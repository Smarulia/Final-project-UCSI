@include('admin.partials._header')
<div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data of PAL</h6>
        </div>
        <div class="card-body">
            <a href="{{route("admin.pal.add")}}" class="btn btn-primary mb-3">Add P.A.L (Peer-Assisted Learning)</a>
            <a href="{{route("admin.jurusan")}}" class="btn btn-primary mb-3">Add Course Name and Code</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name PAL</th>
                            <th>Course Name and Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($pals as $item)
                        <tr>
                        
                            <td>{{$item->nama_pal}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                <a href="{{route('admin.edit.pal',$item->id)}}" class="btn btn-warning">Edit</a>
                                @if ($item->status == 'hide')
                                    <a href="{{route('admin.visible.pal',$item->id)}}" id="show_button" class="btn btn-success">Show</a>
                                @else
                                    <a href="{{route('admin.hide.pal',$item->id)}}" id="hide_button" class="btn btn-danger">Hide</a>
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
    const showButton = document.querySelectorAll('#show_button');
    const hideButton = document.querySelectorAll('#hide_button');

    hideButton.forEach(button => {
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

    showButton.forEach(button => {
        button.addEventListener('click', () => {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data has been Show',
                showConfirmButton: false,
                timer: 15000
            })
        });
    });

</script>