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
      <div class="col-sm-8 col-md-9 col-lg-10">
         <h2 class="heading-real-time-exp">Add Real Time Experience</h2>
         <div class="work-exp-wrapper">
            @include('front.layout._operation_status')
            <form class="" id="frm_store_experience" method="POST" enctype="multipart/form-data" action="{{url('/')}}/member/store_real_time_experience" data-parsley-validate>
            {{ csrf_field() }}
            <div class="btn-add-more"><button type="button" class="submit-btn ctn"></button></div>
            <div class="form-group">
               <label>Add Issues Title</label>
               <input type="text" class="input-box-signup" name="issue_title" placeholder="Enter Your  Issues Title" 
                  required="" data-parsley-errors-container="#err_issue_title" data-parsley-required-message="This field is required" value="{{ old('issue_title') }}" />
               <div class="error">{{ $errors->first('issue_title') }}</div>
               <div id="err_issue_title" class="error"></div>
            </div>
            <div class="form-group">
               <label>Skills <span class="star">*</span></label>
               <!--  <select  id="skill_id" name="skills[]" data-rule-required="true"  >
                  </select> -->
               <!--div class="error">Skills is not Valid</div-->
               <input id= "skill" class='input-box-signup' placeholder='Select skill' required="" data-parsley-errors-container="#err_skill" data-parsley-required-message="This field is required">
               <div class="error">{{ $errors->first('skill') }}</div>
               <div id="err_skill" class="error"></div>
               <input type = "hidden" id = "skill-id" name="skill">
            </div>
            <div class="form-group">
               <label>Experience Level</label>
               <div class="select-number">
                  <select name="experience" required="" data-parsley-errors-container="#err_exp_level" data-parsley-required-message="This field is required">
                     <option value="">Select experience</option>
                     <option value="0-2">0-2</option>
                     <option value="2-4">2-4</option>
                     <option value="5-10">5-10</option>
                     <option value="10-20">10-20</option>
                  </select>
               </div>
               <div class="error">{{ $errors->first('experience') }}</div>
               <div id="err_exp_level" class="error"></div>
            </div>
            <div class="form-group">
               <label>Add Solution</label>
               <textarea class="add-solution" required="" data-parsley-errors-container="#err_solution" data-parsley-required-message="This field is required" name="solution"  cols="30" rows="8" >{{old('solution')}}</textarea>
               <div class="error">{{ $errors->first('solution') }}</div>
               <div id="err_solution" class="error"></div>
            </div>
            
            <div class="form-group">
               <label>Attachment</label>
               <div class="user-box row">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <input id="file" style="visibility:hidden; height: 0;" name="attachment" type="file" required="" data-parsley-errors-container="#error-file" data-parsley-required-message="This field is required" onchange="chk_book_ext()">
                     <div class="input-group ">
                        <div class="btn btn-primary btn-file btn-gry">
                           <a class="file" onclick="browsefile()">Choose File
                           </a>
                        </div>
                        <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_file">
                           <a class="file" onclick="removeBrowsedfile()"><i class="fa fa-trash"></i>
                           </a>
                        </div>
                        <input class="form-control file-caption  kv-fileinput-caption" id="profile_file_name" disabled="disabled" type="text">
                     </div>
                     <div class="error">{{ $errors->first('attachment') }}</div>
                     <div id="error-file" class="error"></div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <h5 class="upload">Support Formats: doc, docx, rtf, PDF, Max File 500 KB</h5>
            </div>
            <!--end-->                        
            <div class="btn-wrapper">
               <button type="reset" class="cancel-btn">Cancel</button>
               <button type="submit" class="submit-btn">Submit</button>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/skillautocomplete.css"/>
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
      $( "#skill" ).autocomplete({
         minLength: 0,
         source: projects,
         focus: function( event, ui ) {
                     $( "#skill" ).val( ui.item.label );
                     return false;
                  },
         select: function( event, ui ) {
                     $( "#skill" ).val( ui.item.label );
                     $( "#skill-id" ).val( ui.item.value );
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
@endsection

