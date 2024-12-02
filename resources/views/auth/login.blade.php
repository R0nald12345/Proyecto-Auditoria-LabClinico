<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <!-- Link al archivo css en public/css/ -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Inicio de Sesión</title>
</head>

<body>
    <!-- Contenido Principal -->
    <div class="container-fluid text-center">
        <div class="row main-content bg-success text-center">
            <div class="col-md-4 text-center company__info">
                <span class="company__logo">
                    <img src="{{ asset('vendor/adminlte/dist/img/LOGO_LAB.png') }}" alt="Logo de la empresa"
                        style="max-width: 100px;">
                </span>
                <h4 class="company_title">Analytics Lab</h4>
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container-fluid">
                    <div class="row">
                        <h2>Inicio de Sesión</h2>
                    </div>
                    <div class="row">
                        <form control="" class="form-group" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="input-group">
                                    <span class="fa fa-user" style="margin-right: 20px;"></span>
                                    <input type="email" name="email" id="email"
                                        class="form__input @error('email') is-invalid @enderror" placeholder="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="row">
                                <div class="input-group">
                                    <span class="fa fa-lock" style="margin-right: 20px;"></span>
                                    <input type="password" name="password" id="password"
                                        class="form__input @error('password') is-invalid @enderror"
                                        placeholder="Contraseña" required autocomplete="current-password">
                                    @error('password')
                                </div>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : ''
                                    }} class="">
                                <label for="remember">Recordar</label>
                            </div>
                            <div class="row">

                                <input type="submit" value="Ingresar" class="btn">

                                <a href="{{ route('register') }}" class="btn">Registrar</a>

                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
	<div class="container-fluid text-center footer" style="color: white; text-shadow: 1px 1px 2px black;">&copy; 2024 Analytics Lab. Todos los derechos reservados.</a></p>
	</div>
</body>

</html>
