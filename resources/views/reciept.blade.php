<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        box-sizing: border-box;
        font-family: "VT323", monospace;
        color: #111;
        font-weight: bold;
    }

    .container {
        background: #f1f1f1;
        padding: 20px 10px;
        font-size: 12px;
        border: 1px solid #000;
    }

    .receipt {
        width: 300px;
        min-height: 250px;
        background: #fff;
        margin: 0 auto;
        box-shadow: 5px 5px 19px #ccc;
        padding: 10px;
    }

    .logo {
        text-align: center;
        padding: 5px;
    }

    .logo img {
        height: 75px;
        widows: 75px;
    }

    .address,
    .detail {
        text-align: left;
    }

    .transactionDetails {
        font-size: 12px;
    }

    .transactionDetails table {
        padding-bottom: 05px;
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    table thead tr {
        border-bottom: 1px solid #000;
    }

    table thead tr th,
    table tbody tr td {
        padding: 2px;
        text-align: center;
    }

    .feedback {
        margin: 20px auto;
        text-align: center;
    }

    .feedback .break,
    .feedback .center {
        font-size: 18px;
        margin: 5px
    }

    .feedback .center {
        font-size: 12px;
    }

    .feedback .clickBait {
        font-size: 12px;
        margin: 05px 0;
    }

    .feedback .web {
        font-size: 15px;
        margin: 05px 0;
    }

    .fbr {
        height: 125px;
    }

    .fbvInvoice {
        margin: 15px 0;
        text-align: center;
    }

    .fbrImages {
        display: block;
        text-align: center;
    }

    .fbrLogo {
        margin-right: 10px
    }

    .fbrQR {
        margin-left: 10px
    }

    img {
        width: 75px;
        height: 75px;
    }
</style>

<body>
    @php
        date_default_timezone_set('Asia/Karachi');
        $orderData = $orderData;
        $date_time = $orderData->created_at;
        $date = date('F d, Y', strtotime($date_time));
        $time = date('g:i A', strtotime($date_time));

        $subtotal = 0.0;
    @endphp

    <div id="showScroll" class="container">
        <div class="receipt">
            <h1 class="logo">Crust House</h1>

            <div class="logo">
                <img src="{{ asset('Images/image 1.png') }}" alt="Pizza Image">
            </div>


            <div class="address"> Address : {{ $orderData->salesman->branch->address }}</div>
            <div class="detail">Date : {{ $date }}</div>
            <div class="detail">Time : {{ $time }}</div>

            <div class="detail">ORDER TYPE: {{ $orderData->ordertype }}</div>
            <div class="detail cashier">Helped by:{{ $orderData->salesman->name }}</div>

            <div class="detail ordernumber">Order # {{ $orderData->order_number }}</div>
            <div class="detail" style="text-align: center; margin-top:15px;">Free Delivery</div>

            <div class="transactionDetails">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th style="width: 180px;">NAME</th>
                            <th>QTY</th>
                            <th>PRICE RS</th>
                        </tr>
                    </thead>
                    <br>
                    <tbody>
                        @foreach ($products as $i => $item)
                            @php
                                preg_match('/\d+(\.\d+)?/', $item->total_price, $matches);
                                $numericPart = $matches[0];
                                $subtotal += $numericPart;

                            @endphp
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                @if ($item->addons)
                                    <td>{{ $item->product_name }} with {{ $item->addons }}</td>
                                @else
                                    <td>{{ $item->product_name }}</td>
                                @endif
                                <td>{{ $item->product_quantity }}</td>
                                <td>{{ $numericPart }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="detail" style="text-align: center; margin-bottom:15px;"> Recipt #
                {{ $orderData->order_number }} </div>
            <div class="detail">SUBTOTAL: {{ $subtotal }}</div>
            <div class="detail">TAXES: {{ $orderData->taxes }}</div>
            <div class="detail">DISCOUNT:
                {{ $orderData->discount_type == '%' ? $orderData->discount . '%' : 'Rs ' . $orderData->discount }}
            </div>
            {{-- <div class="detail">DISCOUNT
                TYPE:{{ $orderData->discount_type == '%' ? 'Percentage' : ($orderData->discount_type == '-' ? 'Fixed Discount' : 'None') }}
            </div> --}}
            <div class="detail">REASON: {{ $orderData->discount_reason }}</div>
            <div class="detail" style="font-size: 15px;">TOTAL:
                {{ $orderData->discount_type == '%' ? $subtotal - ($orderData->discount / 100) * $subtotal + $orderData->taxes : $subtotal + $orderData->taxes - $orderData->discount }}
            </div>
            <div class="detail">CASH: {{ $orderData->received_cash }}</div>
            <div class="detail">CHANGE: {{ $orderData->return_change }}</div>

            {{-- <div class="returnPolicy bold">
                            Returns with receipt, subject to CVS Return Policy, thru 08/30/2024
                            Refund amount is based on the price after all coupons and discounts.
                        </div> --}}

            <div class="feedback">
                <div class="break">
                    **************************
                </div>
                <p class="center">
                    @if ($orderData->salesman->branch->receipt_message !== null)
                        {{ $orderData->salesman->branch->receipt_message }}
                    @else
                        We would love to hear your feedback on your recent experience with us. This survey will only
                        take 1 minute to complete.
                    @endif
                </p>

                <h3 class="clickBait">Share Your Feedback</h3>
                <h4 class="web">www.Crusthouse.com</h4>
                <p class="center">
                    Enjoy your Meal.!
                </p>
                <div class="break">
                    **************************
                </div>
            </div>
            <div class="fbr">
                <div class="fbvInvoice">
                    <p>FBR INVOICE #:</p>
                </div>
                <div class="fbrImages">

                    <img class="fbrLogo" src="{{ asset('Images/fbrLogo.jpg') }}" alt="FBR POS LOGO">

                    <img class="fbrQR" src="{{ asset('Images/QR Code.png') }}" alt="FBR POS LOGO">

                </div>
            </div>
        </div>
    </div>
</body>

</html>



{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        box-sizing: border-box;
        font-family: "VT323", monospace;
        color: #111;
        font-weight: bold;
    }

    .container {
        background: #f1f1f1;
        padding: 20px 10px;
        font-size: 12px;
        border: 1px solid #000;
    }

    .receipt {
        width: 300px;
        min-height: 250px;
        background: #fff;
        margin: 0 auto;
        box-shadow: 5px 5px 19px #ccc;
        padding: 10px;
    }

    .logo {
        text-align: center;
        padding: 5px;
    }

    .logo svg {
        height: 75px;
        width: 75px;
    }

    .address,
    .detail {
        text-align: left;
    }

    .transactionDetails {
        font-size: 12px;
    }

    .transactionDetails table {
        padding-bottom: 05px;
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    table thead tr {
        border-bottom: 1px solid #000;
    }

    table thead tr th,
    table tbody tr td {
        padding: 2px;
        text-align: center;
    }

    .feedback {
        margin: 20px auto;
        text-align: center;
    }

    .feedback .break,
    .feedback .center {
        font-size: 18px;
        margin: 5px
    }

    .feedback .center {
        font-size: 12px;
    }

    .feedback .clickBait {
        font-size: 12px;
        margin: 05px 0;
    }

    .feedback .web {
        font-size: 15px;
        margin: 05px 0;
    }

    .fbr {
        height: 125px;
    }

    .fbvInvoice {
        margin: 15px 0;
        text-align: center;
    }

    .fbrImages {
        display: block;
        text-align: center;
    }

    .fbrLogo,
    .fbrQR {
        display: inline-block;
        margin: 0 10px;
    }

    .fbrLogo svg,
    .fbrQR svg {
        width: 75px;
        height: 75px;
    }
</style>
<body>
    @php
        date_default_timezone_set('Asia/Karachi');
        $orderData = $orderData;
        $date_time = $orderData->created_at;
        $date = date('F d, Y', strtotime($date_time));
        $time = date('g:i A', strtotime($date_time));

        $subtotal = 0.0;
    @endphp

    <div id="showScroll" class="container">
        <div class="receipt">
            <h1 class="logo">Crust House</h1>

            <div class="logo">
                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                    <!-- Example SVG content -->
                    <circle cx="32" cy="32" r="30" stroke="black" stroke-width="2" fill="red" />
                    <text x="32" y="37" font-size="20" text-anchor="middle" fill="white">Pizza</text>
                </svg>
            </div>


            <div class="address"> Address : {{ $orderData->salesman->branch->address }}</div>
            <div class="detail">Date : {{ $date }}</div>
            <div class="detail">Time : {{ $time }}</div>

            <div class="detail">ORDER TYPE: {{ $orderData->ordertype }}</div>
            <div class="detail cashier">Helped by:{{ $orderData->salesman->name }}</div>

            <div class="detail ordernumber">Order # {{ $orderData->order_number }}</div>
            <div class="detail" style="text-align: center; margin-top:15px;">Free Delivery</div>

            <div class="transactionDetails">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th style="width: 180px;">NAME</th>
                            <th>QTY</th>
                            <th>PRICE RS</th>
                        </tr>
                    </thead>
                    <br>
                    <tbody>
                        @foreach ($products as $i => $item)
                            @php
                                preg_match('/\d+(\.\d+)?/', $item->total_price, $matches);
                                $numericPart = $matches[0];
                                $subtotal += $numericPart;

                            @endphp
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                @if ($item->addons)
                                    <td>{{ $item->product_name }} with {{ $item->addons }}</td>
                                @else
                                    <td>{{ $item->product_name }}</td>
                                @endif
                                <td>{{ $item->product_quantity }}</td>
                                <td>{{ $numericPart }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="detail" style="text-align: center; margin-bottom:15px;"> Recipt #
                {{ $orderData->order_number }} </div>
            <div class="detail">SUBTOTAL: {{ $subtotal }}</div>
            <div class="detail">TAXES: {{ $orderData->taxes }}</div>
            <div class="detail">DISCOUNT: {{ $orderData->discount ?? '0.0' }}</div>

            <div class="detail">REASON: {{ $orderData->discount_reason }}</div>
            <div class="detail" style="font-size: 15px;">TOTAL:
                {{ $subtotal + $orderData->taxes - $orderData->discount }}</div>
            <div class="detail">CASH: {{ $orderData->received_cash }}</div>
            <div class="detail">CHANGE: {{ $orderData->return_change }}</div>

            {{-- <div class="returnPolicy bold">
                            Returns with receipt, subject to CVS Return Policy, thru 08/30/2024
                            Refund amount is based on the price after all coupons and discounts.
                        </div> 

                        <div class="feedback">
                            <div class="break">
                                **************************
                            </div>
                            <p class="center">
                                @if ($orderData->salesman->branch->receipt_message !== null)
                                    {{ $orderData->salesman->branch->receipt_message }}
                                @else
                                    We would love to hear your feedback on your recent experience with us. This survey will only
                                    take 1 minute to complete.
                                @endif
                            </p>
            
                            <h3 class="clickBait">Share Your Feedback</h3>
                            <h4 class="web">www.Crusthouse.com</h4>
                            <p class="center">
                                Enjoy your Meal.!
                            </p>
                            <div class="break">
                                **************************
                            </div>
                        </div>
                        <div class="fbr">
                            <div class="fbvInvoice">
                                <p>FBR INVOICE #:</p>
                            </div>
                            <div class="fbrImages">
            
                                <div class="fbrLogo">
                                    <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Example SVG content -->
                                        <rect x="10" y="10" width="44" height="44" stroke="black" stroke-width="2" fill="green" />
                                        <text x="32" y="37" font-size="20" text-anchor="middle" fill="white">FBR</text>
                                    </svg>
                                </div>
            
                                <div class="fbrQR">
                                    <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Example SVG content -->
                                        <rect x="0" y="0" width="64" height="64" fill="white" />
                                        <path d="M10 10 h10 v10 h-10 z M30 10 h10 v10 h-10 z M10 30 h10 v10 h-10 z M30 30 h10 v10 h-10 z" fill="black" />
                                    </svg>
                                </div>
            
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            
            </html>
            
--}}
