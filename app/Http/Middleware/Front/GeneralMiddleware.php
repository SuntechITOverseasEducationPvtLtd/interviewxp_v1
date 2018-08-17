<?php
namespace App\Http\Middleware\Front;

use Closure;
use Sentinel;
use Session; 

use App\Models\UserModel;
use App\Models\MemberDetailModel;
use App\Models\UserDetailModel;
use App\Models\NotificationModel;


class GeneralMiddleware
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
     
        $user = Sentinel::check();
            
            if($user)
            {
               // dd($user->is_active);
                if(Session::has('logged_in') && Session::get('logged_in')=='member')
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
                }

                if(Session::has('logged_in') && Session::get('logged_in')=='user')
                {
                    $user_details = UserModel::where('id',$user->id)->with('user_profile')->first();
                    $member_notification = NotificationModel::where('user_id',$user->id)->where('status','=',0)->count();
                   $does_member_exists = MemberDetailModel::where('user_id',$user->id)->count();
                   if($does_member_exists)
                   {
                        $member_exists = 'true';
                   }
                   else
                   {
                       $member_exists = 'false';
                   }
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
                        view()->share('member_exists',$member_exists);
                    }
                }
            } 
        return $next($request);
    }
}