<style>
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
</style>
<table class="table  table-hover  table-borderless table-striped border" id="block-artist">
    <thead>
        <tr>
            <th colspan="2"><select class="form-control" onchange="myFunction()" name="filter_search"
                    id="filter_search">
                    <option>Search By</option>
                    <option value="1">Person Code</option>
                    <option value="2">Artist Status</option>
                    <option value="3">Artist Name</option>
                    <option value="4">Profession</option>
                    <option value="5">Nationality</option>
                </select></th>
            <th colspan="2">
                <div class="row" id="search_by_name" style="display:-webkit-box">
                    <input type="text" id="search_artist" class="form-control" name="search_artist"
                        placeholder="Search..."><button style="" id="search_button_css"
                        class="fa fa-search search_button"></button>
                </div>

                <div class="row" id="search_by_nationality_tab" style="display:none">
                    <select type="text" id="search_by_nationality" class="form-control" style="width: 90%"
                        name="search_artist">
                        <option value="">Select Nationality</option>
                        @foreach($country as $key => $nationality)
                        <option value="{{$key}}">{{$nationality}}</option>
                        @endforeach
                    </select>
                    <button style="" id="search_button_css1" class="fa fa-search submit_button_nationality"></button>
                </div>

                <div class="row" id="search_by_profession_tab" style="display:none">
                    <select type="text" id="search_by_profession" style="width: 90%" class="form-control"
                        name="search_artist">
                        <option value="">Select Profession</option>
                        @foreach($profession as $key => $nationality)
                        <option value="{{$key}}">{{$nationality}}</option>
                        @endforeach
                    </select>
                    <button style="" id="search_button_css1" class="fa fa-search submit_button_profession"></button>
                </div>
            </th>
            <th><button style="margin-left: 20px" class="form-control" id="resetButton">Reset</button></th>
        </tr>
        <tr style="font-size: 12px">
            <th></th>
            <th style="width: 14%">{{ __('PERSON CODE') }}</th>
            <th style="width: 14%">{{ __('ARTIST STATUS') }}</th>
            <th>{{ __('ARTIST NAME') }}</th>
            <th>{{ __('PROFESSION') }}</th>
            <th>{{ __('NATIONALITY') }}</th>
            <th style="width: 14%">{{ __('MOBILE NUMBER') }}</th>
            <th>{{ __('ACTIVE PERMIT') }}</th>
        </tr>
    </thead>
</table>


@section('script')
<script>
    $(function myTable() {
         table= $('#block-artist').DataTable({
          dom: 'Bfrtip',
           "searching":false,
            buttons: ['pageLength',
                {
                    extend: 'pdf',
                    title: function () { return 'ARTIST REPORT'; },
                    customize: function (doc) {
                        doc.defaultStyle.fontSize = 7;
                        doc.styles.tableHeader.fontSize = 7;
                        doc.styles.title.fontSize = 14;
                        doc.styles.tableHeader={'color': "Grey"};
                    }
                },
                {
                    extend: 'excel',
                    title: function () { return 'ARTIST REPORT'; },
                }
            ],
             lengthMenu: [
                 [ 10, 25, 50, 1 ],
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
                {data: 'artist_id',name:'artist_id'},
                {data: 'person_code',name:'person_code'},
                {data: 'artist_status',name:'artist_status'},
                {data: 'artist_name',name:'artist_name'},
                {data: 'profession',name:'profession'},
                {data: 'nationality',name:'nationality'},
                {data: 'mobile_number',name:'mobile_number'},
                {data: 'permit_status',name:'permit_status'},
            ],
        });
    });

        function fill_datatable(filter_search = '', search_artist = '')
        {
            var dataTable = $('#block-artist').DataTable({
                dom: 'Bfrtip',
                buttons: ['pageLength',
                    {
                        extend: 'pdf',
                        title: function () { return 'ARTIST REPORT'; },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 14;
                            doc.styles.tableHeader={'color': "Grey"};
                        },
                    },
                    {
                        extend: 'excel',
                        title: function () {
                            return 'ARTIST REPORT';
                        },
                    }

                ],
                lengthMenu: [
                    [ 10, 25, 50, 1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
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
                    {data: 'artist_id',name:'artist_id'},
                    {data: 'person_code',name:'person_code'},
                    {data: 'artist_status',name:'artist_status'},
                    {data: 'artist_name',name:'artist_name'},
                    {data: 'profession',name:'profession'},
                    {data: 'nationality',name:'nationality'},
                    {data: 'mobile_number',name:'mobile_number'},
                    {data: 'permit_status',name:'permit_status'},
                ]
            });
        }

        $('.search_button').click(function(){
            var filter_search = $('#filter_search').val();
            var search_artist = $('#search_artist').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Select Both filter option');
            }
        });

    $('#resetButton').click(function () {
        myTableRefresh();
    })


        $('.submit_button_nationality').click(function(){
            var filter_search = $('#filter_search').val();
            var search_artist = $('#search_by_nationality').val();

            if(filter_search != '' &&  search_artist != '')
            {

                $('#block-artist').DataTable().destroy();
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Select Both filter option');
            }
        });

        $('.submit_button_profession').click(function(){
            var filter_search = $('#filter_search').val();
            var search_artist = $('#search_by_profession').val();

            if(filter_search != '' &&  search_artist != '')
            {
                $('#block-artist').DataTable().destroy();
                fill_datatable(filter_search, search_artist);
            }
            else
            {
                alert('Select Both filter option');
            }
        });

       function myTableRefresh()
       {
           table= $('#block-artist').DataTable({
               dom: 'Bfrtip',

               "searching":false,
               buttons: ['pageLength',
                   {
                       extend: 'pdf',
                       title: function () { return 'ARTIST REPORT'; },
                       customize: function (doc) {
                           doc.defaultStyle.fontSize = 7;
                           doc.styles.tableHeader.fontSize = 7;
                           doc.styles.title.fontSize = 14;
                           doc.styles.tableHeader={'color': "Grey"};
                       }
                   },
                   {
                   extend: 'excel',
           title: function () { return 'ARTIST REPORT'; },
       }
               ],
               lengthMenu: [
                   [ 10, 25, 50, 1 ],
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
                   {data: 'artist_id',name:'artist_id'},
                   {data: 'person_code',name:'person_code'},
                   {data: 'artist_status',name:'artist_status'},
                   {data: 'artist_name',name:'artist_name'},
                   {data: 'profession',name:'profession'},
                   {data: 'nationality',name:'nationality'},
                   {data: 'mobile_number',name:'mobile_number'},
                   {data: 'permit_status',name:'permit_status'},

               ],
           });
       }

          function myFunction() {
                var x = document.getElementById("filter_search").value;

                if(x==5 ) {
                    $('#search_by_name').css({display:'none'})
                    $('#search_by_profession_tab').css({display:'none'})
                    $('#search_by_nationality_tab').css({display:'-webkit-box'})
                }

              if(x==4 ) {
                  $('#search_by_name').css({display:'none'})
                  $('#search_by_profession_tab').css({display:'-webkit-box'})
                  $('#search_by_nationality_tab').css({display:'none'})
              }
              if(x==1 || x==2 || x==3 ){
                  $('#search_by_profession_tab').css({display:'none'})
                  $('#search_by_nationality_tab').css({display:'none'})
                  $('#search_by_name').css({display:'-webkit-box'})
              }
            }

            //Event Report JS

$('#event-report-tab').click(function () {
    table= $('#event-report').DataTable({
        dom: 'Bfrtip',
        "searching":false,
        buttons: ['pageLength',
            {
                extend: 'pdf',
                title: function () { return 'Event Report'; },
                customize: function (doc) {
                    doc.defaultStyle.fontSize = 7;
                    doc.styles.tableHeader.fontSize = 7;
                    doc.styles.title.fontSize = 14;
                    doc.styles.tableHeader={'color': "Grey"};
                }
            },
            {
                extend: 'excel',
                title: function () { return 'EVENT REPORT'; },
            }
        ],
        lengthMenu: [
            [ 10, 25, 50, 1 ],
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
            {data: 'status',name:'status'},
            {data: 'updated_at',name:'updated_at'},


        ],
    });

})


        $('#application-type').change(function () {
            console.log('application type')
            var application_type= $('#application-type').val();
            table= $('#event-report').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                buttons: ['pageLength',
                    {
                        extend: 'pdf',
                        title: function () { return 'Event Report'; },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 14;
                            doc.styles.tableHeader={'color': "Grey"};
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'EVENT REPORT'; },
                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50, 1 ],
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
                    {data: 'status',name:'status'},
                    {data: 'updated_at',name:'updated_at'},


                ],
            });

        })

        // Applied Date
        $('#applied-date').change(function () {
            console.log('appled date')
            var applied_date=$('#applied-date').val();
            table= $('#event-report').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                buttons: ['pageLength',
                    {
                        extend: 'pdf',
                        title: function () { return 'Event Report'; },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 14;
                            doc.styles.tableHeader={'color': "Grey"};
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'EVENT REPORT'; },
                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50, 1 ],
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
                    method: 'post',
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
                    {data: 'status',name:'status'},
                    {data: 'updated_at',name:'updated_at'},


                ],
            });

        })

    //status

        $('#status').change(function () {
            console.log('status')

            var status=$('#status').val();

            table= $('#event-report').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                buttons: ['pageLength',
                    {
                        extend: 'pdf',
                        title: function () { return 'Event Report'; },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 14;
                            doc.styles.tableHeader={'color': "Grey"};
                        }
                    },
                    {
                        extend: 'excel',
                        title: function () { return 'EVENT REPORT'; },
                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50, 1 ],
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
                    {data: 'status',name:'status'},
                    {data: 'updated_at',name:'updated_at'},


                ],
            });

        })

</script>
@endsection
{{--@include('admin.artist_permit.includes.artist-block-modal')--}}