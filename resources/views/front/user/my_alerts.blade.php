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
                           <li class="">
                             <!--  <a href="#doctor1">Create Alerts</a> -->
                             <a href="{{url('/user/create_alert')}}">Create Alerts</a>
                           </li>
                           <li class="active">
                              <!-- <a href="#doctor2">My Saved Alerts</a> -->
                              <a href="{{url('/user/manage_alert')}}">My Saved Alerts</a>
                           </li>
                        </ul>
                     </nav>
                     <div class="content">
                        <!-- <h3 class="accordion-title active"><a href="#doctor1">CREATE ALERTS</a></h3>-->
                        @include('admin.layout._operation_status')  
                         <form id="frm_manage" action="{{url('/user/multi_action')}}" id="frm_alerts_manage" method="POST" enctype="multipart/form-data" data-parsley-validate> 
                            {{ csrf_field() }}
                           <div class="icon-wrapper"> 
                              <a href="javascript:void(0);" class="delete-i-top" title="Multiple Delete"
                              onclick="javascript : return check_multi_action('checked_record[]','frm_manage','delete');">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </a>
                              <a href="{{url('/user/manage_alert')}}" class="refresh-i"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                           </div>
                           <div class="table-search-pati section1-tab">
                              <div class="table-responsive">
                                 <table class="table" id="table_module">
                                        <thead>
                                          <tr class="top-strip-table">
                                             <td  style="width: 4%;">
                                             <div class="check-box-UserAlert">
                                                <input class="css-checkbox" id="radio0" name="radiog_dark" type="checkbox">
                                                <label class="css-label radGroup2" for="radio0">&nbsp;</label>
                                              <!--  <input type="checkbox" name="mult_change" id="mult_change" class="selectall" /> -->
                                             </div>
                                          </td>
                                             <td>S.No</td>
                                             <td>Alert Name</td>
                                             <td>Skills</td>
                                             <td>Experience Level</td>
                                             <td>Actions</td>
                                          </tr>
                                       </thead>
                                    <tbody>
                                      @if(isset($arr_data['data']) && sizeof($arr_data['data'])>0)
                                      <?php $i = 1; ?>
                                       @foreach($arr_data['data'] as $data)
                                       <tr class="strips">
                                          <td>
                                             <div class="check-box-UserAlert">
                                                <input id="radio1_{{ base64_encode($data['alert_id']) }}" class="css-checkbox" type="checkbox" 
                                                   name="checked_record[]"  
                                                   value="{{ base64_encode($data['alert_id']) }}" />
                                                   <label class="css-label radGroup2" for="radio1_{{ base64_encode($data['alert_id']) }}">&nbsp;</label> 
                                                    
                                               <!--  <input type="checkbox" name="checked_record[]"  value="{{ base64_encode($data['alert_id']) }}"> -->
                                                
                                             </div>
                                          </td>
                                          <td><?php echo $i++; ?></td>
                                          <td>{{$data['alert_name'] or 'NA'}}</td>
                                          <td>{{$data['skills'][0]['skill_name'] or 'NA'}}</td>
                                          <td>{{$data['exp_level'] or 'NA'}} Years</td>
                                          <td>
                                             <div class="text-left">
                                                <a href="{{url('/')}}/user/view_alert/{{ base64_encode($data['alert_id']) }}" class="eye-i"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="{{url('/')}}/user/edit_alert/{{ base64_encode($data['alert_id']) }}" class="edit-i"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <a href="{{url('/')}}/user/delete_alert/{{ base64_encode($data['alert_id']) }}" onclick="return confirm('Are you sure to Delete this record?')" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                             </div>
                                          </td>
                                       </tr>
                                      @endforeach
                                      @else
                                        <tr><td colspan="6"><div style="color:red;text-align:center;">No Records found...  </div></td></tr>
                                      @endif
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                       <!--  </form> -->
                       {!! Form::close() !!}
                         <div class="prod-pagination">
                          {{$arr_pagination->render()}}
                          </div>
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
<script type="text/javascript">
$( document ).ready(function() {
 $('#radio0').click(function() {
    if ($(this).is(':checked')) {
        $('div input').attr('checked', true);
    } else {
        $('div input').attr('checked', false);
    }
});
}); 

</script>
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
         source: availableTags,
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

