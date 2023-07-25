@include('user.partials._header')
<div class="card shadow mb-4">
@if(session('error'))
                            <div class="alert alert-danger">
                                <ul>
                                    {{ session('error') }}
                                </ul>
                            </div>
                            @endif

                            @if(session('success'))
                            <div class="alert alert-success">
                                <ul>
                                    {{ session('success') }}
                                </ul>
                            </div>
                            @endif
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Booking PAL </h6>
    </div>
    <div class="card-body">
        <form action="{{route("user.post.change.password")}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Old Password</label>
                <input type="password" name="old_password" class="form-control" id="oldpassword">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-control" id="newpassword">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Repeat Password</label>
                <input type="password"name="repeat_password" class="form-control" id="reapeat">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@include('user.partials.footer')
