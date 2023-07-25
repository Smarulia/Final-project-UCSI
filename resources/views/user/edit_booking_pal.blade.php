@include('user.partials._header')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Booking P.A.L </h6>
    </div>
    <div class="card-body">
        <form action="{{route("user.post.edit.booking.pal",$pal_request)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly required>
            </div>

            <div class="form-group">
                <label for="jurusan_pal-type">Course Name and Code</label>
                <select class="form-control" id="major" name="major_id" required>
                    <option value="">Select Your Course </option>
                    @foreach ($majors as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pal-type">P.A.L</label>
                <select class="form-control" id="pal" name="pal_id" required>
                    <option value="">Select Your P.A.L</option>
                    @foreach ($pals as $item)
                    <option value="{{$item->id}}">{{$item->nama_pal}}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{route("user.pal")}}" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</div>
@include('user.partials.footer')

<script>
    $('#major').change(() => {
        var majorId = $('#major').val()
        $("#pal").empty()
            .append(`<option value="">Select Your PAL</option>`)


        $.ajax({
            url: `/user/pal/major?id=${majorId}`,
            type: "GET",
            success: (response) => {

                if (response.status) {
                    var items = response.data
                    items.forEach((item) => {
                        console.log(item)
                        $("#pal").append(
                            `<option value="${item.id}">${item.nama_pal}</option>`)
                    })

                }
            },
            error: () => {

            }
        });
    });

</script>
