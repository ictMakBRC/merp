<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Upload Appraisal
    </x-page-title>
    <!-- end page title -->

    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">Upload Completed Performance Appraisal</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="appraisalForm">
                        @csrf
                        <div class="row col-md-12">
                            <div class="mb-3 col-md-6">
                                <label for="date5" class="form-label">From (Period)</label>
                                <input type="date" id="date1" class="form-control" name="start_date"required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="date6" class="form-label">To (Period)</label>
                                <input type="date" id="date2" class="form-control" name="end_date"required>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="employee" class="form-label">Employee</label>
                                <select class="form-select select2" data-toggle="select2" id="employee"
                                    name="employee_id" required>
                                    <option selected value="">Select</option>
                                    <option value='{{ auth()->user()->employee_id }}'>{{ auth()->user()->name }}</option>
                                    @foreach ($employees as $employee)
                                        <option value='{{ $employee->id }}'>{{ $employee->fullName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="appraisal" class="form-label">Completed Appraisal</label>
                                <input name="appraisal_file" type="file" id="appraisal" class="form-control" required
                                    accept=".pdf">
                            </div>
                            <div class="col-md-8"></div>
                            <div class="col-md-4 text-end pt-1">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            //STORE GRIEVANCE
            $('#appraisalForm').submit(function(e) {

                e.preventDefault();
                let formData = new FormData(this);

                swal({
                        title: 'Are you sure you want to Upload?',
                        text: 'This action is irreversible once submitted!',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willConfirm) => {
                        if (willConfirm) {
                            $.ajax({
                                type: 'POST',
                                enctype: 'multipart/form-data',
                                url: "{{ route('appraisals.store') }}",
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: (response) => {

                                    if (response.status === 'success') {
                                        iziToast.success({
                                            title: 'Good!',
                                            message: response.message,
                                            position: 'topRight'
                                        });
                                        $('#appraisalForm').trigger('reset');
                                    } else {
                                        swal('Error', `Oops! ${response.message}`, 'error');
                                    }

                                },
                                error: function(response) {
                                    swal('Error', 'Oops! Something went wrong', 'error');

                                }
                            });
                        } else {

                            return
                        }
                    });

            });
        });
    </script>
@endpush
</x-hr-layout>
