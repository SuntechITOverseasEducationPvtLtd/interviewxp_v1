@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->

<link type="text/css" rel="stylesheet" href="{{url('/')}}/assets/jQuery-Plugin-loader/waitMe.css">

<script src="http://cloudforcehub.com/interviewxp/js/croppie.js"></script>
		<link rel="stylesheet" href="http://cloudforcehub.com/interviewxp/js/croppie.css" />
	
 <script>  
$(document).ready(function(){

	$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:100,
      type:'square' //circle
    },
    boundary:{
      width:400,
      height:200
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
      
      $('.imagesadded').text('Image Added')
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"http://cloudforcehub.com/interviewxp/interthum.php",
        type: "POST",
        data:{"image": response,"id":'1222'},
        success:function(data)
        {
          $('#uploadimageModal').modal('hide');
          $('#uploaded_image').html(data);
          
        }
      });
    })
  });
  
  
   $(document).on('keypress', '.youtubevideo', function() {  $('.youtubeerror').text('');  });
   
   
  $('.addyoutube').on('click', function(){
      
      
      var youtuvevalue=$('.youtubevideo').val();
      
      
    
    var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
    var matches = youtuvevalue.match(p);
    if(matches){
        $imgname=matches[1];
        $('.vtext').text('URL Added');
        
        $('.youtubeurlinput').html('<input name="videofile" value="'+youtuvevalue+'" type="hidden">');
        
        
       $('.videff').html('<h3>Video URL added</h3>'); 
       
       $(this).css('display','none');
       
       $image=$("input[name=image]").val();   if($image==''){  
       
       $('#uploaded_image').html('<img src="https://img.youtube.com/vi/'+$imgname+'/0.jpg" style="width: 100%;" /> 	<input name="image" value="" type="hidden">');
       
       
       }
        
    }

 else{
        $('.youtubeerror').text('Enter Valid youtube URL');}
      
      
      
      
  });
  
  
  

});  
</script>



<div class="banner-member">
   <div class="pattern-member">
   </div>
</div>
<div class="container-fluid fix-left-bar">
   <div class="row">
      @include('front.member.member_sidebar')               
      <div class="col-sm-9 col-md-9 col-lg-10 extra-height middle-content">
         <h2 class="my-profile pages">Create New Skill </h2>
         <div class="row">
             
              @include('front.layout._operation_status')
                           <form class="" id="frm_store_interview" method="POST" enctype="multipart/form-data" action="{{url('/')}}/member/store_interview" data-parsley-validate>
                              {{ csrf_field() }}
                              
                              
             
            <div class="col-sm-12 col-md-12 col-lg-9">
                 <div class="col-sm-3 col-md-3 col-lg-3"> 
                 <div class="youtubeurlinput"> <input name="videofile" value="" type="hidden"></div>
                 
                 <h5 style="    padding-top: 15px; text-align: center;">Video/Image Upload</h5>
                 
         <div class="uvido" style="
    width: 100%;
    min-height: 200px;
    margin-top: 23px;
    /* border: 1px solid #eee; */
    padding-top: 9px;
    border-radius: 6px;
    box-shadow: 0px 0px 6px #0000001f;
    ">
                     
                     
                     
                     
              <div data-toggle="modal" href="#youtubevideoup"  style="
    /* text-align: center; */
    height: 31px;
    background: #0e998e;
    color: #fff;
    line-height: 30px;
    font-size: 15px;
    padding-left: 10px;
    margin-top: 10px;
    /* float: left; */
    width: 96%;
    margin: auto;
    border-radius: 4px;
    cursor: pointer;
">
                  <i class="fa fa-youtube-play" aria-hidden="true" style="
    font-size: 26px; padding-top: 3px;
    float: left;
    padding-right: 10px;
"></i> <span class="vtext">Video URL</span>
                  
              </div>       
                     
                 			<input name="upload_image" class="myclassf" type="file" onchange="readURL(this);" 
								style="    margin-top: 24px;
    width: 97% !important;
    position: absolute;
    opacity: 0;" id="upload_image" >     
                
                
                <br>
                
                  <div style="
    /* text-align: center; */
    height: 31px;
    background: #908686;
    color: #fff;
    line-height: 30px;
    font-size: 15px;
    padding-left: 10px;
    margin-top: 10px;
    /* float: left; */
    width: 96%;
    margin: auto;
    border-radius: 4px;
    cursor: pointer;
">
                  <i class="fa fa-picture-o" aria-hidden="true" style="
    font-size: 23px; padding-top: 4px;
    float: left;
    padding-right: 10px;
"></i> Upload Image
                  
              </div>  
              
              
              
          <p  class="imagesadded" style="    text-align: center;
    padding-top: 17px;
    color: #17b0a4;">Default Image</p>    
              <div style="padding: 4px;" id="uploaded_image" >
                  
                  <input name="image" value="" type="hidden">
                  
            <img src="{{url('/')}}/uploads/no-image.png" style="width:100%">     
            
            </div>
                     
                     
                     
                     
                 </div>
                 
                 
                 </div>
                 
                 
                <div class="col-sm-9 col-md-9 col-lg-9">
                
               <div class="box-m mrg-tps">
                  <div class="tab-contact">
                     <div class="tabs responsive-tabs responsive-tabs-initialized">
                        <nav>
                           <ul class="ul-new">
                              <li class="active post-label display_new_skill">
                                 Upload Interview Reference book, Interview by Companies & Video
                              </li>
                              <!-- <li class="title-lis">
                                 <a href="{{url('/')}}/member/real_time_experience"><span>2</span> RealTime Work Experience (Tickets, Tasks & Issues)</a>
                              </li> -->
                           </ul>
                        </nav>
                        <div class="content recent-product-table">
                          
                              <div class="outer-box" style="   padding: 5px;
    border: none;
    border-radius: 6px;
    box-shadow: 0px 0px 6px #0000001f;" >
                                 <div class="inner-box">
                                    <div class="row">
                                       <div class="col-sm-6 col-md-6 col-lg-12 first-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-4">
                                                   <label>Skills <span class="star">*</span></label>
                                                   <!--  <select  id="skill_id" name="skills[]" data-rule-required="true"  >
                                                      </select> -->
                                                   <!--div class="error">Skills is not Valid</div-->
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-8">
                                                  <select  id="skill_id" name="skills" required="" data-parsley-errors-container="#err_job_skill" data-parsley-required-message="This field is required">
                                                   </select>
                                                   <div class="error">{{ $errors->first('skill') }}</div>
                                                   <div id="err_job_skill" class="error"></div>
                                                   
                                                </div>
                                             </div>
                                          </div>
                                       </div>


                                       <div class="col-sm-6 col-md-6 col-lg-12 last-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-4">  <label>Experience Level <span class="star">*</span></label></div>
                                                <div class="col-sm-12 col-md-12 col-lg-8">
                                                   <div class="select-number">
                                                      <select name="experience" id="experience" required="" data-parsley-errors-container="#err_exp_level" data-parsley-required-message="This field is required">
                                                         <option value="">Select experience</option>
                                                         <option value="0-2">0-2 Years</option>
                                                         <option value="2-4">2-4 Years</option>
                                                         <option value="5-10">5-10 Years</option>
                                                         <option value="10-20">10-20 Years</option>
                                                         <option value="NA">NA</option>
                                                      </select>
                                                      <div class="error">{{ $errors->first('experience') }}</div>
                                                      <div id="err_exp_level" class="error"></div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6 col-md-6 col-lg-12 first-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-4"> <label>Categories <span class="star">*</span></label></div>
                                                <div class="col-sm-12 col-md-12 col-lg-8">
                                                   <div class="select-number">
                                                      <select  class="getcategory" name="category" data-rule-required="true" required="" data-parsley-errors-container="#err_category" data-parsley-required-message="This field is required">
                                                         <option value="">Select Category</option>
                                                         @if(isset($arr_category) && count($arr_category)>0)
                                                         @foreach($arr_category as $category)
                                                         <option value="{{ $category['id'] }}">{{ $category['category_name'] or '-' }}</option>
                                                         @endforeach
                                                         @endif
                                                      </select>
                                                      <div class="error">{{ $errors->first('category') }}</div>
                                                      <div id="err_category" class="error"></div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-sm-6 col-md-6 col-lg-12 last-name">
                                          <div class="form-group" style="margin: 0px;">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-4"><label>Sub Catagories</label> </div>
                                                <div class="col-sm-12 col-md-12 col-lg-8">
                                                    <input type="text" name="subcategory" class="input-box-signup" placeholder="Enter Subcategory" data-parsley-required="false" data-parsley-errors-container="#err_sub_category" data-parsley-required-message="This field is required"/> 
                                                   <div id="err_sub_category" class="error"></div>
                                                   
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row" style="display:none">
                                       <div class="col-sm-6 col-md-6 col-lg-12 first-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-4"><label>Qualification <span class="star">*</span></label> </div>
                                                <div class="col-sm-12 col-md-12 col-lg-8">
                                                   <div class="select-number" style="background:none !important">
                                                      <select name="qualification_id" onchange="loadSpecialization(this);" required="" data-parsley-errors-container="#err_qualification" data-parsley-required-message="This field is required">
                                                         @if(isset($arr_qualification) && count($arr_qualification)>0)
                                                         <option value="{{ $member_detail['qualification_id'] }}">{{ $arr_qualification[$member_detail['qualification_id']] or '-' }}</option>
                                                         @endif
                                                      </select>
                                                      <div class="error">{{ $errors->first('qualification_id') }}</div>
                                                      <div id="err_qualification" class="error"></div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div id="specialization_div" class="col-sm-6 col-md-6 col-lg-12 last-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-4"><label>Specialization <span class="star">*</span></label> </div>
                                                <div class="col-sm-12 col-md-12 col-lg-8">
                                                   <div class="select-number" style="background:none !important">                                                     
                                                      <select id="specialization" name="specialization_id">
                                                         <option value="{{ $member_detail['specialization_id'] }}">{{ $arr_specialization[$member_detail['specialization_id']]}}</option>
                                                      </select>
                                                      <div id="err_specialization" class="error"></div>
                                                      <!--  <div class="error">{{ $errors->first('specialization') }}</div> -->
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    
                                   
                          
                           </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>   </div>
               
               
                <div class="row">
                                       
                                      
                                       
                                     
                                       <div class="col-sm-12 col-md-12 col-lg-12 last-name">
                                          <div class="btn-wrapper" style="text-align: center;">
                                             <a href="{{url('/')}}/member/post_interview"><button type="button" class="cancel-btn pad-equal">Cancel</button></a> 
                                             <button type="submit" onclick="return validation();" class="submit-btn pad-equal">Submit</button>
                                          </div>
                                       </div>
                                    </div>
                                    
                                    
               
                </form>
                
                
            </div>
            <div class="col-sm-12 col-md-12 col-lg-3">
               <div class="side-img">
                  <div class="contact-details pull-right">
                     <div class="inner-details">
                        <h4>Customer Support</h4>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/landline.png"></div>
                           <div class="contact-details2">
                              <h5>Landline:</h5>
                              <h6>040-646487</h6>
                           </div>
                        </div>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/mobile.png"></div>
                           <div class="contact-details2">
                              <h5>Mobile no.:</h5>
                              <!--  <h6>9000000009</h6> -->
                              <h6>{{$arr_user_details[0]['mobile_no']}}</h6>
                           </div>
                        </div>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/email.png"></div>
                           <div class="contact-details2">
                              <h5>Email:</h5>
                              <!-- <h6 class="email">support@interviewxp.com</h6> -->
                              <h6 class="email">{{$arr_user_email[0]['general_email']}}</h6>
                           </div>
                        </div>
                     </div>
                  </div>
                  @if(isset($arr_advertise) && sizeof($arr_advertise)>0)
                   @if($arr_advertise[0]['is_active']==1)
                        @if($arr_advertise[0]['id']==2)
                          <div class="sample-img"> <img src="{{$advertise_public_img_path.$arr_advertise[0]['advertise_image']}}" alt="Interviewxp"/> </div>
                       @endif
                     @else
                     <div class="sample-img"> <img src="{{url('/')}}/images/sample-img.jpg" alt="Interviewxp" class="img-responsive" /> </div>
                     @endif
                  @endif

                 <!--  <div class="sample-img"> <img src="{{url('/')}}/images/sample-img.jpg" alt="Interviewxp"/> </div> -->

                 
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<!-- Javascript -->
<script src="{{url('/')}}/assets/jQuery-Plugin-loader/waitMe.js"></script>
<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/admin/jquery.tokenize.css"/>
<script type="text/javascript" src="{{url('/')}}/js/admin/jquery.tokenize.js"></script>
<script type="text/javascript">
var urlnew = "{{ url('/get_skills') }}";  
   $(document).ready(function(){
    
         $('#skill_id').tokenize(
         { 
        newElements:true,
        maxElements:1,
        datas: urlnew,
            textField:'skill_name',
            valueField:'skill_name'
        });
 
        

        var value_locationtype = $("input[name='location_type']:checked").val();
        if(value_locationtype=='location')
        {
            $('#city_parsely').attr('data-parsley-required', 'false');
            $('#country_id').attr('data-parsley-required', 'true');
            $('#other_city').attr('data-parsley-required', 'true');
        }
        else
        {  
            $('#city_parsely').attr('data-parsley-required', 'true');
            $('#country_id').attr('data-parsley-required', 'false');
            $('#other_city').attr('data-parsley-required', 'false');
   
        }
    
   }); 
</script>


<script type="text/javascript">
   function validation() 
    {
        if($('#frm_store_interview').parsley().isValid())
        {         
            run_waitMe();    
        }
    }

    function run_waitMe(){
    
  $('body').waitMe({
  //none, rotateplane, stretch, orbit, roundBounce, win8,
  //win8_linear, ios, facebook, rotation, timer, pulse,
  //progressBar, bouncePulse or img
  effect: 'win8',
  //place text under the effect (string).
  text: 'Please Wait...',
  //background for container (string).
  bg: 'rgba(179,179,179,0.7)',
  //color for background animation and text (string).
  color: 'green',
  //change width for elem animation (string).
  sizeW: '',
  //change height for elem animation (string).
  sizeH: '',
  // url to image
  source: '',
  // callback
  //onClose: function() {}
  });
  }

</script>
<script type="text/javascript">
   $(document).ready(function()
   {
    $(".getcategory").change(function()
    {  
     
    var id         = $(this).val();
    var site_url   = "{{ url('/') }}";
    var token      = $('input[name="_token"]').val();  
    var dataString = 'id='+ id;
   
      $.ajax
      ({
        type: "POST",
        url: site_url+'/member/getsubcategory'+"?_token="+token,
        data: dataString,
        cache: false,
        success: function(html)
        {
          //alert(html.length);
          //console.log(html);
          $(".subcategory").html(html);
          if(html.length==49)
          {
            $('#subcategory').attr('data-parsley-required', 'false');
          } else {
             $('#subcategory').attr('data-parsley-required', 'true');
          }
   
          
        } 
      });   
    });
   });
   
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
   
   
   function locationtype()
     {
        var value_locationtype = $("input[name='location_type']:checked").val();
     
        if(value_locationtype=='location')
        {
          $('#city').hide();
          $('#outside_india').show(); 
          $('#city_parsely').attr('data-parsley-required', 'false');
          $('#country_id').attr('data-parsley-required', 'true');
          $('#other_city').attr('data-parsley-required', 'true');
        }
        else
        {
          $('#city').show();
          $('#outside_india').hide();
          $('#city_parsely').attr('data-parsley-required', 'true');
          $('#country_id').attr('data-parsley-required', 'false');
          $('#other_city').attr('data-parsley-required', 'false');
        }
     }
   //<!--file upload js script for upload video start-->  
         function browsevideo() {
         
             $("#video").trigger('click');
         }
         
         function removeBrowsedvideo() {
             $('#profile_video_name').val("");
             $("#btn_remove_video").hide();
             $("#video").val("");
         }
         
   
             // This is the simple bit of jquery to duplicate the hidden field to subfile
             $('#video').change(function() {
                 if ($(this).val().length > 0) {
                     $("#btn_remove_video").show();
                 }
         
                 $('#profile_video_name').val($(this).val());
             });
              //<!--file upload js script end-->  
   //<!--file upload js script for upload video start-->  
         function browsefile() {
         
             $("#file").trigger('click');
         }
         
         function removeBrowsedfile() {
             $('#profile_file_name').val("");
             $("#btn_remove_file").hide();
             $("#file").val("");
         }
         
   
             // This is the simple bit of jquery to duplicate the hidden field to subfile
             $('#file').change(function() {
                 if ($(this).val().length > 0) {
                     $("#btn_remove_file").show();
                 }
         
                 $('#profile_file_name').val($(this).val());
             });
			 $('#experience').change(function() {
				 var skill = $('#skill_id').val();
				 var value = $(this).val();
				 var html = '';
                 if (value == 'NA' && skill.length > 0) {
					 html = skill+' Interview Questions & Answers';
                     $(".display_new_skill").html(html);
                 }
				 else if(value != '' && skill.length > 0){
					 html = skill+' Real Time Interview Questions & Answers ( '+value+'  Year Exp )';
					 $(".display_new_skill").html(html);
				 }
				else	
					$(".display_new_skill").html(html);		
         
             });
              //<!--file upload js script end-->  
</script>



<div class="modal fade popup-cls in" id="youtubevideoup" role="dialog" aria-hidden="false">
				  <div class="modal-dialog">
					 <div class="modal-content">
						<div class="modal-header">
						   <button type="button" class="close" data-dismiss="modal"><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"></button>
						   <h4 class="modal-title">Add Intro Youtube Video URL</h4>
						</div>
						<div class="modal-body videff">
						    
						   
					 
					 
						<div class="form-group" style="width:100%">
						  <div class="row">
						      
						   <div class="col-sm-12 col-md-4 col-lg-4" style="padding: 10px 16px 2px;">   Youtube  URL:</div>						 
						  <div class="col-sm-12 col-md-8 col-lg-8">
						 
						  <input class="input-box-signup youtubevideo" type="url" value="" name="youtubevideo" placeholder="https://www.youtube.com/watch?v=Up4YiPUN3rc">
						  <span class="youtubeerror" style="color:red"></span>
						  
					
						  
						  </div>
						  </div>
						</div>
				 
					   
						<!--end-->
					 </div>
					 <div class="modal-footer">
						<button type="button"  class="submit-btn ctn addyoutube">Add</button>
					 </div>
				  </div>
			   </div>
		 </div>
			
			
			
			
			
			
			
			
			
			
			
			
			  
  <div id="uploadimageModal" class="modal" role="dialog" style="margin-top: -253.5px !important;">
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header" style="    background: #102b44;">
        	
        		<h4 class="modal-title" style="color: #fff;">Thumbnail Image 	</h4>
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



			
@endsection

