<style>
    .search_button {
        background: transparent;
        border: none;
        height: 38px;
        width: 36px;
        margin-left: -37px;
    }
</style>
<table class="table  table-hover  table-borderless table-striped border" id="block-artist">
    <thead>
    <tr>
        <th colspan="2"><select class="form-control" name="filter_search" id="filter_search">
                <option>Search By</option>
                    <option value="1">Person Code</option>
                    <option value="2">Artist Status</option>
                     <option value="3">Artist Name</option>
                    <option value="4">Profession</option>
                    <option value="5">Nationality</option>
                </select></th>
        <th colspan="2">
            <div class="row" style="display:-webkit-box"><input type="text" id="search_artist" class="form-control" name="search_artist" placeholder="Search..."><button style="" class="fa fa-search search_button"></button></div></th>
        </tr>
    <tr>
        <th></th>
        <th>{{ __('PERSON CODE') }}</th>
        <th>{{ __('ARTIST STATUS') }}</th>
        <th>{{ __('ARTIST NAME') }}</th>
        <th>{{ __('PROFESSION') }}</th>
        <th>{{ __('NATIONALITY') }}</th>
        <th>{{ __('MOBILE NUMBER') }}</th>
        <th>{{ __('ACTIVE PERMIT') }}</th>
    </tr>
    </thead>
</table>


@section('script')
<script>
    $(function() {
         table= $('#block-artist').DataTable({
          dom: 'Bfrtip',
           "searching":false,
            buttons: ['pageLength','excel', 'pdf', 'print'
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
                buttons: ['excel', 'pdf', 'print'
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                'searching':false,
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

</script>
@endsection

{{--@include('admin.artist_permit.includes.artist-block-modal')--}}

