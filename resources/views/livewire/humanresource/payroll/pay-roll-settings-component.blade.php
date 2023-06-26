<div>
    <!-- start page title -->
    <x-page-title>
        Payroll Settings
    </x-page-title>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                        <li class="nav-item" wire:ignore.self>
                            <a href="#Prepared" data-bs-toggle="tab" aria-expanded="false" wire:ignore.self
                                class="nav-link rounded-0 active">
                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                <span class="d-none d-md-block">Payslip Preppers</span>
                                {{-- wire:click="$set('type','Approver')" --}}
                            </a>
                        </li>
                        <li class="nav-item" wire:ignore.self>
                            <a href="#Approved" data-bs-toggle="tab" aria-expanded="true" wire:ignore.self
                                class="nav-link rounded-0">
                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                <span class="d-none d-md-block">Payslip Approvers</span>
                            </a>
                        </li>
                        <li class="nav-item" wire:ignore.self>
                            <a href="#settings1" data-bs-toggle="tab" aria-expanded="false" wire:ignore.self
                                class="nav-link rounded-0">
                                <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                <span class="d-none d-md-block">Deduction and Currency Settings</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="Prepared" wire:ignore.self>
                            <div class="row">
                                <div class="col-md-4">
                                    @include('livewire.humanresource.payroll.add_employee')
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-items-center mt-4">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($approvalers->where('type', 'Prepper') as $keys => $approvaler)
                                                    <tr>
                                                        <td>{{ $keys + 1 }}</td>
                                                        <td>{{ $approvaler->employee->fullname }}</td>
                                                        <td><a href="javascript:void()" wire:click='removeUser({{$approvaler->id}})'class="action-icon"> <i class="mdi mdi-delete"></i></a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" wire:ignore.self id="Approved" wire:ignore.self>
                            <div class="row">
                                <div class="col-md-4">
                                    @include('livewire.humanresource.payroll.add_approver_employee')
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-items-center mt-4">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($approvalers->where('type', 'Approver') as $key => $approvaler)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $approvaler->employee->fullname }}</td>
                                                        <td><a href="javascript:void()" wire:click='removeUser({{$approvaler->id}})'class="action-icon"> <i class="mdi mdi-delete"></i></a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" wire:ignore.self id="settings1">
                            <form wire:submit.prevent='addNewRates' class="form m-2">
                                <div class="row">
                                    <div class="mb-1 col">
                                        <label for="vat" class="form-label">VAT RAte</label>
                                        <input type="text" id="vat" class="form-control" name="vat"
                                            required wire:model.defer="vat">
                                        @error('vat')
                                            <div class="text-danger text-small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-1 col">
                                        <label for="vat" class="form-label">PAYE</label>
                                        <input type="text" id="paye" class="form-control" name="paye"
                                            required wire:model.defer="paye">
                                        @error('paye')
                                            <div class="text-danger text-small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-1 col">
                                        <label for="employee_nssf" class="form-label">Emloyee NSSF</label>
                                        <input type="text" id="employee_nssf" class="form-control"
                                            name="employee_nssf" required wire:model.defer="employee_nssf">
                                        @error('employee_nssf')
                                            <div class="text-danger text-small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-1 col">
                                        <label for="employer_nssf" class="form-label">Employer NSSF</label>
                                        <input type="text" id="employer_nssf" class="form-control"
                                            name="employer_nssf" required wire:model.defer="employer_nssf">
                                        @error('employer_nssf')
                                            <div class="text-danger text-small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-1 col">
                                        <label for="usd_rate" class="form-label">USD RATE</label>
                                        <input type="text" id="usd_rate" class="form-control" name="usd_rate"
                                            required wire:model.defer="usd_rate">
                                        @error('usd_rate')
                                            <div class="text-danger text-small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-1 col">
                                        <label for="eur_rate" class="form-label">EUR RATE</label>
                                        <input type="text" id="eur_rate" class="form-control" name="eur_rate"
                                            required wire:model.defer="eur_rate">
                                        @error('eur_rate')
                                            <div class="text-danger text-small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-1 col">
                                        <label for="gbp_rate" class="form-label">GBP</label>
                                        <input type="text" id="gbp_rate" class="form-control" name="gbp_rate"
                                            required wire:model.defer="gbp_rate">
                                        @error('gbp_rate')
                                            <div class="text-danger text-small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-success float-end">{{ __('Save') }}</button>
                                    </div>
                                </div>

                            </form>
                            <div class="table-responsive">
                                <table class="table table-hover align-items-center mt-4">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>VAT</th>
                                            <th>PAYE</th>
                                            <th>EMPLOYEE NSSF</th>
                                            <th>EMPLOYER NSSF</th>
                                            <th>USD RATE</th>
                                            <th>EUR RATE</th>
                                            <th>GBP RATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_settings as $key => $setting)
                                            <tr @if ($setting->status == '1') class="alert alert-success" @endif>
                                                <td>{{ $key + 1 }}</td>
                                                <td>@moneyFormat($setting->vat)</td>
                                                <td>@moneyFormat($setting->paye)</td>
                                                <td>@moneyFormat($setting->employee_nssf)</td>
                                                <td>@moneyFormat($setting->employer_nssf)</td>
                                                <td>@moneyFormat($setting->usd_rate)</td>
                                                <td>@moneyFormat($setting->eur_rate)</td>
                                                <td>@moneyFormat($setting->gbp_rate)</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
