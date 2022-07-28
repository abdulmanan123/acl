<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ApplicationTypeController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\TehsilController;
use App\Http\Controllers\AreaTypeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\EducationLevelController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NatureOfOwnershipController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'homePage'])->name('home');




Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ApplicationController::class, 'dashboard'])->name('dashboard');

    Route::resource('users', UserController::class)->only('index')->middleware('role_or_permission:Super Admin|View Users');
    Route::resource('users', UserController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Users', 'verify.ajax']);
    Route::resource('users', UserController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Users', 'verify.ajax']);
    Route::resource('users', UserController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Users', 'verify.ajax']);
    Route::post('users/ajax', [UserController::class, 'index'])->name('users.ajax');

    // ACL Routes
    Route::resource('roles', RoleController::class)->only('index')->middleware('role_or_permission:Super Admin|View Roles');
    Route::resource('roles', RoleController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Roles', 'verify.ajax']);
    Route::resource('roles', RoleController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Roles', 'verify.ajax']);
    Route::resource('roles', RoleController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Roles', 'verify.ajax']);
    Route::post('roles/ajax', [RoleController::class, 'index'])->name('roles.ajax');
    Route::get('roles/permissions/{role_id}', [RoleController::class, 'getRolePermissions'])->name('roles.getPermissions')->middleware(['role_or_permission:Super Admin|Role Permissions', 'verify.ajax']);
    Route::put('roles/permissions/{role_id}', [RoleController::class, 'updateRolePermission'])->name('roles.permissions')->middleware(['role_or_permission:Super Admin|Role Permissions', 'verify.ajax']);

    Route::resource('permissions', PermissionController::class)->only('index')->middleware('role_or_permission:Super Admin|View Permissions');
    Route::resource('permissions', PermissionController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Permissions', 'verify.ajax']);
    Route::resource('permissions', PermissionController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Permissions', 'verify.ajax']);
    Route::resource('permissions', PermissionController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Permissions', 'verify.ajax']);
    Route::post('permissions/ajax', [PermissionController::class, 'index'])->name('permissions.ajax');

    // Applications
    Route::resource('applications', ApplicationController::class)->only('index')->middleware('role_or_permission:Super Admin|View Applications');
    Route::resource('applications', ApplicationController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Applications']);
    Route::resource('applications', ApplicationController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Applications', 'verify.ajax']);
    Route::resource('applications', ApplicationController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Applications', 'verify.ajax']);
    Route::post('applications/ajax', [ApplicationController::class, 'index'])->name('applications.ajax');
    Route::get('applications/add_new_qualification_stat', [ApplicationController::class, 'addNewQualificationStat'])->name('applications.addNewQualificationStat');
    Route::get('applications/add_new_enrollment_stat', [ApplicationController::class, 'addNewEnrollmentStat'])->name('applications.addNewEnrollmentStat');

    // Application Types
    Route::resource('application-types', ApplicationTypeController::class)->only('index')->middleware('role_or_permission:Super Admin|View Application Types');
    Route::resource('application-types', ApplicationTypeController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Application Types', 'verify.ajax']);
    Route::resource('application-types', ApplicationTypeController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Application Types', 'verify.ajax']);
    Route::resource('application-types', ApplicationTypeController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Application Types', 'verify.ajax']);
    Route::post('application-types/ajax', [ApplicationTypeController::class, 'index'])->name('application-types.ajax');

    // Area Types
    Route::resource('area-types', AreaTypeController::class)->only('index')->middleware('role_or_permission:Super Admin|View Area Types');
    Route::resource('area-types', AreaTypeController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Area Types', 'verify.ajax']);
    Route::resource('area-types', AreaTypeController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Area Types', 'verify.ajax']);
    Route::resource('area-types', AreaTypeController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Area Types', 'verify.ajax']);
    Route::post('area-types/ajax', [AreaTypeController::class, 'index'])->name('area-types.ajax');
    Route::post('area-types/get_drop_down_options', [AreaTypeController::class, 'getDropDownOptions'])->name('area-types.getDropDownOptions');

    // Districts
    Route::resource('districts', DistrictController::class)->only('index')->middleware('role_or_permission:Super Admin|View Districts');
    Route::resource('districts', DistrictController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Districts', 'verify.ajax']);
    Route::resource('districts', DistrictController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Districts', 'verify.ajax']);
    Route::resource('districts', DistrictController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Districts', 'verify.ajax']);
    Route::post('districts/ajax', [DistrictController::class, 'index'])->name('districts.ajax');
    Route::post('districts/get_drop_down_options', [DistrictController::class, 'getDropDownOptions'])->name('districts.getDropDownOptions');

    // Tehsils
    Route::resource('tehsils', TehsilController::class)->only('index')->middleware('role_or_permission:Super Admin|View Tehsils');
    Route::resource('tehsils', TehsilController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Tehsils', 'verify.ajax']);
    Route::resource('tehsils', TehsilController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Tehsils', 'verify.ajax']);
    Route::resource('tehsils', TehsilController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Tehsils', 'verify.ajax']);
    Route::post('tehsils/ajax', [TehsilController::class, 'index'])->name('tehsils.ajax');
    Route::post('tehsils/get_drop_down_options', [TehsilController::class, 'getDropDownOptions'])->name('tehsils.getDropDownOptions');

    // Cities
    Route::resource('cities', CityController::class)->only('index')->middleware('role_or_permission:Super Admin|View Cities');
    Route::resource('cities', CityController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Cities', 'verify.ajax']);
    Route::resource('cities', CityController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Cities', 'verify.ajax']);
    Route::resource('cities', CityController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Cities', 'verify.ajax']);
    Route::post('cities/ajax', [CityController::class, 'index'])->name('cities.ajax');
    Route::post('cities/get_drop_down_options', [CityController::class, 'getDropDownOptions'])->name('cities.getDropDownOptions');

    // Education Levels
    Route::resource('education-levels', EducationLevelController::class)->only('index')->middleware('role_or_permission:Super Admin|View Education Levels');
    Route::resource('education-levels', EducationLevelController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Education Levels', 'verify.ajax']);
    Route::resource('education-levels', EducationLevelController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Education Levels', 'verify.ajax']);
    Route::resource('education-levels', EducationLevelController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Education Levels', 'verify.ajax']);
    Route::post('education-levels/ajax', [EducationLevelController::class, 'index'])->name('education-levels.ajax');
    Route::post('education-levels/get_drop_down_options', [EducationLevelController::class, 'getDropDownOptions'])->name('education-levels.getDropDownOptions');

    // Genders
    Route::resource('genders', GenderController::class)->only('index')->middleware('role_or_permission:Super Admin|View Genders');
    Route::resource('genders', GenderController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Genders', 'verify.ajax']);
    Route::resource('genders', GenderController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Genders', 'verify.ajax']);
    Route::resource('genders', GenderController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Genders', 'verify.ajax']);
    Route::post('genders/ajax', [GenderController::class, 'index'])->name('genders.ajax');
    Route::post('genders/get_drop_down_options', [GenderController::class, 'getDropDownOptions'])->name('genders.getDropDownOptions');

    // Labs
    Route::resource('labs', LabController::class)->only('index')->middleware('role_or_permission:Super Admin|View Labs');
    Route::resource('labs', LabController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Labs', 'verify.ajax']);
    Route::resource('labs', LabController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Labs', 'verify.ajax']);
    Route::resource('labs', LabController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Labs', 'verify.ajax']);
    Route::post('labs/ajax', [LabController::class, 'index'])->name('labs.ajax');
    Route::post('labs/get_drop_down_options', [LabController::class, 'getDropDownOptions'])->name('labs.getDropDownOptions');

    // Locations
    Route::resource('locations', LocationController::class)->only('index')->middleware('role_or_permission:Super Admin|View Labs');
    Route::resource('locations', LocationController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Labs', 'verify.ajax']);
    Route::resource('locations', LocationController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Labs', 'verify.ajax']);
    Route::resource('locations', LocationController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Labs', 'verify.ajax']);
    Route::post('locations/ajax', [LocationController::class, 'index'])->name('locations.ajax');
    Route::post('locations/get_drop_down_options', [LocationController::class, 'getDropDownOptions'])->name('locations.getDropDownOptions');
    Route::resource('locations', LocationController::class);

    Route::post('nature_of_ownerships/get_drop_down_options', [NatureOfOwnershipController::class, 'getDropDownOptions'])->name('nature_of_ownerships.getDropDownOptions');
    Route::resource('nature_of_ownerships', NatureOfOwnershipController::class);

    Route::post('programs/get_drop_down_options', [ProgramController::class, 'getDropDownOptions'])->name('programs.getDropDownOptions');
    Route::resource('programs', ProgramController::class);

    // Nature Of Ownership
    Route::resource('nature-of-ownerships', NatureOfOwnershipController::class)->only('index')->middleware('role_or_permission:Super Admin|View Nature Of Ownerships');
    Route::resource('nature-of-ownerships', NatureOfOwnershipController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Nature Of Ownerships', 'verify.ajax']);
    Route::resource('nature-of-ownerships', NatureOfOwnershipController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Nature Of Ownerships', 'verify.ajax']);
    Route::resource('nature-of-ownerships', NatureOfOwnershipController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Nature Of Ownerships', 'verify.ajax']);
    Route::post('nature-of-ownerships/ajax', [NatureOfOwnershipController::class, 'index'])->name('nature-of-ownerships.ajax');
    Route::post('nature-of-ownerships/get_drop_down_options', [NatureOfOwnershipController::class, 'getDropDownOptions'])->name('nature-of-ownerships.getDropDownOptions');

    // Programs
    Route::resource('programs', ProgramController::class)->only('index')->middleware('role_or_permission:Super Admin|View Programs');
    Route::resource('programs', ProgramController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Programs', 'verify.ajax']);
    Route::resource('programs', ProgramController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Programs', 'verify.ajax']);
    Route::resource('programs', ProgramController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Programs', 'verify.ajax']);
    Route::post('programs/ajax', [ProgramController::class, 'index'])->name('programs.ajax');

    // Qualifications
    Route::resource('qualifications', QualificationController::class)->only('index')->middleware('role_or_permission:Super Admin|View Qualifications');
    Route::resource('qualifications', QualificationController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Qualifications', 'verify.ajax']);
    Route::resource('qualifications', QualificationController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Qualifications', 'verify.ajax']);
    Route::resource('qualifications', QualificationController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Qualifications', 'verify.ajax']);
    Route::post('qualifications/ajax', [QualificationController::class, 'index'])->name('qualifications.ajax');
    Route::post('qualifications/get_drop_down_options', [QualificationController::class, 'getDropDownOptions'])->name('qualifications.getDropDownOptions');

    // Shifts
    Route::resource('shifts', ShiftController::class)->only('index')->middleware('role_or_permission:Super Admin|View Shifts');
    Route::resource('shifts', ShiftController::class)->only(['create', 'store'])->middleware(['role_or_permission:Super Admin|Create Shifts', 'verify.ajax']);
    Route::resource('shifts', ShiftController::class)->only(['edit', 'update'])->middleware(['role_or_permission:Super Admin|Edit Shifts', 'verify.ajax']);
    Route::resource('shifts', ShiftController::class)->only('destroy')->middleware(['role_or_permission:Super Admin|Delete Shifts', 'verify.ajax']);
    Route::post('shifts/ajax', [ShiftController::class, 'index'])->name('shifts.ajax');
    Route::post('shifts/get_drop_down_options', [ShiftController::class, 'getDropDownOptions'])->name('shifts.getDropDownOptions');
    Route::resource('shifts', ShiftsController::class);

    Route::post('application_types/get_drop_down_options', [ApplicationTypeController::class, 'getDropDownOptions'])->name('application_types.getDropDownOptions');
    Route::resource('application_types', ApplicationTypeController::class);
});

Route::get('/display_image/{image}', 'HomeController@loadImage')->name('display-image');
Route::get('/display_pdf/{pdf}', 'HomeController@loadPdf')->name('display-pdf');

Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('clear-compiled');
        return "Cache is cleared";
});

require __DIR__ . '/auth.php';
