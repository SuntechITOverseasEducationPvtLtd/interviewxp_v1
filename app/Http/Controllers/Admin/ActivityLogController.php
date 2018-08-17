<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ActivityLogsModel;
use App\Events\ActivityLogEvent;

use Sentinel;
use Validator;
use Session;
use Flash;
use Datatables;

class ActivityLogController extends Controller
{

	public function __construct(ActivityLogsModel $activity_logs) 
	{
        $this->arr_view_data      = [];
        $this->ActivityLogsModel  = $activity_logs;
        $this->BaseModel          = $this->ActivityLogsModel;
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/activity_logs");
        $this->module_view_folder = "admin.activity_logs";
        $this->arr_exempted_role  = config('app.project.base_roles');
        $this->module_title       = "Activity Log";
        $this->theme_color        = theme_color();
	}

    public function index()
    {

        $this->arr_view_data['page_title']      = "Manage ".str_singular( $this->module_title);
        $this->arr_view_data['module_title']    = $this->module_title;
        //$this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }

    public function get_records(Request $request)
    {
        $obj_data = $this->BaseModel->orderBy('id','DESC')->get();
        

        if($obj_data != FALSE)
        {                        
            $json_result  = Datatables::of($obj_data)->make(true);
        }

        /* Extract built JSON */

        $build_result = $json_result->getData();
 

        if(isset($build_result->data) && sizeof($build_result->data)>0)
        {

            foreach($build_result->data as $key => $data)
            {  
                $build_result->data[$key]->built_id            = $data->id;

                $build_result->data[$key]->built_user_id       = isset($data->user_id)&&sizeof($data->user_id)>0?$data->user_id : 'NA';

                $build_result->data[$key]->built_activity      = isset($data->activity_log)&&sizeof($data->activity_log)>0?$data->activity_log: 'NA';

                $build_result->data[$key]->built_module_title  = isset($data->module_title)&&sizeof($data->module_title)>0?$data->module_title: 'NA';

                $build_result->data[$key]->built_module_action = isset($data->module_action)&&sizeof($data->module_action)>0?$data->module_action: 'NA';


                $build_result->data[$key]->built_ip_address    = isset($data->ip_address)&&sizeof($data->ip_address)>0?$data->ip_address: 'NA';

                /*$build_result->data[$key]->date                = isset($data->created_at)&&sizeof($data->created_at)>0?$data->created_at: 'NA';*/

                $build_result->data[$key]->built_date          = isset($data->created_at)&&sizeof($data->created_at)>0?date('d-M-Y , H:i', strtotime($data->created_at)): 'NA';
                

            }

            //dd(response()->json($build_result));

            return response()->json($build_result);
        }
        else
        {
            return $json_result;
        }
    }

}
