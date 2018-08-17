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

use Flash;
use Validator;
use Sentinel;
use File;

class InterviewController extends Controller
{
    public function __construct(UserModel $user,
                                StateModel $state,
                                QualificationModel $qualification,
                                CategoryModel $category,
                                UserDetailModel $userdetail,
                                ActivityLogsModel $activity_logs,
                                CountryModel $country,
                                MemberInterviewModel $member_interview,
                                MemberDetailModel $member_detail
                                )
    {

    	$this->UserModel            = $user;
        $this->StateModel           = $state;
        $this->BaseModel            = $member_interview;
        $this->UserDetailModel      = $userdetail;
        $this->QualificationModel   = $qualification;
        $this->ActivityLogsModel    = $activity_logs;
        $this->CategoryModel        = $category;
        $this->CountryModel         = $country;
        $this->MemberInterviewModel = $member_interview;
        $this->MemberDetailModel    = $member_detail;
        $this->module_view_folder   = 'admin.interview';
        $this->arr_view_data        = [];
        $this->module_url_path      = url(config('app.project.admin_panel_slug')."/interviews");
        $this->module_title         = "Interviews";
        $this->theme_color          = theme_color();

        $this->member_referencebook_public_path    = url('/').config('app.project.img_path.refrencebook');
        $this->member_interviewimages_path  = public_path().config('app.project.img_path.interview_images');
        $this->member_interviewimages_public_path = url('/').config('app.project.img_path.interview_images');

    }
    public function index()
    {
    	$arr_interview = [];
    	$obj_interview = $this->MemberInterviewModel->with(['memberdetails','member_personal_details'])->orderBy('id','desc')->get();
    	if($obj_interview)
    	{
    		$arr_interview = $obj_interview->toArray();
    	}
        $this->arr_view_data['page_title'] = 'Manage Interviews';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['arr_interview']   = $arr_interview;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['referencebook_public_path']     = $this->member_referencebook_public_path;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    	
    }

    public function member_interviews($enc_id)
    {
        $member_id = base64_decode($enc_id);
        $arr_interview = [];
        $obj_interview = $this->MemberInterviewModel->where('member_id',$member_id)  
                                                    ->with(['memberdetails','member_personal_details'])
                                                    ->get();
        if($obj_interview)
        {
            $arr_interview = $obj_interview->toArray();
        }
        //dd($arr_interview);
        $this->arr_view_data['page_title'] = 'Manage Interviews';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['arr_interview']   = $arr_interview;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['member_id']       = $enc_id;
        $this->arr_view_data['referencebook_public_path']     = $this->member_referencebook_public_path;
        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function verification_approve($enc_id)
    {
        $interview_id=base64_decode($enc_id);
        $arr_update = [];
        $arr_update['admin_verification'] = 1;
        $arr_update['admin_pending'] = 1;
        $approve=$this->MemberInterviewModel->where('id',$interview_id)->update($arr_update);
        if($approve)
        {    
            Flash::success('Interview approved Successfully.');
        }
        else
        {
            Flash::error('Error occur while Interview approve.');
        }
        return redirect()->back();
    }
    public function verification_reject($enc_id)
    {
        $interview_id=base64_decode($enc_id);
        $arr_update = [];
        $arr_update['admin_verification'] = 0;
        $arr_update['admin_pending'] = 1;
        $reject = $this->MemberInterviewModel->where('id',$interview_id)->update($arr_update);
        if($reject)
        {    
            Flash::success('Interview rejected Successfully.');
        }
        else
        {
            Flash::error('Error occur while Interview rejection.');
        }
        return redirect()->back();
    }

    public function comment($enc_id)
    {
        $id = $enc_id;
        $interview_id = base64_decode($id);
        $arr_itnterview_info=[];
        $obj_interview_info = $this->MemberInterviewModel->where('id',$interview_id)->first();
        if($obj_interview_info)
        {
            $arr_itnterview_info = $obj_interview_info->toArray();
        }

        $this->arr_view_data['enc_id']              = $enc_id;
        $this->arr_view_data['arr_itnterview_info'] = $arr_itnterview_info;
        $this->arr_view_data['page_title']          = 'Interview Comment';
        $this->arr_view_data['module_url_path']     = $this->module_url_path;
        $this->arr_view_data['module_title']        = $this->module_title;
        $this->arr_view_data['theme_color']         = $this->theme_color;
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

        $interview_id = base64_decode($request->input('enc_id'));
        $comment = $request->input('comment');
        
        $comment = $this->MemberInterviewModel->where('id',$interview_id)->update(['admin_comments'=>$comment ]);
        if($comment)
        {
            Flash::success('Interview comment added Successfully.');
        }
        else
        {
            Flash::error('Error occur while storing Interview comment.');
        }
        return redirect()->back();
    }

    public function details($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_interview = [];
        $obj_interview = $this->BaseModel->where('id',$id)->with(['memberdetails','member_personal_details'])->first();
        if($obj_interview)
        {
            $arr_interview = $obj_interview->toArray();
        }

        $arr_country = [];
        $obj_country = $this->CountryModel->get();
        if($obj_country) 
        {
            $arr_country = $obj_country->toArray();
        }

        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }

        //dd($arr_interview);
        $this->arr_view_data['page_title']      = 'Interview Details';
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['module_title']    = $this->module_title;
        $this->arr_view_data['arr_data']        = $arr_interview;
        $this->arr_view_data['arr_country']     = $arr_country;
        $this->arr_view_data['arr_state']     = $arr_state;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        $this->arr_view_data['referencebook_public_path']     = $this->member_referencebook_public_path;
        $this->arr_view_data['member_interviewimages_public_path']  = $this->member_interviewimages_public_path;
        return view($this->module_view_folder.'.view',$this->arr_view_data);
    }

    public function approve_change(Request $request)
    {
        //dd($request->all());
        $approve_id    = $request->input('id');
        $approve_value = $request->input('approve_status');
        $result = $this->MemberInterviewModel->where('id',$approve_id)->update(['approve_status'=>$approve_value ]);
        if($result)
        {
             Flash::success('Interview Approve Status Change Successfully!!!');        
             $arr_response['status']    = "SUCCESS";
        } 
        else
        {
             Flash::error('Problem Occured While Change Approve Status!!!');
             $arr_response['status']    = "Error";
        }   
        //return json_encode($result);
        return response()->json($arr_response);
    }

    public function multi_action(Request $request)
    {
        //dd($request->all());
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

}
