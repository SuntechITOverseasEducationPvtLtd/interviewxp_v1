<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;
use App\Models\CountryModel;
use App\Models\AccountSettingModel;
use App\Models\ManageEmailModel;

use Validator;
use Flash;
use Sentinel;
use Hash;
 
class AccountSettingsController extends Controller 
{

    public function __construct(UserModel $user,
                                ActivityLogsModel $activity_logs,
                                CountryModel $country,
                                AccountSettingModel $account_setting,
                                ManageEmailModel $manage_email
                                )
    {
        $this->UserModel           = $user;
        $this->BaseModel           = $this->UserModel;
        $this->ActivityLogsModel   = $activity_logs;
        $this->CountryModel        = $country;
        $this->AccountSettingModel = $account_setting;
        $this->ManageEmailModel    = $manage_email;

        $this->arr_view_data       = [];
        $this->admin_url_path      = url(config('app.project.admin_panel_slug'));
        $this->module_url_path     = $this->admin_url_path."/account_settings";

        $this->module_title       = "Account Settings";
        $this->module_view_folder = "admin.account_settings";
        $this->ip_address         = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;  
        $this->theme_color        = theme_color();
    }

    public function index()
    {

        $arr_account_settings = array();

        $arr_data  = [];
        $obj_data  = Sentinel::getUser();
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();    
        }

        if(isset($arr_data) && sizeof($arr_data)<=0)
        {
            return redirect($this->admin_url_path.'/login');
        }
        $arr_country=[];
        $obj_country = $this->CountryModel->get();
        if($obj_country)
        {
            $arr_country = $obj_country->toArray();
        }
        $user_id = $obj_data->id;
        $arr_account_detail=[];
        $obj_account_detail = $this->AccountSettingModel->where('user_id',$user_id)->first();
        if($obj_account_detail)
        {
            $arr_account_detail = $obj_account_detail->toArray();
        }
        
        $this->arr_view_data['arr_account_detail']        = $arr_account_detail;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['arr_country']     = $arr_country;
        $this->arr_view_data['page_title']      = str_plural($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->ip_address                       = $_SERVER['REMOTE_ADDR'];
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
 

    public function update(Request $request)
    {

        $arr_rules = array();
        //$form_data = $request->all();
        $obj_data   = Sentinel::getUser();
        $first_name = $obj_data->first_name;
        $last_name  = $obj_data->last_name;

        $arr_rules['first_name']     = "required";
        $arr_rules['last_name']      = "required";
        $arr_rules['email']          = "email|required";
        $arr_rules['country']        = "required";
        $arr_rules['street_address'] = "required";
        $arr_rules['city']           = "required";
        $arr_rules['state']          = "required";
        $arr_rules['mobile_no']      = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }
  
        
        if($this->UserModel->where('email',$request->input('email'))
                           ->where('id','!=',$obj_data->id)
                           ->count()==1)
        {
            Flash::error('This Email id already present in our system, please try another one');
            return redirect()->back();
        }
        

        $arr_data['first_name']   = $request->input('first_name');
        $arr_data['last_name']    = $request->input('last_name');
        $arr_data['email']        = $request->input('email');


        event(new ActivityLogEvent(['activity_msg'=>"Account Setting was Updated By '".$first_name." ".$last_name."'",'module_title'=>$this->module_title,'module_action'=>'Update','ip_address'=>$this->ip_address]));
        
        $obj_data = Sentinel::update($obj_data, $arr_data);
        $user_id = $obj_data->id;
        $account_setting_data = [];

        $account_setting_data['country_code'] = $request->input('country');
        $account_setting_data['street_address'] = $request->input('street_address');
        $account_setting_data['city'] = $request->input('city');
        $account_setting_data['state'] = $request->input('state');
        $account_setting_data['zipcode'] = $request->input('zipcode');
        $account_setting_data['lat'] = $request->input('lat');
        $account_setting_data['lon'] = $request->input('lon');
        $account_setting_data['mobile_no'] = $request->input('mobile_no');
        $account_setting_data['igst'] = $request->input('igst');
        $account_setting_data['cgst'] = $request->input('cgst');
        $account_setting_data['sgst'] = $request->input('sgst');
        $account_setting_data['tds'] = $request->input('tds');
        $account_setting_data['admin_commission'] = $request->input('admin_commission');
         $account_setting_data['activationfee'] = $request->input('activationfee');
        $account_setting_data['deactivate_company_tab'] = $request->input('deactivate_company_tab') ? 1 : '';
        $account_setting_data['is_enable_gst'] = $request->input('is_enable_gst') ? 1 : '';

        $account_settings = $this->AccountSettingModel->where('user_id',$user_id)->update($account_setting_data);
        if($obj_data)
        {
            Flash::success(str_singular($this->module_title).' Updated Successfully'); 
        }
        else
        {
            Flash::error('Problem Occurred, While Updating '.str_singular($this->module_title));  
        } 
      
        return redirect()->back();
    }

    function manage_email()
    {
        $arr_data  = [];
        $obj_data  = Sentinel::getUser();
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();    
        }
        if(isset($arr_data) && sizeof($arr_data)<=0)
        {
            return redirect($this->admin_url_path.'/login');
        }

        $arr_email=[];
        $obj_email = $this->ManageEmailModel->get();
        if($obj_email)
        {
            $arr_email = $obj_email->toArray();
        }

        $this->arr_view_data['arr_email']       = $arr_email;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = 'Manage Email';
        $this->arr_view_data['module_title']    = 'Manage Email';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.manage_email',$this->arr_view_data);
    }

    function update_manage_email(Request $request)
    {
        $arr_rules['general_email']     = "email|required";
        $arr_rules['opening_email']     = "email|required";
        $arr_rules['hr_mail']           = "email|required";
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {       
            return redirect()->back()->withErrors($validator)->withInput();  
        }
        $id = $request->input('enc_id');

        $email_manage_data['general_email'] = $request->input('general_email');
        $email_manage_data['opening_email'] = $request->input('opening_email');
        $email_manage_data['hr_mail'] = $request->input('hr_mail');

        $account_settings = $this->ManageEmailModel->where('id',$id)->update($email_manage_data);
        if($account_settings)
        {
            Flash::success('Emails Updated Successfully'); 
        }
        else
        {
            Flash::error('Problem Occurred, While Updating Emails');  
        } 
      
        return redirect()->back();
    }
}
