<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Franchise Created</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        h1 {
            color: #3a3a3a;
            text-align: center;
            font-size: 26px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table td {
            padding: 8px;
            text-align: left;
        }
        table tr:nth-child(even) {
            background-color: #f4f4f4;
        }
        table td strong {
            color: #555555;
        }
        .footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            margin-top: 40px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Family, {{ $franchise['franchise_name'] }}!</h1>
        <p>We are thrilled to have you on board! Your franchise has been successfully created, and we’re excited about the journey ahead. Here are your account details:</p>

        <table>
            <tr>
                <td><strong>Franchise Name:</strong></td>
                <td>{{ $franchise['franchise_name'] }}</td>
            </tr>
            <tr>
                <td><strong>Contact Number:</strong></td>
                <td>{{ $franchise['contact_no'] }}</td>
            </tr>
            <tr>
                <td><strong>Email Address:</strong></td>
                <td>{{ $franchise['email'] }}</td>
            </tr>
            <!-- Add more fields as necessary -->
        </table>

        <p>We’re here to support you every step of the way. If you need help or have any questions, feel free to reach out to our team at any time.</p>

        <p><a href="#" class="button">Explore Your Dashboard</a></p>

        <p class="footer">If you did not create this franchise, please <a href="mailto:support@yourcompany.com">contact support</a> immediately.</p>

        <p class="footer">Thank you for choosing us. We can’t wait to see your success!</p>
    </div>
</body>
</html>
