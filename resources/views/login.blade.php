<!doctype html>
<html lang="en">
<head>
    <title>Login Siakad IKT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('login/css/style.css')}}">

</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
{{--                <h2 class="heading-section">Selamat Datang</h2>--}}
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="wrap">
                    <div class="img" style="background-image: url({{asset('login/images/ikt2.png')}}); background-size: contain; /* Fit gambar sesuai ukuran */background-position: center; /* Pusatkan gambar */background-repeat: no-repeat; /* Hindari pengulangan gambar */height: 200px; /* Tinggi elemen gambar, sesuaikan sesuai kebutuhan */width: 100%; /* Lebar penuh */margin: 0 auto; /* Pusatkan div jika perlu */"></div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Selamat datang silahkan login !</h3>
                            </div>
                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
                                </p>
                            </div>
                        </div>
                        <form id="loginForm"  class="signin-form">
                            @csrf
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" id ="user_id" name="user_id" required>
                                <label class="form-control-placeholder" for="username">NIDN/NIDK/NIM</label>
                            </div>
                            <div class="form-group">
                                <input id="password" name="password" type="password" class="form-control" required>
                                <label class="form-control-placeholder" for="password">Kata Sandi</label>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50 text-left">
{{--                                    <label class="checkbox-wrap checkbox-primary mb-0">Remember Me--}}
{{--                                        <input type="checkbox" checked>--}}
{{--                                        <span class="checkmark"></span>--}}
{{--                                    </label>--}}
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#">Lupa Kata Sandi</a>
                                </div>
                            </div>
                        </form>
{{--                        <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{asset('login/js/jquery.min.js')}}"></script>
<script src="{{asset('login/js/popper.js')}}"></script>
<script src="{{asset('/login/js/bootstrap.min.js')}}"></script>
<script src="{{asset('login/js/main.js')}}"></script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function () {
        $('#loginForm').on('submit', function (e) {
            e.preventDefault(); // Mencegah refresh form

            let formData = {
                user_id: $('#user_id').val(),
                password: $('#password').val(),
                _token: '{{ csrf_token() }}'
            };

            //console.log('Form data:', formData); // Debug input data

            $.ajax({
                url: '{{ url("/login-user") }}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    //console.log('Response:', response); // Debug response
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        }).then(() => {
                            window.location.href = '/dashboard'; // Halaman tujuan setelah login
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message
                        });
                    }
                },
                error: function (xhr, status, error) {
                    //console.error('Error:', xhr.responseText); // Debug error dari server
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Silakan coba lagi.'
                    });
                }
            });
        });
    });


</script>


</body>
</html>

