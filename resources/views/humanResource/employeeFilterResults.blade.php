<x-hr-layout>

    <x-report-layout>

        <x-slot:pagetitle>
            Employees Filter Results
            </x-slot>
            <x-slot:reporttitle>
                {{$title}}
                </x-slot>

                {{-- <div class="row">
                    <div class="col-lg-12">
                
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-lg-12" id="nobreak">
                        @if (!$employees->isEmpty())
                            <div class="table-responsiv">
                                <table class="{!! Auth::user()->color_scheme === 'true' ? '' : 'table-striped' !!} mb-0 w-100 table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Emp-No</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                            <th>Department</th>
                                            <th>Work Type</th>
                                            <th>Status</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($employees as $key => $employee)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $employee->emp_id }}</td>
                                                <td>{{ $employee->fullName }}</td>
                                                <td>{{ $employee->gender }}</td>
                                                <td>{{ $employee->contact }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->designation->name }}</td>
                                                <td>{{ $employee->department->department_name }}</td>
                                                <td>{{ $employee->work_type }}</td>
                                                @if ($employee->status != 'Active')
                                                    <td><span class="badge bg-danger">{{ $employee->status }}</span></td>
                                                @else
                                                    <td><span class="badge bg-success">Active</span></td>
                                                @endif
                                                {{-- <td class="table-action">
                                                <a href="{{ route('employees.show', $employee->id) }}"
                                                    class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                @if (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-create'))
                                                    <a href="{{ route('employees.edit', [$employee->id]) }}"
                                                        class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                                    <a  onclick="return confirm('Are you sure you want to delete?');" href="{{route('employees.destroy',[$employee->id])}}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                @endif
                                            </td> --}}
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div> <!-- end preview-->


                    </div>
                    {{-- <div class="col-lg-12">
                        <div class="mb-3 text-end" id="bcode">
                            <svg id="barcodee" style="display: none"></svg>
                        </div> 
                    </div> --}}
                </div>

                <div class="text-sm-center mt-3">
                    <button class="btn btn-success" id="noprint1" onclick="window.print();"> PRINT</button>
                </div>
            @else
                <x-not-available-alert>
                    No Results
                </x-not-available-alert>
                @endif
    </x-report-layout>

    {{-- @push('scripts')
        <script src="{{ asset('js/JsBarcode.all.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $("#reportHeader").removeClass('table-bordered border-primary');
                JsBarcode("#barcodee", '{{ $employee->emp_id }}', {
                    format: 'code128',
                    displayValue: false,
                    lineColor: "#24292e",
                    width: 2,
                    height: 30,
                    fontSize: 15
                });

            });
        </script>
    @endpush --}}
</x-hr-layout>
