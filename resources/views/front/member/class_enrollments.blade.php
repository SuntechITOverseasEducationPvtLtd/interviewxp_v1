@extends('front.layout.main')
@section('middle_content')
<div id="member-header" class="after-login"></div>
	<div class="banner-member">
	   <div class="pattern-member">
	   </div>
	</div>
	<div class="container-fluid fix-left-bar">
	   <div class="row">
	      @include('front.member.member_sidebar') 
	    </div>
	</div>      
@endsection