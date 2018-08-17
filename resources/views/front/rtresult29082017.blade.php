
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
	?>
	<li style="border:1px solid #eee; line-height:35px;padding-left:20px;">{{$key +1}} . {{$newString}} 
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
}
?>
</ul>

</div>
<div class="prod-pagination">
	{{ $ticketslist->render() }}
	<!-- <ul class="pagination">
		<li class="disabled"><a>«</a></li> 
		<li class="active clickme" att_ram="1"><a style="cursor:pointer">1</a></li>
		<li class="clickme" att_ram="2"><a style="cursor:pointer">2</a></li>
		<li class="clickme" att_ram="3"><a style="cursor:pointer">3</a></li>
		<li class="clickme" att_ram="4"><a style="cursor:pointer">4</a></li>
		<li class="clickme" att_ram="5"><a style="cursor:pointer">»</a></li>
	</ul> -->
</div>
