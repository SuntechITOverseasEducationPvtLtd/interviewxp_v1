<?php

namespace App\Http\Middleware\Front;

use Closure;
use Sentinel;
use Session;

use App\Models\UserModel;
use App\Models\MemberDetailModel;
use App\Models\UserDetailModel;
use App\Models\NotificationModel;


class AuthenticateUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $arr_except = array();
        $current_url_route = app()->router->getCurrentRoute()->uri();
        
        $arr_except[] =  'user/login';
        $arr_except[] =  'member/login';
        $arr_except[] =  'user/register';
        $arr_except[] =  'user/store';
        $arr_except[] =  'user/forgot_password';
        $arr_except[] =  'user/process_forgot_password';
        $arr_except[] =  'user/validate_user_reset_password_link/{enc_id}/{enc_reminder_code}';
        $arr_except[] =  'user/reset_password';
        $arr_except[] =  'user/email_verification';

        if(in_array($current_url_route, $arr_except))
        {
            $user = Sentinel::check();
            if($user && Session::has('logged_in') && Session::get('logged_in')=='member')
            {
                Sentinel::logout();
                return $next($request);   
            }
            
            if($user && Session::has('logged_in') && Session::get('logged_in')=='user')
            {
                return redirect('user/profile');
            }
            else
            {
                return $next($request);
            }

        }
        $arr_except[] =  'user/login_process';
        $arr_except[] =  'user/logout';
        $arr_except[] =  'user/specialization/{qualification_id}';
        if(!in_array($current_url_route, $arr_except))
        {
            $user = Sentinel::check();
            if($user && Session::has('logged_in') && Session::get('logged_in')=='user')
            {
                if($user->inRole('user') && $user->is_active=="1")
                {
                    $user_details = UserModel::where('id',$user->id)->with('user_profile')->first();
                    $member_notification = NotificationModel::where('user_id',$user->id)->where('status','=',0)->count();
                   
                    if ($user_details) 
                    {
                        $user_auth_details = array();
                        $user_details = $user_details->toArray();

                        $profile_img_public_path = url('/').config('app.project.img_path.user_profile_image');

                        $user_auth_details['is_login'] = TRUE;
                        $user_auth_details['first_name'] = isset($user_details['first_name'])?$user_details['first_name']:'';
                        $user_auth_details['last_name'] = isset($user_details['last_name'])?$user_details['last_name']:'';
                        $user_auth_details['profile_image'] = isset($user_details['profile_image'])?$profile_img_public_path.$user_details['profile_image']:'';
                        
                        view()->share('profile_img_public_path',$profile_img_public_path);
                        view()->share('user_auth_details',$user_auth_details);
                        view()->share('notification_count',$member_notification);  
                    }
                    

                    return $next($request);    
                }

                else
                {
                    Sentinel::logout();
                    return redirect('/user/login');
                }    
            }
            else
            {
                return redirect('/user/login');
            }
            
        }
        else
        {
            return $next($request); 
        }

        
    }
}
