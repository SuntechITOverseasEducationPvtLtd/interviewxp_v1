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
                                    <div class="col-xs-8">
                                        <h2 class="my-profile">{{$module_title}}</h2>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="icon-w">
                                            <a href="{{url('/member/learn')}}" class="green-back m-right">Back</i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="pdf-slides">
                                    <div class="row">
                                        <div class="col-sm-12">
    
                                            @if(isset($arr_transaction['member_interview_info']) && sizeof($arr_transaction['member_interview_info'])>0) 
                                            @if($arr_transaction['purchase_history'][0]['reference_book'] == 'Yes') 
                                            @if(isset($arr_transaction['multi_ref_book']) && sizeof($arr_transaction['multi_ref_book'])>0)

                                            <div class="table-search-pati section1-tab">
                                                <div class="row">
                                                    <table class="col-xs-12 col-sm-3 col-md-3 col-lg-2 slides-s content-d">

                                                        <thead>
                                                            <tr class="top-strip-ta ble">
                                                                <td class="attact-head new_attachment">Attachment</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach($arr_transaction['multi_ref_book'] as $key => $ref_book)
                                                            @if($ref_book['updated_at']<$arr_transaction['created_at'])
                
                                                            <tr class="bg-clolr-table">
                                                                <td>
                                                                <button onclick="javascript: return reference_book_generation('{{$ref_book['mul_reference_book']}}')">
                                                                    <iframe class="remove_border" style="border:none" src="{{url('/')}}/ViewerJS/#../uploads/refrence_book/{{$ref_book['mul_reference_book']}}" width="100%" height="150"></iframe>
                                                                    {{$ref_book['topic_name']}}
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                                                                <iframe id="frame-" src="{{url('/')}}/MainViewerJS/#../uploads/refrence_book/{{$arr_transaction['multi_ref_book'][0]['mul_reference_book']}}" allowfullscreen width="100%" height="500"></iframe>
                                                            </div>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            @endif @endif @endif 

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
        /*document.getElementById('frame-').contentDocument.location.reload(true);*/
        iframe.attr('src', '{{url('/')}}/MainViewerJS/#../uploads/refrence_book/'+reference_book_name);
    }
</script>

@endsection


