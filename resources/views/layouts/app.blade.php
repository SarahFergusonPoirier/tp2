<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <!--Bootstrap CSS CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <link  href= "https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css"rel= "stylesheet">
</head>
<body>
    @php $locale = session()->get('locale') @endphp
    <nav class="navbar navbar-expand-lg bg-primary d-flex justify-content-between align-items-center mb-3 p-4">
        <!--<a href="\" class="link-light link-offset-2 link-underline-opacity-0 display-5">Home</a>-->
        @guest
            <div>
                @if($locale=='fr')
                    <a href="{{ route('lang', 'en') }}" class="link-light link-offset-2 link-underline-opacity-0 display-6">English</a>
                @else
                    <a href="{{ route('lang', 'fr') }}" class="link-light link-offset-2 link-underline-opacity-0 display-6">Français</a>
                @endif
            </div>
            <div>
                <a href="{{ route('login') }}" class="link-light link-offset-2 link-underline-opacity-0 display-6">@lang('lang.login')</a>
            </div>
        @else
            <div>
                <a href="{{ url('/') }}" class="link-light link-offset-2 link-underline-opacity-0 display-6 me-4">Forum</a>
                <a href="{{ url('/file') }}" class="link-light link-offset-2 link-underline-opacity-0 display-6 me-4">@lang('lang.files')</a>
                @can('see-users')
                    <a href="{{ url('/etudiant') }}" class="link-light link-offset-2 link-underline-opacity-0 display-6 me-4">@lang('lang.student')</a>
                @endcan
                <div class="vr display-6 me-4"></div>
                @if($locale=='fr')
                    <a href="{{ route('lang', 'en') }}" class="link-light link-offset-2 link-underline-opacity-0 display-6">English</a>
                @else
                    <a href="{{ route('lang', 'fr') }}" class="link-light link-offset-2 link-underline-opacity-0 display-6">Français</a>
                @endif
            </div>
            <a href="{{ url('/logout') }}" class="link-light link-offset-2 link-underline-opacity-0 display-6">{{ Auth::user()->name }} [@lang('lang.sign_out')]</a>
        @endguest

    </nav>
    @yield('content')
</body>
    <!--Bootstrap JS CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</html>