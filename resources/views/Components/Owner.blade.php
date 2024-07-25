<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crust - House | Owner - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('CSS/Owner/owner.css') }}">
    <link rel="icon" href="{{ asset('Images/Web_Images/chlogo.png') }}" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('styles')
</head>

<body>
    <div class="container">
        <nav>
            <div class="logo">
                <img src="{{ asset('Images/image 1.png') }}" alt="Logo Here">
            </div>

            <div class="menuList">
                <i class='bx bx-menu' id="menuIcon" onclick="toggleMenu()"></i>
                <div class="menu" id="menu">
                    <div class="menuItems" id="menu1">
                        <i class='bx bxs-dashboard'></i>
                        <a href="{{ route('dashboard') }}" onclick="setActiveMenu('menu1')" style="text-decoration: none;">
                            <p class="link">Dashboard</p>
                        </a>
                    </div>
                    <div class="menuItems" id="menu2">
                        <i class='bx bx-package'></i>
                        <a href="{{ route('branches') }}" onclick="setActiveMenu('menu2')" style="text-decoration: none;">
                            <p class="link">My Branch</p>
                        </a>
                    </div>
                    <div class="menuItems" id="menu5">
                        <i class='bx bxs-group'></i>
                        <a href="{{ route('staff') }}" onclick="setActiveMenu('menu5')" style="text-decoration: none;">
                            <p class="link">My Staff</p>
                        </a>
                    </div>
                    <div class="menuItems" id="menu7">
                        <i class='bx bxs-report'></i>
                        <a href="{{ route('showReports') }}" onclick="setActiveMenu('menu7')" style="text-decoration: none;">
                            <p class="link">Reports</p>
                        </a>
                    </div>
                    <div class="menuItems" id="menu8">
                        <i class='bx bxs-cog'></i>
                        <a href="{{ route('settings') }}" onclick="setActiveMenu('menu8')" style="text-decoration: none;">
                            <p class="link">Settings</p>
                        </a>
                    </div>
                </div>
            </div>
            
            <script>
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
            </script>
            
        </nav>
        <div class="rgtpnl">
            <header id="header">
                <div class="searchbar">
                    <i class='bx bx-search'></i>
                    <input type="text" id="search" placeholder="Search">
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
                        <p class="profilename">{{ session('username') }}</p>
                    </div>

                    <div class="notification">
                        <i class='bx bx-bell'></i>
                    </div>

                    <a href="{{ route('logout') }}" class="logout">
                        <i class='bx bx-log-out-circle' title="logout"></i>
                    </a>

                    {{-- <div class="theme">
                        <i class='bx bx-moon' id="theme" onclick="toggleTheme()"></i>
                    </div> --}}
                </div>
            </header>

            @yield('main')

        </div>
    </div>
    <script src="{{ asset('JavaScript/index.js') }}"></script>

</body>

</html>
