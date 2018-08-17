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
	background-color:#000;
	display:none;
}
#loader {
    display: block;
    position: relative;
    left: 30%;
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
	<div id="loader"><img src="{{url('/')}}/images/win.gif" /></div>
</div>
<div class="container-fluid fix-left-bar">
   <div class="row">
      @include('front.member.member_sidebar')  
      <div class="col-sm-9 col-md-9 col-lg-10 middle-content">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
            <h2 class="my-profile m-history">Manage Uploads</h2>
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
                        <thead class="box  hideRow hideRow{{$key+1}}">
                           <tr class="top hideAll" id="{{$key+1}}">
                              <td>{{$key+1}}</td>
                              <td>
                                 {{isset($uploads['skill_name'])?$uploads['skill_name']:'NA'}} Real Time Interview Questions &amp; Answers   
                              </td>
                              <td>
                                 {{isset($uploads['experience_level'])?$uploads['experience_level']:'NA'}} Year
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
                           <tr class="bottom" style="display:none;">
                              <td colspan="4">
                                 <div class="multi-tabbing">
								    <div class="panel with-nav-tabs panel-default">
										<div class="panel-heading">
											<ul class="nav nav-tabs">
												<li class="active"><a style="font-size: 14px;" href="#tab1default{{$uploads['id']}}" data-toggle="tab">Interview Q & A</a></li>
												@if(!empty($arr_user_info[0]['company_qa_tab']))
												<li><a style="font-size: 14px;" href="#tab2default{{$uploads['id']}}" data-toggle="tab">Interviews by Companies</a></li>
												@endif
												@if(!empty($arr_user_info[0]['real_issues_qa_tab']))
												<li><a style="font-size: 14px;" href="#tab3default{{$uploads['id']}}" data-toggle="tab">Real Time Issues (Tickets, Tasks, Etc.,)</a></li>
												@endif
												<li><a style="font-size: 14px;" href="{{url('/member/biography')}}">Bookings</a></li>
											</ul>
										</div>
										<div class="panel-body">
											<div class="tab-content">
												<div class="tab-pane fade in active" id="tab1default{{$uploads['id']}}">
													<!--tab 1-->
													<div class="middle-box">
													   <div class="sub-tab">
														  <div class="ref-book" style="width: 100%;">
															 <h4>
																<!--<i class="fa fa-star" aria-hidden="true"></i>Interview Reference Book-->
																<!--<span data-toggle="modal" href="#ref-book-{{$uploads['id']}}">
																<i class="fa fa-plus" aria-hidden="true"></i>
																</span> --> 
																<span class="addTopicMain" style="background-color: #17b0a4;color:#fff;border: 1px solid #17b0a4;padding:5px;">
																	<i class="fa fa-plus" aria-hidden="true"></i><span style="color:#fff">Add Topic</span>
																 </span>												
															 </h4>
														  </div>
													   </div>
													   <div class="table-search-pati section1-tab add-skiils-table middle-bottom">
														  <div class="table-responsive">
															 <table class="table">
																<tbody>
																   @if(isset($uploads['reference_book_details']) && sizeof($uploads['reference_book_details'])>0)
																   <tr class="top-strip-table">
																	  <td>Topic Name</td>
																	  <td>File Size</td>
																	  <td>Date & Time</td>
																	  <td>Status</td>
																	  <td  style="text-align: center;">Action</td>
																   </tr>
																   
																   <?php
																   $results = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$uploads['id']."' group by topic_name ORDER BY `multi_reference_book`.`id` DESC") );
																	
																	foreach ($results as $key=>$user) {
																		
																		$delete="/member/delete_reference_book_all/".base64_encode($user->topic_name);
																		$string = ucwords(strtolower(mb_strimwidth($user->topic_name, 0, 95, '...')));
																		?>
																		<tr style="background-color: #ecf8f7">
																			<td colspan="5" title="{{$string}}">{{$key+1}} . {{$string}} 
																			<span style="float:right"><span style="margin-left:10px;color:rgba(85, 85, 85, 0.82)"><i class="fa fa-pencil"></i></span>
																			<a style="margin-left:10px;color:rgba(85, 85, 85, 0.82)" href="{{$delete}}" onclick="return confirm('Are you sure to Delete this record?')"><i class="fa fa-trash-o"></i></a> 
																			<span class="showPDFExcelAdd" attrId="{{$uploads['id']}}" txtattr="{{$user->topic_name}}" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;margin-left:10px;"><i class="fa fa fa-plus"></i> Add Part</span></span></td>
																		 </tr>
																			<?php
																				   $results1 = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$uploads['id']."' AND topic_name = '".$user->topic_name."' ORDER BY `multi_reference_book`.`id` DESC") );
																					foreach ($results1 as $key1=>$user1) {
																						
																						 if($user1->file_extension =='Pdf'){
																							 $icon='<i class="fa fa-file-pdf-o"></i>';
																						 }else if($user1->file_extension =='Video'){
																							 $icon='<i class="fa fa-play"></i>';
																						 }else{
																							 $icon="";
																						 }
																						 
																						 if($user1->approve_status==1){
																							 $status="Approved";
																							 $freeView="";
																							 $url="/member/delete_reference_book/".base64_encode($user->id);
																							 $dow="/uploads/refrence_book/".$user->mul_reference_book;
																							 $action='<a style="color:rgba(85, 85, 85, 0.82)" href="'.$dow.'" target="_New"><i class="fa fa-eye" aria-hidden="true"></i></a><a style="margin-left:10px;" href="'.$dow.'" download="" class="download-i"><i style="color: rgba(85, 85, 85, 0.82) !important;" class="fa fa-download" aria-hidden="true"></i></a><a style="margin-left:10px;color:rgba(85, 85, 85, 0.82)" class="editInterview"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a style="margin-left:10px;color:rgba(85, 85, 85, 0.82)" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
																						 }
																							 
																						 else{
																							 $status="Pending";
																							 $freeView="/member/freePreview/".base64_encode($user1->id);
																							 $url="/member/delete_reference_book/".base64_encode($user->id);
																							 $dow="/uploads/refrence_book/".$user->mul_reference_book;
																							 $action='<a style="color:red" href="'.$dow.'" target="_New"><i class="fa fa-eye" aria-hidden="true"></i></a><a style="margin-left:10px;" href="'.$dow.'" download="" class="download-i"><i style="color: red !important;" class="fa fa-download" aria-hidden="true"></i></a><a style="margin-left:10px;" data-toggle="modal" href="#ref-book-'.$user->id.'"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a style="margin-left:10px;" href="'.$url.'" onclick="return confirm("Are you sure to Delete this record?")" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
																						 }
																						 
																						 
																					?>
																					<tr>
																						<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $icon ?> &nbsp;&nbsp; Part {{$key1+1}} &nbsp;&nbsp; {{$user1->pageCount}} </td><td>{{$user1->fileSize}} M.B</td>
																						<td>{{$user1->created_at}} 
																						<?php 
																						if($user1->freePreview ==''&& $status=='Pending'){
																						?>
																						<a style="margin-left:10px;" href="{{$freeView}}" onclick="return confirm('Are you sure you want make it free?')"><button title="Make a free preview" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;width:50px;"> Free </button></a>
																						<?php 
																						}else{
																							?>
																							<button title="Free preview" style="background-color: red;border: 1px solid #17b0a4;color: #fff;width:50px;border:none;margin-left:10px;"> Free </button>
																							<?php
																						}
																						?>
																						</td>
																						<td><?php echo $status;?></td>
																						<td><?php echo $action;?></td>
																					</tr>
																					<div class="modal fade popup-cls" id="ref-book-{{@$user->id}}" role="dialog">
																					  <div class="modal-dialog">
																						 <div class="modal-content">
																							<div class="modal-header">
																							   <button type="button" class="close" data-dismiss="modal"><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"/></button>
																							   <h4 class="modal-title">Reference Book</h4>
																							</div>
																							<div class="modal-body">
																							   <div class="row">
																							   </div>
																							   {{ csrf_field() }}
																							 <meta name="csrf_token" content="{{ csrf_token() }}" />
																							   <div style="color:green;" id='reference_success_msg-{{@$user1->id}}'>
																							</div>
																							<div class="form-group">
																										   <div class="row">
																											  <div class="col-sm-12 col-md-4 col-lg-4"><label>Topic Name<span class="error" style="color:red;">*</span></label> 
																											  </div>
																											  <div class="col-sm-12 col-md-8 col-lg-8">
																												 <input class="input-box-signup" type="text" id="updatetopic_name-reference-{{@$user1->id}}" name="updatetopic_name" value="{{@$user->topic_name}}">
																												 <div id="updatereference_error_topic-{{@$user1->id}}" class="error"></div>
																												 <div id="updatelen_reference_error_topic-{{@$user1->id}}" class="error"></div>
																											  </div>
																										   </div>
																										</div>
																							<div class="form-group">
																							  <div class="row">
																											  <div class="col-sm-12 col-md-4 col-lg-4">
																												  <label>Uploads <span class="error" style="color:red;">*</span></label></div>
																								<div class="col-sm-12 col-md-8 col-lg-8">
																								 <input id="updatereference_book-{{@$user1->id}}"  style="visibility:hidden; height: 0;" name="updatereference_book" type="file">
																									 <div class="input-group ">
																										<div class="btn btn-primary btn-file btn-gry">
																										   <a class="file" onclick="updatebrowseReferenceBook({{@$user1->id}})">Choose File
																										   </a>
																										</div>
																										<div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="updatebtn_remove_reference_book-{{@$user1->id}}">
																										   <a class="file" onclick="updateremoveReferenceBook({{@$user1->id}})"><i class="fa fa-trash"></i>
																										   </a>
																										</div>
																										<input class="form-control file-caption  kv-fileinput-caption" id="updatereference_book_name-{{@$user1->id}}" disabled="disabled" type="text" style="height: 38px;">

																									   
																										
																										<h5 class="upload">Support Formats: PDF, Max File 500 KB</h5>
																										<div id="error_msg-{{@$user1->id}}" class="error"></div>
																							 <div id="updatecreate_error_attachment-{{@$user1->id}}" class="error" style="left:0;"></div>
																									 </div>
																								  </div>
																								  <div class="clearfix"></div>
																							   </div>

																							</div>
																							
																							<!--end-->
																						 </div>
																						 <div class="modal-footer">
																							<button  type="button" id="update_reference_book" onclick="javascript: return updaterefbookupload({{@$user1->id}});" class="submit-btn ctn">Upload</button>

																						 </div>
																					  </div>
																					<?php
																					}
																					?>
																		<?php
																		
																	}
																	
																   ?>
																  
																 
																   @else
																   <tr>
																	  <td style="color:red;">
																		 No Records found...
																	  </td>
																   </tr>
																   @endif
																</tbody>
															 </table>
															 <!-- Ramakrishna -->
													<hr/>
																 <div style="clear:both;"></div>
																 <div class="addbook" style="height:22px;">
																	   <div class="row">
																	   </div>
																	   {{ csrf_field() }}
																	   
																	   <input type="hidden" class="interviewid"  id="unique_id" value="{{@$uploads['id']}}">
																	   <input type="hidden" id="skill_id_reference-{{@$uploads['id']}}" value="{{@$uploads['skill_id']}}">
																	   <input type="hidden" id="experience_level_reference-{{@$uploads['id']}}" value="{{@$uploads['experience_level']}}">
																	   <div style="color:green;" id="reference_success_msg-{{@$uploads['id']}}">
																	</div>
																	<div style="clear:both;"></div>
																	<div class="form-group topicText" style="padding:10px;">
																	   <div class="row">
																		  <div class="col-sm-11 col-md-3 col-lg-3" style="margin-left:20px;"><label>Topic<span class="error" style="color:red;">*</span></label> 
																		  </div>
																		 
																		  <div class="col-sm-12 col-md-8 col-lg-8">
																			 <input class="input-box-signup topicTextbox{{$uploads['id']}}"  type="text" id="topic_name-reference-{{@$uploads['id']}}" name="topic_name" value="{{@$uploads['topic_name']}}">
																			 <div id="reference_error_topic-{{@$uploads['id']}}" class="error"></div>
																			 <div id="len_reference_error_topic-{{@$uploads['id']}}" class="error"></div>
																			 <!-- actions-->
																			 <div class="actionsBooks">
																				<button class="submit-btn ctn saveBookBtn" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;">Save</button>
																				<button class="member-profile-btn cancelBookBtn" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;">Cancel</button>
																			 </div>
																		  </div>
																		  
																	   </div>
																	</div>
																	<div style="clear:both;"></div>
																	<!-- topic save -->
																	<div class="form-group topicSave" style="">
																		<div class="col-md-12" style="padding:6px;background-color: #ecf8f7;">
																			<span class="col-md-8 addTopicname" style="margin-top: 8px;"></span>
																			<span class="col-md-1 editTopic" style="margin-top: 8px;"><i class="fa fa-pencil"></i></span>
																			<span class="col-md-1 deleteTopic" style="margin-top: 8px;"><i class="fa fa-trash-o"></i></span>
																			<span class="col-md-2 showPDFExcel" style="background-color: #17b0a4;border: 1px solid #17b0a4;float: right;color: #fff;padding: 5px;width:92px;"><i class="fa fa fa-plus"></i> Add Part</span>
																		</div>
																	</div>
																	<div style="clear:both;"></div>
																	<div class="form-group videoPdfIcon" style="border:1px solid #ccc;padding:5px;">
																	  <div class="row">
																		<div class="col-sm-12 col-md-4 col-lg-4"> Add Part </div>
																		<div class="col-sm-12 col-md-8 col-lg-8">
																			<div class="col-sm-12 col-md-4 col-lg-4 videoIcon"><i class="fa fa-play"  style="font-size:30px; border: 1px solid #ccc;padding: 15px;margin-top:10px;"></i><span style="clear: both;display: block;">Video (MP4)</span></div>
																			<div class="col-sm-12 col-md-4 col-lg-4 pdfIcon"><i class="fa fa-file-pdf-o" style="font-size:30px; border: 1px solid #ccc;padding: 15px;margin-top:10px;"></i><span style="clear: both;display: block;margin-left: 20px;">Pdf</span></div>
																			<div style="clear:both;"></div>
																		</div>
																		</div>
																	</div>
																	<div style="clear:both;"></div>
																	<div class="form-group">
																	   <div class="row">
																		<div class="col-sm-12 col-md-12 col-lg-12">
																			<div class="videoclass" style="border: 1px solid #ccc;padding:15px;">
																				<!--<input id="reference_book-{{@$uploads['id']}}"  style="visibility:hidden; height: 0;" name="reference_book" type="file">-->
																				 <div class="input-group col-sm-12 col-md-12 col-lg-12">
																					<div class="btn btn-primary btn-gry col-sm-6 col-md-6 col-lg-6" style="background-color: #eee;border:none;">
																					   <!--<a class="file" onclick="browseReferenceBook({{@$uploads['id']}})">Choose File
																					   </a>-->
																					   <input id="reference_book-{{@$uploads['id']}}" accept="video/mp4" class="reference_bookVideo-{{@$uploads['id']}} reference_bookVideo" onchange="setFileInfo(this.files)" name="reference_book" type="file">
																					</div>
																					<input type="hidden" name="durationVideo" id="durationVideo">
																					<div class="col-sm-6 col-md-6 col-lg-6">
																						
																						<div class="btn btn-warning cancelFinalBtn" style="padding: 11px;height: 40px;float:right;margin-top: 0px;background-color: #17b0a4; width:125px;margin-left: 10px;border:none;">Cancel</div>
																						<button  type="button" id="update_reference_book" onclick="javascript: return refbookupload({{@$uploads['id']}});" style="float:right;width:125px;" class="submit-btn ctn bookbtn">Upload</button>
																					</div>
																					<div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_reference_book-{{@$uploads['id']}}">
																					   <a class="file" onclick="removeReferenceBook({{@$uploads['id']}})"><i class="fa fa-trash"></i>
																					   </a>
																					</div>
																					<input class="form-control file-caption  kv-fileinput-caption" id="reference_book_name-{{@$uploads['id']}}" disabled="disabled" type="text" style="height: 38px;">
																					<h5 class="upload">Support Formats: MP4, Max File 300 MB</h5>
																					<h5 class="upload">Tip: video is InterviewXp's preferred delivery type wide screen 16:9 ratio is preferred. Please note that the average video length is within 5-10 minutes. Content should be with high resolution video 720p (1280x720)</h5>
																					<div id="error_msg-{{@$uploads['id']}}" class="error"></div>
																					<div id="create_error_attachment-{{@$uploads['id']}}" class="error" style="left:0;"></div>
																				 </div>
																			</div>
																			<div class="pdfclass" style="border: 1px solid #ccc;padding:15px;">
																				<!--<input id="reference_book-{{@$uploads['id']}}"  style="visibility:hidden; height: 0;" name="reference_book" type="file">-->
																				 <div class="input-group  col-sm-12 col-md-12 col-lg-12">
																					
																					<div class="col-sm-6 col-md-6 col-lg-6 btn btn-primary  btn-gry" style="background-color: #eee;border:none;">
																					   <!--<a class="file" onclick="browseReferenceBook({{@$uploads['id']}})">Choose File
																					   </a>-->
																					   <input id="reference_book-{{@$uploads['id']}}" class="reference_bookPdf-{{@$uploads['id']}} reference_bookPdf" accept="application/pdf" name="reference_book" type="file">
																					</div>
																					<div class="col-sm-6 col-md-6 col-lg-6">
																						<div class="btn btn-warning cancelFinalBtn" style="padding: 11px;height: 40px;margin-top: 0px;background-color: #17b0a4; width:125px;margin-right: 10px;border:none; float:right">Cancel</div>
																						<button  type="button" id="update_reference_book" onclick="javascript: return refbookupload({{@$uploads['id']}});" style="margin-right:10px;width:125px; float:right"  class="submit-btn ctn bookbtn">Upload</button>
																					</div>
																					<div class="btn btn-primary btn-file remove"  style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_reference_book-{{@$uploads['id']}}">
																					   <a class="file" onclick="removeReferenceBook({{@$uploads['id']}})"><i class="fa fa-trash"></i>
																					   </a>
																					</div>
																					<input class="form-control file-caption  kv-fileinput-caption" id="reference_book_name-{{@$uploads['id']}}" disabled="disabled" type="text" style="height: 38px;">
																					<h5 class="upload">Support Formats: PDF, Max File 2 MB</h5>
																					<div id="error_msg-{{@$uploads['id']}}" class="error"></div>
																					<div id="create_error_attachment-{{@$uploads['id']}}" class="error" style="left:0;"></div>
																				 </div>
																			</div>
																		</div>
																		
																	   </div>
																		  <div class="clearfix"></div>
																	   </div>

																	</div>
																
																<!-- custom code Ramakrishna-->
																<!--end-->
															 </div>
														  </div>
													   </div>
												</div>
												@if(!empty($arr_user_info[0]['company_qa_tab']))
												<div class="tab-pane fade" id="tab2default{{$uploads['id']}}">
													<div class="middle-box">
														<div class="sub-tab">
														   <div class="ref-book">
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
														</div>
														<div class="table-search-pati section1-tab add-skiils-table middle-bottom">
														   <div class="table-responsive">
															  <table class="table">
																 <tbody>
																	@if(isset($uploads['interview_details']) && sizeof($uploads['interview_details'])>0)
																	<tr class="top-strip-table">
																	   <td><b>Company Name</b></td>
																	   <td>File Name</td>
																	   <td>Date &amp; Time Uploaded</td>
																	   <td>Status</td>
																	   <td  style="text-align: center;">Action</td>
																	</tr>
																	<?php
																	   $results = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$uploads['id']."' group by company_id ORDER BY `id` DESC") );
																		foreach ($results as $key=>$user) {
																			$delete="/member/delete_interview_all/".base64_encode($user->company_id);
																			$att = DB::table('interview_detail')
																				  ->where('company_id', '=', $user->company_id)
																				  ->orderBy('id','desc')
																				  ->first();
																			if($att->roundType =='Call / Email Schedul')
																				$typeofRound='addTechRoundAdd';
																			else if($att->roundType =='Technical Round')
																				$typeofRound='addPmRoundAdd';
																			else if($att->roundType =='PM Round')
																				$typeofRound='addHrRoundAdd';
																			else
																				$typeofRound='NoAdd';
																			
																			$NameCompany = DB::table('company_master')
																				  ->where('company_id', '=', $user->company_id)
																				  ->first();
																			$NameC=$NameCompany->company_name;
																			?>
																			<tr style="background-color: #ecf8f7">
																				<td colspan="5">{{$key+1}} . {{$NameC}} ({{$user->company_location}}) 
																				<span style="float:right"><span style="margin-left:10px;color:rgba(85, 85, 85, 0.82)"><i class="fa fa-pencil"></i></span>
																				<a style="margin-left:10px;color:rgba(85, 85, 85, 0.82)" href="{{$delete}}" onclick="return confirm('Are you sure to Delete this record?')"><i class="fa fa-trash-o"></i></a> 
																				<span class="{{$typeofRound}}" attrId="{{$uploads['id']}}" companyName={{$NameC}} txtattr="{{$user->company_location}}" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;margin-left:10px;"><i class="fa fa fa-plus"></i> Add Round</span></span></td>
																			 </tr>
																				<?php
																				   $results1 = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$uploads['id']."' AND company_id = '".$user->company_id."'") );
																					foreach ($results1 as $key1=>$user1) {
																						 if($user1->file_extension =='Pdf'){
																							 $icon='<i class="fa fa-file-pdf-o"></i>';
																						 }
																							 
																						 if($user1->file_extension =='Video'){
																							 $icon='<i class="fa fa-play"></i>';
																						 }
																						 
																						 if($user1->approve_status==1){
																							 $status="Approved";
																							 $freeViewCompany="";
																							 $dow="/uploads/company_attachment/".$user1->attachment;
																							 $action='<a style="color:rgba(85, 85, 85, 0.82)" href="'.$dow.'" target="_New"><i class="fa fa-eye" aria-hidden="true"></i></a><a style="margin-left:10px;" href="'.$dow.'" download="" class="download-i"><i style="color: rgba(85, 85, 85, 0.82) !important;" class="fa fa-download" aria-hidden="true"></i></a><a style="margin-left:10px;color: rgba(85, 85, 85, 0.82)" ><i class="fa fa-pencil" aria-hidden="true"></i></a> <a style="margin-left:10px;color: rgba(85, 85, 85, 0.82)" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
																						 }
																							 
																						 else{
																							 $status="Pending";
																							 $freeViewCompany= url('/member/freePreviewCompany')."/".base64_encode($user1->user_id)."/".base64_encode($user1->id);
																							 $url="/member/delete_interview/".base64_encode($user->id);
																							 $dow="/uploads/company_attachment/".$user1->attachment;
																							 $action='<a style="color:red" href="'.$dow.'" target="_New"><i class="fa fa-eye" aria-hidden="true"></i></a><a style="margin-left:10px;" href="'.$dow.'" download="" class="download-i"><i style="color: red !important;" class="fa fa-download" aria-hidden="true"></i></a><a style="margin-left:10px;" data-toggle="modal"  href="#update_company-'.$user1->id.'"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a style="margin-left:10px;" href="'.$url.'" onclick="return confirm("Are you sure to Delete this record?")" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
																						 }
																						 
																						 
																					?>
																					<tr>
																						<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $icon ?> &nbsp;&nbsp; {{$user1->roundType}} &nbsp;&nbsp; {{$user1->pageCount}}</td>
																						<td>{{$user1->fileSize}} M.B</td>
																						<td>{{$user1->created_at}}
																						<?php 
																						if($user->freePreview =='' && $status=='Pending'){
																						?>
																						<a style="margin-left:10px;" href="{{$freeViewCompany}}" onclick="return confirm('Are you sure you want make it free?')"><button title="Make a free preview" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;width:50px;"> Free </button></a>
																						<?php 
																						}else{
																							?>
																							<button title="Free preview" style="background-color: red;border:none;width:50px;margin-left:10px;color:#fff"> Free </button>
																							<?php
																						}
																						?>
																						</td>
																						<td><?php echo $status;?></td>
																						<td><?php echo $action;?></td>
																					</tr>
																					<div class="modal fade popup-cls" id="update_company-{{$user1->id}}" role="dialog">
																					  <div class="modal-dialog">
																						 <div class="modal-content">
																							<div class="modal-header">
																							   <button type="button" class="close" data-dismiss="modal"><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"/></button>
																							   <h4 class="modal-title">Update Company</h4>
																							</div>
																							<div class="modal-body">
																							   <div class="row">
																							   </div>
																							   <div id="error_update_company-{{$user1->id}}" class="error"></div>
																							   <div id="success_update_company-{{$user1->id}}" style="color:green;"></div>
																							   {{ csrf_field() }}
																							   <!--upload resume section-->
																							   <div style="color:green;" id='success_msg-{{$user1->id}}'>
																							</div>
																							<div class="form-group">
																							  <div class="row">
																							  <div class="col-sm-12 col-md-4 col-lg-4"><label>Company<span class="star"  style="color:red;">*</span></label> 
																							  </div>
																							  <div class="col-sm-12 col-md-8 col-lg-8">
																							  <input class="input-box-signup" type="text" readonly="" name="company_id" value="{{$NameC}}">
																							  
																							  </div>
																							  </div>
																							</div>
																							<div class="form-group">
																							   <div class="row">
																								  <div class="col-sm-12 col-md-4 col-lg-4"><label>Location<span class="star" style="color:red;">*</span></label> 
																								  </div>
																								  <div class="col-sm-12 col-md-8 col-lg-8">
																									 <input class="input-box-signup" readonly="" type="text" value="{{@$user1->company_location}}" name="company_location">
																									 <div id="update_error_location-{{@$user1->id}}" class="error"></div>
																								  </div>
																							   </div>
																							</div>
																							<div class="form-group">
																							  <div class="row">
																							  <div class="col-sm-12 col-md-4 col-lg-4"><label>Round Name<span class="star"  style="color:red;">*</span></label> 
																							  </div>
																							  <div class="col-sm-12 col-md-8 col-lg-8">
																							  <input class="input-box-signup" type="text" name="company_Round-{{@$user1->id}}" id="company_Round-{{@$user1->id}}" value="{{$user1->roundType}}">
																							  
																							  </div>
																							  </div>
																							</div>
																							<div class="form-group">
																							   <div class="row">
																							  <div class="col-sm-12 col-md-4 col-lg-4">
																							   <label>Uploads<span class="star" style="color:red;">*</span></label>
																								   </div>
																								<div class="col-sm-12 col-md-8 col-lg-8">
																									 <input id="update_company_file-{{@$user1->id}}"  style="visibility:hidden; height: 0;" accept="video/mp4,application/pdf" name="company_file" type="file">
																									 <div class="input-group ">
																										<div class="btn btn-primary btn-file btn-gry">
																										   <a class="file" onclick="update_browsecompanyfile({{@$user1->id}})">Choose File
																										   </a>
																										</div>
																										<div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="update_btn_remove_company_file-{{@$user1->id}}">
																										   <a class="file" onclick="update_removecompanyfile({{@$user1->id}})"><i class="fa fa-trash"></i>
																										   </a>
																										</div>
																										<input class="form-control file-caption  kv-fileinput-caption" id="update_company_file_name-{{@$user1->id}}" disabled="disabled" type="text">
																									 </div>
																									  <h5 class="upload">Support Formats: PDF (Max File 5 MB), Video (Max File 300 MB)</h5>
																									   <div id="update_error_attachment-{{@$user1->id}}" class="error"></div>
																							<div id="update_company_upload_msg-{{@$user1->id}}" class="error"></div>
																								  </div>
																								  <div class="clearfix"></div>
																							   </div>
																							  
																							</div>
																						   
																							<!--end-->
																						 </div>
																						 <div class="modal-footer">
																							<button type="button" id="update_company" onclick="javascript: return update_companyupload({{@$user1->id}});" class="submit-btn ctn">Upload</button>
																						 </div>
																					  </div>
																				   </div>
																				</div>
																					<?php
																					}
																					?>
													
																		<?php
																	}
																   ?>
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
														<!-- form start -->
														<div>
															  {{ csrf_field() }}
															  <div id="error_company-{{@$uploads['id']}}" class="error" style="color:red;"></div> 
															  <div id="success_company-{{@$uploads['id']}}" style="color:green;"></div>   
															  <input type="hidden" id="skill_id_company-{{@$uploads['id']}}" value="{{@$uploads['skill_id']}}">
															  <input type="hidden" id="experience_level_company-{{@$uploads['id']}}" value="{{@$uploads['experience_level']}}">
															  <div style="color:green;" id="success_msg-{{@$uploads['id']}}"></div>
															  <div class="CompanyAll" style="width:96%;margin:0px auto;border:1px solid rgba(39, 9, 9, 0.28);">
																 <input type="hidden" name="roundTypeVal" class="roundTypeVal">
																  <div class="form-group CompanyText" style="background-color: #ecf8f7;display: -webkit-box;">
																	  <div class="col-sm-12 col-md-12 col-lg-12" style="padding:10px;">
																		  <span class="CompanyTextAppend"></span><span class="LocationTextAppend"></span>
																		  <span class="CompanyTextEdit"><i class="fa fa-pencil"></i></span>
																	  </div>
																  </div>
																   <div style="clear:both;"></div><br/>
																  <div class="form-group Company">
																	  <div class="col-sm-12 col-md-4 col-lg-4">
																	  <label>Company Name<span class="star" style="color:red;">*</span></label> <br/>
																	  </div>
																	  <div class="col-sm-12 col-md-8 col-lg-8">
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
																			<button class="submit-btn ctn saveCompanyBtn" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;">Save</button>
																			<button class="member-profile-btn cancelCompanyBtn" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;">Cancel</button>
																		 </div>
																	  </div>
																  </div>
						  
																  

																  <div style="clear:both;"></div><br/>
																  <div class="form-group">
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
																  </div>
																  
																  <div style="clear:both;"></div><br/>
																  <div class="form-group">
																		<div class="TechnicalRound" style="width:96%;margin:0px auto;border: 1px solid rgba(39, 9, 9, 0.28);height: 43px;padding: 10px;">
																		  <div class="col-sm-12 col-md-8 col-lg-8"><label>Technical Round</label></div>
																		  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
																			  <span class="addTechRound" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
																		  </div>
																	  </div>
																  </div>
																  
																  <div style="clear:both;"></div><br/>
																  <div class="form-group">
																	  <div class="PMRound"  style="width:96%;margin:0px auto;border: 1px solid rgba(39, 9, 9, 0.28);height: 43px;padding: 10px;">
																		  <div class="col-sm-12 col-md-8 col-lg-8"><label>PM Round</label></div>
																		  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
																			  <span class="addPmRound" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
																		  </div>
																	  </div>
																  </div>
																  
																  <div style="clear:both;"></div><br/>
																  <div class="form-group">
																	  <div class="HRRound" style="width:96%;margin:0px auto;border: 1px solid rgba(39, 9, 9, 0.28);height: 43px;padding: 10px;">
																		  <div class="col-sm-12 col-md-8 col-lg-8"><label>HR Round</label></div>
																		  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
																			  <span class="addHrRound" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
																		  </div>
																	  </div>
																  </div>
																  
															  </div>

															  <div style="clear:both;"></div>
														  </div>
														<!-- form end -->
													 </div>
													</div>
												</div>
												@endif
												@if(!empty($arr_user_info[0]['real_issues_qa_tab']))
												<div class="tab-pane fade" id="tab3default{{$uploads['id']}}">
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
												 </span>
												   </h4>
												   </div>
												   </div>
												   <div class="table-search-pati section1-tab add-skiils-table middle-bottom">
												   <div class="table-responsive">
												   <table class="table">
													   <tbody>
													   @if(isset($uploads['realtime_details']) && sizeof($uploads['realtime_details'])>0)
													   <tr class="top-strip-table">
													   <td>Tickets, Tasks, Etc.,</td>
													   <td>File Size</td>
													   <td>Date & Time Uploaded</td>
													   <td>Status</td>
													   <td style="text-align: center;">Action</td>
													   </tr>
													   <?php
													   $results = DB::select( DB::raw("SELECT * FROM member_real_time_experience WHERE interview_id = '".$uploads['id']."' group by issue_title ORDER BY `id` DESC") );
													   $i=1;
														foreach ($results as $key=>$user) {
															$i++;
															$delete="/member/delete_realtime_all/".base64_encode($user->user_id)."/".base64_encode($user->issue_title);
															$string = ucwords(strtolower(mb_strimwidth($user->issue_title, 0, 95, '...')));
															?>
															<tr style="background-color: #ecf8f7">
																<td colspan="5" title="{{$user->issue_title}}">{{$key+1}} . {{$string}} 
																<span style="float:right"><!--<span style="margin-left:10px;color:rgba(85, 85, 85, 0.82)"><i class="fa fa-pencil"></i></span>-->
																<a style="margin-left:10px;color:rgba(85, 85, 85, 0.82)" href="{{$delete}}" onclick="return confirm('Are you sure to Delete this record?')"><i class="fa fa-trash-o"></i></span></a> 
																</td>
															 </tr>
																<?php
																	   $results1 = DB::select( DB::raw("SELECT * FROM member_real_time_experience WHERE interview_id = '".$uploads['id']."' AND issue_title = '".$user->issue_title."'") );
																		foreach ($results1 as $key1=>$user1) {
																			 if($user1->file_extension =='Pdf'){
																				 $icon='<i class="fa fa-file-pdf-o"></i>';
																			 }else if($user1->file_extension =='Video'){
																				 $icon='<i class="fa fa-play"></i>';
																			 }else{
																				 $icon="";
																			 }
																			 
																			 if($user1->approve_status==1){
																				 $status="Approved";
																				 $freeViewReal="";
																				 $dow="/uploads/real_time_attachment/".$user1->attachment;
																				 $action='<a style="color:rgba(85, 85, 85, 0.82)" href="'.$dow.'" target="_New"><i class="fa fa-eye" aria-hidden="true"></i></a><a style="margin-left:10px;" href="'.$dow.'" download="" class="download-i"><i style="color: rgba(85, 85, 85, 0.82) !important;" class="fa fa-download" aria-hidden="true"></i></a><a style="margin-left:10px;color:rgba(85, 85, 85, 0.82)" ><i class="fa fa-pencil" aria-hidden="true"></i></a> <a style="margin-left:10px;color:rgba(85, 85, 85, 0.82)" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
																			 }
																				 
																			 else{
																				 $status="Pending";
																				 $freeViewReal="/member/freePreviewReal/".base64_encode($user1->user_id)."/".base64_encode($user1->id);
																				 $url="/member/delete_realtime/".base64_encode($user->user_id)."/".base64_encode($user->id);
																				 $dow="/uploads/real_time_attachment/".$user1->attachment;
																				 $action='<a style="color:red" href="'.$dow.'" target="_New"><i class="fa fa-eye" aria-hidden="true"></i></a><a style="margin-left:10px;" href="'.$dow.'" download="" class="download-i"><i style="color: red !important;" class="fa fa-download" aria-hidden="true"></i></a><a style="margin-left:10px;" data-toggle="modal"  href="#real-time-update-'.$user1->id.'"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a style="margin-left:10px;" href="'.$url.'" onclick="return confirm("Are you sure to Delete this record?")" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
																			 }
																			 
																		?>
																		<tr>
																			<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $icon ?> &nbsp;&nbsp; {{$user1->pageCount}} </td><td>{{$user1->fileSize}} M.B</td>
																			<td>{{$user1->created_at}}
																			<?php 
																			if($user->freePreview =='' && $status=='Pending'){
																			?>
																			<a style="margin-left:10px;" href="{{$freeViewReal}}" onclick="return confirm('Are you sure you want make it free?')"><button title="Make a free preview" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;width:50px;"> Free </button></a>
																			<?php 
																			}else{
																				?>
																				<button title="Free preview" style="background-color: red;border:none;width:50px;margin-left:10px;color:#fff"> Free </button>
																				<?php
																			}
																			?>
																			</td>
																			<td><?php echo $status;?></td>
																			<td style="float:right"><?php echo $action;?></td>
																		</tr>
																		<div class="modal fade popup-cls" id="real-time-update-{{$user1->id}}" role="dialog">
																		   <div class="modal-dialog">
																			   <div class="modal-content">
																			   <div class="modal-header">
																			   <button type="button" class="close" data-dismiss="modal"><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"/></button>
																			   <h4 class="modal-title">Update Real time work experience</h4>
																			   </div>
																			   <div class="modal-body">
																			   {{ csrf_field() }}
																			   <div style="color:green;" id="success_update_realtime_msg-{{$user1->id}}"></div>
																			   <div class="error" id="error_in_updating_realtime" ></div>
																			   <div class="form-group">
																			   <div class="row">
																			   <div class="col-sm-12 col-md-4 col-lg-4"><label>Tasks, Tickets, Etc.,<span class="star">*</span></label> 
																			   </div>
																			   <div class="col-sm-12 col-md-8 col-lg-8">
																			   <input class="input-box-signup" type="text" id="issue_title_update-{{@$user1->id}}" name="issue_title" value="{{@$user->issue_title}}">
																			   <div id="error_update_issue_title-{{@$user1->id}}" class="error"></div>
																			   </div>
																			   </div>
																			   </div>
																			   
																			   <!--upload resume section-->
																			   <div class="form-group">
																				<div class="row">
																			   <div class="col-sm-12 col-md-4 col-lg-4">
																			   <label>Uploads</label>
																					</div>
																			   <div class="col-sm-12 col-md-8 col-lg-8">
																			   <input id="realtime-{{$user1->id}}" style="visibility:hidden; height: 0;" accept="application/pdf" name="file" type="file">
																			   <div class="input-group ">
																			   <div class="btn btn-primary btn-file btn-gry">
																			   <a class="file" onclick="real_time_file({{$user1->id}})">Choose File
																			   </a>
																			   </div>
																			   <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_image">
																			   <a class="file" onclick="removerealtime({{$user1->id}})"><i class="fa fa-trash"></i>
																			   </a>
																			   </div>
																			   <input class="form-control file-caption  kv-fileinput-caption" id="realtime_name-{{$user1->id}}" disabled="disabled" type="text">
																			   <h5 class="upload">Support Formats:PDF, Max File 5 MB</h5>
																				 <div id="error_update_realtime_msg-{{$user1->id}}" class="error"></div>
																			   </div>
																			   </div>
																			   <div class="clearfix"></div>
																			   </div>
																			   </div>
																			 
																			   <!--end-->
																			   </div>
																			   <div class="modal-footer">
																			   <button type="button" onclick="javascript:return update_realtimeupload({{$user1->id}});" class="submit-btn ctn">Submit</button>
																			   </div>
																			   </div>
																		   </div>
																		</div>
																		<?php
																		}
																		?>
															<?php
														}
													   ?>
													   
													   @else
													   <tr>
													   <td style="color:red;">
													   No Records found...
													   </td>
													   </tr>
													   @endif
													   </tbody>
												   </table>
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
															<div class="col-sm-12 col-md-12 col-lg-12"  style="padding: 10px 0px 10px 26px;background-color: #ecf8f7;color: #000;border: 1px solid #eee;"> {{$i}}. ( Tasks, Tickets, Etc., )</div>
														   <div>
															   <textarea class="input-box-signup topicTextValueReal{{$uploads['id']}}" type="text" style="height:100px;" id="create_issue_title-{{@$uploads['id']}}" name="issue_title"></textarea>
															   <div id="error_issue_title-{{@$uploads['id']}}" class="error"></div>
															   <div id="len_error_issue_title-{{@$uploads['id']}}" class="error"></div>
															   
															   <!-- actions-->
															 <div class="actionsReal" style="text-align: center;">
																<button class="submit-btn ctn saveRealBtn" incre="{{$i}}" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;">Save</button>
																<button class="member-profile-btn cancelRealBtn" attrId="{{$uploads['id']}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:100px;">Cancel</button>
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
															<div class="col-sm-12 col-md-6 col-lg-6 addTiitle"></div>
															<div class="col-sm-12 col-md-6 col-lg-6" style="margin-top:10px;">
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
																<span class="addTiitle"></span>
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
																	<span class="addTiitle"></span>
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
	
	$(".showPDFExcelAdd").on('click', function(){
		$(".topicText").hide();
		var id=$(this).attr("attrId");
		var addtxt=$(this).attr("txtattr");
		$(".videoPdfIcon").show();
		$(".topicTextbox"+id).val(addtxt);
	});
	$(".showPDFExcelAddReal").on('click', function(){
		$(".topicTextReal").hide();
		var addtxt=$(this).attr("txtattr");
		$(".realIcons").show();
		$(".topicTextValueReal").val(addtxt);
	});
	$(".addTopicMain").on('click', function() {
		$(".videoPdfIcon").hide();
		$(".topicText").show();
		$(".actionsBooks").show(); // new
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
		$(".topicTextbox").val("");
	});
	//new
	$(".cancelBookBtn").on('click', function() {
		var id=$(this).attr("attrId");
		$(".addTopicMain").show();
		$(".topicText").hide();
		$(".actionsBooks").hide();
		$(".videoPdfIcon").hide();
		$(".topicTextbox"+id).val("");
	});
	$(".saveBookBtn").on('click', function() {
		$(".videoPdfIcon").hide();
		var id=$(this).attr("attrId");
		var txt=$(".topicTextbox"+id).val();
		if(txt ==''){
			alert("Please enter topic");
			$(".topicTextbox"+id).focus();
		}else{
			$(".topicText").hide();
			$(".actionsBooks").hide();
			$(".topicSave").show();
			$(".addTopicname").html(txt);
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
	$(".videoIcon").on('click', function() {
		$(".videoPdfIcon").hide();
		$(".videoclass").show();
		$(".pdfclass").hide();
		$(".bookbtn").show();
		$(".cancelFinalBtn").show();
		$(".cancelBtn").show();
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
	});
	$(".pdfIcon").on('click', function() {
		$(".videoPdfIcon").hide();
		$(".videoclass").hide();
		$(".pdfclass").show();
		$(".bookbtn").show();
		$(".cancelFinalBtn").show();
		$(".cancelBtn").show();
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
	});
	$(".cancelBtn").on('click', function() {
		$(".videoPdfIcon").show();
		$(".videoclass").hide();
		$(".pdfclass").hide();
		$(".bookbtn").hide();
		$(".cancelFinalBtn").hide();
		$(".cancelBtn").hide();
		$(".reference_bookVideo").val(""); // new
		$(".reference_bookPdf").val(""); // new
	});
	$(".cancelFinalBtn").on('click', function() {
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
		$(".CompanyTextAppend").html("");
		$(".LocationTextAppend").html("");
		$(".CompanyTextValue").val("");
		$(".LocationTextValue").val("");
	});
	$(".saveCompanyBtn").on("click", function(){
		var id=$(this).attr("attrId");
		var CompanyTextValue=$(".CompanyTextValue"+id).val();
		var LocationTextValue=$(".LocationTextValue"+id).val();
		
		if(CompanyTextValue =='' && LocationTextValue ==''){
			alert("Please enter comapny Name & Location");
			$(".CompanyTextValue"+id).focus();
		}else{
			$(".TechnicalRound").hide();
			$(".PMRound").hide();
			$(".HRRound").hide();
			$(".Location").hide();
			$(".Company").hide();
			$(".CompanyText").show();
			$(".CompanyTextAppend").html(CompanyTextValue);
			$(".LocationTextAppend").html("( "+LocationTextValue+" )");
		}
	});
	$(".CompanyTextEdit").on("click", function(){
		$(".Company").show();
		$(".Location").show();
		$(".CompanyText").hide();
		$(".CompanyTextAppend").html("");
		$(".LocationTextAppend").html("");
	});
	$(".cancelCompanyBtn").on("click", function(){
		var id=$(this).attr("attrId");
		$(".Company").show();
		$(".CompanyText").hide();
		$(".CompanyTextValue"+id).val("");
		$(".LocationTextValue"+id).val("");
	});
	$(".cancelCompanyBtn").on("click", function(){
		$(".Location").show();
		$(".LocationText").hide();
		$(".LocationTextValue").val("");
	});
	$(".addCallEmail").on("click", function(){
		$(".CallIcons").show();
		$(".callEmail").hide();
		$(".titleTxt").html("Call / Email Schedule");
		$(".roundTypeVal").val("Call / Email Schedule");
	});
	$(".videoIconCall").on("click", function(){
		$(".callEmailVideo").show();
		$(".CallIcons").hide();
	});
	$(".pdfIconCall").on("click", function(){
		$(".callEmailPdf").show();
		$(".CallIcons").hide();
	});
	$(".cancelCallEmailVideoBtn").on("click", function(){
		$(".callEmailVideo").hide();
		$(".CallIcons").show();
	});
	$(".cancelCallEmailPdfBtn").on("click", function(){
		$(".callEmailPdf").hide();
		$(".CallIcons").show();
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
	});
	$(".addTopicMain").click(function() {
		$('html,body').animate({
        scrollTop: $(".topicText").offset().top},
        'slow');
	});
	$(".addTopicMainCompany").click(function() {
		$('html,body').animate({
        scrollTop: $(".CompanyAll").offset().top},
        'slow');
	});
	$(".addTopicMainReal").click(function() {
		$('html,body').animate({
        scrollTop: $(".topicTextReal").offset().top},
        'slow');
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
   
   function companyupload(id)
   {
      var link         = "{{ url('/member/store_company') }}";
      var _token       = $("input[name=_token]").val();
      var company_name = $('#company_name-'+id).val();
      var location     = $('#company_location-'+id).val();
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
							  alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}";
                           }
                           else
                           {
                              $('#error_company_name-'+id).html('');  
                           }
                           
                           if(response.status=="invalid_location")
                           {
                              $('#error_location-'+id).html(response.msg);
							  alert(response.msg);
  							  window.location="{{URL::to('member/manage_upload_history')}}";							  
                           }
                           else
                           {
                              $('#error_location-'+id).html(''); 
                           }   
                           if(response.status=="invalid_file")
                           {
                              $('#company_create_error_attachment-'+id).html(response.msg);
							  alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}";
                           }
                           else
                           {
                              $('#company_create_error_attachment-'+id).html('');
                           }
                           if(response.status=="file_required")
                           {
                              $('#create_error_msg-'+id).html(response.msg);
							  alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}";
                           }
                           else
                           {
                              $('#create_error_msg-'+id).html('');
                           }
                           if(response.status=="topic_length")
                           {
                              $('#len_error_company_name-'+id).html(response.msg);
							  alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}";
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
							  alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}";
                           }
                           if(response.status=="error")
                           {
                              $('#success_company-'+id).html('');
                              $('#company_name-'+id).val('');
                              $('#company_location-'+id).val('');
                              //$('#error_company-'+id).html(response.msg).show().fadeOut(5000);
							  alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}";
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
                              //$('#error_issue_title-'+id).html(response.msg);
							  alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}";
                           }
                           else
                           {
                              //$('#error_issue_title-'+id).html('');  
							  window.location="{{URL::to('member/manage_upload_history')}}";
                           }
                           
                           if(response.status=="invalid_file")
                           {
                              //$('#error_create_realtime_file_required-'+id).html(response.msg);
							  alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}";
                           }  
                           else
                           {
                              //$('#error_create_realtime_file_required-'+id).html('');
							  window.location="{{URL::to('member/manage_upload_history')}}";
                           } 
                           if(response.status=="topic_length")
                           {
                              //$('#len_error_issue_title-'+id).html(response.msg);
							  alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}";
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
							  alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}";
                           }
                           if(response.status=="error")
                           {
                              $('#create_solution-'+id).val('');
                              $('#create_issue_title-'+id).val('');
                              $('#createrealtime-'+id).val('');
                              $('#realtime-create-success_msg-'+id).html('');
                              //$('#error_realtime_create_msg-'+id).html(response.msg).show().fadeOut(5000);
							  alert(response.msg);
							  window.location="{{URL::to('member/manage_upload_history')}}";
                           }
                       } 
                      });    
   
          
    };

</script>
@endsection

