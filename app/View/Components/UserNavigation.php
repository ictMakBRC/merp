<?php

namespace App\View\Components;

use App\Models\AdmissionRequest;
use App\Models\DoctorReferral;
use App\Models\EmergencyReferral;
use App\Models\ExternalReferral;
use App\Models\ProcedureRequest;
use App\Models\TestRequest;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class UserNavigation extends Component
{
    public $selfReqCount;

    public $pendingTriageCount;

    public $nurseSeenCount;

    public $internalRefCount;

    public $pendingAdmissionReqCount;

    public $pendingIpdAdmissionCount;

    public $admittedIpdCount;

    public $dischargedIpdCount;

    public $pendingEmergencyReqCount;

    public $pendingEmergencyCount;

    public $admittedEmergencyCount;

    public $dischargedEmergencyCount;

    public $pendingExtReferralCount;

    public $approvedExtReferralCount;

    public $declinedExtReferralCount;

    public $pendingTestReqCount;

    public $scheduledTestReqCount;

    public $completedTestReqCount;

    public $pendingRadReqCount;

    public $scheduledRadReqCount;

    public $completedRadReqCount;

    public $pendingCadReqCount;

    public $scheduledCadReqCount;

    public $completedCadReqCount;

    public $pendingEndoReqCount;

    public $scheduledEndoReqCount;

    public $completedEndoReqCount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $today = Carbon::today();

        $this->selfReqCount = Visit::where('status', 'Self-Pending')->count();
        $this->pendingTriageCount = Visit::pendingTriage()->count();
        $this->nurseSeenCount = Visit::nurseSeen()->count();

        $this->internalRefCount = DoctorReferral::where(['status' => 'Pending', 'doctor_id' => Auth::id()])->count();
        $this->pendingAdmissionReqCount = AdmissionRequest::where('status', 'Pending')->orWhere('status', 'Visit-Present')->count();
        $this->pendingIpdAdmissionCount = Visit::where(['visit_type' => 'IPD', 'status' => 'Pending-Admission'])->count();
        $this->admittedIpdCount = Visit::where(['visit_type' => 'IPD', 'status' => 'admitted'])->count();
        $this->dischargedIpdCount = Visit::where(['visit_type' => 'IPD', 'status' => 'Discharged'])->count();

        $this->pendingEmergencyReqCount = EmergencyReferral::where('status', 'Pending')->orWhere('status', 'Visit-Present')->count();
        $this->pendingEmergencyCount = Visit::where(['visit_type' => 'Emergency', 'status' => 'Pending-Emergency'])->count();
        $this->admittedEmergencyCount = Visit::where(['visit_type' => 'EMERGENCY', 'status' => 'Admitted'])->count();
        $this->dischargedEmergencyCount = Visit::where(['visit_type' => 'EMERGENCY', 'status' => 'Discharged'])->count();

        $this->pendingExtReferralCount = ExternalReferral::where('status', 'Pending')->orWhere('status', 'Acknowledged')->count();
        $this->declinedExtReferralCount = ExternalReferral::where('status', 'Declined')->count();
        $this->approvedExtReferralCount = ExternalReferral::where('status', 'Approved')->count();

        $this->pendingTestReqCount = TestRequest::where('status', 'Pending')->whereDate('test_date', '<=', $today)->orWhere('status', 'Acknowledged')->count();
        $this->schedeledTestReqCount = TestRequest::where(['status' => 'Pending'])->whereDate('test_date', '>', $today)->count();
        $this->completedTestReqCount = TestRequest::where('status', 'Completed')->count();

        $this->pendingRadReqCount = ProcedureRequest::pendingRequests('RADIOLOGY')->count(); //pendingRequests is a query scope
        $this->scheduledRadReqCount = ProcedureRequest::where(['status' => 'Pending', 'type' => 'RADIOLOGY'])->whereDate('procedure_date', '>', $today)->count();
        $this->completedRadReqCount = ProcedureRequest::where(['status' => 'Completed', 'type' => 'RADIOLOGY'])->count();

        $this->pendingCadReqCount = ProcedureRequest::pendingRequests('CARDIOLOGY')->count(); //pendingRequests is a query scope
        $this->scheduledCadReqCount = ProcedureRequest::where(['status' => 'Pending', 'type' => 'CARDIOLOGY'])->whereDate('procedure_date', '>', $today)->count();
        $this->completedCadReqCount = ProcedureRequest::where(['status' => 'Completed', 'type' => 'CARDIOLOGY'])->count();

        $this->pendingEndoReqCount = ProcedureRequest::pendingRequests('ENDOSCOPY')->count(); //pendingRequests is a query scope
        $this->scheduledEndoReqCount = ProcedureRequest::where(['status' => 'Pending', 'type' => 'ENDOSCOPY'])->whereDate('procedure_date', '>', $today)->count();
        $this->completedEndoReqCount = ProcedureRequest::where(['status' => 'Completed', 'type' => 'ENDOSCOPY'])->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.usernavigation');
    }
}
