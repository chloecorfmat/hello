<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#4b3f72">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hello Toeic') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="app">
        <header class="header">
            <div class="header--part header--logo">
                <a href="{{ route('profile') }}">
                    <img src="/svg/hello-toeic-small.svg" alt="">
                    {{ config('app.name', 'Hello Toeic') }}
                </a>
            </div>
            <div class="header--part">
                <ul class="header--actions-list">
                @guest
                    <li class="header--actions-list-item">
                        <a href="{{ route('login') }}">
                            <span>{{ __('Login') }}</span>
                        </a>
                    </li>
                @else
                    <li class="header--actions-list-item">
                        <a href="{{ route('profile') }}">
                            <span class="name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                            <i class="user-ico fas fa-user-circle fa-lg"></i>
                        </a>
                    </li>
                    <li class="header--actions-list-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="header--logout-btn" type="submit" title="{{ __('Logout') }}">
                                <i class="fas fa-power-off fa-lg"></i>
                            </button>
                        </form>
                    </li>
                @endguest
                </ul>
            </div>
        </header>
        <main
            @if (isset($class_main) && !empty($class_main))
                class="{{ $class_main }}"
            @endif
        >
            <div class="container">
                @auth
                    <div class="laterale-bar">
                        <a class="profile" href="{{ route('profile') }}">
                            <i class="user-ico fas fa-user-circle fa-4x"></i>
                        </a>
                        <h2>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>

                        @yield('laterale-bar-content-begin')

                        @role('student')
                        <div class="laterale-bar--part">
                            <!--<a href="{{ route('train') }}" class="btn">S'entraîner</a>-->

                            <ul>
                                <li>
                                    <a class="btn btn-training" href="{{ route('student.tests.index') }}">
                                        <i class="fas fa-graduation-cap"></i> Tests complets
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-training" href="{{ route('tests.exercises') }}">
                                        <i class="fas fa-question"></i> Exercises
                                    </a>
                                </li>
                                <li>
                                    <a class="btn btn-training" href="{{ route('games') }}">
                                        <i class="fas fa-medal"></i> Challenges
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @endrole

                        @role('teacher')
                        <div class="laterale-bar--part laterale-bar--menu">
                            <h3>Menu</h3>
                            <ul class="laterale-bar--menu-list">
                                <li class="laterale-bar--menu-item">
                                    <a href="{{ route('documents.index') }}">
                                        <i class="menu-ico far fa-images"></i>
                                        Liste des documents
                                    </a>
                                </li>

                                <li class="laterale-bar--menu-item">
                                    <a href="{{ route('questions.index') }}">
                                        <i class="menu-ico fas fa-question"></i>
                                        Liste des questions
                                    </a>
                                </li>

                                <li class="laterale-bar--menu-item">
                                    <a href="{{ route('tests.index') }}">
                                        <i class="menu-ico fas fa-list"></i>
                                        Liste des tests
                                    </a>
                                </li>

                                <li class="laterale-bar--menu-item">
                                    <a href="{{ route('games') }}">
                                        <i class="menu-ico fas fa-trophy"></i>
                                        Liste des challenges
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @endrole

                        @role('admin')
                        <div class="laterale-bar--part laterale-bar--menu">
                            <h3>Administration</h3>
                            <ul class="laterale-bar--menu-list">
                                <li class="laterale-bar--menu-item">
                                    <a href="{{ route('permissions.index') }}">
                                        <i class="menu-ico fas fa-key"></i>
                                        Permissions
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @endrole

                        @if(isset($datasources) && !empty($datasources))
                            <div class="player" id="player">
                                <audio src="{{ $source }}" type="audio" data-sources="{{ $datasources }}"></audio>
                                <div class="controls">
                                    <button class="btn-play" id="play">
                                        <i class="fas fa-play fa-2x"></i>
                                    </button>
                                </div>
                                <p id="timer">0</p>
                            </div>
                        @endif
                    </div>
                @endauth
                @yield('content')
            </div>
        </main>

        <div class="body-border"></div>
    </div>

    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment-duration-format/2.2.2/moment-duration-format.min.js"></script>
    <script>
        @if(isset($listening_duration) && $listening_duration != 0)
            const DURATION_LISTENING = {{ $listening_duration }};
        @else
            const DURATION_LISTENING = 0;
        @endif
    </script>
    <script src="{{ asset('js/all.js') }}" defer></script>
</body>
</html>
