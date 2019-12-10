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

    #active-artist_wrapper  .dt-buttons{
        background-color: #edeef4;
        margin-top:6px;
    }

    #block-artist_wrapper .dt-buttons{
        background-color: #edeef4;
        margin-top:6px;
    }

</style>
<table class="table  table-hover  table-borderless table-striped border" id="block-artist">
    <thead>
    <tr>
        <th colspan="2"><select class="form-control" onchange="myFunction()" name="filter_search" id="filter_search">
                <option>Search By</option>
                    <option value="1">{{__('Person Code')}}</option>
                    <option value="2">{{__('Artist Status')}}</option>
                     <option value="3">{{__('Artist Name')}}</option>
                     <option value="4">{{__('Profession')}}</option>
                     <option value="5">{{__('Nationality')}}</option>
                   </select></th>
        <th colspan="2">
            <div class="row" id="search_by_name" style="display:-webkit-box">
                <input type="text" id="search_artist" class="form-control" name="search_artist" placeholder="Search..."><button style="" id="search_button_css" class="fa fa-search search_button"></button>
            </div>

            <div class="row"  id="search_by_nationality_tab" style="display:none">
            <select type="text" id="search_by_nationality" class="form-control" style="width: 90%" name="search_artist" >
                <option value="">{{__('Select Nationality')}}</option>

                @foreach($country as $key => $nationality)
                    <option value="{{$key}}">{{$nationality}}</option>
                @endforeach
            </select>
            </div>

            <div class="row"  id="search_by_profession_tab" style="display:none">
             <select type="text" id="search_by_profession" style="width: 90%" class="form-control" name="search_artist" >
                <option value="">{{__('Select Profession')}}</option>
                @foreach($profession as $key => $nationality)
                    <option value="{{$key}}">{{$nationality}}</option>
                @endforeach
            </select>
            </div>
        </th>
        <th><button style="margin-left: 20px" class="form-control" id="resetButton" >{{__('Reset')}}</button></th>
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
                        doc.defaultStyle.fontSize = 8;
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
                            doc.defaultStyle.fontSize = 8;
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


        $('#search_by_profession').change(function(){

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

        $('#search_by_nationality').change(function(){
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
                           doc.defaultStyle.fontSize = 8;
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
                            doc.defaultStyle.fontSize = 8;
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
                    {data: 'application_type',name:'application_type'},
                    {data: 'status',name:'status'},
                ],
            });
        });

        $('#reset-event-table').click(function () {
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
                    {data: 'application_type',name:'application_type'},
                    {data: 'status',name:'status'},


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
                            doc.defaultStyle.fontSize = 8;
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
                    {data: 'application_type',name:'application_type'},
                    {data: 'status',name:'status'},



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
                            doc.defaultStyle.fontSize = 8;
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
                dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
                    {data: 'artist_id'},
                    {data: 'person_code'},
                    {data: 'name'},
                    {data: 'profession'},
                    {data: 'nationality'},
                    {data: 'mobile_number'},
                    {data: 'active_permit'},
                ],
                createdRow: function (row, data, index) {
                }
            });
        }
        function activeArtistTable() {

            active_artist_table = $('table#active-artist').DataTable({
                dom: "lBfrtip",
                "searching":false,
                buttons: ['pageLength',
                    {
                        extend: 'pdf',
                        title: function () { return 'ARTIST PERMIT REPORT'; },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 14;
                            doc.styles.tableHeader={'color': "Grey"};
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
                        location.href = '{{url('/artist_permit_report/show/')}}/'+data.artist_id+'?tab='+hash;
                    });

                }
            });


            //clear fillte button
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

            activePermit = $('table#artist-permit-approved').DataTable({
                dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                ajax: {
                    url: '{{ route('admin.artist_permit.datatable')}}',
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

            processingPermit = $('table#artist-permit-processing').DataTable({
                dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",



                ajax: {
                    url: '{{ route('admin.artist_permit.datatable') }}',
                    data: function (d) {
                        d.status = ['approved-unpaid', 'modification request', 'processing', 'need approval'];
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

            archivePermit = $('table#artist-permit-rejected').DataTable({
                dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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


            pendingPermit = $('table#pending-permit').DataTable({
                dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

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


            artistPermit = $('table#artist-permit').DataTable({
                dom: "lBfrtip",
                "searching":false,
                buttons: ['pageLength',
                    {
                        extend: 'pdf',
                        title: function () { return 'ARTIST PERMIT REPORT'; },
                        customize: function (doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 14;
                            doc.styles.tableHeader={'color': "Grey"};
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

