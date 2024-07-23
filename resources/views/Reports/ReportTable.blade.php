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
                        <th>Total Sale</th>
                        <th>Payment Methods</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_sales = 0.0;
                        $selectedDate = null;
                    @endphp
                    @foreach ($dailyOrders as $value)
                        @foreach ($value->items as $item)
                            @php
                                $time = $item->created_at->format('H:i:s');
                                $order_bill = (float) str_replace('Rs. ', '', $item->total_price);
                                $total_sales += $order_bill;
                                $selectedDate = $value->selected_date;
                            @endphp
                            <tr>
                                <td>{{ $item->order_number }}</td>
                                <td>{{ $time }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->product_quantity }}</td>
                                <td>{{ $item->total_price }}</td>
                                <td>Cash</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" ></td>
                    </tr>
                    <tr>
                        <td><strong>Total Sales:</strong></td>
                        <td>{{ number_format($total_sales, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Report Date:</strong></td>
                        <td>{{ $selectedDate }}</td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</body>

</html>
