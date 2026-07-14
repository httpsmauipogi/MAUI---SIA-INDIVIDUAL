<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment Confirmed</title>
</head>
<body style="margin:0; padding:0; background:#f4f6fb; font-family: Arial, Helvetica, sans-serif; color:#333;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6fb; padding: 30px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="480" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; overflow:hidden;">
                    <tr>
                        <td style="background:#3454d1; padding: 24px; text-align:center;">
                            <h2 style="color:#ffffff; margin:0;">{{ site_setting('site_name', 'Healix HMS') }}</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <h3 style="margin-top:0;">Hi {{ $appointment->patient->name }},</h3>
                            <p>Your appointment has been confirmed. Please arrive 15 minutes early and bring this serial number with you.</p>

                            <div style="text-align:center; margin: 24px 0; padding: 20px; border: 2px dashed #3454d1; border-radius: 8px;">
                                <p style="margin:0; color:#888; text-transform:uppercase; font-size:12px;">Your Serial Number</p>
                                <p style="margin:4px 0 0; font-size:42px; font-weight:bold; color:#3454d1;">{{ $appointment->serial_number ?? '-' }}</p>
                                <p style="margin:4px 0 0; color:#888;">{{ $appointment->appointment_date->format('l, d M Y') }}</p>
                            </div>

                            <table role="presentation" width="100%" cellpadding="6" cellspacing="0" style="font-size: 14px;">
                                <tr>
                                    <td style="color:#888;">Doctor</td>
                                    <td align="right"><strong>Dr. {{ $appointment->doctor->name ?? 'N/A' }}</strong></td>
                                </tr>
                                <tr>
                                    <td style="color:#888;">Specialization</td>
                                    <td align="right">{{ $appointment->doctor->specialization ?? '-' }}</td>
                                </tr>
                                @if ($appointment->doctor?->branch)
                                    <tr>
                                        <td style="color:#888;">Branch</td>
                                        <td align="right">{{ $appointment->doctor->branch }}</td>
                                    </tr>
                                @endif
                                @if ($appointment->doctor?->floor)
                                    <tr>
                                        <td style="color:#888;">Floor</td>
                                        <td align="right">{{ $appointment->doctor->floor }}</td>
                                    </tr>
                                @endif
                                @if ($appointment->doctor?->room_no)
                                    <tr>
                                        <td style="color:#888;">Room No</td>
                                        <td align="right">{{ $appointment->doctor->room_no }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td style="color:#888;">Time</td>
                                    <td align="right">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                </tr>
                                @if ($appointment->doctor?->consultation_fee)
                                    <tr>
                                        <td style="color:#888;">Consultation Fee</td>
                                        <td align="right">{{ $appointment->doctor->consultation_fee }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td style="color:#888;">Appointment No</td>
                                    <td align="right">{{ $appointment->appointment_no }}</td>
                                </tr>
                            </table>

                            <p style="margin-top:24px; font-size:13px; color:#888;">
                                If you need to reschedule or cancel, please call us
                                @if (site_setting('phone'))
                                    at {{ site_setting('phone') }}
                                @endif
                                .
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f4f6fb; padding: 16px; text-align:center; font-size:12px; color:#999;">
                            {{ site_setting('site_name', 'Healix HMS') }}
                            @if (site_setting('address'))
                                &middot; {{ site_setting('address') }}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
