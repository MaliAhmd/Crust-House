@extends('Components.Salesman')

@push('styles')
    <link rel="stylesheet" href="{{ asset('CSS/Salesman/dashboard.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('JavaScript/Salesman1.js') }}"></script>
@endpush

@section('main')

    {{-- PDF Download Code --}}
    @if (session('pdf_filename'))
        <input type="hidden" value="{{ session('pdf_filename') }}" id="pdf_link">
        <a id="orderRecipt" href="{{ asset('PDF/' . session('pdf_filename')) }}" download>Download PDF</a>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let pdfLink = document.getElementById('orderRecipt');
                pdfLink.style.display = 'none';
                pdfLink.click();
                let file_name = document.getElementById('pdf_link').value;
                route = "{{ route('deleteReceiptPDF', '_file_name') }}";
                route = route.replace('_file_name', file_name);
                window.location.href = route;
            });
        </script>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <input id="orderNo" type="hidden" value="1">
    <main id="salesman">
        @php
            $allProducts = $AllProducts;
            $id = $id;
            $branch_id = $branch_id;
            $cartProducts = $cartProducts;
            $totalbill = 0;
            $taxes = $taxes;
            $discounts = $discounts;
            $maximum_discount_percentage_value = $branch_data->max_discount_percentage;
            $orderTypeArray = [];
            $discountTypeArray = [];
            foreach ($payment_methods as $value) {
                if ($value->order_type != null) {
                    $orderTypeArray[] = $value->order_type;
                } elseif ($value->discount_type != null) {
                    $discountTypeArray[] = $value->discount_type;
                }
            }
        @endphp

        <div id="productsSide">
            <div id="category_bar">
                <div onclick="selectCategory('{{ route('salesman_dashboard', [$id, $branch_id]) }}', this)">
                    <a id="all_category" class="category_link">All</a>
                </div>
                @foreach ($Categories as $category)
                    <div onclick="selectCategory('{{ route('salesman_dash', [$category->categoryName, $id, $branch_id]) }}', this)">
                        <a class="category_link">{{ $category->categoryName }}</a>
                    </div>
                @endforeach
                <div onclick="selectCategory('{{ route('salesman_dash', ['Deals', $id, $branch_id]) }}', this)">
                    <a class="category_link">Deals</a>
                </div>
            </div>


            <div id="products">
                @php
                    $displayedProductNames = [];
                    $displayedDealTitles = [];
                @endphp

                @if ($Products !== null)
                    @foreach ($Products as $product)
                        @if (!in_array($product->productName, $displayedProductNames))
                            @php
                                $displayedProductNames[] = $product->productName;
                            @endphp

                            <div id="imageBox" class="imgbox"
                                onclick="showAddToCart({{ json_encode($product) }} ,null, {{ json_encode($allProducts) }})">
                                <img src="{{ asset('Images/ProductImages/' . $product->productImage) }}" alt="Product">
                                <p class="product_name">{{ $product->productName }}</p>
                                {{-- <p class="product_price">From Rs. {{ $product->productPrice }}</p> --}}
                            </div>
                        @endif
                    @endforeach
                @elseif ($Deals !== null)
                    @foreach ($Deals as $deal)
                        @if (!in_array($deal->deal->dealTitle, $displayedDealTitles))
                            @php
                                $displayedDealTitles[] = $deal->deal->dealTitle;
                            @endphp
                            @if ($deal->deal->dealStatus != 'not active')
                                <div id='imageBox' class="imgbox"
                                    onclick="showAddToCart({{ json_encode($deal) }}, {{ json_encode($Deals) }}, {{ json_encode($allProducts) }})">
                                    <img src="{{ asset('Images/DealImages/' . $deal->deal->dealImage) }}" alt="Product">
                                    <p class="product_name">{{ $deal->deal->dealTitle }}</p>
                                    {{-- <p class="product_price">{{ $deal->deal->dealDiscountedPrice }}</p> --}}
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endif

            </div>

            <div id="deals_seperate_section">
                <h3 id="deals_seperate_section_heading">Deals</h3>
                <div id="deals_seperate_section_imgDiv">
                    @if ($Deals !== null)
                        @foreach ($Deals as $deal)
                            @if ($deal->deal !== null && !in_array($deal->deal->dealTitle, $displayedDealTitles))
                                @php
                                    $displayedDealTitles[] = $deal->deal->dealTitle;
                                @endphp
                                @if ($deal->deal->dealStatus != 'not active')
                                    <div class="deal_imgbox"
                                        onclick="showAddToCart({{ json_encode($deal) }}, {{ json_encode($Deals) }}, {{ json_encode($allProducts) }})">
                                        <img src="{{ asset('Images/DealImages/' . $deal->deal->dealImage) }}"
                                            alt="Product">
                                        <p class="product_name">{{ $deal->deal->dealTitle }}</p>
                                        {{-- <p class="product_price">{{ $deal->deal->dealDiscountedPrice }}</p> --}}
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @else
                        <p class="product_name">No Deal Found</p>
                    @endif
                </div>
            </div>
        </div>

        <div id="receipt">
            <h4 id="heading">Receipt</h4>
            <div id="cart">

                <input type="hidden" name="salesman_id" id="salesman_id" value={{ $id }}>
                <div id="selectedProducts" name="products">
                    @foreach ($cartProducts as $Value)
                        @php
                            $priceString = $Value->totalPrice;
                            preg_match('/\d+(\.\d+)?/', $priceString, $matches);
                            $numericPart = $matches[0];
                            $totalbill = $totalbill + $numericPart;
                        @endphp
                        <div id="productdiv">
                            <div class="product_name">
                                @if ($Value->productAddon && strpos($Value->productName, $Value->productAddon) === false)
                                    <p style="margin: 0; max-width:80%;" id="product-name">
                                        {{ $Value->productName . ' with ' . $Value->productAddon }}</p>
                                    <span id="product_price{{ $Value->id }}">{{ $Value->totalPrice }}</span>
                                @else
                                    <p style="margin: 0; max-width:80%;" id="product-name">{{ $Value->productName }}</p>
                                    <span id="product_price{{ $Value->id }}">{{ $Value->totalPrice }}</span>
                                @endif
                            </div>
                            <div class="product-controls">
                                <button
                                    onclick="window.location='{{ route('removeOneProduct', [$Value->id, $Value->salesman_id, $branch_id]) }}'"
                                    id="remove-product"><i class='bx bxs-trash'></i></button>
                                <div class="quantity-control">
                                    <a class="quantity-decrease-btn"
                                        href="{{ route('decreaseQuantity', [$Value->id, $Value->salesman_id, $branch_id]) }}">
                                        <i class='bx bxs-checkbox-minus'></i>
                                    </a>
                                    <input class="quantity-display-field" type="text"
                                        name="prodQuantity{{ $Value->id }}" id="product_quantity{{ $Value->id }}"
                                        value="{{ $Value->productQuantity }}" readonly>
                                    <a class="quantity-increase-btn"
                                        href="{{ route('increaseQuantity', [$Value->id, $Value->salesman_id, $branch_id]) }}">
                                        <i class='bx bxs-plus-square'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @php
                    $totalTaxes = 0.0;
                    foreach ($taxes as $tax) {
                        $totalTaxes += $totalbill * ((float) $tax->tax_value / 100);
                    }
                    $totalbill += $totalTaxes;
                @endphp

                <form action="{{ route('placeOrder', $id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="payment-div">
                        <div class="cash-fields">
                            <div class="paymentfields">
                                <label for="totalbill">Total Amount</label>
                                <input type="text" name="totalbill" id="totalbill" value="Rs {{ $totalbill }}"
                                    readonly>
                                <input type="hidden" name="totaltaxes" id="totaltaxes" value="{{ $totalTaxes }}"
                                    readonly>
                            </div>
                            <div class="paymentfields">
                                <label for="recievecash"> Cash Tendered
                                </label>
                                <input style="background-color: #fff" type="number" name="recievecash" id="recievecash"
                                    min="0" placeholder="Rupees" oninput="calculateChange()" required>
                            </div>

                            <div class="paymentfields">
                                <label for="change">Balance</label>
                                <input type="number" name="change" id="change" min="0" placeholder="Rupees"
                                    readonly>
                            </div>

                            <div class="paymentfields"
                                style="flex-direction: row; justify-content:space-between; align-items:center;">
                                <span id="false-option">{{ $orderTypeArray[0] }}&nbsp;&nbsp;</span><label class="switch">
                                    <input id="order_type" type="checkbox">
                                    <span class="slider round"></span>
                                </label><span id="true-option">{{ $orderTypeArray[1] }}</span>
                            </div>
                            <input type="hidden" name="orderType" id="orderTypeHidden">

                            <div class="paymentfields">
                                <label for="paymentMethod">Payment Method:</label>
                                <div class="paymentfields" style="flex-direction: row; align-items: center; justify-content:space-between;">
                                    <span id="false-option0">Cash</span>
                                    <label class="switch">
                                        <input id="paymentmethod" type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    <span id="true-option0">Online</span>
                                </div>
                                <select style="display: none; background-color: #fff" name="payment_method"
                                    id="paymentMethod">
                                    @foreach ($payment_methods as $methods)
                                        @if ($methods->payment_method != null)
                                            <option value="{{ $methods->payment_method }}">{{ $methods->payment_method }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="discount-field">
                            <div class="paymentfields" style="flex-direction:row;align-items: center;">
                                <label style="width:200px" id="toggle-text" for="discountEnableDisable">Enable
                                    Discount</label>
                                <input type="checkbox" name="discount" id="discountEnableDisable"
                                    onclick="toggleDiscount()">
                            </div>
                            <script>
                                function toggleDiscount() {
                                    let temp = document.getElementById("totalbill").value;
                                    let temp1 = parseFloat(temp.replace('Rs', '').trim());
                                    updateDiscountTypeInput(parseInt(temp1));
                                    togglebtn = document.getElementById('discountEnableDisable').checked;
                                    if (togglebtn == true) {
                                        document.getElementById('toggle-text').textContent = "Disable Discount";
                                        document.getElementById('toggle-text').style.width = "250px";
                                        document.getElementById('discount').disabled = false;
                                        document.getElementById('discount_reason').disabled = false;
                                        document.getElementById('discountType').disabled = false;

                                        document.getElementById('discount-Type-div').style.display = "flex"
                                        document.getElementById('discountFieldDiv').style.display = "flex"
                                        document.getElementById('discountReasonDiv').style.display = "flex"
                                        document.getElementById('discountTypeDiv').style.display = "flex"
                                    } else {
                                        document.getElementById('toggle-text').textContent = "Enable Discount";
                                        document.getElementById('toggle-text').style.width = "200px";
                                        document.getElementById('discount').disabled = true;
                                        document.getElementById('discount_reason').disabled = true;
                                        document.getElementById('discountType').disabled = true;

                                        document.getElementById('discount-Type-div').style.display = "none"
                                        document.getElementById('discountFieldDiv').style.display = "none"
                                        document.getElementById('discountReasonDiv').style.display = "none"
                                        document.getElementById('discountTypeDiv').style.display = "none"
                                    }
                                }
                            </script>

                            <div id="discount-Type-div" class="paymentfields" style="display:none">
                                <label for="discountType">Type of Discount</label>
                                <div id="discountTypeDiv"
                                    style="flex-direction: row; display:none; justify-content:center; align-items:center;">
                                    <span id="false-option2">{{ $discountTypeArray[1] }}</span>
                                    <label class="switch">
                                        <input id="discounttype" type="checkbox" value="%"
                                            onclick="updateTotalONSwitch({{ json_encode($totalbill) }})">
                                        <span class="slider round"></span>
                                    </label>
                                    <span id="true-option2">{{ $discountTypeArray[0] }}</span>
                                </div>
                            </div>
                            <input type="hidden" name="discount_type" id="discountType" value="%">

                            <div class="paymentfields" id="discountFieldDiv" style="display: none">
                                <label for="discount">Discount Applied</label>
                                <input style="background-color: #fff" type="number" name="discount" id="discount"
                                    min="0" placeholder="Rupees" disabled value="0"
                                    oninput="updateTotalONInput({{ json_encode($totalbill) }},{{ json_encode($maximum_discount_percentage_value) }})">
                            </div>

                            <div class="paymentfields" id="discountReasonDiv" style="display: none">
                                <label for="discount_reason">Reason for Discount
                                </label>
                                <select style="background-color: #fff" name="discount_reason" id="discount_reason"
                                    disabled>
                                    <option value="none" selected>Select</option>
                                    @foreach ($discounts as $discount)
                                        <option value="{{ $discount->discount_reason }}">
                                            {{ $discount->discount_reason }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="buttons">
                        <input type="submit" id="proceed" value="Proceed">
                        <button onclick="window.location='{{ route('clearCart', $id) }}'" type="button"
                            id="clearCart">Clear
                            Cart</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="overlay"></div>
        <form id="addToCart" action="{{ route('saveToCart') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="product_id" name="product_id">
            <input type="hidden" name="branch_id" value="{{ $branch_id }}">
            <input type="hidden" name="salesman_id" id="salesman_id" value={{ $id }}>

            <p id="headTitle" class="head1">Customize Item</p>
            <input id="prodName" name="productname" style="border: none; display:none;" readonly>
            <div style="display: none;margin: 10px 0.5vw; border-bottom:1px solid #393939" id="productCustomDiv">
                <span id="prodPrice" style="width: 50%;"> </span>
                <input name="productprice" style="border: none; text-align:right; font-size:0.9vw;" id="price"
                    readonly>
            </div>
            {{-- <p class="head1">Please Select</p> --}}

            <label id="prodVariationLabel" for="prodVariation">Product Variation</label>
            <select tabindex="0" name="prodVariation" id="prodVariation"></select>

            <label id="addOnsLabel" for="addons">Add Ons</label>
            <select name="addOn" id="addons"></select>

            <label id="drinkFlavourLabel" for="drinkFlavour">Drink Flavour</label>
            <select name="drinkFlavour" id="drinkFlavour"></select>

            <div id="quantity">
                <p>Quantity</p>
                <i onclick="decrease()" class='bx bxs-checkbox-minus'></i>
                <input type="number" name="prodQuantity" id="prodQuantity" value="1" min="0">
                <i onclick="increase()" class='bx bxs-plus-square'></i>
            </div>

            <p id="bottom">Total Price <input name="totalprice"
                    style="background-color:transparent; border: none; text-align:right;" id="totalprice" readonly></p>

            <div id="buttons">
                <button type="button" onclick="closeAddToCart()">Close</button>
                <input id="addbtn" type="submit" value="Add">
            </div>
        </form>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let toggle = document.getElementById('order_type');
            const falsetext = document.getElementById('false-option').textContent;
            const truetext = document.getElementById('true-option').textContent;
            let orderTypeHidden = document.getElementById('orderTypeHidden');

            function updateHiddenInput() {
                orderTypeHidden.value = toggle.checked ? truetext : falsetext;
            }

            updateHiddenInput();

            toggle.addEventListener('change', function() {
                updateHiddenInput();
            });
        });
        let discountTypeInput = document.getElementById('discountType');
        let toggleDiscountType = document.getElementById('discounttype');

        function updateDiscountTypeInput(total) {
            discountTypeInput.value = toggleDiscountType.checked ? '-' : '%';
            let totalBill = parseFloat(document.getElementById("totalbill").value);
            let discount = parseFloat(document.getElementById("discount").value);
            let discountType = document.getElementById("discountType").value;
            if (isNaN(discount)) {
                alert("Enter Discount Value First");
                return;
            }

            let discountValue;
            if (discountType === "%") {
                discountValue = (discount / 100) * total;
                total -= discountValue;
            } else {
                total -= discount;
            }

            total = total.toFixed(2);
            document.getElementById("totalbill").value = `Rs ${total}`;
        }

        function updateTotalONSwitch(total) {
            updateDiscountTypeInput(total);

        };

        function updateTotalONInput(total, discountLimit) {
            let discount = parseFloat(document.getElementById("discount").value);
            let discountType = document.getElementById("discountType").value;
            if (isNaN(discount)) {
                alert("Enter Discount Value First");
                document.getElementById("discount").focus();
                return;
            }

            let discountValue;
            if (discountType === "%") {
                if (discount > parseFloat(discountLimit)) {
                    alert(`Discount in Percentage should be less then ${discountLimit}.`)
                    document.getElementById("discount").focus();
                    return;
                }
                discountValue = (discount / 100) * total;
                total -= discountValue;
            } else {
                total -= discount;
            }

            total = total.toFixed(2);
            document.getElementById("totalbill").value = `Rs ${total}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            let togglePaymentMethod = document.getElementById('paymentmethod');
            const falsetext1 = document.getElementById('false-option0').textContent;
            const truetext1 = document.getElementById('true-option0').textContent;
            let paymentMethodSelect = document.getElementById('paymentMethod');
            let removedCashOption = null;

            function updatePaymentMethod() {
                if (togglePaymentMethod.checked) {
                    paymentMethodSelect.style.display = 'flex';
                    for (let i = paymentMethodSelect.options.length - 1; i >= 0; i--) {
                        if (paymentMethodSelect.options[i].value.toLowerCase() === 'cash') {
                            removedCashOption = paymentMethodSelect.options[i];
                            paymentMethodSelect.remove(i);
                        }
                    }
                    paymentMethodSelect.value = truetext1;
                    if (!paymentMethodSelect.value) {
                        paymentMethodSelect.selectedIndex = 0;
                    }

                } else {
                    paymentMethodSelect.style.display = 'none';
                    paymentMethodSelect.value = falsetext1;
                    if (removedCashOption) {
                        let cashOption = document.createElement('option');
                        cashOption.value = removedCashOption.value;
                        cashOption.textContent = removedCashOption.textContent;
                        paymentMethodSelect.add(cashOption, paymentMethodSelect.options[
                            0]);
                        removedCashOption = null;
                    }
                }
            }


            updatePaymentMethod();

            togglePaymentMethod.addEventListener('change', function() {
                updatePaymentMethod();
            });
        });

        document.getElementById('deals_seperate_section_imgDiv').addEventListener('wheel', function(event) {
            event.preventDefault();
            this.scrollLeft += event.deltaY;
        });

        function selectCategory(route, element) {
        let categoryLinks = document.getElementsByClassName('category_link');
        for (let i = 0; i < categoryLinks.length; i++) {
            categoryLinks[i].classList.remove('selected');
        }
        let link = element.getElementsByTagName('a')[0];
        link.classList.add('selected');
        document.cookie = "selected_category=" + link.textContent.trim() + "; path=/";
        window.location = route;
    }

    function getCookie(name) {
        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }

    window.onload = function() {
        let selectedCategory = getCookie("selected_category");
        let categoryLinks = document.getElementsByClassName('category_link');
        if (!selectedCategory) {
            categoryLinks[0].classList.add('selected');
            return;
        }
        for (let i = 0; i < categoryLinks.length; i++) {
            if (categoryLinks[i].textContent.trim() === selectedCategory) {
                categoryLinks[i].classList.add('selected');
                break;
            }
        }
    };

        // function updateTotal(total) {
        //     let totalBill = parseFloat(document.getElementById("totalbill").value);
        //     let discount = parseFloat(document.getElementById("discount").value);
        //     // let discountType = document.getElementById("discountType").value;
        //     console.log(discountType.value);
        //     if (isNaN(discount)) {
        //         alert("Enter Discount Value First");
        //         return;
        //     }

        //     let discountValue;
        //     if (discountType.value === "%") {
        //         discountValue = (discount / 100) * total;
        //         total -= discountValue;
        //         updateDiscountTypeInput();
        //     } else {
        //         total -= discount;
        //         // updateDiscountTypeInput();
        //     }

        //     total = total.toFixed(2);
        //     document.getElementById("totalbill").value = `Rs ${total}`;
        // }

        function calculateChange() {
            let totalBillStr = document.getElementById('totalbill').value;
            let
                totalBill = parseFloat(totalBillStr.replace('Rs', '').trim());
            let
                receivedBill = parseFloat(document.getElementById('recievecash').value);
            if (isNaN(totalBill) ||
                isNaN(receivedBill)) {
                return;
            }
            let change = receivedBill - totalBill;
            if (change < 0) {
                document.getElementById('proceed').disabled = true;
            } else {
                document.getElementById('proceed').disabled = false;
            }
            document.getElementById('change').value = change.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search_bar');
        const productDivs = document.querySelectorAll('#imageBox');

        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();
            productDivs.forEach(function(div) {
                const productName = div.querySelector('.product_name').textContent.toLowerCase();
                if (productName.includes(filter)) {
                    div.style.display = 'flex';
                } else {
                    div.style.display = 'none';
                }
            });
        });
    });
    </script>
@endsection
