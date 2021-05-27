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

Route::get('/', function () {
    // return view('welcome');
    return Redirect::to('login');
});
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/jobs', [App\Http\Controllers\JobOppController::class, 'jobs'])->name('jobs');
Route::get('/jobs/{id}', [App\Http\Controllers\JobOppController::class, 'jobs_view'])->name('jobs.view');
Route::post('/jobs/{id}/apply', [App\Http\Controllers\JobOppController::class, 'apply'])->name('jobs.apply');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
Route::get('admin', 'App\Http\Controllers\AdminController@index')->name('admin');

Route::group(['middleware' => ['role:superadministrator']], function () {

Route::group(['middleware' => 'auth'], function () {
Route::get('admin', 'App\Http\Controllers\AdminController@index')->name('admin');
Route::post('users/suspend/{id}', 'App\Http\Controllers\UserController@inactivate')->name('user.inactivate');
Route::post('users/reactivate/{id}', 'App\Http\Controllers\UserController@reactivate')->name('user.reactivate');
Route::get('users/edit/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');
Route::post('users/edit_save/{id}', 'App\Http\Controllers\UserController@edit_save')->name('user.edit_save');
// Route::get('users', function () {
// 		return view('adminpages.users');
// 	})->name('users');
Route::get('designations', 'App\Http\Controllers\DesignationsController@index')->name('designations.index');
Route::get('designations/create', 'App\Http\Controllers\DesignationsController@create')->name('designations.create');

Route::get('designations/{id}', 'App\Http\Controllers\DesignationsController@designee')->name('designation.designee');
Route::post('designations/store', 'App\Http\Controllers\DesignationsController@store')->name('designations.store');

Route::post('designations/{id}/remove', 'App\Http\Controllers\DesignationsController@remove_designee')->name('designation.remove_designee');

Route::get('/job_opportunity/{id}/view', 'App\Http\Controllers\JobOppController@view')->name('job_opportunity.view');

Route::get('/job_opportunity/{id}/profile', 'App\Http\Controllers\JobOppController@view_internal_profile')->name('job_opportunity.internal_app_profile');

Route::get('/job_opportunity/{id}/print_profile', 'App\Http\Controllers\JobOppController@print_internal_profile')->name('job_opportunity.internal_print_profile');

Route::get('/job_opportunity/{id}/print_externalprofile', 'App\Http\Controllers\JobOppController@print_external_profile')->name('job_opportunity.external_print_profile');

Route::get('/job_opportunity/{id}/externalprofile', 'App\Http\Controllers\JobOppController@view_external_profile')->name('job_opportunity.external_app_profile');



Route::get('designations/{id}/designate', 'App\Http\Controllers\DesignationsController@designate_new')->name('designation.designate_new');

Route::post('designations/{id}/store', 'App\Http\Controllers\DesignationsController@designate_store')->name('designation.designate_store');

Route::get('designations/{id}/edit', 'App\Http\Controllers\DesignationsController@edit')->name('designation.edit');
Route::post('designations/{id}/delete', 'App\Http\Controllers\DesignationsController@delete')->name('designation.delete');
Route::post('designations/{id}/update', 'App\Http\Controllers\DesignationsController@update')->name('designation.update');

// Route::resource('designations', 'App\Http\Controllers\DesignationsController');
Route::resource('users', 'App\Http\Controllers\UserController');
Route::resource('acadyear', 'App\Http\Controllers\AcadyearController');

Route::resource('tasks', 'App\Http\Controllers\TasksController');

Route::resource('job_opportunity', 'App\Http\Controllers\JobOppController');


Route::resource('evaluation_kpi', 'App\Http\Controllers\EvalDetailsController');



Route::post('evaluation_kpi/{id}/delete', 'App\Http\Controllers\EvalDetailsController@delete')->name('evalkpi.delete');
Route::get('evaluation_kpi/{id}/editkpi', 'App\Http\Controllers\EvalDetailsController@edit_kpi')->name('evalkpi.edit_kpi');

Route::post('evaluation_kpi/{id}/editsave', 'App\Http\Controllers\EvalDetailsController@edit_save')->name('evalkpi.edit_save');

Route::get('department/{id}/view', 'App\Http\Controllers\DepartmentController@view')->name('dept.view');

Route::post('department/{id}/add_employee', 'App\Http\Controllers\DepartmentController@add_employee')->name('dept.add_employee');

Route::post('department/{id}/{dept_id}remove_employee', 'App\Http\Controllers\DepartmentController@remove_employee')->name('dept.remove_employee');

Route::post('department/{id}/delete', 'App\Http\Controllers\DepartmentController@delete')->name('dept.delete');
Route::post('department/{id}/edit', 'App\Http\Controllers\DepartmentController@edit');
Route::post('department/{id}/update', 'App\Http\Controllers\DepartmentController@update')->name('dept.update');;

Route::get('department/{id}/designate_head/{emp_id}', 'App\Http\Controllers\DepartmentController@designate_head')->name('dept.designate');

Route::resource('department', 'App\Http\Controllers\DepartmentController');

Route::get('employees/{id}/profile', 'App\Http\Controllers\EmployeesController@view_profile')->name('employee.view_profile');

Route::post('/employees/{id}/add_service_record', 'App\Http\Controllers\EmployeesController@add_service_record')->name('employee.add_service_record');



Route::get('employees/print', 'App\Http\Controllers\EmployeesController@print_list')->name('employee.print_list');

Route::resource('employees', 'App\Http\Controllers\EmployeesController');

Route::post('/job_opportunity/{id}/publish', 'App\Http\Controllers\JobOppController@publish')->name('job_opportunity.publish');

Route::get('/job_opportunity/{id}/print', 'App\Http\Controllers\JobOppController@print_jobopp')->name('job_opportunity.print_jobopp');

Route::get('/job_opportunity/{id}/edit', 'App\Http\Controllers\JobOppController@edit')->name('job_opportunity.edit_jobopp');
Route::post('/job_opportunity/{id}/save_edit', 'App\Http\Controllers\JobOppController@save_edit')->name('job_opportunity.save_edit_jobopp');
Route::get('/applicant/{id}/resume', 'App\Http\Controllers\JobOppController@download')->name('job_opportunity.download');


Route::post('/job_opportunity/{id}/unpublish', 'App\Http\Controllers\JobOppController@unpublish')->name('job_opportunity.unpublish');

Route::post('/job_opportunity/{id}/delete', 'App\Http\Controllers\JobOppController@delete')->name('job_opportunity.delete');


Route::get('/positions/type', 'App\Http\Controllers\PositionsController@postype')->name('position.postype');
Route::get('/positions/addtype', 'App\Http\Controllers\PositionsController@create_type')->name('position.create_type');
Route::resource('positions', 'App\Http\Controllers\PositionsController');

Route::post('/positions/edit/{id}', 'App\Http\Controllers\PositionsController@edit')->name('position.edit');
Route::get('/positions/delete/{id}', 'App\Http\Controllers\PositionsController@delete')->name('position.delete');


Route::get('/evaluations/set/{id}', 'App\Http\Controllers\EvaluationsController@setevaluation')->name('evaluation.setevaluation');

Route::get('/evaluations/view/{id}', 'App\Http\Controllers\EvaluationsController@view_evaluation')->name('evaluation.view_evaluation');

Route::get('/evaluations/{id}/published/view', 'App\Http\Controllers\EvaluationsController@viewpublished_evaluation')->name('evaluation.viewpublished_evaluation');

Route::post('/evaluations/{id}/delete', 'App\Http\Controllers\EvaluationsController@delete_evaluation')->name('evaluation.delete_evaluation');

Route::post('/evaluations/{id}/publish', 'App\Http\Controllers\EvaluationsController@publish_evaluation')->name('evaluation.publish_evaluation');

Route::post('/evaluations/{id}/show', 'App\Http\Controllers\EvaluationsController@show_evaluation')->name('evaluation.show_evaluation');

Route::post('/evaluations/{id}/hide', 'App\Http\Controllers\EvaluationsController@hide_evaluation')->name('evaluation.hide_evaluation');

Route::post('/evaluations/reset/{id}', 'App\Http\Controllers\EvaluationsController@resetevaluation')->name('evaluation.resetevaluation');

Route::get('/evaluations/{id}/{dept_id}', 'App\Http\Controllers\EvaluationsController@department_evaluation')->name('evaluation.department_evaluation');

Route::get('/evaluations/{id}/evaluate/{emp_id}', 'App\Http\Controllers\EvaluationsController@admin_evaluate_employee')->name('evaluation.admin_evaluate_employee');

Route::post('/evaluations/{id}/evaluate/{emp_id}/save', 'App\Http\Controllers\EvaluationsController@admin_save_evaluation')->name('evaluation.admin_save_evaluation');

Route::get('/evaluations/{id}/evaluate/{emp_id}/result', 'App\Http\Controllers\EvaluationsController@employee_evaluation_result')->name('evaluation.employee_evaluation_result');



Route::resource('evaluations', 'App\Http\Controllers\EvaluationsController');
Route::post('/evaluations/set/{id}', 'App\Http\Controllers\EvaluationsController@set_store')->name('eval.set_store');

Route::get('tasks/{id}/assign', 'App\Http\Controllers\TasksController@assign_task')->name('task.assign');

Route::post('tasks/{id}/delete', 'App\Http\Controllers\TasksController@delete_task')->name('task.delete');

Route::get('/task/for_assignment', 'App\Http\Controllers\TasksController@forassign')->name('task.forassign');

Route::get('/task/in_progress', 'App\Http\Controllers\TasksController@in_progress')->name('task.in_progress');

Route::get('/task/finished', 'App\Http\Controllers\TasksController@finished')->name('task.finished');

Route::post('tasks/{id}/assign_task', 'App\Http\Controllers\TasksController@assign_task_touser')->name('task.assign_task_user');
Route::get('tasks/{id}/task_assigned', 'App\Http\Controllers\TasksController@task_assigned')->name('task.task_assigned');
Route::post('/task/{id}/task_milestone', 'App\Http\Controllers\TasksController@task_milestone')->name('task.milestone');



Route::post('tasks/{id}/edit', 'App\Http\Controllers\TasksController@edit')->name('task.edit');
Route::post('tasks/{id}/update', 'App\Http\Controllers\TasksController@update')->name('task.update');



 Route::get('sem/{id}', 'App\Http\Controllers\SemController@index')->name('sem.index');
 Route::post('sem/{id}/update', 'App\Http\Controllers\SemController@update')->name('sem.update');

Route::get('requests', 'App\Http\Controllers\UserSelfServiceController@view_requests')->name('req.view');

Route::get('exit_applications', 'App\Http\Controllers\UserExitApplicationController@view_exit_app')->name('exit.view');

Route::get('exit_applications/interview/{id}', 'App\Http\Controllers\UserExitApplicationController@view_exit_interview')->name('exit.view_exit_interview');

Route::get('exit_applications/interview/{id}/print', 'App\Http\Controllers\UserExitApplicationController@print_exit_interview')->name('exit.print_exit_interview');

Route::get('exit_applications/{id}', 'App\Http\Controllers\UserExitApplicationController@exit_application')->name('exit.view_application');

Route::get('exit_applications/{id}/print', 'App\Http\Controllers\UserExitApplicationController@print_exit_application')->name('exit.print_application');

Route::resource('exit_interview_questions', 'App\Http\Controllers\interview_questionsController');
Route::get('save_question', 'App\Http\Controllers\interview_questionsController@store')->name('exit.store');

Route::get('update_question/{id}', 'App\Http\Controllers\interview_questionsController@update')->name('exit.update');

Route::get('delete_question/{id}', 'App\Http\Controllers\interview_questionsController@delete')->name('exit.delete');

Route::get('exit_applications/{id}/approve', 'App\Http\Controllers\UserExitApplicationController@approve')->name('exit.approve');




// Route::get('employees', function () {
// 		return view('adminpages.employee_list');
// 	})->name('employees');
// Route::get('acadyear', function () {
// 		return view('adminpages.acadyear');
// 	})->name('acadyear');
Route::get('add_user', function () {
		return view('adminpages.add_user');
	})->name('add_user');


});
});
Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => ['role:superadministrator|user']], function () {
Route::group(['middleware' => 'auth'], function () {
	Route::get('employees/{id}/print', 'App\Http\Controllers\EmployeesController@print_profile')->name('employee.print_profile');
	Route::get('/evaluations/{id}/evaluate/{emp_id}/printresult', 'App\Http\Controllers\EvaluationsController@admin_print_result')->name('evaluation.print_evaluation_result');
	 // Route::resource('users', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	// Route::get('users/edit', 'App\Http\Controllers\UserController@edit')->name('user.edit')

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::get('change_password', ['as' => 'profile.change_pass', 'uses' => 'App\Http\Controllers\ProfileController@change_pass']);

	Route::post('profile\pic', ['as' => 'profiles.picture', 'uses' => 'App\Http\Controllers\ProfileController@profile_picture']);

	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::put('profile/password/change', ['as' => 'profile.change_password', 'uses' => 'App\Http\Controllers\ProfileController@change_password']);

	Route::get('/userprofile/educ','App\Http\Controllers\UserProfileController@educbg');
	Route::get('/userprofile/eligibility','App\Http\Controllers\UserProfileController@eligibility');
	Route::get('/userprofile/work_experience','App\Http\Controllers\UserProfileController@workexp');
	Route::get('/userprofile/ldi','App\Http\Controllers\UserProfileController@ldi');
	Route::post('/userprofile/educbg','App\Http\Controllers\UserProfileController@educstore')->name('educbg.store');
	Route::post('/userprofile/eligibility','App\Http\Controllers\UserProfileController@eligibility_store')->name('eligibility.store');
	Route::post('/userprofile/update','App\Http\Controllers\UserProfileController@update')->name('user_profile.update');
	Route::post('/userprofile/educbg/{id}','App\Http\Controllers\UserProfileController@educ_update')->name('educbg.update');
	Route::post('/userprofile/eligibility/{id}','App\Http\Controllers\UserProfileController@eligibility_update')->name('eligibility.update');
	Route::post('/userprofile/educbg/{id}/delete','App\Http\Controllers\UserProfileController@educ_delete')->name('educbg.delete');
	Route::post('/userprofile/eligibility/{id}/delete','App\Http\Controllers\UserProfileController@eligibility_delete')->name('eligibility.delete');
	Route::post('/userprofile/work_experience','App\Http\Controllers\UserProfileController@workexp_store')->name('workexp.store');
	Route::post('/userprofile/work_experience/{id}','App\Http\Controllers\UserProfileController@workexp_update')->name('workexp.update');
	Route::post('/userprofile/work_experience/{id}/delete','App\Http\Controllers\UserProfileController@workexp_delete')->name('workexp.delete');
	Route::post('/userprofile/ldi','App\Http\Controllers\UserProfileController@ldi_store')->name('ldi.store');
	Route::post('/userprofile/ldi/{id}','App\Http\Controllers\UserProfileController@ldi_update')->name('ldi.update');
	Route::post('/userprofile/ldi/{id}/delete','App\Http\Controllers\UserProfileController@ldi_delete')->name('ldi.delete');

	Route::get('/directory', 'App\Http\Controllers\EmployeesController@directory')->name('directory');



	Route::get('/usertask/{id}/ongoing', 'App\Http\Controllers\UserTaskController@on_goingtask')->name('utask.ongoing');

	Route::post('/usertask/{id}/task_milestone', 'App\Http\Controllers\UserTaskController@task_milestone')->name('utask.milestone');

	Route::get('/usertask/on-going', 'App\Http\Controllers\UserTaskController@ongoing')->name('utask.task_ongoing');

	Route::get('/usertask/finished', 'App\Http\Controllers\UserTaskController@finished')->name('utask.task_finished');
	Route::get('/usertask/{id}/task_finished', 'App\Http\Controllers\UserTaskController@task_finished')->name('utask.finished');

	Route::get('/user_jobopportunity/{id}', 'App\Http\Controllers\UserJobOppController@viewjob')->name('joboppuser.viewjob');

	Route::get('/user_jobopportunity/{id}/view', 'App\Http\Controllers\UserJobOppController@view_application')->name('joboppuser.view_application');

	Route::get('/evaluation/{id}/myresult', 'App\Http\Controllers\UserEvalController@myresult')->name('usereval.evaluation_myresult');

	Route::get('/evaluation/{id}/print_myresult', 'App\Http\Controllers\UserEvalController@printmyresult')->name('usereval.evaluation_print_myresult');

	Route::get('/evaluation/{id}/{dept_id}', 'App\Http\Controllers\UserEvalController@evaluations')->name('usereval.evaluations');

	Route::get('/evaluation/{id}/evaluate/{emp_id}', 'App\Http\Controllers\UserEvalController@evaluate_employee')->name('usereval.evaluate_employee');

	Route::post('/evaluation/{id}/evaluate/{emp_id}/save', 'App\Http\Controllers\UserEvalController@save_evaluation')->name('usereval.save_evaluation');

	Route::get('/evaluation/{id}/evaluate/{emp_id}/result', 'App\Http\Controllers\UserEvalController@evaluation_result')->name('usereval.evaluation_result');

	Route::post('request/make_request', 'App\Http\Controllers\UserSelfServiceController@create')->name('req.create');

	Route::post('request/mark_ready/{id}/{emp_id}', 'App\Http\Controllers\UserSelfServiceController@document_ready')->name('req.doc_ready');

	Route::post('request/release/{id}/{emp_id}', 'App\Http\Controllers\UserSelfServiceController@document_release')->name('req.doc_release');

	Route::get('exit_interview/{id}', 'App\Http\Controllers\UserExitApplicationController@exit_interview')->name('exit.take');

	Route::get('exit_application/view/{id}', 'App\Http\Controllers\UserExitApplicationController@my_application')->name('exit.view_my_application');

	Route::get('exit_application/cancel/{id}', 'App\Http\Controllers\UserExitApplicationController@cancel')->name('exit.cancel');

	Route::post('exit_interview/save', 'App\Http\Controllers\UserExitApplicationController@exit_save')->name('exit.take_save');






	Route::resource('userprofile', 'App\Http\Controllers\UserProfileController');
	Route::resource('usereduc', 'App\Http\Controllers\UserEducbgController');
	Route::resource('usertask', 'App\Http\Controllers\UserTaskController');
	Route::resource('user_designation', 'App\Http\Controllers\UserDesignationController');
	Route::resource('user_jobopportunity', 'App\Http\Controllers\UserJobOppController');
	Route::resource('user_evaluation', 'App\Http\Controllers\UserEvalController');
	Route::resource('request', 'App\Http\Controllers\UserSelfServiceController');
	Route::resource('user_exitapplication', 'App\Http\Controllers\UserExitApplicationController');


});
});
