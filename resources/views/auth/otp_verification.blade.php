@extends('layouts.landing.app')
@section('title', 'Verify OTP')
@section('content')
<section id="auth">
      <div class="row">
        <div class="col-lg-7">
          <img src="{{asset('/assets/landing/images/auth/auth_vector_img.png')}}" alt="image" class="auth_vector" />
        </div>
        <div class="col-lg-5 my-auto">
          <div class="auth_form_blog">
            <div class="auth_blog_title text-center">
              <h4>OTP Verification</h4>
              <p>We sent you 4-digit code At <br /> <b>{{ session()->get('email') }}</b></p>
            </div>
            <form method="post" enctype="multipart/form-data" action="{{ route('verify_otp') }}">
              {!! success_error_view_generator() !!}     
              @csrf  
                <input type="hidden" id="email" name="email" value="{{ session()->get('email') }}">      
                <div class="form-group otp_blogs" id="otp_verify">
                    <input type="text" name="otp_1" inputmode="numeric" class="form-control" maxlength="1" style="font-size:36px; text-align:center;"/>
                    <input type="text" name="otp_2" inputmode="numeric" class="form-control" maxlength="1" style="font-size:36px; text-align:center;"/>
                    <input type="text" name="otp_3" inputmode="numeric" class="form-control" maxlength="1" style="font-size:36px; text-align:center;"/>
                    <input type="text" name="otp_4" inputmode="numeric" class="form-control" maxlength="1" style="font-size:36px; text-align:center;"/>
                </div>
                <label id="otp_1-error" class="error" for="otp_1" style="color:red;"></label>
                <label id="otp_2-error" class="error" for="otp_2" style="color:red;"></label>
                <label id="otp_3-error" class="error" for="otp_3" style="color:red;"></label>
                <label id="otp_4-error" class="error" for="otp_4" style="color:red;"></label>                            
              <button type="submit" class="authbtn">Verify</button>       
            </form>   
          </div>
        </div>
      </div>
    </section>
@endsection
@section('page-js')
<script src="{{asset('/assets/landing/js/auth.js')}}"></script>

<script>
  const inputs = document.getElementById("otp_verify");
  
  inputs.addEventListener("input", function (e) {
    const target = e.target;
    const val = target.value;
  
    if (isNaN(val)) {
      target.value = "";
      return;
    }
  
    if (val != "") {
      const next = target.nextElementSibling;
      if (next) {
        next.focus();
      }
    }
  });
  
  inputs.addEventListener("keyup", function (e) {
    const target = e.target;
    const key = e.key.toLowerCase();
  
    if (key == "backspace" || key == "delete") {
      target.value = "";
      const prev = target.previousElementSibling;
      if (prev) {
        prev.focus();
      }
      return;
    }
  });
</script>
@endsection