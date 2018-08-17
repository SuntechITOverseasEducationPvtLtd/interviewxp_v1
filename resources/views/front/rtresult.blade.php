
<div>
 <!-- Please buy the tickets you will see all -->
 <div class="col-sm-1 showme"><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true" style="color: #fc575c"></i></div>
 <div class="col-sm-11" style="padding: 0px;margin-top: -32px;margin-left: -8px;">
  <p style="padding-left: 8px" class="show-results">Showing {{($ticketslist->currentpage()-1)*$ticketslist->perpage()+1}} to {{($ticketslist->currentpage()-1) * $ticketslist->perpage() + $ticketslist->count()}}
    of  {{$ticketslist->total()}} results</p>
  <hr style="margin-top: 5px;margin-bottom: 10px;" class="showme">
  <p class="showme"><strong>You will be able to choose and select only after you buy real time work experience material.</strong></p>
  <hr style="margin-top: 15px;margin-bottom: 5px;" class="showme">
 </div>

</div>

<div class="hideme" style="margin-top: 5px;">
<ul>
<?php

foreach ($ticketslist as $key=>$ticketslistNo) {
	$string = ucwords(strtolower(mb_strimwidth($ticketslistNo->issue_title, 0, 75, '...')));
    $string2 = strtoupper(substr($string,0,1)).preg_replace("/[a-z]/", "x",substr($string, 1));
    $newString = ($page > 1) ? $string2 : $string;

    if($ticketslistNo->file_extension =='Pdf'){
			 $icon='<i class="fa fa-file-pdf-o" style="color: #17b0a4;"></i>';
	 }
		 
	 if($ticketslistNo->file_extension =='Video'){
		 $icon='<i class="fa fa-play" style="color: #17b0a4;"></i>';
	 }
	?>
	<li style="border:1px solid #eee; line-height:35px;padding-left:10px;"><?php echo $icon ?>&nbsp;&nbsp; {{$key +1}} . {{$newString}} 
	<span style="float:right;margin-right:15px;">{{$ticketslistNo->pageCount}} &nbsp;&nbsp; {{$ticketslistNo->fileSize}} M.B</span>
		<?php 		
		if($ticketslistNo->freePreview =='Yes'){
			$dow="/uploads/real_time_attachment/".$ticketslistNo->attachment;
			$previewUrl= url('/')."/".base64_encode($ticketslistNo->skill_id)."/".base64_encode($ticketslistNo->member_id)."/".base64_encode($ticketslistNo->user_id)."/preview-real-issues/".base64_encode($ticketslistNo->interview_id)."/".base64_encode($ticketslistNo->experience_level);
		?>
		<a href="<?php echo $previewUrl?>" target="_New"><span style="float:right;margin-right:15px;">Preview</span></a>
		<?php }
		?>
	</li>
	
	
	
	
		<?php
$results1sis = DB::select( DB::raw("SELECT * FROM member_real_time_experience  WHERE `approve_status`='1' AND  `subid`= '".$ticketslistNo->id."' ") );
																 
																 if(isset($results1sis) && count($results1sis)>0) { echo '<div style="line-height: 23px;
    font-weight: 500;
    background: #f9f7f7;
    width: 100%;
    color: #0c756d;
    float: left;
    font-size: 13px;
    padding-left: 13px;
    border-top: 1px solid #ecececc2;
    border-bottom: 1px solid #ecececc2;;">Video URL refrance.</div>';}
    
																	foreach ($results1sis as $key1sis=>$user1sis) {
																	
																		 $videoIDis=explode('?v=',$user1sis->attachment);
																?>
																		
																		<li style="border:1px solid #eee;line-height:35px;background-color:#fff !important;width: 100%;float: left;"> 
																			<span class="col-sm-4">  <?php if(isset($videoIDis[1])) { ?>
              <div class="videoss" style="background-image:url('https://img.youtube.com/vi/{{$videoIDis[1]}}/0.jpg')">
                            
                            <a  style="text-align: center;"> 
  
  <img src="{{url('/')}}/images/icon-play.svg" class="img-zoomss"  style=" float: none;"></a>
  
  
     
     </div>
     
     <?php } ?> </span><span class="col-sm-4" align="right"></span>
																			<span class="col-sm-2" align="center">
																			<?php 		
		if($user1sis->freePreview =='Yes'){
			$dow="/uploads/real_time_attachment/".$user1sis->attachment;
			$previewUrl= url('/')."/".base64_encode($ticketslistNo->skill_id)."/".base64_encode($ticketslistNo->member_id)."/".base64_encode($ticketslistNo->user_id)."/preview-real-issues/".base64_encode($ticketslistNo->interview_id)."/".base64_encode($ticketslistNo->experience_level);
		?>
		<a href="<?php echo $previewUrl ?>" target="_New"><span style="float:right;">Preview</span></a>
		<?php }
		?>
																			</span>
																		
																			<span class="col-sm-2" align="right">{{round($user1sis->fileSize/60)}} Min.</span>																				
																		</li>
																		
																		
																		<?php } ?>
	
	
	
	
	
	
	
	<?php
}
?>
</ul>

</div>
<div class="prod-pagination">
    <?php if($ticketslist->total()>10) {
    
    $curenntdatas=($ticketslist->currentpage()-1)*$ticketslist->perpage()+1;
    ?>
<ul class="pagination"  style="
    width: 100%;
">
    <?php if($curenntdatas==11) { ?><li style="
    float: left;
    width: 100%;
"> <a href="http://cloudforcehub.com/interviewxp/realtimeissues?page=1" class="lessdi" style="
    font-weight: 500;
    display: block;
    color: #e04d52;
    cursor: pointer;
    font-size: 14px;
    border: none;
    width: 69px;
    width: 69px;
    height: 16px;
    line-height: 0px; 
">- View Less</a></li>
<?php }  else { ?>
<li style="
    float: left;
    width: 100%;
"> <a href="http://cloudforcehub.com/interviewxp/realtimeissues?page=2" class="moredi"  style="
    font-weight: 500;
    display: block;
    color: #e04d52;
    cursor: pointer;
    font-size: 14px;
    border: none;
    width: 79px;
    height: 16px;
    line-height: 0px;
">+ View More</a></li>

<?php } ?></ul>
<?php } ?>
</div>
