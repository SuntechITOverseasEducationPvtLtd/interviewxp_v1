<?php

namespace App\Http\Controllers\Front\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\StateModel;
use App\Models\QualificationModel;
use App\Models\CategoryModel;
use App\Models\UserDetailModel;
use App\Models\SpecializationModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;
use App\Models\CountryModel;
use App\Models\NotificationModel;
use App\Models\MemberDetailModel;
use App\Models\AccountSettingModel;
use App\Models\ManageEmailModel;
use App\Models\SkillsModel;
use App\Models\UserAlertsModel;
use App\Models\TransactionModel;
use App\Models\PurchaseHistoryModel;
use App\Models\InterviewDetailModel;
use App\Models\PurchasedTicketModel;
use App\Models\MultiReferenceBookModel;
use App\Models\AdvertisementModel;

use Validator;
use Sentinel;
use Flash;
use Session;
use Activation;
use Mail;
use File;

class UserController extends Controller
{
    public function __construct(userModel $user,
    							StateModel $state,
    							QualificationModel $qualification,
								CategoryModel $category,
                                SpecializationModel $specialization,
								UserDetailModel $user_detail,
                                CountryModel $country,
                                NotificationModel $notification,
                                MemberDetailModel $member_detail,
                                AccountSettingModel $account_setting,
                                ManageEmailModel $manage_email,
                                SkillsModel $skill,
                                UserAlertsModel $user_alerts,
                                TransactionModel $transaction,
                                PurchaseHistoryModel $purchase_history,
                                MultiReferenceBookModel $multiple_reference_book,
                                InterviewDetailModel $interview_detail,
                                PurchasedTicketModel $purchase_ticket,
                                AdvertisementModel $advertisement
    							)
    {
        $this->arr_view_data = [];
    	$this->UserModel = $user;
    	$this->BaseModel = Sentinel::createModel();
    	$this->StateModel = $state;
    	$this->QualificationModel = $qualification;
        $this->SpecializationModel = $specialization;
    	$this->CategoryModel = $category;
    	$this->UserDetailModel = $user_detail;
        $this->CountryModel = $country;
        $this->NotificationModel    = $notification;
        $this->MemberDetailModel = $member_detail;
        $this->AccountSettingModel = $account_setting;
        $this->ManageEmailModel = $manage_email;
        $this->SkillsModel   = $skill;
        $this->UserAlertsModel = $user_alerts;
        $this->TransactionModel        = $transaction;
        $this->PurchaseHistoryModel    = $purchase_history;
        $this->InterviewDetailModel    = $interview_detail;
        $this->PurchasedTicketModel    = $purchase_ticket;
        $this->MultiReferenceBookModel = $multiple_reference_book;
        $this->AdvertisementModel      = $advertisement; 

        $this->module_title       = "Users";

          if(! $user = Sentinel::check()) 
          {
            return redirect('user/login');
          }

          if(!$user->inRole('user')) 
          {
            return redirect('user/login'); 
          }
        $this->user_id   = $user->id;
        $obj_mail_from = $this->ManageEmailModel->first();
        $this->mail_from = $obj_mail_from->general_email;
        
        $this->user_profile_base_img_path   = public_path().config('app.project.img_path.user_profile_image');
        $this->user_profile_public_img_path = url('/').config('app.project.img_path.user_profile_image');

        $this->member_company_attachment_path    = public_path().config('app.project.img_path.company_attachment');
        $this->member_company_attachment_public_path    = url('/').config('app.project.img_path.company_attachment');

        $this->member_realtime_attachment_path    = public_path().config('app.project.img_path.realtime_attachment');
        $this->member_realtime_attachment_public_path    = url('/').config('app.project.img_path.realtime_attachment');

        $this->member_referencebook_path    = public_path().config('app.project.img_path.refrencebook');
        $this->member_referencebook_public_path    = url('/').config('app.project.img_path.refrencebook');

        $this->advertise_base_img_path   = public_path().config('app.project.img_path.advertise_image');
        $this->advertise_public_img_path = url('/').config('app.project.img_path.advertise_image');

        $this->module_view_folder= "front.user";
    }


    public function dashboard()
    {
        $this->arr_view_data['module_title'] = "Dashboard";
    	return view('front.user.dashboard',$this->arr_view_data);
    }

    public function get_specialization($qualification_id)
    {

        $arr_specialization = array();
        $arr_response = array();

        $obj_specialization = $this->SpecializationModel
                                       ->select('id','specialization_name')
                                       ->where('is_active','=',1)  
                                       ->where('qualification_id',$qualification_id)
                                       ->get();
        if($obj_specialization != FALSE)
        {
            $arr_specialization =  $obj_specialization->toArray();
        }
        dd('gdfdfdfgdf');

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


    public function profile()
    {
    	if(! $user = Sentinel::check()) 
        {
            return redirect('user/login');
        }

        if(!$user->inRole('user')) 
        {
        return redirect('user/login'); 
        }
        $user_id = $user->id;

        $arr_data = [];
        $obj_data = $this->BaseModel->where('id',$user_id)->with(['user_profile'])->first();
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
        
        //dd($this->arr_view_data);
        return view($this->module_view_folder.'.profile', $this->arr_view_data);                  
    }

    public function update_profile(Request $request)
    {
       // dd($request->all());
        
        $id = base64_decode($request->input('enc_id'));
        $arr_rules['first_name']        = "required";
        $arr_rules['last_name']         = "required";
        $arr_rules['email']             = "required";
        $arr_rules['mobile_no']         = "required";
        $arr_rules['qualification_id']  = "required";
        $arr_rules['passing_month']     = "required";
        $arr_rules['passing_year']      = "required";
        $arr_rules['marks_type']        = "required";
        $arr_rules['marks_input']       = "required";
       /* $arr_rules['category_id']       = "required";*/
        /*$arr_rules['city']              = "required";*/
      /*  $arr_rules['date']              = "required";
        $arr_rules['month']             = "required";
        $arr_rules['year']              = "required";*/
        //$arr_rules['gender']            = "required";

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
            Flash::error('User Already Exists.');
            return redirect()->back()->withInput($request->all());
        }    
        /* User Proof upload */
        $marks_input = $request->input('marks_input');
        if($request->input('marks_type')=='percentage')
        {
            if($marks_input<30 || $marks_input>100)
            {
                Flash::error('Percentage value must be between 30 to 100');
                return redirect()->back();
            }    
        }
        if($request->input('marks_type')=='cgpa')
        {
            if($marks_input<1 || $marks_input>10)
            {
                Flash::error('CGPA value must be between 1 to 10');
                return redirect()->back();
            }    
        } 

        $obj_data = $this->BaseModel->where('id','=',$id)->first(['id','profile_image']);
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();
        }
        //dd($arr_data);
        $file_name = $arr_data['profile_image'];


        if($request->hasFile('profile_image'))
        {

            $fileExtension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 


              $arr_file_types = ['jpg','jpeg','png','bmp'];

            if(in_array($fileExtension, $arr_file_types) )
            {
                
                if(isset($arr_data) && sizeof($arr_data)>0)
                {
                    if(File::exists($this->user_profile_base_img_path.$arr_data['profile_image']))
                    {
                        @unlink($this->user_profile_base_img_path.$arr_data['profile_image']);
                    }
                }
            
                $file_name      = "default.png";
                $file_name      = $request->input('profile_image');
                $file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
                $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $request->file('profile_image')->move($this->user_profile_base_img_path, $file_name);
            } 
            else 
            {
                Flash::error('Please upload valid image with jpg, jpeg ,png extension');
                return redirect()->back();
            }

        }

        $date = $request->input('date');
        $month = $request->input('month');
        $year = $request->input('year');
        $birth_date=date('Y-m-d',strtotime($year.'-'.$month.'-'.$date));
        //dd($request->input('birth_date'));
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
            $arr_user_data                   = [];
            $arr_user_data['first_name']    = $request->input('first_name');
            $arr_user_data['last_name']     = $request->input('last_name');
            $arr_user_data['email']         = $request->input('email');
            $arr_user_data['profile_image'] = $file_name;
            $arr_user_data['gender']        = $request->input('gender');
            $arr_user_data['mobile_code']     = $request->input('mobile_code');
            $arr_user_data['mobile_no']     = $request->input('mobile_no');
            /*$arr_user_data['birth_date']    = $birth_date;*/
            $user_data=$this->BaseModel->where('id',$id)->update($arr_user_data);

            $arr_data=[];
            $arr_data['qualification_id']      = $request->input('qualification_id');
            $arr_data['passing_month']         = $request->input('passing_month');
            $arr_data['passing_year']          = $request->input('passing_year');
            $arr_data['marks_type']            = $request->input('marks_type');
            $arr_data['marks']                 = $request->input('marks_input');
            $arr_data['specialization_id']     = $request->input('specialization_id');
            $arr_data['category_id']           = $request->input('category_id');
            $arr_data['current_work_location'] = $request->input('city');
            $arr_data['other_city']            = $other_city;
            $arr_data['other_state']            = $other_state;
            $arr_data['country_id']            = $country_id;
            $this->UserDetailModel->where('user_id',$id)->update($arr_data);

            /*Notification for  update profile --Sagar sahuji 8 dec */

                $notification_data = [];
                $notification_data['user_id'] = $id;
                $notification_data['message'] = 'Profile updated';
                $this->NotificationModel->create($notification_data);

                /*end notification */
            if($user_data)
            {    

                Flash::success('User profile updated successfully.');
            }
            else
            {
                Flash::error('Problem Occured While Updating Profile.');
            }   
            
            return redirect()->back();      
    }

    public function usercheck()
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
        return view('front.user.deactivate_account', $this->arr_view_data);  
    }

    public function deactivate_account(Request $request)
    {
        /*dd($request->all());*/
        if(! $user = Sentinel::check()) 
          {
            return redirect('user/login');
          }

          if(!$user->inRole('user')) 
          {
            return redirect('user/login'); 
          }
        $user_id                                 = $user->id;

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
                Sentinel::logout();
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
        if(! $user = Sentinel::check()) 
          {
            return redirect('user/login');
          }

          if(!$user->inRole('user')) 
          {
            return redirect('user/login'); 
          }
        $user_id                                 = $user->id;
        $arr_pagination       = array();
        $arr_notification       = array();

        $this->NotificationModel->where('user_id',$user_id)->update(['status'=>1]);
        $user_notification = $this->NotificationModel->where('user_id',$user_id)->orderBy('id','desc')->paginate(4);
        if($user_notification)
        {  $arr_pagination = clone $user_notification;
           $arr_notification = $user_notification->toArray(); 
        }
        /*dd($arr_notification);*/
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

    public function become_member()
    {
        if(! $user = Sentinel::check()) 
          {
            return redirect('user/login');
          }

          if(!$user->inRole('user')) 
          {
            return redirect('user/login'); 
          }
        $user_id                                 = $user->id;
        $member_id_does_exists = $this->MemberDetailModel->where('user_id',$user_id)->first();
        if($member_id_does_exists)
        {
            $member_id = $member_id_does_exists->id;
        }
        else
        {
            $member_detail_obj = $this->MemberDetailModel->create(['user_id'=>$user_id]);
            $member_id = $member_detail_obj->id;
        }
        Sentinel::logout();
        $member_id = base64_encode($member_id);
        Session::put('member_id',$member_id);
        Session::put('become_member','yes');
        return redirect('member/employment');     
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
      $this->arr_view_data['skill_name']             = $skill_name;
      $this->arr_view_data['module_title'] = "Change Password";
      return view($this->module_view_folder.'.change_password', $this->arr_view_data);
    } 
	public function buy_tickets()
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
      $this->arr_view_data['module_title'] = "Buy Tickets";
      return view($this->module_view_folder.'.buy_tickets', $this->arr_view_data);
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
            Flash::success('Password Changed Successfully.');
          }
          else
          {
            Flash::error('Problem Occurred, While Changing Password');
          }
        }
        else
        {
          Flash::error('Invalid Old Password.');
        }

        return redirect()->back();
    }

    /*Manage Alerts
      By Shankar
      4/1/2017 */

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
      //dd($arr_data);  
      $skill_name='';
      $this->arr_view_data['skill_name']             = $skill_name;
      $this->arr_view_data['arr_pagination']    = $arr_pagination;    
      $this->arr_view_data['arr_data']    = $arr_data;  
      $this->arr_view_data['arr_skill']    = $arr_skill; 
      $this->arr_view_data['module_title'] = 'My Alerts';
      //dd($this->arr_view_data);
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
       $this->arr_view_data['skill_name']             = $skill_name;  
       $this->arr_view_data['arr_data']    = $arr_data;  
       $this->arr_view_data['arr_skill']    = $arr_skill; 
       $this->arr_view_data['module_title'] = 'My Alerts';
       return view($this->module_view_folder.'.create_alert', $this->arr_view_data); 
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
        $arr_data['user_type']          = 'User';

        $result = $this->UserAlertsModel->create($arr_data);
        if($result)
        {
            Flash::success('User alerts added successfully.'); 
        }
        else
        {
            Flash::error('Error! While adding user alerts.'); 
        }
         return redirect()->back();
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

       $this->arr_view_data['arr_skill']             = $arr_skill;
       $this->arr_view_data['skill_name']             = $skill_name;
       $this->arr_view_data['arr_data']    = $arr_data;  
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
                            ->where('alert_id','<>',$id)
                            ->where('user_id','=',$this->user_id)
                            ->where('skill_id','=',$request->input('skill'))
                            ->where('exp_level','=',$request->input('experience'))
                            ->count();  
        //dd($does_exists);                      

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
        $arr_user_data['user_type']     = 'User';

        $user_data = $this->UserAlertsModel->where('alert_id',$id)->update($arr_user_data);
        if($user_data)
        {
            Flash::success('User alerts updated successfully.'); 
            return redirect(url('/user/manage_alert'));
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

    public function multi_action(Request $request)
    {
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

  /*  public function purchase_history()
    {
      $this->arr_view_data['module_title'] = 'Purchase History';
      
      return view($this->module_view_folder.'.purchase_history', $this->arr_view_data); 
    }
*/
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
        
       if(isset($arr_transaction['data']) && sizeof($arr_transaction['data'])>0)
       {
        foreach($arr_transaction['data'] as $key => $details) 
      	{	 
	         $arr_transaction['data'][$key]['interview_count'] = count($details['purchase_history']);
	         $arr_transaction['data'][$key]['interview_count_arr'] = count($details['purchase_history'][0]['interview_attachment']);
	         
	         $arr_transaction['data'][$key]['ticket_name'] = $details['purchase_history'][0]['ticket_name'];
      	}
      }
      	$arr_advertise=array();
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
        $this->arr_view_data['arr_transaction'] = $arr_transaction;
        $this->arr_view_data['module_title']    = 'Purchase History';
        $this->arr_view_data['arr_pagination']  = $arr_pagination;
        $this->arr_view_data['advertise_public_img_path'] = $this->advertise_public_img_path;

        
        if(\Request::segment(2)=='learn')
        {
            $this->arr_view_data['module_title']    = 'Learn';
            return view($this->module_view_folder.'.learn', $this->arr_view_data);    
        }
        return view($this->module_view_folder.'.purchase_history', $this->arr_view_data); 
   } 

   public function view_purchase($enc_id)
   {    
        $user_id = $this->user_id;
        $id = base64_decode($enc_id);
        //dd($user_id);
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
        $grand_total = $arr_transaction['grand_total'];
        $interview_count    = count($arr_transaction['purchase_history']);
        $interview_count_arr    = count($arr_transaction['purchase_history'][0]['interview_attachment']);
        $ticket_name        = $arr_transaction['purchase_history'][0]['ticket_name'];   

        //dd($ticket_name);
        $this->arr_view_data['member_referencebook_public_path'] = $this->member_referencebook_public_path;
        $this->arr_view_data['member_company_attachment_public_path'] = $this->member_company_attachment_public_path;
         $this->arr_view_data['member_realtime_attachment_public_path'] = $this->member_realtime_attachment_public_path;
        $this->arr_view_data['ticket_name']       = $ticket_name;  
        $this->arr_view_data['interview_count']   = $interview_count;
        $this->arr_view_data['interview_count_arr']   = $interview_count_arr;
        $this->arr_view_data['grand_total']  = $grand_total;
        
        $this->arr_view_data['arr_transaction']   = $arr_transaction;
        $this->arr_view_data['module_title']      = 'Purchase History Details';

        //dd($this->arr_view_data);
        return view($this->module_view_folder.'.view_purchase_details', $this->arr_view_data); 
   }

    public function multi_action_purchase(Request $request)
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
      
        if($learn_type == 'referencebook')
        {
           $this->arr_view_data['module_title']      = 'Reference Book'; 
           
           /*$this->arr_view_data['referencebook_path']=  $this->member_referencebook_folder_path; */
           return view($this->module_view_folder.'.view_learn_details', $this->arr_view_data); 
        }
        elseif($learn_type == 'company')
        {
            $this->arr_view_data['module_title']      = 'Companies';
            /*$this->arr_view_data['company_attachment_path']=  $this->member_company_attachment_folder_path;*/
            return view($this->module_view_folder.'.view_learn_company_details', $this->arr_view_data); 
        }
        elseif($learn_type == 'rwe_tickets')
        {
            $this->arr_view_data['module_title']      = 'Real Time Work Experience (Tickets, Tasks, Issues)';
			$this->arr_view_data['userid']      = $user_id; 
			$this->arr_view_data['id']      = $id; 
            /*$this->arr_view_data['realtime_attachment_path']=  $this->member_realtime_attachment_folder_path;*/
            return view($this->module_view_folder.'.view_learn_rwetickets_details', $this->arr_view_data); 
        }
    } 

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

}
