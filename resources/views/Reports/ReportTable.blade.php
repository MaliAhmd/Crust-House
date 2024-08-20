<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>

<style>
    #dayFullTransactionReportTable {
        display: flex;
        flex-direction: column;
        background-color: #ffffff;
        border-radius: 10px;
        width: 95vw;
        margin: auto
    }

    #table-container {
        display: flex;
        flex-direction: column;
        width: 100%;
        margin: auto;
        max-height: 70vh;
        overflow-y: auto;
        scrollbar-width: none;
        padding: 10px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 14px;
        margin: 0.5vw auto 2vw;
    }

    table thead tr {
        border-bottom: 2px solid #000;
    }

    table tbody tr {
        border-bottom: 1px solid #898989;
    }

    table tbody tr td {
        text-align: center;
        border-radius: 6px;
        padding: 0.5vw;
        font-size: 1.3vw;
    }
</style>

<body>
    <div id="dayFullTransactionReportTable">
        <h3 style="text-align: center;">Daily Full Transaction Report</h3>
        <div id="table-container">
            <table id="dayTransactionReportTable">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Time of Sale</th>
                        <th>Items</th>
                        <th>Qty</th>
                        <th>Product Total Price</th>
                        <th>Tax</th>
                        <th>Discount</th>
                        <th>Total Bill</th>
                        <th>Payment Methods</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_sales = 0.0;
                        $salesman_id = null;
                        $selectedDate = null;
                        $renderedOrders = [];
                    @endphp
                    @foreach ($dailyOrders as $value)
                        @php
                            if (isset($renderedOrders[$value->order_number])) {
                                continue;
                            }

                            $orderProduct = [];
                            $productQuantities = [];
                            $productPrices = [];
                            foreach ($dailyOrders as $order) {
                                if ($order->order_number == $value->order_number) {
                                    foreach ($order->items as $item) {
                                        $orderProduct[] = $item->product_name;
                                        $productQuantities[] = $item->product_quantity;
                                        $productPrices[] = $item->total_price;
                                    }
                                }
                            }
                            $renderedOrders[$value->order_number] = true;
                            $salesman_id = $value->salesman_id;
                            $selectedDate = $value->selected_date;
                            $order_bill = (float) str_replace('Rs. ', '', $value->total_bill);
                            $total_sales += $order_bill;
                            $discountValue = $value->discount === null ? 0 : $value->discount;
                            $salesmanName = $value->salesman->name;
                        @endphp
                        <tr style="border-bottom: 1px solid #000;">
                            <td>{{ $value->order_number }}</td>
                            <td>{{ $value->created_at->format('H:i:s') }}</td>
                            <td>
                                <div style="display: flex; flex-direction:column;">
                                    @foreach ($orderProduct as $product)
                                        <p class="truncate-text">{{ $product }}</p>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; flex-direction:column;">
                                    @foreach ($productQuantities as $quantity)
                                        <p class="truncate-text">{{ $quantity }}</p>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div style="display: flex; flex-direction:column;">
                                    @foreach ($productPrices as $price)
                                        <p class="truncate-text">{{ $price }}</p>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $value->taxes }}</td>
                            <td>{{ $value->discount_type == '%' ? (int)($order_bill) * (int)($discountValue / 100) : $value->discount }}</td>
                            <td>{{ $value->total_bill }}</td>
                            <td>{{ $value->payment_method }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td style="width: 150px;"><strong>Total Sales:</strong></td>
                        <td>Rs. {{ number_format($total_sales, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="width: 150px;"><strong>Reported By:</strong></td>
                        <td>{{ $salesmanName }}</td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</body>

</html>
