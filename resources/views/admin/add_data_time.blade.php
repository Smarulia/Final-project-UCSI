@include('admin.partials._header')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Booking Discussion Room</h6>
    </div>
    <div class="card-body">
        <form action="{{route("admin.ruangan.post.add.time")}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Time</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>
@include('admin.partials.footer')
