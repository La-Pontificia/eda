<?php

use App\Http\Controllers\AssistsController;
use App\Http\Controllers\AssistTerminalController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BusinessUnitController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EdaController;
use App\Http\Controllers\EventAssistController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobPositionController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuestionnaireTemplateController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\YearController;

// -------------------------------- AUTH ROUTES ---------------------------

Route::get('login/azure', [LoginController::class, 'redirectToAzure']);
Route::post('login', [LoginController::class, 'login']);
Route::get('login/azure/callback', [LoginController::class, 'handleAzureCallback']);
Auth::routes();

// -------------------------------- DASHBOARD ROUTES ---------------------------

Route::group(['middleware' => 'authMiddleware'], function () {

    // Home routes
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index']);

    // Module routes
    Route::get('/', [HomeController::class, 'index']);

    // User roles routes
    Route::get('users/user-roles', [UserRoleController::class, 'index']);
    Route::get('users/user-roles/create', [UserRoleController::class, 'create']);
    Route::get('users/user-roles/{id}', [UserRoleController::class, 'slug']);

    // Users routes
    Route::get('users', [UserController::class, 'index']);

    // Route::get('users/schedules/create', [ScheduleController::class, 'create']);
    // Route::get('users/schedules/{id}', [ScheduleController::class, 'schedule']);

    Route::get('users/emails-access', [UserController::class, 'emails_access']);

    Route::get('users/domains', [UserController::class, 'domains']);

    Route::get('users/create', [UserController::class, 'create']);
    Route::get('users/edit/{id}', [UserController::class, 'edit']);

    Route::get('users/{id}/details', [UserController::class, 'slug_details']);
    Route::get('users/{id}/segurity-access', [UserController::class, 'slug_segurity_access']);
    Route::get('users/{id}/organization', [UserController::class, 'slug_organization']);
    Route::get('users/{id}/schedules', [UserController::class, 'slug_schedules']);
    Route::get('users/{id}/assists', [UserController::class, 'slug_assists']);
    Route::get('users/{id}/contract', [UserController::class, 'slug_contract']);


    Route::get('users/{id}', [UserController::class, 'slug']);


    // schedules routes

    Route::get('schedules', [ScheduleController::class, 'index']);
    Route::get('schedules/{id}', [ScheduleController::class, 'slug']);
    Route::get('schedules/external', [ScheduleController::class, 'external']);


    // Edas routes
    Route::get('edas', [EdaController::class, 'index']);
    Route::get('edas/collaborators', [EdaController::class, 'collaborators']);
    Route::get('edas/reports', [EdaController::class, 'reports']);
    Route::get('edas/years', [YearController::class, 'index']);
    Route::get('edas/questionnaire-templates', [QuestionnaireTemplateController::class, 'index']);
    Route::get('edas/questionnaire-templates/create', [QuestionnaireTemplateController::class, 'create']);
    Route::get('edas/questionnaire-templates/{id}', [QuestionnaireTemplateController::class, 'slug']);

    Route::get('edas/me', [EdaController::class, 'me']);

    Route::get('edas/{id_user}/eda', [EdaController::class, 'user']);
    Route::get('edas/{id_user}/eda/{id_year}', [EdaController::class, 'year']);
    Route::get('edas/{id_user}/eda/{id_year}/goals', [EdaController::class, 'goals']);
    Route::get('edas/{id_user}/eda/{id_year}/evaluation/{id_evaluation}', [EdaController::class, 'evaluation']);
    Route::get('edas/{id_user}/eda/{id_year}/ending', [EdaController::class, 'ending']);
    Route::get('edas/{id_user}/eda/{id_year}/questionnaires', [EdaController::class, 'questionnaires']);

    // Assists routes
    Route::get('assists', [AssistsController::class, 'index']);
    Route::get('assists/terminals', [AssistTerminalController::class, 'index']);
    Route::get('assists/sn-schedules', [AssistsController::class, 'snSchedules']);
    Route::get('assists/peer-schedule', [AssistsController::class, 'peerSchedule']);
    Route::get('assists/single-summary', [AssistsController::class, 'singleSummary']);
    Route::get('assists/without-calculating', [AssistsController::class, 'withoutCalculating']);


    Route::post('assists/terminals', [AssistTerminalController::class, 'store']);
    Route::post('assists/terminals/{id}', [AssistTerminalController::class, 'update']);
    Route::post('assists/terminals/delete/{id}', [AssistTerminalController::class, 'delete']);

    // -------- SETTINGS ROUTES ---------------------------
    Route::get('settings', [SettingController::class, 'index']);
    Route::get('settings/departments', [DepartmentController::class, 'index']);
    Route::get('settings/job-positions', [JobPositionController::class, 'index']);
    Route::get('settings/roles', [RoleController::class, 'index']);

    Route::get('settings/branches', [BranchController::class, 'index']);
    Route::get('settings/business-units', [BusinessUnitController::class, 'index']);

    // -------- EVENT ROUTES ---------------------------
    Route::get('events', [EventController::class, 'index']);
    Route::get('events/assists', [EventAssistController::class, 'index']);

    // -------- AUDIT ROUTES ---------------------------
    Route::get('audit', [AuditController::class, 'index']);

    // -------- REPORT ROUTES ---------------------------
    Route::get('reports', [ReportController::class, 'index']);
    Route::get('reports/files', [ReportController::class, 'files']);

    // -------- TICKETS ROUTES ---------------------------
    Route::get('tickets', [TicketController::class, 'index']);
    Route::get('tickets/real-time', [TicketController::class, 'realTime']);

    // routes if no route is found
    Route::fallback(function () {
        return view('+404');
    });
});
