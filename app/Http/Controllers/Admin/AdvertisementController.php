<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\AdvertisementModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;

use Flash;
use Validator;
use Sentinel;
use File;

class AdvertisementController extends Controller
{
    public function __construct(UserModel $user,
    							AdvertisementModel $advertisement,
                                ActivityLogsModel $activity_logs)
    {
    	 $this->UserModel          = $user;
    	 $this->AdvertisementModel = $advertisement;
    	 $this->BaseModel          = $this->AdvertisementModel;
         
        $this->ActivityLogsModel     = $activity_logs;
        
        $this->arr_view_data        = [];
        $this->admin_url_path       = url(config('app.project.admin_panel_slug'));
        $this->module_url_path      = $this->admin_url_path."/advertisement";
        $this->module_view_folder   = "admin.advertisement";

        $this->module_title = "Advertisements";
        $this->advertise_base_img_path   = public_path().config('app.project.img_path.advertise_image');
        $this->advertise_public_img_path = url('/').config('app.project.img_path.advertise_image');
        /*For Activity log*/
        $this->obj_data    = Sentinel::getUser();
                $this->first_name  = isset($this->obj_data->first_name)?$this->obj_data->first_name:'--';
        $this->last_name  = isset($this->obj_data->last_name)?$this->obj_data->last_name:'--';
        $this->ip_address         = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;  
        $this->theme_color  = theme_color();
    }
    public function index()
    {
    	$arr_advertise = [];
        $obj_advertise = $this->BaseModel->get();
        {
            $arr_advertise = $obj_advertise->toArray();
        }
        
        $this->arr_view_data['arr_data']        = $arr_advertise;
        $this->arr_view_data['page_title']      = "Manage ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['advertise_public_image_path'] = $this->advertise_public_img_path;
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
        $arr_rules['title']         = "required";
        $arr_rules['description']   = "required";
        $arr_rules['advertise_image'] = "required|image";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $does_exists = $this->BaseModel
                            ->where('title','=',$request->input('title'))
                            ->count();   
        if($does_exists)
        {
            Flash::error('Title Already Exists!!!');
            return redirect()->back()->withInput($request->all());
        }


        $file_name      = "default.jpg";
        $file_name      = $request->input('advertise_image');
        $file_extension = strtolower($request->file('advertise_image')->getClientOriginalExtension()); 
        $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
        $request->file('advertise_image')->move($this->advertise_base_img_path, $file_name);

        
        $arr_user_data                    = [];
        $arr_user_data['title']           = $request->input('title');
        $arr_user_data['description']     = $request->input('description');
        $arr_user_data['advertise_image'] = $file_name;
        $create                           = $this->BaseModel->create($arr_user_data);

        if($create)
        {
        	event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Created By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Create','ip_address'=>$this->ip_address]));
           Flash::success(str_singular($this->module_title).' Created Succesfully!!!'); 
        }
        else
        {
            Flash::error('Error Occured While Inserting'.str_singular($this->module_title).' !!!');    
        }
        return redirect()->back();
    }

    public function edit($enc_id,$advt_slug)
    {
        $slug = $advt_slug;
        $id = base64_decode($enc_id);
        $arr_advertise = [];
        $obj_advertise = $this->BaseModel->where('id',$id)->first();
        if($obj_advertise)
        {
            $arr_advertise = $obj_advertise->toArray();
        }
        
       $this->arr_view_data['page_title']      = "Edit ".str_singular($this->module_title);
       $this->arr_view_data['arr_data']        = $arr_advertise;
       $this->arr_view_data['module_title']    = str_plural($this->module_title);
       $this->arr_view_data['module_url_path'] = $this->module_url_path;
       $this->arr_view_data['theme_color']     = $this->theme_color;
       $this->arr_view_data['advertise_public_image_path'] = $this->advertise_public_img_path;
       $this->arr_view_data['enc_id']          = base64_encode($id);
       $this->arr_view_data['slug']          = $slug;

       return view($this->module_view_folder.'.edit', $this->arr_view_data); 
    }

    public function update(Request $request)
    {
    	$arr_rules['title']         = "required";
        $arr_rules['description']   = "required";
        
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $id   = base64_decode($request->input('enc_id'));
        $slug = $request->input('advt_slug');

        $does_exists = $this->BaseModel
        					->where('id','<>',$id)	
                            ->where('title','=',$request->input('title'))
                            ->count();   
        if($does_exists)
        {
            Flash::error('Title Already Exists!!!');
            return redirect()->back()->withInput($request->all());
        }
        /*Fetching image data to unlink if new image is uploaded*/
        $arr_data = [];
        $obj_data = $this->BaseModel->where('id',$id)->first(['id','advertise_image']);
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();
        }
        $file_name = $arr_data['advertise_image']; 
        /*checking for is new image is uploaded */
        if($request->hasFile('advertise_image'))
        {
            $image_size=[];
            $fileExtension = strtolower($request->file('advertise_image')->getClientOriginalExtension()); 
            $arr_file_types = ['jpg','jpeg','png','bmp'];    

            $image_size = getimagesize($request->file('advertise_image'));
            $image_width = $image_size[0];
            $image_height = $image_size[1];    
            
           if($slug == 'right_advertise')
           {
             if(in_array($fileExtension, $arr_file_types) && $image_width==271 && $image_height==190)
            {
                if(isset($arr_data) && sizeof($arr_data)>0)
                {
                    if(File::exists($this->advertise_base_img_path.$arr_data['advertise_image']))
                    {
                        @unlink($this->advertise_base_img_path.$arr_data['advertise_image']);
                    }
                }
                $file_name      = "default.jpg";
                $file_name      = $request->input('advertise_image');
                $file_extension = strtolower($request->file('advertise_image')->getClientOriginalExtension()); 
                $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $request->file('advertise_image')->move($this->advertise_base_img_path, $file_name);
            }
            else
            {
               Flash::error('Please upload valid file with jpg,jpeg,png,bmp extension with 271X190 resolution.');
               return redirect()->back();
            }

           } 

           elseif($slug == 'bottom_advertise')
           {
             if(in_array($fileExtension, $arr_file_types) && $image_width==971 && $image_height==187)
            {
                if(isset($arr_data) && sizeof($arr_data)>0)
                {
                    if(File::exists($this->advertise_base_img_path.$arr_data['advertise_image']))
                    {
                        @unlink($this->advertise_base_img_path.$arr_data['advertise_image']);
                    }
                }
                $file_name      = "default.jpg";
                $file_name      = $request->input('advertise_image');
                $file_extension = strtolower($request->file('advertise_image')->getClientOriginalExtension()); 
                $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $request->file('advertise_image')->move($this->advertise_base_img_path, $file_name);
            }
            else
            {
               Flash::error('Please upload valid file with jpg,jpeg,png,bmp extension with 971X187 resolution.');
               return redirect()->back();
            }

           } 
            
        }    

        $arr_user_data                    = [];
        $arr_user_data['title']           = $request->input('title');
        $arr_user_data['description']     = $request->input('description');
        $arr_user_data['advertise_image'] = $file_name;
        $update                           = $this->BaseModel->where('id',$id)
        													->update($arr_user_data);

        if($update)
        {
        	event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Updated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Update','ip_address'=>$this->ip_address]));
           Flash::success(str_singular($this->module_title).' Updated Successfully!!!'); 
        }
        else
        {
            Flash::error('Error Occured While Inserting'.str_singular($this->module_title).' !!!');    
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
            
        }

        return redirect()->back();
    }

    public function perform_delete($id)
    {
    	$arr_data = [];
        $obj_data = $this->BaseModel->where('id',$id)->first(['id','advertise_image']);
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();
        }
    	if(isset($arr_data) && sizeof($arr_data)>0)
        {
            if(File::exists($this->advertise_base_img_path.$arr_data['advertise_image']))
            {
                @unlink($this->advertise_base_img_path.$arr_data['advertise_image']);
            }
        }
       $delete_success = $this->BaseModel->where('id',$id)->delete();
       event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deleted By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Delete','ip_address'=>$this->ip_address]));

       return $delete_success;    
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
        $entity = $this->BaseModel->where('id',$id)->first();
        if($entity)
        {
            return $this->BaseModel->where('id',$id)->update(['is_active'=>1]);
        }

        return FALSE;
    }

    public function perform_deactivate($id)
    {

        $entity = $this->BaseModel->where('id',$id)->first();
        
        if($entity)
        {
            return $this->BaseModel->where('id',$id)->update(['is_active'=>0]);
        }
        return FALSE;
    }
}
