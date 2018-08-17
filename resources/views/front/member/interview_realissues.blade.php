<style>
    .sinterview_qa_01{background-color: #fff !important;}
.sinterview_qa_02{margin-bottom: -5px !important;}
.sinterview_qa_03{font-family: 'ubuntumedium',sans-serif !important; font-size: 13px !important;}
.sinterview_qa_017{float:right !important;}
.sinterview_qa_018{margin-left:10px !important; color:rgba(85, 85, 85, 0.82) !important;}
.sinterview_qa_019{margin-left: 10px !important;}
.sinterview_qa_021{color:rgba(85, 85, 85, 0.82) !important;}
.sinterview_qa_022{color: red !important;}
.sinterview_qa_023{color: #17b0a4 !important;}
.sinterview_qa_024{color: green !important;}
.sinterview_qa_025{visibility:hidden!important; height: 0 !important;}
</style>


<tr class="sinterview_qa_01">
	<td colspan="5"><p class="sinterview_qa_02" class="show-results">Showing {{($results->currentpage()-1)*$results->perpage()+1}} to {{($results->currentpage()-1) * $results->perpage() + $results->count()}}
of  {{$results->total()}} results</p>
	<input type="hidden" id="tot_interviewqa_topics-{{$interview_id}}" name="tot_interviewqa_topics" value="{{$results->total()+1}}">
																
	</td>
</tr>   
<tr class="top-strip-table">
<td class="sinterview_qa_03">Tickets, Tasks, Etc.,</td>
<td class="sinterview_qa_03">File Size</td>
<td class="sinterview_qa_03">Date & Time Uploaded</td>
<td class="sinterview_qa_03">Status</td>
<td class="sinterview_qa_03 text-center" >Action</td>
</tr>
													   
<?php	
$i=1;
foreach ($results as $key=>$user) {
	$i++;
	$delete="/member/delete_realtime_all/".base64_encode($user->user_id)."/".base64_encode($user->issue_title);
	$string = ucwords(strtolower(mb_strimwidth($user->issue_title, 0, 95, '...')));
	?>
	<tr class="asgreen">
		<td colspan="5" title="{{$user->issue_title}}">{{($results->currentpage()-1)*$results->perpage()+1+$key}} . {{$string}} 
		<span class="sinterview_qa_017" ><!--<span style="margin-left:10px;color:rgba(85, 85, 85, 0.82)"><i class="fa fa-pencil"></i></span>-->
		<?php if($user->approve_status == 0) { ?>
		<a class="sinterview_qa_018" href="{{$delete}}" onclick="return confirm('Are you sure to Delete this record?')"  title="Delete"><i class="fa fa-trash-o"></i></span></a> 
		<?php } ?>
		</td>
	 </tr>
		<?php
			   $results1 = DB::select( DB::raw("SELECT * FROM member_real_time_experience WHERE interview_id = '".$interview_id."' AND issue_title = '".$user->issue_title."'") );
				foreach ($results1 as $key1=>$user1) {
					 if($user1->file_extension =='Pdf'){
						 $icon='<i class="fa fa-file-pdf-o"></i>';
					 }else if($user1->file_extension =='Video'){
						 $icon='<i class="fa fa-play"></i>';
					 }else{
						 $icon="";
					 }
					 $viewicon=url('/')."/images/viewicon.png";
					 if($user1->approve_status==1){
						 $status="Approved";
						 $freeViewReal="";
						 $dow="/uploads/real_time_attachment/".$user1->attachment;
						 $action='<a class="sinterview_qa_021"  href="'.$dow.'" target="_New"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a><a href="'.$dow.'" download="" class="download-i sinterview_qa_019"><i class="fa fa-download sinterview_qa_021" aria-hidden="true"></i></a><a class="sinterview_qa_018" ><i class="fa fa-pencil" aria-hidden="true"></i></a> <a class="sinterview_qa_018" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
					 }
						 
					 else{
						 $status="Pending";
						 $freeViewReal="/member/freePreviewReal/".base64_encode($user1->user_id)."/".base64_encode($user1->id);
						 $url="/member/delete_realtime/".base64_encode($user->user_id)."/".base64_encode($user->id);
						 $dow="/uploads/real_time_attachment/".$user1->attachment;
						 $action='<a class="sinterview_qa_022"  href="'.$dow.'" target="_New"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a><a href="'.$dow.'" download="" class="download-i sinterview_qa_019"><i  class="fa fa-download sinterview_qa_022" aria-hidden="true" title="Download"></i></a><a class="sinterview_qa_019" data-toggle="modal"  href="#real-time-update-'.$user1->id.'"   title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="'.$url.'" onclick="return confirm("Are you sure to Delete this record?")" class="delete-i sinterview_qa_019"><i class="fa fa-trash-o" aria-hidden="true" title="Delete"></i></a>';
					 }
					 
				?>
				<tr class="aswhite">
					<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $icon ?> &nbsp;&nbsp; {{$user1->pageCount}} </td><td>{{$user1->fileSize}} M.B</td>
					<td>{{ date('j M, Y, g:i A T',strtotime($user1->created_at))}}
					<?php 
					if($user->freePreview =='' && $status=='Pending'){
					?>
					<a class="sinterview_qa_019" href="{{$freeViewReal}}" onclick="return confirm('Are you sure you want make it free?')"><i class="fa fa-eye-slash sinterview_qa_023" aria-hidden="true" title="Make a free preview"></i></a>
					<?php 
					}else{
					?>
						<i class="fa fa-eye sinterview_qa_019 sinterview_qa_023" aria-hidden="true" title="Free Preview" ></i>
					<?php
					}
					?>
					</td>
					<td><?php echo $status;?></td>
					<td class="sinterview_qa_017"><?php echo $action;?>
						@if($user1->admin_comments) 
						&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comments sinterview_qa_024" title="{{$user1->admin_comments}}" ></i>
						@endif
					</td>
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
					   <div class="sinterview_qa_024"  id="success_update_realtime_msg-{{$user1->id}}"></div>
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
					   <input id="realtime-{{$user1->id}}" class="sinterview_qa_025" accept="application/pdf" name="file" type="file">
					   <div class="input-group ">
					   <div class="btn btn-primary btn-file btn-gry">
					   <a class="file" onclick="real_time_file({{$user1->id}})">Choose File
					   </a>
					   </div>
					   <div class="btn btn-primary btn-file remove sinterview_qa_025" id="btn_remove_image">
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
<tr>
  <td colspan="5" class="sinterview_qa_01">
	  <div class="prod-pagination">
		{{ $results->appends(['interview_id'=>$interview_id])->render() }}
	  </div>
  </td>
</tr>