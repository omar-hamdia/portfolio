<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>نبذة عني</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero section dark-background">
        <img src="{{ asset('assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

        <div class="container" data-aos="fade-up">
            <h2>مرحباً بك في موقعي الشخصي</h2>
            <p>أنا مطور مواقع وخبير أمن معلومات.</p>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>نبذة عني</h2>
            </div>

            @if($about)
                <div class="row gy-4">

                    <div class="col-lg-4">
                        <img src="{{ asset('storage/' . $about->image) }}" class="img-fluid rounded" alt="">
                    </div>

                    <div class="col-lg-8 content">
                        <h3>About me</h3>
                        <p class="fst-italic">
                            {{ $about->content }}
                        </p>
                    </div>

                </div>
            @else
                <div class="alert alert-warning text-center">لا يوجد بيانات حالياً</div>
            @endif

        </div>
    </section>
    <!-- End About Section -->

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
