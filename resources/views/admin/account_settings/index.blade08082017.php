@extends('admin.layout.master')    
@section('main_content')
<!-- BEGIN Page Title -->


<div class="page-title">
  <div>
  </div>
</div>
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="fa fa-home">
      </i>
      <a href="{{ url($admin_panel_slug.'/dashboard') }}" class="call_loader">Dashboard
      </a>
    </li>
    <span class="divider">
      <i class="fa fa-angle-right">
      </i>
      <i class="fa fa-cog">
      </i>
    </span> 
    <li class="active">  {{ isset($page_title)?$page_title:"" }}
    </li>
  </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box {{ $theme_color }}">
      <div class="box-title">
        <h3>
          <i class="fa fa-cog">
          </i>{{ isset($page_title)?$page_title:"" }} 
        </h3>
        <div class="box-tool">
        </div>
      </div>
      <div class="box-content">
        @include('admin.layout._operation_status')
        {!! Form::open([ 'url' => $module_url_path.'/update/'.base64_encode($arr_data['id']),
        'method'=>'POST',   
        'class'=>'form-horizontal', 
        'id'=>'validation-form' 
        ]) !!}
        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">First Name
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
            {!! Form::text('first_name',$arr_data['first_name'],['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'255', 'placeholder'=>'First Name']) !!}
            <span class='help-block'>{{ $errors->first('first_name') }}
            </span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">Last Name
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
            {!! Form::text('last_name',$arr_data['last_name'],['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'255', 'placeholder'=>'Last Name']) !!}
            <span class='help-block'>{{ $errors->first('last_name') }}
            </span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">Email
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
            {!! Form::text('email',$arr_data['email'],['class'=>'form-control', 'data-rule-required'=>'true', 'data-rule-email'=>'true', 'data-rule-maxlength'=>'255', 'placeholder'=>'Email']) !!}
            <span class='help-block'>{{ $errors->first('email') }}
            </span>
          </div>
        </div>

         <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">Mobile No
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
            {!! Form::text('mobile_no',$arr_account_detail['mobile_no'],['class'=>'form-control', 'data-rule-required'=>'true','data-rule-digits'=>'true','data-rule-maxlength'=>'10','data-rule-minlength'=>'10','placeholder'=>'Mobile No']) !!}
            <span class='help-block'>{{ $errors->first('mobile_no') }}
            </span>
          </div>
        </div>

        <div class="form-group" style="">
          <label class="col-sm-3 col-lg-2 control-label">Country
            <i style="color: red;">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls" >
            <select class="form-control"  name="country" data-rule-required="true" onchange="changeCountryRestriction(this)" >
              <option value="">--Select Country--
              </option>
              @if(isset($arr_country) && count($arr_country)>0)
              @foreach($arr_country as $key => $value)
              <option @if($arr_account_detail['country_code']==$value['country_code']) selected="" @endif value="{{ $value['country_code'] }}">{{ $value['country_name'] }}
              </option>
              @endforeach
              @endif
            </select>
            <span class="help-block">{{ $errors->first('country') }}
            </span>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">Street Address
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
          <input type="text" name="street_address" id="autocomplete" class="form-control" data-rule-required='true' value="{{isset($arr_account_detail['street_address'])?$arr_account_detail['street_address']:'NA'}}" 
          placeholder="Street">
            
            <span class='help-block'>{{ $errors->first('street_address') }}
            </span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">State
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
          <input type="text" name="state" value="{{isset($arr_account_detail['state'])?$arr_account_detail['state']:'NA'}}" class="form-control" data-rule-required='true'
          placeholder="State Name">
            
            <span class='help-block'>{{ $errors->first('state') }}
            </span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">City
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
          <input type="text" name="city" class="form-control"  id="locality" data-rule-required='true' value="{{isset($arr_account_detail['city'])?$arr_account_detail['city']:'NA'}}"
          placeholder="City">
            
            <span class='help-block'>{{ $errors->first('city') }}
            </span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">Zipcode
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
          <input type="text" class="form-control" name="zipcode" id="postal_code"  data-rule-required="" placeholder="Zip Code" value="{{isset($arr_account_detail['zipcode'])?$arr_account_detail['zipcode']:'NA'}}"   />
            <span class='help-block'>{{ $errors->first('zipcode') }}
            </span>
          </div>
        </div>

        <div class="form-group" style="">     
          <div class="col-md-12">
            <label class="col-sm-3 col-lg-2 control-label" for="">Google Map 
            </label>
            <div class="col-sm-6 col-lg-9 controls">
              <input type="hidden" name="lat"  id="lat" readonly="true" value="{{ $arr_account_detail['lat'] or ''}}" />
              <input type="hidden" name="lon"  id="lon" readonly="true" value="{{ $arr_account_detail['lon'] or ''}}" />
              <div id="address_map" style="height:350px;">
              </div> 
            </div>
          </div>
        </div>
             
        <div class="form-group">
          <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
            {!! Form::submit('Update',[ 'class'=>'btn btn btn-primary','value'=>'true'])!!}
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <!-- END Main Content -->

  <script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCccvQtzVx4aAt05YnfzJDSWEzPiVnNVsY&libraries=places&callback=initAutocomplete"
        async defer>
</script>
<script type="text/javascript">
  var glob_autocomplete;
  var glob_component_form = 
      {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        postal_code: 'short_name'
      };
  var glob_marker = false;
  var glob_map = false;
  var glob_options = {
  };
  glob_options.types = ['geocode'];
  $(document).ready(function()
                    {
    $("#autocomplete").bind('keypress',function(event)
                            {
      if($("#country").val().trim().length==0)
      {
        event.preventDefault();
        alert('Please Select Country First ');
      }
    }
                           );
  }
                   );
  function changeCountryRestriction(ref)
  {
    var country_code = $(ref).val();
    destroyPlaceChangeListener(autocomplete);
    // $('#property_map').show();
    glob_options.componentRestrictions = {
      country: country_code};
    initAutocomplete(country_code);
    glob_autocomplete = false;
    glob_autocomplete = initGoogleAutoComponent($('#autocomplete')[0],glob_options,glob_autocomplete);
  }
  function initAutocomplete(country_code) 
  {
    glob_options.componentRestrictions = {
      country: country_code};
    glob_autocomplete = false;
    glob_autocomplete = initGoogleAutoComponent($('#autocomplete')[0],glob_options,glob_autocomplete);
    initializeMap();
  }
  function initGoogleAutoComponent(elem,options,autocomplete_ref)
  {
    autocomplete_ref = new google.maps.places.Autocomplete(elem,options);
    autocomplete_ref = createPlaceChangeListener(autocomplete_ref,fillInAddress);
    return autocomplete_ref;
  }
  function createPlaceChangeListener(autocomplete_ref,fillInAddress)
  {
    autocomplete_ref.addListener('place_changed', fillInAddress);
    return autocomplete_ref;
  }
  function destroyPlaceChangeListener(autocomplete_ref)
  {
    google.maps.event.clearInstanceListeners(autocomplete_ref);
  }
  function fillInAddress() 
  {
    // Get the place details from the autocomplete object.
    var place = glob_autocomplete.getPlace();
    for (var component in glob_component_form) 
    {
      $("#"+component).val("");
      $("#"+component).attr('disabled',false);
    }
    if(place.address_components.length > 0 )
    {
      $.each(place.address_components,function(index,elem)
             {
        var addressType = elem.types[0];
        if(glob_component_form[addressType])
        {
          var val = elem[glob_component_form[addressType]];
          $("#"+addressType).val(val) ;
        }
      }
            );
    }
    $('#lat').val(place.geometry.location.lat());
    $('#lon').val(place.geometry.location.lng());
    glob_marker.setPosition(place.geometry.location);
    glob_map.setCenter(place.geometry.location);
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
      zoom: 17,
      center: latlng,
      panControl: true,
      scrollwheel: true,
      scaleControl: true,
      overviewMapControl: true,
      disableDoubleClickZoom: false,
      overviewMapControlOptions: {
        opened: true }
      ,
      mapTypeId: google.maps.MapTypeId.HYBRID
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
