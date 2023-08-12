<div>
    <x-page-title>
        Employee Payslip
    </x-page-title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        p {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12.5pt;
            margin: 2pt;
        }

        .s1 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 11pt;
        }

        .s2 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 10.5pt;
        }

        .s3 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10.5pt;
        }

        .s4 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 11.5pt;
        }

        .s5 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: italic;
            font-weight: normal;
            text-decoration: none;
            font-size: 10.5pt;
        }

        .s6 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: italic;
            font-weight: normal;
            text-decoration: none;
            font-size: 11.5pt;
        }

        .s7 {
            color: black;
            font-family: "Times New Roman", serif;
            font-style: italic;
            font-weight: normal;
            text-decoration: none;
            font-size: 11pt;
        }

        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }
    </style>
      <div class="row">
        <div class="col-12">
            @if ($employee)
                <div class="card">  
                    <div class="card-body">        
                        <table style="border-collapse:collapse;margin-left:5.5566pt" width="100%"  cellspacing="0">
                            <tbody>
                                <tr>
                                    <td style="width: 10%">
                                        <img class="d-flex align-self-end rounded me-0"
                                            src="{{ asset('storage/' . $facilityInfo?->logo) }}" alt="logo"  width="120px">
                                    </td>
                                    <td class="text-center">
                                        <div class="w-100 overflow-hidde">
                                            <p style="padding-top: 9pt;padding-left: 79pt;text-indent: 0pt;text-align: center;"><a name="bookmark0">Makerere
                                                {{ $facilityInfo?->facility_name }}</a></p>
                                            <p class="mb-1 mt-1 text-mute">{{ $facilityInfo?->address2 }}
                                                <span> || {{ $facilityInfo?->physical_address}}</span> <br>
                                                <span><strong>Tel:</strong> {{ $facilityInfo?->contact }}
                                                    @if ($facilityInfo?->contact2)
                                                    /{{ $facilityInfo?->contact2 }}
                                                    @endif
                                                </span>
                                                ||
                                                @if ($facilityInfo?->fax)
                                                    <span><strong>Fax:</strong> {{ $facilityInfo?->fax }}</span> <br>
                                                @endif
                                                @if ($facilityInfo?->email)
                                                    <span><strong>Email:</strong> {{ $facilityInfo?->email }}</span>
                                                @endif
                                                ||
                                                @if ($facilityInfo?->website)
                                                <span><strong>Web:</strong> {{ $facilityInfo?->website }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td style="width: 10%">
                                        <img class="d-flex align-self-end rounded me-0"
                                            src="{{ asset('storage/' . $facilityInfo?->logo2) }}" alt="logo"  width="100px">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse;margin-left:5.5566pt" width="100%" cellspacing="0">
                           
                            
                            <tr>
                                <td
                                    style="width:194pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:1pt">
                                    <p class="s1" style="padding-left: 78pt;text-indent: 0pt;text-align: left;">Payslip for:</p>
                                </td>
                                <td
                                    style="width:163pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                    <p class="s2" style="padding-left: 96pt;text-indent: 0pt;text-align: left;">{{ \Carbon\Carbon::parse($month)->format('M-y') }}</p>
                                </td>
                         
                                <td colspan="3" style="border-right-style:solid;border-right-width:2pt">
                                    <table width="100%">
                                        <tr>
                                            <td style="width:51pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:0pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:1pt">
                                            <p class="s2" style="text-indent: 0pt;text-align: left;">Name:</p>
                                            </td>
                                            <td
                                                style="width:116pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:2pt">
                                                <p class="s3" style="padding-left: 1pt;text-indent: 0pt;text-align: left;">{{ $employee->fullName }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="width:51pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:0pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:1pt">
                                                <p class="s2" style="text-indent: 0pt;text-align: left;">Position:</p>
                                            </td>
                                            <td
                                                style="width:116pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:1pt">
                                                <p class="s3" style="padding-left: 1pt;text-indent: 0pt;text-align: left;">{{ $employee->designation?->name??'N/A' }}</p>
                                            </td>
                                        </tr>
                                        <tr>                                            
                                            <td
                                                style="width:51pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:0pt">
                                                <p class="s2" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;border-right-style:solid;border-right-width:1pt">Unit:</p>
                                            </td>
                                            <td
                                                style="width:216pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:0pt">
                                                <p class="s3" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">
                                                    {{ $employee->department?->department_name??'N/A' }}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr style="height:32pt">
                                <td
                                    style="width:194pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s2" style="padding-top: 1pt;text-indent: 0pt;text-align: left;">Details</p>
                                </td>
                                <td
                                    style="width:163pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt" />
                                <td
                                    style="width:51pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt" />
                                <td
                                    style="width:116pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:1pt" />
                                <td
                                    style="width:107pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                    <p class="s2" style="padding-top: 1pt;padding-right: 1pt;text-indent: 0pt;text-align: right;">UGX</p>
                                </td>
                            </tr>
                            <tr style="height:32pt">
                                <td colspan="2"
                                    style="width:194pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt">
                                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                                    <p class="s3" style="text-indent: 0pt;text-align: left;">Basic Monthly Salary - Administration</p>
                                </td>
                                {{-- <td style="width:163pt;border-top-style:solid;border-top-width:2pt" /> --}}
                                <td style="width:51pt;border-top-style:solid;border-top-width:2pt" />
                                <td
                                    style="width:116pt;border-top-style:solid;border-top-width:2pt;border-right-style:solid;border-right-width:1pt" />
                                <td
                                    style="width:107pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:2pt">
                                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                                    @php
                                        $salary = 0;
                                        $usd_rate = $global->usd_rate;
                                        if($employee->officialContract){
                                            if ($employee?->officialContract?->currency =='USD') {
                                            $salary = $employee?->officialContract?->gross_salary * $usd_rate;}
                                            if ($employee?->officialContract?->currency =='UGX') {
                                                $salary = $employee?->officialContract?->gross_salary;
                                            }
                                        }else{
                                            $salary =  $employee->salary_ugx;
                                        }
                                    @endphp
                                    <p class="s4" style="padding-left: 31pt;text-indent: 0pt;text-align: right;">UGX @moneyFormat($salary)</p>
                                </td>
                            </tr>
                            <tr style="height:37pt">
                                <td colspan="2" style="width:194pt;border-left-style:solid;border-left-width:2pt">
                                    <p class="s5"
                                        style="padding-top: 2pt;padding-right: 74pt;text-indent: 0pt;line-height: 16pt;text-align: left;">
                                        Less: Statutory Remittances PAYE (Flat Rate-{{$global->paye}}%)</p>
                                </td>
                                {{-- <td style="width:163pt" /> --}}
                                <td style="width:51pt" />
                                <td style="width:116pt;border-right-style:solid;border-right-width:1pt" />
                                <td
                                    style="width:107pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:2pt">
                                    @php
                                      $paye =  $global->paye/100;
                                      $paye_deduct = $salary * $paye;
                                    @endphp
                                    <p class="s6" style="padding-top: 8pt;padding-left: 20pt;text-indent: 0pt;text-align: right;">-UGX @moneyFormat($paye_deduct)</p>
                                </td>
                            </tr>
                            <tr style="height:25pt">
                                <td
                                    style="width:194pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s5" style="padding-top: 1pt;text-indent: 0pt;text-align: left;">NSSF ({{$global->employee_nssf}}%)</p>
                                </td>
                                <td style="width:163pt;border-bottom-style:solid;border-bottom-width:2pt" />
                                <td style="width:51pt;border-bottom-style:solid;border-bottom-width:2pt" />
                                <td
                                    style="width:116pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:1pt" />
                                <td
                                    style="width:107pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                    @php
                                    $nssf =  $global->employee_nssf/100;
                                    $nssf_deduct = $salary * $nssf;
                                  @endphp
                                    <p class="s7" style="padding-top: 1pt;padding-left: 35pt;text-indent: 0pt;text-align: right;">-UGX @moneyFormat($nssf_deduct)</p>
                                </td>
                            </tr>
                            <tr style="height:18pt">
                                <td
                                    style="width:194pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s2" style="padding-top: 2pt;text-indent: 0pt;text-align: left;">Net Payable</p>
                                </td>
                                <td
                                    style="width:163pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt" />
                                <td
                                    style="width:51pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt" />
                                <td
                                    style="width:116pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:1pt" />
                                <td
                                    style="width:107pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                    @php
                                        $net_deduct = $nssf_deduct+$paye_deduct;
                                        $net_pay = $salary-$net_deduct;
                                    @endphp
                                    <p class="s1" style="padding-left: 30pt;text-indent: 0pt;text-align: right;">UGX @moneyFormat($net_pay)</p>
                                </td>
                            </tr>
                            <tr style="height:32pt">
                                <td
                                    style="width:194pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt">
                                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                                    <p class="s3" style="text-indent: 0pt;text-align: left;">Remittance Method:</p>
                                </td>
                                <td style="width:163pt;border-top-style:solid;border-top-width:2pt">
                                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                                    <p class="s5" style="padding-left: 2pt;text-indent: 0pt;text-align: left;">Electonic Funds Transfer</p>
                                </td>
                                <td style="width:51pt;border-top-style:solid;border-top-width:2pt" />
                                <td style="width:116pt;border-top-style:solid;border-top-width:2pt" />
                                <td
                                    style="width:107pt;border-top-style:solid;border-top-width:2pt;border-right-style:solid;border-right-width:2pt" />
                            </tr>
                            <tr style="height:16pt">
                                <td style="width:194pt;border-left-style:solid;border-left-width:2pt">
                                    <p class="s3" style="padding-top: 1pt;text-indent: 0pt;text-align: left;">Account Name:</p>
                                </td>
                                <td style="width:163pt">
                                    <p class="s5" style="padding-top: 1pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">{{$bank_account->account_name??'No bank data'}}</p>
                                </td>
                                <td style="width:51pt" />
                                <td style="width:116pt" />
                                <td style="width:107pt;border-right-style:solid;border-right-width:2pt" />
                            </tr>
                            <tr style="height:16pt">
                                <td style="width:194pt;border-left-style:solid;border-left-width:2pt">
                                    <p class="s3" style="padding-top: 1pt;text-indent: 0pt;text-align: left;">Bank Name:</p>
                                </td>
                                <td style="width:163pt">
                                    <p class="s5" style="padding-top: 1pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">{{$bank_account->bank_name??'No bank data'}}</p>
                                </td>
                                <td style="width:51pt" />
                                <td style="width:116pt" />
                                <td style="width:107pt;border-right-style:solid;border-right-width:2pt" />
                            </tr>
                            <tr style="height:16pt">
                                <td style="width:194pt;border-left-style:solid;border-left-width:2pt">
                                    <p class="s3" style="padding-top: 1pt;text-indent: 0pt;text-align: left;">Branch Name</p>
                                </td>
                                <td style="width:163pt">
                                    <p class="s5" style="padding-top: 1pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">{{$bank_account->branch??'No bank data'}} </p>
                                </td>
                                <td style="width:51pt" />
                                <td style="width:116pt" />
                                <td style="width:107pt;border-right-style:solid;border-right-width:2pt" />
                            </tr>
                            <tr style="height:24pt">
                                <td
                                    style="width:194pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s3" style="padding-top: 1pt;text-indent: 0pt;text-align: left;">Account No:</p>
                                </td>
                                <td style="width:163pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s5" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">{{$bank_account->account_number??'No bank data'}}</p>
                                </td>
                                <td style="width:51pt;border-bottom-style:solid;border-bottom-width:2pt" />
                                <td style="width:116pt;border-bottom-style:solid;border-bottom-width:2pt" />
                                <td
                                    style="width:107pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" />
                            </tr>
                            <tr style="height:16pt">
                                <td
                                    style="width:194pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s2" style="padding-top: 1pt;text-indent: 0pt;text-align: left;">Prepared by:</p>
                                </td>
                                <td
                                    style="width:163pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s3" style="padding-top: 1pt;padding-left: 64pt;text-indent: 0pt;text-align: left;">Nalwadda
                                        Geraldine</p>
                                </td>
                                <td
                                    style="width:51pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt" />
                                <td
                                    style="width:116pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s2" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">Date:</p>
                                </td>
                                <td
                                    style="width:107pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                    <p class="s3" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">
                                         {{ \Carbon\Carbon::parse($month)->format('d-M-Y') }}
                                    </p>
                                </td>
                            </tr>
                            <tr style="height:37pt">
                                <td
                                    style="width:194pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s2" style="padding-top: 1pt;text-indent: 0pt;text-align: left;">Approved by:</p>
                                </td>
                                <td
                                    style="width:163pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s3" style="padding-top: 1pt;padding-left: 79pt;text-indent: 0pt;text-align: left;">Joloba
                                        Moses</p>
                                </td>
                                <td
                                    style="width:51pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt" />
                                <td
                                    style="width:116pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s2" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">Date:</p>
                                </td>
                                <td
                                    style="width:107pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                    <p class="s3" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">
                                        {{ \Carbon\Carbon::parse($month)->format('d-M-Y') }}</p>
                                </td>
                            </tr>
                            <tr style="height:36pt">
                                <td
                                    style="width:194pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:1pt">
                                    <p class="s2" style="padding-top: 1pt;text-indent: 0pt;text-align: left;">Received by:</p>
                                </td>
                                <td
                                    style="width:163pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:2pt">
                                    <p class="s3" style="padding-top: 1pt;padding-left: 62pt;text-indent: 0pt;text-align: left;">Catherine
                                        Abenaitwe</p>
                                </td>
                                <td
                                    style="width:51pt;border-top-style:solid;border-top-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:1pt" />
                                <td
                                    style="width:116pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:1pt">
                                    <p class="s2" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">Date:</p>
                                </td>
                                <td
                                    style="width:107pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                    <p class="s3" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">
                                        {{ \Carbon\Carbon::parse($month)->format('d-M-Y') }}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <button wire:click='downloadPayslip'>Download</button>
            @endif
          
        </div>
      </div>
</div>