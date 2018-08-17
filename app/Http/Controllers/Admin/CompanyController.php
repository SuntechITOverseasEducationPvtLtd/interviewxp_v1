<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\StateModel;
use App\Models\CompanyModel;

use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;

use Validator;
use Session;
use Sentinel;
use Flash;

class CompanyController extends Controller
{
    public function __construct(UserModel $user,
    							CategoryModel $category,
                                SubCategoryModel $subcategory,
                                StateModel $state,
                                CompanyModel $company,
                                ActivityLogsModel $activity_logs)
    {
    	 $this->UserModel = $user;
    	 $this->CompanyModel = $company; 
         //$this->BaseModel =  $this->CategoryModel;
         $this->BaseModel =  $this->CompanyModel;
         $this->SubCategoryModel = $subcategory;
         $this->StateModel = $state;
         $this->ActivityLogsModel     = $activity_logs;
        
        $this->arr_view_data        = [];
        $this->admin_url_path       = url(config('app.project.admin_panel_slug'));
        $this->module_url_path      = $this->admin_url_path."/company";
        $this->module_view_folder   = "admin.company";

        $this->module_title = "Company";
        /*For Activity log*/
        $this->obj_data    = Sentinel::getUser();
        $this->first_name  = isset($this->obj_data->first_name)?$this->obj_data->first_name:'--';
        $this->last_name  = isset($this->obj_data->last_name)?$this->obj_data->last_name:'--';
        $this->ip_address         = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;  
        $this->theme_color  = theme_color();
    }
    public function index()
    {
        $arr_company = [];
        $obj_company = $this->BaseModel->get();
        {
            $arr_company = $obj_company->toArray();
        }
        
        $this->arr_view_data['arr_data']        = $arr_company;
        $this->arr_view_data['page_title']      = "Manage ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.index', $this->arr_view_data);
    }


    public function create()
    {
        $this->arr_view_data['page_title']      = "Create ".str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.create', $this->arr_view_data);
    }

    public function store(Request $request)
    {
        $arr_rules['company_name']         = "required";
        $arr_rules['company_location']         = "required";
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $does_com_exits = $this->BaseModel
                               ->where('company_name','=',$request->input('company_name'))                          
                               ->where('company_location','=',$request->input('company_location'))
                               ->count();
                               
         if($does_com_exits)
         {
            Flash::error(str_singular($this->module_title).' And Location Already Exists!!!');
            return redirect()->back()->withInput($request->all());
         }   

        $arr_user_data                  = [];
        $arr_user_data['company_name'] = $request->input('company_name');
        $arr_user_data['company_location'] = $request->input('company_location');
        $arr_user_data['is_active']     = 1;
        //dd($arr_user_data['company_location']);

        $create                         = $this->BaseModel->create($arr_user_data);

        if($create)
        {
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Created By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Create','ip_address'=>$this->ip_address]));
           Flash::success(str_singular($this->module_title).' Added Succesfully!!!'); 
        }
        else
        {
            Flash::error('Error Occured While Inserting'.str_singular($this->module_title).' !!!');    
        }
        return redirect()->back();
    }
    public function edit($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_company = [];
        $obj_company = $this->BaseModel->where('company_id',$id)->first();
        if($obj_company)
        {
            $arr_company = $obj_company->toArray();
        }
        
       $this->arr_view_data['page_title']      = "Edit ".str_singular($this->module_title);
       $this->arr_view_data['arr_data']        = $arr_company;
       $this->arr_view_data['module_title']    = str_plural($this->module_title);
       $this->arr_view_data['module_url_path'] = $this->module_url_path;
       $this->arr_view_data['theme_color']     = $this->theme_color;
       $this->arr_view_data['enc_id']          = base64_encode($id);

        return view($this->module_view_folder.'.edit', $this->arr_view_data); 
    }

    public function update(Request $request)
    {
        $arr_rules['company_name']         = "required";
        $arr_rules['company_location']         = "required";
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {   
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $id = base64_decode($request->input('enc_id'));

        $does_com_exits = $this->BaseModel
                               ->where('company_id','<>',$id)    
                               ->where('company_name','=',$request->input('company_name'))                          
                               ->where('company_location','=',$request->input('company_location'))
                               ->count();
                               
         if($does_com_exits)
         {
            Flash::error(str_singular($this->module_title).' And Location Already Exists!!!');
            return redirect()->back()->withInput($request->all());
         }                   
       /* if($does_exists)
        {
            Flash::error(str_singular($this->module_title).' Already Exists!!!');
            return redirect()->back()->withInput($request->all());
        }*/
        
        $arr_user_data                  = [];
        $arr_user_data['company_name'] = $request->input('company_name');
        $arr_user_data['company_location'] = $request->input('company_location');
        $update                         = $this->BaseModel->where('company_id',$id)
                                                          ->update($arr_user_data);

        if($update)
        {
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Updated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Update','ip_address'=>$this->ip_address]));
            //$this->BaseModel->where('company_id',$id)->update(['is_active'=>1]);
           Flash::success(str_singular($this->module_title).' Updated Successfully!!!'); 
        }
        else
        {
            Flash::error('Error Occured While Updating'.str_singular($this->module_title).' !!!');    
        }
        return redirect()->back();   
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
        $entity = $this->BaseModel->where('company_id',$id)->first();
        

        if($entity)
        {
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Activated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Activate','ip_address'=>$this->ip_address]));
            return $this->BaseModel->where('company_id',$id)->update(['is_active'=>1]);
        }

        return FALSE;
    }

    public function perform_deactivate($id)
    {
        $entity = $this->BaseModel->where('company_id',$id)->first();
        
        if($entity)
        {
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deactivated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Deactivate','ip_address'=>$this->ip_address]));
            return $this->BaseModel->where('company_id',$id)->update(['is_active'=>0]);
        }
        return FALSE;
    }

    

    public function perform_delete($id)
    {
       $delete_success = $this->BaseModel->where('company_id',$id)->delete();
       event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deleted By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Delete','ip_address'=>$this->ip_address]));

       return $delete_success;    
    } 
}
