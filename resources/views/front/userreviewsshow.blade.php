@foreach($arr_review_rating as $data)
<?php
if($data['ReviewTypeID'] !='' AND $data['ReviewType'] == 'Company'){
	$NameCompany = DB::table('company_master')->where('company_id', '=', $data['ReviewTypeID'])->first();
	$CompanyLocation = DB::table('interview_detail')->where('company_id', '=', $data['ReviewTypeID'])->first();
	$NameC=$NameCompany->company_name;
	
	$Location=$CompanyLocation->company_location;
	if($data['ReviewType'] == 'Company'){
		$title=$NameC. "(".$Location.")";
	}else{
		$title=$data['ReviewTypeID'];
	}
}else{
	$title=$data['ReviewTypeID'];
}

//$profile_image = ($data['user_details']['profile_image'])? $data['user_details']['profile_image'] : 'user-rew.jpg';
$profile_image = 'default.jpg';


?>

<div class="row">
	<div class="col-sm-2 col-md-1 col-lg-1">
		<div class="user-bl user-review-icon">
			<i class="fa fa-user fa-3x img-responsive" aria-hidden="true"></i>
		</div>
	</div>
	<div class="col-sm-10 col-md-11 col-lg-11">
		<div class="review-bl">
			<div class="review">
				<h4 style="font-size: 15px;">{{ucfirst($data['user_details']['first_name'])}} {{$data['user_details']['last_name']}}</h4>
				<div class="star-wrapper" style="font-size: 12px;">
					@for($i=1;$i<=$data['review_star'];$i++)
					<img src="{{url('/')}}/images/star.png"/>
				@endfor          
				@for($i=$data['review_star'];$i<5;$i++)
					  <img src="{{url('/')}}/images/blank_star.png"/>
				@endfor
				 ( {{$title}} {{$data['ReviewType']}})
				</div>
				<p style="font-size: 13px;">{{substr($data['review_message'],0,300).'...'}}<span class="rev-date">{{date('d-M-Y',strtotime($data['created_at']))}}</span></p>                                                        
				<div class="clearfix"></div>
			</div>

			
		</div>
	</div>
</div>
@endforeach
 
 <?php if($page>$startid) { ?>
 <div class="prod-pagination" style="text-align: center;">
	<button data-purpose="show-more-review-button" type="button" class="btn btn-default ratingmore" id="{{$startid}}"><span style="color: #fc575c;">Show More Reviews</span></button>
	
	<?php  }?>
</div>

 