@extends('front.layout.main') @section('middle_content')
<style>
.tabs-left, .tabs-right {
  border-bottom: none;
  padding-top: 2px;
}

.tabs-left>li, .tabs-right>li {
  float: none;
  margin-bottom: 2px;
}
.tabs-left>li {
  margin-right: -1px;
}

.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
    border: none;
	background-color: #17b0a4;
	color:#fff;
	padding:6px;
}
.tabs-left>li>a {
  border-radius: 4px 0 0 4px;
  margin-right: 0;
  display:block;
  color:#000;
}



.sfree_preview_01{min-height:500px !important; border: 1px solid #ddd;}
.sfree_preview_02{min-height:500px !important; padding-left: 0px !important;}
.sfree_preview_03{padding-left: 0px !important;}
.sfree_preview_04{min-height:500px !important;}
.sfree_preview_05{width:100% !important;}
.sfree_preview_06{min-height:300px!important; border: 1px solid #ddd!important;}
.sfree_preview_07{min-height:300px!important; padding-left: 0px !important;}
</style>

<div id="after-login-header" class="after-login"></div>
<div class="banner-member">
    <div class="pattern-member">
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="middle-section min-height">
                <div class="user-dashbord">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="middle part">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <h2 class="my-profile">{{$module_title}}</h2>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="icon-w">
                                            <a href="{{url('/user/learn')}}" class="green-back m-right">Back</i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pdf-slides">
                                    <div class="row">
                                        <div class="col-sm-12">
											<?php
											if($book=='Book'){
											?>
                                            <div class="table-search-pati section1-tab">
												<div class="row sfree_preview_01">
													<div  class="col-sm-12 sfree_preview_02" >
														<div class="col-sm-3 sfree_preview_02" >
															<!-- required for floating -->
															<!-- Nav tabs -->
														<ul class="nav nav-tabs tabs-left sfree_preview_02 sfree_preview_01" >
													  <?php
													   $results = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$interviewId."' group by topic_name") );
														foreach ($results as $key=>$user) {
															$string = ucwords(strtolower(mb_strimwidth($user->topic_name, 0, 30, '...')));
															?>
																<li title="{{$user->topic_name}}" style="border-bottom:1px solid #ccc; padding:10px; cursor:pointer"><b>{{$key+1}} . {{$string}}</b>
																<?php
																   $results1 = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$interviewId."' AND topic_name = '".$user->topic_name."'") );
																	foreach ($results1 as $key1=>$user1) {
																		 if($user1->file_extension =='Pdf'){
																			 $icon='<i class="fa fa-file-pdf-o"></i>';
																			 $href='#home'.$user1->id;
																			 $dataId=$user1->id;
																		 }else if($user1->file_extension =='Video'){
																			 $icon='<i class="fa fa-play"></i>';
																			 $href='#video'.$user1->id;
																			 $dataId=$user1->id;
																		 }else{
																			 $icon="&nbsp;&nbsp;&nbsp;&nbsp;";
																			 $href='#';
																			 $dataId="";
																		 }
																		 
																?>
																	<ul class="nav nav-tabs tabs-left sfree_preview_03" ><li> <a href="{{$href}}" attrId={{$dataId}} data-toggle="tab"><span><?php echo $icon ?> &nbsp;&nbsp; Part {{$key1+1}} </span>
																	<span style="float:right;">{{$user1->pageCount}}</span></li></a></ul>
																<?php
																	}
																	?>
																</li>
															<?php
														}
													   ?>
													   </ul>
													
														</div>
														<div class="col-sm-9 sfree_preview_04" >
															<!-- Tab panes -->
															<div class="tab-content">
															<?php
														   $results = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$interviewId."' group by topic_name") );
															foreach ($results as $key=>$user) {
															   $results1 = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$interviewId."' AND topic_name = '".$user->topic_name."'") );
																foreach ($results1 as $key1=>$user1) {
																	
																	if(isset($user1->mul_reference_book) AND $user1->freePreview =='Yes'){
																		$bookPdf=$user1->mul_reference_book;
																		?>
																		<div class="tab-pane" id="home{{$user1->id}}"> 
																			<embed src="{{url('/')}}/uploads/refrence_book/{{$bookPdf}}"  type="application/pdf" width= '100%' height= '600'>
																		</div>
																		<div class="tab-pane" id="video{{$user1->id}}"> 
																			<video width= '100%' height= '500'  controls>
																			  <source src="{{url('/')}}/uploads/refrence_book/{{$user1->mul_reference_book}}" type="video/mp4">
																			Your browser does not support the video tag.
																			</video>
																		</div>
																		<?php
																	}else{
																	?>
																	<div class="tab-pane" id="home{{$user1->id}}"> 
																		<img class="sfree_preview_05" src="{{url('/')}}/uploads/no.jpg">
																	</div>
																	<div class="tab-pane" id="video{{$user1->id}}"> 
																		<img class="sfree_preview_05" src="{{url('/')}}/uploads/no.jpg">
																	</div>
																	<?php
																	}
																}
															}
														   ?>
																
																
															</div>
														</div>

														<div class="clearfix"></div>
													</div>
												</div>
												<br/>
                                            </div>
											<!-- tickets -->
											<?php
											}
											if($book=='Real'){
												?>
												<div class="table-search-pati section1-tab">
													<div class="row sfree_preview_06">
														<div  class="col-sm-12 sfree_preview_07" >
															<div class="col-sm-3 sfree_preview_07" >
																<!-- required for floating -->
																<!-- Nav tabs -->
															<ul class="nav nav-tabs tabs-left sfree_preview_02" style="overflow:auto;">

														  <?php
															$results = DB::select( DB::raw("SELECT * FROM member_real_time_experience WHERE interview_id = '".$interviewId."' AND freePreview='Yes'") );
																foreach ($results as $key=>$user) {
																		$title=$user->issue_title;
																		if(strlen($title) > 10)
																			$name=substr($user->issue_title,0,10).'...';
																		else
																			$name=$title;
																		if($user->file_extension =='Pdf'){
																			 $icon='<i class="fa fa-file-pdf-o"></i>';
																			 $href='#home'.$user->id;
																		 }else if($user->file_extension =='Video'){
																			 $icon='<i class="fa fa-play"></i>';
																			 $href='#video'.$user->id;
																		 }else{
																			 $icon="&nbsp;&nbsp;&nbsp;&nbsp;";
																			 $href='#';
																		 }
																		 ?>
																		 
																		<li title="{{$title}}" class="sfree_preview_05"> 
																			<a href="{{$href}}"  data-toggle="tab">
																			<span><?php echo $icon;?> &nbsp;&nbsp; {{$name}} </span>
																			<span style="float:right">{{$user->pageCount}}</span></a></li>
																		<?php
																	}
																
															?>
														   </ul>
														
															</div>
															<div class="col-sm-9 sfree_preview_04"  >
																<!-- Tab panes -->
																<div class="tab-content">
																	<?php
																	$results1 = DB::select( DB::raw("SELECT * FROM member_real_time_experience WHERE interview_id = '".$interviewId."' AND freePreview='Yes'") );
																	foreach ($results1 as $key=>$ticket_attachment) {
																			?>
																			<div class="tab-pane" id="home{{$ticket_attachment->id}}"> 
																				<embed src="{{url('/')}}/uploads/real_time_attachment/{{$ticket_attachment->attachment}}"  type="application/pdf" width= '100%' height= '600'>
																			</div>
																			<div class="tab-pane" id="video{{$ticket_attachment->id}}"> 
																				<video width= '100%' height= '500'  controls>
																				  <source src="{{url('/')}}/uploads/real_time_attachment/{{$ticket_attachment->attachment}}" type="video/mp4">
																				Your browser does not support the video tag.
																				</video>
																			</div>
																	<?php
																		}
																	?>
																	
																</div>
															</div>

															<div class="clearfix"></div>
														</div>
													</div>
												</div>
												<?php
											}
											?>
											<!-- tcikets end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="sample-img2"><img src="images/sample-img3.jpg" class="img-responsive" alt="Interviewxp"/></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $('.main-content > .arrow').click(function() {
        $(this).parent().next('.sub-content').slideToggle();
        $(this).find('.arrow i').toggleClass('fa-chevron-down fa-chevron-up')
    });
</script>
<script>
    $("tr:even").css("background-color", "#eeeeee");
    $("tr:odd").css("background-color", "#fff");
</script>
<!--footer section-->
<script type="text/javascript">
    function reference_book_generation(reference_book_name) 
    {
        iframe = $('#frame-');
        window.location.reload();
        iframe.attr('src', '{{url('/')}}/MainViewerJS/#../uploads/refrence_book/'+reference_book_name);
    }
	function getPDFvIDEO(id)
   {
      var link             = "{{ url('/member/getPDFandVideo') }}";
      var id = id; 
   
      var form_data = new FormData();
      form_data.append('id',id);
	  
      jQuery.ajax({
	   url:link,
	   type:'post',
	   dataType:'json',
	   data:form_data,
	   processData:false,
	   contentType:false,
	   //alert(form_data);
	   beforeSend:function()
	   {
		 alert(id);
	   },
	   success:function(response)
	   {

		   if(response.status=="success")
		   {
			  alert("if");
			  alert(response.msg);
			  
		   }else{
			   alert("else");
		   }
			  
	   } 
	  });    
   
          
    }; 
      
</script>
@endsection


