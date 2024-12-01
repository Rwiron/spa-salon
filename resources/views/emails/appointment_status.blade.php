<!DOCTYPE html>
<html>

<head>
    <title>Appointment Status</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h1 style="color: #333;">Your Appointment Status</h1>

    <p>Dear {{ $appointment->name }},</p>

    @if ($status == 'accepted')
        <p>
            We are pleased to inform you that your appointment for <strong>{{ $appointment->service->name }}</strong>
            ({{ $appointment->serviceType->name }}) has been
            <span style="color: green;"><strong>accepted</strong></span>. Your appointment is scheduled for
            <strong>{{ $appointment->date }}</strong> at <strong>{{ $appointment->time }}</strong>.
        </p>
        <p>The total price for the service is <strong>{{ number_format($appointment->serviceType->price) }}
                RWF</strong>.
        </p>
        <p>We look forward to providing you with an exceptional experience at our salon and spa.</p>
    @else
        <p>
            We regret to inform you that your appointment for <strong>{{ $appointment->service->name }}</strong>
            ({{ $appointment->serviceType->name }}) scheduled for <strong>{{ $appointment->date }}</strong> has been
            <span style="color: red;"><strong>declined</strong></span>.
        </p>
        <p>
            We apologize for any inconvenience caused, and we encourage you to reschedule at a more convenient time.
            Please don't hesitate to contact us for any further assistance.
        </p>
    @endif

    <p>
        Thank you for choosing <strong>Alcobra Dubai Kigali Salon & Spa</strong>. We are always here to help with any
        questions or to assist with future bookings.
    </p>

    <p style="color: #888;">Best Regards,<br>Alcobra Dubai Kigali Salon & Spa Team</p>
</body>

</html>
