@include('user.partials._header')
<div class="col-md-12">
    @if (Auth::user()->role != "culture")
        
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Discussion Room</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id student</th>
                            <th>Discussion Room</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                        @if ($bookingRooms->isEmpty())
                            <td colspan="5" class="text-center">No Data</td>
                        @endif
                        @foreach ($bookingRooms as $item)
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
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>       
        </div>
    </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Discussion Room</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id student</th>
                            <th>PAL Name</th>
                            <th>Phone Number</th>
                            <th>Course Name and Code</th>
                            <th>Status</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <tr>
                        @if ($bookingPal->isEmpty())
                            <td colspan="5" class="text-center">No Data</td>
                        @endif
                        @foreach ($bookingPal as $item)
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
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>      
        </div>
    </div>
</div>
@include('user.partials.footer')
