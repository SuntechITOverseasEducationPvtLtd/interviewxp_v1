<style>
    .sinterview-company_01{background-color: #fff !important;}
.sinterview-company_02{margin-bottom: -5px !important; }
.sinterview-company_03{font-family: 'ubuntumedium',sans-serif !important; font-size: 13px !important;}
.sinterview-company_04{background-color: #ecf8f7 !important; display: none !important;}
.sinterview-company_05{float:right !important;}
.sinterview-company_06{margin-left:10px !important; color:rgba(85, 85, 85, 0.82) !important;}
.sinterview-company_07{background-color: #17b0a4 !important; border: 1px solid #17b0a4 !important; color: #fff !important; padding: 5px !important; margin-left:10px !important;}
.sinterview-company_08{width:96% !important;}
.sinterview-company_09{border: 1px solid rgba(39, 9, 9, 0.28) !important; padding: 10px !important;}
.sinterview-company_010{width: 70% !important; padding: 2px !important; border-style: groove !important;}
.sinterview-company_011{width: 30% !important; float: right !important; color: #fc575c !important; text-align: right!important;}
.sinterview-company_012{display: block!important;text-align: right !important;}
.sinterview-company_013{font-size:30px !important; border: 1px solid #ccc !important; padding: 15px !important; margin-top:10px !important;}
.sinterview-company_014{clear: both !important; display: block !important; margin-left: 20px !important;}
.sinterview-company_015{border: 1px solid rgba(39, 9, 9, 0.28) !important; padding: 10px !important;}
.sinterview-company_016{width:100% !important;}
.sinterview-company_017{background-color: #eee;border:none !important;}
.sinterview-company_018{border:none !important;
 border-radius:0px !important;
 height: 41px!important;
 width: 57px; float: right !important;
 padding: 0px!important;
 width: 100px !important;
 text-align: center !important;
    padding-top: 8px !important;
    margin: 0px 6px !important;}
.sinterview-company_019{border-right: 1px solid rgb(251, 251, 251) !important; display: none !important;}
.sinterview-company_020{border: 1px solid rgba(39, 9, 9, 0.28) !important;padding: 10px !important;}
.sinterview-company_021{background-color: #eee!important; border:none !important;}

.sinterview-company_022{border: none !important;    
    padding: 0px 0px !important;
    border-radius: 0px !important;
    height: 39px !important;
    margin-left: 11px !important;
    width: 100px !important;
    float: right !important;
    padding-top: 8px !important;
    padding-bottom: 11px !important;
    text-align: center !important;}

.sinterview-company_023{margin-left:10px!important; width: 130px !important; float:right !important;}
.sinterview-company_024{border-right: 1px solid rgb(251, 251, 251) ! important; display: none !important;}
.sinterview-company_025{width:96%; margin:0px auto !important; border: 1px solid rgba(39, 9, 9, 0.28) !important; height: 43px !important; padding: 10px!important;}
.sinterview-company_026{background-color: #17b0a4!important; border: 1px solid #17b0a4!important;  color: #fff !important; padding: 5px!important; float: right!important; 
margin-top: -6px !important;}
.sinterview-company_027{margin-left:10px !important;}
.sinterview-company_028{color:rgba(85, 85, 85, 0.82) !important}
.sinterview-company_029{margin-left:10px !important; color: #17b0a4 !important;}
.sinterview-company_030{margin-left:10px !important; float:right !important; width:130px !important; padding-left: 21px !important;}
.sinterview-company_031{clear: both; display: block !important;}
.sinterview-company_032{display: block !important;}
.sinterview-company_033{left:0 !important;}
.sinterview-company_034{visibility:hidden!important; height: 0 !important;}
.sinterview-company_035{display:none !important;}
.sinterview-company_036{padding-right: 0px !important;}
.sinterview-company_037{color:red !important;}
.sinterview-company_038{color: #17b0a4 !important;}
.sinterview-company_039{width: 19% !important;}
.sinterview-company_040{color:green !important;}
.sinterview-company_041{width: 42% !important;}
</style>


<tr class="sinterview-company_01">
	<td colspan="5"><p class="sinterview-company_02 show-results">Showing {{($results->currentpage()-1)*$results->perpage()+1}} to {{($results->currentpage()-1) * $results->perpage() + $results->count()}}
of  {{$results->total()}} results</p>
	<input type="hidden" id="tot_interviewqa_topics-{{$interview_id}}" name="tot_interviewqa_topics" value="{{$results->total()+1}}">
																
	</td>
</tr> 
<tr class="top-strip-table">
   <td class="sinterview-company_03">Company Name</td>
   <td class="sinterview-company_03">File Name</td>
   <td class="sinterview-company_03">Date &amp; Time Uploaded</td>
   <td class="sinterview-company_03">Status</td>
   <td class="sinterview-company_03 text-center">Action</td>  
</tr>
<tr class="top-strip-table CompanyTextAppendRow sinterview-company_04" >
	<td colspan="5">{{$results->total()+1}} .<span class="CompanyTextAppend"></span><span class="LocationTextAppend"></span>
   	<span class="sinterview-company_05"><span class="CompanyTextEdit sinterview-company_06" ><i class="fa fa-pencil"></i></span>
	<a class="sinterview-company_06" href="#" onclick="return confirm('Are you sure to Delete this record?')"><i class="fa fa-trash-o"></i></a> 
	<span class="addNewRound sinterview-company_07" attrId="{{$interview_id}}" companyName="" companySource="" txtattr=""><i class="fa fa fa-plus"></i> Add Round</span></span></td>
</tr>
<tr class="sinterview-company_035 callRounds " id="callRounds{{$interview_id}}">
	<td colspan="5">
		<div class="form-group">
			  <div class="callEmail sinterview-company_08" >
				  <div class="col-sm-12 col-md-8 col-lg-8">
				  
				    <div class="select-number">
	                  <select name="addRounds" class="addRounds" required="" data-parsley-errors-container="#err_exp_level" data-parsley-required-message="This field is required" companyname="" attrid"" txtattr="">
	                    <option value="">---Select Interview Round---</option>
	                    <option value="Call / Email Schedule, Written Test, Technical Round, PM Round, HR Round...etc">Call / Email Schedule, Written Test, Technical Round, PM Round, HR Round...etc</option>
	                    <!--<option value="Call / Email Schedule">Call/Email Schedule</option>
					    <option value="Written Test">1st Round&nbsp;&nbsp;-&nbsp;&nbsp;(Written Test)</option>
					    <option value="Technical Round">2nd Round&nbsp;&nbsp;-&nbsp;&nbsp;(Technical Round)</option>
					    <option value="Onsite, Usa">3rd Round&nbsp;&nbsp;-&nbsp;&nbsp;(Onsite, Usa)</option>
					    <option value="PM Round">4rd Round&nbsp;&nbsp;-&nbsp;&nbsp;(PM Round)</option>
					    <option value="HR Round">5th Round&nbsp;&nbsp;-&nbsp;&nbsp;(HR Round)</option>-->
	                  </select>                  
	               </div>
				 </div>
				 <!--  <div class="col-sm-12 col-md-4 col-lg-4" style="padding-right: 0px;">
					  <span class="addCallEmail" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;float: right;margin-top: -6px;"><i class="fa fa fa-plus"></i> Add Content</span>
				  </div> -->
			  </div>
			  <br/>
			  <div class="col-sm-12 col-md-12 col-lg-12 CallIcon sinterview-company_09" >
				<div><span class="titleTxt sinterview-company_010" contenteditable="true">Call/Email Schedule</span><span class="closeschedules sinterview-company_011" attrid="{{@$interview_id}}">close</span></div>
				<div class="col-sm-1 col-md-1 col-lg-1"></div>
				<div class="col-sm-4 col-md-4 col-lg-4 videoIconCall sinterview-company_012" companyname="" attrid"" txtattr=""><i class="fa fa-play sinterview-company_013" ></i><span class="sinterview-company_030">Video (MP4)</span></div>
				<div class="col-sm-1 col-md-1 col-lg-1"></div>
				<div class="col-sm-4 col-md-4 col-lg-4 pdfIconCall sinterview-company_032" companyname="" attrid"" txtattr=""><i class="fa fa-file-pdf-o sinterview-company_013"></i><span class="sinterview-company_014" >Pdf</span></div>
				<div class="clearfix"></div>
			  </div>
			  <div class="clearfix"></div><br/>
			  <div class="form-group callEmailPdf">
				 <div class="col-sm-12 col-md-12 col-lg-12 sinterview-company_015" >
					  <p class="titleTxt">Call/Email Schedule</p>
					  <div class="input-group sinterview-company_016" >
						  <div class="btn btn-primary sinterview-company_017">
							<input id="company_file-{{@$interview_id}}" accept="application/pdf" class="company_fileCallPdf-{{@$interview_id}} company_fileCallPdf" name="company_file" type="file">
						  </div>
						  <a href="javascript:;" class="cancelCallEmailPdfBtn cancel-btn sinterview-company_018" attrId="{{$interview_id}}" >Cancel</a>
							<button type="button" id="create_company" onclick="javascript: return companyupload({{@$interview_id}}, $(this).attr('companyname'), $(this).attr('txtattr'), $(this).attr('company_source'));" class="submit-btn ctn sinterview-company_030" 	companyname="" attrid"" txtattr="">Upload</button>
						  
						  <div class="btn btn-primary btn-file remove sinterview-company_018"  id="btn_remove_company_file-{{@$interview_id}}">
						  <a class="file" onclick="removecompanyfile({{@$interview_id}})"><i class="fa fa-trash"></i>
						  </a>
						  </div>
						  <input class="form-control file-caption  kv-fileinput-caption" id="company_file_name-{{@$interview_id}}" disabled="disabled" type="text">
						  <h5 class="upload">Support Formats: PDF, Max File 5 MB</h5>
						  <div id="company_create_error_attachment-{{@$interview_id}}" class="error sinterview-company_033" ></div>
						  <div id="create_error_msg-{{@$interview_id}}" class="error sinterview-company_033" ></div>
					  </div>
				  </div>
			  </div>
			  <div class="clearfix"></div><br/>
			  <div class="form-group callEmailVideo">
			  <p class="titleTxt">Call/Email Schedule</p>
				 <div class="col-sm-12 col-md-12 col-lg-12 sinterview-company_020">
					  <input id="company_file-{{@$interview_id}}"  class="sinterview-company_034" name="company_file" type="file">
					  <div class="input-group sinterview-company_016">
						  <div class="btn btn-primary sinterview-company_021">
							<input id="company_file-{{@$interview_id}}" onchange="setFileInfoCall(this.files)" accept="video/mp4"
							class="company_fileCallVideo-{{@$interview_id}} company_fileCallVideo"  name="company_file" type="file">
						  </div>
						  <input type="hidden" name="durationVideoCall" id="durationVideoCall">
						 
						  <a href="javascript:;" class="cancelCallEmailVideoBtn cancel-btn sinterview-company_022" attrId="{{$interview_id}}">Cancel</a>
						  <button type="button" id="create_company" onclick="javascript: return companyupload({{@$interview_id}});" class="submit-btn ctn sinterview-company_023">Upload</button>
						  
						  <div class="btn btn-primary btn-file remove sinterview-company_024" id="btn_remove_company_file-{{@$interview_id}}">
						  <a class="file" onclick="removecompanyfile({{@$interview_id}})"><i class="fa fa-trash"></i>
						  </a>
						  </div>
						  <input class="form-control file-caption  kv-fileinput-caption" id="company_file_name-{{@$interview_id}}" disabled="disabled" type="text">
						  <h5 class="upload">Support Formats: MP4, Max File 300 MB</h5>
						  <h5 class="upload">Tip: video is InterviewXp's preferred delivery type wide screen 16:9 ratio is preferred. Please note that the average video length is within 5-10 minutes. Content should be with high resolution video 720p (1280x720)</h5>
						  <div id="company_create_error_attachment-{{@$interview_id}}" class="error sinterview-company_033" ></div>
						  <div id="create_error_msg-{{@$interview_id}}" class="error sinterview-company_033"></div>
					  </div>
				  </div>
			  </div>
		  </div>
	</td>
</tr>
<tr class="TechnicalRoundtr sinterview-company_035">
	<td colspan="5">
		<div class="form-group">
			<div class="TechnicalRound sinterview-company_025">
			  <div class="col-sm-12 col-md-8 col-lg-8"><label>Technical Round</label></div>
			  <div class="col-sm-12 col-md-4 col-lg-4 sinterview-company_036">
				  <span class="addTechRound sinterview-company_026" ><i class="fa fa fa-plus"></i> Add Content</span>
			  </div>
		  </div>
	  </div>
	</td>
</tr>
<tr class="PMRoundtr sinterview-company_035" >
	<td colspan="5">
		<div class="form-group">
		  <div class="PMRound sinterview-company_025" >
			  <div class="col-sm-12 col-md-8 col-lg-8"><label>PM Round</label></div>
			  <div class="col-sm-12 col-md-4 col-lg-4 sinterview-company_036" >
				  <span class="addPmRound sinterview-company_026" ><i class="fa fa fa-plus"></i> Add Content</span>
			  </div>
		  </div>
	  </div>
	</td>
</tr>	
<tr class="HRRoundtr sinterview-company_035">
	<td colspan="5">
		<div class="form-group">
		  <div class="HRRound sinterview-company_025">
			  <div class="col-sm-12 col-md-8 col-lg-8"><label>HR Round</label></div>
			  <div class="col-sm-12 col-md-4 col-lg-4 sinterview-company_036" >
				  <span class="addHrRound sinterview-company_026"><i class="fa fa fa-plus"></i> Add Content</span>
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
		$NameC=isset($NameCompany->company_name) ? $NameCompany->company_name : '';

		?>
		<tr class="asgreen">
			<td colspan="5">{{($results->currentpage()-1)*$results->perpage()+1+$key}} . {{$NameC}} ({{$user->company_location}}) 

			@if($user->approve_status==0)
			<span class="sinterview-company_05"><span class="sinterview-company_06"><i class="fa fa-pencil"></i></span>
			<a class="sinterview-company_06" href="{{$delete}}" onclick="return confirm('Are you sure to Delete this record?')"><i class="fa fa-trash-o"></i></a> 
			@endif
			<?php /*<span class="{{$typeofRound}}" attrId="{{$interview_id}}" companyName="{{@$NameC}}" txtattr="{{$user->company_location}}" style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;margin-left:10px;float: right;"><i class="fa fa fa-plus"></i> Add Round</span>
			*/ ?>
			</span></td>
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
						 $action='<a class="sinterview-company_028" href="'.$dow.'" target="_New"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a><a  href="'.$dow.'" download=""   title="Download" class="download-i sinterview-company_027"><i class="fa fa-download sinterview-company_028" aria-hidden="true"></i></a><a class="sinterview-company_06" title="Edit" ><i class="fa fa-pencil" aria-hidden="true"></i></a> <a class="delete-i sinterview-company_06"   title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
					 }
						 
					 else{
						 $status="Pending";
						 $freeViewCompany= url('/member/freePreviewCompany')."/".base64_encode($user1->user_id)."/".base64_encode($user1->id);
						 $url= url('/member/delete_interview')."/".base64_encode($user1->id);
						 $dow= url('/uploads/company_attachment')."/".$user1->attachment;
						 $action='<a class="sinterview-company_037" href="'.$dow.'" target="_New"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a><a href="'.$dow.'" download=""  title="Download" class="download-i sinterview-company_027"><i class="fa fa-download sinterview-company_037" aria-hidden="true"></i></a><a class="sinterview-company_027" data-toggle="modal" title="Edit"  href="#update_company-'.$user1->id.'"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="'.$url.'" onclick="return confirm("Are you sure to Delete this record?")" class="delete-i sinterview-company_027" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
					 }
					
				?>
				<tr class="aswhite">
					<td class="sinterview-company_041"><?php echo $icon ?> &nbsp;&nbsp; {{$user1->roundType}} &nbsp;&nbsp; {{$user1->pageCount}}</td>
					<td>{{$user1->fileSize}} M.B</td>
					<td>{{date('j M, Y, g:i A T',strtotime($user1->created_at))}}
					<?php 
					if($user1->freePreview =='' && $status=='Pending'){
					?>
					<a class="sinterview-company_027" href="{{$freeViewCompany}}" onclick="return confirm('Are you sure you want make it free?')"><i class="fa fa-eye-slash sinterview-company_038" aria-hidden="true" title="Make a free preview" ></i></a>
					<?php 
					}else if($user1->freePreview =='Yes'){
						?>
						<i class="fa fa-eye sinterview-company_029" aria-hidden="true" title="Free Preview" ></i>
						<?php
					}
					?>
					</td>
					<td><?php echo $status;?></td>
					<td class="sinterview-company_039"><?php echo $action;?>
						@if($user1->admin_comments) 
						&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comments sinterview-company_040" title="{{$user1->admin_comments}}" ></i>
						@endif
					</td>					
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
						   <div id="success_update_company-{{$user1->id}}" class="sinterview-company_040"></div>
						   {{ csrf_field() }}
						   <!--upload resume section-->
						   <div class="sinterview-company_040" id='success_msg-{{$user1->id}}'>
						</div>
						<div class="form-group">
						  <div class="row">
						  <div class="col-sm-12 col-md-4 col-lg-4 sinterview-company_037"><label>Company<span class="star">*</span></label> 
						  </div>
						  <div class="col-sm-12 col-md-8 col-lg-8">
						  <input class="input-box-signup" type="text" readonly="" name="company_id" value="{{$NameC}}">
						  
						  </div>
						  </div>
						</div>
						<div class="form-group">
						   <div class="row">
							  <div class="col-sm-12 col-md-4 col-lg-4"><label>Location<span class="star sinterview-company_037" >*</span></label> 
							  </div>
							  <div class="col-sm-12 col-md-8 col-lg-8">
								 <input class="input-box-signup" readonly="" type="text" value="{{@$user1->company_location}}" name="company_location">
								 <div id="update_error_location-{{@$user1->id}}" class="error"></div>
							  </div>
						   </div>
						</div>
						<div class="form-group">
						  <div class="row">
						  <div class="col-sm-12 col-md-4 col-lg-4"><label>Round Name<span class="star sinterview-company_037" >*</span></label> 
						  </div>
						  <div class="col-sm-12 col-md-8 col-lg-8">
						  <!-- <input class="input-box-signup" type="text" name="company_Round-{{@$user1->id}}" id="company_Round-{{@$user1->id}}" value="{{$user1->roundType}}"> -->
						  <input class="input-box-signup" type="text" value="{{@$user1->roundType}}" name="company_Round-{{@$user1->id}}" id="company_Round-{{@$user1->id}}">
						  <!--<div class="select-number">
			                  <select name="company_Round-{{@$user1->id}}" id="company_Round-{{@$user1->id}}" required="" data-parsley-errors-container="#err_exp_level" data-parsley-required-message="This field is required" companyname="" attrid"" txtattr="" disabled="disabled">
			                    <option value="">---Select Interview Round---</option>
			                    <option value="Call / Email Schedule" {!! ($user1->roundType == 'Call / Email Schedule') ? 'Selected="Selected"' : '' !!}>Call/Email Schedule</option>
							    <option value="Written Test" {!! ($user1->roundType == 'Written Test') ? 'Selected="Selected"' : '' !!}>1st Round&nbsp;&nbsp;-&nbsp;&nbsp;(Written Test)</option>
							    <option value="Technical Round" {!! ($user1->roundType == 'Technical Round') ? 'Selected="Selected"' : '' !!}>2nd Round&nbsp;&nbsp;-&nbsp;&nbsp;(Technical Round)</option>
							    <option value="Onsite, Usa" {!! ($user1->roundType == 'Onsite, Usa') ? 'Selected="Selected"' : '' !!}>3rd Round&nbsp;&nbsp;-&nbsp;&nbsp;(Onsite, Usa)</option>
							    <option value="PM Round" {!! ($user1->roundType == 'PM Round') ? 'Selected="Selected"' : '' !!}>4rd Round&nbsp;&nbsp;-&nbsp;&nbsp;(PM Round)</option>
							    <option value="HR Round" {!! ($user1->roundType == 'HR Round') ? 'Selected="Selected"' : '' !!}>5th Round&nbsp;&nbsp;-&nbsp;&nbsp;(HR Round)</option>
			                  </select>                  
			               </div>-->
						  
						  </div>
						  </div>
						</div>
						<div class="form-group">
						   <div class="row">
						  <div class="col-sm-12 col-md-4 col-lg-4">
						   <label>Uploads<span class="star sinterview-company_037">*</span></label>
							   </div>
							<div class="col-sm-12 col-md-8 col-lg-8">
								 <input id="update_company_file-{{@$user1->id}}" class="sinterview-company_034" accept="video/mp4,application/pdf" name="company_file" type="file">
								 <div class="input-group ">
									<div class="btn btn-primary btn-file btn-gry">
									   <a class="file" onclick="update_browsecompanyfile({{@$user1->id}})">Choose File
									   </a>
									</div>
									<div class="btn btn-primary btn-file remove sinterview-company_019" id="update_btn_remove_company_file-{{@$user1->id}}">
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
						<button type="button" id="update_company" onclick="javascript: return update_companyupload({{@$user1->id}});" class="submit-btn ctn">Update Company</button>
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
  <td colspan="5" class="sinterview-company_01">
	  <div class="prod-pagination">
		{{ $results->appends(['interview_id'=>$interview_id])->render() }}
	  </div>
  </td>
</tr>