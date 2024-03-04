<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;

        }

        tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<h1>Customer List</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Firstname</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Gender</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->firstname }}</td>
            <td>{{ $customer->address }}</td>
            <td>{{ $customer->phone_number }}</td>
            <td>{{ $customer->gender }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
