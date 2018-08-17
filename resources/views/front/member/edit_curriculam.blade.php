@extends('front.layout.main')
@section('middle_content')
<div id="member-header" class="after-login"></div>
	<div class="banner-member">
	   <div class="pattern-member">
	   </div>
	</div>
	 
	<div class="container-fluid fix-left-bar">
      <div class="row">
        @include('front.member.member_sidebar')
         <div class="col-sm-8 col-md-9 col-lg-10">
          
            <h2 class="curriculam">Update Curriculam</h2>
           
            <div class="right-section-member">
             <div class="col-sm-12 col-md-10 form-wrapper">                  
           
          
           <div class="member-myProfile-form">

           <form class="" id="frm_edit_education" method="POST" action="{{url('/')}}/member/update_curriculam" data-parsley-validate>                        
           {{ csrf_field() }}
           @include('admin.layout._operation_status')
           <div class="form-group">
                  <label>Topics<span class="star">*</span></label>

                  <div class="duration">
                     <div class="row">
                        
                        <div id="specialization_div" class="col-sm-12">
                           <div class="select-number">
                              <input type="hidden" name="id" id="id" value="{{isset($arr_curriculam['id'])?$arr_curriculam['id']:''}}" />
                              <select id="skills" name="skills" data-parsley-required="true" data-parsley-errors-container="#err_skills" data-parsley-required-message="This field is required">
                              @if(isset($arrMemberDetails) && count($arrMemberDetails)>0)
                              @foreach($arrMemberDetails as $value)
                              <option value="{{$value['skill_id']}}" {{($value['skill_id'] == $arr_curriculam['skill_id'])?'selected="selected"':'NA'}}>{{$value['skill_name']}} Real Time Interview Questions & Answers</option>
                              @endforeach
                              @endif
                              
                            </select>
                             
                           </div>
                        </div>
                      
                     </div>
                  </div>
               </div>     


           
            <div class="form-group">
                  <label>Title<span class="star">*</span></label>
                  <input type="text" name="title" id="title" class="input-box-signup" placeholder="Enter Title" value="{{isset($arr_curriculam['title'])?$arr_curriculam['title']:''}}" required="" data-parsley-errors-container="#err_title" data-parsley-required-message="This field is required"/>
                         <!--  <div class="error_msg" id="err_marks_input" style="color:red"></div> -->
                    <div id="err_title" class="error"></div> 
                     <div class="error">{{ $errors->first('marks_input') }}</div>     
            </div>
               
               
            <div class="form-group">
                  <label>Description<span class="star">*</span></label>                        
                  <textarea name="description" class="form-area" data-rule-required="true" cols="30" rows="5" placeholder="Enter Description" required="" data-parsley-errors-container="#err_description" data-parsley-required-message="This field is required">{{isset($arr_curriculam['description'])?$arr_curriculam['description']:''}}</textarea>
                  <div id="err_description" class="error"></div>   
                  <div class="error">{{ $errors->first('pan_no') }}</div>     
            </div>   

                
               <div class="btn-wrapper">
                  <input type="hidden"  name="enc_id" value="{{$enc_id or ''}}">
                  <button type="submit" class="submit-btn">Update</button>

               </div>
               </form>
            </div>
          </div>
           </div>

             </div>
        </div>
       
          
    </div>
    </div>
 </div>     
@endsection