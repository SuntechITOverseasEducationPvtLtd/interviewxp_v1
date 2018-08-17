<script src="{{url('/')}}/assets/pdfviewer/build/pdf.js"></script>
		
@extends('front.layout.learning_preview')
@section('middle_content')
	<?php $obj_user  = Session::get('logged_in'); ?>
	<div class="col-sm-12 col-xs-12 top_banner navbar-preview" id="top_banner" data-uid="163744">
		<div class="pull-left" style="max-height:55px;width: 100%;">
			<button class="col-sm-1 col-xs-1 toc_toggle btn btn-transparent">
			  <i class="fa fa-bars"></i>
			</button>
			<div class="col-sm-9 col-xs-9 hidden-xs ff2">
				<div class="box_name">{{$skill_name }} Real Time Interview Questions & Answers ( 0-2 Year Exp )</div>
				<!-- <div class="box_name_sub"></div> -->
			</div>
			<div class="col-sm-2 col-xs-10 pdf-preview-header" style="display: none">
			  <span><button id="prev"><i class="fa fa-chevron-left" aria-hidden="true" style="color: #0BB76C"></i></button></span>
			  <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page: <span id="page_num"></span> / <span id="page_count"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			  <span><button id="next"><i class="fa fa-chevron-right" aria-hidden="true" style="color: #0BB76C"></i></button></span>	  
			</div>
			<!-- <div class="col-sm-2 pull-right learn_buy_btn">              
				<div class="preview_join_group">
					<button class="btn btn-10 buy-btn pull-right" title="Buy Now">Buy Now</button>
				</div>
            </div> -->
		</div>
	</div>
	<div class="col-sm-3 col-xs-3">
		<div class="row preview_topics bc4" id="preview_topics" data-first-load="1" style="min-height: 609px;">
			<div class="section_wrapper">
				<?php $is_active =true; ?>
				@if(isset($arr_transaction['member_interview_info']) && sizeof($arr_transaction['member_interview_info'])>0) 
                @if($arr_transaction['purchase_history'][0]['reference_book'] == 'Yes') 
                @if(isset($arr_transaction['multi_ref_book']) && sizeof($arr_transaction['multi_ref_book'])>0)
                <?php
                	$previewData = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$arr_transaction['ref_interview_id']."' group by topic_name") );
                	
                ?>

				@foreach($previewData as $key=>$value)
				<?php
				$interview_id = $value->interview_id;
				$topicName = ucwords($value->topic_name);
				
				$results = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$interview_id."' AND topic_name = '".$value->topic_name."'") );
				?>
				<div class="section section-title"><strong>{{ $topicName }}</strong></div>
				
				@if($results)
				@foreach($results as $key=>$values)
				<?php
					if($values->file_extension =='Pdf'){
					 $icon='<i class="fa fa-file-pdf-o"></i>';
					 $href='#home'.$values->id;
					 $dataId=$values->id;
					}else if($values->file_extension =='Video'){
					 $icon='<i class="fa fa-play"></i>';
					 $href='#video'.$values->id;
					 $dataId=$values->id;
					}else{
					 $icon="&nbsp;&nbsp;&nbsp;&nbsp;";
					 $href='#';
					 $dataId="";
					}

					if($is_active)
					{
						$topicActive = 'topic_active on';
						$is_active = false;
					}
					else
					{
						$topicActive = 'topic_active';
					}

					
					$mul_reference_book = $values->mul_reference_book;
				?>
				<div class="box preview_item {{$topicActive}}" data-id="{{$mul_reference_book}}" data-type="{{$values->file_extension}}">
			        <!-- <div class="col-sm-1 col-xs-2 box_status_icon" title="Video" alt="Video">{!!$icon !!}</div> -->
			        <div class="col-sm-12 col-xs-12" style="padding-top:10px;padding-left: 0px">
			          <a class="title fc7 col-sm-9 col-xs-10" href="#" style="" title="Part {{$key+1}}"><span><?php echo $icon ?> &nbsp;&nbsp; <span class="preview_item_txt">Part {{$key+1}}</span> </span></a>	
			          <div class="duration pull-right">{!! ($values->pageCount == '1 Pages') ? '1 Page' : $values->pageCount !!}</div></div>
		      	</div>
		      	@endforeach
				@endif
				@endforeach
				@endif	
				@endif
				@endif	      	
			</div>
		</div>
	</div>
	<div class="col-sm-9 col-xs-12 preview_wrapper">
		<div class="preview_body">
		<div class="tab-panel-video" style="display: none"> 
			<video width= '100%' height= '500'  controls>
			  <source src="" type="video/mp4" id="source-src">
			Your browser does not support the video tag.
			</video>
		</div>	
		<div id="main_loading" style="display: none;"><div class="course_access_denied">This resource can be accessed only after you buy this meterial</div></div>	

		<canvas id="the-canvas"></canvas>
		<!-- <embed src="{{url('/')}}/uploads/refrence_book/8f9e5d3ad2ab1ccc78e229bc1d9e44c373ddece9.pdf"  type="application/pdf" width= '100%' height= '600'> -->
		<script type="text/javascript">
			var pdfDoc = null;
			var isOnload = true;
			var dataId ='';

			$(document).ready(function(){
			 $(document).bind("contextmenu",function(e){
			   //return false;
			 });
			});

			$(function() {
			    dataId = $(".preview_item.on").attr('data-id');
			    dataType = $(".preview_item.on").attr('data-type');
			    
			    $(".topic_active.on").click();

			    $user_session = "{{$obj_user}}";
			   
			    if($user_session == '')
			    {
			    	//$("#userLoginFormModal").modal('show');
			    	$('#userLoginFormModal').modal({backdrop: 'static', keyboard: false}, 'show');
			    }
			});			    

			$(".preview_item, .topic_active.on").on("click", function (event) { 
				// If absolute URL from the remote server is provided, configure the CORS
				if(isOnload == false)
				{				
					dataId = $(this).attr('data-id');
					dataType = $(this).attr('data-type');
				}				

				if(dataId && dataType == 'Pdf')
				{
					if(isOnload == false)
					{
						$(".preview_item").removeClass('on');
						$(this).addClass('on');
					}
					isOnload = false;					
					
					// header on that server.
					var url = "{{url('/')}}/uploads/refrence_book/"+dataId;
					var pageNum = 1;

					$('.pdf-preview-header').show();
					$('#main_loading').hide();
					$('.tab-panel-video').hide();
					
					var preview_item_txt = $(this).prevAll('.section').children('strong').html()+' : '+ $(this).find('.preview_item_txt').html();
					//$('.box_name_sub').html(preview_item_txt);
					
					var pageRendering = false,
				    pageNumPending = null,
				    scale = 1.33,
				    canvas = document.getElementById('the-canvas'),
				    ctx = canvas.getContext('2d');

					/**
					 * Get page info from document, resize canvas accordingly, and render page.
					 * @param num Page number.
					 */
					function renderPage(num) {
					 
					  pdfDoc.getPage(num).then(function(page) {
					    var viewport = page.getViewport(785 / page.getViewport(1.0).width);
					    canvas.height = viewport.height;
					    canvas.width = viewport.width;

					    $(".preview_wrapper").css({'height':(canvas.height+220)+'px','background': 'rgb(82, 86, 89)' });
					   
					    // Render PDF page into canvas context
					    var renderContext = {
					      canvasContext: ctx,
					      viewport: viewport
					    };
					    var renderTask = page.render(renderContext);

					    // Wait for rendering to finish
					    renderTask.promise.then(function() {
					      pageRendering = false;
					      if (pageNumPending !== null) {
					        // New page rendering is pending
					        //renderPage(pageNumPending);
					        pageNumPending = null;
					      }
					    });
					  });

					  // Update page counters
					  document.getElementById('page_num').textContent = pageNum;
					}

					/**
					 * If another page rendering in progress, waits until the rendering is
					 * finised. Otherwise, executes rendering immediately.
					 */
					function queueRenderPage(num) {
					  if (pageRendering) {
					    pageNumPending = num;
					  } else {
					    renderPage(num);
					  }
					}

					/**
					 * Displays previous page.
					 */
					function onPrevPage() {				
					  if (pageNum <= 1) {
					    return;
					  }
					  pageNum--;
					  queueRenderPage(pageNum);
					}
					document.getElementById('prev').addEventListener('click', onPrevPage);

					/**
					 * Displays next page.
					 */
					function onNextPage() {
					  if (pageNum >= pdfDoc.numPages) {
					    return;
					  }
					  pageNum++;
					  queueRenderPage(pageNum);
					}
					document.getElementById('next').addEventListener('click', onNextPage);

					/**
					 * Asynchronously downloads PDF.
					 */
					PDFJS.getDocument(url).then(function(pdfDoc_) {
					  pdfDoc = pdfDoc_;

					  document.getElementById('page_count').textContent = pdfDoc.numPages;
					  // Initial/first page rendering
					  renderPage(pageNum);
					});

				}
				else if(dataId && dataType == 'Video')
				{
					$('canvas').remove();
					$('.preview_body').append('<canvas id="the-canvas"></canvas>');
					var url = "{{url('/')}}/uploads/refrence_book/"+dataId;
					$('.tab-panel-video').show();
					$('#main_loading').hide();
					$('.pdf-preview-header').hide();
					$('#source-src').attr('src', url);
					$(".tab-panel-video video")[0].load();
					$(".preview_item").removeClass('on');
					$(this).addClass('on');
					$(".preview_wrapper").css({'height':'auto','background': 'rgb(82, 86, 89)'});
					var preview_item_txt = $(this).prevAll('.section').children('strong').html()+' : '+ $(this).find('.preview_item_txt').html();
					//$('.box_name_sub').html(preview_item_txt);
				}
				else{
					$(".preview_wrapper").css({'height':''});
					$('canvas').remove();
					$('.preview_body').append('<canvas id="the-canvas"></canvas>');
					$('#main_loading').show();
					$('.tab-panel-video').hide();
					$('.pdf-preview-header').hide();
					$(".preview_item").removeClass('on');
					$(".preview_wrapper").css({'height':$(window).height(),'background': '#000' });
					var preview_item_txt = $(this).prevAll('.section').children('strong').html()+' : '+ $(this).find('.preview_item_txt').html();
					//$('.box_name_sub').html(preview_item_txt);
				}	

		});

		$(".toc_toggle").on("click", function (event) {
			$(".preview_topics, .preview_wrapper").toggleClass('topics_close');
		});	

		</script>		
		</div>
	</div>	
	<div class="modal fade" id="userLoginFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">	     
	      <div class="modal-body">
	        	<div class="user-login-form">
                  <div class="col-xs-12">                  		
                     <div class="login-box" style="margin: auto">
                     	<ul class="nav nav-tabs">
						  <li class="active"><a data-toggle="tab" href="#user">User</a></li>
						  <li><a data-toggle="tab" href="#member">Member</a></li>
						</ul>
						<div class="tab-content">
  							<div id="user" class="tab-pane fade in active">
		                        <h3>User Login</h3>
		                        <img src="{{url('/')}}/images/bag-login.png" alt="Interviewxp" class="center-block"/>
		                        @include('front.layout._operation_status')
		                        <form action="{{url('/user/login_process')}}" method="POST" id="frm_user_login" id="frm_user_login">
		                        {{ csrf_field() }}
		                           <div class="form-group">
		                              <label for="email">Email:</label>
		                              <input type="email" name="email" class="input-box-login" data-rule-required='true'
		                              data-rule-email='true' />
		                              <input type="hidden" name="preview-page" value="1" />
		                               <div class="error">{{ $errors->first('email') }}</div>
		                           </div>
		                           <div class="form-group">
		                              <label for="pwd">Password:</label>
		                              <input type="password" data-rule-required='true' class="input-box-login" name="password" />
		                               
		                              <div class="error">{{ $errors->first('password') }}</div>
		                           </div>
		                           <div class="checkbox"><input name="remember" value="remember" type="checkbox"/> Remember me</div>
		                           <div class="forget"><a href="{{url('/user/forgot_password')}}">Forgot Password?</a></div>
		                           <div class="clr">&nbsp;</div><button type="submit" class="login-button">Login</button>
		                           <div class="account">
		                              <div class="dont-account">Dont have an account?</div>
		                              <div class="register"><a href="{{url('/user/register')}}">Register here</a></div>
		                           </div>
		                        </form>
	                        </div>
	                        <div id="member" class="tab-pane fade in">
		                        <h3>Member Login</h3>
		                        <img src="{{url('/')}}/images/bag-login.png" alt="Interviewxp" class="center-block"/>
		                        @include('front.layout._operation_status')
		                        
		                        <form action="{{url('/member/login_process')}}" method="POST" id="frm_member_login" >
		                        {{ csrf_field() }}
		                           <div class="form-group">
		                              <label for="email">Email:</label>
		                              <input type="email" name="email" data-rule-required='true'
		                              data-rule-email='true' class="input-box-login" id="email"/>
		                               <input type="hidden" name="preview-page" value="1" />
		                              
		                               <div class="error">{{ $errors->first('email') }}</div>
		                           </div>
		                           <div class="form-group">
		                              <label for="pwd">Password:</label>
		                              <input type="password" name="password" data-rule-required='true' class="input-box-login" id="pwd"/>
		                              <div class="error">{{ $errors->first('password') }}</div>
		                              
		                           </div>
		                           <div class="checkbox"><input name="remember" value="remember" type="checkbox"/> Remember me</div>
		                           <div class="forget"><a href="{{url('/member/forgot_password_member')}}">Forgot Password?</a></div>
		                           <div class="clr">&nbsp;</div><button type="submit" class="login-button" value="Login">Login</button>
		                           <div class="account">
		                              <div class="dont-account">Dont have an account?</div>
		                              <div class="register"><a href="{{url('/member/register')}}">Register here</a></div>
		                           </div>
		                        </form>
	                        </div>
                        </div>
                     </div>
                  </div>
		      </div>
	      </div>      
	    </div>
	  </div>
	</div> 
	<style type="text/css">
		.modal.fade.in {
		    top: 14%;
		}
		.modal-body {
    		padding: 0px; 
		}
	</style>

@endsection

