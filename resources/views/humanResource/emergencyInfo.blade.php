<form  method="POST" id="emergencyContact">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="empId" class="form-label">Employee</label>
            <select class="form-select select2" data-toggle="select2" id="empId" name="employee_id" required>
                @if (Auth::user()->hasRole(['HrSupervisor', 'SuperAdmin', 'HrUser']))
                    <option value='{{ Auth::user()->employee->status==='Active'?Auth::user()->employee_id:'' }}'>{{ Auth::user()->employee->status==='Active'?Auth::user()->employee->fullName:'Select' }}</option>
                @else
                    <option selected value="">Select</option>
                    @foreach ($employees as $employee)
                        <option value='{{ $employee->id }}'>{{ $employee->fullName }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="contact_relationship" class="form-label">Relationship To Contact</label>
            <input type="text" id="contact_relationship" class="form-control" name="contact_relationship" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="contact_name" class="form-label">Contact Name</label>
            <input type="text" id="contact_name" class="form-control" name="contact_name" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="contact_email" class="form-label">Email</label>
            <input name="contact_email" type="email" id="contact_email" class="form-control">
        </div>
        <div class="mb-3 col-md-4">
            <label for="contact_phone" class="form-label">Phone Number</label>
            <input name="contact_phone" type="text" id="contact_phone" class="form-control" required>
        </div>
        <div class="mb-3 col-md-4">
            <label for="contact_address" class="form-label">Address</label>
            <input name="contact_address" type="text" id="contact_address" class="form-control" required>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4 text-end pt-1">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </div>
</form>
