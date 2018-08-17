@extends('front.layout.main')
@section('middle_content')
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
      
      <div class="middle-area min-height">
    
           <form id="frm_manage" action="{{url('/member/multi_action_notification')}}" id="frm_alerts_manage" method="POST" enctype="multipart/form-data" data-parsley-validate> 
           {{ csrf_field() }}
         <div class="container">
           <div class="notification-box notify-bx2">
               @include('admin.layout._operation_status')  
           <div class="row">
               <div class="col-xs-10">
                  <div class="check-box-UserAlert">
                      <input class="css-checkbox" id="radio0" name="radiog_dark" type="checkbox">
                      <label class="css-label radGroup2" for="radio0">&nbsp;</label>
                  </div>
               </div>
               <div class="col-xs-2">
               <div class="delet-wrapper delet-w2">
                <a href="javascript:void(0);" class="delete-i-top" title="Multiple Delete"
                  onclick="javascript : return check_multi_action('checked_record[]','frm_manage','delete');">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
               </a>
               </div>
               </div>
           </div>
        </div>
         @if(isset($arr_notification['data']) && sizeof($arr_notification['data'])>0)
          @foreach($arr_notification['data'] as $notification)
          <div class="notification-box notify">
           <div class="row">
               <div class="col-sm-11">
                       <div class="check-box-UserAlert">
                         <input id="radio1_{{ base64_encode($notification['id']) }}" class="css-checkbox" type="checkbox" 
                                                   name="checked_record[]"  
                                                   value="{{ base64_encode($notification['id']) }}" /> 
                                                   <label class="css-label radGroup2" for="radio1_{{ base64_encode($notification['id']) }}">&nbsp;</label>  
                       </div>
                       <p>{{$notification['message']}}</p>
                       <h5><i class="fa fa-calendar" aria-hidden="true"></i> {{date('d M Y h:i',strtotime($notification['created_at']))}}</h5>
               </div>
               <div class="col-sm-1">
               <div class="delet-wrapper">
               <a href="{{url('/member/delete_notification/'.base64_encode($notification['id']))}}" onclick="return confirm('Are you sure to Delete this notification?')" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
               </div>
               </div>
           </div>
          </div>
            @endforeach
            @else
               <div class="notification-box notify">
                  <div class="row">
                    <p>No Records found... </p>
                </div>
              </div>
            @endif
                       <!-- pagination -->
                        {{-- <div class="prod-pagination">
                                         <ul class="pagination pagination-blog">
                                            <li>
                                               <a href="#" class="disable">
                                               <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                               </a>
                                            </li>
                                            <li><a href="#" class="act">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li>
                                               <a href="#">
                                              <i class="fa fa-angle-double-right" aria-hidden="true"></i>

                                               </a>
                                            </li>
                                         </ul>
                        </div> --}}
                    <!-- end -->    
            <div class="prod-pagination">
            {{$arr_pagination->render()}}
            </div>
         </div>
      </form>   
   </div>
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
      