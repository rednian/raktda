<style xmlns:data="http://www.w3.org/1999/xhtml">
    .dropdown-item{
        color: #6d6d6d;
    }
    body{
        font-family: arial;
    }
    .dt-button-collection span{
        color: #6d6d6d;
    }

    #buttonsId{
        border-bottom: 3px solid #8b000029;
    }

    #search_button_css {
        background: transparent;
        border: none;
        height: 38px;
        width: 36px;
        margin-left: -37px;
    }
    #search_button_css1 {
        background: transparent;
        border: none;
        height: 38px;
        width: 36px;
        margin-left: 6px;
    }e
     .dataTables_wrapper {
         font-size: 12px;
     }
    .dataTables_wrapper tr td {
        font-size: 11px;
    }
    #name_search_button{
        border-radius: 4px;
        padding: 5px;
        background-color: #b45454;
        border: navajowhite;
        width: 37px;
        margin-right: -9px;
        color: white;
    }

    #active-artist_wrapper  .dt-buttons{
        background-color: #edeef4;
        margin-top:6px;
    }

    #block-artist_wrapper .dt-buttons{
        background-color: #edeef4;
        margin-top:6px;
    }
    #navbarCollapse{
        width: 141px;
        background-color: #616161;
        padding: 9.2876px;
        box-shadow: 0px 9px 15px -6px grey;
        border-radius: 4px;
        margin-left: 76%;
        position: absolute;
        margin-top: -22%;
    }


    .border-bottom{
        border: navajowhite;
        border-bottom: 3px solid #8b0000b8;
    }

</style>
<div class="container" style="margin-top:-16px">
    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist" id="">
        <li  id="all_permit_type_click" class="nav-item "><a class="nav-link active" data-toggle="tab" href="#">
                <span style="font-size: 11px">{{__('ARTISTS WITH ACTIVE PERMITS')}}</span>
                <input type="text" value='all' id="all_permit_type_input" hidden>
            </a></li>

        <li  id="single_permit_type_click" class="nav-item"><a class="nav-link" data-toggle="tab" href="#">
                <span style="font-size: 11px">{{__('ARTISTS WITH SINGLE PERMIT')}}</span>
                <input type="text" value='single' id="single_permit_type_input" hidden>
            </a></li>
        <li  id="multiple_permit_type_click" class="nav-item"><a class="nav-link" data-toggle="tab" href="#">
                <span style="font-size: 11px">{{__('ARTISTS WITH MULTIPLE PERMITS')}}</span>
                <input type="text" value='multiple' id="multiple_permit_type_input" hidden>
            </a></li>
        <li  id="blocked_artist_click" class="nav-item"><a class="nav-link" data-toggle="tab" href="#" data-target="#">
                <span  style="font-size: 11px">{{__('BLOCKED ARTISTS')}}</span>
                <input type="text" value='blocked' id="blocked_artist_input" hidden>
            </a></li>

        <li id="active_artist_click" class="nav-item"><a class="nav-link" data-toggle="ttab" href="#" data-target="#">
                <span  style="font-size: 11px">{{__('ACTIVE ARTISTS')}}</span>
                <input type="text" value="active" id="active_artist_input" hidden>
            </a></li>
        <li>
            <button class="btn btn-warning btn-sm" style=" box-shadow: 1px 4px 7px -5px grey;height: 24px;border-radius: 3px;line-height: 4px;margin-top: 9px;" id="filter_button">Filter</button></li>


    </ul>
</div>

<table class="table  table-hover  table-borderless table-striped border" id="block-artist">
    <thead>
    <tr id="filterTableCollapse" style="display: none">
        <th> <div class="col-sm" style="display: inline-flex">
                <input type="text" class="form-control form-control-sm " name="search-artist-name" id="search-artist-name" placeholder="{{__('Name')}}">
                <button class="fa fa-search" id="name_search_button"></button>
            </div></th>
        <th><select type="text" id="search_by_gender" style="width: 100%;margin-top: 1px" class="form-control form-control-sm custom-select-sm custom-select" >
                <option value="">{{__('Gender')}}</option>
                @foreach($gender as $key => $genders)
                    <option value="{{$genders->gender_id}}">{{Auth()->user()->LanguageId==1? ucwords($genders->name_en):ucwords($genders->name_ar)}}</option>
                @endforeach
            </select></th>
        <th><select type="text" id="search_by_age" style="width: 100%" class="form-control form-control-sm custom-select-sm custom-select" name="search_artist" >
                <option value="">{{__('Age')}}</option>
                <option value="17">{{__('Minor')}}</option>
                <option value="18">{{__('Adult')}}</option>
            </select></th>
        <th> <select type="text"  id="search_by_nationality" class="form-control form-control-sm custom-select-sm custom-select" style="width: 90%" name="search_artist" >
                <option value="">{{__('Nationality')}}</option>

                @foreach($country as $key => $nationality)
                    <option value="{{$nationality->country_id}}">{{Auth()->user()->LanguageId==1? $nationality->nationality_en:$nationality->nationality_ar}}</option>
                @endforeach
            </select></th>
        <th>
            <select type="text" id="search_by_profession" style="width: 99px" class="form-control form-control-sm custom-select-sm custom-select" name="search_artist" >
                <option value="">{{__('Profession')}}</option>
                @foreach($profession as $key => $nationality)
                    <option value="{{$nationality->profession_id}}">{{Auth()->user()->LanguageId==1? $nationality->name_en:$nationality->name_ar}}</option>
                @endforeach
            </select>
        </th>
        <th>
            <select type="text" id="search_by_visa" style="width:97px" class="form-control form-control-sm custom-select-sm custom-select" name="search_artist" >
                <option value="">{{__('Visa Type')}}</option>
                @foreach($visas as $key => $visa)
                    <option value="{{$visa->id}}">{{Auth()->user()->LanguageId==1? $visa->visa_type_en:$visa->visa_type_ar}}</option>
                @endforeach
            </select>
        </th>
        <th>  <button id="ArtistTableresetButton" class="btn btn-sm pull-right btn-secondary">Reset</button></th>
    </tr>

    <tr style="font-size: 12px">
        <th style="width: 14%;font-weight: bold">{{ __('PERSON CODE') }}</th>
        <th style="font-weight: bold">{{ __('NAME') }}</th>
        <th style="font-weight: bold">{{ __('PROFESSION') }}</th>
        <th style="font-weight: bold">{{ __('NATIONALITY') }}</th>
        <th style="width: 14%;font-weight: bold">{{ __('MOBILE') }}</th>
        <th style="font-weight: bold;width:14%;">{{ __('EMAIL') }}</th>
        <th style="font-weight: bold">{{ __('IDENTIFICATION NUMBER') }}</th>
        <th style="font-weight: bold">{{ __('LANGUAGE') }}</th>
        <th style="font-weight: bold">{{ __('FAX NUMBER') }}</th>
        <th style="font-weight: bold">{{ __('PO-BOX') }}</th>
        <th style="font-weight: bold">{{ __('EMIRATE') }}</th>
        <th style="font-weight: bold">{{ __('ADDRESS') }}</th>
        <th></th>

    </tr>
    </thead>
</table>

@foreach($artistPermit as $key =>$artists)
    <?php
    $artistWithThisId=\App\ArtistPermit::where('artist_permit_id',$artists->artist_permit_id)->with('profession')->first();
    ?>

    <div class="modal fade" id="artist_modal_{{$artists->artist_id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="    font-family: Arial;border: none;box-shadow: 1px 8px 24px -2px black;">
                <div class="modal-header" style="background-color: #f7b100;">
                    <h5 class="modal-title hover_title__{{$artists->artist_id}}" id="exampleModalLabel" style="font-weight:bold;margin-left:36%;color: white">
                        {{
                          Auth()->user()->LanguageId == 1 ? $artists->firstname_en . " " . $artists->lastname_en ." Report" : $artists->firstname_ar . " " . $artists->lastname_ar." Report"                 }}
                    </h5>

                </div>
                <div class="modal-body">
                    <div class="container" id="tableToPrint_{{$artists->artist_id}}" style="margin-top: 10px">
                        <table class="table table-borderless table-hover" id="artistTableHide_{{$artists->artist_id}}" style="font-family:arial;font-size: 11px">
                            <tr>
                                <td colspan="8" ><img style="
                                     height: 59%;width: 99%" src='{{asset('img/raktdalogo.png')}}'/></td>

                            </tr>
                            <tr><th colspan="12" style="background-color:#f0f0f0;color:black;padding: 11px;text-align: center;box-shadow: 0px 8px 10px -12px black">
                                    Personal Details - {{Auth()->user()->LanguageId == 1 ? $artistWithThisId->firstname_en . " " . $artistWithThisId->lastname_en  : $artists->firstname_ar. " ".$artistWithThisId->lastname_ar}}
                                </th>
                            </tr>
                            <tr style="font-size: 10px">
                                <th width="10%">PERSON CODE</th>
                                <th width="14%">PROFESSION</th>
                                <th width="14%">NATIONALITY</th>
                                <th width="20%">E-MAIL</th>
                                <th width="15%">VISA NO.</th>
                                <th width="15%">PASSPORT NO.</th>
                                <th width="26%">PASSPORT EXPIRY DATE</th>

                            </tr>
                            <tr>
                                <td width="14%">{{$artistWithThisId->artist->person_code}}</td>
                                <td width="14%">{{$artistWithThisId->profession?$artistWithThisId->profession->name_en:''}}</td>
                                <td width="14%">{{$artistWithThisId->country?$artistWithThisId->country->nationality_en:''}}</td>
                                <td width="18%">{{$artistWithThisId->email}}</td>
                                <td width="15%">{{$artistWithThisId->visa_number}}</td>
                                <td width="15%">{{$artistWithThisId->passport_number}}</td>

                                <?php
                                $passport_expire_date=\Illuminate\Support\Facades\Date::make($artistWithThisId->passport_expire_date)->format('d/m/Y');
                                ?>
                                <td width="24%">{{$passport_expire_date}}</td>
                            </tr>
                        </table>


                        <table class="table  table-hover table-borderless table-striped " style="font-size: 12px;margin-top:5%;font-family:Arial" id="printTable_{{$artists->artist_id}}">
                            <thead>
                            <tr><th colspan="7"  style="font-size:11px;padding: 9px;background-color: #f0f0f0;font-weight:bold;color: black;text-align: center;box-shadow: 0px 8px 10px -12px black;width: 100%">
                                   Permit Details -  {{Auth()->user()->LanguageId == 1 ? $artistWithThisId->firstname_en . " " . $artistWithThisId->lastname_en: $artists->firstname_ar." ".$artists->lastname_ar}}
                                </th></tr>
                            <tr  align="center">
                                <th style="width: 18% ;font-weight: bold;font-size: 10px;text-align: left">{{ __('NAME') }}</th>
                                <th style="width: 14%; font-weight: bold;font-size: 10px ;text-align: left">{{ __('PERMIT NO.') }}</th>
                                <th style="width: 18% ;text-align: left; font-weight: bold;font-size: 10px">{{ __('REFERENCE NO.') }}</th>
                                <th style="width: 18% ;text-align: left; font-weight: bold;font-size: 10px">{{ __('ISSUED DATE') }}</th>
                                <th style="width: 18% ;text-align: left; font-weight: bold;font-size: 10px">{{ __('EXPIRY DATE') }}</th>
                                <th style="width: 18% ;text-align: left; font-weight: bold;font-size: 10px">{{ __('COMPANY') }}</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            $permits=\App\Artist::where('artist_id',$artistWithThisId->artist_id)->with('permit')->first();

                            ?>
                            @foreach($permits->permit as $permit)

                                <tr align="center" >
                                    <td  style="text-align: left;font-size: 10px">{{ Auth()->user()->LanguageId == 1 ? $artists->firstname_en . ' ' . $artists->lastname_en  : $artists->firstname_ar . ' ' . $artists->lastname_ar}}
                                    <td style="text-align: left;font-size: 10px">{{$permit->permit_number}}</td>
                                    <td style="text-align: left;font-size: 10px">{{$permit->reference_number}}</td>
                                    <?php
                                    $issued_date= \Illuminate\Support\Facades\Date::make($permit->issued_date)->format('d/m/Y');
                                    $expire_date= \Illuminate\Support\Facades\Date::make($permit->expired_date)->format('d/m/Y');
                                    ?>
                                    <td style="text-align: left;font-size: 10px">{{$issued_date}}</td>
                                    <td style="text-align: left;font-size: 10px">{{$expire_date}}</td>
                                    <td style="text-align: left;font-size: 10px">{{$permit->company? $permit->company->name_en:''}}</td>
                                </tr>

                            @endforeach
                            <tr><td></td></tr>
                            <tr><th style="text-align: left;padding: 10px">
                                   Total Permits : <span style="color: grey">{{$permits->permit->count()}}</span>
                                        </th></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" id="modal_footer{{$artists->artist_id}}">
                    <button class="btn btn-success" style="height: 26px; line-height: 3px; border-radius: 2px; box-shadow: 1px 3px 4px -4px black;" id="{{$artists->artist_id}}" onclick="printContent({{$artists->artist_id}})">Print</button>
                    <button style="height: 26px; line-height: 3px; border-radius: 2px; box-shadow: 1px 3px 4px -4px black;" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endforeach
@section('script')
    <script>

        function printContent(id) {

            var artistTableHide = '#artistTableHide_' + id;
            var tableToPrint = 'tableToPrint_' + id;

            $(artistTableHide).css({'display': 'block','text-align':'center'})
            var divToPrint = document.getElementById(tableToPrint);
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }


        $('#filter_button').click(function () {
            $('#filterTableCollapse').toggle(400)
        })


        $(function myTable() {

            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
           /*     + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();*/

            table= $('#block-artist').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                "columnDefs": [
                    {
                        "targets": [6,7,8,9,10,11],
                        "visible": false,
                        "searchable": false
                    },

                ],

                buttons: ['pageLength',
                    {
                        extend: 'pdf',
                        title: function () {
                            return 'Artists With Active Permits';

                        },
                        exportOptions: {
                            columns: [ 0, 1, 2,3,4, 5 ]
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.tableHeader.background = 'red';
                            doc.styles.title.fontSize = 12;
                            doc.pageMargins = [30,70, 30,30 ];
                            doc.content[1].table.widths = [ '13%', '20%', '14%', '18%', '14%', '21%'];
                            doc.styles.tableHeader={'color': "Grey","background-color":'black'};
                            doc.styles.title = {
                                color: 'black',
                                fontSize: '11',
                                margin:'10',
                                alignment: 'center'
                            };
                            doc['header']=(function(page, pages) {
                                return {

                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 10],
                                }

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0,-55, 0, 10],
                                width: 525,
                                alignment: "center",
                                image: 'data:image/png;base64,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'

                            });


                        },

                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1, 2,3,4, 5,6,7,8,9,10,11 ]
                        },
                        title: function () {
                            return  'Artists With Active Permits'; },
                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50 ],
                    [ '10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                ajax: {
                    url: '{{ route('admin.artist_permit_reports.artist_reports')}}',
                    method: 'get',
                    data: function (d) {
                    }
                },

                columns: [
                    {data: 'person_code',name:'person_code'},
                    {data: 'artist_name',name:'artist_name'},
                    {data: 'profession',name:'profession'},
                    {data: 'nationality',name:'nationality'},
                    {data: 'mobile_number',name:'mobile_number'},
                    {data: 'email',name:'email'},
                    {data: 'identification_number',name:'identification_number'},
                    {data: 'language_id',name:'language_id'},
                    {data: 'fax_number',name:'fax_number'},
                    {data: 'po_box',name:'po_box'},
                    {data: 'emirate_id',name:'emirate_id'},
                    {data: 'address_en',name:'address_en'},
                    {data: 'artist_id',name:'artist_id'},

                ],

            });
        });


        $('#name_search_button').click(function (e) {
            e.preventDefault();
            var search_artist=$('input[name="search-artist-name"]').val();
            var filter_search={{\App\ConstantValue::ARTISTNAME}};

            $.ajax({
                url: '{{ route("admin.artist_permit_reports.artist_reports")}}',
                data:{filter_search:filter_search,search_artist:search_artist}
            })
            if(search_artist != '' && filter_search != '')
            {
                $('#block-artist').DataTable().destroy();
                fill_datatable(search_artist, filter_search);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        });

        $('#active_artist_click').click(function (e) {
            e.preventDefault();
            var search_artist=$('#active_artist_input').val();
            var filter_search={{\App\ConstantValue::STATUS}};

            $.ajax({
                url: '{{ route("admin.artist_permit_reports.artist_reports")}}',
                data:{filter_search:filter_search,search_artist:search_artist}
            })
            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        });

        $('#blocked_artist_click').click(function (e) {
            e.preventDefault();
            var search_artist=$('#blocked_artist_input').val();
            var filter_search={{\App\ConstantValue::STATUS}};

            $.ajax({
                url: '{{ route("admin.artist_permit_reports.artist_reports")}}',
                data:{filter_search:filter_search,search_artist:search_artist}
            })
            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        });


        function fill_datatable(filter_search = '', search_artist = '')
        {
            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
         /*   console.log(filter_search +search_artist)*/
            var dataTable = $('#block-artist').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [6,7,8,9,10,11],
                        "visible": false,
                        "searchable": false
                    },

                ],
                buttons: ['pageLength',
                    {
                        extend: 'pdf',
                        title: function () {
                            if(filter_search==1){
                                return 'Artists List Searched By Status'; }
                            if(filter_search==3){
                                return 'Artists List Searched By Name'; }
                            if(filter_search ==4){
                                return 'Artists With Profession'; }

                            if(filter_search==5){
                                return 'Artists By Nationality'; }

                            if(filter_search==6){
                                if(search_artist=='single') {
                                    return "Artists With Single Permit";
                                }
                                if(search_artist=='multiple'){
                                    return "Artists With Multiple Permits";
                                }
                                if(search_artist=='all'){
                                    return "Artists With Active Permits";
                                }
                            }
                            if(filter_search==7){
                                return 'Artists List Searched By Visa Type'; }

                            if(filter_search==8){
                                return 'Artists List Searched By Age'; }

                            if(filter_search==9){
                                return 'Artists List Searched By Area'; }
                        },
                        exportOptions: {
                            columns: [ 0, 1, 2,3,4, 5 ]
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.bgColor = 'red';
                            doc.styles.title.fontSize = 12;
                            doc.content[1].table.marginTop=40;
                         doc.content[1].table.widths = [ '13%', '20%', '14%', '18%', '14%', '21%'];
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {

                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20],
                                }

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 109,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 105,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });

                        },
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1, 2,3,4, 5,6,7,8,9,10,11 ]
                        },
                        title: function () {
                            if(filter_search==1){
                                return 'ARTISTS WITH  STATUS '; }
                            if(filter_search==3){
                                return 'ARTISTS LIST SEARCHED BY NAME '; }
                            if(filter_search ==4){
                                return 'ARTISTS WITH PROFESSION'; }

                            if(filter_search==5){
                                return 'ARTISTS WITH NATIONALITY '; }

                            if(filter_search==6){
                                if(search_artist=='single') {
                                    return "ARTISTS WITH SINGLE PERMIT";
                                }
                                if(search_artist=='multiple'){
                                    return "ARTISTS WITH MULTIPLE PERMITS";
                                }
                                if(search_artist=='all'){
                                    return "ARTISTS WITH ACTIVE PERMIT";
                                }
                            }
                            if(filter_search==7){
                                return 'ARTISTS LIST SEARCHED BY VISA TYPE '; }

                            if(filter_search==8){
                                return 'ARTISTS LIST SEARCHED BY AGE '; }

                            if(filter_search==9){
                                return 'ARTISTS LIST SEARCHED BY AREA '; }
                        },

                    }

                ],
                lengthMenu: [
                    [ 10, 25, 50],
                    [ '10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                searching:false,

                ajax: {
                    url: '{{ route('admin.artist_permit_reports.search_artist')}}',
                    method: 'post',
                    data:{filter_search:filter_search, search_artist:search_artist}
                },
                columns: [
                    {data: 'person_code',name:'person_code'},
                    {data: 'artist_name',name:'artist_name'},
                    {data: 'profession',name:'profession'},
                    {data: 'nationality',name:'nationality'},
                    {data: 'mobile_number',name:'mobile_number'},
                    {data: 'email',name:'email'},
                    {data: 'identification_number',name:'identification_number'},
                    {data: 'language_id',name:'language_id'},
                    {data: 'fax_number',name:'fax_number'},
                    {data: 'po_box',name:'po_box'},
                    {data: 'emirate_id',name:'emirate_id'},
                    {data: 'address_en',name:'address_en'},
                    {data: 'artist_id',name:'artist_id'},
                ],
            });
        }

        function ArtistResetTable() {
            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            table= $('#block-artist').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [6,7,8,9,10,11],
                        "visible": false,
                        "searchable": false
                    },

                ],
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',

                        title: function () {
                            return 'ARTISTS LIST';

                        },
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.bgColor = 'red';
                            doc.styles.title.fontSize = 12;
                            doc.content[1].table.marginTop=40;
                         doc.content[1].table.widths = [ '13%', '20%', '14%', '18%', '14%', '21%'];
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {

                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20],
                                }

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        },

                    },
                    {
                        extend: 'excel',

                        title: function () {
                            return  'ARTIST REPORT'; },
                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50 ],
                    [ '10 rows', '25 rows', '50 rows' ]
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                ajax: {
                    url: '{{ route('admin.artist_permit_reports.artist_reports')}}',
                    method: 'get',
                    data: function (d) {
                    }
                },

                columns: [
                    {data: 'person_code',name:'person_code'},
                    {data: 'artist_name',name:'artist_name'},
                    {data: 'profession',name:'profession'},
                    {data: 'nationality',name:'nationality'},
                    {data: 'mobile_number',name:'mobile_number'},
                    {data: 'email',name:'email'},
                    {data: 'identification_number',name:'identification_number'},
                    {data: 'language_id',name:'language_id'},
                    {data: 'fax_number',name:'fax_number'},
                    {data: 'po_box',name:'po_box'},
                    {data: 'emirate_id',name:'emirate_id'},
                    {data: 'address_en',name:'address_en'},
                    {data: 'artist_id',name:'artist_id'},

                ],
            });
        }

        $('#ArtistTableresetButton').click(function () {
            ArtistResetTable();
        })

        $('#Artist-report-tab').click(function () {
            ArtistResetTable();
        })



        $('.search_button').click(function(){
            var filter_search = $('#filter_search').val();
            var search_artist = $('#search_artist').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        });

        $('#search_by_status').change(function(){
            var filter_search = {{\App\ConstantValue::STATUS}};
            var search_artist = $('#search_by_status').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        });

        $('#search_by_gender').change(function(){
            var filter_search = {{\App\ConstantValue::GENDER}};
            var search_artist = $('#search_by_gender').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        });

        $('#search_by_visa').change(function(){
            var filter_search = '{{\App\ConstantValue::VISATYPE}}';
            var search_artist = $('#search_by_visa').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        });


        $('#search_by_profession').change(function(){

            var filter_search = {{\App\ConstantValue::PROFESSION}};
            var search_artist = $('#search_by_profession').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        });

        $('#search_by_nationality').change(function(){
            var filter_search = 5;
            var search_artist = $('#search_by_nationality').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        });

        function myTableRefresh()
        {
            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            table= $('#block-artist').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [6,7,8,9,10,11],
                        "visible": false,
                        "searchable": false
                    },

                ],
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',
                        title: function () { return 'ARTIST REPORT'; },
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.bgColor = 'red';
                            doc.styles.title.fontSize = 12;
                            doc.content[1].table.marginTop=40;
                         doc.content[1].table.widths = [ '13%', '20%', '14%', '18%', '14%', '21%'];
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {

                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20],
                                }

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        },
                    },
                    {
                        extend: 'excel',
                        title: function () {
                            if(filter_search==1){
                                return 'Artist List searched by Status '; }
                            if(filter_search==3){
                                return 'Artist List searched by Name '; }
                            if(filter_search ==4){
                                return 'Artist List searched by Profession'; }

                            if(filter_search==5){
                                return 'Artist List searched by Nationality '; }

                            if(filter_search==6){
                                return "Artist List searched by Artist Permit Count"; }
                        },

                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50  ],
                    [ '10 rows', '25 rows', '50 rows' ]
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                ajax: {
                    url: '{{ route('admin.artist_permit_reports.artist_reports')}}',
                    method: 'get',
                    data: function (d) {
                    }
                },

                columns: [
                    {data: 'person_code',name:'person_code'},
                    {data: 'artist_name',name:'artist_name'},
                    {data: 'profession',name:'profession'},
                    {data: 'nationality',name:'nationality'},
                    {data: 'mobile_number',name:'mobile_number'},
                    {data: 'email',name:'email'},
                    {data: 'identification_number',name:'identification_number'},
                    {data: 'language_id',name:'language_id'},
                    {data: 'fax_number',name:'fax_number'},
                    {data: 'po_box',name:'po_box'},
                    {data: 'emirate_id',name:'emirate_id'},
                    {data: 'address_en',name:'address_en'},
                    {data: 'artist_id',name:'artist_id'},

                ],

            });

        }

        //Event Report JS

        $('#event-report-tab').click(function () {
            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            table= $('#event-report').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [6,7,8,9,10,11],
                        "visible": false,
                        "searchable": false
                    },

                ],
                "searching":false,
                buttons: ['pageLength',
                    {

                        extend: 'pdf',

                        title: function () { return 'ALL EVENTS REPORT'; },
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header']=(function(page, pages) {
                                return {
                                    columns: [

                                        {
                                            alignment: 'right',
                                            text: [ '' ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });

                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'ALL EVENETS REPORT'; },
                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                ajax: {
                    url: '{{ route('admin.event_reports.event_report')}}',
                    method: 'get',
                    data: function (d) {

                    }
                },
                columns: [
                    {data: 'event_id',name:'event_id'},
                    {data: 'reference_number',name:'reference_number'},
                    {data: 'name_en',name:'name_en'},
                    {data: 'description_en',name:'description_en'},
                    {data: 'venue_en',name:'venue_en'},
                    {data: 'address',name:'address'},
                    {data: 'company_id',name:'company_id'},
                    {data: 'issued_date',name:'issued_date'},
                    {data: 'event_type_id',name:'event_type_id'},
                    {data: 'application_type',name:'application_type'},
                    {data: 'status',name:'status'},
                ],
            });
        });

        $('#reset-event-table').click(function () {
            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            table= $('#event-report').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [6,7,8,9,10,11],
                        "visible": false,
                        "searchable": false
                    },

                ],
                "searching":false,
                buttons: ['pageLength',
                    {

                        extend: 'pdf',
                        title: function () { return 'ALL EVENETS REPORT'; },

                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header']=(function(page, pages) {
                                return {
                                    columns: [

                                        {
                                            alignment: 'right',
                                            text: [ '' ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });

                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATkAAADcCAYAAAALH9Z0AAAACXBIWXMAACHUAAAh1AHW21Z5AAAoF0lEQVR4Xu2dC5QkV3nfWwKEBHqgXa32NdP1mJF2t7uqhqAEC4WHA7YBGx+OjRWiQKxYCYtZeZB2p6uqV9haTE44MeSYKOBYTmRjCBCvkHYegIlFMNjIOEY5YCc8bMWxjIl5mqCZ2RXSArupr+a7rdu37q2+tx79mu93znem7vf973dv3er5uvpV1SCIOji95pzfsuZz0KWEaTeWZx9HF0EQxPgCBQs3G+ur1ldOr9pfxGYG0H53dWYetteX7XPra/YP0gBBEMQ4AoXqb99/6VXYTHn01K45WfHiiyEDfOvLTTqjIwhi/Fhfds4lZ20xNvsQC1pSyG7Y/MDVu7HZB2g3Vu3/gU2CIIjh8OjJy3dAAWKG7h4yH0OMPb7SbD3y7sbF2Ozj9IodivrNVfvv2Lhgqr4EQRCFgeLCXnayYpMGELHNI8a+s9p0cDPD5pp9jyw32MaadYRtY4ggCKI8YmFZX7WuFwtNXuERY5sr1j24mWFz2XowL/fGmv0YtOlDCoIgKuE79zdfDEXl2x+cbaOrcX6t8QzwnflQ8xf4l5IYlrKx0vzFjRXnvWCnP2w9G90Zzp9oXMjyga0v298Vc7MYNgmCIIqjKiibK/an09iK/W/RVRnn7208ZXO1+Sds7NPL9pcwlAIvd1XzIgiCMGJciwkVOYIgKoGKHEEQUw0VOYIgphooJJur9l9iU8nGmn0nfOLJis/62uwT62vW8zBcOVTkCIKoBCgkG8v2R7GZcvpD1rtYkWG2sdY8i+GhwMbFJkEQRDGgkGyuWkusqIiWVJkLUDpU2PjYJAiCMGdzbfYoX9B4g++zoWwksHlgkyAIwpzTa7N/zhc2sPVV+3MYHilsPtgkCIIwhy9uYOsfbN6AoZHD5oRNgiAIc/gCd2bF/l10jwVsXufvbVyELoIgCDP4IoeusaE3t1P7XoEugiAIM1gh+dbKzsvQNTasrzbPpvMTftdKEAShDSty2BwrTq/Ovn+c50cQxAQwzkVkY2Xmp6jIEQRRinEuIuc/0XgqFTmCIAqTVI4Lqioi4i8m0F2aqvMRBLGNOP/uxsVVFJGH72o8neXhDcOlqDIXQRDbDPhRfhVFhOWQGUoKU1UegiC2IayArC/bX0OXMRsrzRMsDzMMpfnPrFql7q8q5iQIgtCGFZDTy9Y70WVMLwcaunvIfCao8hIEQQyEFZDTa/tfji5jnswhL0YynwmqvARBEANhBeTeextPQZcxLAczdPfYWLX+HW4WQpWXIAhiIFUUEJZDlavsNel6ue+19qCLIAhCD1VhMqFXhCrIJWNz1VqDvJvLzZegiyAIQo8qChPLUUUuGRsrzRbkTYrcCroIgiD0qKIwsRxV5FJRZ26CIKaU0x+29lRRPFiOKnKpqDM3QRBTyukPzd5cRfFgOarIpaLO3ARBTCkbp+wzVRQPlqOKXCrqzE0QxJRSVWHi85TNpaLO3ARBTClVFSY+T9lcKurMTRDElMIKx+aqtYquQrA8zDbWrJ/HUGWsL1vfg9zYJAiCGAwrSmeWm9ehqxBn1uy35tqqdTtKC7O52rybihxBEEawInfud3dcjq6xhoocQRBGsCKHzbEnne9qk+6/ShCEHpNY5DZWmr+HTYIgCDWbK9ZbJrHITdJ8CYIYIaxgUJEjCGIqYQVjc9k+ja6xZ3N1f0BFjiCIgWwsW5+Z1LMimPPGqvUGbBIEQWRhBW5Si9wkzpsgiCGxvmZ/f9ILBRU5giCkJJXhAlbgJrlQwPuIVOgIgsgwgQXuwm7TvzJyvdfHVvCV7tzC+SKW9P+1JTe4+vDevc/AvARBTBt8gXv01MxN6B45i/vnZ7pu8DVZcRqmRba/HrtBF6dFEMQksXFq9st8kUP30Ild76dkBSbPYtd/61Kz1cIUfWwuz766iv0Jbe9FsePfLRsfrGP570QpQRDjxuZq87dGVeAiu/1SWdEQLSkwd2EXYzaX7fuHsV9dJ3gbP+fQ8m7BEEEQo+LMyuxtwy5w8VzwEF8MMuYGD6C0Mk6vWQ+sL9vnsDlUkjPNd8ZzC+dCO3gXugiCGAabK83/MKwCF9nBR6QFLbGO1f4mymrlzLLzKvh6DDZHStf11nCTIIg6OLNqf3EYBU5W1MAid+H1KBkq51Z2XpYUuh9gkyCIaWR91f5BnQUutFo3yQpb1/Y+jpKRU2dhJwhihPDFrep/9DB5CSYrbhgeO6jQEcSUUVeBi+3g8UkqbjyPfWxvEzcJgphUHl2zP99f4JrvwFApQif4O7GwxXPtb2CYIAiifvqLWzVnb7EVbGSKmxU8hGGCIIj62Vyz7+GL2/qyU/o7YqEbfJ2KG0EQI4cvbmDnTjYuwVAhwjnvjFjcum7w5xgmCIIYDqfXrE2xwGGoELETLIvFLXL8UxgmCIIYDpur1psrLW6W1xWLG/w4HcMEQRDD4fEP7b9GLG6bK86PYNiYjhW8TCxuHdd/K4YJgiCGw7mTM5dkittacwXDxoSzs/vE4hbNLrQxTBAEMRw2Tu7ZlSluq83/jmFjbt+90BaLW+y6V2CYIAhiOGysWG8Xi9vGin0Cw8ZEjv9PxeKGIYIgiOEhFjawb92z8zIMGxO6XswXtsjx3oMhgiCI4XBmee912eLW3MBwITrcz69iNxjJhSMJgtjmZAubcx6ufYbhQsSu931W3Bb3zO9CN0EQRP089uE9lqywwddCUFKIGxuNi1hhC2cP7EM3QdRC7LTfzB5vYOgmtiun1+wHs4XN/jyGS9F1vfs6Lt0xihgeXeFCDbHjvxdDxHbgsfvkZ2qnl62HUUIQEw2duW0ToJhtrjY3ZAVtc2X2V87f23gKSgliqqAiRxDE1BK6/lf5l6rMMEwQBDGZ3NE8uFdW3MCSwvcZlBEEQUwmYdN/CW4SBEEQBEEQBEGMK92mfx28F3N05pr96NKm22y/gr2Xgy5iAjnRaFxIx5GYatgD3ORBzvcx6UeMFx3He4SOIzH1RLPej5o80CPH/wKv1+lDjB9HZ1o76DgS2wb+gT7oKie8lhmGiAmCjiOxrTB5sIvaQXpiPJno48hPOrba30B3n//WfQd3opuYIOJm8GLcrBT+sQEWu97fYiiDqAXDEDFBTPRxlE08coOPyfzE5MAfu/jKau/jwOdmhqEMJlpifJno4yibeNdu/5jMT0wGcGZV5/ETc+flN9ES48tEH8fI8d8km3TSPjdxO0OkhI7/Anbs6jiGYu68/CZaYnyh40iMHbEbfA0eiHXc40F8sINhKIOJlhhfttVxnIYdZPuwZLV/GF2EAWz9eMNQBhMtMb5sq+PI7+Ti/vkZdE8U/D6AoZvQRFy/vDU00RLjy7Y6jtOwo+I+TOp+jAqT9TPREuPLtjqO4o7GcwsTd19PcR/AMERoYLJ+JlpifNlWx3EadnYa9mGUmKyfiZbIEjXbN8CaRdbC/0JXLiZrXETLG4YmC/gkTrYzYJHjvQc0sljaeYiEtvc92TwGWdhsvwL6y2IndsxfniafMPKOWZ6FjvdZTGGMLB+GMphoiSysyOmuXVHtkcauS9Ethdcyw9BYETnBp6Vzi6zguLgDYLG79U350PZDWZxZmqRmYtt/oWxssNhu/2zHOvg8Wey44+2G/l0nuFYWZzaJRU62H6aGqYwwyWOiJbKIRW7Q+g1LO0g/Ai7ozc0O/gh9WxydmbmEnzjY7Vdf42K4D1HHDMO1IRsTDMON2yU32+i47Ucw3EecLICoBcsrckmBfeWRXa3cZ7phI9sHsOSZ7G0oySDTg2FYG5McJloiS9kiF7n+zRjKIGrBMJTBRDtsuvsO7sydFx9UijhM9WWRjRe6wQ8wnCLTYEiKTJ9X5CLX+zmmu7HRugjdI4WfOzMM5VK0H49JDhMtkUVW5LqO/8sYzpDRJoahDHVph83AeYkCqYjDVF+GyG3/tM54OhoemV63yIGhe6Tw8zGZV9T0Xyfpd8FWVA+xP+aQYqIlssiKXOwGf4zhDKIWDEMZ6tIOE3FOseXfhaEnEUVgGJJiqi+D7li6OoZMb1LkwDA0MsT56M5pqdlqif3guv0Y1kLsD4ahDCZaIgsVuXy05iSKlELEVF+Urr1wWHcsXR1Dpp/0Ihc6wQqGcqEiN1lQkVNzy84Dl2nNSRQphYipviiycZJ/xqdiuA+ZFkNSZHrTIre4Z34XhkeCOB90D4SK3GRBRU5N5Hj/SmtOokgpREz1RTEZx0QLyPSmRe647b0IwyOBn0vs+u9D90CoyE0WVOTUaF/cVxQphYipvgiyMWLXewzDGWR6DEmR6Se2yBlemp6K3GRBRU7N1BU5DEmpQj9pRa4oVOQmCypyaia2yMnyJ1bpbe9keipy+oj9wTCUwURLZAmTx5m4flTktpiqIochJaZ9ZHoqcvqI/cEwlMFES2SJXP/l4vp1LO9TGM4gasEwlKEu7bCYyCInyx073n/FsBJZPwxJkempyOkj9gfDUAZRF7v+X2OI0CB2gmVxDY/ssvZguI/ICX5D1IJhOENd2mExcUUucvwvFM1t2k+m3zZFbrd7tbgvwyxyt+zceRmGCA3E9QPDUAaZNrIOXo/hPmRaMAxnEHWh5f9vDI2MiSpyR2eu2V8mr2lfmX7xUvX33mRFjl22aRIR9yVutoxuQi32B8NQBl0dIUdcP9UawktYXe1t1sKzdLUME+2wmJgiF+9vL5TNadpfpu/Y3jcxnKHr+KdEfex638fwxBHbXizuD4YGEtuHspe8avpXYriPruX1Xf4qtP1fxBChwWJj/un8+oEtNhpPx3CPjhP8tqgDi+bamQttHtt77VUyLRhKpPA68QIZo4KfEzMMZdEVijpm8Vyx297BYom5iizg4UbjaWKeaM57GMN9JC+LMwWLGUoyyLRgGJ5IOlbwZX5fYse7BUO58H2YYShDRzi+6CY04dcOLLSDJzDUQ9TwhpIecc4FVlEiJW62X6WrHRah472GnxNYZPsPYjhL1/JvEjskxeZLGG6Eswf2iXGZoTyXOHk2l/UFu7HReArKjEnOtj4hy4nhFFlctOSBcCfKU6Qay3+Ibd/csC5G6cQB6923X3b7LIYyxHbwDl7LDMNSmCZ5LH0XXYQGsePfyq8xWPK4/GTiv0v0q2zJDTLvvaoMh1Vioh0GsiuDa3+gJXaUGUpT8k59dS35B/g6pqsE2Rgyg4uFpnrHk14VWWXpIAmR03quLL5dDJdBSWy1z+rodEn+yd8nzmE7WLLf38Yl6JH4/lCmBUNJj+SkQnlVb3bl7zwix/sJ0B5uXPc0dCkR8w/LcHiCIAiCIAiCIAiCIAiCIAiCIAhirIBLjNMnOgRBTC38x9ZU6AhizInc4AT+oxrdjm67csw5mLkDP4bGGvbToCX7kIWuSoCc8NtBbBJEYUK7/Wr8fzK6UIQW7J8VByAGwK9X7Pon0T32xNzPedBVmjc6zm6W83iyjW6CKAR7LFX5GE1J/lE/V1vyKSWy2odwc6Ko4zjzOTu7WtJrnOmwtL/9w3wusMjxfwfDxDYgdvx/yR9/dJdH/GF77HrfwRAxQpKXgffyv8+DH9NjqDD8cQZDdynK5pRdoEE0lBLbAP64V3qVHz4xGLoziLpBht2mijr3L7YO2Hx+laHcGEme0u/FijnDOf0ryIh9mUVW8DcoyQDX9VvavfuZ2CSmDPGxgO7yiIlju30bhoyAWwaKuTA0FRzfM7+rrv0LreAJMTdY2Az6LszJ/Mcd/1Z0acPnZYahwhTNKeune4ktpo8d77+gi5gS+McDWGRlr4dXCDExGIaMqTLXuHH7VQf31rFvsR08LuZV5ebjHcV1/lXwfZlhqDBFcsr6hK53BsNa8H3RNdHw+zMt+1QEcR0qW4sqE8e2n7lqLIamAn6/TO+LIGNxx47L+ZzMMJxBVydD7GvaX4ZpzuTx8UrTPjLK9h83pm1/iiKuQ2VrUWXirh38kJgrdvy3YJgQENcKDENSRG3oBO/A0EDEvmAYKoxpTlO9CkmO6r9fNUQk+7MtEdehsrWoMrGsyEWO/28wTHCE+w9dI64VGIalmOp5yvRVYZrTVK+iqjzjwtGZ1g62H3AVbnRvO/jjyQxD5agycZ1FjuXD5sTDr5HuvhXpwyjTV4VJThPtIKrMVRY2fplL9087sD4d2/seNpWwteQNQ+WoMvEwihxY8sw3j+6Jhd8fZhhSUqQPo0xfFSY5TbSDqDJXWfg5hE7b6AOU7QK/Ri9qNJ6K7gy8jhmGylFl4mEVOTB0TyRd2/u4uD8dq/0GDCsR+4BhaCBl+qrQzQl3cxN1YfPgczBsjJgLDENDR5wH3PEeQwQirhG6M4i6PK0RVSYeZpEDw9DEUXRfivYDyvRVoZtTV6dL1fnKME5zGVd010hXZ0yVianI6VF0X4r2A8r0VaGTs+t6j4iaJaf1MxguhJgPDENDZxhzidzgV1luuNUgulNO7Gpdyo/NW/Lyue/L5IBMl5oTrKCkcmTjYagPXZ0xVSYuUuQ6zrWB2Ec00Kn8VXGi0bpINgYYSipBlv+Oqw7uxTD8UPm9zI+uHnwflUZFmb4qdHLqaExR5Yzd4AFZrGeW/6Y0gQbiPWllBjqVX5fkpfzPQp8TOe9VAbIbdfPtPDPRLs3514Feh8j2I1kOZnD1G9DJYmkCAZVO5uctkeT/RFHRqRBh079RzJX3qZOoBQvtdpiE0klHln+9TMMMNGXpzB18niy3aCgvzaDcJjExnkeZvioG5RwUL4osL7OlZqu1tDt4JpjqvsCYRonsVyhwf2C4oAXEj85cs1+M85Ym0YQVOTC4KAO6pfBjgKG7B9xhX9QwQ0mPyPV/U6YDgxvAo0yJrN+x5qGXYLgRuq3MDet5Q1kfMl3Pmv6V7Lh29mdPjJK1+yamySKKwTBkjEmuslowDBcmeSn1qCxv8iDfQEml3NHM/jQMDMMpJjExnkeZvirycubFyiLLDYbhDN392VcYGMrQcf0/1dXGrnenqM3Ty+CLHFjo+F/FUAZexwxDfch0YBjuQ6YDw7AUE71MC4bhPmS6vN8oZ7XtN2OoH1EIhiEjZHngmRTDGURt6Pq9ZwEZoh4MQ4XoOv7dspx1XuVCNl7i7jvV5mOx5T2M7hQ+xgxDAynTV4Usp8xQXhlFxhD1N1vWxRjqQ9SBYUiKqV5ELHJ5/WPr0N/T1Yo6sMhp/waG+5BpwTDcR7jzwGWijp3hqhD1YBjqQ1fHo6UXRVUZppcSu/4XTfSAqNfpk4cs321XWM/CcC3IxsSQFmX6l+mrQpaziC3umL8cU2ohy4EhJbp9dHUMU72ISZEDRK1K3zH8nbCutsjVhkS9qo+ujkdLL4pUpnspHB3gqhNifgwpEfU6fVTIcsW2dxbDtZCcdi+JY3asnPcRJIj9wTA0kDJ9VZTJKfaLreBxDA1E7AuGISU6feDsTkfHY6oXkRW52A4WMZxB1IJhKEMdWl0dj24fXR2Pll4UMaHMDxY63mfTjiUYxyKHodqoYswyOcr0VVE2p9g3OcOHD50GIvYDw5ASnT5U5PrtNiv7ykamw5AS3T66Oh4tvSjihfATDFkcDCWFGGWRC23vXWKe2A3+DMO1IY4JhiFtyuQo01dF2ZzJS5/MBz8YykXso9NPpw8VOcH2HdyJ4R4yHYaU6PbR1fFo6UWRTCjTgGHYmFEWuarymBA5wafFMUM7eD+GtRFzgGFoIGX6qiibM3SD/1ekv9hHp59OHypygm2nIgfIdGAYNmKERe7CivIYUdWYZfKU6auibE4qclTkeHR1PFp6UaQUJsi08Zz/EIa1GVWRk+UY9PF3FcjGxZARZfKU6auibE4qclTkeHR1PFp6UaQUJsSOf9JEr2KcihyGagNurSaO2Wm2/yGGjRDzgGFoIGX6qiibs2iRixz/l037iXpZHypygm3HIgfI9GAY1mIURU7WHwzDtVHlmGVylemromzOokUOMO0n6mV9xqXIhU3vNRjOIGrBMJShrHbYRe6NjrNbR8ejpRdFSiFHkT4841LkMFQb4eyhF1Q5bplcZfqqKJuzTJEDTPrxWlWfcSlyGJIiavP0ZbXDLnJAZPvrOjoGr1XqRZFSyCHrk7yU/X0MD2TYRS6222fL9C+KYszCN3VW5NOiTF8VZXOWLXKAbj9+DFUfKnKCjaDIAYvz80/X0QF8TqVeFCmFAkX7AaEdbJr2FfU6fRiyvkd27boUw7UhGxdDhSiTr0xfFWVzVlHkdBHHkY2lurwShqWY6kUi17/ZpL+ozdOX1d7cyP6+V6bDkJIifXTRyiuKdM/IxH5gkeN9FMO5hE3/OWJfuHsVhqWIejAM5SLrB4bh2pCNGbv+SQwXIraD/ybmxNBAxH4mfVWUzTluRQ7Q1TFk+s5M8DIMD0Tsi24loj6vTx3a0PE/oaPjEfU6fXTRyqslUiD2Nelv0jd2g2/L9GAokSLTg2G4Vuoat0hO2Y+qq7i7lJgztgKjrxPBNcDEHBiqHHEc1Vi6OmCx8eTLKtFQMhC+j85JAq8HQ7cUUXucu96biKiNrbbyt9yiFgxDGeAaeTL9rZKXwkUQ86K7n4GCHPi+zJJnZ60f8ke2/6CsP4Z7QD6Zjrdo9lAb5Y14zluUaZihrFbgx+Z1jX3Yda8wyQkXHuD1YJHjfwHDpRDzolub5Mnrk2Vz6CKOkzOW9Avji3vmd2E8BdaQj8u+KhS6/n9GeYakiHyD1yb5TmEoF75Pp+m9Ft1SeC0YuqWYaENLfnFODPeQaXiL7OAjKC2MmBPd/eQGNeAHYLbktP8BhnMJbf+ArL/UrODL2A2u6PFaqSbH8r57VDWy8TFUGbIxdOzozMwlmKI0LGds+/egyxh+bmDorhxxnEFjyfQqwy65l9DPM+yuhUkfpo2s9iF0KWHa2Anega5cuk72KuAq44uZLI6hQlSZSwlcm14cCCzv/orTjGwtujVfxmmSEdfq2L72LIYqRRwHDEPEBDO0Y5o8k79VHAysyrOGSUC2BmAYJiRErn87v1aR7f0ShiqFH4MZhogJZqjHNLJbrxMHBKv7YpTjgmzfwTBM5DCsNRvWOMTwGMkxFQflDd6sjRzvGEonmng2eH6yP78j209mKCU0GMa6dSzvU8MYhxguIzmmg+5ZmUgKf+t/XJDtFzOUEAWA9YOf9mCzcuBb/HScpo+u7X2ejilBEARBEARBEARBEARBEARBEARBEARBEARBEARBEARBEARBEARBEMR4AZdFil33CtgOXe/HUyexLYDLHeFmo0vHfuIIHf8IbsKVtH8eNwvBftdbxeXxxw7+R8v89qgZp7mMkshpPVdchyrWJbbbC5CnMzs/R2utpqq1gRyh7R9e2h08s6q1Tufmth+JHO89ZXJWNR/CkPQA0uKniOtA6zI8kjOk78ZucA6bhYFjdts+/wDbTp1jAj2eRkTotI/Q4m8hrgOtC1EFcJOepIA/AI8n+Jtuu96jGJ5OYGfH5R+oY7d/jP6ZtxDXoY51obWebOD4wcVcsUnwdJzgVbBAvGGocvgx4Gqt6JZSpsjBbQ9xsxZi238lbg4FcR2KrosIvAxjx6OqnIzObHsusvyXY3OiiV3vg7hZCUu73as7bvBObBYG7mTHH78yRQ5u8n7c8V+ATWO6jv8juDkUYsd/S/L4/VonWYPQ9dQfusDCHHOCa7HZCF3/pqof7AwxLzsw2MxQtMgNyqsieYD8emQHf4PNlDuuOrhXlqtI/jKI45UdP7bbZ6HAYTOl6n2CfHUWOdkNnjFUKXXkhnyRG/waNo0JHf9ucU5pzhJFDvqXKnIVr5EKGKcrfJIcuf5vpn5xDuBIquGt2ExJitxL6pqsLC/4VDelLlrk2E2VsakN9BGLXDTXvkE1b9wcCuJ4ZcZfbDTS4oDNHlXvE+Srq8jBDZ0j2/vH2Eypev6MyAlWa1mbEkVONp805zYocoyuu3Aaxjw26/0outI59M1DNqnjzVarrslGVvuf4GYPdk8IKGjo6lH4TM4N/rhQv6TPdihy0Dd5MvsMNntUvU+Qr44it9T0r5PNter5M+CtiVrWpmCRi932X6n2fzsUueOOF4S29z1swvG5P7L992Gzfx6ySd12xcKzhjVZRmwFj8vGpCL3JOJ4ZcaHvnFydoLNHlXvE+Sro8hBXtkXVqueP2Pcilzoemdk80lzbpOXq7jZg/f1xVWTGtZkeWBMvjoDVOSeRByvzPjQdxj7BPnqKnK42UfV82eMW5HruMGfyuaT5qQi1x+HxqAOw6Ljeo+I47Jv5GNTm05SLIv0gz7dueAhbKYkD8SPyXIVyV8Gcbwy459oNC5U7VPY9F6DzdJAvtjxP4fNysC5Z25tWWZN8kgKx6erzg35xPcUTYD+hxuNp2EzBXzJS9nvYNOYtL/j/z42jal6jVTIxuF9mTg4eItt71vp3wq+4W0KjBu53uuxmbI1F/0vJybzv5PtS+gu/AW6B9K1vY+nfXYeuIx9EBI5wdu2xm89H/7eYbWe/TJ8055Z2rlmZGOVHZvdq1JmS81rHZQVhr2kSvPZ/gvRXRp+nujqofKXgZ3FgcE+obsUqvfUTAgd7zVsXj3DE4Xk5OA2lGmTnHGvszzJq5mXolub3hwSQ1dtbM1xIVMncLNvO5ek2NzHJj1Mk33SGrv+52RamcVz7V5BZKf1OhY6wf/BbinJPP4gtBeeeEOzeSW6GsnB74A2+fuvoR3a7VeLeeow8RNwAPy4WSnHLe8gvG0gzsHUkifJP4R8Jxqti5J/6vRTsCosKTr3xHtbzXR7tvV8GIN9eAXbXefgtby+rMFPupIz36dC7mSfPinTmFrypP0nkK8OXpTMFc7mZOPm29Z3Vg83rntaaAebco3aksfoXdD/Dst/uSw+bIO5EMREw77qBBa5wX9CN0EQBEEQEwn8vIN9OgvP7rET/HYaIIZKemZlLfwc206dxNTCjvGJXa1L6XjXDCwwW2R+mxgu4nG4dfbAvjRATCVwjGPbf+FxdyGi/zmCIAiCIAiCIAiCIAiCIAiCIAiCIAiCIAiCIAiCGCLsS5uDDOXjwgU4p8xldsYJcQ2ZRbb3SygZe2LX/+cwZ2wSNTOKtWaPS2yOhNj1HhvaHLZ2eLzvt9htXuPCPBd3zF+OrrEE5niHs/AT2EzpusEXt9Y4KXZzwbvRPbZQkRsMO57YLEX6uHD8U9isjLw5Vjn/oqjmUMvctpJO+U1lhwSspVjkGPHcQnoLwNjxxvq3tVTkBrP1P1N+jdjl/+tY77y8dY1ZBbXMbSupwcUp4W7bVrX3oixLZ78XwHXMYidYQlcuseteAfpQuORzPL/w2o618Cm4gi66jIC1VBU5QPcARo730a7r3YfNylhqBk56bTQnOI6uDDpF7vjV3m64kiy7lpgu0CdyvWR59Uiv42d7H8dmj+TM597jbvZeFTKSJ5VfgXGP7Gpdiq6BhJa3FjrBCjYz6B7HQWCO9GrNUbN9w5a3GvLmKMaS9XwTrBE2cwlnvb+fvDr5gyjnMVSGvHkXZivp4CLHBk8W482xHfxR3mRUsUH+kLu6L4Z6yHwA08dzT94sGS6fjuEeqV9xEUcW7zPH+2za0QDol1fkIuvg9aCJ3OBX0dUHGxsuIMq2wTDcQ+UHZH646jHrE7r+V9l2ciaRebIaVORY38huJwUo2Ei3He//YrgPpmXGj31jo3ERynq80fF2Qwy2mY5Zsmb3Jo+99J6jvKUdJcBFL3s6nKdKz2JJUc1cNLJjtV6GshQxDoYhI5LHYu89KZ08Ko3Mz3y8YSiF+W7dd3AnrwFL1u3rKOsjmvF9poltbxFuDQnbyZp9ACV9MC1vGErJ8/GGoeQJr/1SaMNjGV09RG2GLUF+kVMlAZ94ZV0gT5/n7zr+SXRlkPVjC43NHnljYDOF/0dAV4rMpwP0yStygCp3nl+80U+eNnbaf4XNHmkO4cF7ZJe1B/xwRVl0peQVuTSPMJdj++Zm0Z+k6gf8slwqPytycFzRlcL0seUfRVcK+OAJAZs94DEpy8/yYLMH858Q3vMdpMdmIaD/UeeAD9tLeDvQxT3zu9KgBNWYpn6AxeBKwuhKGdQneZLpu28HnAGC/2hj5hJ09cjLBajief3y+uCmnK2O6iK3tOeQBZobG63MM2/eoFX4eYr2Y4AOzuSwmXJ4795nlM3LA33KFDnc7INdkhqbPcCnc5PlxJee4WKzD/CLMVWR61rewyZ5AJU/tNr/SObnz+R4VHnAl7z8ztyTBPywbtjsA2LXSW4Eo8pv4tcF3pcV+w/KqYqb+gHTPh18ZYHNPkxzMYr0C932X4ixrhV8RaXvsZVUXeTyBo1t/35ZTNXH1M8ji8N7a6xvMpffQreUVCMUucX5eekd5ZN/kCdk/kFAnyJFroPjRXPBBzJmBx+RzUXMA8/KeTpZbjEHoCxyEi1DFRvUJ05eRmIzpUiRU/nhXiWqfU7OQH4dpSl5eUz8ukDfZJ3fjs0UePzm5VSNaeoHVLHI3rqpDTZ7FMmV1wco0y8pdr0bC0H76ExrBzblbCUtVuQi179dFlP1MfXz5MVZ/7w84B+XIhfb7bPYTAFf6neDO1WG0h5L9tYZNjbTHLjZh2nuYRa5rh08js2UKoocO6ay/eyZ5d2C8hST/IDKr0PyP3Mz668ylPahipn6AVVsUooci3dd/6Y8bY+tTpN5JifC3zYQXT3AN+oiB3FZ3tj2zhYdD4y9KYvuPpgGmwMZZpGDDyKwmVLpmZztvw6bAymSX+bXIe2bvMQK54J/Jlpstb+hyqsa09QPqGKTUOQAiHdm23PwN3aCZXSr2Uqa855cs/Vi0EBBQFePrb76EzX18wyKM0LLW1KNMcoiB2/wQ7zj+Jk3yhPSW+vBG7nY7qPrBG/DzT5iy38A+oHBBwno7oPFsZkhKWp/jZspqiKXnAEZvbcHKP22f1jmr7LIyfwMuJUhbqaY5lH5B9HFTzOxKcV0TFM/oIpNUpHT0fXYEquLHKBKCL6O1fqf2OyRpzfx86j64WaP5KVIepNsbPYA36iKXOgGX4JYXk5VHL52AgUGmxkG5QVUGrhp8rF97VlspqiKHAB+8ZNP+EQQ/LftO3AAXT1U46r8VRU5dkaUnCl+Bl09TPKY+geh00+lqcoPqGKqIgeAP3kS/gI2U+CrJOBn96flUY3BUMWTV4d/mdcPuL3pp7+AGqTrsSXOL3IASxo7/tuTf7o/GzQIi8sMJT1Ufh5ZHH7mxfp28eskqdn+zSjpAf5hFDmVJU8Gz0aZElk/MAxLgXjy4HwQm1JYIRJNfLkI5BY57sEFv8dNXmKlX8FJCp/0pslMu6V58nuMYCjpo6oiB3TstvRG2RjuQxVT+eHL4uCHgp/84/v8jc3zkOWSkea2+t+vZDfSVhnKekRO67ngh+8wRpZ/ffJE+y4MKfcrr8ix99/BkifHOPm79Qsey+uipA+mxWaGnHi6tmDR7KF28j8rXdu83KVIDy58auV4v4CuXELbPxDbC/cnm7X+sP7Y3NwsfGK2ZAc/hK6JJna8/xg5C/8em5VxwrIuTp6kTibH5TC6CpF+6OH4p5ac9k+iSwr/QF7aHTwzdPy7i/6apCiRE/wLeMya/OJBF/gi7JIbeNgcCl07eLXqC7gykiej+6r8zXfoHHoBvA8Gv3xAVy0kT7bvu0MxBv+4IoiRQg9Gog7oMUWMDVTkiKqBx1Pyqu33sEkQo4WKHFEV7Co+S81rHXRJaDT+P45xHH1Cc2DhAAAAAElFTkSuQmCC\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'ALL EVENTS REPORT' },
                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },

                serverSide: true,
                footer: true,
                ajax: {
                    url: '{{ route('admin.event_reports.event_report')}}',
                    method: 'get',
                    data: function (d) {

                    }
                },

                columns: [
                    {data: 'event_id',name:'event_id'},
                    {data: 'reference_number',name:'reference_number'},
                    {data: 'name_en',name:'name_en'},
                    {data: 'description_en',name:'description_en'},
                    {data: 'venue_en',name:'venue_en'},
                    {data: 'address',name:'address'},
                    {data: 'company_id',name:'company_id'},
                    {data: 'issued_date',name:'issued_date'},
                    {data: 'event_type_id',name:'event_type_id'},
                    {data: 'application_type',name:'application_type'},
                    {data: 'status',name:'status'},


                ],
            });

        })

        $('#application-type').change(function () {

            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            var application_type= $('#application-type').val();
            table= $('#event-report').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [6,7,8,9,10,11],
                        "visible": false,
                        "searchable": false
                    },

                ],
                "searching":false,
                buttons: ['pageLength',
                    {

                        extend: 'pdf',
                        title: function () { return 'EVENTS SEARCHED BY APPLICATION-TYPE'; },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header']=(function(page, pages) {
                                return {
                                    columns: [

                                        {
                                            alignment: 'right',
                                            text: [ '' ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });

                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'ALL EVENTS REPORT' },
                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                ajax: {
                    url: '{{ route('admin.event_reports.application_type')}}',
                    method: 'get',
                    data:{application_type:application_type}
                },
                columns: [
                    {data: 'event_id',name:'event_id'},
                    {data: 'reference_number',name:'reference_number'},
                    {data: 'name_en',name:'name_en'},
                    {data: 'description_en',name:'description_en'},
                    {data: 'venue_en',name:'venue_en'},
                    {data: 'address',name:'address'},
                    {data: 'company_id',name:'company_id'},
                    {data: 'issued_date',name:'issued_date'},
                    {data: 'event_type_id',name:'event_type_id'},
                    {data: 'application_type',name:'application_type'},
                    {data: 'status',name:'status'},



                ],
            });

        });


        $('#single_permit_type_click').click(function () {
            var filter_search ={{\App\ConstantValue::NUMBER_OF_PERMIT}};
            var search_artist = $('#single_permit_type_input').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        })

        $('#multiple_permit_type_click').click(function () {
            var filter_search ={{\App\ConstantValue::NUMBER_OF_PERMIT}};
            var search_artist = $('#multiple_permit_type_input').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();

                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        })

        $('#all_permit_type_click').click(function () {
            var filter_search ={{\App\ConstantValue::NUMBER_OF_PERMIT}};
            var search_artist = $('#all_permit_type_input').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        })

        $('#search_by_age').change(function () {
            var filter_search ={{\App\ConstantValue::AGE}};
            var search_artist = $('#search_by_age').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        })

        $('#search_by_area').change(function () {
            var filter_search ={{\App\ConstantValue::AREA}};
            var search_artist = $('#search_by_area').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Please Select Filter Option');
            }
        })


        // Applied Date
        $('#applied-date').change(function () {
            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            var applied_date=$('#applied-date').val();
            table= $('#event-report').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [6,7,8,9,10,11],
                        "visible": false,
                        "searchable": false
                    },

                ],
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',

                        title: function () { return 'Event Report'; },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });


                            doc['header']=(function(page, pages) {

                                return {

                                    columns: [
                                        ,
                                        {
                                            alignment: 'right',
                                            text: [  ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }

                            });

                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'EVENT REPORT'; },
                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                ajax: {
                    url: '{{ route('admin.event_reports.applied_date')}}',
                    method: 'get',
                    data:{applied_date:applied_date}
                },
                columns: [
                    {data: 'event_id',name:'event_id'},
                    {data: 'reference_number',name:'reference_number'},
                    {data: 'name_en',name:'name_en'},
                    {data: 'description_en',name:'description_en'},
                    {data: 'venue_en',name:'venue_en'},
                    {data: 'address',name:'address'},
                    {data: 'company_id',name:'company_id'},
                    {data: 'issued_date',name:'issued_date'},
                    {data: 'event_type_id',name:'event_type_id'},
                    {data: 'application_type',name:'application_type'},
                    {data: 'status',name:'status'},



                ],
            });

        })

        //status

        $('#status').change(function () {
            var status=$('#status').val();
            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            table= $('#event-report').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [6,7,8,9,10,11],
                        "visible": false,
                        "searchable": false
                    },

                ],
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',

                        title: function () { return 'Event Report'; },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header']=(function(page, pages) {
                                return {
                                    columns: [

                                        {
                                            alignment: 'right',
                                            text: [ '' ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'EVENT REPORT'; },
                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                ajax: {
                    url: '{{ route('admin.event_reports.status')}}',
                    method: 'post',
                    data:{status:status}
                },
                columns: [
                    {data: 'event_id',name:'event_id'},
                    {data: 'reference_number',name:'reference_number'},
                    {data: 'name_en',name:'name_en'},
                    {data: 'description_en',name:'description_en'},
                    {data: 'venue_en',name:'venue_en'},
                    {data: 'address',name:'address'},
                    {data: 'company_id',name:'company_id'},
                    {data: 'issued_date',name:'issued_date'},
                    {data: 'event_type_id',name:'event_type_id'},
                    {data: 'application_type',name:'application_type'},
                    {data: 'status',name:'status'},

                ],
            });
        })
        var artistPermit = {};
        var pendingPermit = {};
        var processingPermit = {};
        var activePermit = {};
        var archivePermit = {};
        var active_artist_table = {};

        var hash = window.location.hash;

        $(document).ready(function () {
            $("#kt_page_portlet > div > section > div:nth-child(1) > div").click(function(){
                $('.nav-tabs a[href="#new-request"]').tab('show');
            });
            $("#kt_page_portlet > div > section > div:nth-child(2) > div").click(function(){
                $('.nav-tabs a[href="#pending-request"]').tab('show');
            });
            //   $("#kt_page_portlet > div > section > div:nth-child(3) > div").click(function(){
            //  $('.nav-tabs a[href="#new-request"]').tab('show');
            // });
            // Instantiate the Bloodhound suggestion engine
            var result = new Bloodhound({
                datumTokenizer: function(datum) {
                    return Bloodhound.tokenizers.whitespace(datum.value);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    wildcard: '%QUERY',
                    url: '{{ route('admin.artist_permit.search') }}?q=%QUERY',
                    transform: function(response) {
                        console.log(response);
                        // Map the remote source JSON array to a JavaScript object array
                        return $.map(response.reference_number, function(data) {
                            return {
                                value: data.result
                            };
                        });
                    }
                }
            });

            // Instantiate the Typeahead UI
            $('.typeahead').typeahead(null, {
                hint: true,
                highlight: true,
                minLength: 1,
                display: 'value',
                source: result,
                templates: {
                    empty: [
                        '<div class="empty-message">',
                        'unable to find any Best Picture winners that match the current query',
                        '</div>'
                    ].join('\n'),
                    suggestion: Handlebars.compile('<div><strong>@{{value}}</strong> – @{{year}}</div>')
                }
            });


            // var bestPictures = new Bloodhound({
            //   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            //   queryTokenizer: Bloodhound.tokenizers.whitespace,
            //   // prefetch: '../data/films/post_1960.json',
            //   remote: {
            //     url: '{{ route('admin.artist_permit.search') }}',
            //     // wildcard: '%QUERY'
            //   }
            // });

            // $('#search-application .typeahead').typeahead(null, {
            //   name: 'best-pictures',
            //   display: 'value',
            //   source: bestPictures
            // });



            newRequest();
            setInterval(function(){ newRequest(); pendingRequest();}, 100000);

            hash && $('ul.nav a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function (e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });

            $('.nav-tabs a').on('shown.bs.tab', function (event) {
                var current_tab = $(event.target).attr('href');
                if (current_tab == '#pending-request' ) { pendingRequest(); }
                if (current_tab == '#processing-permit') { processingTable(); }
                if (current_tab == '#active-permit' ) { approvedTable(); }
                if (current_tab == '#archive-permit') { rejectedTable(); }
                if (current_tab == '#active-artist' ) { activeArtistTable(); }
                if (current_tab == '#blocked-artist') { blockArtistTable(); }
                if (current_tab == '#all-artist-permits') { allPermitTable(); }
            });
        });

        function blockArtistTable() {
            $('button#unblock-artist-button').click(function () {

                var rows_selected = block_artist_table.column(0).checkboxes.selected();
                artist_id=[]
                $.each(rows_selected, function(index, rowId) { artist_id.push(rowId); })
                if(artist_id.length>0){
                    $.ajax({
                        type: 'post',
                        url: " {{route('admin.checked_list')}}",
                        data: {id:artist_id},
                        success: function (data) {
                            var html=$('#unblock_checked_list').html('<tr><th>Sn</th><th>Name</th><th>Person Code</th></tr>');
                            $.each(data, function(key,val) {
                                var value=key+1;
                                $(html).append( '<tr><td>'+value+'</td><td>' +val.firstname_en + ' '+  val.lastname_en + '</td><td>'+val.person_code+'</td></tr>' );
                            });
                        }
                    });
                }

                if (rows_selected.length > 0) {
                    $('#block_artist_number').html(rows_selected.length+'  Artist Seleted').css({'color':'green'})
                    $('#block-artist-alert').addClass('d-none');
                    $('#block-artist-modal').modal('show');
                    $('#unblock_artist').click('submit', function(e) {
                        e.preventDefault();
                        artist_id=[]
                        $.each(rows_selected, function(index, rowId) {
                            artist_id.push(rowId);
                        })

                        var remarks=$('#unblock_comment').val();
                        if(artist_id.length>0){
                            $.ajax({
                                type: 'post',
                                url: " {{route('admin.artist_unblock')}}",
                                data: {id:artist_id,remarks},
                                success: function (data) {
                                    $("#delete-ajax-alert").show(500).css({ 'background-color': '#fff2f2','color': 'red','padding': '9px','border-radius': '7px','text-align': 'center'});
                                    setTimeout(function() { $("#delete-ajax-alert").hide();
                                        $('#block-artist-modal').modal('hide');
                                    },2000);
                                    $('table#block-artist').DataTable().ajax.reload(null, false);
                                    ;
                                }
                            });
                        }
                    })
                } else {
                    $('#active-artist-alert').removeClass('d-none');
                }
            });


            block_artist_table=  $('table#block-artist').DataTable({
                /*        dom: "lBfrtip",
                        "searching":false,
                        buttons: ['pageLength',
                            {
                                extend: 'pdf',
                                title: function () { return 'ACTIVE PERMIT REPORT'; },
                                customize: function (doc) {
                                    doc.defaultStyle.fontSize = 8;
                                    doc.styles.tableHeader.fontSize = 7;
                                    doc.styles.title.fontSize = 14;
                                    doc.styles.tableHeader={'color': "Grey"};
                                }
                            },
                            {
                                extend: 'excel',
                                title: function () { return 'ACTIVE PERMIT REPORT'; },
                            }
                        ],*/
                ajax: {
                    url: '{{ route('admin.artist.datatable') }}',
                    data: function (d) {
                        d.artist_status = 'blocked';
                    }
                },
                columnDefs: [
                    {targets: [0, 4, 5, 6], className: 'no-wrap'},
                    {
                        targets:0,
                        orderable: false,
                        checkboxes: {
                            selectRow: true
                        }
                    }
                ],
                select: {
                    style: 'multi'
                },

                columns : [

                    {data: 'person_code'},
                    {data: 'name'},
                    {data: 'profession'},
                    {data: 'nationality'},
                    {data: 'mobile_number'},
                    {data: 'active_permit'},
                    {data: 'artist_id'},
                ],
                createdRow: function (row, data, index) {
                }
            });
        }
        function activeArtistTable() {
            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            active_artist_table = $('table#active-artist').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [6,7,8,9,10,11],
                        "visible": false,
                        "searchable": false
                    },

                ],
                "searching":false,
                buttons: ['pageLength',
                    {

                        extend: 'pdf',

                        title: function () { return 'ARTIST PERMIT REPORT'; },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header']=(function(page, pages) {
                                return {
                                    columns: [

                                        {
                                            alignment: 'right',
                                            text: [ '' ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });

                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWYAAABSCAYAAABnun4ZAAAACXBIWXMAACHUAAAh1AHW21Z5AAAigUlEQVR4Xu2dCbgsR1XHK9Pdw1vunV4uETHEqCAEUBIQECG4gFFQVEQUNAqKC4KoIJ+Kgl9AQUXFuKB+ghvggoD7BihEEJcIggoSsrw7091z38sDEohsBgl6Tt1/9TtV093Ts91lbv2+77x3+39OVXdX91RXdVdXK49nnSl68bflveQJWPR4PB7PfjHubT217G/9XxmkN0DyeDwez34xVvGlRZT9AxY9Ho/Hs9/oljIsD5PX5GH6R3B5PB6PZ78ogvjXZAUN2ePxeDwHAV8xezwezwGAauLzyij7H18pe5YFn1P407NulFH6VvzpWSJXKxUWYfK07X72SX8Lw7NsyiD5DfzpWTfKMHnlsiqLcZRehT89glIl9xmr+L5YrPCVtGdeyiAb+vNnjTGtuHEQfymkuaD0D/cnSneKIP5aLq8iHDwQksfTCfOb5Z4YJM86YQ6wtij+GOS5OHeyDD4CydNCGQ0+asoMksfTSqEGDzDnzK5l/wnX4eFdSm0Mg/T6m9TJO0GqGAXJdXrHwvTPIB1J5EHejrLbIc+FzAuSpwVZXkWYPhPykSEPk4fmvewdr1IqgGQ4j1qCn+ByGamNh0A78pRRdps8Z/R5o9RxuA8HZZDp+6bGqNKpmvxSZxurwePgOlKMws3CLQu45sLKK4j/C7KnAau8yCAfCbbDzQ9b+x9u3sr6WG0+2NLJRr3kaTrREYXLRpZHESWvL6Ld8fAIORwMw/R9cke6GJIeKXi/6YL1/mWVg8xn0bzWnRvDwf3d8jp0rZ85cfe7iyHpkSKPNv+7qRzc5UOD3Blj2yq5hFpyj5nwRck1SHZkoC7ivXjf+W9ZFto5B1Suj5X5sOXq+KfB7XGgc+6Fbnlt97eOxIMcOsmOufvONlbphXmYvmJCj5InIunaU/SSb3L3ny0Ps79CiMboWDxcyB3j8aSQ1fVK3cHoRZSehXykGEabH+L9579NWbCR0NcBMzKK0jfJfNiGUfa/cHsciih7kVtebHAfCZr2m3oOmdHfrTa3IK8tpcoew893ZHlIo8Jx78HrsiuC9LexePgYh9nN+NMj4AOb93ZbInL+hjxMnqIDZmQUZgVVxJ/Io/ifTV5scHscqMwfrcsoSt8my2tHqTsi5EhA+3sCfx4ZhmrjnqZh1GZFGJ9BEoubVPxZ7OfBDZA86wIfWPypqPt4WXVChOmfQJ6JMspu5leN9d8mL7KRij9TB3gsRlF8Py4f/luW13a0+WEd4FkbdsLk++UxbrIizP6cx7ZTb+oveBnJJ+CRZm1+zyHF3MrBosacHGVvvnGRw2hQe2uEumif0AEei1Pq5J1MedEP8S2yzHSAZ225Uqke/qyFelGtc6kcqvOEtjIgi7Bowd2lHbVxcYFuI/3/i3CtFTzOka+mWGzktEouGkXJv2BRYw52GSU3QZoJqlyqk6kIk1dX+UHzTCLLRpYXiWs7KQ11v/u5itOxOnbhjtq6eBQkj6KW4pXcShxF2Xt5/8dqsTdQDzvmPMDiBOyj39hzsHiwKNXm55sd6GpFmP4gkq8VPFDf3de2q3IZJC+lo2495DPpeMA/pJmQFTNj8pOax4bLhgpHHydZXmUQ/5IOOMTkQfJz1j5NMT3JU5R8M5IfaUyZYHGCNt++YjbctVPhYFyGyY8OVXbPW1QaI3ztqSsLNrgnOKNOfgr+rDBphkH8JZBmYjsafESu0+THNlJ38PeZa+CyMQ9wyjD9YVlmOuAQckqpWO6HNGoZj8pe/PRCDe5GO3gMSTwOprywaDFWyVc3+fYN2prQbPS4N/geyEeecS99vCkXY/xKK9xTodZuNSoD0szoh38ifdFL/83kWcx5e2Td4bI5rTbOx6J1MYN0qMjVyXvztvNLS5A8c9B2DtDv7Jaylx2sr6vzxuZh/ANY9AjoB65fGNm17DbIUzmXhirQYPDlkGemCAc7nAcW1VC8ROBnwKqHyyYXL0+Y8mKDdKjg7a6Z98IzA/z2pzkHzih1EnLFgTs36Md9+yl17NOx6GmgDNJt/NlKHma5OQHYinDrZXDNBV0M3umeNDJ/SB6BLvcoeT0WqTUUnzblNe3J/UHDX3yXQ6EG1cs1dRVzESYH504BP8Utw+xvsOhZgCJIH2EOvLGzanBXuOemCOMf5LywqJHrgOQRlFH6AVk2Z5X6VFNeI3XizpAPPDtB+twz/jnCUrhebZxvzoG6ivlAIU9ez/yYA15ZsLW0VzrpAPV1nlFyCSRV9LK3m3VBOhCMVXwp/txXijD9c7dsTHnx/VpIB56DdnwPM0N1oro481h3yEsnV+m9Ty06QIJnWcKfnjngb86Zg60tyF4I11LhvEdR9u1YpOOWPMGsE9K+kAfZ5fxWIm8Ht0gg7zt5mD7ZLRtTXnv5gIefB+Rh/Ix5Wmh5b/DdB3ZM7SFEVsz86jXkpVGdX8LmeljLQ2y21YmqFeaZDesghMkrIa8EvY4ofTEW1buV2jLrhrRnlEH8sGq/2YL0wI0NvgVDy7CoMdu7F/cSacXnVeVDxsNN4eoMp8OfniUgK2bqfd4H8sLQQepV+TbY6SB9BMKnwwnw51LgN4/kxpxd44lA5H4a24ni+8G9dDj/Isr+EYsas14srhQeH2vWx7bd37qdx9XCfSBxy6ba/mDzkZBWRrUuGPes4OoMp8OfS2EYpi+T2wT5yCAr5lGYPhjywsgybTOeXAlJ2uFg/LkweZj8iLshy8z/IGGGrzUZz22xrZKLEL4UON/C+W6gWR8WVwJVKNYr4HmQ/CZcBx63bMw+nFHxZ0BaCWY90uDqDPVCHjlPuibc7WE7anOtyIp5p598DeSFKKP4jCzTLoak9ZipEbG4EDxrmrtyY2N1YuKz8oeduv1sMh7qlIcbOZLOjfnqMxY1Zh1YXCpFL36myZ+NVnKohpgxbtmYfVnlE/lt1b+HWY8xuGZikbQucltcQ8jCmPyosv/kKExeyw9YC7XxheMouYa0c/MhY5bE/cC6lRGmT4a8ECY//mwXJA0t371aV41tR5v1H1XOo+yvOQCLc5MH6XPdlbqG0LWCZ4qr29dZDdl1QsbzvLPz5NEFk++ol/0HpEOJWzarKi+JWYe2IP1xyDOzrG0tI/ubdhMWJa9D6NxM60FK47dWkWzPkRVzEaTPhzw3fDuP88JiLcW08jcWJT+zm6C/+1VYvTAn8msI2qj7pXVnY3TwmkI7F8xbSe+odKaXeob9c18tKcL0d3Q+UfZBSEvBbBvt11xfWzlI8H7gT43ZNywunTwYfJlZx6L335exreMweY7Jh21bbd2Ddamx6eAFcPNrM54WF8k6Y9LySBtIc1Go4xeIvP4Y8lzw6/6cDxZb4fdEzHrbbDdYLszJRKYC6ZvnYBi48sefS4NbEfhzqVyr1Kbc71aL0rch2VxU+QTZYyAtjMkTi0vjhn0aN2y+IsNQC2m4qv0zmPzft4TvMS66rfz6tsmjLp8236zIvNpsnu8uunmMwuy9cM0MN4SqvIL0RshzwXkMo+x9WGyk4Pk3zDqnmE7AhcQL81aaExk68DSgVUyUfQDyzOj0c375o462bV4E+uFfVe2vY/ztQzpAb6GT6g+KaHAFkswNbXw1FAvSwpzCDHY8+gLSUsjV4K56W2ds2dOOBUXDp/XnGe1jymscpC+AtFR4CB7nP4qyN0FaCLO9WJwZk76pMuRvRpqYvDd/SzQP498z+UwzJOmMqaNcK8JsrqGpY+oxyHwgz0ypsru0pc+j9MVyPV0MSSnzKPlXFuaZnYya5n8wkWENJmZaXBP8rTuTnlujkOdGbg9VFJ0nI5qGlS9sHGRfD/fSkeuBtBBVS38FD2bm3dYyHOzgTwuei5gqwS/CYifkV8YhLZ1l52/yGwXxwyB1Rn6aH9IEQ7X5IBPTFtfGWG1OPOistV72LiTpzLSHZ7PeBmTMA3Rj1GWt/fjHNEx6LGrGUfytMu8uRheYV1Em9sRUwzB5qgmA1BmTjlrbA0i1mDhtYfq7kDuR9yZ3lDa0+hr3LLjdOmNwz03djf33q6y1TBZF/hiKKK7eBFwE0zLB4lIx22oMciv0gznRFMv6rD/KWdc/K1Tx6Emm6Ngs7avTZntn7f7zV0u67quJ6xLrQj3iszK9saG6w1KGIvJoprr8pSG0M0vJI0heqdMG6Q1csVNPWD+r62qdXgU3we+fUsFKTBpuzUJqxL3pPe74lWjqZr1fprOMWnVdpz+8Wswx3WSzVqSjKP2OunyoJfcShKyMf1fqpFwn5IVZdn6GugsiH1u4a8nD5NkcxzMeQtLQxs11+8akYeNpHyEvlXm2axq5uuPnzZOvSTNyhm/VYWKN8evjcE1wrdrazIP0FW4atnGYvhFhS6NuPXV2gzp2IZI0wre+6tIa44ncENrIjtq4I9Vfr6lL32ZFL307suiOzABSK3I6S0hTkeuoLIo/RhXsm0dh+id8L5q6pk+l/623krpaEaV/V0TJT/ObVdqi+NfK/uCjdbGyi1dr0eCj+tuFUfK6cZS9tutoC+zqSuGXIuQ6uUcB10LwG1Cr3A+5zdL4G3T8sgo/PzDfo7P8Yfz7eZRe7epNn52vg86xj8u0kJeKyTtXauqPe1aqbe/4Uk8VTwaplW117CKZxhhP1cAjgOp8lkXZzchq6TRdBJqMWq4fGEfpL1FdcEXZzx5Lv+Pn151X8jZsre1+kb7zA7s6W3gonhzjOG1Sj7GK72ti+YEO5KlMHUe5R1YE8bW8PVQZfFWdfx6jbqbVqlsVY3SVz613eW9s8Sf9Tb6Qlorc7mUYsp3KvOlmwXzya1X5z7L9VCH97TzbItcxi1EdcDmyWBn8mbain7696CXfM+445KzNuPHH+Zrna8u002pwf73Ry0JmDqmWrnF1yLT7Yur4XbApmlnvC9UZfx0c2a0M/p5f3brhXgqrytege0diHYsYsmyFWjt6HmbL1LnpUpcF/cjfYPJf1ZdFqDKqxiEX/ezjkCfgbraJK4PspZA7U6XtYPv9GnfdNnUxJK/gaRPq4job9a6R1WqQK3Pv6xlkDKSZqe1WTLFRED98GAx+oc7XxfJe+jisfgK+XVGXptWCbHuRMdldKdTgAbXrJ0PI0lhl3kweDdpvH3UwupD+JbJrpOjXXwDyIF766Bjqqr5crgPySpDrGVLPCbLEmsUO2szIPOqMe2nzjmJYJnXb1mY8EgNJJ8jD9Fl1aaYZnVNzv9HZGb557q4YLg39KM7dp5tz/KCE5ymgK/zF21FyiWtFL36SWVcRJq9GksbKI1fHP40q2PuUQfzFRTh4AL4QPNOcDjxULI/iz6Mf9qPpQF3G+eltiZLPHav0wlW1huooorTxIsStfIQtFbkOSEvFnD91Iyl4FMMptXl3Lu9RFN9v1M/udZ06fkHXY1g6Q75cW3iy8hpGUfIvch1Xr/iL1HmU/ZNcn3z7k5G+Zewv3z4YhZsPLqKtK8ZRfGnbA8G9Ru4rJPUe6i3wcyr+/NooSK7Lg+RnRyqe6YsvXG58bzoPspeMg/QqfoOTf/twV5hnV1hcPXKH2wzhK6MIsyvr1mU+PspDaCCtFcP+VuuDllVOn0oVp57knm0VvQHOly6yC8/HIKFtfovZ5lqbY+7jLkysZ9XdWTCx3hpr6u2uC9aDXJU9CPKewhXzjar/2VjcG+RBrjOqKVc+dwIPRK/WiR8zrTcyGs/3rAPXgFwN7l/ta43xg6WhihOEr4w8TB4q1wt5KZjbV1hcGH7YKrd1wua4v9oFalGde5VXGNwrh3uEdeuXhtC1xMzrw+b2GPYSrpjx595B3ejGV4r5bSuErZS6dUtD2FrADw+HUXzfYRA/hlqAT+IKslDZBXDvKVY5h/FSPszLn9RZ5jHj21bUveYhUK/VLeYgeWkRDL68yxjURZAjL6TBvWfUbYMxfviHsLWibhw8XPvCvlTMDHfN3IIowuwv4F45RS9u7KKOVfxwhHmWDN8ikmXdZXKWJuQMXvxCDORDBf36a98UNYawPad27ghnxNE6QOfNp0zsJ9m4w8skq2Rfv496WmX35CFO/GYfnYHnQd4TaH3VbQtp7pc7PMuFyt36JJixvNftTU1mFKXfKdPyV7zhOhRcyd9tC7Pfl/swYSt8oaIr9Nv8Vd4WfigI6dBgylHPgRNlLxpH2RPZ+IGd6WE1GTUQ/xDZePYDdygSG1yeFUI/+NNuuVsWxWf4Tc08zJ5OFdj38wQs/JCtNpYM2R5YeBQOXzzqtr3O3qtO3BlJPQsw9e3bOtuDbzR6DghlkH4F/vQA/ixQ7Q9jRkN2B5Iy7P4mKpcHknmWTJdzjaeAQLhnHdDdUnGAC/G5eupyWy+6rNNIj2VQBslvyPKZyXrZPyCbQwG3/PMo/udhuFWW4da4jJJryjD9Ybg9e0QeZF9fRukvl1H2Qjomnw/Zs27UVhptttdjEw8BRZhaH2Nts3GQ/iSSeTweTz11lUebIZmnBe5Z8LSZbPywkKQ9fTDs8XjWAFnxjoL4sZDVGTV4YOXzoz08Ho9nb+H5NvitLSxa+HvLHo/H4/F4PB6Px+PxeDwej8fj8Xg8Ho/H4/F4PB6Px+PxeA4IeRQ/z4w7H0aDD0P2OKB8PsRlxH9DXjn85RT9XUeeMjjIboS8Mnga4oMwy18TPAx3O8o+UUZbt/J7EkV/8c/xNbL7xtfxC86o+DNKld1lL74Q7fGYCtnYONwq4fI4uGUFeeXIdRbRYKVzpZRR+ja5PsgHDrmN4yB9AeTl0PZhUGk7UfodSOJZY/b6C8l5mL7CPdeK3hY1SNpx0zQZwg8s8ruGkFqR+9Y1DTMxJ0qUfRAui9MqucjEDIPk1yE7611h65Cw16U/d7dnH0qeBbmNdBy/HfJiFL3kCpkx27iXvkm2kssgfpgVE2Sn4PKsGXRsv04f42hvZ47jde6oY9Vbm1wxjKKta7DYiHVekvHXzvVnu+T3JGEH9YfNyO3sclGU8WyQp5IHyVdbaaP6D+caf9FLrQ8g2GmzX4W8Ego5nQIZ5AOH3Eb+/UCeH57/VGbK90rgqqUM0z/luEKpDJJnjZDnwihKfwXyyhmpE3fmddKfM0+U5H5+CbKGFs6TPtd/UOBbh7Nup4yd5Wvy4zB9sExbBFnVGjZU/pq5ZWTaMkqfB3ml8HHEnwcSWSYjasRCno+yF3+XzLDrJOH+ky/rizwfeO5iyCvHrJNacy+B1Bn94EVsN+QK6avzHwT4S9CzbqeMLcIBdXC7Mepv3Eum5TmR4dKYL440fZ3aSuvnstbIMhmF6UMgz4fMjA2y5wgjz4c8Sh8HeeXI9ULqDFUsH29LL311/oOAu41sRZj8GNy1yFi6oL0H8lSG/EBfpC2jrefDpcb97NlGhzSBlTZMnwz5SCPLZBjFl0KeHTqZf0VmNktXaBo8nEbmbYyOtNUdcf2QJ2jy51H21zJ9Uxwj/YVKPpe1Ikr/jpepxXW7DiJknPkasaWxBekNOljgxrA2CrcKqRVh+jIdTAyVSqSP7W0tI1/I/0E3ng3uimEQP9r10z8T3fkiiq0HFFp3vgE47O8OwxpGmx9CWCdOKRXLfIxRRf9GhFRoH39JRMb1B9U34hDWCp3Lt8n0kCukr87PFEF8rRvXFMsUvfQb3dhiznvydD79Nqcfqv7Fbp4IqUXGFf30rZCnckadtL9IHWY/yvr1Sg2MpgMbsNJG6XdNaFqPT+vgGvTXY9x4Mrgt2mLqfMMwe4bU5NffKWDid5CH6WVwW1Bs6MayNd0tkDHbUXKJq2nr8LxkItFQbVwM19yMlLh3Je5NUUVddTXzXvJEyHxfLaviyajiejlcFsaPRY1MB8nSSLQenkjfTSr+LPox32yW8372CoRZcWO1uSWXLQsHYyTRWL4ouanp4jTuZU/Me/G31vnYkF0FCdbJBLl2/xmq/O4tfbmKU7ksrQjSRyAZ36e9fRvjYSuLsg9wpVxEm7cibCrb0WaVBz9kYo2PhcxXBwIup5r13szrbOpKu8xSMdPF+CxkTRnEj5X+OkNoBZeL9kUpXUt3x7Ga2DyMf08HzYBcD1X4/2aW2UhsvLcq45ZRMZtlHdSClTbKnmAtC9vuDz6CJJq2894YQivot/T6Jr/U2Yogu9HV2Ia97J3XKrVZ52PbVid0RWoo+3YPbMKoh4bQCukf9TP7VpGwYZDS9a8FNwHkhWjLT/rI2YM8dTuoNas/cU614BYk+2FPkL4YsqKK9B6VTgZZI3XzoMlYU8XMNg6Sn2ed8r6769MJgOszft7XOt8N6tiF7M/drzZTpc66Qfr4oQ1kVYTxD51Lk90GWe2ojTvKNGzmnhe1kp/k+nQigfSN+5t3h9wJquTebdK6FSB3y2XekCukj7a32s8u0P7/j0wPWVMG2XaTj+GvgBdOmV+vNs6XaSYq84a86rRpmId+XHlAssqCzu/G0U8ybhylb4A8lbqK2fxNF/bq99SElZYt3B0yxz1M16cTAL7dQj2Td2NRw6NwZLx7LGj/q5eN2CBrpO763QfCbEN8eTvvDZ7i+nQiwMv0e7fOQTrHbmmKZ6SPLQ+TZ7NeqPRzXJ9O0MRMwR3gB4dt+UmffMhIV6fGHxXj6rJ10hbv+qRutpUq3UdRRfgtfEsEYVYcG2QNxb6w0Sd010c/msdL3zjKfgoujfSxQaaLQd+6GECuqPPxMCupcwsMLg11tzuVd51vGtPSSr+5TWSQvkUrZmrJvpkuQh+TGuU500Mq0yAwBtm6IEKqIGHmoXh1eRmtzieRMQtVzI4hrJG2eOrqP63J1wQ3LJrS0G/TamVD1pT9wUebfIz0uf42XxMyvugNHg9ZI31skDV0YX9Dk28CGTg1uANWfkHys5Ar3KfOkBXV0CelTjv8jXAxu9343u59LIau6FfLeMgV0leEgwdC7ry/MoZOsisha/7d2VbIGqm7Pkb6yFn1GBjpY4M8U57c8oJs6XQhyyBryp59Dw5yRZuvDTpGfz8trfS7MVJftGJ2K9U8TJ+F0M6Mwsx6PgCZW/7PkTqte6FXhd38GX5zTK5jWyUXwWUhYxa5lbEdDT4il9kQWouMo5bhayBXSD+kVvSr3Q1p8mBweZNvGG5a96ohV0gfHbcvgqyhMr5K+iG3IuOpl/B9kDXSR2XyFMgV0g+pHhk4NRg0pcnV4K5Spy7wPeCqoArhP2UMZI3UpY/SvHNaLP8wLJM+8cRY6nQF+0XIE8i4U+rknSBXSD8kjdT5RINcIf2UsNNDUFdv21c+BkjWuI2MO4YVckWbr41pPSZG+t0YqS9aMWtNLButC/xiSt09Rrg1rs/YUKljCOkE9cCu0Wl7ifUjZ9y8IVtI/0L3mIP0udYymbmFV4eMG0Xpd0KukH5ItYyD+EunDRNcVsV8hhpVkDXUc/w26YdcC4/zlrHaWipmOq73gVwh/ZDqkYFs/EQWrkbcNJC5Ffs4qfNwHLgq+B6ajIGsoR/Wm+t8/DffK8KiRsbtWvqsJhupjXshmZWOWlCNQ3xk3Gm1cT5kDW2Ydb8YskbqPMEL5Arpp4TzVcw1+2jsfUptIpmVDlIFD35v87f52pDpmtK2xUhdPpTsAp0/E11hqjCsFtEwan6QWATJT8vYUbD5qCJKXic1hGr0ZDXCJ41+R3dA2FTq0jcZklhIP48qgTyViYoZw+UsjUwH12DFRdkTIFdIP6SKcZC9RPp31MZlTbeNmGGYPajZt0DFHGbfK/2QK9xWvHsLtegl34RQjfTxwz/IFdIPqZ4yis/I4C6vWFvxZJCpsJOvkjqPeoCrgloh3Z+cq8HdblVKj4igwLmG2LlY6VpenJBxB61ihjyVtjTUOnpkq7/F14ZM15S2LUbq1Jp5EuRO1FXMjNTY6ipNKyaI/wsyNzbeKH2QK/TzCeGXhpBWdkxLMNy8NQ+yy6mVdYkxbknS/9Zoh7qK1/LT7xnyVHhSMpm2qph7A6vxxKYTOEh/HmXVKCuD9EPSSD3vpe+AzMfP6v1B1qysxdxQMXOvR+pXNg1UCJKvhKyRvhui9N6QK6QfUjMyuEuCtnipU6ts4l1x6WeDXOH6TXcS7gr60VYTvdT5m5BpqMX8A5AnkHHurQz3oEHWSP3Uim5lQJ5KW5qiF7d24dp8bVCrp/XtO0b6yzD9M8ga6SvCrR+C3AluDcv0kNVYpRdKXfqYkWruPVBlMfWeObOjUmtUQVuspEuszLMudpq/iZyHi4p04+jcbQups9WN0rBiaho50g+JKv3km+t0hsq6ccRDW8XMQ1abfIz0XaeOXwBZQ70y6z4+ZCsN1TXVaCdG+tzxz9JHlX71bMsg/ZCaoe7ai2QC+nFVL1rUIWPZIGukXtdtlH5qDUxMmpJHyc9YMWTjMP1uuCt+3Rl1MAqS6+BqxUoTxdaoCIkVp07cGbLmrFIb0g9ZI3XXx0jfq5yn99LHBpkncLmb5QvSn4CrEXdUBuSKMtx6Vqu/xdcGBVsD8iFX8IRYbX7po2P6W5A7Qedb40VB6mzUwvsnuKjVtDvvizHIGh5v2uQrwuR78WfFsL9VbQOkRiig6nlBqsUdddDWfWaDPBWe5EmmK6L0Krj4OE0Mt4SrwvLXzJUh/ZCo8m2evtMdxw5Zw+89NPlmGZUxik7cD7KGejzWfWPIVhq+xQJZI31Uh1j5Wb6auTKkH1I7ozD7G5moLWFbHI+caPJNG+JmkDGtcc7DHrcCZXhMLf7UyHi6yv8u5AlkHHWVvgCyxr03B1kjddfHSB85Q8ga6WODrHF9dbOObVOlgD8V336R8ZAr6Er/R21+6eNnB5A7IdPSxdd6y4laNzvGx11QyBV22uzvIXfCSksGWUMLges3tzSKMLamv5S3OqTOBlnjLjN8G0THNkyhKanyDdLWC1Dd26Fwadp8bdC2fomd1n4phl8Os/3N682DbGJuE+mHxBfBl0udHFWvUepskDU5NUaafFJ3fYz00cXoCsiapp631KSeq5P2i1tBdjlcGsvXS78BcoX0Q5rOe2peSmCj1sVflUH2UvdqZwzJK8pQPDARr2S2pZHIuGmxdQPI6cr/VvPGHRX8PyJUY8WKwfwuVhy1LiFr+O1I6YeskbrrY6TPvdcpfWyQK1w/7eMnaV+rY1L00mciVJ2J7AHtQxUncGnaHrQw7lNyfS80Sp8L91Rk2lzt3msrw81zD3BqZitjZDraN+uFjmnItGyQKyaep4gYVze2o9LL5PK71PkbHJ+L5ylc2fAoDv07gaYzncI8scb4DTa4pu53E1S+1rh6+XKLQfrZZE/D8kXZayFraCMae05Sl5arjYfKZTn0k7ZVT5tgDLJG6q6Pkb6RcxGUPjbIdK7yw3Tbx8Z3EyyNGodIorF8zpj5kUofIv2Qu8MVBlVaE3PYSuOhI9S+bxzBwXnIV7CrdA2vW0v4pB/2Bx/ScyWE8TMgN3JaDe7vrodtR8WPRkgF65yvmYcB8gRU4d9exTlzYoyD+AXGV/Sz294hKr22/KmF8sWn+oMPs4//l+OrmS7bNnbuDRs7K4bJMbSur9vGuviVWK4U4dJwxWjW5Y54MVDlbB+/0P7xTeO0Ov4AKz1MzrXsIuPoonoL5E5wmnP7VH87TsbwsePGBut8W0mum830Sor+Vu29z7IXP13qbG5DoAn6fb2Jt0Hm1wb93ob8EpbZdpmO/67Tp1EE8U/xPChtaYfqxKVu/mfViU9ln/0bybZ1AlCEyVPPpbEvwnVlfTV6j1R+u6+5kw0pf52AkLFskDW8fG5dk/sg/e550ZZ2J0ysB4OyoWDpmDdj9+3N7DaTH5XBq3UwoOW/NT57mgGl/h9M91QliVm5BAAAAABJRU5ErkJggg==\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'ARTIST PERMIT REPORT'; },
                    }
                ],
                ajax: {
                    url: '{{ route('admin.artist.datatable') }}',
                    data: function (d) {
                        d.artist_status = $('#artist-permit-status').val();
                        d.profession_id = $('select[name=profession_id]').val();
                        d.country_id = $('select[name=country_id]').val();
                    }
                },
                columnDefs: [
                    {targets: [0, 1, 4, 5], className: 'no-wrap'},
                ],
                columns: [
                    // {data: 'artist_id'},
                    {data: 'person_code'},
                    {data: 'name'},
                    {data: 'profession'},
                    {data: 'nationality'},
                    {data: 'mobile_number'},
                    {data: 'active_permit'},
                    {data: 'artist_status'},
                ],
                createdRow: function (row, data, index) {
                    $('#active-artist-modal').on('shown.bs.modal', function () {
                    });

                    $(row).click(function () {
                        location.href = '{{url('/artist_reports/artist_permit_report/show/')}}/'+data.artist_id+'?tab='+hash;
                    });

                }
            });


            //clear fillter button
            $('#artist-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); active_artist_table.draw();});

            active_artist_table.page.len($('#artist-length-change').val());
            $('#artist-length-change').change(function(){ active_artist_table.page.len( $(this).val() ).draw(); });

            var search = $.fn.dataTable.util.throttle(function(v){ active_artist_table.search(v).draw(); }, 500);
            $('input#search-artist-request').keyup(function(){ search($(this).val()); });


            $('div.toolbar-active').html('<button type="button" id="btn-active-action" class="btn btn-warning btn-sm kt-font-transform-u">Block Artist</button>');
            $('div.toolbar-active-1').html($('#active-profession-container'));
            $('div.toolbar-active-2').html($('#active-nationality-container'));

            $('button#btn-active-action').click(function () {
                var rows_selected = active_artist_table.column(0).checkboxes.selected();
                artist_id=[]
                $.each(rows_selected, function(index, rowId) {
                    artist_id.push(rowId);
                })
                if(artist_id.length>0){
                    $.ajax({
                        type: 'post',
                        url: " {{route('admin.checked_list')}}",
                        data: {id:artist_id},
                        success: function (data) {
                            var html=$('#checked_list').html('<tr><th>Sn</th><th>Name</th><th>Person Code</th></tr>')
                            $.each(data, function(key,val) {
                                var value=key+1;
                                $(html).append( '<tr><td>'+value+'</td><td>' +val.firstname_en + ' '+  val.lastname_en + '</td><td>'+val.person_code+'</td></tr>' );
                            });
                        }
                    });

                }
                if (rows_selected.length > 0) {
                    $('#active-artist-alert').addClass('d-none');
                    $('#active-artist-modal').modal('show');

                    $('#block_artist').click('submit', function(e) {
                        e.preventDefault();
                        artist_id=[]
                        $.each(rows_selected, function(index, rowId) {
                            artist_id.push(rowId);
                        })
                        if(artist_id.length>0){

                            var remarks=$('#comment').val();
                            $.ajax({
                                type: 'post',
                                url: " {{route('admin.artist_block')}}",
                                data: {id:artist_id,remarks},
                                success: function (data) {
                                    $("#ajax-alert").show(500).css({ 'background-color': '#fff2f2','color': 'red','padding': '9px','border-radius': '7px','text-align': 'center'});
                                    setTimeout(function() { $("#ajax-alert").hide();
                                        $('#active-artist-modal').modal('hide');
                                    },2000);
                                    $('table#active-artist').DataTable().ajax.reload(null, false);
                                    ;
                                }
                            });

                        }
                    })
                } else {
                    $('#active-artist-alert').removeClass('d-none');
                }
            });
        }


        function approvedTable() {

            var start = moment().subtract(29, 'days');
            var end = moment();
            var selected_date = [];

            $('input#active-applied-date').daterangepicker({
                autoUpdateInput: false,
                buttonClasses: 'btn',
                applyClass: 'btn-warning btn-sm btn-elevate',
                cancelClass: 'btn-secondary btn-sm btn-elevate',
                startDate: start,
                endDate: end,
                maxDate: new Date,
                ranges: {
                    '{{ __('Today') }}': [moment(), moment()],
                    '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
                    '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
                    '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
                    '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, function (start, end, label) {
                $('input#active-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }).on('apply.daterangepicker', function(e, d){
                new_selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
                activePermit.draw();
            });

            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            activePermit = $('table#artist-permit-approved').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',

                        title: function () { return 'ACTIVE ARTISTS PERMIT REPORT'; },
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header']=(function(page, pages) {
                                return {
                                    columns: [

                                        {
                                            alignment: 'right',
                                            text: [ '' ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });

                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'ACTIVE ARTIST PERMIT REPORT'; },
                    }
                ],
                ajax: {
                    url: '{{ route('admin.artist_permit_report.active_permit')}}',
                    data: function (d) {
                        d.status = ['active'];
                    }
                },
                columnDefs: [
                    {targets: [0, 6], className: 'no-wrap'},
                    {targets: 5, sortable: false},
                ],
                columns: [
                    {data: 'reference_number'},
                    {data: 'permit_number'},
                    {data: 'company_name'},
                    {data: 'applied_date'},
                    {data: 'artist_number'},
                    {data: 'request_type'},
                    {data: 'action'},
                ],

                createdRow: function (row, data, index) {
                    $(row).click(function () {
                        location.href = '{{ url('/artist_permit') }}/' + data.permit_id+'?tab=#active-permit';
                    });
                }
            });

            //clear fillte button
            $('#active-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); activePermit.draw();});

            activePermit.page.len($('#acive-length-change').val());
            $('#active-length-change').change(function(){ activePermit.page.len( $(this).val() ).draw(); });

            var search = $.fn.dataTable.util.throttle(function(v){ activePermit.search(v).draw(); }, 500);
            $('input#search-active-request').keyup(function(){ search($(this).val()); });
        }

        function processingTable() {
            var start = moment().subtract(29, 'days');
            var end = moment();
            var selected_date = [];

            $('input#processing-applied-date').daterangepicker({
                autoUpdateInput: false,
                buttonClasses: 'btn',
                applyClass: 'btn-warning btn-sm btn-elevate',
                cancelClass: 'btn-secondary btn-sm btn-elevate',
                startDate: start,
                endDate: end,
                maxDate: new Date,
                ranges: {
                    '{{ __('Today') }}': [moment(), moment()],
                    '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
                    '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
                    '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
                    '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, function (start, end, label) {
                $('input#processing-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }).on('apply.daterangepicker', function(e, d){
                selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
                processingPermit.draw();
            });


            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            processingPermit = $('table#artist-permit-processing').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',

                        title: function () { return 'ARTIST PERMIT PRECESSING REPORT'; },
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header']=(function(page, pages) {
                                return {
                                    columns: [
                                        'Header Artist Report',
                                        {
                                            alignment: 'right',
                                            text: [ '' ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });

                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'ARTIST PERMIT PROCESSING REPORT'; },
                    }
                ],
                ajax: {
                    url: '{{ route('admin.artist_permit_report.active_permit') }}',
                    data: function (d) {
                        d.request_type =$('select[name="report-new-request-type"]').val();
                        d.status =$('select[name="report-new-request-status"]').val();
                        d.date =$('select[name="report-new-applied-date"]').val();
                    }
                },
                columnDefs: [
                    {targets: [0, 4, 5], className: 'no-wrap'},
                ],
                columns: [
                    {data: 'reference_number'},
                    {data: 'company_name'},
                    {data: 'applied_date'},
                    {data: 'artist_number'},
                    // { data: 'company_type'},
                    {data: 'request_type'},
                    {data: 'permit_status'},
                ],

                createdRow: function (row, data, index) {
                    $(row).click(function () {
                        location.href = '{{ url('/artist_permit') }}/' + data.permit_id+'?tab=#processing-permit';
                    });
                }
            });

            //clear fillte button
            $('#processing-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); processingPermit.draw();});

            processingPermit.page.len($('#processing-length-change').val());
            $('#processing-length-change').change(function(){ processingPermit.page.len( $(this).val() ).draw(); });

            var search = $.fn.dataTable.util.throttle(function(v){ processingPermit.search(v).draw(); }, 500);
            $('input#search-processing-request').keyup(function(){ search($(this).val()); });
        }


        function processingTable() {
            var start = moment().subtract(29, 'days');
            var end = moment();
            var selected_date = [];
            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            $('input#processing-applied-date').daterangepicker({
                autoUpdateInput: false,
                buttonClasses: 'btn',
                applyClass: 'btn-warning btn-sm btn-elevate',
                cancelClass: 'btn-secondary btn-sm btn-elevate',
                startDate: start,
                endDate: end,
                maxDate: new Date,
                ranges: {
                    '{{ __('Today') }}': [moment(), moment()],
                    '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
                    '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
                    '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
                    '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, function (start, end, label) {
                $('input#processing-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }).on('apply.daterangepicker', function(e, d){
                selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
                processingPermit.draw();
            });

            processingPermit = $('table#artist-permit-processing').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',

                        title: function () { return 'ARTIST PERMIT PRECESSING REPORT'; },
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header']=(function(page, pages) {
                                return {
                                    columns: [
                                        'Header Artist Report',
                                        {
                                            alignment: 'right',
                                            text: [ '' ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });

                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATkAAADcCAYAAAALH9Z0AAAACXBIWXMAACHUAAAh1AHW21Z5AAAoF0lEQVR4Xu2dC5QkV3nfWwKEBHqgXa32NdP1mJF2t7uqhqAEC4WHA7YBGx+OjRWiQKxYCYtZeZB2p6uqV9haTE44MeSYKOBYTmRjCBCvkHYegIlFMNjIOEY5YCc8bMWxjIl5mqCZ2RXSArupr+a7rdu37q2+tx79mu93znem7vf973dv3er5uvpV1SCIOji95pzfsuZz0KWEaTeWZx9HF0EQxPgCBQs3G+ur1ldOr9pfxGYG0H53dWYetteX7XPra/YP0gBBEMQ4AoXqb99/6VXYTHn01K45WfHiiyEDfOvLTTqjIwhi/Fhfds4lZ20xNvsQC1pSyG7Y/MDVu7HZB2g3Vu3/gU2CIIjh8OjJy3dAAWKG7h4yH0OMPb7SbD3y7sbF2Ozj9IodivrNVfvv2Lhgqr4EQRCFgeLCXnayYpMGELHNI8a+s9p0cDPD5pp9jyw32MaadYRtY4ggCKI8YmFZX7WuFwtNXuERY5sr1j24mWFz2XowL/fGmv0YtOlDCoIgKuE79zdfDEXl2x+cbaOrcX6t8QzwnflQ8xf4l5IYlrKx0vzFjRXnvWCnP2w9G90Zzp9oXMjyga0v298Vc7MYNgmCIIqjKiibK/an09iK/W/RVRnn7208ZXO1+Sds7NPL9pcwlAIvd1XzIgiCMGJciwkVOYIgKoGKHEEQUw0VOYIgphooJJur9l9iU8nGmn0nfOLJis/62uwT62vW8zBcOVTkCIKoBCgkG8v2R7GZcvpD1rtYkWG2sdY8i+GhwMbFJkEQRDGgkGyuWkusqIiWVJkLUDpU2PjYJAiCMGdzbfYoX9B4g++zoWwksHlgkyAIwpzTa7N/zhc2sPVV+3MYHilsPtgkCIIwhy9uYOsfbN6AoZHD5oRNgiAIc/gCd2bF/l10jwVsXufvbVyELoIgCDP4IoeusaE3t1P7XoEugiAIM1gh+dbKzsvQNTasrzbPpvMTftdKEAShDSty2BwrTq/Ovn+c50cQxAQwzkVkY2Xmp6jIEQRRinEuIuc/0XgqFTmCIAqTVI4Lqioi4i8m0F2aqvMRBLGNOP/uxsVVFJGH72o8neXhDcOlqDIXQRDbDPhRfhVFhOWQGUoKU1UegiC2IayArC/bX0OXMRsrzRMsDzMMpfnPrFql7q8q5iQIgtCGFZDTy9Y70WVMLwcaunvIfCao8hIEQQyEFZDTa/tfji5jnswhL0YynwmqvARBEANhBeTeextPQZcxLAczdPfYWLX+HW4WQpWXIAhiIFUUEJZDlavsNel6ue+19qCLIAhCD1VhMqFXhCrIJWNz1VqDvJvLzZegiyAIQo8qChPLUUUuGRsrzRbkTYrcCroIgiD0qKIwsRxV5FJRZ26CIKaU0x+29lRRPFiOKnKpqDM3QRBTyukPzd5cRfFgOarIpaLO3ARBTCkbp+wzVRQPlqOKXCrqzE0QxJRSVWHi85TNpaLO3ARBTClVFSY+T9lcKurMTRDElMIKx+aqtYquQrA8zDbWrJ/HUGWsL1vfg9zYJAiCGAwrSmeWm9ehqxBn1uy35tqqdTtKC7O52rybihxBEEawInfud3dcjq6xhoocQRBGsCKHzbEnne9qk+6/ShCEHpNY5DZWmr+HTYIgCDWbK9ZbJrHITdJ8CYIYIaxgUJEjCGIqYQVjc9k+ja6xZ3N1f0BFjiCIgWwsW5+Z1LMimPPGqvUGbBIEQWRhBW5Si9wkzpsgiCGxvmZ/f9ILBRU5giCkJJXhAlbgJrlQwPuIVOgIgsgwgQXuwm7TvzJyvdfHVvCV7tzC+SKW9P+1JTe4+vDevc/AvARBTBt8gXv01MxN6B45i/vnZ7pu8DVZcRqmRba/HrtBF6dFEMQksXFq9st8kUP30Ild76dkBSbPYtd/61Kz1cIUfWwuz766iv0Jbe9FsePfLRsfrGP570QpQRDjxuZq87dGVeAiu/1SWdEQLSkwd2EXYzaX7fuHsV9dJ3gbP+fQ8m7BEEEQo+LMyuxtwy5w8VzwEF8MMuYGD6C0Mk6vWQ+sL9vnsDlUkjPNd8ZzC+dCO3gXugiCGAabK83/MKwCF9nBR6QFLbGO1f4mymrlzLLzKvh6DDZHStf11nCTIIg6OLNqf3EYBU5W1MAid+H1KBkq51Z2XpYUuh9gkyCIaWR91f5BnQUutFo3yQpb1/Y+jpKRU2dhJwhihPDFrep/9DB5CSYrbhgeO6jQEcSUUVeBi+3g8UkqbjyPfWxvEzcJgphUHl2zP99f4JrvwFApQif4O7GwxXPtb2CYIAiifvqLWzVnb7EVbGSKmxU8hGGCIIj62Vyz7+GL2/qyU/o7YqEbfJ2KG0EQI4cvbmDnTjYuwVAhwjnvjFjcum7w5xgmCIIYDqfXrE2xwGGoELETLIvFLXL8UxgmCIIYDpur1psrLW6W1xWLG/w4HcMEQRDD4fEP7b9GLG6bK86PYNiYjhW8TCxuHdd/K4YJgiCGw7mTM5dkittacwXDxoSzs/vE4hbNLrQxTBAEMRw2Tu7ZlSluq83/jmFjbt+90BaLW+y6V2CYIAhiOGysWG8Xi9vGin0Cw8ZEjv9PxeKGIYIgiOEhFjawb92z8zIMGxO6XswXtsjx3oMhgiCI4XBmee912eLW3MBwITrcz69iNxjJhSMJgtjmZAubcx6ufYbhQsSu931W3Bb3zO9CN0EQRP089uE9lqywwddCUFKIGxuNi1hhC2cP7EM3QdRC7LTfzB5vYOgmtiun1+wHs4XN/jyGS9F1vfs6Lt0xihgeXeFCDbHjvxdDxHbgsfvkZ2qnl62HUUIQEw2duW0ToJhtrjY3ZAVtc2X2V87f23gKSgliqqAiRxDE1BK6/lf5l6rMMEwQBDGZ3NE8uFdW3MCSwvcZlBEEQUwmYdN/CW4SBEEQBEEQBEGMK92mfx28F3N05pr96NKm22y/gr2Xgy5iAjnRaFxIx5GYatgD3ORBzvcx6UeMFx3He4SOIzH1RLPej5o80CPH/wKv1+lDjB9HZ1o76DgS2wb+gT7oKie8lhmGiAmCjiOxrTB5sIvaQXpiPJno48hPOrba30B3n//WfQd3opuYIOJm8GLcrBT+sQEWu97fYiiDqAXDEDFBTPRxlE08coOPyfzE5MAfu/jKau/jwOdmhqEMJlpifJno4yibeNdu/5jMT0wGcGZV5/ETc+flN9ES48tEH8fI8d8km3TSPjdxO0OkhI7/Anbs6jiGYu68/CZaYnyh40iMHbEbfA0eiHXc40F8sINhKIOJlhhfttVxnIYdZPuwZLV/GF2EAWz9eMNQBhMtMb5sq+PI7+Ti/vkZdE8U/D6AoZvQRFy/vDU00RLjy7Y6jtOwo+I+TOp+jAqT9TPREuPLtjqO4o7GcwsTd19PcR/AMERoYLJ+JlpifNlWx3EadnYa9mGUmKyfiZbIEjXbN8CaRdbC/0JXLiZrXETLG4YmC/gkTrYzYJHjvQc0sljaeYiEtvc92TwGWdhsvwL6y2IndsxfniafMPKOWZ6FjvdZTGGMLB+GMphoiSysyOmuXVHtkcauS9Ethdcyw9BYETnBp6Vzi6zguLgDYLG79U350PZDWZxZmqRmYtt/oWxssNhu/2zHOvg8Wey44+2G/l0nuFYWZzaJRU62H6aGqYwwyWOiJbKIRW7Q+g1LO0g/Ai7ozc0O/gh9WxydmbmEnzjY7Vdf42K4D1HHDMO1IRsTDMON2yU32+i47Ucw3EecLICoBcsrckmBfeWRXa3cZ7phI9sHsOSZ7G0oySDTg2FYG5McJloiS9kiF7n+zRjKIGrBMJTBRDtsuvsO7sydFx9UijhM9WWRjRe6wQ8wnCLTYEiKTJ9X5CLX+zmmu7HRugjdI4WfOzMM5VK0H49JDhMtkUVW5LqO/8sYzpDRJoahDHVph83AeYkCqYjDVF+GyG3/tM54OhoemV63yIGhe6Tw8zGZV9T0Xyfpd8FWVA+xP+aQYqIlssiKXOwGf4zhDKIWDEMZ6tIOE3FOseXfhaEnEUVgGJJiqi+D7li6OoZMb1LkwDA0MsT56M5pqdlqif3guv0Y1kLsD4ahDCZaIgsVuXy05iSKlELEVF+Urr1wWHcsXR1Dpp/0Ihc6wQqGcqEiN1lQkVNzy84Dl2nNSRQphYipviiycZJ/xqdiuA+ZFkNSZHrTIre4Z34XhkeCOB90D4SK3GRBRU5N5Hj/SmtOokgpREz1RTEZx0QLyPSmRe647b0IwyOBn0vs+u9D90CoyE0WVOTUaF/cVxQphYipvgiyMWLXewzDGWR6DEmR6Se2yBlemp6K3GRBRU7N1BU5DEmpQj9pRa4oVOQmCypyaia2yMnyJ1bpbe9keipy+oj9wTCUwURLZAmTx5m4flTktpiqIochJaZ9ZHoqcvqI/cEwlMFES2SJXP/l4vp1LO9TGM4gasEwlKEu7bCYyCInyx073n/FsBJZPwxJkempyOkj9gfDUAZRF7v+X2OI0CB2gmVxDY/ssvZguI/ICX5D1IJhOENd2mExcUUucvwvFM1t2k+m3zZFbrd7tbgvwyxyt+zceRmGCA3E9QPDUAaZNrIOXo/hPmRaMAxnEHWh5f9vDI2MiSpyR2eu2V8mr2lfmX7xUvX33mRFjl22aRIR9yVutoxuQi32B8NQBl0dIUdcP9UawktYXe1t1sKzdLUME+2wmJgiF+9vL5TNadpfpu/Y3jcxnKHr+KdEfex638fwxBHbXizuD4YGEtuHspe8avpXYriPruX1Xf4qtP1fxBChwWJj/un8+oEtNhpPx3CPjhP8tqgDi+bamQttHtt77VUyLRhKpPA68QIZo4KfEzMMZdEVijpm8Vyx297BYom5iizg4UbjaWKeaM57GMN9JC+LMwWLGUoyyLRgGJ5IOlbwZX5fYse7BUO58H2YYShDRzi+6CY04dcOLLSDJzDUQ9TwhpIecc4FVlEiJW62X6WrHRah472GnxNYZPsPYjhL1/JvEjskxeZLGG6Eswf2iXGZoTyXOHk2l/UFu7HReArKjEnOtj4hy4nhFFlctOSBcCfKU6Qay3+Ibd/csC5G6cQB6923X3b7LIYyxHbwDl7LDMNSmCZ5LH0XXYQGsePfyq8xWPK4/GTiv0v0q2zJDTLvvaoMh1Vioh0GsiuDa3+gJXaUGUpT8k59dS35B/g6pqsE2Rgyg4uFpnrHk14VWWXpIAmR03quLL5dDJdBSWy1z+rodEn+yd8nzmE7WLLf38Yl6JH4/lCmBUNJj+SkQnlVb3bl7zwix/sJ0B5uXPc0dCkR8w/LcHiCIAiCIAiCIAiCIAiCIAiCIAhirIBLjNMnOgRBTC38x9ZU6AhizInc4AT+oxrdjm67csw5mLkDP4bGGvbToCX7kIWuSoCc8NtBbBJEYUK7/Wr8fzK6UIQW7J8VByAGwK9X7Pon0T32xNzPedBVmjc6zm6W83iyjW6CKAR7LFX5GE1J/lE/V1vyKSWy2odwc6Ko4zjzOTu7WtJrnOmwtL/9w3wusMjxfwfDxDYgdvx/yR9/dJdH/GF77HrfwRAxQpKXgffyv8+DH9NjqDD8cQZDdynK5pRdoEE0lBLbAP64V3qVHz4xGLoziLpBht2mijr3L7YO2Hx+laHcGEme0u/FijnDOf0ryIh9mUVW8DcoyQDX9VvavfuZ2CSmDPGxgO7yiIlju30bhoyAWwaKuTA0FRzfM7+rrv0LreAJMTdY2Az6LszJ/Mcd/1Z0acPnZYahwhTNKeune4ktpo8d77+gi5gS+McDWGRlr4dXCDExGIaMqTLXuHH7VQf31rFvsR08LuZV5ebjHcV1/lXwfZlhqDBFcsr6hK53BsNa8H3RNdHw+zMt+1QEcR0qW4sqE8e2n7lqLIamAn6/TO+LIGNxx47L+ZzMMJxBVydD7GvaX4ZpzuTx8UrTPjLK9h83pm1/iiKuQ2VrUWXirh38kJgrdvy3YJgQENcKDENSRG3oBO/A0EDEvmAYKoxpTlO9CkmO6r9fNUQk+7MtEdehsrWoMrGsyEWO/28wTHCE+w9dI64VGIalmOp5yvRVYZrTVK+iqjzjwtGZ1g62H3AVbnRvO/jjyQxD5agycZ1FjuXD5sTDr5HuvhXpwyjTV4VJThPtIKrMVRY2fplL9087sD4d2/seNpWwteQNQ+WoMvEwihxY8sw3j+6Jhd8fZhhSUqQPo0xfFSY5TbSDqDJXWfg5hE7b6AOU7QK/Ri9qNJ6K7gy8jhmGylFl4mEVOTB0TyRd2/u4uD8dq/0GDCsR+4BhaCBl+qrQzQl3cxN1YfPgczBsjJgLDENDR5wH3PEeQwQirhG6M4i6PK0RVSYeZpEDw9DEUXRfivYDyvRVoZtTV6dL1fnKME5zGVd010hXZ0yVianI6VF0X4r2A8r0VaGTs+t6j4iaJaf1MxguhJgPDENDZxhzidzgV1luuNUgulNO7Gpdyo/NW/Lyue/L5IBMl5oTrKCkcmTjYagPXZ0xVSYuUuQ6zrWB2Ec00Kn8VXGi0bpINgYYSipBlv+Oqw7uxTD8UPm9zI+uHnwflUZFmb4qdHLqaExR5Yzd4AFZrGeW/6Y0gQbiPWllBjqVX5fkpfzPQp8TOe9VAbIbdfPtPDPRLs3514Feh8j2I1kOZnD1G9DJYmkCAZVO5uctkeT/RFHRqRBh079RzJX3qZOoBQvtdpiE0klHln+9TMMMNGXpzB18niy3aCgvzaDcJjExnkeZvioG5RwUL4osL7OlZqu1tDt4JpjqvsCYRonsVyhwf2C4oAXEj85cs1+M85Ym0YQVOTC4KAO6pfBjgKG7B9xhX9QwQ0mPyPV/U6YDgxvAo0yJrN+x5qGXYLgRuq3MDet5Q1kfMl3Pmv6V7Lh29mdPjJK1+yamySKKwTBkjEmuslowDBcmeSn1qCxv8iDfQEml3NHM/jQMDMMpJjExnkeZvirycubFyiLLDYbhDN392VcYGMrQcf0/1dXGrnenqM3Ty+CLHFjo+F/FUAZexwxDfch0YBjuQ6YDw7AUE71MC4bhPmS6vN8oZ7XtN2OoH1EIhiEjZHngmRTDGURt6Pq9ZwEZoh4MQ4XoOv7dspx1XuVCNl7i7jvV5mOx5T2M7hQ+xgxDAynTV4Usp8xQXhlFxhD1N1vWxRjqQ9SBYUiKqV5ELHJ5/WPr0N/T1Yo6sMhp/waG+5BpwTDcR7jzwGWijp3hqhD1YBjqQ1fHo6UXRVUZppcSu/4XTfSAqNfpk4cs321XWM/CcC3IxsSQFmX6l+mrQpaziC3umL8cU2ohy4EhJbp9dHUMU72ISZEDRK1K3zH8nbCutsjVhkS9qo+ujkdLL4pUpnspHB3gqhNifgwpEfU6fVTIcsW2dxbDtZCcdi+JY3asnPcRJIj9wTA0kDJ9VZTJKfaLreBxDA1E7AuGISU6feDsTkfHY6oXkRW52A4WMZxB1IJhKEMdWl0dj24fXR2Pll4UMaHMDxY63mfTjiUYxyKHodqoYswyOcr0VVE2p9g3OcOHD50GIvYDw5ASnT5U5PrtNiv7ykamw5AS3T66Oh4tvSjihfATDFkcDCWFGGWRC23vXWKe2A3+DMO1IY4JhiFtyuQo01dF2ZzJS5/MBz8YykXso9NPpw8VOcH2HdyJ4R4yHYaU6PbR1fFo6UWRTCjTgGHYmFEWuarymBA5wafFMUM7eD+GtRFzgGFoIGX6qiibM3SD/1ekv9hHp59OHypygm2nIgfIdGAYNmKERe7CivIYUdWYZfKU6auibE4qclTkeHR1PFp6UaQUJsi08Zz/EIa1GVWRk+UY9PF3FcjGxZARZfKU6auibE4qclTkeHR1PFp6UaQUJsSOf9JEr2KcihyGagNurSaO2Wm2/yGGjRDzgGFoIGX6qiibs2iRixz/l037iXpZHypygm3HIgfI9GAY1mIURU7WHwzDtVHlmGVylemromzOokUOMO0n6mV9xqXIhU3vNRjOIGrBMJShrHbYRe6NjrNbR8ejpRdFSiFHkT4841LkMFQb4eyhF1Q5bplcZfqqKJuzTJEDTPrxWlWfcSlyGJIiavP0ZbXDLnJAZPvrOjoGr1XqRZFSyCHrk7yU/X0MD2TYRS6222fL9C+KYszCN3VW5NOiTF8VZXOWLXKAbj9+DFUfKnKCjaDIAYvz80/X0QF8TqVeFCmFAkX7AaEdbJr2FfU6fRiyvkd27boUw7UhGxdDhSiTr0xfFWVzVlHkdBHHkY2lurwShqWY6kUi17/ZpL+ozdOX1d7cyP6+V6bDkJIifXTRyiuKdM/IxH5gkeN9FMO5hE3/OWJfuHsVhqWIejAM5SLrB4bh2pCNGbv+SQwXIraD/ybmxNBAxH4mfVWUzTluRQ7Q1TFk+s5M8DIMD0Tsi24loj6vTx3a0PE/oaPjEfU6fXTRyqslUiD2Nelv0jd2g2/L9GAokSLTg2G4Vuoat0hO2Y+qq7i7lJgztgKjrxPBNcDEHBiqHHEc1Vi6OmCx8eTLKtFQMhC+j85JAq8HQ7cUUXucu96biKiNrbbyt9yiFgxDGeAaeTL9rZKXwkUQ86K7n4GCHPi+zJJnZ60f8ke2/6CsP4Z7QD6Zjrdo9lAb5Y14zluUaZihrFbgx+Z1jX3Yda8wyQkXHuD1YJHjfwHDpRDzolub5Mnrk2Vz6CKOkzOW9Avji3vmd2E8BdaQj8u+KhS6/n9GeYakiHyD1yb5TmEoF75Pp+m9Ft1SeC0YuqWYaENLfnFODPeQaXiL7OAjKC2MmBPd/eQGNeAHYLbktP8BhnMJbf+ArL/UrODL2A2u6PFaqSbH8r57VDWy8TFUGbIxdOzozMwlmKI0LGds+/egyxh+bmDorhxxnEFjyfQqwy65l9DPM+yuhUkfpo2s9iF0KWHa2Anega5cuk72KuAq44uZLI6hQlSZSwlcm14cCCzv/orTjGwtujVfxmmSEdfq2L72LIYqRRwHDEPEBDO0Y5o8k79VHAysyrOGSUC2BmAYJiRErn87v1aR7f0ShiqFH4MZhogJZqjHNLJbrxMHBKv7YpTjgmzfwTBM5DCsNRvWOMTwGMkxFQflDd6sjRzvGEonmng2eH6yP78j209mKCU0GMa6dSzvU8MYhxguIzmmg+5ZmUgKf+t/XJDtFzOUEAWA9YOf9mCzcuBb/HScpo+u7X2ejilBEARBEARBEARBEARBEARBEARBEARBEARBEARBEARBEARBEARBEMR4AZdFil33CtgOXe/HUyexLYDLHeFmo0vHfuIIHf8IbsKVtH8eNwvBftdbxeXxxw7+R8v89qgZp7mMkshpPVdchyrWJbbbC5CnMzs/R2utpqq1gRyh7R9e2h08s6q1Tufmth+JHO89ZXJWNR/CkPQA0uKniOtA6zI8kjOk78ZucA6bhYFjdts+/wDbTp1jAj2eRkTotI/Q4m8hrgOtC1EFcJOepIA/AI8n+Jtuu96jGJ5OYGfH5R+oY7d/jP6ZtxDXoY51obWebOD4wcVcsUnwdJzgVbBAvGGocvgx4Gqt6JZSpsjBbQ9xsxZi238lbg4FcR2KrosIvAxjx6OqnIzObHsusvyXY3OiiV3vg7hZCUu73as7bvBObBYG7mTHH78yRQ5u8n7c8V+ATWO6jv8juDkUYsd/S/L4/VonWYPQ9dQfusDCHHOCa7HZCF3/pqof7AwxLzsw2MxQtMgNyqsieYD8emQHf4PNlDuuOrhXlqtI/jKI45UdP7bbZ6HAYTOl6n2CfHUWOdkNnjFUKXXkhnyRG/waNo0JHf9ucU5pzhJFDvqXKnIVr5EKGKcrfJIcuf5vpn5xDuBIquGt2ExJitxL6pqsLC/4VDelLlrk2E2VsakN9BGLXDTXvkE1b9wcCuJ4ZcZfbDTS4oDNHlXvE+Srq8jBDZ0j2/vH2Eypev6MyAlWa1mbEkVONp805zYocoyuu3Aaxjw26/0outI59M1DNqnjzVarrslGVvuf4GYPdk8IKGjo6lH4TM4N/rhQv6TPdihy0Dd5MvsMNntUvU+Qr44it9T0r5PNter5M+CtiVrWpmCRi932X6n2fzsUueOOF4S29z1swvG5P7L992Gzfx6ySd12xcKzhjVZRmwFj8vGpCL3JOJ4ZcaHvnFydoLNHlXvE+Sro8hBXtkXVqueP2Pcilzoemdk80lzbpOXq7jZg/f1xVWTGtZkeWBMvjoDVOSeRByvzPjQdxj7BPnqKnK42UfV82eMW5HruMGfyuaT5qQi1x+HxqAOw6Ljeo+I47Jv5GNTm05SLIv0gz7dueAhbKYkD8SPyXIVyV8Gcbwy459oNC5U7VPY9F6DzdJAvtjxP4fNysC5Z25tWWZN8kgKx6erzg35xPcUTYD+hxuNp2EzBXzJS9nvYNOYtL/j/z42jal6jVTIxuF9mTg4eItt71vp3wq+4W0KjBu53uuxmbI1F/0vJybzv5PtS+gu/AW6B9K1vY+nfXYeuIx9EBI5wdu2xm89H/7eYbWe/TJ8055Z2rlmZGOVHZvdq1JmS81rHZQVhr2kSvPZ/gvRXRp+nujqofKXgZ3FgcE+obsUqvfUTAgd7zVsXj3DE4Xk5OA2lGmTnHGvszzJq5mXolub3hwSQ1dtbM1xIVMncLNvO5ek2NzHJj1Mk33SGrv+52RamcVz7V5BZKf1OhY6wf/BbinJPP4gtBeeeEOzeSW6GsnB74A2+fuvoR3a7VeLeeow8RNwAPy4WSnHLe8gvG0gzsHUkifJP4R8Jxqti5J/6vRTsCosKTr3xHtbzXR7tvV8GIN9eAXbXefgtby+rMFPupIz36dC7mSfPinTmFrypP0nkK8OXpTMFc7mZOPm29Z3Vg83rntaaAebco3aksfoXdD/Dst/uSw+bIO5EMREw77qBBa5wX9CN0EQBEEQEwn8vIN9OgvP7rET/HYaIIZKemZlLfwc206dxNTCjvGJXa1L6XjXDCwwW2R+mxgu4nG4dfbAvjRATCVwjGPbf+FxdyGi/zmCIAiCIAiCIAiCIAiCIAiCIAiCIAiCIAiCIAiCGCLsS5uDDOXjwgU4p8xldsYJcQ2ZRbb3SygZe2LX/+cwZ2wSNTOKtWaPS2yOhNj1HhvaHLZ2eLzvt9htXuPCPBd3zF+OrrEE5niHs/AT2EzpusEXt9Y4KXZzwbvRPbZQkRsMO57YLEX6uHD8U9isjLw5Vjn/oqjmUMvctpJO+U1lhwSspVjkGPHcQnoLwNjxxvq3tVTkBrP1P1N+jdjl/+tY77y8dY1ZBbXMbSupwcUp4W7bVrX3oixLZ78XwHXMYidYQlcuseteAfpQuORzPL/w2o618Cm4gi66jIC1VBU5QPcARo730a7r3YfNylhqBk56bTQnOI6uDDpF7vjV3m64kiy7lpgu0CdyvWR59Uiv42d7H8dmj+TM597jbvZeFTKSJ5VfgXGP7Gpdiq6BhJa3FjrBCjYz6B7HQWCO9GrNUbN9w5a3GvLmKMaS9XwTrBE2cwlnvb+fvDr5gyjnMVSGvHkXZivp4CLHBk8W482xHfxR3mRUsUH+kLu6L4Z6yHwA08dzT94sGS6fjuEeqV9xEUcW7zPH+2za0QDol1fkIuvg9aCJ3OBX0dUHGxsuIMq2wTDcQ+UHZH646jHrE7r+V9l2ciaRebIaVORY38huJwUo2Ei3He//YrgPpmXGj31jo3ERynq80fF2Qwy2mY5Zsmb3Jo+99J6jvKUdJcBFL3s6nKdKz2JJUc1cNLJjtV6GshQxDoYhI5LHYu89KZ08Ko3Mz3y8YSiF+W7dd3AnrwFL1u3rKOsjmvF9poltbxFuDQnbyZp9ACV9MC1vGErJ8/GGoeQJr/1SaMNjGV09RG2GLUF+kVMlAZ94ZV0gT5/n7zr+SXRlkPVjC43NHnljYDOF/0dAV4rMpwP0yStygCp3nl+80U+eNnbaf4XNHmkO4cF7ZJe1B/xwRVl0peQVuTSPMJdj++Zm0Z+k6gf8slwqPytycFzRlcL0seUfRVcK+OAJAZs94DEpy8/yYLMH858Q3vMdpMdmIaD/UeeAD9tLeDvQxT3zu9KgBNWYpn6AxeBKwuhKGdQneZLpu28HnAGC/2hj5hJ09cjLBajief3y+uCmnK2O6iK3tOeQBZobG63MM2/eoFX4eYr2Y4AOzuSwmXJ4795nlM3LA33KFDnc7INdkhqbPcCnc5PlxJee4WKzD/CLMVWR61rewyZ5AJU/tNr/SObnz+R4VHnAl7z8ztyTBPywbtjsA2LXSW4Eo8pv4tcF3pcV+w/KqYqb+gHTPh18ZYHNPkxzMYr0C932X4ixrhV8RaXvsZVUXeTyBo1t/35ZTNXH1M8ji8N7a6xvMpffQreUVCMUucX5eekd5ZN/kCdk/kFAnyJFroPjRXPBBzJmBx+RzUXMA8/KeTpZbjEHoCxyEi1DFRvUJ05eRmIzpUiRU/nhXiWqfU7OQH4dpSl5eUz8ukDfZJ3fjs0UePzm5VSNaeoHVLHI3rqpDTZ7FMmV1wco0y8pdr0bC0H76ExrBzblbCUtVuQi179dFlP1MfXz5MVZ/7w84B+XIhfb7bPYTAFf6neDO1WG0h5L9tYZNjbTHLjZh2nuYRa5rh08js2UKoocO6ay/eyZ5d2C8hST/IDKr0PyP3Mz668ylPahipn6AVVsUooci3dd/6Y8bY+tTpN5JifC3zYQXT3AN+oiB3FZ3tj2zhYdD4y9KYvuPpgGmwMZZpGDDyKwmVLpmZztvw6bAymSX+bXIe2bvMQK54J/Jlpstb+hyqsa09QPqGKTUOQAiHdm23PwN3aCZXSr2Uqa855cs/Vi0EBBQFePrb76EzX18wyKM0LLW1KNMcoiB2/wQ7zj+Jk3yhPSW+vBG7nY7qPrBG/DzT5iy38A+oHBBwno7oPFsZkhKWp/jZspqiKXnAEZvbcHKP22f1jmr7LIyfwMuJUhbqaY5lH5B9HFTzOxKcV0TFM/oIpNUpHT0fXYEquLHKBKCL6O1fqf2OyRpzfx86j64WaP5KVIepNsbPYA36iKXOgGX4JYXk5VHL52AgUGmxkG5QVUGrhp8rF97VlspqiKHAB+8ZNP+EQQ/LftO3AAXT1U46r8VRU5dkaUnCl+Bl09TPKY+geh00+lqcoPqGKqIgeAP3kS/gI2U+CrJOBn96flUY3BUMWTV4d/mdcPuL3pp7+AGqTrsSXOL3IASxo7/tuTf7o/GzQIi8sMJT1Ufh5ZHH7mxfp28eskqdn+zSjpAf5hFDmVJU8Gz0aZElk/MAxLgXjy4HwQm1JYIRJNfLkI5BY57sEFv8dNXmKlX8FJCp/0pslMu6V58nuMYCjpo6oiB3TstvRG2RjuQxVT+eHL4uCHgp/84/v8jc3zkOWSkea2+t+vZDfSVhnKekRO67ngh+8wRpZ/ffJE+y4MKfcrr8ix99/BkifHOPm79Qsey+uipA+mxWaGnHi6tmDR7KF28j8rXdu83KVIDy58auV4v4CuXELbPxDbC/cnm7X+sP7Y3NwsfGK2ZAc/hK6JJna8/xg5C/8em5VxwrIuTp6kTibH5TC6CpF+6OH4p5ac9k+iSwr/QF7aHTwzdPy7i/6apCiRE/wLeMya/OJBF/gi7JIbeNgcCl07eLXqC7gykiej+6r8zXfoHHoBvA8Gv3xAVy0kT7bvu0MxBv+4IoiRQg9Gog7oMUWMDVTkiKqBx1Pyqu33sEkQo4WKHFEV7Co+S81rHXRJaDT+P45xHH1Cc2DhAAAAAElFTkSuQmCC\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'ARTIST PERMIT PROCESSING REPORT'; },
                    }
                ],
                ajax: {
                    url: '{{ route('admin.artist_permit_report.active_permit') }}',
                    data: function (d) {
                        d.request_type =$('select[name="report-new-request-type"]').val();
                        d.status =$('select[name="report-new-request-status"]').val();
                        d.date =$('select[name="report-new-applied-date"]').val();
                    }
                },
                columnDefs: [
                    {targets: [0, 4, 5], className: 'no-wrap'},
                ],
                columns: [
                    {data: 'reference_number'},
                    {data: 'company_name'},
                    {data: 'applied_date'},
                    {data: 'artist_number'},
                    // { data: 'company_type'},
                    {data: 'request_type'},
                    {data: 'permit_status'},
                ],

                createdRow: function (row, data, index) {
                    $(row).click(function () {
                        location.href = '{{ url('/artist_permit') }}/' + data.permit_id+'?tab=#processing-permit';
                    });
                }
            });

            //clear fillte button
            $('#processing-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); processingPermit.draw();});

            processingPermit.page.len($('#processing-length-change').val());
            $('#processing-length-change').change(function(){ processingPermit.page.len( $(this).val() ).draw(); });

            var search = $.fn.dataTable.util.throttle(function(v){ processingPermit.search(v).draw(); }, 500);
            $('input#search-processing-request').keyup(function(){ search($(this).val()); });
        }




        function rejectedTable() {

            var start = moment().subtract(29, 'days');
            var end = moment();
            var selected_date = [];

            $('input#archive-applied-date').daterangepicker({
                autoUpdateInput: false,
                buttonClasses: 'btn',
                applyClass: 'btn-warning btn-sm btn-elevate',
                cancelClass: 'btn-secondary btn-sm btn-elevate',
                startDate: start,
                endDate: end,
                maxDate: new Date,
                ranges: {
                    '{{ __('Today') }}': [moment(), moment()],
                    '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
                    '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
                    '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
                    '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, function (start, end, label) {
                $('input#archive-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }).on('apply.daterangepicker', function(e, d){
                selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
                archivePermit.draw();
            });

            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            archivePermit = $('table#artist-permit-rejected').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',

                        title: function () { return 'ARTIST PERMIT REJECTED REPORT'; },
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header']=(function(page, pages) {
                                return {
                                    columns: [
                                        'Header Artist Report',
                                        {
                                            alignment: 'right',
                                            text: [ '' ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWYAAABSCAYAAABnun4ZAAAACXBIWXMAACHUAAAh1AHW21Z5AAAigUlEQVR4Xu2dCbgsR1XHK9Pdw1vunV4uETHEqCAEUBIQECG4gFFQVEQUNAqKC4KoIJ+Kgl9AQUXFuKB+ghvggoD7BihEEJcIggoSsrw7091z38sDEohsBgl6Tt1/9TtV093Ts91lbv2+77x3+39OVXdX91RXdVdXK49nnSl68bflveQJWPR4PB7PfjHubT217G/9XxmkN0DyeDwez34xVvGlRZT9AxY9Ho/Hs9/oljIsD5PX5GH6R3B5PB6PZ78ogvjXZAUN2ePxeDwHAV8xezwezwGAauLzyij7H18pe5YFn1P407NulFH6VvzpWSJXKxUWYfK07X72SX8Lw7NsyiD5DfzpWTfKMHnlsiqLcZRehT89glIl9xmr+L5YrPCVtGdeyiAb+vNnjTGtuHEQfymkuaD0D/cnSneKIP5aLq8iHDwQksfTCfOb5Z4YJM86YQ6wtij+GOS5OHeyDD4CydNCGQ0+asoMksfTSqEGDzDnzK5l/wnX4eFdSm0Mg/T6m9TJO0GqGAXJdXrHwvTPIB1J5EHejrLbIc+FzAuSpwVZXkWYPhPykSEPk4fmvewdr1IqgGQ4j1qCn+ByGamNh0A78pRRdps8Z/R5o9RxuA8HZZDp+6bGqNKpmvxSZxurwePgOlKMws3CLQu45sLKK4j/C7KnAau8yCAfCbbDzQ9b+x9u3sr6WG0+2NLJRr3kaTrREYXLRpZHESWvL6Ld8fAIORwMw/R9cke6GJIeKXi/6YL1/mWVg8xn0bzWnRvDwf3d8jp0rZ85cfe7iyHpkSKPNv+7qRzc5UOD3Blj2yq5hFpyj5nwRck1SHZkoC7ivXjf+W9ZFto5B1Suj5X5sOXq+KfB7XGgc+6Fbnlt97eOxIMcOsmOufvONlbphXmYvmJCj5InIunaU/SSb3L3ny0Ps79CiMboWDxcyB3j8aSQ1fVK3cHoRZSehXykGEabH+L9579NWbCR0NcBMzKK0jfJfNiGUfa/cHsciih7kVtebHAfCZr2m3oOmdHfrTa3IK8tpcoew893ZHlIo8Jx78HrsiuC9LexePgYh9nN+NMj4AOb93ZbInL+hjxMnqIDZmQUZgVVxJ/Io/ifTV5scHscqMwfrcsoSt8my2tHqTsi5EhA+3sCfx4ZhmrjnqZh1GZFGJ9BEoubVPxZ7OfBDZA86wIfWPypqPt4WXVChOmfQJ6JMspu5leN9d8mL7KRij9TB3gsRlF8Py4f/luW13a0+WEd4FkbdsLk++UxbrIizP6cx7ZTb+oveBnJJ+CRZm1+zyHF3MrBosacHGVvvnGRw2hQe2uEumif0AEei1Pq5J1MedEP8S2yzHSAZ225Uqke/qyFelGtc6kcqvOEtjIgi7Bowd2lHbVxcYFuI/3/i3CtFTzOka+mWGzktEouGkXJv2BRYw52GSU3QZoJqlyqk6kIk1dX+UHzTCLLRpYXiWs7KQ11v/u5itOxOnbhjtq6eBQkj6KW4pXcShxF2Xt5/8dqsTdQDzvmPMDiBOyj39hzsHiwKNXm55sd6GpFmP4gkq8VPFDf3de2q3IZJC+lo2495DPpeMA/pJmQFTNj8pOax4bLhgpHHydZXmUQ/5IOOMTkQfJz1j5NMT3JU5R8M5IfaUyZYHGCNt++YjbctVPhYFyGyY8OVXbPW1QaI3ztqSsLNrgnOKNOfgr+rDBphkH8JZBmYjsafESu0+THNlJ38PeZa+CyMQ9wyjD9YVlmOuAQckqpWO6HNGoZj8pe/PRCDe5GO3gMSTwOprywaDFWyVc3+fYN2prQbPS4N/geyEeecS99vCkXY/xKK9xTodZuNSoD0szoh38ifdFL/83kWcx5e2Td4bI5rTbOx6J1MYN0qMjVyXvztvNLS5A8c9B2DtDv7Jaylx2sr6vzxuZh/ANY9AjoB65fGNm17DbIUzmXhirQYPDlkGemCAc7nAcW1VC8ROBnwKqHyyYXL0+Y8mKDdKjg7a6Z98IzA/z2pzkHzih1EnLFgTs36Md9+yl17NOx6GmgDNJt/NlKHma5OQHYinDrZXDNBV0M3umeNDJ/SB6BLvcoeT0WqTUUnzblNe3J/UHDX3yXQ6EG1cs1dRVzESYH504BP8Utw+xvsOhZgCJIH2EOvLGzanBXuOemCOMf5LywqJHrgOQRlFH6AVk2Z5X6VFNeI3XizpAPPDtB+twz/jnCUrhebZxvzoG6ivlAIU9ez/yYA15ZsLW0VzrpAPV1nlFyCSRV9LK3m3VBOhCMVXwp/txXijD9c7dsTHnx/VpIB56DdnwPM0N1oro481h3yEsnV+m9Ty06QIJnWcKfnjngb86Zg60tyF4I11LhvEdR9u1YpOOWPMGsE9K+kAfZ5fxWIm8Ht0gg7zt5mD7ZLRtTXnv5gIefB+Rh/Ix5Wmh5b/DdB3ZM7SFEVsz86jXkpVGdX8LmeljLQ2y21YmqFeaZDesghMkrIa8EvY4ofTEW1buV2jLrhrRnlEH8sGq/2YL0wI0NvgVDy7CoMdu7F/cSacXnVeVDxsNN4eoMp8OfniUgK2bqfd4H8sLQQepV+TbY6SB9BMKnwwnw51LgN4/kxpxd44lA5H4a24ni+8G9dDj/Isr+EYsas14srhQeH2vWx7bd37qdx9XCfSBxy6ba/mDzkZBWRrUuGPes4OoMp8OfS2EYpi+T2wT5yCAr5lGYPhjywsgybTOeXAlJ2uFg/LkweZj8iLshy8z/IGGGrzUZz22xrZKLEL4UON/C+W6gWR8WVwJVKNYr4HmQ/CZcBx63bMw+nFHxZ0BaCWY90uDqDPVCHjlPuibc7WE7anOtyIp5p598DeSFKKP4jCzTLoak9ZipEbG4EDxrmrtyY2N1YuKz8oeduv1sMh7qlIcbOZLOjfnqMxY1Zh1YXCpFL36myZ+NVnKohpgxbtmYfVnlE/lt1b+HWY8xuGZikbQucltcQ8jCmPyosv/kKExeyw9YC7XxheMouYa0c/MhY5bE/cC6lRGmT4a8ECY//mwXJA0t371aV41tR5v1H1XOo+yvOQCLc5MH6XPdlbqG0LWCZ4qr29dZDdl1QsbzvLPz5NEFk++ol/0HpEOJWzarKi+JWYe2IP1xyDOzrG0tI/ubdhMWJa9D6NxM60FK47dWkWzPkRVzEaTPhzw3fDuP88JiLcW08jcWJT+zm6C/+1VYvTAn8msI2qj7pXVnY3TwmkI7F8xbSe+odKaXeob9c18tKcL0d3Q+UfZBSEvBbBvt11xfWzlI8H7gT43ZNywunTwYfJlZx6L335exreMweY7Jh21bbd2Ddamx6eAFcPNrM54WF8k6Y9LySBtIc1Go4xeIvP4Y8lzw6/6cDxZb4fdEzHrbbDdYLszJRKYC6ZvnYBi48sefS4NbEfhzqVyr1Kbc71aL0rch2VxU+QTZYyAtjMkTi0vjhn0aN2y+IsNQC2m4qv0zmPzft4TvMS66rfz6tsmjLp8236zIvNpsnu8uunmMwuy9cM0MN4SqvIL0RshzwXkMo+x9WGyk4Pk3zDqnmE7AhcQL81aaExk68DSgVUyUfQDyzOj0c375o462bV4E+uFfVe2vY/ztQzpAb6GT6g+KaHAFkswNbXw1FAvSwpzCDHY8+gLSUsjV4K56W2ds2dOOBUXDp/XnGe1jymscpC+AtFR4CB7nP4qyN0FaCLO9WJwZk76pMuRvRpqYvDd/SzQP498z+UwzJOmMqaNcK8JsrqGpY+oxyHwgz0ypsru0pc+j9MVyPV0MSSnzKPlXFuaZnYya5n8wkWENJmZaXBP8rTuTnlujkOdGbg9VFJ0nI5qGlS9sHGRfD/fSkeuBtBBVS38FD2bm3dYyHOzgTwuei5gqwS/CYifkV8YhLZ1l52/yGwXxwyB1Rn6aH9IEQ7X5IBPTFtfGWG1OPOistV72LiTpzLSHZ7PeBmTMA3Rj1GWt/fjHNEx6LGrGUfytMu8uRheYV1Em9sRUwzB5qgmA1BmTjlrbA0i1mDhtYfq7kDuR9yZ3lDa0+hr3LLjdOmNwz03djf33q6y1TBZF/hiKKK7eBFwE0zLB4lIx22oMciv0gznRFMv6rD/KWdc/K1Tx6Emm6Ngs7avTZntn7f7zV0u67quJ6xLrQj3iszK9saG6w1KGIvJoprr8pSG0M0vJI0heqdMG6Q1csVNPWD+r62qdXgU3we+fUsFKTBpuzUJqxL3pPe74lWjqZr1fprOMWnVdpz+8Wswx3WSzVqSjKP2OunyoJfcShKyMf1fqpFwn5IVZdn6GugsiH1u4a8nD5NkcxzMeQtLQxs11+8akYeNpHyEvlXm2axq5uuPnzZOvSTNyhm/VYWKN8evjcE1wrdrazIP0FW4atnGYvhFhS6NuPXV2gzp2IZI0wre+6tIa44ncENrIjtq4I9Vfr6lL32ZFL307suiOzABSK3I6S0hTkeuoLIo/RhXsm0dh+id8L5q6pk+l/623krpaEaV/V0TJT/ObVdqi+NfK/uCjdbGyi1dr0eCj+tuFUfK6cZS9tutoC+zqSuGXIuQ6uUcB10LwG1Cr3A+5zdL4G3T8sgo/PzDfo7P8Yfz7eZRe7epNn52vg86xj8u0kJeKyTtXauqPe1aqbe/4Uk8VTwaplW117CKZxhhP1cAjgOp8lkXZzchq6TRdBJqMWq4fGEfpL1FdcEXZzx5Lv+Pn151X8jZsre1+kb7zA7s6W3gonhzjOG1Sj7GK72ti+YEO5KlMHUe5R1YE8bW8PVQZfFWdfx6jbqbVqlsVY3SVz613eW9s8Sf9Tb6Qlorc7mUYsp3KvOlmwXzya1X5z7L9VCH97TzbItcxi1EdcDmyWBn8mbain7696CXfM+445KzNuPHH+Zrna8u002pwf73Ry0JmDqmWrnF1yLT7Yur4XbApmlnvC9UZfx0c2a0M/p5f3brhXgqrytege0diHYsYsmyFWjt6HmbL1LnpUpcF/cjfYPJf1ZdFqDKqxiEX/ezjkCfgbraJK4PspZA7U6XtYPv9GnfdNnUxJK/gaRPq4job9a6R1WqQK3Pv6xlkDKSZqe1WTLFRED98GAx+oc7XxfJe+jisfgK+XVGXptWCbHuRMdldKdTgAbXrJ0PI0lhl3kweDdpvH3UwupD+JbJrpOjXXwDyIF766Bjqqr5crgPySpDrGVLPCbLEmsUO2szIPOqMe2nzjmJYJnXb1mY8EgNJJ8jD9Fl1aaYZnVNzv9HZGb557q4YLg39KM7dp5tz/KCE5ymgK/zF21FyiWtFL36SWVcRJq9GksbKI1fHP40q2PuUQfzFRTh4AL4QPNOcDjxULI/iz6Mf9qPpQF3G+eltiZLPHav0wlW1huooorTxIsStfIQtFbkOSEvFnD91Iyl4FMMptXl3Lu9RFN9v1M/udZ06fkHXY1g6Q75cW3iy8hpGUfIvch1Xr/iL1HmU/ZNcn3z7k5G+Zewv3z4YhZsPLqKtK8ZRfGnbA8G9Ru4rJPUe6i3wcyr+/NooSK7Lg+RnRyqe6YsvXG58bzoPspeMg/QqfoOTf/twV5hnV1hcPXKH2wzhK6MIsyvr1mU+PspDaCCtFcP+VuuDllVOn0oVp57knm0VvQHOly6yC8/HIKFtfovZ5lqbY+7jLkysZ9XdWTCx3hpr6u2uC9aDXJU9CPKewhXzjar/2VjcG+RBrjOqKVc+dwIPRK/WiR8zrTcyGs/3rAPXgFwN7l/ta43xg6WhihOEr4w8TB4q1wt5KZjbV1hcGH7YKrd1wua4v9oFalGde5VXGNwrh3uEdeuXhtC1xMzrw+b2GPYSrpjx595B3ejGV4r5bSuErZS6dUtD2FrADw+HUXzfYRA/hlqAT+IKslDZBXDvKVY5h/FSPszLn9RZ5jHj21bUveYhUK/VLeYgeWkRDL68yxjURZAjL6TBvWfUbYMxfviHsLWibhw8XPvCvlTMDHfN3IIowuwv4F45RS9u7KKOVfxwhHmWDN8ikmXdZXKWJuQMXvxCDORDBf36a98UNYawPad27ghnxNE6QOfNp0zsJ9m4w8skq2Rfv496WmX35CFO/GYfnYHnQd4TaH3VbQtp7pc7PMuFyt36JJixvNftTU1mFKXfKdPyV7zhOhRcyd9tC7Pfl/swYSt8oaIr9Nv8Vd4WfigI6dBgylHPgRNlLxpH2RPZ+IGd6WE1GTUQ/xDZePYDdygSG1yeFUI/+NNuuVsWxWf4Tc08zJ5OFdj38wQs/JCtNpYM2R5YeBQOXzzqtr3O3qtO3BlJPQsw9e3bOtuDbzR6DghlkH4F/vQA/ixQ7Q9jRkN2B5Iy7P4mKpcHknmWTJdzjaeAQLhnHdDdUnGAC/G5eupyWy+6rNNIj2VQBslvyPKZyXrZPyCbQwG3/PMo/udhuFWW4da4jJJryjD9Ybg9e0QeZF9fRukvl1H2Qjomnw/Zs27UVhptttdjEw8BRZhaH2Nts3GQ/iSSeTweTz11lUebIZmnBe5Z8LSZbPywkKQ9fTDs8XjWAFnxjoL4sZDVGTV4YOXzoz08Ho9nb+H5NvitLSxa+HvLHo/H4/F4PB6Px+PxeDwej8fj8Xg8Ho/H4/F4PB6Px+PxeA4IeRQ/z4w7H0aDD0P2OKB8PsRlxH9DXjn85RT9XUeeMjjIboS8Mnga4oMwy18TPAx3O8o+UUZbt/J7EkV/8c/xNbL7xtfxC86o+DNKld1lL74Q7fGYCtnYONwq4fI4uGUFeeXIdRbRYKVzpZRR+ja5PsgHDrmN4yB9AeTl0PZhUGk7UfodSOJZY/b6C8l5mL7CPdeK3hY1SNpx0zQZwg8s8ruGkFqR+9Y1DTMxJ0qUfRAui9MqucjEDIPk1yE7611h65Cw16U/d7dnH0qeBbmNdBy/HfJiFL3kCpkx27iXvkm2kssgfpgVE2Sn4PKsGXRsv04f42hvZ47jde6oY9Vbm1wxjKKta7DYiHVekvHXzvVnu+T3JGEH9YfNyO3sclGU8WyQp5IHyVdbaaP6D+caf9FLrQ8g2GmzX4W8Ego5nQIZ5AOH3Eb+/UCeH57/VGbK90rgqqUM0z/luEKpDJJnjZDnwihKfwXyyhmpE3fmddKfM0+U5H5+CbKGFs6TPtd/UOBbh7Nup4yd5Wvy4zB9sExbBFnVGjZU/pq5ZWTaMkqfB3ml8HHEnwcSWSYjasRCno+yF3+XzLDrJOH+ky/rizwfeO5iyCvHrJNacy+B1Bn94EVsN+QK6avzHwT4S9CzbqeMLcIBdXC7Mepv3Eum5TmR4dKYL440fZ3aSuvnstbIMhmF6UMgz4fMjA2y5wgjz4c8Sh8HeeXI9ULqDFUsH29LL311/oOAu41sRZj8GNy1yFi6oL0H8lSG/EBfpC2jrefDpcb97NlGhzSBlTZMnwz5SCPLZBjFl0KeHTqZf0VmNktXaBo8nEbmbYyOtNUdcf2QJ2jy51H21zJ9Uxwj/YVKPpe1Ikr/jpepxXW7DiJknPkasaWxBekNOljgxrA2CrcKqRVh+jIdTAyVSqSP7W0tI1/I/0E3ng3uimEQP9r10z8T3fkiiq0HFFp3vgE47O8OwxpGmx9CWCdOKRXLfIxRRf9GhFRoH39JRMb1B9U34hDWCp3Lt8n0kCukr87PFEF8rRvXFMsUvfQb3dhiznvydD79Nqcfqv7Fbp4IqUXGFf30rZCnckadtL9IHWY/yvr1Sg2MpgMbsNJG6XdNaFqPT+vgGvTXY9x4Mrgt2mLqfMMwe4bU5NffKWDid5CH6WVwW1Bs6MayNd0tkDHbUXKJq2nr8LxkItFQbVwM19yMlLh3Je5NUUVddTXzXvJEyHxfLaviyajiejlcFsaPRY1MB8nSSLQenkjfTSr+LPox32yW8372CoRZcWO1uSWXLQsHYyTRWL4ouanp4jTuZU/Me/G31vnYkF0FCdbJBLl2/xmq/O4tfbmKU7ksrQjSRyAZ36e9fRvjYSuLsg9wpVxEm7cibCrb0WaVBz9kYo2PhcxXBwIup5r13szrbOpKu8xSMdPF+CxkTRnEj5X+OkNoBZeL9kUpXUt3x7Ga2DyMf08HzYBcD1X4/2aW2UhsvLcq45ZRMZtlHdSClTbKnmAtC9vuDz6CJJq2894YQivot/T6Jr/U2Yogu9HV2Ia97J3XKrVZ52PbVid0RWoo+3YPbMKoh4bQCukf9TP7VpGwYZDS9a8FNwHkhWjLT/rI2YM8dTuoNas/cU614BYk+2FPkL4YsqKK9B6VTgZZI3XzoMlYU8XMNg6Sn2ed8r6769MJgOszft7XOt8N6tiF7M/drzZTpc66Qfr4oQ1kVYTxD51Lk90GWe2ojTvKNGzmnhe1kp/k+nQigfSN+5t3h9wJquTebdK6FSB3y2XekCukj7a32s8u0P7/j0wPWVMG2XaTj+GvgBdOmV+vNs6XaSYq84a86rRpmId+XHlAssqCzu/G0U8ybhylb4A8lbqK2fxNF/bq99SElZYt3B0yxz1M16cTAL7dQj2Td2NRw6NwZLx7LGj/q5eN2CBrpO763QfCbEN8eTvvDZ7i+nQiwMv0e7fOQTrHbmmKZ6SPLQ+TZ7NeqPRzXJ9O0MRMwR3gB4dt+UmffMhIV6fGHxXj6rJ10hbv+qRutpUq3UdRRfgtfEsEYVYcG2QNxb6w0Sd010c/msdL3zjKfgoujfSxQaaLQd+6GECuqPPxMCupcwsMLg11tzuVd51vGtPSSr+5TWSQvkUrZmrJvpkuQh+TGuU500Mq0yAwBtm6IEKqIGHmoXh1eRmtzieRMQtVzI4hrJG2eOrqP63J1wQ3LJrS0G/TamVD1pT9wUebfIz0uf42XxMyvugNHg9ZI31skDV0YX9Dk28CGTg1uANWfkHys5Ar3KfOkBXV0CelTjv8jXAxu9343u59LIau6FfLeMgV0leEgwdC7ry/MoZOsisha/7d2VbIGqm7Pkb6yFn1GBjpY4M8U57c8oJs6XQhyyBryp59Dw5yRZuvDTpGfz8trfS7MVJftGJ2K9U8TJ+F0M6Mwsx6PgCZW/7PkTqte6FXhd38GX5zTK5jWyUXwWUhYxa5lbEdDT4il9kQWouMo5bhayBXSD+kVvSr3Q1p8mBweZNvGG5a96ohV0gfHbcvgqyhMr5K+iG3IuOpl/B9kDXSR2XyFMgV0g+pHhk4NRg0pcnV4K5Spy7wPeCqoArhP2UMZI3UpY/SvHNaLP8wLJM+8cRY6nQF+0XIE8i4U+rknSBXSD8kjdT5RINcIf2UsNNDUFdv21c+BkjWuI2MO4YVckWbr41pPSZG+t0YqS9aMWtNLButC/xiSt09Rrg1rs/YUKljCOkE9cCu0Wl7ifUjZ9y8IVtI/0L3mIP0udYymbmFV4eMG0Xpd0KukH5ItYyD+EunDRNcVsV8hhpVkDXUc/w26YdcC4/zlrHaWipmOq73gVwh/ZDqkYFs/EQWrkbcNJC5Ffs4qfNwHLgq+B6ajIGsoR/Wm+t8/DffK8KiRsbtWvqsJhupjXshmZWOWlCNQ3xk3Gm1cT5kDW2Ydb8YskbqPMEL5Arpp4TzVcw1+2jsfUptIpmVDlIFD35v87f52pDpmtK2xUhdPpTsAp0/E11hqjCsFtEwan6QWATJT8vYUbD5qCJKXic1hGr0ZDXCJ41+R3dA2FTq0jcZklhIP48qgTyViYoZw+UsjUwH12DFRdkTIFdIP6SKcZC9RPp31MZlTbeNmGGYPajZt0DFHGbfK/2QK9xWvHsLtegl34RQjfTxwz/IFdIPqZ4yis/I4C6vWFvxZJCpsJOvkjqPeoCrgloh3Z+cq8HdblVKj4igwLmG2LlY6VpenJBxB61ihjyVtjTUOnpkq7/F14ZM15S2LUbq1Jp5EuRO1FXMjNTY6ipNKyaI/wsyNzbeKH2QK/TzCeGXhpBWdkxLMNy8NQ+yy6mVdYkxbknS/9Zoh7qK1/LT7xnyVHhSMpm2qph7A6vxxKYTOEh/HmXVKCuD9EPSSD3vpe+AzMfP6v1B1qysxdxQMXOvR+pXNg1UCJKvhKyRvhui9N6QK6QfUjMyuEuCtnipU6ts4l1x6WeDXOH6TXcS7gr60VYTvdT5m5BpqMX8A5AnkHHurQz3oEHWSP3Uim5lQJ5KW5qiF7d24dp8bVCrp/XtO0b6yzD9M8ga6SvCrR+C3AluDcv0kNVYpRdKXfqYkWruPVBlMfWeObOjUmtUQVuspEuszLMudpq/iZyHi4p04+jcbQups9WN0rBiaho50g+JKv3km+t0hsq6ccRDW8XMQ1abfIz0XaeOXwBZQ70y6z4+ZCsN1TXVaCdG+tzxz9JHlX71bMsg/ZCaoe7ai2QC+nFVL1rUIWPZIGukXtdtlH5qDUxMmpJHyc9YMWTjMP1uuCt+3Rl1MAqS6+BqxUoTxdaoCIkVp07cGbLmrFIb0g9ZI3XXx0jfq5yn99LHBpkncLmb5QvSn4CrEXdUBuSKMtx6Vqu/xdcGBVsD8iFX8IRYbX7po2P6W5A7Qedb40VB6mzUwvsnuKjVtDvvizHIGh5v2uQrwuR78WfFsL9VbQOkRiig6nlBqsUdddDWfWaDPBWe5EmmK6L0Krj4OE0Mt4SrwvLXzJUh/ZCo8m2evtMdxw5Zw+89NPlmGZUxik7cD7KGejzWfWPIVhq+xQJZI31Uh1j5Wb6auTKkH1I7ozD7G5moLWFbHI+caPJNG+JmkDGtcc7DHrcCZXhMLf7UyHi6yv8u5AlkHHWVvgCyxr03B1kjddfHSB85Q8ga6WODrHF9dbOObVOlgD8V336R8ZAr6Er/R21+6eNnB5A7IdPSxdd6y4laNzvGx11QyBV22uzvIXfCSksGWUMLges3tzSKMLamv5S3OqTOBlnjLjN8G0THNkyhKanyDdLWC1Dd26Fwadp8bdC2fomd1n4phl8Os/3N682DbGJuE+mHxBfBl0udHFWvUepskDU5NUaafFJ3fYz00cXoCsiapp631KSeq5P2i1tBdjlcGsvXS78BcoX0Q5rOe2peSmCj1sVflUH2UvdqZwzJK8pQPDARr2S2pZHIuGmxdQPI6cr/VvPGHRX8PyJUY8WKwfwuVhy1LiFr+O1I6YeskbrrY6TPvdcpfWyQK1w/7eMnaV+rY1L00mciVJ2J7AHtQxUncGnaHrQw7lNyfS80Sp8L91Rk2lzt3msrw81zD3BqZitjZDraN+uFjmnItGyQKyaep4gYVze2o9LL5PK71PkbHJ+L5ylc2fAoDv07gaYzncI8scb4DTa4pu53E1S+1rh6+XKLQfrZZE/D8kXZayFraCMae05Sl5arjYfKZTn0k7ZVT5tgDLJG6q6Pkb6RcxGUPjbIdK7yw3Tbx8Z3EyyNGodIorF8zpj5kUofIv2Qu8MVBlVaE3PYSuOhI9S+bxzBwXnIV7CrdA2vW0v4pB/2Bx/ScyWE8TMgN3JaDe7vrodtR8WPRkgF65yvmYcB8gRU4d9exTlzYoyD+AXGV/Sz294hKr22/KmF8sWn+oMPs4//l+OrmS7bNnbuDRs7K4bJMbSur9vGuviVWK4U4dJwxWjW5Y54MVDlbB+/0P7xTeO0Ov4AKz1MzrXsIuPoonoL5E5wmnP7VH87TsbwsePGBut8W0mum830Sor+Vu29z7IXP13qbG5DoAn6fb2Jt0Hm1wb93ob8EpbZdpmO/67Tp1EE8U/xPChtaYfqxKVu/mfViU9ln/0bybZ1AlCEyVPPpbEvwnVlfTV6j1R+u6+5kw0pf52AkLFskDW8fG5dk/sg/e550ZZ2J0ysB4OyoWDpmDdj9+3N7DaTH5XBq3UwoOW/NT57mgGl/h9M91QliVm5BAAAAABJRU5ErkJggg==\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'ARTIST PERMIT REJETCED REPORT'; },
                    }
                ],
                ajax: {
                    url: '{{ route('admin.artist_permit.datatable') }}',
                    data: function (d) {

                        var status = $('select#archive-permit-status').val();
                        d.request_type = $('select#archive-request-type').val();
                        d.status = status != null ? [status] : ['rejected', 'expired', 'unprocessed'];
                        d.date = $('#archive-applied-date').val()  ? selected_date : null;
                    }
                },
                columnDefs: [
                    {targets: '_all', className: 'no-wrap'},
                    {targets: [5], sortable: false}
                ],
                columns: [
                    {data: 'reference_number'},
                    {data: 'company_name'},
                    {data: 'applied_date'},
                    {data: 'artist_number'},
                    {data: 'request_type'},
                    {data: 'permit_status'},
                ],

                createdRow: function (row, data, index) {
                    $(row).click(function () {
                        location.href = '{{ url('/artist_permit') }}/' + data.permit_id+'?tab=#archive-permit';
                    });
                }
            });
            //clear fillte button
            $('#archive-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); archivePermit.draw();});

            archivePermit.page.len($('#archive-length-change').val());
            $('#archive-length-change').change(function(){ archivePermit.page.len( $(this).val() ).draw(); });


            var search = $.fn.dataTable.util.throttle(function(v){ archivePermit.search(v).draw(); }, 500);
            $('input#search-archive-request').keyup(function(){ search($(this).val()); });

        }

        function pendingRequest() {

            var start = moment().subtract(29, 'days');
            var end = moment();
            var selected_date = [];

            $('input#pending-applied-date').daterangepicker({
                autoUpdateInput: false,
                buttonClasses: 'btn',
                applyClass: 'btn-warning btn-sm btn-elevate',
                cancelClass: 'btn-secondary btn-sm btn-elevate',
                startDate: start,
                endDate: end,
                maxDate: new Date,
                ranges: {
                    '{{ __('Today') }}': [moment(), moment()],
                    '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
                    '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
                    '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
                    '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, function (start, end, label) {
                $('input#pending-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }).on('apply.daterangepicker', function(e, d){
                selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
                pendingPermit.draw();
            });

            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            pendingPermit = $('table#pending-permit').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',

                        title: function () { return 'PENDING ARTIST PERMIT REPORT'; },
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header']=(function(page, pages) {
                                return {
                                    columns: [
                                        'Header Artist Report',
                                        {
                                            alignment: 'right',
                                            text: [ '' ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWYAAABSCAYAAABnun4ZAAAACXBIWXMAACHUAAAh1AHW21Z5AAAigUlEQVR4Xu2dCbgsR1XHK9Pdw1vunV4uETHEqCAEUBIQECG4gFFQVEQUNAqKC4KoIJ+Kgl9AQUXFuKB+ghvggoD7BihEEJcIggoSsrw7091z38sDEohsBgl6Tt1/9TtV093Ts91lbv2+77x3+39OVXdX91RXdVdXK49nnSl68bflveQJWPR4PB7PfjHubT217G/9XxmkN0DyeDwez34xVvGlRZT9AxY9Ho/Hs9/oljIsD5PX5GH6R3B5PB6PZ78ogvjXZAUN2ePxeDwHAV8xezwezwGAauLzyij7H18pe5YFn1P407NulFH6VvzpWSJXKxUWYfK07X72SX8Lw7NsyiD5DfzpWTfKMHnlsiqLcZRehT89glIl9xmr+L5YrPCVtGdeyiAb+vNnjTGtuHEQfymkuaD0D/cnSneKIP5aLq8iHDwQksfTCfOb5Z4YJM86YQ6wtij+GOS5OHeyDD4CydNCGQ0+asoMksfTSqEGDzDnzK5l/wnX4eFdSm0Mg/T6m9TJO0GqGAXJdXrHwvTPIB1J5EHejrLbIc+FzAuSpwVZXkWYPhPykSEPk4fmvewdr1IqgGQ4j1qCn+ByGamNh0A78pRRdps8Z/R5o9RxuA8HZZDp+6bGqNKpmvxSZxurwePgOlKMws3CLQu45sLKK4j/C7KnAau8yCAfCbbDzQ9b+x9u3sr6WG0+2NLJRr3kaTrREYXLRpZHESWvL6Ld8fAIORwMw/R9cke6GJIeKXi/6YL1/mWVg8xn0bzWnRvDwf3d8jp0rZ85cfe7iyHpkSKPNv+7qRzc5UOD3Blj2yq5hFpyj5nwRck1SHZkoC7ivXjf+W9ZFto5B1Suj5X5sOXq+KfB7XGgc+6Fbnlt97eOxIMcOsmOufvONlbphXmYvmJCj5InIunaU/SSb3L3ny0Ps79CiMboWDxcyB3j8aSQ1fVK3cHoRZSehXykGEabH+L9579NWbCR0NcBMzKK0jfJfNiGUfa/cHsciih7kVtebHAfCZr2m3oOmdHfrTa3IK8tpcoew893ZHlIo8Jx78HrsiuC9LexePgYh9nN+NMj4AOb93ZbInL+hjxMnqIDZmQUZgVVxJ/Io/ifTV5scHscqMwfrcsoSt8my2tHqTsi5EhA+3sCfx4ZhmrjnqZh1GZFGJ9BEoubVPxZ7OfBDZA86wIfWPypqPt4WXVChOmfQJ6JMspu5leN9d8mL7KRij9TB3gsRlF8Py4f/luW13a0+WEd4FkbdsLk++UxbrIizP6cx7ZTb+oveBnJJ+CRZm1+zyHF3MrBosacHGVvvnGRw2hQe2uEumif0AEei1Pq5J1MedEP8S2yzHSAZ225Uqke/qyFelGtc6kcqvOEtjIgi7Bowd2lHbVxcYFuI/3/i3CtFTzOka+mWGzktEouGkXJv2BRYw52GSU3QZoJqlyqk6kIk1dX+UHzTCLLRpYXiWs7KQ11v/u5itOxOnbhjtq6eBQkj6KW4pXcShxF2Xt5/8dqsTdQDzvmPMDiBOyj39hzsHiwKNXm55sd6GpFmP4gkq8VPFDf3de2q3IZJC+lo2495DPpeMA/pJmQFTNj8pOax4bLhgpHHydZXmUQ/5IOOMTkQfJz1j5NMT3JU5R8M5IfaUyZYHGCNt++YjbctVPhYFyGyY8OVXbPW1QaI3ztqSsLNrgnOKNOfgr+rDBphkH8JZBmYjsafESu0+THNlJ38PeZa+CyMQ9wyjD9YVlmOuAQckqpWO6HNGoZj8pe/PRCDe5GO3gMSTwOprywaDFWyVc3+fYN2prQbPS4N/geyEeecS99vCkXY/xKK9xTodZuNSoD0szoh38ifdFL/83kWcx5e2Td4bI5rTbOx6J1MYN0qMjVyXvztvNLS5A8c9B2DtDv7Jaylx2sr6vzxuZh/ANY9AjoB65fGNm17DbIUzmXhirQYPDlkGemCAc7nAcW1VC8ROBnwKqHyyYXL0+Y8mKDdKjg7a6Z98IzA/z2pzkHzih1EnLFgTs36Md9+yl17NOx6GmgDNJt/NlKHma5OQHYinDrZXDNBV0M3umeNDJ/SB6BLvcoeT0WqTUUnzblNe3J/UHDX3yXQ6EG1cs1dRVzESYH504BP8Utw+xvsOhZgCJIH2EOvLGzanBXuOemCOMf5LywqJHrgOQRlFH6AVk2Z5X6VFNeI3XizpAPPDtB+twz/jnCUrhebZxvzoG6ivlAIU9ez/yYA15ZsLW0VzrpAPV1nlFyCSRV9LK3m3VBOhCMVXwp/txXijD9c7dsTHnx/VpIB56DdnwPM0N1oro481h3yEsnV+m9Ty06QIJnWcKfnjngb86Zg60tyF4I11LhvEdR9u1YpOOWPMGsE9K+kAfZ5fxWIm8Ht0gg7zt5mD7ZLRtTXnv5gIefB+Rh/Ix5Wmh5b/DdB3ZM7SFEVsz86jXkpVGdX8LmeljLQ2y21YmqFeaZDesghMkrIa8EvY4ofTEW1buV2jLrhrRnlEH8sGq/2YL0wI0NvgVDy7CoMdu7F/cSacXnVeVDxsNN4eoMp8OfniUgK2bqfd4H8sLQQepV+TbY6SB9BMKnwwnw51LgN4/kxpxd44lA5H4a24ni+8G9dDj/Isr+EYsas14srhQeH2vWx7bd37qdx9XCfSBxy6ba/mDzkZBWRrUuGPes4OoMp8OfS2EYpi+T2wT5yCAr5lGYPhjywsgybTOeXAlJ2uFg/LkweZj8iLshy8z/IGGGrzUZz22xrZKLEL4UON/C+W6gWR8WVwJVKNYr4HmQ/CZcBx63bMw+nFHxZ0BaCWY90uDqDPVCHjlPuibc7WE7anOtyIp5p598DeSFKKP4jCzTLoak9ZipEbG4EDxrmrtyY2N1YuKz8oeduv1sMh7qlIcbOZLOjfnqMxY1Zh1YXCpFL36myZ+NVnKohpgxbtmYfVnlE/lt1b+HWY8xuGZikbQucltcQ8jCmPyosv/kKExeyw9YC7XxheMouYa0c/MhY5bE/cC6lRGmT4a8ECY//mwXJA0t371aV41tR5v1H1XOo+yvOQCLc5MH6XPdlbqG0LWCZ4qr29dZDdl1QsbzvLPz5NEFk++ol/0HpEOJWzarKi+JWYe2IP1xyDOzrG0tI/ubdhMWJa9D6NxM60FK47dWkWzPkRVzEaTPhzw3fDuP88JiLcW08jcWJT+zm6C/+1VYvTAn8msI2qj7pXVnY3TwmkI7F8xbSe+odKaXeob9c18tKcL0d3Q+UfZBSEvBbBvt11xfWzlI8H7gT43ZNywunTwYfJlZx6L335exreMweY7Jh21bbd2Ddamx6eAFcPNrM54WF8k6Y9LySBtIc1Go4xeIvP4Y8lzw6/6cDxZb4fdEzHrbbDdYLszJRKYC6ZvnYBi48sefS4NbEfhzqVyr1Kbc71aL0rch2VxU+QTZYyAtjMkTi0vjhn0aN2y+IsNQC2m4qv0zmPzft4TvMS66rfz6tsmjLp8236zIvNpsnu8uunmMwuy9cM0MN4SqvIL0RshzwXkMo+x9WGyk4Pk3zDqnmE7AhcQL81aaExk68DSgVUyUfQDyzOj0c375o462bV4E+uFfVe2vY/ztQzpAb6GT6g+KaHAFkswNbXw1FAvSwpzCDHY8+gLSUsjV4K56W2ds2dOOBUXDp/XnGe1jymscpC+AtFR4CB7nP4qyN0FaCLO9WJwZk76pMuRvRpqYvDd/SzQP498z+UwzJOmMqaNcK8JsrqGpY+oxyHwgz0ypsru0pc+j9MVyPV0MSSnzKPlXFuaZnYya5n8wkWENJmZaXBP8rTuTnlujkOdGbg9VFJ0nI5qGlS9sHGRfD/fSkeuBtBBVS38FD2bm3dYyHOzgTwuei5gqwS/CYifkV8YhLZ1l52/yGwXxwyB1Rn6aH9IEQ7X5IBPTFtfGWG1OPOistV72LiTpzLSHZ7PeBmTMA3Rj1GWt/fjHNEx6LGrGUfytMu8uRheYV1Em9sRUwzB5qgmA1BmTjlrbA0i1mDhtYfq7kDuR9yZ3lDa0+hr3LLjdOmNwz03djf33q6y1TBZF/hiKKK7eBFwE0zLB4lIx22oMciv0gznRFMv6rD/KWdc/K1Tx6Emm6Ngs7avTZntn7f7zV0u67quJ6xLrQj3iszK9saG6w1KGIvJoprr8pSG0M0vJI0heqdMG6Q1csVNPWD+r62qdXgU3we+fUsFKTBpuzUJqxL3pPe74lWjqZr1fprOMWnVdpz+8Wswx3WSzVqSjKP2OunyoJfcShKyMf1fqpFwn5IVZdn6GugsiH1u4a8nD5NkcxzMeQtLQxs11+8akYeNpHyEvlXm2axq5uuPnzZOvSTNyhm/VYWKN8evjcE1wrdrazIP0FW4atnGYvhFhS6NuPXV2gzp2IZI0wre+6tIa44ncENrIjtq4I9Vfr6lL32ZFL307suiOzABSK3I6S0hTkeuoLIo/RhXsm0dh+id8L5q6pk+l/623krpaEaV/V0TJT/ObVdqi+NfK/uCjdbGyi1dr0eCj+tuFUfK6cZS9tutoC+zqSuGXIuQ6uUcB10LwG1Cr3A+5zdL4G3T8sgo/PzDfo7P8Yfz7eZRe7epNn52vg86xj8u0kJeKyTtXauqPe1aqbe/4Uk8VTwaplW117CKZxhhP1cAjgOp8lkXZzchq6TRdBJqMWq4fGEfpL1FdcEXZzx5Lv+Pn151X8jZsre1+kb7zA7s6W3gonhzjOG1Sj7GK72ti+YEO5KlMHUe5R1YE8bW8PVQZfFWdfx6jbqbVqlsVY3SVz613eW9s8Sf9Tb6Qlorc7mUYsp3KvOlmwXzya1X5z7L9VCH97TzbItcxi1EdcDmyWBn8mbain7696CXfM+445KzNuPHH+Zrna8u002pwf73Ry0JmDqmWrnF1yLT7Yur4XbApmlnvC9UZfx0c2a0M/p5f3brhXgqrytege0diHYsYsmyFWjt6HmbL1LnpUpcF/cjfYPJf1ZdFqDKqxiEX/ezjkCfgbraJK4PspZA7U6XtYPv9GnfdNnUxJK/gaRPq4job9a6R1WqQK3Pv6xlkDKSZqe1WTLFRED98GAx+oc7XxfJe+jisfgK+XVGXptWCbHuRMdldKdTgAbXrJ0PI0lhl3kweDdpvH3UwupD+JbJrpOjXXwDyIF766Bjqqr5crgPySpDrGVLPCbLEmsUO2szIPOqMe2nzjmJYJnXb1mY8EgNJJ8jD9Fl1aaYZnVNzv9HZGb557q4YLg39KM7dp5tz/KCE5ymgK/zF21FyiWtFL36SWVcRJq9GksbKI1fHP40q2PuUQfzFRTh4AL4QPNOcDjxULI/iz6Mf9qPpQF3G+eltiZLPHav0wlW1huooorTxIsStfIQtFbkOSEvFnD91Iyl4FMMptXl3Lu9RFN9v1M/udZ06fkHXY1g6Q75cW3iy8hpGUfIvch1Xr/iL1HmU/ZNcn3z7k5G+Zewv3z4YhZsPLqKtK8ZRfGnbA8G9Ru4rJPUe6i3wcyr+/NooSK7Lg+RnRyqe6YsvXG58bzoPspeMg/QqfoOTf/twV5hnV1hcPXKH2wzhK6MIsyvr1mU+PspDaCCtFcP+VuuDllVOn0oVp57knm0VvQHOly6yC8/HIKFtfovZ5lqbY+7jLkysZ9XdWTCx3hpr6u2uC9aDXJU9CPKewhXzjar/2VjcG+RBrjOqKVc+dwIPRK/WiR8zrTcyGs/3rAPXgFwN7l/ta43xg6WhihOEr4w8TB4q1wt5KZjbV1hcGH7YKrd1wua4v9oFalGde5VXGNwrh3uEdeuXhtC1xMzrw+b2GPYSrpjx595B3ejGV4r5bSuErZS6dUtD2FrADw+HUXzfYRA/hlqAT+IKslDZBXDvKVY5h/FSPszLn9RZ5jHj21bUveYhUK/VLeYgeWkRDL68yxjURZAjL6TBvWfUbYMxfviHsLWibhw8XPvCvlTMDHfN3IIowuwv4F45RS9u7KKOVfxwhHmWDN8ikmXdZXKWJuQMXvxCDORDBf36a98UNYawPad27ghnxNE6QOfNp0zsJ9m4w8skq2Rfv496WmX35CFO/GYfnYHnQd4TaH3VbQtp7pc7PMuFyt36JJixvNftTU1mFKXfKdPyV7zhOhRcyd9tC7Pfl/swYSt8oaIr9Nv8Vd4WfigI6dBgylHPgRNlLxpH2RPZ+IGd6WE1GTUQ/xDZePYDdygSG1yeFUI/+NNuuVsWxWf4Tc08zJ5OFdj38wQs/JCtNpYM2R5YeBQOXzzqtr3O3qtO3BlJPQsw9e3bOtuDbzR6DghlkH4F/vQA/ixQ7Q9jRkN2B5Iy7P4mKpcHknmWTJdzjaeAQLhnHdDdUnGAC/G5eupyWy+6rNNIj2VQBslvyPKZyXrZPyCbQwG3/PMo/udhuFWW4da4jJJryjD9Ybg9e0QeZF9fRukvl1H2Qjomnw/Zs27UVhptttdjEw8BRZhaH2Nts3GQ/iSSeTweTz11lUebIZmnBe5Z8LSZbPywkKQ9fTDs8XjWAFnxjoL4sZDVGTV4YOXzoz08Ho9nb+H5NvitLSxa+HvLHo/H4/F4PB6Px+PxeDwej8fj8Xg8Ho/H4/F4PB6Px+PxeA4IeRQ/z4w7H0aDD0P2OKB8PsRlxH9DXjn85RT9XUeeMjjIboS8Mnga4oMwy18TPAx3O8o+UUZbt/J7EkV/8c/xNbL7xtfxC86o+DNKld1lL74Q7fGYCtnYONwq4fI4uGUFeeXIdRbRYKVzpZRR+ja5PsgHDrmN4yB9AeTl0PZhUGk7UfodSOJZY/b6C8l5mL7CPdeK3hY1SNpx0zQZwg8s8ruGkFqR+9Y1DTMxJ0qUfRAui9MqucjEDIPk1yE7611h65Cw16U/d7dnH0qeBbmNdBy/HfJiFL3kCpkx27iXvkm2kssgfpgVE2Sn4PKsGXRsv04f42hvZ47jde6oY9Vbm1wxjKKta7DYiHVekvHXzvVnu+T3JGEH9YfNyO3sclGU8WyQp5IHyVdbaaP6D+caf9FLrQ8g2GmzX4W8Ego5nQIZ5AOH3Eb+/UCeH57/VGbK90rgqqUM0z/luEKpDJJnjZDnwihKfwXyyhmpE3fmddKfM0+U5H5+CbKGFs6TPtd/UOBbh7Nup4yd5Wvy4zB9sExbBFnVGjZU/pq5ZWTaMkqfB3ml8HHEnwcSWSYjasRCno+yF3+XzLDrJOH+ky/rizwfeO5iyCvHrJNacy+B1Bn94EVsN+QK6avzHwT4S9CzbqeMLcIBdXC7Mepv3Eum5TmR4dKYL440fZ3aSuvnstbIMhmF6UMgz4fMjA2y5wgjz4c8Sh8HeeXI9ULqDFUsH29LL311/oOAu41sRZj8GNy1yFi6oL0H8lSG/EBfpC2jrefDpcb97NlGhzSBlTZMnwz5SCPLZBjFl0KeHTqZf0VmNktXaBo8nEbmbYyOtNUdcf2QJ2jy51H21zJ9Uxwj/YVKPpe1Ikr/jpepxXW7DiJknPkasaWxBekNOljgxrA2CrcKqRVh+jIdTAyVSqSP7W0tI1/I/0E3ng3uimEQP9r10z8T3fkiiq0HFFp3vgE47O8OwxpGmx9CWCdOKRXLfIxRRf9GhFRoH39JRMb1B9U34hDWCp3Lt8n0kCukr87PFEF8rRvXFMsUvfQb3dhiznvydD79Nqcfqv7Fbp4IqUXGFf30rZCnckadtL9IHWY/yvr1Sg2MpgMbsNJG6XdNaFqPT+vgGvTXY9x4Mrgt2mLqfMMwe4bU5NffKWDid5CH6WVwW1Bs6MayNd0tkDHbUXKJq2nr8LxkItFQbVwM19yMlLh3Je5NUUVddTXzXvJEyHxfLaviyajiejlcFsaPRY1MB8nSSLQenkjfTSr+LPox32yW8372CoRZcWO1uSWXLQsHYyTRWL4ouanp4jTuZU/Me/G31vnYkF0FCdbJBLl2/xmq/O4tfbmKU7ksrQjSRyAZ36e9fRvjYSuLsg9wpVxEm7cibCrb0WaVBz9kYo2PhcxXBwIup5r13szrbOpKu8xSMdPF+CxkTRnEj5X+OkNoBZeL9kUpXUt3x7Ga2DyMf08HzYBcD1X4/2aW2UhsvLcq45ZRMZtlHdSClTbKnmAtC9vuDz6CJJq2894YQivot/T6Jr/U2Yogu9HV2Ia97J3XKrVZ52PbVid0RWoo+3YPbMKoh4bQCukf9TP7VpGwYZDS9a8FNwHkhWjLT/rI2YM8dTuoNas/cU614BYk+2FPkL4YsqKK9B6VTgZZI3XzoMlYU8XMNg6Sn2ed8r6769MJgOszft7XOt8N6tiF7M/drzZTpc66Qfr4oQ1kVYTxD51Lk90GWe2ojTvKNGzmnhe1kp/k+nQigfSN+5t3h9wJquTebdK6FSB3y2XekCukj7a32s8u0P7/j0wPWVMG2XaTj+GvgBdOmV+vNs6XaSYq84a86rRpmId+XHlAssqCzu/G0U8ybhylb4A8lbqK2fxNF/bq99SElZYt3B0yxz1M16cTAL7dQj2Td2NRw6NwZLx7LGj/q5eN2CBrpO763QfCbEN8eTvvDZ7i+nQiwMv0e7fOQTrHbmmKZ6SPLQ+TZ7NeqPRzXJ9O0MRMwR3gB4dt+UmffMhIV6fGHxXj6rJ10hbv+qRutpUq3UdRRfgtfEsEYVYcG2QNxb6w0Sd010c/msdL3zjKfgoujfSxQaaLQd+6GECuqPPxMCupcwsMLg11tzuVd51vGtPSSr+5TWSQvkUrZmrJvpkuQh+TGuU500Mq0yAwBtm6IEKqIGHmoXh1eRmtzieRMQtVzI4hrJG2eOrqP63J1wQ3LJrS0G/TamVD1pT9wUebfIz0uf42XxMyvugNHg9ZI31skDV0YX9Dk28CGTg1uANWfkHys5Ar3KfOkBXV0CelTjv8jXAxu9343u59LIau6FfLeMgV0leEgwdC7ry/MoZOsisha/7d2VbIGqm7Pkb6yFn1GBjpY4M8U57c8oJs6XQhyyBryp59Dw5yRZuvDTpGfz8trfS7MVJftGJ2K9U8TJ+F0M6Mwsx6PgCZW/7PkTqte6FXhd38GX5zTK5jWyUXwWUhYxa5lbEdDT4il9kQWouMo5bhayBXSD+kVvSr3Q1p8mBweZNvGG5a96ohV0gfHbcvgqyhMr5K+iG3IuOpl/B9kDXSR2XyFMgV0g+pHhk4NRg0pcnV4K5Spy7wPeCqoArhP2UMZI3UpY/SvHNaLP8wLJM+8cRY6nQF+0XIE8i4U+rknSBXSD8kjdT5RINcIf2UsNNDUFdv21c+BkjWuI2MO4YVckWbr41pPSZG+t0YqS9aMWtNLButC/xiSt09Rrg1rs/YUKljCOkE9cCu0Wl7ifUjZ9y8IVtI/0L3mIP0udYymbmFV4eMG0Xpd0KukH5ItYyD+EunDRNcVsV8hhpVkDXUc/w26YdcC4/zlrHaWipmOq73gVwh/ZDqkYFs/EQWrkbcNJC5Ffs4qfNwHLgq+B6ajIGsoR/Wm+t8/DffK8KiRsbtWvqsJhupjXshmZWOWlCNQ3xk3Gm1cT5kDW2Ydb8YskbqPMEL5Arpp4TzVcw1+2jsfUptIpmVDlIFD35v87f52pDpmtK2xUhdPpTsAp0/E11hqjCsFtEwan6QWATJT8vYUbD5qCJKXic1hGr0ZDXCJ41+R3dA2FTq0jcZklhIP48qgTyViYoZw+UsjUwH12DFRdkTIFdIP6SKcZC9RPp31MZlTbeNmGGYPajZt0DFHGbfK/2QK9xWvHsLtegl34RQjfTxwz/IFdIPqZ4yis/I4C6vWFvxZJCpsJOvkjqPeoCrgloh3Z+cq8HdblVKj4igwLmG2LlY6VpenJBxB61ihjyVtjTUOnpkq7/F14ZM15S2LUbq1Jp5EuRO1FXMjNTY6ipNKyaI/wsyNzbeKH2QK/TzCeGXhpBWdkxLMNy8NQ+yy6mVdYkxbknS/9Zoh7qK1/LT7xnyVHhSMpm2qph7A6vxxKYTOEh/HmXVKCuD9EPSSD3vpe+AzMfP6v1B1qysxdxQMXOvR+pXNg1UCJKvhKyRvhui9N6QK6QfUjMyuEuCtnipU6ts4l1x6WeDXOH6TXcS7gr60VYTvdT5m5BpqMX8A5AnkHHurQz3oEHWSP3Uim5lQJ5KW5qiF7d24dp8bVCrp/XtO0b6yzD9M8ga6SvCrR+C3AluDcv0kNVYpRdKXfqYkWruPVBlMfWeObOjUmtUQVuspEuszLMudpq/iZyHi4p04+jcbQups9WN0rBiaho50g+JKv3km+t0hsq6ccRDW8XMQ1abfIz0XaeOXwBZQ70y6z4+ZCsN1TXVaCdG+tzxz9JHlX71bMsg/ZCaoe7ai2QC+nFVL1rUIWPZIGukXtdtlH5qDUxMmpJHyc9YMWTjMP1uuCt+3Rl1MAqS6+BqxUoTxdaoCIkVp07cGbLmrFIb0g9ZI3XXx0jfq5yn99LHBpkncLmb5QvSn4CrEXdUBuSKMtx6Vqu/xdcGBVsD8iFX8IRYbX7po2P6W5A7Qedb40VB6mzUwvsnuKjVtDvvizHIGh5v2uQrwuR78WfFsL9VbQOkRiig6nlBqsUdddDWfWaDPBWe5EmmK6L0Krj4OE0Mt4SrwvLXzJUh/ZCo8m2evtMdxw5Zw+89NPlmGZUxik7cD7KGejzWfWPIVhq+xQJZI31Uh1j5Wb6auTKkH1I7ozD7G5moLWFbHI+caPJNG+JmkDGtcc7DHrcCZXhMLf7UyHi6yv8u5AlkHHWVvgCyxr03B1kjddfHSB85Q8ga6WODrHF9dbOObVOlgD8V336R8ZAr6Er/R21+6eNnB5A7IdPSxdd6y4laNzvGx11QyBV22uzvIXfCSksGWUMLges3tzSKMLamv5S3OqTOBlnjLjN8G0THNkyhKanyDdLWC1Dd26Fwadp8bdC2fomd1n4phl8Os/3N682DbGJuE+mHxBfBl0udHFWvUepskDU5NUaafFJ3fYz00cXoCsiapp631KSeq5P2i1tBdjlcGsvXS78BcoX0Q5rOe2peSmCj1sVflUH2UvdqZwzJK8pQPDARr2S2pZHIuGmxdQPI6cr/VvPGHRX8PyJUY8WKwfwuVhy1LiFr+O1I6YeskbrrY6TPvdcpfWyQK1w/7eMnaV+rY1L00mciVJ2J7AHtQxUncGnaHrQw7lNyfS80Sp8L91Rk2lzt3msrw81zD3BqZitjZDraN+uFjmnItGyQKyaep4gYVze2o9LL5PK71PkbHJ+L5ylc2fAoDv07gaYzncI8scb4DTa4pu53E1S+1rh6+XKLQfrZZE/D8kXZayFraCMae05Sl5arjYfKZTn0k7ZVT5tgDLJG6q6Pkb6RcxGUPjbIdK7yw3Tbx8Z3EyyNGodIorF8zpj5kUofIv2Qu8MVBlVaE3PYSuOhI9S+bxzBwXnIV7CrdA2vW0v4pB/2Bx/ScyWE8TMgN3JaDe7vrodtR8WPRkgF65yvmYcB8gRU4d9exTlzYoyD+AXGV/Sz294hKr22/KmF8sWn+oMPs4//l+OrmS7bNnbuDRs7K4bJMbSur9vGuviVWK4U4dJwxWjW5Y54MVDlbB+/0P7xTeO0Ov4AKz1MzrXsIuPoonoL5E5wmnP7VH87TsbwsePGBut8W0mum830Sor+Vu29z7IXP13qbG5DoAn6fb2Jt0Hm1wb93ob8EpbZdpmO/67Tp1EE8U/xPChtaYfqxKVu/mfViU9ln/0bybZ1AlCEyVPPpbEvwnVlfTV6j1R+u6+5kw0pf52AkLFskDW8fG5dk/sg/e550ZZ2J0ysB4OyoWDpmDdj9+3N7DaTH5XBq3UwoOW/NT57mgGl/h9M91QliVm5BAAAAABJRU5ErkJggg==\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'PENDING ARTIST PERMIT REPORT'; },
                    }
                ],

                ajax: {
                    url: '{{ route('admin.artist_permit.datatable') }}',
                    data: function (d) {
                        // var status = $('select#pending-permit-status').val();
                        d.request_type = $('select#pending-request-type').val();
                        d.status =  ['modified', 'checked-inspector', 'checked-manager'];//ADDED BY DONSKIE
                        d.date = $('#pending-applied-date').val()  ? selected_date : null;
                    }
                },
                columnDefs: [
                    {targets: [0, 2, 4, 5], className: 'no-wrap'},
                ],
                columns: [
                    {data: 'reference_number'},
                    {data: 'company_name'},
                    {data: 'artist_number'},
                    {data: 'applied_date'},
                    {data: 'request_type'},
                    {data: 'permit_status'}
                ],
                createdRow: function (row, data, index) {
                    $(row).click(function () {
                        location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '/application';
                    });
                },
            });

            //clear fillte button
            $('#pending-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); pendingPermit.draw();});

            pendingPermit.page.len($('#pending-length-change').val());
            $('#pending-length-change').change(function(){ pendingPermit.page.len( $(this).val() ).draw(); });

            var search = $.fn.dataTable.util.throttle(function(v){ pendingPermit.search(v).draw(); }, 500);
            $('input#search-pending-request').keyup(function(){ search($(this).val()); });
        }

        function newRequest() {

            var start = moment().subtract(29, 'days');
            var end = moment();
            var selected_date = [];

            $('input#new-applied-date').daterangepicker({
                autoUpdateInput: false,
                buttonClasses: 'btn',
                applyClass: 'btn-warning btn-sm btn-elevate',
                cancelClass: 'btn-secondary btn-sm btn-elevate',
                startDate: start,
                endDate: end,
                maxDate: new Date,
                ranges: {
                    '{{ __('Today') }}': [moment(), moment()],
                    '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
                    '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
                    '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
                    '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, function (start, end, label) {
                $('input#new-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }).on('apply.daterangepicker', function(e, d){
                selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
                artistPermit.draw();
            });


            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            artistPermit = $('table#artist-permit').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',

                        title: function () { return 'ARTIST PERMIT REPORT'; },
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '10%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '10%'
                            ]
                            doc.styles.tableHeader={'color': "Grey"};
                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString()                                   }]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header']=(function(page, pages) {
                                return {
                                    columns: [
                                        'Header Artist Report',
                                        {
                                            alignment: 'right',
                                            text: [ '' ]
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 100,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWYAAABSCAYAAABnun4ZAAAACXBIWXMAACHUAAAh1AHW21Z5AAAigUlEQVR4Xu2dCbgsR1XHK9Pdw1vunV4uETHEqCAEUBIQECG4gFFQVEQUNAqKC4KoIJ+Kgl9AQUXFuKB+ghvggoD7BihEEJcIggoSsrw7091z38sDEohsBgl6Tt1/9TtV093Ts91lbv2+77x3+39OVXdX91RXdVdXK49nnSl68bflveQJWPR4PB7PfjHubT217G/9XxmkN0DyeDwez34xVvGlRZT9AxY9Ho/Hs9/oljIsD5PX5GH6R3B5PB6PZ78ogvjXZAUN2ePxeDwHAV8xezwezwGAauLzyij7H18pe5YFn1P407NulFH6VvzpWSJXKxUWYfK07X72SX8Lw7NsyiD5DfzpWTfKMHnlsiqLcZRehT89glIl9xmr+L5YrPCVtGdeyiAb+vNnjTGtuHEQfymkuaD0D/cnSneKIP5aLq8iHDwQksfTCfOb5Z4YJM86YQ6wtij+GOS5OHeyDD4CydNCGQ0+asoMksfTSqEGDzDnzK5l/wnX4eFdSm0Mg/T6m9TJO0GqGAXJdXrHwvTPIB1J5EHejrLbIc+FzAuSpwVZXkWYPhPykSEPk4fmvewdr1IqgGQ4j1qCn+ByGamNh0A78pRRdps8Z/R5o9RxuA8HZZDp+6bGqNKpmvxSZxurwePgOlKMws3CLQu45sLKK4j/C7KnAau8yCAfCbbDzQ9b+x9u3sr6WG0+2NLJRr3kaTrREYXLRpZHESWvL6Ld8fAIORwMw/R9cke6GJIeKXi/6YL1/mWVg8xn0bzWnRvDwf3d8jp0rZ85cfe7iyHpkSKPNv+7qRzc5UOD3Blj2yq5hFpyj5nwRck1SHZkoC7ivXjf+W9ZFto5B1Suj5X5sOXq+KfB7XGgc+6Fbnlt97eOxIMcOsmOufvONlbphXmYvmJCj5InIunaU/SSb3L3ny0Ps79CiMboWDxcyB3j8aSQ1fVK3cHoRZSehXykGEabH+L9579NWbCR0NcBMzKK0jfJfNiGUfa/cHsciih7kVtebHAfCZr2m3oOmdHfrTa3IK8tpcoew893ZHlIo8Jx78HrsiuC9LexePgYh9nN+NMj4AOb93ZbInL+hjxMnqIDZmQUZgVVxJ/Io/ifTV5scHscqMwfrcsoSt8my2tHqTsi5EhA+3sCfx4ZhmrjnqZh1GZFGJ9BEoubVPxZ7OfBDZA86wIfWPypqPt4WXVChOmfQJ6JMspu5leN9d8mL7KRij9TB3gsRlF8Py4f/luW13a0+WEd4FkbdsLk++UxbrIizP6cx7ZTb+oveBnJJ+CRZm1+zyHF3MrBosacHGVvvnGRw2hQe2uEumif0AEei1Pq5J1MedEP8S2yzHSAZ225Uqke/qyFelGtc6kcqvOEtjIgi7Bowd2lHbVxcYFuI/3/i3CtFTzOka+mWGzktEouGkXJv2BRYw52GSU3QZoJqlyqk6kIk1dX+UHzTCLLRpYXiWs7KQ11v/u5itOxOnbhjtq6eBQkj6KW4pXcShxF2Xt5/8dqsTdQDzvmPMDiBOyj39hzsHiwKNXm55sd6GpFmP4gkq8VPFDf3de2q3IZJC+lo2495DPpeMA/pJmQFTNj8pOax4bLhgpHHydZXmUQ/5IOOMTkQfJz1j5NMT3JU5R8M5IfaUyZYHGCNt++YjbctVPhYFyGyY8OVXbPW1QaI3ztqSsLNrgnOKNOfgr+rDBphkH8JZBmYjsafESu0+THNlJ38PeZa+CyMQ9wyjD9YVlmOuAQckqpWO6HNGoZj8pe/PRCDe5GO3gMSTwOprywaDFWyVc3+fYN2prQbPS4N/geyEeecS99vCkXY/xKK9xTodZuNSoD0szoh38ifdFL/83kWcx5e2Td4bI5rTbOx6J1MYN0qMjVyXvztvNLS5A8c9B2DtDv7Jaylx2sr6vzxuZh/ANY9AjoB65fGNm17DbIUzmXhirQYPDlkGemCAc7nAcW1VC8ROBnwKqHyyYXL0+Y8mKDdKjg7a6Z98IzA/z2pzkHzih1EnLFgTs36Md9+yl17NOx6GmgDNJt/NlKHma5OQHYinDrZXDNBV0M3umeNDJ/SB6BLvcoeT0WqTUUnzblNe3J/UHDX3yXQ6EG1cs1dRVzESYH504BP8Utw+xvsOhZgCJIH2EOvLGzanBXuOemCOMf5LywqJHrgOQRlFH6AVk2Z5X6VFNeI3XizpAPPDtB+twz/jnCUrhebZxvzoG6ivlAIU9ez/yYA15ZsLW0VzrpAPV1nlFyCSRV9LK3m3VBOhCMVXwp/txXijD9c7dsTHnx/VpIB56DdnwPM0N1oro481h3yEsnV+m9Ty06QIJnWcKfnjngb86Zg60tyF4I11LhvEdR9u1YpOOWPMGsE9K+kAfZ5fxWIm8Ht0gg7zt5mD7ZLRtTXnv5gIefB+Rh/Ix5Wmh5b/DdB3ZM7SFEVsz86jXkpVGdX8LmeljLQ2y21YmqFeaZDesghMkrIa8EvY4ofTEW1buV2jLrhrRnlEH8sGq/2YL0wI0NvgVDy7CoMdu7F/cSacXnVeVDxsNN4eoMp8OfniUgK2bqfd4H8sLQQepV+TbY6SB9BMKnwwnw51LgN4/kxpxd44lA5H4a24ni+8G9dDj/Isr+EYsas14srhQeH2vWx7bd37qdx9XCfSBxy6ba/mDzkZBWRrUuGPes4OoMp8OfS2EYpi+T2wT5yCAr5lGYPhjywsgybTOeXAlJ2uFg/LkweZj8iLshy8z/IGGGrzUZz22xrZKLEL4UON/C+W6gWR8WVwJVKNYr4HmQ/CZcBx63bMw+nFHxZ0BaCWY90uDqDPVCHjlPuibc7WE7anOtyIp5p598DeSFKKP4jCzTLoak9ZipEbG4EDxrmrtyY2N1YuKz8oeduv1sMh7qlIcbOZLOjfnqMxY1Zh1YXCpFL36myZ+NVnKohpgxbtmYfVnlE/lt1b+HWY8xuGZikbQucltcQ8jCmPyosv/kKExeyw9YC7XxheMouYa0c/MhY5bE/cC6lRGmT4a8ECY//mwXJA0t371aV41tR5v1H1XOo+yvOQCLc5MH6XPdlbqG0LWCZ4qr29dZDdl1QsbzvLPz5NEFk++ol/0HpEOJWzarKi+JWYe2IP1xyDOzrG0tI/ubdhMWJa9D6NxM60FK47dWkWzPkRVzEaTPhzw3fDuP88JiLcW08jcWJT+zm6C/+1VYvTAn8msI2qj7pXVnY3TwmkI7F8xbSe+odKaXeob9c18tKcL0d3Q+UfZBSEvBbBvt11xfWzlI8H7gT43ZNywunTwYfJlZx6L335exreMweY7Jh21bbd2Ddamx6eAFcPNrM54WF8k6Y9LySBtIc1Go4xeIvP4Y8lzw6/6cDxZb4fdEzHrbbDdYLszJRKYC6ZvnYBi48sefS4NbEfhzqVyr1Kbc71aL0rch2VxU+QTZYyAtjMkTi0vjhn0aN2y+IsNQC2m4qv0zmPzft4TvMS66rfz6tsmjLp8236zIvNpsnu8uunmMwuy9cM0MN4SqvIL0RshzwXkMo+x9WGyk4Pk3zDqnmE7AhcQL81aaExk68DSgVUyUfQDyzOj0c375o462bV4E+uFfVe2vY/ztQzpAb6GT6g+KaHAFkswNbXw1FAvSwpzCDHY8+gLSUsjV4K56W2ds2dOOBUXDp/XnGe1jymscpC+AtFR4CB7nP4qyN0FaCLO9WJwZk76pMuRvRpqYvDd/SzQP498z+UwzJOmMqaNcK8JsrqGpY+oxyHwgz0ypsru0pc+j9MVyPV0MSSnzKPlXFuaZnYya5n8wkWENJmZaXBP8rTuTnlujkOdGbg9VFJ0nI5qGlS9sHGRfD/fSkeuBtBBVS38FD2bm3dYyHOzgTwuei5gqwS/CYifkV8YhLZ1l52/yGwXxwyB1Rn6aH9IEQ7X5IBPTFtfGWG1OPOistV72LiTpzLSHZ7PeBmTMA3Rj1GWt/fjHNEx6LGrGUfytMu8uRheYV1Em9sRUwzB5qgmA1BmTjlrbA0i1mDhtYfq7kDuR9yZ3lDa0+hr3LLjdOmNwz03djf33q6y1TBZF/hiKKK7eBFwE0zLB4lIx22oMciv0gznRFMv6rD/KWdc/K1Tx6Emm6Ngs7avTZntn7f7zV0u67quJ6xLrQj3iszK9saG6w1KGIvJoprr8pSG0M0vJI0heqdMG6Q1csVNPWD+r62qdXgU3we+fUsFKTBpuzUJqxL3pPe74lWjqZr1fprOMWnVdpz+8Wswx3WSzVqSjKP2OunyoJfcShKyMf1fqpFwn5IVZdn6GugsiH1u4a8nD5NkcxzMeQtLQxs11+8akYeNpHyEvlXm2axq5uuPnzZOvSTNyhm/VYWKN8evjcE1wrdrazIP0FW4atnGYvhFhS6NuPXV2gzp2IZI0wre+6tIa44ncENrIjtq4I9Vfr6lL32ZFL307suiOzABSK3I6S0hTkeuoLIo/RhXsm0dh+id8L5q6pk+l/623krpaEaV/V0TJT/ObVdqi+NfK/uCjdbGyi1dr0eCj+tuFUfK6cZS9tutoC+zqSuGXIuQ6uUcB10LwG1Cr3A+5zdL4G3T8sgo/PzDfo7P8Yfz7eZRe7epNn52vg86xj8u0kJeKyTtXauqPe1aqbe/4Uk8VTwaplW117CKZxhhP1cAjgOp8lkXZzchq6TRdBJqMWq4fGEfpL1FdcEXZzx5Lv+Pn151X8jZsre1+kb7zA7s6W3gonhzjOG1Sj7GK72ti+YEO5KlMHUe5R1YE8bW8PVQZfFWdfx6jbqbVqlsVY3SVz613eW9s8Sf9Tb6Qlorc7mUYsp3KvOlmwXzya1X5z7L9VCH97TzbItcxi1EdcDmyWBn8mbain7696CXfM+445KzNuPHH+Zrna8u002pwf73Ry0JmDqmWrnF1yLT7Yur4XbApmlnvC9UZfx0c2a0M/p5f3brhXgqrytege0diHYsYsmyFWjt6HmbL1LnpUpcF/cjfYPJf1ZdFqDKqxiEX/ezjkCfgbraJK4PspZA7U6XtYPv9GnfdNnUxJK/gaRPq4job9a6R1WqQK3Pv6xlkDKSZqe1WTLFRED98GAx+oc7XxfJe+jisfgK+XVGXptWCbHuRMdldKdTgAbXrJ0PI0lhl3kweDdpvH3UwupD+JbJrpOjXXwDyIF766Bjqqr5crgPySpDrGVLPCbLEmsUO2szIPOqMe2nzjmJYJnXb1mY8EgNJJ8jD9Fl1aaYZnVNzv9HZGb557q4YLg39KM7dp5tz/KCE5ymgK/zF21FyiWtFL36SWVcRJq9GksbKI1fHP40q2PuUQfzFRTh4AL4QPNOcDjxULI/iz6Mf9qPpQF3G+eltiZLPHav0wlW1huooorTxIsStfIQtFbkOSEvFnD91Iyl4FMMptXl3Lu9RFN9v1M/udZ06fkHXY1g6Q75cW3iy8hpGUfIvch1Xr/iL1HmU/ZNcn3z7k5G+Zewv3z4YhZsPLqKtK8ZRfGnbA8G9Ru4rJPUe6i3wcyr+/NooSK7Lg+RnRyqe6YsvXG58bzoPspeMg/QqfoOTf/twV5hnV1hcPXKH2wzhK6MIsyvr1mU+PspDaCCtFcP+VuuDllVOn0oVp57knm0VvQHOly6yC8/HIKFtfovZ5lqbY+7jLkysZ9XdWTCx3hpr6u2uC9aDXJU9CPKewhXzjar/2VjcG+RBrjOqKVc+dwIPRK/WiR8zrTcyGs/3rAPXgFwN7l/ta43xg6WhihOEr4w8TB4q1wt5KZjbV1hcGH7YKrd1wua4v9oFalGde5VXGNwrh3uEdeuXhtC1xMzrw+b2GPYSrpjx595B3ejGV4r5bSuErZS6dUtD2FrADw+HUXzfYRA/hlqAT+IKslDZBXDvKVY5h/FSPszLn9RZ5jHj21bUveYhUK/VLeYgeWkRDL68yxjURZAjL6TBvWfUbYMxfviHsLWibhw8XPvCvlTMDHfN3IIowuwv4F45RS9u7KKOVfxwhHmWDN8ikmXdZXKWJuQMXvxCDORDBf36a98UNYawPad27ghnxNE6QOfNp0zsJ9m4w8skq2Rfv496WmX35CFO/GYfnYHnQd4TaH3VbQtp7pc7PMuFyt36JJixvNftTU1mFKXfKdPyV7zhOhRcyd9tC7Pfl/swYSt8oaIr9Nv8Vd4WfigI6dBgylHPgRNlLxpH2RPZ+IGd6WE1GTUQ/xDZePYDdygSG1yeFUI/+NNuuVsWxWf4Tc08zJ5OFdj38wQs/JCtNpYM2R5YeBQOXzzqtr3O3qtO3BlJPQsw9e3bOtuDbzR6DghlkH4F/vQA/ixQ7Q9jRkN2B5Iy7P4mKpcHknmWTJdzjaeAQLhnHdDdUnGAC/G5eupyWy+6rNNIj2VQBslvyPKZyXrZPyCbQwG3/PMo/udhuFWW4da4jJJryjD9Ybg9e0QeZF9fRukvl1H2Qjomnw/Zs27UVhptttdjEw8BRZhaH2Nts3GQ/iSSeTweTz11lUebIZmnBe5Z8LSZbPywkKQ9fTDs8XjWAFnxjoL4sZDVGTV4YOXzoz08Ho9nb+H5NvitLSxa+HvLHo/H4/F4PB6Px+PxeDwej8fj8Xg8Ho/H4/F4PB6Px+PxeA4IeRQ/z4w7H0aDD0P2OKB8PsRlxH9DXjn85RT9XUeeMjjIboS8Mnga4oMwy18TPAx3O8o+UUZbt/J7EkV/8c/xNbL7xtfxC86o+DNKld1lL74Q7fGYCtnYONwq4fI4uGUFeeXIdRbRYKVzpZRR+ja5PsgHDrmN4yB9AeTl0PZhUGk7UfodSOJZY/b6C8l5mL7CPdeK3hY1SNpx0zQZwg8s8ruGkFqR+9Y1DTMxJ0qUfRAui9MqucjEDIPk1yE7611h65Cw16U/d7dnH0qeBbmNdBy/HfJiFL3kCpkx27iXvkm2kssgfpgVE2Sn4PKsGXRsv04f42hvZ47jde6oY9Vbm1wxjKKta7DYiHVekvHXzvVnu+T3JGEH9YfNyO3sclGU8WyQp5IHyVdbaaP6D+caf9FLrQ8g2GmzX4W8Ego5nQIZ5AOH3Eb+/UCeH57/VGbK90rgqqUM0z/luEKpDJJnjZDnwihKfwXyyhmpE3fmddKfM0+U5H5+CbKGFs6TPtd/UOBbh7Nup4yd5Wvy4zB9sExbBFnVGjZU/pq5ZWTaMkqfB3ml8HHEnwcSWSYjasRCno+yF3+XzLDrJOH+ky/rizwfeO5iyCvHrJNacy+B1Bn94EVsN+QK6avzHwT4S9CzbqeMLcIBdXC7Mepv3Eum5TmR4dKYL440fZ3aSuvnstbIMhmF6UMgz4fMjA2y5wgjz4c8Sh8HeeXI9ULqDFUsH29LL311/oOAu41sRZj8GNy1yFi6oL0H8lSG/EBfpC2jrefDpcb97NlGhzSBlTZMnwz5SCPLZBjFl0KeHTqZf0VmNktXaBo8nEbmbYyOtNUdcf2QJ2jy51H21zJ9Uxwj/YVKPpe1Ikr/jpepxXW7DiJknPkasaWxBekNOljgxrA2CrcKqRVh+jIdTAyVSqSP7W0tI1/I/0E3ng3uimEQP9r10z8T3fkiiq0HFFp3vgE47O8OwxpGmx9CWCdOKRXLfIxRRf9GhFRoH39JRMb1B9U34hDWCp3Lt8n0kCukr87PFEF8rRvXFMsUvfQb3dhiznvydD79Nqcfqv7Fbp4IqUXGFf30rZCnckadtL9IHWY/yvr1Sg2MpgMbsNJG6XdNaFqPT+vgGvTXY9x4Mrgt2mLqfMMwe4bU5NffKWDid5CH6WVwW1Bs6MayNd0tkDHbUXKJq2nr8LxkItFQbVwM19yMlLh3Je5NUUVddTXzXvJEyHxfLaviyajiejlcFsaPRY1MB8nSSLQenkjfTSr+LPox32yW8372CoRZcWO1uSWXLQsHYyTRWL4ouanp4jTuZU/Me/G31vnYkF0FCdbJBLl2/xmq/O4tfbmKU7ksrQjSRyAZ36e9fRvjYSuLsg9wpVxEm7cibCrb0WaVBz9kYo2PhcxXBwIup5r13szrbOpKu8xSMdPF+CxkTRnEj5X+OkNoBZeL9kUpXUt3x7Ga2DyMf08HzYBcD1X4/2aW2UhsvLcq45ZRMZtlHdSClTbKnmAtC9vuDz6CJJq2894YQivot/T6Jr/U2Yogu9HV2Ia97J3XKrVZ52PbVid0RWoo+3YPbMKoh4bQCukf9TP7VpGwYZDS9a8FNwHkhWjLT/rI2YM8dTuoNas/cU614BYk+2FPkL4YsqKK9B6VTgZZI3XzoMlYU8XMNg6Sn2ed8r6769MJgOszft7XOt8N6tiF7M/drzZTpc66Qfr4oQ1kVYTxD51Lk90GWe2ojTvKNGzmnhe1kp/k+nQigfSN+5t3h9wJquTebdK6FSB3y2XekCukj7a32s8u0P7/j0wPWVMG2XaTj+GvgBdOmV+vNs6XaSYq84a86rRpmId+XHlAssqCzu/G0U8ybhylb4A8lbqK2fxNF/bq99SElZYt3B0yxz1M16cTAL7dQj2Td2NRw6NwZLx7LGj/q5eN2CBrpO763QfCbEN8eTvvDZ7i+nQiwMv0e7fOQTrHbmmKZ6SPLQ+TZ7NeqPRzXJ9O0MRMwR3gB4dt+UmffMhIV6fGHxXj6rJ10hbv+qRutpUq3UdRRfgtfEsEYVYcG2QNxb6w0Sd010c/msdL3zjKfgoujfSxQaaLQd+6GECuqPPxMCupcwsMLg11tzuVd51vGtPSSr+5TWSQvkUrZmrJvpkuQh+TGuU500Mq0yAwBtm6IEKqIGHmoXh1eRmtzieRMQtVzI4hrJG2eOrqP63J1wQ3LJrS0G/TamVD1pT9wUebfIz0uf42XxMyvugNHg9ZI31skDV0YX9Dk28CGTg1uANWfkHys5Ar3KfOkBXV0CelTjv8jXAxu9343u59LIau6FfLeMgV0leEgwdC7ry/MoZOsisha/7d2VbIGqm7Pkb6yFn1GBjpY4M8U57c8oJs6XQhyyBryp59Dw5yRZuvDTpGfz8trfS7MVJftGJ2K9U8TJ+F0M6Mwsx6PgCZW/7PkTqte6FXhd38GX5zTK5jWyUXwWUhYxa5lbEdDT4il9kQWouMo5bhayBXSD+kVvSr3Q1p8mBweZNvGG5a96ohV0gfHbcvgqyhMr5K+iG3IuOpl/B9kDXSR2XyFMgV0g+pHhk4NRg0pcnV4K5Spy7wPeCqoArhP2UMZI3UpY/SvHNaLP8wLJM+8cRY6nQF+0XIE8i4U+rknSBXSD8kjdT5RINcIf2UsNNDUFdv21c+BkjWuI2MO4YVckWbr41pPSZG+t0YqS9aMWtNLButC/xiSt09Rrg1rs/YUKljCOkE9cCu0Wl7ifUjZ9y8IVtI/0L3mIP0udYymbmFV4eMG0Xpd0KukH5ItYyD+EunDRNcVsV8hhpVkDXUc/w26YdcC4/zlrHaWipmOq73gVwh/ZDqkYFs/EQWrkbcNJC5Ffs4qfNwHLgq+B6ajIGsoR/Wm+t8/DffK8KiRsbtWvqsJhupjXshmZWOWlCNQ3xk3Gm1cT5kDW2Ydb8YskbqPMEL5Arpp4TzVcw1+2jsfUptIpmVDlIFD35v87f52pDpmtK2xUhdPpTsAp0/E11hqjCsFtEwan6QWATJT8vYUbD5qCJKXic1hGr0ZDXCJ41+R3dA2FTq0jcZklhIP48qgTyViYoZw+UsjUwH12DFRdkTIFdIP6SKcZC9RPp31MZlTbeNmGGYPajZt0DFHGbfK/2QK9xWvHsLtegl34RQjfTxwz/IFdIPqZ4yis/I4C6vWFvxZJCpsJOvkjqPeoCrgloh3Z+cq8HdblVKj4igwLmG2LlY6VpenJBxB61ihjyVtjTUOnpkq7/F14ZM15S2LUbq1Jp5EuRO1FXMjNTY6ipNKyaI/wsyNzbeKH2QK/TzCeGXhpBWdkxLMNy8NQ+yy6mVdYkxbknS/9Zoh7qK1/LT7xnyVHhSMpm2qph7A6vxxKYTOEh/HmXVKCuD9EPSSD3vpe+AzMfP6v1B1qysxdxQMXOvR+pXNg1UCJKvhKyRvhui9N6QK6QfUjMyuEuCtnipU6ts4l1x6WeDXOH6TXcS7gr60VYTvdT5m5BpqMX8A5AnkHHurQz3oEHWSP3Uim5lQJ5KW5qiF7d24dp8bVCrp/XtO0b6yzD9M8ga6SvCrR+C3AluDcv0kNVYpRdKXfqYkWruPVBlMfWeObOjUmtUQVuspEuszLMudpq/iZyHi4p04+jcbQups9WN0rBiaho50g+JKv3km+t0hsq6ccRDW8XMQ1abfIz0XaeOXwBZQ70y6z4+ZCsN1TXVaCdG+tzxz9JHlX71bMsg/ZCaoe7ai2QC+nFVL1rUIWPZIGukXtdtlH5qDUxMmpJHyc9YMWTjMP1uuCt+3Rl1MAqS6+BqxUoTxdaoCIkVp07cGbLmrFIb0g9ZI3XXx0jfq5yn99LHBpkncLmb5QvSn4CrEXdUBuSKMtx6Vqu/xdcGBVsD8iFX8IRYbX7po2P6W5A7Qedb40VB6mzUwvsnuKjVtDvvizHIGh5v2uQrwuR78WfFsL9VbQOkRiig6nlBqsUdddDWfWaDPBWe5EmmK6L0Krj4OE0Mt4SrwvLXzJUh/ZCo8m2evtMdxw5Zw+89NPlmGZUxik7cD7KGejzWfWPIVhq+xQJZI31Uh1j5Wb6auTKkH1I7ozD7G5moLWFbHI+caPJNG+JmkDGtcc7DHrcCZXhMLf7UyHi6yv8u5AlkHHWVvgCyxr03B1kjddfHSB85Q8ga6WODrHF9dbOObVOlgD8V336R8ZAr6Er/R21+6eNnB5A7IdPSxdd6y4laNzvGx11QyBV22uzvIXfCSksGWUMLges3tzSKMLamv5S3OqTOBlnjLjN8G0THNkyhKanyDdLWC1Dd26Fwadp8bdC2fomd1n4phl8Os/3N682DbGJuE+mHxBfBl0udHFWvUepskDU5NUaafFJ3fYz00cXoCsiapp631KSeq5P2i1tBdjlcGsvXS78BcoX0Q5rOe2peSmCj1sVflUH2UvdqZwzJK8pQPDARr2S2pZHIuGmxdQPI6cr/VvPGHRX8PyJUY8WKwfwuVhy1LiFr+O1I6YeskbrrY6TPvdcpfWyQK1w/7eMnaV+rY1L00mciVJ2J7AHtQxUncGnaHrQw7lNyfS80Sp8L91Rk2lzt3msrw81zD3BqZitjZDraN+uFjmnItGyQKyaep4gYVze2o9LL5PK71PkbHJ+L5ylc2fAoDv07gaYzncI8scb4DTa4pu53E1S+1rh6+XKLQfrZZE/D8kXZayFraCMae05Sl5arjYfKZTn0k7ZVT5tgDLJG6q6Pkb6RcxGUPjbIdK7yw3Tbx8Z3EyyNGodIorF8zpj5kUofIv2Qu8MVBlVaE3PYSuOhI9S+bxzBwXnIV7CrdA2vW0v4pB/2Bx/ScyWE8TMgN3JaDe7vrodtR8WPRkgF65yvmYcB8gRU4d9exTlzYoyD+AXGV/Sz294hKr22/KmF8sWn+oMPs4//l+OrmS7bNnbuDRs7K4bJMbSur9vGuviVWK4U4dJwxWjW5Y54MVDlbB+/0P7xTeO0Ov4AKz1MzrXsIuPoonoL5E5wmnP7VH87TsbwsePGBut8W0mum830Sor+Vu29z7IXP13qbG5DoAn6fb2Jt0Hm1wb93ob8EpbZdpmO/67Tp1EE8U/xPChtaYfqxKVu/mfViU9ln/0bybZ1AlCEyVPPpbEvwnVlfTV6j1R+u6+5kw0pf52AkLFskDW8fG5dk/sg/e550ZZ2J0ysB4OyoWDpmDdj9+3N7DaTH5XBq3UwoOW/NT57mgGl/h9M91QliVm5BAAAAABJRU5ErkJggg==\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 110,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'ARTIST PERMIT REPORT'; },
                    }
                ],

                ajax: {
                    url: '{{ route('admin.artist_permit.datatable') }}',
                    data: function (d) {
                        // var status = $('select#new-permit-status').val();
                        d.request_type = $('select#new-request-type').val();
                        d.status = ['new'];
                        d.date = $('#new-applied-date').val()  ? selected_date : null;
                    }
                },
                // order: [[ 3, "desc" ]],
                columnDefs: [
                    {targets: [0, 2, 4, 5], className: 'no-wrap'},
                ],
                columns: [
                    {data: 'reference_number'},
                    {data: 'company_name'},
                    {data: 'artist_number'},
                    {data: 'request_type'},
                    {data: 'applied_date'},
                    {data: 'permit_status'}
                ],
                createdRow: function (row, data, index) {
                    $(row).click(function () {
                        location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '/application';
                    });
                },
                initComplete: function(setting, json){
                    $('#new-count').html(json.new_count);
                    $('#pending-count').html(json.pending_count);
                    $('#cancelled-count').html(json.cancelled_count);
                }
            });

            //clear fillte button
            $('#new-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); artistPermit.draw();});

            artistPermit.page.len($('#new-length-change').val());
            $('#new-length-change').change(function(){ artistPermit.page.len( $(this).val() ).draw(); });

            var search = $.fn.dataTable.util.throttle(function(v){ artistPermit.search(v).draw(); }, 500);
            $('input#search-new-request').keyup(function(){ search($(this).val()); });
        }
    </script>

@endsection
{{--@include('admin.artist_permit.includes.artist-block-modal')--}}

