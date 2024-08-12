<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crust - House | Tachyon - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('CSS/Owner/owner.css') }}">
    <link rel="icon" href="{{ asset('Images/Web_Images/chlogo.png') }}" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('styles')
</head>

<body>
    @php
        $owner_id = session('owner_id');
        $posLogo = false;
        if (session()->has('OwnerSettings')) {
            $OwnerSettings = session('OwnerSettings');
            $posLogo = $OwnerSettings->pos_logo;
        }
    @endphp
    @if (session('success'))
        <div id="success" class="alert alert-success">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('success').classList.add('alert-hide');
            }, 1500);

            setTimeout(() => {
                document.getElementById('success').style.display = 'none';
            }, 2000);
        </script>
    @endif

    @if (session('error'))
        <div id="error" class="alert alert-danger">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('error').classList.add('alert-hide');
            }, 1500);

            setTimeout(() => {
                document.getElementById('error').style.display = 'none';
            }, 2000);
        </script>
    @endif
    <header id="header">
        <div class="logo">
            <img src="{{ asset('Images/logo.png') }}" alt="Logo Here" onclick="window.loction.href='{{ route('dashboard', $owner_id) }}'" style="cursor: pointer;" >
        </div>

        <div class="profilepanel">
            <div class="profile">
                <div class="profilepic">
                    <img src="{{ asset('Images/Rectangle 3463281.png') }}" alt="Profile Picture">
                </div>
                <p class="profilename">Tachyon</p>
            </div>

            <a href="{{ route('logout') }}" class="logout">
                <i class='bx bx-log-out-circle' title="logout"></i>
            </a>
        </div>
    </header>
    <div class="container">
        <nav>
            <div class="menuItems" id="menu1">
                <i class='bx bxs-dashboard'></i>
                <a href="{{ route('dashboard', $owner_id) }}" onclick="setActiveMenu('menu1')"
                    style="text-decoration: none;">
                    <p class="link">Dashboard</p>
                </a>
            </div>
            {{-- <div class="menuItems" id="menu2">
                <i class='bx bx-package'></i>
                <a href="{{ route('branches', $owner_id) }}" onclick="setActiveMenu('menu2')"
                    style="text-decoration: none;">
                    <p class="link">My Branch</p>
                </a>
            </div> --}}
            {{-- <div class="menuItems" id="menu5">
                <i class='bx bxs-group'></i>
                <a href="{{ route('staff', $owner_id) }}" onclick="setActiveMenu('menu5')"
                    style="text-decoration: none;">
                    <p class="link">My Staff</p>
                </a>
            </div> --}}
            {{-- <div class="menuItems" id="menu7">
                <i class='bx bxs-report'></i>
                <a href="{{ route('showReports', $owner_id) }}" onclick="setActiveMenu('menu7')"
                    style="text-decoration: none;">
                    <p class="link">Reports</p>
                </a>
            </div>
            <div class="menuItems" id="menu8">
                <i class='bx bxs-cog'></i>
                <a href="{{ route('settings', $owner_id) }}" onclick="setActiveMenu('menu8')"
                    style="text-decoration: none;">
                    <p class="link">Settings</p>
                </a>
            </div> --}}

        </nav>
        <div class="rgtPnl">
            @yield('main')
        </div>
    </div>
    {{-- <script>
                function setActiveMenu(menuId) {
                    document.cookie = "activeMenu=" + menuId + "; path=/";
                    console.log("Set cookie: activeMenu=" + menuId);
                    document.querySelectorAll('.menuItems').forEach(item => {
                        item.classList.remove('active');
                    });
                    document.getElementById(menuId).classList.add('active');
                }

                document.addEventListener('DOMContentLoaded', (event) => {
                    const activeMenu = getActiveMenu();
                    console.log("Active menu from cookie: " + activeMenu);
                    if (activeMenu) {
                        document.querySelectorAll('.menuItems').forEach(item => {
                            item.classList.remove('active');
                        });
                        document.getElementById(activeMenu).classList.add('active');
                    }
                });

                function getActiveMenu() {
                    const value = `; ${document.cookie}`;
                    const parts = value.split(`; activeMenu=`);
                    if (parts.length === 2) {
                        const menu = parts.pop().split(';').shift();
                        console.log("Retrieved menu from cookie: " + menu);
                        return menu;
                    }
                    return null;
                }
            </script> --}}

    <script src="{{ asset('JavaScript/index.js') }}"></script>

</body>

</html>
