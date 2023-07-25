@include('user.partials._header')
<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Booking status P.A.L</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <a href="{{route("user.booking.pal")}}" class="btn btn-primary mb-3">Book P.A.L (Peer-Assisted
                        Learning)</a>
                    <thead>
                        <tr>
                            <th>P.A.L Name</th>
                            <th>Phone Number</th>
                            <th>Course Name and Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pals as $item)
                        <tr>
                            <td>{{$item->nama_users}}</td>
                            <td>
                                @php
                                // Mengambil nomor telepon dari variabel $item
                                $nomorTelepon = $item->handphone_pal;

                                // Membuat link WhatsApp dengan nomor telepon
                                $linkWhatsApp = "http://wa.me/".$nomorTelepon;
                                @endphp
                                <a href="{{$linkWhatsApp}}">{{$item->handphone_pal}}</a>
                            </td>
                            <td>{{$item->nama_pal}}</td>
                            <td>{{strtoupper($item->status)}}</td>
                            <td>
                                <a href="{{ route('user.edit.booking.pal',$item->id) }}"
                                    class="btn btn-warning">edit</a>
                                <form action="{{ route('user.cancel.pal') }}"id="form_cancel" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button type="submit"  class="btn btn-danger">Cancel</button>
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
