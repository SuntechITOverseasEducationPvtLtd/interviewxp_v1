@extends('front.layout.main')
@section('middle_content')  
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
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
        data:{"image": response,"id":'<?=$arr_member_details['user_id'];?>'},
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
      width:500,
      height:300,
      type:'square' //circle
    },
    boundary:{
      width:700,
      height:400
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
        data:{"image": response,"id":'<?=$arr_member_details['user_id'];?>'},
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

<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->
      <div class="banner-member">
         <div class="pattern-member">
            
         </div>
      </div>
    
         <div class="container-fluid fix-left-bar">
            <div class="row">
              @include('front.member.member_sidebar')
              
               <div class="col-sm-8 col-md-9 col-lg-10 middle-content">
               
                     <h2 class="my-profile">My Profile</h2>
                 
                  <div class="right-section-member">
                   <div class="col-sm-12 col-md-10 form-wrapper">
                   
                    <!--process box-->
                     <div class="process-bx">
					  <div class="center-row">
						 <div class="step_process border-line">
							<div class="active-step step_bor">
							   <div class="active_step normal_step">1</div>
							</div>
							<div class="plan-detail left1">
							   <div class="active step_title">Employment</div>
							</div>
						 </div>
						 <div class="bg_i2">&nbsp;</div>
						 <div class="step_process border-line">
							<div class="active-step step_bor">
							   <div class="active_step normal_step">2</div>
							</div>
							<div class="plan-detail left2">
							   <div class="active step_title">Personal</div>
							</div>
						 </div>
						 <div class="bg_i2">&nbsp; </div>
						 <div class="step_process">
							<div class="step_bor">
							   <div class="normal_step">3</div>
							</div>
							<div class="plan-detail left3">
							   <div class="step_title">Education</div>
							</div>
						 </div>
					  </div>
				   </div>
                     <!--end-->
                
                 <div class="member-myProfile-form">
                 @include('admin.layout._operation_status')
                 <form class="" id="edit_personal1" method="POST" enctype="multipart/form-data" action="{{url('/')}}/member/update_personal" data-parsley-validate>
                 {{ csrf_field() }}

                  <!--<div class="profile-img">
                  <div class="upload-img">
                  <img src="{{url('/')}}/images/Profile-edit-img.png" class="Profile-edit-img" alt="interviewxp"></div>
                  <input class="file-upload" type="file" onchange="readURL(this);" id="profile-image" name="profile_image">
                     <div class="profile-image">
                     @if($arr_data['profile_image']=="")
                       <img style="width:160px;height:160px;" src="{{url('/')}}/images/Profile-img.jpg" id="upload-f" class="profile" alt="interviewxp">
                     @else
                     <img style="width:160px;height:160px;" src="{{$user_auth_details['profile_image']}}" id="upload-f" class="profile" alt="interviewxp">
                     @endif
                     </div>
                  </div>-->
				  <?php
						if(empty($FirstName))
							$opF="Interview";
						else
							$opF=$FirstName;
						if(empty($LastName))
							$opL="Member";
						else
							$opL=$LastName;
						
						$banner_image = $arr_member_details['banner_image'];
						
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
                  <div class="form-wrapper">
						<div class="col-sm-12 card hovercard">						
						<span id="uploaded_image1"></span>
						<div style="background-image: url('{{$bgImage}}');height: 313px; margin-bottom: 0px;background-size: 100% 100%;" id="bg_banner_image">
							    
							    
							    
								
								<label for="upload_image1" class="btn banner_image_label" style="float: right;"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 20px;color: #0e998e;"></i></label>
								
							
								
								 <div class="avatar">
								     <span id="uploaded_image">
								          
								 <img src="{{$profile_image}}" style=" width: 130px;
    margin-top: 78px;
    max-width: 130px;
    max-height: 130px;
    height: 130px;" class="inner-div" id="profile_image uploaded_image">
								 </span>
								 
								 <label for="upload_image" class="btn profile_image_label"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 20px;color: #0e998e;"></i></label>
								 
								<input name="upload_image" class="myclassf" type="file" onchange="readURL(this);" 
								style="height: 260px;     margin-top: -41px;  width:100% !important; visibility:hidden;" id="upload_image" > 
								 
								<input name="upload_image1" class="myclassf" type="file" onchange="readURL(this);" 
								style="height: 260px;     margin-top: -41px;  width:100% !important; visibility:hidden;" id="upload_image1" > 
								
								</div>
							</div>
							
					</div>	
					
					<div class="clearfix"></div>
					
					<div class="clearfix"></div>
					
				
                     <div class="form-group" style="    float: left;
    width: 100%;
    padding-top: 30px;">
                        <label>Email Address <span class="star">*</span></label>
                        <input type="text" readonly="readonly" name="email" data-rule-required="true"
                        data-rule-email="true" class="input-box-signup" value="{{$arr_data['email']}}" placeholder="Enter Your Email Address" /required="" data-parsley-type="email" data-parsley-errors-container="#err_email" data-parsley-required-message="This field is required" />
                           <div id="err_email" class="error"></div>
                          <div class="error">{{ $errors->first('email') }}</div>  
                     </div>
                     <div class="form-group">
                        <label>Mobile Number <span class="star">*</span></label>
                        <div class="row">
                           <div class="col-xs-4 col-sm-3 col-md-2 mumber-box-left">
                           <input type="text" name="mobile_code"
                               class="input-box-signup" value="{{$arr_data['mobile_code']}}" data-parsley-pattern="\+[0-9]{1,3}"
                        data-parsley-pattern-message="Enter Valid Country Code" required="" data-parsley-errors-container="#err_mobile_code" data-parsley-required-message="Field required" />
                               <div id="err_mobile_code" class="error"></div>
                          <div class="error">{{ $errors->first('mobile_code') }}</div>
                           </div>
                           <div class="col-xs-8 col-sm-9 col-md-10 mumber-box-right">
                              <input type="text" name="mobile_no"
                               class="input-box-signup" value="{{$arr_data['mobile_no']}}" placeholder="Enter Your Mobile Number" required="" data-parsley-type="integer" data-parsley-errors-container="#err_mobile_no" data-parsley-required-message="This field is required" data-parsley-minlength="7" data-parsley-maxlength="16"/>
                           <div id="err_mobile_no" class="error"></div>
                          <div class="error">{{ $errors->first('mobile_no') }}</div>   
                           </div>
                        </div>
                     </div>
					
					 <div class="clearfix"></div>
                     <div class="form-group">
                        <label>Birth Date</label>
                        
                          @if(isset($birth_date) && $birth_date!='')
                          <input type="text" class="input-box-signup" readonly="readonly"  
                         value="{{$birth_date}}" />
                          @endif
                        
                     </div>
                     <!--inline Radio button-->
                     <div class="form-group">
                     <label>Gender</label>
                        @if($arr_data['gender']=='M') 
                          <input type="text" class="input-box-signup" readonly="readonly"  
                         value="Male" />
                         @else 
                         <input type="text" class="input-box-signup" readonly="readonly"  
                         value="Female" />
                          @endif
                            
                     </div>
                     <!--end-->
                     <input type="hidden" value="{{$enc_id}}" name="enc_id">
                     <div class="btn-wrapper">
                        <button type="reset" class="cancel-btn">Cancel</button>
                        <button type="submit" class="submit-btn">Continue</button>
                     </div>
                  </div>
                  </form>
                </div>
                 </div>
                 
                   </div>
                </div>
                
               </div>
            </div>
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



  <div id="uploadimageModal" class="modal" role="dialog" style="margin-top: -253.5px !important;">
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header" style="    background: #102b44;">
        	
        		<h4 class="modal-title" style="color: #fff;">Profile photo 	</h4>
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-12 col-sm-12 col-xs-12 text-center">
						  <div id="image_demo" style=""></div>
  					</div>
  					<div class="col-md-4  col-sm-12 col-xs-12"  style="text-align:center">
  					 
					
					</div>
					
					<div class="col-md-4  col-sm-12 col-xs-12"  style="text-align:center">
  					 
						  <button class="btn btn-success crop_image">Apply</button>
					</div>
					
						<div class="col-md-4  col-sm-12 col-xs-12" style="text-align:center">
  					 
								<a href=""><button type="button" class="btn btn-default" >Close</button></a>
					</div>
					
					
				</div>
      		</div>
      	 
    	</div>
    </div>
</div>












  <div id="uploadimageModal1" class="modal" role="dialog" style="margin-top: -253.5px !important;">
	<div class="modal-dialog" style="width: 736px;">
		<div class="modal-content">
      		<div class="modal-header" style="    background: #102b44;">
        	
        		<h4 class="modal-title" style="color: #fff;">Cover photo 	</h4>
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-12 col-sm-12 col-xs-12 text-center">
						  <div id="image_demo1" style=""></div>
  					</div>
  					<div class="col-md-4  col-sm-12 col-xs-12"  style="text-align:center">
  					 
					
					</div>
					
					<div class="col-md-4  col-sm-12 col-xs-12"  style="text-align:center">
  					 
						  <button class="btn btn-success crop_image1">Apply</button>
					</div>
					
						<div class="col-md-4  col-sm-12 col-xs-12" style="text-align:center">
  					 
								<a href=""><button type="button" class="btn btn-default" >Close</button></a>
					</div>
					
					
				</div>
      		</div>
      	 
    	</div>
    </div>
</div>
      	 
    

    
@endsection  