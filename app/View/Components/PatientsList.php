<?php

namespace App\View\Components;

use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class PatientsList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $patientVisits;

    public function __construct()
    {
        if (Route::currentRouteName() == 'opdclinicalmanagement.create') {
            $this->patientVisits = Visit::with('patient')->where('status', 'Pending-Triage')->get();
        } elseif (Route::currentRouteName() == 'opdDocPatManagement') {
            $this->patientVisits = Visit::with('patient')->where(['visit_type' => 'OPD', 'status' => 'Nurse-Seen', 'assigned_to' => Auth::id()])->get();
        } elseif (Route::currentRouteName() == 'selfReqManagement') {
            $this->patientVisits = Visit::with('patient')->where('status', 'Self-Pending')->get();
        } elseif (Route::currentRouteName() == 'ipdNurPatManagement' || Route::currentRouteName() == 'ipdDocPatManagement') {
            $this->patientVisits = Visit::with('patient', 'admission', 'admission.bed', 'admission.bed.ward')->where(['visit_type' => 'IPD', 'status' => 'Admitted'])->get();
        } elseif (Route::currentRouteName() == 'emergencyDocPatMgt' || Route::currentRouteName() == 'emergencyNurPatMgt') {
            $this->patientVisits = Visit::with('patient')->where(['visit_type' => 'EMERGENCY', 'status' => 'Admitted'])->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.patients-list');
    }
}
