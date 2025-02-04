@extends('layouts.app')

@section('title', 'Profile - Smart Government Rak')

@section('content')
@php
$user = Auth::user();
$user_lang = $user->LanguageId;
@endphp
<div class="kt-portlet ">
  <div class="kt-portlet__body">

    @if ($company->status == 'draft')
    <div class="alert alert-outline-danger fade show kt-padding-t-10 kt-padding-b-10" role="alert">
      <div class="alert-icon"><i class="flaticon-warning"></i></div>
      <div class="alert-text">
        <ul>
          <li>Your registration is still in <span class="kt-badge kt-badge--warning kt-badge--inline">Draft</span>.
            Please update the information and submit to enjoy the RAKTDA services.</li>
        </ul>
      </div>
      <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
      </div>
    </div>
    @endif

    @if ($company->status == 'pending')
    <div class="alert alert-outline-danger fade show kt-padding-t-10 kt-padding-b-10" role="alert">
      <div class="alert-icon"><i class="flaticon-warning"></i></div>
      <div class="alert-text">
        <p>Your registration is still in <span class="kt-badge kt-badge--warning kt-badge--inline">Pending</span> ,
          <br />
          The RAKTDA representative will check your application and will respond your request.</p>
      </div>
      <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
      </div>
    </div>
    @endif

    @if ($company->status == 'return')
    <div class="alert alert-outline-danger fade show kt-padding-t-10 kt-padding-b-10" role="alert">
      <div class="alert-icon"><i class="flaticon-warning"></i></div>
      <div class="alert-text">
        <div class="kt-font-bold">Your application was bounced back, see the comment below:</div>
        <ul class="kt-margin-t-10">
          @if ($company->comment()->latest()->exists())
          <li>
            {{ getLangId() == 1 ? ucfirst($company->comment()->latest()->first()->comment_en) : $company->comment()->latest()->first()->comment_ar}}
          </li>
          @endif
        </ul>
      </div>
      <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
      </div>
    </div>
    @endif


    <div class="kt-widget kt-widget--user-profile-3">
      <div class="kt-widget__top">

        {{-- <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light">
          {!! defaultProfile($company->name_en, null)!!}
        </div> --}}
        <div class="kt-widget__content">
          <div class="kt-widget__head">
            <span class="kt-widget__title">{{$user_lang == 1  ? ucfirst($company->name_en) : $company->name_ar }}</span>

            @if (in_array($company->status, ['active' , 'blocked', 'draft' , 'return']))
            <div class="kt-widget__action">
              <a href="{{ URL::signedRoute('company.edit', $company->company_id) }}"
                class="btn btn-sm btn--maroon kt-font-transform-u">{{__('Update Details')}}</a>&nbsp;
              <button type="button" class="kt-hide btn btn-success btn-sm btn-upper">add user</button>&nbsp;
              <button type="button" class="kt-hide btn btn-brand btn-sm btn-upper">new task</button>
            </div>
            @endif


          </div>

           <div class="kt-widget__subhead">
            <span> {!!permitStatus(in_array($company->status, ['rejected', 'active', 'blocked',
              'back',
              'draft', 'active']) ?ucfirst($company->status):'Pending')!!}</span>&emsp;
          </div>

           <div class="kt-widget__info row">
            <div class="col-md-8">

         
          <div class="kt-widget__subhead">
            <span ><i class="flaticon2-envelope fnt-20 kt-valign-middle"></i>&emsp; {{$company->company_email}}</span><br />
            <span ><i class="flaticon2-phone fnt-20 kt-valign-middle"></i>&emsp; {{$company->phone_number}}</span><br />
            <span ><i class="flaticon2-pin fnt-20 kt-valign-middle"></i>&emsp; {{$company->getFullAddressAttribute()}}</span><br />
             @if($company->company_description_en ?? $company->company_description_ar)
            <span ><i class="flaticon2-chat fnt-20 kt-valign-middle"></i>&emsp; {{$user_lang == 1  ? ucfirst($company->company_description_en) : ucfirst($company->company_description_ar)}}
            </span>
             @endif
          </div>
         
             
              <div class="kt-widget__stats">
                <div class="kt-widget__item">
                  <span class="kt-widget__date kt-padding-b-5">
                    {{__('License Number')}}
                  </span>
                  <div class="kt-widget__label">
                    <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold">{{$company->trade_license }}</span>
                  </div>
                </div>

                <div class="kt-widget__item">
                  <span class="kt-widget__date kt-padding-b-5">
                    {{__('License Expiry Date')}}
                  </span>
                  <div class="kt-widget__label">
                    <span
                      class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold">{{$company->trade_license_expired_date->format('d-F-Y')}}</span>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-md-4">
              <div class="border kt-padding-10">
                <h6 class="kt-font-dark kt-font-bold kt-font-transform-u kt-margin-b-10">
                  {{ __('Establishment Details') }}</h6>
                <table class="table table-borderless table-sm table-display">
                  <tbody>
                    <tr>
                      <td width="40%">{{__('Reference No')}}</td>
                      <td>{{$company->reference_number}}</td>
                    </tr>
                  </tbody>
                </table>
                <hr>
                <h6 class="kt-font-dark kt-font-bold kt-font-transform-u kt-margin-b-10">
                  {{ __('Contact Person Details') }}</h6>
                <table class="table table-borderless table-sm table-display">
                  <tbody>
                    <tr>
                      <td width="40%"><i style="font-size: large;" class="flaticon-profile-1"></i></td>
                      <td>
                        {{ $user_lang == 1 ? ucwords($company->contact->contact_name_en) : ucwords($company->contact->contact_name_ar)  }}
                      </td>
                    </tr>
                    <tr>
                      <td><i style="font-size: large;" class="la la-suitcase"></i></td>
                      <td>
                        {{ $user_lang == 1 ? ucwords($company->contact->designation_en) : ucwords($company->contact->designation_ar) }}
                      </td>
                    </tr>
                    <tr>
                      <td><i style="font-size: large;" class="la la-mobile-phone"></i></td>
                      <td>{{ $company->contact->mobile_number }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="kt-widget__bottom">

        <div class="kt-widget__item col-md-3">
          <div class="kt-widget__icon">
            <i class="flaticon-confetti"></i>
          </div>
          <div class="kt-widget__details">
            <span class="kt-widget__title kt-font-transform-u">{{__('Active Event Permits')}}</span>
            <a href="#"
              class="kt-widget__value kt-font-brand">{{ $company->event()->whereStatus('active')->count() }}</a>
          </div>
        </div>

        <div class="kt-widget__item col-md-3">
          <div class="kt-widget__icon">
            <i class="flaticon-file-2"></i>
          </div>
          <div class="kt-widget__details">
            <span class="kt-widget__title kt-font-transform-u">{{__('Active Artist Permits')}}</span>
            <a href="#"
              class="kt-widget__value kt-font-brand">{{$company->permit()->where('permit_status', 'active')->count()}}</a>
          </div>
        </div>

        <div class="kt-widget__item kt-hide">
          <div class="kt-widget__icon">
            <i class="flaticon-network" data-toggle="kt-tooltip" data-skin="dark" data-placement="top" title=""
              data-original-title="{{(__('Active Artists'))}}"></i>
          </div>
          <div class="kt-widget__details">
            <div class="kt-section__content kt-section__content--solid">
              @if ( $artists = $company->artists()->where('artist_status', 'active')->get() )
              <div class="k t-badge kt-badge__pics">

                @foreach ($artists as $index => $artist)
                {{-- {{dd($artist->companies()->sync(1))}} --}}
                @if ($index <= 6) <a href="javascript:void(0)" class="kt-badge__pic" data-toggle="kt-tooltip"
                  data-skin="brand" data-placement="top" title=""
                  data-original-title="{{ucwords($artist->artistPermit()->latest()->first()->fullname)}}">
                  <img src="{{ asset('storage/'.$artist->artistPermit()->latest()->first()->thumbnail) }}"
                    class="img-thumbnail">
                  </a>
                  @else
                  <a href="javascript:void(0)" class="kt-badge__pic kt-badge__pic--last kt-font-brand">
                    +{{ ($index+1) - 5 }}
                  </a>
                  @endif
                  @endforeach

              </div>
              @endif

            </div>
          </div>
        </div>

      </div>
      <section class="row">
        <div class="col-md-12">
          <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist">
            <li class="nav-item">
              <a class="nav-link active kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_1"
                role="tab">{{__('Uploaded Documents')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_3"
                role="tab">{{__('Comments')}}</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="kt_tabs_6_1" role="tabpanel">
              <table class="table table-borderless border" id="upload-requirement-table">
                <thead>
                  <tr>
                    <th>{{__('Document Name')}}</th>
                    <th>{{__('No.of.Files')}}</th>
                    {{-- <th>{{__('ISSUED DATE')}}</th> --}}
                    {{-- <th>{{__('EXPIRED DATE')}}</th> --}}
                    <th></th>
                  </tr>
                </thead>
              </table>
            </div>

            <div class="tab-pane" id="kt_tabs_6_3" role="tabpanel">
              <table class="table table-borderless table-striped table-hover border" id="action-table">
                <thead>
                  <tr>
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
</div>
@stop
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    uploaded();
    actionTable();
  });

  function actionTable(){
    $('#action-table').DataTable({
      ajax: '{{ route('company.comment.datatable', $company->company_id) }}',
      columnDefs:[
        {targets: '_all', className: 'no-wrap'}
      ],
      responsive: true,
      columns:[
      {data: 'remark'},
      {data: 'action'},
      {data: 'date'},
      ]
    });
  }
      function uploaded(){
      requirementTable = $('#upload-requirement-table').DataTable({

        ajax: '{{ route('company.requirement.datatable', $company->company_id) }}',
        // columnDefs:[{targets: [4], className:'no-wrap'}],
        "order": [[ 0, 'asc' ]],
          rowGroup: {
            startRender: function ( rows, group ) {
             var row_data = rows.data()[0];
             console.log()
             return $('<tr/>').append( '<td >'+group+'</td>' )
                        .append( '<td>'+rows.count()+'</td>' )
                        .append( '<td></td>' )
                        // .append( '<td>'+row_data.action+'</td>' )
                        // .append( '<tr/>' );
              },
           dataSrc: 'name'
        },
        columns:[
        // {data: 'name'},
        {data: 'file'},
        {render: function(data){ return null}},
        // {render: function(data){ return null}},
        {render: function(data){ return null}},
        ],
        language: {
                    searchPlaceholder: "{{__('Search')}}",
                },
        createdRow: function(row, data, index){
          $('.btn-remove',row).click(function(){
            $.ajax({
              url: '{{ route('company.requirement.delete', $company->company_id) }}',
              data: {company_requirement_id : data.company_requirement_id, path: data.path},
              type: 'post',
              beforeSend: function(){
                KTApp.blockPage({
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'success',
                    message: '{{__("Please wait...")}}'
                });
              }
            }).done(function(response, textStatus, xhr){
              if(xhr.status == 200){
                 KTApp.unblockPage();
                requirementTable.ajax.reload();
              }
            });

          });
        }
      });
    }
</script>
@stop
