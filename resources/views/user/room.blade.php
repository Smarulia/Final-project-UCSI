@include('user.partials._header')
<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Booking Status</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <a href="{{route("user.booking.room")}}" class="btn btn-primary mb-3">Book Discussion Room</a>
                    <thead>
                        <tr>
                            <th>ID Number</th>
                            <th>Discussion Room</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($rooms as $item)
                        <tr>
                            <td>{{$item["id_student"]}}</td>
                            <td>{{$item["namaRoom"]}}</td>
                            <td>{{$item["time"]}}</td>
                            <td>{{$item["status"]}}</td>
                            <td>
                                <a href="{{ route('user.edit.booking.room', ['roomId' => $item['id']]) }}" class="btn btn-warning">Reschedule</a>
                                
                                {{-- <a href="{{"cancelRoom"}}" class="btn btn-danger">Cancel</a> --}}
                                <form action="{{ route('user.cancel.room') }}" id="form_cancel" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item["id"]}}">
                                    <button type="submit" class="btn btn-danger">Cancel</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelector('#form_cancel').addEventListener('submit', function (e) {
        var form = this;
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to cancel this booking?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });

</script>
@include('user.partials.footer')


