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
        <h3 style="text-align: center;">
            Products Refund Report
        </h3>
        <div id="table-container">
            <table id="dayTransactionReportTable">
                @php
                    $total_Sales = 0.0;
                    $count = 0;
                @endphp
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Salesman</th>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesRefund as $Sales)
                        @foreach ($Sales->items as $item)
                            @php
                                $date = $item->created_at->format('d/m/y');
                                $order_bill = (float) str_replace('Rs. ', '', $item->total_price);
                                $total_Sales += $order_bill;
                                $count += 1;
                                $start_date = $Sales->start_date;
                                $end_date = $Sales->end_date;
                                $salesman = $Sales->salesman->name;
                            @endphp
                            <tr>
                                <td>{{ $item->order_number }}</td>
                                <td>{{ $salesman }}</td>
                                <td>{{ $item->product_id }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->product_price }}</td>
                                <td>{{ $item->product_quantity }}</td>
                                <td>{{ $item->total_price }}</td>
                                <td>{{ $date }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; border:none;"><strong>Total Refund:</strong></td>
                        <td>{{ number_format($total_Sales, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;border:none"><strong>Total Products Refund:</strong></td>
                        <td>{{ $count }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>


</html>
