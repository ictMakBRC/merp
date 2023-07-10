<div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent='generatePayroll'>
                        <div class="row">
                            <div class="col-2 mb-2">
                                <label for="department_id" class="form-label">Project</label>
                                <select class="form-select select2" id="department_id" wire:model="department_id">
                                    <option selected value=" ">Select</option>
                                    @forelse ($projectContracts as $projectContract)
                                        <option value="{{ $projectContract->project_id }}">{{ $projectContract->project?->department_name??'N/A' }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('department_id')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="currency" class="form-label">Currency</label>
                                <select class="form-select" wire:model.defer="currency" id="currency" name="currency" required>
                                    <option selected value="">Select</option>
                                    <option value="UGX">UGX</option>
                                    <option value="USD">USD</option>
                                    <option value="GBP">GBP</option>
                                    <option value="EUR">EUR</option>
                                </select>
                                @error('currency')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2 col-3">
                                <label for="employee_id" class="form-label">Employee<small
                                        class="text-danger">*</small></label>
                                <select class="form-select select2" name="employee_id" id="employee_id"
                                    wire:model="employee_id">
                                    <option selected value="0">All</option>
                                    @forelse ($employees as $projectEmployee)
                                        <option value="{{ $projectEmployee->employee_id }}">
                                            {{ $projectEmployee->employee?->surname . ' ' . $projectEmployee->employee?->first_name . ' ' . $projectEmployee->employee?->other_name }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('employee_id')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-2 col-2">
                                <label for="usd_rate"class="form-label">Months<small class="text-danger">*</small></label>
                                <input type="month"  class="form-control" name="show_month" id="show_month" wire:model="show_month">
                                @error('show_month')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-2 col-2">
                                <label for="prepper_id" class="form-label">Issued By<small class="text-danger">*</small></label>
                                <select class="form-select select2" required name="prepper_id" id="prepper_id"
                                    wire:model="prepper_id">
                                    <option selected value=" ">Select</option>
                                    @forelse ($issuers as $prepper)
                                        <option value="{{ $prepper->name  }}"> {{ $prepper->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('prepper_id')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="mb-2 col-2">
                                <label for="approver_id" class="form-label">Approver<small class="text-danger">*</small></label>
                                <select class="form-select select2" required name="approver_id" id="approver_id"
                                    wire:model="approver_id">
                                    <option selected value=" ">Select</option>
                                    @forelse ($approvalers->where('type', 'Approver') as $approvaler)
                                        <option value="{{ $approvaler->employee_id  }}"> {{ $approvaler->employee?->fullname }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div> --}}
                            <div class="modal-footer">
                                <button class="btn btn-success m-9">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="card">
                <div class="modal-footer">
                    @if (!$emp_payroll->isEmpty())
                    <button  id="btnExport" class="btn btn-primary float-right no-print d-none"onclick="exportTableToExcel('datableButtonS', 'export-data')" style="margin-right: 5px;">Eport</button>
                    <button class="btn btn-outline-success" onclick="fnExcelReport();" >Export Payroll</button>
                    @endif
                    
                    @if (count($selectedEmployeeIds)>0)
                    <button class="btn btn-info" wire:click='sendPayslip'>Send Payslip</button>
                    @endif
                </div>
                @if (!$emp_payroll->isEmpty() && $currency!= null)
                    <div class="card-body">                  
                            <div class="table-responsive">
                                <table id="datableButtonS" class="table table-striped table-bordered mb-0 w-100 sortable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Gross Amount ({{$currency}})</th>
                                            {{-- <th>Exchange Rate(URA on {{date('d M Y')}})</th> --}}
                                            <th>Employee 5% NSSF ({{$currency}})</th>
                                            <th>Employer 10% NSSF ({{$currency}})</th>
                                            <th>Employee 15% NSSF ({{$currency}})</th>
                                            <th>Taxable Gross ({{$currency}})</th>
                                            <th>PAYE ({{$currency}})</th>
                                            <th>Net Pay ({{$currency}})</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>                                 
                                        <tbody>
                                            @foreach ($emp_payroll as $key => $employeeContract)
                                                <tr>
                                                    @php
                                                        $paye = $global->paye/100;
                                                        $employeeNss = $global->employee_nssf/100;
                                                        $employerNss = $global->employer_nssf/100;
                                                        $salary = 0;
                                                        $salaryUgx = 0;
                                                        if ($currency=='USD')  {
                                                            if ($employeeContract?->currency =='USD') {
                                                                $salary = $employeeContract?->gross_salary??'0';
                                                            }
                                                           
                                                        }
                                                        if ($currency=='EUR')  {
                                                            if ($employeeContract?->currency =='EUR') {
                                                                $salary = $employeeContract?->gross_salary??'0';
                                                            }
                                                          
                                                        }
                                                        if ($currency=='GBP')  {
                                                            if ($employeeContract?->currency =='GBP') {
                                                                $salary = $employeeContract?->gross_salary??'0';
                                                            }
                                                          
                                                        }
                                                    if ($currency=='UGX')  {
                                                        if ($employeeContract?->currency =='USD') {
                                                            $salary =  $employeeContract->gross_salary * $usd_rate;
                                                            }
                                                        if ($employeeContract?->currency =='UGX') {
                                                            $salary = $employeeContract->gross_salary??'0';
                                                        }
                                                        if ($employeeContract?->currency =='EUR') {
                                                            $salary = $employeeContract->gross_salary*$usd_rate;
                                                        }
                                                        if ($employeeContract?->currency =='GBP') {
                                                            $salary = $employeeContract->gross_salary*$usd_rate;
                                                        }
                                                    }
                                                    @endphp
                                                    <td>{{ $key + 1 }}
                                                        <input class="form-check-input" type="checkbox"
                                                        value="{{ $employeeContract->id }}" class="ms-2 float-end" wire:model.lazy="selectedEmployeeIds">
                                                    </td>
                                                    <td>{{ $employeeContract->employee->fullName }}</td>
                                                    <td> @moneyFormat($salary)</td>
                                                    {{-- <td>@moneyFormat($usd_rate)</td> --}}
                                                
                                                    <td>
                                                        @php
                                                        $usd_nssf = $salary*$employeeNss
                                                        @endphp
                                                        @moneyFormat($usd_nssf)                                    
                                                    </td>
                                                    <td> 
                                                        @php
                                                        $ugxEmp_nssf = $salary*$employerNss
                                                        @endphp
                                                        @moneyFormat($ugxEmp_nssf)
                                                    </td>
                                                    <td>
                                                        @moneyFormat($ugxEmp_nssf+$usd_nssf)
                                                    </td>
                                                    <td>@moneyFormat($salary)</td>
                                                    <td>
                                                        @php
                                                        $usdPaye = $salary*$paye
                                                        @endphp
                                                        @moneyFormat($usdPaye)
                                                    </td>
                                                    <td>
                                                        @php
                                                        $usdDeduct = $usdPaye+$usd_nssf+$ugxEmp_nssf
                                                        @endphp
                                                        @moneyFormat($salary-$usdDeduct)
                                                    </td>
                                                    <td class="table-action">
                                                        {{-- <a target="_blank" href="{{ URL::signedRoute('hr.viewPaySlip', $employeeContract->employee_id) }}"
                                                            class="action-icon"> <i class="mdi mdi-eye"></i></a> --}}
                                                        <a target="_blank" href="{{ route('humanresource.downloadProjectPayslip',[$employeeContract->id,$currency,$show_month,$prepper_id]) }}"
                                                            class="action-icon"> <i class="mdi mdi-download"></i></a>
                                                
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div> <!-- end preview-->
                  
                @else
                     <h6 class="text-center">Click Submit to generate data</h6>   
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script type="text/javascript">
    function fnExcelReport() {
        var table = document.getElementById('datableButtonS'); // Get the table element
        var tab_text = "<table border='2px'>MAKBRC PAYMENT PAYROLL<tr bgcolor='#33C481'>";

        for (var j = 0; j < table.rows.length; j++) {
            tab_text += table.rows[j].innerHTML + "</tr>";
        }

        tab_text += "</table>";
        tab_text = tab_text.replace(/<a[^>]*>|<\/a>/g, ""); // Remove links
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // Remove images
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // Remove input elements

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) { // If Internet Explorer
            var txtArea1 = document.createElement("textarea");
            txtArea1.innerHTML = tab_text;
            txtArea1.style.display = 'none';
            document.body.appendChild(txtArea1);
            txtArea1.focus();
            txtArea1.select();
            var sa = txtArea1.document.execCommand("SaveAs", true, "Mak BRC Payroll.xls");
            document.body.removeChild(txtArea1);
        } else {
            var downloadLink = document.createElement("a");
            downloadLink.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tab_text);
            downloadLink.download = 'Mak BRC Payroll.xls';
            downloadLink.style.display = 'none';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    }
</script>

   




<!-- ./wrapper -->
@endpush

</div>
