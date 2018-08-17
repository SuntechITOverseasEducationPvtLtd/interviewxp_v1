@extends('front.layout.main') @section('middle_content')
<style>
.tabs-left, .tabs-right {
  border-bottom: none;
  padding-top: 2px;
}
.tabs-left {
  border-right: 1px solid #ddd;
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
}
.tabs-left>li>a {
  border-radius: 4px 0 0 4px;
  margin-right: 0;
  display:block;
  color:#000;
}
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
                                                
                                            @if(isset($arr_transaction['ticket_details']) && sizeof($arr_transaction['ticket_details'])>0 )  
											<div class="table-search-pati section1-tab">
												<div class="row" style="min-height:300px;border: 1px solid #ddd;">
													<div  class="col-sm-12" style="min-height:300px;padding-left: 0px !important;">
														<div class="col-sm-3" style="min-height:300px;padding-left: 0px !important;">
															<!-- required for floating -->
															<!-- Nav tabs -->
														<ul class="nav nav-tabs tabs-left" style="height:500px;padding-left: 0px !important;overflow:auto;">

													  <?php
                                                            foreach($arr_transaction['ticket_details'] as $ticket){
																foreach($ticket['rwe_details'] as $ticket_attachment){
																	$title=$ticket_attachment['issue_title'];
																	if(strlen($title) > 10)
																		$name=substr($ticket_attachment['issue_title'],0,10).'...';
																	else
																		$name=$title;
																	if($ticket_attachment['file_extension'] =='Pdf'){
																		 $icon='<i class="fa fa-file-pdf-o"></i>';
																		 $href='#home'.$ticket_attachment['id'];
																	 }else if($ticket_attachment['file_extension'] =='Video'){
																		 $icon='<i class="fa fa-play"></i>';
																		 $href='#video'.$ticket_attachment['id'];
																	 }else{
																		 $icon="&nbsp;&nbsp;&nbsp;&nbsp;";
																		 $href='#';
																	 }
																	 ?>
																	 
																	<li title="{{$title}}" style="width:100%"> 
																		<a href="{{$href}}"  data-toggle="tab">
																		<span><?php echo $icon;?> &nbsp;&nbsp; {{$name}} </span>
																		<span style="float:right">{{$ticket_attachment['pageCount']}}</span></a></li>
																	<?php
																}
															}
															
														?>
													   </ul>
													
														</div>
														<div class="col-sm-9"  style="min-height:500px;">
															<!-- Tab panes -->
															<div class="tab-content">
																<?php
																foreach($arr_transaction['ticket_details'] as $ticket){
																	foreach($ticket['rwe_details'] as $ticket_attachment){
																		?>
																		<div class="tab-pane" id="home{{$ticket_attachment['id']}}"> 
																			<embed src="{{url('/')}}/uploads/real_time_attachment/{{$ticket_attachment['attachment']}}"  type="application/pdf" width= '100%' height= '600'>
																		</div>
																		<div class="tab-pane" id="video{{$ticket_attachment['id']}}"> 
																			<video width= '100%' height= '500'  controls>
																			  <source src="{{url('/')}}/uploads/real_time_attachment/{{$ticket_attachment['attachment']}}" type="video/mp4">
																			Your browser does not support the video tag.
																			</video>
																		</div>
																<?php
																	}
																}
																?>
																
															</div>
														</div>

														<div class="clearfix"></div>
													</div>
												</div>
											</div>
                                            <!--<div class="table-search-pati section1-tab">
                                                <div class="row">
                                                    <table class="col-xs-12 col-sm-3 col-md-3 col-lg-2">

                                                        {{-- <thead>
                                                            <tr class="top-strip-ta ble">
                                                                <td class="attact-head new_attachment">Attachment</td>
                                                            </tr>
                                                        </thead> --}}
                                                        <tbody>

                                                            @foreach($arr_transaction['ticket_details'] as $ticket)
                                                            @foreach($ticket['rwe_details'] as $ticket_attachment)    
                                                            <tr class="bg-clolr-table">
                                                                <td>
                                                                <button onclick="javascript: return rwe_tickets_generation('{{$ticket_attachment['attachment']}}')">
                                                                    <iframe class="remove_border" style="border:none" src="{{url('/')}}/ViewerJS/#../uploads/real_time_attachment/{{$ticket_attachment['attachment']}}" width="100%" height="150"></iframe>
                                                                    {{$ticket_attachment['issue_title']}}
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            @endforeach
                                                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                                                                <iframe id="frame-" src="{{url('/')}}/MainViewerJS/#../uploads/real_time_attachment/{{$arr_transaction['ticket_details'][0]['rwe_details'][0]['attachment']}}" allowfullscreen width="100%" height="500"></iframe>
                                                            </div>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>-->
											@else
											<div class="table-responsive">
										{{ csrf_field() }}

									
												<br/>
												<table class="table" style="border: 1px solid #ccc;">
													<thead>
													<tr class="t-head">
														<td>Sl.No</td>
														<td>Checkbox</td>
														<td>Issue Title</td>
													</tr>
													</thead>
                                                    <tbody>
													<?php
													$memberId = DB::table('transaction')
																	  ->where('id', '=', $id)
																	  ->where('user_id', '=', $userid)
																	  ->first();
													$purchase_history = DB::table('purchase_history')
																	  ->where('interview_id', '=', $memberId->ref_interview_id)
																	  ->where('trans_id', '=', $id)
																	  ->first();
													//echo $memberId->member_user_id;

													$tickets = DB::select( DB::raw("SELECT * FROM `member_real_time_experience` WHERE `interview_id` = '".$memberId->ref_interview_id."' AND `experience_level` = '".$memberId->experience_level."' AND `skill_id` = '".$memberId->skill_id."' AND `user_id` = '".$memberId->member_user_id."' AND `approve_status`='1'") );
														foreach ($tickets as $key=>$ticketsList) {
															if($ticketsList->file_extension =='Pdf'){
																 $icon='<i class="fa fa-file-pdf-o"></i>';
																 $pages=$ticketsList->pageCount;
															 }else if($ticketsList->file_extension =='Video'){
																 $icon='<i class="fa fa-play"></i>';
																 $pages=$ticketsList->pageCount;
															 }else{
																 $icon="";
																 $pages="";
															 }
															?>
															<tr style="border: 1px solid #ccc;padding:80px;">
																<td style="background-color:#fff !important;padding: 20px;">{{$key+1}}.</td>
																<td style="background-color:#fff !important;padding: 20px;">
																	<div class="ticket_check">
																		<input  type="checkbox"  class="css-checkbox ads_Checkbox"
																			name="check_record[]"  
																			value="{{$ticketsList->id}}" id="{{$ticketsList->id}}" />
																		<label class="css-label radGroup2" for="{{$ticketsList->id}}">&nbsp;</label>
																	</div>
																</td>
																<td style="background-color:#fff !important;padding: 20px;">
																	<?php echo $icon; ?> &nbsp; {{$ticketsList->issue_title}} <span style="float:right"> <?php echo $pages; ?></span>
																</td>
															</tr>
															<?php
														}
													?>
													</tbody>
													<input type="hidden" id="unique" value="{{base64_encode($memberId->ref_interview_id)}}">
													<input type="hidden" id="limit" value="{{$purchase_history->ticket_name}}">
													<input type="hidden" id="ticket_unique_id" value="{{$memberId->ticket_unique_id}}">
												   @endif 
												  
												</table>
											</div>
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
    
    function rwe_tickets_generation(real_time_tickets) 
    {
        iframe = $('#frame-');
        window.location.reload();
        iframe.attr('src', '{{url('/')}}/MainViewerJS/#../uploads/real_time_attachment/'+real_time_tickets);
    }  
	$('.ticket_check').click(function () 
    {
        var check_record=$("input:checkbox[name='check_record[]']:checked").length;
        limit = $('#limit').val();
        if(check_record==limit)
        {
            $('#exceed_limit').html('');
            var result = confirm(' You have selected '+limit+' tickets! Are you sure you want submit?');
        }
        if(check_record>limit)
        {
            $('#exceed_limit').html('Your limit is exceeded.');
        }
        if(result)
        {
            var arr = $('input[name="check_record[]"]:checked').map(function(){
            return $(this).val();
            }).get();
            var link         = "{{ url('/purchased_tickets') }}";
            var _token       = $("input[name=_token]").val();
            var interview_id = $('#unique').val();
            var ticket_unique_id = $('#ticket_unique_id').val();
   
          var form_data = new FormData();
          form_data.append('_token',_token);
          form_data.append('arr_data',arr);
          form_data.append('id',interview_id);
          form_data.append('ticket_unique_id',ticket_unique_id);
   
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
                          },
                          success:function(response)
                          {
                            if(response.status=="success")
                              {
                                $('#ticket_unique_id').val(response.ticket_unique_id);
                                $('#modal-success-ticket').html(response.msg);
								alert(response.msg);
								location.reload();
                              }
                              if(response.status=="error")
                              {
                                /*alert('user not logged in');*/
                                 $('#modal-error-ticket').html(response.msg);
								 alert(response.msg);
								 location.reload();
                              }
                          } 
                         });   
        }
        
        
    });
</script>
@endsection


