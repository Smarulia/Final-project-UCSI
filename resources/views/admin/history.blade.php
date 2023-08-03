@include('admin.partials._header')

<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History Discussion Room</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($bookingRooms->isEmpty())
                    <p class="text-center">No Data</p>
                @else
                    <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>Discussion Room</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookingRooms as $item)
                                <tr>
                                    <td>{{ $item->id_student }}</td>
                                    <td>{{ $item->nama_room }}</td>
                                    <td>{{ $item->time }}</td>
                                    <td>{{ $item->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History P.A.L</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($bookingPal->isEmpty())
                    <p class="text-center">No Data</p>
                @else
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Number</th>
                                <th>PAL Name</th>
                                <th>Phone Number</th>
                                <th>Course Name and Code</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookingPal as $item)
                                <tr>
                                    <td>{{ $item->id_student }}</td>
                                    <td>{{ $item->nama_pal }}</td>
                                    <td>{{ $item->handphone_pal }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>

@include('admin.partials.footer')
