<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crust-House</title>
    <link rel="stylesheet" href="{{ asset('CSS/OnlineOrdering/layer.css') }}" class="css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
</head>
<script src="{{ asset('JavaScript/onlineOrdering.js') }}"></script>
<script>
    if (performance.navigation.type === 1) {
        window.location.href = "{{ route('onlineOrderPage') }}";
    }
</script>

<body>
    @php
        $Products = $Products;
        $Deals = $Deals;
        $Categories = $Categories;
        $count = $Categories->count();
        $AllProducts = $AllProducts;
    @endphp
    <div class="overlay" id="overlay"></div>
    <div class="frontmodel">
        <div class="maincontainer">
            <div class="mainp1">
                <span class="imgmain">
                    <img src="{{ asset('Images/OnlineOrdering/image-1.png') }}" alt="">
                </span>

                <span class="text1">Select your order type</span>
            </div>

            <div class="btndelivery">
                <button class="btndel">Delivery</button>
            </div>
            <div class="sub_items1">
                <span class="text1">Please Select your Location</span>
                <div class="btnlocation">
                    <button style="cursor: pointer;" id="useCurrentLocation" class="btnloc"><img class="crosshair"
                            src="{{ asset('Images/OnlineOrdering/crosshair.png') }}" alt="">Use Current
                        Location</button>
                </div>
            </div>
            <div class="fields">
                <div class="inputfields">
                    <input class="subin_fields" type="text" name="" id="district"
                        placeholder="Select City / Region ">
                    <input class="subin_fields" type="text" name="" id="address"
                        placeholder="Select Area / Sub Region">
                    <button class="btnn" onclick="SelectLocation()">Select</button>
                </div>
            </div>
            <div class="close-button">
                <button class="closebtn" onclick="closeFrontModel()">&times;</button>
            </div>
        </div>

    </div>
    <!-- end of frontmodel -->

    <!-- full page of website include nav footer and product cards -->
    <div class="whole">
        <div class="temp">
            <div class="popwhole">
                <div class="nav">
                    <div class="location">
                        <img class="locimg" src="{{ asset('Images/OnlineOrdering/locationpin.png') }}" alt="">
                        <div class="locelement">
                            <span class="ele1">Deliver to</span>
                            <span class="ele1" id="addr"></span>
                        </div>
                    </div>
                    <div class="mainimage">
                        <img class="imgelement" src="{{ asset('Images/OnlineOrdering/image-1.png') }}" alt="">
                    </div>
                    <div class="icons">
                        <hr>
                        <img class="locimgg" src="{{ asset('Images/OnlineOrdering/search.png') }}" alt="">
                        <hr>
                        <img id="profileImg" class="locimgg" src="{{ asset('Images/OnlineOrdering/profile.png') }}"
                            alt="">
                        <hr>
                        <img onclick="toggleCart()" id="locimgg" class="locimgg"
                            src="{{ asset('Images/OnlineOrdering/cart.png') }}" alt="">
                        <hr>
                    </div>
                </div>
                <div class="section">
                    @foreach ($Categories as $key => $Category)
                        <a href="#section{{ $key + 1 }}">
                            <button class="botn">{{ $Category->categoryName }}</button>
                        </a>
                    @endforeach
                    <a href="#section0">
                        <button class="botn">Deals</button>
                    </a>
                </div>
                <div class="root">
                    @foreach ($Categories as $key => $Category)
                        <div id="section{{ $key + 1 }}" class="content-section">
                            <h1>{{ $Category->categoryName }}</h1>
                            <div class="items">
                                @php
                                    $CategoryProducts = $Products->where('category_id', $Category->id);
                                    $displayedProductNames = [];
                                @endphp
                                @foreach ($CategoryProducts as $Product)
                                    @if (!in_array($Product->productName, $displayedProductNames))
                                        @php
                                            $displayedProductNames[] = $Product->productName;
                                        @endphp
                                        <div class="imgbox">
                                            <div class="imgstyle">
                                                <img class="cardimg"
                                                    src="{{ asset('Images/ProductImages/' . $Product->productImage) }}"
                                                    alt="Product">
                                            </div>
                                            <div class="infoo">
                                                <p class="product_name">{{ $Product->productName }}</p>
                                                <div class="space"></div>
                                                <div class="mini">
                                                    <div>
                                                        <p class="product_price">Rs. {{ $Product->productPrice }}</p>
                                                    </div>
                                                    <div class="btn">
                                                        <button
                                                            onclick="addToCart({{ json_encode($Product) }}, {{ json_encode($CategoryProducts) }})"
                                                            class="cartbtn">Add To Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div id="section0" class="content-section">
                        @php
                            $displayedDealTitles = [];
                        @endphp
                        <h1>Deals</h1>
                        <div class="items">
                            @foreach ($Deals as $Deal)
                                @if (!in_array($Deal->deal->dealTitle, $displayedDealTitles))
                                    @php
                                        $displayedDealTitles[] = $Deal->deal->dealTitle;
                                    @endphp
                                    @if ($Deal->deal->dealStatus != 'not active')
                                        <div class="imgbox">
                                            <div class="imgstyle">
                                                <img class="cardimg"
                                                    src="{{ asset('Images/DealImages/' . $Deal->deal->dealImage) }}"
                                                    alt="Deals">
                                            </div>
                                            <div class="infoo">
                                                <p class="product_name">{{ $Deal->deal->dealTitle }}</p>
                                                <div class="space"></div>
                                                <div class="mini">
                                                    <div>
                                                        <p class="product_price">Rs.
                                                            {{ $Deal->deal->dealDiscountedPrice }}</p>
                                                    </div>
                                                    <div class="btn">
                                                        <button {{-- onclick="addToCart({{ json_encode($Product) }}, {{ json_encode($CategoryProducts) }})" --}} class="cartbtn">Add To
                                                            Cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="gapp"></div>
                
                <div class="footer_main">
                    <div class="footer">
                        <div class="footer_hlf">
                            <div class="footergrid">
                                <div class="footer_1">
                                    <img class="imgg" src="{{ asset('Images/OnlineOrdering/image-1.png') }}"
                                        alt="Logo">
                                </div>
                                <div class="footergrid2">
                                    <div>
                                        <span class="cont_us">Contact Us:</span>
                                    </div>
                                    <div class="cu">
                                        <ul>
                                            <li><img class="contact"
                                                    src="{{ asset('Images/OnlineOrdering/phone.png') }}"
                                                    alt="">03090555415
                                            </li>
                                            <li><img class="contact"
                                                    src="{{ asset('Images/OnlineOrdering/email.png') }}"
                                                    alt="">support@crusthouse.com</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="foot_timing">
                                <div class="timingsetting">
                                    <span>Our Timing:</span>
                                </div>
                                <div class="time">
                                    <ul class="sub_time">
                                        <li class="fontt">Monday - Thursday</li>
                                        <li class="fontt">Friday</li>
                                        <li class="fontt">Saturday - Sunday</li>
                                    </ul>
                                    <ul class="sub_time">
                                        <li class="fontt">11:00 AM - 03:00 AM</li>
                                        <li class="fontt">02:00 PM - 03:00 AM</li>
                                        <li class="fontt">11:00 AM - 03:00 AM</li>
                                    </ul>
                                </div>
                                <div>
                                    <span class="timingsetting">Follow us:</span>
                                </div>
                                <div class="follow">

                                    <div class="followico">
                                        <a href=""><img class="iconsize"
                                                src="{{ asset('/Images/OnlineOrdering/facebook.png') }}"
                                                alt=""></a>
                                        <a href=""><img class="iconsize"
                                                src="{{ asset('/Images/OnlineOrdering/instagram.png') }}"
                                                alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="footer_hlf1">
                            <div class="ele_hlf1">
                                <span class="ele_hlf2">© 2024 Powered by:
                                    <a href="https://tachyontechs.com/" target="_blank"><img class="logo"
                                            src="{{ asset('Images/OnlineOrdering/logo.png') }}" alt=""></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- end of main page -->

    <!-- openpop -->
    <div class="openitems" id="popup" style="display: none; ">
        <div class="cbtn" id="closeButton" style="display: none;">
            <button class="clobtn" onclick="closeAddToCart()">
                &times;
            </button>
        </div>
        <div class="itemss" id="itemss">
            <div class="hlfcontainer">
                <div class="mini_halfcontainer">
                    <div class="mini_items">
                        <span class="img_item">
                            <img class="popup-img" id="popup-img" src="" alt="Product Image">
                        </span>
                    </div>
                    <div class="textshow">
                        <span class="popup_title" id="popup-title"></span>
                        <span class="popup_price" id="popup-price"></span>
                    </div>
                </div>
                <div class="extra_items">
                    <div class="extra_1">
                        <div class="extra_4" onclick="toggleDropdown()">
                            <div class="extra_5">
                                <div class="extra_6">
                                    <span class="size">Variation</span>
                                    <span class="required">Required</span>
                                </div>
                                <div class="arrow" onclick="toggleDropdown()">
                                    <img class="up" src="{{ asset('Images/OnlineOrdering/up.png') }}"
                                        alt="">
                                    <img class="down" src="{{ asset('Images/OnlineOrdering/down.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                        <div id="dropdown-content" class="dropdown-content">
                            <div class="dropdown_1">
                                <div>
                                    <div class="drop">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="bottom">
                        <div class="bottom_1">
                            <button onclick="decreaseQuantity()" class="bottom_2" id="decrease">
                                -
                            </button>
                            <span class="count" id="quantity">1</span>

                            <button onclick="increaseQuantity()" class="bottom_2" id="increase">
                                +
                            </button>

                        </div>
                        <button class="addcart" onclick="handleCartButtonClick() ">
                            <div>
                                <span id="originalprice" style="display: none;"></span>
                                <span id="cart-price"></span>
                            </div>
                            <div>Add to Cart</div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of popup product -->


    <!-- login component -->
    <div id="logincomponent" class="logincomponent">
        <div class="popup-content">
            <div class="textt">
                <span class="details">Enter your mobile number</span>
            </div>
            <div class="phone-input">
                <span class="select">Please enter email and confirm your country code and enter your mobile
                    number</span>
                <div class="lo_email">
                    <input class="l_input" type="email" id="email" placeholder="Enter your email">
                </div>
            </div>
            <div class="code">
                <input id="countryCode" type="tel">
                <input id="phoneNumber" type="tel" placeholder="Enter phone number">
            </div>
            <div class="privacy">This site is protected by reCAPTCHA and the Google
                <a href="https://policies.google.com/privacy">Privacy Policy</a>
                and
                <a href="https://policies.google.com/terms">Terms of Service</a>
                apply.
            </div>


            <div class="loginbtn">
                <button class="lobtn">Login</button>
                <div class="orline">
                    <span class="or">OR</span>
                </div>
                <button class="signbtn">Sign-up</button>
            </div>
        </div>

        <span class="close">&times;</span>
        <!-- <p>This is the profile popup content!</p> -->
    </div>


    <!-- end of login -->
    <!-- signup page -->
    <div id="signupcomponent" class="signupcomponent">
        <div class="main">
            <div class="regtext">
                <h2 class="r_text">Register</h2>
            </div>
            <div class="userinfo">
                <div class="fields">
                    <div class="name">
                        <label class="s_label">Enter Name</label>
                        <div class="gap">
                            <input class="s_input" type="text" id="name" placeholder="Enter your name">
                        </div>
                    </div>
                    <div class="email">
                        <label class="s_label">Enter Email</label>
                        <div class="gap">
                            <input class="s_input" type="email" id="email" placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="gend-dob">
                        <div class="main-GenDob">
                            <div class="row1">
                                <label class="s_label" for="gender">Gender</label>
                                <select name="" id="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="row2">
                                <label class="s_label">Date of Birth</label>
                                <div>
                                    <input type="date" id="dob" placeholder="dd-mm-yyyy">
                                </div>
                                <script>
                                    const today = new Date();
                                    today.setDate(today.getDate() - 1);
                                    const previousDay = today.toISOString().split('T')[0];
                                    document.getElementById('dob').setAttribute('max', previousDay);
                                </script>
                            </div>
                        </div>
                    </div>
                    <div id="mobileno" class="mobileno">
                        <label class="s_label">Mobile Number</label>
                        <div class="codee">
                            <input id="countryCodee" type="tel">
                            <input id="phoneNumberr" type="tel" placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="registerbtn">
                        <button class="regbtn">Register</button>
                    </div>
                    <div class="alreadyacc">
                        <a class="alraccount">Already have an account?</a>
                    </div>

                </div>
            </div>
        </div>
        <span class="closee">&times;</span>
    </div>


    <!-- end of signup -->

    <!-- cart div -->
    <div id="cart" class="cart">
        <div class="cart_part1">
            <div class="cartname">
                <span class="cart_text">Your Cart</span>
                <span class="cart_clear"><a class="cart_textt">Clear Cart</a></span>

            </div>

            <div class="cartitems">

            </div>
            <div class="total" style="display: none;">
                <div class="main_total">
                    <div class="subtotal">
                        <span>Subtotal</span>
                        <span>Rs 0.00</span>
                    </div>
                    <div class="delichrge">
                        <span>Delivery Charges</span>
                        <span>Rs 0.00</span>
                    </div>
                    <div class="grandtotal">
                        <span>Garnd Total</span>
                        <span>Rs 0.00</span>
                    </div>
                    <button class="checkoutbtn">Checkout</button>
                </div>

            </div>

        </div>
        <div class="clear" style="display: none;">
            <!-- code of clear cart -->
            <div class="clear_Cart_itens">
                <span>Are you sure?</span>
                <div class="clear_cart">
                    <button class="cancel">cancel</button>
                    <button class="clearbtn">Clear Cart</button>
                </div>
            </div>

        </div>
        <div class="emptycart">
            <span><img src="{{ asset('Images/OnlineOrdering/cart-empty.png') }}" alt=""></span>
            <span style="color: rgb(131, 143, 155);">Your Cart is Empty</span>
        </div>
    </div>
    <div class="msg">
        <div class="msg1">
            <div class="msg_img">
                <img src="{{ asset('Images/OnlineOrdering/addedcart.png') }}" alt="">
            </div>
            <div class="msg_text">
                <span>Item Added to Cart</span>
            </div>
        </div>
    </div>

    <!-- end of cart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="{{ asset('JavaScript/frontend.js') }}"></script>
    <script src="{{ asset('JavaScript/location.js') }}"></script>
    <script src="{{ asset('JavaScript/phone.js') }}"></script>
    <script src="{{ asset('JavaScript/final.js') }}"></script>


</body>

</html>
