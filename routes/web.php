<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
Carbon::setLocale('dk');


Auth::routes();
Route::get('/pdf', 'User\DocumentController@pdf');
Route::post('/pdf', 'User\DocumentController@pdf');
Route::get('/home', function(){ return redirect('/login'); });


Route::get('/', function(){ return redirect('/login'); });

Route::match(['post', 'get'],'/login', 'LoginController@index');


Route::get('/getSubCategories/{id}', 'Admin\CategoryController@getSubCategories');


Route::group(['namespace' => 'User', 'middleware' => ['auth' => 'User', 'AdminPermission']],function(){

	Route::get('/dashboard/', 'AuthUserController@dashboard');
	Route::get('/account/', 'AuthUserController@account');
	Route::get('/logout/', 'AuthUserController@logout');
	
	Route::post('/toggle_sidebar', 'AuthUserController@toggle_sidebar');

	Route::get('/password', 'PasswordController@password');
	Route::get('/check-pwd', 'PasswordController@check');
	Route::post('/update_password', 'PasswordController@update_password');






	/*User CRUD*/
	Route::get('user', 'UserController@index');
	Route::post('user/store', 'UserController@store');
	Route::get('user/profile/{id}', 'UserController@profile');
	Route::get('user/view/{id}', 'UserController@profile');
	Route::get('user/view/map/{id}', 'UserController@map');
	Route::post('user/update/{id}', 'UserController@update');
	Route::post('user/update_adderss/{id}', 'UserController@update_adderss');
	Route::post('/user/picture/{id}', 'UserController@profile_picture');
	Route::get('/user/remove/picture/{id}', 'UserController@remove_profile');
	Route::post('user/profile_note/{id}', 'UserController@profile_note');
	Route::get('user/delete/{id}', 'UserController@delete');

	/*StamData CRUD*/
	Route::get('user/stamdata/{id}', 'StamDataController@index');

	// Contact
	Route::post('user/stamdata/contact/store/{id}', 'StamDataController@contact_store');
	Route::post('user/stamdata/contact/update/{id}', 'StamDataController@contact_update');
	Route::get('user/stamdata/contact/delete/{id}', 'StamDataController@contact_delete');


	// Courses
	Route::post('user/stamdata/course/store/{id}', 'StamDataController@course_store');
	Route::post('user/stamdata/course/update/{id}', 'StamDataController@course_update');
	Route::get('user/stamdata/course/delete/{id}', 'StamDataController@course_delete');


	// authorization
	Route::post('user/stamdata/authorization/store/{id}', 'StamDataController@authorization_store');
	Route::post('user/stamdata/authorization/update/{id}', 'StamDataController@authorization_update');
	Route::get('user/stamdata/authorization/delete/{id}', 'StamDataController@authorization_delete');
	Route::post('user/stamdata/authorization/validate/{id}', 'StamDataController@authorization_validate');


	// Bank
	Route::post('user/stamdata/bank/store/{id}', 'StamDataController@bank_store');
	Route::post('user/stamdata/bank/update/{id}', 'StamDataController@bank_update');
	Route::get('user/stamdata/bank/delete/{id}', 'StamDataController@bank_delete');


	// Associated
	Route::post('user/stamdata/associated/store/{id}', 'StamDataController@associated_store');
	Route::post('user/stamdata/associated/update/{id}', 'StamDataController@associated_update');
	Route::get('user/stamdata/associated/delete/{id}', 'StamDataController@associated_delete');


	// License
	Route::post('user/stamdata/license/store/{id}', 'StamDataController@license_store');
	Route::post('user/stamdata/license/update/{id}', 'StamDataController@license_update');
	Route::get('user/stamdata/license/delete/{id}', 'StamDataController@license_delete');



	// Employment
	Route::post('user/stamdata/employment/update/{id}', 'StamDataController@employment_update');


	Route::post('user/stamdata/store/{id}', 'StamDataController@store');
	Route::post('user/stamdata/update/{id}', 'StamDataController@update');
	Route::get('user/stamdata/delete/{id}', 'StamDataController@delete');



	/*Equipment CRUD*/
	Route::get('user/equipment/{id}', 'EquipmentController@index');
	Route::post('user/equipment/store/{id}', 'EquipmentController@store');
	Route::post('user/equipment/update/{id}', 'EquipmentController@update');
	Route::get('user/equipment/delete/{id}', 'EquipmentController@delete');

	/*Document CRUD*/
	Route::get('user/doc/{id}', 'UserDocumentController@index');
	Route::get('user/pri/{id}', 'UserDocumentController@wiki');
	
	Route::get('user/pir/single/reset/{document_id}/{user_id}', 'UserDocumentController@signle_reset');
	Route::get('user/pir/all/reset/{user_id}', 'UserDocumentController@all_reset');

	Route::post('user/document/store/{id}', 'UserDocumentController@store');
	Route::post('user/document/update/{id}', 'UserDocumentController@update');
	Route::get('user/document/delete/{id}', 'UserDocumentController@delete');

	/*Notes CRUD*/
	Route::get('user/note/{id}', 'UserNoteController@index');
	Route::get('user/note/edit/{user_id}/{id}', 'UserNoteController@edit');
	Route::post('user/note/update/{user_id}/{id}', 'UserNoteController@update');
	Route::post('user/note/store/{id}', 'UserNoteController@store');
	Route::post('user/note/update/{id}', 'UserNoteController@update');
	Route::get('user/note/delete/{id}', 'UserNoteController@delete');



	/*Setting*/
	Route::get('user/setting/{id}', 'UserSettingController@index');
	Route::post('user/setting/status/update/{id}', 'UserSettingController@status');
	Route::post('user/setting/app_access/{id}', 'UserSettingController@app_access');
	Route::post('user/setting/permission/update/{id}', 'UserSettingController@permission');









	/*Location CRUD*/
	Route::get('user/location', 'LoactionController@index');
	Route::post('user/location/store', 'LoactionController@store');
	Route::post('user/location/update/{id}', 'LoactionController@update');
	Route::get('user/location/delete/{id}', 'LoactionController@delete');













	/*User CRUD*/
	Route::get('customer', 'Customer\CustomerController@index');
	Route::post('customer/store', 'Customer\CustomerController@store');
	Route::get('customer/profile/{id}', 'Customer\CustomerController@profile');
	Route::get('customer/view/{id}', 'Customer\CustomerController@profile');
	Route::get('customer/view/map/{id}', 'Customer\CustomerController@map');
	Route::post('customer/update/{id}', 'Customer\CustomerController@update');
	Route::post('customer/update_adderss/{id}', 'Customer\CustomerController@update_adderss');
	Route::post('/customer/picture/{id}', 'Customer\CustomerController@profile_picture');
	Route::get('/customer/remove/picture/{id}', 'Customer\CustomerController@remove_profile');
	Route::get('customer/delete/{id}', 'Customer\CustomerController@delete');

	/*StamData CRUD*/
	Route::get('customer/stamdata/{id}', 'Customer\StamDataController@index');

	// Contact
	Route::post('customer/stamdata/contact/store/{id}', 'Customer\StamDataController@contact_store');
	Route::post('customer/stamdata/contact/update/{id}', 'Customer\StamDataController@contact_update');
	Route::get('customer/stamdata/contact/delete/{id}', 'Customer\StamDataController@contact_delete');


	// Courses
	Route::post('customer/stamdata/course/store/{id}', 'Customer\StamDataController@course_store');
	Route::post('customer/stamdata/course/update/{id}', 'Customer\StamDataController@course_update');
	Route::get('customer/stamdata/course/delete/{id}', 'Customer\StamDataController@course_delete');


	// Bank
	Route::post('customer/stamdata/bank/store/{id}', 'Customer\StamDataController@bank_store');
	Route::post('customer/stamdata/bank/update/{id}', 'Customer\StamDataController@bank_update');
	Route::get('customer/stamdata/bank/delete/{id}', 'Customer\StamDataController@bank_delete');


	// Associated
	Route::post('customer/stamdata/associated/store/{id}', 'Customer\StamDataController@associated_store');
	Route::post('customer/stamdata/associated/update/{id}', 'Customer\StamDataController@associated_update');
	Route::get('customer/stamdata/associated/delete/{id}', 'Customer\StamDataController@associated_delete');


	// License
	Route::get('customer/assignment/{id}', 'Customer\StamDataController@assignment_all');
	Route::post('customer/stamdata/assignment/store/{id}', 'Customer\StamDataController@assignment_store');
	Route::post('customer/stamdata/assignment/update/{id}', 'Customer\StamDataController@assignment_update');
	Route::get('customer/stamdata/assignment/delete/{id}', 'Customer\StamDataController@assignment_delete');



	// Employment
	Route::post('customer/stamdata/employment/update/{id}', 'Customer\StamDataController@employment_update');


	Route::post('customer/stamdata/store/{id}', 'Customer\StamDataController@store');
	Route::post('customer/stamdata/update/{id}', 'Customer\StamDataController@update');
	Route::get('customer/stamdata/delete/{id}', 'Customer\StamDataController@delete');



	/*Document CRUD*/
	Route::get('customer/doc/{id}', 'Customer\CustomerDocumentController@index');
	Route::get('customer/pri/{id}', 'Customer\CustomerDocumentController@wiki');
	
	Route::get('customer/pir/single/reset/{document_id}/{user_id}', 'Customer\CustomerDocumentController@signle_reset');
	Route::get('customer/pir/all/reset/{user_id}', 'Customer\CustomerDocumentController@all_reset');

	Route::post('customer/document/store/{id}', 'Customer\CustomerDocumentController@store');
	Route::post('customer/document/update/{id}', 'Customer\CustomerDocumentController@update');
	Route::get('customer/document/delete/{id}', 'Customer\CustomerDocumentController@delete');

	/*Notes CRUD*/
	Route::get('customer/note/{id}', 'Customer\CustomerNoteController@index');
	Route::get('customer/note/edit/{user_id}/{id}', 'Customer\CustomerNoteController@edit');
	Route::post('customer/note/update/{user_id}/{id}', 'Customer\CustomerNoteController@update');
	Route::post('customer/note/store/{id}', 'Customer\CustomerNoteController@store');
	Route::post('customer/note/update/{id}', 'Customer\CustomerNoteController@update');
	Route::get('customer/note/delete/{id}', 'Customer\CustomerNoteController@delete');




























	/*User CRUD*/
	Route::get('vehicle', 'Vehicle\VehicleController@index');
	Route::post('vehicle/store', 'Vehicle\VehicleController@store');
	Route::get('vehicle/profile/{id}', 'Vehicle\VehicleController@profile');
	Route::get('vehicle/view/{id}', 'Vehicle\VehicleController@profile');
	Route::get('vehicle/view/map/{id}', 'Vehicle\VehicleController@map');
	Route::post('vehicle/update/{id}', 'Vehicle\VehicleController@update');
	Route::post('vehicle/update_adderss/{id}', 'Vehicle\VehicleController@update_adderss');
	Route::post('vehicle/picture/{id}', 'Vehicle\VehicleController@profile_picture');
	Route::get('vehicle/remove/picture/{id}', 'Vehicle\VehicleController@remove_profile');
	
	Route::post('vehicle/millage/store/{id}', 'Vehicle\VehicleController@millage');
	Route::post('vehicle/todo/store/{id}', 'Vehicle\VehicleController@vehicle_store_todo');
	Route::post('vehicle/todo/update/{id}', 'Vehicle\VehicleController@vehicle_update_todo');
	Route::get('vehicle/todo/delete/{id}', 'Vehicle\VehicleController@vehicle_delete_todo');
	Route::get('vehicle/todo/done/{id}', 'Vehicle\VehicleController@vehicle_done_todo');

	Route::get('vehicle/delete/{id}', 'Vehicle\VehicleController@delete');

	/*StamData CRUD*/
	Route::get('vehicle/stamdata/{id}', 'Vehicle\VehicleStamDataController@index');

	// Contact
	Route::post('vehicle/stamdata/contact/store/{id}', 'Vehicle\VehicleStamDataController@contact_store');
	Route::post('vehicle/stamdata/contact/update/{id}', 'Vehicle\VehicleStamDataController@contact_update');
	Route::get('vehicle/stamdata/contact/delete/{id}', 'Vehicle\VehicleStamDataController@contact_delete');




	// Bank
	Route::post('vehicle/stamdata/bank/store/{id}', 'Vehicle\VehicleStamDataController@bank_store');
	Route::post('vehicle/stamdata/bank/update/{id}', 'Vehicle\VehicleStamDataController@bank_update');
	Route::get('vehicle/stamdata/bank/delete/{id}', 'Vehicle\VehicleStamDataController@bank_delete');


	// Associated
	Route::post('vehicle/stamdata/associated/store/{id}', 'Vehicle\VehicleStamDataController@associated_store');
	Route::post('vehicle/stamdata/associated/update/{id}', 'Vehicle\VehicleStamDataController@associated_update');
	Route::get('vehicle/stamdata/associated/delete/{id}', 'Vehicle\VehicleStamDataController@associated_delete');





	// Employment
	Route::post('vehicle/stamdata/employment/update/{id}', 'Vehicle\VehicleStamDataController@employment_update');



	/*Document CRUD*/
	Route::get('vehicle/doc/{id}', 'Vehicle\VehicleDocumentController@index');
	Route::get('vehicle/pri/{id}', 'Vehicle\VehicleDocumentController@wiki');
	
	Route::get('vehicle/pir/single/reset/{document_id}/{user_id}', 'Vehicle\VehicleDocumentController@signle_reset');
	Route::get('vehicle/pir/all/reset/{user_id}', 'Vehicle\VehicleDocumentController@all_reset');

	Route::post('vehicle/document/store/{id}', 'Vehicle\VehicleDocumentController@store');
	Route::post('vehicle/document/update/{id}', 'Vehicle\VehicleDocumentController@update');
	Route::get('vehicle/document/delete/{id}', 'Vehicle\VehicleDocumentController@delete');

	/*Notes CRUD*/
	Route::get('vehicle/note/{id}', 'Vehicle\VehicleNoteController@index');
	Route::get('vehicle/note/edit/{user_id}/{id}', 'Vehicle\VehicleNoteController@edit');
	Route::post('vehicle/note/update/{user_id}/{id}', 'Vehicle\VehicleNoteController@update');
	Route::post('vehicle/note/store/{id}', 'Vehicle\VehicleNoteController@store');
	Route::post('vehicle/note/update/{id}', 'Vehicle\VehicleNoteController@update');
	Route::get('vehicle/note/delete/{id}', 'Vehicle\VehicleNoteController@delete');


















	/*Group CRUD*/
	Route::get('user/group', 'GroupController@index');
	Route::post('group/store', 'GroupController@store');
	Route::post('group/update/{id}', 'GroupController@update');
	Route::get('group/delete/{id}', 'GroupController@delete');

	/*Category CRUD*/
	Route::get('/wiki/category', 'CategoryController@index');
	Route::get('getSubCategories', 'CategoryController@getSubCategories');
	Route::post('category/store', 'CategoryController@store');
	Route::post('category/update/{id}', 'CategoryController@update');
	Route::get('category/delete/{id}', 'CategoryController@delete');

	



	/*Document CRUD*/
	Route::get('wiki/list', 'DocumentController@index');
	Route::get('wiki/list/create', 'DocumentController@create');
	Route::post('wiki/list/store', 'DocumentController@store');
	Route::get('wiki/list/edit/{id}', 'DocumentController@edit');
	Route::post('wiki/list/update/{id}', 'DocumentController@update');
	Route::get('wiki/list/delete/{id}', 'DocumentController@delete');
	
	Route::get('/user/wiki/reset/{id}', 'DocumentController@reset');

	Route::get('wiki/view/{id}', 'DocumentController@view');

	Route::get('document/status/', 'DocumentController@status');

	Route::get('document/autocomplete/', 'DocumentController@autocomplete');
	Route::get('document/autocompleteSubtitle/', 'DocumentController@autocompleteSubtitle');
	Route::get('document/autocompleteKeyword/', 'DocumentController@autocompleteKeyword');
	
	Route::get('wiki/search/', 'DocumentController@search');
	Route::get('wiki', 'DocumentController@wiki');
	Route::get('wiki/{id}', 'DocumentController@document_by_category');


	Route::get('document/update/{status}/{id}', 'DocumentController@update_status');








	

	Route::get('/settings/app', 'SettingController@setting');
	Route::post('/settings/app/update/{id}', 'SettingController@update');


	Route::get('/settings/minisite', 'MiniSiteController@index');
	Route::post('/setting/minisite/store', 'MiniSiteController@store');
	Route::post('/setting/minisite/update/{id}', 'MiniSiteController@update');
	Route::get('/setting/minisite/delete/{id}', 'MiniSiteController@delete');
	
	Route::get('/minisite/{id}', 'MiniSiteController@minisite');
	Route::get('/minisite/information/{id}', 'MiniSiteController@minisite_information');
	Route::get('/minisite/instrukser/{id}', 'MiniSiteController@minisite_instrukser');
	Route::get('/minisite/team/{id}', 'MiniSiteController@minisite_team');

	Route::post('/minisite/todo/store', 'MiniSiteController@store_todo');
	Route::post('/minisite/todo/update/{id}', 'MiniSiteController@update_todo');
	Route::get('/minisite/todo/done/{id}', 'MiniSiteController@done_todo');
	Route::get('/minisite/todo/delete/{id}', 'MiniSiteController@delete_todo');

	Route::post('/minisite/chat/store', 'MiniSiteController@store_chat');
	Route::get('/minisite/chat/delete/{id}', 'MiniSiteController@delete_chat');
	


	Route::get('/news', 'NewsController@index');
	Route::get('/news/create', 'NewsController@create');
	Route::post('/news/store', 'NewsController@store');
	Route::get('/news/edit/{id}', 'NewsController@edit');
	Route::get('/news/view/{id}', 'NewsController@view');
	Route::post('/news/update/{id}', 'NewsController@update');
	Route::get('/news/delete/{id}', 'NewsController@delete');


	Route::get('/schedule', 'ScheduleController@index');

	Route::get('/schedule/overview', 'ScheduleController@overview');

	Route::get('/schedule/by/id/{id}', 'ScheduleController@get_schedule');
	Route::get('/schedule/application/approved/{id}', 'ScheduleController@application_confirm');
	Route::post('/schedule/store', 'ScheduleController@store');
	Route::post('/schedule/setting/update', 'ScheduleController@setting_update');
	Route::post('/schedule/open/shift/store', 'ScheduleController@open_shift_store');
	Route::post('/schedule/publish/shifts', 'ScheduleController@publish_shifts');
	Route::post('/schedule/update/{id}', 'ScheduleController@update');
	Route::get('/schedule/drag/update/{id}', 'ScheduleController@drag_update');
	Route::get('/schedule/copy/ajax/{id}', 'ScheduleController@copy_schedule_ajax');
	Route::get('/schedule/by/date-range', 'ScheduleController@by_date_range');
	Route::post('/schedule/copy/{id}', 'ScheduleController@copy');
	Route::get('/schedule/delete/{id}', 'ScheduleController@delete');
	Route::get('/schedule/ajax_delete/{id}', 'ScheduleController@ajax_delete');

	Route::get('/schedule/notes/{id}', 'ScheduleController@get_notes');
	Route::get('/schedule/application/{id}', 'ScheduleController@get_application');
	Route::post('/schedule/note/store/{id}', 'ScheduleController@note_store');
	Route::get('/schedule/note/delete/{id}', 'ScheduleController@note_delete');
	
	Route::post('/schedule/not/working', 'ScheduleController@note_working');
	Route::post('/schedule/not/working/update/{id}', 'ScheduleController@note_working_update');
	Route::get('/schedule/update/status/{status}/{id}', 'ScheduleController@update_status_right_click');
	Route::get('/schedule/not/working/single/{id}', 'ScheduleController@getSingleNotWorkSchedule');
	Route::get('/schedule/not/working/delete/{id}', 'ScheduleController@note_working_delete');
	
	Route::get('/schedule/get/customer/assignments/{id}', 'ScheduleController@customer_assignments');
	Route::get('/schedule/get/user/by/location/{ids}', 'ScheduleController@staff_by_location');
	Route::get('/schedule/get/user/by/location/and/group/{group_ids}/{locaction_ids}', 'ScheduleController@staff_by_location_and_group');
});



Route::group(['namespace' => 'PWA', 'middleware' => ['auth' => 'User']],function(){
	Route::get('/pwa', 'PWAController@index');
	Route::get('/pwa/logout', 'PWAController@logout');
	
	Route::get('/pwa/schedule', 'ScheduleController@index');
	Route::get('/pwa/schedule/view/{id}', 'ScheduleController@view');
	Route::get('/pwa/schedule/status/{status}/{id}', 'ScheduleController@update_status');
	Route::get('/pwa/schedule/apply/{id}', 'ScheduleController@apply');
	
	Route::get('/pwa/news', 'NewsController@index');
	Route::get('/pwa/news/view/{id}', 'NewsController@view');
	
	Route::get('/pwa/pri/document', 'PriDocumentController@index');
	Route::get('/pwa/pri/document/view/{id}', 'PriDocumentController@view');
	Route::get('/pwa/pri/document/download/pdf/{id}', 'PriDocumentController@download_pdf');
	Route::get('/pwa/pri/document/add-to-favorite/{id}', 'PriDocumentController@add_to_favorite');
	Route::get('/pwa/pri/document/pdf/{id}', 'PriDocumentController@pdf');
	Route::get('/pwa/pri/document/{id}', 'PriDocumentController@document_by_category');
	Route::get('/pwa/pri/search/', 'PriDocumentController@search');
	Route::get('/pwa/pri/document/update/{status}/{id}', 'PriDocumentController@update_status');
});



Route::get('cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    die("Cash Cleard");
});



Route::get('/updateapp', function(){
    exec('composer update');
    exec('composer dump-autoload');
    die("composer dump-autoload complete");
});