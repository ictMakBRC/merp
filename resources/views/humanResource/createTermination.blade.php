<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Create Termination
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
                                <h4 class="header-title mb-3  text-center">Upload Official Termination Letter</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="terminationForm">
                        @csrf
                        <div class="row col-md-12">
                            <div class="mb-3 col-md-4">
                                <label for="employee" class="form-label">Employee</label>
                                <select class="form-select select2" data-toggle="select2" id="employee"
                                    name="employee_id" required>
                                    <option selected value="">Select</option>
                                    @foreach ($employees as $employee)
                                        <option value='{{ $employee->id }}'>{{ $employee->fullName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="reason" class="form-label">Termination Reason</label>
                                <select class="form-select select2" data-toggle="select2" id="reason" name="reason"
                                    required>
                                    <option selected value="">Select</option>
                                    <option value='Gross Misconduct'>Gross Misconduct</option>
                                    <option value='Contract Expiry'>Contract Expiry</option>
                                    <option value='Redundancy'>Redundancy</option>
                                    <option value='Resignation'>Resignation</option>
                                    <option value='Retirement'>Retirement</option>
                                    <option value='Medical Grounds'>Medical Grounds</option>
                                    <option value='Death'>Death</option>
                                    <option value='Poor Performance during probation period'>Poor Performance during
                                        probation period</option>
                                    <option value='Failure to perform after confirmation'>Failure to perform after
                                        confirmation</option>
                                    <option value='Organisation/Company Restructuring'>Organisation/Company
                                        Restructuring</option>

                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="terminationDate" class="form-label">Termination Date (30 Days from
                                    now)</label>
                                <input type="date" id="terminationDate" class="form-control" name="termination_date"
                                    required>
                            </div>
                            <div class="col-md-12">
                                <label for="letter" class="form-label">Termination Letter</label>
                                <input name="letter" type="file" id="letter" class="form-control" required
                                    accept=".pdf,.doc,.docx">
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

                //STORE TERMINATION
                $('#terminationForm').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    swal({
                            title: 'Are you sure?',
                            text: 'This action is irreversible once the Termination letter has been submitted!',
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willConfirm) => {
                            if (willConfirm) {
                                $.ajax({
                                    type: 'POST',
                                    enctype: 'multipart/form-data',
                                    url: "{{ route('terminations.store') }}",
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
                                            $('#terminationForm').trigger('reset');
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
