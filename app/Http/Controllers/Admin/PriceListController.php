<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\UserModel;
use App\Models\PriceListModel;
use Flash;
use Validator;
use Sentinel;
use File;

class PriceListController extends Controller
{
    public function __construct(UserModel $user,
                                PriceListModel $price_list
                                )
    {
        $user = Sentinel::createModel();

        $this->UserModel          = $user;
        $this->BaseModel          = $price_list; 

        $this->arr_view_data      = [];
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/price_list");
        $this->module_title       = "Price List";
        $this->modyle_url_slug    = "price_list";
        $this->module_view_folder = "admin.price_list";
        /*For activity log*/
        $this->obj_data    = Sentinel::getUser();
        $this->first_name  = isset($this->obj_data->first_name)?$this->obj_data->first_name:'--';
        $this->last_name  = isset($this->obj_data->last_name)?$this->obj_data->last_name:'--';
        $this->ip_address         = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:false;  
        $this->theme_color = theme_color();
    }	

    public function index()
    {
        $this->arr_view_data['arr_data'] = array();
        $obj_data = $this->BaseModel->get();

        if($obj_data)
        {
        	$arr_data = $obj_data->toArray();
        }
        	
        /*dd($arr_data);*/
        //$this->arr_view_data['page_title']      = "Manage ".str_plural($this->module_title);
        $this->arr_view_data['page_title']      = "Manage ".$this->module_title;
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.index', $this->arr_view_data);
    }

    public function edit($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_data = [];
        $obj_data = $this->BaseModel->where('price_id',$id)->first();
        if($obj_data)
        {
        	$arr_data = $obj_data->toArray();
        }

        $this->arr_view_data['page_title']                   = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['module_title']                 = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']              = $this->module_url_path;
        $this->arr_view_data['arr_data']                     = $arr_data;
        $this->arr_view_data['enc_id']                       = base64_encode($id);
        $this->arr_view_data['theme_color']                  = $this->theme_color;
        
        return view($this->module_view_folder.'.edit', $this->arr_view_data);
    }

    public function update(Request $request)
    {
        $id                               = base64_decode($request->input('enc_id'));
        $arr_rules['validity']            = "required";
        $arr_rules['ref_book_price']      = "required";
        $arr_rules['training_price']      = "required";
        $arr_rules['interview_price']     = "required";
        $arr_rules['price_for_25_ticket'] = "required";
        $arr_rules['price_for_50_ticket'] = "required";
        $arr_rules['price_for_75_ticket'] = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
            $arr_data=[];
            
            $arr_data['exp_level']           = $request->input('exp_level');
            $arr_data['validity']            = $request->input('validity');
            $arr_data['ref_book_price']      = $request->input('ref_book_price');
            $arr_data['interview_price']     = $request->input('interview_price');
            $arr_data['training_price']     = $request->input('training_price');
            $arr_data['price_for_25_ticket'] = $request->input('price_for_25_ticket');
            $arr_data['price_for_50_ticket'] = $request->input('price_for_50_ticket');
            $arr_data['price_for_75_ticket'] = $request->input('price_for_75_ticket');
            $arr_data['price_for_5_companies'] = $request->input('price_for_5_companies');
            $arr_data['price_for_10_companies'] = $request->input('price_for_10_companies');
            $arr_data['price_for_20_companies'] = $request->input('price_for_20_companies');
            $arr_data['combo_coach_interview_qa'] = $request->input('combo_coach_interview_qa');
            $arr_data['combo_coach_company'] = $request->input('combo_coach_company');
            $arr_data['combo_coach_realissues'] = $request->input('combo_coach_realissues');

            $price_list_data = $this->BaseModel->where('price_id',$id)->update($arr_data);

        if($price_list_data)
        {    
            Flash::success(str_singular($this->module_title).' Updated Successfully!!!');
        }
        else
        {
            Flash::error('Problem Occured While Updating '.str_singular($this->module_title));
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
        $entity = $this->BaseModel->where('price_id',$id)->first();
        if($entity)
        {
            return $this->BaseModel->where('price_id',$id)->update(['is_active'=>1]);
        }

        return FALSE;
    }

    public function perform_deactivate($id)
    {

        $entity = $this->BaseModel->where('price_id',$id)->first();
        
        if($entity)
        {
            return $this->BaseModel->where('price_id',$id)->update(['is_active'=>0]);
        }
        return FALSE;
    }
}
