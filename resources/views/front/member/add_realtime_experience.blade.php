<style>
   .srealtime_01{visibility:hidden; height: 0;}
.srealtime_02{border-right: 1px solid rgb(251, 251, 251) ! important; display: none;} 
    
</style>

@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->
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
                     <div  class="tabs responsive-tabs responsive-tabs-initialized">
                        <nav>
                           <ul class="ul-new">
                              <li class="title-lis">
                                 <a href="{{url('/')}}/member/post_interview"><span>1</span> Upload Interview Reference book, Interview by Companies & Video</a>
                              </li>
                              <li class="active title-lis">
                                 <a href="{{url('/')}}/member/real_time_experience"><span>2</span> RealTime Work Experience (Tickets, Tasks & Issues)</a>
                              </li>
                           </ul>
                        </nav>
                        <div class="content recent-product-table">
                           @include('front.layout._operation_status')
                           <form class="" id="frm_add_realtime" method="POST" enctype="multipart/form-data" action="{{url('/')}}/member/store_real_time_experience" data-parsley-validate>
                              {{ csrf_field() }}
                              <div class="outer-box">
                                 <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-9 first-name">
                                       <div class="form-group">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-4 col-lg-4"> <label>Add Issues Title<span class="star">*</span></label></div>
                                             <div class="col-sm-12 col-md-8 col-lg-8">
                                                <input type="text" class="input-box-signup" name="issue_title" placeholder="Enter Your  Issues Title" 
                                                   required="" data-parsley-errors-container="#err_issue_title" data-parsley-required-message="This field is required" value="{{ old('issue_title') }}" />
                                                <div class="error">{{ $errors->first('issue_title') }}</div>
                                                <div id="err_issue_title" class="error"></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-9 first-name">
                                       <div class="form-group">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-4 col-lg-4"><label>Skills <span class="star">*</span></label></div>
                                             <div class="col-sm-12 col-md-8 col-lg-8">
                                                <!--  <select  id="skill_id" name="skills[]" data-rule-required="true"  >
                                                   </select> -->
                                                <!--div class="error">Skills is not Valid</div-->
                                                <input id="skill_realtime" class='input-box-signup' placeholder='Select skill' required="" data-parsley-errors-container="#err_skill_realtime" data-parsley-required-message="This field is required">
                                                <div class="error">{{ $errors->first('skill') }}</div>
                                                <div id="err_skill_realtime" class="error"></div>
                                                <input type = "hidden" id ="skill-id-realtime" name="skill">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-9 first-name">
                                       <div class="form-group">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-4 col-lg-4"><label>Experience Level<span class="star">*</span></label></div>
                                             <div class="col-sm-12 col-md-8 col-lg-8">
                                                <div class="select-number">
                                                   <select name="experience" required="" data-parsley-errors-container="#err_exp_level_realtime" data-parsley-required-message="This field is required">
                                                      <option value="">Select experience</option>
                                                      <option value="0-2">0-2</option>
                                                      <option value="2-4">2-4</option>
                                                      <option value="5-10">5-10</option>
                                                      <option value="10-20">10-20</option>
                                                   </select>
                                                </div>
                                                <div class="error">{{ $errors->first('experience') }}</div>
                                                <div id="err_exp_level_realtime" class="error"></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-9 first-name">
                                       <div class="form-group">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-4 col-lg-4"><label>Add Solution<span class="star">*</span></label></div>
                                             <div class="col-sm-12 col-md-8 col-lg-8">
                                                <textarea class="add-solution" required="" data-parsley-errors-container="#err_solution" data-parsley-required-message="This field is required" name="solution"  cols="30" rows="8" >{{old('solution')}}</textarea>
                                                <div class="error">{{ $errors->first('solution') }}</div>
                                                <div id="err_solution" class="error"></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-9 first-name">
                                       <div class="form-group">
                                          <div class="row">
                                             <div class="col-sm-12 col-md-4 col-lg-4"><label>Attachment<span class="star">*</span></label></div>
                                             <div class="col-sm-12 col-md-8 col-lg-8">
                                                <div class="user-box">
                                                   <input id="file_realtime" class="srealtime_01" name="attachment" type="file" required="" data-parsley-errors-container="#error-file-realtime" data-parsley-required-message="This field is required">
                                                   <div class="input-group ">
                                                      <div class="btn btn-primary btn-file btn-gry">
                                                         <a class="file" onclick="browsefile_realtime()">Choose File
                                                         </a>
                                                      </div>
                                                      <div class="btn btn-primary btn-file remove srealtime_02" id="btn_remove_file_realtime">
                                                         <a class="file" onclick="removeBrowsedfile_realtime()"><i class="fa fa-trash"></i>
                                                         </a>
                                                      </div>
                                                      <input class="form-control file-caption  kv-fileinput-caption" id="realtime_file_name" disabled="disabled" type="text">
                                                   </div>
                                                   <div class="clearfix"></div>
                                                </div>
                                                <h5 class="upload">Support Formats: doc, docx, rtf, PDF, Max File 500 KB</h5>
                                                <div class="error">{{ $errors->first('attachment') }}</div>
                                                <div id="error-file-realtime" class="error"></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!--end-->   
                                    <div class="row">
                                       <div class="col-sm-12 col-md-8 col-lg-9">
                                          <div class="btn-wrapper">
                                             <button type="reset" class="cancel-btn">Cancel</button>
                                             <button type="submit" class="submit-btn">Submit</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </form>
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
                  <div class="sample-img"> <img src="{{url('/')}}/images/sample-img.jpg" alt="Interviewxp"/> </div>
                  <div class="sample-img"> <img src="{{url('/')}}/images/sample-img.jpg" alt="Interviewxp"/> </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<!-- <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet"> -->
<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/skillautocomplete.css"/>
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!-- Javascript -->
<script>
   function loadskill(){
      var token     = $('input[name=_token]').val();
      var skillList = "";
      $.ajax({
            url: "{{url('/')}}/member/getmemberskills",
            type: "POST",
            async: false,
            data: { _token:token},
            dataType: "json"
          }).done(function(skills){
           skillList = skills;
          });
      //Returns the javascript array of sports teams for the selected sport.
     return skillList; 
   }
   $(function() {
      var projects = loadskill();
      $( "#skill_realtime" ).autocomplete({
         minLength: 0,
         source: projects,
         focus: function( event, ui ) {
                     $( "#skill" ).val( ui.item.label );
                     return false;
                  },
         select: function( event, ui ) {
                     $( "#skill_realtime" ).val( ui.item.label );
                     $( "#skill-id-realtime" ).val( ui.item.value );
                     return false;
                  }
      })
               
      .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
         return $( "<li>" )
         .append( "<a>" + item.label + "<br> </a>" )
         .appendTo( ul );
      };
   });
</script>
<script type="text/javascript">
   function browsefile_realtime() {
          
              $("#file_realtime").trigger('click');
          }
          
          function removeBrowsedfile_realtime() {
              $('#realtime_file_name').val("");
              $("#btn_remove_file_realtime").hide();
              $("#file_realtime").val("");
          }
          
    
              // This is the simple bit of jquery to duplicate the hidden field to subfile
              $('#file_realtime').change(function() {
                  if ($(this).val().length > 0) {
                      $("#btn_remove_file_realtime").show();
                  }
          
                  $('#realtime_file_name').val($(this).val());
              });
</script>
@endsection

