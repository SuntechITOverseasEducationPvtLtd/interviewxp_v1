@extends('front.layout.main')
@section('middle_content')
      <div id="after-login-header" class="after-login"></div>
      <div class="banner-member">
         <div class="pattern-member">
         </div>
      </div>

     
      <div class="container max-height">
         <div class="row">
            <div class="col-lg-12">
               <div class="middle-section min-height">
                  <div class="user-dashbord">
                     <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <div class="middle part">

                           @include('admin.layout._operation_status')  
                         <form id="frm_manage" action="{{url('/member/multi_action_purchase')}}" id="frm_alerts_manage" method="POST" enctype="multipart/form-data" data-parsley-validate> 
                         {{ csrf_field() }}
                              <div class="row">
                                 <div class="col-xs-8">
                                    <h2 class="my-profile">{{$module_title}}</h2>
                                 </div>
                                 <div class="col-xs-4">
                                    <div class="icon-w"> 
                                      {{--  <a href="javascript:void(0);" class="delete-i-top" title="Multiple Delete"
                              onclick="javascript : return check_multi_action('checked_record[]','frm_manage','delete');">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </a> --}}
                              <a href="{{url('/member/purchase_history')}}" class="refresh-i"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                    </div>
                                 </div>

                              </div>
                              <div class="outer-box">
                                 <div class="table-search-pati section1-tab">
                                    <div class="table-responsive">
                                       <table class="table">
                                          <tbody>
                                          <thead>
                                             <tr class="top-strip-table">
                                                <td>
                                                   <div class="check-box-UserAlert">
                                                      <input class="css-checkbox" id="radio0" name="radiog_dark" type="checkbox">
                                                      <label class="css-label radGroup2" for="radio0">&nbsp;</label>
                                                   </div>
                                                </td>
                                                <td>S.No.</td>
                                                <td>Description</td>
                                                <td>Exp.Level</td>
                                                <td>Purchased date</td>
                                                {{-- <td>Validity Date</td> --}}
                                                <td>Amount</td>
                                                <td>Actions</td>
                                             </tr>
                                          </thead>
                                        
                                         @if(isset($arr_transaction['data']) && sizeof($arr_transaction['data'])>0)
                                         <?php $i = 1; ?>
                                         @foreach($arr_transaction['data'] as $data)
                                          <thead class="strips">
                                             <tr class="main-content">
                                                <td>
                                                   <div class="check-box-UserAlert">
                                                      <input id="radio1_{{ base64_encode($data['id']) }}" class="css-checkbox" type="checkbox" 
                                                   name="checked_record[]"  
                                                   value="{{ base64_encode($data['id']) }}" /> 
                                                   <label class="css-label radGroup2" for="radio1_{{ base64_encode($data['id']) }}">&nbsp;</label>  
                                                   </div>
                                                </td>
                                                <td>{{$i++}}</td>
                                                <td>{{$data['skill_name'] or 'NA'}}</td>
                                                <td>{{$data['experience_level'] or 'NA'}} Years</td>
                                                <td>{{date('d M Y', strtotime($data['created_at']))}}</td>
                                                {{-- <td>{{date('d M Y', strtotime($data['end_date']))}}</td> --}}
                                                <td>Rs.{{ $data['grand_total'] or 'NA' }}</td>
                                                <td>
                                                   <div class="text-left">
                                                      <a href="{{url('/')}}/member/view_purchase/{{ base64_encode($data['id']) }}" class="eye-p"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                     {{-- <a href="{{url('/')}}/member/delete_purchase/{{ base64_encode($data['id']) }}" onclick="return confirm('Are you sure to Delete this record?')" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a> --}}
                                                   </div>
                                                </td>
                                                <td class="arrow"><i class="fa fa-chevron-down" aria-hidden="true"></i></td>
                                             </tr>
                                             
                                             <tr class="sub-content" style="display:none;">
                                                <td colspan="9">

                                               @if(isset($data['reference_book']) && $data['reference_book']=='Yes')
                                                   <p>
                                                      <i class="fa fa-check" aria-hidden="true"></i>
                                                      <a href="{{url('/')}}/member/view_purchase/{{ base64_encode($data['id']) }}"><span> Interview Refference Book (30 Days Validity)</span>
                                                      <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                   </p>
                                                 @endif  
                                                 @if($data['interview_count_arr']!=0)
                                                   <p>
                                                      <i class="fa fa-check" aria-hidden="true"></i>
                                                       <a href="{{url('/')}}/member/view_purchase/{{ base64_encode($data['id']) }}">
                                                      <span> {{$data['interview_count']}} Company's Q & A</span>
                                                      <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                   </p>
                                                 @endif  
                                                 @if($data['purchase_history'][0]['ticket_name']!="")
                                                   <p>
                                                      <i class="fa fa-check" aria-hidden="true"></i>
                                                       <a href="{{url('/')}}/member/view_purchase/{{ base64_encode($data['id']) }}">
                                                      <span>{{$data['ticket_name']}} Real Time Work Experience (Tickets, Tasks, Issues)</span>
                                                      <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                   </p>
                                                 @endif 
                                                </td>
                                             </tr>
                                             
                                          </thead>
                                         @endforeach
                                         @else
                                          <tr><td colspan="6"><div style="color:red;text-align:center;">No Records found... </div></td></tr>
                                         @endif
                                         
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <!-- pagination -->
                               <!--   <div class="prod-pagination">
                               
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
                                 </div> -->

                                  <div class="prod-pagination">
                                   {{$arr_pagination->render()}}
                                   </div>
                                 <!-- end -->              
                              </div>
                            {!! Form::close() !!}
                              @if(isset($arr_advertise) && sizeof($arr_advertise)>0)
                             @if($arr_advertise[1]['is_active']==1)
                              @if($arr_advertise[1]['id']==4)
                                <div class="sample-img2"> <img src="{{$advertise_public_img_path.$arr_advertise[1]['advertise_image']}}" alt="Interviewxp" class="img-responsive" /> </div>
                             @endif
                           @else
                           <div class="sample-img2"> <img src="{{url('/')}}/images/sample-img3.jpg" alt="Interviewxp" class="img-responsive" /> </div>
                           @endif
                           @else
                           <div class="sample-img2"> <img src="{{url('/')}}/images/sample-img3.jpg" alt="Interviewxp" class="img-responsive" /> </div>
                           @endif

                              <!-- <div class="sample-img2"><img src="{{url('/')}}/images/sample-img3.jpg" class="img-responsive" alt="Interviewxp"/></div> -->
                           </div>
                        </div>
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>

    <script type="text/javascript">
         $('.main-content').click(function(){
           $(this).next('.sub-content').slideToggle();
           $(this).find('.arrow i').toggleClass('fa-chevron-down fa-chevron-up')
         });
      </script>
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
      <!--footer section-->
@endsection

