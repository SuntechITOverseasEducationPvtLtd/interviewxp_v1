<?php

namespace App\Http\Controllers\Front\member;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\StateModel;
use App\Models\AddInterviewCoach;
use App\Models\QualificationModel;
use App\Models\CategoryModel;
use App\Models\UserDetailModel;
use App\Models\MemberDetailModel;
use App\Models\CountryModel;
use App\Models\SkillsModel;
use App\Models\MembersSkillsModel;
use App\Models\SubCategoryModel;
use App\Models\SpecializationModel;
use App\Models\MemberInterviewModel;
use App\Models\NotificationModel;
use App\Models\CompanyModel;
use App\Models\AccountSettingModel;
use App\Models\ManageEmailModel;
use App\Models\PriceListModel;
use App\Models\RealtimeExperienceModel;
use App\Models\UserAlertsModel;
use App\Models\InterviewDetailModel;
use App\Models\TransactionModel;
use App\Models\PurchaseHistoryModel;
use App\Models\PurchasedTicketModel;
use App\Models\MultiReferenceBookModel;
use App\Models\AdvertisementModel;
use App\Models\ReviewRatingModel;
use App\Models\EmployerTypeModel;
use App\Models\TrainingCurriculamModel;
use App\Models\TrainingSchedulesModel;



use Validator;
use Sentinel;
use Flash;
use Session;
use Activation;
use Mail;
use File;
use DB;
use Auth;
use Response;

class MemberController extends Controller
{
     public function __construct(userModel $user,
    							StateModel $state,
    							QualificationModel $qualification,
    							AddInterviewCoach $addInterviewCoach,
								CategoryModel $category,
								UserDetailModel $user_detail,
								MemberDetailModel $member_detail,
								CountryModel $country,
								SkillsModel $skills,
                                MembersSkillsModel $member_skill,
                                SubCategoryModel $subcategory,
                                SpecializationModel $specialization,
								MemberInterviewModel $memberinterview,
                                NotificationModel $notification,
                                CompanyModel $Company,
                                AccountSettingModel $account_setting,
                                ManageEmailModel $manage_email,
                                RealtimeExperienceModel $RealtimeExperienceModel,
                                PriceListModel $price_list,
                                UserAlertsModel $user_alerts,
                                InterviewDetailModel $interview_detail,
                                TransactionModel $transaction,
                                PurchaseHistoryModel $purchase_history,  
                                //TransactionModel $transaction,
                               // InterviewDetailModel $interview_detail,
                                PurchasedTicketModel $purchase_ticket,
                                MultiReferenceBookModel $multiple_reference_book,
                                ReviewRatingModel $ReviewRatingModel,
                                AdvertisementModel $advertisement,
                                EmployerTypeModel $employer_type,
                                TrainingCurriculamModel $curriculam,
                                TrainingSchedulesModel $schedules
    							)
    {
          
        $this->UserModel               = $user;
        $this->BaseModel               = Sentinel::createModel();
        $this->StateModel              = $state;
        $this->QualificationModel      = $qualification;
        $this->AddInterviewCoach       = $addInterviewCoach;
        $this->CategoryModel           = $category;
        $this->UserDetailModel         = $user_detail;
        $this->MemberDetailModel       = $member_detail;
        $this->MembersSkillsModel      = $member_skill;
        $this->CountryModel            = $country;
        $this->SkillsModel             = $skills;
        $this->SubCategoryModel        = $subcategory;
        $this->SpecializationModel     = $specialization;
        $this->MemberInterviewModel    = $memberinterview;
        $this->NotificationModel       = $notification;
        $this->CompanyModel            = $Company;
        $this->AccountSettingModel     = $account_setting;
        $this->ManageEmailModel        = $manage_email;
        $this->RealtimeExperienceModel = $RealtimeExperienceModel;
        $this->PriceListModel          = $price_list;
        $this->UserAlertsModel         = $user_alerts;
        $this->InterviewDetailModel    = $interview_detail;
        $this->TransactionModel        = $transaction;
        $this->PurchaseHistoryModel    = $purchase_history;
        $this->PurchasedTicketModel    = $purchase_ticket;
        $this->MultiReferenceBookModel = $multiple_reference_book;
        $this->ReviewRatingModel 	   = $ReviewRatingModel;
        $this->AdvertisementModel      = $advertisement;
        $this->EmployerTypeModel = $employer_type; 
        $this->TrainingCurriculamModel = $curriculam; 
        $this->TrainingSchedulesModel = $schedules; 

        if(! $user = Sentinel::check()) 
          {
            return redirect('member/login');
          }

          if(!$user->inRole('member')) 
          {
            return redirect('member/login'); 
          }

        $this->user_id   = $user->id;



        $obj_member_id   = $this->MemberDetailModel->where('user_id',$this->user_id)->first();
        
        if($obj_member_id)
        {
          $member_detail   = $obj_member_id->toArray();
        }
        $obj_mail_from = $this->ManageEmailModel->first();
        $this->mail_from = $obj_mail_from->general_email;
        $this->member_detail = $member_detail;
        $this->member_id = isset($member_detail['id'])?$member_detail['id']:0;

        $obj_user_info = $this->UserModel->where(['id'=>$this->user_id])->get();
        if($obj_user_info)
        {
            $this->arr_user_info = $obj_user_info->toArray();
            if(isset($this->arr_user_info[0]['training_tab']))
            {
                $obj_schedules = $this->TrainingSchedulesModel
                                ->where(['member_id' => $this->member_id, 'status' => 'Live'])
                                ->get();
                foreach ($obj_schedules as $key => $value) {

                    $start_date = $value->created_at;
                    $schedule_id = $value->id;
                    $skill_id = $value->skill_id;
                    $max_allowed = $value->max_allowed;
                    $closing_days = config('constants.CLOSE_SCHEDULE_DAYS');


                    $newEndDate = strtotime("+".$closing_days." days", strtotime($value->date));
                    $end_date = date("Y-m-d H:i:s", $newEndDate);

                    $date1=date_create(date('Y-m-d'));
                    $date2=date_create($value->date);
                    $diff = date_diff($date2,$date1);
                    if($diff->days <= $closing_days)
                    {
                        break;
                    }

                    $transactionDetails = DB::table('transaction')
                                ->select(['purchase_history.training_schedule_id', 'transaction.user_id', 'transaction.member_user_id', 'r.review_star', 'r.review_message'])
                                ->join('purchase_history','purchase_history.trans_id','=','transaction.id')
                                ->leftJoin('review_rating as r', function($q)
                                  {
                                      $q->on('r.unique_id', '=', 'transaction.ticket_unique_id')
                                          ->where('r.ReviewType', '=', "Online Class");
                                  })
                                ->where('transaction.member_user_id', '=', $this->user_id)
                                ->where('training_schedule_id', '=', $schedule_id)
                                ->where('skill_id', '=', $skill_id)
                                ->where('transaction.payment_status', '=', 'paid')
                                ->where('transaction.created_at','>=',$start_date)
                                ->where('transaction.created_at','<=',$end_date)
                                ->get();

                    $userReviewStatus = true;            
                    foreach ($transactionDetails as $key => $userReview) {

                        if(empty($userReview->review_star) && empty($userReview->review_message))
                        {
                            $userReviewStatus = false;
                            break;
                        }
                    }

                    if($userReviewStatus == true)
                    {
                        $value->status = 'Completed';
                        $value->save();
                    }            
                }
                
            }
        }

        $this->user_profile_base_img_path   = public_path().config('app.project.img_path.user_profile_image');
        $this->user_profile_public_img_path = url('/').config('app.project.img_path.user_profile_image');
        $this->member_resume_path           = public_path().config('app.project.img_path.resume');

        $this->member_referencebook_path    = public_path().config('app.project.img_path.refrencebook');
        $this->member_referencebook_public_path    = url('/').config('app.project.img_path.refrencebook');

        $this->member_video_path            = public_path().config('app.project.img_path.video');
        $this->member_interviewimages_path  = public_path().config('app.project.img_path.interview_images');

        $this->member_realtime_attachment_path    = public_path().config('app.project.img_path.realtime_attachment');
        $this->member_realtime_attachment_public_path    = url('/').config('app.project.img_path.realtime_attachment');

        $this->member_company_attachment_path    = public_path().config('app.project.img_path.company_attachment');
        $this->member_company_attachment_public_path    = url('/').config('app.project.img_path.company_attachment');

        $this->advertise_base_img_path   = public_path().config('app.project.img_path.advertise_image');
        $this->advertise_public_img_path = url('/').config('app.project.img_path.advertise_image');

        $this->member_referencebook_folder_path       = config('app.project.img_path.refrencebook');
        $this->member_company_attachment_folder_path  = config('app.project.img_path.company_attachment');
        $this->member_realtime_attachment_folder_path = config('app.project.img_path.realtime_attachment');
        $this->module_view_folder                     = "front.member";
    }


    public function dashboard()
    {
    	$this->arr_view_data['module_title'] = "Dashboard"; 	
    	return view('front.member.dashboard',$this->arr_view_data);
    }
    
    public function edit_employment()
    {
        $member_id = $this->member_id;
         $obj_member_detail = $this->MemberDetailModel->where('id',$member_id)->with(['member_skills','member_employer_type'])->first();
        $arr_member_detail = [];
        if($obj_member_detail)
        {
            $arr_member_detail = $obj_member_detail->toArray();
        }
        /*dd($arr_member_detail);*/
        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->where('is_active','=',1)  
                                      ->orderBy('is_metro','asc')  
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }
        $arr_country = [];
        $obj_country = $this->CountryModel->get();
        if($obj_country) 
        {
            $arr_country = $obj_country->toArray();
        }
        $arr_category = [];
        $obj_category = $this->CategoryModel->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['arr_state']    = $arr_state;
        $this->arr_view_data['arr_category'] = $arr_category;
        $this->arr_view_data['arr_country']  = $arr_country;
        $this->arr_view_data['enc_id']       = base64_encode($this->member_id);
        $this->arr_view_data['arr_data']     = $arr_member_detail;
        return view($this->module_view_folder.'.edit_employment', $this->arr_view_data);
    }

    public function update_employment(Request $request)
    {   
    	$member_id = base64_decode($request->input('enc_id'));
        $type = '';
        if($request->input('type')!='')
        {
                $type = $request->input('type');
        }
    	$arr_rules['skills']           = "required";
        $arr_rules['experience_year']  = "required";
        $arr_rules['experience_month'] = "required";
        $arr_rules['employer_name']     = "required";
        $arr_rules['employer_type']    = "required";
        /*$arr_rules['start_month']      = "required";
        $arr_rules['start_year']       = "required";
        $arr_rules['end_month']        = "required";
        $arr_rules['end_year']         = "required";
        $arr_rules['designation']      = "required";*/
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $obj_data = $this->MemberDetailModel->where('id','=',$member_id)->first(['id','resume']);
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();
        }
        
        $file_name = $arr_data['resume'];
        
        if($request->hasFile('resume'))
        {   
            $bytes = File::size($request->file('resume'));

            $fileExtension = strtolower($request->file('resume')->getClientOriginalExtension()); 

            $arr_file_types = ['docx','pdf','doc','rtf'];

            if(in_array($fileExtension, $arr_file_types) && $bytes<=500000)
            {
                if(isset($arr_data) && sizeof($arr_data)>0)
                {
                    if(File::exists($this->member_resume_path.$arr_data['resume']))
                    {
                        @unlink($this->member_resume_path.$arr_data['resume']);
                    }
                }
                $file_name      = $request->input('resume');
                $file_extension = strtolower($request->file('resume')->getClientOriginalExtension()); 
                $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $request->file('resume')->move($this->member_resume_path, $file_name); 
            }
            else
            {
                Flash::error('Please upload valid file with doc,docx,pdf,rtf extension max size 500 kb');
                return redirect()->back();
            } 
        }

        /*$job_profile='';
        if($request->input('employer_type')=='current')
        {
            $start_month = $request->input('current_start_month');
            $start_year  = $request->input('current_start_year');
            $end_month   = $request->input('current_end_month');
            $end_year    = $request->input('current_end_year');
            $designation = $request->input('current_designation');
            $job_profile = $request->input('job_profile');
        }
        $company_name='';
        if($request->input('employer_type')=='previous')
        {
            $start_month  = $request->input('previous_start_month');
            $start_year   = $request->input('previous_start_year');
            $end_month    = $request->input('previous_end_month');
            $end_year     = $request->input('previous_end_year');
            $designation  = $request->input('previous_designation');
            $company_name = $request->input('company_name');
        }*/

        $job_profile='';
        if($request->input('employer_type')=='current')
        {
            $delete_previous_employer_type=$this->EmployerTypeModel->where('member_id',$member_id)->delete();
            $data['start_month']   = $request->input('current_start_month');
            $data['start_year']    = $request->input('current_start_year');
            $data['end_month']     = "present";
            $data['end_year']      = "present";
            $data['designation']   = $request->input('current_designation');
            $data['company_name']  = '';
            $data['member_id']     = $member_id;
            $data['employer_type'] = "current";
            /*$job_profile         = $request->input('job_profile');*/
            $employer_add          = $this->EmployerTypeModel->create($data);
        }
        $company_name='';
        if($request->input('employer_type')=='previous')
        {
            $delete_previous_employer_type=$this->EmployerTypeModel->where('member_id',$member_id)->delete();
            $previous_data=[];
            $previous_designation = $request->input('previous_designation');
            $previous_company_name = $request->input('company_name');
            $previous_start_month = $request->input('previous_start_month');
            $previous_start_year = $request->input('previous_start_year');
            $previous_end_month = $request->input('previous_end_month');
            $previous_end_year = $request->input('previous_end_year');

            foreach($previous_designation as $key => $designation) 
            {
                $previous_data[$key]['designation'] = $designation;
            }

            foreach($previous_company_name as $key => $company_name) 
            {
                $previous_data[$key]['company_name'] = $company_name;
            }
            
            foreach($previous_start_month as $key => $start_month) 
            {
                $previous_data[$key]['start_month'] = $start_month;
            }

            foreach($previous_start_year as $key => $start_year) 
            {
                $previous_data[$key]['start_year'] = $start_year;
            }

            foreach($previous_end_month as $key => $end_month) 
            {
                $previous_data[$key]['end_month'] = $end_month;
            }

            foreach($previous_end_year as $key => $end_year) 
            {
                $previous_data[$key]['end_year'] = $end_year;
            }
            
            foreach($previous_data as $key => $data) 
            {
               $data['member_id'] = $member_id;
               $data['employer_type'] = "previous";
               $employer_add = $this->EmployerTypeModel->create($data); 
            }
            /*$start_month  = $request->input('previous_start_month');
            $start_year   = $request->input('previous_start_year');
            $end_month    = $request->input('previous_end_month');
            $end_year     = $request->input('previous_end_year');
            $designation  = $request->input('previous_designation');
            $company_name = $request->input('company_name');*/
        }


        $this->MembersSkillsModel->where('member_id',$member_id)->delete();
        $skills = $request->input('skills');
        foreach ($skills as  $skill) 
        {
            $arr_skills=[];
            $arr_skills['skill_id'] =$skill;
            $arr_skills['member_id'] = $member_id;
            $this->MembersSkillsModel->create($arr_skills);    
        }
        
        $employer_name = $request->input('employer_name');
        $other_city = '';
        if($request->input('other_city')!='')
        {
        	$other_city = $request->input('other_city');
        }
        $other_state = '';
        if($request->input('other_state')!='')
        {
            $other_state = $request->input('other_state');
        }
        $country_id = 358;
        if($request->input('country_id')!='')
        {
            $country_id = $request->input('country_id');
        }
        $arr_member_data                     = [];
        $arr_member_data['experience_years'] = $request->input('experience_year');
        $arr_member_data['employer_name']    = $employer_name;
        $arr_member_data['experience_month'] = $request->input('experience_month');

        $arr_member_data['employer_name']          = $request->input('employer_name');
        $arr_member_data['employer_type']          = $request->input('employer_type');
        /*$arr_member_data['start_month']            = $start_month;
        $arr_member_data['start_year']             = $start_year;
        $arr_member_data['end_month']              = $end_month;
        $arr_member_data['end_year']               = $end_year;
        $arr_member_data['designation']            = $designation;*/
        $arr_member_data['current_work_location']  = $request->input('city');
        $arr_member_data['employment_country_id']  = $country_id;
        $arr_member_data['resume']                 = $file_name;
        $arr_member_data['employment_other_city']  = $other_city;
        $arr_member_data['employment_other_state'] = $other_state;
        $arr_member_data['company_name']           = $company_name;
        $arr_member_data['job_profile']            = $job_profile;
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_member_data['arr_skill']             = $arr_skill;
        $this->arr_member_data['skill_name']             = $skill_name;

        $member_employment = $this->MemberDetailModel->where('id',$member_id)->update($arr_member_data);
        if($member_employment)
        {
            Flash::success('Your Employment Information Stored Successfully.');
        }
        else
        {
            Flash::error('Error while storing employment detail.');   
        }
         
        return redirect('member/edit_education');    
    }

    public function edit_education()
    {
        $member_id = $this->member_id;
         $obj_member_detail = $this->MemberDetailModel->where('id',$member_id)->with(['member_skills'])->first();
        $arr_member_detail = [];
        if($obj_member_detail)
        {
            $arr_member_detail = $obj_member_detail->toArray();
        }
        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->where('is_active','=',1)  
                                      ->orderBy('is_metro','asc')  
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }
        $arr_country = [];
        $obj_country = $this->CountryModel->get();
        if($obj_country) 
        {
            $arr_country = $obj_country->toArray();
        }
        $arr_qualification = [];
        $obj_qualification = $this->QualificationModel->where('is_active','1')->get();
        if($obj_qualification)
        {
            $arr_qualification = $obj_qualification->toArray();
        }
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['arr_qualification'] = $arr_qualification;
        $this->arr_view_data['arr_state'] = $arr_state;
        $this->arr_view_data['arr_country'] = $arr_country;
        $this->arr_view_data['enc_id'] = base64_encode($this->member_id);
        $this->arr_view_data['arr_data'] = $arr_member_detail;
        return view($this->module_view_folder.'.edit_education', $this->arr_view_data);  
    }

    public function update_education(Request $request)
    {   
    	$member_id = base64_decode($request->input('enc_id'));
    	
    	$arr_rules['qualification_id']  = "required";
    	$arr_rules['passing_month']     = "required";
    	$arr_rules['passing_year']      = "required";
    	$arr_rules['marks_type']        = "required";
    	$arr_rules['marks_input']       = "required";
    	$arr_rules['pan_no']            = "required";
    	$arr_rules['about_member']      = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $marks_input = $request->input('marks_input');
        if($request->input('marks_type')=='percentage')
        {
            if($marks_input<30 || $marks_input>100)
            {
                Flash::error('Percentage value must be between 30 to 100.');
                return redirect()->back();
            }    
        }
        if($request->input('marks_type')=='cgpa')
        {
            if($marks_input<1 || $marks_input>10)
            {
                Flash::error('CGPA value must be between 1 to 10.');
                return redirect()->back();
            }    
        }

        $country_id = 358;
        if($request->input('country_id')!='')
        {
        	$country_id = $request->input('country_id');
        } 

        $other_city = '';
        if($request->input('other_city')!='')
        {
            $other_city = $request->input('other_city');
        }
        $other_state = '';
        if($request->input('other_state')!='')
        {
            $other_state = $request->input('other_state');
        }
        $specialization_id = '';
        if($request->input('specialization_id')!='')
        {
            $specialization_id = $request->input('specialization_id');
        }

        $arr_member_data                         = [];
        $arr_member_data['qualification_id']     = $request->input('qualification_id');
        $arr_member_data['passing_month']        = $request->input('passing_month');
        $arr_member_data['passing_year']         = $request->input('passing_year');
        $arr_member_data['marks_type']           = $request->input('marks_type');
        $arr_member_data['specialization_id']    = $specialization_id;
        $arr_member_data['marks']                = $request->input('marks_input');
        $arr_member_data['pan_no']               = $request->input('pan_no');
        $arr_member_data['education_city']       = $request->input('city');
        $arr_member_data['about_member']         = $request->input('about_member');
        $arr_member_data['education_country_id'] = $country_id;
        $arr_member_data['facebook']             = $request->input('facebook');
        $arr_member_data['linkedin']             = $request->input('linkedin');
        $arr_member_data['twitter']              = $request->input('twitter');
        $arr_member_data['education_other_city'] = $other_city;
        $arr_member_data['education_other_state'] = $other_state;
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_member_data['arr_skill']             = $arr_skill;
        $this->arr_member_data['skill_name']             = $skill_name;
        
        $member_data = $this->MemberDetailModel->where('id',$member_id)->update($arr_member_data);
        if($member_data)
        {
            Flash::success('Your Education Information Stored Successfully.');    
        }
        else
        {
            Flash::error('Error While Education Detail Updation.');
        }

    	return redirect()->back();
    }

    public function get_skills(Request $request)
    {
        
    	if($request->has('search'))
        {
            $search_term = $request->input('search');
            

            $obj_data = $this->SkillsModel->select(['id','skill_name'])
                                           ->where('is_active','1')
                                           ->where('skill_name','LIKE','%'.$search_term.'%');

                                           
            $arr_data = $obj_data->get()->toArray();
            return response()->json($arr_data);
        }
    }
	public function interviewCoach()
    {
        $user_id = $this->user_id;
		
		$coach = DB::table('interview_coach')->where('User_Id', $user_id)->first();
		if(isset($coach)){
			$this->arr_view_data['enc_id']                       = base64_encode($user_id);
			$this->arr_view_data['FirstName']             = $coach->FirstName;
			$this->arr_view_data['LastName']             = $coach->LastName;
			$this->arr_view_data['CurrentState']             = $coach->CurrentState;
			$this->arr_view_data['CurrentCity']             = $coach->CurrentCity;
			$this->arr_view_data['Headline']             = $coach->Headline;
			$this->arr_view_data['Summary']             = $coach->Summary;
			$this->arr_view_data['Interview']             = $coach->Interview;
			$this->arr_view_data['Companies']             = $coach->Companies;
			$this->arr_view_data['Issues']             = $coach->Issues;
		}else{
			$this->arr_view_data['enc_id']                       = base64_encode($user_id);
			$this->arr_view_data['FirstName']             = "";
			$this->arr_view_data['LastName']             = "";
			$this->arr_view_data['CurrentState']             = "";
			$this->arr_view_data['CurrentCity']             = "";
			$this->arr_view_data['Headline']             = "";
			$this->arr_view_data['Summary']             = "";
			$this->arr_view_data['Interview']             = "";
			$this->arr_view_data['Companies']             = "";
			$this->arr_view_data['Issues']             = "";
		}
		
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        
        return view($this->module_view_folder.'.interviewCoach', $this->arr_view_data);       
    }
    public function personal()
    {
        $this->arr_view_data['module_title'] = "My Profile"; 
        $user_id = $this->user_id;

        $arr_data = [];
        $obj_data = $this->BaseModel->where('id',$user_id)->with(['member_detail'])->first();
         if($obj_data)
        {
            $arr_data = $obj_data->toArray();
        }

        if(isset($arr_data) && sizeof($arr_data)>0)
        {
            $birth_date=date('d-M-Y',strtotime($arr_data['birth_date']));
        } 
        
        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->where('is_active','=',1)  
                                      ->orderBy('is_metro','asc')
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }

        $arr_qualification = [];
        $obj_qualification = $this->QualificationModel->where('is_active','1')->get();
        if($obj_qualification)
        {
            $arr_qualification = $obj_qualification->toArray();
        }

        $arr_category = [];
        $obj_category = $this->CategoryModel->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        } 
        $arr_country = [];
        $obj_country = $this->CountryModel->get();
        if($obj_country) 
        {
            $arr_country = $obj_country->toArray();
        }

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['arr_country']                  = $arr_country;
        $this->arr_view_data['module_title']                 = 'My Profile';
        $this->arr_view_data['arr_data']                     = $arr_data;
        $this->arr_view_data['enc_id']                       = base64_encode($user_id);
        $this->arr_view_data['birth_date']                   = $birth_date;
        $this->arr_view_data['arr_state']                    = $arr_state;
        $this->arr_view_data['arr_qualification']            = $arr_qualification;
        $this->arr_view_data['arr_category']                 = $arr_category;
        $this->arr_view_data['user_profile_public_img_path'] = $this->user_profile_public_img_path;
        return view($this->module_view_folder.'.edit_personal', $this->arr_view_data);       
    }
	public function add_interviewCoach(Request $request)
    {
        $user_id = base64_decode($request->input('enc_id'));
        $arr_rules['FirstName']        = "required";
        $arr_rules['LastName']         = "required";
        $arr_rules['CurrentState']      = "required";
        $arr_rules['CurrentCity']       = "required";
        $arr_rules['Headline']          = "required";
        $arr_rules['Summary']           = "required";
        $arr_rules['Interview']         = "required";
        $arr_rules['Companies']         = "required";
        $arr_rules['Issues']            = "required";
        
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
       
        $arr_user_details                  = [];
        $arr_user_details['User_Id']    = $user_id;
        $arr_user_details['FirstName']    = $request->input('FirstName');
        $arr_user_details['LastName']     = $request->input('LastName');
        $arr_user_details['CurrentState']   = $request->input('CurrentState');
        $arr_user_details['CurrentCity']     = $request->input('CurrentCity'); 
        $arr_user_details['Headline']     = $request->input('Headline'); 
        $arr_user_details['Summary']     = $request->input('Summary'); 
        $arr_user_details['Interview']     = $request->input('Interview'); 
        $arr_user_details['Companies']     = $request->input('Companies'); 
        $arr_user_details['Issues']     = $request->input('Issues');
		DB::table('interview_coach')->where('User_Id', $user_id)->delete();
        $update_member_user = $this->AddInterviewCoach->create($arr_user_details); 
        if($update_member_user)
        {
            Flash::success('Your Interview Coach Information Updated Successfully.');
        }
        else
        {   
            Flash::error('Error While Your Interview Coach Information Updating.');
        }
        return redirect('member/interviewCoach');
    }
    public function update_personal(Request $request)
    {
        $user_id = base64_decode($request->input('enc_id'));
        $arr_rules['first_name']        = "required";
        $arr_rules['last_name']         = "required";
        $arr_rules['email']             = "required|email";
        $arr_rules['mobile_code']       = "required";
        $arr_rules['mobile_no']         = "required";
        
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $obj_data = $this->BaseModel->where('id','=',$user_id)->first(['id','profile_image']);
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();
        }
        $file_name = $arr_data['profile_image'];
        if($request->hasFile('profile_image'))
        {
            $image_size=[];
            $fileExtension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
            $arr_file_types = ['jpg','jpeg','png','bmp'];
                         
            if(in_array($fileExtension, $arr_file_types))
            {    
                if(isset($arr_data) && sizeof($arr_data)>0)
                {
                    if(File::exists($this->user_profile_base_img_path.$arr_data['profile_image']))
                    {
                        @unlink($this->user_profile_base_img_path.$arr_data['profile_image']);
                    }
                }
                $file_name      = "default.jpg";
                $file_name      = $request->input('profile_image');
                $file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
                $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $request->file('profile_image')->move($this->user_profile_base_img_path, $file_name);
            } 
            else 
            {
                Flash::error('Please upload valid image with jpg, jpeg ,png extension.');
                return redirect()->back();
            }
        }
       
        $arr_user_details                  = [];
        $arr_user_details['first_name']    = $request->input('first_name');
        $arr_user_details['email']         = $request->input('email');
        $arr_user_details['last_name']     = $request->input('last_name');
        $arr_user_details['mobile_code']   = $request->input('mobile_code');
        $arr_user_details['mobile_no']     = $request->input('mobile_no'); 
        $arr_user_details['profile_image'] = $file_name;
        $update_member_user = $this->BaseModel->where('id',$user_id)->update($arr_user_details); 
        if($update_member_user)
        {
            Flash::success('Your Personal Information Updated Successfully.');
        }
        else
        {   
            Flash::error('Error While Personal Detail Updation.');
        }
        return redirect('member/edit_employment');
    }

    public function common()
    {
        $user_id = $this->user_id;
        $obj_member_detail= $this->MemberDetailModel->where('user_id',$user_id)->first(['biography','curriculum','my_interview_experience','calls_job_market','about_interview']);
        if($obj_member_detail)
        {
            $arr_member_detail = $obj_member_detail->toArray();
        }
        $arr_user_details=[];
        $obj_user_details = $this->AccountSettingModel->get();
        if($obj_user_details)
        {
            $arr_user_details = $obj_user_details->toArray();
        }
        $arr_user_email=[];
        $obj_user_email = $this->ManageEmailModel->get();
        if($obj_user_email)
        {
            $arr_user_email = $obj_user_email->toArray();
        }
        $obj_advertise = $this->AdvertisementModel->get();
        if($obj_advertise)
        {
            $arr_advertise = $obj_advertise->toArray();
        }
        if(\Request::segment(2)=='about_interview')
        {   
            $this->arr_view_data['type'] = 'about_interview';
            $this->arr_view_data['module_title'] = 'About This Interview Question and Answer';
            $this->arr_view_data['data'] =$arr_member_detail['about_interview'];
        }
        if(\Request::segment(2)=='biography')
        {   
            $this->arr_view_data['type'] = 'biography';
            $this->arr_view_data['module_title'] = 'Biography';
            $this->arr_view_data['data'] =$arr_member_detail['biography'];
        }
        if(\Request::segment(2)=='curriculum')
        {
            $this->arr_view_data['type'] = 'curriculum';
            $this->arr_view_data['module_title'] = 'Curriculum';
            $this->arr_view_data['data'] =$arr_member_detail['curriculum'];   
        }
        if(\Request::segment(2)=='interview_experience')
        {   
            $this->arr_view_data['type'] = 'interview_experience';
            $this->arr_view_data['module_title'] = 'My Interview Experience';
            $this->arr_view_data['data'] =$arr_member_detail['my_interview_experience'];
        }
        if(\Request::segment(2)=='call_job_market')
        {
            $this->arr_view_data['type'] = 'call_job_market';
            $this->arr_view_data['module_title'] = 'Present Calls In Job Market';
            $this->arr_view_data['data'] =$arr_member_detail['calls_job_market'];
        }
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']         = $arr_skill;
        $this->arr_view_data['skill_name']        = $skill_name;
        $this->arr_view_data['arr_advertise']     = $arr_advertise;
        $this->arr_view_data['arr_user_details']  = $arr_user_details;
        $this->arr_view_data['arr_user_email']    = $arr_user_email;
        $this->arr_view_data['advertise_public_img_path'] = $this->advertise_public_img_path;
        $this->arr_view_data['enc_id'] = base64_encode($user_id);
        return view($this->module_view_folder.'.common', $this->arr_view_data);   

    }
    public function update_common(Request $request)
    {
        $user_id = $this->user_id;
        $arr_member_data = [];
        if($request->input('type')=='about_interview')
        {   $arr_member_data['about_interview'] = $request->input('data');
            $update_common = $this->MemberDetailModel->where('user_id',$user_id)->update($arr_member_data); 
            if($update_common)
            { 
               Flash::success('Record updated successfully.');
            }
            else
            {
                Flash::error('Error while updating record.');   
            }
            return redirect(url('/member/about_interview'));  
        }
        if($request->input('type')=='biography')
        {   $arr_member_data['biography'] = $request->input('data');
            $update_common = $this->MemberDetailModel->where('user_id',$user_id)->update($arr_member_data); 
            if($update_common)
            { 
               Flash::success('Record updated successfully.');
            }
            else
            {
                Flash::error('Error while updating record.');   
            }
            return redirect(url('/member/biography'));  
        }
        if($request->input('type')=='curriculum')
        {
            $arr_member_data['curriculum'] = $request->input('data');
            $update_common = $this->MemberDetailModel->where('user_id',$user_id)->update($arr_member_data);
            if($update_common)
            {
                Flash::success('Record updated successfully.');
            }
            else
            {
                Flash::error('Error while updating record.');   
            }
            return redirect(url('/member/curriculum'));    
        }
        if($request->input('type')=='interview_experience')
        {   
            $arr_member_data['my_interview_experience'] = $request->input('data');
            $update_common = $this->MemberDetailModel->where('user_id',$user_id)->update($arr_member_data);
            if($update_common)
            {
                Flash::success('Record updated successfully.'); 
            }
            else
            {
                Flash::error('Error while updating record.');   
            }   
            return redirect(url('/member/interview_experience'));   
        }
        if($request->input('type')=='call_job_market')
        {
            $arr_member_data['calls_job_market'] = $request->input('data');
            $update_common = $this->MemberDetailModel->where('user_id',$user_id)->update($arr_member_data);
            if($update_common)
            { 
                Flash::success('Record updated successfully.'); 
            }
            else
            {
                Flash::error('Error while updating record.');   
            }
            return redirect(url('/member/call_job_market'));  
        }
    }

    public function add_skill()
    {
        $user_id = $this->user_id;
        $obj_member_detail = $this->MemberDetailModel->where('user_id',$user_id)->first();
        $arr_member_detail = [];
        if($obj_member_detail)
        {
            $arr_member_detail = $obj_member_detail->toArray();
        }
        $member_id = $arr_member_detail['id'];

        $obj_member_data = $this->MembersSkillsModel->where('member_id',$member_id)->get(); 
        $arr_member_data=[];
        if($obj_member_data)
        {
            $arr_member_data = $obj_member_data->toArray();
        }

        $arr_user_details=[];
        $obj_user_details = $this->AccountSettingModel->get();
        if($obj_user_details)
        {
            $arr_user_details = $obj_user_details->toArray();
        }
        $arr_user_email=[];
        $obj_user_email = $this->ManageEmailModel->get();
        if($obj_user_email)
        {
            $arr_user_email = $obj_user_email->toArray();
        }
        $this->arr_view_data['module_title'] = "Add New Skills";     
        $this->arr_view_data['enc_id'] = $member_id;
        $this->arr_view_data['arr_data'] = $arr_member_data;
        $this->arr_view_data['arr_user_details']  = $arr_user_details;
        $this->arr_view_data['arr_user_email']    = $arr_user_email;
        return view($this->module_view_folder.'.add_skills', $this->arr_view_data);
    }

    /*public function store_skill(Request $request)
    {
        $arr_rules['add_skill']            = "required";
        $user_id = $this->user_id;
        $obj_member_detail = $this->MemberDetailModel->where('user_id',$user_id)->first();
        $arr_member_detail = [];
        if($obj_member_detail)
        {
            $arr_member_detail = $obj_member_detail->toArray(); 
        }

        $member_id = $arr_member_detail['id'];

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $skill_exists = $this->SkillsModel 
                            ->where('skill_name',$request->input('add_skill'))
                            ->count(); 

        $skill_arr = $this->SkillsModel->where('skill_name',$request->input('add_skill'))->first();
        $skill_id=$skill_arr['id'];
        
        $skill_employee_exists = $this->MembersSkillsModel->where('member_id',$member_id)->where('skill_id',$skill_id)->count();  

        if($skill_exists)
        {
            if($skill_employee_exists)
            {
                Flash::error('Skill already exists.');
                return redirect()->back()->withInput($request->all());
            }
            else {

                $arr_data=[];
                $arr_data['member_id'] = $member_id;
                $arr_data['skill_id'] = $skill_id;
                $this->MembersSkillsModel->create($arr_data);
                $notification_data = [];
                $notification_data['user_id'] = $user_id;
                $notification_data['message'] = 'New Skill Added';
                $this->NotificationModel->create($notification_data);

                Flash::success('Skill added successfully.'); 
                return redirect(url('/member/add_skill/'));  
            }

        } 
        else 
        {
                $arr_skill=[];
                $arr_skill['skill_name'] = $request->input('add_skill');
                $new_skill = $this->SkillsModel->create($arr_skill);
                $input['new_skill_id'] = $new_skill->id;
                $arr_data=[];
                $arr_data['member_id'] = $member_id;
                $arr_data['skill_id'] = $input['new_skill_id'];
                $this->MembersSkillsModel->create($arr_data);
                $notification_data = [];
                $notification_data['user_id'] = $user_id;
                $notification_data['message'] = 'New Skill Added';
                $this->NotificationModel->create($notification_data);
                Flash::success('Skill added successfully.'); 
                return redirect(url('/member/add_skill/'));  
        }
                                                                    
    }*/

    /*public function skill_delete($id)
    {
        $skill_id = base64_decode($id);
        $user_id = $this->user_id;
        $obj_member_detail = $this->MemberDetailModel->where('user_id',$user_id)->first();
        $arr_member_detail = [];
        if($obj_member_detail)
        {
            $arr_member_detail = $obj_member_detail->toArray();
        }
        $member_id = $arr_member_detail['id'];
        
        $skill_delete = $this->MembersSkillsModel->where('member_id',$member_id)->where('skill_id',$skill_id)->delete();
        if($skill_delete)
        {
            Flash::success('Skill deleted successfully.'); 
            return redirect(url('/member/add_skill/'));  

        } 
        else 
        {

            Flash::error('Error while deleting skill');
            return redirect(url('/member/add_skill/'));  
        }

    }*/

    public function post_interview()
    {
        $user_id   = $this->user_id;
        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->where('is_active','=',1)  
                                      ->orderBy('is_metro','asc')  
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }
        $arr_category = [];
        $obj_category = $this->CategoryModel->where('is_active','=',1)->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }
        $arr_subcategory = [];
        $obj_subcategory = $this->SubCategoryModel->where('is_active','=',1)->get();
        if($obj_subcategory)
        {
            $arr_subcategory = $obj_subcategory->toArray();
        }
        $arr_skill = [];
        $obj_skill = $this->MembersSkillsModel->where('member_id',$this->member_id)->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $arr_qualification = [];
        $obj_qualification = $this->QualificationModel->where('is_active','=',1)->get()->map(function($item) use(&$arr_qualification) {
            $arr_qualification[$item->id] = $item->qualification_name;
        });
        
        /*if($obj_qualification)
        {
            $arr_qualification = $obj_qualification->toArray();
        }*/

        $arr_specialization = [];
        $obj_specialization = $this->SpecializationModel->where('is_active','=',1)->get()->map(function($item) use(&$arr_specialization) {
            $arr_specialization[$item->id] = $item->specialization_name;
        });
        /*if($obj_specialization)
        {
            $arr_specialization = $obj_specialization->toArray();
        }*/

        $arr_company = [];
        $obj_company = $this->CompanyModel->where('is_active','=',1)->get();
        if($obj_company)
        {
            $arr_company = $obj_company->toArray();
        }
        $arr_country = [];
        $obj_country = $this->CountryModel->get();
        if($obj_country) 
        {
          $arr_country = $obj_country->toArray();
        }                            

        $arr_user_details=[];
        $obj_user_details = $this->AccountSettingModel->get();
        if($obj_user_details)
        {
            $arr_user_details = $obj_user_details->toArray();
        }
        $arr_user_email=[];
        $obj_user_email = $this->ManageEmailModel->get();
        if($obj_user_email)
        {
            $arr_user_email = $obj_user_email->toArray();
        }

        $obj_advertise = $this->AdvertisementModel->get();
        if($obj_advertise)
        {
            $arr_advertise = $obj_advertise->toArray();
        }

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['member_detail']             = $this->member_detail;
        $this->arr_view_data['skill_name']             = $skill_name;
  
        $this->arr_view_data['arr_advertise']      = $arr_advertise; 
        $this->arr_view_data['arr_state']          = $arr_state;
        $this->arr_view_data['arr_category']       = $arr_category;
        $this->arr_view_data['arr_skill']          = $arr_skill;
        $this->arr_view_data['arr_subcategory']    = $arr_subcategory;
        $this->arr_view_data['arr_qualification']  = $arr_qualification;
        $this->arr_view_data['arr_specialization'] = $arr_specialization;
        $this->arr_view_data['arr_country']        = $arr_country;
        $this->arr_view_data['arr_company']        = $arr_company;
        $this->arr_view_data['arr_user_details']   = $arr_user_details;
        $this->arr_view_data['arr_user_email']     = $arr_user_email;
        $this->arr_view_data['advertise_public_img_path'] = $this->advertise_public_img_path;
        return view($this->module_view_folder.'.post_interview', $this->arr_view_data);  
    }

    public function updateSkill($id)
    {
        $updateId = base64_decode($id);
        $user_id   = $this->user_id;
        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->where('is_active','=',1)  
                                      ->orderBy('is_metro','asc')  
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }
        $arr_category = [];
        $obj_category = $this->CategoryModel->where('is_active','=',1)->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }
        $arr_subcategory = [];
        $obj_subcategory = $this->SubCategoryModel->where('is_active','=',1)->get();
        if($obj_subcategory)
        {
            $arr_subcategory = $obj_subcategory->toArray();
        }
        $arr_skill = [];
        $obj_skill = $this->MembersSkillsModel->where('member_id',$this->member_id)->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $arr_qualification = [];
        $obj_qualification = $this->QualificationModel->where('is_active','=',1)->get()->map(function($item) use(&$arr_qualification) {
            $arr_qualification[$item->id] = $item->qualification_name;
        });

        $memberInterviewObj = $this->MemberInterviewModel->where(['id'=>$updateId])->first();
        $currentSkillDetails = $this->SkillsModel->where(['id'=>$memberInterviewObj->skill_id])->first();

        /*if($obj_qualification)
        {
            $arr_qualification = $obj_qualification->toArray();
        }*/

        $arr_specialization = [];
        $obj_specialization = $this->SpecializationModel->where('is_active','=',1)->get()->map(function($item) use(&$arr_specialization) {
            $arr_specialization[$item->id] = $item->specialization_name;
        });
        /*if($obj_specialization)
        {
            $arr_specialization = $obj_specialization->toArray();
        }*/

        $arr_company = [];
        $obj_company = $this->CompanyModel->where('is_active','=',1)->get();
        if($obj_company)
        {
            $arr_company = $obj_company->toArray();
        }
        $arr_country = [];
        $obj_country = $this->CountryModel->get();
        if($obj_country) 
        {
          $arr_country = $obj_country->toArray();
        }                            

        $arr_user_details=[];
        $obj_user_details = $this->AccountSettingModel->get();
        if($obj_user_details)
        {
            $arr_user_details = $obj_user_details->toArray();
        }
        $arr_user_email=[];
        $obj_user_email = $this->ManageEmailModel->get();
        if($obj_user_email)
        {
            $arr_user_email = $obj_user_email->toArray();
        }

        $obj_advertise = $this->AdvertisementModel->get();
        if($obj_advertise)
        {
            $arr_advertise = $obj_advertise->toArray();
        }

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';
        $subcategoryObj = $this->SubCategoryModel->where('id',$memberInterviewObj->sub_category_id)->first();

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['member_detail']             = $this->member_detail;
        $this->arr_view_data['member_detail']             = $this->member_detail;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['subcategory_name']   = (!empty($subcategoryObj->subcategory_name)) ? $subcategoryObj->subcategory_name : '';
  
        $this->arr_view_data['arr_advertise']      = $arr_advertise; 
        $this->arr_view_data['arr_state']          = $arr_state;
        $this->arr_view_data['arr_category']       = $arr_category;
        $this->arr_view_data['arr_skill']          = $arr_skill;
        $this->arr_view_data['arr_subcategory']    = $arr_subcategory;
        $this->arr_view_data['arr_qualification']  = $arr_qualification;
        $this->arr_view_data['arr_specialization'] = $arr_specialization;
        $this->arr_view_data['arr_country']        = $arr_country;
        $this->arr_view_data['arr_company']        = $arr_company;
        $this->arr_view_data['arr_user_details']   = $arr_user_details;
        $this->arr_view_data['arr_user_email']     = $arr_user_email;
        $this->arr_view_data['memberInterviewObj'] = $memberInterviewObj;
        $this->arr_view_data['currentSkillDetails']= $currentSkillDetails;
        $this->arr_view_data['advertise_public_img_path'] = $this->advertise_public_img_path;
        return view($this->module_view_folder.'.update_skill', $this->arr_view_data);  
    }
    public function deleteSkill($id)
    {
        $id = base64_decode($id);
        $obj_member_interview = $this->MemberInterviewModel->where(['id'=>$id, 'member_id'=>$this->member_id])->first();
        if(isset($obj_member_interview))
        {
            $obj_member_interview->delete();
            Flash::success('Skill deleted successfully.');
            return redirect()->back();
        }
    }
    public function update_interview(Request $request)
    {                    
        $arr_rules['skills']          = "required";
        $arr_rules['experience']     = "required";
        $arr_rules['category']       = "required";
        $arr_rules['qualification_id']  = "required";
      
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $specialization_id =0;
        if($request->input('specialization_id')!='')
        {
            $specialization_id = $request->input('specialization_id'); 
        }
        $subcategory_id = ucfirst($request->input('subcategory_id'));
        $subcategory = ucfirst($request->input('subcategory'));
        if($subcategory!='')
        {
            if(!empty($subcategory_id))
            {
            $does_exists_subcategory = $this->SubCategoryModel->where('id',$subcategory_id)->update(['subcategory_name' => $subcategory]);
            }
            else
            {
                $create_subcategory = $this->SubCategoryModel->create(['category_id'=>$request->input('category'),'subcategory_name'=>$subcategory]);
                $subcategory_id = $create_subcategory->id;
            }
        }
        $skill_id = $request->input('member_skill_id');
        $member_interview_id = $request->input('member_interview_id');
        $skills = $request->input('skills');
        $skill_name   = ucfirst($skills);
        if($skill_name)
        {
            
            $skill_exists = $this->SkillsModel->where('id',$skill_id)->update(['skill_name' => $skill_name]);
            
        }
        
        $arr_data['user_id']                = $this->user_id;
        $arr_data['member_id']              = $this->member_id;
        $arr_data['skill_id']               = $skill_id;
        $arr_data['experience_level']       = $request->input('experience');
        $arr_data['category_id']            = $request->input('category');
        $arr_data['sub_category_id']        = $subcategory_id;
        $arr_data['qualification_id']       = $request->input('qualification_id');
        $arr_data['specialization_id']      = $specialization_id;
        $arr_data['video']                  = $request->input('videofile');
        
        $image_name='';
        if($request->hasFile('image'))
        {   $image_size=[];
            $fileExtension = strtolower($request->file('image')->getClientOriginalExtension()); 

            $arr_file_types = ['jpg','jpeg','png','bmp'];
            $image_size = getimagesize($request->file('image'));
            $image_width = $image_size[0];
            $image_height= $image_size[1];
             
            if(in_array($fileExtension, $arr_file_types) && $image_width<=200 && $image_height<=100)
            {
                $image_name      = $request->input('image');
                $image_extension = strtolower($request->file('image')->getClientOriginalExtension()); 
                $image_name      = sha1(uniqid().$image_name.uniqid()).'.'.$image_extension;
                $request->file('image')->move($this->member_interviewimages_path, $image_name); 
            }
            else
            {
                Flash::error('Please upload valid file with jpg,jpeg,png,bmp extension with 200X100 resolution.');
                return redirect()->back();
            } 
        }
        $arr_data['image']=$image_name;
                           

        $result = $this->MemberInterviewModel->where('id',$member_interview_id)->update($arr_data);
        if($result)
        { 
            Flash::success('Interview updated successfully.'); 
        }
        else
        {
            Flash::error('Error! While updating nterview.'); 
        }
        $arr_member_details = [];
        $obj_member_details = $this->BaseModel->where('id',$this->user_id)->first();
        if($obj_member_details)
        {
            $arr_member_details = $obj_member_details->toArray();
        }
        
        return redirect()->back();
    }

    public function store_interview(Request $request)
    {                    
        $arr_rules['skills']          = "required";
        $arr_rules['experience']     = "required";
        $arr_rules['category']       = "required";
        $arr_rules['qualification_id']  = "required";
      
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $specialization_id =0;
        if($request->input('specialization_id')!='')
        {
            $specialization_id = $request->input('specialization_id'); 
        }
        $subcategory = ucfirst($request->input('subcategory'));
        $subcategory_id = 0;
        if($subcategory!='')
        {
            $does_exists_subcategory = $this->SubCategoryModel->where('subcategory_name',$subcategory)->first();
            if($does_exists_subcategory)
            {
                $subcategory_id = $does_exists_subcategory['id']; 
            }    
            else
            {
                $create_subcategory = $this->SubCategoryModel->create(['category_id'=>$request->input('category'),'subcategory_name'=>$subcategory]);
                $subcategory_id = $create_subcategory->id;
            }
        }
        $skills = $request->input('skills');
        $skill_name   = ucfirst($skills);
        $skill_exists = $this->SkillsModel->where('skill_name',$skill_name)->first();
        if($skill_exists)
        {
            $skill_id = $skill_exists->id; 
        }
        else
        {
            $obj_skill_create = $this->SkillsModel->create(['skill_name'=>$skill_name]);
            if($obj_skill_create)
            {    
                $skill_id                = $obj_skill_create->id;
                $arr_skills              = [];
                $arr_skills['skill_id']  = $skill_id;
                $arr_skills['member_id'] = $this->member_id;
                $this->MembersSkillsModel->create($arr_skills);    
            }    
        }
        $arr_data['user_id']                = $this->user_id;
        $arr_data['member_id']              = $this->member_id;
        $arr_data['skill_id']               = $skill_id;
        $arr_data['experience_level']       = $request->input('experience');
        $arr_data['category_id']            = $request->input('category');
        $arr_data['sub_category_id']        = $subcategory_id;
        $arr_data['qualification_id']       = $request->input('qualification_id');
        $arr_data['specialization_id']      = $specialization_id;
        $arr_data['video']                  = $request->input('videofile');
        
        $image_name='';
        if($request->hasFile('image'))
        {   $image_size=[];
            $fileExtension = strtolower($request->file('image')->getClientOriginalExtension()); 

            $arr_file_types = ['jpg','jpeg','png','bmp'];
            $image_size = getimagesize($request->file('image'));
            $image_width = $image_size[0];
            $image_height= $image_size[1];
             
            if(in_array($fileExtension, $arr_file_types) && $image_width<=200 && $image_height<=100)
            {
                $image_name      = $request->input('image');
                $image_extension = strtolower($request->file('image')->getClientOriginalExtension()); 
                $image_name      = sha1(uniqid().$image_name.uniqid()).'.'.$image_extension;
                $request->file('image')->move($this->member_interviewimages_path, $image_name); 
            }
            else
            {
                Flash::error('Please upload valid file with jpg,jpeg,png,bmp extension with 200X100 resolution.');
                return redirect()->back();
            } 
        }
        $arr_data['image']=$image_name;
        $obj_alert_notification = $this->UserAlertsModel 
                            ->where('skill_id','=',$skill_id)
                            ->where('exp_level','=',$request->input('experience'))
                            ->get(); 

        if($obj_alert_notification) 
        {
            $arr_alert_notification = $obj_alert_notification->toArray();
        }                   
        foreach($arr_alert_notification as $notification)
        {
            $arr_noti  = [];
            $arr_noti['user_id'] = $notification['user_id'];
            $arr_noti['message'] = 'New '.$request->input('skills').' '.$request->input('experience').' years interview posted on our website.';
            $notification = $this->NotificationModel->create($arr_noti);
        }                    

        $result = $this->MemberInterviewModel->create($arr_data);
        if($result)
        { 
            Flash::success('Interview added successfully.'); 
        }
        else
        {
            Flash::error('Error! While adding nterview.'); 
        }
        $arr_member_details = [];
        $obj_member_details = $this->BaseModel->where('id',$this->user_id)->first();
        if($obj_member_details)
        {
            $arr_member_details = $obj_member_details->toArray();
        }
        
        /*----------------------------------------------------------------------------
            Member email for posting new interview
        ---------------------------------------------------------------------------*/
        if($result)
        {
            $email_id = isset($arr_member_details['email'])?$arr_member_details['email']:'';
            
            $data['name'] = ucfirst(isset($arr_member_details['first_name'])?$arr_member_details['first_name']:'');
            $data['email_id'] = isset($arr_member_details['email'])?$arr_member_details['email']:'';
            
            $project_name = config('app.project.name');
            $mail_from = $this->mail_from;

            Mail::send('front.email.post_interview', $data, function ($message) 
                use ($email_id,$mail_from,$project_name) 
                {
                      $message->from($mail_from, $project_name);
                      $message->subject($project_name.':Posted Interview.');
                      $message->to($email_id);
                });
            /*------------------------------------------------------------------------------
            End member mail sending        ----------------------------------------------------------------------------
            */

            /*
            -----------------------------------------------------------------------------
            Start admin mail for posted new interview by member
            -----------------------------------------------------------------------------
            */

            $obj_admin_account = $this->UserModel->whereHas('roles',function($query)
                                            {
                                                $query->where('slug','=','admin');
                                            })->first();
            $admin_email_id = $obj_admin_account->email;

            Mail::send('front.email.admin_posted_interview_email', $data, function ($message) 
                    use ($admin_email_id,$mail_from,$project_name) 
                    {
                          $message->from($mail_from, $project_name);
                          $message->subject($project_name.':Posted Interview.');
                          $message->to($admin_email_id);
                    });

            /*------------------------------------------------------------------------------
            End  mail sending for Admin
            ----------------------------------------------------------------------------
            */        
        }
        return redirect()->back();
    }

    public function getsubcategory(Request $request)
    {
        $category_id     = $request->id;
        $arr_subcategory = [];
        $obj_subcategory = $this->SubCategoryModel->where('category_id',$category_id)->get();
        if($obj_subcategory)
        {
            $arr_subcategory = $obj_subcategory->toArray();
        }
         echo '<option value=""> Select Subcategory</option>';
        foreach($arr_subcategory as $subcategory)
        {
            $id = $subcategory['id'];
            $subcat_name = $subcategory['subcategory_name'];
            echo '<option value="'.$id.'">'.$subcat_name.'</option>';
        }     
    }     

     public function getspecialization(Request $request)
    {
        $qualification_id   = $request->id;
        $arr_specialization = [];
        $obj_specialization = $this->SpecializationModel->where('qualification_id',$qualification_id)->get();
        if($obj_specialization)
        {
            $arr_specialization = $obj_specialization->toArray();
        }
         echo '<option value=""> Select Specialization</option>';
        foreach($arr_specialization as $specialization)
        {
            $id = $specialization['id'];
            $specialization_name = $specialization['specialization_name'];
            echo '<option value="'.$id.'">'.$specialization_name.'</option>';
        }     
    }

    public function getmemberskills()
    {
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        
        $skillname=[];
        foreach($arr_skill as $key => $value) 
        {
            $skillname[$key]['label'] = ucfirst($value['skill_name']);
            $skillname[$key]['value'] = $value['id'];
        }
        $skills=$skillname;
       return json_encode($skills);
    } 

    public function deactivate()
    {
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
         $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['module_title'] = "Deactivate an Account";
        return view($this->module_view_folder.'.deactivate_account', $this->arr_view_data);  
    }

    public function deactivate_account(Request $request)
    {
        $user = Sentinel::check();
        $user_id     = $user->id;

        $credentials = [];
        $credentials['password'] = $request->input('password');
        if(Sentinel::validateCredentials($user,$credentials))
        {
            $reason = $request->input('reason');
            if($request->input('reason')=='other')
            {
                $reason = $request->input('reason').' '.$request->input('other');
            }
            $arr_user_data                           = [];
            $arr_user_data['deactivate_reason']      = $request->input('reason');
            $arr_user_data['deactivate_description'] = $request->input('description');
            $arr_user_data['is_active'] =0;
            $arr_user_data['is_deactivate'] =1; 

            $deactivate = $this->BaseModel->where('id',$user_id)->update($arr_user_data);
            if($deactivate)
            {
                $obj_member = $this->BaseModel->where('id',$user_id)->first();
                if($obj_member)
                {
                    $arr_member_details = $obj_member->toArray();
                }
                Sentinel::logout();
                $email_id = isset($arr_member_details['email'])?$arr_member_details['email']:'';
            
            $data['name'] = ucfirst(isset($arr_member_details['first_name'])?$arr_member_details['first_name']:'');
            $data['email_id'] = isset($arr_member_details['email'])?$arr_member_details['email']:'';
            
            $project_name = config('app.project.name');
            $mail_from = $this->mail_from;

                Mail::send('front.email.deactivate_account', $data, function ($message) 
                use ($email_id,$mail_from,$project_name) 
                {
                      $message->from($mail_from, $project_name);
                      $message->subject($project_name.':Account Deactivation.');
                      $message->to($email_id);
                });
                Flash::success('Your account deactivated successfully.');
                $arr_response['status']    = "SUCCESS";
            }
            else
            {
                $arr_response['status']    = "Error";
            }
            
        }
        else
        {
            $arr_response['status']    = "ERROR";
        }
        return response()->json($arr_response);
    }

    public function notification()
    {
      $arr_pagination       = array();
      $arr_notification       = array();
      $user_id = $this->user_id;
      $this->NotificationModel->where('user_id',$user_id)->update(['status'=>1]);
      $member_notification = $this->NotificationModel->where('user_id',$user_id)->orderBy('id','desc')->paginate(4);
      if($member_notification)
      { 
        $arr_pagination = clone $member_notification;  
        $arr_notification = $member_notification->toArray(); 
      }
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['skill_name']             = $skill_name;
      $this->arr_view_data['arr_pagination']        = $arr_pagination;
      $this->arr_view_data['arr_notification'] = $arr_notification;
      $this->arr_view_data['module_title'] = 'Notifications';
      return view($this->module_view_folder.'.notification', $this->arr_view_data); 
    }

    public function delete_notification($enc_id)
    {
        $notification_id = base64_decode($enc_id);
        $delete_notification = $this->NotificationModel->where('id',$notification_id)->delete();
        if($delete_notification)
        {
            Flash::success('Notification deleted successfully.');
            return redirect()->back();
        }
        else
        {
            Flash::error('Error while Notification deletion.');
            return redirect()->back();
        }    
    }

    public function change_password()
    {
       $arr_skill = [];
       $obj_skill = $this->SkillsModel->get();
       if($obj_skill)
       {
        $arr_skill = $obj_skill->toArray();
       }
       $skill_name='';

       $this->arr_view_data['arr_skill']             = $arr_skill;
       $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
       $this->arr_view_data['skill_name']             = $skill_name;
       $this->arr_view_data['module_title'] = "Change Password";
       return view($this->module_view_folder.'.change_password', $this->arr_view_data);
    }  

    public function update_password(Request $request)
    {
        $arr_rules                     = array();
        $arr_rules['old_password']     = "required";
        $arr_rules['new_password']     = "required";
        $arr_rules['con_new_password'] = "required|same:new_password";
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
          return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $user = Sentinel::check();
        $credentials = [];
        $credentials['password'] = $request->input('old_password');
        if(Sentinel::validateCredentials($user,$credentials))
        {
          $new_credentials = [];
          $new_credentials['password'] = $request->input('new_password');

          if(Sentinel::update($user,$new_credentials))
          {
            Flash::success('Your password has been Changed Successfully.');
          }
          else
          {
            Flash::error('Problem Occurred, While Changing Your Password');
          }
        }
        else
        {
          Flash::error('Invalid Old Password.');
        }
        return redirect()->back();
    }

    public function revenue_reports()
    {
        $user_id = $this->user_id;
        $user_member_id = $this->member_id;
        $obj_transaction= $this->TransactionModel
                                 ->with(['purchase_history','member_detail','user_detail','purchase_history.interview_attachment','member_interview_info'])
                                 ->where('member_user_id',$user_id)
                                 ->where('payment_status','=','paid')
                                 ->orderBy('id','desc')
                                 ->paginate(10);  

        if($obj_transaction)
        {
            $arr_pagination = clone $obj_transaction;
            $arr_transaction = $obj_transaction->toArray();
        }

       foreach($arr_transaction['data'] as $key => $details) 
       {
         $member_amount     = $details['member_amount'];
         $member_tax_amount = ($member_amount*10/100);
         $after_tax_amount = $member_amount-$member_tax_amount;
         $arr_transaction['data'][$key]['member_tax_amount'] = $member_tax_amount;
         $arr_transaction['data'][$key]['after_tax_amount'] = $after_tax_amount;
         $arr_transaction['data'][$key]['interview_count'] = count($details['purchase_history']);
         $arr_transaction['data'][$key]['interview_count_arr'] = count($details['purchase_history'][0]['interview_attachment']);
         $arr_transaction['data'][$key]['ticket_name'] = $details['purchase_history'][0]['ticket_name'];
       } 

        $obj_advertise = $this->AdvertisementModel->get();
        if($obj_advertise)
        {
            $arr_advertise = $obj_advertise->toArray();
        }
        //dd($arr_transaction);

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['skill_name']             = $skill_name; 
        $this->arr_view_data['advertise_public_img_path'] = $this->advertise_public_img_path;  
        $this->arr_view_data['arr_advertise']   = $arr_advertise;
        $this->arr_view_data['arr_pagination']  = $arr_pagination;                    
        $this->arr_view_data['module_title']    = 'Revenue Report';
        $this->arr_view_data['arr_transaction'] = $arr_transaction;
        return view($this->module_view_folder.'.revenue_reports',$this->arr_view_data);
    }
// Ramakrishna Reviews Code
  /*  public function reviews()
    {
		$user_id = $this->user_id;
        $user_member_id = $this->member_id;
        //dd($user_id);

        $arr_review_rating = [];
   		$obj_reviews = $this->ReviewRatingModel->with(['user_details','interview_details.user_details'])->where('member_user_id',$user_id)->where('approve_status','!=','pending')->paginate(10);
   		if($obj_reviews)
   		{
   			$arr_pagination = clone $obj_reviews;
   			$arr_review_rating = $obj_reviews->toArray();
   		}
   		$obj_advertise = $this->AdvertisementModel->get();
        if($obj_advertise)
        {
            $arr_advertise = $obj_advertise->toArray();
        }

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']         = $arr_skill;
        $this->arr_view_data['skill_name']        = $skill_name;
      	$this->arr_view_data['advertise_public_img_path'] = $this->advertise_public_img_path;
   		$this->arr_view_data['module_title']      = 'Reviews';
   		$this->arr_view_data['arr_advertise']   = $arr_advertise;
        $this->arr_view_data['arr_pagination']  = $arr_pagination;
   		$this->arr_view_data['arr_review_rating'] = $arr_review_rating;
        //dd($arr_review_rating);

        return view($this->module_view_folder.'.member_reviews',$this->arr_view_data);	
    }
*/


    public function view_revenue_report($enc_id)
    {
        $user_id = $this->user_id;
        $id = base64_decode($enc_id);
        $obj_transaction= $this->TransactionModel
                                 ->with(['purchase_history','member_detail','user_detail','purchase_history.interview_attachment','member_interview_info',
                                    'multi_ref_book'=> function($ref_book)
                                    {
                                        $ref_book->where('approve_status',1); 
                                    }

                                    ])
                                 ->where('member_user_id',$user_id)
                                 ->where('id',$id)
                                 ->first();
        if($obj_transaction)
        {
            $arr_transaction = $obj_transaction->toArray();
        }

        $member_amount      = $arr_transaction['member_amount'];
        $member_tax_amount  = ($member_amount*10/100);
        $after_tax_amount   = $member_amount-$member_tax_amount;
        $interview_count    = count($arr_transaction['purchase_history']);
        $interview_count_arr= count($arr_transaction['purchase_history']);
        $ticket_name        = $arr_transaction['purchase_history'][0]['ticket_name'];   
        $multi_ref_book     = count($arr_transaction['multi_ref_book']);

        $this->arr_view_data['member_referencebook_public_path'] = $this->member_referencebook_public_path;
        $this->arr_view_data['member_company_attachment_public_path'] = $this->member_company_attachment_public_path;
        $this->arr_view_data['multi_ref_book']    = $multi_ref_book;  
        $this->arr_view_data['ticket_name']       = $ticket_name;  
        $this->arr_view_data['interview_count']   = $interview_count;
        $this->arr_view_data['interview_count_arr']   = $interview_count_arr;
        $this->arr_view_data['after_tax_amount']  = $after_tax_amount;
        $this->arr_view_data['member_tax_amount'] = $member_tax_amount;
        $this->arr_view_data['arr_transaction']   = $arr_transaction;
        $this->arr_view_data['module_title']      = 'Revenue Reports Details';
        return view($this->module_view_folder.'.view_revenue_report', $this->arr_view_data); 
    }
	public function reviewsNew()
    {
        $arr_user_details=[];
        $obj_user_details = $this->AccountSettingModel->get();
        if($obj_user_details)
        {
            $arr_user_details = $obj_user_details->toArray();
        }
        $arr_user_email=[];
        $obj_user_email = $this->ManageEmailModel->get();
        if($obj_user_email)
        {
            $arr_user_email = $obj_user_email->toArray();
        }

    	$obj_interview_experience = $this->MemberInterviewModel->with(['interview_details','realtime_details','reference_book_details'])
    							->where('user_id',$this->user_id)
    							->get();
        $arr_interview=[];                        
    	if($obj_interview_experience)
    	{
    		$arr_interview = $obj_interview_experience->toArray();
    	}
        $arr_company = [];
        $obj_company = $this->CompanyModel->where('is_active','=',1)->get();
        if($obj_company)
        {
            $arr_company = $obj_company->toArray();
        }
        $this->arr_view_data['arr_company']        = $arr_company;
        $arr_revenue = [];
        $meb_revenue_ern="";
        $total_revenue_ern="";
        $act_revenue_ern="";
        $revenue_per="";
        $sale=0;
        $sale =$this->TransactionModel->where('member_user_id',$this->user_id)->where('payment_status','Paid')->count();
        //dd($sale);
        $obj_revenue =$this->TransactionModel->where('member_user_id',$this->user_id)->where('member_payment_status','Paid')->get(['member_amount']);
        if($obj_revenue)
        {
            $arr_revenue = $obj_revenue->toArray();
        }
        //dd($arr_revenue);
       
        foreach($arr_revenue as $meb_amount)
        {
            $total_revenue_ern=($total_revenue_ern)+($meb_amount['member_amount']);
        }
        
        $revenue_per=($total_revenue_ern*10)/(100);
        $act_revenue_ern=($total_revenue_ern)-($revenue_per);
        
        $arr_revenue = [];
        $meb_revenue_pen="";
        $total_revenue_pen="";
        $act_revenue_pen="";
        $revenue_pen="";
        $obj_revenue =$this->TransactionModel->where('member_user_id',$this->user_id)->where('member_payment_status','Dont Pay')->orWhere('member_payment_status','Pay')->get(['member_amount']);
        if($obj_revenue)
        {
            $arr_revenue = $obj_revenue->toArray();
        }
       
        foreach($arr_revenue as $meb_amount)
        {
            $total_revenue_pen=($total_revenue_pen)+($meb_amount['member_amount']);
        }


        $revenue_per_pen=($total_revenue_pen*10)/(100);

        $act_revenue_pen=($total_revenue_pen)-($revenue_per_pen);
        //dd($act_revenue_pen);
        /*--------------------------------------------------------------------------------
          start member interview upload view total count 
        --------------------------------------------------------------------------------*/
        $member_interview_view_count = $this->MemberInterviewModel
                                         ->where('user_id',$this->user_id)
                                         ->sum('view_count');
         /*--------------------------------------------------------------------------------
          end member interview upload view total count 
        --------------------------------------------------------------------------------*/
        $this->arr_view_data['member_interview_view_count'] = $member_interview_view_count;
        //dd($arr_interview);

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['act_revenue_ern']           = $act_revenue_ern;
        $this->arr_view_data['total_revenue_ern']         = $total_revenue_ern;
        $this->arr_view_data['act_revenue_pen']           = $act_revenue_pen;
        $this->arr_view_data['arr_interview']             = $arr_interview;
        $this->arr_view_data['arr_user_details']          = $arr_user_details;
        $this->arr_view_data['arr_user_email']            = $arr_user_email;
        $this->arr_view_data['sale']                      = $sale;
        $this->arr_view_data['referencebook_public_path'] = $this->member_referencebook_public_path;
        $this->arr_view_data['realtime_public_path']      = $this->member_realtime_attachment_public_path;

        $this->arr_view_data['company_public_path']   =$this->member_company_attachment_public_path;
        $this->arr_view_data['company_base_path']   =$this->member_company_attachment_path;
  
        return view($this->module_view_folder.'.member_reviews',$this->arr_view_data);
       
    }
	public function biography()
    {
        $arr_user_details=[];
        $obj_user_details = $this->AccountSettingModel->get();
        if($obj_user_details)
        {
            $arr_user_details = $obj_user_details->toArray();
        }
        $arr_user_email=[];
        $obj_user_email = $this->ManageEmailModel->get();
        if($obj_user_email)
        {
            $arr_user_email = $obj_user_email->toArray();
        }

    	$obj_interview_experience = $this->MemberInterviewModel->with(['interview_details','realtime_details','reference_book_details'])
    							->where('user_id',$this->user_id)
    							->get();
        $arr_interview=[];                        
    	if($obj_interview_experience)
    	{
    		$arr_interview = $obj_interview_experience->toArray();
    	}
        $arr_company = [];
        $obj_company = $this->CompanyModel->where('is_active','=',1)->get();
        if($obj_company)
        {
            $arr_company = $obj_company->toArray();
        }
        $this->arr_view_data['arr_company']        = $arr_company;
        $arr_revenue = [];
        $meb_revenue_ern="";
        $total_revenue_ern="";
        $act_revenue_ern="";
        $revenue_per="";
        $sale=0;
        $sale =$this->TransactionModel->where('member_user_id',$this->user_id)->where('payment_status','Paid')->count();
        //dd($sale);
        $obj_revenue =$this->TransactionModel->where('member_user_id',$this->user_id)->where('member_payment_status','Paid')->get(['member_amount']);
        if($obj_revenue)
        {
            $arr_revenue = $obj_revenue->toArray();
        }
        //dd($arr_revenue);
       
        foreach($arr_revenue as $meb_amount)
        {
            $total_revenue_ern=($total_revenue_ern)+($meb_amount['member_amount']);
        }
        
        $revenue_per=($total_revenue_ern*10)/(100);
        $act_revenue_ern=($total_revenue_ern)-($revenue_per);
        
        $arr_revenue = [];
        $meb_revenue_pen="";
        $total_revenue_pen="";
        $act_revenue_pen="";
        $revenue_pen="";
        $obj_revenue =$this->TransactionModel->where('member_user_id',$this->user_id)->where('member_payment_status','Dont Pay')->orWhere('member_payment_status','Pay')->get(['member_amount']);
        if($obj_revenue)
        {
            $arr_revenue = $obj_revenue->toArray();
        }
       
        foreach($arr_revenue as $meb_amount)
        {
            $total_revenue_pen=($total_revenue_pen)+($meb_amount['member_amount']);
        }


        $revenue_per_pen=($total_revenue_pen*10)/(100);

        $act_revenue_pen=($total_revenue_pen)-($revenue_per_pen);
        //dd($act_revenue_pen);
        /*--------------------------------------------------------------------------------
          start member interview upload view total count 
        --------------------------------------------------------------------------------*/
        $member_interview_view_count = $this->MemberInterviewModel
                                         ->where('user_id',$this->user_id)
                                         ->sum('view_count');
         /*--------------------------------------------------------------------------------
          end member interview upload view total count 
        --------------------------------------------------------------------------------*/
        $this->arr_view_data['member_interview_view_count'] = $member_interview_view_count;
        //dd($arr_interview);

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['act_revenue_ern']           = $act_revenue_ern;
        $this->arr_view_data['total_revenue_ern']         = $total_revenue_ern;
        $this->arr_view_data['act_revenue_pen']           = $act_revenue_pen;
        $this->arr_view_data['arr_interview']             = $arr_interview;
        $this->arr_view_data['arr_user_details']          = $arr_user_details;
        $this->arr_view_data['arr_user_email']            = $arr_user_email;
        $this->arr_view_data['sale']                      = $sale;
        $this->arr_view_data['referencebook_public_path'] = $this->member_referencebook_public_path;
        $this->arr_view_data['realtime_public_path']      = $this->member_realtime_attachment_public_path;

        $this->arr_view_data['company_public_path']   =$this->member_company_attachment_public_path;
        $this->arr_view_data['company_base_path']   =$this->member_company_attachment_path;
  
        return view($this->module_view_folder.'.common',$this->arr_view_data);
       
    }

    public function mybookings($id)
    {
        $interviewId = base64_decode($id);
        $arr_user_details=[];
        $obj_user_details = $this->AccountSettingModel->get();
        if($obj_user_details)
        {
            $arr_user_details = $obj_user_details->toArray();
        }
        $arr_user_email=[];
        $obj_user_email = $this->ManageEmailModel->get();
        if($obj_user_email)
        {
            $arr_user_email = $obj_user_email->toArray();
        }

        $obj_interview_experience = $this->MemberInterviewModel->with(['interview_details','realtime_details','reference_book_details'])
                                ->where('user_id',$this->user_id)
                                ->where('id',$interviewId)
                                ->get();
        $arr_interview=[];                        
        if($obj_interview_experience)
        {
            $arr_interview = $obj_interview_experience->toArray();
        }
        $arr_company = [];
        $obj_company = $this->CompanyModel->where('is_active','=',1)->get();
        if($obj_company)
        {
            $arr_company = $obj_company->toArray();
        }
        $this->arr_view_data['arr_company']        = $arr_company;
        $arr_revenue = [];
        $meb_revenue_ern="";
        $total_revenue_ern="";
        $act_revenue_ern="";
        $revenue_per="";
        $sale=0;
        $sale =$this->TransactionModel->where('member_user_id',$this->user_id)->where('payment_status','Paid')->count();
        //dd($sale);
        $obj_revenue =$this->TransactionModel->where('member_user_id',$this->user_id)->where('member_payment_status','Paid')->get(['member_amount']);
        if($obj_revenue)
        {
            $arr_revenue = $obj_revenue->toArray();
        }
        //dd($arr_revenue);
       
        foreach($arr_revenue as $meb_amount)
        {
            $total_revenue_ern=($total_revenue_ern)+($meb_amount['member_amount']);
        }
        
        $revenue_per=($total_revenue_ern*10)/(100);
        $act_revenue_ern=($total_revenue_ern)-($revenue_per);
        
        $arr_revenue = [];
        $meb_revenue_pen="";
        $total_revenue_pen="";
        $act_revenue_pen="";
        $revenue_pen="";
        $obj_revenue =$this->TransactionModel->where('member_user_id',$this->user_id)->where('member_payment_status','Dont Pay')->orWhere('member_payment_status','Pay')->get(['member_amount']);
        if($obj_revenue)
        {
            $arr_revenue = $obj_revenue->toArray();
        }
       
        foreach($arr_revenue as $meb_amount)
        {
            $total_revenue_pen=($total_revenue_pen)+($meb_amount['member_amount']);
        }


        $revenue_per_pen=($total_revenue_pen*10)/(100);

        $act_revenue_pen=($total_revenue_pen)-($revenue_per_pen);
        //dd($act_revenue_pen);
        /*--------------------------------------------------------------------------------
          start member interview upload view total count 
        --------------------------------------------------------------------------------*/
        $member_interview_view_count = $this->MemberInterviewModel
                                         ->where('user_id',$this->user_id)
                                         ->sum('view_count');
         /*--------------------------------------------------------------------------------
          end member interview upload view total count 
        --------------------------------------------------------------------------------*/
        $this->arr_view_data['member_interview_view_count'] = $member_interview_view_count;
        //dd($arr_interview);

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['interviewId']             = $interviewId;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['act_revenue_ern']           = $act_revenue_ern;
        $this->arr_view_data['total_revenue_ern']         = $total_revenue_ern;
        $this->arr_view_data['act_revenue_pen']           = $act_revenue_pen;
        $this->arr_view_data['arr_interview']             = $arr_interview;
        $this->arr_view_data['arr_user_details']          = $arr_user_details;
        $this->arr_view_data['arr_user_email']            = $arr_user_email;
        $this->arr_view_data['sale']                      = $sale;
        $this->arr_view_data['referencebook_public_path'] = $this->member_referencebook_public_path;
        $this->arr_view_data['realtime_public_path']      = $this->member_realtime_attachment_public_path;

        $this->arr_view_data['company_public_path']   =$this->member_company_attachment_public_path;
        $this->arr_view_data['company_base_path']   =$this->member_company_attachment_path;
  
        return view($this->module_view_folder.'.common',$this->arr_view_data);
       
    }
	
    public function upload_history()
    {        

        $arr_user_details=[];
        $obj_user_details = $this->AccountSettingModel->get();
        if($obj_user_details)
        {
            $arr_user_details = $obj_user_details->toArray();
        }
        $arr_user_email=[];
        $obj_user_email = $this->ManageEmailModel->get();
        if($obj_user_email)
        {
            $arr_user_email = $obj_user_email->toArray();
        }

    	$obj_interview_experience = $this->MemberInterviewModel->with(['interview_details','realtime_details','reference_book_details'])
    							->where('user_id',$this->user_id)
    							->get();
        $arr_interview=[];                        
    	if($obj_interview_experience)
    	{
    		$arr_interview = $obj_interview_experience->toArray();
    	}

        $arr_company = [];
        $obj_company = $this->CompanyModel->where('is_active','=',1)->get();
        if($obj_company)
        {
            $arr_company = $obj_company->toArray();
        }
        $this->arr_view_data['arr_company']        = $arr_company;
        $arr_revenue = [];
        $meb_revenue_ern="";
        $total_revenue_ern="";
        $act_revenue_ern="";
        $revenue_per="";
        $sale=0;
        $sale =$this->TransactionModel->where('member_user_id',$this->user_id)->where('payment_status','Paid')->count();
        //dd($sale);
        $obj_revenue =$this->TransactionModel->where('member_user_id',$this->user_id)->where('member_payment_status','Paid')->get(['member_amount']);
        if($obj_revenue)
        {
            $arr_revenue = $obj_revenue->toArray();
        }
        //dd($arr_revenue);
       
        foreach($arr_revenue as $meb_amount)
        {
            $total_revenue_ern=($total_revenue_ern)+($meb_amount['member_amount']);
        }
        
        $revenue_per=($total_revenue_ern*10)/(100);
        $act_revenue_ern=($total_revenue_ern)-($revenue_per);
        
        $arr_revenue = [];
        $meb_revenue_pen="";
        $total_revenue_pen="";
        $act_revenue_pen="";
        $revenue_pen="";
        $obj_revenue =$this->TransactionModel->where('member_user_id',$this->user_id)->where('member_payment_status','Dont Pay')->orWhere('member_payment_status','Pay')->get(['member_amount']);
        if($obj_revenue)
        {
            $arr_revenue = $obj_revenue->toArray();
        }
       
        foreach($arr_revenue as $meb_amount)
        {
            $total_revenue_pen=($total_revenue_pen)+($meb_amount['member_amount']);
        }


        $revenue_per_pen=($total_revenue_pen*10)/(100);

        $act_revenue_pen=($total_revenue_pen)-($revenue_per_pen);
        //dd($act_revenue_pen);
        /*--------------------------------------------------------------------------------
          start member interview upload view total count 
        --------------------------------------------------------------------------------*/
        $member_interview_view_count = $this->MemberInterviewModel
                                         ->where('user_id',$this->user_id)
                                         ->sum('view_count');
         /*--------------------------------------------------------------------------------
          end member interview upload view total count 
        --------------------------------------------------------------------------------*/
        $this->arr_view_data['member_interview_view_count'] = $member_interview_view_count;
        //dd($arr_interview);

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['act_revenue_ern']           = $act_revenue_ern;
        $this->arr_view_data['total_revenue_ern']         = $total_revenue_ern;
        $this->arr_view_data['act_revenue_pen']           = $act_revenue_pen;
        $this->arr_view_data['arr_interview']             = $arr_interview;
        $this->arr_view_data['arr_user_details']          = $arr_user_details;
        $this->arr_view_data['arr_user_email']            = $arr_user_email;
        $this->arr_view_data['sale']                      = $sale;
        $this->arr_view_data['referencebook_public_path'] = $this->member_referencebook_public_path;
        $this->arr_view_data['realtime_public_path']      = $this->member_realtime_attachment_public_path;

        $this->arr_view_data['company_public_path']   =$this->member_company_attachment_public_path;
        $this->arr_view_data['company_base_path']   =$this->member_company_attachment_path;

        if(\Request::segment(2)=='upload_history')
        {    
            return view($this->module_view_folder.'.upload_history',$this->arr_view_data);
        }
        if(\Request::segment(2)=='manage_upload_history')
        {    
            return view($this->module_view_folder.'.manage_upload_history',$this->arr_view_data);
        }
    }
    public function real_time_experience()
    {
        $arr_user_details=[];
        $obj_user_details = $this->AccountSettingModel->get();
        if($obj_user_details)
        {
            $arr_user_details = $obj_user_details->toArray();
        }
        $arr_user_email=[];
        $obj_user_email = $this->ManageEmailModel->get();
        if($obj_user_email)
        {
            $arr_user_email = $obj_user_email->toArray();
        }
        $this->arr_view_data['arr_user_details']   = $arr_user_details;
        $this->arr_view_data['arr_user_email']     = $arr_user_email;
        return view($this->module_view_folder.'.add_realtime_experience',$this->arr_view_data);
    }
    public function store_real_time_experience(Request $request)
    {
        $issue_title = $request->input('issue_title');
        $durationVideoReal = $request->input('durationVideoReal');
        
        if($issue_title=='')
        {
            $arr_response['status'] ='invalid_issue_title';
            $arr_response['msg'] = 'This field is required.'; 
            return response()->json($arr_response);        
        } 


        $topic_name_length = strlen($issue_title);
        if($topic_name_length>300)
        {
            $arr_response['status'] ='topic_length';
            $arr_response['msg'] = 'Topic name should be less than 300 character'; 
            return response()->json($arr_response);   
        }
        
        $file_name='';
        if($request->hasFile('realtime'))
        {   
            //$bytes = File::size($request->file('realtime'));
			$bytes = (File::size($request->file('realtime'))* .0009765625) * .0009765625;
			$sizeFile = (File::size($request->file('realtime'))* .0009765625) * .0009765625;
			
            $fileExtension = strtolower($request->file('realtime')->getClientOriginalExtension()); 

              $arr_file_types = ['pdf','mp4'];

            if(in_array($fileExtension, $arr_file_types))
            {
                if($fileExtension == 'pdf')
				{
					if($bytes<=5)
					{
						$file_name      = $request->input('realtime');
						$file_extension = strtolower($request->file('realtime')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('realtime')->move($this->member_realtime_attachment_path, $file_name); 
						//page count
						
						if (!$fp = @fopen("uploads/real_time_attachment/".$file_name,"r")) {
							$pageCount="";
							$file_extension='';
							$fileSize='';
						}
						else 
						{
							$max=0;
							while(!feof($fp)) {
									$line = fgets($fp,255);
									if (preg_match('/\/Count [0-9]+/', $line, $matches)){
											preg_match('/[0-9]+/',$matches[0], $matches2);
											if ($max<$matches2[0]) $max=$matches2[0];
									}
							}
							fclose($fp);
							$pageCount=$max." Pages";
							$file_extension='Pdf';
							$fileSize=$sizeFile;
						}
						
						// end pages count
					}
					
					else
					{
						$arr_response['status'] ='invalid_file';
						$arr_response['msg'] = 'Please upload valid file with max size 5 MB.'; 
						return response()->json($arr_response);       
					}
				}
				else
				{
					if($bytes<300)
					{
						$file_name      = $request->input('realtime');
						$file_extension = strtolower($request->file('realtime')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('realtime')->move($this->member_realtime_attachment_path, $file_name); 
						
						$pageCount=$durationVideoReal;
						$file_extension='Video';
						$fileSize=$sizeFile;
					}
					else
					{
						$arr_response['status'] ='invalid_file';
						$arr_response['msg'] = 'Please upload valid file with max size 300 MB.'; 
						return response()->json($arr_response);       
					}
				}
            }

            else
            {
                $arr_response['status'] ='invalid_file';
                $arr_response['msg'] = 'Please upload valid file with pdf extension.'; 
                return response()->json($arr_response);
            } 
        }
        else        
        {
            $arr_response['status'] ='invalid_file';
            $arr_response['msg'] = 'This field is required.'; 
            return response()->json($arr_response);       
        }
        $arr_data['attachment']=$file_name;
        $interview_id = $request->input('id');
        $arr_data['user_id']          = $this->user_id;
        $arr_data['member_id']        = $this->member_id;
        $arr_data['interview_id']     = $interview_id;
        $arr_data['skill_id']         = base64_decode($request->input('skill_id'));
        $arr_data['experience_level'] = base64_decode($request->input('experience'));
        $arr_data['issue_title']      = $request->input('issue_title');
        $arr_data['pageCount']      	= $pageCount;
        $arr_data['file_extension']      = $file_extension;
        $arr_data['fileSize']      		= $fileSize;
        
        $result = $this->RealtimeExperienceModel->create($arr_data);
        if($result)
        {
            $arr_response['status'] ='success';
            $arr_response['msg'] = 'Realtime work experience added successfully.'; 
            return response()->json($arr_response);
            /*Flash::success('Realtime work experience added successfully.'); 
            return redirect('member/manage_upload_history');*/     
        }
        else
        {
            $arr_response['status'] ='error';
            $arr_response['msg'] = 'Error while adding Realtime work experience.'; 
            return response()->json($arr_response);    
        }   
    }
    public function delete_interview($company_id)
    {
        $company_id = base64_decode($company_id);
		//DB::table('company_master')->where('company_id', $company_id)->delete();
        $delete = $this->InterviewDetailModel
                                            ->where('user_id',$this->user_id)
                                            ->where('id',$company_id)
                                            ->delete();
        if($delete)
        {
            Flash::success('Interview deleted successfully.');
        }   
        else
        {
            Flash::error('Error while interview deletion');
        }                                 
        return redirect()->back();
    }
	public function delete_interview_all($company_id)
    {
        $company_id = base64_decode($company_id);
		DB::table('company_master')->where('company_id', $company_id)->delete();
        $delete = $this->InterviewDetailModel
                                            ->where('user_id',$this->user_id)
                                            ->where('company_id',$company_id)
                                            ->delete();
		
        if($delete)
        {
            Flash::success('Interview deleted successfully.');
        }   
        else
        {
            Flash::error('Error while interview deletion');
        }                                 
        return redirect()->back();
    }

    public function delete_realtime_work_experience($enc_id,$realtime_id)
    {
        $user_id     = base64_decode($enc_id);
        $realtime_id = base64_decode($realtime_id);
        
        $delete = $this->RealtimeExperienceModel->where('user_id',$user_id)
                                            ->where('id',$realtime_id)
                                            ->delete();
        if($delete)
        {
            Flash::success('Realtime work experience deleted successfully.');
        }   
        else
        {
            Flash::error('Error while realtime work experience deletion');
        }                                 
        return redirect()->back();
    }
	public function delete_realtime_work_experience_all($enc_id,$issue_title)
    {
        $user_id     = base64_decode($enc_id);
        $issue_title = base64_decode($issue_title);
        
        $delete = $this->RealtimeExperienceModel->where('user_id',$user_id)
                                            ->where('issue_title',$issue_title)
                                            ->delete();
        if($delete)
        {
            Flash::success('Realtime work experience deleted successfully.');
        }   
        else
        {
            Flash::error('Error while realtime work experience deletion');
        }                                 
        return redirect()->back();
    }
	 public function freePreviewReal($enc_id,$realtime_id)
    {
        $user_id     = base64_decode($enc_id);
        $realtime_id = base64_decode($realtime_id);
        
        $updateReal = $this->RealtimeExperienceModel->where('user_id',$user_id)
                                            ->where('id',$realtime_id)
                                            ->update(['freePreview' => 'Yes']);
        if($updateReal)
        {
            Flash::success('Your video make as a free preview successfully.');
        }   
        else
        {
            Flash::error('Error while make free preview');
        }                                 
        return redirect()->back();
    }

     public function freePreviewCompany($enc_id,$realtime_id)
    {
        $user_id     = base64_decode($enc_id);
        $realtime_id = base64_decode($realtime_id);
        
        $updateComapny = $this->InterviewDetailModel->where('user_id',$user_id)
                                            ->where('id',$realtime_id)
                                            ->update(['freePreview' => 'Yes']);
        if($updateComapny)
        {
            Flash::success('Your video make as a free preview successfully.');
        }   
        else
        {
            Flash::error('Error while make free preview');
        }                                 
        return redirect()->back();
    }
	
	public function updatecreate_reference_book(Request $request) // Ramakrishna
    {

        $id = $request->input('id');
        $topic_name = $request->input('topic_name');

        if($topic_name=='')
        {
            $arr_response['status'] ='invalid_topic_name';
            $arr_response['msg'] = 'This field is required.'; 
            return response()->json($arr_response);
        }

        $topic_name_length = strlen($topic_name);
        if($topic_name_length>300)
        {
            $arr_response['status'] ='topic_length';
            $arr_response['msg'] = 'Topic name should be less than 300 character'; 
            return response()->json($arr_response);   
        }        

        if($request->hasFile('refrencebook'))
        {   
            $bytes = (File::size($request->file('refrencebook'))* .0009765625) * .0009765625;
            $sizeFile = (File::size($request->file('refrencebook'))* .0009765625) * .0009765625;
			
            $fileExtension = strtolower($request->file('refrencebook')->getClientOriginalExtension()); 

            $arr_file_types = ['pdf','mp4'];

            if(in_array($fileExtension, $arr_file_types))
            {
				if($fileExtension == 'pdf')
				{
					if($bytes<5)
					{
						if(isset($refrencebook) && $refrencebook!='')
						{
						   if(File::exists($this->member_referencebook_path.$refrencebook))
							{
								@unlink($this->member_referencebook_path.$refrencebook);
							}
						}
						
						$file_name      = $request->input('refrencebook');
						$file_extension = strtolower($request->file('refrencebook')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('refrencebook')->move($this->member_referencebook_path, $file_name);
						//page count
						if (!$fp = @fopen("uploads/refrence_book/".$file_name,"r")) {
							$pageCount="";
							$file_extension='';
							$fileSize='';
						}
						else 
						{
							$max=0;
							while(!feof($fp)) {
									$line = fgets($fp,255);
									if (preg_match('/\/Count [0-9]+/', $line, $matches)){
											preg_match('/[0-9]+/',$matches[0], $matches2);
											if ($max<$matches2[0]) $max=$matches2[0];
									}
							}
							fclose($fp);
							$pageCount=$max." Pages";
							$file_extension='Pdf';
							$fileSize=$sizeFile;
						}
						// end pages count
				    }
					else
					{
						$arr_response['status'] = "ERROR";
						$arr_response['msg']    = "Please upload valid file with max size 5 MB";
						return response()->json($arr_response);
						
					}
				}else{
					
					if($bytes<300)
					{

						if(isset($refrencebook) && $refrencebook!='')
						{
						   if(File::exists($this->member_referencebook_path.$refrencebook))
							{
								@unlink($this->member_referencebook_path.$refrencebook);
							}
						}
						
						$file_name      = $request->input('refrencebook');
						$file_extension = strtolower($request->file('refrencebook')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('refrencebook')->move($this->member_referencebook_path, $file_name);
						
						//$pageCount=$durationVideo;
						$pageCount="";
						$file_extension='Video';
						$fileSize=$sizeFile;
				    }
					else
					{
						$arr_response['status'] = "ERROR";
						$arr_response['msg']    = "Please upload valid file with max size 300 MB";
						return response()->json($arr_response);
					}
				}
            }
            else
            {
                $arr_response['status']    = "ERROR";
                $arr_response['msg'] = "Please upload valid file with pdf extension";
                return response()->json($arr_response);
            } 
            
        } 
        else
        {
            $arr_response['status'] = "ERROR";
            $arr_response['msg']    = "This field is required.";
            return response()->json($arr_response);
        } 
		
        $arr_update = [];
        $arr_update['mul_reference_book'] = $file_name;
        $arr_update['topic_name'] = $topic_name;
        $arr_update['pageCount'] = $pageCount;
        $arr_update['file_extension'] = $file_extension;
        $arr_update['fileSize'] = $fileSize;
        $obj_update = $this->MultiReferenceBookModel
                                            ->where('id',$id)
                                            ->update($arr_update);
		//create($arr_create);
        if($obj_update)
        {
            $arr_response['status'] = "SUCCESS";
            $arr_response['msg']    = "Interview Q & A updated successfully";
        }                          
        else
        {
            $arr_response['status'] = "error";
            $arr_response['msg']    = "Error while updating interview Q & A";
        }  
        return response()->json($arr_response);        
    }
    public function create_reference_book(Request $request) // Ramakrishna
    {
        $skill_id = $request->input('skill_id');
        $experience_level = $request->input('experience_level');
        $interview_id = $request->input('id');
        $topic_name = $request->input('topic_name');
        $durationVideo = $request->input('durationVideo');

        if($topic_name=='')
        {
            $arr_response['status'] ='invalid_topic_name';
            $arr_response['msg'] = 'This field is required.'; 
            return response()->json($arr_response);
        }

        $topic_name_length = strlen($topic_name);
        if($topic_name_length>300)
        {
            $arr_response['status'] ='topic_length';
            $arr_response['msg'] = 'Topic name should be less than 300 character'; 
            return response()->json($arr_response);   
        }        

        if($request->hasFile('refrencebook'))
        {   
            $bytes = (File::size($request->file('refrencebook'))* .0009765625) * .0009765625;
            $sizeFile = (File::size($request->file('refrencebook'))* .0009765625) * .0009765625;
			
            $fileExtension = strtolower($request->file('refrencebook')->getClientOriginalExtension()); 

            $arr_file_types = ['pdf','mp4'];

            if(in_array($fileExtension, $arr_file_types))
            {
				if($fileExtension == 'pdf')
				{
					if($bytes<5)
					{
						$file_name      = $request->input('refrencebook');
						$file_extension = strtolower($request->file('refrencebook')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('refrencebook')->move($this->member_referencebook_path, $file_name);
						//page count
						if (!$fp = @fopen("uploads/refrence_book/".$file_name,"r")) {
							$pageCount="";
							$file_extension='';
							$fileSize='';
						}
						else 
						{
							$max=0;
							while(!feof($fp)) {
									$line = fgets($fp,255);
									if (preg_match('/\/Count [0-9]+/', $line, $matches)){
											preg_match('/[0-9]+/',$matches[0], $matches2);
											if ($max<$matches2[0]) $max=$matches2[0];
									}
							}
							fclose($fp);
							$pageCount=$max." Pages";
							$file_extension='Pdf';
							$fileSize=$sizeFile;
						}
						// end pages count
				    }
					else
					{
						$arr_response['status'] = "ERROR";
						$arr_response['msg']    = "Please upload valid file with max size 5 MB";
						return response()->json($arr_response);
						
					}
				}else{
					if($bytes<300)
					{
						$file_name      = $request->input('refrencebook');
						$file_extension = strtolower($request->file('refrencebook')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('refrencebook')->move($this->member_referencebook_path, $file_name);
						$pageCount=$durationVideo;
						$file_extension='Video';
						$fileSize=$sizeFile;
				    }
					else
					{
						$arr_response['status'] = "ERROR";
						$arr_response['msg']    = "Please upload valid file with max size 300 MB";
						return response()->json($arr_response);
					}
				}
            }
            else
            {
                $arr_response['status']    = "ERROR";
                $arr_response['msg'] = "Please upload valid file with pdf extension";
                return response()->json($arr_response);
            } 
            
        } 
        else
        {
            $arr_response['status'] = "ERROR";
            $arr_response['msg']    = "This field is required.";
            return response()->json($arr_response);
        } 
		
        $arr_create = [];
        $arr_create['mul_reference_book'] = $file_name;
        $arr_create['topic_name'] = $topic_name;
        $arr_create['interview_id'] = $interview_id;
        $arr_create['pageCount'] = $pageCount;
        $arr_create['file_extension'] = $file_extension;
        $arr_create['fileSize'] = $fileSize;
        $obj_create = $this->MultiReferenceBookModel->create($arr_create);
        if($obj_create)
        {
            $arr_response['status'] = "SUCCESS";
            $arr_response['msg']    = "New Topic added successfully";
        }                          
        else
        {
            $arr_response['status'] = "error";
            $arr_response['msg']    = "Error while adding reference book";
        }  
        return response()->json($arr_response);        
    }

    public function update_realtime_attachment(Request $request)
    {
        $id          = $request->input('id');
        
        $issue_title = $request->input('issue_title');
        if($issue_title=='')
        {
            $arr_response['status'] ='invalid_issue_title';
            $arr_response['msg'] = 'This field is required.'; 
            return response()->json($arr_response);        
        } 
        
        $file_exists = $this->RealtimeExperienceModel
                                                ->where('user_id',$this->user_id)
                                                ->where('id',$id)
                                                ->first();
        if($file_exists)
        {
            $arr_file_exists = $file_exists->toArray();
        }                                        
        $file_name = $arr_file_exists['attachment'];

        if($request->hasFile('realtime'))
        {   
            //$bytes = File::size($request->file('realtime'));
			$bytes = (File::size($request->file('realtime'))* .0009765625) * .0009765625;
			$sizeFile = (File::size($request->file('realtime'))* .0009765625) * .0009765625;
			
            $fileExtension = strtolower($request->file('realtime')->getClientOriginalExtension()); 
            $arr_file_types = ['pdf','mp4'];

            if(in_array($fileExtension, $arr_file_types))
            {
                /*
				if($bytes<=500000)
                {
                    if(isset($realtime) && $realtime!='')
                    {
                       if(File::exists($this->member_realtime_attachment_path.$realtime))
                        {
                            @unlink($this->member_realtime_attachment_path.$realtime);
                        }
                    }
                    $file_name      = $request->input('realtime');
                    $file_extension = strtolower($request->file('realtime')->getClientOriginalExtension()); 
                    $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                    $request->file('realtime')->move($this->member_realtime_attachment_path, $file_name);
                }
                else
                {
                    $arr_response['status'] = "ERROR";
                    $arr_response['msg']    = "Please upload valid file with max size 500 kb";
                    return response()->json($arr_response);
                }
				*/
				if($fileExtension == 'pdf')
				{
					if($bytes<=5)
					{
						if(isset($realtime) && $realtime!='')
						{
						   if(File::exists($this->member_realtime_attachment_path.$realtime))
							{
								@unlink($this->member_realtime_attachment_path.$realtime);
							}
						}
					
						$file_name      = $request->input('realtime');
						$file_extension = strtolower($request->file('realtime')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('realtime')->move($this->member_realtime_attachment_path, $file_name); 
						//page count
						
						if (!$fp = @fopen("uploads/real_time_attachment/".$file_name,"r")) {
							$pageCount="";
							$file_extension='';
							$fileSize='';
						}
						else 
						{
							$max=0;
							while(!feof($fp)) {
									$line = fgets($fp,255);
									if (preg_match('/\/Count [0-9]+/', $line, $matches)){
											preg_match('/[0-9]+/',$matches[0], $matches2);
											if ($max<$matches2[0]) $max=$matches2[0];
									}
							}
							fclose($fp);
							$pageCount=$max." Pages";
							$file_extension='Pdf';
							$fileSize=$sizeFile;
						}
						
						// end pages count
					}
					
					else
					{
						$arr_response['status'] ='invalid_file';
						$arr_response['msg'] = 'Please upload valid file with max size 5 MB.'; 
						return response()->json($arr_response);       
					}
				}
				else
				{
					if($bytes<300)
					{
						if(isset($realtime) && $realtime!='')
						{
						   if(File::exists($this->member_realtime_attachment_path.$realtime))
							{
								@unlink($this->member_realtime_attachment_path.$realtime);
							}
						}
						$file_name      = $request->input('realtime');
						$file_extension = strtolower($request->file('realtime')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('realtime')->move($this->member_realtime_attachment_path, $file_name); 
						
						//$pageCount=$durationVideoReal;
						$pageCount="";
						$file_extension='Video';
						$fileSize=$sizeFile;
					}
					else
					{
						$arr_response['status'] ='invalid_file';
						$arr_response['msg'] = 'Please upload valid file with max size 300 MB.'; 
						return response()->json($arr_response);       
					}
				}
            }
            else
            {
                $arr_response['status']    = "ERROR";
                $arr_response['msg'] = "Please upload valid file with pdf extension";
                return response()->json($arr_response);
            } 
            
        }
		
        $obj_update = $this->RealtimeExperienceModel
                                                    ->where('user_id',$this->user_id)
                                                    ->where('id',$id) 
                                                    ->update(['attachment'=>$file_name,'issue_title'=>$issue_title, 'pageCount'=>$pageCount, 'file_extension'=>$file_extension, 'fileSize'=>$fileSize]);
        if($obj_update)
        {
            $arr_response['status'] ='success';
            $arr_response['msg'] = 'Realtime work experience updated successfully.'; 
            return response()->json($arr_response);
        }                          
        else
        {
            $arr_response['status'] = "error";
            $arr_response['msg']    = "Error while Realtime work experience updation";
            return response()->json($arr_response);
        }                                    
    }

    public function manage_alert()
    {
       $login_id = $this->user_id; 
       $arr_data = [];
       $obj_data = $this->UserAlertsModel
                        ->with(['skills'])
                        ->where('user_id',$login_id)
                        ->where('is_active','=',1)
                        ->orderBy('alert_id','desc')
                        ->paginate(5);

       if($obj_data)
       {
         $arr_pagination = clone $obj_data;
         $arr_data = $obj_data->toArray();
       }
       $arr_skill = [];
       $obj_skill = $this->SkillsModel->get();
       if($obj_skill)
       {
            $arr_skill = $obj_skill->toArray();
       }  
       $skill_name='';    
       $this->arr_view_data['skill_name']        = $skill_name;
       $this->arr_view_data['arr_pagination']    = $arr_pagination;    
       $this->arr_view_data['arr_data']    = $arr_data;  
       $this->arr_view_data['arr_skill']    = $arr_skill; 
       $this->arr_view_data['module_title'] = 'My Alerts';
       return view($this->module_view_folder.'.my_alerts', $this->arr_view_data); 
    }

    public function create_alert()
    { 
        $arr_data = [];
        $obj_data = $this->UserAlertsModel->with(['skills'])->get();
        if($obj_data)
        {
         $arr_data = $obj_data->toArray();
        }
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';    
        $this->arr_view_data['skill_name']        = $skill_name;
        $this->arr_view_data['arr_data']    = $arr_data;  
        $this->arr_view_data['arr_skill']    = $arr_skill; 

        $this->arr_view_data['module_title'] = 'My Alerts';
        return view($this->module_view_folder.'.create_alert', $this->arr_view_data); 
    }

    public function getskills()
    {
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skillname=[];
        foreach($arr_skill as $key => $value) 
        {
            $skillname[$key]['label'] = ucfirst($value['skill_name']);
            $skillname[$key]['value'] = $value['id'];
        }
        $skills=$skillname;
        return json_encode($skills);
    }

    public function store_alerts(Request $request)
    {
        $arr_rules['skill']                 = "required";
        $arr_rules['experience']            = "required";
        $arr_rules['alert_name']            = "required";
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }  

        $does_exists = $this->UserAlertsModel 
                            ->where('user_id','=',$this->user_id)
                            ->where('skill_id','=',$request->input('skill'))
                            ->where('exp_level','=',$request->input('experience'))
                            ->count();    

        if($does_exists)
        {
            Flash::error('Alert Already Exists.');
            return redirect()->back()->withInput($request->all());
        }   

        $skill_set = $request->input('skill_set');
        if($skill_set == "")
        {
            $skill_set = 'No';
        }    

        $arr_data['user_id']            = $this->user_id;
        $arr_data['skill_id']           = $request->input('skill');
        $arr_data['exp_level']          = $request->input('experience');
        $arr_data['alert_name']         = $request->input('alert_name');
        $arr_data['skill_set']          = $skill_set;
        $arr_data['user_type']          = 'Member';

        $result = $this->UserAlertsModel->create($arr_data);
        if($result)
        {
            Flash::success('User alerts added successfully'); 
        }
        else
        {
            Flash::error('Error! While adding user alerts'); 
        }
         return redirect()->back();
    }
     public function view_alert($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_data = [];
        $obj_data = $this->UserAlertsModel->where('alert_id',$id)->with(['skills'])->first();
        if($obj_data)
        {
         $arr_data = $obj_data->toArray();
        }
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']    = $arr_skill;
        $this->arr_view_data['skill_name']   = $skill_name;
        $this->arr_view_data['module_title'] = 'My Alerts';
        $this->arr_view_data['arr_data']    = $arr_data;  
        return view($this->module_view_folder.'.view_alert', $this->arr_view_data); 
    }

    public function edit_alert($enc_id)
    { 
       $alert_id = base64_decode($enc_id); 
       $arr_data = [];
       $obj_data = $this->UserAlertsModel->where('alert_id',$alert_id)->with(['skills'])->first();
       if($obj_data)
       {
         $arr_data = $obj_data->toArray();
       }
       $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        } 

      $skill_name='';
      $this->arr_view_data['skill_name']             = $skill_name;     
      $this->arr_view_data['arr_data']    = $arr_data;  
      $this->arr_view_data['arr_skill']    = $arr_skill; 
      $this->arr_view_data['module_title'] = 'My Alerts';
      return view($this->module_view_folder.'.edit_alert', $this->arr_view_data); 
    }

    public function update_alert(Request $request)
    {
        $id = $request->input('enc_id');
        $arr_rules['skill']                 = "required";
        $arr_rules['experience']            = "required";
        $arr_rules['alert_name']            = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $does_exists = $this->UserAlertsModel 
                            ->where('user_id','<>',$this->user_id)
                            ->where('skill_id','=',$request->input('skill'))
                            ->where('exp_level','=',$request->input('experience'))
                            ->count();    

        if($does_exists)
        {
            Flash::error('Alert Already Exists.');
            return redirect()->back()->withInput($request->all());
        }   


        $skill_set = $request->input('skill_set');
        if($skill_set == "")
        {
            $skill_set = 'No';
        }else{
            $skill_set = 'Yes';
        }  

        $arr_user_data['skill_id']      = $request->input('skill');
        $arr_user_data['exp_level']     = $request->input('experience');
        $arr_user_data['alert_name']    = $request->input('alert_name');
        $arr_user_data['skill_set']     = $skill_set;
        $arr_user_data['user_type']     = 'Member';

        $user_data = $this->UserAlertsModel->where('alert_id',$id)->update($arr_user_data);
        if($user_data)
        {
            Flash::success('User alerts updated successfully.'); 
            return redirect(url('/member/manage_alert'));
        }
        else
        {
            Flash::error('Error! While update user alerts.'); 
            return redirect()->back();
        }
    }

    public function delete_alert($enc_id)
    {
        $alert_id = base64_decode($enc_id);
        $delete_alert = $this->UserAlertsModel->where('alert_id',$alert_id)->delete();
        if($delete_alert)
        {
            Flash::success('Alert deleted successfully.');
        }
        else
        {
            Flash::error('Error while Alert deletion.');
        } 
        return redirect()->back();   
    }
        
    public function multi_action(Request $request)
    {
        $arr_rules = array();
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.str_plural($this->module_title) .' To Perform Multi Actions');  
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $multi_action = 'delete';
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Session::flash('error','Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
               $this->perform_delete(base64_decode($record_id));    
               Flash::success('Alert Deleted Successfully.'); 
            } 
        }

        return redirect()->back();
    }

    public function perform_delete($id)
    {
        $entity = $this->UserAlertsModel->where('alert_id',$id)->first();
        if($entity)
        {
           $delete_success = $this->UserAlertsModel->where('alert_id',$id)->delete();
           return $delete_success;
        }
        return FALSE;
    }

    public function store_company(Request $request)
    { 
        $arr_response =[];

        if($request->input('company_name')=='')
        {
            $arr_response['status'] ='invalid_company_id';
            $arr_response['msg'] = 'This field is required.'; 
            return response()->json($arr_response);
        }

        $topic_name=$request->input('company_name');
        $topic_name_length = strlen($topic_name);
        if($topic_name_length>300)
        {
            $arr_response['status'] ='topic_length';
            $arr_response['msg'] = 'Topic name should be less than 300 character'; 
            return response()->json($arr_response);   
        }   
        
        if($request->input('location')=='')
        {
            $arr_response['status'] ='invalid_location';
            $arr_response['msg'] = 'This field is required.'; 
            return response()->json($arr_response);
        }
        if($request->hasFile('attachment'))
        {   
            //$bytes = File::size($request->file('attachment'));
			$bytes = (File::size($request->file('attachment'))* .0009765625) * .0009765625;
			$sizeFile = (File::size($request->file('attachment'))* .0009765625) * .0009765625;
			
            $fileExtension = strtolower($request->file('attachment')->getClientOriginalExtension()); 

              $arr_file_types = ['pdf','mp4'];

            if(in_array($fileExtension, $arr_file_types))
            {
				if($fileExtension == 'pdf')
				{
					if($bytes<=5)
					{
						$file_name      = $request->input('attachment');
						$file_extension = strtolower($request->file('attachment')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('attachment')->move($this->member_company_attachment_path, $file_name);
						
						//page count
						if (!$fp = @fopen("uploads/company_attachment/".$file_name,"r")) {
							$pageCount="";
							$file_extension='';
							$fileSize='';
						}
						else 
						{
							$max=0;
							while(!feof($fp)) {
									$line = fgets($fp,255);
									if (preg_match('/\/Count [0-9]+/', $line, $matches)){
											preg_match('/[0-9]+/',$matches[0], $matches2);
											if ($max<$matches2[0]) $max=$matches2[0];
									}
							}
							fclose($fp);
							$pageCount=$max." Pages";
							$file_extension='Pdf';
							$fileSize=$sizeFile;
						}
						// end pages count
						
					}
					else
					{
						$arr_response['status'] ='invalid_file';
						$arr_response['msg'] = 'Please upload valid file with max size 5 MB.'; 
						return response()->json($arr_response);       
					}
				}else{
					if($bytes<300)
					{
						$file_name      = $request->input('attachment');
						$file_extension = strtolower($request->file('attachment')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('attachment')->move($this->member_company_attachment_path, $file_name);
						
						$pageCount=$request->input('durationVideoCall');
						$file_extension='Video';
						$fileSize=$sizeFile;
				    }
					else
					{
						$arr_response['status'] = "ERROR";
						$arr_response['msg']    = "Please upload valid file with max size 300 MB";
						return response()->json($arr_response);
					}
				}
            }

            else
            {
                $arr_response['status'] ='invalid_file';
                $arr_response['msg'] = 'Please upload valid file with pdf extension.'; 
                return response()->json($arr_response);
            } 
        }
        else
        {
            $arr_response['status'] ='file_required';
            $arr_response['msg'] = 'This field is required.'; 
            return response()->json($arr_response);       
        }
        $company_name = trim(ucfirst($request->input('company_name')));
        
        if($company_name!='')
        {
            $does_exists_company = $this->CompanyModel->where('company_name',$company_name)->first();
            if($does_exists_company)
            {
                $company_id = $does_exists_company['company_id'];
            }    
            else
            {
                $create_company = $this->CompanyModel->create(['company_name'=>$company_name]);
                $company_id = $create_company->id;
            }
        }
        $arr_create['attachment']       = $file_name;
        $arr_create['company_id']       = $company_id;
        $arr_create['company_location'] = $request->input('location');
        $arr_create['skill_id']         = $request->input('skill_id');
        $arr_create['experience_level'] = $request->input('experience_level');
        $arr_create['interview_id']     = $request->input('interview_id');
        $arr_create['user_id']          = $this->user_id;
		$arr_create['roundType']        = $request->input('roundType');
		$arr_create['pageCount']        = $pageCount;
		$arr_create['file_extension']   = $file_extension;
		$arr_create['fileSize']   		= $fileSize;
        $create_company                 = $this->InterviewDetailModel->create($arr_create);
        
        if($create_company)
        {
            $arr_response['status'] ='success';
            $arr_response['msg'] = 'Company added successfully.'; 
            return response()->json($arr_response);
        }
        else
        {
            $arr_response['status'] ='error';
            $arr_response['msg'] = 'Error while adding Interview.'; 
            return response()->json($arr_response);     
        }    
    }
    
    public function update_company(Request $request)
    {
        $arr_response =[];
        $company_id=$request->input('id');
        $obj_company_info = $this->InterviewDetailModel->where('id',$company_id)
                                                       ->where('user_id',$this->user_id)
                                                       ->first(['attachment']);

        $attachment = $obj_company_info['attachment'];
        $file_name = $attachment;                                                              
        if($request->hasFile('attachment'))
        {   
            //$bytes = File::size($request->file('attachment'));
			
			$bytes = (File::size($request->file('attachment'))* .0009765625) * .0009765625;
			$sizeFile = (File::size($request->file('attachment'))* .0009765625) * .0009765625;
			
            $fileExtension = strtolower($request->file('attachment')->getClientOriginalExtension()); 

            //$arr_file_types = ['pdf'];
			$arr_file_types = ['pdf','mp4'];

            if(in_array($fileExtension, $arr_file_types))
            {
				/*
                if($bytes<=500000)
                {
                    if(isset($attachment) && $attachment!='')
                    {
                       if(File::exists($this->member_company_attachment_path.$attachment))
                        {
                            @unlink($this->member_company_attachment_path.$attachment);
                        }
                    }
                    $file_name      = $request->input('attachment');
                    $file_extension = strtolower($request->file('attachment')->getClientOriginalExtension()); 
                    $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                    $request->file('attachment')->move($this->member_company_attachment_path, $file_name);   
                }
                else
                {
                    $arr_response['status'] = 'invalid_file';
                    $arr_response['msg']    = "Please upload valid file with max size 500 kb";
                    return response()->json($arr_response);
                }
				*/
				if($fileExtension == 'pdf')
				{
					if($bytes<=5)
					{
						if(isset($attachment) && $attachment!='')
						{
						   if(File::exists($this->member_company_attachment_path.$attachment))
							{
								@unlink($this->member_company_attachment_path.$attachment);
							}
						}
					
						$file_name      = $request->input('attachment');
						$file_extension = strtolower($request->file('attachment')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('attachment')->move($this->member_company_attachment_path, $file_name);
						
						//page count
						if (!$fp = @fopen("uploads/company_attachment/".$file_name,"r")) {
							$pageCount="";
							$file_extension='';
							$fileSize='';
						}
						else 
						{
							$max=0;
							while(!feof($fp)) {
									$line = fgets($fp,255);
									if (preg_match('/\/Count [0-9]+/', $line, $matches)){
											preg_match('/[0-9]+/',$matches[0], $matches2);
											if ($max<$matches2[0]) $max=$matches2[0];
									}
							}
							fclose($fp);
							$pageCount=$max." Pages";
							$file_extension='Pdf';
							$fileSize=$sizeFile;
						}
						// end pages count
						
					}
					else
					{
						$arr_response['status'] ='invalid_file';
						$arr_response['msg'] = 'Please upload valid file with max size 5 MB.'; 
						return response()->json($arr_response);       
					}
				}else{
					if($bytes<300)
					{
						if(isset($attachment) && $attachment!='')
						{
						   if(File::exists($this->member_company_attachment_path.$attachment))
							{
								@unlink($this->member_company_attachment_path.$attachment);
							}
						}
						$file_name      = $request->input('attachment');
						$file_extension = strtolower($request->file('attachment')->getClientOriginalExtension()); 
						$file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
						$request->file('attachment')->move($this->member_company_attachment_path, $file_name);
						
						//$pageCount=$request->input('durationVideoCall');
						$pageCount="";
						$file_extension='Video';
						$fileSize=$sizeFile;
				    }
					else
					{
						$arr_response['status'] = "ERROR";
						$arr_response['msg']    = "Please upload valid file with max size 300 MB";
						return response()->json($arr_response);
					}
				}
				
            }
            else
            {
                $arr_response['status']    = 'invalid_file';
                $arr_response['msg'] = "Please upload valid file with pdf extension";
                return response()->json($arr_response);
            }    
        }
        $arr_update['attachment']=$file_name;
		$arr_update['roundType']        = $request->input('roundType');
		$arr_update['pageCount']        = $pageCount;
		$arr_update['file_extension']   = $file_extension;
		$arr_update['fileSize']   		= $fileSize;
		
        $update_company = $this->InterviewDetailModel->where('id',$company_id)->update($arr_update);
        if($update_company)
        {
            $arr_response['status'] ='success';
            $arr_response['msg'] = 'Company updated successfully.'; 
            return response()->json($arr_response);   
        }
        else
        {
            $arr_response['status'] ='error';
            $arr_response['msg'] = 'Error while updating Interview.'; 
            return response()->json($arr_response);     
        }
    }

   public function purchase_history()
   {
        $current_date = date('Y-m-d');
         
        $user_id = $this->user_id;
        $obj_transaction= $this->TransactionModel
                                 ->with(['purchase_history','member_detail','user_detail','purchase_history.interview_attachment','member_interview_info',
                                    'multi_ref_book'=> function($ref_book)
                                    {
                                        $ref_book->where('approve_status',1); 
                                    }
                                    ])
                                 ->where('user_id',$user_id)
                                 ->where('payment_status','=','paid')
                                 ->where('user_deleted','=',0)
                                 ->where('end_date','>=',$current_date)
                                 ->orderBy('id','desc')
                                 ->paginate(10);                         
        if($obj_transaction)
        {
            $arr_pagination = clone $obj_transaction;
            $arr_transaction = $obj_transaction->toArray();
        }
        /*dd($arr_transaction);*/
        
        foreach($arr_transaction['data'] as $key => $details) 
        {	
            if($details['reference_book']=='Yes')
            {   $i=0;
                foreach($details['multi_ref_book'] as  $value) 
                {
                    if($value['updated_at']<=$details['created_at'])
                    {
                        $i=$i+1; 
                    }
                    $arr_transaction['data'][$key]['reference_book_count']=$i;
                }
                
            }
        }
        /*dd($arr_transaction);*/
	  	foreach($arr_transaction['data'] as $key => $details) 
      	{
	         $arr_transaction['data'][$key]['interview_count'] = count($details['purchase_history']);
	         $arr_transaction['data'][$key]['interview_count_arr'] = count($details['purchase_history'][0]['interview_attachment']);
	         $arr_transaction['data'][$key]['ticket_name'] = $details['purchase_history'][0]['ticket_name'];
      	}
      	
        $obj_advertise = $this->AdvertisementModel->get();
        if($obj_advertise)
        {
            $arr_advertise = $obj_advertise->toArray();
        }
        /*$this->arr_view_data['reference_book_count']   = $i;*/
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
             $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['arr_advertise']   = $arr_advertise;
        $this->arr_view_data['advertise_public_img_path'] = $this->advertise_public_img_path;
        $this->arr_view_data['arr_transaction'] = $arr_transaction;
        $this->arr_view_data['module_title']    = 'Purchase History';
        $this->arr_view_data['arr_pagination']  = $arr_pagination;
        /*dd($arr_transaction);*/
        if(\Request::segment(2)=='learn')
        {
            $arr_skill = [];
            $obj_skill = $this->SkillsModel->get();
            if($obj_skill)
            {
                 $arr_skill = $obj_skill->toArray();
            }
            $skill_name='';

            $this->arr_view_data['arr_skill']             = $arr_skill;
            $this->arr_view_data['skill_name']             = $skill_name;
            $this->arr_view_data['module_title']    = 'Learn';
            return view($this->module_view_folder.'.learn', $this->arr_view_data);    
        }
        return view($this->module_view_folder.'.purchase_history', $this->arr_view_data); 
   } 

   public function view_purchase($enc_id)
   {    
        $user_id = $this->user_id;
        $id = base64_decode($enc_id);
        $obj_transaction= $this->TransactionModel
                                 ->with(['purchase_history','member_detail','user_detail','purchase_history.interview_attachment','member_interview_info','ticket_details.rwe_details',
                                    'multi_ref_book'=> function($ref_book)
                                    {
                                        $ref_book->where('approve_status',1); 
                                    }
                                    ])
                                 ->where('user_id',$user_id)
                                 ->where('user_deleted','=',0)
                                 ->where('id',$id)
                                 ->first();
        if($obj_transaction)
        {
            $arr_transaction = $obj_transaction->toArray();
        }

        $member_amount      = $arr_transaction['member_amount'];
        $grand_total      = $arr_transaction['grand_total'];
        $member_tax_amount  = ($member_amount*10/100);
        $after_tax_amount   = $member_amount-$member_tax_amount;
        $interview_count    = count($arr_transaction['purchase_history']);
        $interview_count_arr    = count($arr_transaction['purchase_history'][0]['interview_attachment']);
        $ticket_name        = $arr_transaction['purchase_history'][0]['ticket_name'];
        $this->arr_view_data['member_referencebook_public_path'] = $this->member_referencebook_public_path;
        $this->arr_view_data['member_company_attachment_public_path'] = $this->member_company_attachment_public_path;
        $this->arr_view_data['member_realtime_attachment_public_path'] = $this->member_realtime_attachment_public_path;
        
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
             $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['ticket_name']         = $ticket_name;
        $this->arr_view_data['interview_count']     = $interview_count;
        $this->arr_view_data['interview_count_arr'] = $interview_count_arr;
        $this->arr_view_data['after_tax_amount']    = $after_tax_amount;
        $this->arr_view_data['member_tax_amount']   = $member_tax_amount;
        $this->arr_view_data['grand_total']         = $grand_total;
        $this->arr_view_data['arr_transaction']     = $arr_transaction;
        $this->arr_view_data['module_title']        = 'Purchase History Details';
        return view($this->module_view_folder.'.view_purchase_details', $this->arr_view_data); 
   }

   public function view_learn($enc_id,$type)
   {
        $user_id    = $this->user_id;
        $id         = base64_decode($enc_id);
        $learn_type = $type;
        $obj_transaction= $this->TransactionModel
                                 ->with(['purchase_history','member_detail','user_detail','purchase_history.interview_attachment','member_interview_info','ticket_details.rwe_details',
                                    'multi_ref_book'=> function($ref_book)
                                    {
                                        $ref_book->where('approve_status',1); 
                                    }
                                    ])
                                 ->where('user_id',$user_id)
                                 ->where('user_deleted','=',0)
                                 ->where('id',$id)
                                 ->first();
        if($obj_transaction)
        {
            $arr_transaction = $obj_transaction->toArray();
        }
        
        $member_amount      = $arr_transaction['member_amount'];
        $member_tax_amount  = ($member_amount*10/100);
        $after_tax_amount   = $member_amount-$member_tax_amount;
        $interview_count    = count($arr_transaction['purchase_history']);
        $interview_count_arr    = count($arr_transaction['purchase_history'][0]['interview_attachment']);
        $ticket_name        = $arr_transaction['purchase_history'][0]['ticket_name'];
        $this->arr_view_data['member_referencebook_public_path'] = $this->member_referencebook_public_path;
        $this->arr_view_data['member_company_attachment_public_path'] = $this->member_company_attachment_public_path;
        $this->arr_view_data['member_realtime_attachment_public_path'] = $this->member_realtime_attachment_public_path;
        $this->arr_view_data['ticket_name']       = $ticket_name;  
        $this->arr_view_data['interview_count']   = $interview_count;
        $this->arr_view_data['interview_count_arr']   = $interview_count_arr;
        $this->arr_view_data['after_tax_amount']  = $after_tax_amount;
        $this->arr_view_data['member_tax_amount'] = $member_tax_amount;
        $this->arr_view_data['arr_transaction']   = $arr_transaction;
        $this->arr_view_data['learn_type']        = $learn_type; 
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['skill_name']             = $skill_name; 
      
        if($learn_type == 'referencebook')
        {
           $this->arr_view_data['module_title']      = 'Reference Book'; 
           $this->arr_view_data['referencebook_path']=  $this->member_referencebook_folder_path; 
           return view($this->module_view_folder.'.view_learn_details', $this->arr_view_data); 
        }
        elseif($learn_type == 'company')
        {
            $this->arr_view_data['module_title']      = 'Companies';
            $this->arr_view_data['company_attachment_path']=  $this->member_company_attachment_folder_path;
            return view($this->module_view_folder.'.view_learn_company_details', $this->arr_view_data); 
        }
        elseif($learn_type == 'rwe_tickets')
        {
            $this->arr_view_data['module_title']      = 'Real Time Work Experience (Tickets, Tasks, Issues)';
            $this->arr_view_data['realtime_attachment_path']=  $this->member_realtime_attachment_folder_path;
            return view($this->module_view_folder.'.view_learn_rwetickets_details', $this->arr_view_data); 
        } 
   }

   public function multi_action_purchase(Request $request)
   {
       $arr_rules = array();
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.str_plural($this->module_title) .' To Perform Multi Actions');  
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $multi_action = 'delete';
        $checked_record = $request->input('checked_record');

        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Session::flash('error','Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
               $id = base64_decode($record_id);
               $delete_success = $this->TransactionModel->where('id',$id)->update(['user_deleted'=>1]);
               
               if($delete_success)
               {
                  Flash::success('Purchase History Deleted Successfully.'); 
               }
               else 
               {
                  Flash::error('Error while deleting purchase history');     
               }
            } 
        }
        return redirect()->back();
   }

   public function delete_purchase($enc_id)
   {
        $id = base64_decode($enc_id);
        $delete_purchase = $this->TransactionModel->where('id',$id)->update(['user_deleted'=>1]);
        if($delete_purchase)
        {
            Flash::success('Purchase History successfully.');
        }
        else
        {
            Flash::error('Error while purchase history.');
        } 
        return redirect()->back();   
   }

   /*public function learn()
   {
        $user_id = $this->user_id;
        $obj_transaction= $this->TransactionModel
                                 ->with(['purchase_history','member_detail','user_detail','purchase_history.interview_attachment','member_interview_info',
                                    'multi_ref_book'=> function($ref_book)
                                    {
                                        $ref_book->where('approve_status',1); 
                                    }
                                    ])
                                 ->where('user_id',$user_id)
                                 ->where('payment_status','=','paid')
                                 ->where('user_deleted','=',0)
                                 ->orderBy('id','desc')
                                 ->paginate(10);                         
        if($obj_transaction)
        {
            $arr_pagination = clone $obj_transaction;
            $arr_transaction = $obj_transaction->toArray();
        }
        foreach($arr_transaction['data'] as $key => $details) 
        {
             $member_amount     = $details['member_amount'];
             $member_tax_amount = ($member_amount*10/100);
             $after_tax_amount = $member_amount-$member_tax_amount;
             $arr_transaction['data'][$key]['member_tax_amount'] = $member_tax_amount;
             $arr_transaction['data'][$key]['after_tax_amount'] = $after_tax_amount;
             $arr_transaction['data'][$key]['multi_reference_book_count'] = count($details['multi_ref_book']);
             $arr_transaction['data'][$key]['interview_count'] = count($details['purchase_history']);
             $arr_transaction['data'][$key]['interview_count_arr'] = count($details['purchase_history'][0]['interview_attachment']);
             $arr_transaction['data'][$key]['ticket_name'] = $details['purchase_history'][0]['ticket_name'];
        }
        $obj_advertise = $this->AdvertisementModel->get();
        if($obj_advertise)
        {
            $arr_advertise = $obj_advertise->toArray();
        }
        $this->arr_view_data['arr_advertise']   = $arr_advertise;
        $this->arr_view_data['advertise_public_img_path'] = $this->advertise_public_img_path;
        $this->arr_view_data['arr_transaction'] = $arr_transaction;
        $this->arr_view_data['module_title']    = 'Learn';
        $this->arr_view_data['arr_pagination']  = $arr_pagination;
        return view($this->module_view_folder.'.learn', $this->arr_view_data); 
   }*/

    public function multi_action_notification(Request $request)
   {
       //dd($request->all());     
       $arr_rules = array();
        //$arr_rules['multi_action'] = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.str_plural($this->module_title) .' To Perform Multi Actions');  
            return redirect()->back()->withErrors($validator)->withInput();
        }

       /* $multi_action = $request->input('multi_action');*/
        $multi_action = 'delete';
        $checked_record = $request->input('checked_record');

        //dd($checked_record);
        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Session::flash('error','Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }

        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="delete")
            {
               //$this->perform_delete(base64_decode($record_id)); 
               $id = base64_decode($record_id);
               $delete_success = $this->NotificationModel->where('id',$id)->delete();
               
               if($delete_success)
               {
                  Flash::success('Notification Deleted Successfully.'); 
               }
               else 
               {
                  Flash::error('Error while deleting notification');     
               }
            } 
        }

        return redirect()->back();
   }

   public function delete_reference_book($reference_id)
    {
        $reference_id = base64_decode($reference_id);
        $delete = $this->MultiReferenceBookModel
                                            ->where('id',$reference_id)
                                            ->delete();
        if($delete)
        {
            Flash::success('Reference book deleted successfully.');
        }   
        else
        {
            Flash::error('Error while reference book deletion');
        }                                 
        return redirect()->back();
    }
	public function delete_reference_book_all($reference_name)
    {
        $reference_name = base64_decode($reference_name);
        $delete = $this->MultiReferenceBookModel
                                            ->where('topic_name',$reference_name)
                                            ->delete();
        if($delete)
        {
            Flash::success('Reference book deleted successfully.');
        }   
        else
        {
            Flash::error('Error while reference book deletion');
        }                                 
        return redirect()->back();
    }
	
	public function freePreview($reference_id)
    {
        $reference_id = base64_decode($reference_id);
        $update = $this->MultiReferenceBookModel
                                            ->where('id',$reference_id)
                                            ->update(['freePreview' => 'Yes']);
			
        if($update)
        {
            Flash::success('Your video make as a free preview successfully.');
        }   
        else
        {
            Flash::error('Error while make free preview');
        }                                 
        return redirect()->back();
    }

    public function curriculam()
    {
        
        $obj_interview_experience = $this->MemberInterviewModel->with(['interview_details'])
                                ->where('user_id',$this->user_id)
                                ->get();

        if($obj_interview_experience)
        {
            $arrMemberDetails = $obj_interview_experience->toArray();
        }

        $obj_curriculam = $this->TrainingCurriculamModel->get();
        $arr_curriculam=[];                        
        if($obj_curriculam)
        {
            $arr_curriculam = $obj_curriculam->toArray();
        }

        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['arrMemberDetails']             = $arrMemberDetails;
        $this->arr_view_data['arr_curriculam']             = $arr_curriculam;
        return view($this->module_view_folder.'.curriculam', $this->arr_view_data);
    }

    public function edit_curriculam($id)
    {
        $id = base64_decode($id);
        $obj_interview_experience = $this->MemberInterviewModel->with(['interview_details'])
                                ->where('user_id',$this->user_id)
                                ->get();
        if($obj_interview_experience)
        {
            $arrMemberDetails = $obj_interview_experience->toArray();
        }

        $obj_curriculam = $this->TrainingCurriculamModel->where('id',$id)->first();
        $arr_curriculam=[];                        
        if($obj_curriculam)
        {
            $arr_curriculam = $obj_curriculam->toArray();
        }

        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['arrMemberDetails']             = $arrMemberDetails;
        $this->arr_view_data['arr_curriculam']             = $arr_curriculam;
        return view($this->module_view_folder.'.edit_curriculam', $this->arr_view_data);
    }

    public function update_curriculam(Request $request)
    {                    
        $arr_rules['title']     = "required";
        $arr_rules['description']       = "required";
      
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            /*return redirect()->back()->withErrors($validator)->withInput($request->all());*/
            return Response::json([
                'message'=>'Please fill required fields',
                'error' =>$validator->errors()->toArray()
            ]);
        }
        
        $arr_data = [];
        $id = $request->input('id');
        $arr_data['member_id'] = $this->member_id;
        $arr_data['title'] = $request->input('title');
        $arr_data['description'] = $request->input('description');
        
        $result = $this->TrainingCurriculamModel->where(['id'=>$id])->update($arr_data);

        if($result)
        { 
            /*Flash::success('Curriculam updated successfully.');*/ 
            return Response::json([
                    'message'=>'Curriculam updated successfully.',
                    'status' =>true,
                    'type' => 'update',
                    'title' => $arr_data['title'],
                    'id' => $id,
                    'description' => $arr_data['description'],
                ]);
        }
        else
        {
            /*Flash::error('Error! While updating curriculam.');*/
            return Response::json([
                    'message'=>'Error! While updating curriculam.',
                    'status' =>false
                ]); 
        }
        
        /*return redirect()->back();*/
    }

    public function create_curriculam()
    {
        $obj_interview_experience = $this->MemberInterviewModel->with(['interview_details'])
                                ->where('user_id',$this->user_id)
                                ->get();

        if($obj_interview_experience)
        {
            $arrMemberDetails = $obj_interview_experience->toArray();
        }
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['arrMemberDetails']             = $arrMemberDetails;
        return view($this->module_view_folder.'.create_curriculam', $this->arr_view_data);
    }

    public function store_curriculam(Request $request)
    {                    
        $arr_rules['skills']          = "required";
        $arr_rules['title']     = "required";
        $arr_rules['description']       = "required";
      
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            /*return redirect()->back()->withErrors($validator)->withInput($request->all());*/
             return Response::json([
                    'message'=>'Please fill required fields',
                    'error' =>$validator->errors()->toArray()
                ]);
        }
        
        $arr_data = [];
        $arr_data['skill_id'] = $request->input('skills');
        $arr_data['member_id'] = $this->member_id;
        $arr_data['title'] = $request->input('title');
        $arr_data['description'] = $request->input('description');
        
        $result = $this->TrainingCurriculamModel->create($arr_data);

        if($result)
        { 
            /*Flash::success('Curriculam added successfully.'); */
            return Response::json([
                    'message'=>'Curriculam added successfully.',
                    'status' =>true,
                    'title' => $result->title,
                    'id' => base64_encode($result->id),
                    'description' => $result->description,
                    'skill_id' => $result->skill_id,
                ]);
        }
        else
        {
            /*Flash::error('Error! While adding curriculam.');*/ 
            return Response::json([
                    'message'=>'Error! While adding curriculam.',
                    'status' =>false
                ]);
        }
       
        //return redirect('member/curriculam');
    }
    public function get_curriculam($id)
    {
        $id = base64_decode($id);
        $obj_curriculam = $this->TrainingCurriculamModel->where('id',$id)->first();
        $title = $obj_curriculam->title;
        $description = $obj_curriculam->description;
        return Response::json([
            'status' =>true,
            'title' => $title,
            'id' => $id,
            'description' => $description,
        ]);
    }

    public function delete_curriculam($id)
    {
        $id = base64_decode($id);
        $obj_curriculam = $this->TrainingCurriculamModel->where(['id'=>$id, 'member_id'=>$this->member_id])->first();
        if(isset($obj_curriculam))
        {
            $obj_curriculam->delete();
            Flash::success('Curriculam deleted successfully.');
            return redirect()->back();
        }
        
    }


    public function classEnrollments()
    {
        $obj_interview_experience = $this->MemberInterviewModel->with(['interview_details'])
                                ->where('user_id',$this->user_id)
                                ->get();

        if($obj_interview_experience)
        {
            $arrMemberDetails = $obj_interview_experience->toArray();
        }

        $obj_schedules = $this->TrainingSchedulesModel->get();
        $arr_schedules=[];                        
        if($obj_schedules)
        {
            $arr_schedules = $obj_schedules->toArray();
        }


        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['arrMemberDetails']             = $arrMemberDetails;
        $this->arr_view_data['arr_schedules']             = $arr_schedules;
        return view($this->module_view_folder.'.training_enrollments', $this->arr_view_data);
    }

    public function onlineClassEnrollments($id)
    {
        $interviewId = base64_decode($id);
        $obj_interview_experience = $this->MemberInterviewModel->with(['interview_details'])
                                ->where('user_id',$this->user_id)
                                ->where('id',$interviewId)
                                ->get();

        if($obj_interview_experience)
        {
            $arrMemberDetails = $obj_interview_experience->toArray();
        }

        $obj_schedules = $this->TrainingSchedulesModel->get();
        $arr_schedules=[];                        
        if($obj_schedules)
        {
            $arr_schedules = $obj_schedules->toArray();
        }


        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['interviewId']             = $interviewId;
        $this->arr_view_data['arrMemberDetails']             = $arrMemberDetails;
        $this->arr_view_data['arr_schedules']             = $arr_schedules;
        return view($this->module_view_folder.'.training_enrollments', $this->arr_view_data);
    }
    public function scheduleClass()
    {
        $obj_interview_experience = $this->MemberInterviewModel->with(['interview_details'])
                                ->where('user_id',$this->user_id)
                                ->get();

        if($obj_interview_experience)
        {
            $arrMemberDetails = $obj_interview_experience->toArray();
        }

        $obj_schedules = $this->TrainingSchedulesModel->get();
        $arr_schedules=[];                        
        if($obj_schedules)
        {
            $arr_schedules = $obj_schedules->toArray();
        }

        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['arrMemberDetails']             = $arrMemberDetails;
        $this->arr_view_data['arr_schedules']             = $arr_schedules;
        return view($this->module_view_folder.'.schdule_class', $this->arr_view_data);
    }

    public function create_schedule()
    {
        $obj_interview_experience = $this->MemberInterviewModel->with(['interview_details'])
                                ->where('user_id',$this->user_id)
                                ->get();

        if($obj_interview_experience)
        {
            $arrMemberDetails = $obj_interview_experience->toArray();
        }
        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['arrMemberDetails']             = $arrMemberDetails;
        return view($this->module_view_folder.'.create_schedule', $this->arr_view_data);
    }
    public function store_schedule(Request $request)
    {                    
        $arr_rules['skills']          = "required";
        $arr_rules['start_time']     = "required";
        $arr_rules['end_time']     = "required|after:start_time";
        $arr_rules['date']       = "required|after:today";
        $arr_rules['max_allowed']       = "required";
      
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            /*return redirect()->back()->withErrors($validator)->withInput($request->all());*/
            return Response::json([
                'message'=>'Please fill required fields',
                'error' =>$validator->errors()->toArray()
            ]);
        }
        
        $arr_data = [];
        $arr_data['skill_id'] = $request->input('skills');
        $arr_data['member_id'] = $this->member_id;
        $arr_data['date'] = $request->input('date');
        $arr_data['start_time'] = $request->input('start_time');
        $arr_data['end_time'] = $request->input('end_time');
        $arr_data['max_allowed'] = $request->input('max_allowed');
        

        $countMaxSchedules = $this->TrainingSchedulesModel->where(['member_id'=>$arr_data['member_id'], 'status'=>'Live'])->count();
        if($countMaxSchedules > 1)
        {
            /*Flash::error('warning! you already reached maximum number of schedules.');
            return redirect('member/scheduleClass');*/
            return Response::json([
                    'message'=>'Warning! you already reached maximum number of schedules.',
                    'status' =>false,
                    'status_type'=>'warning'
                ]);

        }

        $countTimeDiff = $this->TrainingSchedulesModel->where(['member_id'=>$arr_data['member_id'], 'date'=>$arr_data['date'], 'status'=>'Live'])->whereBetween('start_time',[$arr_data['start_time'], $arr_data['end_time']])->orWhereBetween('end_time',[$arr_data['start_time'], $arr_data['end_time']])->count();

        if($countTimeDiff > 0)
        {
            /*Flash::error('warning! you already reached maximum number of schedules.');
            return redirect('member/scheduleClass');*/
            return Response::json([
                    'message'=>'Warning! this timings schedule already created.Please try with new timings',
                    'status' =>false,
                    'status_type'=>'warning'
                ]);

        }
        
        $result = $this->TrainingSchedulesModel->create($arr_data);
        if($result)
        { 
            /*Flash::success('Training schedule added successfully.');*/
            return Response::json([
                'message'=>'Training schedule added successfully.',
                'status' =>true,
                'date' => $result->date,
                'id' => base64_encode($result->id),
                'start_time' => $result->start_time,
                'end_time' => $result->end_time,
                'skill_id' => $result->skill_id,
            ]); 
        }
        else
        {
            /*Flash::error('Error! While adding schedule.');*/ 
            return Response::json([
                    'message'=>'Error! While adding schedule.',
                    'status' =>false
                ]);
        }
        
        return redirect('member/scheduleClass');
    }
    public function edit_schedule($id)
    {
        $id = base64_decode($id);
        $obj_interview_experience = $this->MemberInterviewModel->with(['interview_details'])
                                ->where('user_id',$this->user_id)
                                ->get();
        if($obj_interview_experience)
        {
            $arrMemberDetails = $obj_interview_experience->toArray();
        }

        $obj_schedule = $this->TrainingSchedulesModel->where(['id'=>$id, 'member_id'=>$this->member_id, 'status'=>'Live'])->first();
        $arr_schedule=[];                        
        if($obj_schedule)
        {
            $arr_schedule = $obj_schedule->toArray();
        }

        $this->arr_view_data['arr_user_info']             = $this->arr_user_info;
        $this->arr_view_data['arrMemberDetails']             = $arrMemberDetails;
        $this->arr_view_data['arr_schedule']             = $arr_schedule;
        return view($this->module_view_folder.'.edit_schedule', $this->arr_view_data);
    }

    public function cancel_schedule($scheduleId)
    {
        $scheduleId = base64_decode($scheduleId);
        $obj_schedule = $this->TrainingSchedulesModel->where(['id'=>$scheduleId, 'member_id'=>$this->member_id])->first();
        if(isset($obj_schedule))
        {
            $obj_schedule->status = 'Cancelled';
            $obj_schedule->save();
            Flash::success('Training schedule cancelled successfully.');
            return redirect()->back();
        }
        
    }
    public function get_schedule($id, $scheduleId)
    {
        $id = base64_decode($id);
        $obj_schedule = $this->TrainingSchedulesModel->where(['id'=>$id, 'member_id'=>$this->member_id, 'status'=>'Live'])->first();
        if(empty($obj_schedule))
        {
            return Response::json([
                'message'=>'Invalid action',
                'status' =>false,
                'status_type'=>'danger'
            ]);
        }
        $date = $obj_schedule->date;
        $start_time = $obj_schedule->start_time;
        $end_time = $obj_schedule->end_time;
        $max_allowed = $obj_schedule->max_allowed;
        return Response::json([
            'status' =>true,
            'date' => $date,
            'id' => $id,
            'scheduleId' => $scheduleId,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'max_allowed' => $max_allowed,
        ]);
    }

    public function update_schedule(Request $request)
    {          

        $arr_rules['start_time']     = "required";
        $arr_rules['end_time']     = "required|after:start_time";
        $arr_rules['date']       = "required";
        $arr_rules['max_allowed']       = "required";
      
        $validator = Validator::make($request->all(),$arr_rules);        
        if($validator->fails())
        {

            /*return redirect()->back()->withErrors($validator)->withInput($request->all());*/
            return Response::json([
                'message'=>'Please fill required fields',
                'error' =>$validator->errors()->toArray()
            ]);
        }
        
        $arr_data = [];
        $id = $request->input('id');
        $arr_data['member_id'] = $this->member_id;
        $arr_data['date'] = $request->input('date');
        $arr_data['start_time'] = $request->input('start_time');
        $arr_data['end_time'] = $request->input('end_time');
        $arr_data['max_allowed'] = $request->input('max_allowed');

        $countTimeDiff = $this->TrainingSchedulesModel->where('id', '!=', $id)->where(['member_id'=>$arr_data['member_id'], 'date'=>$arr_data['date'], 'status'=>'Live'])->where(function($query) use ($arr_data)
            {
                $query->whereBetween('start_time',[$arr_data['start_time'], $arr_data['end_time']])
                      ->orWhereBetween('end_time',[$arr_data['start_time'], $arr_data['end_time']]);
            })->count();
        
        if($countTimeDiff > 0)
        {           
            return Response::json([
                    'message'=>'Warning! this timings schedule already created.Please try with new timings',
                    'status' =>false,
                    'status_type'=>'warning'
                ]);

        }
        
        $result = $this->TrainingSchedulesModel->where(['id'=>$id, 'member_id'=>$this->member_id])->update($arr_data);
        if($result)
        { 
            /*Flash::success('Training schedule updated successfully.');*/
            return Response::json([
                'message'=>'Training schedule updated successfully.',
                'status' =>true,
                'date' => $arr_data['date'],
                'id' => base64_encode($id),
                'start_time' => $arr_data['start_time'],
                'end_time' => $arr_data['end_time'],
            ]); 
        }
        else
        {
            /*Flash::error('Error! While updating schedule.');*/
            return Response::json([
                    'message'=>'Error! While updating schedule.',
                    'status' =>false
                ]); 
        }
        
        /*return redirect()->back();*/
    }

    public function store_review(Request $request)
    {   $unique_id = $request->input('enc_unique');
    
    //return $unique_id;
        //print_r($request->all()); die;
        $review_count = $this->ReviewRatingModel->where('unique_id',$unique_id)->where('review_status','Complete')->count();
        if($review_count>0)
        {
           Flash::error('You already added review for this interview.');
            return redirect(url('/interview_details/'.$interview_id)); 
        }

        $arr_rules['review']                 = "required";
        $arr_rules['review_star']            = "required";
        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $interview_id = $request->input('enc_interview');
        $interview_details = $this->MemberInterviewModel->where('id',base64_decode($interview_id))->first();
        if($interview_details)
        {
            $member_user_id=$interview_details->user_id;
        }
        $review_data                   = [];
        $review_data['user_id']        = base64_decode($request->input('enc_user'));
        $review_data['interview_id']   = base64_decode($interview_id);
        $review_data['member_user_id'] = $member_user_id;
        $review_data['unique_id']      = $request->input('enc_unique');
        $review_data['review_star']    = $request->input('review_star');
        $review_data['review_message'] = $request->input('review');
        $review_data['review_status']      = $request->input('Complete');
        $review_data['ReviewType']      = $request->input('reviewType');
        $review_data['ReviewTypeID']      = $request->input('reviewTypeID');

        $review = $this->ReviewRatingModel->create($review_data);
        /*$review = $this->ReviewRatingModel->where('unique_id',$unique_id)->update($review_data);*/
        if($review)
        {
            Flash::success('Your review added successfully for this interview.');
        }
        else
        {
            Flash::error('Error occured while adding your review please try again.');
        }
        return redirect(url('/member/purchase_history/'));
    }
   
    
}
