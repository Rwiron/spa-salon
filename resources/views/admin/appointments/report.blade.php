<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted Appointments Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .report-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table th {
            background-color: #f5f5f5;
            color: #333;
        }
        .table td {
            color: #555;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .footer h4 {
            margin: 0;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ asset('assets/img/logo.png') }}" alt="Company Logo">
    <h2>Accepted Appointments Report</h2>
</div>

<div class="report-container">
    <table class="table">
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Service</th>
                <th>Service Type</th>
                <th>Price</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($acceptedAppointments as $appointment)
                <tr>
                    <td>{{ $appointment->name }}</td>
                    <td>{{ $appointment->email }}</td>
                    <td>{{ $appointment->service->name }}</td>
                    <td>{{ $appointment->serviceType->name }}</td>
                    <td>{{ number_format($appointment->serviceType->price, 0) }} FRW</td>
                    <td>{{ $appointment->date }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="footer">
    <h4>Total Appointments: {{ count($acceptedAppointments) }}</h4>
    <h4>Total Revenue: {{ number_format($acceptedAppointments->sum(function ($appt) { return $appt->serviceType->price; }), 0) }} FRW</h4>
</div>

</body>
</html>
