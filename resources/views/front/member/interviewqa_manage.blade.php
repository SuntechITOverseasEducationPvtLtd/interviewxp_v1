<link href="http://cloudforcehub.com/interviewxp/css/front/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <!-- main CSS -->
<link href="http://cloudforcehub.com/interviewxp/css/front/Interviewxp.css" rel="stylesheet" type="text/css" />
  <link href="http://cloudforcehub.com/interviewxp/css/front/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <style>#loader-wrapper {
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
    
    .sinterviewqa_manage_01{width: 55% !important;}
.sinterviewqa_manage_02{display:none !important;}
.sinterviewqa_manage_03{font-family: 'ubuntumedium',sans-serif !important; font-size: 13px !important; width: 50px !important;}
.sinterviewqa_manage_04{font-family: 'ubuntumedium',sans-serif !important; font-size: 13px !important;}
.sinterviewqa_manage_05{width:30% !important; float:left !important; text-align:left !important;}
.sinterviewqa_manage_06{background-color: #d9edf7 !important; display:block !important}
.sinterviewqa_manage_07{padding:0px !important;}
.sinterviewqa_manage_08{margin-top: 8px !important; padding: 0px !important;}
.sinterviewqa_manage_09{margin-top: 8px; padding: 0px 0px 0px 7px !important; text-align: center !important;}
.sinterviewqa_manage_010{margin-top: 8px !important; padding-left: 2px !important; margin-left: 6px !important;}
.sinterviewqa_manage_011{background-color: #17b0a4 !important; border: 1px solid #17b0a4 !important;float: right !important; color: #fff !important; padding: 5px !important; width:92px !important;}
.sinterviewqa_manage_012{margin-left:10px  !important; color:rgba(85, 85, 85, 0.82)  !important;}
.sinterviewqa_manage_013{float:right !important;  margin-right: 20px !important;  cursor: pointer !important;}
.sinterviewqa_manage_014{margin-left:10px !important;}
.sinterviewqa_manage_015{background-color: #17b0a4 !important; border: 1px solid #17b0a4  !important; color: #fff  !important; padding: 5px  !important; margin-left:10px  !important;}
.sinterviewqa_manage_016{background-color:#fff !important; display: none !important; float:left !important; width:100%  !important;}
.sinterviewqa_manage_017{min-height:22px  !important;}
.sinterviewqa_manage_018{color:green  !important;}
.sinterviewqa_manage_019{clear:both  !important;}
.sinterviewqa_manage_020{display: none  !important;}
.sinterviewqa_manage_021{border:1px solid #ccc  !important; padding:5px  !important; width:100%  !important}
.sinterviewqa_manage_022{font-size:30px; border: 1px solid #ccc; padding: 15px;margin-top:10px; color: #de0b12;}
.sinterviewqa_manage_023{display:block !important;}
.sinterviewqa_manage_024{font-size:30px;  border: 1px solid #ccc; padding: 15px; margin-top:10px;}
.sinterviewqa_manage_025{margin-left: 20px;}
.sinterviewqa_manage_026{width:100%}
.sinterviewqa_manage_027{border: 1px solid #ccc; padding:15px;}
.sinterviewqa_manage_028{border-right: 1px solid rgb(251, 251, 251) ! important; display: none;}
.sinterviewqa_manage_029{height: 38px; display: none;}
.sinterviewqa_manage_030{left:0;}
.sinterviewqa_manage_031{background-color: #eee; border:none;}
.sinterviewqa_manage_032{padding: 8px;height: 40px;margin-top: 0px;text-align:center; width:120px;margin-right: 10px;border:none; float:right}
.sinterviewqa_manage_033{margin-right:10px; width:125px; padding: 8px 0px;
 height: 40px; float:right}
.sinterviewqa_manage_034{height: 38px;}
.sinterviewqa_manage_036{color:rgba(85, 85, 85, 0.82)}
.sinterviewqa_manage_037{color: red !important;}
.sinterviewqa_manage_038{width:30%; float:left}
.sinterviewqa_manage_039{width:15%; float:left}
.sinterviewqa_manage_040{width:25%; float:left}
.sinterviewqa_manage_041{color: #17b0a4 !important;}
.sinterviewqa_manage_042{margin-left:10px; font-size: 18px;
    color: #de1218;}
    
    </style>
    
    
    
    
  <div id="loader-wrapper">
	<div id="loader"><img src="{{url('/')}}/images/page-loader.gif" class="sinterviewqa_manage_01"/></div>
</div>
	  <div class="table-responsive">
	      <input class="topicTextbox{{$arr_skill}} sinterviewqa_manage_02"  type="text" id="topic_name-reference-{{$arr_skill}}" name="topic_name" value="">
	       
	       
	       
														 <table class="datatable table table-striped table-bordered table table-advance" style="width: 100% !important;" >
																<thead>
																  
																  
																   <tr class="top-strip-table">
																	  <td style="font-family: 'ubuntumedium',sans-serif;font-size: 13px;     width: 50px;">S.No <i class="fa fa-fw fa-sort"></i></td>
																	  	  <td style="font-family: 'ubuntumedium',sans-serif;font-size: 13px;">
																	  	      <div style="width:30%; float:left; text-align:left">Topic Name  <i class="fa fa-fw fa-sort"></i></div> <div style="width:15%; float:left; text-align:left">File Size <i class="fa fa-fw fa-sort"></i></div>
																	  	      <div style="width:25%; float:left; text-align:left">Date & Time <i class="fa fa-fw fa-sort"></i></div>  <div style="width:15%; float:left; text-align:left">Status <i class="fa fa-fw fa-sort"></i></div> 
																	  	      <div style="width:15%; float:left; text-align:left">Action <i class="fa fa-fw fa-sort"></i></div></td>
																	
																
																   </tr>
																   
																   
																								      <div style="background-color: #d9edf7;display:block"  class="topicSave">
		  
		    <div style="clear:both;"></div>
			<!-- topic save -->
			<div class="form-group" style="">
				<div class="col-md-12" style="padding:0px;">
					<span class="col-md-8 addTopicname" style="margin-top: 8px; padding: 0px;"></span>
					<span class="col-md-2" style="margin-top: 8px; padding: 0px 0px 0px 7px; text-align: center;">Pending</span>
					<div class="col-md-2" style="padding:0px">
					<span class="col-md-1 editTopic" style="margin-top: 8px;padding-left: 2px;margin-left: 6px;"><i class="fa fa-pencil"></i></span>
					<span class="col-md-1 deleteTopic" style="margin-top: 8px;padding-left: 2px;margin-left: 7px;"><i class="fa fa-trash-o"></i></span>						
					<span class="col-md-2 showPDFExcelAdd" attrpartscount="0" attrId="{{@$interview_id}}" style="background-color: #17b0a4;border: 1px solid #17b0a4;float: right;color: #fff;padding: 5px;width:92px;"><i class="fa fa fa-plus"></i> Add Part</span>
					</div>
				</div>
			</div>
															   </thead>
																   
																   
																   
																   <tbody>
 <?php
																		$reference_book_details = DB::table('multi_reference_book')
																				->select('*')
																				->where(['interview_id'=>$arr_skill])
																				->groupBy('topic_name')
																				->orderBy('id','DESC')
																				->orderBy('approve_status','DESC')
																				->paginate(1000);	
																		
																		$submit_book_details = DB::table('multi_reference_book')
																				->select('*')
																				->where(['interview_id'=>$arr_skill])
																				->where('approve_status','=',0)
																				->groupBy('topic_name')
																				->orderBy('id','DESC')
																				->orderBy('approve_status','DESC')
																				->get();

																		$new_approvals = DB::table('multi_reference_book')->where(['interview_id'=>$arr_skill])->where('approve_status','=',1)
																				->groupBy('topic_name')->get();
																	
																	$interview_id=$arr_skill;
																	   ?>


	   <?php
	 
		$resultsskil = DB::select( DB::raw("SELECT * FROM member_interview WHERE id = '".$arr_skill."'  ") );	
			$resultsskilf=$resultsskil[0];
		foreach ($reference_book_details as $key=>$user) {
			
			$delete="/member/delete_reference_book_all/".base64_encode($user->topic_name);
			
			$string = ucwords(strtolower(mb_strimwidth($user->topic_name, 0, 95, '...')));
			
			$results1 = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$user->interview_id."' AND topic_name = '".$user->topic_name."' AND file_extension != 'youtube' ORDER BY `multi_reference_book`.`id` DESC") );	
			
			
				
				
			?>
			<tr class="asgreen">
			    
			     <td    style="text-align:center; background: white;     width: 80px;">{{$key+1}}</td>
			     
			     
				<td title="{{$string}}">&nbsp;&nbsp;&nbsp;{{$string}} 
				<span class="sinterviewqa_manage_013" ><span class="sinterviewqa_manage_012"><i class="fa fa-pencil"></i></span>
				
				@if($user->approve_status == 0)
				<a class="sinterviewqa_manage_012" href="{{$delete}}" onclick="return confirm('Are you sure to Delete this record?')"><i class="fa fa-trash-o"></i></a>
				@else
				<span class="sinterviewqa_manage_014"><i class="fa fa-trash-o"></i></span>	
				@endif
					<span class="showPDFExcelAdd" attrPartsCount="{{@count($results1)}}" attrId="{{$user->interview_id}}" skillId=""  showwId="{{$key+1}}"   txtattr="{{$user->topic_name}}" 
				style="background-color: #17b0a4;border: 1px solid #17b0a4;color: #fff;padding: 5px;margin-left:10px;"><i class="fa fa fa-plus"></i> Add Part</span></span>
				
		
				
					   <div id="addbook-row{{$key+1}}" class="addbook-rowhide" style="background-color:#fff; display: none; float:left; width:100%">
			
				<div class="addbook" style="min-height:22px;">
			
			   {{ csrf_field() }}
			   
			   <input type="hidden" class="interviewid"  id="unique_id" value="{{@$interview_id}}">
			   <input type="hidden" id="skill_id_reference-{{@$interview_id}}" value="{{$resultsskilf->skill_id}}">
			   <input type="hidden" id="experience_level_reference-{{@$interview_id}}" value="{$resultsskilf->experience_level}}">
			   <div style="color:green;" id="reference_success_msg-{{@$interview_id}}"></div>																	
			
			<div style="clear:both;"></div>
            
			<div class="form-group videoPdfIcon" style="border:1px solid #ccc;padding:5px; width:100%">
			  <div class="row">
				<div class="col-sm-12 col-md-4 col-lg-4 part-text">New Part</div>
				<div class="col-sm-12 col-md-8 col-lg-8">
					<div class="col-sm-12 col-md-4 col-lg-4 videoIcon sinterviewqa_manage_020">
					    
					  <i class="fa fa-youtube sinterviewqa_manage_022"  ></i>
					
					<span class="sinterviewqa_manage_019 sinterviewqa_manage_023">Add Video</span></div>
					
					
					
					
					<div class="col-sm-12 col-md-4 col-lg-4 pdfIcon"><i class="fa fa-file-pdf-o sinterviewqa_manage_024"></i><span class="sinterviewqa_manage_023 sinterviewqa_manage_019 sinterviewqa_manage_025" >Pdf</span></div>
					<div class="sinterviewqa_manage_019"></div>
				</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group sinterviewqa_manage_026" >
			   <div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="videoclass sinterviewqa_manage_027">
						<!--<input id="reference_book-{{@$interview_id}}"  style="visibility:hidden; height: 0;" name="reference_book" type="file">-->
						 <div class="input-group col-sm-12 col-md-12 col-lg-12">
						     
						     
						     
						
							
							
							
								<div class="btn btn-primary btn-file remove"  style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_reference_book-{{@$interview_id}}">
							   <a class="file" onclick="removeReferenceBook({{@$interview_id}})"><i class="fa fa-trash"></i>
							   </a>
							</div>
							
							
							<input class="form-control file-caption  kv-fileinput-caption sinterviewqa_manage_029" id="reference_book_name-{{@$interview_id}}" disabled="disabled" type="text">
							<h5 class="upload sinterviewqa_manage_020">Support Formats: MP4, Max File 300 MB</h5>
							<h5 class="upload sinterviewqa_manage_020" >Tip: video is InterviewXp's preferred delivery type wide screen 16:9 ratio is preferred. Please note that the average video length is within 5-10 minutes. Content should be with high resolution video 720p (1280x720)</h5>
							<div id="error_msg-{{@$interview_id}}" class="error"></div>
							<div id="create_error_attachment-{{@$interview_id}}" class="error sinterviewqa_manage_030" ></div>
						 </div>
					</div>
					<div class="pdfclass sinterviewqa_manage_027">
						<!--<input id="reference_book-{{@$interview_id}}"  style="visibility:hidden; height: 0;" name="reference_book" type="file">-->
						 <div class="input-group  col-sm-12 col-md-12 col-lg-12">
							
							<div class="col-sm-6 col-md-6 col-lg-6 btn btn-primary  btn-gry sinterviewqa_manage_031">
							   <!--<a class="file" onclick="browseReferenceBook({{@$interview_id}})">Choose File
							   </a>-->
							   <input id="reference_book-{{$key+1}}" class="reference_bookPdf-{{$key+1}} reference_bookPdf" accept="application/pdf" name="reference_book" type="file">
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
							    
							    <div class="cancelFinalBtn cancel-btn sinterviewqa_manage_032" >Cancel</div>								
							    
							    
								<button  type="submit" id="update_reference_book" onclick="javascript: return refbookupload({{@$interview_id}},{{$key+1}});" class="submit-btn ctn bookbtn sinterviewqa_manage_033">Upload</button>
    
    
    
    
    
    
								
							</div>
						<div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_reference_book-{{@$interview_id}}">
							   <a class="file" onclick="removeReferenceBook({{@$interview_id}})"><i class="fa fa-trash"></i>
							   </a>
							</div>
							<input class="form-control file-caption  kv-fileinput-caption sinterviewqa_manage_034" id="reference_book_name-{{@$interview_id}}" disabled="disabled" type="text" >
							<h5 class="upload">Support Formats: PDF, Max File 2 MB</h5>
							<div id="error_msg-{{@$interview_id}}" class="error"></div>
							<div id="create_error_attachment-{{@interview_id}}" class="error sinterviewqa_manage_030" ></div>
						 </div>
					</div>
				</div>
				
			   </div>
				  <div class="clearfix"></div>
			   </div>

			</div>
		</div>
				
				 
				<br>
				
				
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
								 $alrtmessage="'Are you sure to delete this?'";
							 if($user1->approve_status==1){
								 $status="Approved";
								 $freeView="";
								 $url="http://cloudforcehub.com/interviewxp/member/delete_reference_book/".base64_encode($user1->id);
								 $dow="http://cloudforcehub.com/interviewxp/uploads/refrence_book/".$user1->mul_reference_book;
								 $action='<a class="sinterviewqa_manage_036" href="'.$dow.'" target="_New"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a><a  href="'.$dow.'"  title="Download" download="" class="download-i .sinterviewqa_manage_014"><i class="fa fa-download sinterviewqa_manage_036" aria-hidden="true"></i></a><a class="editInterview sinterviewqa_manage_012"><i class="fa fa-pencil"  title="Edit" aria-hidden="true"></i></a> <a title="Delete" class="delete-i sinterviewqa_manage_012"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
							 }
								 
							 else{
								 $status="Pending";
								 $freeView=url('/member/freePreview/').'/'.base64_encode($user1->id);
								 $url="http://cloudforcehub.com/interviewxp/member/delete_reference_book/".base64_encode($user1->id);
								 $dow="http://cloudforcehub.com/interviewxp/uploads/refrence_book/".$user1->mul_reference_book;
								 $action='<a class="sinterviewqa_manage_037" href="'.$dow.'" target="_New"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a><a href="'.$dow.'"  title="Download" download="" class="download-i sinterviewqa_manage_014"><i class="fa fa-download sinterviewqa_manage_037" aria-hidden="true"></i></a><a class="sinterviewqa_manage_014"  title="Edit" data-toggle="modal" href="#ref-book-'.$user->id.'"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a href="'.$url.'" onclick="return confirm('.$alrtmessage.')"  title="Delete" class="delete-i sinterviewqa_manage_014"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
							 }
							 
							  if($key1==0) { $margintop='margin-top: 9px;'; } else { $margintop=''; }
						?>
					 <div style="float: left;  min-height: 37px;  width: 100%;  border-bottom: 1px solid #e4e7ec; background: #fff;  font-size: 13px;  line-height: 34px;   padding: 0px 5px; {{$margintop}}">
     
							<div class="sinterviewqa_manage_038"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $icon ?> &nbsp;&nbsp; Part {{$key1+1}} &nbsp;&nbsp; {{$user1->pageCount}} </div>
							
							<div class="sinterviewqa_manage_039"> {{$user1->fileSize}} M.B</div>
							<div class="sinterviewqa_manage_040"> {{date('j M, Y, g:i A T',strtotime($user1->created_at))}} 
							<?php 
							if($user1->freePreview ==''&& $status=='Pending'){
							?>
							<a class="sinterviewqa_manage_014" href="{{$freeView}}" onclick="return confirm('Are you sure you want make it free?')"> <i class="fa fa-eye-slash sinterviewqa_manage_041" aria-hidden="true" title="Make a free preview" ></i>
							</a>
							<?php 
							}else{
								?>
								&nbsp;&nbsp;&nbsp;<i class="fa fa-eye sinterviewqa_manage_041" aria-hidden="true" title="Free Preview" ></i>
								<?php
							}
							?>
							</div>
							<div class="sinterviewqa_manage_039"><?php echo $status;?></div>
							<div class="sinterviewqa_manage_039"><?php echo $action;?>
							
							
							<a  data-toggle="modal" href="#ref-book-youtube{{@$user1->id}}" class="sinterviewqa_manage_042 tkeyoutubevalues" id="{{@$user1->id}}" title="Add Youtube URL"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
							
							
							
							
									@if($user1->admin_comments) 
									&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comments" title="{{$user1->admin_comments}}" style="color: green" ></i>
									@endif
							</div>
							
							
							
<?php $results1s = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE subid = '".$user1->id."'  ORDER BY `multi_reference_book`.`id` DESC") );	

if(isset($results1s) && count($results1s)>0) { echo '<div style="line-height: 23px;
    font-weight: 500;
    background: #f9f7f7;
    width: 100%;
    color: #0c756d;
    float: left;
    font-size: 13px;
    padding-left: 16px;
    border-top: 1px solid #ecececc2;
    border-bottom: 1px solid #ecececc2;;">Video URL refrance.</div>';}
	   foreach ($results1s as $key1s=>$user1s) { 
			
			$videoID=explode('?v=',$user1s->mul_reference_book);
							
						
								 $alrtmessage="'Are you sure to delete this?'";
							 if($user1s->approve_status==1){
								 $status="Approved";
								 $freeView="";
								 $url="http://cloudforcehub.com/interviewxp/member/delete_reference_book/".base64_encode($user1s->id);
								 $dow="http://cloudforcehub.com/interviewxp/uploads/refrence_book/".$user1s->mul_reference_book;
								 $action='<a data-toggle="modal" href="#videoplayintro" class="videoidtake" id="'.$videoID[1].'"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a> <a style="margin-left:10px;color:rgba(85, 85, 85, 0.82)" class="editInterview"><i class="fa fa-pencil"  title="Edit" aria-hidden="true"></i></a> <a style="margin-left:10px;color:rgba(85, 85, 85, 0.82)"  title="Delete" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
							 }
								 
							 else{
								 $status="Pending";
								 $freeView=url('/member/freePreview/').'/'.base64_encode($user1s->id);
								 $url="http://cloudforcehub.com/interviewxp/member/delete_reference_book/".base64_encode($user1s->id);
								 $dow="http://cloudforcehub.com/interviewxp/uploads/refrence_book/".$user1s->mul_reference_book;
								 $action='<a style="color:red" data-toggle="modal" href="#videoplayintro" class="videoidtake" id="'.$videoID[1].'"><img src="'.$viewicon.'" alt="Interviewxp" title="View"/></a> <a style="margin-left:10px;"  title="Edit" data-toggle="modal" href="#ref-edityoutube" id="'.$user1s->id.'" ids="'.$user1s->mul_reference_book.'" class="edityoutubetake"><i class="fa fa-pencil" aria-hidden="true"></i></a> <a style="margin-left:10px;" href="'.$url.'" onclick="return confirm('.$alrtmessage.')"  title="Delete" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
							 }
							 
							  if($key1s==0) { $margintop='margin-top: 9px;'; } else { $margintop=''; }
							  
							
							 
							 
						?>
					 <div style="float: left;  min-height: 37px;  width: 100%;  border-bottom: 1px solid #e4e7ec; background: #fff;  font-size: 13px;  line-height: 34px;   padding: 0px 5px; {{$margintop}}">
     
     
     <div style="width:30%; float:left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if(isset($videoID[1])) { ?>
              <div class="video" style="background-image:url('https://img.youtube.com/vi/{{$videoID[1]}}/0.jpg')">
                            
                            <a data-toggle="modal" href="#videoplayintro" class="videoidtake" id="{{$videoID[1]}}" style="text-align: center;"> 
  
  <img src="{{url('/')}}/images/icon-play.svg" class="img-zoom"  style=" float: none;"></a>
  
  
     
     </div>
     
     <?php } ?>
     </div>
							
							
							<div style="width:15%; float:left"> <?php echo round($user1s->fileSize/60) ?> Min.</div>
							<div style="width:25%; float:left"> {{date('j M, Y, g:i A T',strtotime($user1s->created_at))}} 
							<?php 
							if($user1s->freePreview ==''&& $status=='Pending'){
							?>
							<a style="margin-left:10px;" href="{{$freeView}}" onclick="return confirm('Are you sure you want make it free?')"> <i class="fa fa-eye-slash" aria-hidden="true" title="Make a free preview" style="color: #17b0a4 !important;"></i>
							</a>
							<?php 
							}else{
								?>
								&nbsp;&nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true" title="Free Preview" style="color: #17b0a4 !important;"></i>
								<?php
							}
							?>
							</div>
							<div style="width:15%; float:left"><?php echo $status;?></div>
							<div style="width:15%; float:left"><?php echo $action;?>
							
							
						
							
							
							
							</div>
							</div>
							
							<?php } ?>
							
							
							
							
							
							
							
							
						</div>
						
						
						
						
							<div class="modal fade popup-cls" id="ref-book-youtube{{@$user1->id}}" role="dialog" style=" 
    margin-top: 13%;
    position: fixed;">
						  <div class="modal-dialog">
							 <div class="modal-content">
								<div class="modal-header">
								   <button type="button" class="close" data-dismiss="modal"><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"/></button>
								   <h4 class="modal-title">Reference Youtube Video</h4>
								</div>
								<div class="modal-body" style="float:left; background:#fff;     width: 100%;">
								   
								    
						         <form class="" id="yutub_{{@$user1->id}}" method="POST"   data-parsley-validate>                        
                 {{ csrf_field() }}
                 
                 
							<div class="col-sm-12 col-md-12 col-lg-12" >
							  
							   
							   <input id="reference_book-{{@$user1->id}}" class="reference_bookVideo-{{@$user1->id}} input-box-signup" 
							   name="reference_bookyoutube[]" type="url" pattern=".+.youtube.com\/[^\/]+$" placeholder="Enter Valid Youtube URL" required style="width:90%; float: left;"> 
							   
							   	<i class="fa fa-plus addyoutubemore" id="reference_bookVideo-{{@$user1->id}}" style="background: #17b0a4; margin-left: 5px;
    color: #fff;
    padding: 6px 7px;
    margin-top: 5px;
    border-radius: 4px;
    cursor: pointer;"></i>
    
    <p class="rreference_bookVideo-{{@$user1->id}}"></p>
							
							   
							   
							   <input type="hidden" name="interviewidtube" value="{{@$interview_id}}" >
							
							<input type="hidden" name="keyvalye" value="{{@$user1->id}}" >
							
							<input type="hidden" name="topicnametub" value="{{$string}}" >
							
							<input type="hidden" name="categoryid" value="{{$user1->id}}" >
							   
							</div>
						
							
							
								
								
							<div class="col-sm-12 col-md-12 col-lg-12" style="padding-top:15px;">
								
								
								<button  type="button" id="{{$user1->id}}"  style="float:right;width:130px; display:block; margin-right: 56px;" class="submit-btn ctn uploadyoutube">Add</button>
								
								
								
							</div>
							</form>
							
							
							
							
							
								
								<!--end-->
							 </div>
							
						  </div>
						  
						  </div></div>
						  
						  
						  
						
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
								<div class="form-group" style="width:100%">
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
								<div class="form-group" style="width:100%">
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
						  
						  </div></div>
					
						<?php
						}
						?>
				
				
				</td>
			 </tr>
			
					
						
			<?php
			
		}
		
	   ?>	
	   
	   </tbody></table>
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	    <style type="text/css">
	    
	    .table-responsive {
   
    height: 1250px; } 
 .panel-default>.panel-heading {
    color: #333;
    background-color: #f5f5f559;
    border-color: #ddd;
}

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
 .pull-right {
    float: right!important;
    position: absolute;
    right: 24px;
    margin-top: -10px;
}select.input-sm {
    height: 30px;
    line-height: 21px;
}
 .table-bordered>tbody>tr>td {     border: 1px solid #ddd;
       padding: 6px 0px 0px;  font-size: 14px; }
 .table-responsive .top-strip-table {
    color: #403e3e; }
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
		.history-page .table-search-pati.section1-tab.add-skiils-table tr td {
    padding: 10px 11px 10px 25px !important;
    text-align: left;
    font-size: 14px;
} .table-responsive {
   min-height: 1000px; }
</style>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js"></script>
	<script src="http://cloudforcehub.com/interviewxp/js/datatables.js"></script>
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
	
		
	
$(document).on('click', ".showPDFExcelAdd", function() {	
	$(".topicText").hide();
	$(".addTopicMain").show();
	$(".sub-tab").css({'padding': '10px 10px'});
	var id=$(this).attr("attrId");
	var addtxt=$(this).attr("txtattr");
	
	var showwId=$(this).attr("showwId");

	
	var attrpartscount=parseInt($(this).attr("attrpartscount"))+1;
	$(".videoPdfIcon").show();
	$(".topicTextbox"+id).val(addtxt);
	var $this     = $(this),
	$parentTR = $this.closest('td');
	$('.addbook-rowhide').hide();
	
	$('#addbook-row'+showwId).show();	
//$('#addbook-row'+id).remove().clone().insertAfter($parentTR);	
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
		$('.CallIcons .titleTxt').focus();

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
		$('.callEmailVideo p.titleTxt').html($('.CallIcons .titleTxt').html());
		$('.roundTypeVal').val($('.CallIcons .titleTxt').html());
		$('.callEmailVideo button').attr('attrid',  $(this).attr('attrid'));
	});
	$(document).on("click", ".pdfIconCall", function(){	
		$(".callEmailPdf").show();
		$(".CallIcons").hide();
		$('.callEmailPdf button').attr('companyname', $(this).attr('companyname'));
		$('.callEmailPdf button').attr('txtattr', $(this).attr('txtattr'));
		$('.callEmailPdf p.titleTxt').html($('.CallIcons .titleTxt').html());
		$('.roundTypeVal').val($('.CallIcons .titleTxt').html());
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
   
   function refbookupload(id,ids)
   { 
      var link             = "{{ url('/member/create_reference_book') }}";
      var skill_id         = $("#skill_id_reference-"+id).val();
      var experience_level = $('#experience_level_reference-'+id).val();
      var _token           = $("input[name=_token]").val();
      var topic_name       = $('#topic_name-reference-'+id).val();
      var interview_id     = id;
      
 
   
      
      
	  var files=[];
	  var findfile=$(".reference_bookPdf-"+ids).val();
		if(findfile ==''){
			var fileName=$(".reference_bookVideo-"+ids)[0].files[0];
			var durationVideo=$("#durationVideo").val();
		}else{
			var fileName=$(".reference_bookPdf-"+ids)[0].files[0];
			var durationVideo="";
		}
 //alert(findfile);
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
							location.reload();
                              }
                              if(response.status=="ERROR")
                              {
                                 $('#reference_success_msg-'+id).html('');
                                 /*$('#reference_error_msg-'+id).html(response.msg);*/
                                 //$('#create_error_attachment-'+id).html(response.msg);
								 alert(response.msg);
								// window.location="{{URL::to('member/manage_upload_history?ref=')}}"+interview_idBase64;
									location.reload();
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
								//window.location="{{URL::to('member/manage_upload_history?ref=')}}"+interview_idBase64;
									location.reload();
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
								// window.location="{{URL::to('member/manage_upload_history?ref=')}}"+interview_idBase64;
									location.reload();
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
      
      alert(topic_name);
      
      
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
							  
							  alert(response.status);
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
      var roundType	   = $('.roundTypeVal').val();
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
    
    
    
    $(document).on('click', '.uploadyoutube', function() {
    
   $ids=$(this).attr('id');
	 $.ajax({
				url:"{{url('/')}}/member/youtubesave_save",
				type: "POST",
				data: $("#yutub_"+$ids).serialize(),
				cache: false,
				success: function(response) {				
				$("#yutub_"+$ids).html(response);
				
				
									
				} });
    });
		
		
 $(document).on('submit','#yutubeditform', function(e) { 

e.preventDefault();

	 $.ajax({
				url:"{{url('/')}}/member/youtubesave_saveedit",
				type: "POST",
				data: $("#yutubeditform").serialize(),
				cache: false,
				success: function(response) {				
				$("#yutubeditform").html(response);
				
				
									
				} });
    });
		
		
		
			
    $(document).on('click', '.tkeyoutubevalues', function() { 
        
         var x = $(this).offset();
        $hightshow=x.top;
        
 $ids=$(this).attr('id');
  $(".input-box-signup").removeClass("tubetakevalue");
   $(".reference_bookVideo-"+$ids).addClass("tubetakevalue");
   
   $("#ref-book-youtube"+$ids).css("margin-top",$hightshow+"px");
   
   
 
    });
    
    
        $(document).on('click', '.edityoutubetake', function() { 
        
         var x = $(this).offset();
        $hightshow=x.top;
        

 $ids=$(this).attr('id');
 $idss=$(this).attr('ids');
  $(".videoidedi").val($ids);
   $(".editurlyoutubeid").val($idss);
   
   $("#ref-edityoutube").css("margin-top",$hightshow+"px");
   
   
 
    });
    
    
    
    

$(document).on('click', '.addyoutubemore', function() { 
 $ids=$(this).attr('id');

var youtuvevalue=$(".tubetakevalue").val();
      
      
    
    var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
    var matches = youtuvevalue.match(p);
    if(matches){
       
        $(".input-box-signup").removeClass("tubetakevalue");

  $(".r"+$ids).append('<input  class="input-box-signup tubetakevalue"   name="reference_bookyoutube[]" type="url"  placeholder="Enter Valid Youtube URL" required style="width: 90%; float: left;     margin-top: 5px;">');

} else {
    
    alert('Enter Valid Youtube URL');
}

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
	.history-page .table-search-pati.section1-tab.add-skiils-table tr td {
    padding: 10px 11px 10px 25px !important;
    text-align: left;
    font-size: 14px;
}


		    
		    .video {    text-align: center;
    margin-top: -30px;
    height: 36px;
    border-radius: 4px;
    background-size: cover;
    position: relative;
    width: 41px;
    background-position: center;
    margin-bottom: 5px;     margin-left: 11px;} 
    
    .history-page .table thead.box td {
    font-family: 'ubuntulight',sans-serif;
    font-size: 15px;
    letter-spacing: 0.4px;
    line-height: 45px; } 
    
    .img-zoom
{
  height: 100%;
  width: 100%;
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
		
		<script type="text/javascript">
$(document).ready(function(){
    
   $(document).on('click', '.videoidtake', function() {  
       
       $idvalue=$(this).attr('id');  
       
        var x = $(this).offset();
        $hightshow=x.top;
        $hightshowf=($hightshow-200);
         $("#videoplayintro").css("margin-top",$hightshowf+"px");
   
   
        
       $('.videouploadidhere').html('<iframe width="100%" height="315" src="https://www.youtube.com/embed/'+$idvalue+'?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" ></iframe>');
       
   });
   
   
   
   
   $(document).on('click', '.close', function() {   $('.videouploadidhere').html(''); });
   
   
});
  
  
    </script>










		<div class="modal fade popup-cls" id="ref-edityoutube" role="dialog" style=" 
    margin-top: 13%;
    position: fixed;">
						  <div class="modal-dialog">
							 <div class="modal-content">
								<div class="modal-header">
								   <button type="button" class="close" data-dismiss="modal"><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"/></button>
								   <h4 class="modal-title">Edit Youtube Video</h4>
								</div>
								<div class="modal-body" style="float:left; background:#fff;     width: 100%;">
								   
								    
						         <form class="" id="yutubeditform" method="POST"   data-parsley-validate>                        
                 {{ csrf_field() }}
                 
                 
							<div class="col-sm-12 col-md-12 col-lg-12" >
							  
							   
							   <input  class="editurlyoutubeid input-box-signup" 
							   name="editurlyoutube" type="url" 
							   pattern=".+.youtube.com\/[^\/]+$" placeholder="Enter Valid Youtube URL" required style="width:100%; float: left;"> 
							   
							  
							   
							   
							 
							
						
							
							<input type="hidden" name="videoidedi" class="videoidedi" value="" required>
							   
							</div>
						
							
							
								
								
							<div class="col-sm-12 col-md-12 col-lg-12" style="padding-top:15px;">
								
								
								<button  type="submit"  style="float:right;width:130px; display:block; " class="submit-btn ctn">Edit</button>
								
								
								
							</div>
							</form>
							
							
							
							
							
								
								<!--end-->
							 </div>
							
						  </div>
						  
						  </div></div>
						  
						  
						  
						  
						  
	