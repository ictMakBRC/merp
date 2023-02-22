<x-super-admin-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>
    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    System User Logs
                    <x-slot:buttons>
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datableButtons" class="table w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Email</th>
                                    <th>Description</th>
                                    <th>Platform</th>
                                    <th>Browser</th>
                                    <th>Client_IP</th>
                                    <th>Period</th>
                                    <th>Activity Date/time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $key => $log)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $log->email }}</td>
                                        <td>{{ $log->description }}</td>
                                        <td>{{ $log->platform }}</td>
                                        <td>{{ $log->browser }}</td>
                                        <td>{{ $log->client_ip }}</td>
                                        <td>{{ $log->created_at->diffForHumans() }}</td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end preview-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

</x-super-admin-layout>
