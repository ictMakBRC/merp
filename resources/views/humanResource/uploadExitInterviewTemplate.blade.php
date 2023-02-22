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
                    Exit Interview Template Upload
                    <x-slot:buttons>
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <!-- File Upload -->
                    <form action="{{ route('interviewtemplate.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class=" mb-3 col-md-12">
                                <label for="template_file" class="form-label">Template File</label>
                                <input name="template_file" type="file" id="template_file" class="form-control"
                                    required accept=".docx">
                            </div>
                        </div>
                        @include('layouts.inc.form-submit')
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

</x-hr-layout>
