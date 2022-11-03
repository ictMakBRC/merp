<?php

namespace App\Http\Controllers\Humanresource;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Humanresource\Designation;
use App\Models\Humanresource\Employee;
use App\Models\Station;
use Illuminate\Http\Request;

class HrReportsController extends Controller
{
    public function filterEmployees(Request $request)
    {
        $title = $request->report_title;
        $childDepartments = [$request->department_id];

        $level1_children = Department::select('id')->where('parent_department', $request->department_id)->get();
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

        $employees = Employee::select('*')
                    ->when($request->department_id != 0, function ($query) use ($childDepartments) {
                        $query->whereIn('department_id', $childDepartments);
                    })
                    ->when($request->gender != 0, function ($query) use ($request) {
                        $query->where('gender', $request->gender);
                    })
                    ->when($request->nationality != 0, function ($query) use ($request) {
                        $query->where('nationality', $request->nationality);
                    })
                    ->when($request->religious_affiliation != null, function ($query) use ($request) {
                        $query->where('religious_affiliation', 'LIKE', '%'.$request->religious_affiliation.'%');
                    })
                    ->when($request->civil_status != 0, function ($query) use ($request) {
                        $query->where('civil_status', $request->civil_status);
                    })
                    ->when($request->work_type != 0, function ($query) use ($request) {
                        $query->where('work_type', $request->work_type);
                    })
                    ->when($request->station_id != 0, function ($query) use ($request) {
                        $query->where('station_id', $request->station_id);
                    })
                    ->when($request->position != 0, function ($query) use ($request) {
                        $query->where('designation_id', $request->position);
                    })
                    ->when($request->status != 0, function ($query) use ($request) {
                        $query->where('status', $request->status);
                    })
                    ->when($request->join_date1 != '' && $request->join_date2 != '', function ($query) use ($request) {
                        $query->whereBetween('join_date', [$request->join_date1, $request->join_date2]);
                    })
                    ->when($request->birthday1 != '' && $request->birthday2 != '', function ($query) use ($request) {
                        $query->whereBetween('birthday', [$request->birthday1, $request->birthday2]);
                    })
                    ->when($request->birth_place != '', function ($query) use ($request) {
                        $query->where('birth_place', 'LIKE', '%'.$request->birth_place.'%');
                    })
                    ->when($request->blood_type != 0, function ($query) use ($request) {
                        $query->where('blood_type', $request->blood_type);
                    })
                    ->when($request->address != '', function ($query) use ($request) {
                        $query->where('address', 'LIKE', '%'.$request->address.'%');
                    })
                    ->when($request->prefix != 0, function ($query) use ($request) {
                        $query->where('prefix', $request->prefix);
                    })
                    ->latest()->get();

        return view('humanResource.employeeFilterResults', compact('title', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::where('status', 'Active')->latest()->get();
        $stations = Station::latest()->where('status', 'Active')->latest()->get();
        $departments = Department::where('type', 'Department')->OrWhere('type', 'Unit')->OrWhere('type', 'Laboratory')->latest()->get();

        return view('humanResource.generalReportFilters', compact('departments', 'designations', 'stations'));
    }
}
