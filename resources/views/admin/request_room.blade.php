@include('admin.partials._header')
<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Booking Information of Discussion Room</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Number</th>
                            <th>Time</th>
                            <th>Room</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tampilan as $data)
                        <tr>
                            <td>{{$data->id_student}}</td>
                            <td>{{$data->time}}</td>
                            <td>{{$data->nama_room}}</td>
                            <td>{{$data->date}}</td>
                            <td>
                                @if ($data->status == "approve")
                                <form action="{{ route('admin.request.room.done') }}" id="done_form" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <button type="submit" id="btn_reject" class="btn btn-success">Done</button>
                                </form>
                                @else
                                <form action="{{ route('admin.request.room.approve') }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <button type="submit" id="approve_button" class="btn btn-warning">Approve</button>
                                </form>
                                <form action="{{ route('admin.request.room.reject') }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <button type="submit" id="reject_button" class="btn btn-danger">Not Approve</button>
                                </form>
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
    const RejectButton = document.querySelectorAll('#reject_button');
    const ApproveButton = document.querySelectorAll('#approve_button');

    RejectButton.forEach(button => {
        button.addEventListener('click', () => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data has been rejected',
                showConfirmButton: false,
                timer: 15000
            })
        });
    });

    ApproveButton.forEach(button => {
        button.addEventListener('click', () => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data has been approved',
                showConfirmButton: false,
                timer: 15000
            })
        });
    });

    document.querySelector('#done_form').addEventListener('submit', function (e) {
        var form = this;
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to Done this booking?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Done it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });

</script>
