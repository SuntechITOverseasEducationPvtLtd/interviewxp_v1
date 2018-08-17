<?php

namespace App\Http\Middleware\Front;

use Closure;
use Sentinel;
use Session;
 
use App\Models\UserModel;
use App\Models\MemberDetailModel;
use App\Models\UserDetailModel;
use App\Models\NotificationModel;

class AuthenticateMemberMiddleware
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

        $arr_except[] =  'member/login';
        $arr_except[] =  'user/login';
        $arr_except[] =  'user/register';
        $arr_except[] =  'member/register';
        $arr_except[] =  'member/store';
        $arr_except[] =  'member/employment';
        $arr_except[] =  'member/education';
        $arr_except[] =  'member/store_employment';
        $arr_except[] =  'member/store_education';
        $arr_except[] =  'member/forgot_password_member';
        $arr_except[] =  'member/process_forgot_password';
        $arr_except[] =  'member/validate_user_reset_password_link/{enc_id}/{enc_reminder_code}';
        $arr_except[] =  'member/reset_password';
        $arr_except[] =  'member/email_verification';

        if(in_array($current_url_route, $arr_except))
        {
            $user = Sentinel::check();
            if($user && Session::has('logged_in') && Session::get('logged_in')=='user')
            {
                Sentinel::logout();
                return $next($request);   
            }
            if($user && Session::has('logged_in') && Session::get('logged_in')=='member')
            {
                return redirect('member/personal');
            }
            else
            {
                return $next($request);
            }
        }
        $arr_except[] =  'member/logout';
        $arr_except[] =  'member/login_process';
        $arr_except[] =  'member/getskills';
        $arr_except[] =  'member/get_skills';

        if(!in_array($current_url_route, $arr_except))
        {
            $user = Sentinel::check();
            /*dd($user);*/

            if($user && Session::has('logged_in') && Session::get('logged_in')=='member')
            {   
               // dd($user->is_active);
                if($user->inRole('member') && $user->is_active=="1" && $user->normal_member=='yes')
                {
                    $member_details = UserModel::where('id',$user->id)->with('member_detail')->first();
                    $member_notification = NotificationModel::where('user_id',$user->id)->where('status','=',0)->count();
                    
                    if ($member_details) 
                    {
                        $user_auth_details = array();
                        $member_details = $member_details->toArray();
                        
                        $profile_img_public_path = url('/').config('app.project.img_path.user_profile_image');

                        $user_auth_details['is_login'] = TRUE;
                        $user_auth_details['member_id'] = isset($member_details['member_detail']['id'])?$member_details['member_detail']['id']:'';
                        $user_auth_details['user_id'] = isset($member_details['id'])?$member_details['id']:'';
                        
                        $user_auth_details['first_name'] = isset($member_details['first_name'])?$member_details['first_name']:'';
                        $user_auth_details['last_name'] = isset($member_details['last_name'])?$member_details['last_name']:'';
                        $user_auth_details['profile_image'] = isset($member_details['profile_image'])?$profile_img_public_path.$member_details['profile_image']:'';
                        
                        view()->share('profile_img_public_path',$profile_img_public_path);
                        view()->share('user_auth_details',$user_auth_details);
                        view()->share('notification_count',$member_notification);  
                    }
                    return $next($request);    
                }
                else
                {
                    Sentinel::logout();
                    return redirect('member/login');
                }    
            }
            else
            {
                return redirect('member/login');
            }
            
        }
        else
        {
            return $next($request); 
        }

    }
}
