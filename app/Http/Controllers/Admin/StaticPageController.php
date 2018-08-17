<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;
use App\Models\StaticPageModel; 
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;

use Validator;
use Flash;
Use Sentinel;
 
class StaticPageController extends Controller
{
    use MultiActionTrait;
    
    public $StaticPageModel; 
    
    public function __construct(StaticPageModel $static_page,
                                ActivityLogsModel $activity_logs)
    {      
       $this->StaticPageModel   = $static_page;
       $this->BaseModel         = $this->StaticPageModel;
       
       $this->ActivityLogsModel = $activity_logs;
       $this->module_title      = "CMS";
       $this->module_url_slug   = "static_pages";
       $this->module_url_path   = url(config('app.project.admin_panel_slug')."/static_pages");
       /*For activity log*/
        $this->obj_data    = Sentinel::getUser();
        $this->first_name  = isset($this->obj_data->first_name)?$this->obj_data->first_name:'--';
        $this->last_name  = isset($this->obj_data->last_name)?$this->obj_data->last_name:'--';
        $this->ip_address         = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;  
        $this->theme_color       = theme_color();
    }
    
    public function index()
    {
        $obj_static_page = $this->BaseModel->get();

        if($obj_static_page != FALSE)
        {
            $arr_static_page = $obj_static_page->toArray();
        }

        $this->arr_view_data['arr_static_page'] = $arr_static_page;

        $this->arr_view_data['page_title']      = "Manage CMS";
        $this->arr_view_data['module_title']    = "CMS";
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

       return view('admin.static_page.index',$this->arr_view_data);
    }

    public function create()
    {
        $this->arr_view_data['page_title']      = "Create CMS";
        $this->arr_view_data['module_title']    = "CMS";
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view('admin.static_page.create',$this->arr_view_data);
    }


    public function store(Request $request)
    {
        $arr_rules['page_title']     = "required";  
        $arr_rules['meta_keyword']   = "required"; 
        $arr_rules['meta_desc']      = "required";  
        $arr_rules['page_desc']      = "required";  

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
             return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data                 = array();
        $arr_data['page_slug']    = str_slug($request->input('page_title'));
        $arr_data['is_active']    = 1;
        $arr_data['page_title']   = $request->input('page_title');
        $arr_data['meta_keyword'] = $request->input('meta_keyword');
        $arr_data['meta_desc']    = $request->input('meta_desc');
        $arr_data['page_desc']    = $request->input('page_desc');

        $static_page    = $this->BaseModel->create($arr_data);
        if($static_page)
        {
            event(new ActivityLogEvent(['activity_msg'=>'CMS Created By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Create','ip_address'=>$this->ip_address]));

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
        $this->arr_view_data['page_title']      = "Edit CMS";
        $this->arr_view_data['module_title']    = "CMS";
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['enc_id']          = base64_encode($id);
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view('admin.static_page.edit',$this->arr_view_data);  

    }

    public function update(Request $request)
    {
        $id = base64_decode($request->input('enc_id'));
        $arr_rules = array();

        $arr_rules['page_title']     = "required";  
        $arr_rules['meta_keyword']   = "required"; 
        $arr_rules['meta_desc']      = "required";  
        $arr_rules['page_desc']      = "required";  

        $validator = Validator::make($request->all(),$arr_rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $arr_data                 = array();
        $arr_data['page_slug']    = str_slug($request->input('page_title'));
        $arr_data['page_title']   = $request->input('page_title');
        $arr_data['meta_keyword'] = $request->input('meta_keyword');
        $arr_data['meta_desc']    = $request->input('meta_desc');
        $arr_data['page_desc']    = $request->input('page_desc');

        $static_page    = $this->BaseModel->where('id',$id)
                                          ->update($arr_data);
        if($static_page)
        {
            event(new ActivityLogEvent(['activity_msg'=>'CMS Updated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Update','ip_address'=>$this->ip_address]));

            Flash::success($this->module_title .' Updated Successfully');
        }  
        else
        {
            Flash::success('Problem Occurred, While Updating '.$this->module_title);
        }

        return redirect()->back();
            
    }
    
    


}