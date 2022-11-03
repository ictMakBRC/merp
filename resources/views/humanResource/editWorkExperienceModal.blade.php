@foreach ($experiences as $experience)
    <div class="modal fade" id="editExp{{ $experience->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Work Experience Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form action="{{ route('workExperience.update', $experience->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="company" class="form-label">Company/Organisation/Office</label>
                                <input type="text" id="company" class="form-control" name="company"
                                    value="{{ $experience->company }}" required>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="date1" class="form-label">From</label>
                                <input type="date" id="date1" class="form-control" name="start_date"
                                    value="{{ $experience->start_date }}" required>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="date2" class="form-label">To</label>
                                <input type="date" id="date2" class="form-control" name="end_date"
                                    value="{{ $experience->end_date }}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="position_held" class="form-label">Position Held</label>
                                <input type="text" id="position_held" class="form-control" name="position_held"
                                    value="{{ $experience->position_held }}" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="employment_type" class="form-label">Employment Type</label>
                                <select class="form-select" id="employment_type" name="employment_type" required>
                                    <option selected value="{{ $experience->employment_type }}">
                                        {{ $experience->employment_type }}</option>
                                    <option value='Half Time'>Half Time</option>
                                    <option value='Full Time'>Full Time</option>
                                    <option value='Probation'>Probation</option>
                                    <option value='Contract'>Contract</option>
                                    <option value='Commission'>Commission</option>
                                    <option value='Volunteer'>Volunteer</option>
                                    <option value='Intern'>Intern</option>
                                    <option value='Trainee'>Trainee</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="monthly_salary" class="form-label">Monthly Salary/Wage</label>
                                <input type="text" id="monthly_salary" class="form-control" name="monthly_salary"
                                    value="{{ $experience->monthly_salary }}">
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="service_length" class="form-label">Length Of Service</label>
                                <input type="text" id="service_length" class="form-control" name="service_length"
                                    value="{{ $experience->service_length }}">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="job-description" class="form-label">Key Responsibilities</label>
                                <textarea type="text" id="job-description" rows="4" class="form-control" name="job_description">{{ $experience->job_description }}</textarea>
                            </div>
                            <div class="col-md-8"></div>
                            <div class="col-md-4 text-end pt-1">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->
@endforeach
