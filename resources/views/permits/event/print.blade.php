<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$event_details->permit_number}} - Event Permit</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        body {
            /* font-family: 'arabic1' !important; */
            /* font-size: x-large; */
        }

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
        #permit_data,
        #note_data {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        #date_data {
            margin: 25px 0;
            font-size: 12px;
            border-collapse: collapse;
        }

        #date_data td {
            padding: 0 25px;
        }

        #license_data tr td,
        #license_data tr th,
        #permit_data tr td,
        #permit_data tr th {
            /* padding: 5px; */
            /* text-align: center; */
        }



        td {
            text-align: center;
        }

        #license_data tr th,
        #permit_data tr th {
            background: #ccc;
            padding: 5px;
        }

        #note_data {
            font-size: 12px;
        }

        #note_data th {
            background: #80262b;
            color: #fff;
        }

        #dept_name {
            line-height: 10px;
            font-size: 12px;
        }

        .subhead {
            width: 15%;
            font-size: 10px;
            text-align: right;
            padding-right: 5px;
        }

        .text-center {
            text-align: center;
        }

        /*footer {*/
        /*    position: absolute;*/
        /*    bottom: 20px;*/
        /*    left: 0;*/
        /*    right: 0;*/
        /*    text-align: center;*/
        /*    font-size: 10px;*/
        /*}*/

        footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
        }

        .print--footer {
            padding: 15px 0 0;
            width: 100%;
            margin:0px;
            border-width:0px;
            font-size: 10px;
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
                تصريح فعالية
            </div>

            <div>
                Event Permit
            </div>
        </div>
    </header>


    <table id="license_data" border="1">
        <thead>
            <tr>
                <th colspan="2" scope="col">License Data</th>
                <th colspan="2" scope="col" style="font-family: DroidKufi !important;">بيانات الرخصة</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$event_details->owner->company->trade_license}}</td>
                <td class="subhead">رقم الرخصة<br />License Number</td>
                <td>{{$event_details->owner->company->name_ar}}<br />{{$event_details->owner->company->name_en}}</td>
                <td class="subhead">اسم المنشأة<br />Name of Establishment</td>
            </tr>
            <tr>
                <td colspan="3">{{date('d-M-Y',strtotime($event_details->owner->company->trade_license_expired_date))}}
                </td>
                <td class="subhead">انتهاء الترخيص <br /> Expiry Date</td>
            </tr>
            <tr>
                <td colspan="3"> {{$event_details->owner_name_ar}}<br /> {{$event_details->owner_name}}</td>
                <td class="subhead">مالك الرخصة<br />License owner</td>
            </tr>
        </tbody>
    </table>

    <table id="permit_data" border="1">
        <thead>
            <tr>
                <th colspan="2" scope="col">Permit Data</th>
                <th colspan="2" scope="col">بيانات التصريح</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">{{$event_details->name_en}}</td>
                <td>{{$event_details->name_ar}}</td>
                <td class="subhead">اسم الفعالية <br />Event Name</td>
            </tr>
            <tr>
                <td colspan="2">{{$event_details->type['name_en']}}
                    {{$event_details->subType->sub_name_en ?  ' - ' . $event_details->subType['sub_name_en'] : ''}}
                </td>
                <td>{{$event_details->subType->sub_name_ar ? $event_details->subType['sub_name_ar'] . ' - ' : ''}}
                    {{$event_details->type['name_ar']}}</td>
                <td class="subhead">نوع التصريح <br />Permit Type</td>
            </tr>
            <tr>
                <td colspan="3">{{$event_details->permit_number}}</td>
                <td class="subhead">رقم التصريح <br />Permit No</td>
            </tr>
            {{-- <tr>
                <td colspan="2">{{ucwords($days)}} {{$diff > 1 ? 'days' : 'day'}} </td>
            <td>انقضاء</td>
            <td class="subhead">مدة التصريح <br />Permit Period</td>
            </tr> --}}
            <tr>
                <td colspan="3">{{$event_details->issued_date}}</td>
                <td class="subhead">تاريخ بدء التصريح<br /> Permit Date</td>
            </tr>
            <tr>
                <td colspan="3">{{$event_details->expired_date}}</td>
                <td class="subhead"> تاريخ انتهاء التصريح <br /> Permit Expiry Date</td>
            </tr>
            <tr>
                <td colspan="2">{{$event_details->venue_en}}</td>
                <td>{{$event_details->venue_ar}}</td>
                <td class="subhead">الموقع <br />Location</td>
            </tr>
            @if($event_details->liquor()->exists())
            @if($liquor->provided == 1)
            <tr>
                <td colspan="3">{{$liquor->liquor_permit_no}}</td>
                <td class="subhead">رقم تصريح تقديم الكحول<br />Liquor Permit No</td>
            </tr>
            @endif
            @endif
        </tbody>
    </table>



    @if($event_details->note_en)
    <table id="note_data" border="1">
        <thead>
            <tr>
                <th>Notes</th>
                <th>ملاحظات</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$event_details->note_en}}</td>
                <td>{{$event_details->note_ar}}</td>
            </tr>
        </tbody>
    </table>
    @endif
    <table id="date_data" border="1">
        <tr>
            <td>Printing Date: </td>
            <td>{{date('d/m/Y')}}</td>
        </tr>
    </table>
    <div id="dept_name">
        <h2>إدارة التراخيص السياحية وضمان الجودة</h2>
        <h3>Department of Tourism Licensing & Quality Assurance</h3>
    </div>
    <footer>
        @include('permits.components.print.footer')
    </footer>
</body>

</html>
