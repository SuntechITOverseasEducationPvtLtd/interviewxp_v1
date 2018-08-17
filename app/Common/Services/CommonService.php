<?php

namespace App\Common\Services;
use App\Models\TransactionHistoryModel;
use App\Models\InterviewDetailModel;
use App\Models\ReviewRatingModel;
use App\Models\TransactionModel;

use DB;

class CommonService 
{
	public static function getCountry($country_id)
	{
		$countryDetails = DB::table('countries')->where('id',$country_id)->first();
		return $countryDetails->country_name;
	}

	public static function getState($state_id)
	{
		$stateDetails = DB::table('state')->where('id',$state_id)->first();
		return $stateDetails->state_name;
	}

	public static function getCity($city_id)
	{
		$cityDetails = DB::table('city')->where('city_id',$city_id)->first();
		return $cityDetails->city_name;
	}

	public static function getReviewRatings($rating)
	{
		$reviewStatusArray = [1=>"I hate it", 2=>"I don't like it", 3=>"Its Okay", 4=>"I like it", 5=>"I love it"];
		return $reviewStatusArray[$rating];
	}

	public static function getReviewsRatings($member_id)
	{
		$obj_reviews = ReviewRatingModel::orderBy('id','DESC')
		                  ->with(['interview_details','user_details','interview_details.user_details'])
		                  ->where('member_user_id','=', $member_id)
		                  ->where('trans_history_id','!=', 0)
		                  ->groupBy('unique_id')
		                  ->paginate(15);

		return $obj_reviews;		
	}

	public static function getAdminMemberCoaches($member_id,$skill_id)
	{
		//dd($skill_id);
		$obj_reviews = TransactionModel::orderBy('id','DESC')
		                  ->with(['transaction_history'=>function($query){
		                  	$query->where('item_type','Coach');
		                  	$query->groupBy('trans_id');
		                  	$query->orderBy('item_price','ASC');
		                  },'coach_reviews_ratings'=>function($query){
		                  	$query->where('ReviewType','Interview Coaching');
		                  	$query->where('trans_history_id','!=',0);
		                  },'user_detail','interview_detail'])
		                  ->where('member_user_id','=', $member_id)
		                  ->where('skill_id','=', $skill_id)
		                  ->where('payment_status','=', 'paid')
		                  ->groupBy('ticket_unique_id')
		                  ->paginate(15);
		//dd($obj_reviews);                  
		return $obj_reviews;		
	}

	public static function getMemberCoaches($member_id,$skill_id)
	{
		$obj_reviews = TransactionModel::orderBy('transaction.id','DESC')->join('transaction_history','transaction_history.trans_id','=','transaction.id')
		                  ->with(['transaction_history'=>function($query){
		                  	$query->where('item_type','Coach');
		                  },'coach_reviews_ratings'=>function($query){
							  $query->where('ReviewType','Interview Coaching');
							  $query->orWhere('ReviewType','Combo_Coach+Company');
							  $query->orWhere('ReviewType','Combo_Coach+Qa');
							  $query->orWhere('ReviewType','Combo_');
						  },'user_detail','skills'])
		                  ->where('member_user_id','=', $member_id)
		                  ->where('skill_id','=', $skill_id)
		                  ->where('transaction.payment_status','=', 'paid')
		                  ->groupBy('ticket_unique_id')
		                  ->paginate(15);

		return $obj_reviews;		
	}

	public static function getTransactionHistoryById($ticket_unique_id)
	{
		$sqlQuery ="SELECT  th.trans_id as transaction_id,SUM(th.item_price) as combo_item_price, r.* ,th.*, r.id as review_id, r.member_reply FROM `transaction` t
		    INNER JOIN transaction_history th ON th.trans_id = t.id
		    LEFT JOIN review_rating r ON r.unique_id = t.ticket_unique_id and r.trans_history_id = th.id
			WHERE th.combo_status=1 and t.ticket_unique_id='".$ticket_unique_id."' GROUP BY th.id
			UNION
			SELECT  th.id as transaction_id,SUM(th.item_price) as combo_item_price , r.*,th.*, r.id as review_id, r.member_reply FROM `transaction` t
			INNER JOIN transaction_history th ON th.trans_id = t.id
			LEFT JOIN review_rating r ON r.unique_id = t.ticket_unique_id and r.trans_history_id = th.id
			WHERE th.combo_status=0 and t.ticket_unique_id='".$ticket_unique_id."' GROUP BY th.id ORDER BY transaction_id DESC";
        $obj_transaction = DB::select($sqlQuery); 
        return $obj_transaction;
	}

	public static function getTransactionHistoryByLineItem($order_id)
	{
		$sqlQuery ="SELECT  th.trans_id as transaction_id,SUM(th.item_price) as combo_item_price, r.* ,th.* FROM `transaction` t
		    INNER JOIN transaction_history th ON th.trans_id = t.id
		    LEFT JOIN review_rating r ON r.unique_id = t.ticket_unique_id and r.trans_history_id = th.id
			WHERE th.combo_status=1 and th.order_id='".$order_id."' GROUP BY th.item_id,th.item_type,th.trans_id
			UNION
			SELECT  th.id as transaction_id,SUM(th.item_price) as combo_item_price , r.*,th.* FROM `transaction` t
			INNER JOIN transaction_history th ON th.trans_id = t.id
			LEFT JOIN review_rating r ON r.unique_id = t.ticket_unique_id and r.trans_history_id = th.id
			WHERE th.combo_status=0 and th.order_id='".$order_id."' GROUP BY th.item_id,th.item_type,th.trans_id ORDER BY transaction_id DESC";
        $obj_transaction = DB::select($sqlQuery); 
        return $obj_transaction;
	}

	public static function getTransactionHistory($order_id)
	{
		$sqlQuery ="SELECT  th.trans_id as transaction_id,SUM(th.item_price) as combo_item_price, r.* ,th.* FROM `transaction` t
		    INNER JOIN transaction_history th ON th.trans_id = t.id
		    LEFT JOIN review_rating r ON r.unique_id = t.ticket_unique_id and r.trans_history_id = th.id
			WHERE th.combo_status=1 and th.order_id='".$order_id."' GROUP BY th.combo_status=1,th.trans_id
			UNION
			SELECT  th.id as transaction_id,SUM(th.item_price) as combo_item_price , r.*,th.* FROM `transaction` t
			INNER JOIN transaction_history th ON th.trans_id = t.id
			LEFT JOIN review_rating r ON r.unique_id = t.ticket_unique_id and r.trans_history_id = th.id
			WHERE th.combo_status=0 and th.order_id='".$order_id."' GROUP BY th.item_id,th.item_type,th.trans_id ORDER BY transaction_id DESC";
        $obj_transaction = DB::select($sqlQuery); 
        return $obj_transaction;
	}	

	public static function getCombos($order_id, $is_substr=false, $learn = false, $action = null, $display_member_reply=false, $is_role=null)
	{
		$comboDetails = TransactionHistoryModel::where(['transaction_history.order_id'=>$order_id,'combo_status'=>1])->join('transaction','transaction.id','=','transaction_history.trans_id')->leftjoin('review_rating','review_rating.trans_history_id','=','transaction_history.id')->select('transaction_history.*','review_rating.*','transaction.*','transaction_history.payment_status as payment_status','review_rating.id as review_id')->get();
		$response = [];
		$comboPrice = 0;
		$comboIgst = 0;
		$comboCgst = 0;
		$comboSgst = 0;
		$comboTotal = 0;		
		/*$comboStr = '<span style="font-weight: bold;color: #FF8000;padding-left: 7px;">&nbsp;(Combo)</span><p>&nbsp;&nbsp;*&nbsp;Interview Coaching</p>';*/
		$comboStr = '';
		$comboReviews = '';
		$comboRatings = '';
		foreach ($comboDetails as $key => $value) {
			$refundStyle = 'width: 100%;float: left;';
			if($key == 0 && ($value->combo_type == '5 Companies' || $value->combo_type == '10 Companies' || $value->combo_type == '20 Companies'))
			{
				$comboStr = '<span style="font-weight: bold;">'.$value->combo_type.'</span>';		
				//$comboReviews .= '<p style="width: 100%;" class="combo-reviews"></p>';				
				//$comboRatings .= '<p style="width: 100%;" class="combo-reviews"></p>';	
			}
			elseif($key == 0)
			{
				$comboStr = '<p style="font-weight: bold;width: 100%;">Combo</p>';
			}
			/*if($value->combo_type == '5 Companies' || $value->combo_type == '10 Companies' || $value->combo_type == '20 Companies')
			{
				$comboReviews .= '<p style="width: 100%;">';				
				$comboRatings .= '<p style="width: 100%;">';				
				
			}*/
			
			if($key == 0)
			{
				$comboReviews .= '<p style="width: 100%;" class="combo-reviews"></p>';				
				$comboRatings .= '<p style="width: 100%;" class="combo-reviews"></p>';	
			}

			$comboReviews .= '<p style="width: 100%;">';				
			$comboRatings .= '<p style="width: 100%;">';		
			
			switch($value->item_type)
			{
				case 'Interview_qa':
							if($is_substr == true)
							{	
								$descriptionQa = 'Interview QA';
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<a href="'.url("/").'/'.$action.'/view_learn/'.base64_encode($value->trans_id).'/referencebook" target="_blank">';
								}
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<div>';
									$refundStyle = 'width: 60%;float: left;';
								}
								$comboStr .= (strlen($descriptionQa) > 23) ? '<p title="'.$descriptionQa.'" style="'.$refundStyle.'">&nbsp;&nbsp;*&nbsp;'.substr($descriptionQa,0,20).'...</p>' : '<p title="'.$descriptionQa.'" style="'.$refundStyle.'">&nbsp;&nbsp;*&nbsp;'.$descriptionQa.'</p>';
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<i class="fa fa-eye" aria-hidden="true"></i></a>';
								}
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<p class="pull-right">(Refunded)</p></div>';
								}
							}
							else
							{	
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<a href="'.url("/").'/'.$action.'/view_learn/'.base64_encode($value->trans_id).'/referencebook" target="_blank">';
								}
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<div>';
									$refundStyle = 'width: 60%;float: left;';
								}
								$comboStr .= '<p style="'.$refundStyle.'">&nbsp;&nbsp;*&nbsp;Interview QA</p>';
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<i class="fa fa-eye" aria-hidden="true"></i></a>';
								}
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<p class="pull-right">(Refunded)</p></div>';
								}
							}
							$comboPrice = $comboPrice + $value->item_price;
							$comboIgst = $comboIgst + $value->igst;
							$comboCgst = $comboCgst + $value->cgst;
							$comboSgst = $comboSgst + $value->sgst;
							break;
				case 'Company':
							$company_id = $value->item_id;
							$interview_id = $value->ref_interview_id;
							$item_name = '';
         					$companyDetails = InterviewDetailModel::where(['interview_id'=>$interview_id, 'company_id'=>$company_id])->first();
							//print_r($interview_id.'#########');
         					if($companyDetails)
         					{
         						$item_name = $companyDetails->company_name.' ( '.$companyDetails->company_location.' )';
         					}

         					if($is_substr == true)
							{
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<a href="'.url("/").'/'.$action.'/view_learn/'.base64_encode($value->trans_id).'/company" target="_blank">';
								}
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<div>';
									$refundStyle = 'width: 60%;float: left;';
								}
								$comboStr .= (strlen($item_name) > 23) ? '<p title="'.$item_name.'" style="'.$refundStyle.'">&nbsp;&nbsp;*&nbsp;'.substr($item_name,0,20).'...</p>' : '<p title="'.$item_name.'" style="'.$refundStyle.'">&nbsp;&nbsp;*&nbsp;'.$item_name.'</p>';
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<i class="fa fa-eye" aria-hidden="true"></i></a>';
								}
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<p class="pull-right">(Refunded)</p></div>';
								}															
								
							}
							else 
							{   
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<a href="'.url("/").'/'.$action.'/view_learn/'.base64_encode($value->trans_id).'/company" target="_blank">';
								} 
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<div>';
									$refundStyle = 'width: 60%;float: left;';
								}    					
								$comboStr .= '<p style="'.$refundStyle.'">&nbsp;&nbsp;*&nbsp;'.$item_name.'</p>';
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<i class="fa fa-eye" aria-hidden="true"></i></a>';
								}
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<p class="pull-right">(Refunded)</p></div>';
								}
							}
							
							if(!empty($comboRatings))
							{
								if(isset($value->review_star)) { for($i=1; $i<=5; $i++) { if($i <= $value->review_star) { $comboRatings .= ' <i class="fa fa-star" aria-hidden="true" style="font-size: 16px; color:#ffc000" title="'.CommonService::getReviewRatings($value->review_star).'"></i>'; } else { $comboRatings .=  ' <i class="fa fa-star-o" aria-hidden="true" style="font-size: 16px; color:#ffc000" title="'.CommonService::getReviewRatings($value->review_star).'"></i>'; } }  } else { for($i=1; $i<=5; $i++) { $comboRatings .=  '<i class="fa fa-star-o" aria-hidden="true" style="font-size: 16px; color:#ffc000"></i>&nbsp;'; } }
								$comboRatings .= '</p>';
							}
							
							if(!empty($comboReviews))
							{
								if(isset($value->review_message)) {
									$comboReviews .=  '<img src="'.url("/").'/images/review.png"  style="width: 19px; cursor: pointer;"  title="'.$value->review_message.'" />'; 
									if(isset($value->member_reply) && $display_member_reply == true && $is_role != 'admin')
									{
										$comboReviews .='<span style="padding-left:10px" title="'.$value->member_reply.'">Replied</span>';
									}
									elseif($display_member_reply == true){
										$comboReviews .='<a href="javascript:;" onclick="reply_review('.$value->review_id.')" style="padding-left:10px">Reply</a>';
									}
									elseif(isset($value->member_reply) && $is_role == 'admin'){
										$comboReviews .='&nbsp;<span class="label bg-success heading-text" style="background: #26A69A!important;border: #26A69A!important;cursor:pointer" title="'.$value->member_reply.'">Member Replied</span>';
									}

									} else { 
									$comboReviews .=  '<img src="'.url("/").'/images/comment-alt-regular.svg"  style="width: 17px; cursor: pointer;" />'; 
									}
								$comboReviews .= '</p>';
							}	

							$comboPrice = $comboPrice + $value->item_price;
							$comboIgst = $comboIgst + $value->igst;
							$comboCgst = $comboCgst + $value->cgst;
							$comboSgst = $comboSgst + $value->sgst;
							break;
				case 'Work_exp':
							if($is_substr == true)
							{
								$descriptionReal = 'Real Time Issues-'.$value->item_id;
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<a href="'.url("/").'/'.$action.'/view_learn/'.base64_encode($value->trans_id).'/rwe_tickets" target="_blank">';
								}
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<div>';
									$refundStyle = 'width: 60%;float: left;';
								}
								$comboStr .= (strlen($descriptionReal) > 23) ? '<p title="'.$descriptionReal.'" style="'.$refundStyle.'">&nbsp;&nbsp;*&nbsp;'.substr($descriptionReal,0,20).'...</p>' : '<p title="'.$descriptionReal.'" style="'.$refundStyle.'">&nbsp;&nbsp;*&nbsp;'.$descriptionReal.'</p>';
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<i class="fa fa-eye" aria-hidden="true"></i></a>';
								}
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<p class="pull-right">(Refunded)</p></div>';
								}
							}
							else
							{
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<a href="'.url("/").'/'.$action.'/view_learn/'.base64_encode($value->trans_id).'/rwe_tickets" target="_blank">';
								}
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<div>';
									$refundStyle = 'width: 60%;float: left;';
								}
								$comboStr .= '<p style="'.$refundStyle.'">&nbsp;&nbsp;*&nbsp;Real Time Issues-'.$value->item_id.'</p>';
								if($learn == true && $value->payment_status != 'refunded')
								{
									$comboStr .= '<i class="fa fa-eye" aria-hidden="true"></i></a>';
								}
								else if($key == 0 && $value->payment_status == 'refunded')
								{
									$comboStr .= '<p class="pull-right">(Refunded)</p></div>';
								}
							}
							$comboPrice = $comboPrice + $value->item_price;
							$comboIgst = $comboIgst + $value->igst;
							$comboCgst = $comboCgst + $value->cgst;
							$comboSgst = $comboSgst + $value->sgst;							
							break;
				case 'Coach':   $comboStr .= '<p>&nbsp;&nbsp;*&nbsp;Interview Coaching</p>';
								if(!empty($comboRatings))
								{
									if(isset($value->review_star)) { for($i=1; $i<=5; $i++) { if($i <= $value->review_star) { $comboRatings .= ' <i class="fa fa-star" aria-hidden="true" style="font-size: 16px; color:#ffc000" title="'.CommonService::getReviewRatings($value->review_star).'"></i>'; } else { $comboRatings .=  ' <i class="fa fa-star-o" aria-hidden="true" style="font-size: 16px; color:#ffc000" title="'.CommonService::getReviewRatings($value->review_star).'"></i>'; } }  } else { for($i=1; $i<=5; $i++) { $comboRatings .=  '<i class="fa fa-star-o" aria-hidden="true" style="font-size: 16px; color:#ffc000"></i>&nbsp;'; } }
									$comboRatings .= '</p>';
								}
								
								if(!empty($comboReviews))
								{
									if(isset($value->review_message) && $display_member_reply == true) {
										$comboReviews .=  '<img src="'.url("/").'/images/review.png"  style="width: 19px; cursor: pointer;"  title="'.$value->review_message.'" />'; 
										if(isset($value->member_reply) && $is_role != 'admin')
										{
											$comboReviews .='<span style="padding-left:10px" title="'.$value->member_reply.'">Replied</span>';
										}
										elseif($display_member_reply == true){
											$comboReviews .='<a href="javascript:;" onclick="reply_review('.$value->review_id.')" style="padding-left:10px">Reply</a>';
										}
										elseif(isset($value->member_reply) && $is_role == 'admin'){
											$comboReviews .='<span class="label bg-success heading-text" style="background: #26A69A!important;border: #26A69A!important;cursor:pointer" title="'.$value->member_reply.'">Member Replied</span>';
										}

									} else { 
									$comboReviews .=  '<img src="'.url("/").'/images/comment-alt-regular.svg"  style="width: 17px; cursor: pointer;" />'; 
									}
									$comboReviews .= '</p>';
								}
								break;
			}
			
		}
		$response['comboStr'] = $comboStr;
		$response['comboReviews'] = $comboReviews;
		$response['comboRatings'] = $comboRatings;
		$response['comboPrice'] = $comboPrice;
		$response['comboIgst'] = $comboIgst;
		$response['comboCgst'] = $comboCgst;
		$response['comboSgst'] = $comboSgst;
		$response['comboTotal'] = $comboPrice + $comboIgst + $comboCgst + $comboSgst;
		return $response;
	}
}

?>