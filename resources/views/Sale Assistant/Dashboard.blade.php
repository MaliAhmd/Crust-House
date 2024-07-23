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
        @endphp

        <div id="productsSide">
            <div id="category_bar">
                <div onclick="selectCategory('{{ route('salesman_dashboard', [$id, $branch_id]) }}', this)">
                    <a id="all_category" class="category_link">All</a>
                </div>
                @foreach ($Categories as $category)
                    <div
                        onclick="selectCategory('{{ route('salesman_dash', [$category->categoryName, $id, $branch_id]) }}', this)">
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

                            <div class="imgbox"
                                onclick="showAddToCart({{ json_encode($product) }} ,null, {{ json_encode($allProducts) }})">
                                <img src="{{ asset('Images/ProductImages/' . $product->productImage) }}" alt="Product">
                                <p class="product_name">{{ $product->productName }}</p>
                                <p class="product_price">From Rs. {{ $product->productPrice }}</p>
                            </div>
                        @endif
                    @endforeach
                @elseif ($Deals !== null)
                    @foreach ($Deals as $deal)
                        @if (!in_array($deal->deal->dealTitle, $displayedDealTitles))
                            @php
                                $displayedDealTitles[] = $deal->deal->dealTitle;
                            @endphp

                            <div class="imgbox"
                                onclick="showAddToCart({{ json_encode($deal) }}, {{ json_encode($Deals) }}, {{ json_encode($allProducts) }})">
                                <img src="{{ asset('Images/DealImages/' . $deal->deal->dealImage) }}" alt="Product">
                                <p class="product_name">{{ $deal->deal->dealTitle }}</p>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div id="deals_seperate_section">
                <h3 id="deals_seperate_section_heading">Deals</h3>
                <div style="display: flex;">
                    @if ($Deals !== null)
                        @foreach ($Deals as $deal)
                            @if ($deal->deal !== null && !in_array($deal->deal->dealTitle, $displayedDealTitles))
                                @php
                                    $displayedDealTitles[] = $deal->deal->dealTitle;
                                @endphp

                                <div class="imgbox"
                                    onclick="showAddToCart({{ json_encode($deal) }}, {{ json_encode($Deals) }}, {{ json_encode($allProducts) }})">
                                    <img src="{{ asset('Images/DealImages/' . $deal->deal->dealImage) }}" alt="Product">
                                    <p class="product_name">{{ $deal->deal->dealTitle }}</p>
                                </div>
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
                            @if ($Value->productAddon && strpos($Value->productName, $Value->productAddon) === false)
                                <p id="product-name">{{ $Value->productName . ' with ' . $Value->productAddon }}</p>
                                <p id="product_price{{ $Value->id }}">{{ $Value->totalPrice }}</p>
                            @else
                                <p id="product-name">{{ $Value->productName }}</p>
                                <p id="product_price{{ $Value->id }}">{{ $Value->totalPrice }}</p>
                            @endif
                            <button
                                onclick="window.location='{{ route('removeOneProduct', [$Value->id, $Value->salesman_id, $branch_id]) }}'"
                                id="remove-product">Remove</button>

                            <div style="display:flex; text-align:center;">
                                <div style="display:flex; margin-right:70px;">Quantity </div>
                                <div style="display:flex; align-items:center;">
                                    <a style="display: flex; text-decoration:none;"
                                        href="{{ route('decreaseQuantity', [$Value->id, $Value->salesman_id, $branch_id]) }}">
                                        <i class='bx bxs-checkbox-minus'></i>
                                    </a>
                                    <input type="text" name="prodQuantity{{ $Value->id }}"
                                        id="product_quantity{{ $Value->id }}" value="{{ $Value->productQuantity }}"
                                        readonly style="width:30px; text-align:center;">
                                    <a style="display: flex; text-decoration:none;"
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
                        <div class="paymentfields">
                            <label for="totalbill">Total Bill</label>
                            <input type="text" name="totalbill" id="totalbill" value="Rs {{ $totalbill }}" readonly>
                            <input type="hidden" name="totaltaxes" id="totaltaxes" value="{{ $totalTaxes }}" readonly>
                        </div>

                        <div class="paymentfields">
                            <label for="discount">Discount</label>
                            <input type="number" name="discount" id="discount" min="0" placeholder="discount">
                        </div>

                        <div class="paymentfields">
                            <label for="discount_reason">Discount Reason</label>
                            <select name="discount_reason" id="discount_reason">
                                <option value="none" selected>Select Reason</option>
                                @foreach ($discounts as $discount)
                                    <option value="{{ $discount->discount_reason }}">
                                        {{ $discount->discount_reason }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="paymentfields">
                            <label for="discount_type">Discount Type</label>
                            <select name="discount_type" id="discountType" required onchange="updateTotal({{ json_encode($totalbill)}})">
                                <option value="" selected>Select Discount Type</option>
                                <option value="-">Fixed Value</option>
                                <option value="%">In Percentage</option>
                            </select>
                        </div>

                        <div class="paymentfields">
                            <label for="recievecash">Recieve Bill</label>
                            <input type="number" name="recievecash" id="recievecash" min="0"
                                placeholder="Recieved" oninput="calculateChange()" required>
                        </div>

                        <div class="paymentfields">
                            <label for="change">Change</label>
                            <input type="number" name="change" id="change" min="0" placeholder="Change"
                                readonly>
                        </div>

                        <div class="paymentfields">
                            <label for="discount_reason">Discount Reason</label>
                            <select name="orderType" id="orderType" required>
                                <option value="" selected>Order Type</option>
                                <option value="Dinein">Dinein</option>
                                <option value="Takeaway">Takeaway</option>
                                <option value="online">Online</option>
                            </select>
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
            <p class="head1">Customize Item</p>
            <input id="prodName" name="productname" style="border: none;" readonly>
            <p id="prodPrice">Product Price <input name="productprice" style="border: none; text-align:right;"
                    id="price" readonly></p>
            <p class="head1">Please Select</p>

            <label id="prodVariationLabel" for="prodVariation">Product Variation</label>
            <select name="prodVariation" id="prodVariation"></select>

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

        <script>
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

                if (selectedCategory) {
                    for (let i = 0; i < categoryLinks.length; i++) {
                        if (categoryLinks[i].textContent.trim() === selectedCategory) {
                            categoryLinks[i].classList.add('selected');
                            return;
                        }
                    }
                }
            };

            function updateTotal(total){
                let totalBill = document.getElementById("totalbill").value;
                let discount = document.getElementById("discount").value;
                let discountType = document.getElementById("discountType").value;

                discount = parseFloat(discount);
                if(isNaN(discount)){
                    alert("Enter Discount Value First");
                }else{
                    if(discountType == "%"){
                        let discountValue =  (discount / 100) * total;
                        discountValue = discountValue.toFixed(2);
                        totalBillValue = total - discountValue;
                        document.getElementById("totalbill").value = `Rs ${totalBillValue}`; 
                    }
                    else{
                        totalBillValue = total - discount;
                        document.getElementById("totalbill").value = `Rs ${totalBillValue}`; 
                    }
                }

            }

            function calculateChange() {
                let totalBillStr = document.getElementById('totalbill').value;
                let discountStr = document.getElementById('discount').value;
                let totalBill = parseFloat(totalBillStr.replace('Rs', '').trim());
                let discount = parseFloat(discountStr);
                let receivedBill = parseFloat(document.getElementById('recievecash').value);

                if (isNaN(totalBill) || isNaN(receivedBill)) {
                    return;
                }

                if (isNaN(discount)) {
                    discount = 0.0;
                }

                totalBill = totalBill - discount;
                let change = receivedBill - totalBill;

                if (change < 0) {
                    document.getElementById('proceed').disabled = true;
                } else {
                    document.getElementById('proceed').disabled = false;
                }

                document.getElementById('change').value = change.toFixed(2);
            }
        </script>

    </main>
@endsection
