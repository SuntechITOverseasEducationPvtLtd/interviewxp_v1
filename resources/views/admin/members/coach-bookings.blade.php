    @extends('admin.layout.master')                


    @section('main_content')
    @inject('common', 'App\Common\Services\CommonService')
    @inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
    @inject('transactionModel', 'App\Models\TransactionModel')
    @inject('userDetailModel', 'App\Models\UserDetailModel')
    <!-- BEGIN Page Title -->
 <style type="text/css">
                          .rounded-box {
                                  border-radius: 0%;
                                  height: 67px;
                                  overflow: hidden;
                                  width: 80px;
                                  float: left;
                          }
                          .rounded-box img {
                              border-radius: 50%;
                              float: left;
                              height: 73%;
                              width: 73%;
                          }
                           .proimgset {
                                height: 60px !important;
    width: 60px !important;
                          } .pagination { float:right;}
                           .table td {   padding: 2px 7px !important; }
                           p {
    margin: 0 0 3px; }
    h4.value {line-height: 14px;
    font-size: 13px;
    color: #13c0b2;
    font-weight: bold;}
    
    label {
    margin-bottom: 7px;
    font-weight: 400;
    line-height: 30px;
}
                        </style>



<div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i> {{ isset($page_title)?$page_title:"" }}</h5>
              <div class="heading-elements">
               <div class="btn-group"> 
             
            </div>
                      </div>
            </div>
      <div class="box-content">
        <div class="box-content">
          {{ csrf_field() }}
          @include('admin.layout._operation_status')  
          
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">
            <?php $colspan = (isset($member_id)) ? 2 : 1;
              if(isset($member_id)) { $tablestriner="datatable";  $rowbgs="background: #e4e2e2 !important"; } else { $tablestr="datatable";   }
            ?> 
            
            
           <table class="{{ @$tablestr }} table table-striped table-bordered">
              <thead>
                <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;" role="row">
                  <th  >S.No</th>
                  <th  >Name</th>
                  <th  >Email</th>
                  <th  >PH.No</th>
                  <th  >Gender</th>
                  <th   style=" text-align: center;">No.of Skills</th>
                  <th   style=" text-align: center;">No.of Bookings</th>
                  @if(!isset($member_id))
                  <th style="min-width:140px !important;">Action</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                
                @if(isset($arr_review_rating) && sizeof($arr_review_rating)>0)
                  @foreach($arr_review_rating as $key => $data)
                  <?php  
                    $bookings = $transactionModel->join('transaction_history as th','th.trans_id','=','transaction.id')->where(['transaction.member_user_id'=>$data['member_user_id'], 'transaction.payment_status'=>'paid','th.item_type'=>'Coach'])->count();
                    //dd($data['member_user_id']);
                  ?>
                  <tr style="{{ @$rowbgs }}">
                    <td >{{$key+1}}</td>
                    <td > {{ $data['member_detail']['first_name'] }} {{ $data['member_detail']['last_name'] }} </td> 
                    <td >{{$data['member_detail']['email'] or 'NA'}}</td>
                    <td >{{$data['member_detail']['mobile_no'] or 'NA'}}</td>
                    
                    <td >@if($data['member_detail']['gender']=="M")Male @else Female @endif</td>  
                    <td  style="    text-align: center;" >
                    
                        <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" style=" font-weight: bold;width: 25px;    color: #FF7043 !important;
    border-color: #FF7043 !important; height: 25px;  padding: 1px 0px;;"
                    data-popup="tooltip" data-original-title="No.of Skills">  {{$data['all_interview_detail'][0]['no_of_skills'] or ''}}</a>
                    </td>
                    <td  style="    text-align: center;">
                    <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" style=" font-weight: bold;width: 25px;height: 25px;  padding: 1px 0px;;"
                    data-popup="tooltip" data-original-title="No.of Bookings">  {{$bookings or ''}}</a>
                    
                    </td>
                    @if(!isset($member_id))
                    <td>
                      
                      
                      
                      <span> <a href="{{ $module_url_path.'/coach-bookings/'.base64_encode($data['member_user_id'])}}" class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom myc">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a> <p class="myp" style="    float: none;">View </p></span>
                        
                        
                        
                    </td>  
                    @endif                  
                  </tr>
                  @if(isset($member_id))
                  
                  
                      <table class="{{ @$tablestriner }} table table-striped table-bordered" style="width: 1800px;    overflow: auto;">
              <thead>
                  
                   <tr class="bg-teal-400" style="        background-color: #9ad4a1 !important;
    border-color: #f5f5f5 !important;" role="row">
                    <th style="  font-size: 11px !important;">S.No</th>
                    <th style="  font-size: 11px !important;">Date</th>
                    <th style="  font-size: 11px !important;">Name</th>
                    <th style="  font-size: 11px !important;">A/c Type</th>
                    <th style="  font-size: 11px !important;">Gender</th>
                    <th style="  font-size: 11px !important;">Email</th>
                    <th style="  font-size: 11px !important;">PH.No</th>
                    <th style="width: 85px; font-size: 11px !important">Skill</th> 
                    <th style="  font-size: 11px !important;">Exp Level</th>
                    <th style="  font-size: 11px !important;">Amount Paid</th>
                    <th style="  font-size: 11px !important;">Status</th>
                    <th style="width: 100px; font-size: 11px !important">Ratings</th>
                    <th style="  font-size: 11px !important;">Reviews</th>                    
                  </tr>
                  
                  </thead>
                  <?php
                    $memberReviewsRatings = $common->getAdminMemberCoaches($member_id, $data['skill_id']);
                    if(count($memberReviewsRatings) > 0)
                    {
                    foreach($memberReviewsRatings as $key => $reviews)
                    {
                      //print_r($reviews['coach_reviews_ratings']['review_star']);
                      $bgColor = ($key%2 ==1) ? 'background-color: #f6f6f6;border-top: 15px solid #fff;' : 'background-color: #f6f6f6;border-top: 15px solid #fff;';

                      $emptyStars = url('/')."/images/blank_star.png";           
                      $stars = url('/')."/images/star.png";
                      $reviewRating = '';
                      if(isset($reviews['coach_reviews_ratings']['review_star']) && $reviews['coach_reviews_ratings']['review_star'] > 0)
                      $reviewRating = $common->getReviewRatings($reviews['coach_reviews_ratings']['review_star']);
                  ?>
                  <tr>
                    <td >{{$key+1}}</td>
                    <td >{{ date(' d  M, Y' ,strtotime($reviews['created_at'])) }}</td>
                    <td >{{ $reviews['user_detail']['first_name'] }} {{ $reviews['user_detail']['last_name'] }}</td>
                    <?php
                      $userData=$userDetailModel->where('user_id',$reviews->user_id)->first();
                      $role = (count($userData) > 0) ? 'User' : 'Member';
                    ?>
                    <td >{{ $role or '' }}</td>
                    <td >@if($reviews['user_detail']['gender']=="M")Male @else Female @endif</td>
                    <td >{{$reviews['user_detail']['email'] or 'NA'}}</td>
                    <td >{{$reviews['user_detail']['mobile_no'] or 'NA'}}</td>
                    <td >{{ $reviews['interview_detail']['allskill'] }}</td> 
                    <td >{{$reviews['interview_detail']['experience_level'] or 'NA'}}</td>
                    <td >@if(count($reviews['transaction_history']) > 0) {{$reviews['transaction_history'][0]['item_price'] or ''}}@endif</td>
                    <td >
                      <?php if(count($reviews['transaction_history']) > 0) { ?>
                          @if(isset($reviews['transaction_history'][0]['payment_status']) && $reviews['transaction_history'][0]['payment_status'] == 'unpaid')  
                           <span class="label bg-success-400" style="    background-color: #ff7043;
    border-color: #ff7043;">Pending</span>
                          @elseif(isset($reviews['transaction_history'][0]['payment_status']) && $reviews['transaction_history'][0]['payment_status'] == 'paid')
                           <span class="label bg-success-400">Completed</span>
                          @elseif(isset($reviews['transaction_history'][0]['payment_status']) && $reviews['transaction_history'][0]['payment_status'] == 'refunded')
                           <span class="label bg-success-400" style="background-color: #656161;
    border-color: #656161;">Refunded</span>
                          @endif
                    <?php } ?>
                    </td>
                    <td >
                       <div style="width:100px;"> <?php if(isset($reviews['coach_reviews_ratings']['review_star'])) { for($i=1; $i<=5; $i++) { if($i <= $reviews['coach_reviews_ratings']['review_star']) { echo '<img src="'.$stars.'" title="'.$reviewRating.'"/>'; } else { echo '<img src="'.$emptyStars.'" title="'.$reviewRating.'"/>'; } }  } else { for($i=1; $i<=5; $i++) { echo '<img src="'.$emptyStars.'" title=""/>'; } } ?>
                     </div> </td>
                      <td >
                        @if(isset($reviews['coach_reviews_ratings']['review_message']))
                        
                        <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom myc" data-popup="tooltip" data-original-title="{{ $reviews['coach_reviews_ratings']['review_message']}}" >

                          <i class="icon-comments" style="color: green;;cursor: pointer;" ></i> </a>
                        
                        
                        @endif
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


