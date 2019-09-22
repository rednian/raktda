<html>

<head>
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
            box-sizing: border-box;
        }

        body {
            border: 1px solid #000;
            padding: 5px;
        }

        h5,
        h6,
        p {
            margin: 0px;
        }

        td p {
            font-size: 10px;
        }

        th p {
            font-size: 10px;
        }

        .logo--header {
            width: 100%;
        }


        .logo--header tr td:first-child {
            text-align: left;
            float: left;
        }

        .logo--header tr td:nth-child(2) {
            float: right;
            text-align: right;
        }

        .company-details {
            width: 100%;
        }

        .company-details table {
            width: 100%;
            margin-left: -2px;
            margin-right: -2px;
        }


        footer {
            position: fixed;
            bottom: 105px;
            left: 0;
            right: 0;
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
            padding-bottom: 15px;
        }

        /* .right--side-head,
        .left--side-head {
            width: 50%;
        } */

        .right--side-head {
            text-align: right;
        }

        .left--side-head {
            text-align: left;
        }

        /* .person--details {
            border: 1px solid black;
            margin: 5px;
        } */


        .each--person-tab {
            position: relative;
            margin: 5px 2px;
            /* margin: 5px;
            padding: 5px; */
            height: 250px;
            border: 1px solid black;
        }

        .each--person-tab table {
            box-sizing: border-box;
        }


        .content--box tr th:first-child,
        .content--box tr td:first-child {
            text-align: left;
        }

        .content--box tr th:nth-child(2),
        .content--box tr td:nth-child(2) {
            text-align: right;
        }

        .page-break {
            page-break-after: always;
        }

        .permit--number {
            width: 100%;
        }

        .permit--number tr th:nth-child(2) {
            text-align: center;
        }

        .permit--number tr th:last-child {
            text-align: right;
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

        .img--box {
            text-align: center;
            margin: 0 auto;
        }

        .img--box img {
            width: 120px;
            height: auto;
            padding-bottom: 50px;

        }

        main {
            border: 1px solid black;
            height: 60%;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <header>
        <table class="logo--header" style="width: 100%;">
            <tr>
                <td><img class="img img-responsive" alt="Logo" src="{{ asset('/img/logo-en.svg') }}" /></td>
                <td><img class="img img-responsive" alt="Logo" src="{{ asset('/img/logo-en.svg') }}" /></td>
            </tr>
        </table>
        <table class="logo--header" style="margin-top: 25px;">
            <tr>
                <th>
                    <p>Artist Permit</p>
                </th>
                <td>
                    <p>تصريح الفنان</p>
                </td>
            </tr>
        </table>
        <table class="permit--number">
            <tr>
                <th>
                    <p>Permit No</p>
                </th>
                <th>
                    <p>{{$permit_details['permit_number']}}</p>
                </th>
                <th>
                    <p>تصريح لا</p>
                </th>
            </tr>
        </table>

        <table class="col-md-12 company-details">
            <tr class="col-md-12">
                <td class="col-md-5">
                    <table class="left--side-head">
                        <tr class="date--row-1">
                            <th>
                                <p>Expiry Date</p>
                            </th>
                            <td>
                                <p>{{date('d-m-Y', strtotime($permit_details['issued_date']))}}</p>
                            </td>
                            <th>
                                <p>تاريخ الانتهاء</p>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <p>Business Name</p>
                            </th>
                            <td colspan="2">
                                <p>{{$company_details['company_name']}}</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <p>Work Location</p>
                            </th>
                            <td colspan="2">
                                <p>{{$permit_details['work_location']}}</p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="col-md-2">&nbsp;</td>
                <td class="col-md-5 ">
                    <table class="right--side-head">
                        <tr class="date--row-2">
                            <th>
                                <p>Issue Date</p>
                            </th>
                            <td>
                                <p>{{date('d-m-Y', strtotime($permit_details['expired_date']))}}</p>
                            </td>
                            <th>
                                <p>تاريخ الانتهاء</p>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>فندق الحمرا فورت ومنتجع الشاطئ</p>
                            </td>
                            <th>
                                <p>الاسم التجاري</p>
                            </th>

                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>فندق الحمرا فورت ومنتجع الشاطئ</p>
                            </td>
                            <th>
                                <p>مكان العمل</p>
                            </th>

                        </tr>
                    </table>
                </td>
            </tr>

        </table>
    </header>
    {{-- --}}
    <main>
        <table class="person--details">
            @php
            $i = 1 ;
            @endphp
            @foreach($permit_details->artistPermit as $artist_permit)
            @if($i%2 != 0)
            <tr>
                @endif
                <td <?php if($i % 4 ==0){ ?> style="page-break-after: always;" <?php } ?>>
                    <table class="each--person-tab">
                        <tr>
                            <td class="img--box">
                                <img src="{{url('storage').'/'.$artist_permit->thumbnail}}" alt="No Image">
                            </td>
                            <td class="content--box">
                                <table>
                                    <tr>
                                        <th>
                                            <p>Person Code/ رمز الشخص </p>
                                        </th>
                                        <th>
                                            <p>{{$artist_permit->artist['person_code']}}</p>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p>Name</p>
                                        </th>
                                        <th>
                                            <p>اسم</p>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>{{$artist_permit->artist['firstname_en'].'
                                                '.$artist_permit->artist['firstname_en']}}</p>
                                        </td>
                                        <td>
                                            <p>{{$artist_permit->artist['firstname_ar'].'
                                                '.$artist_permit->artist['firstname_ar']}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p>Nationality</p>
                                        </th>
                                        <th>
                                            <p>جنسية</p>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>{{$artist_permit->artist['Nationality']['country_enNationality']}}</p>
                                        </td>
                                        <td>
                                            <p>{{$artist_permit->artist['Nationality']['country_arNationality']}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p>Passport No</p>
                                        </th>
                                        <td>
                                            <p>{{$artist_permit->passport_number}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p>UID No</p>
                                        </th>
                                        <td>
                                            <p>{{$artist_permit->uid_number}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p>Date of Birth</p>
                                        </th>
                                        <td>
                                            <p>{{date('d-m-Y',strtotime($artist_permit->artist['birthdate']))}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p>Profession</p>
                                        </th>
                                        <th>
                                            <p>جنسية</p>
                                        </th>
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
            @endforeach
        </table>
    </main>

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

</body>

</html>
