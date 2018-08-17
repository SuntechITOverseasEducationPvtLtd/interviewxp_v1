<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\SiteSettingModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;


use Validator;
use Flash;
use Input;
use Sentinel;
 
class SiteSettingController extends Controller
{
    
    public function __construct(SiteSettingModel $siteSetting,
                                ActivityLogsModel $activity_logs)
    {
        $this->SiteSettingModel   =   $siteSetting;
        $this->ActivityLogsModel     = $activity_logs;
        $this->arr_view_data      =   [];
        $this->BaseModel          =   $this->SiteSettingModel;
        $this->module_title       =   "Site Settings";
        $this->module_view_folder =   "admin.site_settings";
        $this->module_url_path    =   url(config('app.project.admin_panel_slug')."/site_settings");
        $this->theme_color        = theme_color();

        $this->logo_base_img_path = public_path().'/images/front';
        $this->logo_img_path      = url('/images/front/');
    }

    /*
    | Index  : Display Website settings page
    | auther : Nitesh Acharya
    | Date   : 03/11/2016
    | @return \Illuminate\Http\Response
    */ 
 
    public function index()
    {
        $arr_data = array();   

        $obj_data =  $this->BaseModel->first();

        if($obj_data != FALSE)
        {
            $arr_data = $obj_data->toArray();    
        }

        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['page_title']      = str_singular($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['theme_color']     = $this->theme_color;
        
        $this->arr_view_data['logo_img_path']   = $this->logo_img_path;

        return view($this->module_view_folder.'.index',$this->arr_view_data);
    }
 

    /*
    | update() : Update the Website Settings
    | auther   : Nitesh Acharya
    | Date     : 03/11/2016
    | @param  int  $enc_id
    | @return \Illuminate\Http\Response
    */ 

    public function update(Request $request, $enc_id)
    {
        $id = base64_decode($enc_id);

        $arr_rules = array();

        $arr_rules['site_name']           = "required";
        $arr_rules['site_email_address']  = "email|required";
        $arr_rules['site_contact_number'] = "required";
        $arr_rules['site_address']        = "required";
        $arr_rules['fb_url']              = "required";
        $arr_rules['google_plus_url']     = "required";
        $arr_rules['twitter_url']         = "required";
        $arr_rules['youtube_url']         = "required";
        $arr_rules['instagram_url']       = "required";
        $arr_rules['site_status']         = "required";
        $arr_rules['email_logo_image']    = "required|mimes:jpg,png,jpeg";
        $arr_rules['website_logo_image']  = "required|mimes:jpg,png,jpeg";
        
        $validator = Validator::make($request->all(),$arr_rules);
        

        if($validator->fails())
        {       
            return back()->withErrors($validator)->withInput();  
        } 

        /*---------------------------------Email Logo Upload---------------------------------------------------*/
        $is_email_logo_uploaded = FALSE;

         if ($request->hasFile('email_logo_image')) 
         {
            
            $image_validation = Validator::make(array('file'=>$request->file('email_logo_image')),
                                                array('file'=>'mimes:jpg,jpeg,png'));
            

            if($request->file('email_logo_image')->isValid() && $image_validation->passes())
            {

            }
            else
            {
                Flash::error('Not valid image! Please Select Proper Image Format');
                return redirect()->back();
            }

            $arr_image_size = [];
            $arr_image_size = getimagesize($request->file('email_logo_image'));

            if(isset($arr_image_size) && $arr_image_size==false)
            {
                Flash::error('Please use valid image');
                return redirect()->back(); 
            }

            $excel_file_name = $request->input('email_logo_image');
            $fileExtension   = strtolower($request->file('email_logo_image')->getClientOriginalExtension()); 
            $file_name       = sha1(uniqid().$excel_file_name.uniqid()).'.'.$fileExtension;
            $request->file('email_logo_image')->move($this->logo_base_img_path,$file_name); 
            
            /* Unlink the Existing file from the folder */
            $obj_image = $this->BaseModel->where('site_setting_id',$request->input('user_id'))->first(['email_logo_image']);
            if($obj_image)   
            {   
                $_arr = [];
                $_arr = $obj_image->toArray();
                if(isset($_arr['email_logo_image']) && $_arr['email_logo_image'] != "" )
                {
                    $unlink_path    = $this->logo_base_img_path.$_arr['email_logo_image'];
                    @unlink($unlink_path);
                }
            }

            $is_email_logo_uploaded = TRUE;         
            
        }
        
        $arr_data = [];

        if($is_email_logo_uploaded)
        {
            $arr_data['email_logo_image'] = $file_name;
        }

        /*-----------------------------------------------------------------------------------------------------*/

        /*---------------------------------WebSite Logo Upload----------------------------------------------------*/
        $is_website_logo_uploaded = FALSE;

         if ($request->hasFile('website_logo_image')) 
         {
            
            $image_validation = Validator::make(array('file'=>$request->file('website_logo_image')),
                                                array('file'=>'mimes:jpg,jpeg,png'));
            

            
            if($request->file('website_logo_image')->isValid() && $image_validation->passes())
            {

            }
            else
            {
                Flash::error('Not valid image! Please Select Proper Image Format');
                return redirect()->back();
            }

            $arr_image_size = [];
            $arr_image_size = getimagesize($request->file('website_logo_image'));

            if(isset($arr_image_size) && $arr_image_size==false)
            {
                Flash::error('Please use valid image');
                return redirect()->back(); 
            }

            $excel_file_name = $request->input('website_logo_image');
            $fileExtension   = strtolower($request->file('website_logo_image')->getClientOriginalExtension()); 
            $file_name       = sha1(uniqid().$excel_file_name.uniqid()).'.'.$fileExtension;
            $request->file('website_logo_image')->move($this->logo_base_img_path,$file_name); 
            
            /* Unlink the Existing file from the folder */
            $obj_image = $this->BaseModel->where('site_setting_id',$request->input('user_id'))->first(['website_logo_image']);
            if($obj_image)   
            {   
                $_arr = [];
                $_arr = $obj_image->toArray();
                if(isset($_arr['website_logo_image']) && $_arr['website_logo_image'] != "" )
                {
                    $unlink_path    = $this->logo_base_img_path.$_arr['website_logo_image'];
                    @unlink($unlink_path);
                }
            }
        }

        $is_website_logo_uploaded = TRUE;         
        
        if($is_website_logo_uploaded)
        {
            $arr_data['website_logo_image'] = $file_name;
        }    

        /*---------------------------------------------------------------------------------------------------------*/

        $arr_data['site_name']           = $request->input('site_name');
        $arr_data['site_address']        = $request->input('site_address');
        $arr_data['site_contact_number'] = $request->input('site_contact_number');
        $arr_data['meta_desc']           = $request->input('meta_desc');
        $arr_data['meta_keyword']        = $request->input('meta_keyword');
        $arr_data['site_email_address']  = $request->input('site_email_address');
        $arr_data['fb_url']              = $request->input('fb_url');
        $arr_data['google_plus_url']     = $request->input('google_plus_url');
        $arr_data['twitter_url']         = $request->input('twitter_url');
        $arr_data['youtube_url']         = $request->input('youtube_url');
        $arr_data['rss_feed_url']        = $request->input('rss_feed_url');
        $arr_data['instagram_url']       = $request->input('instagram_url');
        $arr_data['site_status']         = $request->input('site_status');

        $entity = $this->BaseModel->where('site_setting_id',$id)
                                  ->update($arr_data);

        if($entity)
        {   
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Updated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Update','ip_address'=>$this->ip_address]));

            Flash::success(str_singular($this->module_title).' Updated Successfully'); 
        }
        else
        {
            Flash::error('Problem Occured, While Updating '.str_singular($this->module_title));  
        } 
      
        return redirect()->back()->withInput();
    }
}
