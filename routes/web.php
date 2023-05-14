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
Route::get('/filemanager','FilemanagerController@index');

Route::get('/', function () {
    return view('publish/index');
})->name('home');

Route::get('/sign-in.php', function () {
    return view('publish/sign-in');
});

Route::get('/sign-up.php', function () {
    return view('publish/sign-up');
});

Route::get('/course-sidebar.php', function () {
    return view('publish/course-sidebar');
});


Route::post('/publish/sign-up/paramCekNoKTP','publish\signupController@paramCekNoKTP')->name('publish/sign-up/paramCekNoKTP');
Route::post('/publish/sign-up/paramCekEmail','publish\signupController@paramCekEmail')->name('publish/sign-up/paramCekEmail');
Route::post('/publish/sign-up/paramCekPhone','publish\signupController@paramCekPhone')->name('publish/sign-up/paramCekPhone');
Route::post('/publish/sign-up/simpanData','publish\signupController@simpanData')->name('publish/sign-up/simpanData');

Route::post('/publish/validasi','publish\loginController@validasi')->name('publish/validasi');
Route::get('/publish/logout','publish\loginController@logout')->name('publish/logout');



Route::get('/course','publish\courseController@index')->name('course');


// Route::get('/upload', 'UploadController@upload')->name('upload');
// Route::post('/upload/proses', 'UploadController@proses_upload')->name('upload/proses');

//Route::get('/','loginController@index'); 

Route::get('/admin/login', 'admin\loginController@index');
Route::get('/admin/login/logout','admin\loginController@logout')->name('admin/login/logout');

Route::post('/admin/login/validasi','admin\loginController@validasi')->name('admin/login/validasi');


Route::get('/admin/dashboard','admin\dashboardController@index')->name('admin/dashboard');
// Route::post('/dashboard/case0','dashboardController@case0')->name('dashboard/case0');
// Route::post('/dashboard/case1','dashboardController@case1')->name('dashboard/case1');
// Route::post('/dashboard/case2','dashboardController@case2')->name('dashboard/case2');
// Route::post('/dashboard/case3','dashboardController@case3')->name('dashboard/case3');
// Route::post('/dashboard/case4','dashboardController@case4')->name('dashboard/case4');

//Route::post('/login', 'C_login@cek')->name('login');

//------------------------------------------Menu Employee-----------------------------------------------------------//
Route::get('/admin/menuEmployee','admin\menuEmployeeController@index')->name('admin/menuEmployee');
Route::post('/admin/menuEmployee/datatable_load','admin\menuEmployeeController@datatable_load')->name('admin/menuEmployee/datatable_load');

Route::post('/admin/menuEmployee/filtermenuEmployee','admin\menuEmployeeController@filtermenuEmployee')->name('admin/menuEmployee/filtermenuEmployee');
Route::post('/admin/menuEmployee/insertMenu','admin\menuEmployeeController@insertMenu')->name('admin/menuEmployee/insertMenu');
Route::post('/admin/menuEmployee/insertMenuWarehouse','admin\menuEmployeeController@insertMenuWarehouse')->name('admin/menuEmployee/insertMenuWarehouse');
Route::post('/admin/menuEmployee/insertMenuItemGroup','admin\menuEmployeeController@insertMenuItemGroup')->name('admin/menuEmployee/insertMenuItemGroup');
Route::post('/admin/menuEmployee/insertMenuItemType','admin\menuEmployeeController@insertMenuItemType')->name('admin/menuEmployee/insertMenuItemType');
Route::post('/admin/menuEmployee/insertMenuAccessType','admin\menuEmployeeController@insertMenuAccessType')->name('admin/menuEmployee/insertMenuAccessType');
// Route::post('/menu/tambahdataDetail','menuController@tambahdataDetail')->name('menu/tambahdataDetail');

// Route::get('/menu/form_rubahdata/{ID}','menuController@form_rubahdata')->name('menu/form_rubahdata');
// Route::post('/menu/rubahdataDetail','menuController@rubahdataDetail')->name('menu/rubahdataDetail');
//----------------------------------------------------------------------------------------------------------------//

//-------------------------------------------------MASTER------------------------------------------------------------------------------//

//------------------------------------------------Master Menu-------------------------------------------------------//
Route::get('/admin/masterItem','admin\masterItemController@index')->name('admin/masterItem');

Route::get('/admin/masterItem/form_tambahdata','admin\masterItemController@form_tambahdata')->name('admin/masterItem/form_tambahdata');
Route::post('/admin/masterItem/browse_SO','admin\masterItemController@browse_SO')->name('admin/masterItem/browse_SO');

Route::post('/admin/masterItem/paramSubCategory','admin\masterItemController@paramSubCategory')->name('admin/masterItem/paramSubCategory');

Route::post('/admin/masterItem/tambahdataDetail','admin\masterItemController@tambahdataDetail')->name('admin/masterItem/tambahdataDetail');

Route::get('/admin/masterItem/form_rubahdata/{ID}','admin\masterItemController@form_rubahdata')->name('admin/masterItem/form_rubahdata');
Route::post('/admin/masterItem/rubahdataDetail','admin\masterItemController@rubahdataDetail')->name('admin/masterItem/rubahdataDetail');
//----------------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------------------------------------//


//------------------------------------------------Master Menu-------------------------------------------------------//
Route::get('/admin/menu','admin\menuController@index')->name('admin/menu');

Route::get('/admin/menu/form_tambahdata','admin\menuController@form_tambahdata')->name('admin/menu/form_tambahdata');
Route::post('/admin/menu/tambahdataDetail','admin\menuController@tambahdataDetail')->name('admin/menu/tambahdataDetail');

Route::get('/admin/menu/form_rubahdata/{ID}','admin\menuController@form_rubahdata')->name('admin/menu/form_rubahdata');
Route::post('/admin/menu/rubahdataDetail','admin\menuController@rubahdataDetail')->name('admin/menu/rubahdataDetail');
//----------------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------------------------------------//

//------------------------------------------------sales Invoice-------------------------------------------------------------//
Route::get('/admin/salesInvoice','admin\salesInvoiceController@index')->name('admin/salesInvoice');

Route::get('/admin/salesInvoice/form_tambahdata','admin\salesInvoiceController@form_tambahdata')->name('admin/salesInvoice/form_tambahdata');
Route::post('/admin/salesInvoice/browse_SO','admin\salesInvoiceController@browse_SO')->name('admin/salesInvoice/browse_SO');
Route::post('/admin/salesInvoice/paramItem','admin\salesInvoiceController@paramItem')->name('admin/salesInvoice/paramItem');
Route::post('/admin/salesInvoice/ambilDtl','admin\salesInvoiceController@ambilDtl')->name('admin/salesInvoice/ambilDtl');

Route::post('/admin/salesInvoice/tambahdataDetail','admin\salesInvoiceController@tambahdataDetail')->name('admin/salesInvoice/tambahdataDetail');

Route::get('/admin/salesInvoice/form_rubahdata/{ID}','admin\salesInvoiceController@form_rubahdata')->name('admin/salesInvoice/form_rubahdata');
Route::post('/admin/salesInvoice/rubahdataDetail','admin\salesInvoiceController@rubahdataDetail')->name('admin/salesInvoice/rubahdataDetail');
//----------------------------------------------------------------------------------------------------------------//



//------------------------------------------------AR payment Rcv-------------------------------------------------------------//
Route::get('/admin/arPaymentRcv','admin\arPaymentRcvController@index')->name('admin/arPaymentRcv');

Route::get('/admin/arPaymentRcv/form_tambahdata','admin\arPaymentRcvController@form_tambahdata')->name('admin/arPaymentRcv/form_tambahdata');
Route::post('/admin/arPaymentRcv/browse_SO','admin\arPaymentRcvController@browse_SO')->name('admin/arPaymentRcv/browse_SO');
Route::post('/admin/arPaymentRcv/paramCustomer','admin\arPaymentRcvController@paramCustomer')->name('admin/arPaymentRcv/paramCustomer');
Route::post('/admin/arPaymentRcv/paramPeriod','admin\arPaymentRcvController@paramPeriod')->name('admin/arPaymentRcv/paramPeriod');
Route::post('/admin/arPaymentRcv/ambilDtl','admin\arPaymentRcvController@ambilDtl')->name('admin/arPaymentRcv/ambilDtl');

Route::post('/admin/arPaymentRcv/tambahdataDetail','admin\arPaymentRcvController@tambahdataDetail')->name('admin/arPaymentRcv/tambahdataDetail');

Route::get('/admin/arPaymentRcv/form_rubahdata/{ID}','admin\arPaymentRcvController@form_rubahdata')->name('admin/arPaymentRcv/form_rubahdata');
Route::post('/admin/arPaymentRcv/rubahdataDetail','admin\arPaymentRcvController@rubahdataDetail')->name('admin/arPaymentRcv/rubahdataDetail');
//----------------------------------------------------------------------------------------------------------------//


//------------------------------------------------Account Ledger-------------------------------------------------------------//
Route::get('/admin/rAccountLedger','admin\rAccountLedgerController@index')->name('admin/rAccountLedger');
Route::post('/admin/rAccountLedger/browse_SO','admin\rAccountLedgerController@browse_SO')->name('admin/rAccountLedger/browse_SO');
//----------------------------------------------------------------------------------------------------------------//

//------------------------------------------------Account Mutation-------------------------------------------------------------//
Route::get('/admin/rAccountMutation','admin\rAccountMutationController@index')->name('admin/rAccountMutation');
Route::post('/admin/rAccountMutation/browse_SO','admin\rAccountMutationController@browse_SO')->name('admin/rAccountMutation/browse_SO');
//----------------------------------------------------------------------------------------------------------------//
