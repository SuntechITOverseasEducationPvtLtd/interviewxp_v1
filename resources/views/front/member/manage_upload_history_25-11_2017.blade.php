@extends('front.layout.main')
@section('middle_content')
<style>
#loader-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
	display:none;
}
#loader {
    display: block;
    position: relative;
    left: 50%;
    top: 50%;
    width: 150px;
    height: 150px;
    margin: -105px 0 0 -45px;
    border: 3px solid transparent;
}

    #loader:before {
        content: "";
        position: absolute;
        top: 5px;
        left: 5px;
        right: 5px;
        bottom: 5px;
    }

    #loader:after {
        content: "";
        position: absolute;
        top: 15px;
        left: 15px;
        right: 15px;
        bottom: 15px;
    }
</style>
<div id="member-header" class="after-login"></div>
<div class="banner-member">
   <div class="pattern-member">
   </div>
</div>
<div id="loader-wrapper">
	<div id="loader"><img src="{{url('/')}}/images/page-loader.gif" style="width: 55%;" /></div>
</div>
<div class="container-fluid fix-left-bar">
   <div class="row">
      @include('front.member.member_sidebar')  
      <div class="col-sm-9 col-md-9 col-lg-10 middle-content">
         <div class="row">
         	<div class="col-sm-12 uploads-title">
            	<h2 class="col-sm-3 my-profile m-history">Manage Uploads</h2>
            	<div class="col-sm-3 right-block" style="display: none">
                  <h5>Profile Performance</h5>
                  <div class="col-xs-6 col-md-9 col-lg-6 new-perfrom">
                  	 <a href="#" class="no_of_views_url" target="_blank">	
                     <div class="table-number no-of-views">1</div>
                     <div class="radio-btns table-radio-btn">
                        <div class="radio-btn">
                           <!-- <input id="Radio1" name="selector" type="radio"> -->
                           <label for="Radio1">No. of views</label>
                           <div class="check new-top"></div>
                        </div>
                     </div>
                     </a>
                  </div>
                  <div class="col-xs-6 col-md-9 col-lg-6 new-perfrom">
              		 <a href="#" class="no_of_sales_url" target="_blank">
                     <div class="table-number no-of-sales">0</div>
                     <div class="radio-btns table-radio-btn">
                        <div class="radio-btn">
                           <!-- <input id="Radio2" name="selector" type="radio"> -->
                           <label for="Radio2">No. of Sales</label>
                           <div class="check new-top"></div>
                        </div>
                     </div>
                     </a>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
            
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
            
               <div class="outer-box history-page">
                  <!--                  <h4>Interviews</h4>-->
                  <!-- tabbing section -->
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr class="t-head">
                              <td>S.No</td>
                              <td>Description</td>
                              <td>Experience Level</td>
                              <td>Options</td>
                              <td>&nbsp;</td>
                           </tr>
                        </thead>
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
						
						?>
                        <thead class="box  hideRow hideRow{{$key+1}}" style="{{ $styleRef }}" >
                           <tr class="top hideAll" id="{{$key+1}}">
                              <td>{{$key+1}}</td>
                              <td>
								<?php
									$interview_skill_name = '';
									if(isset($uploads['skill_name']) && isset($uploads['experience_level'])  && $uploads['experience_level'] != 'NA')
									{
										$interview_skill_name = $uploads['skill_name'].' Real Time Interview Questions &amp; Answers';
									}
									else if(($uploads['skill_name']) && isset($uploads['experience_level'])){									
										$interview_skill_name = $uploads['skill_name'].' Interview Questions &amp; Answers';
									}
							    ?>
                                 {{$interview_skill_name}}
                                 <input type="hidden" name="user_purchase_details" id="user_purchase_details{{$key+1}}" value="{{isset($uploads['user_purchase_details'])?count($uploads['user_purchase_details']):''}}"> 
                                 <input type="hidden" name="user_view_count" id="user_view_count{{$key+1}}" value="{{isset($uploads['view_count'])?$uploads['view_count']:''}}"> 
                                 <input type="hidden" name="no_of_views_url" id="no_of_views_url{{$key+1}}" value="{{url('/')}}/interview_details/{{ base64_encode($uploads['id']) }}"> 
                                 <input type="hidden" name="no_of_sales_url" id="no_of_sales_url{{$key+1}}" value="{{url('/')}}/member/revenue_reports">  
                              </td>
                              <td>
                                 {{isset($uploads['experience_level']) && $uploads['experience_level'] != 'NA'?$uploads['experience_level'].' Year':'NA'}}
                              </td>
                               <td>
	                              @if($uploads['admin_approval']==0)
	                              <a href="{{url('/')}}/member/delete-skill/{{ base64_encode($uploads['id']) }}" onclick="return confirm('Are you sure want to cancel the skill?')"><i class="fa fa-minus-circle" aria-hidden="true" title="Delete Skill"></i>
	                              </a>
	                               <a href="{{url('/')}}/member/update-skill/{{ base64_encode($uploads['id']) }}"><i class="fa fa-pencil" aria-hidden="true" title="Update Skill"></i>
	                              </a> 
	                              @endif                             
                              </td>
                              <td><img src="{{url('/')}}/images/plus_faq.png" /></td>
                           </tr>
						  
                           <tr class="bottom" style="{{ $styleBottomRef  }}" >
                              <td colspan="4">
                                 <div class="multi-tabbing">
								    <div class="panel with-nav-tabs panel-default">
										<div class="panel-heading">
											<ul class="nav nav-tabs">
												<li {!! ($tab == 'interview-qa' || $tab == '') ? 'class="active"' : ''  !!}><a style="font-size: 14px;" href="#tab1default{{$uploads['id']}}" data-toggle="tab"
												>Interview Q & A</a></li>
												@if(!empty($arr_user_info[0]['company_qa_tab']))
												<li {!! ($tab == 'company') ? 'class="active"' : ''  !!}><a style="font-size: 14px;" href="#tab2default{{$uploads['id']}}" data-toggle="tab">Interviews by Companies</a></li>
												@endif
												@if(!empty($arr_user_info[0]['real_issues_qa_tab']))
												<li {!! ($tab == 'realissues') ? 'class="active"' : ''  !!}><a style="font-size: 14px;" href="#tab3default{{$uploads['id']}}" data-toggle="tab">Real Time Issues (Tickets, Tasks, Etc.,)</a></li>
												@endif
												<li><a style="font-size: 14px;" href="{{url('/member/biography')}}">Bookings</a></li>
											</ul>
										</div>
										<div class="panel-body">
											<div class="tab-content">
												<div {!! ($tab == 'interview-qa' || $tab == '') ? 'class="tab-pane fade in active"' : 'class="tab-pane fade"'  !!} id="tab1default{{$uploads['id']}}">
													<!--tab 1-->
													<div class="middle-box">
													   <div class="sub-tab">
														  <div class="ref-book" style="width: 100%;">
																<!--<i class="fa fa-star" aria-hidden="true"></i>Interview Reference Book-->
																<!--<span data-toggle="modal" href="#ref-book-{{$uploads['id']}}">
																<i class="fa fa-plus" aria-hidden="true"></i>
																</span> --> 
																<span class="addTopicMain" style="background-color: #17b0a4;color:#fff;border: 1px solid #17b0a4;padding:5px;">
																	<i class="fa fa-plus" aria-hidden="true"></i><span style="color:#fff">Add Topic</span>
																 </span>												
																<div style="clear:both;"></div>
																<div class="form-group topicText" style="padding:10px;">
																   <div class="row" style="margin-top:10px">
																	  <!--<div class="col-sm-10 col-md-10 col-lg-10">
																			<label class="col-sm-10 col-md-10 col-lg-10" style="border: 1px solid #ccc;padding: 8px;margin-bottom: 15px;width:79%">Add New Topic</label> 
																	  </div>
																	  <div class="col-sm-2 col-md-2 col-lg-2"></div>-->
																	  <div class="col-sm-12 col-md-12 col-lg-12">
																			<label>Enter The Title of New Topic<span class="error" style="color:red;">*</span></label><span class="pull-right" style="font-size: 13px;" maxlength="150"><span id="charNum" style="font-size: 13px;">0</span> of 150 Characters Used</span> 
																	  </div>
																	  
																	  <div class="col-sm-12 col-md-12 col-lg-12">
																		 <div><input class="input-box-signup topicTextbox{{$uploads['id']}} col-sm-7"  type="text" id="topic_name-reference-{{@$uploads['id']}}" name="topic_name" value="{{@$uploads['topic_name']}}"  onkeyup="countChar(this)"></div>
																		 <div id="reference_error_topic-{{@$uploads['id']}}" class="error"></div>
																		 <div id="len_reference_error_topic-{{@$uploads['id']}}" class="error"></div>
																		 <!-- actions-->
																		 <div class="actionsBooks" style="text-align: center;">
																			<a href="javascript:;" class="cancelBookBtn" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;margin-right: 20px;">Cancel</a>
																			<button class="member-profile-btn  ctn saveBookBtn" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;">Save</button>																			
																		 </div>
																	  </div>
																	  
																   </div>
																</div>
														  </div>
													   </div>
													   <div class="table-search-pati section1-tab add-skiils-table middle-bottom">
														  <div class="table-responsive" style="overflow-x: hidden;">
															<div>
																 <table class="table table-striped" id="interviewqalist">
																	<thead>
																		
																	</thead>
																		
																	<tbody id="interview-qa-list">
																	   @if(isset($uploads) && sizeof($uploads)>0)
																	  
																	   <?php
																		$reference_book_details = DB::table('multi_reference_book')
																				->select('*')
																				->where(['interview_id'=>$uploads['id']])
																				->groupBy('topic_name')
																				->orderBy('id','DESC')
																				->orderBy('approve_status','DESC')
																				->paginate(10);
																	   
																	   ?>
																	   @include('front.member.interview_qa',['page'=>1, 'reference_book_details' =>$reference_book_details, 'interview_id'=>$uploads['id']])
																 
																	   @else
																	   <tr>
																		  <td style="color:red;">
																			 No Records found...
																		  </td>
																	   </tr>
																	   @endif
																	</tbody>
																</table>		
															</div>
															 
															 <!-- Ramakrishna -->
																
															 </div>
														  </div>
													   </div>
												</div>
												@if(!empty($arr_user_info[0]['company_qa_tab']))
												<div  {!! ($tab == 'company') ? 'class="tab-pane fade in active"' : 'class="tab-pane fade"'  !!} id="tab2default{{$uploads['id']}}">
													<div class="middle-box">
														<div class="sub-tab">
														   <div class="ref-book col-sm-12">
															  <h4 data-toggle="modal" href="#interview">
															  <!--<i class="fa fa-star" aria-hidden="true"></i>Interviews by Companies --> 
																 <!--<span data-toggle="modal" href="#company-{{$uploads['id']}}">
																 <i class="fa fa-plus" aria-hidden="true"></i>
																 </span>-->
																 <span class="addTopicMainCompany" style="background-color: #17b0a4;color:#fff;border: 1px solid #17b0a4;padding:5px;">
																	<i class="fa fa-plus" aria-hidden="true"></i><span style="color:#fff">Add Company &nbsp;</span>
																 </span>
															  </h4>
														   </div>
														   <!-- form start -->
														<div class="col-sm-12">
															  {{ csrf_field() }}
															  <div id="error_company-{{@$uploads['id']}}" class="error" style="color:red;"></div> 
															  <div id="success_company-{{@$uploads['id']}}" style="color:green;"></div>   
															  <input type="hidden" id="skill_id_company-{{@$uploads['id']}}" value="{{@$uploads['skill_id']}}">
															  <input type="hidden" id="experience_level_company-{{@$uploads['id']}}" value="{{@$uploads['experience_level']}}">
															  <div style="color:green;" id="success_msg-{{@$uploads['id']}}"></div>
															  <div class="CompanyAll" style="width:96%;margin:0px auto;">
																 <input type="hidden" name="roundTypeVal" class="roundTypeVal">
																  
																   <div style="clear:both;"></div><br/>
																  <div class="form-group Company">
																	  <div class="col-sm-12 col-md-4 col-lg-4">
																	  <label>Company Name<span class="star" style="color:red;">*</span></label> <br/>
																	  </div>
																	  <div class="col-sm-12 col-md-8 col-lg-8" style="margin-bottom: 10px;">
																		  <input class="input-box-signup CompanyTextValue{{$uploads['id']}}" type="text" placeholder="Wipro" id="company_name-{{@$uploads['id']}}" name="company_id">
																	  </div>
																	  <div class="col-sm-12 col-md-4 col-lg-4">
																	  <label>Location<span class="star" style="color:red;">*</span></label> 
																	  </div>
																	  <div class="col-sm-12 col-md-8 col-lg-8">
																		  <input class="input-box-signup LocationTextValue{{$uploads['id']}}" type="text"  placeholder="Madhapur, Hyderabad" id="company_location-{{@$uploads['id']}}" name="company_location">
																		  
																		  <div id="error_company_name-{{@$uploads['id']}}" class="error"></div>
																		  <div id="len_error_company_name-{{@$uploads['id']}}" class="error"></div>
																		  <div class="actionsCompany">
																		  	<a href="javascript:;" class="cancelCompanyBtn" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;margin-right: 20px;">Cancel</a>
																			<button class="member-profile-btn ctn saveCompanyBtn" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;">Save</button>
																		 </div>
																	  </div>
																  </div>
																  <div style="clear:both;"></div><br/>
																  <!-- <div class="form-group callEmailMain">
																	  <div class="callEmail" style="width:96%;margin:0px auto;border: 1px solid rgba(39, 9, 9, 0.28);height: 43px;padding: 10px;">
																		  <div class="col-sm-12 col-md-8 col-lg-8"><label>Call/Email Schedule</label></div>
																		  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
																			  <span class="addCallEmail" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
																		  </div>
																	  </div>
																	  <br/>
																	  <div class="col-sm-12 col-md-12 col-lg-12 CallIcons" style="border: 1px solid rgba(39, 9, 9, 0.28);padding: 10px;">
																		<p class="titleTxt">Call/Email Schedule</p>
																		<div class="col-sm-12 col-md-4 col-lg-4 videoIconCall" style="display: block;"><i class="fa fa-play" style="font-size:30px; border: 1px solid #ccc;padding: 15px;margin-top:10px;"></i><span style="clear: both;display: block;">Video (MP4)</span></div>
																		<div class="col-sm-12 col-md-4 col-lg-4 pdfIconCall" style="display: block;"><i class="fa fa-file-pdf-o" style="font-size:30px; border: 1px solid #ccc;padding: 15px;margin-top:10px;"></i><span style="clear: both;display: block;margin-left: 20px;">Pdf</span></div>
																		<div style="clear:both;"></div>
																	  </div>
																	  <div style="clear:both;"></div><br/>
																	  <div class="form-group callEmailPdf">
																		 <div class="col-sm-12 col-md-12 col-lg-12" style="border: 1px solid rgba(39, 9, 9, 0.28);padding: 10px;">
																			  <p class="titleTxt">Call/Email Schedule</p>
																			  <div class="input-group" style="width:100%;">
																				  <div class="btn btn-primary" style="background-color: #eee;border:none;">
																					<input id="company_file-{{@$uploads['id']}}" accept="application/pdf" class="company_fileCallPdf-{{@$uploads['id']}} company_fileCallPdf" name="company_file" type="file">
																				  </div>
																				  
																					<button class="member-profile-btn cancelCallEmailPdfBtn" style="margin-left:10px;float:right;width:100px;">Cancel</button>
																				  <button type="button" id="create_company" onclick="javascript: return companyupload({{@$uploads['id']}});" class="submit-btn ctn" style="margin-left:10px;float:right;width:100px;">Upload</button>
																				  <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_company_file-{{@$uploads['id']}}">
																				  <a class="file" onclick="removecompanyfile({{@$uploads['id']}})"><i class="fa fa-trash"></i>
																				  </a>
																				  </div>
																				  <input class="form-control file-caption  kv-fileinput-caption" id="company_file_name-{{@$uploads['id']}}" disabled="disabled" type="text">
																				  <h5 class="upload">Support Formats: PDF, Max File 5 MB</h5>
																				  <div id="company_create_error_attachment-{{@$uploads['id']}}" class="error" style="left:0;"></div>
																				  <div id="create_error_msg-{{@$uploads['id']}}" class="error" style="left:0;"></div>
																			  </div>
																		  </div>
																	  </div>
																	  <div style="clear:both;"></div><br/>
																	  <div class="form-group callEmailVideo">
																	  <p class="titleTxt">Call/Email Schedule</p>
																		 <div class="col-sm-12 col-md-12 col-lg-12" style="border: 1px solid rgba(39, 9, 9, 0.28);padding: 10px;">
																			  <input id="company_file-{{@$uploads['id']}}"  style="visibility:hidden; height: 0;" name="company_file" type="file">
																			  <div class="input-group" style="width:100%;">
																				  <div class="btn btn-primary" style="background-color: #eee;border:none;">
																					<input id="company_file-{{@$uploads['id']}}" onchange="setFileInfoCall(this.files)" accept="video/mp4"
																					class="company_fileCallVideo-{{@$uploads['id']}} company_fileCallVideo"  name="company_file" type="file">
																				  </div>
																				  <input type="hidden" name="durationVideoCall" id="durationVideoCall">
																				 <button class="member-profile-btn cancelCallEmailVideoBtn" style="margin-left:10px;width:100px; float:right">Cancel</button>
																				  <button type="button" id="create_company" onclick="javascript: return companyupload({{@$uploads['id']}});" class="submit-btn ctn" style="margin-left:10px;width:100px; float:right">Upload</button>
																				  <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_company_file-{{@$uploads['id']}}">
																				  <a class="file" onclick="removecompanyfile({{@$uploads['id']}})"><i class="fa fa-trash"></i>
																				  </a>
																				  </div>
																				  <input class="form-control file-caption  kv-fileinput-caption" id="company_file_name-{{@$uploads['id']}}" disabled="disabled" type="text">
																				  <h5 class="upload">Support Formats: MP4, Max File 300 MB</h5>
																				  <h5 class="upload">Tip: video is InterviewXp's preferred delivery type wide screen 16:9 ratio is preferred. Please note that the average video length is within 5-10 minutes. Content should be with high resolution video 720p (1280x720)</h5>
																				  <div id="company_create_error_attachment-{{@$uploads['id']}}" class="error" style="left:0;"></div>
																				  <div id="create_error_msg-{{@$uploads['id']}}" class="error" style="left:0;"></div>
																			  </div>
																		  </div>
																	  </div>
																  </div> -->

																  <div style="clear:both;"></div><br/>
																  <div class="form-group WrittenTestRoundMain">
																		<div class="WrittenTestRound" style="width:96%;margin:0px auto;border: 1px solid rgba(39, 9, 9, 0.28);height: 43px;padding: 10px;">
																		  <div class="col-sm-12 col-md-8 col-lg-8"><label>1st Round&nbsp;&nbsp;-&nbsp;&nbsp;(Written Test)</label></div>
																		  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
																			  <span class="addWrittenRound" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
																		  </div>
																	  </div>
																  </div>
																  
																  <div style="clear:both;"></div><br/>
																  <div class="form-group TechnicalRoundMain">
																		<div class="TechnicalRound" style="width:96%;margin:0px auto;border: 1px solid rgba(39, 9, 9, 0.28);height: 43px;padding: 10px;">
																		  <div class="col-sm-12 col-md-8 col-lg-8"><label>2nd Round&nbsp;&nbsp;-&nbsp;&nbsp;(Technical Round)</label></div>
																		  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
																			  <span class="addTechRound1" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
																		  </div>
																	  </div>
																  </div>
																  
																  <div style="clear:both;"></div><br/>
																  <div class="form-group PMRoundMain">
																	  <div class="PMRound"  style="width:96%;margin:0px auto;border: 1px solid rgba(39, 9, 9, 0.28);height: 43px;padding: 10px;">
																		  <div class="col-sm-12 col-md-8 col-lg-8"><label>3rd Round&nbsp;&nbsp;-&nbsp;&nbsp;(PM Round)</label></div>
																		  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
																			  <span class="addPmRound1" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
																		  </div>
																	  </div>
																  </div>
																  
																  <div style="clear:both;"></div><br/>
																  <div class="form-group HRRoundMain">
																	  <div class="HRRound" style="width:96%;margin:0px auto;border: 1px solid rgba(39, 9, 9, 0.28);height: 43px;padding: 10px;">
																		  <div class="col-sm-12 col-md-8 col-lg-8"><label>4th Round&nbsp;&nbsp;-&nbsp;&nbsp;(HR Round)</label></div>
																		  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
																			  <span class="addHrRound1" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
																		  </div>
																	  </div>
																  </div>
						  				  
															  </div>


															  <div style="clear:both;"></div>
														  </div>
														<!-- form end -->
														</div>
														<div class="table-search-pati section1-tab add-skiils-table middle-bottom">
														   <div class="table-responsive">
															  <table class="table" id="interviewcompanylist">
																 <tbody>
																	@if(isset($uploads) && sizeof($uploads)>0)
																	<?php
																	 //$companyResults = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$uploads['id']."' group by company_id ORDER BY `id` DESC, `approve_status` DESC") );
																	 $companyResults = DB::table('interview_detail')
																				->select('*')
																				->where(['interview_id'=>$uploads['id']])
																				->groupBy('company_id')
																				->orderBy('id','DESC')
																				->orderBy('approve_status','DESC')
																				->paginate(10);	
																	?>

																	@include('front.member.interview-company',['page'=>1, 'results' =>$companyResults, 'interview_id'=>$uploads['id']])
															   		@else
																   <tr>
																   <td style="color:red;">
																   No Records found...
																   </td>
																   </tr>
																   @endif
																   </tbody>
															   </table>
														</div>
														
													 </div>
													</div>
												</div>
												@endif
												@if(!empty($arr_user_info[0]['real_issues_qa_tab']))
												<div {!! ($tab == 'realissues') ? 'class="tab-pane fade in active"' : 'class="tab-pane fade"'  !!} id="tab3default{{$uploads['id']}}">
													<!--tab 3-->
												   <div class="middle-box">
												   <div class="sub-tab">
												   <div class="ref-book">
												   <h4><!--<i class="fa fa-star" aria-hidden="true"></i>Real Time Issues (Tickets, Tasks, Etc.,)-->
												   <!--<span data-toggle="modal" href="#real-time-create-{{$uploads['id']}}">
												   <i class="fa fa-plus" aria-hidden="true"></i>
												   </span>-->
												   <span class="addTopicMainReal" style="background-color: #17b0a4;color:#fff;border: 1px solid #17b0a4;padding:5px;">
													<i class="fa fa-plus" aria-hidden="true"></i><span style="color:#fff">Add &nbsp;</span>
													@if(isset($uploads['realtime_details']) && sizeof($uploads['realtime_details'])>0)
													<?php
														$countRealissues = DB::table('member_real_time_experience')
																	->select('*')
																	->where(['interview_id'=>$uploads['id']])
																	->orderBy('id','DESC')
																	->count();			
													?>
													@endif
												 </span>
												   </h4>
												   </div>
												   <div>
													<div class="col-sm-12 col-md-12 col-lg-12">
													 </div>
													 <div style="clear:both;"></div>
													 <div class="addbook">
														   <div style="color:green;" id="realtime-create-success_msg-{{$uploads['id']}}" ></div>
														   <div id="error_realtime_create_msg-{{$uploads['id']}}"></div>
														   {{ csrf_field() }}
														   
														   <input type="hidden" name="skill_id" id="realtime_skill_id-{{$uploads['id']}}" value="{{base64_encode($uploads['skill_id'])}}">
														   <input type="hidden" name="experience" id="realtime_experience-{{$uploads['id']}}" value="{{base64_encode($uploads['experience_level'])}}">
														<div style="clear:both;"></div>
														<div class="form-group topicTextReal">
														   <div class="row" style="margin:0px !important;">
														   <div class="col-sm-12 col-md-12 col-lg-12">
																<label>Enter New Real Time Issue<span class="error" style="color:red;">*</span></label>
														   </div>
														   <div class="col-sm-12 col-md-12 col-lg-12">
															   <textarea class="input-box-signup topicTextValueReal{{$uploads['id']}}" type="text" style="height:45px;" id="create_issue_title-{{@$uploads['id']}}" name="issue_title"></textarea>
															   <div id="error_issue_title-{{@$uploads['id']}}" class="error"></div>
															   <div id="len_error_issue_title-{{@$uploads['id']}}" class="error"></div>
															   
															   <!-- actions-->
															 <div class="actionsReal" style="text-align: center;">
															 	<a href="javascript:;" class="cancelRealBtn" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;margin-right: 20px;">Cancel</a>
																<button class="member-profile-btn ctn saveRealBtn" incre="{{@$countRealissues}}" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;">Save</button>
															 </div>
														   </div>
														   </div>
														</div>
														<div style="clear:both;"></div>
														<!-- topic save -->
														<div class="form-group topicSaveReal">
															<div class="col-md-12" style="background: #ecf8f7;height: 40px;">
																<span class="col-md-8 addTopicnameReal" style="margin-top: 8px;"></span>
																<span class="col-md-1 editTopicReal" style="margin-top: 8px;"><i class="fa fa-pencil"></i></span>
																<span class="col-md-1 deleteTopicReal" style="margin-top: 8px;"><i class="fa fa-trash-o"></i></span>
																<span class="col-md-2 showPDFExcelReal" style="margin-top: 3px;background-color: #17b0a4;border: 1px solid #17b0a4;border-radius: 3px;color: #fff;padding: 5px;float:right"><i class="fa fa fa-plus"></i> Add Content</span>
															</div>
														</div>
														<div style="clear:both;"></div>
														<div class="form-group realIcons"  style="border: 1px solid #ccc; margin-top:10px;padding:10px;">
														  <div class="row">
															<div class="col-sm-4 col-md-4 col-lg-4"></div>
															<div class="col-sm-4 col-md-4 col-lg-4" style="margin-top:10px;">
																<div class="col-sm-12 col-md-6 col-lg-6 videoIconReal"><i class="fa fa-play" aria-hidden="true" style="font-size:30px; border: 1px solid #ccc;padding: 15px;"></i> <span style="clear: both;display: block;">Video (MP4)</span></div>
																<div class="col-sm-12 col-md-6 col-lg-6 pdfIconReal"><i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:30px; border: 1px solid #ccc;padding: 15px;"></i><span style="clear: both;display: block;margin-left: 20px;">Pdf</span></div>
																<div style="clear:both;"></div>
															</div>
														   </div>
														</div>
														<div class="clearfix"></div>
														<div class="form-group">
														  <div class="row">
															
															<div class="col-sm-12 col-md-12 col-lg-12">
																<div class="videoclassReal" style="border: 1px solid #ccc;padding:15px;">
																
																   <div class="input-group  col-sm-12 col-md-12 col-lg-12">
																	   <div class="col-sm-6 col-md-6 col-lg-6 btn btn-primary btn-gry" style="background-color: #eee;border:none;">
																	   <input id="createrealtime-{{$uploads['id']}}" class="createrealtimeVideo-{{$uploads['id']}} createrealtimeVideo" accept="video/mp4" onchange="setFileInfoReal(this.files)" name="file" type="file">
																	   </div>
																	   <input type="hidden" name="durationVideoReal" id="durationVideoReal">
																	   <div class="col-sm-6 col-md-6 col-lg-6">
																			
																			<div class="btn btn-warning cancelFinalBtnReal" style="padding: 11px;height: 39px;margin-left:10px;margin-top: 0px;float:right;background-color: rgb(23, 176, 164);width:100px; border:none;">Cancel</div>
																			<button type="button" onclick="javascript:return create_realtime({{$uploads['id']}});"  class="btn ctn" style="width:100px; float:right;height: 39px;margin-top: 1px;background: #fc575c;color:#fff;">Upload</button>
																		</div>
																	   <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="createbtn_remove_image">
																	   <a class="file" onclick="removerealtimefile({{$uploads['id']}})"><i class="fa fa-trash"></i>
																	   </a>
																	   </div>
																	   <input class="form-control file-caption  kv-fileinput-caption" id="createrealtime_name-{{$uploads['id']}}" disabled="disabled" type="text">
																	   <h5 class="upload">Support Formats: MP4, Max File 300 MB</h5>
																	   <h5 class="upload">Tip: video is InterviewXp's preferred delivery type wide screen 16:9 ratio is preferred. Please note that the average video length is within 5-10 minutes. Content should be with high resolution video 720p (1280x720)</h5>
																		<div id="error_create_realtime_file_required-{{$uploads['id']}}" class="error"></div>
																   </div>
																</div>
																<div class="pdfclassReal" style="border: 1px solid #ccc;padding:15px;">
																	
																   <div class="input-group  col-sm-12 col-md-12 col-lg-12">
																	   <div class="col-sm-6 col-md-6 col-lg-6 btn btn-primary  btn-gry" style="background-color: #eee;border:none;">
																	   <!--<a class="file" onclick="create_real_time_file({{$uploads['id']}})">Choose File
																	   </a>-->
																	   <input id="createrealtime-{{$uploads['id']}}" class="createrealtimePdf-{{$uploads['id']}} createrealtimePdf" accept="application/pdf" name="file" type="file">
																	   </div>
																	   <div class="col-sm-6 col-md-6 col-lg-6">
																			
																			<div class="btn btn-warning cancelFinalBtnReal" style="padding: 11px;height: 39px;margin-left:10px;margin-top: 0px;width:100px;float:right;    background-color: rgb(23, 176, 164);border:none">Cancel</div>
																			<button type="button" onclick="javascript:return create_realtime({{$uploads['id']}});"  class="btn ctn" style="width:100px;float:right;height: 39px;margin-top: 1px;background: #fc575c;color:#fff;">Upload</button>
																		</div>
																	   <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="createbtn_remove_image">
																	   <a class="file" onclick="removerealtimefile({{$uploads['id']}})"><i class="fa fa-trash"></i>
																	   </a>
																	   </div>
																	   <input class="form-control file-caption  kv-fileinput-caption" id="createrealtime_name-{{$uploads['id']}}" disabled="disabled" type="text">
																	   <h5 class="upload">Support Formats:PDF, Max File 2 MB</h5>
																		<div id="error_create_realtime_file_required-{{$uploads['id']}}" class="error"></div>
																   </div>
																</div>
															</div>
														  </div>
														</div>
														</div>
														</div>
												   </div>
												   <div class="table-search-pati section1-tab add-skiils-table middle-bottom">
												   <div class="table-responsive">
												   <table class="table" id="interview-realtime-issues">
													   <tbody>
													   @if(isset($uploads['realtime_details']) && sizeof($uploads['realtime_details'])>0)
														<?php
													   //$results = DB::select( DB::raw("SELECT * FROM member_real_time_experience WHERE interview_id = '".$uploads['id']."' group by issue_title ORDER BY `id` DESC") );
													   $results = DB::table('member_real_time_experience')
																->select('*')
																->where(['interview_id'=>$uploads['id']])
																->groupBy('issue_title')
																->orderBy('id','DESC')
																->paginate(10);
														?>
														
														@include('front.member.interview_realissues',['page'=>1, 'results' =>$results, 'interview_id'=>$uploads['id']])
												   
													   @else
													   <tr>
													   <td style="color:red;">
													   No Records found...
													   </td>
													   </tr>
													   @endif
													   </tbody>
												   </table>
												   
													</div>
												   </div>
												   </div>
												</div>
												@endif
											</div>
										</div>
									</div>
                                    
                                </div>
                </div>
               
         </td>
         </tr>
         </thead>
         @endforeach
         @else
         <tr class="strips">
         <td style="color:red;">
         No Records found...
         </td>
         </tr>
         @endif    
         </tr>
         </table>
      </div>
      <!-- end -->
   </div>
		</div>
</div>
</div>
</div>
</div>

  <!-- Modal -->
<div class="modal fade" id="myModalInterviewQA" role="dialog">
    <div class="modal-dialog">
    <form method="post" enctype="multipart/form-data">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Interview Q & A</h4>
        </div>
        <div class="modal-body">
			<input id="reference_bookEditId" class="reference_bookEditId" required name="reference_bookEditId" type="hidden">
			<div class="col-sm-6 col-md-6 col-lg-6 btn btn-primary  btn-gry" style="background-color: #eee;border:none;">
			   <input id="reference_bookEditPdf" class="reference_bookEditPdf" accept="application/pdf" name="reference_bookEditPdf" type="file">
			   <input id="reference_bookEditVideo" class="reference_bookEditVideo" accept="video/mp4" name="reference_bookEditVideo" type="file">
			</div>
			<div class="clearfix"></div>
        </div>
        <div class="modal-footer">
		<button type="button" id="update_reference_book" class="submit-btn ctn bookbtn">Upload</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<style>
.ui-widget.ui-widget-content {
    border: 1px solid #c5c5c5 !important;
}
.ui-autocomplete .ui-menu-item .ui-state-focus, .ui-menu-item .ui-menu-item-wrapper:hover{
	background:#0e998e!important;
	color:#fff!important;
}

</style>  
<script type="text/javascript">
$(document).ready(function(){
	$(".topicText").hide();
	$(".videoclass").hide();
	$(".pdfclass").hide();
	$(".bookbtn").hide();
	$(".cancelFinalBtn").hide();
	$(".cancelBtn").hide();
	$(".topicSave").hide();  //new
	$(".videoPdfIcon").hide();  //new
	
$( "input[name='company_id']" ).autocomplete({
            source: "{{url('/getcompanies')}}",
            minLength: 2,
            select: function(event, ui) { 
			}
});			
	
$(document).on('click', ".showPDFExcelAdd", function() {	
	$(".topicText").hide();
	$(".addTopicMain").show();
	$(".sub-tab").css({'padding': '10px 10px'});
	var id=$(this).attr("attrId");
	var addtxt=$(this).attr("txtattr");
	var attrpartscount=parseInt($(this).attr("attrpartscount"))+1;
	$(".videoPdfIcon").show();
	$(".topicTextbox"+id).val(addtxt);
	var $this     = $(this),
	$parentTR = $this.closest('tr');
	$('#addbook-row'+id).show();	
	$('#addbook-row'+id).remove().clone().insertAfter($parentTR);	
	$(".addbook").show();	
	$(".videoclass").hide();
	$(".pdfclass").hide();
	$(".part-text").html('Part '+attrpartscount);				
});
	$(".showPDFExcelAddReal").on('click', function(){
		$(".topicTextReal").hide();
		var addtxt=$(this).attr("txtattr");
		$(".realIcons").show();
		$(".topicTextValueReal").val(addtxt);
	});
	$(".addTopicMain").on('click', function() {
		$(".videoPdfIcon").hide();
		$(".addTopicMain").hide();
		$(".topicText").show();
		$(".actionsBooks").show(); // new
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
		$(".topicTextbox").val("");
		$(".sub-tab").css({'padding': '0px 0px'});
	});
	//new
	$(".cancelBookBtn").on('click', function() {
		var id=$(this).attr("attrId");
		$(".addTopicMain").show();
		$(".topicText").hide();
		$(".actionsBooks").hide();
		$(".videoPdfIcon").hide();
		$(".topicTextbox"+id).val("");
		$(".sub-tab").css({'padding': '10px 10px'});
	});
	$(".saveBookBtn").on('click', function() {
		$(".videoPdfIcon").hide();
		var id= $(this).attr("attrId");
		var txt= $('#tot_interviewqa_topics-'+id).val()+' . '+$(".topicTextbox"+id).val();
		if(txt ==''){
			alert("Please enter topic");
			$(".topicTextbox"+id).focus();
		}else{
			$(".topicText").hide();
			$(".actionsBooks").hide();
			$(".topicSave").show();
			$(".addTopicname").html(txt);
			$(".showPDFExcelAdd").attr('txtattr',$('#topic_name-reference-'+id).val());
			$(".reference_bookVideo").val(""); // new
			$(".reference_bookPdf").val(""); // new
		}
	});
	$(".showPDFExcel").on('click', function() {
		$(".videoPdfIcon").show();
		$(".videoclass").hide();
		$(".pdfclass").hide();
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
	});
	$(".deleteTopic").on('click', function() {
		$(".topicText").show();
		$(".topicTextbox").val("");
		$(".actionsBooks").show();
		$(".topicSave").hide();
		$(".videoPdfIcon").hide();
		$(".videoclass").hide();
		$(".pdfclass").hide();
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
	});
	$(".editTopic").on('click', function() {
		$(".topicText").show();
		$(".actionsBooks").show();
		$(".topicSave").hide();
		$(".videoPdfIcon").hide();
		$(".videoclass").hide();
		$(".pdfclass").hide();
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
	});
	
	//new end
	$(document).on('click', ".videoIcon", function() {
		$(".videoPdfIcon").hide();
		$(".videoclass").show();
		$(".pdfclass").hide();
		$(".bookbtn").show();
		$(".cancelFinalBtn").show();
		$(".cancelBtn").show();
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
	});
	$(document).on('click', ".pdfIcon", function() {
		$(".videoPdfIcon").hide();
		$(".videoclass").hide();
		$(".pdfclass").show();
		$(".bookbtn").show();
		$(".cancelFinalBtn").show();
		$(".cancelBtn").show();
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
	});
	$(document).on('click', ".cancelBtn", function() {
		$(".videoPdfIcon").show();
		$(".videoclass").hide();
		$(".pdfclass").hide();
		$(".bookbtn").hide();
		$(".cancelFinalBtn").hide();
		$(".cancelBtn").hide();
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
	});
	$(document).on('click', ".cancelFinalBtn", function() {
		$(".topicText").hide();
		$(".videoPdfIcon").show();
		$(".videoclass").hide();
		$(".pdfclass").hide();
		$(".bookbtn").hide();
		$(".cancelFinalBtn").hide();
		$(".cancelBtn").hide();
		//$(".topicSave").hide(); // new
		$(".topicTextbox").val(""); // new
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
		$(".addTopicMain").show();
	});
	// Real Time Work Experience
	$(".topicTextReal").hide();
	$(".realIcons").hide();
	$(".videoclassReal").hide();
	$(".pdfclassReal").hide();
	$(".bookbtnReal").hide();
	$(".cancelFinalBtnReal").hide();
	$(".cancelBtnReal").hide();
	$(".actionsReal").hide(); // new
	$(".topicSaveReal").hide(); // new
	
	$(".addTopicMainReal").on('click', function() {
		$(".topicTextReal").show();
		$(".actionsReal").show(); // new
		$(".createrealtimePdf").val("");
		$(".createrealtimeVideo").val("");
		$(".addTopicMainReal").hide();
	});
	//new
	$(".cancelRealBtn").on('click', function() {
		var id=$(this).attr("attrId");
		$(".addTopicMainReal").show();
		$(".topicTextReal").hide();
		$(".actionsReal").hide();
		$(".realIcons").hide();
		$(".topicTextValueReal"+id).val("");
		$(".createrealtimePdf").val("");
		$(".createrealtimeVideo").val("");
		
	});
	$(".saveRealBtn").on('click', function() {
		$(".realIcons").hide();
		var id=$(this).attr("attrId");
		var incre=$(this).attr("incre");
		var txt=$(".topicTextValueReal"+id).val();
		var cnt=txt.length;
		var str=txt.substring(0,25);
		if(cnt > 25)
			var txtVal=str+"....";
		else
			var txtVal=txt;
		if(txt ==''){
			alert("Please enter topic");
			$(".topicTextValueReal"+id).focus();
		}else{
			$(".topicTextReal").hide();
			$(".actionsReal").hide();
			$(".topicSaveReal").show();
			$(".addTiitle").html(txtVal);
			$(".addTopicnameReal").html(incre+". "+txtVal);
			$(".addTopicnameReal").attr("title", txt);
			$(".createrealtimePdf").val("");
		    $(".createrealtimeVideo").val("");
		}
	});
	$(".showPDFExcelReal").on('click', function() {
		$(".realIcons").show();
		$(".videoclassReal").hide();
		$(".pdfclassReal").hide();
		$(".createrealtimePdf").val("");
		$(".createrealtimeVideo").val("");
	});
	$(".deleteTopicReal").on('click', function() {
		$(".topicTextReal").show();
		$(".topicTextValueReal").val("");
		$(".actionsReal").show();
		$(".topicSaveReal").hide();
		$(".realIcons").hide();
		$(".videoclassReal").hide();
		$(".pdfclassReal").hide();
		$(".createrealtimePdf").val("");
		$(".createrealtimeVideo").val("");
	});
	$(".editTopicReal").on('click', function() {
		$(".topicTextReal").show();
		$(".actionsReal").show();
		$(".topicSaveReal").hide();
		$(".realIcons").hide();
		$(".videoclassReal").hide();
		$(".pdfclassReal").hide();
		$(".createrealtimePdf").val("");
		$(".createrealtimeVideo").val("");
	});
	
	//new end
	$(".videoIconReal").on('click', function() {
		$(".realIcons").hide();
		$(".videoclassReal").show();
		$(".pdfclassReal").hide();
		$(".bookbtnReal").show();
		$(".cancelFinalBtnReal").show();
		$(".cancelBtnReal").show();
		$(".createrealtimePdf").val("");
		$(".createrealtimeVideo").val("");
	});
	$(".pdfIconReal").on('click', function() {
		$(".realIcons").hide();
		$(".videoclassReal").hide();
		$(".pdfclassReal").show();
		$(".bookbtnReal").show();
		$(".cancelFinalBtnReal").show();
		$(".cancelBtnReal").show();
		$(".createrealtimePdf").val("");
		$(".createrealtimeVideo").val("");
	});
	$(".cancelBtnReal").on('click', function() {
		$(".realIcons").show();
		$(".videoclassReal").hide();
		$(".pdfclassReal").hide();
		$(".bookbtnReal").hide();
		$(".cancelFinalBtnReal").hide();
		$(".cancelBtnReal").hide();
		$(".topicTextValueReal").val("");
		$(".createrealtimePdf").val("");
		$(".createrealtimeVideo").val("");
	});
	$(".cancelFinalBtnReal").on('click', function() {
		$(".topicTextReal").hide();
		$(".realIcons").hide();
		$(".videoclassReal").hide();
		$(".pdfclassReal").hide();
		$(".bookbtnReal").hide();
		$(".cancelFinalBtnReal").hide();
		$(".cancelBtnReal").hide();
		$(".addTopicMainReal").show();
		$(".topicTextValueReal").val("");
		$(".createrealtimePdf").val("");
		$(".createrealtimeVideo").val("");
	});
	
	//Company Interview
	$(".CompanyAll, .Company, .Location, .CompanyText, .LocationText, .callEmail, .CallIcons, .callEmailPdf, .callEmailVideo, .TechnicalRound, .TechIcons, .TechPdf, .TechVideo, .PMRound, .PMIcons, .PMPdf, .PMVideo, .HRRound, .HRIcons, .HRPdf, .HRVideo").hide();
	
	$(".addTopicMainCompany").on("click", function(){
		$(".CompanyAll, .Company, .Location, .callEmail, .TechnicalRound, .PMRound, .HRRound").show();
		$(".CompanyText").hide();
		$(".addTopicMainCompany").hide();
		
		$(".CompanyTextAppend").html("");
		$(".LocationTextAppend").html("");
		$(".CompanyTextValue").val("");
		$(".LocationTextValue").val("");

		$(".callRounds").hide();
	});
	$(".saveCompanyBtn").on("click", function(){
		var id=$(this).attr("attrId");
		var CompanyTextValue=$(".CompanyTextValue"+id).val();
		var LocationTextValue=$(".LocationTextValue"+id).val();
		
		if(CompanyTextValue =='' && LocationTextValue ==''){
			alert("Please enter comapny Name & Location");
			$(".CompanyTextValue"+id).focus();
		}else{
			$(".CompanyAll").hide();
			$(".TechnicalRoundMain").hide();
			$(".callEmailMain").hide();
			$(".callRounds").show();
			$(".callEmail").show();
			$(".PMRoundMain").hide();
			$(".HRRoundMain").hide();
			$(".Location").hide();
			$(".Company").hide();
			$(".CompanyText").show();
			$(".CompanyTextAppend").html(CompanyTextValue);
			$(".LocationTextAppend").html("( "+LocationTextValue+" )");
		}
		$(".addTopicMainCompany").show();
		$(".CallIcons").hide();
		$(".callEmailPdf").hide();
		$(".callEmailVideo").hide();
		$(".CompanyTextAppendRow").show();
		$('.addRounds, .addNewRound').attr('companyname', CompanyTextValue);
		$('.addRounds, .addNewRound').attr('txtattr', LocationTextValue);
		$('.addRounds, .addNewRound').attr('attrid', id);
	});
	$(".CompanyTextEdit").on("click", function(){
		$(".Company").show();
		$(".Location").show();
		$(".CompanyText").hide();
		$(".CompanyTextAppend").html("");
		$(".LocationTextAppend").html("");
	});
	$(".cancelCompanyBtn1").on("click", function(){
		var id=$(this).attr("attrId");
		$(".Company").show();
		$(".CompanyText").hide();
		$(".CompanyTextValue"+id).val("");
		$(".LocationTextValue"+id).val("");
	});
	$(".cancelCompanyBtn1").on("click", function(){
		$(".Location").show();
		$(".LocationText").hide();
		$(".LocationTextValue").val("");
	});

	$(document).on("click", ".cancelCompanyBtn", function(){
		$(".addTopicMainCompany").show();	
		$(".CompanyAll").hide();	
	});
	$(".addCallEmail").on("click", function(){
		$(".callRounds").show();
		$(".CallIcons").show();
		$(".callEmail").hide();
		$(".titleTxt").html("Call / Email Schedule");
		$(".roundTypeVal").val("Call / Email Schedule");
	});


	/*  My script  */

	$(document).on("change", ".addRounds", function(){
		$(".callRounds").show();
		$(".CallIcons").show();
		$(".callEmail").hide();
		$(".callEmailVideo").hide();
		$(".callEmailPdf").hide();
		var titleTxt = $(this).find("option:selected").text();
		var roundTypeVal = $(this).find("option:selected").val();
		$(".titleTxt").html(titleTxt);
		$(".roundTypeVal").val(roundTypeVal);

		$('.pdfIconCall, .callEmailVideo').attr('companyname', $(this).attr('companyname'));
		$('.pdfIconCall, .callEmailVideo').attr('txtattr', $(this).attr('txtattr'));
		$('.pdfIconCall, .callEmailVideo').attr('attrid',  $(this).attr('attrid'));

	});

	$(document).on("click", ".addNewRound", function(){
		var parentTR = $(this).closest('tr');
		var id = $(this).attr('attrid');
		$('#callRounds'+id).show();		
		$('#callRounds'+id).remove().clone().insertAfter(parentTR);	
		$('.addRounds').attr('companyname', $(this).attr('companyname'));
		$('.addRounds').attr('txtattr', $(this).attr('txtattr'));
		$('.addRounds').attr('attrid', id);

		$(".CallIcons").hide();
		$(".callEmailPdf").hide();
		$(".callEmailVideo").hide();
		$(".addTopicMainCompany").show();
		$(".CompanyAll, .Company, .Location, .callEmail, .TechnicalRound, .PMRound, .HRRound").hide();
		$(".callEmail").show();
	});
	$(document).on("click", ".videoIconCall", function(){
		$(".callEmailVideo").show();
		$(".CallIcons").hide();
		$('.callEmailVideo button').attr('companyname', $(this).attr('companyname'));
		$('.callEmailVideo button').attr('txtattr', $(this).attr('txtattr'));
		$('.callEmailVideo button').attr('attrid',  $(this).attr('attrid'));
	});
	$(document).on("click", ".pdfIconCall", function(){	
		$(".callEmailPdf").show();
		$(".CallIcons").hide();
		$('.callEmailPdf button').attr('companyname', $(this).attr('companyname'));
		$('.callEmailPdf button').attr('txtattr', $(this).attr('txtattr'));
		$('.callEmailPdf button').attr('attrid',  $(this).attr('attrid'));
	});

	$(document).on("click", ".cancelCallEmailVideoBtn", function(){		
		$(".callEmailVideo").hide();
		$(".CallIcons").show();
	});
	$(document).on("click", ".cancelCallEmailPdfBtn", function(){	
		$(".callEmailPdf").hide();
		$(".CallIcons").show();
	});
	$(document).on("click", ".closeschedules", function(){	
		$(".CallIcons").hide();
		$('.callEmail').show();
	});





	$(".addTechRound").on("click", function(){
		$(".TechnicalRound").hide();
		$(".CallIcons").show();
		$(".titleTxt").html("Technical Round");
		$(".roundTypeVal").val("Technical Round");
	});
	$(".addPmRound").on("click", function(){
		$(".PMRound").hide();
		$(".CallIcons").show();
		/*$(".videoIconPM").show();
		$(".pdfIconPM").show();*/
		$(".titleTxt").html("PM Round");
		$(".roundTypeVal").val("PM Round");
	});
	$(".addHrRound").on("click", function(){
		$(".HRRound").hide();
		$(".CallIcons").show();
		/*$(".videoIconHR").show();
		$(".pdfIconHR").show();*/
		$(".titleTxt").html("HR Round");
		$(".roundTypeVal").val("HR Round");
	});
	$(".addTechRoundAdd").on("click", function(){
		$(".CompanyAll").show();
		$(".CallIcons").show();
		var id=$(this).attr("attrId");
		$(".CompanyTextValue"+id).val($(this).attr("companyname"));
		$(".LocationTextValue"+id).val($(this).attr("txtattr"));
		$(".titleTxt").html("Technical Round");
		$(".roundTypeVal").val("Technical Round");
	});
	$(".addPmRoundAdd").on("click", function(){
		$(".CompanyAll").show();
		$(".CallIcons").show();
		var id=$(this).attr("attrId");
		$(".CompanyTextValue"+id).val($(this).attr("companyname"));
		$(".LocationTextValue"+id).val($(this).attr("txtattr"));
		$(".titleTxt").html("PM Round");
		$(".roundTypeVal").val("PM Round");
	});
	$(".addHrRoundAdd").on("click", function(){
		$(".CompanyAll").show();
		$(".CallIcons").show();
		var id=$(this).attr("attrId");
		$(".CompanyTextValue"+id).val($(this).attr("companyname"));
		$(".LocationTextValue"+id).val($(this).attr("txtattr"));
		$(".titleTxt").html("HR Round");
		$(".roundTypeVal").val("HR Round");
	});
	$(".NoAdd").on("click", function(){
		alert("Sorry? All arounds are completed !!");
	});
	$(".hideAll").on("click", function(){
		var id=$(this).attr("id");
		$(".hideRow").hide();
		$(".hideRow"+id).show();
		$(".uploads-title").addClass('profile-performance');
		$(".outer-box.history-page").addClass('profile-performance');
		$(".profile-performance .right-block").show();
		var user_purchase_details = $("#user_purchase_details"+id).val();
		var user_view_count = $("#user_view_count"+id).val();
		var no_of_views_url = $("#no_of_views_url"+id).val();
		var no_of_sales_url = $("#no_of_sales_url"+id).val();
		$('.no-of-views').html(user_view_count);
		$('.no-of-sales').html(user_purchase_details);
		$('.no_of_views_url').attr('href',no_of_views_url);
		$('.no_of_sales_url').attr('href',no_of_sales_url);
	});
	$(".addTopicMain").click(function() {
		/*$('html,body').animate({
        scrollTop: $(".topicText").offset().top},
        'slow');*/
	});
	$(".addTopicMainCompany").click(function() {
		/*$('html,body').animate({
        scrollTop: $(".CompanyAll").offset().top},
        'slow');*/
	});
	$(".addTopicMainReal").click(function() {
		/*$('html,body').animate({
        scrollTop: $(".topicTextReal").offset().top},
        'slow');*/
	});
	$(".editInterview").on("click", function(){
		var id=$(this).attr("dataid");
		var icon=$(this).attr("icontype");
		$(".reference_bookEditId").val(id);
		if(icon == 'Video'){
			$(".reference_bookEditPdf").hide();
			$(".reference_bookEditVideo").show();
			$(".reference_bookEditPdf").prop('required',false);
			$(".reference_bookEditVideo").prop('required',true);
		}
		if(icon == 'Pdf'){
			$(".reference_bookEditPdf").show();
			$(".reference_bookEditVideo").hide();
			$(".reference_bookEditPdf").prop('required',true);
			$(".reference_bookEditVideo").prop('required',false);
		}
		
	});
	
});
   $('.top').on('click', function() {
     
         $parent_box = $(this).closest('.box');
         //$parent_box.find('.bottom').slideUp();
         //  $(".details-info").hide();
         $parent_box.find('.bottom').slideToggle(1000, 'swing');
         //$parent_box.find('.bottom').fadeIn(1000, 'swing');
         // $(".details-info").show();
     });
     
     $('.middle-top').on('click', function() {
     
         $parent_box = $(this).closest('.middle-box');
         $parent_box.siblings().find('.middle-bottom').slideUp();
         //  $(".details-info").hide();
         $parent_box.find('.middle-bottom').slideToggle(1000, 'swing');
         //$parent_box.find('.bottom').fadeIn(1000, 'swing');
         // $(".details-info").show();
     });

   
	function setFileInfo(files) {
		var myVideos = [];
		window.URL = window.URL || window.webkitURL;
		myVideos.push(files[0]);
		var video = document.createElement('video');
		video.preload = 'metadata';
		video.onloadedmetadata = function() {
		window.URL.revokeObjectURL(this.src)
		var duration = video.duration;
		myVideos[myVideos.length-1].duration = duration;
			var rk=myVideos[0].duration;
		var minutes=parseInt(rk / 60, 10);
		var seconds = video.duration % 60;
		var secSplit=(""+seconds).split(".");
		//alert(secSplit);
			$("#durationVideo").val(minutes+"."+secSplit[0]);
		}
		video.src = URL.createObjectURL(files[0]);;
	}
	function setFileInfoReal(files) {
		var myVideos = [];
		window.URL = window.URL || window.webkitURL;
		myVideos.push(files[0]);
		var video = document.createElement('video');
		video.preload = 'metadata';
		video.onloadedmetadata = function() {
		window.URL.revokeObjectURL(this.src)
		var duration = video.duration;
		myVideos[myVideos.length-1].duration = duration;
			var rk=myVideos[0].duration;
		var minutes=parseInt(rk / 60, 10);
		var seconds = video.duration % 60;
		var secSplit=(""+seconds).split(".");
		//alert(secSplit);
			$("#durationVideoReal").val(minutes+"."+secSplit[0]);
		}
		video.src = URL.createObjectURL(files[0]);;
	}
	function setFileInfoCall(files) {
		var myVideos = [];
		window.URL = window.URL || window.webkitURL;
		myVideos.push(files[0]);
		var video = document.createElement('video');
		video.preload = 'metadata';
		video.onloadedmetadata = function() {
		window.URL.revokeObjectURL(this.src)
		var duration = video.duration;
		myVideos[myVideos.length-1].duration = duration;
			var rk=myVideos[0].duration;
		var minutes=parseInt(rk / 60, 10);
		var seconds = video.duration % 60;
		var secSplit=(""+seconds).split(".");
		//alert(secSplit);
			$("#durationVideoCall").val(minutes+"."+secSplit[0]);
		}
		video.src = URL.createObjectURL(files[0]);;
	}
   function browseReferenceBook(id) 
   {
      $("#reference_book-"+id).trigger('click');
   }
       
   function removeReferenceBook(id) 
   {     
     $("#reference_book_name-"+id).val("");
     $("#btn_remove_reference_book-"+id).hide();
     $("#reference_book-"+id).val("");
   }
   
  $('#reference_book-'+id).change(function() {
		
	   if ($(this).val().length > 0) {
		   $("#btn_remove_reference_book-"+id).show();
	   }

	   $('#reference_book_name-'+id).val($(this).val());
   });
   
   function refbookupload(id)
   {
      var link             = "{{ url('/member/create_reference_book') }}";
      var skill_id         = $("#skill_id_reference-"+id).val();
      var experience_level = $('#experience_level_reference-'+id).val();
      var _token           = $("input[name=_token]").val();
      var topic_name       = $('#topic_name-reference-'+id).val();
      var interview_id     = id;
	  var files=[];
	  var findfile=$(".reference_bookPdf-"+id).val();
		if(findfile ==''){
			var fileName=$(".reference_bookVideo-"+id)[0].files[0];
			var durationVideo=$("#durationVideo").val();
		}else{
			var fileName=$(".reference_bookPdf-"+id)[0].files[0];
			var durationVideo="";
		}
  // alert(fileName);
   //return false;
          
   
          var form_data = new FormData();
          form_data.append('_token',_token);
          form_data.append('skill_id',skill_id);
          form_data.append('experience_level',experience_level);
          form_data.append('id',interview_id);
          form_data.append('topic_name',topic_name);
          form_data.append('refrencebook',fileName);
          form_data.append('durationVideo',durationVideo);
		  
		  var interview_idBase64 = btoa(interview_id);
		 
          jQuery.ajax({
                          url:link,
                          type:'post',
                          dataType:'json',
                          data:form_data,
                          processData:false,
                          contentType:false,
                          beforeSend:function()
                          {
                            $('#error_msg').html('');
                            $('.container-fluid').css({'opacity':'0.3'});
							$("#loader-wrapper").show();
                          },
                          success:function(response)
                          {
							  $("#loader-wrapper").hide();
							  $('.container-fluid').css({'opacity':'1'});
                              if(response.status=="SUCCESS")
                              {

                                 $('#topic_name-reference-'+id).val('');
                                 $('#reference_error_msg-'+id).html('');
                                 //$('#reference_success_msg-'+id).html(response.msg).show().fadeOut(5000);
								 //alert(response.msg);
								 window.location="{{URL::to('member/manage_upload_history?ref=')}}"+interview_idBase64;
                              }
                              if(response.status=="ERROR")
                              {
                                 $('#reference_success_msg-'+id).html('');
                                 /*$('#reference_error_msg-'+id).html(response.msg);*/
                                 //$('#create_error_attachment-'+id).html(response.msg);
								 alert(response.msg);
								 window.location="{{URL::to('member/manage_upload_history?ref=')}}"+interview_idBase64;
                              }
                              else
                              {

                                 //$('#create_error_attachment-'+id).html('');  
								 //alert("Something went wrong please try again");
								 //window.location="{{URL::to('member/manage_upload_history')}}";
                              }
                              if(response.status=="invalid_topic_name")
                              {
                                //$('#reference_error_topic-'+id).html(response.msg);
								alert(response.msg);
								window.location="{{URL::to('member/manage_upload_history?ref=')}}"+interview_idBase64;
                              }
                              else
                              {
                                 //$('#reference_error_topic-'+id).html('');
								 //alert("Something went wrong please try again");
								 //window.location="{{URL::to('member/manage_upload_history')}}";
                              }
                              if(response.status=="topic_length")
                              {
                                 //$('#len_reference_error_topic-'+id).html(response.msg);
								 alert(response.msg);
								 window.location="{{URL::to('member/manage_upload_history?ref=')}}"+interview_idBase64;
                              }
                              else
                              {
                                 //$('#len_reference_error_topic-'+id).html('');
								 //alert("Something went wrong please try again");
								 //window.location="{{URL::to('member/manage_upload_history')}}";
                              }
                          } 
                         });    
   
    }; 
//update book
function updatebrowseReferenceBook(id) 
   {
      $("#updatereference_book-"+id).trigger('click');
   }
       
   function updateremoveReferenceBook(id) 
   {     
     $("#updatereference_book_name-"+id).val("");
     $("#updatebtn_remove_reference_book-"+id).hide();
     $("#updatereference_book-"+id).val("");
   }
   
  $('#updatereference_book-'+id).change(function() {
		
	   if ($(this).val().length > 0) {
		   $("#updatebtn_remove_reference_book-"+id).show();
	   }

	   $('#updatereference_book_name-'+id).val($(this).val());
   });
   
   function updaterefbookupload(id)
   {
      var link             = "{{ url('/member/updatecreate_reference_book') }}";
      var _token           = $("input[name=_token]").val();
      var topic_name       = $('#updatetopic_name-reference-'+id).val();
      var id     = id;
	  var files=[];
          var form_data = new FormData();
          form_data.append('_token',_token);
          form_data.append('id',id);
          form_data.append('topic_name',topic_name);
          form_data.append('refrencebook',$("#updatereference_book-"+id)[0].files[0]);
          //form_data.append('durationVideo',durationVideo);
   //alert($("#updatereference_book-"+id)[0].files[0]);
          jQuery.ajax({
                          url:link,
                          type:'post',
						  
                          dataType:'json',
                          data:form_data,
                          processData:false,
                          contentType:false,
                          beforeSend:function()
                          {
                            $('#error_msg').html('');
							$("#loader-wrapper").show();
                          },
                          success:function(response)
                          {
							  $("#loader-wrapper").hide();
                              if(response.status=="SUCCESS")
                              {

                                 $('#topic_name-reference-'+id).val('');
                                 $('#reference_error_msg-'+id).html('');
                                 //$('#reference_success_msg-'+id).html(response.msg).show().fadeOut(5000);
								 alert(response.msg);
								 window.location="{{URL::to('member/manage_upload_history')}}";
                              }
                              if(response.status=="ERROR")
                              {
                                 $('#reference_success_msg-'+id).html('');
                                 /*$('#reference_error_msg-'+id).html(response.msg);*/
                                 //$('#create_error_attachment-'+id).html(response.msg);
								 alert(response.msg);
								 window.location="{{URL::to('member/manage_upload_history')}}";
                              }
                              else
                              {

                                 //$('#create_error_attachment-'+id).html('');  
								 //alert("Something went wrong please try again");
								 window.location="{{URL::to('member/manage_upload_history')}}";
                              }
                              if(response.status=="invalid_topic_name")
                              {
                                //$('#reference_error_topic-'+id).html(response.msg);
								alert(response.msg);
								window.location="{{URL::to('member/manage_upload_history')}}";
                              }
                              else
                              {
                                 //$('#reference_error_topic-'+id).html('');
								 //alert("Something went wrong please try again");
								 window.location="{{URL::to('member/manage_upload_history')}}";
                              }
                              if(response.status=="topic_length")
                              {
                                 //$('#len_reference_error_topic-'+id).html(response.msg);
								 alert(response.msg);
								 window.location="{{URL::to('member/manage_upload_history')}}";
                              }
                              else
                              {
                                 //$('#len_reference_error_topic-'+id).html('');
								 //alert("Something went wrong please try again");
								 window.location="{{URL::to('member/manage_upload_history')}}";
                              }
                          },
						  error: function(xhr) {
							  console.log(xhr);
							  //alert(xhr.statusText + xhr.responseText);
						  }
                         });    
   
    }; 
	
	//end book
   function real_time_file(id) 
   {
      $("#realtime-"+id).trigger('click');
   }
       
   function removerealtime(id) 
   {     
     $("#realtime_name-"+id).val("");
     $("#btn_remove_realtime-"+id).hide();
     $("#realtime-"+id).val("");
   } 
   
      $('#realtime-'+id).change(function() {
            
           if ($(this).val().length > 0) {
               $("#btn_remove_realtime-"+id).show();
           }
   
           $('#realtime_name-'+id).val($(this).val());
       });
   
   function update_realtimeupload(id)
   {
      var link             = "{{ url('/member/update_realtime_attachment') }}";
      var _token           = $("input[name=_token]").val();
      var id = id; 
      var issue_title         = $('#issue_title_update-'+id).val();
      var files=[];
      var form_data = new FormData();
      form_data.append('_token',_token);
      form_data.append('realtime',$("#realtime-"+id)[0].files[0]);
      form_data.append('issue_title',issue_title);
      form_data.append('id',id);
	  
      jQuery.ajax({
                       url:link,
                       type:'post',
                       dataType:'json',
                       data:form_data,
                       processData:false,
                       contentType:false,
                       beforeSend:function()
                       {
						  
                         $('#error_realtime_msg').html('');
						 $("#loader-wrapper").show();
                       },
                       success:function(response)
                       {
						   $("#loader-wrapper").hide();
                           if(response.status=="invalid_issue_title")
                           {
                              $('#error_update_issue_title-'+id).html(response.msg);
                           }
                           else
                           {
                              $('#error_update_issue_title-'+id).html('');  
                           }
                           
                           if(response.status=="success")
                           {
                              $('#error_update_realtime_msg-'+id).html('');
                              $('#success_update_realtime_msg-'+id).html(response.msg).show().fadeOut(5000);
                              $('#error_in_updating_realtime-'+id).html('');
                              
                           }
                           if(response.status=="ERROR")
                           {
                              $('#success_update_realtime_msg-'+id).html('');
                             $('#error_update_realtime_msg-'+id).html(response.msg);
                             $('#error_in_updating_realtime-'+id).html('');
                           }
                           if(response.status=="error")
                           {
                              $('#error_update_realtime_msg-'+id).html('');
                              $('#success_update_realtime_msg-'+id).html('');
                             $('#error_in_updating_realtime-'+id).html(response.msg).show().fadeOut(5000);
                           }
                              
                       } 
                      });    
   
          
    }; 

   function browsecompanyfile(id) 
   {
      $("#company_file-"+id).trigger('click');
   }
       
   function removecompanyfile(id) 
   {     
     $("#company_file_name-"+id).val("");
     $("#btn_remove_company_file-"+id).hide();
     $("#company_file-"+id).val("");
   } 
   
      $('#company_file-'+id).change(function() 
      {    
           if ($(this).val().length > 0) 
           {
               $("#btn_remove_company_file-"+id).show();
           }
   
           $('#company_file_name-'+id).val($(this).val());
       });
   
   function companyupload(id, company_name, location)
   {
      var link         = "{{ url('/member/store_company') }}";
      var _token       = $("input[name=_token]").val();
      //var company_name = $('#company_name-'+id).val();
      //var location     = $('#company_location-'+id).val();
      //alert(company_name);
      var roundType	   = $('.roundTypeVal').val();;
      var skill_id = $('#skill_id_company-'+id).val();
      var experience_level = $('#experience_level_company-'+id).val();
      var interview_id = id;
      var files=[];
      var findfile=$(".company_fileCallPdf-"+id).val();
		if(findfile ==''){
			var fileName=$(".company_fileCallVideo-"+id)[0].files[0];
			var durationVideoCall=$("#durationVideoCall").val();
		}else{
			var fileName=$(".company_fileCallPdf-"+id)[0].files[0];
			var durationVideoCall="";
		}
		
		
      var form_data = new FormData();
      form_data.append('_token',_token);
      form_data.append('attachment',fileName);
      form_data.append('company_name',company_name);
      form_data.append('location',location);
      form_data.append('interview_id',interview_id);
      form_data.append('skill_id',skill_id);
      form_data.append('experience_level',experience_level);
      form_data.append('roundType',roundType);
      form_data.append('durationVideoCall',durationVideoCall);

      var interview_idBase64 = btoa(interview_id);

      jQuery.ajax({
                       url:link,
                       type:'post',
                       dataType:'json',
                       data:form_data,
                       processData:false,
                       contentType:false,
                       beforeSend:function()
                       {
                         $('#error_realtime_msg').html('');
						 $("#loader-wrapper").show();
                       },
                       success:function(response)
                       {
							$("#loader-wrapper").hide();
                           if(response.status=="invalid_company_id")
                           {
                              $('#error_company_name-'+id).html(response.msg);  
							  //alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}?t=company&ref="+interview_idBase64;
                           }
                           else
                           {
                              $('#error_company_name-'+id).html('');  
                           }
                           
                           if(response.status=="invalid_location")
                           {
                              $('#error_location-'+id).html(response.msg);
							  //alert(response.msg);
  							  window.location="{{URL::to('member/manage_upload_history')}}?t=company&ref="+interview_idBase64;							  
                           }
                           else
                           {
                              $('#error_location-'+id).html(''); 
                           }   
                           if(response.status=="invalid_file")
                           {
                              $('#company_create_error_attachment-'+id).html(response.msg);
							  //alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}?t=company&ref="+interview_idBase64;
                           }
                           else
                           {
                              $('#company_create_error_attachment-'+id).html('');
                           }
                           if(response.status=="file_required")
                           {
                              $('#create_error_msg-'+id).html(response.msg);
							  //alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}?t=company&ref="+interview_idBase64;
                           }
                           else
                           {
                              $('#create_error_msg-'+id).html('');
                           }
                           if(response.status=="topic_length")
                           {
                              $('#len_error_company_name-'+id).html(response.msg);
							  //alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}?t=company&ref="+interview_idBase64;
                           }
                           else
                           {
                              $('#len_error_company_name-'+id).html('');
                           }

                           if(response.status=="success")
                           {
                              $('#error_company-'+id).html('');
                              $('#company_name-'+id).val('');
                              $('#company_location-'+id).val('');
                              //$('#success_company-'+id).html(response.msg).show().fadeOut(5000);
							  //alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}?t=company&ref="+interview_idBase64;
                           }
                           if(response.status=="error")
                           {
                              $('#success_company-'+id).html('');
                              $('#company_name-'+id).val('');
                              $('#company_location-'+id).val('');
                              //$('#error_company-'+id).html(response.msg).show().fadeOut(5000);
							  //alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}?t=company&ref="+interview_idBase64;
                           }
                       } 
                      });      
    }; 

   function update_browsecompanyfile(id) 
   {
      $("#update_company_file-"+id).trigger('click');
   }
       
   function update_removecompanyfile(id) 
   {     
     $("#update_company_file_name-"+id).val("");
     $("#update_btn_remove_company_file-"+id).hide();
     $("#update_company_file-"+id).val("");
   } 
   
      $('#update_company_file-'+id).change(function() 
      {    
           if ($(this).val().length > 0) 
           {
               $("#update_btn_remove_company_file-"+id).show();
           }
   
           $('#update_company_file_name-'+id).val($(this).val());
       });
   
   function update_companyupload(id)
   {
      var link             = "{{ url('/member/update_company') }}";
      var _token           = $("input[name=_token]").val();     
      var id = id; 
	  var typeofRound= $("#company_Round-"+id).val();
      var files=[];
      var form_data = new FormData();
      form_data.append('_token',_token);
      form_data.append('attachment',$("#update_company_file-"+id)[0].files[0]);
      form_data.append('id',id);
      form_data.append('roundType',typeofRound);
      jQuery.ajax({
                       url:link,
                       type:'post',
                       dataType:'json',
                       data:form_data,
                       processData:false,
                       contentType:false,
                       beforeSend:function()
                       {
                         
                       },
                       success:function(response)
                       {      
                           if(response.status=="invalid_file")
                           {
                              $('#update_company_upload_msg-'+id).html(response.msg);
                           }
                           else
                           {
                              
                           }
                           if(response.status=="success")
                           {
                              $('#update_company_upload_msg-'+id).html('');
                              $('#error_update_company-'+id).html('');
                              $('#success_update_company-'+id).html(response.msg).show().fadeOut(5000);
                           }
                           if(response.status=="error")
                           {
                              $('#success_update_company-'+id).html('');
                              $('#error_update_company-'+id).html(response.msg).show().fadeOut(5000);
                           }
                       } 
                      });      
    }; 

   function create_real_time_file(id) 
   {
      $("#createrealtime-"+id).trigger('click');
   }
       
   function removerealtimefile(id) 
   {     
     $("#createrealtime_name-"+id).val("");
     $("#createbtn_remove_realtime-"+id).hide();
     $("#createrealtime-"+id).val("");
   } 
   
      $('#createrealtime-'+id).change(function() {
            
           if ($(this).val().length > 0) {
               $("#createbtn_remove_realtime-"+id).show();
           }
   
           $('#createrealtime_name-'+id).val($(this).val());
       });
   
   function create_realtime(id)
   {
      var link        = "{{ url('/member/store_real_time_experience') }}";
      var _token      = $("input[name=_token]").val();
      
      var issue_title = $('#create_issue_title-'+id).val();
      var skill_id    = $('#realtime_skill_id-'+id).val();
      var experience  = $('#realtime_experience-'+id).val();
      var id = id;
	  var files=[];
	  var findfile=$(".createrealtimePdf-"+id)[0].files[0];
	  //alert(findfile);
	  if(findfile ==''){
			var fileName=$(".createrealtimeVideo-"+id)[0].files[0];
			var durationVideoReal=$("#durationVideoReal").val();
		}else{
			var fileName=$(".createrealtimePdf-"+id)[0].files[0];
			var durationVideoReal="";
		}
		
	  
	  //var fileName=$(".createrealtimeVideo").val();
	  //alert(fileName);
	  //return false;
      
   
      var form_data = new FormData();
      form_data.append('_token',_token);
      form_data.append('realtime',fileName);
      
      form_data.append('issue_title',issue_title);
      form_data.append('skill_id',skill_id);
      form_data.append('experience',experience);
      form_data.append('id',id);
      form_data.append('durationVideoReal',durationVideoReal);
	  
	  var interview_idBase64 = btoa(id);
	  
      jQuery.ajax({
                       url:link,
                       type:'post',
                       dataType:'json',
                       data:form_data,
                       processData:false,
                       contentType:false,
                       beforeSend:function()
                       {
                         $('#error_realtime_msg').html('');
						 $('.container-fluid').css({'opacity':'0.3'});
						 $("#loader-wrapper").show();
                       },
                       success:function(response)
                       {
						   $("#loader-wrapper").hide();
						   $('.container-fluid').css({'opacity':'1'});
                           if(response.status=="invalid_issue_title")
                           {
                              //$('#error_issue_title-'+id).html(response.msg);
							  //alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}?t=realissues&ref="+interview_idBase64;
                           }
                           else
                           {
                              //$('#error_issue_title-'+id).html('');  
							  window.location="{{URL::to('member/manage_upload_history')}}?t=realissues&ref=";
                           }
                           
                           if(response.status=="invalid_file")
                           {
                              //$('#error_create_realtime_file_required-'+id).html(response.msg);
							  //alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}?t=realissues&ref="+interview_idBase64;
                           }  
                           else
                           {
                              //$('#error_create_realtime_file_required-'+id).html('');
							  window.location="{{URL::to('member/manage_upload_history')}}?t=realissues&ref="+interview_idBase64;
                           } 
                           if(response.status=="topic_length")
                           {
                              //$('#len_error_issue_title-'+id).html(response.msg);
							  //alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}?t=realissues&ref="+interview_idBase64;
                           }
                           else
                           {
                              //$('#len_error_issue_title-'+id).html('');
                           }
                           
                           if(response.status=="success")
                           {
                              $('#create_solution-'+id).val('');
                              $('#create_issue_title-'+id).val('');
                              $('#createrealtime-'+id).val('');
                              $('#error_realtime_create_msg-'+id).html('');
                              //$('#realtime-create-success_msg-'+id).html(response.msg).show().fadeOut(5000);
							  //alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}?t=realissues&ref="+interview_idBase64;
                           }
                           if(response.status=="error")
                           {
                              $('#create_solution-'+id).val('');
                              $('#create_issue_title-'+id).val('');
                              $('#createrealtime-'+id).val('');
                              $('#realtime-create-success_msg-'+id).html('');
                              //$('#error_realtime_create_msg-'+id).html(response.msg).show().fadeOut(5000);
							  //alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}?t=realissues&ref="+interview_idBase64;
                           }
                       } 
                      });    
   
          
    };

</script>
<script>
 $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
               // getData(page);
            }
        }
    });
$(document).ready(function()
{
    $(document).on('click', '#interviewqalist tbody .pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        $('.realissues').addClass('active');
        event.preventDefault();
        var myurl = $(this).attr('href');
       var params=$(this).attr('href').split('?')[1];	   
       var paramsNew=params.split('&');	   
       var page=paramsNew[1].split('=')[1];	   
       var interview_id=paramsNew[0].split('=')[1];
	    $('a[href$="tab1default'+interview_id+'"]').parent().addClass('active in');
	   getData(page, interview_id, 'get_interview_qa', 'interviewqalist');
    });
	$(document).on('click', '#interview-realtime-issues tbody .pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        $('.realissues').addClass('active');
        event.preventDefault();
        var myurl = $(this).attr('href');
       var params=$(this).attr('href').split('?')[1];	   
       var paramsNew=params.split('&');	   
       var page=paramsNew[1].split('=')[1];	   
       var interview_id=paramsNew[0].split('=')[1];
	    $('a[href$="tab3default'+interview_id+'"]').parent().addClass('active in');
	   getData(page, interview_id, 'get_realtime_issues', 'interview-realtime-issues');
    });
    $(document).on('click', '#interviewcompanylist tbody .pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        $('.realissues').addClass('active');
        event.preventDefault();
        var myurl = $(this).attr('href');
       var params=$(this).attr('href').split('?')[1];	   
       var paramsNew=params.split('&');	   
       var page=paramsNew[1].split('=')[1];	   
       var interview_id=paramsNew[0].split('=')[1];
	   $('a[href$="tab2default'+interview_id+'"]').parent().addClass('active in');
	   getData(page, interview_id, 'get_company_issues', 'interviewcompanylist');
    });
});
function getData(page, interview_id, action, tab){
		
        $.ajax(
        {
            url: "{{url('/member/')}}/"+action+"?interview_id="+interview_id+"&page=" + page,
            type: "get",
            datatype: "html",
            // beforeSend: function()
            // {
            //     you can show your loader 
            // }
        })
        .done(function(data)
        {
            
            $("#"+tab+" tbody").empty();
            $("#"+tab+" tbody").html(data);
            var p = getParameterByName('p');  	
		  	
			if(page > 1)
			{
				$('.hideme ul li').addClass('blur-in');
				$('.showme').show();
				$(".show-results").css({'padding-left':'0px'});
			}
			else
			{
				$('.showme').hide();
				$(".show-results").css({'padding-left':'8px'});
			}
			
            location.hash = page;
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              alert('No response from server');
        });
}
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
function countChar(val) {
	var len = val.value.length;
	if (len >= 151) {
	  val.value = val.value.substring(0, 151);
	} else {
	  $('#charNum').text(len);
	}
};
</script>
<style type="text/css">
	.profile-performance .right-block {
	    border: 1px solid #eee;
	    padding: 0px;
	    border-radius: 3px;
	    margin-top: 10px;
	    margin-bottom: 10px;
	    float: right;
	}
	.profile-performance .new-perfrom {
	    margin: 0px;
	    width: 50%;
	}
	.profile-performance.outer-box.history-page {
	     margin-top: 0px;
	}
	.profile-performance .m-history {
	    margin-top: 70px;
	}
	.profile-performance .right-block > h5 {
	    padding-left: 20px;
	}
</style>
@endsection

