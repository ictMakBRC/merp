<div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 mb-2">
                            <label for="department_id" class="form-label">Department</label>
                            <select class="form-select select2" id="department_id" wire:model="department_id">
                                <option selected value="0">All</option>
                                @forelse ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-2 col-3">
                            <label for="employee_id" class="form-label">Employee<small
                                    class="text-danger">*</small></label>
                            <select class="form-select select2" name="employee_id" id="employee_id"
                                wire:model="employee_id">
                                <option selected value="0">All</option>
                                @forelse ($employees as $employee)
                                    <option value="{{ $employee->id }}">
                                        {{ $employee->surname . ' ' . $employee->first_name . ' ' . $employee->other_name }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-2 col-2">
                            <label for="usd_rate"class="form-label">USD Rate<small class="text-danger">*</small></label>
                            <input type="number" step="any" class="form-control" name="usd_rate" id="usd_rate"
                                wire:model='usd_rate'>
                        </div>
                        <div class="mb-2 col-2">
                            <label for="show_month" class="form-label">Months<small class="text-danger">*</small></label>
                            <select class="form-select select2" name="show_month" id="show_month" wire:model="show_month">
                                <option selected value="0">Current</option>
                                <option selected value="01">Jan</option>
                                <option selected value="02">Feb</option>
                                <option selected value="03">March</option>
                                <option selected value="04">April</option>
                                <option selected value="05">May</option>
                                <option selected value="06">June</option>
                                <option selected value="07">July</option>
                                <option selected value="08">Aug</option>
                                <option selected value="09">Sept</option>
                                <option selected value="10">Oct</option>
                                <option selected value="11">Nov</option>
                                <option selected value="12">Dec</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success m-9" wire:click='generatePayroll'>Submit</button>
                        </div>
                    </div>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datableButtonS" class="table table-striped table-bordered mb-0 w-100 sortable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Gross Amount (USD)</th>
                                    <th>Exchange Rate(URA on {{date('d M Y')}})</th>
                                    <th>Gross Amount (UGX)</th>
                                    <th>Employee 5% NSSF (UGX)</th>
                                    <th>Employee 5% NSSF (USD)</th>
                                    <th>Employer 10% NSSF (UGX)</th>
                                    <th>Employee 15% NSSF (UGX)</th>
                                    <th>Taxable Gross Amount (UGX)</th>
                                    <th>PAYE (UGX)</th>
                                    <th>PAYE (USD)</th>
                                    <th>Net Pay (UGX)</th>
                                    <th>Net Pay (USD)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($emp_payroll as $key => $employee)
                                    <tr>
                                        @php
                                            $paye = $global->paye/100;
                                            $employeeNss = $global->employee_nssf/100;
                                            $employerNss = $global->employer_nssf/100;
                                            $salaryUsd = 0;
                                            $salaryUgx = 0;
                                            if ($employee?->officialContract?->currency =='USD') {
                                                $salaryUsd = $employee?->officialContract?->gross_salary??'0';
                                                $salaryUgx = $employee?->officialContract?->gross_salary * $usd_rate;}
                                            if ($employee?->officialContract?->currency =='UGX') {
                                                $salaryUsd = $employee?->officialContract?->gross_salary/$usd_rate;
                                                $salaryUgx = $employee?->officialContract?->gross_salary;
                                            }
                                            
                                        @endphp
                                        <td>{{ $key + 1 }}
                                            <input class="form-check-input" type="checkbox"
                                            value="{{ $employee->id }}" class="ms-2 float-end" wire:model.lazy="selectedEmployeeIds">
                                        </td>
                                        <td>{{ $employee->fullName }}</td>
                                        <td> @moneyFormat($salaryUsd)</td>
                                        <td>@moneyFormat($usd_rate)</td>
                                        <td> @moneyFormat($salaryUgx)</td>
                                        <td> 
                                            @php
                                            $ugx_nssf = $salaryUgx*$employeeNss
                                            @endphp
                                            @moneyFormat($ugx_nssf)
                                        </td>
                                        <td>
                                            @php
                                            $usd_nssf = $salaryUsd*$employeeNss
                                            @endphp
                                            @moneyFormat($usd_nssf)                                    
                                        </td>
                                        <td> 
                                            @php
                                            $ugxEmp_nssf = $salaryUgx*$employerNss
                                            @endphp
                                            @moneyFormat($ugxEmp_nssf)
                                        </td>
                                        <td>
                                            @moneyFormat($ugxEmp_nssf+$ugx_nssf)
                                        </td>
                                        <td>@moneyFormat($salaryUgx)</td>
                                        <td>
                                            @php
                                            $ugxPaye = $salaryUgx*$paye
                                            @endphp
                                            @moneyFormat($ugxPaye)
                                        </td>
                                        <td>
                                            @php
                                            $usdPaye = $salaryUsd*$paye
                                            @endphp
                                            @moneyFormat($usdPaye)
                                        </td>
                                        <td>
                                            @php
                                            $ugxDeduct = $ugxPaye+$ugx_nssf
                                            @endphp
                                            @moneyFormat($salaryUgx-$ugxDeduct)
                                        </td>
                                        <td>
                                            @php
                                            $usdDeduct = $usdPaye+$usd_nssf
                                            @endphp
                                            @moneyFormat($salaryUsd-$usdDeduct)
                                        </td>
                                        <td class="table-action">
                                            <a target="_blank" href="{{ URL::signedRoute('hr.viewPaySlip', $employee->id) }}"
                                                class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="{{ route('humanresource.downloadPayslip', $employee->id) }}"
                                                class="action-icon"> <i class="mdi mdi-download"></i></a>
                                    
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end preview-->
                </div>
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
