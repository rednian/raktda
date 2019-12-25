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
        <li id="active_artist_click" class="nav-item"><a class="nav-link" data-toggle="tab" href="#" data-target="#">
                <span  style="font-size: 11px">{{__('ACTIVE ARTISTS')}}</span>
                <input type="text" value="active" id="active_artist_input" hidden>
            </a></li>
        <li  id="blocked_artist_click" class="nav-item"><a class="nav-link" data-toggle="tab" href="#" data-target="#">
                <span  style="font-size: 11px">{{__('BLOCKED ARTISTS')}}</span>
                <input type="text" value='blocked' id="blocked_artist_input" hidden>
            </a></li>
        <li  id="single_permit_type_click" class="nav-item"><a class="nav-link" data-toggle="tab" href="#">
                <span style="font-size: 11px">{{__('ARTISTS WITH SINGLE PERMIT')}}</span>
                <input type="text" value='single' id="single_permit_type_input" hidden>
            </a></li>
        <li  id="multiple_permit_type_click" class="nav-item"><a class="nav-link" data-toggle="tab" href="#">
                <span style="font-size: 11px">{{__('ARTISTS WITH MULTIPLE PERMITS')}}</span>
                <input type="text" value='multiple' id="multiple_permit_type_input" hidden>
            </a></li>
        <li  id="all_permit_type_click" class="nav-item"><a class="nav-link" data-toggle="tab" href="#">
                <span style="font-size: 11px">{{__('ARTISTS WITH ALL PERMITS')}}</span>
                <input type="text" value='all' id="all_permit_type_input" hidden>
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
        <th><select type="text" id="search_by_gender" style="width: 100%;border: none;margin-top: 1px" class="form-control form-control-sm custom-select-sm custom-select" >
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
        <th style="width: 14%;font-weight: bold">{{ __(' CODE') }}</th>
        <th style="width: 14%;font-weight: bold">{{ __('STATUS') }}</th>
        <th style="font-weight: bold">{{ __('NAME') }}</th>
        <th style="font-weight: bold">{{ __('PROFESSION') }}</th>
        <th style="font-weight: bold">{{ __('NATIONALITY') }}</th>
        <th style="width: 14%;font-weight: bold">{{ __('MOBILE') }}</th>
        <th style="font-weight: bold">{{ __('PERMIT') }}</th>
        <th style="font-weight: bold">{{ __('EMAIL') }}</th>
        <th style="font-weight: bold">{{ __('IDENTIFICATION NUMBER') }}</th>
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
            <div class="modal-content" style="font-family: Arial">
                <div class="modal-header" style="background-color: #f7b100;">
                    <h5 class="modal-title hover_title__{{$artists->artist_id}}" id="exampleModalLabel" style="font-weight:bold;margin-left:36%;color: white">
                        {{
                          Auth()->user()->LanguageId == 1 ? $artists->firstname_en . " " . $artists->lastname_en ."'s Report" : $artists->firstname_ar . " " . $artists->lastname_ar."s' Report"                 }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container" id="tableToPrint_{{$artists->artist_id}}">
                        <table class="table table-bordered" id="artistTableHide_{{$artists->artist_id}}" style="font-family:arial;display: none;font-size: 11px">
                            <tr>
                                <td colspan="5" ><img style="height: 50px;float: left;margin-top: 47px" src='data:image/png;base64,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'/></td>
                                <td colspan="6" width="2%"><img style="height: 120px;float: right;margin-bottom: 13px" src='data:image/png;base64,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'/></td>
                            </tr>
                            <tr><th colspan="12" style="background-color: rgba(162,19,0,0.87);color:white">
                                    {{Auth()->user()->LanguageId == 1 ? $artistWithThisId->firstname_en . " " . $artistWithThisId->lastname_en."'s Details"  : $artists->firstname_ar. " ".$artistWithThisId->lastname_ar."'s Details'"}}
                                </th>
                            </tr>
                            <tr style="font-size: 10px">
                                <th>CODE</th>

                                <th>PROFESSION</th>
                                <th>NATIONALITY</th>
                                <th>STATUS</th>
                                <th>E-MAIL</th>
                                <th>VISA NO</th>
                                <th>PASSPORT</th>
                                <th>PASS. EXPIRE</th>
                                <th>AREA</th>

                            </tr>
                            <tr>
                                <td>{{$artistWithThisId->artist->person_code}}</td>
                                <td>{{Auth()->user()->LanguageId == 1 ?  $artistWithThisId->profession->name_en  :$artistWithThisId->artistPermit->profession->name_ar}}</td>
                                <td>{{Auth()->user()->LanguageId == 1 ? $artistWithThisId->country->nationality_en:$artistWithThisId->artistPermit->country->nationality_ar}}</td>
                                <td>{{$artistWithThisId->artist->artist_status}}</td>
                                <td>{{$artistWithThisId->email}}</td>
                                <td>{{$artistWithThisId->visa_number}}</td>
                                <td>{{$artistWithThisId->passport_number}}</td>

                                <?php
                                $passport_expire_date=\Illuminate\Support\Facades\Date::make($artistWithThisId->passport_expire_date)->format('d/m/Y');
                                ?>
                                <td>{{$passport_expire_date}}</td>
                                <td>{{$artistWithThisId->area->area_en}}</td>


                            </tr>
                        </table>


                        <table class="table table-hover" style="font-size: 12px;margin-top:3%;font-family:Arial" id="printTable_{{$artists->artist_id}}">
                            <thead>
                            <tr><th colspan="8"  style="background-color: #bf4b4b;color: white;text-align: center">
                                    {{Auth()->user()->LanguageId == 1 ? $artistWithThisId->firstname_en . " " . $artistWithThisId->lastname_en."'s Permit Details" : $artists->firstname_ar." "."'s Permit Details"}}
                                </th></tr>
                            <tr style="">
                                <th style="width: 14% ;font-weight: bold;font-size: 10px">{{ __('NAME') }}</th>
                                <th style="width: 14%; font-weight: bold;font-size: 10px">{{ __('PERMIT No.') }}</th>
                                <th style=" font-weight: bold;font-size: 10px">{{ __('REFERENCE No.') }}</th>
                                <th style=" font-weight: bold;font-size: 10px">{{ __('ISSUED') }}</th>
                                <th style=" font-weight: bold;font-size: 10px">{{ __('EXPIRY') }}</th>
                                <th style="width: 14%;font-weight: bold;font-size: 10px">{{ __('STATUS') }}</th>
                                <th style=" font-weight: bold;font-size: 10px">{{ __('COMPANY') }}</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            $permits=\App\Artist::where('artist_id',$artistWithThisId->artist_id)->with('permit')->first();

                            ?>
                            @foreach($permits->permit as $permit)

                                <tr>
                                    <td>{{ Auth()->user()->LanguageId == 1 ? $artists->firstname_en . ' ' . $artists->lastname_en  : $artists->firstname_ar . ' ' . $artists->lastname_ar}}
                                    <td>{{$permit->permit_number}}</td>
                                    <td>{{$permit->reference_number}}</td>
                                    <?php
                                    $issued_date= \Illuminate\Support\Facades\Date::make($permit->issued_date)->format('d/m/Y');
                                    $expire_date= \Illuminate\Support\Facades\Date::make($permit->expired_date)->format('d/m/Y');
                                    ?>
                                    <td>{{$issued_date}}</td>
                                    <td>{{$expire_date}}</td>
                                    <td>{{$permit->permit_status}}</td>
                                    <td>{{$permit->company? $permit->company->name_en:''}}</td>
                                </tr>


                            @endforeach
                            <tr><td colspan="2" style="color: grey">Total Permits : <span style="color: black">{{$permits->permit->count()}}</span></td></tr>

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
            $('#collapse_button').click(function () {
                $('#navbarCollapse').toggle(300)
            })

            var currentdate = new Date();
            var datetime = + currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            table= $('#block-artist').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                "columnDefs": [
                    {
                        "targets": [ 7,8,9 ],
                        "visible": false,
                        "searchable": false
                    },

                ],

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
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.bgColor = 'red';
                            doc.styles.title.fontSize = 13;

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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
                                height: 50,
                                alignment: "right",
                                image:'data:image/png;base64,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\n'
                            });

                        },

                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },

                        title: function () {
                            return  'ARTIST REPORT'; },
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
                    {data: 'artist_status',name:'artist_status'},
                    {data: 'artist_name',name:'artist_name'},
                    {data: 'profession',name:'profession'},
                    {data: 'nationality',name:'nationality'},
                    {data: 'mobile_number',name:'mobile_number'},
                    {data: 'permit_status',name:'permit_status'},
                    {data: 'email',name:'email'},
                    {data: 'identification_number',name:'identification_number'},
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
            var dataTable = $('#block-artist').DataTable({
                dom: 'Bfrtip',
                buttons: ['pageLength',
                    {
                        extend: 'pdf',
                        title: function () {
                            if(filter_search==1){
                                return 'ARTISTS LIST SAECHED BY STATUS '; }
                            if(filter_search==3){
                                return 'ARTISTS LIST SEARCHED BY NAME '; }
                            if(filter_search ==4){
                                return 'ARTISTS LIST SEARCHED NY PROFESSION'; }

                            if(filter_search==5){
                                return 'ARTISTS LIST SEARCHED BY NATIONALITY '; }

                            if(filter_search==6){
                                if(search_artist=='single') {
                                    return "ARTISTS HAVING SINGLE PERMIT";
                                }
                                if(search_artist=='multiple'){
                                    return "ARTISTS HAVING MORE THAN ONE PERMIT";
                                }
                            }
                            if(filter_search==7){
                                return 'ARTISTS LIST SEARCHED BY VISA TYPE '; }

                            if(filter_search==8){
                                return 'ARTISTS LIST SEARCHED BY AGE '; }

                            if(filter_search==9){
                                return 'ARTISTS LIST SEARCHED BY AREA '; }
                        },

                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;

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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWYAAABSCAYAAABnun4ZAAAACXBIWXMAACHUAAAh1AHW21Z5AAAigUlEQVR4Xu2dCbgsR1XHK9Pdw1vunV4uETHEqCAEUBIQECG4gFFQVEQUNAqKC4KoIJ+Kgl9AQUXFuKB+ghvggoD7BihEEJcIggoSsrw7091z38sDEohsBgl6Tt1/9TtV093Ts91lbv2+77x3+39OVXdX91RXdVdXK49nnSl68bflveQJWPR4PB7PfjHubT217G/9XxmkN0DyeDwez34xVvGlRZT9AxY9Ho/Hs9/oljIsD5PX5GH6R3B5PB6PZ78ogvjXZAUN2ePxeDwHAV8xezwezwGAauLzyij7H18pe5YFn1P407NulFH6VvzpWSJXKxUWYfK07X72SX8Lw7NsyiD5DfzpWTfKMHnlsiqLcZRehT89glIl9xmr+L5YrPCVtGdeyiAb+vNnjTGtuHEQfymkuaD0D/cnSneKIP5aLq8iHDwQksfTCfOb5Z4YJM86YQ6wtij+GOS5OHeyDD4CydNCGQ0+asoMksfTSqEGDzDnzK5l/wnX4eFdSm0Mg/T6m9TJO0GqGAXJdXrHwvTPIB1J5EHejrLbIc+FzAuSpwVZXkWYPhPykSEPk4fmvewdr1IqgGQ4j1qCn+ByGamNh0A78pRRdps8Z/R5o9RxuA8HZZDp+6bGqNKpmvxSZxurwePgOlKMws3CLQu45sLKK4j/C7KnAau8yCAfCbbDzQ9b+x9u3sr6WG0+2NLJRr3kaTrREYXLRpZHESWvL6Ld8fAIORwMw/R9cke6GJIeKXi/6YL1/mWVg8xn0bzWnRvDwf3d8jp0rZ85cfe7iyHpkSKPNv+7qRzc5UOD3Blj2yq5hFpyj5nwRck1SHZkoC7ivXjf+W9ZFto5B1Suj5X5sOXq+KfB7XGgc+6Fbnlt97eOxIMcOsmOufvONlbphXmYvmJCj5InIunaU/SSb3L3ny0Ps79CiMboWDxcyB3j8aSQ1fVK3cHoRZSehXykGEabH+L9579NWbCR0NcBMzKK0jfJfNiGUfa/cHsciih7kVtebHAfCZr2m3oOmdHfrTa3IK8tpcoew893ZHlIo8Jx78HrsiuC9LexePgYh9nN+NMj4AOb93ZbInL+hjxMnqIDZmQUZgVVxJ/Io/ifTV5scHscqMwfrcsoSt8my2tHqTsi5EhA+3sCfx4ZhmrjnqZh1GZFGJ9BEoubVPxZ7OfBDZA86wIfWPypqPt4WXVChOmfQJ6JMspu5leN9d8mL7KRij9TB3gsRlF8Py4f/luW13a0+WEd4FkbdsLk++UxbrIizP6cx7ZTb+oveBnJJ+CRZm1+zyHF3MrBosacHGVvvnGRw2hQe2uEumif0AEei1Pq5J1MedEP8S2yzHSAZ225Uqke/qyFelGtc6kcqvOEtjIgi7Bowd2lHbVxcYFuI/3/i3CtFTzOka+mWGzktEouGkXJv2BRYw52GSU3QZoJqlyqk6kIk1dX+UHzTCLLRpYXiWs7KQ11v/u5itOxOnbhjtq6eBQkj6KW4pXcShxF2Xt5/8dqsTdQDzvmPMDiBOyj39hzsHiwKNXm55sd6GpFmP4gkq8VPFDf3de2q3IZJC+lo2495DPpeMA/pJmQFTNj8pOax4bLhgpHHydZXmUQ/5IOOMTkQfJz1j5NMT3JU5R8M5IfaUyZYHGCNt++YjbctVPhYFyGyY8OVXbPW1QaI3ztqSsLNrgnOKNOfgr+rDBphkH8JZBmYjsafESu0+THNlJ38PeZa+CyMQ9wyjD9YVlmOuAQckqpWO6HNGoZj8pe/PRCDe5GO3gMSTwOprywaDFWyVc3+fYN2prQbPS4N/geyEeecS99vCkXY/xKK9xTodZuNSoD0szoh38ifdFL/83kWcx5e2Td4bI5rTbOx6J1MYN0qMjVyXvztvNLS5A8c9B2DtDv7Jaylx2sr6vzxuZh/ANY9AjoB65fGNm17DbIUzmXhirQYPDlkGemCAc7nAcW1VC8ROBnwKqHyyYXL0+Y8mKDdKjg7a6Z98IzA/z2pzkHzih1EnLFgTs36Md9+yl17NOx6GmgDNJt/NlKHma5OQHYinDrZXDNBV0M3umeNDJ/SB6BLvcoeT0WqTUUnzblNe3J/UHDX3yXQ6EG1cs1dRVzESYH504BP8Utw+xvsOhZgCJIH2EOvLGzanBXuOemCOMf5LywqJHrgOQRlFH6AVk2Z5X6VFNeI3XizpAPPDtB+twz/jnCUrhebZxvzoG6ivlAIU9ez/yYA15ZsLW0VzrpAPV1nlFyCSRV9LK3m3VBOhCMVXwp/txXijD9c7dsTHnx/VpIB56DdnwPM0N1oro481h3yEsnV+m9Ty06QIJnWcKfnjngb86Zg60tyF4I11LhvEdR9u1YpOOWPMGsE9K+kAfZ5fxWIm8Ht0gg7zt5mD7ZLRtTXnv5gIefB+Rh/Ix5Wmh5b/DdB3ZM7SFEVsz86jXkpVGdX8LmeljLQ2y21YmqFeaZDesghMkrIa8EvY4ofTEW1buV2jLrhrRnlEH8sGq/2YL0wI0NvgVDy7CoMdu7F/cSacXnVeVDxsNN4eoMp8OfniUgK2bqfd4H8sLQQepV+TbY6SB9BMKnwwnw51LgN4/kxpxd44lA5H4a24ni+8G9dDj/Isr+EYsas14srhQeH2vWx7bd37qdx9XCfSBxy6ba/mDzkZBWRrUuGPes4OoMp8OfS2EYpi+T2wT5yCAr5lGYPhjywsgybTOeXAlJ2uFg/LkweZj8iLshy8z/IGGGrzUZz22xrZKLEL4UON/C+W6gWR8WVwJVKNYr4HmQ/CZcBx63bMw+nFHxZ0BaCWY90uDqDPVCHjlPuibc7WE7anOtyIp5p598DeSFKKP4jCzTLoak9ZipEbG4EDxrmrtyY2N1YuKz8oeduv1sMh7qlIcbOZLOjfnqMxY1Zh1YXCpFL36myZ+NVnKohpgxbtmYfVnlE/lt1b+HWY8xuGZikbQucltcQ8jCmPyosv/kKExeyw9YC7XxheMouYa0c/MhY5bE/cC6lRGmT4a8ECY//mwXJA0t371aV41tR5v1H1XOo+yvOQCLc5MH6XPdlbqG0LWCZ4qr29dZDdl1QsbzvLPz5NEFk++ol/0HpEOJWzarKi+JWYe2IP1xyDOzrG0tI/ubdhMWJa9D6NxM60FK47dWkWzPkRVzEaTPhzw3fDuP88JiLcW08jcWJT+zm6C/+1VYvTAn8msI2qj7pXVnY3TwmkI7F8xbSe+odKaXeob9c18tKcL0d3Q+UfZBSEvBbBvt11xfWzlI8H7gT43ZNywunTwYfJlZx6L335exreMweY7Jh21bbd2Ddamx6eAFcPNrM54WF8k6Y9LySBtIc1Go4xeIvP4Y8lzw6/6cDxZb4fdEzHrbbDdYLszJRKYC6ZvnYBi48sefS4NbEfhzqVyr1Kbc71aL0rch2VxU+QTZYyAtjMkTi0vjhn0aN2y+IsNQC2m4qv0zmPzft4TvMS66rfz6tsmjLp8236zIvNpsnu8uunmMwuy9cM0MN4SqvIL0RshzwXkMo+x9WGyk4Pk3zDqnmE7AhcQL81aaExk68DSgVUyUfQDyzOj0c375o462bV4E+uFfVe2vY/ztQzpAb6GT6g+KaHAFkswNbXw1FAvSwpzCDHY8+gLSUsjV4K56W2ds2dOOBUXDp/XnGe1jymscpC+AtFR4CB7nP4qyN0FaCLO9WJwZk76pMuRvRpqYvDd/SzQP498z+UwzJOmMqaNcK8JsrqGpY+oxyHwgz0ypsru0pc+j9MVyPV0MSSnzKPlXFuaZnYya5n8wkWENJmZaXBP8rTuTnlujkOdGbg9VFJ0nI5qGlS9sHGRfD/fSkeuBtBBVS38FD2bm3dYyHOzgTwuei5gqwS/CYifkV8YhLZ1l52/yGwXxwyB1Rn6aH9IEQ7X5IBPTFtfGWG1OPOistV72LiTpzLSHZ7PeBmTMA3Rj1GWt/fjHNEx6LGrGUfytMu8uRheYV1Em9sRUwzB5qgmA1BmTjlrbA0i1mDhtYfq7kDuR9yZ3lDa0+hr3LLjdOmNwz03djf33q6y1TBZF/hiKKK7eBFwE0zLB4lIx22oMciv0gznRFMv6rD/KWdc/K1Tx6Emm6Ngs7avTZntn7f7zV0u67quJ6xLrQj3iszK9saG6w1KGIvJoprr8pSG0M0vJI0heqdMG6Q1csVNPWD+r62qdXgU3we+fUsFKTBpuzUJqxL3pPe74lWjqZr1fprOMWnVdpz+8Wswx3WSzVqSjKP2OunyoJfcShKyMf1fqpFwn5IVZdn6GugsiH1u4a8nD5NkcxzMeQtLQxs11+8akYeNpHyEvlXm2axq5uuPnzZOvSTNyhm/VYWKN8evjcE1wrdrazIP0FW4atnGYvhFhS6NuPXV2gzp2IZI0wre+6tIa44ncENrIjtq4I9Vfr6lL32ZFL307suiOzABSK3I6S0hTkeuoLIo/RhXsm0dh+id8L5q6pk+l/623krpaEaV/V0TJT/ObVdqi+NfK/uCjdbGyi1dr0eCj+tuFUfK6cZS9tutoC+zqSuGXIuQ6uUcB10LwG1Cr3A+5zdL4G3T8sgo/PzDfo7P8Yfz7eZRe7epNn52vg86xj8u0kJeKyTtXauqPe1aqbe/4Uk8VTwaplW117CKZxhhP1cAjgOp8lkXZzchq6TRdBJqMWq4fGEfpL1FdcEXZzx5Lv+Pn151X8jZsre1+kb7zA7s6W3gonhzjOG1Sj7GK72ti+YEO5KlMHUe5R1YE8bW8PVQZfFWdfx6jbqbVqlsVY3SVz613eW9s8Sf9Tb6Qlorc7mUYsp3KvOlmwXzya1X5z7L9VCH97TzbItcxi1EdcDmyWBn8mbain7696CXfM+445KzNuPHH+Zrna8u002pwf73Ry0JmDqmWrnF1yLT7Yur4XbApmlnvC9UZfx0c2a0M/p5f3brhXgqrytege0diHYsYsmyFWjt6HmbL1LnpUpcF/cjfYPJf1ZdFqDKqxiEX/ezjkCfgbraJK4PspZA7U6XtYPv9GnfdNnUxJK/gaRPq4job9a6R1WqQK3Pv6xlkDKSZqe1WTLFRED98GAx+oc7XxfJe+jisfgK+XVGXptWCbHuRMdldKdTgAbXrJ0PI0lhl3kweDdpvH3UwupD+JbJrpOjXXwDyIF766Bjqqr5crgPySpDrGVLPCbLEmsUO2szIPOqMe2nzjmJYJnXb1mY8EgNJJ8jD9Fl1aaYZnVNzv9HZGb557q4YLg39KM7dp5tz/KCE5ymgK/zF21FyiWtFL36SWVcRJq9GksbKI1fHP40q2PuUQfzFRTh4AL4QPNOcDjxULI/iz6Mf9qPpQF3G+eltiZLPHav0wlW1huooorTxIsStfIQtFbkOSEvFnD91Iyl4FMMptXl3Lu9RFN9v1M/udZ06fkHXY1g6Q75cW3iy8hpGUfIvch1Xr/iL1HmU/ZNcn3z7k5G+Zewv3z4YhZsPLqKtK8ZRfGnbA8G9Ru4rJPUe6i3wcyr+/NooSK7Lg+RnRyqe6YsvXG58bzoPspeMg/QqfoOTf/twV5hnV1hcPXKH2wzhK6MIsyvr1mU+PspDaCCtFcP+VuuDllVOn0oVp57knm0VvQHOly6yC8/HIKFtfovZ5lqbY+7jLkysZ9XdWTCx3hpr6u2uC9aDXJU9CPKewhXzjar/2VjcG+RBrjOqKVc+dwIPRK/WiR8zrTcyGs/3rAPXgFwN7l/ta43xg6WhihOEr4w8TB4q1wt5KZjbV1hcGH7YKrd1wua4v9oFalGde5VXGNwrh3uEdeuXhtC1xMzrw+b2GPYSrpjx595B3ejGV4r5bSuErZS6dUtD2FrADw+HUXzfYRA/hlqAT+IKslDZBXDvKVY5h/FSPszLn9RZ5jHj21bUveYhUK/VLeYgeWkRDL68yxjURZAjL6TBvWfUbYMxfviHsLWibhw8XPvCvlTMDHfN3IIowuwv4F45RS9u7KKOVfxwhHmWDN8ikmXdZXKWJuQMXvxCDORDBf36a98UNYawPad27ghnxNE6QOfNp0zsJ9m4w8skq2Rfv496WmX35CFO/GYfnYHnQd4TaH3VbQtp7pc7PMuFyt36JJixvNftTU1mFKXfKdPyV7zhOhRcyd9tC7Pfl/swYSt8oaIr9Nv8Vd4WfigI6dBgylHPgRNlLxpH2RPZ+IGd6WE1GTUQ/xDZePYDdygSG1yeFUI/+NNuuVsWxWf4Tc08zJ5OFdj38wQs/JCtNpYM2R5YeBQOXzzqtr3O3qtO3BlJPQsw9e3bOtuDbzR6DghlkH4F/vQA/ixQ7Q9jRkN2B5Iy7P4mKpcHknmWTJdzjaeAQLhnHdDdUnGAC/G5eupyWy+6rNNIj2VQBslvyPKZyXrZPyCbQwG3/PMo/udhuFWW4da4jJJryjD9Ybg9e0QeZF9fRukvl1H2Qjomnw/Zs27UVhptttdjEw8BRZhaH2Nts3GQ/iSSeTweTz11lUebIZmnBe5Z8LSZbPywkKQ9fTDs8XjWAFnxjoL4sZDVGTV4YOXzoz08Ho9nb+H5NvitLSxa+HvLHo/H4/F4PB6Px+PxeDwej8fj8Xg8Ho/H4/F4PB6Px+PxeA4IeRQ/z4w7H0aDD0P2OKB8PsRlxH9DXjn85RT9XUeeMjjIboS8Mnga4oMwy18TPAx3O8o+UUZbt/J7EkV/8c/xNbL7xtfxC86o+DNKld1lL74Q7fGYCtnYONwq4fI4uGUFeeXIdRbRYKVzpZRR+ja5PsgHDrmN4yB9AeTl0PZhUGk7UfodSOJZY/b6C8l5mL7CPdeK3hY1SNpx0zQZwg8s8ruGkFqR+9Y1DTMxJ0qUfRAui9MqucjEDIPk1yE7611h65Cw16U/d7dnH0qeBbmNdBy/HfJiFL3kCpkx27iXvkm2kssgfpgVE2Sn4PKsGXRsv04f42hvZ47jde6oY9Vbm1wxjKKta7DYiHVekvHXzvVnu+T3JGEH9YfNyO3sclGU8WyQp5IHyVdbaaP6D+caf9FLrQ8g2GmzX4W8Ego5nQIZ5AOH3Eb+/UCeH57/VGbK90rgqqUM0z/luEKpDJJnjZDnwihKfwXyyhmpE3fmddKfM0+U5H5+CbKGFs6TPtd/UOBbh7Nup4yd5Wvy4zB9sExbBFnVGjZU/pq5ZWTaMkqfB3ml8HHEnwcSWSYjasRCno+yF3+XzLDrJOH+ky/rizwfeO5iyCvHrJNacy+B1Bn94EVsN+QK6avzHwT4S9CzbqeMLcIBdXC7Mepv3Eum5TmR4dKYL440fZ3aSuvnstbIMhmF6UMgz4fMjA2y5wgjz4c8Sh8HeeXI9ULqDFUsH29LL311/oOAu41sRZj8GNy1yFi6oL0H8lSG/EBfpC2jrefDpcb97NlGhzSBlTZMnwz5SCPLZBjFl0KeHTqZf0VmNktXaBo8nEbmbYyOtNUdcf2QJ2jy51H21zJ9Uxwj/YVKPpe1Ikr/jpepxXW7DiJknPkasaWxBekNOljgxrA2CrcKqRVh+jIdTAyVSqSP7W0tI1/I/0E3ng3uimEQP9r10z8T3fkiiq0HFFp3vgE47O8OwxpGmx9CWCdOKRXLfIxRRf9GhFRoH39JRMb1B9U34hDWCp3Lt8n0kCukr87PFEF8rRvXFMsUvfQb3dhiznvydD79Nqcfqv7Fbp4IqUXGFf30rZCnckadtL9IHWY/yvr1Sg2MpgMbsNJG6XdNaFqPT+vgGvTXY9x4Mrgt2mLqfMMwe4bU5NffKWDid5CH6WVwW1Bs6MayNd0tkDHbUXKJq2nr8LxkItFQbVwM19yMlLh3Je5NUUVddTXzXvJEyHxfLaviyajiejlcFsaPRY1MB8nSSLQenkjfTSr+LPox32yW8372CoRZcWO1uSWXLQsHYyTRWL4ouanp4jTuZU/Me/G31vnYkF0FCdbJBLl2/xmq/O4tfbmKU7ksrQjSRyAZ36e9fRvjYSuLsg9wpVxEm7cibCrb0WaVBz9kYo2PhcxXBwIup5r13szrbOpKu8xSMdPF+CxkTRnEj5X+OkNoBZeL9kUpXUt3x7Ga2DyMf08HzYBcD1X4/2aW2UhsvLcq45ZRMZtlHdSClTbKnmAtC9vuDz6CJJq2894YQivot/T6Jr/U2Yogu9HV2Ia97J3XKrVZ52PbVid0RWoo+3YPbMKoh4bQCukf9TP7VpGwYZDS9a8FNwHkhWjLT/rI2YM8dTuoNas/cU614BYk+2FPkL4YsqKK9B6VTgZZI3XzoMlYU8XMNg6Sn2ed8r6769MJgOszft7XOt8N6tiF7M/drzZTpc66Qfr4oQ1kVYTxD51Lk90GWe2ojTvKNGzmnhe1kp/k+nQigfSN+5t3h9wJquTebdK6FSB3y2XekCukj7a32s8u0P7/j0wPWVMG2XaTj+GvgBdOmV+vNs6XaSYq84a86rRpmId+XHlAssqCzu/G0U8ybhylb4A8lbqK2fxNF/bq99SElZYt3B0yxz1M16cTAL7dQj2Td2NRw6NwZLx7LGj/q5eN2CBrpO763QfCbEN8eTvvDZ7i+nQiwMv0e7fOQTrHbmmKZ6SPLQ+TZ7NeqPRzXJ9O0MRMwR3gB4dt+UmffMhIV6fGHxXj6rJ10hbv+qRutpUq3UdRRfgtfEsEYVYcG2QNxb6w0Sd010c/msdL3zjKfgoujfSxQaaLQd+6GECuqPPxMCupcwsMLg11tzuVd51vGtPSSr+5TWSQvkUrZmrJvpkuQh+TGuU500Mq0yAwBtm6IEKqIGHmoXh1eRmtzieRMQtVzI4hrJG2eOrqP63J1wQ3LJrS0G/TamVD1pT9wUebfIz0uf42XxMyvugNHg9ZI31skDV0YX9Dk28CGTg1uANWfkHys5Ar3KfOkBXV0CelTjv8jXAxu9343u59LIau6FfLeMgV0leEgwdC7ry/MoZOsisha/7d2VbIGqm7Pkb6yFn1GBjpY4M8U57c8oJs6XQhyyBryp59Dw5yRZuvDTpGfz8trfS7MVJftGJ2K9U8TJ+F0M6Mwsx6PgCZW/7PkTqte6FXhd38GX5zTK5jWyUXwWUhYxa5lbEdDT4il9kQWouMo5bhayBXSD+kVvSr3Q1p8mBweZNvGG5a96ohV0gfHbcvgqyhMr5K+iG3IuOpl/B9kDXSR2XyFMgV0g+pHhk4NRg0pcnV4K5Spy7wPeCqoArhP2UMZI3UpY/SvHNaLP8wLJM+8cRY6nQF+0XIE8i4U+rknSBXSD8kjdT5RINcIf2UsNNDUFdv21c+BkjWuI2MO4YVckWbr41pPSZG+t0YqS9aMWtNLButC/xiSt09Rrg1rs/YUKljCOkE9cCu0Wl7ifUjZ9y8IVtI/0L3mIP0udYymbmFV4eMG0Xpd0KukH5ItYyD+EunDRNcVsV8hhpVkDXUc/w26YdcC4/zlrHaWipmOq73gVwh/ZDqkYFs/EQWrkbcNJC5Ffs4qfNwHLgq+B6ajIGsoR/Wm+t8/DffK8KiRsbtWvqsJhupjXshmZWOWlCNQ3xk3Gm1cT5kDW2Ydb8YskbqPMEL5Arpp4TzVcw1+2jsfUptIpmVDlIFD35v87f52pDpmtK2xUhdPpTsAp0/E11hqjCsFtEwan6QWATJT8vYUbD5qCJKXic1hGr0ZDXCJ41+R3dA2FTq0jcZklhIP48qgTyViYoZw+UsjUwH12DFRdkTIFdIP6SKcZC9RPp31MZlTbeNmGGYPajZt0DFHGbfK/2QK9xWvHsLtegl34RQjfTxwz/IFdIPqZ4yis/I4C6vWFvxZJCpsJOvkjqPeoCrgloh3Z+cq8HdblVKj4igwLmG2LlY6VpenJBxB61ihjyVtjTUOnpkq7/F14ZM15S2LUbq1Jp5EuRO1FXMjNTY6ipNKyaI/wsyNzbeKH2QK/TzCeGXhpBWdkxLMNy8NQ+yy6mVdYkxbknS/9Zoh7qK1/LT7xnyVHhSMpm2qph7A6vxxKYTOEh/HmXVKCuD9EPSSD3vpe+AzMfP6v1B1qysxdxQMXOvR+pXNg1UCJKvhKyRvhui9N6QK6QfUjMyuEuCtnipU6ts4l1x6WeDXOH6TXcS7gr60VYTvdT5m5BpqMX8A5AnkHHurQz3oEHWSP3Uim5lQJ5KW5qiF7d24dp8bVCrp/XtO0b6yzD9M8ga6SvCrR+C3AluDcv0kNVYpRdKXfqYkWruPVBlMfWeObOjUmtUQVuspEuszLMudpq/iZyHi4p04+jcbQups9WN0rBiaho50g+JKv3km+t0hsq6ccRDW8XMQ1abfIz0XaeOXwBZQ70y6z4+ZCsN1TXVaCdG+tzxz9JHlX71bMsg/ZCaoe7ai2QC+nFVL1rUIWPZIGukXtdtlH5qDUxMmpJHyc9YMWTjMP1uuCt+3Rl1MAqS6+BqxUoTxdaoCIkVp07cGbLmrFIb0g9ZI3XXx0jfq5yn99LHBpkncLmb5QvSn4CrEXdUBuSKMtx6Vqu/xdcGBVsD8iFX8IRYbX7po2P6W5A7Qedb40VB6mzUwvsnuKjVtDvvizHIGh5v2uQrwuR78WfFsL9VbQOkRiig6nlBqsUdddDWfWaDPBWe5EmmK6L0Krj4OE0Mt4SrwvLXzJUh/ZCo8m2evtMdxw5Zw+89NPlmGZUxik7cD7KGejzWfWPIVhq+xQJZI31Uh1j5Wb6auTKkH1I7ozD7G5moLWFbHI+caPJNG+JmkDGtcc7DHrcCZXhMLf7UyHi6yv8u5AlkHHWVvgCyxr03B1kjddfHSB85Q8ga6WODrHF9dbOObVOlgD8V336R8ZAr6Er/R21+6eNnB5A7IdPSxdd6y4laNzvGx11QyBV22uzvIXfCSksGWUMLges3tzSKMLamv5S3OqTOBlnjLjN8G0THNkyhKanyDdLWC1Dd26Fwadp8bdC2fomd1n4phl8Os/3N682DbGJuE+mHxBfBl0udHFWvUepskDU5NUaafFJ3fYz00cXoCsiapp631KSeq5P2i1tBdjlcGsvXS78BcoX0Q5rOe2peSmCj1sVflUH2UvdqZwzJK8pQPDARr2S2pZHIuGmxdQPI6cr/VvPGHRX8PyJUY8WKwfwuVhy1LiFr+O1I6YeskbrrY6TPvdcpfWyQK1w/7eMnaV+rY1L00mciVJ2J7AHtQxUncGnaHrQw7lNyfS80Sp8L91Rk2lzt3msrw81zD3BqZitjZDraN+uFjmnItGyQKyaep4gYVze2o9LL5PK71PkbHJ+L5ylc2fAoDv07gaYzncI8scb4DTa4pu53E1S+1rh6+XKLQfrZZE/D8kXZayFraCMae05Sl5arjYfKZTn0k7ZVT5tgDLJG6q6Pkb6RcxGUPjbIdK7yw3Tbx8Z3EyyNGodIorF8zpj5kUofIv2Qu8MVBlVaE3PYSuOhI9S+bxzBwXnIV7CrdA2vW0v4pB/2Bx/ScyWE8TMgN3JaDe7vrodtR8WPRkgF65yvmYcB8gRU4d9exTlzYoyD+AXGV/Sz294hKr22/KmF8sWn+oMPs4//l+OrmS7bNnbuDRs7K4bJMbSur9vGuviVWK4U4dJwxWjW5Y54MVDlbB+/0P7xTeO0Ov4AKz1MzrXsIuPoonoL5E5wmnP7VH87TsbwsePGBut8W0mum830Sor+Vu29z7IXP13qbG5DoAn6fb2Jt0Hm1wb93ob8EpbZdpmO/67Tp1EE8U/xPChtaYfqxKVu/mfViU9ln/0bybZ1AlCEyVPPpbEvwnVlfTV6j1R+u6+5kw0pf52AkLFskDW8fG5dk/sg/e550ZZ2J0ysB4OyoWDpmDdj9+3N7DaTH5XBq3UwoOW/NT57mgGl/h9M91QliVm5BAAAAABJRU5ErkJggg==\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                                return 'ARTISTS LIST SAECHED BY STATUS '; }
                            if(filter_search==3){
                                return 'ARTISTS LIST SEARCHED BY NAME '; }
                            if(filter_search ==4){
                                return 'ARTISTS LIST SEARCHED NY PROFESSION'; }

                            if(filter_search==5){
                                return 'ARTISTS LIST SEARCHED BY NATIONALITY '; }

                            if(filter_search==6){
                                if(search_artist=='single') {
                                    return "ARTISTS HAVING SINGLE PERMIT";
                                }
                                if(search_artist=='multiple'){
                                    return "ARTISTS HAVING MORE THAN ONE PERMIT";
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
                    {data: 'artist_status',name:'artist_status'},
                    {data: 'artist_name',name:'artist_name'},
                    {data: 'profession',name:'profession'},
                    {data: 'nationality',name:'nationality'},
                    {data: 'mobile_number',name:'mobile_number'},
                    {data: 'permit_status',name:'permit_status'},
                    {data: 'email',name:'email'},
                    {data: 'identification_number',name:'identification_number'},
                    {data: 'address_en',name:'address_en'},
                    {data: 'artist_id',name:'artist_id'},
                ]
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
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',

                        title: function () {
                            return 'ARTISTS LIST';

                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.bgColor = 'red';
                            doc.styles.title.fontSize = 13;

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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                    url: '{{ route('admin.artist_permit_reports.artist_reports')}}',
                    method: 'get',
                    data: function (d) {
                    }
                },

                columns: [

                    {data: 'person_code',name:'person_code'},
                    {data: 'artist_status',name:'artist_status'},
                    {data: 'artist_name',name:'artist_name'},
                    {data: 'profession',name:'profession'},
                    {data: 'nationality',name:'nationality'},
                    {data: 'mobile_number',name:'mobile_number'},
                    {data: 'permit_status',name:'permit_status'},
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
                "searching":false,
                buttons: ['pageLength',

                    {

                        extend: 'pdf',

                        title: function () { return 'ARTIST REPORT'; },
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
                        }
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
                                return "Artist List searched by Artist's Permit Count"; }
                        },

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
                    url: '{{ route('admin.artist_permit_reports.artist_reports')}}',
                    method: 'get',
                    data: function (d) {
                    }
                },

                columns: [

                    {data: 'person_code',name:'person_code'},
                    {data: 'artist_status',name:'artist_status'},
                    {data: 'artist_name',name:'artist_name'},
                    {data: 'profession',name:'profession'},
                    {data: 'nationality',name:'nationality'},
                    {data: 'mobile_number',name:'mobile_number'},
                    {data: 'permit_status',name:'permit_status'},
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
                "searching":false,
                buttons: ['pageLength',
                    {

                        extend: 'pdf',

                        title: function () { return 'ALL EVENTS REPORT'; },
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWYAAABSCAYAAABnun4ZAAAACXBIWXMAACHUAAAh1AHW21Z5AAAigUlEQVR4Xu2dCbgsR1XHK9Pdw1vunV4uETHEqCAEUBIQECG4gFFQVEQUNAqKC4KoIJ+Kgl9AQUXFuKB+ghvggoD7BihEEJcIggoSsrw7091z38sDEohsBgl6Tt1/9TtV093Ts91lbv2+77x3+39OVXdX91RXdVdXK49nnSl68bflveQJWPR4PB7PfjHubT217G/9XxmkN0DyeDwez34xVvGlRZT9AxY9Ho/Hs9/oljIsD5PX5GH6R3B5PB6PZ78ogvjXZAUN2ePxeDwHAV8xezwezwGAauLzyij7H18pe5YFn1P407NulFH6VvzpWSJXKxUWYfK07X72SX8Lw7NsyiD5DfzpWTfKMHnlsiqLcZRehT89glIl9xmr+L5YrPCVtGdeyiAb+vNnjTGtuHEQfymkuaD0D/cnSneKIP5aLq8iHDwQksfTCfOb5Z4YJM86YQ6wtij+GOS5OHeyDD4CydNCGQ0+asoMksfTSqEGDzDnzK5l/wnX4eFdSm0Mg/T6m9TJO0GqGAXJdXrHwvTPIB1J5EHejrLbIc+FzAuSpwVZXkWYPhPykSEPk4fmvewdr1IqgGQ4j1qCn+ByGamNh0A78pRRdps8Z/R5o9RxuA8HZZDp+6bGqNKpmvxSZxurwePgOlKMws3CLQu45sLKK4j/C7KnAau8yCAfCbbDzQ9b+x9u3sr6WG0+2NLJRr3kaTrREYXLRpZHESWvL6Ld8fAIORwMw/R9cke6GJIeKXi/6YL1/mWVg8xn0bzWnRvDwf3d8jp0rZ85cfe7iyHpkSKPNv+7qRzc5UOD3Blj2yq5hFpyj5nwRck1SHZkoC7ivXjf+W9ZFto5B1Suj5X5sOXq+KfB7XGgc+6Fbnlt97eOxIMcOsmOufvONlbphXmYvmJCj5InIunaU/SSb3L3ny0Ps79CiMboWDxcyB3j8aSQ1fVK3cHoRZSehXykGEabH+L9579NWbCR0NcBMzKK0jfJfNiGUfa/cHsciih7kVtebHAfCZr2m3oOmdHfrTa3IK8tpcoew893ZHlIo8Jx78HrsiuC9LexePgYh9nN+NMj4AOb93ZbInL+hjxMnqIDZmQUZgVVxJ/Io/ifTV5scHscqMwfrcsoSt8my2tHqTsi5EhA+3sCfx4ZhmrjnqZh1GZFGJ9BEoubVPxZ7OfBDZA86wIfWPypqPt4WXVChOmfQJ6JMspu5leN9d8mL7KRij9TB3gsRlF8Py4f/luW13a0+WEd4FkbdsLk++UxbrIizP6cx7ZTb+oveBnJJ+CRZm1+zyHF3MrBosacHGVvvnGRw2hQe2uEumif0AEei1Pq5J1MedEP8S2yzHSAZ225Uqke/qyFelGtc6kcqvOEtjIgi7Bowd2lHbVxcYFuI/3/i3CtFTzOka+mWGzktEouGkXJv2BRYw52GSU3QZoJqlyqk6kIk1dX+UHzTCLLRpYXiWs7KQ11v/u5itOxOnbhjtq6eBQkj6KW4pXcShxF2Xt5/8dqsTdQDzvmPMDiBOyj39hzsHiwKNXm55sd6GpFmP4gkq8VPFDf3de2q3IZJC+lo2495DPpeMA/pJmQFTNj8pOax4bLhgpHHydZXmUQ/5IOOMTkQfJz1j5NMT3JU5R8M5IfaUyZYHGCNt++YjbctVPhYFyGyY8OVXbPW1QaI3ztqSsLNrgnOKNOfgr+rDBphkH8JZBmYjsafESu0+THNlJ38PeZa+CyMQ9wyjD9YVlmOuAQckqpWO6HNGoZj8pe/PRCDe5GO3gMSTwOprywaDFWyVc3+fYN2prQbPS4N/geyEeecS99vCkXY/xKK9xTodZuNSoD0szoh38ifdFL/83kWcx5e2Td4bI5rTbOx6J1MYN0qMjVyXvztvNLS5A8c9B2DtDv7Jaylx2sr6vzxuZh/ANY9AjoB65fGNm17DbIUzmXhirQYPDlkGemCAc7nAcW1VC8ROBnwKqHyyYXL0+Y8mKDdKjg7a6Z98IzA/z2pzkHzih1EnLFgTs36Md9+yl17NOx6GmgDNJt/NlKHma5OQHYinDrZXDNBV0M3umeNDJ/SB6BLvcoeT0WqTUUnzblNe3J/UHDX3yXQ6EG1cs1dRVzESYH504BP8Utw+xvsOhZgCJIH2EOvLGzanBXuOemCOMf5LywqJHrgOQRlFH6AVk2Z5X6VFNeI3XizpAPPDtB+twz/jnCUrhebZxvzoG6ivlAIU9ez/yYA15ZsLW0VzrpAPV1nlFyCSRV9LK3m3VBOhCMVXwp/txXijD9c7dsTHnx/VpIB56DdnwPM0N1oro481h3yEsnV+m9Ty06QIJnWcKfnjngb86Zg60tyF4I11LhvEdR9u1YpOOWPMGsE9K+kAfZ5fxWIm8Ht0gg7zt5mD7ZLRtTXnv5gIefB+Rh/Ix5Wmh5b/DdB3ZM7SFEVsz86jXkpVGdX8LmeljLQ2y21YmqFeaZDesghMkrIa8EvY4ofTEW1buV2jLrhrRnlEH8sGq/2YL0wI0NvgVDy7CoMdu7F/cSacXnVeVDxsNN4eoMp8OfniUgK2bqfd4H8sLQQepV+TbY6SB9BMKnwwnw51LgN4/kxpxd44lA5H4a24ni+8G9dDj/Isr+EYsas14srhQeH2vWx7bd37qdx9XCfSBxy6ba/mDzkZBWRrUuGPes4OoMp8OfS2EYpi+T2wT5yCAr5lGYPhjywsgybTOeXAlJ2uFg/LkweZj8iLshy8z/IGGGrzUZz22xrZKLEL4UON/C+W6gWR8WVwJVKNYr4HmQ/CZcBx63bMw+nFHxZ0BaCWY90uDqDPVCHjlPuibc7WE7anOtyIp5p598DeSFKKP4jCzTLoak9ZipEbG4EDxrmrtyY2N1YuKz8oeduv1sMh7qlIcbOZLOjfnqMxY1Zh1YXCpFL36myZ+NVnKohpgxbtmYfVnlE/lt1b+HWY8xuGZikbQucltcQ8jCmPyosv/kKExeyw9YC7XxheMouYa0c/MhY5bE/cC6lRGmT4a8ECY//mwXJA0t371aV41tR5v1H1XOo+yvOQCLc5MH6XPdlbqG0LWCZ4qr29dZDdl1QsbzvLPz5NEFk++ol/0HpEOJWzarKi+JWYe2IP1xyDOzrG0tI/ubdhMWJa9D6NxM60FK47dWkWzPkRVzEaTPhzw3fDuP88JiLcW08jcWJT+zm6C/+1VYvTAn8msI2qj7pXVnY3TwmkI7F8xbSe+odKaXeob9c18tKcL0d3Q+UfZBSEvBbBvt11xfWzlI8H7gT43ZNywunTwYfJlZx6L335exreMweY7Jh21bbd2Ddamx6eAFcPNrM54WF8k6Y9LySBtIc1Go4xeIvP4Y8lzw6/6cDxZb4fdEzHrbbDdYLszJRKYC6ZvnYBi48sefS4NbEfhzqVyr1Kbc71aL0rch2VxU+QTZYyAtjMkTi0vjhn0aN2y+IsNQC2m4qv0zmPzft4TvMS66rfz6tsmjLp8236zIvNpsnu8uunmMwuy9cM0MN4SqvIL0RshzwXkMo+x9WGyk4Pk3zDqnmE7AhcQL81aaExk68DSgVUyUfQDyzOj0c375o462bV4E+uFfVe2vY/ztQzpAb6GT6g+KaHAFkswNbXw1FAvSwpzCDHY8+gLSUsjV4K56W2ds2dOOBUXDp/XnGe1jymscpC+AtFR4CB7nP4qyN0FaCLO9WJwZk76pMuRvRpqYvDd/SzQP498z+UwzJOmMqaNcK8JsrqGpY+oxyHwgz0ypsru0pc+j9MVyPV0MSSnzKPlXFuaZnYya5n8wkWENJmZaXBP8rTuTnlujkOdGbg9VFJ0nI5qGlS9sHGRfD/fSkeuBtBBVS38FD2bm3dYyHOzgTwuei5gqwS/CYifkV8YhLZ1l52/yGwXxwyB1Rn6aH9IEQ7X5IBPTFtfGWG1OPOistV72LiTpzLSHZ7PeBmTMA3Rj1GWt/fjHNEx6LGrGUfytMu8uRheYV1Em9sRUwzB5qgmA1BmTjlrbA0i1mDhtYfq7kDuR9yZ3lDa0+hr3LLjdOmNwz03djf33q6y1TBZF/hiKKK7eBFwE0zLB4lIx22oMciv0gznRFMv6rD/KWdc/K1Tx6Emm6Ngs7avTZntn7f7zV0u67quJ6xLrQj3iszK9saG6w1KGIvJoprr8pSG0M0vJI0heqdMG6Q1csVNPWD+r62qdXgU3we+fUsFKTBpuzUJqxL3pPe74lWjqZr1fprOMWnVdpz+8Wswx3WSzVqSjKP2OunyoJfcShKyMf1fqpFwn5IVZdn6GugsiH1u4a8nD5NkcxzMeQtLQxs11+8akYeNpHyEvlXm2axq5uuPnzZOvSTNyhm/VYWKN8evjcE1wrdrazIP0FW4atnGYvhFhS6NuPXV2gzp2IZI0wre+6tIa44ncENrIjtq4I9Vfr6lL32ZFL307suiOzABSK3I6S0hTkeuoLIo/RhXsm0dh+id8L5q6pk+l/623krpaEaV/V0TJT/ObVdqi+NfK/uCjdbGyi1dr0eCj+tuFUfK6cZS9tutoC+zqSuGXIuQ6uUcB10LwG1Cr3A+5zdL4G3T8sgo/PzDfo7P8Yfz7eZRe7epNn52vg86xj8u0kJeKyTtXauqPe1aqbe/4Uk8VTwaplW117CKZxhhP1cAjgOp8lkXZzchq6TRdBJqMWq4fGEfpL1FdcEXZzx5Lv+Pn151X8jZsre1+kb7zA7s6W3gonhzjOG1Sj7GK72ti+YEO5KlMHUe5R1YE8bW8PVQZfFWdfx6jbqbVqlsVY3SVz613eW9s8Sf9Tb6Qlorc7mUYsp3KvOlmwXzya1X5z7L9VCH97TzbItcxi1EdcDmyWBn8mbain7696CXfM+445KzNuPHH+Zrna8u002pwf73Ry0JmDqmWrnF1yLT7Yur4XbApmlnvC9UZfx0c2a0M/p5f3brhXgqrytege0diHYsYsmyFWjt6HmbL1LnpUpcF/cjfYPJf1ZdFqDKqxiEX/ezjkCfgbraJK4PspZA7U6XtYPv9GnfdNnUxJK/gaRPq4job9a6R1WqQK3Pv6xlkDKSZqe1WTLFRED98GAx+oc7XxfJe+jisfgK+XVGXptWCbHuRMdldKdTgAbXrJ0PI0lhl3kweDdpvH3UwupD+JbJrpOjXXwDyIF766Bjqqr5crgPySpDrGVLPCbLEmsUO2szIPOqMe2nzjmJYJnXb1mY8EgNJJ8jD9Fl1aaYZnVNzv9HZGb557q4YLg39KM7dp5tz/KCE5ymgK/zF21FyiWtFL36SWVcRJq9GksbKI1fHP40q2PuUQfzFRTh4AL4QPNOcDjxULI/iz6Mf9qPpQF3G+eltiZLPHav0wlW1huooorTxIsStfIQtFbkOSEvFnD91Iyl4FMMptXl3Lu9RFN9v1M/udZ06fkHXY1g6Q75cW3iy8hpGUfIvch1Xr/iL1HmU/ZNcn3z7k5G+Zewv3z4YhZsPLqKtK8ZRfGnbA8G9Ru4rJPUe6i3wcyr+/NooSK7Lg+RnRyqe6YsvXG58bzoPspeMg/QqfoOTf/twV5hnV1hcPXKH2wzhK6MIsyvr1mU+PspDaCCtFcP+VuuDllVOn0oVp57knm0VvQHOly6yC8/HIKFtfovZ5lqbY+7jLkysZ9XdWTCx3hpr6u2uC9aDXJU9CPKewhXzjar/2VjcG+RBrjOqKVc+dwIPRK/WiR8zrTcyGs/3rAPXgFwN7l/ta43xg6WhihOEr4w8TB4q1wt5KZjbV1hcGH7YKrd1wua4v9oFalGde5VXGNwrh3uEdeuXhtC1xMzrw+b2GPYSrpjx595B3ejGV4r5bSuErZS6dUtD2FrADw+HUXzfYRA/hlqAT+IKslDZBXDvKVY5h/FSPszLn9RZ5jHj21bUveYhUK/VLeYgeWkRDL68yxjURZAjL6TBvWfUbYMxfviHsLWibhw8XPvCvlTMDHfN3IIowuwv4F45RS9u7KKOVfxwhHmWDN8ikmXdZXKWJuQMXvxCDORDBf36a98UNYawPad27ghnxNE6QOfNp0zsJ9m4w8skq2Rfv496WmX35CFO/GYfnYHnQd4TaH3VbQtp7pc7PMuFyt36JJixvNftTU1mFKXfKdPyV7zhOhRcyd9tC7Pfl/swYSt8oaIr9Nv8Vd4WfigI6dBgylHPgRNlLxpH2RPZ+IGd6WE1GTUQ/xDZePYDdygSG1yeFUI/+NNuuVsWxWf4Tc08zJ5OFdj38wQs/JCtNpYM2R5YeBQOXzzqtr3O3qtO3BlJPQsw9e3bOtuDbzR6DghlkH4F/vQA/ixQ7Q9jRkN2B5Iy7P4mKpcHknmWTJdzjaeAQLhnHdDdUnGAC/G5eupyWy+6rNNIj2VQBslvyPKZyXrZPyCbQwG3/PMo/udhuFWW4da4jJJryjD9Ybg9e0QeZF9fRukvl1H2Qjomnw/Zs27UVhptttdjEw8BRZhaH2Nts3GQ/iSSeTweTz11lUebIZmnBe5Z8LSZbPywkKQ9fTDs8XjWAFnxjoL4sZDVGTV4YOXzoz08Ho9nb+H5NvitLSxa+HvLHo/H4/F4PB6Px+PxeDwej8fj8Xg8Ho/H4/F4PB6Px+PxeA4IeRQ/z4w7H0aDD0P2OKB8PsRlxH9DXjn85RT9XUeeMjjIboS8Mnga4oMwy18TPAx3O8o+UUZbt/J7EkV/8c/xNbL7xtfxC86o+DNKld1lL74Q7fGYCtnYONwq4fI4uGUFeeXIdRbRYKVzpZRR+ja5PsgHDrmN4yB9AeTl0PZhUGk7UfodSOJZY/b6C8l5mL7CPdeK3hY1SNpx0zQZwg8s8ruGkFqR+9Y1DTMxJ0qUfRAui9MqucjEDIPk1yE7611h65Cw16U/d7dnH0qeBbmNdBy/HfJiFL3kCpkx27iXvkm2kssgfpgVE2Sn4PKsGXRsv04f42hvZ47jde6oY9Vbm1wxjKKta7DYiHVekvHXzvVnu+T3JGEH9YfNyO3sclGU8WyQp5IHyVdbaaP6D+caf9FLrQ8g2GmzX4W8Ego5nQIZ5AOH3Eb+/UCeH57/VGbK90rgqqUM0z/luEKpDJJnjZDnwihKfwXyyhmpE3fmddKfM0+U5H5+CbKGFs6TPtd/UOBbh7Nup4yd5Wvy4zB9sExbBFnVGjZU/pq5ZWTaMkqfB3ml8HHEnwcSWSYjasRCno+yF3+XzLDrJOH+ky/rizwfeO5iyCvHrJNacy+B1Bn94EVsN+QK6avzHwT4S9CzbqeMLcIBdXC7Mepv3Eum5TmR4dKYL440fZ3aSuvnstbIMhmF6UMgz4fMjA2y5wgjz4c8Sh8HeeXI9ULqDFUsH29LL311/oOAu41sRZj8GNy1yFi6oL0H8lSG/EBfpC2jrefDpcb97NlGhzSBlTZMnwz5SCPLZBjFl0KeHTqZf0VmNktXaBo8nEbmbYyOtNUdcf2QJ2jy51H21zJ9Uxwj/YVKPpe1Ikr/jpepxXW7DiJknPkasaWxBekNOljgxrA2CrcKqRVh+jIdTAyVSqSP7W0tI1/I/0E3ng3uimEQP9r10z8T3fkiiq0HFFp3vgE47O8OwxpGmx9CWCdOKRXLfIxRRf9GhFRoH39JRMb1B9U34hDWCp3Lt8n0kCukr87PFEF8rRvXFMsUvfQb3dhiznvydD79Nqcfqv7Fbp4IqUXGFf30rZCnckadtL9IHWY/yvr1Sg2MpgMbsNJG6XdNaFqPT+vgGvTXY9x4Mrgt2mLqfMMwe4bU5NffKWDid5CH6WVwW1Bs6MayNd0tkDHbUXKJq2nr8LxkItFQbVwM19yMlLh3Je5NUUVddTXzXvJEyHxfLaviyajiejlcFsaPRY1MB8nSSLQenkjfTSr+LPox32yW8372CoRZcWO1uSWXLQsHYyTRWL4ouanp4jTuZU/Me/G31vnYkF0FCdbJBLl2/xmq/O4tfbmKU7ksrQjSRyAZ36e9fRvjYSuLsg9wpVxEm7cibCrb0WaVBz9kYo2PhcxXBwIup5r13szrbOpKu8xSMdPF+CxkTRnEj5X+OkNoBZeL9kUpXUt3x7Ga2DyMf08HzYBcD1X4/2aW2UhsvLcq45ZRMZtlHdSClTbKnmAtC9vuDz6CJJq2894YQivot/T6Jr/U2Yogu9HV2Ia97J3XKrVZ52PbVid0RWoo+3YPbMKoh4bQCukf9TP7VpGwYZDS9a8FNwHkhWjLT/rI2YM8dTuoNas/cU614BYk+2FPkL4YsqKK9B6VTgZZI3XzoMlYU8XMNg6Sn2ed8r6769MJgOszft7XOt8N6tiF7M/drzZTpc66Qfr4oQ1kVYTxD51Lk90GWe2ojTvKNGzmnhe1kp/k+nQigfSN+5t3h9wJquTebdK6FSB3y2XekCukj7a32s8u0P7/j0wPWVMG2XaTj+GvgBdOmV+vNs6XaSYq84a86rRpmId+XHlAssqCzu/G0U8ybhylb4A8lbqK2fxNF/bq99SElZYt3B0yxz1M16cTAL7dQj2Td2NRw6NwZLx7LGj/q5eN2CBrpO763QfCbEN8eTvvDZ7i+nQiwMv0e7fOQTrHbmmKZ6SPLQ+TZ7NeqPRzXJ9O0MRMwR3gB4dt+UmffMhIV6fGHxXj6rJ10hbv+qRutpUq3UdRRfgtfEsEYVYcG2QNxb6w0Sd010c/msdL3zjKfgoujfSxQaaLQd+6GECuqPPxMCupcwsMLg11tzuVd51vGtPSSr+5TWSQvkUrZmrJvpkuQh+TGuU500Mq0yAwBtm6IEKqIGHmoXh1eRmtzieRMQtVzI4hrJG2eOrqP63J1wQ3LJrS0G/TamVD1pT9wUebfIz0uf42XxMyvugNHg9ZI31skDV0YX9Dk28CGTg1uANWfkHys5Ar3KfOkBXV0CelTjv8jXAxu9343u59LIau6FfLeMgV0leEgwdC7ry/MoZOsisha/7d2VbIGqm7Pkb6yFn1GBjpY4M8U57c8oJs6XQhyyBryp59Dw5yRZuvDTpGfz8trfS7MVJftGJ2K9U8TJ+F0M6Mwsx6PgCZW/7PkTqte6FXhd38GX5zTK5jWyUXwWUhYxa5lbEdDT4il9kQWouMo5bhayBXSD+kVvSr3Q1p8mBweZNvGG5a96ohV0gfHbcvgqyhMr5K+iG3IuOpl/B9kDXSR2XyFMgV0g+pHhk4NRg0pcnV4K5Spy7wPeCqoArhP2UMZI3UpY/SvHNaLP8wLJM+8cRY6nQF+0XIE8i4U+rknSBXSD8kjdT5RINcIf2UsNNDUFdv21c+BkjWuI2MO4YVckWbr41pPSZG+t0YqS9aMWtNLButC/xiSt09Rrg1rs/YUKljCOkE9cCu0Wl7ifUjZ9y8IVtI/0L3mIP0udYymbmFV4eMG0Xpd0KukH5ItYyD+EunDRNcVsV8hhpVkDXUc/w26YdcC4/zlrHaWipmOq73gVwh/ZDqkYFs/EQWrkbcNJC5Ffs4qfNwHLgq+B6ajIGsoR/Wm+t8/DffK8KiRsbtWvqsJhupjXshmZWOWlCNQ3xk3Gm1cT5kDW2Ydb8YskbqPMEL5Arpp4TzVcw1+2jsfUptIpmVDlIFD35v87f52pDpmtK2xUhdPpTsAp0/E11hqjCsFtEwan6QWATJT8vYUbD5qCJKXic1hGr0ZDXCJ41+R3dA2FTq0jcZklhIP48qgTyViYoZw+UsjUwH12DFRdkTIFdIP6SKcZC9RPp31MZlTbeNmGGYPajZt0DFHGbfK/2QK9xWvHsLtegl34RQjfTxwz/IFdIPqZ4yis/I4C6vWFvxZJCpsJOvkjqPeoCrgloh3Z+cq8HdblVKj4igwLmG2LlY6VpenJBxB61ihjyVtjTUOnpkq7/F14ZM15S2LUbq1Jp5EuRO1FXMjNTY6ipNKyaI/wsyNzbeKH2QK/TzCeGXhpBWdkxLMNy8NQ+yy6mVdYkxbknS/9Zoh7qK1/LT7xnyVHhSMpm2qph7A6vxxKYTOEh/HmXVKCuD9EPSSD3vpe+AzMfP6v1B1qysxdxQMXOvR+pXNg1UCJKvhKyRvhui9N6QK6QfUjMyuEuCtnipU6ts4l1x6WeDXOH6TXcS7gr60VYTvdT5m5BpqMX8A5AnkHHurQz3oEHWSP3Uim5lQJ5KW5qiF7d24dp8bVCrp/XtO0b6yzD9M8ga6SvCrR+C3AluDcv0kNVYpRdKXfqYkWruPVBlMfWeObOjUmtUQVuspEuszLMudpq/iZyHi4p04+jcbQups9WN0rBiaho50g+JKv3km+t0hsq6ccRDW8XMQ1abfIz0XaeOXwBZQ70y6z4+ZCsN1TXVaCdG+tzxz9JHlX71bMsg/ZCaoe7ai2QC+nFVL1rUIWPZIGukXtdtlH5qDUxMmpJHyc9YMWTjMP1uuCt+3Rl1MAqS6+BqxUoTxdaoCIkVp07cGbLmrFIb0g9ZI3XXx0jfq5yn99LHBpkncLmb5QvSn4CrEXdUBuSKMtx6Vqu/xdcGBVsD8iFX8IRYbX7po2P6W5A7Qedb40VB6mzUwvsnuKjVtDvvizHIGh5v2uQrwuR78WfFsL9VbQOkRiig6nlBqsUdddDWfWaDPBWe5EmmK6L0Krj4OE0Mt4SrwvLXzJUh/ZCo8m2evtMdxw5Zw+89NPlmGZUxik7cD7KGejzWfWPIVhq+xQJZI31Uh1j5Wb6auTKkH1I7ozD7G5moLWFbHI+caPJNG+JmkDGtcc7DHrcCZXhMLf7UyHi6yv8u5AlkHHWVvgCyxr03B1kjddfHSB85Q8ga6WODrHF9dbOObVOlgD8V336R8ZAr6Er/R21+6eNnB5A7IdPSxdd6y4laNzvGx11QyBV22uzvIXfCSksGWUMLges3tzSKMLamv5S3OqTOBlnjLjN8G0THNkyhKanyDdLWC1Dd26Fwadp8bdC2fomd1n4phl8Os/3N682DbGJuE+mHxBfBl0udHFWvUepskDU5NUaafFJ3fYz00cXoCsiapp631KSeq5P2i1tBdjlcGsvXS78BcoX0Q5rOe2peSmCj1sVflUH2UvdqZwzJK8pQPDARr2S2pZHIuGmxdQPI6cr/VvPGHRX8PyJUY8WKwfwuVhy1LiFr+O1I6YeskbrrY6TPvdcpfWyQK1w/7eMnaV+rY1L00mciVJ2J7AHtQxUncGnaHrQw7lNyfS80Sp8L91Rk2lzt3msrw81zD3BqZitjZDraN+uFjmnItGyQKyaep4gYVze2o9LL5PK71PkbHJ+L5ylc2fAoDv07gaYzncI8scb4DTa4pu53E1S+1rh6+XKLQfrZZE/D8kXZayFraCMae05Sl5arjYfKZTn0k7ZVT5tgDLJG6q6Pkb6RcxGUPjbIdK7yw3Tbx8Z3EyyNGodIorF8zpj5kUofIv2Qu8MVBlVaE3PYSuOhI9S+bxzBwXnIV7CrdA2vW0v4pB/2Bx/ScyWE8TMgN3JaDe7vrodtR8WPRkgF65yvmYcB8gRU4d9exTlzYoyD+AXGV/Sz294hKr22/KmF8sWn+oMPs4//l+OrmS7bNnbuDRs7K4bJMbSur9vGuviVWK4U4dJwxWjW5Y54MVDlbB+/0P7xTeO0Ov4AKz1MzrXsIuPoonoL5E5wmnP7VH87TsbwsePGBut8W0mum830Sor+Vu29z7IXP13qbG5DoAn6fb2Jt0Hm1wb93ob8EpbZdpmO/67Tp1EE8U/xPChtaYfqxKVu/mfViU9ln/0bybZ1AlCEyVPPpbEvwnVlfTV6j1R+u6+5kw0pf52AkLFskDW8fG5dk/sg/e550ZZ2J0ysB4OyoWDpmDdj9+3N7DaTH5XBq3UwoOW/NT57mgGl/h9M91QliVm5BAAAAABJRU5ErkJggg==\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                $('#navbarCollapse').hide(400)
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
                $('#navbarCollapse').hide(400)
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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
                                width: 120,
                                height: 40,
                                alignment: "left",
                                image:'data:image/png;base64,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\n'

                            });
                            doc.content.splice( 1, 0, {
                                margin: [0, -50, 0, 10],
                                width: 120,
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

