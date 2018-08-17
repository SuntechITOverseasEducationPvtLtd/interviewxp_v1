@extends('front.layout.main') @section('middle_content')
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
                                    <div class="col-xs-8 col-sm-9 col-md-9 col-lg-10">
                                        <h2 class="my-profile">{{$module_title}}</h2>
                                    </div>
                                    <div class="col-xs-4 col-sm-3 col-md-3 col-lg-2">
                                        <div class="cont">
                                            <a href="{{url('/member/learn')}}" class="green-back m-r-0">Back</i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pdf-slides">
                                    <div class="row">
                                        <div class="col-sm-12">
                                                
                                            @if(isset($arr_transaction['purchase_history']) && sizeof($arr_transaction['purchase_history'])>0)
                                             @if($interview_count_arr!=0)
                                             
                                            <div class="table-search-pati section1-tab">
                                                <div class="row">
                                                   <div class="content-d">
                                                    <table class="col-xs-12 col-sm-3 col-md-3 col-lg-2 slides-s">

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
                                                    </div>
                                                </div>
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


