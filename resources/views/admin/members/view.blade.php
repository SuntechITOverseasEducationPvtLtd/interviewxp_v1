@extends('admin.layout.master')                
@section('main_content')
 <style type="text/css">
 .value {    word-wrap: break-word; }
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
                     
                     
                     .outer-div
{
  height: 100vh;
  overflow: hidden; 
}
.inner-div
{
  height: 100%;
  width: 100%;
  background-size: cover;
  background-position: center;
  transition: all 0.5s ease;
  background-image: url('http://www.tipue.com/img/yes.jpg');
}
.inner-div:hover
{
  transform: scale(1.2);
}


</style>

<?php 	$obj_member_details = DB::table('member_detail')->where('id',$memberid)->first(); 

$countryDetails = DB::table('countries')->where('id',$obj_member_details->education_country_id)->first();
													$stateDetails = DB::table('state')->where('id',$obj_member_details->education_state)->first();
													$cityDetails = DB::table('city')->where('city_id',$obj_member_details->education_city)->first();
													
													
													
														$banner_image = $arr_data['member_detail']['banner_image']; 
						
						if(!empty($banner_image))
						{
							$bgImage = url('/').'/uploads/profile_images/interviewCoach/'.$banner_image;
						}
						else{
							$bgImage = url('/').'/images/coach_banner.jpg';
						}
						
					
						
						
													?>

<div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat" style="background-color: #f1f1f1;">
         

         <div class="box-content view-details  profile-admin">
          <!--new section start here-->
           <div class="row">
               <div class="col-lg-6" style="background: white;">
                   <div class="pro-block" style=" height: 235px;
    padding-top: 153px;  background:url({{$bgImage}})">
                @if(isset($arr_data['profile_image']) && $arr_data['profile_image']!="") <div class="form-group inner-div"  style="margin: auto;
       width: 161px;
    height: 160px;
    background: url({{ $user_profile_public_img_path.$arr_data['profile_image']}});
    /* cursor: pointer; */
       border-radius: 100px;
    border: 5px solid #f2f5f7; cursor: pointer;
    box-shadow: 0px 0px 28px #0000006e;
    background-position: center top;
    background-size: cover; ">
                </div>
                 @else NA
                        @endif
                 
                 <h5 class="pro-name" style="    background: #ffffff;
    text-align: center;
    color: #171515;
    font-weight: bold; 
   "><span>{{ isset($arr_data['first_name']) && $arr_data['first_name'] !=""  ?ucfirst($arr_data['first_name']):'NA' }}</span> <span>{{ isset($arr_data['last_name']) && $arr_data['last_name'] !=""  ?ucfirst($arr_data['last_name']):'NA' }}</span></h5>
                 
                       
                     
                 
                       
                 </div>
          
                   <div class="admin-pro-info">  
                  
                       <div class="row" style="    padding-top: 103px;">
                           <div class="col-lg-12">
                                <div class="form-group"><div class="col-lg-12" style="    padding: 10px 0px; 5px;
    text-align: center;">
                    {{$obj_member_details->headline}}<br>
                    
                     {{ $countryDetails->country_name or ''}}, {{$stateDetails->state_name or ''}}, {{$cityDetails->city_name or ''}}
                     
                  </div> </div>
                  
                  <div class="form-group"><div class="col-lg-12" style="    padding: 10px 0px 5px;
   ">
                    
                   
                     
                     	<span class="member_summaryhide" style="text-align:justify;">{!!nl2br($obj_member_details->designation)!!}</span>
                     	
                     	
                  </div> </div>
                  	<div class="col-sm-12 more">
                  	<span aria-hidden="true" class="see-more-info-btn"><span>See More</span> <b class="arrow fa fa-angle-right"  style="font-size:24px; color:red"></b></span>
														
														
														
                  </div>
                  						<div class="card hovercard" style="padding-right: 0px;padding-left: 0px;margin-top:10px;height:auto !important;">
													<?php
													$employeeDetails = DB::table('employer_type')->where('member_id', $memberid)->get();
													if(count($employeeDetails) > 0)
													{
													foreach($employeeDetails as $key=>$employee)
													{
														$display = ($key < 2) ? 'show' : 'hide';
														$employer = ($key < 2) ? '' : 'employer';
													?>
													
														@if($key == 0)
														<div class="col-sm-12">
														<h3 style="text-align:left;font-size:20px;     border-top: 1px dotted #aab0b3;">Experience</h3>
														</div>
														@endif
														
														<div class="col-sm-12 employment_details {{$employer}} {{$display}}" style="text-align:left;">
														  <h3 class="desig-details" style="margin-top: 15px;">{{ $employee->designation }}</h3>

														  <p class="company-details">
															<span class="lbl-right" style="line-height: 13px;">{{ ($employee->display_company) ? $employee->display_company : $employee->company_name }}</span>
														  </p>
															<p class="company-join-date" style="line-height: 13px;">
															
																<?php
																	$startDate = $employee->start_year.'-'.$employee->start_month.'-01';
																	if($employee->end_month == 'present')
																	{
																		$end_month = date('m');
																		$end_year = date('Y');
																	}
																	else
																	{
																		$end_month = $employee->end_month;
																		$end_year = $employee->end_year;
																	}
																		
																	
																	$endDate = $end_year.'-'.$end_month.'-01';
																	$datetime1 = new DateTime($startDate);
																	$datetime2 = new DateTime($endDate);
																	$interval = $datetime1->diff($datetime2);
																?>	
																
																@if($employee->employer_type == 'current')																
																<span class="lbl-right">{{ date('M', mktime(0, 0, 0, $employee->start_month, 10)) }} {{ $employee->start_year }} – {{ $employee->end_month }} &nbsp;<b>&#8226;</b>&nbsp;{{$interval->format('%yyrs %mmos')}}</span>	
																@else	
															<?php 	if(isset($employee->end_month)) { ?>
																<span class="lbl-right">{{ date('M', mktime(0, 0, 0, @$employee->start_month, 10)) }} {{ $employee->start_year }} – {{ date('M', mktime(0, 0, 0, @$employee->end_month, 10)) }} {{ $employee->end_year }} &nbsp;<b>&#8226;</b>&nbsp;{{$interval->format('%yyrs %mmos')}}</span>
																<?php } ?>
																
																@endif
															</p>
														  <p class="company-details">
															<?php
																$empCountryDetails = DB::table('countries')->where('id',$employee->country)->first();
																$empStateDetails = DB::table('state')->where('id',$employee->state)->first();
																$empCityDetails = DB::table('city')->where('city_id',$employee->city)->first();
															?>
															<span class="lbl-right" style="line-height: 13px;">{{isset($empCityDetails->city_name)? $empCityDetails->city_name.',' : ''}} {{isset($empCityDetails->state_name) ? $empStateDetails->state_name.',' : ''}} {{isset($empCityDetails->country_name) ? $empCountryDetails->country_name : ''}}</span>
														  </p>		
														  <p class="company-details" style="padding-top: 10px;">
															<span class="lbl-right">{!! nl2br($employee->description) !!}</span>
														  </p>
															<p style="border-bottom: 1px solid #eee;"></p>
															<!--<p class="company-end-date">
															  <span class="lbl-left">Employment Duration : </span>
															  <span  class="lbl-right">1 yr 2 mos</span>
															</p>-->

														</div>
														@if($key == count($employeeDetails)-1 && count($employeeDetails) > 2)
													<div class="col-sm-12 more">
														<span aria-hidden="true" class="see-more-btn"><span>See More</span> 
														<i class="icon-angle-down" style="font-size:24px"></i></span> </div>
														@endif
																											
													<?php } } ?>
													</div>
													
													
													
                  
                   </div>
            
             </div>
             
             </div>
               </div>
               
               <div class="col-lg-6 2nd">
                   
                   
                  <h5 class="panel-title" style="    font-size: 15px;"><i class="icon-transmission" style="color: #13c0b2;
    font-size: 18px;"></i> Revinue History<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
    
   <div class="row" style="background:#fff;margin-left: -7px;width: 101%;">
    <div class="top-blocks-wrapper">
               <div class="col-sm-4">
                  <div class="top-blocks">
                     <div class="content-block" style="
    float: left;
">
                        <h2 style="    font-size: 14px;">INR {{number_format($tot_act_revenue_ern,2)}}/-</h2>

                        <h5 style="font-size: 11px;">TOTAL REVENUE EARNED</h5>
                     </div>
                     <div class="img-top-blocks" style="
    float: right;
"><img src="http://cloudforcehub.com/interviewxp/images/rupies-img.png" alt="Interviewxp" style="
    width: 27px;
    margin-top: 23px;
"></div>
                     <div class="line-img hidden-xs hidden-sm hidden-md"><img src="http://cloudforcehub.com/interviewxp/images/green-line.png" alt="Interviewxp" style="
    width: 100%;
"></div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="top-blocks">
                     <div class="content-block" style="
    float: left;
">
                        <h2 style="
    font-size: 14px;
">INR {{number_format($act_revenue_ern,2)}}/-</h2>
                        <h5 style="
    font-size: 11px;
">CURRENTLY CONFIRMED</h5>
                       
                     </div>
                     <div class="img-top-blocks" style="
    float: right;
"><img src="http://cloudforcehub.com/interviewxp/images/money-img.png" alt="Interviewxp" style="
    width: 30px;
    margin-top: 23px;
"></div>
                     <div class="red-line line-img hidden-xs hidden-sm hidden-md"><img src="http://cloudforcehub.com/interviewxp/images/red-line.png" alt="Interviewxp" style="
    width: 100%;
"></div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="top-blocks">
                     <div class="content-block" style="
    float: left;
">
                        <h2 style="
    font-size: 14px;
">INR {{number_format($act_revenue_pen,2)}}/-</h2>
                        <h5 style="
    font-size: 11px;
">NOT YET CONFIRMED </h5>
                     </div>
                     <div class="img-top-blocks" style="
    float: right;
"><img src="http://cloudforcehub.com/interviewxp/images/blocks-img.png" alt="Interviewxp" style="
    width: 30px;
    margin-top: 30px;
"></div>
                     <div class="line-img hidden-xs hidden-sm hidden-md"><img src="http://cloudforcehub.com/interviewxp/images/blue-line.png" alt="Interviewxp" style="
    width: 100%;
"></div>
                  </div>
               </div>
            </div> </div>
            
            
            
            
            
      
            
            
            
            <div class="row">
            
            
            
            
            
            <div class="table-responsive" style="width: 97%;     margin-left: 4px;">
									<table class="table text-nowrap">
									
										<tbody>
											<tr class="active border-double">
												<td colspan="5">
												
												
												
												 <h5 class="panel-title" style="    font-size: 15px;  padding-top: 20px;"><i class="icon-transmission" style="color: #13c0b2;
    font-size: 18px;    "></i> Skill Info<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
    
    
    </td>
												
											</tr>
<?php $livecpount=0; $viewcount_show=0; $noofsale_show=0; ?>

 @if(isset($arr_interview) && sizeof($arr_interview)>0)
                        @foreach($arr_interview as $key => $uploads)
                        
						<?php
						$refId = base64_encode($uploads['id']);
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
						
   
		 
		 
     $pendingdata =DB::table('multi_reference_book')->where('interview_id',$uploads['id'])->where('approve_status',0)->count(); 
     
     $approves  =DB::table('multi_reference_book')->where('interview_id',$uploads['id'])->where('approve_status',1)->count(); 
        
     $rejects =DB::table('multi_reference_book')->where('interview_id',$uploads['id'])->where('approve_status',2)->count(); 
           
           
           
						 
        $comp_pending =DB::table('interview_detail')->where('interview_id',$uploads['id'])->where('approve_status',0)->count();
        
        $comp_approved =DB::table('interview_detail')->where('interview_id',$uploads['id'])->where('approve_status',1)->count();
        $comp_reject =DB::table('interview_detail')->where('interview_id',$uploads['id'])->where('approve_status',3)->count();
        
        
        
        $work_pending=DB::table('member_real_time_experience')->where('interview_id',$uploads['id'])->where('approve_status',0)->count();
        $work_approved=DB::table('member_real_time_experience')->where('interview_id',$uploads['id'])->where('approve_status',1)->count();
        $work_reject=DB::table('member_real_time_experience')->where('interview_id',$uploads['id'])->where('approve_status',2)->count();
       
        
        if($key>=5) { $disnone="none"; $classrest="restshow";} 
        
        
        
        
        
        
        
        
        
   $arr_interview_member =DB::table('member_interview')->where('id',$uploads['id'])->first(); 
   
   
    $statusQa = '';
    if(!empty($arr_interview_member->is_qa_submitted_review))
    {
       
      $statusQa = '(Requested)';
    }
    else if($arr_interview_member->admin_approval_qa != 1)
    {
      $statusQa = '(Pending)';
    }
    else if($arr_interview_member->admin_approval_qa == 1)
    {
      $statusQa = '(<span style="color:#009900">Live</span>)';
    }
    else if($rejects>=1)
    {
      $statusQa = '(<span style="color:red">Rejected</span>)';
    }
    else
    {
      $statusQa = '(<span style="color:black">Draft</span>)';
    }

    $statusCompany = '';
    if(!empty($arr_interview_member->is_company_submitted_review))
    {
       
      $statusCompany = '(Requested)';
    }
    else if($arr_interview_member->admin_approval_company != 1)
    {
      $statusCompany = '(Pending)';
    }
    else if($arr_interview_member->admin_approval_company == 1)
    {
      $statusCompany = '(<span style="color:#009900">Live</span>)';
    }
       else if($comp_reject>=1) 
    {
      $statusCompany = '(Rejected)';
    }
    else
    {
      $statusCompany = '(<span style="color:black">Draft</span>)';
    }

    $statusRealExp = '';
    if(!empty($arr_interview_member->is_realissues_submitted_review))
    {
    
      $statusRealExp = '(Requested)';
    }
    else if($arr_interview_member->admin_approval_realissues == 0)
    {
      $statusRealExp = '(Pending)';
    }
    else if($arr_interview_member->admin_approval_realissues== 1)
    {
      $statusRealExp = '(<span style="color:#009900">Live</span>)';
    }
      else if($work_reject>=1)
    {
      $statusRealExp = '(Rejected)';
    }
    else
    {
      $statusRealExp = '(<span style="color:black">Draft</span>)';
    }
    
    
    
    
    
        
						?>
                         
					  
											<tr style="    height: 31px; border-bottom: 1px solid #efecec; display:<?=@$disnone;?>" id="{{$uploads['id']}}" class="showdd <?=@$classrest;?>">
												<td class="text-center">
													<h6 class="no-margin">{{$key+1}}   </h6>
												</td>
											
												<td colspan="3">
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">	
														<?php
									$interview_skill_name = '';
									if(isset($uploads['skill_name']) && isset($uploads['experience_level'])  && $uploads['experience_level'] != 'NA')
									{
										$interview_skill_name = $uploads['allskill'].' Real Time Interview Questions &amp; Answers';
									}
									else if(($uploads['skill_name']) && isset($uploads['experience_level'])){									
										$interview_skill_name = $uploads['allskill'].' Interview Questions &amp; Answers';
									}
									$viewcount_show=$uploads['view_count']+$viewcount_show;
									
									
									$noofsale_show=count($uploads['user_purchase_details'])+$noofsale_show;
									
									
							 
									
									
	 

									
							    ?>
                              {{$interview_skill_name}}
                                 <input type="hidden" name="user_purchase_details" id="user_purchase_details{{$key+1}}" value="{{isset($uploads['user_purchase_details'])?count($uploads['user_purchase_details']):''}}"> 
                                 <input type="hidden" name="user_view_count" id="user_view_count{{$key+1}}" value="{{isset($uploads['view_count'])?$uploads['view_count']:''}}"> 
                                 <input type="hidden" name="no_of_views_url" id="no_of_views_url{{$key+1}}" value="{{url('/')}}/interview_details/{{ base64_encode($uploads['id']) }}"> 
                                 <input type="hidden" name="no_of_sales_url" id="no_of_sales_url{{$key+1}}" value="{{url('/')}}/member/revenue_reports"> 
                                 
                                 
                                 
                                 {{isset($uploads['experience_level']) && $uploads['experience_level'] != 'NA'?$uploads['experience_level'].' Year':'NA'}}</span>
													
													
													
													 
  
  
													</a>
												</td>
												
												<td style="    text-align: right;">
												    
												    @if($uploads['is_active'] == 1)
												    
												    <?php $livecpount++; ?>
												    
							<span class="label bg-success heading-text">Live</span>
							
							
							
								@else
							<span class="label bg-success heading-text" style="    background-color: #ff6a71;
    border-color: #ff6a71;">OFF</span>
								</script>
								@endif
								
								
								
												
												</td>
											
											</tr>
											
											
											
											
											<tr style="display:none" class="{{$uploads['id']}}">
											    
											    
											    <td colspan="5">
											        
											        
											         <ul class="nav nav-tabs">
    <li style="width: 24%;
    text-align: center;">
      <a style="font-size: 12px;" data-toggle="tab"
    >Interview   Q & A {!!$statusQa!!}</a><hr>
      <span style="float: left;width: 33%;     text-align: center;"><span class="circle pending" title="Pending"><span>{{ $pendingdata }}</span></span><br>P</span>
      <span style="float: left;width: 33%;     text-align: center;"><span class="circle approve" title="Approved"><span>{{ $approves }}</span></span><br>A</span>
      <span style="float: left;width: 33%;     text-align: center;"><span><span class="circle rejected" title="Rejected"><span>{{  $rejects }}</span></span><br>R</span>
    </li>
  <li style="width: 24%;
    text-align: center;">
      <a style="font-size: 12px;"   data-toggle="tab">Interviews Companies {!!$statusCompany!!}</a><hr>
      <span style="float: left;width: 33%;     text-align: center;"><span class="circle pending" title="Pending"><span>{{ $comp_pending}}</span></span><br>P</span>
      <span style="float: left;width: 33%;     text-align: center;"><span class="circle approve" title="Approved"><span>{{ $comp_approved }}</span></span><br>A</span>
      <span style="float: left;width: 33%;     text-align: center;"><span class="circle rejected" title="Rejected"><span>{{ $comp_reject }}</span></span><br>R</span>
    </li>
  <li style="width: 24%;
    text-align: center;">
      <a style="font-size: 12px;"   data-toggle="tab">Work Experience {!!$statusRealExp!!}</a><hr>
      <span style="float: left;width: 33%;     text-align: center;"><span class="circle pending" title="Pending"><span>{{ $work_pending }}</span></span><br>P</span>
      <span style="float: left;width: 33%;     text-align: center;"><span class="circle approve" title="Approved"><span>{{ $work_approved }}</span></span><br>A</span>
      <span style="float: left;width: 33%;     text-align: center;"><span class="circle rejected" title="Rejected"><span>{{ $work_reject }}</span></span><br>R</span>
    </li>
   <li style="width: 24%;
    text-align: center;">
      <a style="font-size: 12px;"   data-toggle="tab">Booking </a><hr>
      <span style="float: left;width: 33%;     text-align: center;"><span class="circle pending" title="Pending"><span>0</span></span><br>P</span>
      <span style="float: left;width: 33%;     text-align: center;"><span class="circle approve" title="Completed"><span>0</span></span><br>C</span>
      <span style="float: left;width: 33%;     text-align: center;"><span class="circle rejected" title="Refound"><span>0</span></span><br>R</span>
    </li>
    
    </ul>
  
											    </td>
											    
											</tr>
											
											
											
											
											 		  @endforeach
        	@endif
					
										
										</tbody>
									</table>
								</div>
								
								
								
								
									<p  class="moreshowskill" style="    text-align: center;
    font-weight: bold;
    color: #1c8a20;
    cursor: pointer;"><span>See More</span> </p>
								
								
								
								
            
            
            
            
            
            
            
            
            
            
            
            
            </div>
            
            
            
                  
            <div class="row">
            
            
            
            
            
            <div class="table-responsive" style="width: 97%;    margin-left: 4px;">
									<table class="table text-nowrap">
									
										<tbody>
											<tr class="active border-double">
												<td colspan="5">
												
												
												
												 <h5 class="panel-title" style="    font-size: 15px;  padding-top: 20px;"><i class="icon-transmission" style="color: #13c0b2;
    font-size: 18px;    "></i> Company List<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
    
    
    </td>
												
											</tr>
 @if(isset($company_details) && sizeof($company_details)>0 )
												@foreach($company_details as $key => $interview_company)
												
												<?php 
												
        if($key>=5) { $disnones="none"; $classrests="restshows";}  ?>
										 
											<tr style="display:<?=@$disnones;?>" class="<?=@$classrests;?>">
												<td class="text-center">
													<h6 class="no-margin"> {{$key+1}} </h6>
												</td>
											
												<td colspan="3">
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">{{$interview_company->company_name}} ({{$interview_company->company_location}}) 

</span>
													
													</a>
												</td>
												
											<td style="    text-align: right;">
												<span class="label bg-success heading-text"> {{$interview_company->approve_date}}</span>
												</td>
											
											</tr>
										 @endforeach
													  
													@endif

										
										</tbody>
									</table>
								</div>
								
								
								
								
									<p  class="moreshowskilln" style="    text-align: center;
    font-weight: bold;
    color: #1c8a20;
    cursor: pointer;"><span>See More</span> </p>
								
								
								
								
								
								
            
            
            
            
            
            
            
            
            
            
            
            
            </div>
            
            
            
            
            
              <div class="row" style="    margin-left: 4px; ">
                	 <h5 class="panel-title" style="    font-size: 15px;  padding-top: 20px;"><i class="icon-transmission" style="color: #13c0b2;
    font-size: 18px;    "></i> Details<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                
                     
                       <div class="row" style="background:#fff; width:100%">
                           
                           
                           
                           
                           
                           
                           <div class="col-lg-6">
                               
                                  <div class="form-group">
                     <div class="col-sm-6">
                        <label class="title2" >Register On</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">{{ isset($arr_data['created_at']) && $arr_data['created_at'] !=""  ?date(' d  M, Y' ,strtotime($arr_data['created_at'])):'NA' }} </h4>
                     </div>
                  </div>
                  
                  
                  
                               <div class="clearfix"></div>
                          
                       <div class="form-group">
                     <div class="col-sm-6">
                        <label class="title2" >A/C Status</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">
               
                           
                           
                           
                           
                            @if($arr_data['is_deactivate']==1)
                Deactivated  
                    @else
                    
                              
                              {{$arr_data['admin_status'] or 'NA'}} 
                              
                              
                    
                    @endif
                           
                           
                        </h4>
                     </div>
                  </div>
                  
                  
                  
                  
                   <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-6">
                        <label class="title2" >No. Of skills Live</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value"><?=$livecpount;?></h4>
                     </div>
                  </div>
                               
                        
                        
                         <div class="clearfix"></div>
                  <div class="form-group" >
                     <div class="col-sm-6">
                        <label class="title2" >No. Of Sales Transaction</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">
                         <?=$noofsale_show;?>
                        </h4>
                     </div>
                  </div>
                  
                  
                  
                  <div class="clearfix"></div>
                   
                  <div class="form-group">
                     <div class="col-sm-6">
                        <label class="title2" >Disk Uses</label>
                     </div>
                     <div class="col-sm-6">
                     
                      <h4 class="value">--MB</h4>
                      
                     </div>
                  </div>
                  
                  
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                               
                               
                               
                               
                               
                               
                               
                               
                                </div>
                           
                           
                           
                           
                           
                           
                           
                            <div class="col-lg-6"> 
                            
                            
                            
                            
                              
                                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Approved On</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value"> {{ ($arr_data['admin_activated_at'] != '0000-00-00 00:00:00') ? date("j M, Y, g:i A T",strtotime($arr_data['admin_activated_at'])) : '--------'}} </h4>
                     </div>
                  </div>
                  
                  
                  
                               
                                <div class="clearfix"></div>
                                
                                
                                
                                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Activity Status</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value"> 
                        
                        <?php
                        $status = $arr_data['admin_status'];
                     if($status=='Approved')
                    {
                      echo '<span class="label bg-success heading-text">Active</span>';
                    } 
                    else if($status=='Denied' || $status=='Pending')
                    {
                      echo '<span class="label bg-success heading-text" style="background: #ff7043!important;
    border: #ff7043!important;">Inactive</span>';
                    }
                    else {
                    echo '<span class="label bg-grey-400">NA</span>';
                    }
                    ?>
                        
                        
                        </h4>
                     </div>
                  </div>
                  
                  
                  
                               
                                <div class="clearfix"></div>
                                
                                
                                
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >No. of purchase</label>
                     </div>
                     
                     <div class="col-sm-7">
                        <h4 class="value">
                           {{ isset($no_of_purchase)?$no_of_purchase:0 }}
                        </h4>
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  
                                
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >No. of Notification Req.</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{$notificationcount}}</h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  
                  
                                    
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >No. of View</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value"><?=$viewcount_show;?></h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  
                  
                            
                            
                            </div>
                            
                            
                            
                            
                           
                   </div>

                    </div>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
            
            <div class="row" style="    margin-left: 4px; ">
                	 <h5 class="panel-title" style="    font-size: 15px;  padding-top: 20px;"><i class="icon-transmission" style="color: #13c0b2;
    font-size: 18px;    "></i> Personal<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                
                     
                       <div class="row" style="background:#fff; width:100%">
                           
                           
                           
                           
                           
                           
                           <div class="col-lg-6">
                               
                                    
                  <div class="form-group">
                     <div class="col-sm-6">
                        <label class="title2" >Mobile No</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">{{ isset($arr_data['mobile_no']) && $arr_data['mobile_no'] !=""  ?$arr_data['mobile_no']:'NA' }}</h4>
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  
                  
                               
                                 <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-6">
                        <label class="title2" >DOB</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">{{ isset($arr_data['birth_date']) && $arr_data['birth_date'] !=""  ?date(' d  M, Y' ,strtotime($arr_data['birth_date'])):'NA' }}</h4>
                     </div>
                  </div>
                  
                  
                  
                  
                   <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-6">
                        <label class="title2" >Qualification</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">{{ isset($arr_data['member_detail']['qualification'])&& $arr_data['member_detail']['qualification'] !=""  ?$arr_data['member_detail']['qualification']:'NA' }}</h4>
                     </div>
                  </div>
                               
                        
                        
                         <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-6">
                        <label class="title2" >Experience</label>
                     </div>
                     <div class="col-sm-6">
                        <h4 class="value">
                         <?php  $exp_year =   $arr_data['member_detail']['experience_years'];
                                $exp_month =  $arr_data['member_detail']['experience_month'];
                          ?>
                        @if(isset($exp_year) && $exp_year !="" && isset($exp_month) && $exp_month !="")
                        {{ $exp_year.' Years '.$exp_month.' Month'}}  
                        @else NA
                        @endif  
                        </h4>
                     </div>
                  </div>
                  
                  
                  
                  <div class="clearfix"></div>
                   
                  <div class="form-group">
                     <div class="col-sm-6">
                        <label class="title2" >Resume</label>
                     </div>
                     <div class="col-sm-6">
                     @if($arr_data['member_detail']['resume'] !="")
                      <h4 class="value"><a href="{{$member_resume_public_path.$arr_data['member_detail']['resume']}}" download='' ><i class="icon-download" aria-hidden="true"></i></a>
                     @else
                      <h4 class="value">File Not Exists</h4>
                     @endif 
                     </div>
                  </div>
                  
                  
                  <div class="clearfix"></div>
                           
                  <div class="form-group">
                     <div class="col-sm-6">
                        <label class="title2" >I Can Help In</label>
                     </div>
                     <div class="col-sm-6">
                         @if($arr_data['member_detail']['inqa'] ==1)
                     <h4 class="value">Interview Q&A</h4>
                            @endif 
                     
                          @if($arr_data['member_detail']['giveresume'] ==1)
                     <h4 class="value">Interview Coaching & Resume Preparation </h4>
                     @endif 
                     
                          @if($arr_data['member_detail']['collectinterview'] ==1)
                      <h4 class="value">Collect QA's Company </h4>
                      @endif 
                      
                           @if($arr_data['member_detail']['workexp'] ==1)
                       <h4 class="value">Word Experence </h4>
                       @endif 
                     </div>
                  </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                               
                               
                               
                               
                               
                               
                               
                               
                                </div>
                           
                           
                           
                           
                           
                           
                           
                            <div class="col-lg-6"> 
                            
                            
                            
                            
                              <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Email</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($arr_data['email']) && $arr_data['email'] !=""  ?$arr_data['email']:'NA' }}</h4>
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  
                  
                  
                               
                                 <div class="clearfix"></div>
                            
                            <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Pan No</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                           {{ isset($arr_data['member_detail']['pan_no'])&& $arr_data['member_detail']['pan_no'] !=""  ?$arr_data['member_detail']['pan_no']:'NA' }} 
                        </h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  
                  
                                
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Specialization</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($arr_data['member_detail']['specialization'])&& $arr_data['member_detail']['specialization'] !=""  ?$arr_data['member_detail']['specialization']:'NA' }}</h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  
                  
                  
                
	                  <div class="form-group">
	                     <div class="col-sm-5">
	                        <label class="title2" >Address</label>
	                     </div>
	                     <div class="col-sm-7">
	                        <h4 class="value"> 
	                       {{$cityDetails->city_name or ''}}, {{$stateDetails->state_name or ''}}, 	{{ $countryDetails->country_name or ''}}
	                        </h4>
	                     </div>
	                  </div>
                        <div class="clearfix"></div>
	                        
	                  
 
               
                            
                            
                            </div>
                            
                            
                            
                            
                           
                   </div>

                    </div>
                
                
                
                
                
                
                
                
                
                
                
                
                       
                  
            <div class="row">
            
            
            
            
            
            <div class="table-responsive" style="width: 97%;    margin-left: 4px;">
									<table class="table text-nowrap">
									
										<tbody>
											<tr class="active border-double">
												<td colspan="5">
												
												
												
												 <h5 class="panel-title" style="    font-size: 15px;  padding-top: 20px;"><i class="icon-transmission" style="color: #13c0b2;
    font-size: 18px;    "></i> Recent Account Update<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
    
    
    </td>
												
											</tr>

									 @if(isset($logdetailsDetails) && sizeof($logdetailsDetails)>0 )
												@foreach($logdetailsDetails as $key => $logdetailsDetailsF)
											<tr>
												<td class="text-center">
													<h6 class="no-margin">{{$key+1}} </h6>
												</td>
											
												<td colspan="3">
													<a href="#" class="text-default display-inline-block">
														<span class="text-semibold">Account Updated	

</span>
													
													</a>
												</td>
												
											<td style="    text-align: right;">
												<span class="label bg-success heading-text">{{$logdetailsDetailsF->updated_at}}</span>
												</td>
											
											</tr>	
										
										
	 @endforeach
													  
													@endif
										
										</tbody>
									</table>
								</div>
								
								
								
								
								
								
								
								
								
            
            
            
            
            
            
            
            
            
            
            
            
            </div>
            
            
            
            
                
            </div>
            
            
            <!-- end of cols-6 -->
    
                   </div>
                   
                   
                   
           </div>
             </div>
               </div>
         <style>p {
    margin: 0 0 3px;
    text-align: justify;
}
.more { text-align: center;
    font-weight: bold;
    cursor: pointer;}
    h3.desig-details {     font-size: 14px;
    color: #26a69a;
    font-weight: 500; }
    
    .table tr:nth-child(even) {
    background: #ffffff;
}
</style>
<script>
   $(document).ready(function() {
  var showChar = 600;
  var ellipsestext = "...";
  var moretext = "more";
  var lesstext = "less";
  $('.more').each(function() {

    var content = $(this).html();

    if(content.length > showChar) {

      var c = content.substr(0, showChar);
      var h = content.substr(showChar-1, content.length - showChar);

      var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

      $(this).html(html);
    }

  });

  $(".morelink").click(function(){
    if($(this).hasClass("less")) {
      $(this).removeClass("less");
      $(this).html(moretext);
    } else {
      $(this).addClass("less");
      $(this).html(lesstext);
    }
    $(this).parent().prev().toggle();
    $(this).prev().toggle();
    return false;
  });
});

</script>

    <script>
         $(document).ready(function() {
            $('.main-h').click(function() {
                $(this).next('.admin-sub').slideToggle('1000');
                $(this).parent('.cat-main-block').toggleClass('active');
                $(this).find('.arrow i').toggleClass('fa-angle-down fa-angle-up')
            });
        });
    
    </script>
 
    	<script>
														$(document).ready(function(){
															$(".seemore_whats_include").click(function(){
																$(".whats_inclde").toggleClass('hide show');
																$(this).hide();
																$('.less_whats_include').show();
															});
															$(".less_whats_include").click(function(){
																$(".whats_inclde").toggleClass('show hide');
																$(this).hide();
																$('.seemore_whats_include').show();
															});
															$(".seemore_adv_coach").click(function(){
																$(".adv_coach").toggleClass('hide show');
																$(this).hide();
																$('.less_adv_coach').show();
															});
															$(".less_adv_coach").click(function(){
																$(".adv_coach").toggleClass('show hide');
																$(this).hide();
																$('.seemore_adv_coach').show();
															});
															$(".see-more-btn").click(function(){
																$(".employer").toggleClass('show hide');
																$(this).find('i').toggleClass('fa-angle-down fa-angle-up');
																var text = $(this).find('span').html();
																if(text == 'See More')
																{
																	$(this).find('span').html('See Less');
																}
																else{
																	$(this).find('span').html('See More');
																}
																
															});
															$(".see-more-info-btn").click(function(){
																$(".member_summary").toggleClass('show hide');
																$(this).find('i').toggleClass('fa-angle-down fa-angle-up');
																var text = $(this).find('span').html();
																if(text == 'See More')
																{
																	$(this).find('span').html('See Less');
																}
																else{
																	$(this).find('span').html('See More');
																}
																
															});
															
															$("#coach_notify").click(function(){
																var coach_notify =  $("input:checkbox[name='coach_notify']:checked").length;
																if(coach_notify > 0)
																{
																	$('#coach_notify_alert').modal('show');
																}
															});
															
															
														
														});
																											</script>
																											
																										<style type="text/css">
           .circle {
                padding: 2px 6px 2px 6px;
                border: 1px solid #525252;
                margin-left: 2px;
                vertical-align: middle;
                border-radius: 50%;
                position: relative;
                cursor: pointer;
                font-size: 13px;
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
         </style>
    <script> 
$(document).ready(function(){  
    $(".showdd").click(function(){
        
        $ids=$(this).attr('id');  
         $('.'+$ids).slideToggle("slow");
    });
    
    $(".moreshowskill").click(function(){
        
       
         $('.restshow').slideToggle("slow");
    });
    
      $(".moreshowskilln").click(function(){
        
       
         $('.restshows').slideToggle("slow");
    });
    
    
});
</script>
@stop

