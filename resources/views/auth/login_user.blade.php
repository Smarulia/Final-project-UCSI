<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("auth/img/favicon.png")}}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset("auth/css/preloader.css")}}">
    <link rel="stylesheet" href="{{asset("auth/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("auth/css/meanmenu.css")}}">
    <link rel="stylesheet" href="{{asset("auth/css/animate.min.css")}}">
    <link rel="stylesheet" href="{{asset("auth/css/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset("auth/css/swiper-bundle.css")}}">
    <link rel="stylesheet" href="{{asset("auth/css/backToTop.css")}}">
    <link rel="stylesheet" href="{{asset("auth/css/jquery.fancybox.min.css")}}">
    <link rel="stylesheet" href="{{asset("auth/css/fontAwesome5Pro.css")}}">
    <link rel="stylesheet" href="{{asset("auth/css/elegantFont.css")}}">
    <link rel="stylesheet" href="{{asset("auth/css/default.css")}}">
    <link rel="stylesheet" href="{{asset("auth/css/style.css")}}">
</head>

<body>
    <!-- pre loader area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two" style="left:20px;"></div>
                <div class="object" id="object_three" style="left:40px;"></div>
                <div class="object" id="object_four" style="left:60px;"></div>
                <div class="object" id="object_five" style="left:80px;"></div>
            </div>
        </div>
    </div>
    <!-- pre loader area end -->

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->

    <div class="body-overlay"></div>
    <!-- sidebar area end -->

    <main>
        <!-- sign up area start -->
        <section class="signup__area po-rel-z1 pt-100 pb-145">
            <div class="sign__shape">
                <img class="man-1" src="{{asset("auth/img/icon/sign/man-1.png")}}" alt="">
                <img class="man-2" src="{{asset("auth/img/icon/sign/man-2.png")}}" alt="">
                <img class="circle" src="{{asset("auth/img/icon/sign/circle.png")}}" alt="">
                <img class="zigzag" src="{{asset("auth/img/icon/sign/zigzag.png")}}" alt="">
                <img class="dot" src="{{asset("auth/img/icon/sign/dot.png")}}" alt="">
                <img class="bg" src="{{asset("auth/img/icon/sign/sign-up.png")}}" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                        <div class="section__title-wrapper text-center mb-20">
                            <h2 class="section__title">Please Login </h2>
                            <p>Kindly Login to go through to dashboard</p>
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
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="sign__wrapper white-bg">
                            <div class="sign__form">
                                <form action="{{route("user.post.login")}}" method="POST">
                                    @csrf
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>ID Number</h5>
                                        <div class="sign__input">
                                            <input type="number" placeholder="Your ID number" name="id_student">
                                            <i class="fal fa-envelope"></i>
                                        </div>
                                    </div>
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>Password</h5>
                                        <div class="sign__input">
                                            <input type="password" placeholder="Your Password" name="password">
                                            <i class="fal fa-lock"></i>
                                        </div>
                                    </div>
                                    <button class="e-btn  w-100"> <span></span>Login</button>
                                </form>
                                <p>
                                    Do not have an account?
                                </p>
                                <p>
                                    <a href="{{route("user.register")}}">Sign Up as Student</a>
                                </p>
                                <p>
                                    <a href="{{route("lucture.register")}}">Sign Up as Lecture</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- sign up area end -->

    </main>
    <!-- JS here -->
    <script src="{{asset("auth/js/vendor/jquery-3.5.1.min.js")}}"></script>
    <script src="{{asset("auth/js/vendor/waypoints.min.js")}}"></script>
    <script src="{{asset("auth/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("auth/js/jquery.meanmenu.js")}}"></script>
    <script src="{{asset("auth/js/swiper-bundle.min.js")}}"></script>
    <script src="{{asset("auth/js/owl.carousel.min.js")}}"></script>
    <script src="{{asset("auth/js/jquery.fancybox.min.js")}}"></script>
    <script src="{{asset("auth/js/isotope.pkgd.min.js")}}"></script>
    <script src="{{asset("auth/js/parallax.min.js")}}"></script>
    <script src="{{asset("auth/js/backToTop.js")}}"></script>
    <script src="{{asset("auth/js/jquery.counterup.min.js")}}"></script>
    <script src="{{asset("auth/js/ajax-form.js")}}"></script>
    <script src="{{asset("auth/js/wow.min.js")}}"></script>
    <script src="{{asset("auth/js/imagesloaded.pkgd.min.js")}}"></script>
    <script src="{{asset("auth/js/main.js")}}"></script>
</body>

</html>
