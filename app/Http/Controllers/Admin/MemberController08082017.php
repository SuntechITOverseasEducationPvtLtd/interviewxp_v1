<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\StateModel;
use App\Models\QualificationModel;
use App\Models\CategoryModel;
use App\Models\MemberDetailModel;
use App\Models\SkillsModel;
use App\Models\MembersSkillsModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;
use App\Models\MemberInterviewModel;
use App\Models\InterviewDetailModel;
use App\Models\RealtimeExperienceModel;
use App\Models\MultiReferenceBookModel;
use App\Models\ManageEmailModel;
use App\Models\TransactionModel;
use App\Models\EmployerTypeModel;
use DB;
use Flash;
use Validator;
use Sentinel;
use File;
use Mail;

class MemberController extends Controller
{
    public function __construct(UserModel $user,
                                StateModel $state,
                                QualificationModel $qualification,
                                CategoryModel $category,
                                MemberDetailModel $memberdetail,
                                SkillsModel $skill,
                                MembersSkillsModel $member_skill,
                                ActivityLogsModel $activity_logs,
                                MemberInterviewModel $member_interview,
                                InterviewDetailModel $interview_detail,
                                RealtimeExperienceModel $real_time_work,
                                MultiReferenceBookModel $multi_ref_book,
                                ManageEmailModel $manage_email,
                                TransactionModel $transaction,
                                EmployerTypeModel $employer_type
                                )
    {
        $user = Sentinel::createModel();

        $this->UserModel             = $user;
        $this->StateModel            = $state;
        $this->BaseModel             = Sentinel::createModel();   // using sentinel for base model.
        $this->MemberDetailModel     = $memberdetail;
        $this->ManageEmailModel        = $manage_email;
        $this->SkillsModel           = $skill;
        $this->MembersSkillsModel    = $member_skill;
        $this->QualificationModel    = $qualification;
        $this->ActivityLogsModel     = $activity_logs;
        $this->CategoryModel         = $category;
        $this->MemberInterviewModel  = $member_interview;
        $this->InterviewDetailModel  = $interview_detail;
        $this->RealtimeExperienceModel = $real_time_work;
        $this->MultiReferenceBookModel = $multi_ref_book;
        $this->TransactionModel = $transaction;
        $this->EmployerTypeModel = $employer_type;

        $obj_mail_from = $this->ManageEmailModel->first();
        $this->mail_from = $obj_mail_from->general_email;


        $this->user_profile_base_img_path   = public_path().config('app.project.img_path.user_profile_image');
        $this->member_base_resume_path      = public_path().config('app.project.img_path.resume');
        $this->user_profile_public_img_path = url('/').config('app.project.img_path.user_profile_image');
        $this->member_resume_public_path    = url('/').config('app.project.img_path.resume');

        $this->member_referencebook_path            = public_path().config('app.project.img_path.refrencebook');
        $this->member_referencebook_public_path    = url('/').config('app.project.img_path.refrencebook');

        $this->member_company_attachment_path    = public_path().config('app.project.img_path.company_attachment');
        $this->member_company_attachment_public_path    = url('/').config('app.project.img_path.company_attachment');

        $this->member_realtime_attachment_path    = public_path().config('app.project.img_path.realtime_attachment');
        $this->member_realtime_attachment_public_path    = url('/').config('app.project.img_path.realtime_attachment');

        $this->arr_view_data      = [];
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/members");
        $this->module_title       = "Members";
        $this->modyle_url_slug    = "Members";
        $this->module_view_folder = "admin.members";
        /*For activity log*/
        $this->obj_data    = Sentinel::getUser();
        $this->first_name  = isset($this->obj_data->first_name)?$this->obj_data->first_name:'--';
        $this->last_name  = isset($this->obj_data->last_name)?$this->obj_data->last_name:'--';
        $this->ip_address         = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;  
        $this->theme_color = theme_color();
    }	

    public function index()
    {
        
        $this->arr_view_data['arr_data'] = array();
        $obj_data = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','user');
                                        })
                                    ->with(['member_detail','member_skills'])
                                    ->orderBy('id','desc')
        							->get();
        if($obj_data)
        {
        	$arr_data = $obj_data->toArray();
        }
        /*dd($arr_data);*/
        $this->arr_view_data['page_title']      = "A/c Activations ".str_plural($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        
        if(\Request::segment(3)=='profiles')
        {
        	$this->arr_view_data['page_title']      = "Profiles ".str_plural($this->module_title);
        	return view($this->module_view_folder.'.profiles', $this->arr_view_data);
        }
        return view($this->module_view_folder.'.index', $this->arr_view_data);

    }

     /*public function profiles()
    {
        $this->arr_view_data['arr_data'] = array();
        $obj_data = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','user');
                                        })
                                    ->with(['member_detail','member_skills'])
                                    ->orderBy('id','desc')
                                    ->get();
        if($obj_data)
        {
            $arr_data = $obj_data->toArray();
        }
   
        $obj_mydata = $this->UserModel->get();
        if ($obj_mydata) 
        {
            $obj_mydata = $obj_mydata->toArray();
        }
        $this->arr_view_data['page_title']      = "Profiles ".str_plural($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.profiles', $this->arr_view_data);
    }*/


    public function approve_change(Request $request)
    {
        $arr_update = [];
        $user_id    = $request->input('id');
        $approve_value = $request->input('approve_status');
        if($approve_value=='Approved')
        {
            $user = Sentinel::findById($user_id);
            $role = Sentinel::findRoleByName('User');
            $role->users()->detach($user);
            $arr_update['normal_member'] = 'yes';
            $obj_arr_data = $this->BaseModel->where('id',$user_id)->first();
            $arr_user_email_data =[];
            if($obj_arr_data)
            {
              $arr_user_email_data = $obj_arr_data->toArray();
            }
            $email_id = isset($arr_user_email_data['email'])?$arr_user_email_data['email']:'';
            $data['user_id'] = $user_id;
            $data['name'] = ucfirst(isset($arr_user_email_data['first_name'])?$arr_user_email_data['first_name']:'');
            $data['email_id'] = isset($arr_user_email_data['email'])?$arr_user_email_data['email']:'';
            $project_name = config('app.project.name');
            $mail_from =$this->mail_from;
            Mail::send('front.email.account_approved', $data, function ($message) use ($email_id,$mail_from,$project_name) {
                      $message->from($mail_from, $project_name);
                      $message->subject($project_name.':Account Approved');
                      $message->to($email_id);
                  });
        }
        
        $arr_update['admin_status'] = $approve_value;
        $result = $this->UserModel->where('id',$user_id)->update($arr_update);
        if($result)
        {
             Flash::success('Member A/C Activation Status Changed Successfully.');        
             $arr_response['status']    = "SUCCESS";
        } 
        else
        {
             Flash::error('Problem Occured While Changed Member A/C Activation Status.');
             $arr_response['status']    = "Error";
        }   
        
        return response()->json($arr_response);
    }

    public function create()
    {
        $this->arr_view_data['page_title']        = "Create ".str_singular($this->module_title);
        $this->arr_view_data['module_title']      = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['theme_color']       = $this->theme_color;
        return view($this->module_view_folder.'.create', $this->arr_view_data);
    }


    public function store(Request $request)
    {   /*dd($request->all());*/
        $arr_rules['password']          = "required";
        $arr_rules['first_name']        = "required";
        $arr_rules['last_name']         = "required";
        $arr_rules['email']             = "required";
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

        /* Check for email duplication */
        $does_exists = $this->BaseModel	
                            ->where('email','=',$request->input('email'))
                            ->count();

        if($does_exists)
        {
            Flash::error(str_singular($this->module_title).' Already Exists!!!');
            return redirect()->back()->withInput($request->all());
        }   
        
            
        $file_name      = "default.jpg";
        if($request->hasFile('profile_image'))
        {	
            $fileExtension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
            $arr_file_types = ['jpg','jpeg','png','bmp'];
        	
            if(in_array($fileExtension, $arr_file_types))
            {
		        $file_name      = $request->input('profile_image');
		        $file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
		        $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
		        $request->file('profile_image')->move($this->user_profile_base_img_path, $file_name); 
		    }
		    else
		    {
		    	Flash::error('Please upload valid image with jpg, jpeg ,png extension!!!');
                return redirect()->back();
		    } 
    	}
    	$date = $request->input('date');
        $month = $request->input('month');
        $year = $request->input('year');
        
        $birth_date=date('Y-m-d',strtotime($year.'-'.$month.'-'.$date)); 

        $user = Sentinel::registerAndActivate([
            'first_name' => $request->input('first_name'),
            'email'      => $request->input('email'),
            'last_name' => $request->input('last_name'),
            'password'   => $request->input('password'),
        ]);

        if($user)
        {   
            /* Assign User Role */
            $user = Sentinel::findById($user->id);
            $role = Sentinel::findRoleBySlug('member');
            $user->roles()->attach($role);

            $arr_user_data                   = [];
            $arr_user_data['user_type']		= 'member';	
            $arr_user_data['profile_image']  = $file_name;
            $arr_user_data['gender']        = $request->input('gender');
            $arr_user_data['mobile_no']          = $request->input('mobile_no');
            $arr_user_data['is_active']      = '1';
            $arr_user_data['birth_date'] = $birth_date;
            $user::where('id','=',$user->id)->update($arr_user_data);

            $user_id = $user->id;
            $member_data = [];
            $member_data['user_id'] = $user_id;
            $member_detail_obj = $this->MemberDetailModel->create($member_data);
            $member_id = $member_detail_obj->id;

            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).'Profile Created By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Create','ip_address'=>$this->ip_address]));

            Flash::success(str_singular($this->module_title).' Created Successfully!!!');
        }
        else
        {
            Flash::error('Problem Occured While Creating '.str_singular($this->module_title));
        }   
        $type='create';
        return redirect(url('/admin/members/employment/'.base64_encode($member_id)));        
    }

    public function edit_personal($enc_id)
    {
    	$id = base64_decode($enc_id);
        $arr_data = [];
        $obj_data = $this->BaseModel->where('id',$id)->first();
        if($obj_data)
        {
        	$arr_data = $obj_data->toArray();
        }
        /*dd($arr_data);*/
        if(isset($arr_data) && sizeof($arr_data)>0)
        {
            $birth = explode('-', $arr_data['birth_date']);
            $birth_year=$birth[0];
            $birth_month=$birth[1];
            $birth_date=$birth[2];
        } 
        $this->arr_view_data['page_title']                   = "Edit ".str_singular($this->module_title)." Personal";
        $this->arr_view_data['module_title']                 = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']              = $this->module_url_path;
        $this->arr_view_data['arr_data']                     = $arr_data;
        $this->arr_view_data['enc_id']                       = base64_encode($id);
        $this->arr_view_data['birth_year']                   = $birth_year;
        $this->arr_view_data['birth_month']                  = $birth_month;
        $this->arr_view_data['birth_date']                   = $birth_date;
        $this->arr_view_data['user_profile_public_img_path'] = $this->user_profile_public_img_path;
        $this->arr_view_data['theme_color']                  = $this->theme_color;


        return view($this->module_view_folder.'.edit_personal', $this->arr_view_data);	
    }

    public function update(Request $request)
    {
    	$id = base64_decode($request->input('enc_id'));
        $arr_rules['first_name']        = "required";
        $arr_rules['last_name']         = "required";
        $arr_rules['email']             = "required";
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

        /* Check for email duplication */
        $does_exists = $this->BaseModel
                            ->where('id','<>',$id) 
                            ->where('email','=',$request->input('email'))
                            ->count();

        if($does_exists)
        {
            Flash::error(str_singular($this->module_title).' Already Exists!!!');
            return redirect()->back()->withInput($request->all());
        }    
        
        $obj_data = $this->BaseModel->where('id','=',$id)->first(['id','profile_image']);
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();
        }
      
        $file_name = $arr_data['profile_image'];
        if($request->hasFile('profile_image'))
        {            
            $fileExtension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
            $arr_file_types = ['jpg','jpeg','png','bmp'];

             if(in_array($fileExtension, $arr_file_types))
            {
                if(isset($arr_data) && sizeof($arr_data)>0)
                {
                    if(File::exists($this->user_profile_base_img_path.$arr_data['profile_image']))
                    {
                        unlink($this->user_profile_base_img_path.$arr_data['profile_image']);
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
                Flash::error('Please upload valid image with jpg, jpeg ,png extension!!!');
                return redirect()->back();
            }
        }
        $date = $request->input('date');
        $month = $request->input('month');
        $year = $request->input('year');
        $birth_date=date('Y-m-d',strtotime($year.'-'.$month.'-'.$date));

            $arr_user_data                   = [];
            $arr_user_data['first_name']    = $request->input('first_name');
            $arr_user_data['last_name']     = $request->input('last_name');
            $arr_user_data['email']         = $request->input('email');
            $arr_user_data['profile_image'] = $file_name;
            $arr_user_data['gender']        = $request->input('gender');
            $arr_user_data['mobile_no']     = $request->input('mobile_no');
            $arr_user_data['birth_date']    = $birth_date;
            $arr_user_data['training_tab']    = $request->input('training_tab');

            $user_data=$this->BaseModel->where('id',$id)->update($arr_user_data);

        if($user_data)
        {    
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Personal Updated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Update','ip_address'=>$this->ip_address]));
            $get_id = $this->MemberDetailModel->where('user_id','=',$id)->first();
            return redirect(url('/admin/members/edit_employment/'.base64_encode($get_id['id'])));
        }
        else
        {
            Flash::error('Problem Occured While Updating '.str_singular($this->module_title));
            return redirect()->back();
        }     
    }

    public function employment($member_id)
    {
    	$this->arr_view_data['enc_id'] = $member_id;

        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->where('is_active','=',1)  
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }
        $arr_category = [];
        $obj_category = $this->CategoryModel->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }
        $type='create';
    	$this->arr_view_data['page_title']        = "Create Employment";
        $this->arr_view_data['module_title']      = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['type'] = $type;
        $this->arr_view_data['arr_state'] = $arr_state;
        $this->arr_view_data['arr_category'] = $arr_category;
        $this->arr_view_data['theme_color']       = $this->theme_color;
        return view($this->module_view_folder.'.create_employment', $this->arr_view_data);
    }


    public function store_employment(Request $request)
    {
        dd($request->all());
    	$member_id = base64_decode($request->input('enc_id'));
    	$type='';
    	if($request->input('type')!='')
    	{
                $type = $request->input('type');
    	}


        $arr_rules['skills']           = "required";
        $arr_rules['experience_year']  = "required";
        $arr_rules['experience_month'] = "required";
        $arr_rules['employer_name']     = "required";
        $arr_rules['employer_type']    = "required";
        $arr_rules['city']    = "required";
        /*$arr_rules['start_month']      = "required";
        $arr_rules['start_year']       = "required";
        $arr_rules['end_month']        = "required";
        $arr_rules['end_year']         = "required";
        $arr_rules['designation']      = "required";
        $arr_rules['category_id']      = "required";*/


        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
        $file_name = $request->input('old_resume');
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
                $request->file('resume')->move($this->member_base_resume_path, $file_name);
            }
             else
            {
                Flash::error('Please upload valid file with doc,docx,pdf,rtf extension max size 500 kb');
                return redirect()->back();
            } 
        }

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
            
        }

        $this->MembersSkillsModel->where('member_id',$member_id)->delete();
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
        $employer_name='';
        if($request->input('employer_name')!='')
        {
        	$employer_name = $request->input('employer_name');
        }
        $arr_member_data = [];
        $arr_member_data['experience_years']      = $request->input('experience_year');
        $arr_member_data['employer_name']         = $employer_name;
        $arr_member_data['experience_month']      = $request->input('experience_month');
        $arr_member_data['resume']                = $file_name;
        /*$arr_member_data['company_name']          = $request->input('company_name');*/
        /*$arr_member_data['employer_name']          = $request->input('employer_name');*/
        $arr_member_data['employer_type']         = $request->input('employer_type');
        /*$arr_member_data['start_month']           = $request->input('start_month');
        $arr_member_data['start_year']            = $request->input('start_year');
        $arr_member_data['end_month']             = $request->input('end_month');
        $arr_member_data['end_year']              = $request->input('end_year');
        $arr_member_data['designation']           = $request->input('designation');
        $arr_member_data['category_id']           = $request->input('category_id');*/
        $arr_member_data['current_work_location'] = $request->input('city');
        $this->MemberDetailModel->where('id',$member_id)->update($arr_member_data);
        if($type=='create')
        {
        	return redirect(url('/admin/members/education/'.base64_encode($member_id)));
        }
    	else
    	{  
            Flash::success(str_singular($this->module_title).' Updated Successfully!!!');
    		return redirect(url('/admin/members/edit_education/'.base64_encode($member_id)));		
    	}
    }

    public function edit_employment($enc_id)
    {
    	$member_id = base64_decode($enc_id);
        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->where('is_active','=',1)  
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }
        $arr_category = [];
        $obj_category = $this->CategoryModel->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }
        
        $obj_data = $this->MemberDetailModel->where('id',$member_id)->with(['member_skills','member_employer_type'])->first();
        if($obj_data)
        {
        	$arr_data=$obj_data->toArray();
        }
        $this->arr_view_data['enc_id'] = base64_encode($member_id);
    	$this->arr_view_data['page_title']        = "Edit Employment";
        $this->arr_view_data['module_title']      = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['arr_state'] = $arr_state;
        $this->arr_view_data['arr_category'] = $arr_category;
        $this->arr_view_data['arr_data'] = $arr_data;
        $this->arr_view_data['theme_color']       = $this->theme_color;
        return view($this->module_view_folder.'.edit_employment', $this->arr_view_data);	
    }

    public function education($mem_id)
    {
    	$arr_qualification = [];
        $obj_qualification = $this->QualificationModel->where('is_active','1')->get();
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
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }

    	$this->arr_view_data['enc_id'] = $mem_id;
    	$this->arr_view_data['page_title']        = "Create Education";
        $this->arr_view_data['module_title']      = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['arr_qualification']   = $arr_qualification;
        $this->arr_view_data['arr_state']   = $arr_state;
        $this->arr_view_data['theme_color']       = $this->theme_color;
        return view($this->module_view_folder.'.create_education', $this->arr_view_data);
    }
    public function edit_education($mem_id)
    {	
        $member_id = base64_decode($mem_id);
    	$arr_qualification = [];
        $obj_qualification = $this->QualificationModel->where('is_active','1')->get();
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
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }
        $obj_data = $this->MemberDetailModel->where('id',$member_id)->first();
        if($obj_data)
        {
        	$arr_data = $obj_data->toArray();
        }
        /*dd($arr_data);*/

 		$this->arr_view_data['enc_id'] = base64_encode($member_id);
    	$this->arr_view_data['page_title']        = "Edit Education";
    	$this->arr_view_data['arr_data'] = $arr_data;
        $this->arr_view_data['module_title']      = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['arr_qualification']   = $arr_qualification;
        $this->arr_view_data['arr_state']   = $arr_state;
        $this->arr_view_data['theme_color']       = $this->theme_color;
        return view($this->module_view_folder.'.edit_education', $this->arr_view_data);
    	
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
    	$arr_rules['city']              = "required";
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
                Flash::error('Percentage value must be between 30 to 100!!!');
                return redirect()->back();
            }    
        }
        if($request->input('marks_type')=='cgpa')
        {
            if($marks_input<1 || $marks_input>10)
            {
                Flash::error('CGPA value must be between 1 to 10!!!');
                return redirect()->back();
            }    
        } 

        $arr_member_data                      = [];
        $arr_member_data['qualification_id']  = $request->input('qualification_id');
        $arr_member_data['passing_month']     = $request->input('passing_month');
        $arr_member_data['passing_year']      = $request->input('passing_year');
        $arr_member_data['marks_type']        = $request->input('marks_type');
        $arr_member_data['specialization_id'] = $request->input('specialization_id');
        $arr_member_data['marks']             = $request->input('marks_input');
        $arr_member_data['pan_no']            = $request->input('pan_no');
        $arr_member_data['address']           = $request->input('address');
        $arr_member_data['education_city']              = $request->input('city');
        $arr_member_data['pincode']           = $request->input('pincode');
        $arr_member_data['about_member']      = $request->input('about_member');
        $member_data = $this->MemberDetailModel->where('id',$member_id)->update($arr_member_data);

        if($member_data)
        {
        	Flash::success(str_singular($this->module_title).' Detail Stored Successfully!!!');
        }
        else
        {
        	Flash::error('Error While'.str_singular($this->module_title).' Updation !!!');	
        }
    	
        return redirect(url('/admin/members/profiles'));
    }

    public function activate($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }
        if($this->perform_activate(base64_decode($enc_id)))
        {
            Flash::success(str_singular($this->module_title).' Activated Successfully!!!');
        }
        else
        {
            Flash::error('Problem Occured While '.str_singular($this->module_title).' Activation ');
        }
        return redirect()->back();
    }

    public function deactivate($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->perform_deactivate(base64_decode($enc_id)))
        {
            Flash::success(str_singular($this->module_title).' Deactivated Successfully!!!');
        }
        else
        {
            Flash::error('Problem Occured While '.str_singular($this->module_title).' Deactivation ');
        }

        return redirect()->back();
    }

    public function delete($enc_id = FALSE)
    {
        if(!$enc_id)
        {
            return redirect()->back();
        }
        if($this->perform_delete(base64_decode($enc_id)))
        {   
            Flash::success(str_singular($this->module_title).' Deleted Successfully!!!');
        }
        else
        {
            Flash::error('Problem Occured While '.str_singular($this->module_title).' Deletion!!! ');
        }
        return redirect()->back();
    }

    
    public function multi_action(Request $request)
    {
        $arr_rules = array();
        $arr_rules['multi_action'] = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select '.str_plural($this->module_title) .' To Perform Multi Actions');  
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action = $request->input('multi_action');
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
               Flash::success(str_plural($this->module_title).' Deleted Successfully!!!'); 
            } 
            elseif($multi_action=="activate")
            {
               $this->perform_activate(base64_decode($record_id)); 
               Flash::success(str_plural($this->module_title).' Activated Successfully!!!'); 
            }
            elseif($multi_action=="deactivate")
            {
               $this->perform_deactivate(base64_decode($record_id));    
               Flash::success(str_plural($this->module_title).' Blocked Successfully!!!');  
            }
        }

        return redirect()->back();
    }

    public function perform_activate($id)
    {
        $entity = $this->BaseModel->where('id',$id)->first();
        if($entity)
        {
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Activated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Activate','ip_address'=>$this->ip_address]));
            return $this->BaseModel->where('id',$id)->update(['is_active'=>1,'is_deactivate'=>0]);
        }
        return FALSE;
    }

    public function perform_deactivate($id)
    {
        $entity = $this->BaseModel->where('id',$id)->first();
        if($entity)
        {
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deactivated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Deactivate','ip_address'=>$this->ip_address]));
            return $this->BaseModel->where('id',$id)->update(['is_active'=>0]);
        }
        return FALSE;
    }

    public function perform_delete($id)
    {
        $entity = $this->BaseModel->where('id',$id)->first();
        if($entity)
        {
            /* Detaching Role from user Roles table */
            $user        = Sentinel::findById($id);
            $role_user = Sentinel::findRoleBySlug('member');
            $user->roles()->detach($role_user);

            if($entity->profile_image)
            {
                $unlink_path    = $this->user_profile_base_img_path.$entity->profile_image;
                @unlink($unlink_path);
            }
            $this->MemberDetailModel->where('user_id',$id)->delete();
           $delete_success = $this->BaseModel->where('id',$id)->delete();
           event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deleted By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Delete','ip_address'=>$this->ip_address]));

           return $delete_success;
        }

        return FALSE;
    }

    public function get_skills(Request $request)
    {
        if($request->has('search'))
        {
            $search_term = $request->input('search');
            $obj_data = $this->SkillsModel->select(['id','skill_name'])
                                           ->where('skill_name','LIKE','%'.$search_term.'%');
                                        
            $arr_data = $obj_data->get()->toArray();
            return response()->json($arr_data);
        }
    }

    public function details($enc_id)
    {
        $id = base64_decode($enc_id);

        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }

        $obj_category = $this->CategoryModel->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }
        $arr_data = [];

        $obj_data = $this->BaseModel->where('id',$id)->with(['member_detail'])->first();
        if($obj_data)
        {
            $arr_data=$obj_data->toArray();

        }
        
        $arr_skill = [];
        $member_id = $arr_data['member_detail']['id'];
        $obj_skill = $this->MembersSkillsModel->where('member_id',$member_id)->get();
        $all_skills = "";
        if($obj_skill)
        {
            $arr_skill_name = [];
            $arr_skill = $obj_skill->toArray();
            if(sizeof($arr_skill)>0)
            {
                foreach($arr_skill as $skill)
                {
                    array_push($arr_skill_name,$skill['skill_name']);
                }   
                $all_skills = implode(',',$arr_skill_name);
            }
            
        }

        $employer_type_detail = $this->EmployerTypeModel->where('member_id',$member_id)->get();
        if($employer_type_detail)
        {
            $arr_employer_type = $employer_type_detail->toArray();
        }

        $no_of_sale =$this->TransactionModel->where('member_user_id',$id)->where('payment_status','Paid')->count();
        $no_of_purchase = $this->TransactionModel->where('user_id',$id)->where('payment_status','Paid')->count();
        $member_interview_count = $this->MemberInterviewModel 
                            ->where('user_id',$id)
                            ->where('admin_approval',1) 
                            ->count();

        $obj_earnings =$this->TransactionModel->where('member_user_id',$id)->where('member_payment_status','Paid')->get(['member_amount']);
        if($obj_earnings)
        {
            $arr_revenue = $obj_earnings->toArray();
        }
        $total_revenue_ern = 0;
        foreach($arr_revenue as $meb_amount)
        {
            $total_revenue_ern=($total_revenue_ern)+($meb_amount['member_amount']);
        }

        $this->arr_view_data['page_title']                   = "View ".str_singular($this->module_title);
        $this->arr_view_data['module_title']                 = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']              = $this->module_url_path;
        $this->arr_view_data['arr_data']                     = $arr_data;
        $this->arr_view_data['all_skill']                    = $all_skills;
        $this->arr_view_data['arr_employer_type_detail']     = $arr_employer_type;
        $this->arr_view_data['arr_category']                 = $arr_category;
        $this->arr_view_data['arr_state']                    = $arr_state;
        $this->arr_view_data['member_interview_count']       = $member_interview_count;
        $this->arr_view_data['enc_id']                       = base64_encode($id);
        $this->arr_view_data['user_profile_public_img_path'] = $this->user_profile_public_img_path;
        $this->arr_view_data['member_resume_public_path']    = $this->member_resume_public_path;
        $this->arr_view_data['theme_color']                  = $this->theme_color;
        $this->arr_view_data['no_of_sale']                   = $no_of_sale;
        $this->arr_view_data['no_of_purchase']               = $no_of_purchase;
        $this->arr_view_data['total_revenue_ern']            = $total_revenue_ern;
        return view($this->module_view_folder.'.view', $this->arr_view_data);  
    }

    public function comment($enc_id)
    {
        $user_id = base64_decode($enc_id);
        $arr_member_info=[];

        $obj_member_info = $this->BaseModel->where('id',$user_id)->first();
        if($obj_member_info)
        {
            $arr_member_info = $obj_member_info->toArray();
        }
        //dd($arr_member_info);
        $this->arr_view_data['enc_id']              = $enc_id;
        $this->arr_view_data['arr_member_info']     = $arr_member_info;
        $this->arr_view_data['page_title']          = 'Admin Comment';
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['theme_color']         = $this->theme_color;
        return view($this->module_view_folder.'.comment',$this->arr_view_data);
    }

    public function store_comment(Request $request)
    {
        $arr_rules['comment']            = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $user_id = base64_decode($request->input('enc_id'));
        $comment = $request->input('comment');
        
        $comment = $this->BaseModel->where('id',$user_id)->update(['admin_comments'=>$comment ]);
        if($comment)
        {
            Flash::success('Admin comment added Successfully.');
        }
        else
        {
            Flash::error('Error occur while storing admin comment.');
        }
        return redirect()->back();
    }

    public function upload_approvals()
    {
        $arr_data=[];
        $this->arr_view_data['arr_data'] = array();
        $obj_data = $this->MemberInterviewModel
                         ->with(['skilldetails','member_personal_details'])
                         ->orderBy('id','desc')
                         ->get();
        if($obj_data && sizeof($obj_data)>0)
        {
            $arr_data = $obj_data->toArray();
            //dd($arr_data);
            $count_interview_member="";
            $count_interview_data="";
            $count_real_time_work="";
            foreach ($arr_data as $key => $record) 
            {
                $count_interview_member = $this->MultiReferenceBookModel->where('interview_id',$record['id'])->where('approve_status','0')->count();
                $count_interview_data = $this->InterviewDetailModel->where('interview_id',$record['id'])->where('approve_status','0')->count();
                $count_real_time_work = $this->RealtimeExperienceModel->where('interview_id',$record['id'])->where('approve_status','0')->count();
                $arr_data[$key]['count']=$count_interview_member+$count_interview_data+$count_real_time_work;
            }

            

        }
        
        $this->arr_view_data['page_title']      = "Upload Approvals ";
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.upload_approvals', $this->arr_view_data);
    }

    public function comment_upload_approvals($enc_id,$comment_status)
    {
        //dd($comment_status);
        $id = base64_decode($enc_id);
        $arr_interview_info=[];
        if($comment_status == 'comment_interview')
        {
          $obj_interview_info = $this->MultiReferenceBookModel->where('id',$id)->first(['admin_comments']);
        }
        elseif ($comment_status == 'comment_company') 
        {
          $obj_interview_info = $this->InterviewDetailModel->where('id',$id)->first(['admin_comments']);
        }
        elseif ($comment_status == 'comment_rwe') 
        {
            $obj_interview_info = $this->RealtimeExperienceModel->where('id',$id)->first(['admin_comments']);
        }

        $this->arr_view_data['enc_id']              = $enc_id;
        $this->arr_view_data['comment_status']      = $comment_status;
        $this->arr_view_data['arr_comment_info']    = $obj_interview_info['admin_comments'];
        $this->arr_view_data['page_title']          = 'Upload Approvals Comment';
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['theme_color']         = $this->theme_color;
        return view($this->module_view_folder.'.comment_upload_approvals',$this->arr_view_data);
    }
     public function store_upload_approvals_comment(Request $request)
    {
        $arr_rules['comment']            = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $id             = base64_decode($request->input('enc_id'));
        $comment        = $request->input('comment');
        $comment_status = $request->input('comment_status');

        if($comment_status == 'comment_interview')
        {
            $comment = $this->MultiReferenceBookModel->where('id',$id)->update(['admin_comments'=>$comment ]);
        }
        elseif ($comment_status == 'comment_company') 
        {
            $comment = $this->InterviewDetailModel->where('id',$id)->update(['admin_comments'=>$comment ]);
        }
        elseif ($comment_status == 'comment_rwe') 
        {
            $comment = $this->RealtimeExperienceModel->where('id',$id)->update(['admin_comments'=>$comment ]);
        }
       
        if($comment)
        {
            Flash::success('Admin comment added Successfully.');
        }
        else
        {
            Flash::error('Error occur while storing admin comment.');
        }
        return redirect()->back();
    }

    public function upload_approve_change(Request $request)
    {
        $approve_id    = $request->input('id');
        $approve_value = $request->input('approve_status');
        $admin_status  = $request->input('status');
        $interview_id  = $request->input('interview_id');

        //dd($interview_id);
        if($admin_status == 'status_interview')
        {
            $result = $this->MultiReferenceBookModel->where('id',$approve_id)->update(['approve_status'=>$approve_value]);
            if($result)
            {
                $update_interview_table = $this->MemberInterviewModel->where('id',$interview_id)->update([]);
            }
        }
        elseif ($admin_status == 'status_company') {
            $date = date('Y-m-d H:i:s');
            $result = $this->InterviewDetailModel->where('id',$approve_id)->update(['approve_status'=>$approve_value,'approve_date'=>$date]);
            if($result)
            {
                $update_interview_table = $this->MemberInterviewModel->where('id',$interview_id)->update([]);
            }
        }
        elseif ($admin_status == 'status_rwe') {
            $result = $this->RealtimeExperienceModel->where('id',$approve_id)->update(['approve_status'=>$approve_value]);
            if($result)
            {
                $update_interview_table = $this->MemberInterviewModel->where('id',$interview_id)->update([]);
            }
        }
        
        if($result)
        {
             Flash::success('Upload Approvals Status Changed Successfully.');        
             $arr_response['status']    = "SUCCESS";
        } 
        else
        {
             Flash::error('Problem Occured While Changed Upload Approvals Status.');
             $arr_response['status']    = "Error";
        }   
        return response()->json($arr_response);
    }

    public function upload_approve_admin_change(Request $request)
    {
        //dd($request->input('id'));
        $approve_id    = $request->input('id');
        $approve_value = $request->input('approve_status');
        //dd($approve_value);
        if($approve_value=='1')
        {
            $approveStatus='Approved';
        }
        if($approve_value=='2')
        {
            $approveStatus='Rejected';
        }
        $memberInfo=$this->MemberInterviewModel->where('id',$approve_id)->first();
        //dd($memberInfo['user_id']);
       
        $publishDate=date("Y-m-d h:i:sa");

        $result = $this->MemberInterviewModel->where('id',$approve_id)->update(['admin_approval'=>$approve_value,'is_active'=>1,'publish_date'=>$publishDate]);
        if($result)
        {
              if(isset($memberInfo['user_id']))
              {
                $uesrInfo=$this->UserModel->where('id',$memberInfo['user_id'])->first();
                $email_id=$uesrInfo['email'];
                $data['approveStatus']=$approveStatus;
                $data['name'] = ucfirst(isset($uesrInfo['first_name'])?$uesrInfo['first_name']:'');
                $project_name = config('app.project.name');
                $mail_from =$this->mail_from;
                Mail::send('front.email.interview_account_approved', $data, function ($message) use ($email_id,$mail_from,$project_name,$approveStatus) {
                          $message->from($mail_from, $project_name);
                          $message->subject($project_name.':Interview '.$approveStatus);
                          $message->to($email_id);
                      });
        

               }


             Flash::success('Upload Approvals Changed Successfully.');        
             $arr_response['status'] = "SUCCESS";
        } 
        else
        {
             Flash::error('Problem Occured While Changed Upload Approvals .');
             $arr_response['status'] = "Error";
        }  
        return response()->json($arr_response);
    }



   public function deactivate_upload_approve($enc_id)
   {
        if(!$enc_id)
        {
            return redirect()->back();
        }
        $id = base64_decode($enc_id);
        $result = $this->MemberInterviewModel->where('id',$id)->update(['is_active'=>0]);
        if($result)
        {
            Flash::success('Upload Approvals Deactivated Successfully');
        }
        else
        {
            Flash::error('Problem Occured While Upload Approvals Deactivation ');
        }
        return redirect()->back();
   }

   public function activate_upload_approve($enc_id)
   {
        if(!$enc_id)
        {
            return redirect()->back();
        }
        $id = base64_decode($enc_id);
        $result = $this->MemberInterviewModel->where('id',$id)->update(['is_active'=>1]);
        if($result)
        {
            Flash::success('Upload Approvals Activated Successfully');
        }
        else
        {
            Flash::error('Problem Occured While Upload Approvals Activation ');
        }
        return redirect()->back();

   }

   public function multi_action_upload_approve(Request $request)
    {
        //dd($request->all());
        $arr_rules = array();
        $arr_rules['multi_action_upload_approve'] = "required";
        $arr_rules['checked_record'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            Flash::error('Please Select Upload Approvals To Perform Multi Actions');  
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $multi_action = $request->input('multi_action_upload_approve');
        $checked_record = $request->input('checked_record');

        /* Check if array is supplied*/
        if(is_array($checked_record) && sizeof($checked_record)<=0)
        {
            Session::flash('error','Problem Occured, While Doing Multi Action');
            return redirect()->back();
        }
        
        foreach ($checked_record as $key => $record_id) 
        {  
            if($multi_action=="activate")
            {
               $result = $this->MemberInterviewModel->where('id',base64_decode($record_id))->update(['is_active'=>1]);
               Flash::success('Upload Approvals Activated Successfully');   
            }
            elseif($multi_action=="deactivate")
            {
               $result = $this->MemberInterviewModel->where('id',base64_decode($record_id))->update(['is_active'=>0]);
               Flash::success('Upload Approvals Blocked Successfully');  
            }
        }

        return redirect()->back();
    }

    public function upload_approve_details($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_interview_member = [];
        $obj_interview_member = $this->MemberInterviewModel->where('id',$id)->with(['skilldetails','reference_book_details'])->first();
        if($obj_interview_member)
        {
            $arr_interview_member = $obj_interview_member->toArray();
        }

        $arr_interview_data = [];
        $obj_interview_data = $this->InterviewDetailModel->where('interview_id',$id)->get();
        if($obj_interview_data)
        {
            $arr_interview_data = $obj_interview_data->toArray();
        }

        $arr_real_time_work = [];
        $obj_real_time_work = $this->RealtimeExperienceModel->where('interview_id',$id)->get();
        if($obj_real_time_work)
        {
            $arr_real_time_work = $obj_real_time_work->toArray();
        }

        //dd($arr_interview_member);

        $this->arr_view_data['page_title']              = "Upload Approvals Details";
        $this->arr_view_data['module_title']            = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']         = $this->module_url_path;
        $this->arr_view_data['arr_interview_member']    = $arr_interview_member;
        $this->arr_view_data['arr_interview_data']      = $arr_interview_data;
        $this->arr_view_data['arr_real_time_work']      = $arr_real_time_work;
        $this->arr_view_data['theme_color']             = $this->theme_color;
        $this->arr_view_data['member_referencebook_public_path']         = $this->member_referencebook_public_path;
  
        $this->arr_view_data['member_company_attachment_public_path']    = $this->member_company_attachment_public_path;
        $this->arr_view_data['member_realtime_attachment_public_path']   = $this->member_realtime_attachment_public_path;      

        return view($this->module_view_folder.'.upload_approvals_details', $this->arr_view_data);
    }

}
