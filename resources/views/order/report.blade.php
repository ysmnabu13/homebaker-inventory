<!DOCTYPE html>
<html>
<head>
<style>
* {
    font-family: 'Open Sans', sans-serif;
}

#customers {
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #506050;
  color: white;
}
</style>
</head>
<body>
    <h1 style="text-align:center">Order Report</h1>
    <h3 style="text-align:center; font-weight:normal;">
        <?php
            $mytime = Carbon\Carbon::now();
            echo $mytime->toDayDateTimeString();
        ?>
    </h3>

    <table id="customers">
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Cost per Unit (RM)</th>
            <th>Total Cost (RM)</th>
        </tr>

        @foreach ($order as $orders)
        <tr class="border-gray-300 text-center">
            <td> {{ $orders->product_name }} </td>
            <td> {{ $orders->quantity }} </td>
            <td> {{ $orders->totalPrice }} </td>
            <td> {{ number_format($orders->totalPrice * $orders->quantity, 2) }} </td>
        </tr>
        @endforeach

    </table>
</body>
</html>
