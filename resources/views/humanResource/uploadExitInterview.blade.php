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
                    Upload Completed Exit Interview
                    <x-slot:buttons>
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="interviewForm">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="interview_file" class="form-label">Completed Interview File</label>
                                <input name="interview_file" type="file" id="interview_file" class="form-control"
                                    required accept=".pdf">
                            </div>
                            
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

            //STORE GRIEVANCE
            $('#interviewForm').submit(function(e) {

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
                                url: "{{ route('exitInterviews.store') }}",
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
                                        $('#interviewForm').trigger('reset');
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
