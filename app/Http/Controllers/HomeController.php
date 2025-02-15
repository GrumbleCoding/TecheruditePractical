<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Mail\General\User_Register_Mail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function userSignup(Request $request)
    {
        User::where('email', $request->email)->whereNull('email_verified_at')->forceDelete();

        $request->validate([
            'first_name' => ['required', 'min:2', 'max:30'],
            'last_name' => ['required', 'min:2', 'max:30'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users','email')->whereNull('deleted_at')],
            'password' => ['required', 'min:6', 'max:15'],
            'cpassword' => ['required','same:password'],
            'push_token' => ['nullable'],
            'device_id' => ['nullable', 'max:255'],
            'device_type' => ['nullable', 'in:android,ios'],
        ], [
            'email.unique' => __('api.err_email_is_exits'),
            'cpassword.same' => "Password and confirm password do not match.",
        ]);

        $user = User::create([
            'type' => 'user',
            'first_name' => $request->first_name ?? '',
            'last_name' => $request->last_name ?? '',
            'email' => $request->email ?? '',
            'password' => Hash::make($request->password),
            'status' => 'active',
            'otp' => rand(1000, 9999),
        ]);

        Mail::to($user->email)->send(new User_Register_Mail($user));

        $showSignupOTPModal = '1';
        $request->session()->put('email',$user->email);
        success_session('Otp sent successfully');
        
        return view('welcome', compact('showSignupOTPModal'));
    }

    public function userAvailabilityCheckerSignup(Request $request)
    {
        $query = User::query();
        if ($request->email) {
            $query = $query->where('email', $request->email)->whereNotNull('email_verified_at');
        }else {
            return 'false';
        }

        return $query->count() ? "false" : "true";
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => ['required'],
        ]);

        if(!empty($request->otp_1) && !empty($request->otp_2) && !empty($request->otp_3) && !empty($request->otp_4)){
            $otp = $request->otp_1.''.$request->otp_2.''.$request->otp_3.''.$request->otp_4;
            $user = User::where('email', $request->email)->first();
            if(!empty($user)){
                if($user->otp == $otp){
                    User::where('id',$user->id)->update(['email_verified_at' => Carbon::now(), 'otp' => null]);
                
                    success_session('OTP verified successfully');
                    return redirect()->route('login');
                }else{
                    error_session('Please enter valid OTP');
                    return redirect()->back();
                }
            }else{
                error_session('Email not found');
                return redirect()->back();
            }
        }
        error_session('Please enter OTP');
        return redirect()->back();
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'max:15'],
        ]);

        $user_reg = User::where('email',$request->email)->where('type','user')->first();
        if(!empty($user_reg)){
            $user_data = User::where('email',$request->email)->where('type','user')->where('status','active')->first();
            if(!empty($user_data)){
                if(Hash::check($request->password,$user_data->password)){
                        $attempt = ['email' => $request->email, 'password' => $request->password, 'type' => 'user', 'status' => 'active'];
                }else{
                    error_session('Invalid password. Please check your password and try again.');
                    return redirect()->back();
                }

                if (Auth::attempt($attempt)) {
                    return redirect()->route(getDashboardRouteName());
                }else{
                    error_session('Your account is pending admin approval. You will be able to log in once the admin has approved your account');
                    return redirect()->back();
                }

            }else{
                error_session('Your account has been disabled, kindly contact to the admin.');
                return redirect()->back();
            }
        }else{
            error_session('We dont have an account with this email address.');
            return redirect()->back();
        }
    }

    public function home()
    {
        return view('landing.home');
    }

    // public function booking(Request $request)
    // {
    //     $request->validate([
    //         'name' => ['required'],
    //         'email' => ['required', 'email'],  
    //         'date' => ['required'], 
    //         'booking_type' => ['required'],     
    //     ]);

    //     $checkBooking = Booking::where('user_id', Auth::user()->id)->where('booking_date', $request->date)->where('booking_type', '1')->first();
    //     $checkBook = Booking::where('user_id', Auth::user()->id)->where('booking_date', $request->date)->where('booking_type', '1')->first();
    //     if(!empty($checkBooking)){
    //         error_session('You have already booked this date as full day');
    //         return redirect()->back();
    //     }elseif(!empty($checkBook)){
    //         error_session('You have already booked this date as full day');
    //         return redirect()->back();
    //     }

    //     $booking = new Booking;
    //     $booking->user_id = Auth::user()->id;
    //     $booking->customer_name = $request->name;
    //     $booking->customer_email = $request->email;
    //     $booking->booking_date = $request->date;
    //     $booking->booking_type = $request->booking_type;
    //     $booking->booking_slot = $request->booking_slot ?? '0';
    //     $booking->start_time = $request->start_time ?? null;
    //     $booking->end_time = $request->end_time ?? null;
    //     $booking->save();

    //     success_session('Booking done successfully');
    //     return redirect()->back();
    // }

    public function booking(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],  
            'date' => ['required'], 
            'booking_type' => ['required'],     
        ]);

        if($request->booking_type == '1'){
            $checkFullDayBooking = Booking::where('user_id', Auth::user()->id)->where('booking_date', $request->date)->where('booking_type','1')->first();
            if ($checkFullDayBooking) {
                error_session('You have already booked this date');
                return redirect()->back();
            }else{
                $checkHalfDayBooking = Booking::where('user_id', Auth::user()->id)->where('booking_date', $request->date)->where('booking_type', '2')->whereIn('booking_slot', ['1','2'])->first();
                if ($checkHalfDayBooking) {
                    error_session('You have already booked this date');
                    return redirect()->back();
                }else{
                    $alreadyBook = Booking::where('user_id', Auth::user()->id)->where('booking_date', $request->date)->where('booking_type', '3')->first();
                    if ($alreadyBook) {
                        error_session('You have already booked this date');
                        return redirect()->back();
                    }
                }
            }
        }elseif($request->booking_type == '2'){
            $checkHalfDayBooking = Booking::where('user_id', Auth::user()->id)->where('booking_date', $request->date)->where('booking_type', '2')->where('booking_slot', $request->booking_slot)->first();
            if ($checkHalfDayBooking) {
                error_session('You have already booked this date');
                return redirect()->back();
            }else{
                $checkFullDayBooking = Booking::where('user_id', Auth::user()->id)->where('booking_date', $request->date)->where('booking_type','1')->first();
                if ($checkFullDayBooking) {
                    error_session('You have already booked this date');
                    return redirect()->back();
                }else{
                    $alreadyBook = Booking::where('user_id', Auth::user()->id)->where('booking_date', $request->date)->where('booking_type', '3')->first();
                    if ($alreadyBook) {
                        $startTime = Carbon::parse($alreadyBook->start_time);
                        $endTime = Carbon::parse($alreadyBook->end_time);
                    
                        $firstHalfStart = Carbon::today()->startOfDay();
                        $firstHalfEnd = Carbon::today()->setTime(12, 0);
                        $secondHalfStart = Carbon::today()->setTime(12, 1);
                        $secondHalfEnd = Carbon::today()->endOfDay();
                    
                        $isInFirstHalf = $startTime->between($firstHalfStart, $firstHalfEnd) || $endTime->between($firstHalfStart, $firstHalfEnd);
                        $isInSecondHalf = $startTime->between($secondHalfStart, $secondHalfEnd) || $endTime->between($secondHalfStart, $secondHalfEnd);

                        if ($isInFirstHalf && $request->booking_slot == '1') {
                            error_session('You have already booked this date');
                            return redirect()->back();
                        }elseif($isInSecondHalf && $request->booking_slot == '2'){
                            error_session('You have already booked this date');
                            return redirect()->back();
                        } 
                    }
                }
            }
        }elseif($request->booking_type == '3'){
            $timeCheck = Booking::where('user_id', Auth::user()->id)->where('booking_date', $request->date)->where('booking_type','3')->where('start_time', $request->start_time)->where('end_time', $request->end_time)->first();
            if ($timeCheck) {
                error_session('You have already booked this date');
                return redirect()->back();
            }else{
                $checkFullDayBooking = Booking::where('user_id', Auth::user()->id)->where('booking_date', $request->date)->where('booking_type','1')->first();
                if ($checkFullDayBooking) {
                    error_session('You have already booked this date');
                    return redirect()->back();
                }else{
                    $alreadyBook = Booking::where('user_id', Auth::user()->id)->where('booking_date', $request->date)->where('booking_type', '2')->first();
                    if ($alreadyBook) {
                        $startTime = Carbon::parse($request->start_time);
                        $endTime = Carbon::parse($request->end_time);
                    
                        $firstHalfStart = Carbon::today()->startOfDay();
                        $firstHalfEnd = Carbon::today()->setTime(12, 0);
                        $secondHalfStart = Carbon::today()->setTime(12, 1);
                        $secondHalfEnd = Carbon::today()->endOfDay();
                    
                        $isInFirstHalf = $startTime->between($firstHalfStart, $firstHalfEnd) || $endTime->between($firstHalfStart, $firstHalfEnd);
                        $isInSecondHalf = $startTime->between($secondHalfStart, $secondHalfEnd) || $endTime->between($secondHalfStart, $secondHalfEnd);

                        if ($isInFirstHalf && $alreadyBook->booking_slot == '1') {
                            error_session('You have already booked this date');
                            return redirect()->back();
                        }elseif($isInSecondHalf && $alreadyBook->booking_slot == '2'){
                            error_session('You have already booked this date');
                            return redirect()->back();
                        } 
                    }
                }
            }
        }

        $booking = new Booking;
        $booking->user_id = Auth::user()->id;
        $booking->customer_name = $request->name;
        $booking->customer_email = $request->email;
        $booking->booking_date = $request->date;
        $booking->booking_type = $request->booking_type;
        $booking->booking_slot = $request->booking_slot ?? '0';
        $booking->start_time = $request->start_time ?? null;
        $booking->end_time = $request->end_time ?? null;
        $booking->save();

        success_session('Booking done successfully');
        return redirect()->back();
    }

    public function userLogout()
    {
        $name = getDashboardRouteName();
        Auth::logout();
        return redirect()->route($name);
    }
}
