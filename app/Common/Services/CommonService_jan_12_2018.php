<?php

namespace App\Common\Services;
use App\Models\TransactionHistoryModel;
use App\Models\InterviewDetailModel;

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

	public static function getCombos($order_id)
	{
		$comboDetails = TransactionHistoryModel::where(['order_id'=>$order_id,'combo_status'=>1])->get();
		$response = [];
		$comboPrice = 0;
		$comboStr = '<span>Combo</span>';
		foreach ($comboDetails as $key => $value) {
			switch($value->item_type)
			{
				case 'Coach':
							$comboStr .= '<p>Interview Coaching</p>';
							$comboPrice = $comboPrice + $value->item_price;
							break;
				case 'Company':
							$company_id = $value->item_id;
							$interview_id = $value->interview_id;
         					$companyDetails = InterviewDetailModel::where(['interview_id'=>$interview_id, 'company_id'=>$company_id])->first();

         					$item_name = $companyDetails->company_name.' ( '.$companyDetails->company_location.' )';
							$comboStr .= '<p>'.$item_name.'</p>';
							$comboPrice = $comboPrice + $value->item_price;
							break;
				case 'Work_exp':
							$comboStr .= '<p>Real Time Issues'.$value->item_id.'</p>';
							$comboPrice = $comboPrice + $value->item_price;
							break;
			}
			
		}
		$response['comboStr'] = $comboStr;
		$response['comboPrice'] = $comboPrice;
		return $response;
	}
}

?>