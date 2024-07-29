<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crust - House | Chef - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('CSS/Chef/chef.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="{{ asset('Images/Web_Images/chlogo.png') }}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('styles')
</head>

<body>
    @php
        $settings = session('OwnerSettings');
        if(session()->has('OwnerSettings')){
        $OwnerSettings = session('OwnerSettings');
        $posLogo = $OwnerSettings->pos_logo;
    }$posLogo = false;
    @endphp
    <div class="containers">
        <header id="header">
            <div class="logo">
                @if ($posLogo)
                    <img src="{{ asset('Images/Logos/' . $posLogo) }}" alt="Logo Here">
                @else
                    <img src="{{ asset('Images/image-1.png') }}" alt="Logo Here">
                @endif
            </div>

            <div class="profilepanel">
                <div class="profile">
                    <div class="profilepic">
                        @if (session('profile_pic'))
                            <img src="{{ asset('Images/UsersImages/' . session('profile_pic')) }}"
                                alt="Profile Picture">
                        @else
                            <img src="{{ asset('Images/Rectangle 3463281.png') }}" alt="Profile Picture">
                        @endif
                    </div>

                    @if (session('username'))
                        <p class="profilename">{{ session('username') }}</p>
                    @endif
                </div>

                {{-- <div class="notification">
                    <i class='bx bx-bell'></i>
                </div> --}}

                <div class="logout">
                    <a href="{{ route('logout') }}"><i class='bx bx-log-out'></i></a>
                </div>

            </div>
        </header>

        @yield('main')

    </div>

    <script src="{{ asset('JavaScript/index.js') }}"></script>
    @stack('scripts')

</body>

</html>
