<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\UserroleModel;
use App\Models\UserrolecategoryModel;
use App\Models\UserrolenameModel;
use App\Models\UserroleassignlModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;



use Validator;
use Session;
use Sentinel;
use Flash;

class AdminUserController extends Controller
{
    public function __construct(UserModel $user, UserroleModel $users,  UserroleassignlModel $userrossign,
                                ActivityLogsModel $activity_logs) 
    {
        $this->UserModel = $user;
               $this->UserroleModel = $users;
        $this->UserroleassignlModel = $userrossign;
        $this->ActivityLogsModel     = $activity_logs;
        
        $this->arr_view_data        = [];
        $this->admin_url_path       = url(config('app.project.admin_panel_slug'));
        $this->module_url_path      = $this->admin_url_path."/admin_users";
        $this->module_view_folder   = "admin.admin_users";

        $this->module_title = "Admin Users";
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
        $obj_users = Sentinel::createModel()->whereHas('roles',function($query)
            {
               return $query->whereIn('slug',['admin']);
            })->get();
        
        
        $is_last_user = count($obj_users)==1?true:false;

        $this->arr_view_data['is_last_user']    = $is_last_user;
        $this->arr_view_data['obj_users']       = $obj_users;
        $this->arr_view_data['page_title']      = "Manage ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.index',$this->arr_view_data);

    }

    public function create()
    {
        $obj_role = Sentinel::getRoleRepository()->createModel()->whereIn('slug',['admin']);
        $obj_role = $obj_role->orderBy('id','desc')->get(); 

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

        $arr_rules['first_name'] = "required";
        $arr_rules['last_name']  = "required";
        $arr_rules['email']      = "required";
        $arr_rules['password']   = "required|confirmed";

    	$validator = Validator::make($request->all(),$arr_rules);
    	
    	if($validator->fails())
    	{
    		return redirect()->back()->withErrors($validator)->withInput($request->all());
    	}

    	/* Duplication Check */
    	$is_duplicate = Sentinel::createModel()->where('email',$request->input('email'))
                                               ->count();

    	if($is_duplicate>0)
    	{
    		Flash::error(str_singular($this->module_title).' Already Exists.');
    		return redirect()->back()->withInput($request->all());
    	}


        $arr_data               = [];
        $arr_data['first_name'] = $request->input('first_name');
        $arr_data['last_name']  = $request->input('last_name');
        $arr_data['email']      = $request->input('email');
        $arr_data['password']   = $request->input('password');
    	
    	$user = Sentinel::registerAndActivate($arr_data);
    	
    
    	
    	/*
    	if(sizeof($arr_roles)>0)
    	{
    		foreach ($arr_roles as $key => $id) 
    		{
    			$role = Sentinel::findRoleById($id);
    			$role->users()->attach($user);
    		}
    	}
    	*/
    	
    	
  
    	
    	 $arr_datas['user_id']    =$user->id;
        $arr_datas['role_id']    =1;
        $arr_datas['roles_id']    =  $request->input('roles');

        $static_pages    = $this->UserroleassignlModel->create($arr_datas);
        
        
    	
    	
    	
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

    	$obj_user = Sentinel::findById($id);
    	$obj_role = Sentinel::getRoleRepository()->createModel();
       	$obj_role = $obj_role->orderBy('id','desc')->get();	

        if( $obj_role != FALSE)
        {
            $arr_roles = $obj_role->toArray();
        }

    	$arr_user = [];
    	if($obj_user)
    	{
    		$arr_tmp = $obj_user->roles->toArray();
    		$arr_assigned_roles = array_column($arr_tmp,'id');
    	}

        $this->arr_view_data['edit_mode']          = TRUE;
        $this->arr_view_data['enc_id']             = $enc_id;
        $this->arr_view_data['arr_assigned_roles'] = $arr_assigned_roles;
        $this->arr_view_data['arr_roles']          = $arr_roles;
        $this->arr_view_data['obj_user']           = $obj_user;
        $this->arr_view_data['page_title']         = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['module_title']       = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']    = $this->module_url_path;
        $this->arr_view_data['theme_color']        = $this->theme_color;

        return view($this->module_view_folder.'.edit', $this->arr_view_data);    

    }

    public function update(Request $request,$enc_id)
    {	
    	$id = base64_decode($enc_id);
    	
    	$arr_rules = [];
    	$arr_rules['first_name'] = "required";
    	$arr_rules['last_name'] = "required";
    	$arr_rules['email'] = "required";
    	

    	$validator = Validator::make($request->all(),$arr_rules);
    	if($validator->fails())
    	{
    		return redirect()->back()->withErrors($validator)->withInput($request->all());
    	}

    	/* Duplication Check */
    	$is_duplicate = Sentinel::createModel()
    						    ->where('email',$request->input('email'))
    						    ->where('id',"<>",$id)
    						    ->count();

    	if($is_duplicate>0)
    	{
    		Flash::error(str_singular($this->module_title).' Already Exists.');
    		return redirect()->back()->withInput($request->all());
    	}


    	$obj_user = Sentinel::findById($id);

    	$arr_data['first_name'] = $request->input('first_name');
    	$arr_data['last_name']  = $request->input('last_name');
    	$arr_data['email']      = $request->input('email');
    	

    	if($request->has('password'))
    	{
    		$arr_data['password']      = $request->input('password');	
    	}

    	$obj_user = Sentinel::update($obj_user, $arr_data);

    	$arr_roles = $request->input('roles');
    	
    	if(sizeof($arr_roles)>0)
    	{
    		foreach ($arr_roles as $key => $id) 
    		{
    			$role = Sentinel::findRoleById($id);

    			if(!$obj_user->inRole($role))
    			{
    				$role->users()->attach($obj_user);	
    			}
    		}
    	}

    	if($obj_user)
    	{
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Updated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Update','ip_address'=>$this->ip_address]));
    		Flash::success(str_singular($this->module_title).' Updated Successfully');
    	}
    	else
    	{
            Flash::error('Problem Occured While Updating '.str_singular($this->module_title));
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
        $entity = $this->UserModel->where('id',$id)->first();
        
        if($entity)
        {
            $obj_user   = Sentinel::findById($id);
            $role_admin = Sentinel::findRoleBySlug('admin');
            $obj_user->roles()->detach($role_admin);

            $delete_success = $this->UserModel->where('id',$id)->delete();
            return $delete_success;
  
        }
         return FALSE;
    }
}
