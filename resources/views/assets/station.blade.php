<x-asset-layout>
    <x-page-title>
        Stations
    </x-page-title>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center"> MakBRC Stations</h4>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <a type="button" href="addStation.html" class="btn btn-success mb-2 me-1"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Station</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="table-responsive">
                            <table id="datableButtons" class="table w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Station Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stations as $key => $station)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $station->station_name }}</td>
                                            <td>{{ $station->description }}</td>
                                            <td>{{ $station->status }}</td>
                                            <td>{{ $station->created_at }}</td>
                                            <td class="table-action">
                                                <a href="javascript: void(0);" class="action-icon"> <i
                                                        class="mdi mdi-pencil" data-bs-toggle="modal"
                                                        data-bs-target="#editStation{{ $station->id }}"></i></a>
                                                <a onclick="return confirm('Are you sure you want to delete?');"
                                                    href="{{ route('stations.destroy', [$station->id]) }}"
                                                    class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    <!-- ADD NEW STATION Modal -->
    @include('assets.stationModal')
    @foreach ($stations as $key => $station)
        <!-- EDIT STATION Modal -->
        <div class="modal fade" id="editStation{{ $station->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Station</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div> <!-- end modal header -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('stations.update', [$station->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="station_name" class="form-label">Station Name</label>
                                        <input type="text" id="station_name" class="form-control"
                                            value="{{ $station->station_name }}" name="station_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="is_active" class="form-label">Status</label>
                                        <select class="form-select" id="is_active" name="status">
                                            <option selected value="{{ $station->status }}">{{ $station->status }}
                                            </option>
                                            <option value='Active'>Active</option>
                                            <option value='Inactive'>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" rows="3" name="description">{{ $station->description }}</textarea>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-success" type="submit">Update Station</button>
                            </div>
                        </form>
                    </div>

                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->
    @endforeach
</x-asset-layout>
