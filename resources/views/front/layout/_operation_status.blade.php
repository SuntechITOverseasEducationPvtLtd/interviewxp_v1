 <style>
     .soperation_01{margin-top: 0px !important;padding: 0px !important;}
    .soperation_02{margin-top: 0px !important;padding: 0px !important;}
    .soperation_03{margin-top: 0px !important;padding: 0px !important;}
 </style>
 
 @if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close soperation_01"  data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('flash_notification.message') }}
    </div>
@endif 

@if (Session::has('error'))
    <div class="alert alert-error">
        <button type="button" class="close soperation_02" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success">
        <button type="button" class="close soperation_03"  data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('success') }}
    </div>
@endif 

