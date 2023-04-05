<x-hr-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end quote -->

    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    Create Grievance
                    <x-slot:buttons>
        
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <!-- File Upload -->
                    <form method="POST" enctype="multipart/form-data" id="grievanceForm">
                        @csrf
                        <div class="row col-md-12">
                            <div class="mb-3 col-md-4">
                                <label for="grievance_type" class="form-label">Type</label>
                                <select class="form-select select2" data-toggle="select2" id="grievance_type"
                                    name="grievance_type" required>
                                    <option selected value="">Select</option>
                                    <option value='Individual'>Individual</option>
                                    <option value='Collective'>Collective</option>
                                    <option value='Interpersonal issues'>Interpersonal issues</option>
                                    <option value='Pay and benefits'>Pay and benefits</option>
                                    <option value='Gender pay gap'>Gender pay gap</option>
                                    <option value='Working time and Condition'>Working time and Condition</option>
                                    <option value='Tactical grievance'>Tactical grievance</option>
                                    <option value='Whistleblowing'>Whistleblowing</option>
                                    <option value='Workload'>Workload</option>
                                    <option value='Other'>Other</option>

                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="addressee" class="form-label">Addressee</label>
                                <select class="form-select select2" data-toggle="select2" id="addressee"
                                    name="addressee" required>
                                    <option value='' selected>Select</option>
                                    <option value="Administration">Administration</option>
                                    <option value='Department'>Department</option>
                                    <option value='Both'>Both</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="supportFile" class="form-label">Support file (Optional) </label>
                                <input name="support_file" type="file" id="supportFile" class="form-control"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" id="description" class="form-control" name="description" rows="5" required></textarea>
                            </div>
                            <div class="col-md-8"></div>
                            <div class="col-md-4 text-end pt-1">
                                <button class="btn btn-success" type="submit">Save</button>
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
                $('#grievanceForm').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    swal({
                            title: 'Are you sure?',
                            text: 'This action is irreversible once the Grievance has been submitted!',
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willConfirm) => {
                            if (willConfirm) {
                                $.ajax({
                                    type: 'POST',
                                    enctype: 'multipart/form-data',
                                    url: "{{ route('grievances.store') }}",
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
                                            $('#grievanceForm').trigger('reset');
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
