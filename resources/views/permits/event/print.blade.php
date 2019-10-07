<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Permit</title>
    <style>
        * {
            box-sizing: border-box;
            overflow: hidden;
        }

        .logo--header,
        .logo--logo-header {
            width: 100%;
            position: absolute;
        }

        .logo--header tr th:nth-child(1),
        .logo--logo-header tr td:nth-child(1) {
            text-align: left;
            padding-left: 5px;
        }

        .logo--header tr th:nth-child(2),
        .logo--logo-header tr td:nth-child(2) {
            text-align: right;
        }


        #tda_logo {
            height: 80px;
            margin-right: 25px;
        }

        #govt_logo {
            height: 40px;
            margin-left: 25px;
        }

        #heading {
            width: 100%;
            background: #80262b;
            color: #fff;
            margin: 15px 0;
            padding: 5px 0;
        }

        #heading div {
            width: 100%;
            text-align: center;
            font-weight: 700;
        }

        #license_data,
        #permit_data {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        #license_data tr td,
        #license_data tr th,
        #permit_data tr td,
        #permit_data tr th {
            padding: 5px;
        }

        #license_data tr th,
        #permit_data tr th {
            background: #ccc;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <table class="logo--logo-header">
            <tr>
                <td><img id="govt_logo" alt="Logo" src="{{ asset('/img/print_govt_logo.png') }}" /></td>
                <td><img id="tda_logo" alt="Logo" src="{{ asset('/img/print_tda_logo.png') }}" /></td>
            </tr>
        </table>
        <div id="heading">
            <div>
                تصريح مؤقت
            </div>
            <div>
                Temporary Permit
            </div>
        </div>
    </header>

    <table id="license_data" border="1">
        <thead>
            <tr>
                <th colspan="2" scope="col">License Data</th>
                <th colspan="2" scope="col">بيانات الترخيص</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Rakia56rz03125353</td>
                <td>License Number</td>
                <td>Rakia56rz03125353</td>
                <td>License Number</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">25/03/2019</td>
                <td>Expiry</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">Benny Johnson Kurein</td>
                <td>Licese owner</td>
            </tr>
        </tbody>
    </table>

    <table id="permit_data" border="1">
        <thead>
            <tr>
                <th colspan="2" scope="col">Permit Data</th>
                <th colspan="2" scope="col">بيانات الترخيص</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" class="text-center">Health and fitness Event</td>
                <td>License Number</td>
                <td>Rakia56rz03125353</td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">Sport Event without Tickets</td>
                <td>Expiry</td>
                <td>Rakia56rz03125353</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">Benny Johnson Kurein</td>
                <td>Licese owner</td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">Sport Event without Tickets</td>
                <td>Expiry</td>
                <td>Rakia56rz03125353</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">Benny Johnson Kurein</td>
                <td>Licese owner</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">Benny Johnson Kurein</td>
                <td>Licese owner</td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">Sport Event without Tickets</td>
                <td>Expiry</td>
                <td>Rakia56rz03125353</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
