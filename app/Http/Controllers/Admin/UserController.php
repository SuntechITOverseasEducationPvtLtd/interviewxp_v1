<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Common\Traits\MultiActionTrait;

use App\Models\UserModel;
use App\Models\StateModel;
use App\Models\QualificationModel;
use App\Models\CategoryModel;
use App\Models\UserDetailModel;
use App\Events\ActivityLogEvent;
use App\Models\ActivityLogsModel;
use App\Models\CountryModel;

use Flash;
use Validator;
use Sentinel;
use File;

class UserController extends Controller
{
    //use MultiActionTrait;

    public function __construct(UserModel $user,
                                StateModel $state,
                                QualificationModel $qualification,
                                CategoryModel $category,
                                UserDetailModel $userdetail,
                                ActivityLogsModel $activity_logs,
                                CountryModel $country
                                )
    {
        $user = Sentinel::createModel();

        $this->UserModel          = $user;
        $this->StateModel         = $state;
        $this->BaseModel          = Sentinel::createModel();  // using sentinel for base model.
        $this->UserDetailModel    = $userdetail;
        $this->QualificationModel = $qualification;
        $this->ActivityLogsModel  = $activity_logs;
        $this->CategoryModel      = $category;
        $this->CountryModel = $country;
        
        $this->user_profile_base_img_path   = public_path().config('app.project.img_path.user_profile_image');
        $this->user_profile_public_img_path = url('/').config('app.project.img_path.user_profile_image');

        $this->arr_view_data      = [];
        $this->module_url_path    = url(config('app.project.admin_panel_slug')."/users");
        $this->module_title       = "Users";
        $this->modyle_url_slug    = "users";
        $this->module_view_folder = "admin.users";
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
        $obj_data = $this->BaseModel->whereHas('roles',function($query)
                                      {
                                        $query->where('slug','!=','admin');        
                                        $query->where('slug','!=','member');
                                      })
                                    ->with(['user_profile'])  
                                    ->orderBy('id','desc')  
        							->get();

        if($obj_data)
        {
        	$arr_data = $obj_data->toArray();
        }
        //dd($arr_data);
        /* $country_id = $arr_data[0]['user_profile']['country_id'];
        $country_name = $this->CountryModel->where('id',$country_id)->first(['country_name']);*/
       
        $obj_mydata = $this->UserModel->get();
        if ($obj_mydata) 
        {
        	$obj_mydata = $obj_mydata->toArray();
        }
        $this->arr_view_data['page_title']      = "A/c Activations ".str_plural($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.index', $this->arr_view_data);
    }

    public function profiles()
    {
        $this->arr_view_data['arr_data'] = array();
        $obj_data = $this->BaseModel->whereHas('roles',function($query)
                                        {
                                            $query->where('slug','!=','admin');        
                                            $query->where('slug','!=','member');
                                        })  
                                    ->with(['user_profile']) 
                                    ->orderBy('id','desc')   
                                    ->get();

        if($obj_data)
        {
            $arr_data = $obj_data->toArray();
        }
            
        //dd($arr_data);
        /* $country_id = $arr_data[0]['user_profile']['country_id'];
        $country_name = $this->CountryModel->where('id',$country_id)->first(['country_name']);*/
       
        $obj_mydata = $this->UserModel->get();
        if ($obj_mydata) 
        {
            $obj_mydata = $obj_mydata->toArray();
        }
        
        $this->arr_view_data['page_title']      = "Profiles ".str_plural($this->module_title);
        $this->arr_view_data['module_title']    = str_plural($this->module_title);
        $this->arr_view_data['module_url_path'] = $this->module_url_path;
        $this->arr_view_data['arr_data']        = $arr_data;
        $this->arr_view_data['theme_color']     = $this->theme_color;

        return view($this->module_view_folder.'.profiles', $this->arr_view_data);
    }


    public function create()
    {
        
        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->where('is_active','=',1)
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }

        $arr_qualification = [];
        $obj_qualification = $this->QualificationModel->where('is_active','1')->get();
        if($obj_qualification)
        {
            $arr_qualification = $obj_qualification->toArray();
        }

        $arr_category = [];
        $obj_category = $this->CategoryModel->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }

        $arr_country = [];
        $obj_country = $this->CountryModel->get();
        if($obj_country) 
        {
            $arr_country = $obj_country->toArray();
        }

        $this->arr_view_data['page_title']        = "Create ".str_singular($this->module_title);
        $this->arr_view_data['module_title']      = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']   = $this->module_url_path;
        $this->arr_view_data['arr_state']         = $arr_state;
        $this->arr_view_data['arr_qualification'] = $arr_qualification;
        $this->arr_view_data['arr_category']      = $arr_category;
        $this->arr_view_data['theme_color']       = $this->theme_color;
        $this->arr_view_data['arr_country'] = $arr_country;

        return view($this->module_view_folder.'.create', $this->arr_view_data);
    }

    public function store(Request $request)
    {/*dd($request->all());*/
        $arr_rules['password']          = "required";
        $arr_rules['first_name']        = "required";
        $arr_rules['last_name']         = "required";
        $arr_rules['email']             = "required";
        $arr_rules['mobile_no']         = "required";
        $arr_rules['qualification_id']  = "required";
        $arr_rules['passing_month']     = "required";
        $arr_rules['passing_year']      = "required";
        $arr_rules['marks_type']        = "required";
        $arr_rules['marks_input']       = "required";
        //$arr_rules['specialization_id'] = "required";
        $arr_rules['category_id']       = "required";
        //$arr_rules['city']              = "required";
        $arr_rules['date']              = "required";
        $arr_rules['month']             = "required";
        $arr_rules['year']              = "required";
        $arr_rules['gender']            = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        /* Check for email duplication */
        $does_exists = $this->BaseModel	
                            ->where('email','=',$request->input('email'))
                            ->count();

        if($does_exists)
        {
            Flash::error(str_singular($this->module_title).' Already Exists!!!');
            return redirect()->back()->withInput($request->all());
        }   
        $marks_input = $request->input('marks_input');
        if($request->input('marks_type')=='percentage')
        {
            if($marks_input<30 || $marks_input>100)
            {
                Flash::error('Percentage value must be between 30 to 100!!!');
                return redirect()->back();
            }    
        }
        if($request->input('marks_type')=='cgpa')
        {
            if($marks_input<1 || $marks_input>10)
            {
                Flash::error('CGPA value must be between 1 to 10!!!');
                return redirect()->back();
            }    
        } 

         $country_id = 358;
        if($request->input('country_id')!='')
        {
            $country_id = $request->input('country_id');
        }
        $other_city = '';
        if($request->input('city_name')!='')
        {
            $other_city = $request->input('city_name');
        }

        $specialization_id = '';
        if($request->input('specialization_id')!='')
        {
            $specialization_id = $request->input('specialization_id');
        }
        //dd($arr_user_data);
        /* User Proof upload */

        $file_name      = "default.jpg";
        if($request->hasFile('profile_image'))
        {	
        	//$image_validation = Validator::make($request->all(),array('picture'=>'mimes:jpg,jpeg,png'));
            $fileExtension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
            $arr_file_types = ['jpg','jpeg','png','bmp'];

             if(in_array($fileExtension, $arr_file_types) )
            //if($image_validation->passes())
            {
		        $file_name      = $request->input('profile_image');
		        $file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
		        $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
		        $request->file('profile_image')->move($this->user_profile_base_img_path, $file_name); 
		    }
		    else
		    {
		    	Flash::error('Please upload valid image with jpg, jpeg ,png extension!!!');
                return redirect()->back();
		    } 
    	}
    	$date = $request->input('date');
        $month = $request->input('month');
        $year = $request->input('year');
        
        $birth_date=date('Y-m-d',strtotime($year.'-'.$month.'-'.$date)); 

        $user = Sentinel::registerAndActivate([
            'first_name' => $request->input('first_name'),
            'email'      => $request->input('email'),
            'last_name' => $request->input('last_name'),
            'password'   => $request->input('password'),
        ]);

        if($user)
        {   
            /* Assign User Role */
            $user = Sentinel::findById($user->id);
            $role = Sentinel::findRoleBySlug('user');
            $user->roles()->attach($role);

            $arr_user_data                   = [];
            $arr_user_data['user_type']  = 'user';
            $arr_user_data['profile_image']  = $file_name;
            $arr_user_data['gender']        = $request->input('gender');
            $arr_user_data['mobile_no']          = $request->input('mobile_no');
            $arr_user_data['is_active']      = '1';
            $arr_user_data['status']      = 'completed';
            $arr_user_data['birth_date'] = $birth_date;
            $user_update=$this->BaseModel->where('id','=',$user->id)->update($arr_user_data);
            $arr_data=[];
            $arr_data['user_id'] = $user->id;
            $arr_data['qualification_id'] = $request->input('qualification_id');
            $arr_data['passing_month'] = $request->input('passing_month');
            $arr_data['passing_year'] = $request->input('passing_year');
            $arr_data['marks_type'] = $request->input('marks_type');
            $arr_data['marks'] = $request->input('marks_input');
            $arr_data['specialization_id'] = $request->input('specialization_id');
            $arr_data['category_id'] = $request->input('category_id');
            $arr_data['current_work_location'] = $request->input('city');
            $arr_data['other_city'] = $other_city;
            $arr_data['specialization_id']    = $specialization_id;
            $arr_data['country_id']         = $country_id;
            $this->UserDetailModel->create($arr_data);

            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Created By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Create','ip_address'=>$this->ip_address]));

            Flash::success(str_singular($this->module_title).' Created Successfully!!!');
        }
        else
        {
            Flash::error('Problem Occured While Creating '.str_singular($this->module_title));
        }   
        
        return redirect()->back();        
    }

    public function edit($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_data = [];
        $obj_data = $this->BaseModel->where('id',$id)->with(['user_profile'])->first();
        if($obj_data)
        {
        	$arr_data = $obj_data->toArray();
        }
        //dd($arr_data);
        if(isset($arr_data) && sizeof($arr_data)>0)
        {
            $birth = explode('-', $arr_data['birth_date']);
            $birth_year=$birth[0];
            $birth_month=$birth[1];
            $birth_date=$birth[2];

        } 
        $arr_state = [];
        $obj_state = $this->StateModel->with(['city'=>function($query)
                                      {
                                        $query->where('is_active','=',1);
                                      }])
                                      ->where('is_active','=',1)   
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }


        $arr_qualification = [];
        $obj_qualification = $this->QualificationModel->where('is_active','1')->get();
        if($obj_qualification)
        {
            $arr_qualification = $obj_qualification->toArray();
        }

        $arr_category = [];
        $obj_category = $this->CategoryModel->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
        }

        $arr_country = [];
        $obj_country = $this->CountryModel->get();
         if($obj_country) 
        {
            $arr_country = $obj_country->toArray();
        }

         
        //dd($arr_country);

        $this->arr_view_data['page_title']                   = "Edit ".str_singular($this->module_title);
        $this->arr_view_data['module_title']                 = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']              = $this->module_url_path;
        $this->arr_view_data['arr_data']                     = $arr_data;
        $this->arr_view_data['enc_id']                       = base64_encode($id);
        $this->arr_view_data['birth_year']                   = $birth_year;
        $this->arr_view_data['birth_month']                  = $birth_month;
        $this->arr_view_data['birth_date']                   = $birth_date;
        $this->arr_view_data['arr_state']                    = $arr_state;
        $this->arr_view_data['arr_qualification']            = $arr_qualification;
        $this->arr_view_data['arr_category']                 = $arr_category;
        $this->arr_view_data['user_profile_public_img_path'] = $this->user_profile_public_img_path;
        $this->arr_view_data['theme_color']                  = $this->theme_color;
        $this->arr_view_data['arr_country']                  = $arr_country;
        
        //dd($this->arr_view_data);
        return view($this->module_view_folder.'.edit', $this->arr_view_data);
    }

    public function update(Request $request)
    {
        $id = base64_decode($request->input('enc_id'));
        $arr_rules['first_name']        = "required";
        $arr_rules['last_name']         = "required";
        $arr_rules['email']             = "required";
        $arr_rules['mobile_no']         = "required";
        $arr_rules['qualification_id']  = "required";
        $arr_rules['passing_month']     = "required";
        $arr_rules['passing_year']      = "required";
        $arr_rules['marks_type']        = "required";
        $arr_rules['marks_input']       = "required";
        $arr_rules['category_id']       = "required";
        /*$arr_rules['city']              = "required";*/
        $arr_rules['date']              = "required";
        $arr_rules['month']             = "required";
        $arr_rules['year']              = "required";
        $arr_rules['gender']            = "required";

        $validator = Validator::make($request->all(),$arr_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        /* Check for email duplication */
        $does_exists = $this->BaseModel
                            ->where('id','<>',$id) 
                            ->where('email','=',$request->input('email'))
                            ->count();

        if($does_exists)
        {
            Flash::error(str_singular($this->module_title).' Already Exists!!!');
            return redirect()->back()->withInput($request->all());
        }    

        //dd($arr_user_data);
        /* User Proof upload */
        $marks_input = $request->input('marks_input');
        if($request->input('marks_type')=='percentage')
        {
            if($marks_input<30 || $marks_input>100)
            {
                Flash::error('Percentage value must be between 30 to 100');
                return redirect()->back();
            }    
        }
        if($request->input('marks_type')=='cgpa')
        {
            if($marks_input<1 || $marks_input>10)
            {
                Flash::error('CGPA value must be between 1 to 10');
                return redirect()->back();
            }    
        } 
        $obj_data = $this->BaseModel->where('id','=',$id)->first(['id','profile_image']);
        if($obj_data)
        {
           $arr_data = $obj_data->toArray();
        }

        $country_id = 358;
        if($request->input('country_id')!='')
        {
            $country_id = $request->input('country_id');
        }
        $other_city = '';
        if($request->input('city_name')!='')
        {
            $other_city = $request->input('city_name');
        }
        
        $file_name = $arr_data['profile_image'];
        if($request->hasFile('profile_image'))
        {
            //$image_validation = Validator::make($request->all(),array('picture'=>'mimes:jpg,jpeg,png'));
            $fileExtension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
            $arr_file_types = ['jpg','jpeg','png','bmp'];

            //if($image_validation->passes())
            if(in_array($fileExtension, $arr_file_types))    
            {

                if(isset($arr_data) && sizeof($arr_data)>0)
                {
                    if(File::exists($this->user_profile_base_img_path.$arr_data['profile_image']))
                    {
                        @unlink($this->user_profile_base_img_path.$arr_data['profile_image']);
                    }
                }
            
                $file_name      = "default.jpg";
                $file_name      = $request->input('profile_image');
                $file_extension = strtolower($request->file('profile_image')->getClientOriginalExtension()); 
                $file_name      = sha1(uniqid().$file_name.uniqid()).'.'.$file_extension;
                $request->file('profile_image')->move($this->user_profile_base_img_path, $file_name);
            } 
            else 
            {
                Flash::error('Please upload valid image with jpg, jpeg ,png extension!!!');
                return redirect()->back();
            }
        }
        $date = $request->input('date');
        $month = $request->input('month');
        $year = $request->input('year');
        $birth_date=date('Y-m-d',strtotime($year.'-'.$month.'-'.$date));

            $arr_user_data                  = [];
            $arr_user_data['first_name']    = $request->input('first_name');
            $arr_user_data['last_name']     = $request->input('last_name');
            $arr_user_data['email']         = $request->input('email');
            $arr_user_data['profile_image'] = $file_name;
            $arr_user_data['gender']        = $request->input('gender');
            $arr_user_data['mobile_code']   = $request->input('mobile_code');
            $arr_user_data['mobile_no']     = $request->input('mobile_no');
            $arr_user_data['birth_date']    = $birth_date;
            $user_data=$this->BaseModel->where('id',$id)->update($arr_user_data);

            $arr_data=[];
            
            $arr_data['qualification_id']      = $request->input('qualification_id');
            $arr_data['passing_month']         = $request->input('passing_month');
            $arr_data['passing_year']          = $request->input('passing_year');
            $arr_data['marks_type']            = $request->input('marks_type');
            $arr_data['marks']                 = $request->input('marks_input');
            $arr_data['specialization_id']     = $request->input('specialization_id');
            $arr_data['category_id']           = $request->input('category_id');

            $arr_data['current_work_location'] = $request->input('city');
            $arr_data['other_city'] = $other_city;
            $arr_data['country_id']         = $country_id;
            $this->UserDetailModel->where('user_id',$id)->update($arr_data);

        if($user_data)
        {    
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Updated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Update','ip_address'=>$this->ip_address]));

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

    public function perform_activate($id)
    {
        $entity = $this->BaseModel->where('id',$id)->first();
        $this->UserModel->where('id',$id)->update(['is_deactivate'=>0]);
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
            event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deactivated By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Deactivate','ip_address'=>$this->ip_address]));
            return $this->BaseModel->where('id',$id)->update(['is_active'=>0]);
        }
        return FALSE;
    }

    

    public function perform_delete($id)
    {
        $entity = $this->BaseModel->where('id',$id)->first();
        if($entity)
        {
            /* Detaching Role from user Roles table */

            $user        = Sentinel::findById($id);
            $role_user = Sentinel::findRoleBySlug('user');
            $user->roles()->detach($role_user);

            if($entity->profile_image)
            {
                $unlink_path    = $this->user_profile_base_img_path.$entity->profile_image;
                @unlink($unlink_path);
            }
            $this->UserDetailModel->where('user_id',$id)->delete();
           $delete_success = $this->BaseModel->where('id',$id)->delete();
           event(new ActivityLogEvent(['activity_msg'=>str_singular($this->module_title).' Deleted By '.$this->first_name." ".$this->last_name."'",'module_title'=>$this->module_title,'module_action'=>'Delete','ip_address'=>$this->ip_address]));

           return $delete_success;
        }

        return FALSE;
    }

    public function build_select_options_array(array $arr_data,$option_key,$option_value,array $arr_default)
    {

        $arr_options = [];
        if(sizeof($arr_default)>0)
        {
            $arr_options =  $arr_default;   
        }

        if(sizeof($arr_data)>0)
        {
            foreach ($arr_data as $key => $data) 
            {
                if(isset($data[$option_key]) && isset($data[$option_value]))
                {
                    $arr_options[$data[$option_key]] = $data[$option_value];
                }
            }
        }

        return $arr_options;

    }

    public function details($enc_id)
    {
        $id = base64_decode($enc_id);
        $arr_data = [];
        $obj_data = $this->BaseModel->where('id',$id)->with(['user_profile'])->first();
        if($obj_data)
        {
            $arr_data = $obj_data->toArray();
        }

        $arr_category = [];
        $obj_category = $this->CategoryModel->get();
        if($obj_category)
        {
            $arr_category = $obj_category->toArray();
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
                                      /*->where('is_active','=',1)  */
                                      ->get();
        if($obj_state)
        {
            $arr_state = $obj_state->toArray();
        }
        //dd($arr_data);

        $this->arr_view_data['page_title']                   = "View ".str_singular($this->module_title);
        $this->arr_view_data['module_title']                 = str_plural($this->module_title);
        $this->arr_view_data['module_url_path']              = $this->module_url_path;
        $this->arr_view_data['arr_data']                     = $arr_data;
        $this->arr_view_data['arr_category']                 = $arr_category;
        $this->arr_view_data['arr_country']                  = $arr_country;
        $this->arr_view_data['arr_state']                    = $arr_state;
        $this->arr_view_data['enc_id']                       = base64_encode($id);
        $this->arr_view_data['user_profile_public_img_path'] = $this->user_profile_public_img_path;
        $this->arr_view_data['theme_color']                  = $this->theme_color;
        
        //dd($this->arr_view_data);
        return view($this->module_view_folder.'.view', $this->arr_view_data);
    }

     public function comment($enc_id)
    {
        $user_id = base64_decode($enc_id);
        $arr_member_info=[];
       /* $obj_member_info = $this->MemberDetailModel->where('user_id',$user_id)->first();*/

        $obj_member_info = $this->BaseModel->where('id',$user_id)->first();
        if($obj_member_info)
        {
            $arr_member_info = $obj_member_info->toArray();
        }

        //dd($arr_member_info);
        $this->arr_view_data['enc_id']              = $enc_id;
        $this->arr_view_data['arr_member_info']     = $arr_member_info;
        $this->arr_view_data['page_title']          = 'Admin Comment';
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

        $user_id = base64_decode($request->input('enc_id'));
        $comment = $request->input('comment');
        
        /*$comment = $this->MemberDetailModel->where('user_id',$user_id)->update(['admin_comments'=>$comment ]);*/

        $comment = $this->BaseModel->where('id',$user_id)->update(['admin_comments'=>$comment ]);
        if($comment)
        {
            Flash::success('Admin comment added Successfully.');
        }
        else
        {
            Flash::error('Error occur while storing admin comment.');
        }
        return redirect()->back();
    }

    public function approve_change(Request $request)
    {
        //dd($request->all());
        $approve_id    = $request->input('id');
        $approve_value = $request->input('approve_status');

        //dd($approve_id." ".$approve_value);
        $result = $this->UserModel->where('id',$approve_id)->update(['admin_status'=>$approve_value]);
        if($result)
        {
             Flash::success('Member A/C Activation Change Successfully.');        
             $arr_response['status']    = "SUCCESS";
        } 
        else
        {
             Flash::error('Problem Occured While Change Member A/C Activation.');
             $arr_response['status']    = "Error";
        }   
        //return json_encode($result);
        return response()->json($arr_response);
    }
}
