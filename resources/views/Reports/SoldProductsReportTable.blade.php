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
    table thead tr th{
        text-align: left;
    }

    table tbody tr {
        border-bottom: 1px solid #898989;
    }

    table tbody tr td {
        border-radius: 6px;
        padding: 0.5vw;
        font-size: 1.3vw;
    }
</style>

<body>
    <div id="dayFullTransactionReportTable">
        <h3 style="text-align: center;">
            Sold Products Report
        </h3>
        <div id="table-container">
            <table id="dayTransactionReportTable">
                @php
                    $total_Sales = 0.0;
                    $count = 0;
                    $groupedItems = [];

                    // Group items by product_id and sum their quantities and total prices
                    foreach ($dailySales as $Sales) {
                        foreach ($Sales->items as $item) {
                            $productId = $item->product_id;
                            $productName = $item->product_name;
                            $productPrice = $item->product_price;
                            $quantity = $item->product_quantity;
                            $totalPrice = (float) str_replace('Rs. ', '', $item->total_price);
                            $date = $item->created_at->format('d/m/y');

                            if (!isset($groupedItems[$productId])) {
                                $groupedItems[$productId] = [
                                    'product_id' => $productId,
                                    'product_name' => $productName,
                                    'product_price' => $productPrice,
                                    'product_quantity' => 0,
                                    'total_price' => 0,
                                    'date' => $date,
                                ];
                            }

                            $groupedItems[$productId]['product_quantity'] += $quantity;
                            $groupedItems[$productId]['total_price'] += $totalPrice;
                            $total_Sales += $totalPrice;
                            $count += $quantity;
                        }
                    }
                @endphp
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groupedItems as $item)
                        <tr>
                            <td>{{ $item['product_id'] }}</td>
                            <td style="width: 200px;">{{ $item['product_name'] }}</td>
                            <td>{{ $item['product_price'] }}</td>
                            <td style="text-align: center;">{{ $item['product_quantity'] }}</td>
                            <td>Rs. {{ number_format($item['total_price'], 2) }}</td>
                            <td>{{ $item['date'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" style="text-align: center;"></td>
                    </tr>
                    <tr style="border: none;">
                        <td><strong>Total Sales</strong></td>
                        <td style="width: 5px;">:</td>
                        <td>Rs. {{ number_format($total_Sales, 2) }}</td>
                    </tr>
                    <tr style="border: none;">
                        <td><strong>Total Products Sold</strong></td>
                        <td style="width: 5px;">:</td>
                        <td>{{ $count }}</td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</body>


</html>
