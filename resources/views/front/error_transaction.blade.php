@extends('front.layout.main') 
@section('middle_content')
      <div class="banner-login">
         <div class="pattern-login">
            <div class="container">
               <div class="row">
                  <div class="col-md-7 error-box">
                      <div class="error-black-box">
                          <div class="error-logo"><img src="images/logo.png" alt="Interviewxp" /></div>
                          <h1>Error</h1>
                          <h2>Sorry transaction failed please try again.</h2>
                          <div class="back404"><a href="{{url('/')}}" class="back-to-home">Back to Home</a></div>
                      </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection
