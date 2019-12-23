<?php

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
Route::get('/', 'MainPageController@index');
Route::get('details/{id}', "ProjectPointsController@getDetails");

Route::post('/location', "ProjectPointsController@getLocationData");

Route::get('/about', function(){
    return view('about');
});

Route::get('/project', function(){
    return view('project');
});

Route::post('GetProjectWithinDistance', "ProjectController@getProjectWithinDistance");

Route::get('/project/info/{id}', "ProjectController@index")->name("project.info");
Route::post('/project/info/{id}', "ProjectController@facetInfo")->name("project.info.facet");

Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});

Route::get('admin', function () {
    return redirect('beheer');
});
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('admin/logout', 'Auth\LoginController@logout');

Route::post('admin/authenticate', 'Auth\LoginController@authenticate');


Route::get('/media', "MediaController@index")->name('media');
Route::get('/getmedia/{name}', "MediaController@getMedia")->name('media.get');

Route::get('/comments/remove', "CommentController@removeComment")->name('comments.remove');
Route::post('/comments/add', "CommentController@addComment")->name('comments.add');

Route::get('details/{id}', "ProjectPointsController@GetDetails");
Route::get('getMediaFromProjectPoint/{id}', "ProjectPointsController@getMedia");
Route::get('/getAllProjectPoints', "ProjectPointsController@getAllPoints");
Route::get('/getAllProjectPointsFullInfo', "ProjectPointsController@getAllPointsFullInfo");

Route::get('getProjectPointIDs/{id}', "RoutesController@getProjectPointIDs");
Route::get('getProjectPoint/{projectPointId}', "ProjectPointsController@getProjectPointByID");
Route::get('getAllRoutes', "RoutesController@getAllRoutes");
Route::get('getProjectPointOfRoute/{id}', "RoutesController@getProjectPointOfRoute");

Route::group(['middleware' => ['auth']], function () {

    Route::get('beheer', 'ProjectController@main');

    Route::get('/beheer/project/aanmaken', 'ProjectController@create');

    Route::get('/admin/projectpoints', 'ProjectPointsController@viewProjectPoints')->middleware('auth');
    Route::get('/admin/projectpoint/create', 'ProjectPointsController@create')->middleware('auth');
    Route::get('/admin/projectpoint/getDetails/{id}','ProjectPointsController@edit')->middleware('auth');
    Route::post('/admin/addProjectPoint', 'ProjectPointsController@addProjectPoint')->middleware('auth');
    Route::post('/admin/updateProjectPoint', 'ProjectPointsController@update');
    Route::post('/admin/deleteProjectPoint', 'ProjectPointsController@destroy')->middleware('auth');
    Route::post('/beheer/createPoint', "ProjectPointsController@createPoint");
    Route::post('/beheer/updatePoint', "ProjectPointsController@updatePoint");
    Route::post('/beheer/removePoint', "ProjectPointsController@removePoint");

    Route::post('/beheer/removemedia', "MediaController@removeMedia");
    Route::post('/beheer/media', "MediaController@saveMedia");

    Route::post('/beheer/createProject', 'ProjectController@createProject');
    Route::post('/beheer/updateProject', 'ProjectController@update');
    Route::post('/beheer/removeProject', 'ProjectController@remove');
    Route::get('/beheer/edit/{id}','ProjectController@edit');
    Route::get('/beheer/projectpoints/', 'ProjectPointsController@index');

    Route::get('/admin/route', 'AdminRouteController@getView');
    Route::post('/admin/route/data', 'AdminRouteController@getRouteData');
    Route::post('/admin/route/create', 'AdminRouteController@createRoute');
    Route::post('/admin/route/remove', 'AdminRouteController@removeRoute');
    Route::post('/admin/route/points', 'AdminRouteController@getRoutePoints');
    Route::post('/admin/route/projects', 'AdminRouteController@getProjectPoint');
});

Route::get("/getAllVisitors", "VisitorController@getAllVisitors");
Route::post("/addVisitor", "VisitorController@addVisitormm");

Route::get("/searchForProject/{name}", "ProjectController@searchForName");
Route::get("/searchForProjectPoint/{name}", "ProjectPointsController@searchForName");
Route::post("/projectpoints/similarIntrestPoint", "ProjectPointsController@getSimilarInterestPoints");
Route::post("/projectpoints/similarProject", "ProjectPointsController@getSimilarProjects");

// Return only data
Route::get('/getCategories', 'MainPageController@getCatagories');
Route::get('/getProjects', 'ProjectController@getProjects');
Route::get("/getAllMapObjects", "ProjectController@getAllMapObjects");
Route::get('/getProject/{id}', 'ProjectController@getProject');
Route::get('/getMediaFromProject/{id}', 'ProjectController@getMedia');
Route::get('/getProjectNames', 'ProjectController@getProjectNames');
Route::get('/getSingleProjectPoint/{id}', 'ProjectPointsController@getSingleProjectPoint');


Route::get('/getProjectPoints', 'ProjectPointsController@getProjectPoints');

// Unnecessary : Could be deleted
Route::get('details', function() {
    abort(404);
});

Route::get('/leaflet', function(){
    return view('leafletExample');
});
