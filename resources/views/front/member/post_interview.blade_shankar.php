@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>


<div class="banner-member">
   <div class="pattern-member">
   </div>
</div>
<div class="container-fluid fix-left-bar">
   <div class="row">
      @include('front.member.member_sidebar')               
      <div class="col-sm-9 col-md-9 col-lg-10">
         <h2 class="my-profile pages">My Uploads</h2>
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-9">
               <div class="box-m mrg-tps">
                  <div class="tab-contact">
                     <div class="tabs responsive-tabs responsive-tabs-initialized">
                        <nav>
                           <ul class="ul-new">
                              <li class="active title-lis">
                                 <a href="{{url('/')}}/member/post_interview"><span>1</span> Upload Interview Reference book, Interview by Companies & Video</a>
                              </li>
                              <!-- <li class="title-lis">
                                 <a href="{{url('/')}}/member/real_time_experience"><span>2</span> RealTime Work Experience (Tickets, Tasks & Issues)</a>
                              </li> -->
                           </ul>
                        </nav>
                        <div class="content recent-product-table">
                           @include('front.layout._operation_status')
                           <form class="" id="frm_store_interview" method="POST" enctype="multipart/form-data" action="{{url('/')}}/member/store_interview" data-parsley-validate>
                              {{ csrf_field() }}
                              <div class="outer-box">
                                 <div class="inner-box">
                                    <div class="row">
                                       <div class="col-sm-6 col-md-6 col-lg-9 first-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                   <label>Skills <span class="star">*</span></label>
                                                   <!--  <select  id="skill_id" name="skills[]" data-rule-required="true"  >
                                                      </select> -->
                                                   <!--div class="error">Skills is not Valid</div-->
                                                </div>
                                                <div class="col-sm-12 col-md-8 col-lg-8">
                                                  <select  id="skill_id" name="skills[]" required="" data-parsley-errors-container="#err_job_skill" data-parsley-required-message="This field is required">
                                                   </select>
                                                     <div class="error">{{ $errors->first('skills') }}</div>
                                                   <div id="err_job_skill" class="error"></div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>


                                       <div class="col-sm-6 col-md-6 col-lg-9 last-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-4 col-lg-4">  <label>Experience Level <span class="star">*</span></label></div>
                                                <div class="col-sm-12 col-md-8 col-lg-8">
                                                   <div class="select-number">
                                                      <select name="experience" required="" data-parsley-errors-container="#err_exp_level" data-parsley-required-message="This field is required">
                                                         <option value="">Select experience</option>
                                                         <option value="0-2">0-2 Years</option>
                                                         <option value="2-4">2-4 Years</option>
                                                         <option value="5-10">5-10 Years</option>
                                                         <option value="10-20">10-20 Years</option>
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
                                       <div class="col-sm-6 col-md-6 col-lg-9 first-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-4 col-lg-4"> <label>Categories <span class="star">*</span></label></div>
                                                <div class="col-sm-12 col-md-8 col-lg-8">
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
                                       <div class="col-sm-6 col-md-6 col-lg-9 last-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-4 col-lg-4"><label>Sub Catagories</label> </div>
                                                <div class="col-sm-12 col-md-8 col-lg-8">
                                                    <input type="text" name="subcategory" class="input-box-signup" placeholder="Enter Subcategory" data-parsley-required="false" data-parsley-errors-container="#err_sub_category" data-parsley-required-message="This field is required"/> 
                                                   <div id="err_sub_category" class="error"></div>
                                                   
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-6 col-md-6 col-lg-9 first-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-4 col-lg-4"><label>Qualification <span class="star">*</span></label> </div>
                                                <div class="col-sm-12 col-md-8 col-lg-8">
                                                   <div class="select-number">
                                                      <select name="qualification_id" onclick="loadSpecialization(this);" required="" data-parsley-errors-container="#err_qualification" data-parsley-required-message="This field is required">
                                                         <option value="">Select Qualification</option>
                                                         @if(isset($arr_qualification) && count($arr_qualification)>0)
                                                         @foreach($arr_qualification as $qualification)
                                                         <option value="{{ $qualification['id'] }}">{{ $qualification['qualification_name'] or '-' }}</option>
                                                         @endforeach
                                                         @endif
                                                      </select>
                                                      <div class="error">{{ $errors->first('qualification_id') }}</div>
                                                      <div id="err_qualification" class="error"></div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div id="specialization_div" class="col-sm-6 col-md-6 col-lg-9 last-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-4 col-lg-4"><label>Specialization <span class="star">*</span></label> </div>
                                                <div class="col-sm-12 col-md-8 col-lg-8">
                                                   <div class="select-number">
                                                      <select id="specialization" name="specialization_id" data-parsley-required="false" data-parsley-errors-container="#err_specialization" data-parsley-required-message="This field is required">
                                                      </select>
                                                      <div id="err_specialization" class="error"></div>
                                                      <!--  <div class="error">{{ $errors->first('specialization') }}</div> -->
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    
                                    <div class="row">
                                       
                                       <div class="col-sm-6 col-md-6 col-lg-9 last-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-4 col-lg-4"><label>Upload Image</label> </div>
                                                <div class="col-sm-12 col-md-8 col-lg-8">
                                                   <div class="user-box">
                                                      <input id="profile_image" style="visibility:hidden; height: 0;" name="image" type="file" onchange=" return validate_upload();">
                                                      <div class="input-group ">
                                                         <div class="btn btn-primary btn-file btn-gry">
                                                            <a class="file" onclick="browseImage()">Choose File
                                                            </a>
                                                         </div>
                                                         <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_image">
                                                            <a class="file" onclick="removeBrowsedImage()"><i class="fa fa-trash"></i>
                                                            </a>
                                                         </div>
                                                         <input class="form-control file-caption  kv-fileinput-caption" id="profile_image_name" disabled="disabled" type="text">
                                                         <div id="error-image" class="error"></div>
                                                      </div>
                                                      <div class="error" id="error-image">{{ $errors->first('image') }}</div>
                                                      <div class="clearfix"></div>
                                                      <h5 class="upload"> Please upload image of size(200x100) . Support Formats: jpg, jpeg, png, bmp.</h5>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!--end-->
                                       
                                       <div class="col-sm-6 col-md-6 col-lg-9 last-name">
                                          
                                       </div>
                                       <!--upload resume section-->
                                       <div class="col-sm-6 col-md-6 col-lg-9 first-name">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-4 col-lg-4"> <label>Youtube Video Url</label> </div>
                                                <div class="col-sm-12 col-md-8 col-lg-8">
                                                   <div class="user-box">

                                                     <!--  <input id="video" style="visibility:hidden; height: 0;" name="videofile" type="file" onchange="chk_video()">
                                                      <div class="input-group ">
                                                         <div class="btn btn-primary btn-file btn-gry">
                                                            <a class="file" onclick="browsevideo()">Choose File
                                                            </a>
                                                         </div>
                                                         <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_video">
                                                            <a class="file" onclick="removeBrowsedvideo()"><i class="fa fa-trash"></i>
                                                            </a>
                                                         </div>
                                                         <input class="form-control file-caption  kv-fileinput-caption" id="profile_video_name" disabled="disabled" type="text">
                                                      </div>
                                                      <div class="error">{{ $errors->first('videofile') }}</div>
                                                      <div id="error_video" class="error"></div>
                                                      <div class="clearfix"></div>
                                                      <h5 class="upload">Support Formats: MP4,MOV,AVI,FLV,VLC</h5> -->
                                                      <input id="videoUrl" type="text" name="videofile" class="input-box-signup">
                                                      <div id="error_url" class="error"></div>

                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!--end-->
                                       <div class="col-sm-6 col-md-6 col-lg-9 last-name">
                                          <div class="btn-wrapper">
                                             <a href="{{url('/')}}/member/post_interview"><button type="button" class="cancel-btn">Cancel</button></a> 
                                             <button type="submit" class="submit-btn" onclick="return url_validation(); ">Submit</button>
                                          </div>
                                       </div>
                                    </div>
                           </form>
                           </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
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
                     @else
                     <div class="sample-img"> <img src="{{url('/')}}/images/sample-img.jpg" alt="Interviewxp" class="img-responsive" /> </div>
                     @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet"> -->
<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/admin/jquery.tokenize.css"/>
<script type="text/javascript" src="{{url('/')}}/js/admin/jquery.tokenize.js"></script>

<!--
Shankar 26/1/17  for skill changes

<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/skillautocomplete.css"/>
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
<!-- Javascript -->
<script type="text/javascript">    
   $(document).ready(function(){
    
   
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
   function url_validation()
   {
      var chk_url = document.getElementById("videoUrl").value;
      if(chk_url != "")
      {   
         var url = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
         var matches = $('#videoUrl').val().match(url);
         var errName = $("#error_url");
         if (!matches) {
              errName.html("Please Enter Valid Youtube Url.");
             return false;
         } 
      } 
     
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
              //<!--file upload js script end-->  
</script>

<script type="text/javascript">
var url = "{{ url('/get_skills') }}";
  $(document).ready(function()
  {
    $('#skill_id').tokenize(
      { 
        newElements:true,
        maxElements:1,
        datas: url,
            textField:'skill_name',
            valueField:'skill_name'
        });

   });

</script>
@endsection

