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
            Salesman Discount Report
        </h3>
        <div id="table-container">
            <table id="dayTransactionReportTable">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Time of Sale</th>
                        <th>Salesman</th>
                        <th>Sale</th>
                        <th>Discount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesmanDiscountReport as $value)
                        @php
                            $salesman_id = $value->salesman_id;
                            $transaction_report_date = $value->transaction_date;
                            $time = $value->created_at->format('H:i:s');
                            $order_bill = (float)str_replace('Rs. ','', $value->total_bill)
                        @endphp
                        <tr>
                            <td>{{ $value->order_number }}</td>
                            <td>{{ $time }}</td>
                            <td>{{ $value->salesman->name }}</td>
                            <td>{{ $value->total_bill }}</td>
                            <td>Rs. {{ $value->discount_type == '%' ? ($order_bill) * ($value->discount / 100) : $value->discount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>


</html>
