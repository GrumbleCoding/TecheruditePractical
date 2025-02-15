@extends('layouts.landing.app')
@section('title', 'Log In')
@section('content')
<section id="auth">
      <div class="row">
        <div class="col-lg-7">
          <img src="{{asset('/assets/landing/images/auth/auth_vector_img.png')}}" alt="image" class="auth_vector" />
        </div>
        <div class="col-lg-5 my-auto">
          <div class="auth_form_blog">
            <div class="auth_blog_title text-center">
              <h4>Log in</h4>
              <p>Enter your credentials to access your account.</p>
            </div>
            <form name="main_form" id="main_form" method="post" enctype="multipart/form-data" action="{{ route('user_login') }}">
              @csrf
              {!! get_error_html($errors) !!}   
              {!! success_error_view_generator() !!}           
              <div class="form-group">
                <label>Email address</label>
                <div class="input_group_include">
                  <span class="vector_bg"><svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.919 6.47168L11.2163 9.48254C10.5167 10.0375 9.53244 10.0375 8.83286 9.48254L5.09888 6.47168" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0908 16.5957C16.6253 16.6027 18.3334 14.5203 18.3334 11.961V6.23738C18.3334 3.67806 16.6253 1.5957 14.0908 1.5957H5.90936C3.3749 1.5957 1.66675 3.67806 1.66675 6.23738V11.961C1.66675 14.5203 3.3749 16.6027 5.90936 16.5957H14.0908Z" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </span>
                  <input type="email" name="email" class="form-control" placeholder="Enter Email Address" />
                </div>
                <label id="email-error" class="error" for="email" style="color:red;"></label>
              </div>
              <div class="form-group">
                <label>Password</label>
                <div class="input_group_include">
                  <span class="vector_bg"><svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.686 6.96842V5.17926C11.686 3.08509 9.98771 1.38676 7.89354 1.38676C5.79937 1.37759 4.09437 3.06759 4.08521 5.16259V5.17926V6.96842" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0692 16.8033H4.70175C2.95675 16.8033 1.54175 15.3892 1.54175 13.6433V10.0692C1.54175 8.32335 2.95675 6.90918 4.70175 6.90918H11.0692C12.8142 6.90918 14.2292 8.32335 14.2292 10.0692V13.6433C14.2292 15.3892 12.8142 16.8033 11.0692 16.8033Z" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.88566 10.9307V12.7815" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                    
                  </span>
                  <input type="password" name="password" class="form-control" placeholder="Enter password" maxlength="15"/>
                  <i class="toggle-hide-show fa fa-fw fa-eye-slash"></i>
                </div>
                <label id="password-error" class="error" for="password" style="color:red;"></label>
              </div>
              <button type="submit" class="authbtn">Log In</button>              
              <h6 class="newuser_link">Don’t have an account? <a href="{{route('signup')}}"> Create account</a></h6>
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('page-js')
<script src="{{asset('/assets/landing/js/auth.js')}}"></script>

<script>
  $("#main_form").validate({
        rules: {
            email: {required: true,},
            password: {required: true,},
        },
        messages: {
            email: {required: 'Please enter email'},
            password: {required: 'Please enter password'},   
        },
        submitHandler: function (form) {
            addOverlay();
            form.submit();
        }
    });
</script>
<script>
    $(function () {
        let showSignupOTPModal = "{{$showSignupOTPModal ?? '0'}}";
        if(showSignupOTPModal == '1'){
            window.location.href = "{{route('otp_verification')}}";
        }
    });
</script>
@endsection