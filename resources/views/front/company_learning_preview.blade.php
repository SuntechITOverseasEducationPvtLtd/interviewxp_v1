<style>
    .scareer-form_03{display:none !important}

.scompany_learning_01{max-height:55px!important; width: 100%; !important }
.scompany_learning_02{color: #0BB76C !important;}
.scompany_learning_03{padding-top:0px !important; padding-left: 0px !important}
.scompany_learning_04{padding-top: 0px !important;
 padding-left: 58px !important; background: #0bb76c!important;
 margin-top: 2px !important;
    margin-left: -28px !important;
    width: 110% !important; }
.scompany_learning_05{padding-top: 13px !important; color:#fff !important}
.scompany_learning_06{padding: 66px 0px 0px 0px !important; margin:0px !important;}
.scompany_learning_07{position: absolute !important;
    z-index: 9999 !important;
    background: white !important;
 padding: 3px !important;
    border-radius: 10px !important;
    right: 0px !important;}
</style>


<script src="{{url('/')}}/assets/pdfviewer/build/pdf.js"></script>
		
@extends('front.layout.learning_preview')
@section('middle_content')
	<?php $obj_user  = Session::get('logged_in'); ?>
	<div class="col-sm-12 col-xs-12 top_banner navbar-preview" id="top_banner" data-uid="163744">
		<div class="pull-left scompany_learning_01">
			<button class="col-sm-1 col-xs-1 toc_toggle btn btn-transparent">
			  <i class="fa fa-bars"></i>
			</button>
			<div class="col-sm-9 col-xs-9 hidden-xs ff2">
				<div class="box_name">{{$skill_name }} Real Time Interview Questions & Answers ( 0-2 Year Exp )</div>
				<!-- <div class="box_name_sub"></div> -->
			</div>
			<div class="col-sm-2 col-xs-10 pdf-preview-header scareer-form_03" >
			  <span><button id="prev"><i class="fa fa-chevron-left scompany_learning_02" aria-hidden="true"></i></button></span>
			  <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page: <span id="page_num"></span> / <span id="page_count"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			  <span><button id="next"><i class="fa fa-chevron-right scompany_learning_02" aria-hidden="true"></i></button></span>	  
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
				
				<?php

				$NameCompany = DB::table('company_master')
							  ->where('company_id', '=', $company_id)
							  ->first();

				$topicName = ucwords($NameCompany->company_name).' ('.ucwords($previewData[0]->company_location).')';
				
				/*$results = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$interview_id."' AND company_id = '".$value->company_id."'") );*/
				//print_r($results); die;
				?>
				<div class="section section-title"><strong>{{ $topicName }}</strong></div>
				@if($previewData)
				@foreach($previewData as $key=>$value)
				<?php
					if($value->file_extension =='Pdf'){
					 $icon='<i class="fa fa-file-pdf-o"></i>';
					 $href='#home'.$value->id;
					 $dataId=$value->id;
					}else if($value->file_extension =='Video'){
					 $icon='<i class="fa fa-play"></i>';
					 $href='#video'.$value->id;
					 $dataId=$value->id;
					}else{
					 $icon="&nbsp;&nbsp;&nbsp;&nbsp;";
					 $href='#';
					 $dataId="";
					}

					if($value->freePreview =='Yes') 
					{
						if($is_active)
						{
							$topicActive = 'topic_active on';
							$is_active = false;
						}
						else
						{
							$topicActive = 'topic_active';
						}

						$mul_reference_book = $value->attachment;
						
					}else
					{
						$topicActive = 'disabled';
						$mul_reference_book = '';
					}
				?>
				
				
				<div class="box preview_item {{$topicActive}}" data-id="{{$mul_reference_book}}" id="{{$mul_reference_book}}" attrid="{{$value->file_extension}}" data-type="{{$value->file_extension}}">
				
				
			        <!-- <div class="col-sm-1 col-xs-2 box_status_icon" title="Video" alt="Video">{!!$icon !!}</div> -->
			        <div class="col-sm-12 col-xs-12 scompany_learning_03">
			          <a class="title fc7 col-sm-9 col-xs-10" href="#"  title="{{$value->roundType}}"><span><?php echo $icon ?> &nbsp;&nbsp; <span class="preview_item_txt">{{$value->roundType}}</span></span></a>	
			          <div class="duration pull-right">{{($value->pageCount == '1 Pages') ? '1 Page' : $value->pageCount}}</div>        
			        </div>
		      	</div>
		      	
		      	
		      	
		      				          
 <?php $results1s = DB::select( DB::raw("SELECT * FROM interview_detail WHERE subid = '".$value->id."' AND `approve_status`='1'  ORDER BY  `id` DESC") );	

    foreach ($results1s as $key1s=>$user1s) { 
			
			$videoID=explode('?v=',$user1s->roundType);
							
						
						 
							  	if($user1s->freePreview =='Yes') 
					{ $topicActivedd = '1';
					    
					} else { $topicActivedd="0.2"; }
							
							 
							 
						?>
			          
			          
			             <div class="col-sm-12 col-xs-12 scompany_learning_04" style="opacity: {{$topicActivedd}}">
			            <?php if(isset($videoID[1])) { ?>
              <div class="video" style="background-image:url('https://img.youtube.com/vi/{{$videoID[1]}}/0.jpg')">
                  
                  
                          <?php 	if($topicActivedd =='1') { ?>
				
					   
                            <a data-toggle="modal" href="#videoplayintro" class="videoidtake text-center" id="{{$videoID[1]}}"> 
                            
                            <?php } else { ?>
                            
                             <a  class="text-center"> 
                            
                            <?php } ?>
  
  <img src="{{url('/')}}/images/icon-play.svg" class="img-zoom"  style=" float: none;"></a>
  
  
     
     </div>
     
     <?php } ?> 	
			          <div class="duration pull-right scompany_learning_05"><?php echo round($user1s->fileSize/60) ?> Min. </div></div>
			          
			          
			          <?php } ?>
			          
			          
			          
			          
				@endforeach
				@endif		      	
			</div>
		</div>
	</div>
	<div class="col-sm-9 col-xs-12 preview_wrapper" style="padding: 0px;">
		<div class="preview_body scompany_learning_06">
		    
		    
			
		
		
		
		<div id="main_loading scareer-form_03" style="display: none;"><div class="course_access_denied">This resource can be accessed only after you buy this meterial</div></div>	
		
<div class="pdfview"></div>
	
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
	
	
	<script>
$(document).ready(function(){
  
    
    
    $extension=$('.topic_active').attr('attrId');
   
     $pdfvaluee=$('.topic_active').attr('id');
     
     
    if($extension=='Video'){
        

 
  $('.pdfview').load('http://interviewxp.com/videoplayer/index_company.php?video='+$pdfvaluee)
 
    } 
    
    
    else {
        
       
 $('.pdfview').load('http://interviewxp.com/pdfviewers/pdfframe_compnay.php?pdf='+$pdfvaluee)
    }
 
    $(".topic_active ").click(function(){
        
         $('.pdfview').css('display','block');
 
  $('#main_loading').css('display','none')
  
  
 
 $pdfvaluee=$(this).attr('id');
 
 
     
    $extension=$(this).attr('attrId');
   
    
     
     
    if($extension=='Video'){
        

 
  $('.pdfview').load('http://interviewxp.com/videoplayer/index_company.php?video='+$pdfvaluee)
 
    } 
    
    
    else {
        
       
 $('.pdfview').load('http://interviewxp.com/pdfviewers/pdfframe_compnay.php?pdf='+$pdfvaluee)
    }

 
 
 
    });
    
    
       $(".disabled ").click(function(){
 
 
 
 $('.pdfview').css('display','none');
 $('.pdfview').html('');
 
  $('#main_loading').css('display','block')
 
    });
    
    
    
    
    
    
});
</script>


   <script type="text/javascript">
$(document).ready(function(){
    
   $(document).on('click', '.videoidtake', function() {  
       
       $idvalue=$(this).attr('id');  
       
      
   
   
        
       $('.videouploadidhere').html('<iframe width="100%" height="315" src="https://www.youtube.com/embed/'+$idvalue+'?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" ></iframe>');
       
   });
   
   
   
   
   $(document).on('click', '.close', function() {   $('.videouploadidhere').html(''); });
   
   
});
  
  
    </script>
    
    
<div class="modal fade popup-cls in" id="videoplayintro" role="dialog" aria-hidden="false" tabindex="-1" style="    margin-top: 40px !important;" >
				  <div class="modal-dialog">
					 <div class="modal-content">
					
					
					  <button type="button" class="close scompany_learning_07" data-dismiss="modal">
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
		

			$(function() {
	

			    $user_session = "{{$obj_user}}";
			   
			    if($user_session == '')
			    {
			    	//$("#userLoginFormModal").modal('show');
			    	$('#userLoginFormModal').modal({backdrop: 'static', keyboard: false}, 'show');
			    }
			});			    


		</script>



<script type="text/javascript"> 
function disableselect(e){  
return false  
}  

function reEnable(){  
return true  
}  

//if IE4+  
document.onselectstart=new Function ("return false")  
document.oncontextmenu=new Function ("return false")  
//if NS6  
if (window.sidebar){  
document.onmousedown=disableselect  
document.onclick=reEnable  
}


window.onbeforeunload = function () {//Prevent Ctrl+W
    return "Really want to quit the game?";
};

document.onkeydown = function (e) {
    e = e || window.event;//Get event
    if (e.ctrlKey) {
        var c = e.which || e.keyCode;//Get key code
        switch (c) {
            case 83://Block Ctrl+S
            case 87://Block Ctrl+W --Not work in Chrome
                e.preventDefault();     
                e.stopPropagation();
            break;
        }
    }
};
</script>

<script>
document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 85 ||
             e.keyCode === 115 ||
             e.keyCode === 83 ||
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
};
$(document).keypress("u",function(e) {
  if(e.ctrlKey)
  {
return false;
}
else
{
return true;
}
});
</script>

<script type="text/javascript">
$(document).ready(function () {
    //Disable cut copy paste
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
   
    //Disable mouse right click
    $("body").on("contextmenu",function(e){
        return false;
    });
});
</script>

<script language="javascript">
document.onmousedown=disableclick;
status="Right Click Disabled";
Function disableclick(e)
{
  if(event.button==2)
   {
     alert(status);
     return false;	
   }
}
</script>


@endsection

