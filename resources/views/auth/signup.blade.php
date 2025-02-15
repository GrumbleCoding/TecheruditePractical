@extends('layouts.landing.app')
@section('title', 'Sign Up')
@section('page-css')
@endsection
@section('content')
<section id="auth">
      <div class="row">
        <div class="col-lg-7">
          <img src="{{asset('/assets/landing/images/auth/auth_vector_img.png')}}" alt="image" class="auth_vector" />
        </div>
        <div class="col-lg-5 my-auto">
          <div class="auth_form_blog">
            <div class="auth_blog_title text-center">
              <h4>Create Account</h4>
              <p>Let’s create new account to continue.</p>
            </div>
            <form name="main_form" id="main_form" method="post" enctype="multipart/form-data" action="{{ route('user_signup') }}">
              {!! get_error_html($errors) !!}
              @csrf
              <div class="form-group">
                <label>First Name</label>
                <div class="input_group_include">
                  <span class="vector_bg"><svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.98736 11.6934C3.76434 11.6934 1.01196 12.1807 1.01196 14.1322C1.01196 16.0838 3.74688 16.5886 6.98736 16.5886C10.2104 16.5886 12.962 16.1005 12.962 14.1497C12.962 12.1989 10.2278 11.6934 6.98736 11.6934Z" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.98741 8.90952C9.10249 8.90952 10.8168 7.19444 10.8168 5.07936C10.8168 2.96429 9.10249 1.25 6.98741 1.25C4.87233 1.25 3.15725 2.96429 3.15725 5.07936C3.15011 7.1873 4.85328 8.90238 6.96042 8.90952H6.98741Z" stroke="#8C8C8C" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                    
                  </span>
                  <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter first name" value="{{old('first_name')}}"/>
                </div>
                <label id="first_name-error" class="error" for="first_name" style="color:red;"></label>
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <div class="input_group_include">
                  <span class="vector_bg"><svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.98736 11.6934C3.76434 11.6934 1.01196 12.1807 1.01196 14.1322C1.01196 16.0838 3.74688 16.5886 6.98736 16.5886C10.2104 16.5886 12.962 16.1005 12.962 14.1497C12.962 12.1989 10.2278 11.6934 6.98736 11.6934Z" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.98741 8.90952C9.10249 8.90952 10.8168 7.19444 10.8168 5.07936C10.8168 2.96429 9.10249 1.25 6.98741 1.25C4.87233 1.25 3.15725 2.96429 3.15725 5.07936C3.15011 7.1873 4.85328 8.90238 6.96042 8.90952H6.98741Z" stroke="#8C8C8C" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                    
                  </span>
                  <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter last name" value="{{old('last_name')}}"/>
                </div>
                <label id="last_name-error" class="error" for="last_name" style="color:red;"></label>
              </div>
              <div class="form-group">
                <label>Email address</label>
                <div class="input_group_include">
                  <span class="vector_bg"><svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.919 6.47168L11.2163 9.48254C10.5167 10.0375 9.53244 10.0375 8.83286 9.48254L5.09888 6.47168" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0908 16.5957C16.6253 16.6027 18.3334 14.5203 18.3334 11.961V6.23738C18.3334 3.67806 16.6253 1.5957 14.0908 1.5957H5.90936C3.3749 1.5957 1.66675 3.67806 1.66675 6.23738V11.961C1.66675 14.5203 3.3749 16.6027 5.90936 16.5957H14.0908Z" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </span>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Address" value="{{old('email')}}"/>
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
                  <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" value="{{old('password')}}" maxlength="15"/>
                  <i class="toggle-hide-show fa fa-fw fa-eye-slash"></i>
                </div>
                <label id="password-error" class="error" for="password" style="color:red;"></label>
              </div>
              <div class="form-group">
                <label>Confirm password</label>
                <div class="input_group_include">
                  <span class="vector_bg"><svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.686 6.96842V5.17926C11.686 3.08509 9.98771 1.38676 7.89354 1.38676C5.79937 1.37759 4.09437 3.06759 4.08521 5.16259V5.17926V6.96842" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0692 16.8033H4.70175C2.95675 16.8033 1.54175 15.3892 1.54175 13.6433V10.0692C1.54175 8.32335 2.95675 6.90918 4.70175 6.90918H11.0692C12.8142 6.90918 14.2292 8.32335 14.2292 10.0692V13.6433C14.2292 15.3892 12.8142 16.8033 11.0692 16.8033Z" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.88566 10.9307V12.7815" stroke="#8C8C8C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>                    
                  </span>
                  <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Enter confirm password" value="{{old('cpassword')}}" maxlength="15"/>
                  <i class="toggle-hide-show fa fa-fw fa-eye-slash"></i>
                </div>
                <label id="cpassword-error" class="error" for="cpassword" style="color:red;"></label>
              </div>              
              <button type="submit" class="authbtn">Sign Up</button>              
              <h6 class="newuser_link">Already have an account? <a href="{{route('login')}}"> Log in</a></h6>
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('page-js')
<script src="{{asset('/assets/landing/js/auth.js')}}"></script>

<script>
  $(function () {
    $.validator.addMethod("same", function(value, element, param) {
        return value === $(param).val();
    }, "Password and confirm password do not match.");

    $("#main_form").validate({
        rules: {
            first_name: {required: true},
            last_name: {required: true},
            password: {required: true},
            cpassword: {required: true, same: "#password"},
            email: {
                required: true,
                remote: {
                    type: 'get',
                    url: globalSiteUrl + '/user_availability_checker_signup',
                    data: {
                        email: function () {
                            return $('#email').val();
                        }
                    }
                },
            },
        },
        messages: {
            first_name: {required: "Please enter first name"},
            last_name: {required: "Please enter last name"},
            password: {required: "Please enter password"},
            cpassword: {required: "Please enter confirm password"},
            email: {required: 'Please enter email', remote: "This email is already taken"},   
        },
        submitHandler: function (form) {
            addOverlay();
            form.submit();
        }
    });
  });
</script>
@endsection