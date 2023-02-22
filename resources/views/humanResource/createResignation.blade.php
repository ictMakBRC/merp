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
                    Upload Resignation Letter
                    <x-slot:buttons>
        
                    </x-slot>
                </x-card-header>
                
                <div class="card-body">
                    <!-- File Upload -->
                    <form method="POST" enctype="multipart/form-data" id="resignationForm">
                        @csrf
                        <div class="row col-md-12">
                            <div class="mb-3 col-md-8">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" id="subject" class="form-control" name="subject" required>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="handoverDate" class="form-label">Expected Date of Hand-over</label>
                                <input type="date" id="handoverDate" class="form-control" name="hand_over_date"
                                    required>
                            </div>
                            <div class="col-md-12">
                                <label for="letter" class="form-label">Resignation Letter</label>
                                <input name="letter" type="file" id="letter" class="form-control"
                                    accept=".pdf,.doc,.docx">
                            </div>
                            {{-- <div class="col-md-8"></div>
                            <div class="col-md-4 text-end pt-1">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div> --}}
                        </div>
                        @include('layouts.inc.form-submit')
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {

                //STORE RESIGNATION
                $('#resignationForm').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    swal({
                            title: 'Are you sure?',
                            text: 'This action is irreversible once the Resignation letter has been submitted!',
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willConfirm) => {
                            if (willConfirm) {

                                $.ajax({
                                    type: 'POST',
                                    enctype: 'multipart/form-data',
                                    url: "{{ route('resignations.store') }}",
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
                                            $('#resignationForm').trigger('reset');
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
