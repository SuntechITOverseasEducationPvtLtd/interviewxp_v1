    @extends('admin.layout.master')                


    @section('main_content')
    @inject('common', 'App\Common\Services\CommonService')
    @inject('interviewDetailModel', 'App\Models\InterviewDetailModel')
    @inject('memberInterviewModel', 'App\Models\MemberInterviewModel')
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
                          }
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
          {{ csrf_field() }}
          @include('admin.layout._operation_status')  
          
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">
            <?php $colspan = (isset($member_id)) ? 2 : 1; ?>                  
            <table class="datatable table table-striped table-bordered">
              <thead>
              <tr class="bg-teal-400" style="        background-color: #9ad4a1 !important;
    border-color: #f5f5f5 !important;" role="row">
                  <th>SN</th>
                  <th>Name</th>
                  <th>A/c Type</th>
                  <th>Email</th>
                  <th>PH.No</th>
                  <th>Gender</th>
                  <th>Skill</th>
                  <th>Exp Level</th>
                  <th>Requested Date</th>
                  <th>Sent Date</th>
                  <th>Booked Date</th>
                  <th>Status</th>
                  <th>Ratings</th>
                  <th>Reviews</th>
                </tr>
              </thead>
              <tbody>
                
                @if(isset($arr_coach_notifications) && sizeof($arr_coach_notifications)>0)
                  @foreach($arr_coach_notifications as $key => $data)
                  
                  <?php
                      $emptyStars = url('/')."/images/blank_star.png";           
                      $stars = url('/')."/images/star.png";
                      $reviewRating = '';
                      if(isset($data['coach_reviews_ratings']['review_star']) && $data['coach_reviews_ratings']['review_star'] > 0)
                      $reviewRating = $common->getReviewRatings($data['coach_reviews_ratings']['review_star']);
                  ?>
                  <tr>
                    <td>{{$key+1}}</td>
                    <td colspan="{{$colspan}}"> {{ $data['user_detail']['first_name'] }} {{ $data['user_detail']['last_name'] }} </td> 
                    <?php
                      $userData=$userDetailModel->where('user_id',$data['user_id'])->first();
                      $role = (count($userData) > 0) ? 'User' : 'Member';
                    ?>
                    <td>{{ $role or '' }}</td>
                    <td>{{$data['user_detail']['email'] or 'NA'}}</td>
                    <td>{{$data['user_detail']['mobile_no'] or 'NA'}}</td>                    
                    <td>@if($data['user_detail']['gender']=="M")Male @else Female @endif</td>  
                    <td>{{$data['interview_detail']['skill_name'] }}</td> 
                    <td>{{$data['interview_detail']['experience_level'] or 'NA'}}</td>
                   <td>{{ date('j M, Y, g:i A T' ,strtotime($data['updated_at'])) }}</td>
                    <td>{{($data['email_sent_date'] != '0000-00-00 00:00:00') ? date('j M, Y, g:i A T' ,strtotime($data['email_sent_date'])) : '' }}</td>                                      
                    <td>{{ ($data['booked_date'] != '0000-00-00 00:00:00') ? date('j M, Y, g:i A T' ,strtotime($data['booked_date'])) :'' }}</td>                                      
                    <td>@if($data['booked_date'] != '0000-00-00 00:00:00') Booked @elseif($data['email_sent_date'] != '0000-00-00 00:00:00') Email Sent @elseif($data['status']==1) Pending 
                    @else Deleted @endif</td>                                      
                    <td>
                      <?php if(isset($data['coach_reviews_ratings']['review_star'])) { for($i=1; $i<=5; $i++) { if($i <= $data['coach_reviews_ratings']['review_star']) { echo '<img src="'.$stars.'" title="'.$reviewRating.'"/>'; } else { echo '<img src="'.$emptyStars.'" title="'.$reviewRating.'"/>'; } }  } else if($data['booked_date'] != '0000-00-00 00:00:00') { for($i=1; $i<=5; $i++) { echo '<img src="'.$emptyStars.'" title=""/>'; } } ?>
                    </td>                                      
                    <td>
                          @if(isset($data['coach_reviews_ratings']['review_message']))<i class="icon-comments" style="color: #337ab7;;cursor: pointer;" title="{{ $data['coach_reviews_ratings']['review_message']}}"></i> @endif
                  
                    </td>                                      
                  </tr>
                 
                  @endforeach
                @endif
                 
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


