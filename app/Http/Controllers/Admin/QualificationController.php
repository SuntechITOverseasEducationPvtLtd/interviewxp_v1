<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\QualificationModel;
use App\Models\SpecializationModel;

use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;
use App\Models\MemberDetailModel;
use App\Models\UserDetailModel;

use Validator;
use Session;
use Sentinel;
use Flash;

class QualificationController extends Controller
{
 	public function __construct(UserModel $user,
    							QualificationModel $qualification,
    							SpecializationModel $specialization,
                                ActivityLogsModel $activity_logs,
                                MemberDetailModel $member_detail,
                                UserDetailModel $user_detail
                                )
    {
    	 $this->UserModel           = $user;
    	 $this->QualificationModel  = $qualification;
    	 $this->BaseModel           = $this->QualificationModel;
         $this->MemberDetailModel   = $member_detail;
         $this->UserDetailModel     = $user_detail;    
    	 $this->SpecializationModel = $specialization;
    	 $this->ActivityLogsModel = $activity_logs;
        
        $this->arr_view_data        = [];
        $this->admin_url_path       = url(config('app.project.admin_panel_slug'));
        $this->module_url_path      = $this->admin_url_path."/qualification";
        $this->module_view_folder   = "admin.qualification";

        $this->module_title = "Qualification";
        /*For Activity log*/
        $this->obj_data    = Sentinel::getUser();
        $this->first_name  = isset($this->obj_data->first_name)?$this->obj_data->first_name:'--';
        $this->last_name  = isset($this->obj_data->last_name)?$this->obj_data->last_name:'--';
        $this->ip_address         = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;  
        $this->theme_color  = theme_color();
    }
    public function index()
    {
        $arr_qualification = [];
        $obj_qualification = $this->BaseModel->get();
        {
            $arr_qualification = $obj_qualification->toArray();
        }
        
        $this->arr_view_data['arr_data']        = $arr_qualification;
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
        $arr_rules['qualification_name']         = "required";
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $does_exists = $this->BaseModel
                            ->where('qualification_name','=',$request->input('qualification_name'))
                            ->count();   
        if($does_exists)
        {
            Flash::error(str_singular($this->module_title).' Already Exists!!!');
            return redirect()->back()->withInput($request->all());
        }

        $arr_user_data                  = [];
        $arr_user_data['qualification_name'] = $request->input('qualification_name');
        $arr_user_data['is_active']     = 1;
        $create                         = $this->BaseModel->create($arr_user_data);

        if($create)
        {
           event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Created By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Create','ip_address'=>$this->ip_address])); 
           Flash::success(str_singular($this->module_title).' Inserted Succesfully!!!'); 
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
        $arr_category = [];
        $obj_qualification = $this->BaseModel->where('id',$id)->first();
        if($obj_qualification)
        {
            $arr_qualification = $obj_qualification->toArray();
        }
        
       $this->arr_view_data['page_title']      = "Edit ".str_singular($this->module_title);
       $this->arr_view_data['arr_data']        = $arr_qualification;
       $this->arr_view_data['module_title']    = str_plural($this->module_title);
       $this->arr_view_data['module_url_path'] = $this->module_url_path;
       $this->arr_view_data['theme_color']     = $this->theme_color;
       $this->arr_view_data['enc_id']          = base64_encode($id);

        return view($this->module_view_folder.'.edit', $this->arr_view_data); 
    }

    public function update(Request $request)
    {
        $arr_rules['qualification_name']         = "required";
        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
        $id = base64_decode($request->input('enc_id'));
        
        $does_exists = $this->BaseModel
                            ->where('id','<>',$id)    
                            ->where('qualification_name','=',$request->input('qualification_name'))
                            ->count();   
        if($does_exists)
        {
            Flash::error(str_singular($this->module_title).' Already Exists!!!');
            return redirect()->back()->withInput($request->all());
        }
        
        $arr_user_data                  = [];
        $arr_user_data['qualification_name'] = $request->input('qualification_name');
        $update                         = $this->BaseModel->where('id',$id)
                                                          ->update($arr_user_data);

        if($update)
        {
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Updated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Update','ip_address'=>$this->ip_address]));
           Flash::success(str_singular($this->module_title).' Updated Succesfully!!!'); 
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

        $deactivate = $this->perform_deactivate(base64_decode($enc_id));

        if($deactivate == 'not_deactive')
        {
            Flash::error('This qualification is already used by users on this website, so you cant deactivate it.');
        }
        elseif($deactivate ==1)
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
               $deactivate = $this->perform_deactivate(base64_decode($record_id));
               if($deactivate == 'not_deactive')
               {
                    Flash::error('This qualification is already used by users on this website, so you cant deactivate it.');
               } 
               elseif($deactivate == 1)
               {
                 //$this->perform_deactivate(base64_decode($record_id));    
                 Flash::success(str_plural($this->module_title).' Blocked Successfully!!!');  
               }
              
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
            $member_count = $this->MemberDetailModel->where('qualification_id',$id)->count();
            $user_count   = $this->UserDetailModel->where('qualification_id',$id)->count();
            if($member_count > 0 || $user_count > 0)
            {
                $not_deactive = 'not_deactive';
                return $not_deactive;
            }
            else
            {
                event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deactivated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Deactivate','ip_address'=>$this->ip_address]));
                return $this->BaseModel->where('id',$id)->update(['is_active'=>0]);
            }

            
        }
        //return FALSE;
    }

    

    public function perform_delete($id)
    {
    	$this->SpecializationModel->where('qualification_id',$id)->delete();
       $delete_success = $this->BaseModel->where('id',$id)->delete();
       event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deleted By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Delete','ip_address'=>$this->ip_address]));

       return $delete_success;    
    }   
}
