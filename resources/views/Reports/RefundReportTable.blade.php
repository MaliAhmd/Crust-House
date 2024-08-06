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
            Refound Report
        </h3>
        <div id="table-container">
            <table id="dayTransactionReportTable">
                <thead>
                    <tr>
                        <th>Salesman Name</th>
                        <th>Refund Date</th>
                        <th>Gross Refunds</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($refundsReport['refunds_data'] as $salesman => $refund)
                        @foreach ($refund as $date => $totals)
                            <tr>
                                <td>{{ $salesman }}</td>
                                <td>{{ $date }}</td>
                                <td>Rs. {{ $totals['refunds'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: center;"><strong>Total Refund:</strong></td>
                        <td>Rs. {{ $refundsReport['total_refunds'] }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>


</html>
