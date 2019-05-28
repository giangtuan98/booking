<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous"> --}}
    <!-- Optional theme -->
     {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
    crossorigin="anonymous"> --}}
    
    {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href=" {{asset('public/source/Content/themes/startravel/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="{{asset('public/css/admin_style.css')}}">
    <title>Login</title>
</head>
<body class="login">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="post" action="{{route('login')}}" id="login_admin">

                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <h1>Login Form</h1>
                        <div>
                            <input type="email" class="form-control" name="email" placeholder="Username" required="" />
                        </div>
                        <p></p>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                        </div>
                        @if(count($errors) > 0)
                            <ul class="alert-warning alert">
                                @foreach($errors->all() as $error)
                                <li >! {{$error}}</li>
                                @endforeach
                            </ul>
                        @else
                            @if(Session::has('warn'))
                                <li class="alert-warning">! {{Session::get('warn')}}</li>
                            @endif
                        @endif
                        <div style="text-align:center;">
                            <button class="btn btn-default submit">Log in</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
<script>
</script>
</html>