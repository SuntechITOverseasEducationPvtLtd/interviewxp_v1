<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;
use App\Models\EmailTemplateModel; 
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;

use Validator;
use Flash;
Use Sentinel;
 
class EmailTemplateController extends Controller
{
    use MultiActionTrait;
    
    public $EmailTemplateModel; 
    
    public function __construct(EmailTemplateModel $email_template,
                                ActivityLogsModel $activity_logs)
    {      
       $this->EmailTemplateModel   = $email_template;
       $this->BaseModel         = $this->EmailTemplateModel;
       
       $this->ActivityLogsModel = $activity_logs;
       $this->module_title      = "Email Template";
       $this->module_url_slug   = "email_template";
       $this->module_url_path   = url(config('app.project.admin_panel_slug')."/email_template");
       /*For activity log*/
        $this->obj_data    = Sentinel::getUser();
        $this->first_name  = isset($this->obj_data->first_name)?$this->obj_data->first_name:'--';
        $this->last_name  = isset($this->obj_data->last_name)?$this->obj_data->last_name:'--';
        $this->ip_address         = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;  
        $this->theme_color       = theme_color();
    }
    
    public function index()
    {
        $obj_email_template = $this->BaseModel->get();

        if($obj_email_template != FALSE)
        {
            $arr_email_template = $obj_email_template->toArray();
        }

        $this->arr_view_data['arr_email_template'] = $arr_email_template;

        $this->arr_view_data['page_title']      = "Manage Email Template";
        $this->arr_view_data['module_title']    = "Email Template";
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

       return view('admin.email_template.index',$this->arr_view_data);
    }




    public function create()
    {
        $this->arr_view_data['page_title']      = "Create Email Template";
        $this->arr_view_data['module_title']    = "Email Template";
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view('admin.email_template.create',$this->arr_view_data);
    }


    public function store(Request $request)
    {
        $arr_rules['template_category']     = "required";  
        $arr_rules['subject']   = "required"; 
       
        $arr_rules['mailbody']      = "required";  

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data                 = array();
      
        $arr_data['is_active']    = 1;
        $arr_data['mailcategory']   = $request->input('template_category');
        $arr_data['subject'] = $request->input('subject');
 
        $arr_data['bodytext']    = $request->input('mailbody');

        $static_page    = $this->BaseModel->create($arr_data);
        if($static_page)
        {
            event(new ActivityLogEvent(['activity_msg'=>'Email Template Created By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Create','ip_address'=>$this->ip_address]));

            Flash::success($this->module_title .' Created Successfully');
        }  
        else
        {
            Flash::success('Problem Occurred, While Creating '.$this->module_title);
        }

        return redirect()->back();
    }

    public function edit($enc_id)
    {
        $id = base64_decode($enc_id);
        $this->arr_view_data['enc_id']    = $enc_id;
        $obj_page = $this->BaseModel->where('id',$id)->first();
        if($obj_page)
        {
            $arr_data = $obj_page->toArray();
        }
        
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Edit Email Template";
        $this->arr_view_data['module_title']    = "Email Template";
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['enc_id']          = base64_encode($id);
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view('admin.email_template.edit',$this->arr_view_data);  

    }


    public function details($enc_id)
    {
        $id = base64_decode($enc_id);
        $this->arr_view_data['enc_id']    = $enc_id;
        $obj_page = $this->BaseModel->where('id',$id)->first();
        if($obj_page)
        {
            $arr_data = $obj_page->toArray();
        }
        
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "View Email Template";
        $this->arr_view_data['module_title']    = "Email Template";
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['enc_id']          = base64_encode($id);
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view('admin.email_template.details',$this->arr_view_data);  

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



public function perform_activate($id)
    {
        $entity = $this->BaseModel->where('id',$id)->first();
        
        if($entity)
        {
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Activated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Activate','ip_address'=>$this->ip_address]));
            return $this->BaseModel->where('id',$id)->update(['is_active'=>1]);
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
       $delete_success = $this->BaseModel->where('id',$id)->delete();
       event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deleted By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Delete','ip_address'=>$this->ip_address]));

       return $delete_success;    
    } 
    
    public function update(Request $request)
    {
        $id = base64_decode($request->input('enc_id'));
        $arr_rules = array();

       $arr_rules['template_category']     = "required";  
        $arr_rules['subject']   = "required"; 
       
        $arr_rules['mailbody']      = "required";  

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data                 = array();
        
        $arr_data['mailcategory']   = $request->input('template_category');
        $arr_data['subject'] = $request->input('subject');
 
        $arr_data['bodytext']    = $request->input('mailbody');

        $static_page    = $this->BaseModel->where('id',$id)
                                          ->update($arr_data);
        if($static_page)
        {
            event(new ActivityLogEvent(['activity_msg'=>'Email Template Updated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Update','ip_address'=>$this->ip_address]));

            Flash::success($this->module_title .' Updated Successfully');
        }  
        else
        {
            Flash::success('Problem Occurred, While Updating '.$this->module_title);
        }

        return redirect()->back();
            
    }
    
    


}