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
    {{-- <img class="w-24" style="width: 50%; height: auto; margin-left: 20px; margin-top: 10px;" src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path('images/reportlogo.png'))) }}" /> --}}

    <h1 style="text-align:center">Inventory Report</h1>
    {{-- <h2 style="text-align:center"></h2> --}}

    <h3 style="text-align:center; font-weight:normal;">
        <?php
            $mytime = Carbon\Carbon::now();
            echo $mytime->toDayDateTimeString();
        ?>
    </h3>

    <table id="customers">
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Cost (RM)</th>
            <th>Inventory Value (RM)</th>
            <th>Restocking Point</th>
        </tr>

        @foreach ($inventory as $inventory)
        <tr class="border-gray-300 text-center">
            <td> {{ $inventory->name }} </td>
            <td> {{ $inventory->category }} </td>
            <td> {{ $inventory->quantity }} </td>
            <td> {{ $inventory->cost }} </td>
            <td> {{ number_format($inventory->cost * $inventory->quantity, 2) }} </td>
            <td> {{ $inventory->restockPoint }} </td>
        </tr>
        @endforeach

    </table>

</body>
</html>
