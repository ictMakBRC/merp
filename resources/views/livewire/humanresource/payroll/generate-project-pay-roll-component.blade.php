<div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 mb-2">
                            <label for="department_id" class="form-label">Project</label>
                            <select class="form-select select2" id="department_id" wire:model="department_id">
                                <option selected value="0">All</option>
                                @forelse ($projectContracts as $projectContract)
                                    <option value="{{ $projectContract->project_id }}">{{ $projectContract->project?->department_name??'N/A' }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-3 col-md-2">
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-select select2" data-toggle="select2" wire:model.lazy="currency" id="currency" name="currency" required>
                                <option selected value="">Select</option>
                                <option value="UGX">UGX</option>
                                <option value="USD">USD</option>
                            </select>
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
                        </div>
                        {{-- <div class="mb-2 col-2">
                            <label for="usd_rate"class="form-label">USD Rate<small class="text-danger">*</small></label>
                            <input type="number" step="any" class="form-control" name="usd_rate" id="usd_rate"
                                wire:model='usd_rate'>
                        </div> --}}
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
                                            <th>PAYE ({{$currency}})</th>
                                            <th>Net Pay ({{$currency}})</th>
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
                                                        if ($employeeContract?->currency =='UGX') {
                                                            $salary = $employeeContract->gross_salary/$usd_rate;
                                                        }
                                                    }
                                                    if ($currency=='UGX')  {
                                                        if ($employeeContract?->currency =='USD') {
                                                            $salary =  $employeeContract->gross_salary * $usd_rate;
                                                            }
                                                        if ($employeeContract?->currency =='UGX') {
                                                            $salary = $employeeContract->gross_salary??'0';
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
                                                        $usdDeduct = $usdPaye+$usd_nssf
                                                        @endphp
                                                        @moneyFormat($salary-$usdDeduct)
                                                    </td>
                                                    <td class="table-action">
                                                        {{-- <a target="_blank" href="{{ URL::signedRoute('hr.viewPaySlip', $employeeContract->employee_id) }}"
                                                            class="action-icon"> <i class="mdi mdi-eye"></i></a> --}}
                                                        <a href="{{ route('humanresource.downloadProjectPayslip',[$employeeContract->id,$currency]) }}"
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
