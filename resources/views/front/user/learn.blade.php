@extends('front.layout.main')
@section('middle_content')
@inject('common', 'App\Common\Services\CommonService')  
@inject('interviewDetailModel', 'App\Models\InterviewDetailModel')

      <div id="after-login-header" class="after-login"></div>
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

      <div class="container max-height">
         <div class="row">
            <div class="col-lg-12">
               <div class="middle-section min-height">
                  <div class="user-dashbord">
                     <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <div class="middle part">

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
                                                 <td></td>
                                             </tr>
                                          </thead>
                                        
                                         @if(isset($purchase_history) && sizeof($purchase_history)>0)
                                         
                                         @foreach($purchase_history as $key => $data)
                                         
                                         <?php
                                            $skillnames = DB::table('member_interview')->where('id',$data['ref_interview_id'])->first();
                                            
                                             ?>
                                         <?php if($key%2==0) { $baclass="asgray"; }  else {  $baclass="aswhite"; } ?>
                                          <thead class="strips">
                                             <tr class="main-content {{$baclass}}"   >
                                                
                                                <td>{{$key+1}}</td>       

                                                <td  class="cl1">{{ ucfirst($skillnames->allskill)." ".'Real Time Interview Questions & Answers'}}</td>
                                                <td>{{$data['experience_level'] != 'NA' ? $data['experience_level'].' Years' : 'NA'}}</td>
                                                <td>{{date('d M Y', strtotime($data['created_at']))}}</td>
                                                <td class="arrow" rel="sub-content{{$data['order_id']}}"><i class="fa fa-chevron-down" aria-hidden="true"></i></td>
                                             </tr>

                                             <?php
                                                $transactionHistory = $common->getTransactionHistory($data['order_id']);
                                                if(count($transactionHistory) > 0)
                                                {

                                                  foreach ($transactionHistory as $item => $transactionItem) {
                                                    if($transactionItem->combo_status == 1)
                                                    {
                                                      $combo = $common->getCombos($transactionItem->order_id, false, true, 'user');
                                                      $description = $combo['comboStr'];
                                                                                                          }
                                                    else
                                                    { 
                                                              $description = '';
                                                              $class = $transactionItem->id;
                                                      if($transactionItem->item_type == 'Interview_qa')
                                                      {
                                                           $description = '<a href="'.url('/').'/user/view_learn/'.base64_encode($transactionItem->trans_id).'/referencebook" target="_blank"><p>&nbsp;&nbsp;*&nbsp;Interview QA</p><i class="fa fa-eye" aria-hidden="true"></i></a>';
                                                      }
                                                      else if($transactionItem->item_type == 'Company')
                                                      {
                                                          $company_id = $transactionItem->item_id;
                                                          $item_name = '';
                                                          $interview_id = $transactionItem->interview_id;
                                                          $companyDetails = $interviewDetailModel->where(['interview_id'=>$interview_id, 'company_id'=>$company_id])->first();
                                                          if($companyDetails)
                                                          {
                                                            $item_name = $companyDetails->company_name.' ( '.$companyDetails->company_location.' )';
                                                          }
                                                          
                                                          $description .= '<a href="'.url("/").'/user/view_learn/'.base64_encode($transactionItem->trans_id).'/company" target="_blank"><p>&nbsp;&nbsp;*&nbsp;'.$item_name.'</p><i class="fa fa-eye" aria-hidden="true"></i></a>';
                                                      }
                                                      else if($transactionItem->item_type == 'Work_exp')
                                                      {
                                                           $description = '<a href="'.url("/").'/user/view_learn/'.base64_encode($transactionItem->trans_id).'/rwe_tickets" target="_blank"><p>&nbsp;&nbsp;*&nbsp;Real Time Issues-'.$transactionItem->item_id.'</p><i class="fa fa-eye" aria-hidden="true"></i></a>';
                                                      }
                                                      else if($transactionItem->item_type == 'Coach')
                                                      {
                                                         $description = '<p>&nbsp;&nbsp;*&nbsp;Interview Coaching</p>'; 
                                                      }



                                                    }  

                                                   
                                             ?>
                                              <?php if($item%2==0) { $baclasss="asgreen"; }  else {  $baclasss="aswhite"; } ?>
                                              
                                             <tr class="sub-content cl2 {{$baclasss}} sub-content{{$data['order_id']}}" >
                                                <td class="cl3"></td>
                                                <td colspan="2" class="cl4">
                                                   {!!$description!!}
                                                </td>
                                                <td colspan="3" class="cl5"></td>
                                              </tr>
                                                
                                             <?php
                                                }
                                              }
                                             ?>
                                             
                                          </thead>
                                          
                                           <thead>
 <tr class="top-strip-table cl6" >
<td class="paddng"></td>  <td class="paddng"></td>  <td class="paddng"></td>  <td class="paddng"></td>    <td class="paddng"></td>    </tr>


                                          </thead>
                                          
                                         @endforeach
                                         @else
                                          <tr><td colspan="6"><div class="cl6">No Records found...  </div></td></tr>
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
<style type="text/css">
  .sub-content td a p{
    width: 60%;
    float: left;
  }
  .sub-content td a i{
    float: left;
  }
  .table-search-pati table tr td {
    border: 0px solid !important; } 
.sub-content td a p {
    width: 60%;
    float: left;
    font-size: 13px;
    margin-bottom: 3px;
}

.table .sub-content p {
    cursor: pointer;
    margin-bottom: 3px;
    font-size: 13px;
}
.table-search-pati table tr td {
    
    text-align: left;
     
}
.cl1 {text-align: left;}
.cl2 {display:none; }
.cl3 {border-bottom: 1px solid #f1f1f1  !important; }
.cl4 {text-align: left;
    padding-top: 5px;
    border-bottom: 1px solid #f1f1f1 !important;
    padding-bottom: 0px; }
.cl5 {border-bottom: 1px solid #f1f1f1  !important; }
.cl6 { height: 1px; background: #f6f6f6; }
.paddng {padding: 0px; }
.cl6 {color:red;text-align:center;}
</style>      
    <script type="text/javascript">
         $('.main-content > .arrow').click(function(){
          var rel = $(this).attr('rel');          
           $('.'+rel).slideToggle();
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

