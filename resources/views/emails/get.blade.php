<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Notifikasi</title>
</head>

<body style="margin:0; padding:0; background:#f5f5f5; font-family:Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:8px; overflow:hidden;">

                    <!-- Header -->
                    <tr>
                        <td align="center"
                            style="background:#0d6efd; color:#ffffff; padding:25px;">
                            <h1 style="margin:0;">General Affair System</h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:35px; color:#333333;">

                            <h2 style="margin-top:0;">Notifikasi Ticket</h2>

                            <p>
                                Halo, {{ $name }}
                            </p>

                            <p>
                                Ticket Anda telah berhasil diperbarui. Berikut informasi ticket:
                            </p>

                            <table width="100%" cellpadding="10" cellspacing="0"
                                style="border-collapse:collapse; margin-top:20px; border:1px solid #dddddd;">

                                <tr style="background:#f8f9fa;">
                                    <td width="35%"><strong>ID Ticket</strong></td>
                                    <td>{{ $ticket_id }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Issue</strong></td>
                                    <td>{{ ucfirst($description) }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Department</strong></td>
                                    <td>{{ ucfirst($department) }}</td>
                                </tr>

                                <tr style="background:#f8f9fa;">
                                    <td><strong>Status</strong></td>
                                    <td>{{ ucfirst($status) }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td>{{ $tanggal }}</td>
                                </tr>

                            </table>

                            <p style="margin-top:30px;">
                                Silakan login ke aplikasi untuk melihat perkembangan ticket Anda.
                            </p>

                            <table cellpadding="0" cellspacing="0" style="margin-top:25px;">
                                <tr>
                                    <td style="background:#0d6efd; border-radius:5px;">
                                        <a href="https://ga.berkahrositamandiri.com"
                                            style="display:inline-block; padding:12px 25px; color:#ffffff; text-decoration:none; font-weight:bold;">
                                            Lihat Ticket
                                        </a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="background:#f8f9fa; padding:20px; color:#777777; font-size:12px;">

                            Email ini dikirim secara otomatis oleh<br>
                            <strong>General Affair System</strong>

                            <br><br>

                            © 2026 PT Berkah Rosita Mandiri.<br>
                            All Rights Reserved.

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>