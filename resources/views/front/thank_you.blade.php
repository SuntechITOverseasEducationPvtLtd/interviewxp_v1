@extends('front.layout.main') 
@section('middle_content')
<div class="banner-login">
         <div class="pattern-login">
            <div class="container">
              
                 <div class="thanku-sec">
                    <div class="thanku-img"><img src="{{url('/')}}/images/Thank-you.png"/></div>
                   
                    <h1>Thank You</h1>
                    <h5 style="text-align:center;">Your transaction is successful! Thank You.</h5>
                    <?php
                    if(Session::has('logged_in'))
                    {
                        $user = Session::get('logged_in');    
                    }
                    ?>
                    @if(isset($user) && $user=='member')
                    <div class="back404"><a href="{{url('/member/purchase_history')}}" class="back-to-home">Back to Home</a></div>
                    @elseif(isset($user) && $user=='user')
                    <div class="back404"><a href="{{url('/user/purchase_history')}}" class="
                     back-to-home">Back to Home</a></div>
                    @else
                    <div class="back404"><a href="{{url('/')}}" class="
                     back-to-home">Back to Home</a></div>
                    @endif
                 </div>
            </div>
         </div>
      </div>
      <script type="text/javascript">
 
  (function (global, $) {

    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";
        global.setTimeout(function () 
        {
            global.location.href += "!";
        }, 50);
    };

    global.onhashchange = function () {
        if (global.location.hash != _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function () 
    {
        noBackPlease();
        // disables backspace on page except on input fields and textarea..
        $(document.body).keydown(function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which == 8 && (elm !== 'input' && elm  !== 'textarea')) 
            {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        });
    };
})(window, jQuery || window.jQuery);

  </script>
@endsection      