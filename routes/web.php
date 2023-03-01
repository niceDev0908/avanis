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


Route::get('/', function () {
    return view('auth.login');
})->name('home');
Route::post('save-register','Auth\RegisterController@register_store')->name('save-register');
/*Reset password routes starts*/
Route::get('forgot-password','Auth\ForgotPasswordController@index')->name('forgot-password');
Route::post('forgot-password-action','Auth\ForgotPasswordController@forgotPassword')->name('forgot-password-action');
Route::get('reset-passwords/{token}/{email}','Auth\ResetPasswordController@resetPassword')->name('reset-passwords');
Route::post('reset-password-actions','Auth\ResetPasswordController@resetPasswordAction')->name('reset-password-actions');
/*Reset password routes ends*/

/* Adobe api testing routes starts */
Route::get('adobe/upload','AdobeController@view_form')->name('adobe.upload');
Route::post('adobe/upload-doc-action','AdobeController@upload_doc_action')->name('adobe.upload-doc-action');
/* Adobe api testing routes ends */

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::post('upload-requested-document','DashboardController@upload_requested_document_action')->name('upload-requested-document');
    Route::get('view-requested-uploaded-documents/{action_document_id}','DashboardController@view_requested_uploaded_documents')->name('view-requested-uploaded-documents');
    Route::post('dashboard/after_file_uploaded','DashboardController@after_file_uploaded')->name('after-file-uploaded');
    Route::get('actions/{id}','DocumentController@actions')->name('actions');
    Route::get('action-files/{id}','DocumentController@action_files')->name('action-files');
    Route::get('change-password','ProfileController@changePasswordView')->name('change-password');
    Route::post('change-password-action','ProfileController@changePasswordAction')->name('change-password-action');
    Route::get('manage-profile','ProfileController@manage_profile')->name('manage-profile');
    Route::post('manage-profile-action','ProfileController@manage_profile_action')->name('manage-profile-action');
    Route::get('actions/documents/{id}','DocumentController@index')->name('actions.documents');
    Route::get('messages','MessageController@index')->name('messages');
    Route::post('messages/send-message-thread','MessageController@send_message')->name('send-message-thread');
    Route::get('receivables','ReceivablesController@index')->name('receivables');
    Route::post('receivables-action','ReceivablesController@addReceivablesAction')->name('receivables-action');
    Route::get('transfers', 'TransferController@index')->name('transfers');
    Route::post('transfers-action', 'TransferController@addTransferAction')->name('transfers-action');
    Route::get('pmc-management', 'PMCController@index')->name('pmc-management');
    Route::post('pmc-management-action', 'PMCController@addPmcActions')->name('pmc-management-action');
    Route::get('annual-compliance','AnnualComplianceController@index')->name('annual-compliance');
    Route::post('annual-compliance-action','AnnualComplianceController@addAnnualComplianceAction')->name('annual-compliance-action');
    Route::get('annual-compliance-file-download/{slug}','AnnualComplianceController@annualComplianceFileDownload')->name('annual-compliance-file-download');
    Route::get('delete-account','ProfileController@delete_account')->name('delete-account');
    Route::delete('delete-account-action/{id}','ProfileController@delete_account_action')->name('delete-account-action');
    Route::get('receivable-actions','ReceivablesController@receivable_actions')->name('receivable-actions');
    Route::get('user-assets','AssetsController@index')->name('user-assets');
    Route::post('add-assets-action','AssetsController@create_edit_assets')->name('add-assets-action');
    Route::delete('user-assets/delete/{id}','AssetsController@delete_asset')->name('user-assets.delete');
    Route::post('user-assets/send-notification', 'AssetsController@sendNotification')->name('user-assets.send-notification');
});

/* Routes for Admin Panel start */
Route::get('admin', 'Admin\LoginController@index')->name('admin');
Route::post('admin/login-action', 'Admin\LoginController@adminLogin')->name('admin-login-action');
Route::post('admin/forgot-password-action', 'Admin\LoginController@adminForgotPassword')->name('admin-forgot-password-action');
Route::get('admin/reset-password/{token}/{email}','Admin\LoginController@resetPassword')->name('reset-password');
Route::post('admin/reset-password-action','Admin\LoginController@resetPasswordAction')->name('admin-reset-password-action');

Route::group(['middleware' => ['auth', 'is_admin']], function() {
    Route::get('admin/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::get('admin/myprofile', 'Admin\LoginController@myprofile')->name('admin.myprofile');
    Route::post('admin/myprofile-action', 'Admin\LoginController@myprofile_action')->name('admin.myprofile-action');
    Route::get('admin/myprofile-delete-image/{id}','Admin\LoginController@deleteProfileImage')->name('admin.myprofile-delete-image');
    Route::get('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');

    /*Routes for role module start*/
    Route::resource('admin/roles', 'Admin\RoleController');
    Route::get('admin/roles-data', 'Admin\RoleController@data')->name('roles-data');
    Route::get('admin/roles/{id}/delete', 'Admin\RoleController@destroy')->name('roles.destroy');
    /*Routes for role module ends*/

    /*Routes for user module start*/
    Route::get('admin/users','Admin\UserController@index')->name('admin.users');
    Route::get('admin/users/create','Admin\UserController@create_edit')->name('admin.users.create');
    Route::get('admin/users/edit/{id}', 'Admin\UserController@create_edit')->name('admin.users.edit');
    Route::post('admin/users/create_edit_action','Admin\UserController@create_edit_action')->name('admin.users.store');
    Route::delete('admin/users/delete/{id}', 'Admin\UserController@destroy')->name('admin.users.delete');
    Route::post('admin/users/update-selected-records-status', 'Admin\UserController@update_selected_records_status')->name('admin.users.update-selected-records-status');
    Route::post('admin/users/delete-selected-records', 'Admin\UserController@delete_selected_records')->name('admin.users.delete-selected-records');
    Route::get('admin/users/delete_image/{id}','Admin\UserController@deleteUserImage')->name('admin.users.delete_image');
    
    Route::post('admin/users/create_edit_recipients_action','Admin\UserController@create_edit_recipients_action')->name('admin.recipients.store');
    Route::get('admin/users/asset_log/{id}', 'Admin\UserController@view_users_assets_log')->name('admin.users.asset-log');

    Route::get('admin/users/download-documents/{id}', 'Admin\UserController@download_user_documents')->name('admin.users.download-documents');
    /*Routes for user module ends*/
    
    /*Routes for receivables module start*/
    Route::get('admin/receivables','Admin\ReceivablesController@index')->name('admin.receivables');
    Route::delete('admin/receivables/delete/{id}', 'Admin\ReceivablesController@destroy')->name('admin.receivables.delete');
    Route::get('admin/receivables/recipients/view/{id}', 'Admin\ReceivablesController@receivables_recipients_view')->name('admin.receivables_recipients.view');
    Route::post('admin/receivables/recipients/action', 'Admin\ReceivablesController@receivables_recipients_action')->name('admin.receivable.recipients.store');
    /*Routes for user module ends*/
    
    /*Routes for annual compliance module start*/
    Route::get('admin/annual-compliance','Admin\AnnualComplianceController@index')->name('admin.annual-compliance');
    Route::get('admin/annual-compliance/{id}','Admin\AnnualComplianceController@viewAnnualCompliance')->name('admin.annual-compliance.view');
    Route::post('admin/approve-annual-compliance','Admin\AnnualComplianceController@approveAnnualCompliance')->name('admin.approve-annual-compliance');
    Route::get('admin/annual-compliance-file-download/{slug}/{id}','Admin\AnnualComplianceController@annualComplianceFileDownload')->name('admin-annual-compliance-file-download');
    /*Routes for user module ends*/

    /*Routes for admin_action module starts*/
    Route::get('admin/users/documents/{user_id}','Admin\UserActionController@index')->name('admin.users.documents');
    Route::get('admin/users/documents/{user_id}/create','Admin\UserActionController@create_edit')->name('admin.users.documents.create');
    Route::post('admin/users/documents/create_edit_action','Admin\UserActionController@create_edit_action')->name('admin.users.documents.store');
    Route::get('admin/users/documents/{user_id}/{edit}/{id}', 'Admin\UserActionController@create_edit')->name('admin.users.documents.edit');
    Route::delete('admin/users/documents/delete/{id}', 'Admin\UserActionController@destroy')->name('admin.users.documents.delete');
    Route::post('admin/users/documents/update-selected-records-status', 'Admin\UserActionController@update_selected_records_status')->name('admin.users.documents.update-selected-records-status');
    Route::post('admin/users/documents/delete-selected-records', 'Admin\UserActionController@delete_selected_records')->name('admin.users.documents.delete-selected-records');
    Route::delete('admin/users/documents/delete_action_document/{id}','Admin\UserActionController@delete_action_document')->name('admin.users.documents.delete_action_document');
    /*Routes for admin_action module ends*/

    Route::post('admin/users/documents/upload-document','Admin\UserActionController@upload_adobe_document')->name('admin.users.documents.upload-document');

    /*Routes for admin_message_module starts*/
    Route::get('admin/users/messages/{user_id}','Admin\MessageController@index')->name('admin.users.messages');
    Route::post('admin/users/messages/send-message-thread','Admin\MessageController@send_message_thread')->name('admin.users.messages.send-message-thread');
    Route::delete('admin/messages/delete/{id}', 'Admin\MessageController@destroy')->name('admin.messages.delete');
    /*Routes for admin_message_module ends*/

    /*Routes for setting module starts*/
    Route::get('admin/settings','Admin\SettingController@index')->name('admin.settings');
    Route::get('admin/settings/edit','Admin\SettingController@create_edit')->name('admin.settings.edit');
    Route::post('admin/settings/create_edit_action','Admin\SettingController@create_edit_action')->name('admin.settings.store');
    Route::get('admin/settings/edit/{id}', 'Admin\SettingController@create_edit')->name('admin.settings.edit');
    /*Routes for setting module ends*/
    
    /*Routes for setting module starts*/
    Route::get('reports','Admin\ReportController@index')->name('admin.reports');
    /*Routes for setting module ends*/
    
    //Download csv
    Route::post('admin/reports/export', 'Admin\ReportController@export')->name('admin.reports.export');
    Route::post('admin/users/export','Admin\ReportController@export_users')->name('admin.users.export');
    
});
/*Routes for Admin Panel ends*/
