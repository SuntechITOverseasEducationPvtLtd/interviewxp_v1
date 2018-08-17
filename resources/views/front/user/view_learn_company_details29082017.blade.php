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
								@foreach($arr_transaction['purchase_history'] as $company)
								@endforeach
                                <div class="pdf-slides">
                                    <div class="row">
                                        <div class="col-sm-12">
                                                
                                            @if(isset($arr_transaction['purchase_history']) && sizeof($arr_transaction['purchase_history'])>0)
                                             @if($interview_count_arr!=0)
                                            <div class="table-search-pati section1-tab">
												<div class="row" style="min-height:500px;border: 1px solid #ddd;">
													<div  class="col-sm-12" style="min-height:500px;padding-left: 0px !important;">
														<div class="col-sm-3" style="min-height:500px;padding-left: 0px !important;">
															<!-- required for floating -->
															<!-- Nav tabs -->
														<ul class="nav nav-tabs tabs-left" style="min-height:500px;padding-left: 0px !important;border-right: 1px solid #ddd;">
													  
                                                            @foreach($company['interview_attachment'] as $attachment)
															<?php
															$NameCompany = DB::table('company_master')
															  ->where('company_id', '=', $attachment['company_id'])
															  ->first();
														   $fullname=$NameCompany->company_name."( ".$attachment['company_location']." )";
														   $string = ucwords(strtolower(mb_strimwidth($fullname, 0, 30, '...')));
															?>
																<li title="{{$fullname}}" style="border-bottom:1px solid #ccc; padding:10px;line-height:30px;"><b>{{$string}}</b>
																<?php
																   $results1 = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$attachment['interview_id']."' AND company_id = '".$attachment['company_id']."'") );
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
																	<ul class="nav nav-tabs tabs-left" style="padding-left: 0px !important;"><li> <a href="{{$href}}" attrId={{$dataId}} data-toggle="tab"><span><?php echo $icon ?> &nbsp;&nbsp; Part {{$key1+1}} </span>
																	<span style="float:right;">{{$user1->pageCount}}</span></li></a></ul>
																<?php
																	}
																	?>
																</li>
															
														@endforeach
													   </ul>
													
														</div>
														<div class="col-sm-9"  style="min-height:500px;">
															<!-- Tab panes -->
															<div class="tab-content">
															<?php
														   $results = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$arr_transaction['ref_interview_id']."' group by company_id") );
															foreach ($results as $key=>$user) {
															   $results1 = DB::select( DB::raw("SELECT * FROM interview_detail WHERE interview_id = '".$arr_transaction['ref_interview_id']."' AND company_id = '".$user->company_id."'") );
																foreach ($results1 as $key1=>$user1) {
																	?>
																	<div class="tab-pane" id="home{{$user1->id}}"> 
																		<embed src="{{url('/')}}/uploads/company_attachment/{{$user1->attachment}}"  type="application/pdf" width= '100%' height= '600'>
																	</div>
																	<div class="tab-pane" id="video{{$user1->id}}"> 
																		<video width= '100%' height= '500'  controls>
																		  <source src="{{url('/')}}/uploads/company_attachment/{{$user1->attachment}}" type="video/mp4">
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
												<br/>
                                                <!--<div class="row">
                                                    <table class="col-xs-12 col-sm-3 col-md-3 col-lg-2">

                                                        <thead>
                                                            <tr class="top-strip-ta ble">
                                                                <td class="attact-head new_attachment">Attachment</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach($arr_transaction['purchase_history'] as $company)
                                                            @foreach($company['interview_attachment'] as $attachment)
                                                            <tr class="bg-clolr-table">
                                                                <td>
                                                                <button onclick="javascript: return company_pdf_generation('{{$attachment['attachment']}}')">
                                                                    <iframe class="remove_border" style="border:none" src="{{url('/')}}/ViewerJS/#../uploads/company_attachment/{{$attachment['attachment']}}" width="100%" height="150"></iframe>
                                                                    {{@$attachment['company_name']}}
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            @endforeach

                                                            @endforeach
                                                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                                                                <iframe id="frame-" src="{{url('/')}}/MainViewerJS/#../uploads/company_attachment/{{$arr_transaction['purchase_history'][0]['interview_attachment'][0]['attachment']}}" allowfullscreen width="100%" height="500"></iframe>
                                                            </div>
                                                        </tbody>
                                                    </table>
                                                </div>-->
                                            </div>

                                            
                                            @endif @endif

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

    function company_pdf_generation(company_attachment) 
    {
        iframe = $('#frame-');
        window.location.reload();
        iframe.attr('src', '{{url('/')}}/MainViewerJS/#../uploads/company_attachment/'+company_attachment);
    } 
</script>
@endsection


