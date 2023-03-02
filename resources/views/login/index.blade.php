<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <section class="vh-100" style="background-color: #5d3891b1;">
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-md-9 position-absolute z-2 top-50 start-50 translate-middle">
                <div class="row border border-0 rounded" style="height: 82vh">
                        <div class="col-md-7 d-flex align-items-end justify-content-center" style="background-color: #5D3891">
                            <img src="mahasiswa.png" alt="" width="350px" height="350px">
                        </div>
                        <div class="col-md-5 bg-white">
                            <form action="{{ route('postLogin') }}" method="POST">
                                <div class="pt-4 pb-4">
                                    <h4 class="text-center fw-bold-light">UnivesityAllStar</h4>
                                </div>
                                <p class="fw-light mb-3 pb-3 text-center" style="letter-spacing: 1px;">
                                    Sign To Your Account
                                </p>
                                <div class="form-outline mb-3">
                                    <label class="form-label fw-light" for="form2Example17">Email address</label>
                                    <input type="email" id="form2Example17" name="email" class="form-control @error('email') is-invalid @enderror"/>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-outline mb-3">
                                    <label class="form-label fw-light" for="form2Example27">Password</label>
                                    <input type="password" id="form2Example27" name="password" class="form-control @error('password') is-invalid @enderror"/>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="pt-1 mb-4">
                                    <button class="btn text-white" style="background-color: #5D3891" type="submit">Login</button>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                {{-- <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                        href="{{ route('register') }}" style="color: #393f81;">Register here</a></p> --}}
                            </form>
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>
</html>
