<link href="http://cloudforcehub.com/interviewxp/css/front/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <!-- main CSS -->
<link href="http://cloudforcehub.com/interviewxp/css/front/Interviewxp.css" rel="stylesheet" type="text/css" />
      <!--font-awesome-css-start-here-->
     <link href="http://cloudforcehub.com/interviewxp/css/front/font-awesome.min.css" rel="stylesheet" type="text/css" />  



														  <div class="table-responsive">
														 <table class="datatable table table-striped table-bordered table table-advance" >
																<thead>
																  
																   <tr class="top-strip-table">
																	  <td style="font-family: 'ubuntumedium',sans-serif;font-size: 13px;">S.No <i class="fa fa-fw fa-sort"></i></td>
																	  	  <td style="font-family: 'ubuntumedium',sans-serif;font-size: 13px;">
																	  	      <div style="width:30%; float:left; text-align:left">Topic Name  <i class="fa fa-fw fa-sort"></i></div> <div style="width:20%; float:left; text-align:left">File Size <i class="fa fa-fw fa-sort"></i></div>
																	  	      <div style="width:30%; float:left; text-align:left">Date & Time <i class="fa fa-fw fa-sort"></i></div>  <div style="width:20%; float:left; text-align:left">Status <i class="fa fa-fw fa-sort"></i></div> </td>
																	
																
																   </tr>
																   </thead>
																   <tbody >
																   <?php
																  
																   $results = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '$arr_skill' group by topic_name ORDER BY `multi_reference_book`.`id` DESC") );
																	
																	foreach ($results as $key=>$user) {
																		
																		$delete="/member/delete_reference_book_all/".base64_encode($user->topic_name);
																		$string = ucwords(strtolower(mb_strimwidth($user->topic_name, 0, 95, '...')));
																		?>
																		<tr class="asgreen" >
																		    <td  title="{{$string}}" style="text-align:center; background: white; width:80px">{{$key+1}}</td>
																		    
																			<td  title="{{$string}}"> &nbsp;&nbsp;{{$string}} <br><?php
																				   $results1 = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '$arr_skill' AND topic_name = '".$user->topic_name."' AND file_extension != 'youtube' ORDER BY `multi_reference_book`.`id` DESC") );
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
																							 $url="/member/delete_reference_book/".base64_encode($user->id);
																							 $dow="/uploads/refrence_book/".$user->mul_reference_book;
																							
																						 }
																							 
																						 else{
																							 $status="Pending";
																							 $url="/member/delete_reference_book/".base64_encode($user->id);
																							 $dow="/uploads/refrence_book/".$user->mul_reference_book;
																							 
																						 }
																						 
																						 $freeView="/member/freePreview/".base64_encode($user1->id);
																						 
																						 if($key1==0) { $margintop='margin-top: 9px;'; } else { $margintop=''; }
																					?>
 <div style="float: left;  min-height: 37px;  width: 100%;  border-bottom: 1px solid #e4e7ec; background: #fff;  font-size: 13px;  line-height: 34px;   padding: 0px 5px; {{$margintop}}">
     
																					<div style="width:30%; float:left"><?php echo $icon ?> Part {{$key1+1}} &nbsp;&nbsp; {{$user1->pageCount}} </div> 
																					<div style="width:20%; float:left" >{{$user1->fileSize}} M.B </div>
																					 <div style="width:30%; float:left" >{{date('j M, Y, g:i A T',strtotime($user1->created_at))}}</div>
																					 <div style="width:20%; float:left" ><?php echo $status;?></div>
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
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
							 }
								 
							 else{
								 $status="Pending";
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
							
							
							<div style="width:20%; float:left"> <?php echo round($user1s->fileSize/60) ?> Min.</div>
							<div style="width:31%; float:left"> {{date('j M, Y, g:i A T',strtotime($user1s->created_at))}} 
						
						
							</div>
							<div style="width:15%; float:left"><?php echo $status;?></div>
						
							
							
						
							
							
							
							</div>
							</div>
							
							<?php } ?>
							
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 
																					 </div>
																					<?php
																					}
																					?>
																			    
																			
																			
																			</td>
																			
																		 </tr>
																		
																		<?php
																		
																	}
																	
																   ?>
																  
																 
																  
																</tbody>
														
																
															 </table>
																<!--end-->
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
      <!-- end -->
   </div>
		</div>
</div>
   </div>
</div>


<script type="text/javascript">
   
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

</script>
 <style type="text/css">
 
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
   
   

		    
		    .video {    text-align: center;
    margin-top: -30px;
    height: 36px;
    border-radius: 4px;
    background-size: cover;
    position: relative;
    width: 41px;
    background-position: center;
    margin-bottom: 5px;     margin-left: 11px;} 
    
   
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



		
	
 
 