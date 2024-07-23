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
            Daily Transaction Tax Report
        </h3>
        @php
            $total_Sales = 0.0;
            $total_Taxes = 0.0;
        @endphp
        <div id="table-container">
            <table id="dayTransactionReportTable">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Salesman Name</th>
                        <th>Date</th>
                        <th>Sales</th>
                        <th>Taxes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactionTaxes as $tax)
                        @php
                            $date = $tax->created_at->format('d/m/y');
                            $order_bill = (float) str_replace('Rs. ', '', $tax->total_bill);
                            $order_tax = (float) str_replace('Rs. ', '', $tax->taxes);
                            $total_Sales += $order_bill;
                            $total_Taxes += $order_tax;
                            $start_date = $tax->start_date;
                            $end_date = $tax->end_date;
                        @endphp
                        <tr>
                            <td>{{ $tax->order_number }}</td>
                            <td>{{ $tax->salesman->name }}</td>
                            <td>{{ $date }}</td>
                            <td>{{ $tax->total_bill }}</td>
                            <td>{{ $tax->taxes }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: center;"><strong>Total Sales:</strong></td>
                        <td>{{ $total_Sales }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;"><strong>Total Taxes:</strong></td>
                        <td>{{ $total_Taxes }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>


</html>
