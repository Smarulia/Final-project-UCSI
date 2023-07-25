<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation website (Home)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .center-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        body{
            background-image: url('/gambar/welcome.jpg');
            background-size: cover;
        }
        .bg-putih{
            color: white;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
            <div class="col-md-12">
                <div class="row">
                <div class="col-md-6 center-content text-center ">
                    <div class="bg-putih">
                        <h1 class="fw-bold">
                            Reservation 
                        </h1>
                        <h2 class="fw-bold">
                            P.A.L  and Discussion Room UCSI University
                        </h2>
    
                        <p>
                            Discussion Room UCSI University located at block B level 2
                        </p>
    
                        <p>P.A.L is Peer-assisted learning that will help a student to enhance their academic by the chosen student who got permission to assist.</p>
                    </div>
                    
                </div>
                <div class="col-md-6 center-content bg-putih">
                    <div class="mb-4">
                        <a href="{{ route("user.login") }}" class="btn btn-lg btn-primary">Login as Lecturer</a>
                    </div>

                    <div class="mb-4">
                        <a href="{{ route("admin.login") }}" class="btn btn-lg btn-primary">Login as Admin</a>
                    </div>

                    <div class="mb-4">
                        <a href="{{ route("user.login") }}" class="btn btn-lg btn-primary">Login as Student</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
