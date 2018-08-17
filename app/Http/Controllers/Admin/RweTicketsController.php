<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserModel;
use App\Models\StateModel;
use App\Models\QualificationModel;
use App\Models\CategoryModel;
use App\Models\UserDetailModel;
use App\Models\MemberDetailModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;
use App\Models\MemberInterviewModel;
use App\Models\CountryModel;
use App\Models\RealtimeExperienceModel;

use Flash;
use Validator;
use Sentinel;
use File;

class RweTicketsController extends Controller
{
    public function __construct(UserModel $user,
                                StateModel $state,
                                QualificationModel $qualification,
                                CategoryModel $category,
                                UserDetailModel $userdetail,
                                ActivityLogsModel $activity_logs,
                                CountryModel $country,
                                MemberInterviewModel $member_interview,
                                MemberDetailModel $member_detail,
                                RealtimeExperienceModel $real_time_exp
                                )
    {

    	$this->UserModel                = $user;
        $this->StateModel               = $state;
        $this->BaseModel                = $real_time_exp;
        $this->UserDetailModel          = $userdetail;
        $this->QualificationModel       = $qualification;
        $this->ActivityLogsModel        = $activity_logs;
        $this->CategoryModel            = $category;
        $this->CountryModel             = $country;
        $this->MemberInterviewModel     = $member_interview;
        $this->MemberDetailModel        = $member_detail;
        $this->module_view_folder       = 'admin.rwe_tickets';
        $this->arr_view_data            = [];
        $this->module_url_path          = url(config('app.project.admin_panel_slug')."/rwe_tickets");
        $this->module_title             = "Real Time Work Experience";
        $this->theme_color              = theme_color();

        $this->member_referencebook_public_path    = url('/').config('app.project.img_path.refrencebook');

    }
    public function index()
    {
    	$arr_real_time_work = [];
    	$obj_real_time_work = $this->BaseModel->with(['memberdetails','member_personal_details'])->orderBy('id','desc')->get();
    	if($obj_real_time_work)
    	{
    		$arr_real_time_work = $obj_real_time_work->toArray();
    	}
        //dd($arr_real_time_work);
        $this->arr_view_data['page_title']      = 'Manage Real Time Work Experience';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['arr_data']        = $arr_real_time_work;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['referencebook_public_path']     = $this->member_referencebook_public_path;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    	
    }

    public function member_rwe_tickets($enc_id)
    {
        $member_id = base64_decode($enc_id);
        $arr_real_time_work = [];
        $obj_real_time_work = $this->BaseModel ->where('member_id',$member_id)
                                               ->with(['memberdetails','member_personal_details'])
                                               ->get();
        if($obj_real_time_work)
        {
            $arr_real_time_work = $obj_real_time_work->toArray();
        }
        //dd($arr_real_time_work);
        $this->arr_view_data['page_title']      = 'Manage Real Time Work Experience';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['arr_data']        = $arr_real_time_work;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['member_id']          = $enc_id;
        $this->arr_view_data['referencebook_public_path']     = $this->member_referencebook_public_path;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
    
    public function details($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_real_time_work = [];
        $obj_real_time_work = $this->BaseModel->where('id',$id)->with(['memberdetails','member_personal_details'])->first();
        if($obj_real_time_work)
        {
            $arr_real_time_work = $obj_real_time_work->toArray();
        }

        //dd($arr_real_time_work);
        $this->arr_view_data['page_title']      = 'Manage Real Time Experience';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['arr_data']        = $arr_real_time_work;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['referencebook_public_path']     = $this->member_referencebook_public_path;
        return view($this->module_view_folder.'.view',$this->arr_view_data);
    }

    public function comment($enc_id)
    {
        $rwe_ticket_id = base64_decode($enc_id);
        //dd($rwe_ticket_id);
        $arr_rwe_ticket_info=[];
        $obj_rwe_ticket_info = $this->BaseModel->where('id',$rwe_ticket_id)->first();
        if($obj_rwe_ticket_info)
        {
            $arr_rwe_ticket_info = $obj_rwe_ticket_info->toArray();
        }

        $this->arr_view_data['enc_id']              = $enc_id;
        $this->arr_view_data['arr_rwe_ticket_info'] = $arr_rwe_ticket_info;
        $this->arr_view_data['page_title']          = 'Real Time Work Experience Comment';
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['theme_color']         = $this->theme_color;

        //dd($this->arr_view_data);
        return view($this->module_view_folder.'.comment',$this->arr_view_data);
    }

    public function store_comment(Request $request)
    {
        $arr_rules['comment']            = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $rwe_ticket_id = base64_decode($request->input('enc_id'));
        $comment = $request->input('comment');
        
        $comment = $this->BaseModel->where('id',$rwe_ticket_id)->update(['admin_comments'=>$comment]);
        if($comment)
        {
            Flash::success('Real Time Work Experience comment added Successfully.');
        }
        else
        {
            Flash::error('Error occur while storing Interview comment.');
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

    public function perform_delete($id)
    {
       $delete_success = $this->BaseModel->where('id',$id)->delete();
       if($delete_success)
       {
            return $delete_success;   
       }
       return FALSE;
    } 

    public function approve_change(Request $request)
    {
        //dd($request->all());
        $approve_id    = $request->input('id');
        $approve_value = $request->input('approve_status');
        $result = $this->BaseModel->where('id',$approve_id)->update(['approve_status'=>$approve_value]);
        if($result)
        {
             Flash::success('RWE Tickets Status Change Successfully!!!');        
             $arr_response['status']    = "SUCCESS";
        } 
        else
        {
             Flash::error('Problem Occured While Change Approve Status!!! ');
             $arr_response['status']    = "Error";
        }   
        //return json_encode($result);
        return response()->json($arr_response);
    }
    

  
   
}
