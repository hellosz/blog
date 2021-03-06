<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['middleware' => ['auth'], 'as'=>'index', 'uses'=>'IndexController@index']);
Route::get('login', ['as'=>'login_page', 'uses'=>'IndexController@loginPage']);
Route::post('login', ['as'=>'login', 'uses'=>'IndexController@login']);
Route::get('logout', ['middleware' => ['auth'], 'as'=>'logout', 'uses'=>'IndexController@logout']);

// 文章控制器
Route::group(['middleware'=>['auth'], 'prefix'=>'article', 'as'=>'article.'], function (){
    Route::get('list', ['as'=>'list', 'uses'=>'ArticleController@getList']);
    Route::get('paginate', ['as'=>'paginate', 'uses'=>'ArticleController@paginate']);
    Route::get('add_article', ['as'=>'add_article', 'uses'=>'ArticleController@addArticle']);
    Route::post('save_article', ['as'=>'save_article', 'uses'=>'ArticleController@saveArticle']);
    Route::post('upload', ['as'=>'upload', 'uses'=>'ArticleController@upload']);
    Route::post('paste_upload', ['as'=>'paste_upload', 'uses'=>'ArticleController@pasteUpload']);
    Route::post('delete_article', ['as'=>'delete_article', 'uses'=>'ArticleController@deleteArticle']);
    Route::get('summary_image_library', ['as'=>'summary_image_library', 'uses'=>'ArticleController@summaryImageLibrary']);
    Route::get('create_or_update_summary_image_page', ['as'=>'create_or_update_summary_image_page', 'uses'=>'ArticleController@createOrUpdateSummaryImagePage']);
    Route::post('create_or_update_summary_image', ['as'=>'create_or_update_summary_image', 'uses'=>'ArticleController@createOrUpdateSummaryImage']);
    Route::get('summary_image_paginate', ['as'=>'summary_image_paginate', 'uses'=>'ArticleController@summaryImagePaginate']);
    Route::post('delete_summary_image', ['as'=>'delete_summary_image', 'uses'=>'ArticleController@deleteSummaryImage']);
    Route::get('select_summary_image_page', ['as'=>'select_summary_image_page', 'uses'=>'ArticleController@selectSummaryImagePage']);
});

// 评论控制器
Route::group(['middleware'=>['auth'], 'prefix'=>'comment', 'as'=>'comment.'], function (){
    Route::get('list', ['as'=>'list', 'uses'=>'CommentController@getList']);
    Route::get('paginate', ['as'=>'paginate', 'uses'=>'CommentController@paginate']);
    Route::post('delete_comment', ['as'=>'delete_comment', 'uses'=>'CommentController@deleteComment']);
});

// 版块控制器
Route::group(['middleware'=>['auth'], 'prefix'=>'section', 'as'=>'section.'], function (){
    Route::get('list', ['as'=>'list', 'uses'=>'SectionController@getList']);
    Route::get('paginate', ['as'=>'paginate', 'uses'=>'SectionController@paginate']);
    Route::post('create_or_update_section', ['as'=>'create_or_update_section', 'uses'=>'SectionController@createOrUpdateSection']);
    Route::post('delete_section', ['as'=>'delete_section', 'uses'=>'SectionController@deleteSection']);
});

// 分类控制器
Route::group(['middleware'=>['auth'], 'prefix'=>'category', 'as'=>'category.'], function (){
    Route::get('list', ['as'=>'list', 'uses'=>'CategoryController@getList']);
    Route::get('get_tree', ['as'=>'get_tree', 'uses'=>'CategoryController@getTree']);
    Route::post('create_or_update_category', ['as'=>'create_or_update_category', 'uses'=>'CategoryController@createOrUpdateCategory']);
    Route::post('delete_category', ['as'=>'delete_category', 'uses'=>'CategoryController@deleteCategory']);
});

// 标签控制器
Route::group(['middleware'=>['auth'], 'prefix'=>'label', 'as'=>'label.'], function (){
    Route::get('list', ['as'=>'list', 'uses'=>'LabelController@getList']);
    Route::get('paginate', ['as'=>'paginate', 'uses'=>'LabelController@paginate']);
    Route::post('create_or_update_label', ['as'=>'create_or_update_label', 'uses'=>'LabelController@createOrUpdateLabel']);
    Route::post('delete_label', ['as'=>'delete_label', 'uses'=>'LabelController@deleteLabel']);
});

// 友链控制器
Route::group(['middleware'=>['auth'], 'prefix'=>'friendlink', 'as'=>'friendlink.'], function (){
    Route::get('index', ['as'=>'index', 'uses'=>'FriendlinkController@index']);
    Route::get('paginate', ['as'=>'paginate', 'uses'=>'FriendlinkController@paginate']);
    Route::get('create_or_update_friendlink_page', ['as'=>'create_or_update_friendlink_page', 'uses'=>'FriendlinkController@createOrUpdateFriendlinkPage']);
    Route::post('create_or_update_friendlink', ['as'=>'create_or_update_friendlink', 'uses'=>'FriendlinkController@createOrUpdateFriendlink']);
    Route::post('delete_friendlink', ['as'=>'delete_friendlink', 'uses'=>'FriendlinkController@deleteFriendlink']);
});

// 系统控制器
Route::group(['middleware'=>['auth'], 'prefix'=>'system', 'as'=>'system.'], function (){
    Route::get('logs', ['as'=>'logs', 'uses'=>'\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);
    Route::get('config', ['as'=>'config', 'uses'=>'SystemController@config']);
    Route::post('save_config', ['as'=>'save_config', 'uses'=>'SystemController@saveConfig']);
});

// 访客控制器
Route::group(['prefix'=>'visitor', 'as'=>'visitor.'], function (){
    Route::post('track', ['as'=>'track', 'uses'=>'VisitorController@track']);
});