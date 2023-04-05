<x-hr-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    
    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    >Appraisal Form Template Upload
                    <x-slot:buttons>
                    </x-slot>
                </x-card-header>
                <div class="card-body">
                    <!-- File Upload -->
                    <form action="{{ route('appraisaltemplate.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="apparaisalform" class="form-label">Appraisal Form Template</label>
                                <input name="apparaisalform" type="file" id="apparaisalform" class="form-control"
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
