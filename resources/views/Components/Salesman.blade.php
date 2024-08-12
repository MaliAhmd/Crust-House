<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crust - House | Salesman - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('CSS/Salesman/salesman.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="{{ asset('Images/Web_Images/chlogo.png') }}" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('styles')
</head>

<body>
    @php
        $posLogo = false;
        if (session()->has('OwnerSettings')) {
            $OwnerSettings = session('OwnerSettings');
            $posLogo = $OwnerSettings->pos_logo;
        }
    @endphp
    <div class="container">
        <header id="header">
            <div class="logo">
                @if ($posLogo)
                    <img src="{{ asset('Images/Logos/' . $posLogo) }}" alt="Logo Here">
                @else
                    <img src="{{ asset('Images/image-1.png') }}" alt="Logo Here">
                @endif
            </div>
            <div id="centerDiv">
                <button id="dineIn-btn" type="button" onclick="showDineInOrders()">Dine-In Orders</button>
                <div class="search_bar_div">
                    <input type="text" id="search_bar" name="search" placeholder="Search.."
                        style="background-image: url('{{ asset('Images/search.png') }}');">
                </div>
                <button id="online-btn" type="button" onclick="showOnlineOrders()">Online Orders</button>
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
                    <a href="{{ route('logout') }}"><i class='bx bx-log-out' onclick="logout()"></i></a>
                </div>

                {{-- <div class="theme">
                    <i class='bx bx-moon' id="theme" onclick="toggleTheme()"></i>
                </div> --}}
            </div>
        </header>

        @yield('main')

    </div>
    <script>
        function logout() {
            document.cookie = "selected_category=; path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT";
            window.location.href = "{{ route('logout') }}";
        }
    </script>
    <script src="{{ asset('JavaScript/index.js') }}"></script>
    @stack('scripts')

</body>

</html>
