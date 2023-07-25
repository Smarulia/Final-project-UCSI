@include('admin.partials._header')
<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Discussion Room </h6>
        </div>
        <div class="card-body">
            <a href="{{route("admin.ruangan.add")}}" class="btn btn-primary mb-3">Add Data Discussion Room</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name Room</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($room_data as $data)

                        <tr>
                            {{-- jika kosong --}}
                            @if ($data == null)
                           <td colspan="6" class="text-center">Not Available</td>
                            @endif
                            <td>{{$data->nama_room}}</td>
                            <td>
                                {{-- <a href="{{ route('user.edit.booking.room', ['roomId' => $item['id']]) }}" class="btn btn-warning">Reschedule</a> --}}
                                <a href="{{route('admin.edit.room',$data->id)}}" class="btn btn-warning">Edit</a>
                                @if ($data->status == "hide")
                                    <a href="{{route('admin.visible.room',$data->id)}}" id="unhide_button" class="btn btn-success">Un-hide</a>
                                @else
                                <a href="{{route('admin.hide.room',$data->id)}}" id="hide_button" class="btn btn-danger">Hide</a>
                                @endif
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

<script>
    const HideButton = document.querySelectorAll('#hide_button');
    const unhide_button = document.querySelectorAll('#unhide_button');

    HideButton.forEach(button => {
        button.addEventListener('click', () => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data has been hide',
                showConfirmButton: false,
                timer: 15000
            })
        });
    });

    unhide_button.forEach(button => {
        button.addEventListener('click', () => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data has been un-hide',
                showConfirmButton: false,
                timer: 15000
            })
        });
    });

</script>

