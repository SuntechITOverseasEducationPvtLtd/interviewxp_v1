@extends('front.layout.main')
@section('middle_content')
@inject('common', 'App\Common\Services\CommonService')  
@inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
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

                          
                              <div class="row">
                                 <div class="col-xs-8">
                                    <h2 class="my-profile">{{$module_title}}</h2>
                                 </div>
                                 <div class="col-xs-4">
                                    
                                 </div>

                              </div>
                              <div class="outer-box">
                                 <div class="table-search-pati section1-tab">
                                    <div class="table-responsive">
                                       <table class="table">
                                          <tbody>
                                          <thead>
                                             <tr class="top-strip-table">
                                               
                                                <td>S.No.</td>
                                                <td>Description</td>
                                                <td>Exp.Level</td>
                                                <td>Purchased date</td>
                                             </tr>
                                          </thead>
                                        
                                         @if(isset($purchase_history) && sizeof($purchase_history)>0)
                                         
                                         @foreach($purchase_history as $key => $data)
                                         
                                          <thead class="strips">
                                             <tr class="main-content">
                                                
                                                <td>{{$key+1}}</td>       

                                                <td>{{ ucfirst($data['skill_name'])." ".'Real Time Interview Questions & Answers'}}</td>
                                                 <td>{{$data['experience_level'] != 'NA' ? $data['experience_level'].' Years' : 'NA'}}</td>
                                                <td>{{date('d M Y', strtotime($data['created_at']))}}</td>
                                                <td class="arrow"><i class="fa fa-chevron-down" aria-hidden="true"></i></td>
                                             </tr>

                                             <?php
                                                $transactionHistory = $common->getTransactionHistory($data['order_id']);
                                                if(count($transactionHistory) > 0)
                                                {
                                                  foreach ($transactionHistory as $item => $transactionItem) {
                                             ?>
                                             
                                               @if($transactionItem->item_type == "Interview_qa")
                                               <tr class="sub-content" style="display:none;">
                                                <td colspan="9">
                                                   <p>
                                                      <i class="fa fa-check" aria-hidden="true"></i>
                                                      <a href="{{url('/')}}/user/view_learn/{{ base64_encode($data['id']) }}/referencebook" target="_blank"><span> Interview Refference Book</span>
                                                      <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                   </p>
                                                   </td>
                                                  </tr>
                                                 @endif

                                                 @if($transactionItem->item_type == "Company")
                                                    <?php
                                                    $company_id = $transactionItem->item_id;
                                                    $interview_id = $transactionItem->interview_id;
                                                    $interview_attachment =  DB::table('interview_detail')->where(['company_id'=>$company_id, 'interview_id'=>$interview_id])->get();
                                                    $NameCompany = DB::table('company_master')
                                                                  ->where('company_id', '=', $company_id)
                                                                  ->first();
                                                                  
                                                    $topicName = ucwords($NameCompany->company_name).' ('.ucwords($interview_attachment[0]->company_location).')';
                                                    ?>
                                                   <tr class="sub-content" style="display:none;">
                                                   <td colspan="9"> 
                                                   <p>
                                                      <i class="fa fa-check" aria-hidden="true"></i>
                                                       <a href="{{url('/')}}/user/view_learn/{{ base64_encode($data['id'])}}/company" target="_blank">
                                                      <span> {{$topicName}} Company's Q & A</span>
                                                      <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                   </p>
                                                   </td>
                                                  </tr>
                                                 @endif 
                                                 
                                                 @if($transactionItem->item_type == "Work_exp")
                                                    <tr class="sub-content" style="display:none;">
                                                    <td colspan="9">
                                                   <p>
                                                      <i class="fa fa-check" aria-hidden="true"></i>
                                                       <a href="{{url('/')}}/user/view_learn/{{ base64_encode($data['id'])}}/rwe_tickets" target="_blank">
                                                      <span>{{$transactionItem->item_id}} Real Time Work Experience (Tickets, Tasks, Issues)</span>
                                                      <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                   </p>
                                                   </td>
                                                  </tr>
                                                 @endif 
                                                
                                             <?php
                                                }
                                              }
                                             ?>
                                             
                                          </thead>
                                         @endforeach
                                         @else
                                          <tr><td colspan="6"><div style="color:red;text-align:center;">No Records found...  </div></td></tr>
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
                                   {{$purchase_history->render()}}
                                   </div>
                                 <!-- end -->              
                              </div>
                            {!! Form::close() !!}
<!--
                             @if(isset($arr_advertise) && sizeof($arr_advertise)) 
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
-->

                            <!--   <div class="sample-img2"><img src="{{url('/')}}/images/sample-img3.jpg" class="img-responsive" alt="Interviewxp"/></div>
 -->
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
         $('.main-content > .arrow').click(function(){
           $(this).parent().next('.sub-content').slideToggle();
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

