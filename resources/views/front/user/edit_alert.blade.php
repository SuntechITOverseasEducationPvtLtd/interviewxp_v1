

@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/data-tables/latest/dataTables.bootstrap.min.css">
<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->
<div class="banner-change-pw">
   <div class="pattern-change-pw">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="heading-changepw">{{$module_title}}</div>
            </div>
         </div>
      </div>
   </div>
</div>
<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
<div class="middle-area min-height">
   <div class="container">
      <!--tab-->
      <div class="col-sm-12">
         <div class="appom-box">
            <div class="box-m">
               <div class="tab-contact">
                  <div class="tabs responsive-tabs responsive-tabs-initialized">
                     <nav>
                        <ul>
                           <li class="active">
                              <a href="#">Update Alerts</a>
                           </li>
                           <li class="">
                              <a href="{{ url('/')}}/user/manage_alert">My Saved Alerts</a>
                              </li>
                        </ul>
                     </nav>
                     <div class="content">
                        <!-- <h3 class="accordion-title active"><a href="#doctor1">CREATE ALERTS</a></h3>-->
                        <h4>You will receive an alerts on the basis of the fields you have filled</h4>
                        @include('front.layout._operation_status')
                        <form action="{{url('/user/update_alert')}}" id="frm_create_alerts" method="POST" data-parsley-validate>
                           {{ csrf_field() }}
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Skills </label>
                                    <input id="skill" class='input-box-signup' placeholder='Select skill' required="" data-parsley-errors-container="#err_skill" data-parsley-required-message="This field is required" value="{{$arr_data['skills'][0]['skill_name'] or 'NA'}}">
                                    <input type="hidden" id ="skill-id" name="skill" value="{{$arr_data['skill_id']}}">
                                    <div class="error">{{ $errors->first('skill') }}</div>
                                    <div id="err_skill" class="error"></div>
                                 </div>
                                 <div class="form-group">
                                    <label>Experience Level</label>
                                   
                                    <div class="select-number">
                                       <select name="experience" required="" data-parsley-errors-container="#err_exp_level" data-parsley-required-message="This field is required">
                                        <option value="">Select experience</option>
                                          <option @if($arr_data['exp_level']=='0-2') selected="" @endif value="0-2">0-2</option>
                                          <option @if($arr_data['exp_level']=='2-4') selected="" @endif value="2-4">2-4</option>
                                          <option @if($arr_data['exp_level']=='5-10') selected="" @endif value="5-10">5-10</option>
                                          <option @if($arr_data['exp_level']=='10-20') selected="" @endif value="10-20">10-20</option>
                                       </select>
                                       <div class="error">{{ $errors->first('experience') }}</div>
                                       <div id="err_exp_level" class="error"></div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label>Name Your Alerts </label>
                                    <input name="alert_name" type="text" class="input-box-signup" placeholder="Enter Your Name Your Alerts" required="" data-parsley-errors-container="#err_alert_name" data-parsley-required-message="This field is required" value="{{$arr_data['alert_name'] or 'NA'}}" />
                                    <div class="error">{{ $errors->first('alert_name') }}</div>
                                    <div id="err_alert_name" class="error"></div>
                                 </div>
                                 <div class="check-box">
                                    @if($arr_data['skill_set'] == 'Yes')
                                    <input checked="" class="css-checkbox" id="radio" name="skill_set" type="checkbox" value="Yes">
                                    @else
                                     <input class="css-checkbox" id="radio" name="skill_set" type="checkbox" value="No">
                                    @endif
                                    <label class="css-label radGroup2" for="radio">Also send me related skill sets</label>
                                 </div>
                                 <input type="hidden" name="enc_id" value="{{$arr_data['alert_id']}}">
                                 <div class="btn-wrapper btn-UserAlert">
                                    <button type="reset" class="cancel-btn">Cancel</button>
                                    <button type="submit" class="submit-btn">Submit</button>
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
      <!--end-->
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
            url: "{{url('/')}}/user/getskills",
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
   function check_multi_action(checked_record,frm_id,action)
    {
      var checked_record = document.getElementsByName(checked_record);
      var len = checked_record.length;
      var flag=1;
      var input_multi_action = jQuery('input[name="multi_action"]');
      var frm_ref = jQuery("#"+frm_id);
      
      if(len<=0)
      {
        alert("No records to perform this action");
        return false;
      }
      
      if(confirm('Do you really want to perform this action'))
      {
        for(var i=0;i<len;i++)
        {
          if(checked_record[i].checked==true)
          {  
              flag=0;
              /* Set Action in hidden input*/
              jQuery('input[name="multi_action"]').val(action);
   
              /*Submit the referenced form */
              jQuery(frm_ref)[0].submit();  
            }
          }
   
        if(flag==1)
        {
          alert('Please select record(s)');
          return false;
        }  
          
      } 
      
   }
   
</script>
@endsection

