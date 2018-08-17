<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CareerModel;
use App\Models\CareerpostModel;
use App\Common\Traits\MultiActionTrait;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;

use Validator;
use Session;
use Sentinel;
use Flash;

class CareerController extends Controller
{
    public function __construct(CareerModel $career_model, CareerpostModel $careerpost_model, ActivityLogsModel $activity_logs)
    {
    	
        $this->BaseModel           = $career_model;
        $this->BasepostModel           = $careerpost_model;
        $this->ActivityLogsModel   = $activity_logs;
        
        $this->career_resume_path    = public_path().config('app.project.img_path.career_resume');
        $this->arr_view_data        = [];
        $this->admin_url_path       = url(config('app.project.admin_panel_slug'));
        $this->module_url_path      = $this->admin_url_path."/career";
        $this->module_view_folder   = "admin.career";

        $this->module_title = "Career";
        /*For Activity log*/
        $this->obj_data    = Sentinel::getUser();
        $this->first_name  = isset($this->obj_data->first_name)?$this->obj_data->first_name:'--';
        $this->last_name   = isset($this->obj_data->last_name)?$this->obj_data->last_name:'--';
        $this->ip_address  = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;  
        $this->theme_color = theme_color();
    }
    
    
     public function home()
    {
        $id = 'all';
        $arr_career = [];
        
        
        if($id=='all')
        {
        $obj_career = $this->BasepostModel->orderBy('id', 'DESC')->get();
        {
            $arr_career = $obj_career->toArray();
        } } else {
            
           $obj_career = $this->BasepostModel->where('status',$id)->orderBy('id', 'DESC')->get();
        {
            $arr_career = $obj_career->toArray();
        }  
            
        }
        
        //dd($arr_career);
        $this->arr_view_data['arr_data']            = $arr_career;
        $this->arr_view_data['page_title']          = "Manage ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']        = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['theme_color']         = $this->theme_color;
        $this->arr_view_data['career_resume_path']  = $this->career_resume_path;

        return view($this->module_view_folder.'.index', $this->arr_view_data);
    }
    
    
    public function index($enc_id)
    {
        if(!isset($enc_id)) { $id = 'all';} else { $id = ($enc_id);}
        $arr_career = [];
        
        
        if($id=='all')
        {
        $obj_career = $this->BasepostModel->orderBy('id', 'DESC')->get();
        {
            $arr_career = $obj_career->toArray();
        } } else {
            
           $obj_career = $this->BasepostModel->where('status',$id)->orderBy('id', 'DESC')->get();
        {
            $arr_career = $obj_career->toArray();
        }  
            
        }
        
        //dd($arr_career);
        $this->arr_view_data['arr_data']            = $arr_career;
        $this->arr_view_data['page_title']          = "Manage ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']        = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['theme_color']         = $this->theme_color;
        $this->arr_view_data['career_resume_path']  = $this->career_resume_path;

        return view($this->module_view_folder.'.index', $this->arr_view_data);
    }

    public function view($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_career = [];
        $obj_career = $this->BaseModel->where('id',$id)->first();
        {
            $arr_career = $obj_career->toArray();
        }

        $this->arr_view_data['arr_data']            = $arr_career;
        $this->arr_view_data['page_title']          = "View ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']        = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['theme_color']         = $this->theme_color;
        $this->arr_view_data['career_resume_path']  = $this->career_resume_path;

        return view($this->module_view_folder.'.view', $this->arr_view_data);
    }
    
    
        public function application($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_career = [];
     
          $obj_career = $this->BaseModel->where('postid',$id)->get();
        {
            $arr_career = $obj_career->toArray();
        }
        
        //dd($arr_career);
        $this->arr_view_data['arr_data']            = $arr_career;
         $this->arr_view_data['arr_dataid']         = $id;
        $this->arr_view_data['page_title']          = "Manage ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']        = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['theme_color']         = $this->theme_color;
        $this->arr_view_data['career_resume_path']  = $this->career_resume_path;

        return view($this->module_view_folder.'.application', $this->arr_view_data);
        
        
        
    }
    
    
    
    
    
     public function careerpost($enc_id)
    {
        $this->arr_view_data['page_title']      = "Create ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;


        return view($this->module_view_folder.'.cpost', $this->arr_view_data);
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

     
        public function deletepost($enc_id = FALSE)
    {

        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->performpost_delete(base64_decode($enc_id)))
        {   
            Flash::success(str_singular($this->module_title).' Deleted Successfully!!!');
        }
        else
        {
            Flash::error('Problem Occured While '.str_singular($this->module_title).' Deletion!!! ');
        }

        return redirect()->back();
    }

     
     
        public function live($enc_id = FALSE)
    {

        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->performpost_live(base64_decode($enc_id)))
        {   
            Flash::success(str_singular($this->module_title).' Made live Successfully!!!');
        }
        else
        {
            Flash::error('Problem Occured While '.str_singular($this->module_title).'Made Live!!! ');
        }

        return redirect()->back();
    }

     
         public function off($enc_id = FALSE)
    {

        if(!$enc_id)
        {
            return redirect()->back();
        }

        if($this->performpost_off(base64_decode($enc_id)))
        {   
            Flash::success(str_singular($this->module_title).' Made off Successfully!!!');
        }
        else
        {
            Flash::error('Problem Occured While '.str_singular($this->module_title).'Made off!!! ');
        }

        return redirect()->back();
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
    
    
        public function performpost_delete($id)
    {
       $delete_success = $this->BasepostModel->where('id',$id)->delete();
       event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deleted By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Delete','ip_address'=>$this->ip_address]));

       return $delete_success;    
    } 
    
    
            public function performpost_live($id)
    {
        $arr_data['status']    = '3';
       $delete_success = $this->BasepostModel->where('id',$id)->update($arr_data);
       event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Made Live By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Live','ip_address'=>$this->ip_address]));

       return $delete_success;    
    } 
    
          public function performpost_off($id)
    {
        $arr_data['status']    = '2';
       $delete_success = $this->BasepostModel->where('id',$id)->update($arr_data);
       event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Made Off By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Off','ip_address'=>$this->ip_address]));

       return $delete_success;    
    } 
    
      public function edit($enc_id)
    {
        $id = base64_decode($enc_id);
        $this->arr_view_data['enc_id']    = $enc_id;
        $obj_page = $this->BasepostModel->where('id',$id)->first();
        if($obj_page)
        {
            $arr_data = $obj_page->toArray();
        }
        
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = "Edit Job Post";
        $this->arr_view_data['module_title']    = "JOB POST";
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['enc_id']          = base64_encode($id);
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.edit', $this->arr_view_data); 

    }


     public function store(Request $request)
    {
        $arr_rules['job_name']     = "required";  
        $arr_rules['experience_name']   = "required"; 
        $arr_rules['jobtype']      = "required";  
        $arr_rules['job_opening']      = "required";
        $arr_rules['annual_salary']      = "required";
        $arr_rules['email']      = "required";
        $arr_rules['phone']      = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data                 = array();
        $arr_data['jobtitle']    = ($request->input('job_name'));
        $arr_data['status']    = $request->input('savevalue');
        $arr_data['experience']   = $request->input('experience_name');
        $arr_data['type'] = $request->input('jobtype');
        $arr_data['opening']    = $request->input('job_opening');
        $arr_data['anualsalary']    = $request->input('annual_salary');
        $arr_data['jobdescription']    = $request->input('page_desc');
        $arr_data['email']    = $request->input('email');
        $arr_data['phone']    = $request->input('phone');

        $static_page    = $this->BasepostModel->create($arr_data);
        if($static_page)
        {
            event(new ActivityLogEvent(['activity_msg'=>'Career Post Created By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'careerpost','ip_address'=>$this->ip_address]));

            Flash::success($this->module_title .' Created Successfully');
        }  
        else
        {
            Flash::success('Problem Occurred, While Creating '.$this->module_title);
        }

        return redirect()->back();
        
        
    }




    
        public function update(Request $request)
    {
        $id = base64_decode($request->input('enc_id'));
        $arr_rules['job_name']     = "required";  
        $arr_rules['experience_name']   = "required"; 
        $arr_rules['jobtype']      = "required";  
        $arr_rules['job_opening']      = "required";
        $arr_rules['annual_salary']      = "required";
        $arr_rules['email']      = "required";
        $arr_rules['phone']      = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data                 = array();
        $arr_data['jobtitle']    = ($request->input('job_name'));
        $arr_data['experience']   = $request->input('experience_name');
        $arr_data['type'] = $request->input('jobtype');
        $arr_data['opening']    = $request->input('job_opening');
        $arr_data['anualsalary']    = $request->input('annual_salary');
        $arr_data['jobdescription']    = $request->input('page_desc');
        $arr_data['email']    = $request->input('email');
        $arr_data['phone']    = $request->input('phone');

        $carrer_page    =$this->BasepostModel->where('id',$id)
                                          ->update($arr_data);
        if($carrer_page)
        {
            event(new ActivityLogEvent(['activity_msg'=>'Career Post Edited By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'careerpost','ip_address'=>$this->ip_address]));

            Flash::success($this->module_title .' Edited Successfully');
        }  
        else
        {
            Flash::success('Problem Occurred, While Editing '.$this->module_title);
        }

        return redirect()->back();
        
        
    }




}
