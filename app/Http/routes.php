<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(array('middleware' =>'general'), function()
{
    Route::get('/',['as' => 'home_page' ,'uses' => 'Front\HomeController@index']);
    Route::get('/alsobought/{enc_id}/{interview_id}',           ['as'=>'alsobought',          'uses'=>'Front\HomeController@alsobought']);
    Route::get('/searchskill',['as' => 'searchskill' ,'uses' => 'Front\HomeController@searchskill']);
    Route::get('/interview_details/{enc_id}',['as' => 'interview_details' ,'uses' => 'Front\HomeController@interview_details']);
    Route::get('/getreviwrating',['as' => 'getreviwrating' ,'uses' => 'Front\HomeController@getreviwrating']);
    Route::get('/getreviwratingshow',['as' => 'getreviwratingshow' ,'uses' => 'Front\HomeController@getreviwratingshow']);
    Route::get('/learnlistsave',['as' => 'learnlistsave' ,'uses' => 'Front\HomeController@learnlistsave']);
    Route::get('/about_us', ['as'=>'about_us',          'uses'=>'Front\HomeController@about_us']);
    Route::get('/terms_of_use', ['as'=>'terms_of_use',          'uses'=>'Front\HomeController@terms_of_use']);
    Route::get('/privacy_policy', ['as'=>'privacy_policy',          'uses'=>'Front\HomeController@privacy_policy']);
    Route::get('/contact_us', ['as'=>'contact_us',          'uses'=>'Front\HomeController@contact_us']);
    Route::get('/careers', ['as'=>'careers', 'uses'=>'Front\HomeController@careers']);
    Route::get('/mailset', ['as'=>'mailset', 'uses'=>'Front\HomeController@mailset']);
    
    Route::get('/careers_form/{career_slug}', ['as'=>'careers_form',          'uses'=>'Front\HomeController@careers_form']);
    Route::post('/store_careers', ['as'=>'store_careers',          'uses'=>'Front\HomeController@store_careers']);
    Route::post('/contact_enquiry', ['as'=>'contact_enquiry',          'uses'=>'Front\HomeController@store_contact_enquiry']);

    Route::get('/view_all', ['as'=>'about_us',          'uses'=>'Front\HomeController@view_all']);
    
    Route::post('payment/order_summery',     ['as'=>'payment_order_summery',          'uses'=>'Front\PaymentController@order_summery']);
    Route::any('/payment/pay_now',['as' => 'home_page' ,'uses' => 'Front\PaymentController@pay_now']);
    Route::any('/payment/invoice',['as' => 'invoice' ,'uses' => 'Front\PaymentController@getInvoice']);
    Route::post('/payment/response',['as' => 'home_page' ,'uses' => 'Front\PaymentController@payment_responce']);
    Route::post('/subscribe', ['as'=>'subscribe',          'uses'=>'Front\HomeController@subscribe']);
    Route::post('/purchased_tickets', ['as'=>'purchased_tickets',          'uses'=>'Front\PaymentController@purchased_tickets']);
    Route::get('/all_category', ['as'=>'all_category',          'uses'=>'Front\HomeController@function_view_all']);
    Route::get('/all_qualification', ['as'=>'all_qualification',          'uses'=>'Front\HomeController@function_view_all']);
    Route::get('/all_specialization', ['as'=>'all_specialization',          'uses'=>'Front\HomeController@function_view_all']);
    Route::get('/all_skills', ['as'=>'all_skills',          'uses'=>'Front\HomeController@function_view_all']);
    Route::get('/all_company', ['as'=>'all_companies',          'uses'=>'Front\HomeController@function_view_all']);

    Route::get('/skill/{enc_id}', ['as'=>'skill_id',          'uses'=>'Front\HomeController@function_search_data']);
    Route::get('/company/{enc_id}', ['as'=>'company_id',          'uses'=>'Front\HomeController@function_search_data']);
    Route::get('/category/{enc_id}', ['as'=>'category_id',          'uses'=>'Front\HomeController@function_search_data']);
    Route::get('/qualification/{enc_id}', ['as'=>'all_qualification',          'uses'=>'Front\HomeController@function_search_data']);
    Route::get('/specialization/{enc_id}', ['as'=>'all_specialization',          'uses'=>'Front\HomeController@function_search_data']);
    Route::get('/review/{user_id}/{interview_id}/{unique_id}', ['as'=>'review_rating',          'uses'=>'Front\HomeController@review_rating']);
    Route::post('/add_review', ['as'=>'add_review',          'uses'=>'Front\HomeController@store_review']);

});
Route::get('/email-notifications',  ['as'=>'email_notifications', 'uses'=>'Front\HomeController@email_notifications']);
    Route::get('/get_skills',     ['as'=>'registration_skill',          'uses'=>'Front\HomeController@get_skills']);
    Route::get('/confirm_email/{enc_user_id}/{activation_code}',     ['as'=>'confirm_email',          'uses'=>'Front\AuthController@confirm_email']);

    Route::get('/validate_current_enrollment', ['as'=>'validate_current_enrollment', 'uses'=>'Front\HomeController@validate_current_enrollment']);

    Route::get('/{topic_name}/preview/{interview_id}', ['as'=>'learning_preview', 'uses'=>'Front\HomeController@learning_preview']);

    Route::get('/{company_id}/preview-company/{interview_id}', ['as'=>'preview_company', 'uses'=>'Front\HomeController@preview_company']);

    Route::get('/{skill_id}/{member_id}/{user_id}/preview-real-issues/{interview_id}/{experience_level}', ['as'=>'preview_real_issues', 'uses'=>'Front\HomeController@preview_real_issues']);

    Route::get('/pdfs', ['as'=>'viewPdf', 'uses'=>'Front\HomeController@viewPdf']);

    Route::get('/realtimeissues',['as'=>'realtimeissues','uses'=>'Front\HomeController@realtimeTickets']);
    Route::get('/userrealtimeissues',['as'=>'userrealtimeissues','uses'=>'Front\HomeController@getUserRealtimeTickets']);
    Route::get('/get_user_reviews',['as'=>'get_user_reviews','uses'=>'Front\HomeController@getUserReviews']);
    Route::get('/notify-coach',['as'=>'notify-coach','uses'=>'Front\HomeController@notifyCoach']);
    Route::get('/coach-available',['as'=>'coach-available','uses'=>'Front\HomeController@getCoachAvailable']);
    
    Route::get('/getcompanies',['as'=>'getcompanies','uses'=>'Front\HomeController@getCompanies']);
    
    Route::get('/get_states',['as'=>'get_states','uses'=>'Front\AuthController@getStates']);
    Route::get('/get_cities',['as'=>'get_cities','uses'=>'Front\AuthController@getCities']);
    Route::get('/get_country_phone_code',['as'=>'get_country_phone_code','uses'=>'Front\AuthController@getCountryPhoneCode']);

     Route::get('/get_country_codename',['as'=>'get_country_codename','uses'=>'Front\AuthController@getcountrycodename']);


    Route::get('/get_state_codename',['as'=>'get_state_codename','uses'=>'Front\AuthController@getstatecodename']);

     Route::get('/get_city_codename',['as'=>'get_city_codename','uses'=>'Front\AuthController@autosearchboxcity']); 



/*-------------------------admin Route File-----------------------------------*/

        include(app_path('Http/Routes/admin.php'));
/*-------------------------end admin route file---------------------------*/

/*-------------------------Member Route File-----------------------------------*/

        include(app_path('Http/Routes/member.php'));
/*-------------------------end member route file---------------------------*/


/*-------------------------user Route File-----------------------------------*/

        include(app_path('Http/Routes/user.php'));
/*-------------------------end user route file---------------------------*/