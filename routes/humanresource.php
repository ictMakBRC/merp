<?php

use App\Http\Controllers\Humanresource\AppraisalsController;
use App\Http\Controllers\Humanresource\BankingInformationController;
use App\Http\Controllers\Humanresource\ChildrenController;
use App\Http\Controllers\Humanresource\DesignationController;
use App\Http\Controllers\Humanresource\EducationBackgroundController;
use App\Http\Controllers\Humanresource\EmergencyContactController;
use App\Http\Controllers\Humanresource\EmployeeController;
use App\Http\Controllers\Humanresource\ExitInterviewsController;
use App\Http\Controllers\Humanresource\FamilyBackgroundController;
use App\Http\Controllers\Humanresource\GrievanceController;
use App\Http\Controllers\Humanresource\HolidayController;
use App\Http\Controllers\Humanresource\HrDepartmentController;
use App\Http\Controllers\Humanresource\HrReportsController;
use App\Http\Controllers\Humanresource\HrStationController;
use App\Http\Controllers\Humanresource\HrUnitController;
use App\Http\Controllers\Humanresource\LeaveController;
use App\Http\Controllers\Humanresource\LeaveRequestController;
use App\Http\Controllers\Humanresource\NoticesController;
use App\Http\Controllers\Humanresource\OfficialContractController;
use App\Http\Controllers\Humanresource\ProjectContractController;
use App\Http\Controllers\Humanresource\ResignationController;
use App\Http\Controllers\Humanresource\SuggestionsController;
use App\Http\Controllers\Humanresource\TerminationController;
use App\Http\Controllers\Humanresource\TrainingProgramController;
use App\Http\Controllers\Humanresource\WarningsController;
use App\Http\Controllers\Humanresource\WorkExperienceController;
use App\Http\Livewire\Humanresource\Employee\ViewPaySlipComponent;
use App\Http\Livewire\Humanresource\Payroll\GeneratePayRollComponent;
use App\Http\Livewire\Humanresource\Payroll\GenerateProjectPayRollComponent;
use App\Http\Livewire\Humanresource\Payroll\PayRollSettingsComponent;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'humanresource', 'middleware' => ['auth']], function () {
    Route::get('/', [EmployeeController::class, 'dashboard'])->name('humanresource.dashboard');
    Route::get('payslip/download/{emp_id}/pdf', [EmployeeController::class, 'downloadPayslip'])->name('humanresource.downloadPayslip');
    Route::get('proect/payslip/download/{contract_id}/{currency}/{month}/{approver_id}/{prepper_id}/pdf', [EmployeeController::class, 'downloadProjectPayslip'])->name('humanresource.downloadProjectPayslip');
    
    Route::get('employee/payslip/{id}/preview', ViewPaySlipComponent::class)->name('hr.viewPaySlip')->middleware('signed');
    Route::get('employee/officil/payroll', GeneratePayRollComponent::class)->name('hr.viewPayroll');
    Route::get('employee/project/payroll', GenerateProjectPayRollComponent::class)->name('hr.viewOfficialPayroll');
    Route::get('employee/settings/payroll', PayRollSettingsComponent::class)->name('hr.payrollSettings');

    //-------------------------------STATIONS MANAGEMENT ROUTES------------------------
    Route::resource('hrstations', HrStationController::class);

    //-------------------------------DEPARTMENTS MANAGEMENT ROUTES------------------------
    Route::get('/projects', [HrDepartmentController::class, 'projectsView'])->name('projects.view');
    Route::get('departmentalunits/{id}/change', [HrDepartmentController::class, 'changeunit'])->name('units.change');
    Route::get('departmentalunits/{id}', [HrDepartmentController::class, 'getUnits'])->name('units.get');
    Route::resource('hrdepartments', HrDepartmentController::class);

    //-------------------------------PROJECTS MANAGEMENT ROUTES------------------------
    // Route::get('departmentalunits/{id}',[HrUnitController::class, 'getUnits'])->name('units.view');
    // Route::resource('hrunits', HrUnitController::class);

    //-------------------------------STATIONS MANAGEMENT ROUTES------------------------
    Route::resource('hrstations', HrStationController::class);

    //-------------------------------DESIGNATION MANAGEMENT ROUTES------------------------
    Route::resource('designations', DesignationController::class);

    //-------------------------------HOLIDAYS MANAGEMENT ROUTES------------------------
    Route::resource('holidays', HolidayController::class);

    //-------------------------------LEAVES MANAGEMENT ROUTES------------------------
    Route::resource('leaves', LeaveController::class);

    //-------------------------------LEAVE REQUESTS MANAGEMENT ROUTES------------------------
    Route::get('/leaveBalance', [LeaveRequestController::class, 'showBalance'])->name('leavebalance');
    Route::get('/leave/{id}/availableCredits', [LeaveRequestController::class, 'availableCredits'])->name('availablecredits');
    Route::get('/leaveRequests/departmentleaves/{id}', [LeaveRequestController::class, 'departmentRequests'])->name('dept.leaves');
    Route::get('/leaveRequests/delegatedToMe/{id}', [LeaveRequestController::class, 'asDelegatee'])->name('as-delegatee');
    Route::resource('leaveRequests', LeaveRequestController::class);

    //-------------------------------EMPLOYEE MANAGEMENT ROUTES------------------------

    Route::get('/grievances/{id}/employee/{emp_id}', [GrievanceController::class, 'download'])->name('grievance.download');
    Route::resource('/grievances', GrievanceController::class);

    Route::get('/terminations/{id}/employee/{emp_id}', [TerminationController::class, 'download'])->name('termination.download');
    Route::resource('/terminations', TerminationController::class);

    Route::get('/resignations/{id}/employee/{emp_id}', [ResignationController::class, 'download'])->name('resignation.download');
    Route::resource('/resignations', ResignationController::class);

    Route::get('/warnings/{id}/employee/{emp_id}', [WarningsController::class, 'download'])->name('warning.download');
    Route::resource('/warnings', WarningsController::class);

    Route::get('/appraisals/uploadTemplate', function () {
        return view('humanResource.appraisalFormTemplateUpload');
    })->name('appraisaltemplate.show');
    Route::post('/appraisals/template/upload', [AppraisalsController::class, 'upload'])->name('appraisaltemplate.upload');
    Route::get('/appraisals/downloadform/{emp_id}', [AppraisalsController::class, 'downloadForm'])->name('appraisalform.download');
    Route::get('/appraisals/{id}/download', [AppraisalsController::class, 'download'])->name('appraisals.download');
    Route::resource('/appraisals', AppraisalsController::class);

    Route::get('/exitInterviews/uploadTemplate', function () {
        return view('humanResource.uploadExitInterviewTemplate');
    })->name('interviewtemplate.show');
    Route::post('/exitInterviews/template/upload', [ExitInterviewsController::class, 'uploadTemplate'])->name('interviewtemplate.upload');
    Route::get('/exitInterviews/template/download/{emp_id}', [ExitInterviewsController::class, 'downloadtemplate'])->name('interviewtemplate.download');
    Route::get('/exitInterviews/{id}/download', [ExitInterviewsController::class, 'download'])->name('exitInterviews.download');
    Route::resource('/exitInterviews', ExitInterviewsController::class);

    Route::post('employees/filter', [HrReportsController::class, 'filterEmployees'])->name('employees.filter');
    Route::get('employees/general-reports', [HrReportsController::class, 'create'])->name('general-reports.create');
    Route::resource('employees', EmployeeController::class);

    Route::resource('bankingInformation', BankingInformationController::class);
    Route::resource('employeeChildren', ChildrenController::class);
    Route::resource('emergencyContact', EmergencyContactController::class);
    Route::resource('familyBackground', FamilyBackgroundController::class);

    Route::get('/educationBackground/{emp_id}/award/{id}/level/{level}', [EducationBackgroundController::class, 'download'])->name('award.download');
    Route::resource('educationBackground', EducationBackgroundController::class);

    Route::get('/officialContracts/expiry-alert', [OfficialContractController::class, 'expiryAlert'])->name('officialcontract.expiryAlert');
    Route::get('/officialContracts/{emp_id}/officialContracts/download/{id}', [OfficialContractController::class, 'download'])->name('officialcontract.download');
    Route::resource('officialContracts', OfficialContractController::class);

    Route::get('/projectContracts/delete/{id}', [ProjectContractController::class, 'destroy'])->name('projectcontract.delete');
    Route::get('/projectContracts/{emp_id}/projectContracts/download/{id}', [ProjectContractController::class, 'download'])->name('projectcontract.download');
    Route::resource('projectContracts', ProjectContractController::class);

    Route::resource('workExperience', WorkExperienceController::class);

    Route::get('/trainingProgram/{emp_id}/certificate/{id}', [TrainingProgramController::class, 'download'])->name('certificate.download');
    Route::resource('trainingProgram', TrainingProgramController::class);

    Route::resource('suggestions', SuggestionsController::class);
    Route::resource('notices', NoticesController::class);
});
