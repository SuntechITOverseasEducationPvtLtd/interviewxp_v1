    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="http://cloudforcehub.com/interviewxp/themeassets/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="http://cloudforcehub.com/interviewxp/themeassets/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="http://cloudforcehub.com/interviewxp/themeassets/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="http://cloudforcehub.com/interviewxp/themeassets/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="http://cloudforcehub.com/interviewxp/themeassets/assets/css/colors.css" rel="stylesheet" type="text/css">
     <style type="text/css">.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    vertical-align: middle;
    font-size: 13px;
}
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

.nav-tabs li.active {
    background: #f5f5f5 !important;
    height: 200px !important;
    padding: 5px !important;
}

.nav-tabs > li {
    display: inline-block;
    font-size: 13px ;
    background: #f5f5f566 !important;
    margin: 0px 5px !important;
    height: 200px !important;
    padding: 5px !important;
}



                        </style>
<div class="box">
         <!--<div class="box-title">
            <h3><i class="fa fa-eye"></i>Real Time Work Experience (Tickets, Tasks, Issues)</h3>
            <div class="box-tool">
            </div>
         </div>-->

        <div class="box-content">
       <!--   @include('admin.layout._operation_status')   -->
         {!! Form::open([ 'url' => '',
         'method'=>'POST',
         'enctype' =>'multipart/form-data',   
         'class'=>'form-horizontal', 
         'id'=>'frm_manage' 
         ]) !!}
         {{ csrf_field() }}
         <div class="clearfix"></div>
         <div class="table-responsive" style="border:0">
            <input type="hidden" name="multi_interviews_company" value="" />
            <table class="datatable table table-striped table-bordered">
               <thead>
                     <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                    
                    
                     <th>S.No</th>
                     <th>Date Purchased </th>
                     <th>Name</th>
                     <th>PH.No</th>
                     <th>Email</th>
                     <th>Ratings</th>
                     <th>Reviews</th>
                     <th>Status</th>
                     
                  </tr>
               </thead>
               <?php $i=1; ?>
               <tbody>
                  <?php
                  
                  $allidset=explode('_',$requiredids);
                   $reviewInfoObj = DB::table('review_rating')
                     ->join('transaction', 'transaction.ticket_unique_id', '=', 'review_rating.unique_id')
                     ->join('users', 'users.id', '=', 'review_rating.user_id')
                     ->where('transaction.member_user_id', $allidset[0])
                     ->where('review_rating.interview_id', $allidset[1])
                     ->where('transaction.skill_id', $allidset[2])
                     ->where(['ReviewType'=>'Interview Coaching'])
                     ->where(function ($query) {
                         $query->where('approve_status', '=', 'member')
                               ->orWhere('approve_status', '=', 'user');
                           })
                     ->get();
                  ?>
                  @if(isset($reviewInfoObj) && sizeof($reviewInfoObj)>0)
                   @foreach($reviewInfoObj as $reviewInfo)
                   <?php
                      if(isset($reviewInfo)){
                          $star=$reviewInfo->review_star;
                          $msg=$reviewInfo->review_message;
                          if($star <=2)
                            $staus="Not Satisfied";
                          else
                            $staus="Completed";
                        }else{
                          $star="-";
                          $msg="";
                          $staus="Pending";
                        }
                      $reviewStatusArray = [1=>"I hate it", 2=>"I don't like it", 3=>"Its Okay", 4=>"I like it", 5=>"I love it"];  
                      $emptyStars = url('/')."/images/blank_star.png";           
                      $stars = url('/')."/images/star.png";
                   ?>
                  <tr>
                    
                     <td>{{$i++}}</td>
                     <td>{{date('j M, Y, g:i A T',strtotime($reviewInfo->created_at))}}</td>
                     <td>{{$reviewInfo->first_name}} {{$reviewInfo->last_name}}</td>
                     <td>{{$reviewInfo->mobile_no}}</td>
                     <td>{{$reviewInfo->email}}</td>
                     <td><?php if($star) { for($i=1; $i<=5; $i++) { if($i <= $star) { echo '<img src="'.$stars.'" title="'.$reviewStatusArray[$star].'"/>'; } else { echo '<img src="'.$emptyStars.'" title="'.$reviewStatusArray[$star].'"/>'; } }  } else { for($i=1; $i<=5; $i++) { echo '<img src="'.$emptyStars.'"/>'; } } ?>
                     </td>
                  <td title="{{$msg}}" style="    text-align: center;"> 
                     
                     
                     <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="{{$msg}}" style="    width: 25px;
    height: 25px;
    font-size: 12px;
    line-height: 0px;
    text-align: center;
    padding: 6px 0px;"><i class="icon-comments" style="font-size: 12px;"></i></a>
                     </td>
                        <?php $status = $allidset[3]; ?> 
                     <td>{{$staus}}</td>
                  </tr>
                  @endforeach
                  @else
                      <tr><td colspan="7"><div style="color:red;text-align:center;">No Records Found</div></td></tr>
                  @endif
               </tbody>
            </table>
         </div>
         {!! Form::close() !!}
      </div>


      </div>
      
      
      
      	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
		