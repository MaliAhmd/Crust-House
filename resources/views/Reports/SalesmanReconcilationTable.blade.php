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
        <h3 style="text-align: center;">Salesman Reconcilation Figure By Date Report</h3>
        <div id="table-container">
            <table id="dayTransactionReportTable">
                <thead>
                    <tr>
                        <th>Salesman Name</th>
                        <th>Date</th>
                        <th>Cash</th>
                        <th>Discount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_Sales = $dailyReconciliation['total_sales'];
                        $start_date = $dailyReconciliation['report_start_date'];
                        $end_date = $dailyReconciliation['report_end_date'];
                    @endphp
                    @foreach ($dailyReconciliation['sales_data'] as $salesman => $dailyReport)
                        @foreach ($dailyReport as $date => $totals)
                            <tr>
                                <td>{{ $salesman }}</td>
                                <td>{{ $date }}</td>
                                <td>Rs. {{ $totals['sales'] }}</td>
                                <td>Rs. {{ $totals['discount'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: center;"></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Total Sales Made by Salesman:</strong></td>
                        <td>Rs. {{ number_format($total_Sales, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Report Date:</strong></td>
                        <td>{{ $start_date . ' to ' . $end_date }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>


</html>
