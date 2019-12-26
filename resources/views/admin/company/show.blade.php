@extends('layouts.admin.admin-app')
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
  <div class="kt-portlet__head kt-portlet__head--sm">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title kt-font-dark">
        {{ucfirst(Auth::user()->LanguageId == 1 ? $company->name_en : $company->name_ar )}} -
        {!!permitStatus($company->status) !!} </h3>
    </div>
    <div class="kt-portlet__head-toolbar">
      <a href="{{ route('admin.company.index') }}#active-company"
        class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u">
        <i class="la la-arrow-left"></i>
        BACK TO Company LIST
      </a>
    </div>
  </div>
  <div class="kt-portlet__body kt-padding-t-5">
    <div class="kt-widget kt-widget--user-profile-3">
      <div class="kt-widget__top">
        <div class="kt-widget__media kt-hidden">
          <img src="./assets/media/users/100_1.jpg" alt="image">
        </div>
        <div class="kt-widget__pic kt-widget__pic--dark kt-font-dark kt-font-boldest kt-font-light">
          @php
          $name = explode(' ', $company->name_en);
          $first = $name[0];
          @endphp
          {{strtoupper(substr($first, 0, 1))}}
        </div>
        <div class="kt-widget__content">
          <div class="kt-widget__head">
            <a href="#" class="kt-widget__username">
              {{ucfirst(Auth::user()->LanguageId == 1 ? $company->name_en : $company->name_ar )}}
            </a>
          </div>
          <section class="row">
            <div class="col-md-4">
              <div class="kt-widget__subhead">
                <a href="#"><i class="flaticon2-new-email"></i>{{$company->company_email}}</a><br>
                <a href="#"><i class="flaticon2-calendar-3"></i>Designer</a><br>
              </div>
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

            </div>
          </section>
          <div class="kt-widget__subhead">
            <a href="#"><i class="flaticon2-placeholder"></i>
              {{ucfirst($company->address)}}
              {{ucfirst($company->area->area_en)}}
              {{ucfirst($company->emirate->name_en)}}
              {{ucfirst($company->country->name_en)}}
            </a>
          </div>


          <div class="kt-widget__info">
            <div class="kt-widget__desc">
              {{Auth::user()->Language == 1 ? $company->company_description_en : $company->company_description_ar }}
            </div>
            {{-- <div class="kt-widget__progress">
                    <div class="kt-widget__text">
                      Progress
                    </div>
                    <div class="progress" style="height: 5px;width: 100%;">
                      <div class="progress-bar kt-bg-danger" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="kt-widget__stats">
                      53%
                    </div>
                  </div> --}}
          </div>
        </div>
      </div>
      <section class="row kt-margin-t-10">
        <div class="col-md-12">
          @if ($company->status == 'blocked')
          <div class="alert alert-outline-danger fade show kt-padding-t-0 kt-padding-b-0" role="alert">
            <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
            <div class="alert-text">This company is currently blocked.
              <span title="{{$company->comment()->latest()->first()->created_at->format('l h:i A | d-F-Y')}}"
                class="text-underline">{{ humanDate($company->comment()->latest()->first()->created_at) }}</span><br>
              <span>{{__('Please see the ACTION HISTORY for the remarks...')}}</span>
            </div>
            <div class="alert-close">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
              </button>
            </div>
          </div>
          @endif
          @if ($company->status == 'active' || $company->status == 'blocked')
          <div class="accordion accordion-solid  accordion-toggle-plus" id="accordionExample6">
            <div class="card">
              <div class="card-header " id="headingOne6">
                <div class="card-title kt-padding-b-10 kt-padding-t-10" data-toggle="collapse"
                  data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                  @if ($company->status == 'active')
                  {{__('BLOCK ESTABLISHMENT')}}
                  @else
                  {{__('UNBLOCK ESTABLISHMENT')}}
                  @endif
                </div>
              </div>
              <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                data-parent="#accordionExample6" style="">
                <div class="card-body kt-padding-b-0">
                  <form action="{{ route('admin.company.changestatus', $company->company_id) }}" method="post"
                    class="form" id="frm-status">
                    @csrf
                    <div class="form-group row form-group-sm">
                      <div class="col-md-6">
                        <label for="">Remarks <span class="text-danger">*</span></label>
                        <textarea required name="comment_en" maxlength="255" class="form-control form-control-sm"
                          rows="3" autocomplete="off"></textarea>
                      </div>
                      <div class="col-md-6">
                        <label for="">Remarks (AR)<span class="text-danger">*</span></label>
                        <textarea required name="comment_ar" dir="rtl" maxlength="255"
                          class="form-control form-control-sm" rows="3" autocomplete="off"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col">
                        @if ($company->status == 'active')
                        <button class="btn btn-sm btn-maroon kt-transform-u" name="status"
                          value="blocked">{{__('SUBMIT')}}</button>
                        @else
                        <button class="btn btn-sm btn-maroon kt-transform-u" name="status"
                          value="active">{{__('SUBMIT')}}</button>
                        @endif

                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endif


        </div>
      </section>
      <div class="kt-widget__bottom kt-margin-t-10">
        <div class="kt-widget__item kt-padding-t-5">
          <div class="kt-widget__icon">
            <i class="flaticon-event-calendar-symbol"></i>
          </div>
          <div class="kt-widget__details">
            <span class="kt-widget__title">{{__('ACTIVE EVENTS')}}</span>
            <span class="kt-widget__value"><span>{{$company->event()->whereStatus('active')->count()}}</span>
          </div>
        </div>
        <div class="kt-widget__item kt-padding-t-5">
          <div class="kt-widget__icon">
            <i class="flaticon-file-2"></i>
          </div>
          <div class="kt-widget__details">
            <span class="kt-widget__title">{{__('ACTIVE ARTIST PERMITS')}}</span>
            <span class="kt-widget__value">{{$company->permit()->where('permit_status','active')->count()}}</span>
          </div>
        </div>


      </div>
    </div>



    <section class="row">
      <div class="col-lg-12">
        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#event-tab" role="tab">
              <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
              {{__('EVENT PERMITS')}}
              <span class="kt-badge kt-badge--outline kt-badge--info">{{$company->event()->count()}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#artist-permit-tab" role="tab">
              {{__('ARTIST PERMIT')}}
              <span class="kt-badge kt-badge--outline kt-badge--info">{{$company->permit()->count()}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#artist-tab" role="tab">
              {{__('ARTIST LIST')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#requirement-tab" role="tab">
              {{__('UPLOADED REQUIREMENTS')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#action-history" role="tab">
              {{__('ACTION HISTORY')}}
              <span class="kt-badge kt-badge--outline kt-badge--info">{{$company->comment()->count()}}</span>
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="event-tab" role="tabpanel">
            <table class="table table-borderless table-striped table-hover border table-sm" id="event-table">
              <thead>
                <tr>
                  <th></th>
                  <th>{{__('EVENT NAME')}}</th>
                  <th>{{__('REFERENCE NO.')}}</th>
                  <th>{{__('PERMIT NO.')}}</th>
                  <th>{{__('EVENT DURATION')}}</th>
                  <th>{{__('APPLICATION TYPE')}}</th>
                  <th>{{__('STATUS')}}</th>
                  <th>{{__('VENUE')}}</th>
                  <th>{{__('LOCATION')}}</th>
                  <th>{{__('START')}}</th>
                  <th>{{__('END')}}</th>
                  <th>{{__('TIME')}}</th>
                  <th>{{__('Food Truck')}}</th>
                  <th>{{__('HAS LIQUOR')}}</th>
                  <th>{{__('NUMBER OF ARTIST')}}</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="tab-pane" id="artist-permit-tab" role="tabpanel">
            <table class="table table-borderless table-striped table-hover border" id="artist-permit-table">
              <thead>
                <tr>
                  {{-- <th></th> --}}
                  <th>{{__('REFERENCE NO.')}}</th>
                  <th>{{__('DURATION')}}</th>
                  <th>{{__('REQUEST TYPE')}}</th>
                  <th>{{__('PERMIT NO.')}}</th>
                  <th>{{__('NUMBER OF ARTIST')}}</th>
                  <th>{{__('STATUS')}}</th>
                  <th>{{__('WORK LOCATION')}}</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="tab-pane" id="artist-tab" role="tabpanel">
            <table class="table table-borderless table-striped table-hover border table-sm" id="artist-table">
              <thead>
                <tr>
                  <th></th>
                  <th>{{__('ARTIST NAME')}}</th>
                  <th>{{__('PERSON CODE.')}}</th>
                  <th>{{__('NATIONALITY')}}</th>
                  <th>{{__('MOBILE NUMBER')}}</th>
                  <th>{{__('EMAIL')}}</th>
                  <th>{{__('STATUS')}}</th>
                  <th>{{__('BIRTHDATE')}}</th>
                  <th>{{__('AGE')}}</th>
                  <th>{{__('RELIGION')}}</th>
                  <th>{{__('VISA TYPE')}}</th>
                  <th>{{__('VISA NUMBER')}}</th>
                  <th>{{__('VISA EXPIRY')}}</th>
                  <th>{{__('PASSPORT NUMBER')}}</th>
                  <th>{{__('PASSPORT EXPIRY')}}</th>
                  <th>{{__('IDETIFICATION NUMBER')}}</th>
                  <th>{{__('ADDRESS')}}</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="tab-pane" id="requirement-tab" role="tabpanel">
            <table class="table table-borderless table-striped table-hover border" id="requirement-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{__('REQUIREMENT NAME')}}</th>
                  <th>{{__('ISSUED DATE')}}</th>
                  <th>{{__('EXPIRED DATE')}}</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="tab-pane" id="action-history" role="tabpanel">
            <table class="table table-borderless table-striped table-hover table-sm border" id="action-table">
              <thead>
                <tr>
                  <th>{{__('NAME')}}</th>
                  <th>{{__('REMARKS')}}</th>
                  <th>{{__('ACTION')}}</th>
                  <th>{{__('DATE')}}</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </section>


  </div>
</div>
@stop
@section('script')
<script type="text/javascript">
  var event = {};
    $(document).ready(function(){
      $('form#frm-status').validate();
        hasUrl();
        eventList();
        artistPermit();
        artist();
        documentRequirement();
        actionTable();
      
      
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          var current_tab = $(e.target).attr('href');

          if('#artist-permit-tab' == current_tab ){ artistPermit(); }
          if('#artist-tab' == current_tab ){  artist(); }
          if('#action-history' == current_tab ){ actionTable(); }
          if('#event-tab' == current_tab){   eventList(); }
        });

    });

   function documentRequirement(){
      $('#requirement-table').DataTable({
         ajax:{
            url: '{{ route('admin.company.application.datatable', $company->company_id) }}'
         },
         columns: [
         {data: 'count'},
         {data: 'name'},
         {data: 'issued_date'},
         {data: 'expired_date'}
         ]
      });
   }

    function artistPermit(){
      $('table#artist-permit-table').DataTable({
        ajax: '{{ route('admin.company.artistpemit.datatable', $company->company_id) }}',
        columnDefs:[
        {targets: '_all', className: 'now-wrap'}
        ],
        columns:[
        {data: 'reference_number'},
        {data: 'duration'},
        {data: 'request_type'},
        {data: 'permit_number'},
        {data: 'artist_number'},
        {data: 'status'},
        {data: 'location'},
        ],
        createdRow: function(row, data, index){
          $('td:not(:first-child)',row).click(function(e){ location.href = data.link; });
        }
      });
    }

    function actionTable(){
      $('#action-table').DataTable({
        ajax: '{{ route('admin.company.comment.datatable', $company->company_id) }}',
        columnDefs:[
          {targets: '_all', className: 'no-wrap'}
        ],
        responsive: true,
        columns:[
        {data: 'name'},
        {data: 'remark'},
        {data: 'action'},
        {data: 'date'},
        ]
      });
    }

    function artist(){
        event =  $('table#artist-table').DataTable({
          // dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
          //       "<'row'<'col-sm-12'tr>>" +
          //       "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            ajax: {
               url: '{{ route('admin.company.artist.datatable', $company->company_id) }}',
               data: function(d){
                  // var status =  $('#active-permit-status').val();
                  // d.status = status ? [status] : ['blocked', 'active'];
                  // d.type = $('#active-applicant-type').val();
                  // d.area = $('#active-company-area').val();
               }
            },
            responsive: true,
            columnDefs:[
               {targets: '_all', className:'no-wrap'}
            ],
            columns:[
            {render: function(){ return null; }},
            {data: 'name'},
            {data: 'person_code'},
            {data: 'nationality'},
            {data: 'mobile_number'},
            {data: 'email'},
            {data: 'artist_status'},
            {data: 'birthdate'},
            {data: 'age'},
            {data: 'religion'},
            {data: 'visa_type'},
            {data: 'visa_number'},
            {data: 'visa_expiry'},
            {data: 'passport_number'},
            {data: 'passport_expire'},
            {data: 'identification_number'},
            {data: 'address'},
            ],
            createdRow: function(row, data, index){

               $('td:not(:first-child)',row).click(function(e){ location.href = data.link; });
            }
         });
    }

    function eventList() {
        event =  $('table#event-table').DataTable({
          // dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
          //       "<'row'<'col-sm-12'tr>>" +
          //       "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            ajax: {
               url: '{{ route('admin.company.event.datatable', $company->company_id) }}',
               data: function(d){
                  // var status =  $('#active-permit-status').val();
                  // d.status = status ? [status] : ['blocked', 'active'];
                  // d.type = $('#active-applicant-type').val();
                  // d.area = $('#active-company-area').val();
               }
            },
            responsive: true,
            columnDefs:[
               {targets: '_all', className:'no-wrap'}
            ],
            columns:[
            {render: function(){ return null; }},
            {data: 'profile'},
            {data: 'reference_number'},
            {data: 'permit_number'},
            {data: 'duration'},
            {data: 'firm'},
            {data: 'status'},
            {data: 'venue'},
            {data: 'full_address'},
            {data: 'issued_date'},
            {data: 'expired_date'},
            {data: 'time'},
            {data: 'truck'},
            {data: 'liquor'},
            {data: 'artist'},
            ],
            createdRow: function(row, data, index){

               $('td:not(:first-child)',row).click(function(e){ location.href = data.link; });
            }
         });
    }

      function hasUrl(){
     var hash = window.location.hash;
     hash && $('ul.nav a[href="' + hash + '"]').tab('show');
     $('.nav-tabs a').click(function (e) {
       $(this).tab('show');
       var scrollmem = $('body').scrollTop();
       window.location.hash = this.hash;
       // $('html,body').scrollTop(scrollmem);
     });
   }
</script>
@endsection