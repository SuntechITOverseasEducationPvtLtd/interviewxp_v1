<?php

$admin_path = config('app.project.admin_panel_slug');
/* Admin Routes */
	Route::group(['prefix' => $admin_path,'middleware'=>['admin']], function () 
	{
		$route_slug       = "admin_auth_";
		$module_controller = "Admin\AuthController@";

		/*---------------------- Admin Common-function Related ------------------------------*/

		/* Admin Auth Routes Starts */

		Route::get('/',               ['as'=>$route_slug.'login',          'uses'=>$module_controller.'login']);	
		Route::get('login',           ['as'=>$route_slug.'login',          'uses'=>$module_controller.'login']);	
		Route::post('process_login',  ['as'=>$route_slug.'process_login',  'uses'=>$module_controller.'process_login']);	
		Route::get('change_password', ['as'=>$route_slug.'change_password','uses'=>$module_controller.'change_password']);	
		Route::post('update_password',['as'=>$route_slug.'change_password','uses'=>$module_controller.'update_password']);	
		Route::post('process_forgot_password',['as'=>$route_slug.'forgot_password','uses'=>$module_controller.'process_forgot_password']);
		Route::get('validate_admin_reset_password_link/{enc_id}/{enc_reminder_code}', 	['as'=>$route_slug.'validate_admin_reset_password_link', 'uses' => $module_controller.'validate_reset_password_link']);
		Route::post('reset_password',['as'=>$route_slug.'reset_passsword','uses'=>$module_controller.'reset_password']);
		
		/* Dashboard */
		Route::get('/dashboard',['as'=>$route_slug.'dashboard','uses'=>'Admin\DashboardController@index']);	
		Route::get('/logout',   ['as'=>$route_slug.'logout',   'uses'=>$module_controller.'logout']);	

		/* Account Settings*/

		$account_setting_controller = "Admin\AccountSettingsController@";

		Route::get('account_settings',                  ['as' => $route_slug.'account_settings_show',   'uses' => $account_setting_controller.'index']);
		Route::post('account_settings/update/{enc_id}', ['as' => $route_slug.'account_settings_update', 'uses' => $account_setting_controller.'update']);
		Route::get('manage_email',                  ['as' => $route_slug.'manage_email_show',   'uses' => $account_setting_controller.'manage_email']);
		Route::post('account_settings/update_manage_email/{enc_id}', ['as' => $route_slug.'update_manage_email_update', 'uses' => $account_setting_controller.'update_manage_email']);

		Route::group(array('prefix' => '/countries'), function()
		{
			$route_slug       = "admin_countries_";
			$module_controller = "Admin\CountryController@";

			Route::get('/',					 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
			Route::get('show/{enc_id}',		 ['as' => $route_slug.'show',		  'uses' => $module_controller.'show']);
			Route::get('edit/{enc_id}',		 ['as' => $route_slug.'edit',	      'uses' => $module_controller.'edit']);
			Route::post('update/{enc_id}',	 ['as' => $route_slug.'update',	  'uses' => $module_controller.'update']);
			Route::get('create',			 ['as' => $route_slug.'create', 	  'uses' => $module_controller.'create']);
			Route::any('store',				 ['as' => $route_slug.'store',	  	  'uses' => $module_controller.'store']);
			Route::get('delete/{enc_id}',	 ['as' => $route_slug.'delete',	  'uses' => $module_controller.'delete']);
			Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',    'uses' => $module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',  'uses' => $module_controller.'deactivate']);
			Route::post('multi_action',		 ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);
		});

		/*--------------------------------------------Activity_log----------------------*/

		Route::group(array('prefix' => '/activity_logs'), function()
		{
			$route_slug        = "activity_logs_";
			$module_controller = "Admin\ActivityLogController@";

			Route::get('/',['as' => $route_slug.'index', 'uses' => $module_controller.'index']);
			Route::get('/get_records',['as' => $route_slug.'get_records', 'uses' => $module_controller.'get_records']);

	 	});

	 	/*-----------------------Contact Enquiry---------------------------------------*/

			Route::group(array('prefix'=>'/contact_enquiry'), function () 
			{
				$route_slug       = "admin_contact_enquiry_";
				$route_controller = "Admin\ContactEnquiryController@";

				Route::get('/',['as' => $route_slug.'index',
								'uses' => $route_controller.'index']);

				Route::get('/view/{enc_id}',['as' => $route_slug.'details',
											 'uses' => $route_controller.'view']);

				Route::get('delete/{enc_id}',['as' => $route_slug.'delete',
											  'uses' => $route_controller.'delete']);

				Route::post('multi_action',['as'=> $route_slug.'multi_action',
											'uses'=> $route_controller.'multi_action']);	
			});

			/*----------------------Admin - FAQ Module-------------------------------------*/

		Route::group(array('prefix' => '/faq'), function()
		{
			$route_slug       = 'admin_faq_';
			$route_controller = 'Admin\FAQController@';

			Route::get('/',['as' => $route_slug.'index', 
							'uses' => $route_controller.'index']);
			
			Route::get('/create',['as' => $route_slug.'create', 
								  'uses' => $route_controller.'create']);

			Route::post('/store',['as' => $route_slug.'store', 
								  'uses' => $route_controller.'store']);

			Route::get('/edit/{enc_id}',['as' => $route_slug.'edit', 
										 'uses' => $route_controller.'edit']);

			Route::post('/update/{enc_id}',['as' => $route_slug.'update', 
										 	'uses' => $route_controller.'update']);

			Route::get('/delete/{enc_id}',['as' => $route_slug.'edit', 
										   'uses' => $route_controller.'delete']);

			Route::get('activate/{enc_id}',['as' => $route_slug.'activate',
											'uses' => $route_controller.'activate']);	

			Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',
											  'uses' => $route_controller.'deactivate']);

			Route::post('multi_action',['as' => $route_slug.'multi_action',
										'uses' => $route_controller.'multi_action']);
	 		
		});

		/*----------------------------------------------------------------------------------------
			Admin Roles
		----------------------------------------------------------------------------------------*/

			Route::group(array('prefix' => '/admin_users'), function()
			{
				$route_slug       = "admin_users_";
				$module_controller = "Admin\AdminUserController@";

				Route::get('/',				   ['as' => $route_slug.'index',  'uses' => $module_controller.'index']);
				Route::get('/create',		   ['as' => $route_slug.'create', 'uses' => $module_controller.'create']);
				Route::post('/store',		   ['as' => $route_slug.'store',  'uses' => $module_controller.'store']);
				Route::get('/edit/{enc_id}',   ['as' => $route_slug.'edit',   'uses' => $module_controller.'edit']);
				Route::post('/update/{enc_id}',['as' => $route_slug.'update', 'uses' => $module_controller.'update']);
				Route::get('/delete/{enc_id}', ['as' => $route_slug.'edit',   'uses' => $module_controller.'delete']);
		 		
			});

		/*---------------------------------------------------------------------------------------
			End
		-----------------------------------------------------------------------------------------*/

		/*------------------------- Admin States Routes ------------------------------*/

		Route::group(['prefix'=>'state'],function()
		{
			$route_slug       = "admin_state_";
			$module_controller = "Admin\StateController@";

			Route::get('/',                       ['as'=>$route_slug.'index',		 	  'uses'=>$module_controller.'index']);		
			Route::get('create/',        ['as'=>$route_slug.'create',		 	  'uses'=>$module_controller.'create']);	
			Route::post('store',                  ['as'=>$route_slug.'store',	 	 	  'uses'=>$module_controller.'store']);	
			Route::get('edit/{enc_id}',           ['as'=>$route_slug.'edit',		 	  'uses'=>$module_controller.'edit']);	
			Route::post('update/',        ['as'=>$route_slug.'update',		 	  'uses'=>$module_controller.'update']);	
			Route::get('delete/{enc_id}',         ['as'=>$route_slug.'delete',		 	  'uses'=>$module_controller.'delete']);	
			Route::get('activate/{enc_id}',       ['as'=>$route_slug.'activate',	 	  'uses'=>$module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);	
			Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);	
				

		});

		/*------------------------- Admin city Routes ------------------------------*/

		Route::group(['prefix'=>'city'],function()
		{
			$route_slug       = "admin_city_";
			$module_controller = "Admin\CityController@";

			Route::get('/',                       ['as'=>$route_slug.'index',		 	  'uses'=>$module_controller.'index']);	
			Route::get('create/',        ['as'=>$route_slug.'create',		 	  'uses'=>$module_controller.'create']);	
			Route::post('store',                  ['as'=>$route_slug.'store',	 	 	  'uses'=>$module_controller.'store']);	
			Route::get('edit/{enc_id}',           ['as'=>$route_slug.'edit',		 	  'uses'=>$module_controller.'edit']);	
			Route::post('update/',        ['as'=>$route_slug.'update',		 	  'uses'=>$module_controller.'update']);	
			Route::get('delete/{enc_id}',         ['as'=>$route_slug.'delete',		 	  'uses'=>$module_controller.'delete']);	
			Route::get('activate/{enc_id}',       ['as'=>$route_slug.'activate',	 	  'uses'=>$module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);	
			Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);	
				

		});


		/*----------------------------------------------------------------------------------------
			Static Pages - CMS
		----------------------------------------------------------------------------------------*/

			Route::group(array('prefix' => '/static_pages'), function()
			{
				$route_slug       = "static_pages_";
				$module_controller = "Admin\StaticPageController@";

				Route::get('/', 				 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
				Route::get('create',			 ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
				Route::get('edit/{enc_id}',		 ['as' => $route_slug.'edit',		  'uses' => $module_controller.'edit']);
				Route::any('store',				 ['as' => $route_slug.'store',		  'uses' => $module_controller.'store']);
				Route::post('update/',	 ['as' => $route_slug.'update',	  'uses' => $module_controller.'update']);
				Route::get('delete/{enc_id}',	 ['as' => $route_slug.'delete',	  'uses' => $module_controller.'delete']);	
				Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',	  'uses' => $module_controller.'activate']);	
				Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',  'uses' => $module_controller.'deactivate']);	
				Route::post('multi_action',		 ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);	


			});

			

		/*---------------------------------------------------------------------------------------
			End
		-----------------------------------------------------------------------------------------*/

		/*------------------------- Admin Categories Routes ------------------------------*/

		Route::group(['prefix'=>'categories'],function()
		{
			$route_slug       = "admin_category_";
			$module_controller = "Admin\CategoryController@";

			Route::get('/',                       ['as'=>$route_slug.'index',		 	  'uses'=>$module_controller.'index']);		
			Route::get('create/',        ['as'=>$route_slug.'create',		 	  'uses'=>$module_controller.'create']);	
			Route::post('store',                  ['as'=>$route_slug.'store',	 	 	  'uses'=>$module_controller.'store']);	
			Route::get('edit/{enc_id}',           ['as'=>$route_slug.'edit',		 	  'uses'=>$module_controller.'edit']);	
			Route::post('update/',        ['as'=>$route_slug.'update',		 	  'uses'=>$module_controller.'update']);	
			Route::get('delete/{enc_id}',         ['as'=>$route_slug.'delete',		 	  'uses'=>$module_controller.'delete']);	
			Route::get('activate/{enc_id}',       ['as'=>$route_slug.'activate',	 	  'uses'=>$module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);	
			Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);	
				

		});


		/*----------------------------------------------------------------------------------------
			Admin Cmpany Routes
		----------------------------------------------------------------------------------------*/

			Route::group(array('prefix' => '/company'), function()
			{
				$route_slug       = "company_";
				$module_controller = "Admin\CompanyController@";

				Route::get('/', 				 ['as' => $route_slug.'manage',	  'uses' => $module_controller.'index']);
				Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',	  'uses' => $module_controller.'activate']);	
				Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',  'uses' => $module_controller.'deactivate']);
				Route::get('delete/{enc_id}',	 ['as' => $route_slug.'delete',	  'uses' => $module_controller.'delete']);
				Route::post('multi_action',		 ['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);	
				Route::get('create',			 ['as' => $route_slug.'create',	  'uses' => $module_controller.'create']);
				Route::any('store',				 ['as' => $route_slug.'store',		  'uses' => $module_controller.'store']);
				Route::get('edit/{enc_id}',		 ['as' => $route_slug.'edit',		  'uses' => $module_controller.'edit']);	
				Route::post('update/',	 ['as' => $route_slug.'update',	  'uses' => $module_controller.'update']);	
			
			});

			

		/*---------------------------------------------------------------------------------------
			End
		-----------------------------------------------------------------------------------------*/

		/*------------------------- Admin SubCategories Routes ------------------------------*/

		Route::group(['prefix'=>'subcategories'],function()
		{
			$route_slug       = "admin_subcategory_";
			$module_controller = "Admin\SubCategoryController@";

			Route::get('/',                       ['as'=>$route_slug.'index',		 	  'uses'=>$module_controller.'index']);	
			Route::get('create/',        ['as'=>$route_slug.'create',		 	  'uses'=>$module_controller.'create']);	
			Route::post('store',                  ['as'=>$route_slug.'store',	 	 	  'uses'=>$module_controller.'store']);	
			Route::get('edit/{enc_id}',           ['as'=>$route_slug.'edit',		 	  'uses'=>$module_controller.'edit']);	
			Route::post('update/',        ['as'=>$route_slug.'update',		 	  'uses'=>$module_controller.'update']);	
			Route::get('delete/{enc_id}',         ['as'=>$route_slug.'delete',		 	  'uses'=>$module_controller.'delete']);	
			Route::get('activate/{enc_id}',       ['as'=>$route_slug.'activate',	 	  'uses'=>$module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);
			Route::get('get_subcategory/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);	
			Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);	
				

		});

		/*------------------------- Admin Qualification Routes ------------------------------*/

		Route::group(['prefix'=>'qualification'],function()
		{
			$route_slug       = "admin_qualification_";
			$module_controller = "Admin\QualificationController@";

			Route::get('/',                       ['as'=>$route_slug.'index',		 	  'uses'=>$module_controller.'index']);		
			Route::get('create/',        ['as'=>$route_slug.'create',		 	  'uses'=>$module_controller.'create']);	
			Route::post('store',                  ['as'=>$route_slug.'store',	 	 	  'uses'=>$module_controller.'store']);	
			Route::get('edit/{enc_id}',           ['as'=>$route_slug.'edit',		 	  'uses'=>$module_controller.'edit']);	
			Route::post('update/',        ['as'=>$route_slug.'update',		 	  'uses'=>$module_controller.'update']);	
			Route::get('delete/{enc_id}',         ['as'=>$route_slug.'delete',		 	  'uses'=>$module_controller.'delete']);	
			Route::get('activate/{enc_id}',       ['as'=>$route_slug.'activate',	 	  'uses'=>$module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);	
			Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);	
				

		});

		/*------------------------- Admin Specialization Routes ------------------------------*/

		Route::group(['prefix'=>'specialization'],function()
		{
			$route_slug       = "admin_specialization_";
			$module_controller = "Admin\SpecializationController@";

			Route::get('/',                       ['as'=>$route_slug.'index',		 	  'uses'=>$module_controller.'index']);	
			Route::get('create/',        ['as'=>$route_slug.'create',		 	  'uses'=>$module_controller.'create']);	
			Route::post('store',                  ['as'=>$route_slug.'store',	 	 	  'uses'=>$module_controller.'store']);	
			Route::get('edit/{enc_id}',           ['as'=>$route_slug.'edit',		 	  'uses'=>$module_controller.'edit']);	
			Route::post('update/',        ['as'=>$route_slug.'update',		 	  'uses'=>$module_controller.'update']);	
			Route::get('delete/{enc_id}',         ['as'=>$route_slug.'delete',		 	  'uses'=>$module_controller.'delete']);	
			Route::get('activate/{enc_id}',       ['as'=>$route_slug.'activate',	 	  'uses'=>$module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);	
			Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);
			Route::get('get_specialization/{enc_id}',       ['as'=>$route_slug.'specialization','uses'=>$module_controller.'get_specialization']);

				

		});

		/*------------------------- Admin Advertisement Routes ------------------------------*/

		Route::group(['prefix'=>'advertisement'],function()
		{
			$route_slug       = "admin_advertisement_";
			$module_controller = "Admin\AdvertisementController@";

			Route::get('/',                       ['as'=>$route_slug.'index',		 	  'uses'=>$module_controller.'index']);	
			Route::get('create/',        ['as'=>$route_slug.'create',		 	  'uses'=>$module_controller.'create']);	
			Route::post('store',                  ['as'=>$route_slug.'store',	 	 	  'uses'=>$module_controller.'store']);	
			Route::get('edit/{enc_id}/{advt_slug}',           ['as'=>$route_slug.'edit',		 	  'uses'=>$module_controller.'edit']);	
			Route::post('update/',        ['as'=>$route_slug.'update',		 	  'uses'=>$module_controller.'update']);	
			Route::get('delete/{enc_id}',         ['as'=>$route_slug.'delete',		 	  'uses'=>$module_controller.'delete']);	
			Route::get('activate/{enc_id}',       ['as'=>$route_slug.'activate',	 	  'uses'=>$module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);	
			Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);	
				

		});

		/*------------------------- Admin Price List Routes ------------------------------*/
		Route::group(['prefix'=>'price_list'],function()
		{
			$route_slug       = "admin_price_list_";
			$module_controller = "Admin\PriceListController@";

			Route::get('/',                       ['as'=>$route_slug.'index',		 	  'uses'=>$module_controller.'index']);
			Route::get('edit/{enc_id}',           ['as'=>$route_slug.'edit',		 	  'uses'=>$module_controller.'edit']);	
			Route::post('update/',        ['as'=>$route_slug.'update',		 	  'uses'=>$module_controller.'update']);	
			Route::get('activate/{enc_id}',       ['as'=>$route_slug.'activate',	 	  'uses'=>$module_controller.'activate']);	
			Route::get('deactivate/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);	
			Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);	

		});


		/*------------------------- End Admin Price List Routes ------------------------------*/

		/*----------------------------------------------------------------------------------------
			User Module
		----------------------------------------------------------------------------------------*/

			Route::group(array('prefix' => '/users'), function()
			{	
				$route_slug       = "admin_students_";
				$module_controller = "Admin\UserController@";

				Route::get('/',					['as' => $route_slug.'index',		 'uses' => $module_controller.'index']);
				Route::get('create/',			['as' => $route_slug.'create',		 'uses' => $module_controller.'create']);
				Route::post('store/',			['as' => $route_slug.'store',		 'uses' => $module_controller.'store']);
				Route::get('edit/{enc_id}',		['as' => $route_slug.'edit',		 'uses' => $module_controller.'edit']);
				Route::post('update',			['as' => $route_slug.'update',		 'uses' => $module_controller.'update']);
				Route::get('activate/{enc_id}', ['as' => $route_slug.'activate',	 'uses' => $module_controller.'activate']);	
				Route::get('deactivate/{enc_id}',['as'=> $route_slug.'deactivate',	 'uses' => $module_controller.'deactivate']);
				Route::post('multi_action', 	['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);
				Route::get('delete/{enc_id}',	['as' => $route_slug.'update',		 'uses' => $module_controller.'delete']);
				Route::get('details/{enc_id}',   ['as' => $route_slug.'update',		 'uses' => $module_controller.'details']);
				Route::get('/comment/{enc_id}',					['as' => $route_slug.'comment',		 'uses' => $module_controller.'comment']);
				Route::post('/store_comment',					['as' => $route_slug.'store_comment',		 'uses' => $module_controller.'store_comment']);
				Route::post('approve_change/',     ['as'=>$route_slug.'approve_change',	 	  'uses'=>$module_controller.'approve_change']);
				Route::get('profiles/',			['as' => $route_slug.'profiles',		 'uses' => $module_controller.'profiles']);
			
			});

		/*---------------------------------------------------------------------------------------
			End
		-----------------------------------------------------------------------------------------*/

		/*----------------------------------------------------------------------------------------
			Member Module
		----------------------------------------------------------------------------------------*/

			Route::group(array('prefix' => '/members'), function()
			{	
				$route_slug       = "admin_members_";
				$module_controller = "Admin\MemberController@";

				Route::get('/',					['as' => $route_slug.'index',		 'uses' => $module_controller.'index']);
				Route::get('create/',			['as' => $route_slug.'create',		 'uses' => $module_controller.'create']);
				Route::get('employment/{member_id}',			['as' => $route_slug.'create',		 'uses' => $module_controller.'employment']);
				Route::any('edit_employment/{enc_id}',			['as' => $route_slug.'edit',		 'uses' => $module_controller.'edit_employment']);
				Route::get('education/{mem_id}',			['as' => $route_slug.'create','uses' => $module_controller.'education']);
				Route::get('edit_education/{mem_id}',			['as' => $route_slug.'edit',		 'uses' => $module_controller.'edit_education']);
				Route::post('store/',			['as' => $route_slug.'store',		 'uses' => $module_controller.'store']);
				Route::post('store_employment/',			['as' => $route_slug.'store',		 'uses' => $module_controller.'store_employment']);
				Route::post('store_education/',			['as' => $route_slug.'store',		 'uses' => $module_controller.'store_education']);
				Route::get('edit/{enc_id}',		['as' => $route_slug.'edit',		 'uses' => $module_controller.'edit_personal']);
				Route::get('get_skills',		['as' => $route_slug.'edit',		 'uses' => $module_controller.'get_skills']);
				Route::post('update',			['as' => $route_slug.'update',		 'uses' => $module_controller.'update']);
				Route::get('activate/{enc_id}', ['as' => $route_slug.'activate',	 'uses' => $module_controller.'activate']);	
				Route::get('deactivate/{enc_id}',['as'=> $route_slug.'deactivate',	 'uses' => $module_controller.'deactivate']);
				Route::post('multi_action', 	['as' => $route_slug.'multi_action','uses' => $module_controller.'multi_action']);
				Route::get('delete/{enc_id}',	['as' => $route_slug.'update',		 'uses' => $module_controller.'delete']);
				Route::get('details/{enc_id}',	['as' => $route_slug.'details',		 'uses' => $module_controller.'details']);
				Route::get('getDownload/{enc_id}',	['as' => $route_slug.'getDownload',		 'uses' => $module_controller.'getDownload']);
				Route::get('/comment/{enc_id}',					['as' => $route_slug.'comment',		 'uses' => $module_controller.'comment']);
				Route::post('/store_comment',					['as' => $route_slug.'store_comment',		 'uses' => $module_controller.'store_comment']);
				Route::post('approve_change/',     ['as'=>$route_slug.'approve_change',	 	  'uses'=>$module_controller.'approve_change']);
				Route::get('profiles/',			['as' => $route_slug.'profiles',		 'uses' => $module_controller.'index']);
				Route::get('upload_approvals/',			['as' => $route_slug.'upload_approvals',		 'uses' => $module_controller.'upload_approvals']);

				Route::get('comment_upload_approvals/{enc_id}/{comment_status}',			['as' => $route_slug.'comment_upload_approvals',		 'uses' => $module_controller.'comment_upload_approvals']);

				Route::post('/store_upload_approvals_comment',					['as' => $route_slug.'store_upload_approvals_comment',		 'uses' => $module_controller.'store_upload_approvals_comment']);
				Route::post('upload_approve_change/',     ['as'=>$route_slug.'upload_approve_change',	 	  'uses'=>$module_controller.'upload_approve_change']);
				Route::post('update_company/',     ['as'=>$route_slug.'update_company',	 	  'uses'=>$module_controller.'update_company']);

				Route::get('upload_approve_details/{enc_id}',			['as' => $route_slug.'upload_approve_details',		 'uses' => $module_controller.'upload_approve_details']);

				Route::get('deactivate_upload_approve/{enc_id}',     ['as'=>$route_slug.'deactivate_upload_approve',	 	  'uses'=>$module_controller.'deactivate_upload_approve']);

				Route::get('activate_upload_approve/{enc_id}',     ['as'=>$route_slug.'activate_upload_approve',	 	  'uses'=>$module_controller.'activate_upload_approve']);
				Route::post('multi_action_upload_approve', 	['as' => $route_slug.'multi_action_upload_approve','uses' => $module_controller.'multi_action_upload_approve']);
				Route::get('upload_approve_details/{enc_id}',			['as' => $route_slug.'upload_approve_details',		 'uses' => $module_controller.'upload_approve_details']);
				Route::post('upload_approve_admin_change/',     ['as'=>$route_slug.'upload_approve_admin_change',	 	  'uses'=>$module_controller.'upload_approve_admin_change']);
				Route::post('part_approve_admin_change/',     ['as'=>$route_slug.'part_approve_admin_change',	 	  'uses'=>$module_controller.'part_approve_admin_change']);
				Route::get('/delete_reference_book/{int_id}/{interview_id}',     ['as'=>$route_slug.'delete_reference_book',          'uses'=>$module_controller.'delete_reference_book']);
				Route::get('/delete_interview/{int_id}/{interview_id}/{user_id}',     ['as'=>$route_slug.'delete_interview',          'uses'=>$module_controller.'delete_interview']);
				Route::get('/delete_realtime/{issue_title}/{interview_id}/{enc_id}',     ['as'=>$route_slug.'delete_realtime_work_experience',          'uses'=>$module_controller.'delete_realtime_work_experience']);
				
				
			});

		/*---------------------------------------------------------------------------------------
			End
		-----------------------------------------------------------------------------------------*/
		
		/*----------------------------------------------------------------------------------------
			iterview
		----------------------------------------------------------------------------------------*/

			Route::group(array('prefix' => '/interviews'), function()
			{	
				$route_slug       = "interviews";
				$module_controller = "Admin\InterviewController@";

				Route::get('/',					['as' => $route_slug.'index',		 'uses' => $module_controller.'index']);
				Route::get('/member_interviews/{enc_id}',					['as' => $route_slug.'member_interviews',		 'uses' => $module_controller.'member_interviews']);


				Route::get('/approve/{enc_id}',					['as' => $route_slug.'approve',		 'uses' => $module_controller.'verification_approve']);
				Route::get('/reject/{enc_id}',					['as' => $route_slug.'reject',		 'uses' => $module_controller.'verification_reject']);
				Route::get('/comment/{enc_id}',					['as' => $route_slug.'comment',		 'uses' => $module_controller.'comment']);
				Route::post('/store_comment',					['as' => $route_slug.'store_comment',		 'uses' => $module_controller.'store_comment']);
				Route::post('approve_change/',     ['as'=>$route_slug.'approve_change',	 	  'uses'=>$module_controller.'approve_change']);
				Route::get('delete/{enc_id}',         ['as'=>$route_slug.'delete',		 	  'uses'=>$module_controller.'delete']);	
				Route::get('activate/{enc_id}',       ['as'=>$route_slug.'activate',	 	  'uses'=>$module_controller.'activate']);	
				Route::get('deactivate/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);	
				Route::get('/details/{enc_id}',					['as' => $route_slug.'details',		 'uses' => $module_controller.'details']);
				Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);
			
			});

		/*---------------------------------------------------------------------------------------
			End interview
		-----------------------------------------------------------------------------------------*/

		/*----------------------------------------------------------------------------------------
			Real Time Work Experience
		----------------------------------------------------------------------------------------*/
			Route::group(array('prefix' => '/rwe_tickets'), function()
			{	
				$route_slug       = "rwe_tickets";
				$module_controller = "Admin\RweTicketsController@";

				Route::get('/',					['as' => $route_slug.'index',		 'uses' => $module_controller.'index']);
			    Route::get('/member_rwe_tickets/{enc_id}',					['as' => $route_slug.'member_rwe_tickets',		 'uses' => $module_controller.'member_rwe_tickets']);

				Route::get('/details/{enc_id}',					['as' => $route_slug.'details',		 'uses' => $module_controller.'details']);
				Route::get('delete/{enc_id}',         ['as'=>$route_slug.'delete',		 	  'uses'=>$module_controller.'delete']);	
				Route::get('activate/{enc_id}',       ['as'=>$route_slug.'activate',	 	  'uses'=>$module_controller.'activate']);	
				Route::get('deactivate/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);	
				Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);	
				Route::post('approve_change/',     ['as'=>$route_slug.'approve_change',	 	  'uses'=>$module_controller.'approve_change']);	
				Route::get('/comment/{enc_id}',					['as' => $route_slug.'comment',		 'uses' => $module_controller.'comment']);
				Route::post('/store_comment',					['as' => $route_slug.'store_comment',		 'uses' => $module_controller.'store_comment']);
			
			});

		/*---------------------------------------------------------------------------------------
			End Real Time Work Experience
		-----------------------------------------------------------------------------------------*/

		/*----------------------------------------------------------------------------------------
			Skills Tab
		----------------------------------------------------------------------------------------*/
			Route::group(array('prefix' => '/skills'), function()
			{	
				$route_slug       = "skills";
				$module_controller = "Admin\SkillsController@";

				Route::get('/',					['as' => $route_slug.'index',		 'uses' => $module_controller.'index']);
				Route::get('create/',			['as' => $route_slug.'create',		 'uses' => $module_controller.'create']);
				Route::post('store/',			['as' => $route_slug.'store',		 'uses' => $module_controller.'store']);
				Route::get('edit/{enc_id}',		['as' => $route_slug.'edit',		 'uses' => $module_controller.'edit']);
				Route::post('update',			['as' => $route_slug.'update',		 'uses' => $module_controller.'update']);
				Route::get('delete/{enc_id}',         ['as'=>$route_slug.'delete',		 	  'uses'=>$module_controller.'delete']);	
				Route::get('activate/{enc_id}',       ['as'=>$route_slug.'activate',	 	  'uses'=>$module_controller.'activate']);	
				Route::get('deactivate/{enc_id}',     ['as'=>$route_slug.'deactivate',	 	  'uses'=>$module_controller.'deactivate']);	
				Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);	
				Route::post('approve_change/',     ['as'=>$route_slug.'approve_change',	 	  'uses'=>$module_controller.'approve_change']);	
			});

		/*---------------------------------------------------------------------------------------
			End Skills
		-----------------------------------------------------------------------------------------*/

		/*----------------------------------------------------------------------------------------
			Transaction
		----------------------------------------------------------------------------------------*/

			Route::group(array('prefix' => '/transactions'), function()
			{	
				$route_slug       = "transaction";
				$module_controller = "Admin\TransactionController@";

				Route::get('/sales',					['as' => $route_slug.'sales',		 'uses' => $module_controller.'sales']);
				Route::get('/details/{enc_id}',					['as' => $route_slug.'details',		 'uses' => $module_controller.'view_transaction_detail']);
				Route::get('/payments',					['as' => $route_slug.'payments',		 'uses' => $module_controller.'member_payments']);
				Route::post('sales_report/',     ['as'=>$route_slug.'sales_report',	 	  'uses'=>$module_controller.'sales_report']);
				Route::get('/comment/{enc_id}',					['as' => $route_slug.'comment',		 'uses' => $module_controller.'comment']);
				Route::post('/store_comment',					['as' => $route_slug.'store_comment',		 'uses' => $module_controller.'store_comment']);
				Route::get('/updatepayment/{enc_id}',			['as' => $route_slug.'updatepayment',		 'uses' => $module_controller.'updatepayment']);
				Route::post('sales_data/',     ['as'=>$route_slug.'sales_data',	 	  'uses'=>$module_controller.'sales_data']);
				Route::get('delete/{enc_id}',         ['as'=>$route_slug.'delete',		 	  'uses'=>$module_controller.'delete']);	
				Route::post('multi_action',           ['as'=>$route_slug.'multi_action',	  'uses'=>$module_controller.'multi_action']);	

			});

		/*---------------------------------------------------------------------------------------
			End Transaction
		-----------------------------------------------------------------------------------------*/


			/*-----------------------ALERTS START---------------------------------------*/

			Route::group(array('prefix'=>'/alerts'), function () 
			{
				$route_slug       = "alerts";
				$route_controller = "Admin\AlertsController@";

				Route::get('/',['as' => $route_slug.'index',
								'uses' => $route_controller.'index']);

				Route::get('deactivate/{enc_id}',['as' => $route_slug.'deactivate',  'uses' => $route_controller.'deactivate']);
				
				Route::get('activate/{enc_id}',  ['as' => $route_slug.'activate',    'uses' => $route_controller.'activate']);	

				Route::get('/view/{enc_id}',['as' => $route_slug.'details',
											 'uses' => $route_controller.'view']);

				Route::get('delete/{enc_id}',['as' => $route_slug.'delete',
											  'uses' => $route_controller.'delete']);
				Route::get('details/{enc_id}',['as' => $route_slug.'details',
											  'uses' => $route_controller.'details']);

				Route::post('multi_action',['as'=> $route_slug.'multi_action',
											'uses'=> $route_controller.'multi_action']);	
			});

			/*----------------------ALERTS END-------------------------------------*/

			/*-----------------------review rating---------------------------------------*/

			Route::group(array('prefix'=>'/review_rating'), function () 
			{
				$route_slug       = "admin_review_rating_";
				$route_controller = "Admin\ReviewRatingController@";

				Route::get('/',['as' => $route_slug.'index',
								'uses' => $route_controller.'index']);

				Route::get('/view/{enc_id}',['as' => $route_slug.'details',
											 'uses' => $route_controller.'view']);

				Route::get('delete/{enc_id}',['as' => $route_slug.'delete',
											  'uses' => $route_controller.'delete']);

				Route::post('multi_action',['as'=> $route_slug.'multi_action',
											'uses'=> $route_controller.'multi_action']);
				Route::get('review_message/{enc_id}',['as' => $route_slug.'review_message',
											 'uses' => $route_controller.'review_message']);
				Route::post('approve_change',['as'=> $route_slug.'approve_change',
											'uses'=> $route_controller.'approve_change']);							 								

			});

			/* End Review Rating  */

			/*-----------------------carrer---------------------------------------*/

			Route::group(array('prefix'=>'/career'), function () 
			{
				$route_slug       = "career";
				$route_controller = "Admin\CareerController@";

				Route::get('/',['as' => $route_slug.'index',
								'uses' => $route_controller.'index']);
				Route::get('/view/{enc_id}',['as' => $route_slug.'details',
											 'uses' => $route_controller.'view']);
				Route::get('delete/{enc_id}',['as' => $route_slug.'delete',
											  'uses' => $route_controller.'delete']);
				Route::post('multi_action',['as'=> $route_slug.'multi_action',
											'uses'=> $route_controller.'multi_action']);

			});

			/* End Carrer  */
	});