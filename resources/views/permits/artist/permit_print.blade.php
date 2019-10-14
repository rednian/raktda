<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$permit_details->permit_number}}- Artist Permit</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            footer: page-footer;
            header: page-header;
        }

        * {
            box-sizing: border-box;
        }

        body {
            padding: 5px;
        }

        header {
            position: fixed;
            top: 80px;
        }

        h5,
        h6,
        p {
            margin: 0px;
        }

        p {
            font-size: 10px;
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

        .permit--number {
            width: 100%;
            position: absolute;
            padding-top: 8px;
        }

        .permit--number tr td:nth-child(1) {
            /* text-align: left; */
            text-align: left;
            padding-left: 5px;
        }

        .permit--number tr td:nth-child(2) {
            text-align: center;
            width: 80%;
            margin: 0 auto;
        }

        .permit--number tr td:nth-child(3) {
            /* text-align: right; */
            text-align: right;
        }

        .issue--expiry {
            width: 100%;
            position: absolute;
        }

        .issue--expiry tr td:nth-child(1) {
            text-align: left;
        }

        .issue--expiry tr td:nth-child(2) {
            text-align: right;
            float: right;
        }

        .date--row-1,
        .date--row-2 {
            width: 80%;
        }

        .date--row-1 tr td:nth-child(1),
        .date--row-2 tr td:nth-child(1) {
            text-align: left;
        }

        .date--row-1 tr td:nth-child(2),
        .date--row-2 tr td:nth-child(2) {
            text-align: center;
        }

        .date--row-1 tr td:nth-child(3),
        .date--row-2 tr td:nth-child(3) {
            text-align: right;
        }


        .company-details {
            width: 100%;
            position: absolute;
        }

        /* .company-details tr td:nth-child(1) {
            text-align: left;
        } */

        /* .company-details tr td:nth-child(2) {
            text-align: right;
        } */



        .left--side-head,
        .right--side-head {
            width: 100%;
            position: absolute;
        }

        .left--side-head tr td {
            text-align: left;
            float: left;
        }

        .right--side-head tr td {
            text-align: right;
        }

        .left--side-head tr td:nth-child(1),
        .right--side-head tr td:nth-child(1) {
            padding-bottom: 8px;
        }


        footer {
            position: fixed;
            bottom: 50px;
            left: 0;
            right: 0;
        }

        .print--footer {
            padding-top: 15px;
        }

        .print--footer p {
            margin: 0;
            font-size: 10px;
            font-weight: 400;
            text-align: center;
        }

        footer .seal--space {
            display: block;
            text-align: left;
            padding-left: 5px;
            font-size: 12px;
        }

        .person--details {
            width: 100%;
        }

        .each--person-tab {
            position: relative;
            margin: 5px 2px;
            width: 50%;
            border: 1px solid black;
        }

        .each--person-tab tr {
            width: 100%;
        }

        /* .each--person-tab .img--box img {
            width: 150px;
            height: 150px;
        } */

        .content--box table {
            width: 100%;
        }

        .content--box tr th:nth-child(1),
        .content--box tr td:nth-child(1) {
            text-align: left;
        }

        .content--box tr th:nth-child(2),
        .content--box tr td:nth-child(2) {
            text-align: right;
        }

        .page-break {
            page-break-after: always;
        }


        .date--row-1 th:first-child {
            text-align: left;
        }

        .date--row-1 td:nth-child(2) {
            text-align: center;
        }

        .date--row-1 th:nth-child(3) {
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


        .img--box {
            width: 100px;
        }

        .main {
            position: absolute;
            border: 1px solid #000;
            margin: 0 5px;
            top: 28%;
            width: 90%;
            height: 58%;
        }
    </style>

</head>

<body>
    <htmlpageheader name="page-header">
        <header>
            <table class="logo--logo-header">
                <tr>
                    <td><img id="govt_logo" alt="Logo" src="{{ asset('/img/print_govt_logo.png') }}" /></td>
                    <td><img id="tda_logo" alt="Logo" src="{{ asset('/img/print_tda_logo.png') }}" /></td>
                </tr>
            </table>
            <table class="logo--header" style="margin-top: 15px;">
                <tr>
                    <th>
                        <p>Artist Permit</p>
                    </th>
                    <th>
                        <p>تصريح الفنان</p>
                    </th>
                </tr>
            </table>
            <table class="permit--number">
                <tr>
                    <td>
                        <h5>Permit No</h5>
                    </td>
                    <td>
                        <h5>{{$permit_details['permit_number']}}</h5>
                    </td>
                    <td>
                        <h5>تصريح لا</h5>
                    </td>
                </tr>
            </table>

            <table class="col-md-12 issue--expiry">
                <tr>
                    <td>
                        <table class="date--row-1">
                            <tr>
                                <td>
                                    <h5>Expiry Date</h5>
                                </td>
                                <td>
                                    <p>{{date('d-m-Y', strtotime($permit_details['issued_date']))}}</p>
                                </td>
                                <td>
                                    <h5>تاريخ الانتهاء</h5>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td>
                        <table class="date--row-2">
                            <tr>
                                <td>
                                    <h5>Issue Date</h5>
                                </td>
                                <td>
                                    <p>{{date('d-m-Y', strtotime($permit_details['expired_date']))}}</p>
                                </td>
                                <td>
                                    <h5>تاريخ الانتهاء</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>


            <table class="company-details">
                <tr>
                    <td>
                        <table class="left--side-head">
                            <tr>
                                <td>
                                    <h5>Business Name</h5>
                                </td>
                                <td>
                                    <p>{{$company_details['company_name']}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Work Location</h5>
                                </td>
                                <td>
                                    <p>{{$permit_details['work_location']}}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="right--side-head">
                            <tr>
                                <td>
                                    <p>فندق الحمرا فورت ومنتجع الشاطئ</p>
                                </td>
                                <td>
                                    <h5>الاسم التجاري</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>فندق الحمرا فورت ومنتجع الشاطئ</p>
                                </td>
                                <td>
                                    <h5>مكان العمل</h5>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </header>
    </htmlpageheader>

    <div class="main">
        <table class="person--details">
            @php
            $i = 1 ;
            @endphp
            @foreach($artist_details as $artist_permit)
            @if($artist_permit->artist_permit_status == 'approved')
            @if($i%2 != 0)
            <tr>
                @endif
                <td>
                    <table class="each--person-tab">
                        <tr>
                            <td class="img--box">
                                <div class="img--box-div">
                                    <img src="{{url('storage').'/'.$artist_permit->thumbnail}}" alt="No Image"
                                        style="width:100px;height: 100px;object-fit:cover;">
                                </div>
                            </td>
                            <td class="content--box">
                                <table>
                                    <tr>
                                        <td>
                                            <h5>Person Code/ رمز الشخص </h5>
                                        </td>
                                        <td>
                                            <h5>{{$artist_permit->artist['person_code']}}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Name</h5>
                                        </td>
                                        <td>
                                            <h5>اسم</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>{{$artist_permit->artist['firstname_en'].'
                                                '.$artist_permit->artist['lastname_en']}}</p>
                                        </td>
                                        <td>
                                            <p>{{$artist_permit->artist['firstname_ar'].'
                                                '.$artist_permit->artist['lastname_ar']}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Nationality</h5>
                                        </td>
                                        <td>
                                            <h5>جنسية</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>{{$artist_permit->artist['Nationality']['nationality_en']}}</p>
                                        </td>
                                        <td>
                                            <p>{{$artist_permit->artist['Nationality']['nationality_ar']}}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Passport No/ رقم جواز السفر</h5>
                                        </td>
                                        <td>
                                            <p>{{$artist_permit->passport_number}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>UID No/بأرقام تحديد الهوية</h5>
                                        </td>
                                        <td>
                                            <p>{{$artist_permit->uid_number}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Date of Birth/تاريخ الميلاد</h5>
                                        </td>
                                        <td>
                                            <p>{{date('d-m-Y',strtotime($artist_permit->artist['birthdate']))}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Profession</h5>
                                        </td>
                                        <td>
                                            <h5>جنسية</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>{{$artist_permit->profession['name_en']}}</p>
                                        </td>
                                        <td>
                                            <p>{{$artist_permit->profession['name_ar']}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                @if($i%2 == 0)
            </tr>
            @endif
            @php
            $i++;
            @endphp
            @endif
            @endforeach
        </table>
    </div>
    <htmlpagefooter name="page-footer">
        <footer>
            <div class="seal--space">
                <p>Department of Tourism Licensing & Quality Assurance</p>
            </div>
            <div class="print--footer">
                <p>Department of Tourism & Quality Assurance </p>
                <p>+971 (0)7 2338884 Tel fax +971 (0)72 338118</p>
                <p>tlqa@raktda.com</p>
                <p>www.raktda.com</p>
            </div>
        </footer>
    </htmlpagefooter>

</body>

</html>
