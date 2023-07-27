@include('admin.partials._header')
<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">HIstory Discussion Room</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            @if ($bookingRooms->isEmpty())
                            <td colspan="5" class="text-center">No Data</td>
                            @endif
                            <td>
                                {{$item->id_student}}
                            </td>
                            <td>
                                {{$item->nama_room}}
                            </td>
                            <td>
                                {{$item->time}}
                            </td>

                            <td>
                                {{$item->status}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History P.A.L</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                            @if ($bookingPal->isEmpty())
                            <td colspan="5" class="text-center">No Data</td>
                            @endif
                           
                            <td>
                                {{$item->id_student}}
                            </td>
                            <td>
                                {{$item->nama_pal}}
                            </td>
                            <td>
                                {{$item->handphone_pal}}
                            </td>

                            <td>
                                {{$item->name}}
                            </td>

                            <td>
                                {{$item->status}}
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')
