<?php
    

	Route::group(array('prefix' => '/member','middleware' =>['front_member','general']), function()
	{
		$route_slug       = "member";
		$module_controller = "Front\member\MemberController@";
		
		Route::get('/login',           ['as'=>$route_slug.'login',          'uses'=>'Front\AuthController@member_login']);
		Route::post('/login_process',           ['as'=>$route_slug.'login',          'uses'=>'Front\AuthController@member_validate_login']);

		Route::get('/forgot_password_member',           ['as'=>$route_slug.'forgot_password_member',          'uses'=>'Front\AuthController@forgot_password_member']);

		Route::post('/process_forgot_password',           ['as'=>$route_slug.'process_forgot_password',          'uses'=>'Front\AuthController@process_forgot_password']);

		Route::get('/validate_user_reset_password_link/{enc_id}/{enc_reminder_code}',           ['as'=>$route_slug.'validate_user_reset_password_link',          'uses'=>'Front\AuthController@validate_user_reset_password_link']);

		Route::post('/reset_password',           ['as'=>$route_slug.'reset_password',          'uses'=>'Front\AuthController@reset_password']);

		Route::get('/dashboard',           ['as'=>$route_slug.'dashboard',          'uses'=>$module_controller.'dashboard']);
		Route::get('/logout',           ['as'=>$route_slug.'logout',          'uses'=>'Front\AuthController@member_logout']);
		Route::get('/register',     ['as'=>$route_slug.'register',          'uses'=>'Front\AuthController@register']);
		Route::post('/store',     ['as'=>$route_slug.'register',          'uses'=>'Front\AuthController@store']);
		Route::get('/employment',     ['as'=>$route_slug.'employment',          'uses'=>'Front\AuthController@employment']);	
		
		Route::post('/store_employment',     ['as'=>$route_slug.'store_employment',          'uses'=>'Front\AuthController@store_employment']);
		Route::post('/update_employment',     ['as'=>$route_slug.'update_employment',          'uses'=>$module_controller.'update_employment']);
		Route::post('/update_education',     ['as'=>$route_slug.'update_education',          'uses'=>$module_controller.'update_education']);
		Route::get('/education',     ['as'=>$route_slug.'education',          'uses'=>'Front\AuthController@education']);
		Route::post('/store_education',     ['as'=>$route_slug.'store_education',          'uses'=>'Front\AuthController@store_education']);
		Route::post('/getskills',     ['as'=>$route_slug.'employment',          'uses'=>'Front\AuthController@getskills']);
		Route::get('/getmemberskills',     ['as'=>$route_slug.'employment',          'uses'=>$module_controller.'get_member_skills']);
		Route::get('/change_password',     ['as'=>$route_slug.'change_password',          'uses'=>$module_controller.'change_password']);
		Route::post('/update_password',     ['as'=>$route_slug.'update_password',          'uses'=>$module_controller.'update_password']);
		Route::post('/buy_tickets',     ['as'=>$route_slug.'buy_tickets',          'uses'=>$module_controller.'buy_tickets']);
		
		Route::get('/interviewCoach',           ['as'=>$route_slug.'interviewCoach',          'uses'=>$module_controller.'interviewCoach']);
		Route::post('/add_interviewCoach',           ['as'=>$route_slug.'add_interviewCoach',          'uses'=>$module_controller.'add_interviewCoach']);

		Route::post('/add_review',           ['as'=>$route_slug.'store_review',          'uses'=>$module_controller.'store_review']);
		
		Route::get('/personal',           ['as'=>$route_slug.'personal',          'uses'=>$module_controller.'personal']);
		Route::post('/update_personal',           ['as'=>$route_slug.'update_personal',          'uses'=>$module_controller.'update_personal']);
		Route::get('/edit_employment',           ['as'=>$route_slug.'edit_employment',          'uses'=>$module_controller.'edit_employment']);
		Route::get('/edit_education',           ['as'=>$route_slug.'edit_education',          'uses'=>$module_controller.'edit_education']);
		Route::post('/update_employment',     ['as'=>$route_slug.'update_employment',          'uses'=>$module_controller.'update_employment']);
		Route::post('/update_education',     ['as'=>$route_slug.'update_education',          'uses'=>$module_controller.'update_education']);
		Route::get('/curriculum',           ['as'=>$route_slug.'curriculum',          'uses'=>$module_controller.'curriculum']);
		Route::get('/create_curriculam',           ['as'=>$route_slug.'create_curriculam',          'uses'=>$module_controller.'create_curriculam']);
		Route::get('/edit_curriculam/{id}', ['as'=>$route_slug.'edit_curriculam', 'uses'=>$module_controller.'edit_curriculam']);
		Route::get('/delete_curriculam/{id}', ['as'=>$route_slug.'delete_curriculam', 'uses'=>$module_controller.'delete_curriculam']);

		Route::post('/store_curriculam',     ['as'=>$route_slug.'store_curriculam',          'uses'=>$module_controller.'store_curriculam']);
		Route::get('/get_curriculam/{id}',  ['as'=>$route_slug.'get_curriculam',          'uses'=>$module_controller.'get_curriculam']);
		Route::post('/update_curriculam',     ['as'=>$route_slug.'update_curriculam',          'uses'=>$module_controller.'update_curriculam']);

		Route::get('/biography',           ['as'=>$route_slug.'biography',          'uses'=>$module_controller.'biography']);
		Route::get('/mybookings/{id}',           ['as'=>$route_slug.'mybookings',          'uses'=>$module_controller.'mybookings']);

		Route::get('/curriculam', ['as'=>$route_slug.'curriculam', 'uses'=>$module_controller.'curriculam']);
		
		Route::get('/scheduleClass', ['as'=>$route_slug.'scheduleClass', 'uses'=>$module_controller.'scheduleClass']);
		Route::get('/create_schedule', ['as'=>$route_slug.'create_schedule',          'uses'=>$module_controller.'create_schedule']);
		Route::get('/edit_schedule/{id}', ['as'=>$route_slug.'edit_schedule', 'uses'=>$module_controller.'edit_schedule']);
		Route::get('/get_schedule/{id}/{scheduleId}', ['as'=>$route_slug.'get_schedule', 'uses'=>$module_controller.'get_schedule']);
		Route::get('/cancel_schedule/{scheduleId}', ['as'=>$route_slug.'cancel_schedule', 'uses'=>$module_controller.'cancel_schedule']);
		Route::post('/store_schedule',     ['as'=>$route_slug.'store_schedule',          'uses'=>$module_controller.'store_schedule']);
		Route::post('/update_schedule',     ['as'=>$route_slug.'update_schedule',          'uses'=>$module_controller.'update_schedule']);
		

		Route::get('/classEnrollments',  ['as'=>$route_slug.'classEnrollments', 'uses'=>$module_controller.'classEnrollments']);
		
		Route::get('/onlineClassEnrollments/{id}',  ['as'=>$route_slug.'onlineClassEnrollments', 'uses'=>$module_controller.'onlineClassEnrollments']);
		Route::get('/about_interview',           ['as'=>$route_slug.'about_interview',          'uses'=>$module_controller.'common']);
		Route::get('/interview_experience',           ['as'=>$route_slug.'interview_experience',          'uses'=>$module_controller.'common']);
		Route::get('/call_job_market',           ['as'=>$route_slug.'call_job_market',          'uses'=>$module_controller.'common']);
		Route::post('/common',           ['as'=>$route_slug.'common',          'uses'=>$module_controller.'update_common']);
		
		//skill section
        Route::get('/add_skill',           ['as'=>$route_slug.'add_skill',          'uses'=>$module_controller.'add_skill']);
        Route::post('/store_skill',           ['as'=>$route_slug.'store_skill',          'uses'=>$module_controller.'store_skill']);
        Route::get('/skill_delete/{id}',           ['as'=>$route_slug.'skill_delete',          'uses'=>$module_controller.'skill_delete']);

		//post interview section
        Route::get('/post_interview',           ['as'=>$route_slug.'post_interview',          'uses'=>$module_controller.'post_interview']);
        Route::get('/update-skill/{id}',           ['as'=>$route_slug.'updateSkill',          'uses'=>$module_controller.'updateSkill']);
        Route::get('/delete-skill/{id}',           ['as'=>$route_slug.'deleteSkill',          'uses'=>$module_controller.'deleteSkill']);
        Route::post('/store_interview',           ['as'=>$route_slug.'store_interview',          'uses'=>$module_controller.'store_interview']);
        Route::post('/update_interview',           ['as'=>$route_slug.'update_interview',          'uses'=>$module_controller.'update_interview']);
        Route::post('/getsubcategory',           ['as'=>$route_slug.'getsubcategory',          'uses'=>$module_controller.'getsubcategory']);
        Route::post('/getspecialization',           ['as'=>$route_slug.'getspecialization',          'uses'=>$module_controller.'getspecialization']);

        Route::post('/getmemberskills',           ['as'=>$route_slug.'getmemberskills',          'uses'=>$module_controller.'getmemberskills']);
		
		Route::get('/deactivate',     ['as'=>$route_slug.'deactivate',          'uses'=>$module_controller.'deactivate']);
		Route::post('/deactivate_account',     ['as'=>$route_slug.'deactivate_account',          'uses'=>$module_controller.'deactivate_account']);
		Route::get('/notification',     ['as'=>$route_slug.'notification',          'uses'=>$module_controller.'notification']);
		Route::get('/delete_notification/{enc_id}',     ['as'=>$route_slug.'delete_notification',          'uses'=>$module_controller.'delete_notification']);
		Route::post('/email_verification',     ['as'=>$route_slug.'email_verification',          'uses'=>'Front\AuthController@email_verification']);
		Route::get('/revenue_reports',     ['as'=>$route_slug.'revenue_reports',          'uses'=>$module_controller.'revenue_reports']);
		Route::get('/reviews',     ['as'=>$route_slug.'reviews',          'uses'=>$module_controller.'reviewsNew']);
		Route::get('/upload_history',     ['as'=>$route_slug.'upload_history',          'uses'=>$module_controller.'upload_history']);
		Route::get('/manage_upload_history',     ['as'=>$route_slug.'upload_history',          'uses'=>$module_controller.'upload_history']);
		Route::get('/real_time_experience',     ['as'=>$route_slug.'real_time_experience',          'uses'=>$module_controller.'real_time_experience']);
		Route::post('/store_real_time_experience',     ['as'=>$route_slug.'store_real_time_experience',          'uses'=>$module_controller.'store_real_time_experience']);
		Route::get('/listing_real_time_experience',     ['as'=>$route_slug.'listing_real_time_experience',          'uses'=>$module_controller.'listing_real_time_experience']);
		Route::post('/create_reference_book',     ['as'=>$route_slug.'create_reference_book',          'uses'=>$module_controller.'create_reference_book']);
		Route::get('/delete_interview/{int_id}',     ['as'=>$route_slug.'delete_interview',          'uses'=>$module_controller.'delete_interview']);
		Route::get('/delete_interview_all/{int_id}',     ['as'=>$route_slug.'delete_interview_all',          'uses'=>$module_controller.'delete_interview_all']);
		Route::get('/delete_reference_book/{int_id}',     ['as'=>$route_slug.'delete_reference_book',          'uses'=>$module_controller.'delete_reference_book']);
		Route::get('/delete_reference_book_all/{int_id}',     ['as'=>$route_slug.'delete_reference_book_all',          'uses'=>$module_controller.'delete_reference_book_all']);
		Route::get('/freePreview/{int_id}',     ['as'=>$route_slug.'freePreview',          'uses'=>$module_controller.'freePreview']); // Ramakrishna
		Route::get('/freePreviewCompany/{enc_id}/{real_id}', ['as'=>$route_slug.'freePreviewCompany', 'uses'=>$module_controller.'freePreviewCompany']); // Ramakrishna
		Route::get('/delete_realtime/{enc_id}/{real_id}',     ['as'=>$route_slug.'delete_realtime_work_experience',          'uses'=>$module_controller.'delete_realtime_work_experience']);
		Route::get('/delete_realtime_all/{enc_id}/{real_id}',     ['as'=>$route_slug.'delete_realtime_work_experience_all',          'uses'=>$module_controller.'delete_realtime_work_experience_all']);
		Route::get('/freePreviewReal/{enc_id}/{real_id}',     ['as'=>$route_slug.'freePreviewReal',          'uses'=>$module_controller.'freePreviewReal']);
		Route::post('/update_realtime_attachment',     ['as'=>$route_slug.'update_realtime_attachment',          'uses'=>$module_controller.'update_realtime_attachment']);

		// alert member section........
		 Route::get('/create_alert',           ['as'=>$route_slug.'create_alert',          'uses'=>$module_controller.'create_alert']);
		 Route::get('/manage_alert',           ['as'=>$route_slug.'manage_alert',          'uses'=>$module_controller.'manage_alert']);
		 
		 Route::post('/store_alerts',           ['as'=>$route_slug.'store_alerts',          'uses'=>$module_controller.'store_alerts']);
		 Route::get('/view_alert/{enc_id}',           ['as'=>$route_slug.'view_alert',          'uses'=>$module_controller.'view_alert']);

		  Route::get('/edit_alert/{enc_id}',           ['as'=>$route_slug.'edit_alert',          'uses'=>$module_controller.'edit_alert']);
         Route::post('/update_alert',           ['as'=>$route_slug.'update_alert',          'uses'=>$module_controller.'update_alert']);
         Route::get('/delete_alert/{enc_id}',           ['as'=>$route_slug.'delete_alert',          'uses'=>$module_controller.'delete_alert']);
         Route::post('multi_action',		 ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);
         Route::post('/store_company',           ['as'=>$route_slug.'store_company',          'uses'=>$module_controller.'store_company']);
         Route::post('/update_company',           ['as'=>$route_slug.'update_company',          'uses'=>$module_controller.'update_company']);
        Route::get('/purchase_history',           ['as'=>$route_slug.'purchase_history',          'uses'=>$module_controller.'purchase_history']);
        Route::get('/view_purchase/{enc_id}',           ['as'=>$route_slug.'view_purchase',          'uses'=>$module_controller.'view_purchase']);
        Route::get('/learn',           ['as'=>$route_slug.'learn',          'uses'=>$module_controller.'purchase_history']);
        Route::get('/view_revenue_report/{enc_id}',           ['as'=>$route_slug.'view_revenue_report',          'uses'=>$module_controller.'view_revenue_report']);
        Route::post('multi_action_purchase',		 ['as' => $route_slug.'multi_action_purchase','uses' => $module_controller.'multi_action_purchase']);
        Route::get('/delete_purchase/{enc_id}',           ['as'=>$route_slug.'delete_purchase',          'uses'=>$module_controller.'delete_purchase']);
         Route::get('/view_learn/{enc_id}/{type}',           ['as'=>$route_slug.'view_learn',          'uses'=>$module_controller.'view_learn']);
         Route::post('multi_action_notification',		 ['as' => $route_slug.'multi_action_notification','uses' => $module_controller.'multi_action_notification']);
       
	});