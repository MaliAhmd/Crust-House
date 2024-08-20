<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" href= "{{ asset('CSS/Owner/forgotpassword.css') }}">
    {{-- <link rel="shortcut icon" href="{{ asset('Images/favicon.ico')}}" type="image/x-icon"> --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="container">
        <div id="overlay"></div>
        <div id="forgotOverlay">

            <div id="form">
                <form action="{{ route('forgotPassword') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2>Forgot Password</h2>
                    <h5>We'll email you instructions on how to reset your password.</h5>

                    <div id="email-div">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="admin@gmail.com..."
                            style="background-image: url('{{ asset('Images/message.png') }}');">
                    </div>
                
                    @if (session('error'))
                        <div id="error"class="error-message">
                            {{ session('error') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                document.getElementById('error').classList.add('alert-hide');
                            }, 2000);

                            setTimeout(() => {
                                document.getElementById('error').style.display = 'none';
                            }, 3000);
                        </script>
                    @endif

                    <a href="{{ route('viewLoginPage') }}" id="backBtn">Return to login screen.</a>
                    <div id='fgt-btn'>
                        <button type="submit">Reset</button>
                    </div>
                </form>
            </div>
            <div id="image">
                <img src="{{ asset('Images/3293465.jpg') }}" alt="">
            </div>
        </div>
</body>

</html>
