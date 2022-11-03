<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Create Warning
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
                                <h4 class="header-title mb-3  text-center">Upload Warning Letter</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="warningForm">
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
                                <label for="reason" class="form-label">Reason</label>
                                <select class="form-select select2" data-toggle="select2" id="reason" name="reason"
                                    required>
                                    <option selected value="">Select</option>
                                    <option value='Misconduct'>Misconduct</option>
                                    <option value='Corruption'>Corruption</option>
                                    <option value='Absecondment'>Absecondment</option>
                                    <option value='Sexual Harrasment'>Sexual Harrasment</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="letter" class="form-label">Warning Letter</label>
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

                //STORE WARNING
                $('#warningForm').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    swal({
                            title: 'Are you sure?',
                            text: 'This action is irreversible once the Warning letter has been submitted!',
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willConfirm) => {
                            if (willConfirm) {
                                $.ajax({
                                    type: 'POST',
                                    enctype: 'multipart/form-data',
                                    url: "{{ route('warnings.store') }}",
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
                                            $('#warningForm').trigger('reset');
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
