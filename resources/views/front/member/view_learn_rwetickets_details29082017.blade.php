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
                                                
                                            @if(isset($arr_transaction['ticket_details']) && sizeof($arr_transaction['ticket_details'])>0 )   
                                            <div class="table-search-pati section1-tab">
                                                <div class="row">
                                                   <div class="content-d">
                                                    <table class="col-xs-12 col-sm-3 col-md-3 col-lg-2 slides-s">

                                                       {{--  <thead>
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
                                                </div>
                                            </div>

                                           @endif 
                                            
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
        /*document.getElementById('frame-').contentDocument.location.reload(true);*/
        iframe.attr('src', '{{url('/')}}/MainViewerJS/#../uploads/real_time_attachment/'+real_time_tickets);
    }  
</script>
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery.mCustomScrollbar.concat.min.js"></script>
 <script type="text/javascript">
         /*scrollbar start*/
     $(document).ready(function(){
         $(window).on("load",function(){
         $.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
         $.mCustomScrollbar.defaults.axis="yx"; //enable 2 axis scrollbars by default
         
        $(".content-d").mCustomScrollbar({theme:"dark"});
            alert('I ama here');
            return false;
             
         }); 
     });
    
      </script>
@endsection


