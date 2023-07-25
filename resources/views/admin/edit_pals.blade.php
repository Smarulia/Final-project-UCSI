@include('admin.partials._header')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Booking PAL</h6>
    </div>
    <div class="card-body">
        <form action="{{route("admin.post.edit.pal", $pal)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name PAL</label>
                <input type="text" class="form-control" id="name_pal" name="name_pal" required>
            </div>

            <div class="form-group">
                <label for="pal-type">Course Name and Code</label>
                <select class="form-control" id="jurusan" name="jurusan_id" required>
                    <option value="">Select PAL</option>
                    @foreach ($jurusan as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Phone Number PAL</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" required placeholder="+608234131230">
                <small id="emailHelp" class="form-text text-muted">PLease add (+)</small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{route("admin.pal")}}" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>
@include('admin.partials.footer')
