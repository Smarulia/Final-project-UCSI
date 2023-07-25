@include('admin.partials._header')
<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Booking Information of P.A.L</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Student</th>
                            <th>P.A.L Name</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tampilan as $request_pal)
                        <tr>
                            <td>{{$request_pal->id_student}}</td>
                            <td>{{$request_pal->nama_pal}}</td>
                            <td>{{$request_pal->name}}</td>

                            <td>
                                @if ($request_pal->status == "approved")
                                <form action="{{ route('admin.request.pal.done') }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$request_pal->id}}">
                                    <button type="submit" id="btn_reject" class="btn btn-success">Done</button>
                                </form>
                                @else
                                <form action="{{ route('admin.request.pal.approve') }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$request_pal->id}}">
                                    <button type="submit" id="btn_approve" class="btn btn-warning">Approve</button>
                                </form>
                                <form action="{{ route('admin.request.pal.reject') }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$request_pal->id}}">
                                    <button type="submit" id="btn_reject" class="btn btn-danger">Not Approve</button>
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
    const ApproveButton = document.querySelectorAll('#btn_approve');
    const Rejectbutton = document.querySelectorAll('#btn_reject');

    ApproveButton.forEach(button => {
        button.addEventListener('click', () => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data has been Approved',
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
                title: 'Data has been Delete',
                showConfirmButton: false,
                timer: 15000
            })
        });
    });

</script>
