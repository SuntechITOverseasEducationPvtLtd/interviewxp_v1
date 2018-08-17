    @extends('admin.layout.master')                


    @section('main_content')
    @inject('common', 'App\Common\Services\CommonService')
    @inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
    @inject('reviewRatingModel', 'App\Models\ReviewRatingModel')
    @inject('userDetailModel', 'App\Models\UserDetailModel')
    <!-- BEGIN Page Title -->
    <style>.table-responsive p {
    float: left;
    margin-bottom: 0px;
}
.table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 6px 4px; } </style>
<div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i> {{ isset($page_title)?$page_title:"" }}</h5>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
            </div>
 
 
 
          {{ csrf_field() }}
          @include('admin.layout._operation_status')  
          
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">
            <?php $colspan = (isset($member_id)) ? 2 : 1; 
            
             if(isset($member_id)) { $tablestriner="datatable";  $rowbgs="background: #e4e2e2 !important"; } else { $tablestr="datatable";   }
             
            ?>                  
       <table class="{{ @$tablestr }} table table-striped table-bordered">
              <thead>
                <tr style="background-color: #26A69A !important;      color: #fff;  border-color: #26A69A !important;">
                  <th>S.No</th>
                  <th colspan="{{$colspan}}">Name</th>
                  <th colspan="{{$colspan}}">Email</th>
                  <th colspan="{{$colspan}}">PH.No</th>
                  <th colspan="{{$colspan}}">Gender</th>
                  <th colspan="{{$colspan}}">No.of Skills</th>
                  <th colspan="{{$colspan}}">No.of R&R Pendings</th>
                  @if(!isset($member_id))
                  <th style="min-width:140px !important;">Action</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                
                @if(isset($arr_review_rating) && sizeof($arr_review_rating)>0)
                  @foreach($arr_review_rating as $key => $data)
                  <?php  
                    $pendingReviews = $reviewRatingModel->select(DB::raw('COUNT(id) as no_of_rr_pending'))->where(['member_user_id'=>$data['member_user_id'], 'approve_status'=>'pending'])->where('trans_history_id', '!=', 0)->get();
                  ?>
                  <tr style="{{ @$rowbgs }}">
                    <td>{{$key+1}}</td>
                    <td colspan="{{$colspan}}"> {{ $data['member_detail']['first_name'] }} {{ $data['member_detail']['last_name'] }} </td> 
                    <td colspan="{{$colspan}}">{{$data['member_detail']['email'] or 'NA'}}</td>
                    <td colspan="{{$colspan}}">{{$data['member_detail']['mobile_no'] or 'NA'}}</td>
                    
                    <td colspan="{{$colspan}}">@if($data['member_detail']['gender']=="M")Male @else Female @endif</td>  
                    <td colspan="{{$colspan}}"> <a  class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottomm" style="    width: 25px;
    padding: 0px;
    height: 25px;
    line-height: 23px;" data-popup="tooltip" title="" data-original-title="No.of R&R Pendings">{{$data['all_interview_detail'][0]['no_of_skills'] or ''}}</a></td>
                    <td colspan="{{$colspan}}"><a  class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" style="    width: 25px;
    padding: 0px;
    height: 25px;
    line-height: 23px;" data-popup="tooltip" title="" data-original-title="No.of R&R Pendings">{{$pendingReviews[0]->no_of_rr_pending or ''}} </a></td>
                    @if(!isset($member_id))
                    <td>
                        
                          <div class="forleft">
                          
                          <span> <a href="{{ $module_url_path.'/member-reviews-ratings/'.base64_encode($data['member_user_id'])}}" class="myc admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="Review Message"></i>
                        </a>  </span> <p class="myp">View</p>
                        
                        </div>
                        
                      
                    </td>  
                    @endif                  
                  </tr>
               
                  @if(isset($member_id))
                  
                      <table class="{{ @$tablestriner }} table table-striped table-bordered" style="width: 1800px;    overflow: auto;">
              <thead>
                  
                  <tr style="background: #828282; color: #fff !important;">
                    <th style="font-size: 11px;">S.No</th>
                    <th style="font-size: 11px;">Date</th>
                    <th style="font-size: 11px;">Name</th>
                    <th style="font-size: 11px;">A/c Type</th>
                    <th style="font-size: 11px;">Gender</th>
                    <th style="font-size: 11px;">Email</th>
                    <th style="font-size: 11px;">PH.No</th>
                    <th style="width:150px; font-size: 11px">Skill</th> 
                    <th style="font-size: 11px; width:700px !important;"> <div style="width:100%; float:left" class="  ppd">
                    
                    <div style="width:300px; float:left">Exp Level <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>                
                   <div style="width:100px; float:left"> Ratings   <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>       
                    <div style="width:60px; float:left">Reviews   <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>  
                    <div style="width:90px; float:left">Display Status <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>  
                   
                    <div style="width: 146px; float:left">Action <img src="{{ url('/') }}/images/asend.jpg" style="    margin-top: -6px;"></div>  
                    
                    
                    </div> </th>
                  </tr></thead>
                  <?php
                    $memberReviewsRatings = $common->getReviewsRatings($member_id);
                    if(count($memberReviewsRatings) > 0)
                    {
                    foreach($memberReviewsRatings as $key => $reviews)
                    {
                      $bgColor = ($key%2 ==1) ? 'background-color: #f6f6f6;border-top: 15px solid #fff;' : 'background-color: #f6f6f6;border-top: 15px solid #fff;';
                  ?>
                  <tr style=" background: #fafafa !important;     border-bottom: 1px solid #f1f1f1;">
                    <td style="vertical-align: top;     padding-top: 13px;"> &nbsp;&nbsp;&nbsp;{{$key+1}}</td>
                    
                    <td style="vertical-align: top;     padding-top: 13px;"><div style="width:75px;">{{ date(' d  M, Y' ,strtotime($reviews['created_at'])) }}</div></td>
                    
                    
                    
                    <td style="vertical-align: top;     padding-top: 13px;"><div style="width:100px;">{{ $reviews['user_details']['first_name'] }} {{ $reviews['user_details']['last_name'] }}</a></td>
                    <?php
                      $userData=$userDetailModel->where('user_id',$reviews->user_id)->first();
                      $role = (count($userData) > 0) ? 'User' : 'Member';
                    ?>
                    <td style="vertical-align: top;     padding-top: 13px;" >{{ $role or '' }}</td>
                    <td style="vertical-align: top;     padding-top: 13px;">@if($reviews['user_details']['gender']=="M")Male @else Female @endif</td>
                    <td style="vertical-align: top;     padding-top: 13px;">{{$reviews['user_details']['email'] or 'NA'}}</td>
                    <td style="vertical-align: top;     padding-top: 13px;">{{$reviews['user_details']['mobile_no'] or 'NA'}}</td>
                    <td style="vertical-align: top;     padding-top: 13px;"><div style="width:100px;">{{ $reviews['interview_details']['skill_name'] }}</div></td> 
                    <td style="vertical-align: top;     padding-top: 13px;">{{$reviews['interview_details']['experience_level'] or 'NA'}} 
                    
                    <br>
                    <br>
                     <?php
                    $transactionHistory = $common->getTransactionHistoryById($reviews->unique_id);

                    foreach ($transactionHistory as $key1 => $transactionItem) {
                      
                       $description = '';
					   $comboReviews = ''; 
					   $comboRatings = ''; 
					   
						if($transactionItem->combo_status == 1)
						{
							$combo = $common->getCombos($transactionItem->order_id, true, false, null, false, 'admin');
							$description = $combo['comboStr'];
							$basePrice = $combo['comboPrice'];
							$igst = $combo['comboIgst'];
							$cgst = $combo['comboCgst'];
							$sgst = $combo['comboSgst'];
							$totalAmount = $combo['comboTotal'];
							$comboReviews = $combo['comboReviews'];
							$comboRatings = $combo['comboRatings'];
						}
						else
						{
							if($transactionItem->item_type == 'Interview_qa')
							{
								 $description = '<p>&nbsp;&nbsp;*&nbsp;Interview QA</p>';
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
								
								$description .= '<p>&nbsp;&nbsp;*&nbsp;'.$item_name.'</p>';
							}
							else if($transactionItem->item_type == 'Work_exp')
							{
								 $description = '<p>&nbsp;&nbsp;*&nbsp;Real Time Issues-'.$transactionItem->item_id.'</p>';
							}
							else if($transactionItem->item_type == 'Coach')
							   $description = '<p>&nbsp;&nbsp;*&nbsp;Interview Coaching</p>';
						}

                      
                      $bgColor = 'background-color: #f6f6f6;';

                      $emptyStars = url('/')."/images/blank_star.png";           
                      $stars = url('/')."/images/star.png";
                      $reviewRating = '';
                      if($transactionItem->review_star > 0)
                      $reviewRating = $common->getReviewRatings($transactionItem->review_star);
					  if($key1%2 ==0) { $bgcolrs="#d8d8d8ad  !important";} else {$bgcolrs="#fff !important"; }
                  ?>
                  <div style="width:100%; float:left;   padding: 6px 0px 3px;; background-color: {{$bgcolrs}}; ">
                      
                      <div style="width:300px; float:left">
                     {!! $description !!} <!--@if($transactionItem->combo_status == 1)<span style="color: #FF8000;padding-left: 7px;">(Combo)</span>@endif--> </div>
                     
                     
              <div style="width:120px; float:left">
                        <?php if(!empty($comboRatings)) {  echo $comboRatings;} elseif(isset($transactionItem->review_star)) { for($i=1; $i<=5; $i++) { if($i <= $transactionItem->review_star) { echo '<img src="'.$stars.'" title="'.$reviewRating.'"/>'; } else { echo '<img src="'.$emptyStars.'" title="'.$reviewRating.'"/>'; } }  } else { for($i=1; $i<=5; $i++) { echo '<img src="'.$emptyStars.'" title=""/>'; } } ?>
                     
 </div>
 <div style="width:130px; float:left">
                        @if(!empty($comboReviews)) {!! $comboReviews !!}  @elseif(isset($transactionItem->review_message))
                        
                        <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="{{ $transactionItem->review_message}}" style="    width: 25px;
    height: 25px;
    font-size: 12px;
    line-height: 0px;
    text-align: center;
    padding: 6px 0px;"><i class="icon-comments" style="font-size: 12px;"></i></a>
                        
                        @if(isset($transactionItem->member_reply)) <span class="label bg-success heading-text" style="background: #26A69A!important;border: #26A69A!important;cursor:pointer" title="{{$transactionItem->member_reply}}">Member Replied</span>@endif @else <img src="{{url('/')}}/images/comment-alt-regular.svg"  style="width: 19px;    cursor: pointer;" title="{{ $transactionItem->review_message}}" /> @endif </div>
                        
                        <div style="width:140px; float:left">
                        
                  @if($transactionItem->approve_status=='pending')
                      
                      <span class="label bg-success heading-text" style="background: #ff7043!important;
    border: #ff7043!important;">Pending for Live</span>
                     @elseif($transactionItem->approve_status=='member')
                      
                      <span class="label bg-success heading-text" style="background: #103b74!important;
    border: #103b74!important">Displayed to Member</span>
                     @elseif($transactionItem->approve_status=='both' || $transactionItem->approve_status=='user')
                      
                      <span class="label bg-success heading-text">Live</span>
                     @endif 
                     </div>
                     
                    <div style="width:100px; float:left">
                        @if($transactionItem->review_star > 0)
                      <div style="width:200px;">
                       <span><button style="      height: 25px;
    line-height: 7px;
    " value="user" class="btn btn-success btn-rounded" onclick="return approve_change(this.value,{{$transactionItem->review_id}})"
                       title="Online"><i class="icon-checkmark4" aria-hidden="true" title="Online"></i> Online</button>
                         </span>
                         @if(isset($transactionItem->member_reply) && $transactionItem->combo_status != 1)
                          <span class="label bg-success heading-text" style="background: #26A69A!important;
    border: #26A69A!important;cursor:pointer" title="{{$transactionItem->member_reply}}">Member Replied<!--<button style="        height: 25px;
    line-height: 7px;
    background: #103b74;
    border-color: #103b74;" value="member" class="btn btn-success btn-rounded" onclick="return approve_change(this.value,{{$transactionItem->review_id}})"
                       title="Member"><i class="icon-user" aria-hidden="true" title="Member"></i> Member</button>-->
						</span>@endif
                         
                         </div>
                         
                      @endif 
                      </div>
                      
                      
                      
                      </div>
                  <?php 
					if($transactionItem->combo_status == 1)
					{
					 break;
					}
                  }
                    
                  ?>
                    
                        
                        
                        
                 
                    
                    </td>
                  </tr>
                 
                  <?php } } ?>

                  @endif
                  @endforeach
                @endif
                 
              </tbody>
            </table>
            
            
               </tbody>
            </table>
          </div>
        <div> </div>
           
      </div>
  </div>
</div>
<?php $member_id = (empty($member_id)) ? '' : $member_id; ?>
<!-- END Main Content -->
<script>
function approve_change(val,id) {

      if(confirm('Are you sure to perform this action?'))
      {         
            var token         = $('input[name=_token]').val();
            var approve_id    = id;
            var approve_value = val;
            var success_link  = "{{url('/')}}/admin/review_rating/member-reviews-ratings/{{base64_encode($member_id)}}";
            //alert(approve_value);
            $.ajax({
            url: "{{url('/')}}/admin/review_rating/approve_change",
            type: "POST",
            async: false,
            data: { _token:token,approve_status:approve_value,id:approve_id},
            dataType: "json"
          }).done(function(result){
             
              if(result.status=="SUCCESS")
              {
                 location.href = success_link;
              }
              if(result.status=="ERROR")
              {
                location.href = success_link;
              }
          });
       }
     return false;   
}
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table_module').DataTable( {
            "aoColumns": [
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },  
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false }
            ]

        });
    });

    function show_details(url)
    { 
       
        window.location.href = url;
    } 

    function confirm_delete()
    { 
       if(confirm('Are you sure to delete this record?'))
       {
         return true;
       }
       return false;
    }
    
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
<style type="text/css">
  .table-advance tbody > tr:nth-child(even) {
      border-left: none;
  }
  .table-advance tbody > tr {
      border-left: none;
  }
  th {
    text-align: left;
    font-size: 15px;
  }
  .table-responsive p{
    float: left;
  }
	p.combo-reviews {
		margin-top: 18px;
	}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js"></script>
    <script src="https://www.jquery-az.com/boots/js/datatables/datatables.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      $('.datatable').dataTable({
        "sPaginationType": "bs_full"
      }); 
      $('.datatable').each(function(){
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.addClass('form-control input-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.addClass('form-control input-sm');
      });
    });
    </script>
@stop                    


