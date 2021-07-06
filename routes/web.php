<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


require __DIR__.'/auth.php';


Route::get('/klove/{toString}', "KloveController@index");






Route::get('/', 'frontend\frontendController@welcome')->name('welcome');
Route::get('/posts', 'frontend\frontendController@viewPosts')->name('posts');
Route::get('/post/{id}/{slug}', 'frontend\frontendController@singlePost')->name('post');
Route::post('/post_comments', 'frontend\frontendController@createPostComments')->name('postComments');
Route::get('/jobs', 'frontend\frontendController@viewJobs')->name('jobs');
Route::get('/job/{id}', 'frontend\frontendController@viewSingleJob')->name('singlejob');
Route::get('/about', 'frontend\frontendController@viewAbout')->name('about');
Route::get('/contact', 'frontend\frontendController@viewContact')->name('contact');


// academic
Route::get('/orderassignment', 'frontend\frontendController@viewAcademicplaceorder')->name('orderassignment');
Route::post('/orderassignment', 'frontend\frontendController@viewAcademicplaceorder')->name('orderassignment');

Route::get('/academicbio', 'frontend\frontendController@viewAcademicbio')->name('academicbio');
Route::get('/academicpayrates', 'frontend\frontendController@viewAcademicpayrates')->name('academicpayrates');
Route::get('/academicsamples', 'frontend\frontendController@viewAcademicsamples')->name('academicsamples');
Route::get('/academicservices', 'frontend\frontendController@viewAcademicservices')->name('academicservices');


Route::middleware(['auth'])->group(function () {

    Route::group(['middleware' => ['role:admin']], function () {
        //
    });


    Route::get('/dashboard', 'Backend\DashboardController@viewDashboard')->name('dashboard');

    // academics format
    Route::get('/academic_format', 'Backend\Academics\FormatController@index')->name('academicFormat');
    Route::get('/academic_format_list', 'Backend\Academics\FormatController@list')->name('academicFormatList');
    Route::post('/academic_create_format', 'Backend\Academics\FormatController@store')->name('academicCreateFormat')->middleware(['role:admin|superadmin']);
    Route::post('/academic_update_format/{id}', 'Backend\Academics\FormatController@update')->name('academicUpdateFormat')->middleware(['role:admin|superadmin']);
    Route::get('/academic_edit_format/{id}', 'Backend\Academics\FormatController@edit')->name('academicEditFormat');
    Route::delete('/academic_del_format/{id}', 'Backend\Academics\FormatController@destroy')->name('academicDelFormat')->middleware(['role:admin|superadmin']);

    // academic categorry
    Route::get('/academic_category', 'Backend\Academics\CategoryController@index')->name('academicCategory');
    Route::get('/academic_category_list', 'Backend\Academics\CategoryController@list')->name('academicCategoryList');
    Route::post('/academic_create_category', 'Backend\Academics\CategoryController@store')->name('academicCreateCategory')->middleware(['role:admin|superadmin']);
    Route::post('/academic_update_category/{id}', 'Backend\Academics\CategoryController@update')->name('academicUpdateCategory')->middleware(['role:admin|superadmin']);
    Route::get('/academic_edit_category/{id}', 'Backend\Academics\CategoryController@edit')->name('academicEditcategory');
    Route::delete('/academic_del_category/{id}', 'Backend\Academics\CategoryController@destroy')->name('academicDelCategory')->middleware(['role:admin|superadmin']);

     // Acadenic Order
    Route::get('/academic_order', 'Backend\Academics\OrderController@index')->name('academicOrderPage');
    Route::get('/academic_order_list', 'Backend\Academics\OrderController@list')->name('academicOrderList');
    Route::post('/academic_create_order', 'Backend\Academics\OrderController@store')->name('academicCreateOrder')->middleware(['role:admin|superadmin']);
    Route::post('/academic_update_order/{id}', 'Backend\Academics\OrderController@update')->name('academicUpdateOrder')->middleware(['role:admin|superadmin']);
    Route::get('/academic_edit_order/{id}', 'Backend\Academics\OrderController@edit')->name('academicEditOrder');
    Route::get('/academic_show_order/{id}', 'Backend\Academics\OrderController@show')->name('academicShowOrder');
    Route::delete('/academic_del_order/{id}', 'Backend\Academics\OrderController@destroy')->name('academicDelOrder')->middleware(['role:admin|superadmin']);
    // Docs
    Route::delete('/academic_del_order_doc/{id}', 'Backend\Academics\OrderController@destroyDoc')->name('academicDelOrderDoc')->middleware(['role:admin|superadmin']);
    Route::delete('/academic_del_order_docs', 'Backend\Academics\OrderController@destroyDocs')->name('academicDelOrderDocs')->middleware(['role:admin|superadmin']);


    // Blogs category
    Route::get('/blog_category', 'Backend\Blogs\CategoryController@index')->name('blogCategory');
    Route::get('/blog_category_list', 'Backend\Blogs\CategoryController@list')->name('blogCategoryList');
    Route::post('/blog_create_category', 'Backend\Blogs\CategoryController@store')->name('blogCreateCategory')->middleware(['role:admin|superadmin|writer']);
    Route::post('/blog_update_category/{id}', 'Backend\Blogs\CategoryController@update')->name('blogUpdateCategory')->middleware(['role:admin|superadmin|writer']);
    Route::get('/blog_edit_category/{id}', 'Backend\Blogs\CategoryController@edit')->name('blogEditcategory');
    Route::delete('/blog_del_category/{id}', 'Backend\Blogs\CategoryController@destroy')->name('blogDelCategory')->middleware(['role:admin|superadmin']);
    
    
    // Blogs
    Route::get('/blog_page', 'Backend\Blogs\BlogController@index')->name('blogPage');
    Route::get('/blog_list', 'Backend\Blogs\BlogController@list')->name('blogList');
    Route::post('/blog_create', 'Backend\Blogs\BlogController@store')->name('blogCreate')->middleware(['role:admin|superadmin|writer']);
    Route::post('/blog_update/{id}', 'Backend\Blogs\BlogController@update')->name('blogUpdate')->middleware(['role:admin|superadmin|writer']);
    Route::get('/blog_advance_addupdate', 'Backend\Blogs\BlogController@advanceAddOrUpdate')->name('blogAdvanceAddUpdate')->middleware(['role:admin|superadmin|writer']);
    Route::get('/blog_edit/{id}', 'Backend\Blogs\BlogController@edit')->name('blogEdit');
    Route::post('/blog_advance_update/{id}', 'Backend\Blogs\BlogController@advanceEdit')->name('blogAdvanceEdit')->middleware(['role:admin|superadmin|writer']);
    Route::delete('/blog_del/{id}', 'Backend\Blogs\BlogController@destroy')->name('blogDel')->middleware(['role:admin|superadmin']);
    
    Route::post('/add_tags', 'Backend\Blogs\BlogController@addTags')->name('addTags')->middleware(['role:admin|superadmin']);
    // Download
    Route::get('/download/{file}', 'Backend\commonController@download')->name('download');



    /**
     * Jobs
     */
    // Jobs category
    Route::get('/job_category', 'Backend\Jobs\CategoryController@index')->name('jobCategory');
    Route::get('/job_category_list', 'Backend\Jobs\CategoryController@list')->name('jobCategoryList');
    Route::post('/job_create_category', 'Backend\Jobs\CategoryController@store')->name('jobCreateCategory')->middleware(['role:admin|superadmin']);
    Route::post('/job_update_category/{id}', 'Backend\Jobs\CategoryController@update')->name('jobUpdateCategory')->middleware(['role:admin|superadmin']);
    Route::get('/job_edit_category/{id}', 'Backend\Jobs\CategoryController@edit')->name('jobEditcategory');
    Route::delete('/job_del_category/{id}', 'Backend\Jobs\CategoryController@destroy')->name('jobDelCategory')->middleware(['role:admin|superadmin']);

    // Jobs Industry
    Route::get('/job_industry', 'Backend\Jobs\IndustryController@index')->name('jobIndustry');
    Route::get('/job_industry_list', 'Backend\Jobs\IndustryController@list')->name('jobIndustryList');
    Route::post('/job_create_industry', 'Backend\Jobs\IndustryController@store')->name('jobCreateIndustry')->middleware(['role:admin|superadmin']);
    Route::post('/job_update_industry/{id}', 'Backend\Jobs\IndustryController@update')->name('jobUpdateIndustry')->middleware(['role:admin|superadmin']);
    Route::get('/job_edit_industry/{id}', 'Backend\Jobs\IndustryController@edit')->name('jobEditIndustry');
    Route::delete('/job_del_industry/{id}', 'Backend\Jobs\IndustryController@destroy')->name('jobDelIndustry')->middleware(['role:admin|superadmin']);

    // Jobs 
    Route::get('/job', 'Backend\Jobs\JobController@index')->name('job');
    Route::get('/job_list', 'Backend\Jobs\JobController@list')->name('jobList');
    Route::post('/job_create', 'Backend\Jobs\JobController@store')->name('jobCreate')->middleware(['role:admin|superadmin']);
    Route::post('/job_update/{id}', 'Backend\Jobs\JobController@update')->name('jobUpdate')->middleware(['role:admin|superadmin']);
    Route::get('/job_edit/{id}', 'Backend\Jobs\JobController@edit')->name('jobEdit');
    Route::delete('/job_del/{id}', 'Backend\Jobs\JobController@destroy')->name('jobDel')->middleware(['role:admin|superadmin']);
    
    
    
    // Users
    Route::get('/manage_users', 'Backend\SettingsController@showManageUsers')->name('manageUsers')->middleware(['role:admin|superadmin']);
    Route::get('/manage_users_list', 'Backend\SettingsController@listManageUsers')->name('manageUsersList')->middleware(['role:admin|superadmin']);
    Route::get('/manage_users_actdeactivate', 'Backend\SettingsController@actdeactivateManageUsers')->name('manageUsersActdeactivate')->middleware(['role:admin|superadmin']);
    Route::delete('/manage_user_del/{id}', 'Backend\SettingsController@destroyManageUsers')->name('manageUsersDel')->middleware(['role:admin|superadmin']);


    // settings
    Route::get('/settings', 'Backend\SettingsController@index')->name('settings');
    Route::get('/role_list', 'Backend\Roles\RoleController@list')->name('roleList');
    Route::post('/role_create', 'Backend\Roles\RoleController@store')->name('roleCreate')->middleware(['role:admin|superadmin']);
    Route::get('/role_edit/{id}', 'Backend\Roles\RoleController@edit')->name('roleEdit');
    Route::post('/role_update/{id}', 'Backend\Roles\RoleController@update')->name('roleUpdate')->middleware(['role:admin|superadmin']);
    Route::delete('/role_del/{id}', 'Backend\Roles\RoleController@destroy')->name('roleDel')->middleware(['role:admin|superadmin']);

    Route::get('/permission_list', 'Backend\Permissions\PermissionController@list')->name('permissionList');
    Route::post('/permission_create', 'Backend\Permissions\PermissionController@store')->name('permissionCreate')->middleware(['role:admin|superadmin']);
    Route::get('/permission_edit/{id}', 'Backend\Permissions\PermissionController@edit')->name('permissionEdit');
    Route::post('/permission_update/{id}', 'Backend\Permissions\PermissionController@update')->name('permissionUpdate')->middleware(['role:admin|superadmin']);
    Route::delete('/permission_del/{id}', 'Backend\Permissions\PermissionController@destroy')->name('permissionDel')->middleware(['role:admin|superadmin']);
    
    Route::post('/role_give_permissions', 'Backend\SettingsController@roleGivePermissions')->name('roleGivePermissions')->middleware(['role:admin|superadmin']);
    Route::post('/user_give_roles', 'Backend\SettingsController@userGiveRoles')->name('userGiveRoles');
    Route::post('/user_give_permissions', 'Backend\SettingsController@userGivePermissions')->name('userGivePermissions')->middleware(['role:admin|superadmin']);
    Route::get('/user_role_permissions', 'Backend\SettingsController@userRolePermissions')->name('userRolePermissions');

});


