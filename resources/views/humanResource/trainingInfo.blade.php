<form method="POST" enctype="multipart/form-data" id="trainingForm">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="emp-ID" class="form-label">Employee</label>
            <select class="form-select select2" data-toggle="select2" id="emp-ID" name="employee_id" required>
                @if (Auth::user()->hasRole(['HrSupervisor', 'SuperAdmin', 'HrUser']))
                    <option value='{{ Auth::user()?->employee?->status==='Active'?Auth::user()->employee_id:'' }}'>{{ Auth::user()?->employee?->status==='Active'?Auth::user()?->employee?->fullName:'Select' }}</option>
                @else
                    <option selected value="">Select</option>
                    @foreach ($employees as $employee)
                        <option value='{{ $employee->id }}'>{{ $employee->fullName }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mb-3 col-md-3">
            <label for="date3" class="form-label">From</label>
            <input type="date" id="date3" class="form-control" name="start_date"required
                value="{{ old('start_date', '') }}">
        </div>
        <div class="mb-3 col-md-3">
            <label for="date4" class="form-label">To</label>
            <input type="date" id="date4" class="form-control" name="end_date"required
                value="{{ old('end_date', '') }}">
        </div>
        <div class="mb-3 col-md-6">
            <label for="organised_by" class="form-label">Training Organised By</label>
            <input type="text" id="organised_by" class="form-control" name="organised_by" required
                value="{{ old('organised_by', '') }}">
        </div>
        <div class="mb-3 col-md-6">
            <label for="training_name" class="form-label">Title/Training Name</label>
            <input type="text" id="training_name" class="form-control" name="training_name"
                value="{{ old('training_name', '') }}"
                placeholder="Title of Seminar/Conference/ Workshop/Short Courses">
        </div>
        <div class="mb-3 col-md-12">
            <label for="training_description" class="form-label">Description Of Training</label>
            <textarea type="text" id="training_description" class="form-control" rows="3" name="training_description">{{ old('training_description', '') }}</textarea>
        </div>
        <div class="mb-3 col-md-6">
            <label for="training_length" class="form-label">Length Of Training</label>
            <input type="text" id="training_length" class="form-control" name="training_length"
                value="{{ old('training_length', '') }}">
        </div>
        <div class="mb-3 col-md-6">
            <label for="certificate" class="form-label">End of Tranining Document</label>
            <input type="file" id="certificate" class="form-control" name="certificate" accept=".pdf">
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4 text-end pt-1">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </div>
</form>
