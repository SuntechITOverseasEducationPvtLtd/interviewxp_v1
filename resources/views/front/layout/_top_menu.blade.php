<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="" />
      <meta name="keywords" content="" />
      <meta name="author" content="" />
      <!-- ======================================================================== -->
      <title>Interviewxp </title>
      <link rel="icon" href="{{url('/')}}/images/favicon.png" type="image/x-icon" />
      <!-- Bootstrap Core CSS -->
      <link href="{{url('/')}}/css/front/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <!-- main CSS -->
      <link href="{{url('/')}}/css/front/Interviewxp.css" rel="stylesheet" type="text/css" />
      <!--font-awesome-css-start-here-->
      <link href="{{url('/')}}/css/front/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery-1.11.3.min.js"></script>
      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery-validation/dist/jquery.validate.js"></script>
      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery-validation/dist/jquery.validate.min.js"></script>
      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery-validation/dist/additional-methods.js"></script>
      <script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery-validation/dist/additional-methods.min.js"></script>
      {{-- <div id="after-login-header" class="after-login"> --}}
      <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
         <?php $user=Sentinel::check();
            $id = $user['id'];
         ?>
         @if($user->inRole('user'))
         @include('front.layout.user_header')
          
         @elseif($user->inRole('member'))
         @include('front.layout.member_header')
         
      @endif     