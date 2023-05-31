@foreach ($trainings as $training)
    <div class="modal fade" id="editTraining{{ $training->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Training Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">

                    <form action="{{ route('trainingProgram.update', $training->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="organised_by" class="form-label">Training Organised By</label>
                                <input type="text" id="organised_by" class="form-control" name="organised_by"
                                    required value="{{ $training->organised_by }}">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="date3" class="form-label">From</label>
                                <input type="date" id="date3" class="form-control" name="start_date"required
                                    value="{{ $training->start_date }}">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="date4" class="form-label">To</label>
                                <input type="date" id="date4" class="form-control" name="end_date"required
                                    value="{{ $training->end_date }}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="training_name" class="form-label">Title/Training Name</label>
                                <input type="text" id="training_name" class="form-control" name="training_name"
                                    value="{{ $training->training_name }}"
                                    placeholder="Title of Seminar/Conference/ Workshop/Short Courses">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="training_length" class="form-label">Length Of Training</label>
                                <input type="text" id="training_length" class="form-control" name="training_length"
                                    value="{{ $training->training_length }}">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="certificate" class="form-label">End of Tranining Document</label>
                                <input type="file" id="certificate" class="form-control" name="certificate"
                                    accept=".pdf">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="training_description" class="form-label">Description Of Training</label>
                                <textarea type="text" id="training_description" class="form-control" rows="3" name="training_description">{{ $training->training_description }}</textarea>
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
