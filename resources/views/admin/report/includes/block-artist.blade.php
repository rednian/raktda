<style xmlns:data="http://www.w3.org/1999/xhtml">
    .dropdown-item {
        color: #6d6d6d;
    }

    body {
        --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 13px;
    }

    .activeButton {
        border-bottom: 2px solid #000000;
        height: 26px;
        box-shadow: 1px 7px 9px -5px black;
    }

    #block-artist_filter {
        margin-top: 9px;
    }

    #event-report_filter {
        width: 42%;
        float: right;
    }

    .dt-button-collection span {
        color: #6d6d6d;

        background-color:red
    }



    #block-artist_filter {
        width: 42%;
        float: right;
    }

    #buttonsId {
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
    }

    .dataTables_wrapper {
        font-size: 12px;
    }

    .dataTables_wrapper tr td {
        font-size: 11px;
    }

    #name_search_button {
        border-radius: 4px;
        padding: 5px;
        background-color: #b45454;
        border: navajowhite;
        width: 37px;
        margin-right: -9px;
        color: white;
    }


    .dt-buttons{
        margin-top: auto;
        background-color: #edeef4;
        height: 32px;

    }

    #navbarCollapse {
        width: 141px;
        background-color: #616161;
        padding: 9.2876px;
        box-shadow: 0px 9px 15px -6px grey;
        border-radius: 4px;
        margin-left: 76%;
        position: absolute;
        margin-top: -22%;
    }

    .border-bottom {
        border: navajowhite;
        border-bottom: 3px solid #8b0000b8;
    }

</style>

<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-1x nav-tabs-line-danger" role="tablist"
    id="navlink" style="margin-top: -22px;">
    <li id="all_permit_type_click" class="nav-item "><a class="nav-link active" data-toggle="tab" href="#">
            <span style="font-size: 11px">{{__('ARTISTS WITH ACTIVE PERMITS')}}</span>
            <input type="text" value='all' id="all_permit_type_input" hidden>
        </a></li>

    <li id="single_permit_type_click" class="nav-item"><a class="nav-link" data-toggle="tab" href="#">
            <span style="font-size: 11px">{{__('ARTISTS WITH SINGLE PERMIT')}}</span>
            <input type="text" value='single' id="single_permit_type_input" hidden>
        </a></li>
    <li id="multiple_permit_type_click" class="nav-item"><a class="nav-link" data-toggle="tab" href="#">
            <span style="font-size: 11px">{{__('ARTISTS WITH MULTIPLE PERMITS')}}</span>
            <input type="text" value='multiple' id="multiple_permit_type_input" hidden>
        </a></li>
    <li id="blocked_artist_click" class="nav-item"><a class="nav-link"  data-toggle="tab" href="#" data-target="#">
            <span style="font-size: 11px">{{__('BLOCKED ARTISTS')}}</span>
            <input type="text" value='blocked' id="blocked_artist_input" hidden>
        </a></li>

    <li id="active_artist_click" class="nav-item"><a class="nav-link" data-toggle="tab" href="#" data-target="#">
            <span style="font-size: 11px">{{__('ACTIVE ARTISTS')}}</span>
            <input type="text" value="active" id="active_artist_input"  hidden>
        </a></li>
    <li>
        <button class="btn btn-warning btn-sm"
                style="box-shadow: 1px 4px 7px -5px grey;height: 24px;border-radius: 3px;line-height: 4px;margin-top: 9px;border: none"
                id="filter_button"><i class="fas fa-filter"></i>{{__('FILTER')}}
        </button>
    </li>
    <li>
        <button class="btn btn-secondary btn-sm" style="box-shadow: -1px 3px 3px -3px #1e1e1e;height: 24px;border-radius: 3px;line-height: 4px;margin-top: 8px;
margin-left: 10px;border: none;background-color:#f7f7f7;" id="ArtistTableresetButton">
            RESET
        </button>
    </li>
</ul>
<table class="table  table-hover  table-bordered table-striped border" id="block-artist">
    <thead>
    <tr id="filterTableCollapse" style="display: none;font-family:arial">
        <th colspan="2">
            <div class="col-sm" style="display: inline-flex;width:100%">
                <input type="text" class="form-control form-control-sm " name="search-artist-name"
                       id="search-artist-name" placeholder="{{__('Name')}}">
                <button class="fa fa-search" id="name_search_button"></button>
            </div>
        </th>
        <th><select type="text" id="search_by_gender" style="width: 100%;margin-top: 1px"
                    class="form-control form-control-sm custom-select-sm custom-select">
                <option value="">{{__('Gender')}}</option>
                @foreach($gender as $key => $genders)
                    <option
                        value="{{$genders->gender_id}}">{{Auth()->user()->LanguageId==1? ucwords($genders->name_en):ucwords($genders->name_ar)}}</option>
                @endforeach
            </select></th>
        <th><select type="text" id="search_by_age" style="width: 100%"
                    class="form-control form-control-sm custom-select-sm custom-select" name="search_artist">
                <option value="">{{__('Age')}}</option>
                <option value="17">{{__('Minor')}}</option>
                <option value="18">{{__('Adult')}}</option>
            </select></th>
        <th colspan="1"><select type="text" id="search_by_nationality"
                                class="form-control form-control-sm custom-select-sm custom-select" style="width: 90%"
                                name="search_artist">
                <option value="">{{__('Nationality')}}</option>

                @foreach($country as $key => $nationality)
                    <option
                        value="{{$nationality->country_id}}">{{Auth()->user()->LanguageId==1? $nationality->nationality_en:$nationality->nationality_ar}}</option>
                @endforeach
            </select></th>
        <th colspan="2">
            <select type="text" id="search_by_profession" style="width: 99px"
                    class="form-control form-control-sm custom-select-sm custom-select" name="search_artist">
                <option value="">{{__('Profession')}}</option>
                @foreach($profession as $key => $nationality)
                    <option
                        value="{{$nationality->profession_id}}">{{Auth()->user()->LanguageId==1? $nationality->name_en:$nationality->name_ar}}</option>
                @endforeach
            </select>
        </th>
    </tr>
    <tr id="ActiveArtistFilterTableCollapse" style="display: none">
        <th colspan="2">
            <div class="col-sm" style="display: inline-flex;width:100%">
                <input type="text" class="form-control form-control-sm " name="search-artist-name"
                       id="search-artist-name" placeholder="{{__('Name')}}">
                <button class="fa fa-search" id="name_search_button"></button>
            </div>
        </th>
        <th><select type="text" id="search_by_gender" style="width: 100%;margin-top: 1px"
                    class="form-control form-control-sm custom-select-sm custom-select">
                <option value="">{{__('Gender')}}</option>
                @foreach($gender as $key => $genders)
                    <option
                        value="{{$genders->gender_id}}">{{Auth()->user()->LanguageId==1? ucwords($genders->name_en):ucwords($genders->name_ar)}}</option>
                @endforeach
            </select></th>
        <th><select type="text" id="search_by_age" style="width: 100%"
                    class="form-control form-control-sm custom-select-sm custom-select" name="search_artist">
                <option value="">{{__('Age')}}</option>
                <option value="17">{{__('Minor')}}</option>
                <option value="18">{{__('Adult')}}</option>
            </select></th>
        <th colspan="1"><select type="text" id="search_by_nationality"
                                class="form-control form-control-sm custom-select-sm custom-select" style="width: 90%"
                                name="search_artist">
                <option value="">{{__('Nationality')}}</option>

                @foreach($country as $key => $nationality)
                    <option
                        value="{{$nationality->country_id}}">{{Auth()->user()->LanguageId==1? $nationality->nationality_en:$nationality->nationality_ar}}</option>
                @endforeach
            </select></th>
        <th colspan="2">
            <select type="text" id="search_by_profession" style="width: 99px"
                    class="form-control form-control-sm custom-select-sm custom-select" name="search_artist">
                <option value="">{{__('Profession')}}</option>
                @foreach($profession as $key => $nationality)
                    <option
                        value="{{$nationality->profession_id}}">{{Auth()->user()->LanguageId==1? $nationality->name_en:$nationality->name_ar}}</option>
                @endforeach
            </select>
        </th>
    </tr>

    <tr style="font-size: 12px">
        <th style="width: 18% !important;font-weight: bold;white-space: nowrap">{{ __('PERSON CODE') }}</th>
        <th style="font-weight: bold;width: 18%;white-space: nowrap">{{ __('ARTIST NAME') }}</th>
        <th style="font-weight: bold;width: 18%;white-space: nowrap">{{ __('PROFESSION') }}</th>
        <th style="font-weight: bold;width: 18%;white-space: nowrap">{{ __('NATIONALITY') }}</th>
        <th style="width: 18%;font-weight: bold;white-space: nowrap">{{ __('MOBILE ') }}</th>
        <th style="font-weight: bold;width:14%;white-space: nowrap">{{ __('EMAIL') }}</th>
        <th style="font-weight: bold;white-space: nowrap">{{ __('IDENTIFICATION NUMBER') }}</th>
        <th style="font-weight: bold;white-space: nowrap">{{ __('LANGUAGE') }}</th>
        <th style="font-weight: bold;white-space: nowrap">{{ __('FAX NUMBER') }}</th>
        <th style="font-weight: bold;white-space: nowrap">{{ __('PO-BOX') }}</th>
        <th style="font-weight: bold;white-space: nowrap">{{ __('EMIRATE') }}</th>
        <th style="font-weight: bold;white-space: nowrap">{{ __('ADDRESS') }}</th>
        <th></th>
    </tr>
    </thead>
</table>

@foreach($artistPermit as $key =>$artists)
    <?php
    $artistWithThisId = \App\ArtistPermit::where('artist_permit_id', $artists->artist_permit_id)->with('profession')->first();
    ?>

    <div class="modal fade" id="artist_modal_{{$artists->artist_id}}" tabindex="-1" role="dialog"
         aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="font-family: Arial;border: none;box-shadow: 1px 8px 24px -2px black;">
                <div class="modal-header" style="background-color: #f7b100;">
                    <h5 class="modal-title hover_title__{{$artists->artist_id}}" id="exampleModalLabel"
                        style="font-weight:bold;margin-left:42%;color: white">
                        {{__('Artist Report')}}
                    </h5>

                </div>
                <div class="modal-body">
                    <div class="container" id="tableToPrint_{{$artists->artist_id}}" style="margin-top: 10px">
                        <span id="artistPersonalDetails" hidden>Artist Report</span>
                        <table class="table table-borderless table-hover" id="artistTableHide_{{$artists->artist_id}}"
                               style="font-family:arial;font-size: 11px;padding: 3px">
                            <tr>
                                <td colspan="8"><img style="
                                     height: 59%;width: 99%" src='{{asset('img/raktdalogo.png')}}'/></td>
                            </tr>
                            <tr>
                                <th colspan="12"
                                    style="color: black;
                                      padding: 6px;
                                      border-bottom: 1px solid #8c8c8c;
                                      text-align: center;">
                                    Personal Details
                                    - {{Auth()->user()->LanguageId == 1 ? $artistWithThisId->firstname_en . " " . $artistWithThisId->lastname_en  : $artists->firstname_ar. " ".$artistWithThisId->lastname_ar}}
                                </th>
                            </tr>
                            <tr style="font-size: 10px;text-align: left">
                                <th style=";padding: 9px;white-space: nowrap">{{__('PERSON CODE')}}</th>
                                <th style=";padding: 9px;white-space: nowrap">{{__('PROFESSION')}}</th>
                                <th style=";padding: 9px;width: 14%">{{__('NATIONALITY')}}</th>
                                <th style="padding: 9px;white-space: nowrap">{{__('E-MAIL')}}</th>
                                <th style=";padding: 9px;white-space: nowrap">{{__('PASSPORT NO.')}}</th>
                                <th style="padding: 9px;white-space: nowrap">{{__('PASSPORT EXPIRY DATE')}}</th>
                                <th style="padding: 9px;white-space: nowrap"><span> {{__('VISA NO.')}}</span></th>
                            </tr>
                            <tr align="left">
                                <td style=";padding: 9px;width: 16%">{{$artistWithThisId->artist->person_code}}</td>
                                <td style=";padding: 9px;width: 14%">{{$artistWithThisId->profession?$artistWithThisId->profession->name_en:''}}</td>
                                <td style=";padding: 9px;width: 14%">{{$artistWithThisId->country?$artistWithThisId->country->nationality_en:''}}</td>
                                <td style="padding: 9px;width: 20%">{{$artistWithThisId->email}}</td>
                                <td style=";padding: 9px;width:17%">{{$artistWithThisId->passport_number}}</td>
                                <?php
                                $passport_expire_date = \Illuminate\Support\Facades\Date::make($artistWithThisId->passport_expire_date)->format('d-M-Y');
                                ?>
                                <td style="padding: 9px;width: 18%">{{$passport_expire_date}}</td>
                                <td style="padding: 9px;width:10%;">{{$artistWithThisId->visa_number}}</td>
                            </tr>
                        </table>


                        <table class="table  table-hover table-borderless table-striped "
                               style="font-size: 12px;margin-top:5%;font-family:Arial"
                               id="printTable_{{$artists->artist_id}}">
                            <thead>
                            <tr>
                                <th colspan="7"
                                    style="font-size: 11px;
                                     padding: 6px;
                                     font-weight: bold;
                                     border-bottom: 1px solid #0000004d;
                                     color: black;
                                     text-align: center;
                                     width: 100%;">
                                    Permit
                                    Details {{--{{Auth()->user()->LanguageId == 1 ? $artistWithThisId->firstname_en . " " . $artistWithThisId->lastname_en: $artists->firstname_ar." ".$artists->lastname_ar}}--}}
                                </th>
                            </tr>
                            <tr align="center">
                                <th style="width: 18% ;font-weight: bold;font-size: 10px;text-align: left;padding:13px">{{ __('NAME') }}</th>
                                <th style="width: 14%; font-weight: bold;font-size: 10px ;text-align: left;padding:13px">{{ __('PERMIT NO.') }}</th>
                                <th style="width: 18% ;text-align: left; font-weight: bold;font-size: 10px;padding:13px">{{ __('REFERENCE NO.') }}</th>
                                <th style="width: 18% ;text-align: left; font-weight: bold;font-size: 10px;padding:13px">{{ __('ISSUED DATE') }}</th>
                                <th style="width: 18% ;text-align: left; font-weight: bold;font-size: 10px;padding:13px">{{ __('NO. OF DAYS') }}</th>
                                <th style="width: 18% ;text-align: left; font-weight: bold;font-size: 10px;padding:13px">{{ __('COMPANY') }}</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            $permits=\App\Permit::wherehas('artistPermit',function ($q) use ($artists){
                                $q->where('artist_id',$artists->artist_id);
                            })->where('permit_status','active')->whereDate('expired_date', '>', \Carbon\Carbon::today()->toDateString())->get();
                            ?>


                            @foreach($permits as $permit)
                                <tr align="center">
                                    <td style="text-align: left;padding:14px;font-size: 10px">{{ Auth()->user()->LanguageId == 1 ? $artists->firstname_en . ' ' . $artists->lastname_en  : $artists->firstname_ar . ' ' . $artists->lastname_ar}}
                                    <td style="text-align: left;padding:14px;font-size: 10px">{{$permit->permit_number}}</td>
                                    <td style="text-align: left;padding:14px;font-size: 10px">{{$permit->reference_number}}</td>
                                    <?php
                                    $issued_date = \Illuminate\Support\Facades\Date::make($permit->issued_date)->format('d-M-Y');
                                    $expire_date = \Illuminate\Support\Facades\Date::make($permit->expired_date)->format('d-M-Y');

                                    $to = \Carbon\Carbon::parse($permit->expired_date);
                                    $from = \Carbon\Carbon::parse($permit->issued_date);
                                    $days =$from->diffInDays($to);


                                    ?>
                                    <td style="text-align: left;padding:14px;font-size: 10px">{{$issued_date}}</td>
                                    <td style="text-align: left;padding:14px;font-size: 10px">{{/*$expire_date.' '.*/$days}}</td>
                                    <td style="text-align: left;padding:14px;font-size: 10px">{{$permit->company? $permit->company->name_en:''}}</td>
                                </tr>

                            @endforeach
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;padding: 10px">
                                    Total Permits : <span style="color: grey">{{$permits->count()}}</span>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer" id="modal_footer{{$artists->artist_id}}">
                    <a class="btn btn-success"
                       style="height: 26px; line-height: 3px; border-radius: 2px; box-shadow: 1px 3px 4px -4px black;"
                       id="{{$artists->artist_id}}" href="{{route('admin.artist_permit_report.artistHistory',$artists->artist_id)}}" >Artist History
                    </a>
                    <button class="btn btn-success"
                            style="height: 26px; line-height: 3px; border-radius: 2px; box-shadow: 1px 3px 4px -4px black;"
                            id="{{$artists->artist_id}}" onclick="printContent({{$artists->artist_id}})">Print
                    </button>
                    <button
                        style="height: 26px; line-height: 3px; border-radius: 2px; box-shadow: 1px 3px 4px -4px black;"
                        type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
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
            $(artistTableHide).css({'display': 'block', 'text-align': 'center'})
            var divToPrint = document.getElementById(tableToPrint);
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.document.write($('#artistPersonalDetails').val());
            newWin.print();
            newWin.close();
        }

        function onclickevent(id) {
            var url = "artist_reports/event_reports/getEvent/" + id;
            window.location.href = url;
        }
        function transactionFunction(id){
            var url = "artist_reports/artist_permit_report/transactionShow/" + id;
            window.location.href = url;
        }
        $('#filter_button').click(function () {
            $('#filterTableCollapse').toggle(400)
        })

        /*   function showTool(x) {
               $('#tooltip_'+x).css({'display':'block'});
           }
           function hideTool(x) {
              $('#tooltip_'+x).css({'display':'none'});
           }
   */
        $(function myTable() {
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            var time= + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            table = $('#block-artist').DataTable({
                dom: 'Bfrtip',
                "searching": true,
                "columnDefs": [
                    {
                        "targets": [ 6, 7, 8,9, 11],
                        "visible": false,
                        "searchable": false
                    },
                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title:function(){
                            return   'Artist With Active Permits '+datetime+Date.now();
                        },
                        customize: function ( win ) {
                            $(win.document.body).prepend(
                                '<h3 style="font-family:arial;text-align:center">Artist With Active Permits </h3>'
                            );
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(win.document.body).find('h1')
                                .css( 'display', 'none' )

                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        },
                        title: function () {
                            return 'Artists With Active Permits '+datetime+Date.now();
                        },

                    }
                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,


                ajax: {
                    url: '{{ route('admin.artist_permit_reports.artist_reports')}}',
                    method: 'post',
                    data: function (d) {
                    }
                },
                columns: [
                    {data: 'person_code', name: 'person_code'},
                    {data: 'artist_name', name: 'artist_name'},
                    {data: 'profession', name: 'profession'},
                    {data: 'nationality', name: 'nationality'},
                    {data: 'mobile_number', name: 'mobile_number'},
                    {data: 'email', name: 'email'},
                    {data: 'identification_number', name: 'identification_number'},
                    {data: 'language_id', name: 'language_id'},
                    {data: 'fax_number', name: 'fax_number'},
                    {data: 'po_box', name: 'po_box'},
                    {data: 'emirate_id', name: 'emirate_id'},
                    {data: 'address_en', name: 'address_en'},
                    {data: 'artist_id', name: 'artist_id'},
                ],
            });
        });

        $('input[name="search-artist-name"]').change(function(){
            if($('#navlink #active_artist_click a').hasClass('active')) {
                $('#search_by_gender option').prop('selected', false)
                $('#search_by_age option').prop('selected', false)
                $('#search_by_nationality option').prop('selected', false)
                $('#search_by_profession option').prop('selected', false)
                /*        $('#navlink li a').removeClass('active');
                        var link = $('#all_permit_type_click a')
                        if (!link.hasClass('active')) {
                            link.addClass('active');
                        }*/
                var search_artist = $('input[name="search-artist-name"]').val();
                var filter_search ={{\App\ConstantValue::ARTISTNAME}};
                $.ajax({
                    method:"post",
                    url: '{{ route("admin.artist_permit_reports.artist_reports")}}',
                    data: {filter_search: filter_search, search_artist: search_artist}
                })
                if (search_artist != '' && filter_search != '') {
                    $('#block-artist').DataTable().destroy();
                    fill_datatable(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }

                active_artist_filter(filter_search, search_artist);
            }
            else {
                $('#search_by_gender option').prop('selected', false)
                $('#search_by_age option').prop('selected', false)
                $('#search_by_nationality option').prop('selected', false)
                $('#search_by_profession option').prop('selected', false)
                $('#navlink li a').removeClass('active');
                var link = $('#all_permit_type_click a')
                if (!link.hasClass('active')) {
                    link.addClass('active');
                }
                var search_artist = $('input[name="search-artist-name"]').val();
                var filter_search ={{\App\ConstantValue::ARTISTNAME}};
                $.ajax({
                    method:'post',
                    url: '{{ route("admin.artist_permit_reports.artist_reports")}}',
                    data: {filter_search: filter_search, search_artist: search_artist}
                })
                if (search_artist != '' && filter_search != '') {
                    $('#block-artist').DataTable().destroy();
                    fill_datatable(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
        });

        $('#active_artist_click').click(function (e) {
            e.preventDefault();
            var search_artist = $('#active_artist_input').val();
            var filter_search ={{\App\ConstantValue::STATUS}};
            $.ajax({
                method:'post',
                url: '{{ route("admin.artist_permit_reports.artist_reports")}}',
                data: {filter_search: filter_search, search_artist: search_artist}
            })
            if (filter_search != '' && search_artist != '') {
                $('#block-artist').DataTable().destroy();
                fill_datatable(filter_search, search_artist);
            } else {
                ArtistResetTable();
            }
        });

        $('#blocked_artist_click').click(function (e) {
            e.preventDefault();
            var search_artist = $('#blocked_artist_input').val();
            var filter_search ={{\App\ConstantValue::STATUS}};

            $.ajax({
                method:'post',
                url: '{{ route("admin.artist_permit_reports.artist_reports")}}',
                data: {filter_search: filter_search, search_artist: search_artist}
            })
            if (filter_search != '' && search_artist != '') {
                $('#block-artist').DataTable().destroy();
                fill_datatable(filter_search, search_artist);
            } else {
                ArtistResetTable();
            }
        });


        function fill_datatable(filter_search = '', search_artist = '') {
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            var time= + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            /*   console.log(filter_search +search_artist)*/
            var dataTable = $('#block-artist').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [ 6, 7, 8,9, 11],
                        "visible": false,
                    },
                    {
                        "targets": [1,2,3,4,5],
                        searchable: true
                    },

                ],

                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            if (filter_search == 1) {

                                if (search_artist == 'active') {
                                    return 'Active Artists' +datetime+Date.now();
                                }
                                if (search_artist == 'blocked') {
                                    return 'Blocked Artists' +datetime+Date.now();
                                }

                            }
                            if (filter_search == 2) {
                                return 'Artist Searched By Gender ' +datetime+Date.now();
                            }
                            if (filter_search == 3) {
                                return ' Artists List Searched By Name' +datetime+Date.now() ;
                            }
                            if (filter_search == 4) {
                                return ' Artists With Profession' +datetime +Date.now();
                            }

                            if (filter_search == 5) {
                                return ' Artists By Nationality' +datetime+Date.now() ;
                            }

                            if (filter_search == 6) {
                                if (search_artist == 'single') {
                                    return ' Artists With Single Permit' +datetime +Date.now();
                                }
                                if (search_artist == 'multiple') {
                                    return ' Artists With Multiple Permits' +datetime+Date.now() ;
                                }
                                if (search_artist == 'all') {
                                    return ' Artists With Active Permits' +datetime+Date.now() ;
                                }
                            }
                            if (filter_search == 7) {
                                return ' Artists List Searched By Visa Type' +datetime +Date.now();
                            }
                            if(filter_search == 8) {
                                if(search_artist == '17') {
                                    return ' Artists Below Age 18' +datetime+Date.now() ;
                                }
                                if(search_artist == '18') {
                                    return ' Artists Above Age 18' +datetime +Date.now();
                                }
                            }
                            if(filter_search == 9) {
                                return ' Artists List Searched By Area' +datetime+Date.now() ;
                            }
                        },
                        exportOptions: {
                            columns: [0,1,2,3,4,5],
                        },
                        customize: function ( win ) {
                            if (filter_search == 1) {

                                if (search_artist == 'active') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Active Artists </h3>'
                                    );
                                }
                                if (search_artist == 'blocked') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Blocked Artists </h3>'
                                    );
                                }
                            }
                            if (filter_search == 2) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artist Searched By Gender</h3>'
                                );
                            }
                            if (filter_search == 3) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artists List Searched By Name </h3>'
                                );
                            }
                            if (filter_search == 4) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artists List By Profession </h3>'
                                );
                            }
                            if (filter_search == 5) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artists List By Nationality </h3>'
                                );
                            }
                            if (filter_search == 6) {
                                if (search_artist == 'single') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Artists With Single Permit</h3>'
                                    );
                                }
                                if (search_artist == 'multiple') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Artists With Multiple Permits</h3>'
                                    );
                                }
                                if (search_artist == 'all') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Artists With Active Permits </h3>'
                                    );
                                }
                            }
                            if (filter_search == 7) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artists List Searched By Visa Type </h3>'
                                );
                            }
                            if (filter_search == 8) {
                                if (search_artist == '17') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Artists Below Age 18 </h3>'
                                    );
                                }
                                if (search_artist == '18') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Artists Above Age 18</h3>'
                                    );
                                }
                            }
                            if (filter_search == 9) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artists List Searched By Area</h3>'
                                );
                            }
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(win.document.body).find('h1')
                                .css( 'display', 'none' );

                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        },

                        title: function () {
                            if (filter_search == 1) {

                                if (search_artist == 'active') {
                                    return 'Active Artists' +datetime+Date.now();
                                }
                                if (search_artist == 'blocked') {
                                    return 'Blocked Artists' +datetime+Date.now();
                                }
                            }
                            if (filter_search == 3) {
                                return 'Artists List Searched By Name '+datetime+Date.now();
                            }
                            if (filter_search == 4) {
                                return 'Artists With Profession '+datetime+Date.now();
                            }

                            if (filter_search == 5) {
                                return 'Artists By Nationality '+datetime+Date.now();
                            }

                            if (filter_search == 6) {
                                if (search_artist == 'single') {
                                    return "Artists With Single Permit "+datetime+Date.now();
                                }
                                if (search_artist == 'multiple') {
                                    return "Artists With Multiple Permits "+datetime+Date.now();
                                }
                                if (search_artist == 'all') {
                                    return "Artists With Active Permits "+datetime+Date.now();
                                }
                            }
                            if (filter_search == 7) {
                                return 'Artists List Searched By Visa Type '+datetime+Date.now();
                            }

                            if (filter_search == 8) {
                                if (search_artist == '17') {
                                    return 'Artists Below Age 18 '+datetime+Date.now();
                                }
                                if (search_artist == '18') {
                                    return 'Artists Above Age 18 '+datetime+Date.now();
                                }
                            }

                            if (filter_search == 9) {
                                return 'Artists List Searched By Area '+datetime+Date.now();
                            }
                        },

                    }

                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                searching: true,
                ajax: {
                    url: '{{ route('admin.artist_permit_reports.search_artist')}}',
                    method: 'post',
                    data: {filter_search: filter_search, search_artist: search_artist}
                },
                columns: [
                    {data: 'person_code', name: 'person_code'},
                    {data: 'artist_name', name: 'artist_name'},
                    {data: 'profession', name: 'profession'},
                    {data: 'nationality', name: 'nationality'},
                    {data: 'mobile_number', name: 'mobile_number'},
                    {data: 'email', name: 'email'},
                    {data: 'identification_number', name: 'identification_number'},
                    {data: 'language_id', name: 'language_id'},
                    {data: 'fax_number', name: 'fax_number'},
                    {data: 'po_box', name: 'po_box'},
                    {data: 'emirate_id', name: 'emirate_id'},
                    {data: 'address_en', name: 'address_en'},
                    {data: 'artist_id', name: 'artist_id'},
                ],
            });
        }

        function active_artist_filter(filter_search = '', search_artist = '') {
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            var time= + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            /*   console.log(filter_search +search_artist)*/
            var dataTable = $('#block-artist').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [ 6, 7, 8,9, 11],
                        "visible": false,
                    },
                    {
                        "targets": [1,2,3,4,5],
                        searchable: true
                    },

                ],

                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            if (filter_search == 1) {

                                if (search_artist == 'active') {
                                    return 'Active Artists' +datetime+Date.now();
                                }
                                if (search_artist == 'blocked') {
                                    return 'Blocked Artists' +datetime+Date.now();
                                }

                            }
                            if (filter_search == 2) {
                                return 'Artist Searched By Gender ' +datetime+Date.now();
                            }
                            if (filter_search == 3) {
                                return ' Artists List Searched By Name' +datetime+Date.now() ;
                            }
                            if (filter_search == 4) {
                                return ' Artists With Profession' +datetime +Date.now();
                            }

                            if (filter_search == 5) {
                                return ' Artists By Nationality' +datetime+Date.now() ;
                            }

                            if (filter_search == 6) {
                                if (search_artist == 'single') {
                                    return ' Artists With Single Permit' +datetime +Date.now();
                                }
                                if (search_artist == 'multiple') {
                                    return ' Artists With Multiple Permits' +datetime+Date.now() ;
                                }
                                if (search_artist == 'all') {
                                    return ' Artists With Active Permits' +datetime+Date.now() ;
                                }
                            }
                            if (filter_search == 7) {
                                return ' Artists List Searched By Visa Type' +datetime +Date.now();
                            }

                            if (filter_search == 8) {
                                if (search_artist == '17') {
                                    return ' Artists Below Age 18' +datetime+Date.now() ;
                                }
                                if (search_artist == '18') {
                                    return ' Artists Above Age 18' +datetime +Date.now();
                                }
                            }
                            if (filter_search == 9) {
                                return ' Artists List Searched By Area' +datetime+Date.now() ;
                            }
                        },
                        exportOptions: {
                            columns: [0,1,2,3,4,5],
                        },
                        customize: function ( win ) {
                            if (filter_search == 1) {

                                if (search_artist == 'active') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Active Artists </h3>'
                                    );
                                }
                                if (search_artist == 'blocked') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Blocked Artists </h3>'
                                    );
                                }
                            }
                            if (filter_search == 2) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artist Searched By Gender</h3>'
                                );
                            }
                            if (filter_search == 3) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artists List Searched By Name </h3>'
                                );
                            }
                            if (filter_search == 4) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artists List By Profession </h3>'
                                );
                            }
                            if (filter_search == 5) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artists List By Nationality </h3>'
                                );
                            }
                            if (filter_search == 6) {
                                if (search_artist == 'single') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Artists With Single Permit</h3>'
                                    );
                                }
                                if (search_artist == 'multiple') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Artists With Multiple Permits</h3>'
                                    );
                                }

                                if (search_artist == 'all') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Artists With Active Permits </h3>'
                                    );
                                }
                            }
                            if (filter_search == 7) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artists List Searched By Visa Type </h3>'
                                );
                            }
                            if (filter_search == 8) {
                                if (search_artist == '17') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Artists Below Age 18 </h3>'
                                    );
                                }
                                if (search_artist == '18') {
                                    $(win.document.body).prepend(
                                        '<h3 style="font-family:arial;text-align:center">Artists Above Age 18</h3>'
                                    );
                                }
                            }
                            if (filter_search == 9) {
                                $(win.document.body).prepend(
                                    '<h3 style="font-family:arial;text-align:center">Artists List Searched By Area</h3>'
                                );
                            }
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(win.document.body).find('h1')
                                .css( 'display', 'none' );
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        },

                        title: function () {
                            if (filter_search == 1) {

                                if (search_artist == 'active') {
                                    return 'Active Artists' +datetime+Date.now();
                                }
                                if (search_artist == 'blocked') {
                                    return 'Blocked Artists' +datetime+Date.now();
                                }
                            }
                            if (filter_search == 3) {
                                return 'Artists List Searched By Name '+datetime+Date.now();
                            }
                            if (filter_search == 4) {
                                return 'Artists With Profession '+datetime+Date.now();
                            }
                            if (filter_search == 5) {
                                return 'Artists By Nationality '+datetime+Date.now();
                            }

                            if (filter_search == 6) {
                                if (search_artist == 'single') {
                                    return "Artists With Single Permit "+datetime+Date.now();
                                }
                                if (search_artist == 'multiple') {
                                    return "Artists With Multiple Permits "+datetime+Date.now();
                                }
                                if (search_artist == 'all') {
                                    return "Artists With Active Permits "+datetime+Date.now();
                                }
                            }
                            if (filter_search == 7) {
                                return 'Artists List Searched By Visa Type '+datetime+Date.now();
                            }
                            if (filter_search == 8) {
                                if (search_artist == '17') {
                                    return 'Artists Below Age 18 '+datetime+Date.now();
                                }
                                if (search_artist == '18') {
                                    return 'Artists Above Age 18 '+datetime+Date.now();
                                }
                            }
                            if (filter_search == 9) {
                                return 'Artists List Searched By Area '+datetime+Date.now();
                            }
                        },
                    }
                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                searching: true,
                ajax: {
                    url: '{{ route('admin.artist_permit_reports.search_active_artist')}}',
                    method: 'post',
                    data: {filter_search: filter_search, search_artist: search_artist,active:'active'}
                },
                columns: [
                    {data: 'person_code', name: 'person_code'},
                    {data: 'artist_name', name: 'artist_name'},
                    {data: 'profession', name: 'profession'},
                    {data: 'nationality', name: 'nationality'},
                    {data: 'mobile_number', name: 'mobile_number'},
                    {data: 'email', name: 'email'},
                    {data: 'identification_number', name: 'identification_number'},
                    {data: 'language_id', name: 'language_id'},
                    {data: 'fax_number', name: 'fax_number'},
                    {data: 'po_box', name: 'po_box'},
                    {data: 'emirate_id', name: 'emirate_id'},
                    {data: 'address_en', name: 'address_en'},
                    {data: 'artist_id', name: 'artist_id'},
                ],
            });
        }

        function ArtistResetTable() {
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            var time= + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            table = $('#block-artist').DataTable({
                dom: 'Bfrtip',
                "searching": true,
                "columnDefs": [
                    {
                        "targets": [ 6, 7, 8,9, 11],
                        "visible": false,
                        "searchable": false
                    },
                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },
                        title:function(){
                            return   'Artist With Active Permits '+datetime+Date.now();
                        },
                        customize: function ( win ) {
                            $(win.document.body).prepend(
                                '<h3 style="font-family:arial;text-align:center">Artist With Active Permits </h3>'
                            );
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(win.document.body).find('h1')
                                .css( 'display', 'none' )

                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        },
                        title: function () {
                            return 'Artists With Active Permits '+datetime+Date.now();
                        },

                    }
                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                ajax: {

                    url: '{{ route('admin.artist_permit_reports.artist_reports')}}',
                    method: 'post',
                    data: function (d) {
                    }
                },
                columns: [
                    {data: 'person_code', name: 'person_code'},
                    {data: 'artist_name', name: 'artist_name'},
                    {data: 'profession', name: 'profession'},
                    {data: 'nationality', name: 'nationality'},
                    {data: 'mobile_number', name: 'mobile_number'},
                    {data: 'email', name: 'email'},
                    {data: 'identification_number', name: 'identification_number'},
                    {data: 'language_id', name: 'language_id'},
                    {data: 'fax_number', name: 'fax_number'},
                    {data: 'po_box', name: 'po_box'},
                    {data: 'emirate_id', name: 'emirate_id'},
                    {data: 'address_en', name: 'address_en'},
                    {data: 'artist_id', name: 'artist_id'},
                ],
            });
        }

        $('#ArtistTableresetButton').click(function () {
            ArtistResetTable();
            $('#navlink li a').removeClass('active');
            var link = $('#all_permit_type_click a')
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
        });

        $('#artist-report-tab').click(function () {
            $('#transaction-report-tab ').removeClass('active');
            $('#search_by_gender option').prop('selected', false)
            $('#search_by_name').empty()
            $('#search_by_age option').prop('selected', false)
            $('#search_by_nationality option').prop('selected', false)
            $('#search_by_profession option').prop('selected', false)
            ArtistResetTable();
        })

        $('.search_button').click(function () {
            if($('#navlink #active_artist_click a').hasClass('active')) {

                var filter_search = $('#filter_search').val();
                var search_artist = $('#search_artist').val();
                if (filter_search != '' && search_artist != '') {
                    $('#block-artist').DataTable().destroy();
                    fill_datatable(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
            else{
                var filter_search = $('#filter_search').val();
                var search_artist = $('#search_artist').val();
                if (filter_search != '' && search_artist != '') {
                    $('#block-artist').DataTable().destroy();
                    fill_datatable(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
        });

        $('#search_by_status').change(function () {
            if($('#navlink #active_artist_click a').hasClass('active')) {

            }
            else{
                $('#search_by_gender option').prop('selected', false)
                $('#search_by_name').empty()
                $('#search_by_age option').prop('selected', false)
                $('#search_by_nationality option').prop('selected', false)
                $('#search_by_profession option').prop('selected', false)
                var filter_search = {{\App\ConstantValue::STATUS}};
                var search_artist = $('#search_by_status').val();
                $('#navlink li a').removeClass('active');
                var link = $('#all_permit_type_click a')
                if (!link.hasClass('active')) {
                    link.addClass('active');
                }
                if (filter_search != '' && search_artist != '') {
                    $('#block-artist').DataTable().destroy();

                    fill_datatable(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
        });

        $('#search_by_gender').change(function () {
            if($('#navlink #active_artist_click a').hasClass('active')) {
                $('#search_by_name').empty()
                $('#search_by_age option').prop('selected', false)
                $('#search_by_nationality option').prop('selected', false)
                $('#search_by_profession option').prop('selected', false)
                var filter_search = {{\App\ConstantValue::GENDER}};
                var search_artist = $('#search_by_gender').val();
                /*    $('#navlink li a').removeClass('active');
                    var link = $('#all_permit_type_click a')
                    if (!link.hasClass('active')) {
                        link.addClass('active');
                    }*/
                if (filter_search != '' && search_artist != '') {
                    $('#block-artist').DataTable().destroy();
                    $('#navbarCollapse').hide(400)
                    active_artist_filter(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
            else {
                $('#search_by_name').empty()
                $('#search_by_age option').prop('selected', false)
                $('#search_by_nationality option').prop('selected', false)
                $('#search_by_profession option').prop('selected', false)
                var filter_search = {{\App\ConstantValue::GENDER}};
                var search_artist = $('#search_by_gender').val();
                $('#navlink li a').removeClass('active');
                var link = $('#all_permit_type_click a')
                if (!link.hasClass('active')) {
                    link.addClass('active');
                }
                if (filter_search != '' && search_artist != '') {
                    $('#block-artist').DataTable().destroy();
                    $('#navbarCollapse').hide(400)
                    fill_datatable(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
        });

        $('#search_by_visa').change(function () {
            var filter_search = '{{\App\ConstantValue::VISATYPE}}';
            var search_artist = $('#search_by_visa').val();
            $('#navlink li a').removeClass('active');
            var link = $('#all_permit_type_click a')
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            if (filter_search != '' && search_artist != '') {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            } else {
                ArtistResetTable();
            }
        });


        $('#search_by_profession').change(function () {

            if($('#navlink #active_artist_click a').hasClass('active')) {
                $('#search_by_gender option').prop('selected', false)
                $('#search_by_name').empty()
                $('#search_by_age option').prop('selected', false)
                $('#search_by_nationality option').prop('selected', false)
                var filter_search = {{\App\ConstantValue::PROFESSION}};
                var search_artist = $('#search_by_profession').val();
                /*      $('#navlink li a').removeClass('active');
                      var link = $('#all_permit_type_click a')
                      if (!link.hasClass('active')) {
                          link.addClass('active');
                      }*/
                if (filter_search != '' && search_artist != '') {
                    $('#block-artist').DataTable().destroy();
                    $('#navbarCollapse').hide(400)
                    active_artist_filter(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
            else {
                $('#search_by_gender option').prop('selected', false)
                $('#search_by_name').empty()
                $('#search_by_age option').prop('selected', false)
                $('#search_by_nationality option').prop('selected', false)
                var filter_search = {{\App\ConstantValue::PROFESSION}};
                var search_artist = $('#search_by_profession').val();
                $('#navlink li a').removeClass('active');
                var link = $('#all_permit_type_click a')
                if (!link.hasClass('active')) {
                    link.addClass('active');
                }
                if (filter_search != '' && search_artist != '') {
                    $('#block-artist').DataTable().destroy();
                    $('#navbarCollapse').hide(400)
                    fill_datatable(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
        });

        $('#search_by_nationality').change(function () {
            if($('#navlink #active_artist_click a').hasClass('active')) {
                $('#search_by_gender option').prop('selected', false)
                $('#search_by_name').empty()
                $('#search_by_age option').prop('selected', false)
                $('#search_by_profession option').prop('selected', false)
                var filter_search = 5;
                var search_artist = $('#search_by_nationality').val();
                /*         $('#navlink li a').removeClass('active');
                         var link = $('#all_permit_type_click a')
                         if (!link.hasClass('active')) {
                             link.addClass('active');
                         }*/
                if (filter_search != '' && search_artist != '') {
                    $('#block-artist').DataTable().destroy();
                    active_artist_filter(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
            else {
                $('#search_by_gender option').prop('selected', false)
                $('#search_by_name').empty()
                $('#search_by_age option').prop('selected', false)
                $('#search_by_profession option').prop('selected', false)
                var filter_search = 5;
                var search_artist = $('#search_by_nationality').val();
                $('#navlink li a').removeClass('active');
                var link = $('#all_permit_type_click a')
                if (!link.hasClass('active')) {
                    link.addClass('active');
                }
                if (filter_search != '' && search_artist != '') {
                    $('#block-artist').DataTable().destroy();
                    fill_datatable(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
        });

        function myTableRefresh() {
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            table = $('#block-artist').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [ 6, 7, 8,9, 11],
                        "visible": false,
                        "searchable": false
                    },
                ],
                "searching": false,
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return '<img style="width:99%" src="{{asset('img/raktdalogo.png')}}">' +
                                '<h5 style="font-size:21px;text-align:center">ARTIST REPORT</h5>';
                        },
                        exportOptions: {
                            columns: ':not(:last-child)',
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.bgColor = 'red';
                            doc.styles.title.fontSize = 12;
                            doc.content[1].table.marginTop = 40;
                            doc.content[1].table.widths = ['13%', '20%', '14%', '18%', '14%', '21%'];
                            doc.styles.tableHeader = {'color': "Grey"};
                            doc['footer'] = (function (page, pages) {
                                return {

                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                        }
                                    ],
                                    margin: [10, 20],
                                }

                            });
                        },
                    },
                    {
                        extend: 'excel',
                        title: function () {
                            if (filter_search == 1) {
                                return 'Artist List searched by Status '+datetime+Date.now();
                            }
                            if (filter_search == 3) {
                                return 'Artist List searched by Name '+datetime+Date.now();
                            }
                            if (filter_search == 4) {
                                return 'Artist List searched by Profession '+datetime+Date.now();
                            }

                            if (filter_search == 5) {
                                return 'Artist List searched by Nationality '+datetime+Date.now();
                            }

                            if (filter_search == 6) {
                                return "Artist List searched by Artist Permit Count "+datetime+Date.now();
                            }
                        },

                    }
                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                ajax: {
                    url: '{{ route('admin.artist_permit_reports.artist_reports')}}',
                    method: 'post',
                    data: function (d) {
                    }
                },

                columns: [
                    {data: 'person_code', name: 'person_code'},
                    {data: 'artist_name', name: 'artist_name'},
                    {data: 'profession', name: 'profession'},
                    {data: 'nationality', name: 'nationality'},
                    {data: 'mobile_number', name: 'mobile_number'},
                    {data: 'email', name: 'email'},
                    {data: 'identification_number', name: 'identification_number'},
                    {data: 'language_id', name: 'language_id'},
                    {data: 'fax_number', name: 'fax_number'},
                    {data: 'po_box', name: 'po_box'},
                    {data: 'emirate_id', name: 'emirate_id'},
                    {data: 'address_en', name: 'address_en'},
                    {data: 'artist_id', name: 'artist_id'},

                ],

            });

        }


        $('#single_permit_type_click').click(function () {
            var filter_search ={{\App\ConstantValue::NUMBER_OF_PERMIT}};
            var search_artist = $('#single_permit_type_input').val();

            if (filter_search != '' && search_artist != '') {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            } else {
                ArtistResetTable();
            }
        })

        $('#multiple_permit_type_click').click(function () {
            $('#search_by_gender option').prop('selected', false)
            $('#search_by_name').empty()
            $('#search_by_age option').prop('selected', false)
            $('#search_by_nationality option').prop('selected', false)
            $('#search_by_profession option').prop('selected', false)
            var filter_search ={{\App\ConstantValue::NUMBER_OF_PERMIT}};
            var search_artist = $('#multiple_permit_type_input').val();

            if (filter_search != '' && search_artist != '') {
                $('#block-artist').DataTable().destroy();

                fill_datatable(filter_search, search_artist);
            } else {
                ArtistResetTable();
            }
        })

        $('#all_permit_type_click').click(function () {
            $('#startDate').val('');
            $('#startDate').val('');
            $('#search_by_gender option').prop('selected', false)
            $('#search_by_name').empty()
            $('#search_by_age option').prop('selected', false)
            $('#search_by_nationality option').prop('selected', false)
            $('#search_by_profession option').prop('selected', false)
            var filter_search ={{\App\ConstantValue::NUMBER_OF_PERMIT}};
            var search_artist = $('#all_permit_type_input').val();

            if (filter_search != '' && search_artist != '') {
                $('#block-artist').DataTable().destroy();
                fill_datatable(filter_search, search_artist);
            } else {
                ArtistResetTable();
            }
        })

        $('#search_by_age').change(function () {
            if($('#navlink #active_artist_click a').hasClass('active')) {
                $('#search_by_gender option').prop('selected', false)
                $('#search_by_name').empty()

                $('#search_by_nationality option').prop('selected', false)
                $('#search_by_profession option').prop('selected', false)
                var filter_search ={{\App\ConstantValue::AGE}};
                var search_artist = $('#search_by_age').val();
                /*        $('#navlink li a').removeClass('active');
                        var link = $('#all_permit_type_click a')
                        if (!link.hasClass('active')) {
                            link.addClass('active');
                        }*/
                if (filter_search != '' && search_artist != '') {
                    $('#block-artist').DataTable().destroy();
                    active_artist_filter(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
            else {

                $('#search_by_gender option').prop('selected', false)
                $('#search_by_name').empty()

                $('#search_by_nationality option').prop('selected', false)
                $('#search_by_profession option').prop('selected', false)
                var filter_search ={{\App\ConstantValue::AGE}};
                var search_artist = $('#search_by_age').val();
                $('#navlink li a').removeClass('active');
                var link = $('#all_permit_type_click a')
                if (!link.hasClass('active')) {
                    link.addClass('active');
                }
                if (filter_search != '' && search_artist != '') {
                    $('#block-artist').DataTable().destroy();
                    fill_datatable(filter_search, search_artist);
                } else {
                    ArtistResetTable();
                }
            }
        })

        $('#search_by_area').change(function () {
            $('#search_by_gender option').prop('selected', false)
            $('#search_by_name').empty()
            $('#search_by_age option').prop('selected', false)
            $('#search_by_nationality option').prop('selected', false)
            $('#search_by_profession option').prop('selected', false)
            var filter_search ={{\App\ConstantValue::AREA}};
            var search_artist = $('#search_by_area').val();
            $('#navlink li a').removeClass('active');
            var link = $('#all_permit_type_click a')
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            if (filter_search != '' && search_artist != '') {
                $('#block-artist').DataTable().destroy();
                $('#navbarCollapse').hide(400)
                fill_datatable(filter_search, search_artist);
            } else {
                ArtistResetTable();
            }
        })


        //Event Report JS

        function event(xyz) {
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            var time=   + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            table = $('#event-report').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [4,5,6, 10],
                        "visible": false,
                        "searchable": false
                    },

                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            if (xyz == "all") {
                                return 'All Events '+datetime+Date.now();
                            }
                            if (xyz == "+30") {
                                return ' Events In Next 30 Days' +datetime+Date.now() ;
                            }
                            if (xyz == "-30") {
                                return ' Events In Last 30 Days' +datetime+Date.now() ;
                            }
                            if (xyz == "+60") {
                                return ' Events In Next 60 Days' +datetime +Date.now();
                            }
                            if (xyz == "active") {
                                return ' All Active Events' +datetime+Date.now() ;
                            }
                        },
                        exportOptions: {
                            columns: [0, 1, 3, 7, 8, 9]
                        },
                        customize: function (doc){
                            if (xyz == "all") {
                                $(doc.document.body).prepend('<h3 style="text-align: center">All Events</h3>')
                            }
                            if (xyz == "+30") {
                                $(doc.document.body).prepend('<h3 style="text-align: center">Events In Next 30 Days</h3>')
                            }
                            if (xyz == "-30") {
                                $(doc.document.body).prepend('<h3 style="text-align: center">Events In Last 30 Days</h3>')

                            }
                            if (xyz == "+60") {
                                $(doc.document.body).prepend('<h3 style="text-align: center">Events In Next 60 Days</h3>')

                            }
                            if (xyz == "active") {
                                $(doc.document.body).prepend('<h3 style="text-align: center">All Active Events</h3>')
                            }
                            $(doc.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(doc.document.body).find('h1')
                                .css( 'display', 'none' );

                            $(doc.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        },
                    },

                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },
                        title: function () {
                            if (xyz == "all") {
                                return 'All Events Report '+datetime+Date.now();
                            }
                            if (xyz == "+30") {
                                return 'Events In NExt 30 Days '+datetime+Date.now();
                            }
                            if (xyz == "-30") {
                                return 'Events In Last 30 Days '+datetime+Date.now();
                            }
                            if (xyz == "+60") {
                                return 'Events In Next 60 Days '+datetime+Date.now();
                            }
                            if (xyz == "active") {
                                return 'All Active Events '+datetime+Date.now()
                            }
                        },
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                ajax: {
                    url: '{{ route('admin.event_reports.events')}}',
                    method: 'post',
                    data: {events: xyz}
                },
                columns: [
                    {data: 'reference_number', name: 'reference_number'},
                    {data: 'application_type', name: 'application_type'},
                    {data: 'event_type_id', name: 'event_type_id'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'description_en', name: 'description_en'},
                    {data: 'venue_en', name: 'venue_en'},
                    {data: 'address', name: 'address'},
                    {data: 'company_id', name: 'company_id'},
                    {data: 'issued_date', name: 'issued_date'},
                    {data: 'expired_date', name: 'expired_date'},
                    {data: 'status', name: 'status'},
                    {data: 'event_id', name: 'event_id'},
                ],
            });
        }

        $('#event-report-tab').click(function () {

            $('#artist-permit-nav .nav-item').removeClass('active');
            $('#transaction-report-tab ').removeClass('active');

            var link = $('#artist-permit-nav .active');
            if (!link.hasClass('active')) {
                link.addClass('active');
            }

            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            table = $('#event-report').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [4,5,6, 10],
                        "visible": false,
                        "searchable": false
                    },

                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return 'Active Events '+datetime+Date.now()
                        },
                        exportOptions: {
                            columns: [0, 1, 3, 7, 8, 9]
                        },
                        customize: function (doc){
                            $(doc.document.body).prepend('<h3 style="text-align: center">All Active Events</h3>')

                            $(doc.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(doc.document.body).find('h1')
                                .css( 'display', 'none');

                            $(doc.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        },
                    },

                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },
                        title: function () {
                            return 'Active Events' +datetime+Date.now();
                        },
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
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
                    {data: 'reference_number', name: 'reference_number'},
                    {data: 'application_type', name: 'application_type'},
                    {data: 'event_type_id', name: 'event_type_id'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'description_en', name: 'description_en'},
                    {data: 'venue_en', name: 'venue_en'},
                    {data: 'address', name: 'address'},
                    {data: 'company_id', name: 'company_id'},
                    {data: 'issued_date', name: 'issued_date'},
                    {data: 'expired_date', name: 'expired_date'},

                    {data: 'status', name: 'status'},
                    {data: 'event_id', name: 'event_id'},
                ],
            });
        });

        $('#all_events').click(function () {
            var events = $('#all_events_input').val();

            if (events != '') {
                $('#event-report').DataTable().destroy();
                event(events);
            } else {
                alert('No Value');
            }

        });

        $('#active_events').click(function () {
            var events = $('#active_events_input').val();
            if (events != '') {
                $('#event-report').DataTable().destroy();

                event(events);
            } else {
                alert('No Value');
            }

        });
        $('#events_next_30_days').click(function () {
            var events = $('#events_in_30_days').val();
            if (events != '') {
                $('#event-report').DataTable().destroy();
                event(events);
            } else {
                alert('No Value');
            }

        });

        $('#events_next_60_days').click(function () {
            var events = $('#events_in_60_days').val();
            if (events != '') {
                $('#event-report').DataTable().destroy();

                event(events);
            } else {
                alert('No Value');
            }

        });

        $('#events_previous_30_days').click(function () {
            var events = $('#events_in_previous_30_days').val();
            if (events != '') {
                $('#event-report').DataTable().destroy();

                event(events);
            } else {
                alert('No Value');
            }

        });


        $('#reset_event_table').click(function () {
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            var time= + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            table = $('#event-report').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [4,5,6, 10],
                        "visible": false,
                        "searchable": false
                    },

                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return 'Active Events '+datetime+Date.now()
                        },
                        exportOptions: {
                            columns: [0, 1, 3, 7, 8, 9]
                        },
                        customize: function (doc){
                            $(doc.document.body).prepend('<h3 style="text-align: center">All Active Events</h3>')

                            $(doc.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(doc.document.body).find('h1')
                                .css( 'display', 'none');

                            $(doc.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        },
                    },

                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },
                        title: function () {
                            return 'Active Events' +datetime+Date.now();
                        },
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
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

                    {data: 'reference_number', name: 'reference_number'},
                    {data: 'application_type', name: 'application_type'},
                    {data: 'event_type_id', name: 'event_type_id'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'description_en', name: 'description_en'},
                    {data: 'venue_en', name: 'venue_en'},
                    {data: 'address', name: 'address'},
                    {data: 'company_id', name: 'company_id'},
                    {data: 'issued_date', name: 'issued_date'},
                    {data: 'expired_date', name: 'expired_date'},
                    {data: 'status', name: 'status'},
                    {data: 'event_id', name: 'event_id'},


                ],
            });

        })

        $('#application-type').change(function () {
            $('#event_ul_list li a').removeClass('active');
            $('#active_events a').removeClass('active');
            $('#events_next_30_days a').removeClass('active');
            $('#events_next_60_days a').removeClass('active');
            var link = $('#active_events a')
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            var time= + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            var application_type = $('#application-type').val();
            table = $('#event-report').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [2, 4, 6, 9],
                        "visible": false,
                        "searchable": false
                    },

                ],
                "searching": false,
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return 'Events Searched By Application Type ' +datetime+Date.now();
                        },
                        exportOptions: {
                            columns: [0, 1, 3, 7, 8, 9]
                        },
                        customize: function (doc){

                            $(doc.document.body).prepend('<h3 style="text-align: center">Events Searched By Application Type</h3>')

                            $(doc.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(doc.document.body).find('h1')
                                .css( 'display', 'none');

                            $(doc.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        },
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },
                        title: function () {
                            return 'Events Searched With Application Type'
                        },
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
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
                    data: {application_type: application_type}
                },
                columns: [

                    {data: 'reference_number', name: 'reference_number'},
                    {data: 'application_type', name: 'application_type'},
                    {data: 'event_type_id', name: 'event_type_id'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'description_en', name: 'description_en'},
                    {data: 'venue_en', name: 'venue_en'},
                    {data: 'address', name: 'address'},
                    {data: 'company_id', name: 'company_id'},
                    {data: 'issued_date', name: 'issued_date'},
                    {data: 'expired_date', name: 'expired_date'},
                    {data: 'status', name: 'status'},
                    {data: 'event_id', name: 'event_id'},


                ],
            });

        });


        // Applied Date
        $('#applied-date').change(function () {
            $('#event_ul_list li a').removeClass('active');
            var link = $('#active_events a')
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
            /* + currentdate.getHours() + ":"
             + currentdate.getMinutes() + ":"
             + currentdate.getSeconds();*/
            var applied_date = $('#applied-date').val();
            table = $('#event-report').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [4,5,6, 10],
                        "visible": false,
                        "searchable": false
                    },

                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return 'Active Events '+datetime+Date.now()
                        },
                        exportOptions: {
                            columns: [0, 1, 3, 7, 8, 9]
                        },
                        customize: function (doc){
                            if(applied_date==1 ){
                                $(doc.document.body).prepend('<h3 style="text-align: center">All Active Events on Today </h3>')
                            }
                            if(applied_date==2){
                                $(doc.document.body).prepend('<h3 style="text-align: center">All Active Events on Yesterday</h3>')

                            }
                            if(applied_date==3){
                                $(doc.document.body).prepend('<h3 style="text-align: center">All Active Events Last 7 Days</h3>')

                            }
                            if(applied_date==4){
                                $(doc.document.body).prepend('<h3 style="text-align: center">All Active Events Last 30 Days</h3>')

                            }
                            if(applied_date==5){
                                $(doc.document.body).prepend('<h3 style="text-align: center">All Active Events This Month</h3>')

                            }
                            if(applied_date==6){
                                $(doc.document.body).prepend('<h3 style="text-align: center">All Active Events Last Month</h3>')

                            }
                            else{
                                $(doc.document.body).prepend('<h3 style="text-align: center">All Active Events</h3>')

                            }

                            $(doc.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(doc.document.body).find('h1')
                                .css( 'display', 'none');

                            $(doc.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        },
                    },

                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },
                        title: function () {
                            if(applied_date==1 ){
                                return 'All Active Events on Today '+datetime+Date.now()
                            }
                            if(applied_date==2){
                                return 'All Active Events on Yesterday '+datetime+Date.now()

                            }
                            if(applied_date==3){
                                return 'All Active Events Last 7 Days '+datetime+Date.now()

                            }
                            if(applied_date==4){
                                return 'All Active Events Last 30 Days '+datetime+Date.now()

                            }
                            if(applied_date==5){
                                return 'All Active Events This Month '+datetime+Date.now()

                            }
                            if(applied_date==6){
                                return 'All Active Events Last Month '+datetime+Date.now()

                            }
                            else{
                                return 'All Active Events '+datetime+Date.now()

                            }
                        },
                    }
                ],
                lengthMenu: [
                    [10, 25, 50 /*-1*/],
                    ['10 rows', '25 rows', '50 rows'/*, 'Show all'*/]
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
                    data: {applied_date: applied_date}
                },
                columns: [

                    {data: 'reference_number', name: 'reference_number'},
                    {data: 'application_type', name: 'application_type'},
                    {data: 'event_type_id', name: 'event_type_id'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'description_en', name: 'description_en'},
                    {data: 'venue_en', name: 'venue_en'},
                    {data: 'address', name: 'address'},
                    {data: 'company_id', name: 'company_id'},
                    {data: 'issued_date', name: 'issued_date'},
                    {data: 'expired_date', name: 'expired_date'},
                    {data: 'status', name: 'status'},
                    {data: 'event_id', name: 'event_id'},


                ],
            });

        })

        //status

        $('#status').change(function () {
            $('#event_ul_list li a').removeClass('active');
            var link = $('#active_events a')
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            var status = $('#status').val();
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            table = $('#event-report').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [2, 4, 6, 9],
                        "visible": false,
                        "searchable": false
                    },

                ],
                "searching": false,
                buttons: ['pageLength',

                    {

                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 3, 7, 8, 9]
                        },
                        title: function () {
                            return '<img style="width:99%" src="{{asset('img/raktdalogo.png')}}">' +
                                '<h5 style="font-size:21px;text-align:center">EVENT REPORT</h5>';
                        },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 13;
                            doc.content[1].table.widths = [
                                '15%',
                                '20%',
                                '15%',
                                '15%',
                                '15%',
                                '20%',
                            ]
                            doc.styles.tableHeader = {'color': "Grey"};
                            doc['footer'] = (function (page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header'] = (function (page, pages) {
                                return {
                                    columns: [

                                        {
                                            alignment: 'right',
                                            text: ['']
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },
                        title: function () {
                            return 'EVENT REPORT';
                        },
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
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
                    data: {status: status}
                },
                columns: [

                    {data: 'reference_number', name: 'reference_number'},
                    {data: 'application_type', name: 'application_type'},
                    {data: 'event_type_id', name: 'event_type_id'},

                    {data: 'name_en', name: 'name_en'},
                    {data: 'description_en', name: 'description_en'},
                    {data: 'venue_en', name: 'venue_en'},
                    {data: 'address', name: 'address'},
                    {data: 'company_id', name: 'company_id'},
                    {data: 'issued_date', name: 'issued_date'},
                    {data: 'expired_date', name: 'expired_date'},
                    {data: 'status', name: 'status'},
                    {data: 'event_id', name: 'event_id'},

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


            transactions();
            eventTable();
            chartCurrentMonth();
            function eventTable(){
                var currentdate = new Date();
                var datetime = +currentdate.getDate() + "-"
                    + (currentdate.getMonth() + 1) + "-"
                    + currentdate.getFullYear() + "  "
                    + currentdate.getHours() + ":"
                    + currentdate.getMinutes() + ":"
                    + currentdate.getSeconds();
                table = $('#event-report').DataTable({
                    dom: 'Bfrtip',
                    "columnDefs": [
                        {
                            "targets": [4,5,6, 10],
                            "visible": false,
                            "searchable": false
                        },

                    ],
                    buttons: ['pageLength',
                        {
                            extend: 'print',
                            title: function () {
                                return 'Active Events '+datetime
                            },
                            exportOptions: {
                                columns: [0, 1, 3, 7, 8, 9]
                            },
                            customize: function (doc){
                                $(doc.document.body).prepend('<h3 style="text-align: center">All Active Events</h3>')

                                $(doc.document.body)
                                    .css( 'font-size', '10pt' )
                                    .prepend(
                                        '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                    );
                                $(doc.document.body).find('h1')
                                    .css( 'display', 'none');

                                $(doc.document.body).find( 'table' )
                                    .addClass( 'compact' )
                                    .css({ 'font-size': 'inherit'});
                            },
                        },

                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                            },
                            title: function () {
                                return 'Active Events' +datetime;
                            },
                        }
                    ],
                    lengthMenu: [
                        [10, 25, 50, -1],
                        ['10 rows', '25 rows', '50 rows', 'Show all']
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
                        {data: 'reference_number', name: 'reference_number'},
                        {data: 'application_type', name: 'application_type'},
                        {data: 'event_type_id', name: 'event_type_id'},
                        {data: 'name_en', name: 'name_en'},
                        {data: 'description_en', name: 'description_en'},
                        {data: 'venue_en', name: 'venue_en'},
                        {data: 'address', name: 'address'},
                        {data: 'company_id', name: 'company_id'},
                        {data: 'issued_date', name: 'issued_date'},
                        {data: 'expired_date', name: 'expired_date'},
                        {data: 'status', name: 'status'},
                        {data: 'event_id', name: 'event_id'},
                    ],
                });
            }



            $("#kt_page_portlet > div > section > div:nth-child(1) > div").click(function () {
                $('.nav-tabs a[href="#new-request"]').tab('show');
            });
            $("#kt_page_portlet > div > section > div:nth-child(2) > div").click(function () {
                $('.nav-tabs a[href="#pending-request"]').tab('show');
            });
            //   $("#kt_page_portlet > div > section > div:nth-child(3) > div").click(function(){
            //  $('.nav-tabs a[href="#new-request"]').tab('show');
            // });
            // Instantiate the Bloodhound suggestion engine
            var result = new Bloodhound({
                datumTokenizer: function (datum) {
                    return Bloodhound.tokenizers.whitespace(datum.value);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    wildcard: '%QUERY',
                    url: '{{ route('admin.artist_permit.search') }}?q=%QUERY',
                    transform: function (response) {
                        // Map the remote source JSON array to a JavaScript object array
                        return $.map(response.reference_number, function (data) {
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
            setInterval(function () {
                newRequest();
                pendingRequest();
            }, 100000);

            hash && $('ul.nav a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function (e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });

            $('.nav-tabs a').on('shown.bs.tab', function (event) {
                var current_tab = $(event.target).attr('href');
                if (current_tab == '#pending-request') {
                    pendingRequest();
                }
                if (current_tab == '#processing-permit') {
                    processingTable();
                }
                if (current_tab == '#active-permit') {
                    approvedTable();
                }
                if (current_tab == '#archive-permit') {
                    rejectedTable();
                }
                if (current_tab == '#active-artist') {
                    activeArtistTable();
                }
                if (current_tab == '#blocked-artist') {
                    blockArtistTable();
                }
                if (current_tab == '#all-artist-permits') {
                    allPermitTable();
                }
            });
        });

        function blockArtistTable() {
            $('button#unblock-artist-button').click(function () {

                var rows_selected = block_artist_table.column(0).checkboxes.selected();
                artist_id = [5]
                $.each(rows_selected, function (index, rowId) {
                    artist_id.push(rowId);
                })
                if (artist_id.length > 0) {
                    $.ajax({
                        type: 'post',
                        url: " {{route('admin.checked_list')}}",
                        data: {id: artist_id},
                        success: function (data) {
                            var html = $('#unblock_checked_list').html('<tr><th>Sn</th><th>Name</th><th>Person Code</th></tr>');
                            $.each(data, function (key, val) {
                                var value = key + 1;
                                $(html).append('<tr><td>' + value + '</td><td>' + val.firstname_en + ' ' + val.lastname_en + '</td><td>' + val.person_code + '</td></tr>');
                            });
                        }
                    });
                }

                if (rows_selected.length > 0) {
                    $('#block_artist_number').html(rows_selected.length + '  Artist Seleted').css({'color': 'green'})
                    $('#block-artist-alert').addClass('d-none');
                    $('#block-artist-modal').modal('show');
                    $('#unblock_artist').click('submit', function (e) {
                        e.preventDefault();
                        artist_id = [5]
                        $.each(rows_selected, function (index, rowId) {
                            artist_id.push(rowId);
                        })

                        var remarks = $('#unblock_comment').val();
                        if (artist_id.length > 0) {
                            $.ajax({
                                type: 'post',
                                url: " {{route('admin.artist_unblock')}}",
                                data: {id: artist_id, remarks},
                                success: function (data) {
                                    $("#delete-ajax-alert").show(500).css({
                                        'background-color': '#fff2f2',
                                        'color': 'red',
                                        'padding': '9px',
                                        'border-radius': '7px',
                                        'text-align': 'center'
                                    });
                                    setTimeout(function () {
                                        $("#delete-ajax-alert").hide();
                                        $('#block-artist-modal').modal('hide');
                                    }, 2000);
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


            block_artist_table = $('table#block-artist').DataTable({
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
                        targets: 0,
                        orderable: false,
                        checkboxes: {
                            selectRow: true
                        }
                    }
                ],
                select: {
                    style: 'multi'
                },

                columns: [

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
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            active_artist_table = $('table#active-artist').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [ 6, 7, 8,9, 11],
                        "visible": false,
                        "searchable": false
                    },

                ],
                "searching": false,
                buttons: ['pageLength',
                    {

                        extend: 'print',

                        title: function () {
                            return '<img style="width:99%" src="{{asset('img/raktdalogo.png')}}">' +
                                '<h5 style="font-size:21px;text-align:center">ARTIST PERMIT REPORT</h5>';
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
                            doc.styles.tableHeader = {'color': "Grey"};
                            doc['footer'] = (function (page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header'] = (function (page, pages) {
                                return {
                                    columns: [

                                        {
                                            alignment: 'right',
                                            text: ['']
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });

                        }
                    },
                    {
                        extend: 'excel',
                        title: function () {
                            return 'ARTIST PERMIT REPORT';
                        },
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
                        location.href = '{{url('/artist_reports/artist_permit_report/show/')}}/' + data.artist_id + '?tab=' + hash;
                    });

                }
            });


            //clear fillter button
            $('#artist-btn-reset').click(function () {
                $(this).closest('form.form-row')[0].reset();
                active_artist_table.draw();
            });

            active_artist_table.page.len($('#artist-length-change').val());
            $('#artist-length-change').change(function () {
                active_artist_table.page.len($(this).val()).draw();
            });

            var search = $.fn.dataTable.util.throttle(function (v) {
                active_artist_table.search(v).draw();
            }, 500);
            $('input#search-artist-request').keyup(function () {
                search($(this).val());
            });


            $('div.toolbar-active').html('<button type="button" id="btn-active-action" class="btn btn-warning btn-sm kt-font-transform-u">Block Artist</button>');
            $('div.toolbar-active-1').html($('#active-profession-container'));
            $('div.toolbar-active-2').html($('#active-nationality-container'));

            $('button#btn-active-action').click(function () {
                var rows_selected = active_artist_table.column(0).checkboxes.selected();
                artist_id = [5]
                $.each(rows_selected, function (index, rowId) {
                    artist_id.push(rowId);
                })
                if (artist_id.length > 0) {
                    $.ajax({
                        type: 'post',
                        url: " {{route('admin.checked_list')}}",
                        data: {id: artist_id},
                        success: function (data) {
                            var html = $('#checked_list').html('<tr><th>Sn</th><th>Name</th><th>Person Code</th></tr>')
                            $.each(data, function (key, val) {
                                var value = key + 1;
                                $(html).append('<tr><td>' + value + '</td><td>' + val.firstname_en + ' ' + val.lastname_en + '</td><td>' + val.person_code + '</td></tr>');
                            });
                        }
                    });

                }
                if (rows_selected.length > 0) {
                    $('#active-artist-alert').addClass('d-none');
                    $('#active-artist-modal').modal('show');

                    $('#block_artist').click('submit', function (e) {
                        e.preventDefault();
                        artist_id = [5]
                        $.each(rows_selected, function (index, rowId) {
                            artist_id.push(rowId);
                        })
                        if (artist_id.length > 0) {

                            var remarks = $('#comment').val();
                            $.ajax({
                                type: 'post',
                                url: " {{route('admin.artist_block')}}",
                                data: {id: artist_id, remarks},
                                success: function (data) {
                                    $("#ajax-alert").show(500).css({
                                        'background-color': '#fff2f2',
                                        'color': 'red',
                                        'padding': '9px',
                                        'border-radius': '7px',
                                        'text-align': 'center'
                                    });
                                    setTimeout(function () {
                                        $("#ajax-alert").hide();
                                        $('#active-artist-modal').modal('hide');
                                    }, 2000);
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
            }).on('apply.daterangepicker', function (e, d) {
                new_selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD')};
                activePermit.draw();
            });

            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            activePermit = $('table#artist-permit-approved').DataTable({
                dom: 'Bfrtip',
                "searching": false,
                buttons: ['pageLength',

                    {

                        extend: 'print',

                        title: function () {
                            return '<img style="width:99%" src="{{asset('img/raktdalogo.png')}}">' +
                                '<h5 style="font-size:21px;text-align:center">ACTIVE ARTISTS PERMIT REPORT</h5>';
                        },
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
                            doc.styles.tableHeader = {'color': "Grey"};
                            doc['footer'] = (function (page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header'] = (function (page, pages) {
                                return {
                                    columns: [

                                        {
                                            alignment: 'right',
                                            text: ['']
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });


                        }
                    },
                    {
                        extend: 'excel',
                        title: function () {
                            return 'ACTIVE ARTIST PERMIT REPORT';
                        },
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
                        location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '?tab=#active-permit';
                    });
                }
            });

            //clear fillte button
            $('#active-btn-reset').click(function () {
                $(this).closest('form.form-row')[0].reset();
                activePermit.draw();
            });

            activePermit.page.len($('#acive-length-change').val());
            $('#active-length-change').change(function () {
                activePermit.page.len($(this).val()).draw();
            });

            var search = $.fn.dataTable.util.throttle(function (v) {
                activePermit.search(v).draw();
            }, 500);
            $('input#search-active-request').keyup(function () {
                search($(this).val());
            });
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
            }).on('apply.daterangepicker', function (e, d) {
                selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD')};
                processingPermit.draw();
            });


            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            processingPermit = $('table#artist-permit-processing').DataTable({
                dom: 'Bfrtip',
                "searching": false,
                buttons: ['pageLength',

                    {

                        extend: 'print',

                        title: function () {
                            return '<img style="width:99%" src="{{asset('img/raktdalogo.png')}}">' +
                                '<h5 style="font-size:21px;text-align:center">ARTIST PERMIT PRECESSING REPORT</h5>';
                        },
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
                            doc.styles.tableHeader = {'color': "Grey"};
                            doc['footer'] = (function (page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header'] = (function (page, pages) {
                                return {
                                    columns: [
                                        'Header Artist Report',
                                        {
                                            alignment: 'right',
                                            text: ['']
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });


                        }
                    },
                    {
                        extend: 'excel',
                        title: function () {
                            return 'ARTIST PERMIT PROCESSING REPORT';
                        },
                    }
                ],
                ajax: {
                    url: '{{ route('admin.artist_permit_report.active_permit') }}',
                    data: function (d) {
                        d.request_type = $('select[name="report-new-request-type"]').val();
                        d.status = $('select[name="report-new-request-status"]').val();
                        d.date = $('select[name="report-new-applied-date"]').val();
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
                        location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '?tab=#processing-permit';
                    });
                }
            });

            //clear fillte button
            $('#processing-btn-reset').click(function () {
                $(this).closest('form.form-row')[0].reset();
                processingPermit.draw();
            });

            processingPermit.page.len($('#processing-length-change').val());
            $('#processing-length-change').change(function () {
                processingPermit.page.len($(this).val()).draw();
            });

            var search = $.fn.dataTable.util.throttle(function (v) {
                processingPermit.search(v).draw();
            }, 500);
            $('input#search-processing-request').keyup(function () {
                search($(this).val());
            });
        }


        function processingTable() {
            var start = moment().subtract(29, 'days');
            var end = moment();
            var selected_date = [];
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
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
            }).on('apply.daterangepicker', function (e, d) {
                selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD')};
                processingPermit.draw();
            });

            processingPermit = $('table#artist-permit-processing').DataTable({
                dom: 'Bfrtip',
                "searching": false,
                buttons: ['pageLength',

                    {

                        extend: 'print',

                        title: function () {
                            return '<img style="width:99%" src="{{asset('img/raktdalogo.png')}}">' +
                                '<h5 style="font-size:21px;text-align:center">ARTIST PERMIT PRECESSING REPORT</h5>';
                        },
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
                            doc.styles.tableHeader = {'color': "Grey"};
                            doc['footer'] = (function (page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header'] = (function (page, pages) {
                                return {
                                    columns: [
                                        'Header Artist Report',
                                        {
                                            alignment: 'right',
                                            text: ['']
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });


                        }
                    },
                    {
                        extend: 'excel',
                        title: function () {
                            return 'ARTIST PERMIT PROCESSING REPORT';
                        },
                    }
                ],
                ajax: {
                    url: '{{ route('admin.artist_permit_report.active_permit') }}',
                    data: function (d) {
                        d.request_type = $('select[name="report-new-request-type"]').val();
                        d.status = $('select[name="report-new-request-status"]').val();
                        d.date = $('select[name="report-new-applied-date"]').val();
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
                        location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '?tab=#processing-permit';
                    });
                }
            });

            //clear fillte button
            $('#processing-btn-reset').click(function () {
                $(this).closest('form.form-row')[0].reset();
                processingPermit.draw();
            });

            processingPermit.page.len($('#processing-length-change').val());
            $('#processing-length-change').change(function () {
                processingPermit.page.len($(this).val()).draw();
            });

            var search = $.fn.dataTable.util.throttle(function (v) {
                processingPermit.search(v).draw();
            }, 500);
            $('input#search-processing-request').keyup(function () {
                search($(this).val());
            });
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
            }).on('apply.daterangepicker', function (e, d) {
                selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD')};
                archivePermit.draw();
            });

            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            archivePermit = $('table#artist-permit-rejected').DataTable({
                dom: 'Bfrtip',
                "searching": false,
                buttons: ['pageLength',

                    {

                        extend: 'print',

                        title: function () {
                            return '<img style="width:99%" src="{{asset('img/raktdalogo.png')}}">' +
                                '<h5 style="font-size:21px;text-align:center">ARTIST PERMIT REJECTED REPORT</h5>';
                        },
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
                            doc.styles.tableHeader = {'color': "Grey"};
                            doc['footer'] = (function (page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header'] = (function (page, pages) {
                                return {
                                    columns: [
                                        'Header Artist Report',
                                        {
                                            alignment: 'right',
                                            text: ['']
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });

                        }
                    },
                    {
                        extend: 'excel',
                        title: function () {
                            return 'ARTIST PERMIT REJETCED REPORT';
                        },
                    }
                ],
                ajax: {
                    url: '{{ route('admin.artist_permit.datatable') }}',
                    data: function (d) {

                        var status = $('select#archive-permit-status').val();
                        d.request_type = $('select#archive-request-type').val();
                        d.status = status != null ? [status] : ['rejected', 'expired', 'unprocessed'];
                        d.date = $('#archive-applied-date').val() ? selected_date : null;
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
                        location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '?tab=#archive-permit';
                    });
                }
            });
            //clear fillte button
            $('#archive-btn-reset').click(function () {
                $(this).closest('form.form-row')[0].reset();
                archivePermit.draw();
            });

            archivePermit.page.len($('#archive-length-change').val());
            $('#archive-length-change').change(function () {
                archivePermit.page.len($(this).val()).draw();
            });


            var search = $.fn.dataTable.util.throttle(function (v) {
                archivePermit.search(v).draw();
            }, 500);
            $('input#search-archive-request').keyup(function () {
                search($(this).val());
            });

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
            }).on('apply.daterangepicker', function (e, d) {
                selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD')};
                pendingPermit.draw();
            });

            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            pendingPermit = $('table#pending-permit').DataTable({
                dom: 'Bfrtip',
                "searching": false,
                buttons: ['pageLength',

                    {
                        extend: 'print',

                        title: function () {
                            return '<img style="width:99%" src="{{asset('img/raktdalogo.png')}}">' +
                                '<h5 style="font-size:21px;text-align:center">PENDING ARTIST PERMIT REPORT</h5>';
                        },
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
                            doc.styles.tableHeader = {'color': "Grey"};
                            doc['footer'] = (function (page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header'] = (function (page, pages) {
                                return {
                                    columns: [
                                        'Header Artist Report',
                                        {
                                            alignment: 'right',
                                            text: ['']
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });

                        }
                    },
                    {
                        extend: 'excel',
                        title: function () {
                            return 'PENDING ARTIST PERMIT REPORT';
                        },
                    }
                ],

                ajax: {
                    url: '{{ route('admin.artist_permit.datatable') }}',
                    data: function (d) {
                        // var status = $('select#pending-permit-status').val();
                        d.request_type = $('select#pending-request-type').val();
                        d.status = ['modified', 'checked-inspector', 'checked-manager'];//ADDED BY DONSKIE
                        d.date = $('#pending-applied-date').val() ? selected_date : null;
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
            $('#pending-btn-reset').click(function () {
                $(this).closest('form.form-row')[0].reset();
                pendingPermit.draw();
            });

            pendingPermit.page.len($('#pending-length-change').val());
            $('#pending-length-change').change(function () {
                pendingPermit.page.len($(this).val()).draw();
            });

            var search = $.fn.dataTable.util.throttle(function (v) {
                pendingPermit.search(v).draw();
            }, 500);
            $('input#search-pending-request').keyup(function () {
                search($(this).val());
            });
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
            }).on('apply.daterangepicker', function (e, d) {
                selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD')};
                artistPermit.draw();
            });

            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            artistPermit = $('table#artist-permit').DataTable({
                dom: 'Bfrtip',
                "searching": false,
                buttons: ['pageLength',
                    {
                        extend: 'print',

                        title: function () {
                            return '<img style="width:99%" src="{{asset('img/raktdalogo.png')}}">' +
                                '<h5 style="font-size:21px;text-align:center">ARTIST PERMIT REPORT</h5>';
                        },
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
                            doc.styles.tableHeader = {'color': "Grey"};
                            doc['footer'] = (function (page, pages) {
                                return {
                                    columns: [
                                        datetime,
                                        {
                                            alignment: 'right',
                                            text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                        }
                                    ],
                                    margin: [10, 20]
                                }
                            });

                            doc['header'] = (function (page, pages) {
                                return {
                                    columns: [
                                        'Header Artist Report',
                                        {
                                            alignment: 'right',
                                            text: ['']
                                        }
                                    ],
                                    margin: [10, 10]
                                }
                            });

                        }
                    },
                    {
                        extend: 'excel',
                        title: function () {
                            return 'ARTIST PERMIT REPORT';
                        },
                    }
                ],

                ajax: {
                    url: '{{ route('admin.artist_permit.datatable') }}',
                    data: function (d) {
                        // var status = $('select#new-permit-status').val();
                        d.request_type = $('select#new-request-type').val();
                        d.status = ['new'];
                        d.date = $('#new-applied-date').val() ? selected_date : null;
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
                initComplete: function (setting, json) {
                    $('#new-count').html(json.new_count);
                    $('#pending-count').html(json.pending_count);
                    $('#cancelled-count').html(json.cancelled_count);
                }
            });

            //clear fillte button
            $('#new-btn-reset').click(function () {
                $(this).closest('form.form-row')[0].reset();
                artistPermit.draw();
            });

            artistPermit.page.len($('#new-length-change').val());
            $('#new-length-change').change(function () {
                artistPermit.page.len($(this).val()).draw();
            });

            var search = $.fn.dataTable.util.throttle(function (v) {
                artistPermit.search(v).draw();
            }, 500);
            $('input#search-new-request').keyup(function () {
                search($(this).val());
            });
            var data = ['']
        }

        // ARTIST TRANSACTIONS

        function transactions()
        {

            $('#allTransactions').removeClass('active');
            var link = $('#lastSevenButton');
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            var currentdate = new Date();
            var lastSeven=$('#lastSeven').val();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            var time = + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            table = $('#artist-transaction-table').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        targets: [],
                        visible: false,
                        searchable: false,
                    },
                    {
                        "targets": [3,4,5],
                        "className": "text-right",
                    }
                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return "Transactions in last 7 days " +datetime+Date.now() ;
                        },
                        exportOptions: {
                            columns: [0,1,2,3,4,5],
                        },
                        customize: function ( win ) {
                            $(win.document.body).prepend(
                                '<h3 style="font-family:arial;text-align:center"><span style="position: absolute;margin-left: -10%">Transactions In Last 7 Days </span><span style="float: right" id="totalAmountLastSeven"></span></h3>'
                            );
                            var totalAmount= $('#totalAmount').html();
                            var amount=$('#amountFooter').html();
                            var vat=$('#vatFooter').html();

                            $(win.document.body).find('table').append(
                                '<tfoot align="right"><tr><th></th><th></th><th>Total</th><th>'+amount+'</th><th>'+vat+'</th><th>'+totalAmount+'</th></tr></tfoot>'
                            );
                            $(win.document.body).find('#totalAmountLastSeven').append(totalAmount)
                            $(win.document.body).find('h1').css('display','none')
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        }
                    },
                    {
                        extend: 'excel',
                        footer:true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4,5]
                        },
                        title: function () {
                            var totalAmount= $('#totalAmount').html();
                            return "Transactions in last 7 days " +datetime +' Total Amount '+totalAmount;
                        },
                    }
                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                searching: true,
                ajax: {
                    url: '{{ route('admin.artist_permit_report.transactionDate')}}',
                    method: 'get',
                    data: {lastSeven: lastSeven}
                },
                columns: [
                    {data: 'transaction_id', name: 'transaction_id'},
                    {data: 'transaction_type', name: 'transaction_type'},
                    {data: 'transaction_date', name: 'transaction_date'},
                    {data: 'amount', name: 'amount'},
                    {data: 'vat', name: 'vat'},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action'},
                ],
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api();
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    // Total over all pages
                    if (api.column(4).data().length>0){
                        var amount = api
                            .column( 3 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var vat = api
                            .column( 4,{ page: 'current'}  )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var total = api
                            .column( 5 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );


                        $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                        $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                        $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                        $('#totalFooter').html(accounting.formatMoney(total,'AED '));
                    }
                    else{

                        $('#amountFooter').html(
                            'AED 0.00'
                        );
                        $('#totalAmount').html(
                            'AED 0.00'
                        );

                        $('#vatFooter').html(
                            'AED 0.00'
                        );
                        $('#totalFooter').html(
                            'AED 0.00'
                        );
                    }
                },
            });
        }

        $('#transaction-report-tab').click(function () {
            $('.navbar-nav .nav-item ').removeClass('active');
            var link = $('#lastSevenButton');
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            transactions();
        });

        $("#filter_event_button").click(function () {
            $("#filter_to_hide").toggle();
        });

        $(function () {
            $('#datetimepicker6').datetimepicker();
            $('#datetimepicker7').datetimepicker({
                useCurrent: false
            });
            $("#datetimepicker6").on("dp.change", function (e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker7").on("dp.change", function (e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });
        });

        $('#transaction_calender_toggle_button').click(function () {
            $('#transaction_toggle_calender').toggle(300)
        })

        $('#allTransactions').click(function () {
            $('#endDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('#startDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('#startDate').val('');
            $('#endDate').val('');
            $('.navbar-nav .nav-item').removeClass('active');
            var link = $('#allTransactions');
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            var currentdate = new Date();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            var time = + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            table = $('#artist-transaction-table').DataTable({

                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        targets: [],
                        visible: false,
                        "searchable": false,
                    },
                    {
                        targets: [3,4,5],
                        className: "text-right",
                    }
                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return 'Transactions' +datetime+new Date();
                        },
                        exportOptions: {
                            columns: [0,1,2,3,4,5],
                        },
                        customize: function ( win ) {
                            $(win.document.body).prepend(
                                '<h3 style="font-family:arial;text-align:center"><span style="position: absolute">Transactions</span> <span class="text-dark pull-right font-weight-bolder" style="font-size: 16px;margin-top:3px;" id="totalAmountPrint">Total Amount :</span></h3>'
                            );
                            var totalAmount= $('#totalAmount').html();
                            var vat = $('#vatFooter').html();
                            var amount = $('#amountFooter').html();
                            $(win.document.body).find('#totalAmountPrint').append(totalAmount)

                            $(win.document.body).find('table').append(
                                '<tfoot align="right"><tr><th></th><th></th><th>Total</th><th>'+amount+'</th><th>'+vat+'</th><th>'+totalAmount+'</th></tr></tfoot>'
                            );

                            $(win.document.body).find('h1').css('display','none')
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );

                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        }
                    },
                    {
                        extend: 'excel',
                        footer:true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4,5]
                        },
                        title: function () {
                            var totalAmount = $('#totalAmount').html();
                            return "Transactions " + datetime +new Date()+ ' Total Amount ' + totalAmount;
                        },
                    },
                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                searching: true,

                ajax: "{{ route('admin.artist_permit_report.artistTransaction') }}",
                columns: [
                    {data: 'transaction_id', name: 'transaction_id'},
                    {data: 'transaction_type', name: 'transaction_type'},
                    {data: 'transaction_date', name: 'transaction_date'},
                    {data: 'amount', name: 'amount'},
                    {data: 'vat', name: 'vat'},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action'},
                ],
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api();
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    // Total over all pages
                    if (api.column(4).data().length>0){
                        var amount = api
                            .column( 3 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var vat = api
                            .column( 4,{ page: 'current'}  )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var total = api
                            .column( 5 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );

                        $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                        $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                        $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                        $('#totalFooter').html(accounting.formatMoney(total,'AED '));
                    }
                },
            });
        })

        $('#todayButtonClick').click(function () {
            $('#endDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('#startDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('.navbar-nav .nav-item').removeClass('active');
            var link = $('#todayButtonClick');
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            var currentdate = new Date();
            var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
            var today=$('#today').val();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            var time = + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            table = $('#artist-transaction-table').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        targets: [],
                        visible: false,
                        searchable: false,
                    },
                    {
                        "targets": [3,4,5],
                        "className": "text-right",
                    }
                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return "Transactions on "+currentdate.getDate()+"-"+  monthNames[currentdate.getMonth()]+"-"+currentdate.getFullYear()+'_'+datetime+Date.now();
                        },
                        exportOptions: {
                            columns: [0,1,2,3,4,5],
                        },
                        customize: function ( win ) {
                            $(win.document.body).prepend(
                                '<h3 style="text-align: center">'+ '<span style="margin-right: -12%">Transactions on '+currentdate.getDate()+ '-'+  monthNames[currentdate.getMonth()]+ '-'+ +currentdate.getFullYear()+ '</span><span id="todayTotalAmount" class="pull-right text-dark" style="margin-top:3px;font-size:bold;font-size: 16px">Total Amount : </span></h3>'
                            );
                            var totalAmount= $('#totalAmount').html();
                            var amount=$('#amountFooter').html();
                            var vat=$('#vatFooter').html();


                            $(win.document.body).find('table').append(
                                '<tfoot align="right"><tr><th></th><th></th><th>Total</th><th>'+amount+'</th><th>'+vat+'</th><th>'+totalAmount+'</th></tr></tfoot>'
                            );
                            $(win.document.body).find('#todayTotalAmount').append(totalAmount)
                            $(win.document.body).find('h1').css('display','none')
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        }
                    },
                    {
                        extend: 'excel',
                        footer:true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4,5]
                        },
                        title: function () {
                            var totalAmount= $('#totalAmount').html();
                            return "Transactions on "+currentdate.getDate()+"-"+monthNames[currentdate.getMonth()]+"-"+currentdate.getFullYear()+'_'+datetime+ ' Total Amount '+totalAmount;
                        },
                    }
                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                searching: true,
                ajax: {
                    url: '{{ route('admin.artist_permit_report.transactionDate')}}',
                    method: 'get',
                    data: {today: today}
                },
                columns: [
                    {data: 'transaction_id', name: 'transaction_id'},
                    {data: 'transaction_type', name: 'transaction_type'},
                    {data: 'transaction_date', name: 'transaction_date'},
                    {data: 'amount', name: 'amount'},
                    {data: 'vat', name: 'vat'},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action'},
                ],
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api();
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    // Total over all pages
                    if (api.column(4).data().length>0){
                        var amount = api
                            .column( 3 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var vat = api
                            .column( 4,{ page: 'current'}  )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var total = api
                            .column( 5 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );

                        $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                        $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                        $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                        $('#totalFooter').html(accounting.formatMoney(total,'AED '));
                    }
                    else{

                        $('#amountFooter').html(
                            'AED 0.00'
                        );
                        $('#totalAmount').html(
                            'AED 0.00'
                        );

                        $('#vatFooter').html(
                            'AED 0.00'
                        );
                        $('#totalFooter').html(
                            'AED 0.00'
                        );
                    }
                },
            });
        });




        $('#lastSevenButton').click(function () {
            $('#endDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('#startDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('#startDate').val('');
            $('#endDate').val('');
            $('.navbar-nav .nav-item').removeClass('active');
            var link = $('#lastSevenButton');
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            transactions()
        });

        $('#lastThirtyButton').click(function () {
            $('#endDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('#startDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('#startDate').val('');
            $('#endDate').val('');
            $('.navbar-nav .nav-item').removeClass('active');
            var link = $('#lastThirtyButton');
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            var currentdate = new Date();
            var lastThirty=$('#lastThirty').val();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            var time = + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            table = $('#artist-transaction-table').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        targets: [],
                        visible: false,
                        searchable: false,
                    },
                    {
                        targets: [3,4,5],
                        className: "text-right",
                    }
                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return "Transactions in last 30 days " +datetime+Date.now() ;
                        },
                        exportOptions: {
                            columns: [0,1,2,3,4,5],
                        },
                        customize: function ( win ) {
                            $(win.document.body).prepend(
                                '<h3 style="font-family:arial;text-align:center"><span style="position: absolute;margin-left: -10%">Transactions In Last 30 Days </span><span style="float: right" id="totalAmountLastThirty"></span></h3>'
                            );
                            var totalAmount= $('#totalAmount').html();
                            var amount=$('#amountFooter').html();
                            var vat=$('#vatFooter').html();

                            $(win.document.body).find('table').append(
                                '<tfoot align="right"><tr><th></th><th></th><th>Total</th><th>'+amount+'</th><th>'+vat+'</th><th>'+totalAmount+'</th></tr></tfoot>'
                            );
                            $(win.document.body).find('#totalAmountLastThirty').append(totalAmount)
                            $(win.document.body).find('h1').css('display','none')
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit'});
                        },

                    },
                    {
                        extend: 'excel',
                        footer:true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4,5]
                        },
                        title: function () {
                            var totalAmount= $('#totalAmount').html();
                            return "Transactions in last 30 days " +datetime + ' Total Amount : '+totalAmount ;
                        },

                    }
                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                searching: true,
                ajax: {
                    url: '{{ route('admin.artist_permit_report.transactionDate')}}',
                    method: 'get',
                    data: {lastThirty: lastThirty}
                },
                columns: [

                    {data: 'transaction_id', name: 'transaction_id'},
                    {data: 'transaction_type', name: 'transaction_type'},
                    {data: 'transaction_date', name: 'transaction_date'},
                    {data: 'amount', name: 'amount'},
                    {data: 'vat', name: 'vat'},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action'},

                ],

                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api();
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    // Total over all pages
                    if (api.column(4).data().length>0){
                        var amount = api
                            .column( 3 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var vat = api
                            .column( 4,{ page: 'current'}  )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var total = api
                            .column( 5 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );


                        $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                        $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                        $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                        $('#totalFooter').html(accounting.formatMoney(total,'AED '));
                    }
                    else{

                        $('#amountFooter').html(
                            'AED 0.00'
                        );
                        $('#totalAmount').html(
                            'AED 0.00'
                        );

                        $('#vatFooter').html(
                            'AED 0.00'
                        );
                        $('#totalFooter').html(
                            'AED 0.00'
                        );
                    }
                },
            });
        });

        $('#thismonthButton').click(function () {
            $('#endDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('#startDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('#startDate').val('');
            $('#endDate').val('');
            $('.navbar-nav .nav-item').removeClass('active');
            var link = $('#thismonthButton');
            if (!link.hasClass('active')) {
                link.addClass('active');
            }
            var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
            var currentdate = new Date();
            var thisMonth=$('#thisMonth').val();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            var time = + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            table = $('#artist-transaction-table').DataTable({
                dom: 'Bfrtip',
                columnDefs: [
                    {
                        targets: [],
                        visible: false,
                        searchable: false,
                    },
                    {
                        targets: [3,4,5],
                        className: "text-right",
                    }
                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return 'Transactions in ' +monthNames[currentdate.getMonth()] + ' of ' +currentdate.getFullYear()+'_'+datetime;
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],
                        },
                        customize: function (win) {
                            $(win.document.body).prepend(
                                "<h3 style='font-family:arial;text-align:center'>"+'<span style="margin-right: -20%">Transactions in ' +(monthNames[currentdate.getMonth()]) +' of ' +currentdate.getFullYear() +"</span><span id='thisMonthTotalAmount' class='text-dark pull-right font-weight-bold' style='font-size: 16px;margin-top:4px'>Total Amount: </span></h3>"
                            );
                            var totalAmount= $('#totalAmount').html();
                            var amount=$('#amountFooter').html();
                            var vat=$('#vatFooter').html();
                            var total=$('#totalFooter').html();
                            $(win.document.body).find('table').append(
                                '<tfoot align="right"><tr><th></th><th></th><th>Total</th><th>'+amount+'</th><th>'+vat+'</th><th>'+totalAmount+'</th></tr></tfoot>'
                            );
                            $(win.document.body).find('#thisMonthTotalAmount').append(totalAmount)
                            $(win.document.body)
                                .css('font-size', '10pt')
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(win.document.body).find('h1').css({'display':'none'})
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css({'font-size': 'inherit'});
                        }
                    },
                    {
                        extend: 'excel',
                        footer:true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4,5]
                        },
                        title: function () {
                            var totalAmount= $('#totalAmount').html();
                            return 'Transactions in ' + (monthNames[currentdate.getMonth()])+' of ' +currentdate.getFullYear()+'_'+datetime + ' Total Amount '+totalAmount;                        },
                    }
                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                searching: true,
                ajax: {
                    url: '{{ route('admin.artist_permit_report.transactionDate')}}',
                    method: 'get',
                    data: {thisMonth: thisMonth}
                },
                columns: [
                    {data: 'transaction_id', name: 'transaction_id'},
                    {data: 'transaction_type', name: 'transaction_type'},
                    {data: 'transaction_date', name: 'transaction_date'},
                    {data: 'amount', name: 'amount'},
                    {data: 'vat', name: 'vat'},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action'},
                ],
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api();
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    // Total over all pages
                    if (api.column(4).data().length>0){
                        var amount = api
                            .column( 3 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var vat = api
                            .column( 4,{ page: 'current'}  )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var total = api
                            .column( 5 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );

                        $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                        $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                        $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                        $('#totalFooter').html(accounting.formatMoney(total,'AED '));

                    }
                    else{

                        $('#amountFooter').html(
                            'AED 0.00'
                        );
                        $('#totalAmount').html(
                            'AED 0.00'
                        );

                        $('#vatFooter').html(
                            'AED 0.00'
                        );
                        $('#totalFooter').html(
                            'AED 0.00'
                        );
                    }
                },
            });
        });


        $('#amountCollectedMonth').change(function(){
            $('#startDate').val('');
            $('#endDate').val('');
            $('#endDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('#startDate').css({border:'1px solid #d6d6d6',color:'#d6d6d6'});
            $('.navbar-nav .nav-item').removeClass('active');
            var link = $('#selectmonth');
            if (!link.hasClass('active')) {
                link.addClass('active');
            }

            var currentdate = new Date();
            var amountCollectedMonth=$('#amountCollectedMonth').val();
            var datetime = +currentdate.getDate() + "-"
                + (currentdate.getMonth() + 1) + "-"
                + currentdate.getFullYear() + "  "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();
            var time = + currentdate.getHours() + ":"
                + currentdate.getMinutes() + ":"
                + currentdate.getSeconds();

            table = $('#artist-transaction-table').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [],
                        "visible": false,
                        "searchable": false,
                    },
                    {
                        "targets": [3,4,5],
                        "className": "text-right",
                    }
                ],
                buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return 'Transactions in ' + amountCollectedMonth;
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],
                        },
                        customize: function (win) {
                            $(win.document.body).prepend(
                                '<h4 style="font-family:arial;text-align:center">'+"Transactions in "+amountCollectedMonth+'</h4>'
                            );
                            var totalAmount= $('#totalAmount').html();
                            var amount=$('#amountFooter').html();
                            var vat=$('#vatFooter').html();
                            var total=$('#totalFooter').html();
                            $(win.document.body).find('table').append(
                                '<tfoot align="right"><tr><th></th><th></th><th>Total</th><th>'+amount+'</th><th>'+vat+'</th><th>'+totalAmount+'</th></tr></tfoot>'
                            );
                            $(win.document.body)
                                .css('font-size', '10pt')
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            $(win.document.body).find('h1')
                                .css( 'display', 'none' )
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css({'font-size': 'inherit'});
                        }
                    },
                    {
                        extend: 'excel',
                        footer:true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4,5]
                        },
                        title: function () {
                            var totalAmount= $('#totalAmount').html();
                            return 'Transactions in '+amountCollectedMonth;
                        },
                    }
                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                searching: true,
                ajax: {
                    url: '{{ route('admin.artist_permit_report.transactionDate')}}',
                    method: 'get',
                    data: {month: amountCollectedMonth},
                },
                columns: [
                    {data: 'transaction_id', name: 'transaction_id'},
                    {data: 'transaction_type', name: 'transaction_type'},
                    {data: 'transaction_date', name: 'transaction_date'},
                    {data: 'amount', name: 'amount'},
                    {data: 'vat', name: 'vat'},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action'},
                ],
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api();
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
                    // Total over all pages
                    if (api.column(4).data().length>0){
                        var amount = api
                            .column( 3 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var vat = api
                            .column( 4,{ page: 'current'}  )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
                        var total = api
                            .column( 5 ,{ page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );

                        $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                        $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                        $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                        $('#totalFooter').html(accounting.formatMoney(total,'AED '));
                    }
                    else{

                        $('#amountFooter').html(
                            'AED 0.00'
                        );
                        $('#totalAmount').html(
                            'AED 0.00'
                        );

                        $('#vatFooter').html(
                            'AED 0.00'
                        );
                        $('#totalFooter').html(
                            'AED 0.00'
                        );
                    }
                },
            });
        });

        $('#endDate').change(function(){
            $('#amountCollectedMonth').val('');
            var currentdate = new Date();
            $('.datepicker').hide();
            var todayDate =
                + currentdate.getFullYear() + "-"
                +'0'+ (currentdate.getMonth() +1)+ "-"
                +currentdate.getDate() + " "
                + currentdate.getHours() + ":"
                + currentdate.getMinutes();
            var start_date=$('#startDate').val();
            var end_date=$('#endDate').val();

            var d = new Date();
            var strDate = d.getFullYear() + "-" + ('0' +(d.getMonth()+1)).slice(-2)+ "-" +   ('0'+ d.getDate()).slice(-2) ;
            var today=strDate.split('-')
            var  todayString=today[0]+today[1]+today[2]
            var start=start_date.split('-')
            var end=end_date.split('-')
            var  start_string=start[2]+start[1]+start[0]
            var   end_string=end[2]+end[1]+end[0]

            if(start_date!='' && end_date!='') {
                if (end_string <= todayString) {
                    $('#endDate').css({border:'1px solid green',color:'green'});
                    if (start_string <= end_string) {
                        $('#endDate').css({border:'1px solid green',color:'green'});
                        $('#startDate').css({border:'1px solid green',color:'green'});
                        var submit = 'submit'
                        var datetime = +currentdate.getDate() + "-"
                            + (currentdate.getMonth() + 1) + "-"
                            + currentdate.getFullYear() + "  "
                            + currentdate.getHours() + ":"
                            + currentdate.getMinutes() + ":"
                            + currentdate.getSeconds();

                        var time = +currentdate.getHours() + ":"
                            + currentdate.getMinutes() + ":"
                            + currentdate.getSeconds();

                        table = $('#artist-transaction-table').DataTable({
                            dom: 'Bfrtip',
                            "columnDefs": [
                                {
                                    "targets": [],
                                    "visible": false,
                                    "searchable": false,
                                },
                                {
                                    "targets": [2, 3, 4],
                                    "className": "text-right",
                                }
                            ],
                            buttons: ['pageLength',
                                {
                                    extend: 'print',
                                    title: function () {
                                        return 'Transactions between ' + start_date + ' and ' + end_date;
                                    },
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4],
                                    },
                                    customize: function (win) {
                                        $(win.document.body).prepend(
                                            '<h4 style="font-family:arial;text-align:center">' + "Transactions between " + start_date + " and " + end_date + '</h4>'
                                        );
                                        var totalAmount = $('#totalAmount').html();
                                        var amount = $('#amountFooter').html();
                                        var vat = $('#vatFooter').html();
                                        var total = $('#totalFooter').html();
                                        $(win.document.body).find('table').append(
                                            '<tfoot align="right"><tr><th></th><th>Total</th><th>' + amount + '</th><th>' + vat + '</th><th>' + totalAmount + '</th></tr></tfoot>'
                                        );
                                        $(win.document.body)
                                            .css('font-size', '10pt')
                                            .prepend(
                                                '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                            );
                                        $(win.document.body).find('h1')
                                            .css('display', 'none')
                                        $(win.document.body).find('table')
                                            .addClass('compact')
                                            .css({'font-size': 'inherit'});
                                    }
                                },
                                {
                                    extend: 'excel',
                                    footer:true,
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4,5]
                                    },
                                    title: function () {
                                        var totalAmount = $('#totalAmount').html();
                                        return 'Transactions between ' + start_date + ' and ' + end_date + ' Total Amount ' + totalAmount;
                                    },
                                }
                            ],
                            lengthMenu: [
                                [10, 25, 50],
                                ['10 rows', '25 rows', '50 rows']
                            ],
                            processing: true,
                            language: {
                                processing: '<span>Processing</span>',
                            },
                            serverSide: true,
                            footer: true,
                            searching: true,
                            ajax: {
                                url: '{{ route('admin.artist_permit_report.transactionDate')}}',
                                method: 'get',
                                data: {start_date: start_date, end_date: end_date},
                            },
                            columns: [
                                {data: 'transaction_id', name: 'transaction_id'},
                                {data: 'transaction_type', name: 'transaction_type'},
                                {data: 'transaction_date', name: 'transaction_date'},
                                {data: 'amount', name: 'amount'},
                                {data: 'vat', name: 'vat'},
                                {data: 'total', name: 'total'},
                                {data: 'action', name: 'action'},
                            ],
                            footerCallback: function (row, data, start, end, display) {
                                var api = this.api();
                                // Remove the formatting to get integer data for summation
                                var intVal = function (i) {
                                    return typeof i === 'string' ?
                                        i.replace(/[\$,]/g, '') * 1 :
                                        typeof i === 'number' ?
                                            i : 0;
                                };
                                // Total over all pages
                                if (api.column(4).data().length > 0) {
                                    var amount = api
                                        .column(3, {page: 'current'})
                                        .data()
                                        .reduce(function (a, b) {
                                            return intVal(a) + intVal(b);
                                        });
                                    var vat = api
                                        .column(4, {page: 'current'})
                                        .data()
                                        .reduce(function (a, b) {
                                            return intVal(a) + intVal(b);
                                        });
                                    var total = api
                                        .column(5, {page: 'current'})
                                        .data()
                                        .reduce(function (a, b) {
                                            return intVal(a) + intVal(b);
                                        });


                                    $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                                    $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                                    $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                                    $('#totalFooter').html(accounting.formatMoney(total,'AED '));

                                } else {

                                    $('#amountFooter').html(
                                        'AED 0.00'
                                    );
                                    $('#totalAmount').html(
                                        'AED 0.00'
                                    );

                                    $('#vatFooter').html(
                                        'AED 0.00'
                                    );
                                    $('#totalFooter').html(
                                        'AED 0.00'
                                    );
                                }
                            },
                        });
                    }
                    else{
                        $('#endDate').css({border:'1px solid #ff00006e',color:'#ff0000c4'});
                        $('#startDate').css({border:'1px solid #ff00006e',color:'#ff0000c4'});

                        alert("Start Date must be less than End Date date")
                    }

                } else {

                    $('#endDate').css({border:'1px solid #ff00006e',color:'#ff0000c4'});
                    $('#startDate').css({border:'1px solid #ff00006e',color:'#ff0000c4'});

                    alert("Dates must be less than today's date")
                }
            }
            else{
                alert('Please Select Both Field')
            }
        });

        $('#amountCollectedMonth').datepicker({
            autoclose: true,
            minViewMode: 1,
            format: 'mm-yyyy'
        }).on('changeDate', function(selected){
            startDate = new Date(selected.date.valueOf());
            var monthSelected =startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        });

        $('#yearSelected').datepicker({
            autoclose: true,
            minViewMode: 2,
            format: 'yyyy'
        }).on('changeDate', function(selected){
            startDate = new Date(selected.date.valueOf());
            var monthSelected =startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        });
        $('#monthSelected').datepicker({
            autoclose: true,
            minViewMode: 1,
            format: 'mm-yyyy'
        }).on('changeDate', function(selected){
            $('#yearSelected').val('');
            startDate = new Date(selected.date.valueOf());
            var monthSelected =startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        });

        function chartCurrentMonth(){
            var changeYear=new Date().getFullYear();
            $.ajax({
                method:'post',
                url: '{{ route("admin.artist_permit_report.chartData")}}',
                data: {SelectedYear: changeYear},
                success: function(response){
                    //get the bar chart canvas
                    var cData = JSON.parse(response);
                    var ctx = $("#bar-chart");
                    //bar chart data
                    var data = {
                        labels: cData.label,
                        datasets: [
                            {
                                label: cData.label,
                                data: cData.data,
                                backgroundColor: [
                                    "#1abc9c",
                                    "#e67e22",
                                    "#27ae60",
                                    "#54a0ff",
                                    "#fc5c65",
                                    "#1D7A46",
                                    "#2bcbba",
                                    "#CDA776",
                                    "#989898",
                                    "#576574",
                                    "#10ac84",
                                ],
                                /*          borderColor: [
                                              "#1abc9c",
                                              "#e67e22",
                                              "#27ae60",
                                              "#54a0ff",
                                              "#fc5c65",
                                              "#F4A460",
                                              "#CDA776",
                                              "#2bcbba",
                                              "#A9A9A9",
                                              "#DC143C",
                                              "#576574",
                                              "#10ac84",
                                          ],
                                          borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]*/
                            }
                        ]
                    };

                    //options
                    var options = {
                        responsive: true,
                        title: {
                            display: true,
                            position: "top",
                            text: "Monthly Amount Received in "+changeYear,
                            fontSize: 18,
                            fontColor: "#111"
                        },
                        legend: {
                            display: true,
                            position: "bottom",
                            labels: {
                                fontColor: "#333",
                                fontSize: 16
                            }
                        }
                    };

                    //create bar Chart class object

                    var chart1 = new Chart(ctx, {
                        type: "bar",
                        data: data,
                        options: options
                    });
                }
            })
        }


        $('#yearSelected').change(function(){
            var changeYear=$('#yearSelected').val();
            $.ajax({
                method:'post',
                url: '{{ route("admin.artist_permit_report.chartData")}}',
                data: {SelectedYear: changeYear},
                success: function(response){

                    //get the bar chart canvas

                    var cData = JSON.parse(response);
                    var ctx = $("#bar-chart");
                    //bar chart data
                    var data = {
                        labels: cData.label,
                        datasets: [
                            {
                                label: cData.label,

                                data: cData.data,
                                backgroundColor: [
                                    "#1abc9c",
                                    "#e67e22",
                                    "#27ae60",
                                    "#54a0ff",
                                    "#fc5c65",
                                    "#1D7A46",
                                    "#2bcbba",
                                    "#CDA776",
                                    "#989898",
                                    "#576574",
                                    "#10ac84",
                                ],
                                /*      borderColor: [
                                          "#f1c40f",
                                          "#e67e22",
                                          "#27ae60",
                                          "#54a0ff",
                                          "#fc5c65",
                                          "#F4A460",
                                          "#CDA776",
                                          "#2bcbba",
                                          "#A9A9A9",
                                          "#DC143C",
                                          "#576574",
                                          "#10ac84",
                                      ],
                                      borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]*/
                            }
                        ]
                    };

                    //options
                    var options = {
                        responsive: true,
                        title: {
                            display: true,
                            position: "top",
                            text: "Monthly Amount Received in "+changeYear,
                            fontSize: 18,
                            fontColor: "#111"
                        },
                        legend: {
                            display: true,
                            position: "bottom",
                            labels: {
                                fontColor: "#333",
                                fontSize: 16
                            }
                        }
                    };

                    //create bar Chart class object

                    var chart1 = new Chart(ctx, {
                        type: "bar",
                        data: data,
                        options: options,
                    });

                }
            })
        })
        $('#monthSelected').change(function(){
            var changeMonth=$('#monthSelected').val();
            $.ajax({
                method:'post',
                url: '{{ route("admin.artist_permit_report.chartData")}}',
                data: {month: changeMonth},
                success: function(response){
                    //get the bar chart canvas

                    var cData = JSON.parse(response);
                    console.log(response)
                    $('#totalAmountInMonth').html(cData.total)

                    var ctx = $("#bar-chart");
                    //bar chart data
                    var data = {
                        labels: cData.label,
                        datasets: [
                            {
                                label: cData.label,

                                data: cData.data,
                                backgroundColor: [
                                    "#1abc9c",
                                    "#e67e22",
                                    "#27ae60",
                                    "#54a0ff",
                                    "#fc5c65",
                                    "#1D7A46",
                                    "#2bcbba",
                                    "#CDA776",
                                    "#989898",
                                    "#576574",
                                    "#10ac84",
                                    "#1abc9c",
                                    "#e67e22",
                                    "#27ae60",
                                    "#54a0ff",
                                    "#fc5c65",
                                    "#1D7A46",
                                    "#2bcbba",
                                    "#CDA776",
                                    "#989898",
                                    "#576574",
                                    "#10ac84",
                                    "#1abc9c",
                                    "#e67e22",
                                    "#27ae60",
                                    "#54a0ff",
                                    "#fc5c65",
                                    "#1D7A46",
                                    "#2bcbba",
                                    "#CDA776",
                                    "#989898",
                                    "#576574",
                                    "#10ac84",
                                ],
                                /*      borderColor: [
                                          "#f1c40f",
                                          "#e67e22",
                                          "#27ae60",
                                          "#54a0ff",
                                          "#fc5c65",
                                          "#F4A460",
                                          "#CDA776",
                                          "#2bcbba",
                                          "#A9A9A9",
                                          "#DC143C",
                                          "#576574",
                                          "#10ac84",
                                      ],
                                      borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]*/
                            }
                        ]
                    };

                    //options
                    var options = {
                        responsive: true,
                        title: {
                            display: true,
                            position: "top",
                            text: "Monthly Amount Received in "+changeMonth,
                            fontSize: 18,
                            fontColor: "#111"
                        },
                        legend: {
                            display: true,
                            position: "bottom",
                            labels: {
                                fontColor: "#333",
                                fontSize: 16
                            }
                        }
                    };

                    //create bar Chart class object

                    var chart1 = new Chart(ctx, {
                        type: "bar",
                        data: data,
                        options: options,
                    });
                }
            })
        })

        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#startDate').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            format:'dd-mm-yyyy',
            minDate: today,
            todayHighlight: true,
            maxDate: function () {
                return $('#endDate').val();
            }
        });

        $('#endDate').datepicker({
            uiLibrary: 'bootstrap4',
            format:'dd-mm-yyyy',
            todayHighlight: true,
            iconsLibrary: 'fontawesome',
            minDate: function () {
                return $('#startDate').val();
            }
        });
        $('#amountCollectedMonth').mouseover(function () {
            $('#tooltipMonth').show(100)
        });
        $('#amountCollectedMonth').mouseout(function () {
            $('#tooltipMonth').hide(100)
        });


    </script>
    <script src="{{asset('js/moneyFormator.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
@endsection
{{--@include('admin.artist_permit.includes.artist-block-modal')--}}

