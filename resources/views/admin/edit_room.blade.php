@include('admin.partials._header')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Booking Discussion Room</h6>
    </div>
    <div class="card-body">
        <form action="{{route("admin.post.edit.room", $find)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="name">Time (1)</label>
                    <select class="form-control" id="id_time1" name="id_time" required>
                        <option value="">Select Your Time</option>
                        
                        @foreach($times as $data)
                        <option value="{{$data->id}}">{{$data->time}}</option>
                        @endforeach
                    </select>
            </div>

            
            <div class="form-group">
                <label for="name">Time (2)</label>
                    <select class="form-control" id="id_time2" name="id_time2" required>
                        <option value="">Select Your Time</option>
                        @foreach($times as $data)
                        <option value="{{$data->id}}">{{$data->time}}</option>
                        @endforeach
                    </select>
            </div>

            <div class="form-group">
                <label for="name">Time (3)</label>
                    <select class="form-control" id="id_time3" name="id_time3" required>
                        <option value="">Select Your Time</option>
                        @foreach($times as $data)
                        <option value="{{$data->id}}">{{$data->time}}</option>
                        @endforeach
                    </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{route("admin.ruangan")}}" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>
@include('admin.partials.footer')
