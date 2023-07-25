@include('admin.partials._header')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Course Name and Code</h6>
    </div>
    <div class="card-body">
        <form action="{{route("admin.jurusan.post.add")}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Course Name and Code</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" required>
            </div>
            
            
            <div class="d-flex justify-content-between">
                <a href="{{route("admin.pal")}}"<a href="" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>
@include('admin.partials.footer')
