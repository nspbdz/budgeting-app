<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Master\UserController;
// use App\Http\Controllers\Master\RoleController;
// use App\Http\Controllers\Master\AssetController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('home');

Route::group( ['middleware' => 'auth' ], function()
{
    Route::group(['prefix' => 'master'], function ()
    {

        Route::resource('user', 'Master\UserController');
        // Route::post('user/status', 'Master\UserController@status')->name('user.status');

        Route::resource('role', 'Master\RoleController');
        // Route::post('role/status', 'Master\RoleController@status')->name('role.status');

        Route::resource('project', 'Master\ProjectController');
        Route::post('project/status', 'Master\ProjectController@status')->name('project.status');

        Route::resource('adp', 'Master\MasterADPController');
        Route::post('adp/status', 'Master\MasterADPController@status')->name('adp.status');

       
        Route::resource('department', 'Master\DepartementController');
     
        Route::resource('asset', 'Master\AssetController');
        Route::post('asset/status', 'Master\AssetController@status')->name('asset.status');

        Route::resource('team', 'Master\TeamController');
        Route::post('team/status', 'Master\TeamController@status')->name('team.status');

        Route::resource('internalorder', 'Master\InternalOrderController');
        Route::post('internalorder/status', 'Master\InternalOrderController@status')->name('internalorder.status');
    });
    Route::post('user/status', 'Master\UserController@status')->name('user.status');
    Route::get('user/exportpdf', 'Master\UserController@exportpdf')->name('user.exportpdf');
   
    Route::post('role/status', 'Master\RoleController@status')->name('role.status');
    Route::get('role/exportpdf', 'Master\RoleController@exportpdf')->name('role.exportpdf');

    Route::post('project/status', 'Master\ProjectController@status')->name('project.status');
    Route::get('project/exportpdf', 'Master\ProjectController@exportpdf')->name('project.exportpdf');

    Route::post('team/status', 'Master\TeamController@status')->name('team.status');
    Route::get('team/exportpdf', 'Master\TeamController@exportpdf')->name('team.exportpdf');

    Route::post('internalorder/status', 'Master\InternalOrderController@status')->name('internalorder.status');
    Route::get('internalorder/exportpdf', 'Master\InternalOrderController@exportpdf')->name('internalorder.exportpdf');

    Route::post('asset/status', 'Master\AssetController@status')->name('asset.status');
    Route::get('asset/exportpdf', 'Master\AssetController@exportpdf')->name('asset.exportpdf');

    Route::post('adp/status', 'Master\MasterADPController@status')->name('adp.status');
    Route::get('adp/exportpdf', 'Master\MasterADPController@exportpdf')->name('adp.exportpdf');

    Route::post('department/status', 'Master\DepartementController@status')->name('department.status');
    Route::get('department/export', 'Master\DepartementController@export')->name('department.export');
    Route::get('department/exportpdf', 'Master\DepartementController@exportpdf')->name('department.exportpdf');
    Route::get('/pegawai/cetak_pdf', 'PegawaiController@cetak_pdf');


    Route::resource('inputproject', 'InputProjectController');
    Route::post('inputproject/status', 'InputProjectController@status')->name('inputproject.status');
    Route::get('inputproject/history-approval/{input_project}', 'InputProjectController@history')->name('inputproject.history');
    Route::get('export_excelinputproject', 'InputProjectController@export_excel');
    Route::get('cetak_pdf', 'InputProjectController@cetak_pdf');
    
    Route::resource('approval', 'ApprovalController');
    Route::post('/approval/getPm/{approval}', 'ApprovalController@getPm')->name('approval.getPm');
    Route::post('/approval/getPnp/{approval}', 'ApprovalController@getPnp')->name('approval.getPnp');
    Route::post('/approval/getApproval', 'ApprovalController@getApproval')->name('approval.getApproval');
    Route::get('approval/pm/{approval}', 'ApprovalController@pm')->name('approval.pm');
    Route::get('approval/pnp/{approval}', 'ApprovalController@pnp')->name('approval.pnp');
    Route::post('approval/approve', 'ApprovalController@approve')->name('approval.approve');
    Route::get('approval/downloads/{file}', 'VerifikasiLogbookController@downloads')->name('verifikasiupload.downloads');


    Route::resource('reporting', 'ReportingController');
    Route::post('reporting/status', 'ReportingController@status')->name('reporting.status');
    Route::post('/reporting/getReporting', 'ReportingController@getReporting')->name('reporting.getReporting');



    Route::resource('reclass', 'ReClassController');
    Route::post('reclass/status', 'ReClassController@status')->name('reclass.status');
    Route::post('/reclass/getReClass', 'ReClassController@getReClass')->name('reclass.getReClass');


    Route::resource('crosscheckdata', 'CrossCheckDataController');
    Route::post('crosscheckdata/status', 'CrossCheckDataController@status')->name('crosscheckdata.status');
    Route::post('/crosscheckdata/getReporting', 'CrossCheckDataController@getReporting')->name('crosscheckdata.getReporting');


    Route::resource('verifikasilogbook', 'VerifikasiLogbookController');
    Route::get('verifikasilogbook/upload-file/{id}', 'VerifikasiLogbookController@upload')->name('upload-file.upload');
    Route::get('verifikasilogbook/upload-file/{id}', 'VerifikasiLogbookController@update')->name('upload-file.upload');

    Route::post('verifikasilogbook/status', 'VerifikasiLogbookController@status')->name('verifikasilogbook.status');

    Route::post('verifikasilogbook/status', 'VerifikasiLogbookController@status')->name('verifikasilogbook.status');
    Route::post('/verifikasilogbook/getVerifikasi', 'VerifikasiLogbookController@getVerifikasi')->name('verifikasilogbook.getVerifikasi');

    Route::get('verifikasilogbook/pm/{approval}', 'VerifikasiLogbookController@pm')->name('verifikasilogbook.pm');
    Route::get('verifikasilogbook/pnp/{approval}', 'VerifikasiLogbookController@pnp')->name('verifikasilogbook.pnp');
    Route::get('verifikasilogbook/file/{approval}', 'VerifikasiLogbookController@file')->name('verifikasilogbook.file');
    // Route::post('verifikasilogbook/download', 'VerifikasiLogbookController@download')->name('verifikasilogbook.download');
    Route::get('verifikasilogbook/{file}', 'VerifikasiLogbookController@download')->name('download');
    // Route::get('/download', 'VerifikasiLogbookController@download');
    // Route::resource('/', 'DashboardControllersidebar')->name('/.sidebar');
    Route::get('verifikasilogbook/downloads/{file}', 'VerifikasiLogbookController@downloads')->name('verifikasilogbook.downloads');
    Route::get('verifikasilogbook/tampilkanfile/{file}', 'VerifikasiLogbookController@tampilkanfile')->name('verifikasilogbook.tampilkanfile');

    Route::get('download', 'VerifikasiLogbookController@download');

    // Route::resource('dashboard', 'DashboardController');
    Route::resource('/', 'HomeController');

    Route::get('/home', 'HomeController@index')->name('home');
    // InternalOrderController
    Route::resource('monitoringupload', 'MonitoringUploadController');
    Route::post('monitoringupload/status', 'MonitoringUploadController@status')->name('adp.status');

});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
