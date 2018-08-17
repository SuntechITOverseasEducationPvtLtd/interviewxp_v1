<tr style="background-color: #fff;">
	<td colspan="5"><p style="margin-bottom: -5px" class="show-results">Showing {{($results->currentpage()-1)*$results->perpage()+1}} to {{($results->currentpage()-1) * $results->perpage() + $results->count()}}
of  {{$results->total()}} results</p>
	<input type="hidden" id="tot_interviewqa_topics-{{$interview_id}}" name="tot_interviewqa_topics" value="{{$results->total()+1}}">
																
	</td>
</tr> 
<tr class="top-strip-table">
   <td><b>Company Name</b></td>
   <td><b>File Name</b></td>
   <td><b>Date &amp; Time Uploaded</b></td>
   <td><b>Status</b></td>
   <td  style="text-align: center;"><b>Action</b></td>
</tr>
<tr class="top-strip-table CompanyTextAppendRow" style="background-color: #ecf8f7;display: none">
	<td colspan="5">{{$results->total()+1}} .<span class="CompanyTextAppend"></span><span class="LocationTextAppend"></span>
   	<span style="float:right"><span style="margin-left:10px;color:rgba(85, 85, 85, 0.82)" class="CompanyTextEdit"><i class="fa fa-pencil"></i></span>
	<a style="margin-left:10px;color:rgba(85, 85, 85, 0.82)" href="#" onclick="return confirm('Are you sure to Delete this record?')"><i class="fa fa-trash-o"></i></a> 
	<span class="addNewRound" attrId="{{$interview_id}}" companyName="" txtattr="" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;margin-left:10px;"><i class="fa fa fa-plus"></i> Add Round</span></span>
   </td>
</tr>
<tr style="display: none" class="callRounds" id="callRounds{{$interview_id}}">
	<td colspan="5">
		<div class="form-group">
			  <div class="callEmail"  style="width:96%;">
				  <div class="col-sm-12 col-md-8 col-lg-8">
				  
				    <div class="select-number">
	                  <select name="addRounds" class="addRounds" required="" data-parsley-errors-container="#err_exp_level" data-parsley-required-message="This field is required" companyname="" attrid"" txtattr="">
	                    <option value="">---Select Interview Round---</option>
	                    <option value="Call / Email Schedule">Call/Email Schedule</option>
					    <option value="Written Test">1st Round&nbsp;&nbsp;-&nbsp;&nbsp;(Written Test)</option>
					    <option value="Technical Round">2nd Round&nbsp;&nbsp;-&nbsp;&nbsp;(Technical Round)</option>
					    <option value="Onsite, Usa">3rd Round&nbsp;&nbsp;-&nbsp;&nbsp;(Onsite, Usa)</option>
					    <option value="PM Round">4rd Round&nbsp;&nbsp;-&nbsp;&nbsp;(PM Round)</option>
					    <option value="HR Round">5th Round&nbsp;&nbsp;-&nbsp;&nbsp;(HR Round)</option>
	                  </select>                  
	               </div>
				 </div>
				 <!--  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
					  <span class="addCallEmail" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
				  </div> -->
			  </div>
			  <br/>
			  <div class="col-sm-12 col-md-12 col-lg-12 CallIcons" style="border: 1px solid rgba(39, 9, 9, 0.28);padding: 10px;">
				<div><span class="titleTxt" style="width: 70%">Call/Email Schedule</span><span style="width: 30%; float: right; color: #fc575c;text-align: right;" class="closeschedules" attrid="{{@$interview_id}}">close</span></div>
				<div class="col-sm-1 col-md-1 col-lg-1"></div>
				<div class="col-sm-4 col-md-4 col-lg-4 videoIconCall" style="display: block;text-align: right;" companyname="" attrid"" txtattr=""><i class="fa fa-play" style="font-size:30px; border: 1px solid #ccc;padding: 15px;margin-top:10px;"></i><span style="clear: both;display: block;">Video (MP4)</span></div>
				<div class="col-sm-1 col-md-1 col-lg-1"></div>
				<div class="col-sm-4 col-md-4 col-lg-4 pdfIconCall" style="display: block;" companyname="" attrid"" txtattr=""><i class="fa fa-file-pdf-o" style="font-size:30px; border: 1px solid #ccc;padding: 15px;margin-top:10px;"></i><span style="clear: both;display: block;margin-left: 20px;">Pdf</span></div>
				<div style="clear:both;"></div>
			  </div>
			  <div style="clear:both;"></div><br/>
			  <div class="form-group callEmailPdf">
				 <div class="col-sm-12 col-md-12 col-lg-12" style="border: 1px solid rgba(39, 9, 9, 0.28);padding: 10px;">
					  <p class="titleTxt">Call/Email Schedule</p>
					  <div class="input-group" style="width:100%;">
						  <div class="btn btn-primary" style="background-color: #eee;border:none;">
							<input id="company_file-{{@$interview_id}}" accept="application/pdf" class="company_fileCallPdf-{{@$interview_id}} company_fileCallPdf" name="company_file" type="file">
						  </div>
						  
							<button type="button" id="create_company" onclick="javascript: return companyupload({{@$interview_id}}, $(this).attr('companyname'), $(this).attr('txtattr'));" class="member-profile-btn ctn" style="margin-left:10px;float:right;width:100px;" companyname="" attrid"" txtattr="">Upload</button>
						  <a href="javascript:;" class="cancelCallEmailPdfBtn" attrId="{{$interview_id}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:57px;float:right">Cancel</a>
						  <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_company_file-{{@$interview_id}}">
						  <a class="file" onclick="removecompanyfile({{@$interview_id}})"><i class="fa fa-trash"></i>
						  </a>
						  </div>
						  <input class="form-control file-caption  kv-fileinput-caption" id="company_file_name-{{@$interview_id}}" disabled="disabled" type="text">
						  <h5 class="upload">Support Formats: PDF, Max File 5 MB</h5>
						  <div id="company_create_error_attachment-{{@$interview_id}}" class="error" style="left:0;"></div>
						  <div id="create_error_msg-{{@$interview_id}}" class="error" style="left:0;"></div>
					  </div>
				  </div>
			  </div>
			  <div style="clear:both;"></div><br/>
			  <div class="form-group callEmailVideo">
			  <p class="titleTxt">Call/Email Schedule</p>
				 <div class="col-sm-12 col-md-12 col-lg-12" style="border: 1px solid rgba(39, 9, 9, 0.28);padding: 10px;">
					  <input id="company_file-{{@$interview_id}}"  style="visibility:hidden; height: 0;" name="company_file" type="file">
					  <div class="input-group" style="width:100%;">
						  <div class="btn btn-primary" style="background-color: #eee;border:none;">
							<input id="company_file-{{@$interview_id}}" onchange="setFileInfoCall(this.files)" accept="video/mp4"
							class="company_fileCallVideo-{{@$interview_id}} company_fileCallVideo"  name="company_file" type="file">
						  </div>
						  <input type="hidden" name="durationVideoCall" id="durationVideoCall">
						 
						 
						  <button type="button" id="create_company" onclick="javascript: return companyupload({{@$interview_id}});" class="member-profile-btn ctn" style="margin-left:10px;width:100px; float:right">Upload</button>
						   <a href="javascript:;" class="cancelCallEmailVideoBtn" attrId="{{$interview_id}}" style="border: none;border-radius:0px;height: 39px;margin-top:10px;width:57px;float:right">Cancel</a>
						  <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_company_file-{{@$interview_id}}">
						  <a class="file" onclick="removecompanyfile({{@$interview_id}})"><i class="fa fa-trash"></i>
						  </a>
						  </div>
						  <input class="form-control file-caption  kv-fileinput-caption" id="company_file_name-{{@$interview_id}}" disabled="disabled" type="text">
						  <h5 class="upload">Support Formats: MP4, Max File 300 MB</h5>
						  <h5 class="upload">Tip: video is InterviewXp's preferred delivery type wide screen 16:9 ratio is preferred. Please note that the average video length is within 5-10 minutes. Content should be with high resolution video 720p (1280x720)</h5>
						  <div id="company_create_error_attachment-{{@$interview_id}}" class="error" style="left:0;"></div>
						  <div id="create_error_msg-{{@$interview_id}}" class="error" style="left:0;"></div>
					  </div>
				  </div>
			  </div>
		  </div>
	</td>
</tr>
<tr class="TechnicalRoundtr" style="display: none">
	<td colspan="5">
		<div class="form-group">
			<div class="TechnicalRound" style="width:96%;margin:0px auto;border: 1px solid rgba(39, 9, 9, 0.28);height: 43px;padding: 10px;">
			  <div class="col-sm-12 col-md-8 col-lg-8"><label>Technical Round</label></div>
			  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
				  <span class="addTechRound" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
			  </div>
		  </div>
	  </div>
	</td>
</tr>
<tr class="PMRoundtr" style="display: none">
	<td colspan="5">
		<div class="form-group">
		  <div class="PMRound"  style="width:96%;margin:0px auto;border: 1px solid rgba(39, 9, 9, 0.28);height: 43px;padding: 10px;">
			  <div class="col-sm-12 col-md-8 col-lg-8"><label>PM Round</label></div>
			  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
				  <span class="addPmRound" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
			  </div>
		  </div>
	  </div>
	</td>
</tr>	
<tr class="HRRoundtr" style="display: none">
	<td colspan="5">
		<div class="form-group">
		  <div class="HRRound" style="width:96%;margin:0px auto;border: 1px solid rgba(39, 9, 9, 0.28);height: 43px;padding: 10px;">
			  <div class="col-sm-12 col-md-8 col-lg-8"><label>HR Round</label></div>
			  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
				  <span class="addHrRound" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
			  </div>
		  </div>
	  </div>
	</td>
</tr>		
<?php
  
	foreach ($results as $key=>$user) {
		$delete= url('/member/delete_interview_all')."/".base64_encode($user->company_id);
		$att = DB::table('interview_detail')
			  ->where('company_id', '=', $user->company_id)
			  ->orderBy('id','desc')
			  ->first();
		/*if($att->roundType =='Call / Email Schedul')
			$typeofRound='addTechRoundAdd';
		else if($att->roundType =='Technical Round')
			$typeofRound='addPmRoundAdd';
		else if($att->roundType =='PM Round')
			$typeofRound='addHrRoundAdd';
		else*/
			$typeofRound='addNewRound';
		
		$NameCompany = DB::table('company_master')
			  ->where('company_id', '=', $user->company_id)
			  ->first();
		$NameC=$NameCompany->company_name;

		?>
		<tr style="background-color: #ecf8f7">
			<td colspan="5">{{($results->currentpage()-1)*$results->perpage()+1+$key}} . {{$NameC}} ({{$user->company_location}}) 

			@if($user->approve_status==0)
			<span style="float:right"><span style="margin-left:10px;color:rgba(85, 85, 85, 0.82)"><i class="fa fa-pencil"></i></span>
			<a style="margin-left:10px;color:rgba(85, 85, 85, 0.82)" href="{{$delete}}" onclick="return confirm('Are you sure to Delete this record?')"><i class="fa fa-trash-o"></i></a> 
			@endif
			<span class="{{$typeofRound}}" attrId="{{$interview_id}}" companyName="{{@$NameC}}" txtattr="{{$user->company_location}}" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;margin-left:10px;float: right;"><i class="fa fa fa-plus"></i> Add Round</span></span></td>
		 </tr>
			<?php
			   $results1 = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$interview_id."' AND company_id = '".$user->company_id."'") );
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
						 $freeViewCompany="";
						 $dow= url('/uploads/company_attachment')."/".$user1->attachment;
						 $action='<a style="color:rgba(85, 85, 85, 0.82)" href="'.$dow.'" target="_New"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a><a style="margin-left:10px;" href="'.$dow.'" download=""   title="Download" class="download-i"><i style="color: rgba(85, 85, 85, 0.82) !important;" class="fa fa-download" aria-hidden="true"></i></a><a style="margin-left:10px;color: rgba(85, 85, 85, 0.82)" title="Edit" ><i class="fa fa-pencil" aria-hidden="true"></i></a> <a style="margin-left:10px;color: rgba(85, 85, 85, 0.82)" class="delete-i"   title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
					 }
						 
					 else{
						 $status="Pending";
						 $freeViewCompany= url('/member/freePreviewCompany')."/".base64_encode($user1->user_id)."/".base64_encode($user1->id);
						 $url= url('/member/delete_interview')."/".base64_encode($user1->id);
						 $dow= url('/uploads/company_attachment')."/".$user1->attachment;
						 $action='<a style="color:red" href="'.$dow.'" target="_New"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a><a style="margin-left:10px;" href="'.$dow.'" download=""  title="Download" class="download-i"><i style="color: red !important;" class="fa fa-download" aria-hidden="true"></i></a><a style="margin-left:10px;" data-toggle="modal" title="Edit"  href="#update_company-'.$user1->id.'"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a style="margin-left:10px;" href="'.$url.'" onclick="return confirm("Are you sure to Delete this record?")" class="delete-i"   title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
					 }
					 
					 
				?>
				<tr>
					<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $icon ?> &nbsp;&nbsp; {{$user1->roundType}} &nbsp;&nbsp; {{$user1->pageCount}}</td>
					<td>{{$user1->fileSize}} M.B</td>
					<td>{{$user1->created_at}}
					<?php 
					if($user1->freePreview =='' && $status=='Pending'){
					?>
					<a style="margin-left:10px;" href="{{$freeViewCompany}}" onclick="return confirm('Are you sure you want make it free?')"><i class="fa fa-eye-slash" aria-hidden="true" title="Make a free preview" style="color: #17b0a4 !important;"></i></a>
					<?php 
					}else if($user1->freePreview =='Yes'){
						?>
						<i class="fa fa-eye" aria-hidden="true" title="Free Preview" style="margin-left:10px;color: #17b0a4 !important;"></i>
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
						  <!-- <input class="input-box-signup" type="text" name="company_Round-{{@$user1->id}}" id="company_Round-{{@$user1->id}}" value="{{$user1->roundType}}"> -->
						  <div class="select-number">
			                  <select name="company_Round-{{@$user1->id}}" id="company_Round-{{@$user1->id}}" required="" data-parsley-errors-container="#err_exp_level" data-parsley-required-message="This field is required" companyname="" attrid"" txtattr="" disabled="disabled">
			                    <option value="">---Select Interview Round---</option>
			                    <option value="Call / Email Schedule" {!! ($user1->roundType == 'Call / Email Schedule') ? 'Selected="Selected"' : '' !!}>Call/Email Schedule</option>
							    <option value="Written Test" {!! ($user1->roundType == 'Written Test') ? 'Selected="Selected"' : '' !!}>1st Round&nbsp;&nbsp;-&nbsp;&nbsp;(Written Test)</option>
							    <option value="Technical Round" {!! ($user1->roundType == 'Technical Round') ? 'Selected="Selected"' : '' !!}>2nd Round&nbsp;&nbsp;-&nbsp;&nbsp;(Technical Round)</option>
							    <option value="Onsite, Usa" {!! ($user1->roundType == 'Onsite, Usa') ? 'Selected="Selected"' : '' !!}>3rd Round&nbsp;&nbsp;-&nbsp;&nbsp;(Onsite, Usa)</option>
							    <option value="PM Round" {!! ($user1->roundType == 'PM Round') ? 'Selected="Selected"' : '' !!}>4rd Round&nbsp;&nbsp;-&nbsp;&nbsp;(PM Round)</option>
							    <option value="HR Round" {!! ($user1->roundType == 'HR Round') ? 'Selected="Selected"' : '' !!}>5th Round&nbsp;&nbsp;-&nbsp;&nbsp;(HR Round)</option>
			                  </select>                  
			               </div>
						  
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
<tr>
  <td colspan="5" style="background-color:#fff">
	  <div class="prod-pagination">
		{{ $results->appends(['interview_id'=>$interview_id])->render() }}
	  </div>
  </td>
</tr>