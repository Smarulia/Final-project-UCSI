@include('user.partials._header')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Booking Discussion Room</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('user.post.edit.booking.room', ['roomId' => $roomId]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" value="{{Auth::user()->name}}" readonly name="name"
                    required>
            </div>

            <div class="form-group">
                <label for="room-type">Discussion Room</label>
                <select class="form-control" id="room_name" name="roomId" required>
                    <option value="">Select Your Discussion Room</option>
                    @foreach ($rooms as $room)
                    <option value="{{$room->id}}">
                        {{$room->nama_room}}
                    </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
                
            </div>

            <div class="form-group">
                <label for="date">Time</label>
                <select class="form-control" id="available_times" name="selectedTime" required>
                    <option value="" selected>Select Your Time</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{route("user.dashboard")}}" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>
@include('user.partials.footer')
<script>
    $('#room_name').change(() => {
        var selectedRoom = $('#room_name').val()
        $("#available_times").empty()
            .append(`<option value="">Select Your Times</option>`)


        $.ajax({
            url: `/user/times/${selectedRoom}`,
            type: "GET",
            success: (response) => {

                if (response.status) {
                    var items = response.data
                    items.forEach((item) => {
                        console.log(item)
                        $("#available_times").append(
                            `<option value="${item.id}">${item.name}</option>`)
                    })
                    console.log(response)

                }
            },
            error: () => {

            }
        });
    });

</script>
