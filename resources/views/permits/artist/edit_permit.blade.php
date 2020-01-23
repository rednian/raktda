@extends('layouts.app')

@section('title', 'Edit Permit - Smart Government Rak')

@section('content')

@include('permits.components.comments', ['staff_comments' => $staff_comments])

<div class="kt-portlet kt-portlet--mobile" style="z-index:1;">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('Edit Artist Permit')}}
            </h3>
            @if(!$permit_details->event)
            <span class="text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                <strong>{{$permit_details->reference_number}}
                </strong>
            </span>
            @endif
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <button id="back_btn" class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
                </button>
                {{-- <a href="{{url('company/artist/add_artist_to_permit/edit/'.$permit_details->permit_id)}}"
                class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                <i class="la la-plus"></i>
                {{__('Add Artist')}}
                </a> --}}
                <a href="{{URL::signedRoute('company.add_artist_to_permit',['from' => 'edit', 'id' => $permit_details->permit_id])}}"
                    class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-plus"></i>
                    {{__('Add Artist')}}
                </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                <button id="back_btn_sm" class="btn btn--maroon btn-sm">
                    <i class="la la-arrow-left"></i>
                </button>
                <a href="{{URL::signedRoute('company.add_artist_to_permit',['from' => 'edit', 'id' => $permit_details->permit_id])}}"
                    class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-plus"></i>
                </a>
            </div>

        </div>
    </div>

    <input type="hidden" id="permit_id" value="{{$permit_details->permit_id}}">

    <div class="kt-portlet__body kt-padding-t-0">
        <div class="kt-widget kt-widget--project-1">
            <div class="kt-widget__body kt-padding-l-0">
                @if($permit_details->event)
                <div class="kt-widget__stats d-">
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('From Date')}}</span>
                        <div class="kt-widget__label">
                            <span class="btn btn-label-success btn-sm btn-bold btn-upper">
                                {{date('d M, y',strtotime($permit_details->issued_date))}}
                            </span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('To Date')}}</span>
                        <div class="kt-widget__label">
                            <span class="btn btn-label-danger btn-sm btn-bold btn-upper">
                                {{date('d M, y',strtotime($permit_details->expired_date))}}
                            </span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('Permit Term')}}</span>
                        <div class="kt-widget__label">
                            <span
                                class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper cursor-text">
                                {{$permit_details->term}}
                            </span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('Reference Number')}}</span>
                        <div class="kt-widget__label">
                            <span
                                class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper cursor-text">
                                {{$permit_details->reference_number}}
                            </span>
                        </div>
                    </div>
                    <input type="hidden" id="event_id" value="{{$permit_details->event->event_id}}">

                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('Connected Event ?')}}</span>
                        <div class="kt-widget__label">
                            <span
                                class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper cursor-text">
                                {{getLangId() == 1 ? ucfirst($permit_details->event->name_en) : $permit_details->event->name_ar}}
                            </span>
                        </div>
                    </div>

                </div>
                <div class="kt-widget__text kt-margin-t-10">
                    <strong>{{__('Work Location')}} :</strong>
                    {{getLangId() == 1 ? ucfirst($permit_details->work_location) : $permit_details->work_location_ar}}
                </div>
                <input type="hidden" id="permit_from" value="" />
                <input type="hidden" id="permit_to" value="" />
                <input type="hidden" id="work_loc" value="" />
                <input type="hidden" id="work_loc_ar" value="" />
                @else
                <input type="hidden" id="event_id" value="">
                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                    <div class="kt-form__section kt-form__section--first">
                        <div class="kt-wizard-v3__form">
                            <form id="permit_details" method="POST" autocomplete="off">
                                <div class="row">
                                    <div class="form-group col-lg-2 kt-margin-b-0">
                                        <label for="permit_from"
                                            class="col-form-label col-form-label-sm ">{{__('From Date')}} <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text" class="form-control form-control-sm "
                                                    name="permit_from" id="permit_from" placeholder="DD-MM-YYYY"
                                                    data-date-start-date="+0d" onchange="givWarn()"
                                                    value="{{date('d-m-Y',strtotime($permit_details->issued_date))}}" />
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                    <span>
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="artiststartafter"
                                        value="{{getSettings()->artist_start_after}}" />
                                    <div class="form-group col-lg-2 kt-margin-b-0">
                                        <label for="permit_to"
                                            class="col-form-label col-form-label-sm">{{__('To Date')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text" class="form-control form-control-sm "
                                                    name="permit_to" id="permit_to" placeholder="DD-MM-YYYY"
                                                    value="{{date('d-m-Y',strtotime($permit_details->expired_date))}}" />
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                    <span>
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group col-lg-3 kt-margin-b-0">
                                        <label for="work_loc" class="col-form-label col-form-label-sm">
                                            {{__('Work Location')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="work_loc"
                                            id="work_loc" value="{{ucfirst($permit_details->work_location)}}" />
                                    </div>
                                    <div class="form-group col-lg-3 kt-margin-b-0">
                                        <label for="work_loc" class="col-form-label col-form-label-sm">
                                            {{__('Work Location (AR)')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="work_loc_ar"
                                            id="work_loc_ar" dir="rtl" value="{{$permit_details->work_location_ar}}" />
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-striped border table-hover table-borderless" id="applied-artists-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('First Name')}}</th>
                            <th>{{__('Last Name')}}</th>
                            <th>{{__('Profession')}}</th>
                            <th>{{__('Mobile Number')}}</th>
                            {{-- <th>Email</th> --}}
                            <th>{{__('Status')}}</th>
                            <th class="text-center">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0 ;
                        @endphp
                        <input type="hidden" id="total_artist_details" value="{{count($artist_details)}}">
                        @foreach ($artist_details as $artist_detail)
                        <tr>
                            <td>{{ getLangId() == 1 ? $artist_detail->firstname_en :  $artist_detail->firstname_ar}}
                            </td>
                            <td>{{ getLangId() == 1 ? $artist_detail->lastname_en :  $artist_detail->lastname_ar}}</td>
                            <td>{{ getLangId() == 1 ? $artist_detail->profession['name_en'] : $artist_detail->profession['name_ar']}}
                            </td>
                            <td>{{$artist_detail->mobile_number}}</td>
                            {{-- <td>{{$artist_detail->email}}</td> --}}
                            <td>
                                {{ ucwords($artist_detail->artist_permit_status)}}
                            </td>
                            <td class="d-flex justify-content-center">
                                @if($artist_detail->artist_permit_status != 'approved')
                                <a href="{{URL::signedRoute('artist.edit_artist',[ 'id' => $artist_detail->id , 'from' => 'edit'])}}"
                                    title="Edit">
                                    <button
                                        class="btn btn-sm btn-secondary btn-elevate btn-hover-warning kt-margin-r-5">{{__('Edit')}}</button>
                                </a>
                                @else
                                <button style="visibility: hidden"
                                    class="btn btn-sm btn-secondary btn-elevate btn-hover-warning kt-margin-r-5">Edit</button>
                                @endif
                                <a href="{{URL::signedRoute('temp_artist_details.view' , [ 'id' => $artist_detail->id , 'from' => 'edit'])}}"
                                    title="View">
                                    <button
                                        class="btn btn-sm btn-secondary btn-elevate btn-hover-warning  kt-margin-r-5">{{__('View')}}</button>
                                </a>
                                @if(count($artist_details) > 1)
                                @if($artist_detail->artist_permit_status != 'approved')
                                <a href="#"
                                    onclick="delArtist({{$artist_detail->id}},{{$artist_detail->permit_id}},'{{$artist_detail->firstname_en}}','{{$artist_detail->lastname_en}}')"
                                    data-toggle="modal" data-target="#delartistmodal" title="{{__('Remove')}}">
                                    <button
                                        class="btn btn-sm btn-secondary btn-elevate btn-warning-hover">{{__('Remove')}}</button>
                                </a>
                                @else
                                <button style="visibility: hidden"
                                    class="btn btn-sm btn-secondary btn-elevate btn-hover-warning kt-margin-r-5">Edit</button>
                                @endif
                                @endif
                                {{-- @if(count($staff_comments) > 0)
                                <a href="#" onclick="getArtistComments({{$artist_detail->artist_permit_id}})">
                                <i class="la la-comment la-2x pl-4"></i>
                                </a>
                                @endif --}}
                            </td>
                            <input type="hidden" id="temp_id_{{$i}}" value="{{$artist_detail->id}}">
                            @php
                            $i++;
                            @endphp
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

            <div class="d-flex justify-content-end">
                <div class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u" id="submit_btn">
                    <i class="la la-check"></i>
                    {{__('Submit')}}
                </div>
            </div>
        </div>
    </div>



    @include('permits.artist.modals.leave_page')

    @include('permits.artist.modals.remove_artist', ['from' => 'edit'])


    <div class="modal fade" id="artist_permit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Comments on Artist')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="artistpermitcomment">
                </div>
            </div>
        </div>
    </div>

    @include('permits.artist.modals.show_warning_modal',['day_count' =>getSettings()->artist_start_after ]);

</div>

@endsection

@section('script')
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){

            $('#kt_aside_menu ul li a').on('mouseenter', stopNavigate)
                .on('mouseout', function () {
                $(window).on('beforeunload', windowBeforeUnload);
            });
            if($('#permit_from').length)
            {
               var minDate = $('#permit_from').val() ;
               var maxDate = moment(minDate).add(3, 'M').toDate(); 
               $('#permit_to').datepicker('setEndDate', maxDate );
               $('#permit_to').datepicker('setStartDate', minDate );
            }
          
        })

        function stopNavigate(event) {
            $(window).off('beforeunload');
        }

        function windowBeforeUnload() {
            // return 'Are you sure you want to leave?';
            var permit_id = $('#permit_id').val();
            var nextUrl = document.activeElement.href;
            if(nextUrl == undefined){
                return;
            }
            var total = $('#total_artist_details').val();

            var addUrl = "{{url('company/artist/add_artist_to_permit/edit')}}/"+permit_id ;

            if(nextUrl != addUrl ){
                var tempArr = [];
                for(var i = 0 ; i < total; i++){
                    var temp_id = $('#temp_id_'+i).val();
                    var tempUrl = "{{url('company/artist/permit')}}"+'/' +temp_id + '/edit' ;
                    // var tempUrl = "{{url('company/edit_edit_artist')}}"+'/' +temp_id ;
                    tempArr.push(tempUrl);
                }

                if(!tempArr.includes(nextUrl)){
                    $.ajax({
                        type: 'GET',
                        url: "{{url('company/update_is_edit')}}"+"/" +permit_id,
                        success: function(data) {
                            // console.log('at last it worked');

                        }
                    });
                }

            }

            // return 'Are you sure you want to leave?';
        }


    $('#back_btn , #back_btn_sm').click(function(){
        $total_artists = $('#total_artist_details').val();
        if($total_artists > 0) {
            $('#back_btn_modal').modal('show');
        } else {
            window.location.href = "{{URL::signedRoute('artist.index')}}#applied";
        }
    });

    $('#permit_from').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom left",
        zIndexOffset: 98
    });
    
    $('#permit_to').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom left"
    });

    $('#permit_from').on('changeDate', function (selected) {
        $('#permit_from').valid() || $('#permit_from').removeClass('invalid').addClass('success');
        var minDate = new Date(selected.date.valueOf());
        var maxDate = moment(minDate).add(3, 'M').toDate();
        $('#permit_to').datepicker('setEndDate', maxDate);
        $('#permit_to').datepicker('setStartDate', minDate);
    });


    function go_back_confirm_function(){
        var temp_permit_id =  $('#permit_id').val();
        $.ajax({
                url:"{{route('company.clear_the_temp_data')}}",
                type: "POST",
                data: { permit_id: temp_permit_id, from: 'edit'},
                async: true,
                success: function(result){
                    window.location.href= result.toURL;
                }
        });
    }

    var event_id = $('#event_id').val();

    if(!event_id)
    {
        var permit_detail_Validator = $('#permit_details').validate({
            rules: {
                permit_from: 'required',
                permit_to: 'required',
                work_loc: 'required',
                work_loc_ar: 'required'
            }, 
            messages: {
                permit_from: '',
                permit_to: '',
                work_loc: '',
                work_loc_ar: ''
            }
        })
    }


    $('#submit_btn').click(function() {
        // $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
        // $('#submit_btn').css('pointer-events', 'none');
        if(!event_id ? permit_detail_Validator.form() : true)
        {
            $.ajax({
                url: '{{route("artist.update_permit")}}',
                type: 'POST',
                data: {
                    permit_id: $('#permit_id').val(),
                    from_date: $('#permit_from').val(),
                    to_date: $('#permit_to').val(),
                    work_loc: $('#work_loc').val(),
                    work_loc_ar: $('#work_loc_ar').val()
                },
                beforeSend: function() {
                    KTApp.blockPage({
                        overlayColor: '#000000',
                        type: 'v2',
                        state: 'success',
                        message: '{{__("Please wait...")}}'
                    });
                },
                success: function(result) {
                    if(result.message[0] == 'success')
                    {
                        window.location.href=result.toURL;
                        KTApp.unblockPage();
                    }
                }
            });
       }
    });

    function delArtist(temp_id, permit_id, fname, lname) {
        $('#del_temp_id').val(temp_id);
        $('#del_permit_id').val(permit_id);
        $('#del_fname').val(fname);
        $('#warning_text').html('Are you sure to remove <b>' + fname + ' ' + lname + '</b> from this permit ?');
        $('#warning_text').css('color', '#580000')
    }

    function getArtistComments(id){
        let url = '{{route("artist.fetch_artist_comment", ":id")}}';
        url = url.replace(':id', id);
        $.ajax({
            url: url ,
            success: function(result) {
                let comm = result.comments;
                $('#artistpermitcomment').empty();
                if(comm.length)
                {
                    $('#artist_permit_modal').modal('show');
                    for(const com of comm){
                        $('#artistpermitcomment').append(com.comment);
                    }
                }
            }
        });
    }

    function givWarn()
    {
        
        var from_date = $('#permit_from').val();
        let start_days_count = $('#artiststartafter').val();
        if(from_date)
        {
            var x = moment(from_date, "DD-MM-YYYY");
            var to = moment();
            var from = moment([x.format('YYYY'), x.month(), x.format('DD')]);
            var today = moment([to.format('YYYY'), to.month(), to.format('DD')]);
            var diff = from.diff(today, 'days');
            if(diff <= start_days_count)
            {
                $('#showwarning').modal('show');
            }
            var permit_to = x.add(30, 'days').calendar();
            var permit_to_date = moment(permit_to,'MM/DD/YYYY').format('DD-MM-YYYY');
            $('#permit_to').datepicker('setStartDate', permit_to_date);
            $('#permit_to').val(permit_to_date).datepicker('update');
        }
    }


</script>
@endsection