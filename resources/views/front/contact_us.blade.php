@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<style>
    .min-height {
    min-height: 0px;
}

.scareer-form_03{display:none !important}
.contact_us.blade_01{height:350px !important;}
</style>

<div class="banner-member">
         <div class="pattern-member about-banner">
            
         </div>
      </div>
<div class="middle-area min-height">
<div class="container">
   <div class="col-sm-7 scareer-form_03">
      <div class="contact-left-sec">
      <form id="frm_contact_us" method="POST" action="{{url('/')}}/contact_enquiry" data-parsley-validate>
      {{ csrf_field() }}
         <h2>Get In Touch with Us</h2>
         @include('front.layout._operation_status')
         <div class="form-group">
            <label>Full Name<span class="star">*</span></label>
            <input type="text" name="name" class="input-box-signup" required=""
                           data-parsley-errors-container="#err_first_name" data-parsley-required-message="This field is required" />
            <div id="err_first_name" class="error"></div>               
            <div class="error">{{ $errors->first('name') }}</div>
         </div>
         <div class="form-group">
            <label>Mobile No.<span class="star">*</span></label>
            <input type="text" name="mob_no" class="input-box-signup" required="" data-parsley-type="integer" data-parsley-errors-container="#err_mobile_no" data-parsley-required-message="This field is required" data-parsley-minlength="7" data-parsley-maxlength="16" />
             <div id="err_mobile_no" class="error"></div>
            <div class="error">{{ $errors->first('mob_no') }}</div>
         </div>
         <div class="form-group">
            <label>Email Address<span class="star">*</span></label>
            <input type="text" name="email" class="input-box-signup" required="" data-parsley-type="email" data-parsley-errors-container="#err_email" data-parsley-required-message="This field is required" />
             <div id="err_email" class="error"></div>
            <div class="error">{{ $errors->first('email') }}</div>
         </div>
         <div class="form-group">
            <label>Message<span class="star">*</span></label>
            <textarea class="form-area" name="message" cols="30" rows="8" required=""
                           data-parsley-errors-container="#err_message" data-parsley-required-message="This field is required"></textarea>
            <div id="err_message" class="error"></div>
            <div class="error">{{ $errors->first('message') }}</div>
         </div>
         <div class="g-recaptcha" data-sitekey="6Lc-HA4UAAAAAPY67Ox_frqmqLpqfPxGmPHg0Aot"></div>

                  <div id="captcha_error" class="error">  </div>
                  <div class="error">{{ $errors->first('condition') }}</div>
         <div class="btn-wrapper">
            <button type="submit" onclick="return validate_with_recaptcha()" class="submit-btn ctn m-top">Submit</button>
         </div>
         </form>
      </div>
   </div>
   <div class="col-sm-12">
      <div class="contact-right-sec">
         <h2>Contact Info</h2>
         <div class="col-sm-4">
         <div class="location">
            <div class="contact-img1"><img src="images/contact-us-img1.jpg" alt="Interviewxp"/></div>
            <div class="location-text">
               <h2>Our Location</h2>
               <h5>{{$arr_account_detail['street_address']}}, {{$arr_account_detail['zipcode']}}</h5>

            </div> </div>
         </div>
         <div class="col-sm-4">
         <div class="call-us">
            <div class="contact-img1"><img src="images/contact-us-img2.jpg" alt="Interviewxp"/></div>
            <div class="location-text">
               <h2>Call us On</h2>
             <!--   <h5>+9168576847,</h5> -->
              <h5>+{{$arr_account_detail['mobile_no']}}</h5>
            </div>
         </div> </div>
         <div class="col-sm-4">
         <div class="message">
            <div class="contact-img1"><img src="images/contact-us-img3.jpg" alt="Interviewxp"/></div>
            <div class="location-text">
               <h2>Leave a Message</h2>
               <h5><span>For Hr queries :</span> {{$arr_email['hr_mail']}}</h5>
               <h5><span>For Openings :</span> {{$arr_email['opening_email']}}</h5>
               <h5><span>For General Info :</span> {{$arr_email['general_email']}}</h5>
            </div>
         </div> </div>
      </div>
   </div>
</div>
</div>

   <div class="map">
             <!-- <input type="hidden" name="lat"  id="lat" readonly="true" value="{{ $arr_account_detail['lat'] or ''}}" />
              <input type="hidden" name="lon"  id="lon" readonly="true" value="{{ $arr_account_detail['lon'] or ''}}" /> -->
              
              <input type="hidden" name="lat"  id="lat" readonly="true" value="17.4158683" />
              <input type="hidden" name="lon"  id="lon" readonly="true" value="78.4470187" />
              <div id="address_map contact_us.blade_01">
              </div>        
   </div>
   <div class="clearfix"></div>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
function validate_with_recaptcha () 
    {

        if($('#frm_contact_us').parsley().isValid())
        {
            
            var is_valid_captcha = grecaptcha.getResponse();  
              
            if(is_valid_captcha == "")
            {
               $('#captcha_error').html('This field is required.');
               return false;
            }
            return grecaptcha.getResponse()==""?false:true
        }
        
    }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places&callback=initAutocomplete"
        async defer>
</script>
<script type="text/javascript">
  var glob_autocomplete;
  
  var glob_marker = false;
  var glob_map = false;
  var glob_options = {
  };
  glob_options.types = ['geocode'];
  
  function initAutocomplete() 
  {
    initializeMap();
  }

  function initializeMap() 
  {
    var lat = $("#lat").val();
    var lon = $("#lon").val();
    if(parseFloat(lat)==0)
    {
      lat = 1.10;
    }
    if(parseFloat(lon)==0)
    {
      lon = 1.10;
    }
    
    var image = '{{url('/')}}/images/rsz_1markbig.png';
    var latlng = new google.maps.LatLng(lat, lon);
    var myOptions = {
      zoom: 14,
      center: latlng,
      panControl: true,
      scrollwheel: true,
      scaleControl: true,
      overviewMapControl: true,
      disableDoubleClickZoom: false,
      overviewMapControlOptions: {
        opened: true }
      ,
      mapTypeId: google.maps.MapTypeId.dd
    };
    glob_map = new google.maps.Map(document.getElementById("address_map"),
                                   myOptions);
    geocoder = new google.maps.Geocoder();
    glob_marker = new google.maps.Marker({
      position: latlng,
      map: glob_map,
      icon :image,
      animation:google.maps.Animation.BOUNCE
    }
                                        );
    glob_map.streetViewControl = false;
    infowindow = new google.maps.InfoWindow({
      content: "(1.10, 1.10)"
    }
                                           );
    google.maps.event.addListener(glob_map, 'click', function(event) 
                                  {
      glob_marker.setPosition(event.latLng);
      var yeri = event.latLng;
      var latlongi = "(" + yeri.lat().toFixed(6) + ", " +yeri.lng().toFixed(6) + ")";
      infowindow.setContent(latlongi);
      document.getElementById('lat').value = yeri.lat().toFixed(6);
      document.getElementById('lon').value = yeri.lng().toFixed(6);
    }
                                 );
    google.maps.event.addListener(glob_map, 'mousewheel', function(event,delta) 
                                  {
      console.log(delta);
    }
                                 );
  }
</script>
@endsection

