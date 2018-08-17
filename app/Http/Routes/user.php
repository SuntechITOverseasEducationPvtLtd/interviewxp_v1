<?php
     Route::group(array('prefix' => '/user','middleware' =>['front_user','general']), function()
	{
		$route_slug       = "user";
		$module_controller = "Front\user\UserController@";
		
		Route::get('/login',           		['as'=>'userlogin',          'uses'=>'Front\AuthController@user_login']);
		
		Route::post('/login_process',           ['as'=>$route_slug.'login',          'uses'=>'Front\AuthController@user_validate_login']);

		Route::get('/forgot_password',           ['as'=>$route_slug.'forgot_password',          'uses'=>'Front\AuthController@forgot_password']);

		Route::post('/process_forgot_password',           ['as'=>$route_slug.'process_forgot_password',          'uses'=>'Front\AuthController@process_forgot_password']);

		Route::get('/validate_user_reset_password_link/{enc_id}/{enc_reminder_code}',           ['as'=>$route_slug.'validate_user_reset_password_link',          'uses'=>'Front\AuthController@validate_user_reset_password_link']);

		Route::post('/reset_password',           ['as'=>$route_slug.'reset_password',          'uses'=>'Front\AuthController@reset_password']);
		
		Route::get('/logout',           ['as'=>$route_slug.'logout',          'uses'=>'Front\AuthController@user_logout']);
		Route::get('/dashboard',           ['as'=>$route_slug.'dashboard',          'uses'=>$module_controller.'dashboard']);
		Route::get('/register',     ['as'=>$route_slug.'register',          'uses'=>'Front\AuthController@user_register']);
		Route::get('specialization/{qualification_id}',     ['as'=>$route_slug.'specialization',          'uses'=>'Front\HomeController@get_specialization']);

		Route::post('/store',     ['as'=>$route_slug.'register',          'uses'=>'Front\AuthController@user_store']);
		Route::get('/change_password',     ['as'=>$route_slug.'change_password',          'uses'=>$module_controller.'change_password']);
		Route::get('/buy_tickets',     ['as'=>$route_slug.'buy_tickets',          'uses'=>$module_controller.'buy_tickets']);

		Route::post('/update_password',     ['as'=>$route_slug.'update_password',          'uses'=>$module_controller.'update_password']);
		Route::get('/profile',     ['as'=>$route_slug.'profile',          'uses'=>$module_controller.'profile']);	
		Route::post('/update_profile',     ['as'=>$route_slug.'profile',          'uses'=>$module_controller.'update_profile']);
		
		Route::get('/deactivate',     ['as'=>$route_slug.'deactivate',          'uses'=>$module_controller.'deactivate']);
		Route::post('/deactivate_account',     ['as'=>$route_slug.'deactivate_account',          'uses'=>$module_controller.'deactivate_account']);
		Route::get('/notification',     ['as'=>$route_slug.'notification',          'uses'=>$module_controller.'notification']);
		Route::get('/delete_notification/{enc_id}',     ['as'=>$route_slug.'delete_notification',          'uses'=>$module_controller.'delete_notification']);
		Route::get('/become_member',     ['as'=>$route_slug.'become_member',          'uses'=>$module_controller.'become_member']);
		Route::post('/email_verification',     ['as'=>$route_slug.'email_verification',          'uses'=>'Front\AuthController@email_verification']);
		
		//alert section
        Route::get('/manage_alert',           ['as'=>$route_slug.'manage_alert',          'uses'=>$module_controller.'manage_alert']);
        Route::get('/create_alert',           ['as'=>$route_slug.'create_alert',          'uses'=>$module_controller.'create_alert']);
        
        Route::get('/learnlist',           ['as'=>$route_slug.'learnlist',          'uses'=>'Front\HomeController@learnlist']);
        
      Route::get('/deletelearnlist/{enc_id}',           ['as'=>$route_slug.'deletelearnlist',          'uses'=>'Front\HomeController@deletelearnlist']);
        
        Route::post('/getskills',     ['as'=>$route_slug.'getskills',          'uses'=>'Front\AuthController@getskills']);
        Route::post('/store_alerts',           ['as'=>$route_slug.'store_alerts',          'uses'=>$module_controller.'store_alerts']);
        Route::get('/edit_alert/{enc_id}',           ['as'=>$route_slug.'edit_alert',          'uses'=>$module_controller.'edit_alert']);
         Route::post('/update_alert',           ['as'=>$route_slug.'update_alert',          'uses'=>$module_controller.'update_alert']);
         Route::get('/delete_alert/{enc_id}',           ['as'=>$route_slug.'delete_alert',          'uses'=>$module_controller.'delete_alert']);
         Route::get('/view_alert/{enc_id}',           ['as'=>$route_slug.'view_alert',          'uses'=>$module_controller.'view_alert']);
         Route::post('multi_action',		 ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);
         Route::get('/purchase_history',     ['as'=>$route_slug.'purchase_history',          'uses'=>$module_controller.'purchase_history']);	
         Route::get('/view_purchase/{enc_id}',           ['as'=>$route_slug.'view_purchase',          'uses'=>$module_controller.'view_purchase']);
         Route::post('multi_action_purchase',		 ['as' => $route_slug.'multi_action_purchase','uses' => $module_controller.'multi_action_purchase']);
        Route::get('/delete_purchase/{enc_id}',           ['as'=>$route_slug.'delete_purchase',          'uses'=>$module_controller.'delete_purchase']);

        Route::get('/learn',           ['as'=>$route_slug.'learn',          'uses'=>$module_controller.'purchase_history']);
        Route::get('/view_learn/{enc_id}/{type}',           ['as'=>$route_slug.'view_learn',          'uses'=>$module_controller.'view_learn']);

         Route::post('multi_action_notification',		 ['as' => $route_slug.'multi_action_notification','uses' => $module_controller.'multi_action_notification']);
         Route::post('/usercheck',     ['as'=>$route_slug.'getskills',          'uses'=>'Front\AuthController@usercheck']);
	});
