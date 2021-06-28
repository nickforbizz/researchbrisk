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
    Route::get('/dashboard', 'DashboardController@viewDashboard')->name('dashboard');

    // academics format
    Route::get('/academic_format', 'Backend\Academics\FormatController@index')->name('academicFormat');
    Route::get('/academic_format_list', 'Backend\Academics\FormatController@list')->name('academicFormatList');
    Route::post('/academic_create_format', 'Backend\Academics\FormatController@store')->name('academicCreateFormat');
    Route::post('/academic_update_format/{id}', 'Backend\Academics\FormatController@update')->name('academicUpdateFormat');
    Route::get('/academic_edit_format/{id}', 'Backend\Academics\FormatController@edit')->name('academicEditFormat');
    Route::delete('/academic_del_format/{id}', 'Backend\Academics\FormatController@destroy')->name('academicDelFormat');

    // academic categorry
    Route::get('/academic_category', 'Backend\Academics\CategoryController@index')->name('academicCategory');
    Route::get('/academic_category_list', 'Backend\Academics\CategoryController@list')->name('academicCategoryList');
    Route::post('/academic_create_category', 'Backend\Academics\CategoryController@store')->name('academicCreateCategory');
    Route::post('/academic_update_category/{id}', 'Backend\Academics\CategoryController@update')->name('academicUpdateCategory');
    Route::get('/academic_edit_category/{id}', 'Backend\Academics\CategoryController@edit')->name('academicEditcategory');
    Route::delete('/academic_del_category/{id}', 'Backend\Academics\CategoryController@destroy')->name('academicDelCategory');

     // Acadenic Order
    Route::get('/academic_order', 'Backend\Academics\OrderController@index')->name('academicOrderPage');
    Route::get('/academic_order_list', 'Backend\Academics\OrderController@list')->name('academicOrderList');
    Route::post('/academic_create_order', 'Backend\Academics\OrderController@store')->name('academicCreateOrder');
    Route::post('/academic_update_order/{id}', 'Backend\Academics\OrderController@update')->name('academicUpdateOrder');
    Route::get('/academic_edit_order/{id}', 'Backend\Academics\OrderController@edit')->name('academicEditOrder');
    Route::get('/academic_show_order/{id}', 'Backend\Academics\OrderController@show')->name('academicShowOrder');
    Route::delete('/academic_del_order/{id}', 'Backend\Academics\OrderController@destroy')->name('academicDelOrder');
    // Docs
    Route::delete('/academic_del_order_doc/{id}', 'Backend\Academics\OrderController@destroyDoc')->name('academicDelOrderDoc');
    Route::delete('/academic_del_order_docs', 'Backend\Academics\OrderController@destroyDocs')->name('academicDelOrderDocs');


    // Blogs category
    Route::get('/blog_category', 'Backend\Blogs\CategoryController@index')->name('blogCategory');
    Route::get('/blog_category_list', 'Backend\Blogs\CategoryController@list')->name('blogCategoryList');
    Route::post('/blog_create_category', 'Backend\Blogs\CategoryController@store')->name('blogCreateCategory');
    Route::post('/blog_update_category/{id}', 'Backend\Blogs\CategoryController@update')->name('blogUpdateCategory');
    Route::get('/blog_edit_category/{id}', 'Backend\Blogs\CategoryController@edit')->name('blogEditcategory');
    Route::delete('/blog_del_category/{id}', 'Backend\Blogs\CategoryController@destroy')->name('blogDelCategory');
    
    
    // Blogs
    Route::get('/blog_page', 'Backend\Blogs\BlogController@index')->name('blogPage');
    Route::get('/blog_list', 'Backend\Blogs\BlogController@list')->name('blogList');
    Route::post('/blog_create', 'Backend\Blogs\BlogController@store')->name('blogCreate');
    Route::post('/blog_update/{id}', 'Backend\Blogs\BlogController@update')->name('blogUpdate');
    Route::get('/blog_advance_addupdate', 'Backend\Blogs\BlogController@advanceAddOrUpdate')->name('blogAdvanceAddUpdate');
    Route::get('/blog_edit/{id}', 'Backend\Blogs\BlogController@edit')->name('blogEdit');
    Route::post('/blog_advance_update/{id}', 'Backend\Blogs\BlogController@advanceEdit')->name('blogAdvanceEdit');
    Route::delete('/blog_del/{id}', 'Backend\Blogs\BlogController@destroy')->name('blogDel');
    
    Route::post('/add_tags', 'Backend\Blogs\BlogController@addTags')->name('addTags');
    // Download
    Route::get('/download/{file}', 'Backend\commonController@download')->name('download');



    /**
     * Jobs
     */
    // Jobs category
    Route::get('/job_category', 'Backend\Jobs\CategoryController@index')->name('jobCategory');
    Route::get('/job_category_list', 'Backend\Jobs\CategoryController@list')->name('jobCategoryList');
    Route::post('/job_create_category', 'Backend\Jobs\CategoryController@store')->name('jobCreateCategory');
    Route::post('/job_update_category/{id}', 'Backend\Jobs\CategoryController@update')->name('jobUpdateCategory');
    Route::get('/job_edit_category/{id}', 'Backend\Jobs\CategoryController@edit')->name('jobEditcategory');
    Route::delete('/job_del_category/{id}', 'Backend\Jobs\CategoryController@destroy')->name('jobDelCategory');

    // Jobs Industry
    Route::get('/job_industry', 'Backend\Jobs\IndustryController@index')->name('jobIndustry');
    Route::get('/job_industry_list', 'Backend\Jobs\IndustryController@list')->name('jobIndustryList');
    Route::post('/job_create_industry', 'Backend\Jobs\IndustryController@store')->name('jobCreateIndustry');
    Route::post('/job_update_industry/{id}', 'Backend\Jobs\IndustryController@update')->name('jobUpdateIndustry');
    Route::get('/job_edit_industry/{id}', 'Backend\Jobs\IndustryController@edit')->name('jobEditIndustry');
    Route::delete('/job_del_industry/{id}', 'Backend\Jobs\IndustryController@destroy')->name('jobDelIndustry');

    // Jobs 
    Route::get('/job', 'Backend\Jobs\JobController@index')->name('job');
    Route::get('/job_list', 'Backend\Jobs\JobController@list')->name('jobList');
    Route::post('/job_create', 'Backend\Jobs\JobController@store')->name('jobCreate');
    Route::post('/job_update/{id}', 'Backend\Jobs\JobController@update')->name('jobUpdate');
    Route::get('/job_edit/{id}', 'Backend\Jobs\JobController@edit')->name('jobEdit');
    Route::delete('/job_del/{id}', 'Backend\Jobs\JobController@destroy')->name('jobDel');
    

});


require __DIR__.'/auth.php';
