<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\UserDetailModel;
use App\Models\MemberDetailModel;
use App\Models\StateModel;
use App\Models\QualificationModel;
use App\Models\CategoryModel;
use App\Models\CountryModel;
use App\Models\MembersSkillsModel;
use App\Models\AccountSettingModel;
use App\Models\ManageEmailModel;
use App\Models\SpecializationModel;
use App\Models\SkillsModel;
use App\Models\EmployerTypeModel;


use Validator;
use Sentinel;
use Session;
use Mail;
use Activation;
use Reminder;
use URL;
use Flash;
use File;


class AuthController extends Controller
{

    public function __construct(UserModel $user,
                                UserDetailModel $user_detail,
                                StateModel $state,
                                CategoryModel $category,
                                CountryModel $country,
                                QualificationModel $qualification,
                                MemberDetailModel $member_detail,
                                MembersSkillsModel $member_skill,
                                AccountSettingModel $account_setting,
                                SpecializationModel $specialization,
                                ManageEmailModel $manage_email,
                                SkillsModel $skill,
                                EmployerTypeModel $employer_type
                              )
    {
        $this->arr_view_data=[];
        $this->UserModel =$user;
        $this->StateModel = $state;
        $this->QualificationModel = $qualification;
        $this->CategoryModel = $category;
        $this->CountryModel = $country;
        $this->BaseModel = Sentinel::createModel();
        $this->UserDetailModel =$user_detail;
        $this->SpecializationModel = $specialization;
        $this->MemberDetailModel =$member_detail;
        $this->MembersSkillsModel = $member_skill;
        $this->SkillsModel = $skill;
        $this->AccountSettingModel = $account_setting;
        $this->ManageEmailModel = $manage_email;
        $this->EmployerTypeModel = $employer_type;
        $obj_mail_from = $this->ManageEmailModel->first();
        $this->mail_from = $obj_mail_from->general_email;

        $this->member_resume_path           = public_path().config('app.project.img_path.resume');
    }   

    public function user_login()
    {
      /*$previous_url=\URL::previous();
      if($previous_url==url('/payment/order_summery'))
      {
            Session::put('previous_url',$previous_url);  
      }*/

      $arr_skill = [];
      $obj_skill = $this->SkillsModel->get();
      if($obj_skill)
      {
         $arr_skill = $obj_skill->toArray();
      }
      $skill_name='';

      $this->arr_view_data['arr_skill']             = $arr_skill;
      $this->arr_view_data['skill_name']             = $skill_name;
      return view('front.layout._user_login',$this->arr_view_data);
    }

    public function member_login()
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
      return view('front.layout._member_login',$this->arr_view_data);
    }

    public function register()
    {
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
        $obj_qualification = $this->QualificationModel->where('is_active','=',1) ->get();
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

        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
          $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']         = $arr_skill;
        $this->arr_view_data['skill_name']        = $skill_name;
        $this->arr_view_data['arr_state']         = $arr_state;
        $this->arr_view_data['arr_country']       = $arr_country;
        $this->arr_view_data['arr_qualification'] = $arr_qualification;
        $this->arr_view_data['arr_category']      = $arr_category;
        $this->arr_view_data['arr_user_details']  = $arr_user_details;
        $this->arr_view_data['arr_user_email']    = $arr_user_email;
        
        return view('front.member.register', $this->arr_view_data);
    }

    public function store(Request $request)
    {
        $arr_rules['password']          = "required";
        $arr_rules['con_password']      = "required|same:password";
        $arr_rules['first_name']        = "required";
        $arr_rules['last_name']         = "required";
        $arr_rules['email']             = "required";
        $arr_rules['mobile_code']       = "required";
        $arr_rules['mobile_no']         = "required";
        $arr_rules['date']              = "required";
        $arr_rules['month']             = "required";
        $arr_rules['year']              = "required";
        $arr_rules['gender']            = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        /*dd($request->all());
*/
        /* Check for email duplication */
        $does_exists = $this->BaseModel 
                            ->where('email','=',$request->input('email'))
                            ->count();

        if($does_exists)
        {
            Flash::error('Email-id Already Exists.');
            return redirect()->back()->withInput($request->all());
        }   
        
        $date = $request->input('date');
        $month = $request->input('month');
        $year = $request->input('year');
        
        $birth_date=date('Y-m-d',strtotime($year.'-'.$month.'-'.$date)); 

        $obj_user = Sentinel::register([
            'first_name' => $request->input('first_name'),
            'email'      => $request->input('email'),
            'last_name' => $request->input('last_name'),
            'password'   => $request->input('password'),
        ]); 

        if($obj_user) 
        {
          $user_id                         = $obj_user->id;
          $arr_user_details['mobile_code'] = $request->input('mobile_code');
          $arr_user_details['mobile_no']   = $request->input('mobile_no');
          $arr_user_details['birth_date']  = $birth_date;
          $arr_user_details['is_active']   = 0;
          $arr_user_details['gender'] = $request->input('gender');
          $arr_user_details['profile_image']   = 'default.jpg';
          //assign role to user 
          
          $status = $this->BaseModel->where('id',$user_id)->update($arr_user_details);
          $arr_data=[];
            $arr_data['user_id'] = $user_id;
            $member_detail_obj = $this->MemberDetailModel->create($arr_data);
            $member_id = $member_detail_obj->id;
          if($status)
          { 
            $role = Sentinel::findRoleBySlug('member');
            $obj_user->roles()->attach($role);
            
              Flash::success('Your personal Information has been Stored Successfully! Please enter your Employment details.');
              
              $member_id = base64_encode($member_id);
              Session::put('member_id',$member_id);
              return redirect('member/employment');
              
           } 
           else
           {
              Flash::error('Error occured while registration');
           }
        }
    }

    public function employment()
    {
        $enc_id = Session::get('member_id');
        
        $this->arr_view_data['enc_id'] = $enc_id;

        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->orderBy('is_metro','asc')
                                      ->where('is_active','=',1)  
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
     
        $type='create';
        
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
          $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['arr_state']        = $arr_state;
        $this->arr_view_data['arr_category']     = $arr_category;
        $this->arr_view_data['arr_country']      = $arr_country;
        $this->arr_view_data['arr_user_details'] = $arr_user_details;
        $this->arr_view_data['arr_user_email']   = $arr_user_email;
        $this->rr_view_data['type']              = $type;
        
        return view('front.member.employment', $this->arr_view_data);
    }

    public function store_employment(Request $request)
    {     /*dd($request->all());*/
        $member_id = base64_decode($request->input('enc_id'));
      
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

        /*$user_detail = $this->MemberDetailModel->where('id',$member_id)->first(['user_id']);
      $user_id = $user_detail['user_id'];*/
        
        $file_name = '';
        if($request->hasFile('resume'))
        {  
            $bytes = File::size($request->file('resume'));

            $fileExtension = strtolower($request->file('resume')->getClientOriginalExtension()); 

              $arr_file_types = ['docx','pdf','doc','rtf'];

            if(in_array($fileExtension, $arr_file_types) && $bytes<=500000)
            {
                $file_name      = $request->input('resume');
                $file_extension = strtolower($request->file('resume')->getClientOriginalExtension()); 
                $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $request->file('resume')->move($this->member_resume_path, $file_name); 
            }
            else
            {
                Flash::error('Please upload valid file with doc,docx,pdf,rtf extension and max size 500 kb');
                return redirect()->back();
            } 
        }

        $job_profile='';
        if($request->input('employer_type')=='current')
        {
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
        

        $skills = $request->input('skills');
        $skill_id     = [];
        foreach ($skills as $key => $skill) 
        {
            $skill_name   = ucfirst($skill);
            $skill_exists = $this->SkillsModel->where('skill_name',$skill_name)->first();
            if($skill_exists)
            {
                $skill_id[$key] = $skill_exists->id; 
                continue;
            }
            $obj_skill_create = $this->SkillsModel->create(['skill_name'=>$skill_name]);
            if($obj_skill_create)
            {    
                $skill_id[$key] = $obj_skill_create->id;
            }
        }

        if(isset($skill_id) && sizeof($skill_id)>0)
        {
            foreach ($skill_id as $member_skills) 
            {
                $arr_skills=[];
                $arr_skills['skill_id'] =$member_skills;
                $arr_skills['member_id'] = $member_id;

                $this->MembersSkillsModel->create($arr_skills);    
            }
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
 
        $arr_member_data                           = [];
        $arr_member_data['experience_years']       = $request->input('experience_year');
        $arr_member_data['employer_name']          = $employer_name;
        $arr_member_data['experience_month']       = $request->input('experience_month');
        /*$arr_member_data['company_name']           = $request->input('company_name');*/
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
        /*$arr_member_data['job_profile']            = $job_profile;*/
        /*$arr_member_data['company_name']           = $company_name;*/

        $member_employment = $this->MemberDetailModel->where('id',$member_id)->update($arr_member_data);
        if($member_employment)
        {
            Flash::success('Your employment Information has been Stored Successfully! Please enter your Education details.');
        }
        else
        {
            Flash::error('Error while storing employment detail');   
        }
        $member_id =base64_encode($member_id); 
        return redirect('member/education');    
    }

    public function education()
    {
        $enc_id = Session::get('member_id');
        
      $arr_qualification = [];
        $obj_qualification = $this->QualificationModel->where('is_active','=',1)->get();
        if($obj_qualification)
        {
            $arr_qualification = $obj_qualification->toArray();
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

        $this->arr_view_data['arr_country']       = $arr_country;
        
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
          $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['enc_id']            = $enc_id;
        $this->arr_view_data['arr_qualification'] = $arr_qualification;
        $this->arr_view_data['arr_state']         = $arr_state;
        $this->arr_view_data['arr_user_details']  = $arr_user_details;
        $this->arr_view_data['arr_user_email']    = $arr_user_email;
      
        return view('front.member.education', $this->arr_view_data);
    }

    public function store_education(Request $request)
    {
      $member_id = base64_decode($request->input('enc_id'));
      
      $arr_rules['qualification_id']  = "required";
      $arr_rules['passing_month']     = "required";
      $arr_rules['passing_year']      = "required";
      $arr_rules['marks_type']        = "required";
      $arr_rules['marks_input']       = "required";
      $arr_rules['pan_no']            = "required";
      
      /*$arr_rules['city']              = "required";*/
      
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
        Session::forget('member_id');
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
        
        $arr_member_data                          = [];
        $arr_member_data['qualification_id']      = $request->input('qualification_id');
        $arr_member_data['passing_month']         = $request->input('passing_month');
        $arr_member_data['passing_year']          = $request->input('passing_year');
        $arr_member_data['marks_type']            = $request->input('marks_type');
        $arr_member_data['specialization_id']     = $request->input('specialization_id');
        $arr_member_data['marks']                 = $request->input('marks_input');
        $arr_member_data['pan_no']                = $request->input('pan_no');
        $arr_member_data['education_city']        = $request->input('city');
        $arr_member_data['about_member']          = $request->input('about_member');
        $arr_member_data['education_country_id']  = $country_id;
        $arr_member_data['facebook']              = $request->input('facebook');
        $arr_member_data['linkedin']              = $request->input('linkedin');
        $arr_member_data['twitter']               = $request->input('twitter');
        $arr_member_data['education_other_city']  = $other_city;
        $arr_member_data['education_other_state'] = $other_state;
        $arr_member_data['status']                = 'completed';

        $member_data = $this->MemberDetailModel->where('id',$member_id)->update($arr_member_data);
        
        /*Fetching member data for sending confirmation mail */
        $obj_user_data = $this->MemberDetailModel->where('id',$member_id)->first();
      $arr_user_data=[];
      if($obj_user_data)
      {
        $arr_user_data = $obj_user_data->toArray();
      }
      $user_id = $arr_user_data['user_id'];
      
      /*Changing status for member from inprogress to completed as he completed his profile  */
      $user_data_update=[];
      if(Session::has('become_member') && Session::get('become_member')=='yes')
      {
        $user_role = Sentinel::findUserById($user_id);
        $role = Sentinel::findRoleBySlug('member');
        $user_role->roles()->attach($role);
        $user_data_update['admin_status'] = 'Pending';
        $user_data_update['normal_member'] = 'no';
      }
      $user_data_update['status'] = 'completed';
      $user_member_data           = $this->BaseModel->where('id',$user_id)->update($user_data_update);
      $obj_arr_data               = $this->BaseModel->where('id',$user_id)->first();
      $arr_user_email_data        = [];
      if($obj_arr_data)
      {
        $arr_user_email_data = $obj_arr_data->toArray();
      }
      if(Session::has('become_member') && Session::get('become_member')=='yes' )
      {
            $email_id = isset($arr_user_email_data['email'])?$arr_user_email_data['email']:'';
            $data['user_id'] = $user_id;
            $data['name'] = ucfirst(isset($arr_user_email_data['first_name'])?$arr_user_email_data['first_name']:'');
            $data['email_id'] = isset($arr_user_email_data['email'])?$arr_user_email_data['email']:'';
            $project_name = config('app.project.name');
            $mail_from = $this->mail_from;

            Mail::send('front.email.member_request', $data, function ($message) use ($email_id,$mail_from,$project_name) {
                      $message->from($mail_from, $project_name);
                      $message->subject($project_name.':Member Request');
                      $message->to($email_id);
                  });   
            Flash::success('Your become member request sent to admin please wait till admin approval');
            return redirect(url('/member/login'));           
      }
      Session::forget('become_member');
      $user = Sentinel::findById($user_id);
            $activation = Activation::create($user); 
            $activation_code = $activation->code; 

            $email_id = isset($arr_user_email_data['email'])?$arr_user_email_data['email']:'';
            $data['user_id'] = $user_id;
            $data['activation_code'] = base64_encode($activation_code);
            $data['name'] = ucfirst(isset($arr_user_email_data['first_name'])?$arr_user_email_data['first_name']:'');
            $data['email_id'] = isset($arr_user_email_data['email'])?$arr_user_email_data['email']:'';
            $data['confirmation_link'] = url('/').'/confirm_email/'.base64_encode($user_id).'/'.base64_encode($activation_code);

            $project_name = config('app.project.name');
            $mail_from = $this->mail_from;

            Mail::send('front.email.signup_confirmation', $data, function ($message) use ($email_id,$mail_from,$project_name) {
                      $message->from($mail_from, $project_name);
                      $message->subject($project_name.':Email Confirmation.');
                      $message->to($email_id);
                  });
        if($member_data)
        {
          Flash::success('Your account is created successfully! Please check your mail for verification.');
        }
        else
        {
          Flash::error('Error While Storing Education fields.'); 
        }
      return redirect(url('/member/login'));
    }

    public function user_register()
    { 
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
        $obj_qualification = $this->QualificationModel->where('is_active','=',1)->get();
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
     
        /*$this->arr_view_data['module_title']      = str_plural($this->module_title);*/
        /*$this->arr_view_data['module_url_path']   = $this->module_url_path;*/
        $arr_skill = [];
        $obj_skill = $this->SkillsModel->get();
        if($obj_skill)
        {
            $arr_skill = $obj_skill->toArray();
        }
        $skill_name='';

        $this->arr_view_data['arr_skill']             = $arr_skill;
        $this->arr_view_data['skill_name']             = $skill_name;
        $this->arr_view_data['arr_state']         = $arr_state;
        $this->arr_view_data['arr_qualification'] = $arr_qualification;
        $this->arr_view_data['arr_category']      = $arr_category;
        $this->arr_view_data['arr_country'] = $arr_country;
        $this->arr_view_data['arr_user_details'] = $arr_user_details;
        $this->arr_view_data['arr_user_email'] =$arr_user_email;
        /*$this->arr_view_data['theme_color']       = $this->theme_color;*/

        /*return view('front.user.register');*/
        return view('front.user.register', $this->arr_view_data);
    }

    public function user_store(Request $request)
    {
        
        $arr_rules['password']          = "required";
        $arr_rules['first_name']        = "required";
        $arr_rules['last_name']         = "required";
        $arr_rules['email']             = "required";
        $arr_rules['mobile_code']       = "required";
        $arr_rules['mobile_no']         = "required";
        $arr_rules['qualification_id']  = "required";
        $arr_rules['passing_month']     = "required";
        $arr_rules['passing_year']      = "required";
        $arr_rules['marks_type']        = "required";
        $arr_rules['marks_input']       = "required";
        /*$arr_rules['specialization_id'] = "required";*/
        
        /*$arr_rules['city']              = "required";*/
        $arr_rules['date']              = "required";
        $arr_rules['month']             = "required";
        $arr_rules['year']              = "required";
        $arr_rules['gender']            = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
        $does_exists = $this->BaseModel 
                            ->where('email','=',$request->input('email'))
                            ->count();

        if($does_exists)
        {
            Flash::error(/*str_singular($this->module_title).*/'Email-id Already Exists.');
            return redirect()->back()->withInput($request->all());
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
        $date = $request->input('date');
        $month = $request->input('month');
        $year = $request->input('year');
        
        $birth_date=date('Y-m-d',strtotime($year.'-'.$month.'-'.$date)); 

        $obj_user = Sentinel::register([
            'first_name' => $request->input('first_name'),
            'email'      => $request->input('email'),
            'last_name' => $request->input('last_name'),
            'password'   => $request->input('password'),
            'birth_date' => $birth_date,
        ]); 



        if($obj_user) 
        {
          $user_id                         = $obj_user->id;
          $arr_user_details['mobile_code'] = $request->input('mobile_code');
          $arr_user_details['mobile_no']   = $request->input('mobile_no');
          $arr_user_details['birth_date']  = $birth_date;
          $arr_user_details['is_active']   = 1;
          $arr_user_details['status']   = 'completed';
          $arr_user_details['profile_image']   = 'default.jpg';

          //assign role to user 
          $role = Sentinel::findRoleBySlug('user');
          $obj_user->roles()->attach($role);
          
          $status = $this->BaseModel->where('id',$user_id)->update($arr_user_details);
          $arr_data=[];
            $arr_data['user_id'] = $user_id;
            $arr_data['qualification_id'] = $request->input('qualification_id');
            $arr_data['passing_month'] = $request->input('passing_month');
            $arr_data['passing_year'] = $request->input('passing_year');
            $arr_data['marks_type'] = $request->input('marks_type');
            $arr_data['marks'] = $request->input('marks_input');
            $arr_data['specialization_id'] = $request->input('specialization_id');
            $arr_data['current_work_location'] = $request->input('city');
            $arr_data['other_city'] = $other_city;
            $arr_data['other_state'] = $other_state;
            $arr_data['country_id'] = $country_id;

            //dd($arr_data);
            $this->UserDetailModel->create($arr_data);
          
          if($status)
          { 
            $user = Sentinel::findById($obj_user->id);
            $activation = Activation::create($user); /* Create avtivation */
            $activation_code = $activation->code; // get activation code

            $email_id = $request->input('email');
            $data['user_id'] = $obj_user->id;
            $data['activation_code'] = base64_encode($activation_code);
            $data['name'] = ucfirst($request->input('first_name'));
            $data['email_id'] = $request->input('email');
            $data['confirmation_link'] = url('/').'/confirm_email/'.base64_encode($obj_user->id).'/'.base64_encode($activation_code);

            $project_name = config('app.project.name');
            $mail_from = $this->mail_from;

            Mail::send('front.email.signup_confirmation', $data, function ($message) use ($email_id,$mail_from,$project_name) {
                      $message->from($mail_from, $project_name);
                      $message->subject($project_name.':Email Confirmation.');
                      $message->to($email_id);
                  });
              Flash::success('Thank you! Registration completed successfully! Please check your email account for confirmation link');
              return redirect(url('/user/login'));
          } 
          else
          {
              Flash::error('Error occured while registration');
          }
        }
    }

    public function member_validate_login(Request $request)
    { 
       $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $credentials = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];


      $user = Sentinel::findByCredentials($credentials); // check if user exists

      if($user)
      {
        /*$check = Sentinel::findById($user->id)->roles()->get();
        dd($check->toArray());*/
        if(isset($user->is_active) && $user->is_active==0 && isset($user->is_deactivate) && $user->is_deactivate==1)
        {
            /*Flash::error('Invalid Credentials');*/
            Flash::error('Currently your account was deactivated by you, To reactivate please contact to superadmin.');
            Sentinel::logout();
            return redirect()->back();
        }
        $activation = Activation::completed($user);

        if($activation) // check if activation is completed
        {
          /* Check if array has remember me parameter */
          $remember = $request->input('remember');
          if($remember=='remember')
          {
              $check_authentication = Sentinel::authenticateAndRemember($credentials);  //authenticate a user  
          }
          else
          {
            /*authenticate a user*/
            $check_authentication = Sentinel::authenticate($credentials);   
          }

          if(isset($user->is_active) && $user->is_active!=1) 
          {
             Flash::error('You will get call from our account activation team within 24 hours to verify your details.');
             Sentinel::logout();
             return redirect()->back();
          }

          if(isset($user->normal_member) && $user->normal_member!='yes' || isset($user->admin_status) && $user->admin_status!='Approved' )
          {
            if(Sentinel::inRole('user'))
            {
                Flash::error('You are not a member user.');
                Sentinel::logout();
                return redirect()->back();
            } 
            else
            {
                Flash::error('Your account is not approved yet by admin.');
                Sentinel::logout();
                return redirect()->back();
            }   
            
          }

          
          if($check_authentication)
          {
               /* check if the user has the specified role */
                if(Sentinel::inRole('member'))
                {
                    $login_status = Sentinel::login($user);

                    if($login_status)
                    {  
                        Session::put('logged_in','member');
                        Flash::success("You Logged In Successfully.");
                        return redirect('/member/personal');
                    }
                    else
                    { 
                        Flash::error('Invalid Credentials Please Try Again');
                    }
                }
              else
              {
                  Flash::error('Member Does Not Exists');
              } 
          }
          else
          {
            Flash::error('Invalid Credentials Please Try Again');
          }
        }
        else
        {
          Flash::error('You Haven\'t Activated Your Account Yet');
            
        }
      }
      else
      {
        Flash::error('Invalid Credentials Please Try Again');
      }

        return redirect()->back();
    }

    public function user_validate_login(Request $request)
    { 
       $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->all());
        }

        $credentials = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];


      $user = Sentinel::findByCredentials($credentials); // check if user exists

      if($user)
      {
        
        if(isset($user->is_active) && $user->is_active==0 && isset($user->is_deactivate) && $user->is_deactivate==1)
        {
            Flash::error('Currently your account was deactivated by you, To reactivate please contact to superadmin.');
            Sentinel::logout();
            return redirect()->back(); 
        }
        $activation = Activation::completed($user);

        if($activation) // check if activation is completed
        {
          /* Check if array has remember me parameter */
          $remember = $request->input('remember');
          if($remember=='remember')
          {
              $check_authentication = Sentinel::authenticateAndRemember($credentials);  //authenticate a user  
          }
          else
          {
            $check_authentication = Sentinel::authenticate($credentials);   //authenticate a user
          }

          if(isset($user->is_active) && $user->is_active!=1) 
          {
             Flash::error('You will get call from our account activation team within 24 hours to verify your details.');
              Sentinel::logout();
             return redirect()->back();
          }

          if($check_authentication)
          {
          	$check = Sentinel::findById($user->id)->roles()->get();
        	
               // check if the user has the specified role which user

              if(Sentinel::inRole('user'))
              { 
                  $login_status = Sentinel::login($user);

                  if($login_status)
                  {  
                    Session::put('logged_in','user');
                    Flash::success("You Logged In Successfully");
                    
                    return redirect('/user/profile');
                  }
                  else
                  {
                      Flash::error('Invalid Credentials Please Try Again');
                  }
              }
              else
              {
                  Flash::error('User Does Not Exists');
              } 
          }
          else
          {
            Flash::error('Invalid Credentials Please Try Again');
          }
        }
        else
        {
          Flash::error('You Haven\'t Activated Your Account Yet');
            
        }
      }
      else
      {
        Flash::error('Invalid Credentials Please Try Again');
      }

        return redirect()->back();
    }

    public function get_specialization($qualification_id)
    {

        $arr_specialization = array();
        $arr_response = array();

        $obj_specialization = $this->SpecializationModel
                                       ->select('id','specialization_name')
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

    public function member_logout()
    {
        Session::forget('logged_in');
      Sentinel::logout();
      return redirect(url('member/login'));
    }

    public function user_logout()
    {
        Session::forget('logged_in');
      Sentinel::logout();
      return redirect(url('user/login'));
    }

    public function confirm_email($enc_user_id,$activation_code)
    {
        $id = base64_decode($enc_user_id);
        $activation_code = base64_decode($activation_code);
        $role_for_user = Sentinel::findById($id)->roles()->first();
        $user_role = $role_for_user->toArray();
        /*dd($user_role);*/   
        $user = Sentinel::findById($id);
        if(Activation::completed($user))
        {
          if($user_role['slug']=='user')
          {
            Flash::success('Activation Already Completed! Please Login To Your Account');
            return redirect(url('user/login'));
          }
          if($user_role['slug']=='member')
          {
            Flash::success('Activation Already Completed! Please Login To Your Account');
            return redirect(url('member/login'));
          }
        }
      
        
        $activation = Activation::exists($user); // check if activation entry for specific user in database ...

        if($activation) /* if activation entry there  in database*/
        {
            /*check for if user activated already with email account with verification link*/
            if(Activation::complete($user, $activation_code))
            /* complete an activation process*/
            {

                $tmp_user = $this->BaseModel->where('id',$id)->first();
                if($tmp_user)
                {
                    $tmp_user->is_active = 1;
                    $tmp_user->save(); 
                }
                $check_authentication = Sentinel::login($user);
                if($check_authentication)
                {
                  $role_user = Sentinel::findRoleBySlug('user');  
                  /*check if the user has the specified role which user*/
                  $role_member = Sentinel::findRoleBySlug('member');

                  if(Sentinel::inRole($role_user))
                  {
                       Flash::success('Your account is verified successfully, Please login.');
                      return redirect(url('user/login'));
                  } 
                  elseif (Sentinel::inRole($role_member)) 
                  {
                        Flash::success('Your account is verified successfully,You will be able to login after admin approval.');
                        return redirect(url('member/login'));
                  } 
                }
            } 
            else
            {  
              if($user_role['slug']=='user')
              {
                   Flash::error('Error occured while email confirmation');
                   return redirect(url('user/login'));
              } 
              if($user_role['slug']=='member') 
              {
                   Flash::error('Error occured while email confirmation');
                   return redirect(url('member/login'));
              } 
            }   
        }
        else
        {
          if($user_role['slug']=='user')
          {
               Flash::error('Error invalid request for email confirmation');
               return redirect(url('user/login'));
          } 
          if($user_role['slug']=='member') 
          {
               Flash::error('Error invalid request for email confirmation');
               return redirect(url('member/login'));
          }
        }
    }

    public function forgot_password()
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
      $this->arr_view_data['module_title'] = "Forgot Password";
      return view('front.layout._user_forgot', $this->arr_view_data);
    }

    public function forgot_password_member()
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
      $this->arr_view_data['module_title'] = "Forgot Password";
      return view('front.layout._member_forgot', $this->arr_view_data);
    }

    public function process_forgot_password(Request $request)
    {
          $arr_rules['email']      = "required";

          $validator = Validator::make($request->all(),$arr_rules);

          if($validator->fails())
          {
            Flash::error('Please enter valid email_id');
            return redirect()->back()->withErrors($validator)->withInput();
          }

          $email = $request->input('email');

          $user  = Sentinel::findByCredentials(['email' => $email]);

          if($user==null)
          {
            Flash::error("Invaild Email Id");
            return redirect()->back();
          }

            if(\Request::segment(1)=='user')
            {
               if($user->inRole('user')==false)
               {
                  Flash::error('We are unable to process this Email Id');
                  return redirect()->back();
               }

            }else if(\Request::segment(1)=='member'){

                if($user->inRole('member')==false)
                {
                  Flash::error('We are unable to process this Email Id');
                  return redirect()->back();
                }
            }

          $reminder = Reminder::create($user);

          $arr_mail_data = $this->built_mail_data($email, $reminder->code); 
          $project_name = config('app.project.name');
          $mail_from = $this->mail_from;

         $email_status = Mail::send('front.email.forgot_password_user', $arr_mail_data, function ($message) use ($email,$mail_from,$project_name) {
                    $message->from($mail_from, $project_name);
                    $message->subject($project_name.':Reset Password.');
                    $message->to($email);
          });


          if($email_status)
          {
            Flash::success('Password reset link send to your email id');
            return redirect()->back();
          }
          else
          {
            Flash::success('Error while sending password reset link');
            return redirect()->back();
          }
    }

     public function built_mail_data($email, $reminder_code)
    {
      $user = $this->get_user_details($email);
      if($user)
      {
          $arr_user = $user->toArray();

           if(\Request::segment(1)=='user')
            {
              $remdurl = URL::to('user/validate_user_reset_password_link/'.base64_encode($arr_user['id']).'/'.base64_encode($reminder_code) );
            } else if(\Request::segment(1)=='member'){

              $remdurl = URL::to('member/validate_user_reset_password_link/'.base64_encode($arr_user['id']).'/'.base64_encode($reminder_code) );
            } 

          //dd($remdurl);

          $arr_built_content = ['FIRST_NAME'   => $arr_user['first_name'],
                                'EMAIL'        => $arr_user['email'],
                                'REMINDER_URL' => $remdurl,
                                'SITE_URL'     => config('app.project.name')];


          $arr_mail_data                      = [];
          $arr_mail_data['email_template_id'] = '7';
          $arr_mail_data['arr_built_content'] = $arr_built_content;
          $arr_mail_data['user']              = $arr_user;

          return $arr_mail_data;
      }
      return FALSE;
    }

    public function get_user_details($email)
    {
      $credentials = ['email' => $email];
      $user = Sentinel::findByCredentials($credentials); // check if user exists

      if($user)
      {
        return $user;
      }
      return FALSE;
    }

    public function validate_user_reset_password_link($enc_id, $enc_reminder_code)
    {
      $user_id       = base64_decode($enc_id);
      $reminder_code = base64_decode($enc_reminder_code);

      $user = Sentinel::findById($user_id);

      if(!$user)
      {
        Flash::error('Invalid User Request');
        return redirect()->back();
      }

      if($reminder = Reminder::exists($user))
      {
          if(\Request::segment(1)=='user')
            {
            return view('front.layout._user_reset_password',compact('enc_id','enc_reminder_code'));
         } else if(\Request::segment(1)=='member')
         {
            return view('front.layout._member_reset_password',compact('enc_id','enc_reminder_code'));

         }
        
      }
      else
      {
        Flash::error('Reset Password Link Expired');
        return redirect()->back();
      }
    }

    public function reset_password(Request $request)
    {
        
      $arr_rules                      = array();
      $arr_rules['password']          = "required";
      $arr_rules['confirm_password']  = "required";
      $arr_rules['enc_id']            = "required";
      $arr_rules['enc_reminder_code'] = "required";

      $validator = Validator::make($request->all(),$arr_rules);

      if($validator->fails())
      {
        return redirect()->back();
      }

         $enc_id            = $request->input('enc_id');
         $enc_reminder_code = $request->input('enc_reminder_code');
         $password          = $request->input('password');
         $confirm_password  = $request->input('confirm_password');
       
      if($password  !=  $confirm_password)
      {
        Flash::error('Passwords Do Not Match.');
        return redirect()->back();
      }

      $user_id       = base64_decode($enc_id);
      $reminder_code = base64_decode($enc_reminder_code);

      $user = Sentinel::findById($user_id);
     
      if(!$user)
      {
        Flash::error('Invalid User Request');
        return redirect()->back();
      }

      if ($reminder = Reminder::complete($user, $reminder_code, $password))
      {
         if(\Request::segment(1)=='user')
         {
            Flash::success('Password reset successfully,Please login');
            return redirect(url('user/login'));
         } else if(\Request::segment(1)=='member'){
         
            Flash::success('Password reset successfully,Please login');
            return redirect(url('member/login'));
         }
        
      }
      else
      {
        Flash::error('Reset Password Link Expired');
        return redirect()->back();
      }

  }

  public function logout()
  {
    Sentinel::logout();
    return redirect(url($this->admin_panel_slug));
  }
  public function email_verification(Request $request)
  {
    $does_exists = $this->BaseModel 
                            ->where('email','=',$request->input('email'))
                            ->count();
        if($does_exists)
        {
            $arr_response['status']    = "ERROR";
        }
        else
        {
            $arr_response['status']    = "SUCCESS";   
        }
        return response()->json($arr_response);
  }

  

}

