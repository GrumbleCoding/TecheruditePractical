@extends('layouts.landing.app')
@section('title', 'Booking Form')
@section('page-css')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<main>
<section class="wd-registration-blog">
          <div class="container">
            <h1>Booking Form</h1>
            <form name="main_form" id="main_form" method="post" enctype="multipart/form-data" action="{{route('booking')}}">
              {!! get_error_html($errors) !!} 
              {!! success_error_view_generator() !!} 
              @csrf
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Customer Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" />
                  </div>
                  <label id="name-error" class="error" for="name" style="color:red;"></label>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Customer email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" />
                  </div>
                  <label id="email-error" class="error" for="email" style="color:red;"></label>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Booking Date</label>
                    <input type="date" id="date" name="date" class="form-control" placeholder="Select date" />
                  </div>
                  <label id="date-error" class="error" for="date" style="color:red;"></label>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Booking Type</label>
                    <select id="booking_type" name="booking_type" class="js-location form-control">
                        <option value="" selected disabled>--select--</option>
                        <option value="1">Full Day</option>
                        <option value="2">Half Day</option>
                        <option value="3">Custom</option>
                    </select>
                  </div>
                  <label id="booking_type-error" class="error" for="booking_type" style="color:red;"></label>
                </div>

                <div class="col-lg-6 booking_slot">
                  <div class="form-group">
                    <label>Booking Slot</label>
                    <select id="booking_slot" name="booking_slot" class="js-location form-control">
                        <option value="" selected disabled>--select--</option>
                        <option value="1">First Half</option>
                        <option value="2">Second Half</option>
                    </select>
                  </div>
                  <label id="booking_slot-error" class="error" for="booking_slot" style="color:red;"></label>
                </div>

                <div class="col-lg-6 time_slot">
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="time" id="start-time" name="start_time" class="form-control" placeholder="Select start time" />
                    </div>
                    <label id="start-time-error" class="error" for="start-time" style="color:red;"></label>
                </div>

                <div class="col-lg-6 time_slot">
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="time" id="end-time" name="end_time" class="form-control" placeholder="Select end time" />
                    </div>
                    <label id="end-time-error" class="error" for="end-time" style="color:red;"></label>
                </div>

                <div class="col-lg-12">
                    <button type="submit" class="wd-register-btn">Book</button>
                </div>
              </div> 
            </form>
          </div>
        </section>
</main>
@endsection
@section('page-js')
 <!-- Select2 -->  
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- Custom Jquery -->  
  <script>
      $(document).ready(function(){
        $('.time_slot').attr('style', 'display: none;');
        $('.booking_slot').attr('style', 'display: none;');
      });
  </script>
  <script>
    $(document).ready(function () {
        $('#booking_type').on('change', function () {
            if ($(this).val() == "2") {
                $('.booking_slot').removeAttr('style');
                $('.time_slot').attr('style', 'display: none;');
            } else if($(this).val() == "3"){
                $('.booking_slot').attr('style', 'display: none;');
                $('.time_slot').removeAttr('style');
            } else {
                $('.booking_slot').attr('style', 'display: none;');
                $('.time_slot').attr('style', 'display: none;');
            }
        });
    });
  </script>
  <script>
     $(function () {
        $("#main_form").validate({
            rules: {
                name: {required: true},
                email: {required: true},
                date: {required: true},
                booking_type: {required: true},
            },
            messages: {
                name: {required: "Please enter name"},
                date: {required: "Please select date"},
                booking_type: {required: "Please select booking type"},
                email: {required: 'Please enter email'},   
            },
            submitHandler: function (form) {
                addOverlay();
                form.submit();
            }
        });
     });
  </script>
@endsection