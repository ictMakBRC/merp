<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Payslip</title>
<style>
    .btop{
        border:solid 0.5px;
    }
    .brow{
        border:solid 1.4px;
    }
    .bleft{
        border-left:solid 0.5px;
    }
    .t-right{
        text-align: right;
    }
    .t-bold{
        font-weight: bold;
    }
    .twidth{
        width: 30%;
    }
</style>
</head>
<body>
    <table style="border-collapse:collapse;margin-left:5.5566pt" width="100%"  cellspacing="0">
        <tbody>
            <tr>
                <td style="width: 10%">
                    <img class="d-flex align-self-end rounded me-0"
                        src="{{ asset('storage/' . $facilityInfo?->logo) }}" alt="logo"  width="120px">
                </td>
                <td class="text-center">
                    <div class="w-100 overflow-hidde">
                        <p style="text-indent: 0pt;text-align: center;" class="t-bold"><a name="bookmark0">
                            {{ $facilityInfo?->facility_name }}</a></p>
                        <p style="text-align: center;">{{ $facilityInfo?->address2 }}
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
    <table width="99%" style="border:solid 2px;border-collapse:collapse;margin-left:5.5566pt;border:solid;" cellspacing="0">
        <tr>
            <td class="btop t-bold">Payslip For</td>
            <td class="btop">{{ \Carbon\Carbon::parse($month)->format('M-y') }}</td>
            <td  class="btop" colspan="2">
                <table width="100%" style="border-collapse:collapse; border:solid 0px;">
                    <tr class="btop">
                        <td class="btop t-bold twidth">
                        <p class="s2" style="text-indent: 0pt;text-align: left;">Name:</p>
                        </td>
                        <td class="btop ">
                            <p class="s3" style="padding-left: 1pt;text-indent: 0pt;text-align: left;">{{ $employee->employee?->fullName }}</p>
                        </td>
                    </tr>
                    <tr class="btop">
                        <td class="btop t-bold twidth">
                            <p class="s2" style="text-indent: 0pt;text-align: left;">Position:</p>
                        </td>
                        <td class="btop">
                            <p class="s3" style="padding-left: 1pt;text-indent: 0pt;text-align: left;">{{ $employee->position?->name??'N/A' }}</p>
                        </td>
                    </tr>
                    <tr class="btop">                                            
                        <td class="btop t-bold twidth">
                            <p class="s2" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">Unit:</p>
                        </td>
                        <td class="btop">
                            <p class="s3" style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">
                                {{ $employee->project?->department_name??'N/A' }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="brow t-bold">
            <td  class="btop" colspan="3">
                Deatils
            </td>
            <td  class="btop t-right">
                {{$currency}}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                Basic Monthly Salary - Administration <br>
            </td>
            <td  class="bleft t-right">
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
                @php
                $salary = 0;
                if ($currency=='USD')  {
                if ($employee?->currency =='USD') {
                    $salary = $employee?->gross_salary??'0';
                }
                if ($employee?->currency =='UGX') {
                    $salary = $employee->gross_salary/$usd_rate;
                }
            }
            if ($currency=='UGX')  {
                if ($employee?->currency =='USD') {
                    $salary =  $employee->gross_salary * $usd_rate;
                    }
                if ($employee?->currency =='UGX') {
                    $salary = $employee->gross_salary??'0';
                }
            }
            @endphp
                {{$currency}} @moneyFormat($salary)
            </td>
        </tr>
        <tr>
            <td  class="btopp" colspan="3">  Less: Statutory Remittances PAYE (Flat Rate-{{$global->paye}}%) <br>
            </td>
            <td  class="bleft t-right">
                @php
                $paye =  $global->paye/100;
                $paye_deduct = $salary * $paye;
            @endphp
                -{{$currency}} @moneyFormat($paye_deduct)
            </td>
        </tr>
        <tr>
            <td  class="btobp" colspan="3">
                NSSF ({{$global->employee_nssf}}%)
            </td>
            <td  class="bleft t-right">
                @php
                    $nssf =  $global->employee_nssf/100;
                    $nssf_deduct = $salary * $nssf;
                @endphp
                -{{$currency}} @moneyFormat($nssf_deduct)
            </td>
        </tr>
        <tr class="brow t-bold">
            <td  class="btop" colspan="3">
                Net Payable
            </td>
            <td  class="btop t-right">
                @php
                    $net_deduct = $nssf_deduct+$paye_deduct;
                    $net_pay = $salary-$net_deduct;
                @endphp
                {{$currency}} @moneyFormat($net_pay)
            </td>
        </tr>
        <tr>
            <td colspan="2">Remittance Method:</td>
            <td colspan="2">Electonic Funds Transfer</td>
        </tr>
        <tr>
            <td colspan="2">Account Name:</td>
            <td colspan="2">{{$bank_account->account_name??'No bank data'}}</td>
        </tr>
        <tr>
            <td colspan="2">Bank Name:</td>
            <td colspan="2">{{$bank_account->bank_name??'No bank data'}}</td>
        </tr>
        <tr>
            <td  colspan="2">Branch Name:</td>
            <td  colspan="2">{{$bank_account->branch??'No bank data'}} </td>
        </tr>
        <tr>
            <td  colspan="2">Account No:</td>
            <td  colspan="2">{{$bank_account->account_number??'No bank data'}}</td>
        </tr>
        <tr class="brow">
            <td  class="btop t-bold">
                Prepared by:
            </td>
            <td  class="btop">
                Nalwadda Geraldine
            </td>
            <td  class="btop t-bold">
                Date
            </td>
            <td  class="btop">
                {{ \Carbon\Carbon::parse($month)->format('d-M-Y') }}
            </td>
        </tr>
        <tr>
            <td colspan="4"><br></td>
        </tr>
        <tr class="brow">
            <td  class="btop t-bold">
                Approved by:
            </td>
            <td  class="btop">
                Joloba Moses
            </td>
            <td  class="btop t-bold">
                Date
            </td>
            <td  class="btop">
                {{ \Carbon\Carbon::parse($month)->format('d-M-Y') }}
            </td>
        </tr>
        <tr>
            <td colspan="4"><br></td>
        </tr>
        <tr class="brow">
            <td  class="btop t-bold">
                Received by:
            </td>
            <td  class="btop">
                {{ $employee->employee?->fullName }}
            </td>
            <td  class="btop t-bold">
                Date
            </td>
            <td  class="btop">
                {{ \Carbon\Carbon::parse($month)->format('d-M-Y') }}
            </td>
        </tr>
    </table>
</body>
</html>