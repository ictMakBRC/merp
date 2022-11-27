<?php

namespace App\View\Components;

use App\Models\Department;
use App\Models\Humanresource\BankingInformation;
use App\Models\Humanresource\EducationBackground;
use App\Models\Humanresource\EmergencyContact;
use App\Models\Humanresource\FamilyBackground;
use App\Models\Humanresource\Notice;
use App\Models\Humanresource\OfficialContract;
use App\Models\Humanresource\WorkExperience;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Updates extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $notices;

    public $contracts;

    public $educationInfoCount;

    public $bankingInfoCount;

    public $emergencyContactCount;

    public $familyBackgroundCount;

    public $workExperienceCount;

    public function __construct()
    {
        $childDepartments = [];

        $level1_children = Department::select('id')->where('parent_department', Auth::user()->employee->department_id)->get();

        if (! $level1_children->isEmpty()) {
            foreach ($level1_children as $level1_child) {
                array_push($childDepartments, $level1_child->id);
            }
        }

        $level2_children = Department::select('id')->whereIn('parent_department', $childDepartments)->get();

        if (! $level2_children->isEmpty()) {
            foreach ($level2_children as $level2_child) {
                array_push($childDepartments, $level2_child->id);
            }
        }

        $level3_children = Department::select('id')->whereIn('parent_department', $childDepartments)->get();

        if (! $level3_children->isEmpty()) {
            foreach ($level3_children as $level3_child) {
                array_push($childDepartments, $level3_child->id);
            }
        }
        $this->notices = Notice::with('employee')->where('expires_on', '>=', date('Y-m-d'))->where('audience', Auth::user()->employee->department_id)->orWhere('audience', 0)->latest()->get();
        $this->educationInfoCount = EducationBackground::where(['employee_id' => auth()->user()->employee->id])->count();
        $this->bankingInfoCount = BankingInformation::where(['employee_id' => auth()->user()->employee->id])->count();
        $this->emergencyContactCount = EmergencyContact::where(['employee_id' => auth()->user()->employee->id])->count();
        $this->familyBackgroundCount = FamilyBackground::where(['employee_id' => auth()->user()->employee->id])->count();
        $this->workExperienceCount = WorkExperience::where(['employee_id' => auth()->user()->employee->id])->count();

        if (Auth::user()->hasRole(['HrAdmin', 'SuperAdmin'])) {
            $this->contracts = OfficialContract::contractOwner()->get();
        } elseif (Auth::user()->hasRole(['HrSupervisor'])) {
            $this->contracts = OfficialContract::contractOwner()->where('department_id', Auth::user()->employee->department_id)->orWhereIn('department_id', $childDepartments)->get();
        } elseif (Auth::user()->hasRole(['HrUser'])) {
            $this->contracts = OfficialContract::contractOwner()->where(['employee_id' => auth()->user()->employee->id])->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('humanResource.whatsHappening');
    }
}
