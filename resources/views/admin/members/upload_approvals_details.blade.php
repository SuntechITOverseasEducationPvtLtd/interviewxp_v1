@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->

		<script type="text/javascript">
$(document).ready(function(){
    
   $(document).on('click', '.videoidtake', function() {  
       
       $idvalue=$(this).attr('id');  
       
       
       $('.videouploadidhere').html('<iframe width="100%" height="315" src="https://www.youtube.com/embed/'+$idvalue+'?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" ></iframe>');
       
   });
   
   $(document).on('click', '.close', function() {   $('.videouploadidhere').html(''); });
   
});
  
  
    </script>
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
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<h2 style="font-size: 17px;
    padding-left: 26px;
    background: #17b0a4;
    width: 98%;
    margin-left: 1%;
    padding: 5px 0px;
    color: #fff;"> &nbsp;&nbsp;{{$arr_interview_member['id']}})  {{$arr_interview_member['allskill']}}
@if($arr_interview_member['experience_level'] == 'NA')
{{$arr_interview_member['allskill']}} interview questions & answers 
@else
{{$arr_interview_member['allskill']}} real time interview questions & answers ({{$arr_interview_member['experience_level']}} year exp)
@endif
</h2>
<br>
<div class="col-sm-12">
  <div class="col-sm-3 ua_details_left" style="    background: whitesmoke;
    padding: 3px;">
    <style type="text/css">
      .ua_details_left{
        background-color: #fff;              
      }
      .ua_details_left p{
        margin:0 0 2px 0;
        color: #888;
      }
      .rounded-box {
          border-radius: 50%;
          height: 72px;
          overflow: hidden;
          width: 72px;
          float: left;
      }
      .rounded-box img {
          border-radius: 50%;
          float: left;
          height: 100%;
          width: 100%;
      }
      .ua_details_left hr{
            margin-top: 5px;
            margin-bottom: 3px;
            margin-right: 3px;
      }
      .ua_details_left .padding{
        padding: 3px 0px 3px 0px;
        text-align: center;
        font-size: 13px;
      }
      .circle {
            padding: 2px 6px 2px 6px;
            border: 1px solid #525252;
            margin-left: 2px;
            vertical-align: middle;
            border-radius: 50%;
            position: relative;
            cursor: pointer;
            text-align: center;
            width: 100%;
       }           
       .circle span{
          font-size: 10px;
          font-weight: 700;            
       }
       .circle.pending{
        border-color: #0090ff;
       }
       .circle.pending span{
        color: #0090ff;
       }
       .circle.rejected{
        border-color: red;
       }
       .circle.rejected span{
        color: red;
       }
       .circle.approve{
        border-color: #009900;
       }
       .circle.approve span{
        color: #009900;
       }
       hr {
            margin-top: 3px;
            margin-bottom: 3px;
            border: 0;
            border-top: none;
        }
      .nav-tabs {
          border-bottom: none;
      }
        
      .nav-tabs>li>a {
          border: none;
          border-radius: 0px;
      }
      .nav-tabs>li.active>a {
          border: none !important;
          border-radius: 0px;
      }
      .table-advance tbody > tr:nth-child(even) {
          border-left: none;
      }
      .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
          border-top: none;
          vertical-align: middle;
      }
    </style>
  
    
    <div class="col-sm-4">
      <div class="rounded-box"> 
        <img src="{{url('/')}}/uploads/profile_images/{{$user_details->profile_image}}" alt="Interviewxp">
      </div>
    </div>
   
    <div class="col-sm-8">
       <p><b>{{$user_details->first_name}} {{$user_details->last_name}}</b></p>
      
       
       <p>
           
           <p class="td-p-line" data-popup="tooltip" title="" data-original-title="Gender" style="font-size: 12px;     color: #43a047;"><i class="icon-user-check" style="    font-size: 12px;"> </i> {{ ($user_details->gender == 'M') ? 'Male' : 'Female'}}</p>
           
           
           
       <span data-popup="tooltip" title="" data-original-title="DOB" style="    font-size: 12px;
    color: #2196f3;"><i class=" icon-calendar2" style="    font-size: 12px;"></i> {{date('j M, Y, g:i A T',strtotime($user_details->birth_date))}}</span>
    </p>
       <?php
          $cityDetails = DB::table('city')->where('city_id',$user_details->member_detail->education_city)->first();
       ?>
       <p><i class=" icon-location4" data-popup="tooltip" title="" data-original-title="Location" style="    font-size: 12px;"></i> {{isset($cityDetails->city_name) ? $cityDetails->city_name : 'NA'}}</p>
    </div>
    <div class="col-sm-12">
       <!--<p>A/c Activated ON : {{date('d M Y',strtotime($user_details->birth_date))}}</p>-->
       <?php 
          $email = (strlen($user_details->email) > 31) ? substr($user_details->email,0,28).'...' : $user_details->email; 
        ?>
       <p><i class="icon-envelop3"></i> <span title="{{$user_details->email}}">{{$email}}</span></p>
       <p><i class=" icon-phone-plus2"></i> {{$user_details->mobile_code}} {{$user_details->mobile_no}}</p>
       @if($user_details->member_detail->resume) 
       <p> <a href="{{url('/')}}/uploads/resume_files/{{$user_details->member_detail->resume}}" download><i class=" icon-download4"></i> Resume </a> </p>
       <style type="text/css">
         .nav-tabs li.active {
          background: #fff;
          height: 245px;      }
       </style>
       @else
       
       <style type="text/css">
         .nav-tabs li.active {
          background: #fff;
          height: 230px;      }
       </style>
       @endif
    </div>
    
      <div class="col-sm-12 padding">
      <div class="col-sm-4 padding"><p style="color:#009688">
          <a href="#" style="padding: 5px 6px;" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Earnings" aria-describedby="tooltip936335"><i class=" icon-cash3"></i></a><br/>
      
      
      ${{$total_revenue_ern}}</p></div>
      <div class="col-sm-4 padding">
      
      <p style="color:#FF7043 ">
          <a href="#" style="padding: 5px 6px;" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Views" aria-describedby="tooltip936335"><i class="  icon-eye-plus"></i></a><br/>
          
          
          
          {{$arr_interview_member['view_count']}}</p></div>
      <div class="col-sm-4 padding">
        <p style="color:#5C6BC0  ">
          <a href="#" style="padding: 5px 6px;" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Usage Space" aria-describedby="tooltip936335"><i class="icon-database-check"></i></a><br/>
      
      50MB</p></div>
    </div> 
    
    
    
    
    
  </div>
  <div class="col-sm-9">
  <?php
    $refId = base64_encode($interview_id);
    $urlrefId = isset($_GET['ref']) ? $_GET['ref'] : '';
    $tab = isset($_GET['t']) ? $_GET['t'] : '';
    if($urlrefId ==  $refId)
    {
      $styleRef = '';
      $styleBottomRef = '';
    }
    else if(!empty($urlrefId))
    {
      $styleRef = 'display:none';
      $styleBottomRef = 'display:none';
    }
    else{
      $styleRef = '';
      $styleBottomRef = 'display:none';
    }
    
    ?>
  <?php
    $qa_columns = array_column($arr_interview_member['ref_book_details'],'approve_status');
    $qaRes = [];
    if($qa_columns)
    {
      foreach ($qa_columns as $key => $value) {
        $newArray= explode(',',$value);
        $qaRes = array_merge($qaRes, $newArray);
      }     
    }
    $qa = array_count_values($qaRes);  
    $company = array_count_values(array_column($arr_interview_data,'approve_status'));
    $workexp = array_count_values(array_column($arr_real_time_work,'approve_status'));
    
    $bookings = array_count_values(array_column($arr_coach_bookings,'is_user'));
    
    $pendingQA = 0;
    $approveQA = 0;
    $rejectedQA = 0;
    if(isset($qa[0])) $pendingQA =  $qa[0];
    if(isset($qa[1])) $approveQA =  $qa[1];
    if(isset($qa[2])) $rejectedQA =  $qa[2];
    if(isset($qa[3])) $pendingQA =  $pendingQA + $qa[3];

    $pendingCompany = 0;
    $approveCompany = 0;
    $rejectedCompany = 0;
    if(isset($company[0])) $pendingCompany =  $company[0];
    if(isset($company[1])) $approveCompany =  $company[1];
    if(isset($company[2])) $rejectedCompany =  $company[2];
    if(isset($company[3])) $pendingCompany =  $pendingCompany + $company[3];

    $pendingWXP = 0;
    $approveWXP = 0;
    $rejectedWXP = 0;
    if(isset($workexp[0])) $pendingWXP =  $workexp[0];
    if(isset($workexp[1])) $approveWXP =  $workexp[1];
    if(isset($workexp[2])) $rejectedWXP =  $workexp[2];
    if(isset($workexp[3])) $pendingWXP =  $pendingWXP + $workexp[3];
	$pendingBookings = 0;
    $completedBookings = 0;
    $refundedBookings = 0;
    if(isset($bookings['Pending'])) $pendingBookings =  $bookings['Pending'];
    if(isset($bookings['Completed'])) $completedBookings =  $bookings['Completed'];
    if(isset($bookings['Refunded'])) $refundedBookings =  $bookings['Refunded'];;

    $statusQa = '';
    if(!empty($arr_interview_member['is_qa_submitted_review']))
    {
      $type = '&#34;interview_qa&#34;';
      $statusQa = '(<span class="check-icon" style="font-size: 14px;">Requested<button value="1" class="admin-button-icons check-icon" onclick="return approve_by_admin(this.value,'.$interview_id.','.$type.')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button></span>)';
    }
    else if($arr_interview_member['admin_approval_qa'] != 1)
    {
      $statusQa = '(Pending)';
    }
    else if($arr_interview_member['admin_approval_qa'] == 1)
    {
      $statusQa = '(<span style="color:#009900">Live</span>)';
    }
    else if(isset($qa[2]))
    {
      $statusQa = '(<span style="color:red">Rejected</span>)';
    }
    else
    {
      $statusQa = '(<span style="color:black">Draft</span>)';
    }

    $statusCompany = '';
    if(!empty($arr_interview_member['is_company_submitted_review']))
    {
      $type = '&#34;company&#34;';
      $statusCompany = '(<span class="check-icon" style="font-size: 14px;">Requested<button value="1" class="admin-button-icons check-icon" onclick="return approve_by_admin(this.value,'.$interview_id.','.$type.')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button></span>)';
    }
    else if($arr_interview_member['admin_approval_company'] != 1)
    {
      $statusCompany = '(Pending)';
    }
    else if($arr_interview_member['admin_approval_company'] == 1)
    {
      $statusCompany = '(<span style="color:#009900">Live</span>)';
    }
    else if(isset($company[2]))
    {
      $statusCompany = '(Rejected)';
    }
    else
    {
      $statusCompany = '(<span style="color:black">Draft</span>)';
    }

    $statusRealExp = '';
    if(!empty($arr_interview_member['is_realissues_submitted_review']))
    {
      $type = '&#34;work_exp&#34;';
      $statusRealExp = '(<span class="check-icon" style="font-size: 14px;">Requested<button value="1" class="admin-button-icons check-icon" onclick="return approve_by_admin(this.value,'.$interview_id.','.$type.')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button></span>)';
    }
    else if($arr_interview_member['admin_approval_realissues'] == 0)
    {
      $statusRealExp = '(Pending)';
    }
    else if($arr_interview_member['admin_approval_realissues'] == 1)
    {
      $statusRealExp = '(<span style="color:#009900">Live</span>)';
    }
    else if(isset($workexp[2]))
    {
      $statusRealExp = '(Rejected)';
    }
    else
    {
      $statusRealExp = '(<span style="color:black">Draft</span>)';
    }

  	$statusBookings = '';
    if($available_member_bookings > 0)
    {
      $statusBookings = '(<span style="color:#009900">Available</span>)';
    }
    else
    {
      $statusBookings = '(Not Available)';
    }

  ?> 
  <ul class="nav nav-tabs">
    <li {!! ($tab == 'interview-qa' || $tab == '') ? 'class="active"' : ''  !!} style="text-align: center;width: 23%; float: left;">
      <a style="font-size: 17px;" href="#tab1default{{$interview_id}}" data-toggle="tab"
    >Interview  Q & A{!!$statusQa!!}</a><hr>
      <span style="float: left;width: 33%;"><span class="circle pending" title="Pending"><span>{{ $pendingQA }}</span></span><br>Pending</span>
      <span style="float: left;width: 33%;"><span class="circle approve" title="Approved"><span>{{ $approveQA }}</span></span><br>Approved</span>
      <span style="float: left;width: 33%;"><span><span class="circle rejected" title="Rejected"><span>{{ $rejectedQA }}</span></span><br>Rejected</span>
    </li>
    <li {!! ($tab == 'company') ? 'class="active"' : ''  !!} style="text-align: center;width: 23%; float: left;">
      <a style="font-size: 17px;" href="#tab2default{{$interview_id}}" data-toggle="tab">Interviews Companies{!!$statusCompany!!}</a><hr>
      <span style="float: left;width: 33%;"><span class="circle pending" title="Pending"><span>{{ $pendingCompany}}</span></span><br>Pending</span>
      <span style="float: left;width: 33%;"><span class="circle approve" title="Approved"><span>{{ $approveCompany }}</span></span><br>Approved</span>
      <span style="float: left;width: 33%;"><span class="circle rejected" title="Rejected"><span>{{ $rejectedCompany }}</span></span><br>Rejected</span>
    </li>
    <li {!! ($tab == 'realissues') ? 'class="active"' : ''  !!} style="text-align: center; width: 23%; float: left;">
      <a style="font-size: 17px;" href="#tab3default{{$interview_id}}" data-toggle="tab">Work Experience{!!$statusRealExp!!}</a><hr>
      <span style="float: left;width: 33%;"><span class="circle pending" title="Pending"><span>{{ $pendingWXP }}</span></span><br>Pending</span>
      <span style="float: left;width: 33%;"><span class="circle approve" title="Approved"><span>{{ $approveWXP }}</span></span><br>Approved</span>
      <span style="float: left;width: 33%;"><span class="circle rejected" title="Rejected"><span>{{ $rejectedWXP }}</span></span><br>Rejected</span>
    </li>
     <li {!! ($tab == 'bookings') ? 'class="active"' : ''  !!} style="text-align: center; width: 23%; float: left;">
      <a style="font-size: 17px;" href="#tab4default{{$interview_id}}" data-toggle="tab">Bookings<br>{!!$statusBookings!!}</a><hr>
      <span style="float: left;width: 33%;"><span class="circle pending" title="Pending"><span>{{ $pendingBookings }}</span></span><br>Pending</span>
      <span style="float: left;width: 33%;"><span class="circle approve" title="Approved"><span>{{ $completedBookings }}</span></span><br>Completed</span>
      <span style="float: left;width: 33%;"><span class="circle rejected" title="Rejected"><span>{{ $refundedBookings }}</span></span><br>Refunded</span>
    </li>
      <!--<li style="background: none !important;"><a style="font-size: 17px; background: #17b0a4 !important;
    color: #fff; !important" href="#tab4default{{$interview_id}}" data-toggle="tab">Bookings</a></li>-->
  </ul>
  </div>
 
  <!-- Modal -->
<div class="modal fade" id="admin_comments_modal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                     Upload Approvals Comment
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                
               {{ Form::open(array('url'=>'','method'=>'post', 'id'=>'form_admin_comment')) }}
                  <div class="form-group">
                    {{ csrf_field() }}
                    {!! Form::hidden('inputId', null,['class'=>'form-control','id'=>'inputId']) !!}
                    {!! Form::hidden('inputValue', null,['class'=>'form-control','id'=>'inputValue']) !!}
                    {!! Form::hidden('inputInterviewId', null,['class'=>'form-control','id'=>'inputInterviewId']) !!}
                    {!! Form::hidden('inputStatus', null,['class'=>'form-control','id'=>'inputStatus']) !!}
                    {!! Form::textarea('inputComment', null, array('required','class'=>'form-control','placeholder'=>'Enter Comment', 'cols'=>2,'rows'=>2)) !!}
                    </div>
                  <div class="form-group">
                    {!! Form::submit('submit', array('class'=>'btn btn-primary', 'id'=>'btn_admin_comment')) !!}
                  </div>
                {{ Form::close() }}            
            </div>
         
        </div>
    </div>
</div>
</div>
<div class="col-md-12">
  @include('admin.layout._operation_status')  
  <div class="tab-content">
    <div {!! ($tab == 'interview-qa' || $tab == '') ? 'class="tab-pane fade in active"' : 'class="tab-pane fade"'  !!} id="tab1default{{$interview_id}}">
      <div class="box {{ $theme_color }}">
  

      <div class="box-content">
       
         {!! Form::open([ 'url' => '',
         'method'=>'POST',
         'enctype' =>'multipart/form-data',   
         'class'=>'form-horizontal', 
         'id'=>'frm_manage' 
         ]) !!}
         {{ csrf_field() }}
         <div class="clearfix"></div>
         <div class="table-responsive" style="border:0">
            <input type="hidden" name="multi_action_upload_approve" value="" />
            <table class="datatable table table-striped table-bordered" style="min-width: 1200px;    overflow: auto;" >
               <thead>
                   <tr style="background-color: #26A69A !important; height:45px;      color: #fff;  border-color: #26A69A !important;">
                    
                     
	<td style="font-family: 'ubuntumedium',sans-serif;font-size: 13px;    "><div style="width:60px; float:left">S.No </div></td>
	<td style="font-family: 'ubuntumedium',sans-serif;font-size: 13px;">
	<div style="width:300px; float:left; text-align:left">Topic Name  <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
	<div style="width:100px; float:left; text-align:left">File Size <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div>
	<div style="width:100px; float:left; text-align:left">Date & Time <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
	<div style="width:100px; float:left; text-align:left">Status <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
	<div style="width:306px; float:left; text-align:left">Action <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div>
	
	<div style="width:140px; float:left; text-align:left">Admin Comment </div>
	</td>
																	
																
																 
																   
																   
                     
                     
                  </tr>
               </thead>
               <?php $i=1; ?>
               <tbody>
                  @if(isset($arr_interview_member) && sizeof($arr_interview_member)>0)
                  @if(isset($arr_interview_member['ref_book_details']) && sizeof($arr_interview_member['ref_book_details'])>0)
                   @foreach($arr_interview_member['ref_book_details'] as $data)
                  <tr style="border-bottom: 1px solid #d0cdcd;">
                    
                     <td style="background-color: #f6f6f6;">{{$i++}}</td>
                     <!-- <td>{{$arr_interview_member['skilldetails']['skill_name'].' reference book'}}</td> -->

                     <td style="background-color: #f8fbfb;"><p style=" text-transform: capitalize;  padding: 7px 0px; 
    color: #26a69a;">{{$data['topic_name'] or 'NA'}} </p>
                     <?php $status = $data['approve_status']; 
                     
                  $results1 = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$data['interview_id']."' AND topic_name = '".$data['topic_name']."' AND file_extension != 'youtube' ORDER BY `multi_reference_book`.`id` DESC") );      
                   foreach ($results1 as $key1=>$user1) {
                    
                     if($user1->file_extension =='Pdf'){
                       $icon='<i class="fa fa-file-pdf-o"></i>';
                     }else if($user1->file_extension =='Video'){
                       $icon='<i class="fa fa-play"></i>';
                     }else{
                       $icon="";
                     }
                     $viewicon=url('/')."/images/viewicon.png";
                      // dd($data);
                     if($user1->approve_status==1){
                       $status="<span class='label bg-success heading-text' style='margin-top: 9px;'>Approved</span>";
                     }
                     else if($user1->approve_status==2)
                     {
                       $status="Rejected";
                     }
                     else if($user1->approve_status==3)
                     {
                       $status="Requested";
                     }                       
                     else{
                      $status="Pending";
                     }
                     
                   if($key1==0) { $margintop='margin-top: 9px;'; } else { $margintop=''; }  
                  ?>
                
                    	 <div style="float: left;   width: 100%; 
					 border-bottom: 1px solid #e4e7ec; background: #fff;   {{$margintop}}">
                    	     
                   	<div style="width:305px; float:left; line-height: 40px;"><?php echo $icon ?> &nbsp;&nbsp; Part {{$key1+1}} &nbsp;&nbsp; {{$user1->pageCount}} </div>
                   <div style="width:100px; float:left; line-height: 40px;">{{$user1->fileSize}} M.B</div>
                  <div style="width:100px; float:left">{{date('j M, Y, g:i A T',strtotime($user1->created_at))}}
                      @if($user1->freePreview =='Yes')<i class="fa fa-eye" aria-hidden="true" title="Free Preview" style="margin-left:10px;color: #17b0a4 !important;"></i>@endif
                   </div>
                   <div style="width:100px; float:left; background-color: #fff; margin-top: 9px; font-weight:bold;color:@if($user1->approve_status==1)green @elseif($user1->approve_status==2)red @elseif($user1->approve_status==0)#0090ff @endif"><?php echo $status;?></div>
                   <div style="width:306px; float:left; background-color: #fff; ">
                      
                       
                       
                        <span> <a href="{{$member_referencebook_public_path.$user1->mul_reference_book}}" class="admin-button-icons call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                      <i class=" icon-download4" title="Download"></i>
                        </a>  </span>
                        
                        
                        
                        <span> <a href="{{$member_referencebook_public_path.$user1->mul_reference_book}}" class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span>
                        
                        
                        
                         <button style="margin-top:-19px" value="1" class="btn btn-success btn-rounded" onclick="return approve_change(this.value,{{$user1->id}},{{$user1->interview_id}},'status_interview')" title="Approve"><i class="icon-checkmark4" aria-hidden="true" title="Approve"></i> Approve</button>
                         
                         
                   
                   <button style="margin-top:-19px" value="2" class="btn btn-warning btn-rounded btn-sm" onclick="return approve_change(this.value,{{$user1->id}},{{$user1->interview_id}},'status_interview')" title="Reject"><i class="icon-cross2" aria-hidden="true" title="Reject"></i> Reject</button>
                   
                   
                      
                        <span><a href="{{url('/admin/members/delete_reference_book/'.base64_encode($user1->id).'/'.base64_encode($interview_id))}}" onclick="return confirm_delete();" class="admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-trash" title="Delete"></i> 
                        </a> </span>
                        
                        
                        
                    
                  </div>
                   <div style="width:100px; float:left">
                          <?php 
                            $admin_comments = $user1->admin_comments ? $user1->admin_comments : 'Admin Comment';
                            $admin_comments_color = $user1->admin_comments ? 'color: green;' : 'color: #337ab7;';
                         ?>
                      
                        <a  href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($user1->id).'/'.'comment_interview' }}" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">

                          <i class="icon-comments" style="color: green;;cursor: pointer;" title="{{$admin_comments}}"></i> </a>
                          
                          
                          </div>
                          
                          
                          
                          
                          
                          
                          
                          
                          
<?php $results1s = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE subid = '".$user1->id."'  ORDER BY `id` DESC") ); 

if(isset($results1s) && count($results1s)>0) { echo '<div style="line-height: 23px;
   
    background: #f9f7f7;
    width: 100%;
    color: #0c756d;
    float: left;
    font-size: 13px;
    padding-left: 2px;
    border-top: 1px solid #ecececc2;
    border-bottom: 1px solid #ecececc2;;">Video URL refrance.</div>';}
    
    
    
                   foreach ($results1s as $key1s=>$user1s) {
                    $videoID=explode('?v=',$user1s->mul_reference_book);
                    
                     $viewicon=url('/')."/images/viewicon.png";
                     
                     if($user1s->approve_status==1){
                       $status="<span class='label bg-success heading-text' >Approved</span>";
                     }
                     else if($user1s->approve_status==2)
                     {
                       $status="Rejected";
                     }
                     else if($user1s->approve_status==3)
                     {
                       $status="Requested";
                     }                       
                     else{
                      $status="Pending";
                     }
                          
                          
                          
                          
                          
                          
                          
                          ?>
                          
                          
                      	 <div style="float: left;   width: 100%; 	 border-bottom: 1px solid #e4e7ec; " >   
                      	 
                      	 
                      	 
<div style="width:305px; float:left; line-height: 40px;"> 


    <?php if(isset($videoID[1])) { ?>
              <div class="video" style="background-image:url('https://img.youtube.com/vi/{{$videoID[1]}}/0.jpg')">
                            
                            <a data-toggle="modal" href="#videoplayintro" class="videoidtake" id="{{$videoID[1]}}" style="text-align: center;"> 
  
  <img src="{{url('/')}}/images/icon-play.svg" class="img-zoom"  style=" float: none;"></a>
  
  
     
     </div>
     
     <?php } ?>






</div>

                   <div style="width:100px; float:left; line-height: 40px;">{{round($user1s->fileSize/60)}} Min.</div>
                  <div style="width:100px; float:left">{{date('j M, Y, g:i A T',strtotime($user1s->created_at))}}
                      @if($user1s->freePreview =='Yes')<i class="fa fa-eye" aria-hidden="true" title="Free Preview" style="margin-left:10px;color: #17b0a4 !important;"></i>@endif
                   </div>
                   <div style="width:100px; float:left; background-color: #fff;font-weight:bold; margin-top: 9px; color:@if($user1s->approve_status==1)green @elseif($user1s->approve_status==2)red @elseif($user1s->approve_status==0)#0090ff @endif"><?php echo $status;?></div>
                   <div style="width:306px; float:left; background-color: #fff; ">
                      
                       
                       
                       <span style="
    width: 51px;
    height: 30px;
"> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  </span>
                        
                        
                        
                        <span> <a data-toggle="modal" href="#videoplayintro"  id="{{$videoID[1]}}" class="videoidtake admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span>
                        
                        
                        
                         <button style="margin-top:-19px" value="1" class="btn btn-success btn-rounded" onclick="return approve_change(this.value,{{$user1s->id}},{{$user1s->interview_id}},'status_interview')" title="Approve"><i class="icon-checkmark4" aria-hidden="true" title="Approve"></i> Approve</button>
                         
                         
                   
                   <button style="margin-top:-19px" value="2" class="btn btn-warning btn-rounded btn-sm" onclick="return approve_change(this.value,{{$user1s->id}},{{$user1s->interview_id}},'status_interview')" title="Reject"><i class="icon-cross2" aria-hidden="true" title="Reject"></i> Reject</button>
                   
                   
                      
                        <span><a href="{{url('/admin/members/delete_reference_book/'.base64_encode($user1s->id).'/'.base64_encode($interview_id))}}" onclick="return confirm_delete();" class="admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-trash" title="Delete"></i> 
                        </a> </span>
                        
                        
                        
                    
                  </div>
                   <div style="width:100px; float:left">
                          <?php 
                            $admin_comments = $user1s->admin_comments ? $user1s->admin_comments : 'Admin Comment';
                            $admin_comments_color = $user1s->admin_comments ? 'color: green;' : 'color: #337ab7;';
                         ?>
                      
                        <a  href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($user1s->id).'/'.'comment_interview' }}" 
                        class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">

                          <i class="icon-comments" style="color: green;;cursor: pointer;" title="{{$admin_comments}}"></i> </a>
                          
                          
                          </div>
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 
                      	 </div>
                          
                          
                          <?php } ?>
                          
                          
                          
                          
                          
                          
                          
                          
                          </div>
                          
                          
                          <?php } ?>
                          
                          
                          
                    </td>
                  </tr>
                  
                  @endforeach
                  @else
                     <tr><td colspan="7"><div style="color:red;text-align:center;">No Records Found</div></td></tr>
                  @endif
                  @endif
               </tbody>
            </table>
         </div>
         {!! Form::close() !!}
      </div>

      </div>
    </div>
<div  {!! ($tab == 'company') ? 'class="tab-pane fade in active"' : 'class="tab-pane fade"'  !!} id="tab2default{{$interview_id}}">
<div class="modal fade popup-cls" id="update_company" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
     {{ Form::open(array('url'=>'','method'=>'post', 'id'=>'form_update_company')) }} 
    <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal"><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"/></button>
       <h4 class="modal-title">Update Company</h4>
    </div>
    <div class="modal-body">
      
       <div class="row">
       </div>
       <div id="error_update_company" class="error"></div>
       <div id="success_update_company" style="color:green;"></div>
       {{ csrf_field() }}
       <!--upload resume section-->
       <div style="color:green;" id='success_msg'>
    </div>
    <div class="form-group">
      <div class="row">
      <div class="col-sm-12 col-md-4 col-lg-4"><label>Company<span class="star"  style="color:red;">*</span></label> 
      </div>
      <div class="col-sm-12 col-md-8 col-lg-8">
      <input class="input-box-signup" type="hidden" name="company_primary_id" id="company_primary_id" value="">
      <input class="input-box-signup" type="hidden" name="interview_id" id="interview_id" value="">
      <input class="input-box-signup" type="hidden" name="company_id" id="company_id" value="">
      <input class="input-box-signup" type="text" name="company_name" id="company_name" value="">
      
      </div>
      </div>
    </div>
    <div class="form-group">
       <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4"><label>Location<span class="star" style="color:red;">*</span></label> 
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
         <input class="input-box-signup" type="text" value="" name="company_location" id="company_location">
         <div id="update_error_location" class="error"></div>
        </div>
       </div>
    </div>                    
   
    <!--end-->
   </div>
   <div class="modal-footer">
    <button type="submit" id="update_company" class="submit-btn ctn">Update</button>
   </div>
   {{ Form::close() }}
  </div>
 </div>
</div>   
<div class="row">
   <div class="col-md-12">
      <div class="box">
         <!--<div class="box-title">
            <h3><i class="fa fa-eye"></i>Interviews by Companies</h3>
            <div class="box-tool">
            </div>
         </div>-->

        <div class="box-content">
        <!--  @include('admin.layout._operation_status')   -->
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
        
                  
                   <table class="datatable table table-striped table-bordered" style="min-width: 1200px;    overflow: auto;" >
               <thead>
                   <tr style="background-color: #26A69A !important; height:45px;      color: #fff;  border-color: #26A69A !important;">
                    
                     
	<td style="font-family: 'ubuntumedium',sans-serif;font-size: 13px;    "><div style="width:60px; float:left">S.No </div></td>
	<td style="font-family: 'ubuntumedium',sans-serif;font-size: 13px;">
	<div style="width:300px; float:left; text-align:left">Company Name  <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top:0px;"></div> 
	<div style="width:100px; float:left; text-align:left">File Size <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: 0px;"></div>
	<div style="width:100px; float:left; text-align:left">Date & Time Uploaded<img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: 0px;"></div> 
	<div style="width:100px; float:left; text-align:left">Status <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: 0px;"></div> 
	<div style="width:306px; float:left; text-align:left">Action <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: 0px;"></div>
	
	<div style="width:140px; float:left; text-align:left">Admin Comment </div>
	</td>
																	
																
																 
																   
																   
                     
                     
                  </tr>
                  
                  
                  
               </thead>
               <?php $i=1;  ?>
               <tbody>
                  @if(isset($arr_interview_data) && sizeof($arr_interview_data)>0)
                   @foreach($arr_interview_data as $data)
                  <tr style="    border-bottom: 1px solid #d0cdcd;">
                    
                     <td style="background-color: #f6f6f6;">{{$i++}}</td>
                     
                     
                     <td style="background-color: #f8fbfb;"><p style="  padding: 7px 0px;
    color: #26a69a;">{{$data['company_name'] or 'NA'}} ({{ $data['company_location']}}) @if($data['freePreview'] =='Yes')<i class="icon-eye" aria-hidden="true" 
                     title="Free Preview" style="margin-left:10px;color: #17b0a4 !important;"></i>@endif </p>
                     
                  <?php

                   $results1 = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$interview_id."' AND company_id = '".$data['company_id']."' AND file_extension!='youtube' ") );
                  foreach ($results1 as $key1=>$user1) {

                     $icon = '';

                     if($user1->file_extension =='Pdf'){
                       $icon='<i class="fa fa-file-pdf-o"></i>';
                     }
                       
                     if($user1->file_extension =='Video'){
                       $icon='<i class="fa fa-play"></i>';
                     }
                     $viewicon=url('/')."/images/viewicon.png";

                     if($user1->approve_status==1){
                       $status="Approved";
                     }
                     else if($user1->approve_status==2)
                     {
                       $status="Rejected";
                     }
                     else if($user1->approve_status==3)
                     {
                       $status="Requested";
                     }                       
                     else{
                      $status="Pending";
                     }
                     
                     
                 if($key1==0) { $margintop='margin-top: 9px;'; } else { $margintop=''; }  
                  ?>
                
                    	 <div style="float: left;   width: 100%;  border-bottom: 1px solid #e4e7ec; background: #fff;   {{$margintop}}">
                
                    
                    <div  style="width:310px; background-color: #fff; float: left;"><?php echo $icon ?>{{$user1->roundType}} &nbsp;&nbsp; {{$user1->pageCount}}</div>
                   <div  style="width:100px; background-color: #fff; float: left;">{{$user1->fileSize}} M.B</div>
                    <div  style="width:100px; background-color: #fff; float: left;">{{date('j M, Y, g:i A T',strtotime($user1->created_at))}}</div>
                     <div  style="width:100px; float: left; color:@if($user1->approve_status==1)green @elseif($user1->approve_status==2)red @elseif($user1->approve_status==0)#0090ff @endif">
                        <span class='label bg-success heading-text' style="    margin-top: 9px;">{{$status}}</span>
                     </div>
                      <div  class="ac-icons"  style="width:336px; float:left;">
                        
                    <span> <a href="{{$member_company_attachment_public_path.'/'.$user1->attachment}}" class="admin-button-icons call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                      <i class=" icon-download4" title="Download"></i>
                        </a>  </span>
                        
                        
                        
                      
                        
                   <span> <a href="{{$member_company_attachment_public_path.'/'.$user1->attachment}}" class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span>
                        
                        
                        
                        
            
                         <button style="margin-top:-19px" value="1" class="btn btn-success btn-rounded" onclick="return approve_change(this.value,{{$user1->id}},{{$user1->interview_id}},'status_company')" title="Approve"><i class="icon-checkmark4" aria-hidden="true" title="Approve"></i> Approve</button>
                         
                         
                      
                        
                          <button style="margin-top:-19px" value="2" class="btn btn-warning btn-rounded btn-sm"onclick="return approve_change(this.value,{{$user1->id}},{{$user1->interview_id}},'status_company')" title="Reject"><i class="icon-cross2" aria-hidden="true" title="Reject"></i> Reject</button>
                   
                   
                  
                        
                        
                        <span><a href="{{url('/admin/members/delete_interview/'.base64_encode($user1->id).'/'.base64_encode($interview_id).'/'.base64_encode($user1->user_id))}}" onclick="return confirm_delete();" class="admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-trash" title="Delete"></i> 
                        </a> </span>
                        
                        
                        
                        

                   
                        
                        
                        
                        
                        <span> <a href="#" data-toggle="modal" title="Edit" onclick="updateComapny({{$user1->id}},{{$data['company_id']}},{{$interview_id}})" class="admin-button-icons call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                      <i class=" icon-pencil7" title="Edit"></i>
                        </a>  </span>
                        
                        
                        
                        
                        <input type="hidden" name="company_location_{{$user1->id}}" id="company_location_{{$user1->id}}" value="{{$user1->company_location}}" /> 
                        <input type="hidden" name="company_name_{{$user1->id}}" id="company_name_{{$user1->id}}" value="{{$data['company_name']}}" /> 
                        </span>
                        
                    
                     

                     </div>
                     <div  style="width:100px; float:left;"> 
                        <?php 
                            $admin_comments = isset($user1->admin_comments) ? $user1->admin_comments : 'Admin Comment';
                            $admin_comments_color = $user1->admin_comments ? 'color: green;' : 'color: #337ab7;';
                         ?>
                    
                          <a  href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($user1->id).'/'.'comment_company' }}" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">

                          <i class="icon-comments" style="color: green;;cursor: pointer;" title="{{$admin_comments}}"></i> </a>
                          
                          
                          
                    </div>
                    
                   
                          
                          
<?php $results1sc = DB::select( DB::raw("SELECT * FROM interview_detail WHERE subid = '".$user1->id."'  ORDER BY `id` DESC") ); 

if(isset($results1sc) && count($results1sc)>0) { echo '<div style="line-height: 23px;
   
    background: #f9f7f7;
    width: 100%;
    color: #0c756d;
    float: left;
    font-size: 13px;
    padding-left: 2px;
    border-top: 1px solid #ecececc2;
    border-bottom: 1px solid #ecececc2;;">Video URL refrance.</div>';}
    
    
    
                   foreach ($results1sc as $key1sc=>$user1sc) {
                    $videoID=explode('?v=',$user1sc->roundType);
                    
                     $viewicon=url('/')."/images/viewicon.png";
                     
                     
                          
                          
                     if($user1sc->approve_status==1){
                       $status="Approved";
                     }
                     else if($user1sc->approve_status==2)
                     {
                       $status="Rejected";
                     }
                     else if($user1sc->approve_status==3)
                     {
                       $status="Requested";
                     }                       
                     else{
                      $status="Pending";
                     }
                     
                     
                          
                      
                          ?>
                          
                          
                         <div style="float: left;   width: 100%;     border-bottom: 1px solid #e4e7ec; " >   
                         
                         
                         
<div style="width:305px; float:left; line-height: 40px;"> 


    <?php if(isset($videoID[1])) { ?>
              <div class="video" style="background-image:url('https://img.youtube.com/vi/{{$videoID[1]}}/0.jpg')">
                            
                            <a data-toggle="modal" href="#videoplayintro" class="videoidtake" id="{{$videoID[1]}}" style="text-align: center;"> 
  
  <img src="{{url('/')}}/images/icon-play.svg" class="img-zoom"  style=" float: none;"></a>
  
  
     
     </div>
     
     <?php } ?>






</div>

  <div  style="width:100px; background-color: #fff; float: left;">{{round($user1sc->fileSize/60)}} Min.</div>
                    <div  style="width:100px; background-color: #fff; float: left;">{{date('j M, Y, g:i A T',strtotime($user1sc->created_at))}}</div>
                     <div  style="width:100px; float: left; color:@if($user1sc->approve_status==1)green @elseif($user1sc->approve_status==2)red @elseif($user1sc->approve_status==0)#0090ff @endif">
                        <span class='label bg-success heading-text' style="    margin-top: 9px;">{{$status}}</span>
                     </div>
                      <div  class="ac-icons"  style="width:336px; float:left;">
                        
                    <span>  </span>
                        
                        
                        
                      
                        
                   <span> <a data-toggle="modal" href="#videoplayintro"  id="{{$videoID[1]}}" style="margin-left: 41px;" class="videoidtake admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span>
                        
                        
                        
                        
            
                         <button style="margin-top:-19px" value="1" class="btn btn-success btn-rounded" onclick="return approve_change(this.value,{{$user1sc->id}},{{$user1sc->interview_id}},'status_company')" title="Approve"><i class="icon-checkmark4" aria-hidden="true" title="Approve"></i> Approve</button>
                         
                         
                      
                        
                          <button style="margin-top:-19px" value="2" class="btn btn-warning btn-rounded btn-sm"onclick="return approve_change(this.value,{{$user1sc->id}},{{$user1sc->interview_id}},'status_company')" title="Reject"><i class="icon-cross2" aria-hidden="true" title="Reject"></i> Reject</button>
                   
                   
                  
                        
                        
                        <span><a href="{{url('/admin/members/delete_interview/'.base64_encode($user1sc->id).'/'.base64_encode($interview_id).'/'.base64_encode($user1sc->user_id))}}" onclick="return confirm_delete();" class="admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-trash" title="Delete"></i> 
                        </a> </span>
                        
                        
                        
                        

                   
                        </span>
                        
                    
                     

                     </div>
                     <div  style="width:100px; float:left;"> 
                        <?php 
                            $admin_comments = isset($user1sc->admin_comments) ? $user1sc->admin_comments : 'Admin Comment';
                            $admin_comments_color = $user1sc->admin_comments ? 'color: green;' : 'color: #337ab7;';
                         ?>
                    
                          <a  href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($user1sc->id).'/'.'comment_company' }}" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">

                          <i class="icon-comments" style="color: green;;cursor: pointer;" title="{{$admin_comments}}"></i> </a>
                          
                          
                          
                    </div>
                         
                         
                         
                         
                         
                         
                         </div>
                          
                          
                          <?php } ?>
                          
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                  </div>
                  
                  <?php } ?>
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
   </div>
</div>   
</div>   
<div {!! ($tab == 'realissues') ? 'class="tab-pane fade in active"' : 'class="tab-pane fade"'  !!} id="tab3default{{$interview_id}}">
<div class="row">
   <div class="col-md-12">
      <div class="box">
      
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
                     <th>RWE</th>
                     <th>File Size</th>
                     <th>Date & Time Uploaded</th>
                     <th>Status</th>
                     <th style="min-width:185px !important">Action</th>
                     <th>Admin Comments</th>
                    
                  </tr>
               </thead>
               <?php $i=1; ?>
               <tbody>
                  @if(isset($arr_real_time_work) && sizeof($arr_real_time_work)>0)
                   @foreach($arr_real_time_work as $data_rwe)
                  <tr>
                    
                     <td>{{$i++}}</td>
                     <td>{{$data_rwe['issue_title'] or 'NA'}}</td>
                     <td>{{$data_rwe['fileSize']}} M.B</td>
                     <td>{{date('j M, Y, g:i A T',strtotime($data_rwe['created_at']))}}
                      @if($data_rwe['freePreview'] =='Yes')<i class="fa fa-eye" aria-hidden="true" title="Free Preview" style="margin-left:10px;color: #17b0a4 !important;"></i>@endif
                     </td>
                     <?php $status = $data_rwe['approve_status']; ?> 
                     <td style="font-weight:bold;color:@if($status==1)green @elseif($status==2)red @elseif($status==0)#0090ff @endif"><span class='label bg-success heading-text' style="    margin-top: 9px;">
                        @if($status==0)Pending
                        @elseif($status==1)Approved
                        @elseif($status==2)Rejected
                        @elseif($status==3)Requested
                        @endif
                        </span>
                     </td>
                     <td class="ac-icons" style="width: 30%;">
                    
                     
                        
                        
                <span> <a href="{{$member_realtime_attachment_public_path.$data_rwe['attachment']}}" class="admin-button-icons call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                      <i class=" icon-download4" title="Download"></i>
                        </a>  </span>
                        
                        
                          <span> <a href="{{$member_realtime_attachment_public_path.$data_rwe['attachment']}}" class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span>
                        
                        
                        
                      
                      
                      
                         <button style="margin-top:-19px" value="1" class="btn btn-success btn-rounded" onclick="return approve_change(this.value,{{$data_rwe['id']}},{{$data_rwe['interview_id']}},'status_rwe')" title="Approve"><i class="icon-checkmark4" aria-hidden="true" title="Approve"></i> Approve</button>
                         
                         
                         
                         
                     
                       
                       <button style="margin-top:-19px" value="2" class="btn btn-warning btn-rounded btn-sm" onclick="return approve_change(this.value,{{$data_rwe['id']}},{{$data_rwe['interview_id']}},'status_rwe')"  title="Reject"><i class="icon-cross2" aria-hidden="true" title="Reject"></i> Reject</button>
                   
                   
                   
                   

                        
                       <span><a href="{{url('/admin/members/delete_realtime/'.base64_encode($data_rwe['issue_title']).'/'.base64_encode($interview_id).'/'.base64_encode($data_rwe['user_id']))}}" onclick="return confirm_delete();" class="admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-trash" title="Delete"></i> 
                        </a> </span>
                        
                        
                     
                     </td>
                     <td>
                         <?php 
                            $admin_comments = $data_rwe['admin_comments'] ? $data_rwe['admin_comments'] : 'Admin Comment';
                            $admin_comments_color = $data_rwe['admin_comments'] ? 'color: green;' : 'color: #337ab7;';
                         ?>
                      
                         <a  href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($data_rwe['id']).'/'.'comment_rwe' }}" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">

                          <i class="icon-comments" style="color: green;;cursor: pointer;" title="{{$admin_comments}}"></i> </a>
                          
                          
                          
                    </td>
                     
                     
                     
                     
                  </tr>
                  
                  
                  
                                           
<?php $realid=$data_rwe['id']; 
$results1relis = DB::select( DB::raw("SELECT * FROM member_real_time_experience WHERE subid = '".$realid."'  ORDER BY `id` DESC") ); 

if(isset($results1relis) && count($results1relis)>0) { echo '
   <tr><td>&nbsp;</td><td colspan="6"><div style="line-height: 23px;
   
    background: #f9f7f7;
    width: 100%;
    color: #0c756d;
    float: left;
    font-size: 13px;
    padding-left: 2px;
    border-top: 1px solid #ecececc2;
    border-bottom: 1px solid #ecececc2;;">Video URL refrance.</div></td></tr> ';}
    
    
    
                   foreach ($results1relis as $key1is=>$user1is) {
                    $videoIDmm=explode('?v=',$user1is->attachment);
                    
                     $viewicon=url('/')."/images/viewicon.png";
                     
                     
                          
                          
                     if($user1is->approve_status==1){
                       $status="Approved";
                     }
                     else if($user1is->approve_status==2)
                     {
                       $status="Rejected";
                     }
                     else if($user1is->approve_status==3)
                     {
                       $status="Requested";
                     }                       
                     else{
                      $status="Pending";
                     }
                     
                     
                          
                      
                          ?>
                  
                  
                   <tr>
                       
                       
                       
                       
                       
                              <td>&nbsp;</td>
                     <td>
                         
                         
    <?php if(isset($videoIDmm[1])) { ?>
              <div class="video" style="background-image:url('https://img.youtube.com/vi/{{$videoIDmm[1]}}/0.jpg')">
                            
                            <a data-toggle="modal" href="#videoplayintro" class="videoidtake" id="{{$videoIDmm[1]}}" style="text-align: center;"> 
  
  <img src="{{url('/')}}/images/icon-play.svg" class="img-zoom"  style=" float: none;"></a>
  
  
     
     </div>
     
     <?php } ?>
                     </td>
                     
                     
                     
                     <td>{{round($user1is->fileSize/60)}} Min.</td>
                     <td>{{date('j M, Y, g:i A T',strtotime($user1is->created_at))}}
                      @if($user1is->freePreview =='Yes')<i class="fa fa-eye" aria-hidden="true" title="Free Preview" style="margin-left:10px;color: #17b0a4 !important;"></i>@endif
                     </td>
                     <?php $status = $user1is->approve_status; ?> 
                     <td style="font-weight:bold;color:@if($status==1)green @elseif($status==2)red @elseif($status==0)#0090ff @endif"><span class='label bg-success heading-text' style="    margin-top: 9px;">
                        @if($status==0)Pending
                        @elseif($status==1)Approved
                        @elseif($status==2)Rejected
                        @elseif($status==3)Requested
                        @endif
                        </span>
                     </td>
                     <td class="ac-icons" style="width: 30%;">
                    
                     
                        
             
                        
                        
                          <span> <a data-toggle="modal" href="#videoplayintro"  id="{{$videoIDmm[1]}}" style="margin-left: 37px;" class="videoidtake admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span>
                        
                        
                        
                      
                      
                      
                         <button style="margin-top:-19px" value="1" class="btn btn-success btn-rounded" onclick="return approve_change(this.value,{{$user1is->id}},{{$user1is->interview_id}},'status_rwe')" title="Approve"><i class="icon-checkmark4" aria-hidden="true" title="Approve"></i> Approve</button>
                         
                         
                         
                         
                     
                       
                       <button style="margin-top:-19px" value="2" class="btn btn-warning btn-rounded btn-sm" onclick="return approve_change(this.value,{{$user1is->id}},{{$user1is->interview_id}},'status_rwe')"  title="Reject"><i class="icon-cross2" aria-hidden="true" title="Reject"></i> Reject</button>
                   
                   
                   
                   

                        
                       <span><a href="{{url('/admin/members/delete_realtime/'.base64_encode($user1is->issue_title).'/'.base64_encode($interview_id).'/'.base64_encode($user1is->user_id))}}" onclick="return confirm_delete();" class="admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-trash" title="Delete"></i> 
                        </a> </span>
                        
                        
                     
                     </td>
                     <td>
                         <?php 
                            $admin_comments = $user1is->admin_comments ? $user1is->admin_comments : 'Admin Comment';
                            $admin_comments_color = $user1is->admin_comments ? 'color: green;' : 'color: #337ab7;';
                         ?>
                      
                         <a  href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($user1is->id).'/'.'comment_rwe' }}" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">

                          <i class="icon-comments" style="color: green;;cursor: pointer;" title="{{$admin_comments}}"></i> </a>
                          
                          
                          
                    </td>
                     
                     
                       
                       
                       
                       
                       
                       
                       
                       
                   </tr>
                  
                  
                  <?php } ?>
                  
                  
                  
                  
                  
                  
                  
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
   </div>
</div>
</div>

<div {!! ($tab == 'coach') ? 'class="tab-pane fade in active"' : 'class="tab-pane fade"'  !!} id="tab4default{{$interview_id}}">
    
    <?php $status = $data_rwe['approve_status']; $totalsetid=$arr_interview_member['user_id']."_".$interview_id."_".$arr_interview_member['skill_id']."_".$status;  ?>
<div class="row">
   <div class="col-md-12">
    <iframe style="width:100%; border:none; max-height:700px; min-height:500px;" src="http://cloudforcehub.com/interviewxp/admin/members/booking_profile/<?=$totalsetid;?>"></iframe>
   </div>
</div>
</div>

</div>

</div></div>
</div>
<!-- END Main Content -->
<script type="text/javascript">
   $(document).ready(function() {
    /*   $('#table_module').DataTable( {
           "aoColumns": [
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           ]
   
       });

        $('#table_module_company').DataTable( {
           "aoColumns": [
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },

           ]
   
       });

        $('#table_module_ticket').DataTable( {
           "aoColumns": [
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },

           ]
   
       });*/
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
     var input_multi_action = jQuery('input[name="multi_action_upload_approve"]');
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
             jQuery('input[name="multi_action_upload_approve"]').val(action);
   
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
<script>

   function updateComapny(id,company_id,interview_id) {
      $('#update_company').modal('show');
          var company_location = $('#company_location_'+id).val();
          var company_name = $('#company_name_'+id).val();
          $('#company_primary_id').val(id);
          $('#company_id').val(company_id);
          $('#company_name').val(company_name);
          $('#company_location').val(company_location);
          $('#interview_id').val(interview_id);
          var url = "{{url('/')}}/admin/members/update_company";
          $('#form_update_company').attr('action',url);
   }
   function approve_change(val,id,interview_id,status) {

          $('#admin_comments_modal').modal('show');
          $('#inputId').val(id);
          $('#inputValue').val(val);
          $('#inputInterviewId').val(interview_id);
          $('#inputStatus').val(status);
          var url = "{{url('/')}}/admin/members/upload_approve_change";
          $('#form_admin_comment').attr('action',url);

         /*if(confirm('Are you sure to perform this action?'))
         {         
               var token         = $('input[name=_token]').val();
               var approve_id    = id;
               var approve_value = val;
               var status        = status;
               var interview_id  = interview_id;
               
               if(status == 'status_rwe')
               {
                  $tab = 'realissues';
               }
               else if(status == 'status_company')
               {
                  $tab = 'company';
               }
               else
               {
                  $tab = 'interview-qa';
               }
               var success_link  = "{{url('/')}}/admin/members/upload_approve_details/{{ base64_encode($arr_interview_member['id']) }}?t="+$tab;
               //alert(approve_value);
               $.ajax({
               url: "{{url('/')}}/admin/members/upload_approve_change",
               type: "POST",
               async: false,
               data: { _token:token,approve_status:approve_value,id:approve_id,status:status,interview_id:interview_id},
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
          }*/
        return false;   
   }
   function approve_by_admin(val,id,type) 
   {
         if(confirm('Are you sure to perform this action?'))
         {         
               var token         = $('input[name=_token]').val();
               var approve_id    = id;
               var approve_value = val;
               var approve_type = type;
               //var success_link  = "{{url('/')}}/admin/members/upload_approve_details";
               if(type == 'work_exp')
               {
                  $tab = 'realissues';
               }
               else if(type == 'company')
               {
                  $tab = 'company';
               }
               else
               {
                  $tab = '';
               }
               var success_link  = "{{url('/')}}/admin/members/upload_approve_details/{{ base64_encode($arr_interview_member['id']) }}?t="+$tab;
               
               //alert(approve_value);
               $.ajax({
               url: "{{url('/')}}/admin/members/upload_approve_admin_change",
               type: "POST",
               async: false,
               data: { _token:token,approve_status:approve_value,id:approve_id,type:approve_type},
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
   function multi_approve_change(val,id,type,topic) 
   {
         if(confirm('Are you sure to perform this action?'))
         {         
               var token         = $('input[name=_token]').val();
               var approve_id    = id;
               var approve_value = val;
               var approve_type = type;
               var approve_topic = topic;
               var success_link  = "{{url('/')}}/admin/members/upload_approve_details/{{ base64_encode($arr_interview_member['id']) }}";
               //alert(approve_value);
               $.ajax({
               url: "{{url('/')}}/admin/members/part_approve_admin_change",
               type: "POST",
               async: false,
               data: { _token:token,approve_status:approve_value,id:approve_id,type:approve_type,topic:approve_topic},
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
		<style>
		    
		      .video {    text-align: center;
    
    height: 36px;
    border-radius: 4px;
    background-size: cover;
    position: relative;
    width: 41px;
    background-position: center;
    margin-bottom: 5px;     margin-left: 11px;} 
    
 
    
    .img-zoom
{
     height: 72%;
    width: 85%;
  background-size: cover;
  background-position: center;
  transition: all 0.5s ease;
  
}
.img-zoom:hover
{
  transform: scale(1.2);
}
		</style>
		
		
		<div class="modal fade popup-cls in" id="videoplayintro" role="dialog" aria-hidden="false" tabindex="-1" style="    margin-top: 40px !important;" >
				  <div class="modal-dialog">
					 <div class="modal-content">
					
					
					  <button type="button" class="close" data-dismiss="modal" style="    position: absolute;
    z-index: 9999;
    background: white;
    padding: 3px;
    border-radius: 10px;
    right: 0px;">
					      <img src="http://cloudforcehub.com/interviewxp/images/close-img.png" alt="Interviewxp"></button>
					 
						<div class="videouploadidhere" style="width:100%">
				<iframe width="100%" height="315" src="https://www.youtube.com/embed/VFTNOF77bMs?rel=0&amp;controls=0&amp;showinfo=0" 
					frameborder="0" allow="autoplay; encrypted-media"></iframe>
						</div>
				 
					   
						<!--end-->
					 </div>
					 
				  </div>
			   </div>
			   
			   
		

    
    
    
@stop

