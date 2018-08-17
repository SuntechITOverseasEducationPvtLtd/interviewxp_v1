<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserroleModel;
use App\Models\UserrolecategoryModel;
use App\Models\UserrolenameModel;
use App\Models\UserroleassignModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;


use Validator;
use Session;
use Sentinel;
use Flash;

class UserroleController extends Controller
{
    public function __construct(UserroleModel $user, UserrolecategoryModel $userrolec, UserroleassignModel $userrossign, UserrolenameModel $userrolen,
                                ActivityLogsModel $activity_logs) 
    {
        $this->UserroleModel = $user;
        $this->UserrolecategoryModel = $userrolec;
        $this->UserrolenameModel = $userrolen;
        $this->UserroleassignModel = $userrossign;
        $this->ActivityLogsModel     = $activity_logs;
        
        $this->arr_view_data        = [];
        $this->admin_url_path       = url(config('app.project.admin_panel_slug'));
        $this->module_url_path      = $this->admin_url_path."/users_roles";
        $this->module_view_folder   = "admin.users_roles";

        $this->module_title = "Users Role";
        /*For Activity log*/
        $this->obj_data    = Sentinel::getUser();
        $this->first_name  = isset($this->obj_data->first_name)?$this->obj_data->first_name:'--';
        $this->last_name  = isset($this->obj_data->last_name)?$this->obj_data->last_name:'--';
        $this->ip_address         = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;  
        $this->theme_color  = theme_color();
    }

    public function index()
    {
        $arr_users = array();
       $obj_user = $this->UserroleModel->orderBy('id', 'DESC')->get();
        {
            $arr_users = $obj_user->toArray();
        }

        $this->arr_view_data['is_last_user']    = 1;
        $this->arr_view_data['obj_users']       = $arr_users;
        $this->arr_view_data['page_title']      = "Manage ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.index',$this->arr_view_data);

    }

    public function create()
    {
         $arr_roles = array();
        $obj_role =$this->UserrolecategoryModel->orderBy('id', 'ASC')->get();

        if( $obj_role != FALSE)
        {
            $arr_roles = $obj_role->toArray();
        }

        $this->arr_view_data['arr_roles']       = $arr_roles;
        $this->arr_view_data['page_title']      = "Create ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.create',$this->arr_view_data);
    }

    public function store(Request $request)
    {

    	$arr_rules = [];

        $arr_rules['rolename'] = "required";
       

    	$validator = Validator::make($request->all(),$arr_rules);
    	
    	if($validator->fails())
    	{
    		return redirect()->back()->withErrors($validator)->withInput($request->all());
    	}

    	/* Duplication Check */
    	
    	 $is_duplicate =$this->UserroleModel->where('rolename',$request->input('rolename'))->count();
    	 
    	 
    	 

    	if($is_duplicate>0)
    	{
    		Flash::error(str_singular($this->module_title).' Already Exists.');
    		return redirect()->back()->withInput($request->all());
    	}

        $arr_data               = [];
        $arr_data['rolename'] = $request->input('rolename');
        $arr_data['rolecount'] = 1;
        $arr_data['status'] =1;
    
    	
    $user = $this->UserroleModel->create($arr_data);
    
    
 $roleselect=$request->input('roleselect');
 if(sizeof($roleselect)>0) {
    foreach($roleselect as $roleselectF)
    {
        
       $idroleselectF=explode("-",$roleselectF);
       
       
       
        $arr_datas               = [];
        $arr_datas['roleid'] = $user->id;
        $arr_datas['roeassignid'] =$idroleselectF[1];
        $arr_datas['rolecategoryid'] =$idroleselectF[0];
        $arr_datas['status'] =1;
    
    	
    $userroles = $this->UserroleassignModel->create($arr_datas);
    
    
        
    }
   
    
    }
    
    
    	if($user)
    	{
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Created By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Create','ip_address'=>$this->ip_address]));
    		Flash::success(str_singular($this->module_title).' Created Successfully');
    	}
    	else
    	{
    		Flash::error('Problem Occurred, While Creating '.str_singular($this->module_title));
    	}

    	return redirect()->back();
    	
    	
    	
    
    
    }
    
    
    
    
    

    public function edit($enc_id)
    {
     $id = base64_decode($enc_id);
        
        $obj_user = $this->UserroleModel->where('id',$id)->first();
        if($obj_user)
        {
            $arr_data = $obj_user->toArray();
        }
        
        
        $arr_roles = array();
        $obj_role =$this->UserrolecategoryModel->orderBy('id', 'ASC')->get();

        if( $obj_role != FALSE)
        {
            $arr_roles = $obj_role->toArray();
        }

        $this->arr_view_data['arr_roles']       = $arr_roles;
        
        
        
        $this->arr_view_data['edit_mode']          = TRUE;
        $this->arr_view_data['enc_id']             = $enc_id;
       // $this->arr_view_data['arr_assigned_roles'] = $arr_assigned_roles;
       // $this->arr_view_data['arr_roles']          = $arr_roles;
        $this->arr_view_data['arr_data']           = $arr_data;
        $this->arr_view_data['page_title']         = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['module_title']       = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']    = $this->module_url_path;
        $this->arr_view_data['theme_color']        = $this->theme_color;

        return view($this->module_view_folder.'.edit', $this->arr_view_data);    

    }


 public function view($enc_id)
    {
     $id = base64_decode($enc_id);
        
        $obj_user = $this->UserroleModel->where('id',$id)->first();
        if($obj_user)
        {
            $arr_data = $obj_user->toArray();
        }
        
        
        $arr_roles = array();
        $obj_role =$this->UserrolecategoryModel->orderBy('id', 'ASC')->get();

        if( $obj_role != FALSE)
        {
            $arr_roles = $obj_role->toArray();
        }

        $this->arr_view_data['arr_roles']       = $arr_roles;
        
        
        
        $this->arr_view_data['edit_mode']          = TRUE;
        $this->arr_view_data['enc_id']             = $enc_id;
       // $this->arr_view_data['arr_assigned_roles'] = $arr_assigned_roles;
       // $this->arr_view_data['arr_roles']          = $arr_roles;
        $this->arr_view_data['arr_data']           = $arr_data;
        $this->arr_view_data['page_title']         = "View ".str_singular($this->module_title);
        $this->arr_view_data['module_title']       = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']    = $this->module_url_path;
        $this->arr_view_data['theme_color']        = $this->theme_color;

        return view($this->module_view_folder.'.view', $this->arr_view_data);    

    }
    
    
    public function update(Request $request,$enc_id)
    {	
    	$id = base64_decode($enc_id);
    	
    $arr_rules = [];

        $arr_rules['rolename'] = "required";
       

    	$validator = Validator::make($request->all(),$arr_rules);
    	
    	if($validator->fails())
    	{
    		return redirect()->back()->withErrors($validator)->withInput($request->all());
    	}

    

        $arr_data               = [];
        $arr_data['rolename'] = $request->input('rolename');
  
   
    	
    	
        $user   =$this->UserroleModel->where('id',$id)
                                          ->update($arr_data);

    
    
     $delete_success = $this->UserroleassignModel->where('roleid',$id)->delete();
    
    
 $roleselect=$request->input('roleselect');
 if(sizeof($roleselect)>0) {
    foreach($roleselect as $roleselectF)
    {
        
       $idroleselectF=explode("-",$roleselectF);
       
       
       
        $arr_datas               = [];
        $arr_datas['roleid'] = $id;
        $arr_datas['roeassignid'] =$idroleselectF[1];
        $arr_datas['rolecategoryid'] =$idroleselectF[0];
        $arr_datas['status'] =1;
    
    	
    $userroles = $this->UserroleassignModel->create($arr_datas);
    
    
        
    }
   
    
    }
    
    
    	if($user)
    	{
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Updated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Create','ip_address'=>$this->ip_address]));
    		Flash::success(str_singular($this->module_title).' Updated Successfully');
    	}
    	else
    	{
    		Flash::error('Problem Occurred, While Creating '.str_singular($this->module_title));
    	}

    	return redirect()->back();
    	
    	
    	
    }
    
    public function delete($enc_id)
    {
    	$id = base64_decode($enc_id);

    	if($this->perform_delete($id))
    	{
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deleted By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Delete','ip_address'=>$this->ip_address]));
	    	Flash::success(str_singular($this->module_title).' Deleted Successfully');
    	}
    	else
    	{
    		Flash::error('Problem Occured While '.str_singular($this->module_title).' Deletion ');
    	}

    	return redirect()->back();
    }

    public function perform_delete($id)
    {
      
            $delete_success = $this->UserroleModel->where('id',$id)->delete();
            return $delete_success;
  
      
         return FALSE;
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
    
    
    
    
    
    
    
    
    
    
    
     public function perform_activate($id)
    {
       
       
            
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Activated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Activate','ip_address'=>$this->ip_address]));
            return $this->UserroleModel->where('id',$id)->update(['status'=>1]);
       
        return FALSE;
    }

    public function perform_deactivate($id)
    {

       
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deactivated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Deactivate','ip_address'=>$this->ip_address]));
            return $this->UserroleModel->where('id',$id)->update(['status'=>0]);
       
    }

}
