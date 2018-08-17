<style>
.sedit_employment_01{background: #f5f5f5 !important;}
.sedit_employment_02{ border: none !important;}
.sedit_employment_03{ height: 210px !important;
 width: 100%  !important;
 margin: 0px  !important;
 padding: 0px !important; overflow: visible  !important;}
.croppie-container { height:400px !important;}
.sedit_employment_04{height: 208px !important;
    margin-bottom: 0px !important;

    margin: 0px !important;
    padding: 0px !important;
    float: left !important;
    width: 100% !important;
    background-size: cover !important;     box-shadow: 0 0 0 1px rgba(0,0,0,.1), 0 2px 3px rgba(0,0,0,.2) !important;
    transition: box-shadow 83ms !important;}

.sedit_employment_05{font-size: 12px !important; color:#0e998e !important; background: #fff !important; padding: 5px 6px !important; border-radius: 13px !important;
box-shadow: 0px 0px 23px #0000005e !important;}

.sedit_employment_06{height:30px}
.sedit_employment_07{ width: 130px !important;
 margin-top: 123px !important; max-width: 130px !important;
 max-height: 130px !important;
  height: 130px !important; margin-left: 50px !important;  border: 5px solid #f2f5f7 !important;
 cursor: pointer !important;
 box-shadow: 0px 0px 28px #0000006e !important;}

.sedit_employment_08{font-size: 20px;color: #0e998e !important;}
.sedit_employment_09{height: 260px !important; margin-top: -41px !important;  width:100% !important; visibility:hidden !important;}

.sedit_employment_010{ float: left !important; width: 100% !important; padding-top: 54px !important; margin-left: 0px !important;}
.sedit_employment_011{text-align: center !important;
 text-transform: capitalize !important;
    font-weight: 500 !important;
    font-size: 17px !important;}
.sedit_employment_012{padding-top: 5px;}
.sedit_employment_013{text-align: center; font-size: 14px;}
.sedit_employment_014{text-align: justify;  font-size: 14px;}
.sedit_employment_015{padding: 14px;}
.sedit_employment_016{ padding-bottom: 0px;
    margin-bottom: 0px;
    height: 10px;
    font-size: 18px;}
.sedit_employment_017{font-size: 20px;
    font-weight: 500;
    font-family: 'ubunturegular', sans-serif;}
.sedit_employment_018{padding: 15px; margin-bottom: 0px; border-bottom: 1px solid #f5f5f5;}
.sedit_employment_019{float: right;
    margin-left: 5px;
    color: #fc575c;
    font-size: 16px;}
.sedit_employment_020{margin-top: 10px;}
.sedit_employment_021{line-height: 13px;}
.sedit_employment_022{padding-top: 10px; font-size: 14px;}
.sedit_employment_023{padding: 15px; margin-bottom: 0px; border-bottom: 1px solid #f5f5f5; float: left;
    width: 100%;}
.sedit_employment_024{font-size: 20px;
    font-weight: 500;
    font-family: 'ubunturegular', sans-serif; margin-bottom: 8px;}
.sedit_employment_025{text-align:left; font-weight: 500;
    font-size: 16px;"}
.sedit_employment_026{line-height: 13px; text-transform: capitalize;}
.sedit_employment_027{padding: 15px; margin-bottom: 0px; border-bottom: 1px solid #f5f5f5;}
.sedit_employment_028{font-size: 20px;
    font-weight: 500;
    font-family: 'ubunturegular', sans-serif;  margin-bottom: 0px;}
.sedit_employment_029{ font-size: 20px;   color: #4267b2;}
.sedit_employment_030{padding:0px}
.sedit_employment_031{width: 95.8%;}

.sedit_employment_032{padding: 0px;}
.sedit_employment_033{margin-top: -10px;float: right;cursor:pointer}
.sedit_employment_034{clear:both}
.sedit_employment_035{width: 95.8%;}
.sedit_employment_036{margin-top: -253.5px !important;}
.sedit_employment_037{background: #102b44 !important;}
.sedit_employment_038{color: #fff !important;}
.sedit_employment_039{margin-top: -253.5px !important;}
.sedit_employment_040{width: 1036px !important;}
.sedit_employment_041{margin-top: 16px !important;}
.sedit_employment_042{z-index: 99999999999999999999999 !important;}
.sedit_employment_043{width: 200px !important;}
.sedit_employment_044{color:#0f8a80 !important;}
.sedit_employment_045{padding: 15px !important; margin-bottom: 0px!important; border-bottom: 1px solid #f5f5f5 !important;   margin-bottom: 12px !important;    width: 100% !important; float: left !important;}

</style>


@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<script>
getStates({{$arr_data['education_country_id']}}, {{$arr_data['education_state']}}, 'state_id');
getCities({{$arr_data['education_state']}}, {{$arr_data['education_city']}}, 'city_id');
function getCountryPhoneCode(country_id){
     $.ajax({
            url: "{{url('/get_country_phone_code')}}",
            type: "get",
            data: {country_id: country_id},
			dataType:'json',
            success: function (data) {
                $('#mobile_code').val(data);
            }
        });
}

function getStates(country_id, state_id='', id){
     $.ajax({
            url: "{{url('/get_states')}}",
            type: "get",
            data: {country_id: country_id, state_id: state_id},
			dataType:'json',
            success: function (data) {
                $('#'+id).html(data);
            }
        });
}

function getCities(state_id, city_id='', id){
    $.ajax({
        url: "{{url('/get_cities')}}",
        type: "get",
        data: {state_id: state_id, city_id: city_id},
		dataType:'json',
        success: function (data) {
            $('#'+id).html(data);
        }
    });
}

$(document).ready(function() { 

	$(document).on('click','.emp_close', function() {
		$(this).parent().remove();
	});
	$(document).on('change','input[type="checkbox"]', function() {
	   $(this).siblings('input[type="checkbox"]').prop('checked', false);
	});

    $('#country_id').on('change', function () {
        var country = this.value;
        var state = '';
        getStates(country, state, 'state_id');
		getCountryPhoneCode(country);
        getCities(0,'');
    });
    $('#state_id').on('change', function () {
        var state = this.value;
        var city = '';
		getCities(state, city, 'city_id');
    });
	
	$(document).on('change','.company_country_id', function () {
        var country = $(this).val();
        var state = '';
		var key = $(this).attr('data-key');		
        getStates(country, state, 'state'+key);
		getCountryPhoneCode(country);
        getCities(0,'');
    });
    $(document).on('change', '.company_state_id', function () {
        var state = $(this).val();
        var city = '';
		var key = $(this).attr('data-key');
		getCities(state, city, 'city'+key);
    });
   

});

</script>
<script>
function getCountryPhoneCode(country_id){
     $.ajax({
            url: "{{url('/get_country_phone_code')}}",
            type: "get",
            data: {country_id: country_id},
			dataType:'json',
            success: function (data) {
                $('#mobile_code').val(data);
            }
        });
}

function getStates(country_id, state_id='', id){
     $.ajax({
            url: "{{url('/get_states')}}",
            type: "get",
            data: {country_id: country_id, state_id: state_id},
			dataType:'json',
            success: function (data) {
                $('#'+id).html(data);
            }
        });
}

function getCities(state_id, city_id='', id){
    $.ajax({
        url: "{{url('/get_cities')}}",
        type: "get",
        data: {state_id: state_id, city_id: city_id},
		dataType:'json',
        success: function (data) {
            $('#'+id).html(data);
        }
    });
}

</script>

<script src="http://cloudforcehub.com/interviewxp/js/croppie.js"></script>
		<link rel="stylesheet" href="http://cloudforcehub.com/interviewxp/js/croppie.css" />
	
 <script>  
$(document).ready(function(){

	$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){ 
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"http://cloudforcehub.com/interviewxp/upload.php",
        type: "POST",
        data:{"image": response,"id":'<?=$arr_data['user_id'];?>'},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#uploaded_image').html(data);
          location.reload();
        }
      });
    })
  });

});  
</script>


	
 <script>  
$(document).ready(function(){

	$image_crop1 = $('#image_demo1').croppie({
    enableExif: true,
    viewport: {
      width:900,
      height:210,
      type:'square' //circle
    },
    boundary:{
      width:1000,
      height:300
    }
  });

  $('#upload_image1').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop1.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
   
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal1').modal('show');
  });

  $('.crop_image1').click(function(event){ 
    $image_crop1.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"http://cloudforcehub.com/interviewxp/uploads.php",
        type: "POST",
        data:{"image": response,"id":'<?=$arr_data['user_id'];?>'},
        success:function(data)
        {
          $('#uploadimageModal1').modal('hide');
          $('#uploaded_image1').html(data);
          location.reload();
        }
      });
    })
  });

});  
</script>




<style>
    
     .outer-div
{
  height: 100vh;
  overflow: hidden; 
}
.inner-div
{
  height: 100%;
  width: 100%;
  background-size: cover;
  background-position: center;
  transition: all 0.5s ease;
  background-image: url('http://www.tipue.com/img/yes.jpg');
}
.inner-div:hover
{
  transform: scale(1.2);
}
</style>
<div class="banner-member">
   <div class="pattern-member">
   </div>
</div>
<div class="container-fluid fix-left-bar">
   <div class="row">
      @include('front.member.member_sidebar')
      <div class="col-sm-8 col-md-9 col-lg-10 middle-content sedit_employment_01" >
        
         <div class="right-section-member sedit_employment_02">
            <div class="col-sm-12 col-md-10 form-wrapper">
			

               <div class="member-myProfile-form">
              
                 <?php $current_year = date('Y'); 
						
						$banner_image = $arr_data['banner_image'];
						
						if(!empty($banner_image))
						{
							$bgImage = url('/').'/uploads/profile_images/interviewCoach/'.$banner_image;
						}
						else{
							$bgImage = url('/').'/images/coach_banner.jpg';
						}
						
						$profile_image = $arr_data['profile_image'];
						
						if(!empty($profile_image))
						{
							$profile_image = url('/').'/uploads/profile_images/'.$profile_image;
						}
						else{
							$profile_image = url('/').'/images/Profile-img.jpg';
						}
						
					?>
					<div class="col-sm-12 card hovercard sedit_employment_03" id="A"  >						
						<span id="uploaded_image1"></span>
						
						
						<div class="sedit_employment_04" style="background-image: url('{{$bgImage}}');
						" id="bg_banner_image">
							    
							    
							    
								
								<label for="upload_image1" class="btn banner_image_label sedit_employment_05" style="float: right;"><i class="fa fa-pencil" aria-hidden="true" ></i></label>
								
							
								
						
								
										 <div class="avatar sedit_employment_06" >
								     <span id="uploaded_image">
								          
								 <img src="{{$profile_image}}" class="inner-div sedit_employment_07" id="profile_image uploaded_image">
								 </span>
								 
								 <label for="upload_image" class="btn profile_image_label"><i class="fa fa-pencil sedit_employment_08" aria-hidden="true"></i></label>
								 
								<input name="upload_image" class="myclassf sedit_employment_09" type="file" onchange="readURL(this);" 		 id="upload_image" > 
								 
								<input name="upload_image1" class="myclassf sedit_employment_09" type="file" onchange="readURL(this);" 		id="upload_image1" > 
								
								</div>
								
								
								
								
								
								
								
								
								
								
								
								
								
							</div>
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
					</div>	
					
					
					
					
					
					
					
					
					
					
					
					<?php
					
						$countryDetails = DB::table('countries')->where('id',$arr_data['education_country_id'])->first();
													$stateDetails = DB::table('state')->where('id',$arr_data['education_state'])->first();
													$cityDetails = DB::table('city')->where('city_id',$arr_data['education_city'])->first();
													
													
													?>
					
					
					
					
					
					
					
					<div class="row sedit_employment_010" >
					    
<div class="col-sm-12 col-md-12 col-lg-12"> 

 <i class="fa fa-pencil-square editpersonal" aria-hidden="true"  data-toggle="modal" href="#editpersonal" data-toggle="tooltip" title="Edit Summery"></i>
 
 
 
<p class="sedit_employment_011" >{{$arr_data['first_name']}} {{$arr_data['last_name']}}
    </p> 
    
    
    
    
   
    
    
    
    </div>
    
    

    
    
    
    
    
    
    
    
    
    
					        <div class="col-sm-12 col-md-12 col-lg-12 sedit_employment_012" >
					            
    
    <p class="sedit_employment_013" >{{$arr_data['headline']}}</p>
    
       <p class="sedit_employment_013" ><i class="fa fa-map-marker sedit_employment_044"  aria-hidden="true"></i> {{ $countryDetails->country_name or ''}}, {{$stateDetails->state_name or ''}}, {{$cityDetails->city_name or ''}}</p>
       
       <p class="sedit_employment_014"> {{$arr_data['designation']}}</p>
       
    
    </div>
					    
                     
                     </div>	 
				
				  <div class="clearfix"></div>
			
				 <div class="row sedit_employment_015">
							<label class="col-sm-12 company-details sedit_employment_016"><i class="fa fa-plus-square addemplyeement"  aria-hidden="true"   data-toggle="modal" href="#addemplyeement"  data-toggle="tooltip" title="Add Experience"></i>

<h3 class="sedit_employment_017">Employment Details</h3></label>
					  </div>
					 @if(count($arr_employeeDetails) > 0)
					 @foreach($arr_employeeDetails as $key=>$value)
					 
					 <div id="current_employer" class="sedit_employment_018">
					     
					     
					     
					
						<a href="{{url('/')}}/member/delete_empylemet/{{ $value->id }}" onclick="return confirm('Are you sure to delete this?')" title="Delete This"><i class="fa fa-trash sedit_employment_019" aria-hidden="true" 
						></i></a>
							<i class="fa fa-pencil-square editmplyeement"  aria-hidden="true"   data-toggle="modal" href="#editemplyeement"  aria-hidden="true" id="{{ $value->id }}" data-toggle="tooltip" title="Edit {{ $value->designation }} Details"></i>
						
						
				<p class="company-details hcc sedit_employment_020">{{ $value->designation }}</p>
				
				
<p class="company-details">
<span class="lbl-right sedit_employment_021">{{ ($value->display_company) ? $value->display_company : $value->company_name }}</span>
</p>

<p class="company-join-date sedit_employment_021" >
															
																<?php
																	$startDate = $value->start_year.'-'.$value->start_month.'-01';
																	if($value->end_month == 'present')
																	{
																		$end_month = date('m');
																		$end_year = date('Y');
																	}
																	else
																	{
																		$end_month = $value->end_month;
																		$end_year = $value->end_year;
																	}
																		
																	
																	$endDate = $end_year.'-'.$end_month.'-01';
																	$datetime1 = new DateTime($startDate);
																	$datetime2 = new DateTime($endDate);
																	$interval = $datetime1->diff($datetime2);
																?>	
																
																@if($value->employer_type == 'current')																
																<span class="lbl-right">{{ date('M', mktime(0, 0, 0, $value->start_month, 10)) }} {{ $value->start_year }} – {{ $value->end_month }} &nbsp;<b>&#8226;</b>&nbsp;{{$interval->format('%yyrs %mmos')}}</span>	
																@else	
																<span class="lbl-right">{{ date('M', mktime(0, 0, 0, $value->start_month, 10)) }} {{ $value->start_year }} – {{ date('M', mktime(0, 0, 0, $value->end_month, 10)) }} {{ $value->end_year }} &nbsp;<b>&#8226;</b>&nbsp;{{$interval->format('%yyrs %mmos')}}</span>
																@endif
															</p>
														
<p class="company-details">
															<?php
																$empCountryDetails = DB::table('countries')->where('id',$value->country)->first();
																$empStateDetails = DB::table('state')->where('id',$value->state)->first();
																$empCityDetails = DB::table('city')->where('city_id',$value->city)->first();
															?>
															<span class="lbl-right sedit_employment_021">{{isset($empCityDetails->city_name)? $empCityDetails->city_name.',' : ''}} {{isset($empCityDetails->state_name) ? $empStateDetails->state_name.',' : ''}} {{isset($empCityDetails->country_name) ? $empCountryDetails->country_name : ''}}</span>
														  </p>		
														  <p class="company-details sedit_employment_022" >
															<span class="lbl-right">{!! nl2br($value->description) !!}</span>
														  </p>
														  
														  
									
                     </div>
					
					@endforeach
					@endif
					 
                  
                  
                  
                  
                 
                 
               
                     
	 <div id="current_employer" class="sedit_employment_023" >
                 	     
                 	     <h3 id ="B" class="sedit_employment_017" >Personal</h3>


	
	
    <div class="col-sm-12 col-md-12 col-lg-12 sedit_employment_032" id="personalview" > 
    
    
  	<i class="fa fa-pencil-square editpro_save"  aria-hidden="true"   data-toggle="modal" href="#editpro_save" aria-hidden="true" data-toggle="tooltip" title="Edit Personal"></i>
<p class="sedit_employment_025">Email: {{$arr_data['email']}}</p>  </div>
    
<div class="col-sm-12 col-md-12 col-lg-12 sedit_employment_032" >
<p class="sedit_employment_025">Phone No.: {{$arr_data['mobile_code']}}  {{$arr_data['mobile_no']}} </p>  </div>
    
    <div class="col-sm-12 col-md-12 col-lg-12 sedit_employment_032" >
<p class="sedit_employment_025">DOB: {{$arr_data['birth_date']}}</p>  </div>
    
 <div class="col-sm-12 col-md-12 col-lg-12 sedit_employment_032">
     
        <?php if(isset($arr_data['gender']) && $arr_data['gender']=='M') { $selectg="Male"; }  else { $selectg="Female";  }  ?>
        
        
<p class="sedit_employment_025">Gender: {{@$selectg}} </p>  </div>
    
    
    
      <div class="col-sm-12 col-md-12 col-lg-12 sedit_employment_032" >
<p class="sedit_employment_025">Pan No.: {{isset($arr_data['pan_no'])?$arr_data['pan_no']:'NA'}} </p>  </div>
				
										  
									
                     </div>
                     
                     
                     
                      	 <div id="current_employer sedit_employment_045" style="padding-left: 21px;">
                 	     
                 	     <h3 id="C" class="sedit_employment_017" >Education</h3>

<?php $qualificationDetails = DB::table('qualification')->where('id',$arr_data['qualification_id'])->first(); 

$qualificationDetailsm = DB::table('specialization')->where('id',$arr_data['specialization_id'])->first(); 


?>

						<i class="fa fa-pencil-square editeducation_save"  aria-hidden="true"   data-toggle="modal" href="#editeducation_save" data-toggle="tooltip" title="Edit {{$qualificationDetails->qualification_name}} Details"></i>
						
						
						
				<p class="company-details sedit_employment_020  "> Qualification: {{$qualificationDetails->qualification_name}}</p>
				
				
<p class="company-details">
<span class="lbl-right sedit_employment_021">Specialization: {{@$qualificationDetailsm->specialization_name}}</span>
</p>

<p class="company-join-date sedit_employment_026"> Passout year: {{$arr_data['passing_month']}} - {{$arr_data['passing_year']}}	</p>
														
<p class="company-details">Marks: {{isset($arr_data['marks'])?$arr_data['marks']:'NA'}} <?php if($arr_data['marks_type']=='percentage')   { echo "%"; } else { echo "CGPA"; } ?> </p>		

											  
														  
									
                     </div>
                      
                     

	 <div id="current_employer sedit_employment_027" style="padding-left: 21px;">
                 	     
                 	     <h3 class="sedit_employment_017">Social Network</h3>



				 	<i class="fa fa-pencil-square socaileditemp"  aria-hidden="true"   data-toggle="modal" href="#socaileditemp"  aria-hidden="true" data-toggle="tooltip" title="Edit Socail Details"></i>
						
						
<p class="company-details sedit_employment_020"><i class="fa fa-facebook-square sedit_employment_029" aria-hidden="true"></i> {{isset($arr_data['facebook'])?$arr_data['facebook']:'NA'}}</p>
<p class="company-details sedit_employment_020"><i class="fa fa-linkedin-square sedit_employment_029" aria-hidden="true" ></i> {{isset($arr_data['linkedin'])?$arr_data['linkedin']:'NA'}}</p>
<p class="company-details sedit_employment_020"><i class="fa fa-twitter-square sedit_employment_029" aria-hidden="true"></i> {{isset($arr_data['twitter'])?$arr_data['twitter']:'NA'}}</p>
				
				
										  
									
                     </div>
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                  
                  
                  
                  

             
               <input type="hidden" value="{{$enc_id or ''}}" name="enc_id">
               
              
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
</div>


{{-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> --}}
<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/admin/jquery.tokenize.css"/>
<script type="text/javascript" src="{{url('/')}}/js/admin/jquery.tokenize.js"></script>

<!-- <script type="text/javascript">
   $("#frm_edit_employment").validate({
         errorElement: 'div',
         errorClass: 'error',
         highlight: function (element) {
             $(element).removeClass('error');
         }
   });
   
   
</script> -->

<script type="text/javascript">
$(document).ready(function(){
	//Image file input change event
	$("#member-photo-edit-upload-input").change(function(){
		readImageData(this, '#profile_image', 1);//Call image read and render function
	});
	$("#member-banner-edit-upload-input").change(function(){
		readImageData(this, '#bg_banner_image', 2);//Call image read and render function
	});
});
function readImageData(imgData, id, type){
	if (imgData.files && imgData.files[0]) {
		var readerObj = new FileReader();
		
		readerObj.onload = function (element) {
			if(type == 1)
			{
				$(id).attr('src', element.target.result);
			}
			else
			{
				$(id).css('background-image', 'url(' + element.target.result + ')');
			}										
			
		}
		
		readerObj.readAsDataURL(imgData.files[0]);
	}
}

</script>
<?php	
	$countries = json_encode($arr_country);
  $display_company = (isset($value->display_company)) ? 'Confidential' : '';
?>		 
<script type="text/javascript">
  var count = '{{count($arr_employeeDetails)}}';  
  var current_year = new Date().getFullYear();
    $("#add_more").click(function()
    {
      
        var content='<div class="previous_employer_details">';
        var countries = <?php echo $countries; ?>;

        content+='<i class="fa fa-times-circle-o fa-2x pull-right emp_close sedit_employment_033" aria-hidden="true" ></i>';
        content+='<div class="form-group sedit_employment_034">';
        content+='<label>Designation<span class="star">*</span></label>'
        content+='<input type="text" id="previous_designation'+count+'" class="input-box-signup" placeholder="Enter Your Designation" name="current_designation[]" data-parsley-required="true" data-parsley-errors-container="#err_previous_designation'+count+'" data-parsley-required-message="This field is required"/>';
        content+='<div id="err_previous_designation'+count+'" class="error"></div>';
        content+='<div class="error"></div>'; 
        content+='</div>';

        content+='<div class="form-group">';
        content+='<label>Company Name<span class="star">*</span></label>';
        content+='<input data-parsley-required="true" id="previous_company_name'+count+'" data-parsley-errors-container="#err_company_name'+count+'" data-parsley-required-message="This field is required" type="text" class="input-box-signup"  name="company_name[]" placeholder="Enter Name Of Your Employer"  />';
        content+='<div id="err_company_name'+count+'" class="error"></div>';
        content+='<div class="error"></div>';
        content+='</div>';
		
		content+='<div class="form-group">';
		content+='<input id="display_company" type="checkbox"  name="display_company['+count+']" value="Confidential" {{ $display_company ==  "Confidential" ? "checked" : ""  }}>&nbsp;&nbsp;<span>Confidential</span>';
		content+='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		content+='<input id="display_company" type="checkbox"  name="display_company['+count+']" value="MNC" {{ $display_company ==  "MNC" ? "checked" : ""  }}>&nbsp;&nbsp;<span>MNC</span>';
		content+='</div>';

		content+='<div id="row">';
		content+='<div class="col-sm-4 sedit_employment_030" >';
		content+='<div class="form-group">';
		content+='<label>Country<span class="star">*</span></label>';
		content+='<div class="select-number sedit_employment_031" >';
		content+='<select id="country'+count+'" data-key="'+count+'" name="country[]" data-parsley-required="true" data-parsley-errors-container="#err_company_ountry_id'+count+'" data-parsley-required-message="This field is required" data-parsley-id="'+count+'" class="parsley-error company_country_id">';
		content+='<option value="">--Select Country--</option>';		
		$.each(countries, function(i, item) {
			content+='<option value="'+item.id+'">'+item.country_name+'</option>';
		});
		
		content+='</select>';
		content+='<div id="err_company_country_id'+count+'" class="error"></div>';
		content+='</div>';
		content+='</div>';
		content+='</div>';
		content+='<div class="col-sm-4 sedit_employment_032">';
		content+='<div class="form-group">';
		content+='<label>';
		content+='State<span class="star">*</span> ';
		content+='</label>';
		content+='<div class="select-number sedit_employment_035" >';
		content+='<select id="state'+count+'" data-key="'+count+'" name="state[]" data-parsley-required="true" data-parsley-errors-container="#err_company_state_id'+count+'" data-parsley-required-message="This field is required" data-parsley-id="'+count+'" class="parsley-error company_state_id">';
		content+='<option value="">--Select State--</option>                             ';
		content+='</select>';
		content+='</div>';
		content+='<div id="err_company_state_id'+count+'" class="error"></div>';
		content+='<!--  <div class="error"></div> -->';
		content+='</div>';
		content+='</div>';
		content+='<div class="col-sm-4 sedit_employment_032" >';
		content+='<div class="form-group">';
		content+='<label>';
		content+='City<span class="star">*</span>';
		content+='</label>';
		content+='<div class="select-number sedit_employment_035">';
		content+='<select id="city'+count+'" name="city[]" data-parsley-required="true" data-parsley-errors-container="#err_company_city_id'+count+'" data-parsley-required-message="This field is required" data-parsley-id="'+count+'" class="parsley-error">';
		content+='<option value="">--Select City--</option>';
		content+='</select>';
		content+='</div>';
		content+='<div id="err_company_city_id'+count+'" class="error"></div>';
		content+='</div>';
		content+='</div>';
		content+='</div>';


        content+='<div class="form-group sedit_employment_034">';
                        content+='<label>Duration<span class="star">*</span></label>';
                        content+='<div class="duration">';
                           content+='<div class="row">';
                              content+='<div class="col-sm-3">';
                                 content+='<div class="select-number">';
                                    content+='<select name="start_month[]" id="previous_start_month'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_duration_month'+count+'" data-parsley-required-message="This field is required">';
                                       content+='<option value="">Month</option>';
                                       content+='<option value="01">Jan</option>';
                                       content+='<option value="02">Feb</option>';
                                       content+='<option value="03">Mar</option>';
                                       content+='<option value="04">Apr</option>';
                                       content+='<option value="05">May</option>';
                                       content+='<option value="06">Jun</option>';
                                       content+='<option value="07">Jul</option>';
                                       content+='<option value="08">Aug</option>';
                                       content+='<option value="09">Sep</option>';
                                       content+='<option value="10">Oct</option>';
                                       content+='<option value="11">Nov</option>';
                                       content+='<option value="12">Dec</option>';
                                    content+='</select>';
                                    content+='<div id="err_previous_duration_month'+count+'" class="error"></div>';
                                    content+='<div class="error"></div>'; 
                                 content+='</div>';
                              content+='</div>';
                              content+='<div class="col-sm-3">';
                                 content+='<div class="select-number">';
                                    content+='<select name="start_year[]" id="previous_start_year'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_duration_year'+count+'" data-parsley-required-message="This field is required">';
                                       content+='<option value="">Year</option>';

                                     for(var i=current_year;i>=1976;i--)
                                          {
                                            content+='<option value='+i+'>'+i+'</option>';       
                                          }
                                    content+='</select>';
                                   content+='<div id="err_previous_duration_year'+count+'" class="error"></div>';
                                   content+='<div class="error"></div>'; 
                                 content+='</div>';
                              content+='</div>';
                              content+='<div class="duration-to">To</div>';
                              content+='<div class="col-sm-3">';
                                 content+='<div class="select-number">';
                                    content+='<select name="end_month[]" id="previous_end_month'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_toduration_month'+count+'" data-parsley-required-message="This field is required">';
                                       content+='<option value="">Month</option>';
									   content+='<option value="present">Present</option>';
                                       content+='<option value="01">Jan</option>';
                                       content+='<option value="02">Feb</option>';
                                       content+='<option value="03">Mar</option>';
                                       content+='<option value="04">Apr</option>';
                                       content+='<option value="05">May</option>';
                                       content+='<option value="06">Jun</option>';
                                       content+='<option value="07">Jul</option>';
                                       content+='<option value="08">Aug</option>';
                                       content+='<option value="09">Sep</option>';
                                       content+='<option value="10">Oct</option>';
                                       content+='<option value="11">Nov</option>';
                                       content+='<option value="12">Dec</option>';
                                    content+='</select>';
                                    content+='<div id="err_previous_toduration_month'+count+'" class="error"></div>';
                                     content+='<div class="error"></div>';
                                 content+='</div>';
                              content+='</div>';
                              content+='<div class="col-sm-3">';
                                 content+='<div class="select-number">';
                                    content+='<select name="end_year[]" id="previous_end_year'+count+'" data-parsley-required="true" data-parsley-errors-container="#err_previous_toduration_year'+count+'" data-parsley-required-message="This field is required">';
                                       content+='<option value="">Year</option>';
									   content+='<option value="present">Present</option>';	
                                        for(var i=current_year;i>=1976;i--)
                                          {
                                            content+='<option value='+i+'>'+i+'</option>';       
                                          }

                                    content+='</select>';
                                    content+='<div id="err_previous_toduration_year'+count+'" class="error"></div>';
                                    content+='<div class="error"></div>'; 
                                 content+='</div>';
                              content+='</div>';
                           content+='</div>';
                        content+='</div>';
                        content+='</div>';
					content+='<div class="form-group">';
					content+='<label>Description<span class="star">*</span></label>';
					content+='<textarea type="text" id="description'+count+'" class="input-box-textarea" placeholder="Enter Your Designation Summary" name="description[]" data-parsley-required="true" data-parsley-errors-container="#err_description'+count+'" data-parsley-required-message="This field is required" rows="3"></textarea>';
					content+='<div id="err_description'+count+'" class="error"></div><div class="error"></div>';
					content+='</div>';	
                    content+='</div>';
                    
                    $('#previous_employer').before(content);
					
		count++;
      
        
    });
	
$(document).ready(function() { 

	$(document).on('click','.emp_close', function() {
		$(this).parent().remove();
	});
	$(document).on('change','input[type="checkbox"]', function() {
	   $(this).siblings('input[type="checkbox"]').prop('checked', false);
	});

    $('#country_id').on('change', function () {
        var country = this.value;
        var state = '';
        getStates(country, state, 'state_id');
		getCountryPhoneCode(country);
        getCities(0,'');
    });
    $('#state_id').on('change', function () {
        var state = this.value;
        var city = '';
		getCities(state, city, 'city_id');
    });
	
	$(document).on('change','.company_country_id', function () {
        var country = $(this).val();
        var state = '';
		var key = $(this).attr('data-key');		
        getStates(country, state, 'state'+key);
		getCountryPhoneCode(country);
        getCities(0,'');
    });
    $(document).on('change', '.company_state_id', function () {
        var state = $(this).val();
        var city = '';
		var key = $(this).attr('data-key');
		getCities(state, city, 'city'+key);
    });
   

});

  </script>
  
  
  
  <div id="uploadimageModal" class="modal sedit_employment_036" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header sedit_employment_037" >
        	
        		<h4 class="modal-title sedit_employment_038">Profile photo 	</h4>
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-12 col-sm-12 col-xs-12 text-center">
						  <div id="image_demo"></div>
  					</div>
  					<div class="col-md-4  col-sm-12 col-xs-12 text-center"  >
  					 
					
					</div>
					
					<div class="col-md-4  col-sm-12 col-xs-12 text-center" >
  					 
						  <button class="btn btn-success crop_image">Apply</button>
					</div>
					
						<div class="col-md-4  col-sm-12 col-xs-12 text-center" >
  					 
								<a href=""><button type="button" class="btn btn-default" >Close</button></a>
					</div>
					
					
				</div>
      		</div>
      	 
    	</div>
    </div>
</div>












  <div id="uploadimageModal1" class="modal" role="dialog" style="margin-top: -253.5px !important;">
	<div class="modal-dialog" style="width: 1036px !important;">
		<div class="modal-content">
      		<div class="modal-header sedit_employment_037">
        	
        		<h4 class="modal-title sedit_employment_038">Cover photo (Size-1000px X 300px)	</h4>
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-12 col-sm-12 col-xs-12 text-center">
						  <div id="image_demo1" ></div>
  					</div>
  					<div class="col-md-4  col-sm-12 col-xs-12 text-center">
  					 
					
					</div>
					
					<div class="col-md-4  col-sm-12 col-xs-12 text-center" >
  					 
						  <button class="btn btn-success crop_image1">Apply</button>
					</div>
					
						<div class="col-md-4  col-sm-12 col-xs-12 text-center">
  					 
								<a href=""><button type="button" class="btn btn-default" >Close</button></a>
					</div>
					
					
				</div>
      		</div>
      	 
    	</div>
    </div>
</div>
      	 
    
    
    
    
    
    
    
    
    
 <!-- edit personal -->   
    
    
    
    
<div class="modal fade popup-cls in sedit_employment_041" id="editpersonal" role="dialog" aria-hidden="false">
				  <div class="modal-dialog sedit_employment_042" >
					 <div class="modal-content">
						<div class="modal-header">
						   <a href=""><button type="button" class="close" ><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"></button></a>
						   <h4 class="modal-title">Edit Personal Information</h4>
						</div>
						<div class="modal-body editpersonalshow">
						    
						   <p class="text-center"><img src="{{url('/')}}/images/interviewload.gif"></p>
					 
				 
					   
					 </div>
					 
				  </div>
			   </div>
		 </div>
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		  <!-- Add emplyeement -->   
    
    
    
    
<div class="modal fade popup-cls in sedit_employment_041" id="addemplyeement" role="dialog" aria-hidden="false" >
				  <div class="modal-dialog sedit_employment_042" >
					 <div class="modal-content">
						<div class="modal-header">
						   <a href=""><button type="button" class="close" ><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"></button></a>
						   <h4 class="modal-title">Add another employment</h4>
						</div>
						<div class="modal-body addemplyeementshow">
						    
						   <p class="text-center"><img src="{{url('/')}}/images/interviewload.gif" class="sedit_employment_043"></p>
					 
				 
					   
					 </div>
					 
				  </div>
			   </div>
		 </div>
		 
		 	 
		  <!-- edit pros -->   
    
    
    
    
<div class="modal fade popup-cls in sedit_employment_041" id="editpro_save" role="dialog" aria-hidden="false" >
				  <div class="modal-dialog sedit_employment_042">
					 <div class="modal-content">
						<div class="modal-header">
						   <a href=""><button type="button" class="close" ><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"></button></a>
						   <h4 class="modal-title">Edit Personal Information</h4>
						</div>
						<div class="modal-body editpro_saveshow">
						    
						   <p class="text-center"><img src="{{url('/')}}/images/interviewload.gif" class="sedit_employment_043"></p>
					 
				 
					   
					 </div>
					 
				  </div>
			   </div>
		 </div>
		 
		 
		 
		 
		 		 
		  <!-- edit emplyeement -->   
    
    
    
    
<div class="modal fade popup-cls in sedit_employment_041" id="editemplyeement" role="dialog" aria-hidden="false">
				  <div class="modal-dialog sedit_employment_042" >
					 <div class="modal-content">
						<div class="modal-header">
						   <a href=""><button type="button" class="close" ><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"></button></a>
						   <h4 class="modal-title">Edit Employment</h4>
						</div>
						<div class="modal-body editemplyeementshow">
						    
						   <p class="text-center"><img src="{{url('/')}}/images/interviewload.gif" class="sedit_employment_043"></p>
					 
				 
					   
					 </div>
					 
				  </div>
			   </div>
		 </div>
			
			
    
    
    
    		 		 
		  <!-- edit emplyeement -->   
    
    
    
    
<div class="modal fade popup-cls in sedit_employment_041" id="socaileditemp" role="dialog" aria-hidden="false">
				  <div class="modal-dialog sedit_employment_042">
					 <div class="modal-content">
						<div class="modal-header">
						   <a href=""><button type="button" class="close" ><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"></button></a>
						   <h4 class="modal-title">Edit Employment</h4>
						</div>
						<div class="modal-body">
						    
						  <div class="row">
						     
 
						       <form class="" id="socailmplyeement_save" method="POST"   data-parsley-validate>                        
                 {{ csrf_field() }}
                           <div class="col-sm-12">
                              <input type="text" name="facebook" class="input-box-signup scocial-site" placeholder="Facebook" value="{{isset($arr_data['facebook'])?$arr_data['facebook']:'NA'}}">
                           </div>
                           <div class="col-sm-12">
                              <input type="text" name="linkedin" class="input-box-signup scocial-site" placeholder="Linkedin" value="{{isset($arr_data['linkedin'])?$arr_data['linkedin']:'NA'}}">
                           </div>
                           <div class="col-sm-12">
                              <input type="text" name="twitter" class="input-box-signup scocial-site" placeholder="Twitter" value="{{isset($arr_data['twitter'])?$arr_data['twitter']:'NA'}}">
                           </div>
                           
                           
                              <div class="clearfix"></div>
                      <div class="col-sm-12">
                     
                                             
                     <div class="btn-wrapper">
                    
               <input type="hidden" value="{{$enc_id or ''}}" name="enc_idnew">
                        <button type="submit" class="submit-btn">Update</button>

                     </div>  </div>
                     </form>
                     
                     
                     
                        </div>
					   
					 </div>
					 
				  </div>
			   </div>
		 </div>
			
			
			
			
    
    	  <!-- Add emplyeement -->   
    
    
    
    
<div class="modal fade popup-cls in sedit_employment_041" id="editeducation_save" role="dialog" aria-hidden="false">
				  <div class="modal-dialog sedit_employment_042">
					 <div class="modal-content">
						<div class="modal-header">
						   <a href=""><button type="button" class="close" ><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"></button></a>
						   <h4 class="modal-title">Edit Education</h4>
						</div>
						<div class="modal-body">
						    
				 <form class="" id="edit_education_save" method="POST"   data-parsley-validate>                        
                 {{ csrf_field() }}
                                 <div class="form-group">
                        <label>Highest Qualification<span class="star">*</span></label>

                        <div class="duration">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="select-number">
                                    <select class="form-control" name="qualification_id" required="" data-parsley-errors-container="#err_high_quali" data-parsley-required-message="This field is required" id="qualification_id" onclick="loadSpecialization(this);">
                                  <option value="">--Select Qualification--</option>
                                              @if(isset($arr_qualification) && count($arr_qualification)>0)
                                    @foreach($arr_qualification as $qualification)
                                    <option @if($arr_data['qualification_id']==$qualification['id']) selected="" @endif value="{{ $qualification['id'] }}">{{ $qualification['qualification_name'] or '-' }}</option>
                                    @endforeach
                                    @endif                                                               
                                                                          
                                 </select>
                                 <div id="err_high_quali" class="error"></div>
                               <div class="error"></div>  
                                 </div>
                              </div>
                              <div id="specialization_div" class="col-sm-6">
                                 <div class="select-number">
                                    <select id="specialization" name="specialization_id" data-parsley-required="true" data-parsley-errors-container="#err_specialization" data-parsley-required-message="This field is required">
                                        
                                        
                                                                        <option value="{{@$arr_data['specialization_id']}}">{{@$qualificationDetailsm->specialization_name}}</option>
                                                                        
                                                                        
                                                                        
                                    
                                  </select>
                                   
                                 </div>
                              </div>
                            
                           </div>
                        </div>
                     </div>
         
                      <div class="form-group">

                      
                        <div class="duration">
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="select-number">

                                    <select name="passing_month" required="" data-parsley-errors-container="#err_pass_month" data-parsley-required-message="This field is required">
                      <option value="">Passing Month</option>
                      
                        
                      
                        <option @if($arr_data['passing_month']=='jan') selected="" @endif value="jan">Jan</option>
                        <option @if($arr_data['passing_month']=='feb') selected="" @endif value="feb">Feb</option>
                        <option @if($arr_data['passing_month']=='mar') selected="" @endif value="mar">Mar</option>
                        <option @if($arr_data['passing_month']=='apr') selected="" @endif value="apr">Apr</option>
                        <option @if($arr_data['passing_month']=='may') selected="" @endif value="may">May</option>
                        <option @if($arr_data['passing_month']=='jun') selected="" @endif value="jun">Jun</option>
                        <option @if($arr_data['passing_month']=='jul') selected="" @endif value="jul">Jul</option>
                        <option @if($arr_data['passing_month']=='aug') selected="" @endif value="aug">Aug</option>
                        <option @if($arr_data['passing_month']=='sep') selected="" @endif value="sep">Sep</option>
                        <option @if($arr_data['passing_month']=='oct') selected="" @endif value="oct">Oct</option>
                        <option @if($arr_data['passing_month']=='nov') selected="" @endif value="nov">Nov</option>
                        <option @if($arr_data['passing_month']=='dec') selected="" @endif value="dec">Dec</option>
                         
                    </select>
                      <div id="err_pass_month" class="error"></div>
                                            <div class="error"></div>   
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="select-number">
 <select name="passing_year" required="" data-parsley-errors-container="#err_pass_year" data-parsley-required-message="This field is required">
                       
                        @for($i=$current_year;$i>=1992;$i--) 
                      <option @if($arr_data['passing_year']==$i) selected="" @endif value="{{$i}}"> {{$i}}</option>
                      @endfor
                      
                      
                                          </select>
                    <div id="err_pass_year" class="error"></div>
                    <div class="error"></div>    
                                 </div>
                              </div>
                             
                         
                           </div>
                        </div>
                     </div>
                  <!--inline Radio button-->
                 <div class="form-group">
                        <div class="row">
                           <div class="col-sm-12 col-md-3 col-lg-2">
                              <div class="form-lable">Marks<span class="star">*</span></div>
                           </div>
                           <div class="col-sm-12 col-md-9 col-lg-10">
                              <div class="radio-btns">
                                 <div class="radio-btn">
                                    <input type="radio" id="Radio1" name="marks_type" checked="" value="percentage"   @if($arr_data['marks_type']=='percentage') checked="" @endif value="percentage" required="" data-parsley-errors-container="#err_marks" data-parsley-required-message="This field is required" data-parsley-multiple="marks_type">

                                    <label for="Radio1">Percentage</label>
                                    <div class="check"></div>
                                 </div>
                                 <div class="radio-btn">

                                    <input type="radio" id="Radio2" name="marks_type" @if($arr_data['marks_type']=='cgpa') checked="" @endif value="cgpa"  data-parsley-multiple="marks_type">
                                    <label for="Radio2">CGPA(Out of 10)</label>
                                    <div class="check">
                                       <div class="inside"></div>
                                    </div>
                                 </div>

                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                      <div id="err_marks" class="error"></div>
                      <div class="error"></div> 
                     <!--end-->
                 
                  <div class="form-group">
                        
                        <input type="text" name="marks_input" id="marks_input" class="input-box-signup" placeholder="Marks" value="{{isset($arr_data['marks'])?$arr_data['marks']:'NA'}}" required="" data-parsley-errors-container="#err_marks_input" data-parsley-required-message="This field is required">
                               <!--  <div class="error_msg" id="err_marks_input" style="color:red"></div> -->
                          <div id="err_marks_input" class="error"></div> 
                           <div class="error"></div>     
                  </div>
                     
                     
                      

                     <div class="clearfix"></div>
                     
                     
                                             
                     <div class="btn-wrapper">
                    
               <input type="hidden" value="{{$enc_id or ''}}" name="enc_idnew">
                        <button type="submit" class="submit-btn">Update</button>

                     </div>
                     </form>
					 
				 
					   
					 </div>
					 
				  </div>
			   </div>
		 </div>
			
			
			
			
<style>
    .modal.fade.in {
     top: 30% !important; 
}

.modal-body .form-group {
    padding-top: 0px;
    margin-bottom: 11px;
}
    
    .member-myProfile-form { 
        
      background: #fff;
    padding: 0px 0px 10px;
    box-shadow: 0 0 0 1px rgba(0,0,0,.1), 0 2px 3px rgba(0,0,0,.2);
    transition: box-shadow 83ms;
    border-radius: 2px;
    }
    .fa-pencil-square,.fa-plus-square,.trash
    
    {
        
        
        float: right;
    color: #0e998e;
    font-size: 18px;
    cursor: pointer;
    }
    .hcc {    margin-top: 10px;
    font-size: 18px;
  
    color: #0d655e;
    
}

.header {
  
    z-index: 1 !important;
}


</style>

<script>
$(document).ready(function(){
    
 $('[data-toggle="tooltip"]').tooltip();   
    
    
 $(document).on('click', '.editpersonal', function() {
    $('.editpersonalshow').load('{{url('/')}}/member/editpersonal/{{$enc_id}}');
   });
   
   
   
    $(document).on('click', '.editpro_save', function() {
    $('.editpro_saveshow').load('{{url('/')}}/member/editpro_save/{{$enc_id}}');
   });
   
   
   
    $(document).on('click', '.addemplyeement', function() {
    $('.addemplyeementshow').load('{{url('/')}}/member/addemplyeement/{{$enc_id}}');
   });
   
   
   
     $(document).on('click', '.editmplyeement', function() {
         
         $empyid=$(this).attr('id');
         
    $('.editemplyeementshow').load('{{url('/')}}/member/editemplyeement/'+$empyid);
   });
   
   
   
   
   
    
});
</script>



<script type="text/javascript">

$(document).ready(function() {   



$('input').attr('autocomplete', 'off');

$(document).on('keyup', '.keypressit', function() {


var kyvalue=$(this).val(); var kyvalueres=kyvalue.replace(' ', '-'); var kyvaluelenght=kyvalueres.length; 
if(kyvaluelenght>=2)
{ $('.auto-search-box').css('display','block');
 $.ajax({
            url: "http://cloudforcehub.com/interviewxp/get_country_codename",
            type: "get",
            data: {country_id: kyvalueres},
      dataType:'json',
            success: function (data) {
             
                $('.auto-search-boxul').html(data);
            }
        }); } 
else {
      $('.auto-search-box').css('display','none'); 

} });




$(document).on('click', '.searchp', function() {

$mainvalue=$(this).attr('id');

var kyvalueres=$mainvalue.split('-');;
$(this).closest(".select-number").find('.keypressit').val(kyvalueres[1]);

  
 
  
$mobile_code='+'+kyvalueres[2];

 
 $('#mobile_code').val($mobile_code);
 

$('.countrycodes').val(kyvalueres[0]);



$country_id_value=$('.country_id').val();
 
$('.country_id').val(kyvalueres[0]);
 


 $('.auto-search-box').css('display','none'); 
});




$(document).on('keyup', '.keystate', function() {

var kyvalue=$(this).val(); var kyvalueres=kyvalue.replace(' ', '-'); var kyvaluelenght=kyvalueres.length; 
var country_id=$('.country_id').val();
if(kyvaluelenght>=2)
{ $('.auto-search-box-state').css('display','block');
 $.ajax({
            url: "http://cloudforcehub.com/interviewxp/get_state_codename",
            type: "get",
            data: {country_id: country_id, state_id: kyvalueres},
      dataType:'json',
            success: function (data) {
             
                $('.auto-search-box-state').html(data);
            }
        }); } 
else {
      $('.auto-search-box-state').css('display','none'); 

} });




$(document).on('click', '.searchpstate', function() {

$mainvalue=$(this).attr('id');

var kyvalueres=$mainvalue.split('-');;

$('.satecodeset').val(kyvalueres[0]);


$state_id_value=$('.state_id').val();
 
$('.state_id').val(kyvalueres[0]);
 




$(this).closest(".select-number").find('.keystate').val(kyvalueres[1]);



 $('.auto-search-box-state').css('display','none'); 
});









$(document).on('keyup', '.keycity', function() {

var kyvalue=$(this).val(); var kyvalueres=kyvalue.replace(' ', '-'); var kyvaluelenght=kyvalueres.length; 
var country_id=$('.state_id').val();

if(kyvaluelenght>=2)
{ $('.auto-search-box-city').css('display','block');
 $.ajax({
            url: "http://cloudforcehub.com/interviewxp/get_city_codename",
            type: "get",
            data: {country_id: country_id, state_id: kyvalueres},
      dataType:'json',
            success: function (data) {
             
                $('.auto-search-box-city').html(data);
            }
        }); } 
else {
      $('.auto-search-box-city').css('display','none'); 

} });


$(document).on('click', '.searchpcity', function() {

$mainvalue=$(this).attr('id');

var kyvalueres=$mainvalue.split('-');;

$(this).closest(".select-number").find('.citycodeset').val(kyvalueres[0]);


$city_id_value=$('.city_id').val();
 
$('.city_id').val(kyvalueres[0]);
 




$(this).closest(".select-number").find('.keycity').val(kyvalueres[1]);



 $('.auto-search-box-city').css('display','none'); 
});






 $(document).on('submit','#editpersonal_save', function(e) { 

e.preventDefault();

  
    
   
	$.ajax({
				url:"{{url('/')}}/member/editpersonal_save",
				type: "POST",
				data: $('#editpersonal_save').serialize(),
				cache: false,
				success: function(response) {				
				$('#editpersonal_save').html(response);
				location.reload();
							}
                   });	
 

		});




 $(document).on('submit','#edit_pro_savepro', function(e) { 

e.preventDefault();

  
    
   
	$.ajax({
				url:"{{url('/')}}/member/edit_pro_savepro",
				type: "POST",
				data: $('#edit_pro_savepro').serialize(),
				cache: false,
				success: function(response) {				
				$('#edit_pro_savepro').html(response);
				location.reload();
							}
                   });	
 

		});





 $(document).on('submit','#addemplyeement_save', function(e) { 

e.preventDefault();

  
    
     
	$.ajax({
				url:"{{url('/')}}/member/addemplyeement_save",
				type: "POST",
				data: $('#addemplyeement_save').serialize(),
				cache: false,
				success: function(response) {				
				$('#addemplyeement_save').html(response);
				location.reload();
							}
                   });	
 

		});



 $(document).on('submit','#editemplyeement_save', function(e) { 

e.preventDefault();

  
    
     
	$.ajax({
				url:"{{url('/')}}/member/editemplyeement_save",
				type: "POST",
				data: $('#editemplyeement_save').serialize(),
				cache: false,
				success: function(response) {				
				$('#editemplyeement_save').html(response);
				location.reload();
							}
                   });	
 

		});



 $(document).on('submit','#edit_education_save', function(e) { 

e.preventDefault();

  
    
     
	$.ajax({
				url:"{{url('/')}}/member/editeducation_save",
				type: "POST",
				data: $('#edit_education_save').serialize(),
				cache: false,
				success: function(response) {				
				$('#edit_education_save').html(response);
				location.reload();
							}
                   });	
 

		});


 $(document).on('submit','#socailmplyeement_save', function(e) { 

e.preventDefault();

  
    
     
	$.ajax({
				url:"{{url('/')}}/member/socailmplyeement_save",
				type: "POST",
				data: $('#socailmplyeement_save').serialize(),
				cache: false,
				success: function(response) {				
				$('#socailmplyeement_save').html(response);
				location.reload();
							}
                   });	
 

		});
		
		
		
		
		
		
		
		
		
		
		$(document).on('click','.ppnews', function(event) {
    event.preventDefault();  
    var target = "#" + this.getAttribute('data-target');
    $('html, body').animate({
        scrollTop: $(target).offset().top
    }, 1000);
});
   

});


</script>
 <script type="text/javascript">
var url = "{{ url('/user/specialization') }}";
    function loadSpecialization(ref)
    {
        var selected_qualification = jQuery(ref).val();

        jQuery.ajax({
                        url:url+'/'+selected_qualification,
                        type:'GET',
                        data:'',
                        dataType:'json',
                        beforeSend:function()
                        {
                            jQuery('select[name="specialization_id"]').attr('disabled','disabled');
                        },
                        success:function(response)
                        {
                            if(response.status=="SUCCESS")
                            {
                              
                                jQuery('select[name="specialization_id"]').removeAttr('disabled');
                                if(typeof(response.arr_specialization) == "object")
                                {
                                  $('#specialization_div').show();
                                   var option = '<option value="">Select Specialization</option>'; 
                                   jQuery(response.arr_specialization).each(function(index,specialization)
                                   {   
                                    
                                        option+='<option value="'+specialization.id+'">'+specialization.specialization_name+'</option>';
                                   });

                                   jQuery('select[name="specialization_id"]').html(option);
                                }
                                jQuery('select[name="specialization_id"]').attr('data-parsley-required','true');
                            }
                            else
                            {
                              $('#specialization_div').hide();
                              var option = '<option value="">No Specialization</option>'; 
                              jQuery('select[name="specialization_id"]').html(option);
                              jQuery('select[name="specialization_id"]').attr('data-parsley-required','false');
                            }
                            return false;
                        },
                        error:function(response)
                        {
                         
                        }
        });
     }    






  </script>
  
  
  
@endsection

