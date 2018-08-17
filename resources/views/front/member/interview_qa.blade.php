<style>
    .sinterview_qa_01{background-color: #fff !important;}
.sinterview_qa_02{margin-bottom: -5px !important;}
.sinterview_qa_03{font-family: 'ubuntumedium',sans-serif !important; font-size: 13px !important;}
.sinterview_qa_04{height:22px !important;}
.sinterview_qa_05{background-color:#fff !important; display: none !important;}
.sinterview_qa_06{border:1px solid #ccc !important; padding:5px !important;}
.sinterview_qa_07{font-size:30px; border: 1px solid #ccc !important; padding: 15px !important; margin-top:10px !important;}
.sinterview_qa_08{clear: both;display: block !important;}
.sinterview_qa_09{clear: both!important; display: block !important; margin-left: 20px !important;}
.sinterview_qa_010{border: 1px solid #ccc !important; padding:15px !important;}
.sinterview_qa_011{background-color: #eee !important; border:none !important;}
.sinterview_qa_012{padding: 8px !important; height: 40px !important; float:right!important; margin-top: 0px !important; text-align:center !important; width:125px !important; margin-left: 10px !important; border:none !important;}
.sinterview_qa_013{float:right;width:130px !important;}
.sinterview_qa_014{border-right: 1px solid rgb(251, 251, 251) !important; display: none !important;}
.sinterview_qa_015{height: 38px !important;}
.sinterview_qa_016{left:0 !important;}
.sinterview_qa_017{float:right !important;}
.sinterview_qa_018{margin-left:10px !important; color:rgba(85, 85, 85, 0.82) !important;}
.sinterview_qa_019{margin-left: 10px !important;}
.sinterview_qa_021{color:rgba(85, 85, 85, 0.82) !important;}
.sinterview_qa_020{background-color: #17b0a4 !important; border: 1px solid #17b0a4 !important; color: #fff !important; padding: 5px !important; margin-left:10px !important;}
.sinterview_qa_022{color: red !important;}
.sinterview_qa_023{color: #17b0a4 !important;}
.sinterview_qa_024{color: green !important;}
.sinterview_qa_025{visibility:hidden!important; height: 0 !important;}
.sinterview_qa_026{border-right: 1px solid rgb(251, 251, 251) ! important; display: none ! important;}
</style>	


	<tr class="sinterview_qa_01">
		<td colspan="5"><p class="show-results sinterview_qa_02">Showing {{($reference_book_details->currentpage()-1)*$reference_book_details->perpage()+1}} to {{($reference_book_details->currentpage()-1) * $reference_book_details->perpage() + $reference_book_details->count()}}
    of  {{$reference_book_details->total()}} results</p>
		<input type="hidden" id="tot_interviewqa_topics-{{$interview_id}}" name="tot_interviewqa_topics" value="{{$reference_book_details->total()+1}}">
																	
		</td>
	</tr>
	
	  
		<tr class="t-head">
		  <td class="sinterview_qa_03">Topic Name</td>
		  <td class="sinterview_qa_03">File Size</td>
		  <td class="sinterview_qa_03">Date & Time</td>
		  <td class="sinterview_qa_03">Status</td>
		  <td class="text-center sinterview_qa_03">Action</td>
	   </tr>
	 
	   <tr id="addbook-row{{@$interview_id}}" class="sinterview_qa_05">
			<td class="" colspan="5">
				<div class="addbook sinterview_qa_04">
			   <div class="row">
			   </div>
			   {{ csrf_field() }}
			   
			   <input type="hidden" class="interviewid"  id="unique_id" value="{{@$interview_id}}">
			   <input type="hidden" id="skill_id_reference-{{@$interview_id}}" value="{{@$uploads['skill_id']}}">
			   <input type="hidden" id="experience_level_reference-{{@$interview_id}}" value="{{@$uploads['experience_level']}}">
			   <div style="color:green;" id="reference_success_msg-{{@$interview_id}}">
			</div>																	
			
			<div style="clear:both;"></div>
			<div class="form-group videoPdfIcon sinterview_qa_06">
			  <div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4 part-text">New Part</div>
				<div class="col-sm-12 col-md-8 col-lg-8">
					<div class="col-sm-12 col-md-4 col-lg-4 videoIcon"><i class="fa fa-play sinterview_qa_07"></i><span class="sinterview_qa_08" >Video (MP4)</span></div>
					<div class="col-sm-12 col-md-4 col-lg-4 pdfIcon"><i class="fa fa-file-pdf-o sinterview_qa_07" ></i><span class="sinterview_qa_09">Pdf</span></div>
					<div style="clear:both;"></div>
				</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group">
			   <div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="videoclass sinterview_qa_010" style="">
						<!--<input id="reference_book-{{@$interview_id}}"  style="visibility:hidden; height: 0;" name="reference_book" type="file">-->
						 <div class="input-group col-sm-12 col-md-12 col-lg-12">
							<div class="btn btn-primary btn-gry col-sm-6 col-md-6 col-lg-6 sinterview_qa_011" >
							   <!--<a class="file" onclick="browseReferenceBook({{@$interview_id}})">Choose File
							   </a>-->
							   <input id="reference_book-{{@$interview_id}}" accept="video/mp4" class="reference_bookVideo-{{@$interview_id}} reference_bookVideo" onchange="setFileInfo(this.files)" name="reference_book" type="file">
							</div>
							<input type="hidden" name="durationVideo" id="durationVideo">
							<div class="col-sm-6 col-md-6 col-lg-6">
								
								<div class="cancel-btn cancelFinalBtn sinterview_qa_012">Cancel</div>
								<button  type="button" id="update_reference_book" onclick="javascript: return refbookupload({{@$interview_id}});" class="sinterview_qa_013 submit-btn ctn bookbtn">Upload</button>
							</div>
							<div class="btn btn-primary btn-file remove sinterview_qa_014"  id="btn_remove_reference_book-{{@$interview_id}}">
							   <a class="file" onclick="removeReferenceBook({{@$interview_id}})"><i class="fa fa-trash"></i>
							   </a>
							</div>
							<input class="form-control file-caption  kv-fileinput-caption sinterview_qa_015" id="reference_book_name-{{@$interview_id}}" disabled="disabled" type="text">
							<h5 class="upload">Support Formats: MP4, Max File 300 MB</h5>
							<h5 class="upload">Tip: video is InterviewXp's preferred delivery type wide screen 16:9 ratio is preferred. Please note that the average video length is within 5-10 minutes. Content should be with high resolution video 720p (1280x720)</h5>
							<div id="error_msg-{{@$interview_id}}" class="error"></div>
							<div id="create_error_attachment-{{@$interview_id}}" class="error sinterview_qa_016" ></div>
						 </div>
					</div>
					<div class="pdfclass sinterview_qa_010" >
						<!--<input id="reference_book-{{@$interview_id}}"  style="visibility:hidden; height: 0;" name="reference_book" type="file">-->
						 <div class="input-group  col-sm-12 col-md-12 col-lg-12">
							
							<div class="col-sm-6 col-md-6 col-lg-6 btn btn-primary  btn-gry sinterview_qa_011">
							   <!--<a class="file" onclick="browseReferenceBook({{@$interview_id}})">Choose File
							   </a>-->
							   <input id="reference_book-{{@$interview_id}}" class="reference_bookPdf-{{@$interview_id}} reference_bookPdf" accept="application/pdf" name="reference_book" type="file">
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
							    
							    <div class="cancelFinalBtn cancel-btn sinterview_qa_012" >Cancel</div>								
							    
							    
								<button  type="button" id="update_reference_book" onclick="javascript: return refbookupload({{@$interview_id}});" style="margin-right:10px;width:125px; padding: 8px 0px;
    height: 40px; float:right"  class="submit-btn ctn bookbtn">Upload</button>
								
							</div>
							<div class="btn btn-primary btn-file remove sinterview_qa_014"  id="btn_remove_reference_book-{{@$interview_id}}">
							   <a class="file" onclick="removeReferenceBook({{@$interview_id}})"><i class="fa fa-trash"></i>
							   </a>
							</div>
							<input class="form-control file-caption  kv-fileinput-caption sinterview_qa_015" id="reference_book_name-{{@$interview_id}}" disabled="disabled" type="text">
							<h5 class="upload">Support Formats: PDF, Max File 2 MB</h5>
							<div id="error_msg-{{@$interview_id}}" class="error"></div>
							<div id="create_error_attachment-{{@interview_id}}" class="error sinterview_qa_016"></div>
						 </div>
					</div>
				</div>
				
			   </div>
				  <div class="clearfix"></div>
			   </div>

			</div>
			</td>
	   </tr>

	   <?php
	   //$results = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$interview_id."' group by topic_name ORDER BY `multi_reference_book`.`id` DESC") );
		
		foreach ($reference_book_details as $key=>$user) {
			
			$delete="/member/delete_reference_book_all/".base64_encode($user->topic_name);
			$string = ucwords(strtolower(mb_strimwidth($user->topic_name, 0, 95, '...')));
			$results1 = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$user->interview_id."' AND topic_name = '".$user->topic_name."' ORDER BY `multi_reference_book`.`id` DESC") );			
			?>
			<tr class="asgreen">
				<td colspan="5" title="{{$string}}">{{($reference_book_details->currentpage()-1)*$reference_book_details->perpage()+1+$key}} . {{$string}} 
				<span class="sinterview_qa_017"><span class="sinterview_qa_018"><i class="fa fa-pencil"></i></span>
				@if($user->approve_status == 0)
				<a  class="sinterview_qa_018" href="{{$delete}}" onclick="return confirm('Are you sure to Delete this record?')"><i class="fa fa-trash-o"></i></a>
				@else
				<span class="sinterview_qa_019"><i class="fa fa-trash-o"></i></span>	
				@endif
				<span class="showPDFExcelAdd sinterview_qa_020" attrPartsCount="{{@count($results1)}}" attrId="{{$user->interview_id}}" skillId="" txtattr="{{$user->topic_name}}" ><i class="fa fa fa-plus"></i> Add Part</span></span></td>
			 </tr>
				<?php
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
								 $freeView="";
								 $url="/member/delete_reference_book/".base64_encode($user->id);
								 $dow="/uploads/refrence_book/".$user->mul_reference_book;
								 $action='<a  class="sinterview_qa_021" href="'.$dow.'" target="_New"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a><a class="sinterview_qa_019" href="'.$dow.'"  title="Download" download="" class="download-i"><i class="fa fa-download sinterview_qa_021" aria-hidden="true"></i></a><a class="sinterview_qa_018 editInterview "><i class="fa fa-pencil"  title="Edit" aria-hidden="true"></i></a> <a title="Delete" class="delete-i sinterview_qa_018"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
							 }
								 
							 else{
								 $status="Pending";
								 $freeView=url('/member/freePreview/').'/'.base64_encode($user1->id);
								 $url="/member/delete_reference_book/".base64_encode($user->id);
								 $dow="/uploads/refrence_book/".$user->mul_reference_book;
								 $action='<a class="sinterview_qa_022" href="'.$dow.'" target="_New"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a><a href="'.$dow.'"  title="Download" download="" class="download-i sinterview_qa_019"><i class="fa fa-download sinterview_qa_022" aria-hidden="true"></i></a><a class="sinterview_qa_018" title="Edit" data-toggle="modal" href="#ref-book-'.$user->id.'"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="'.$url.'" onclick="return confirm("Are you sure to Delete this record?")"  title="Delete" class="delete-i sinterview_qa_019"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
							 }
							 
							 
						?>
						<tr class="aswhite">
							<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $icon ?> &nbsp;&nbsp; Part {{$key1+1}} &nbsp;&nbsp; {{$user1->pageCount}} </td><td>{{$user1->fileSize}} M.B</td>
							<td>{{date('j M, Y, g:i A T',strtotime($user1->created_at))}} 
							<?php 
							if($user1->freePreview ==''&& $status=='Pending'){
							?>
							<a class="sinterview_qa_019" href="{{$freeView}}" onclick="return confirm('Are you sure you want make it free?')"> <i class="fa fa-eye-slash sinterview_qa_023" aria-hidden="true" title="Make a free preview"></i></a>
							<?php 
							}else{
								?>
								&nbsp;&nbsp;&nbsp;<i class="fa fa-eye sinterview_qa_023" aria-hidden="true" title="Free Preview" ></i>
								<?php
							}
							?>
							</td>
							<td><?php echo $status;?></td>
							<td><?php echo $action;?>
									@if($user1->admin_comments) 
									&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comments sinterview_qa_024" title="{{$user1->admin_comments}}"></i>
									@endif
							</td>
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
								   <div class="sinterview_qa_024" id='reference_success_msg-{{@$user1->id}}'>
								</div>
								<div class="form-group">
											   <div class="row">
												  <div class="col-sm-12 col-md-4 col-lg-4"><label>Topic Name<span class="error sinterview_qa_022" >*</span></label> 
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
													  <label>Uploads <span class="error sinterview_qa_022" >*</span></label></div>
									<div class="col-sm-12 col-md-8 col-lg-8">
									 <input id="updatereference_book-{{@$user1->id}}" class="sinterview_qa_025" name="updatereference_book" type="file">
										 <div class="input-group ">
											<div class="btn btn-primary btn-file btn-gry">
											   <a class="file" onclick="updatebrowseReferenceBook({{@$user1->id}})">Choose File
											   </a>
											</div>
											<div class="btn btn-primary btn-file remove sinterview_qa_026" id="updatebtn_remove_reference_book-{{@$user1->id}}">
											   <a class="file" onclick="updateremoveReferenceBook({{@$user1->id}})"><i class="fa fa-trash"></i>
											   </a>
											</div>
											<input class="form-control file-caption  kv-fileinput-caption sinterview_qa_015" id="updatereference_book_name-{{@$user1->id}}" disabled="disabled" type="text" >

										   
											
											<h5 class="upload">Support Formats: PDF, Max File 500 KB</h5>
											<div id="error_msg-{{@$user1->id}}" class="error"></div>
								 <div id="updatecreate_error_attachment-{{@$user1->id}}" class="error sinterview_qa_016" ></div>
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
	   <tr>
		  <td colspan="5" class="sinterview_qa_01" >
			  <div class="prod-pagination">
				{{ $reference_book_details->appends(['interview_id'=>$interview_id])->render() }}
			  </div>
		  </td>
		</tr>
		
		