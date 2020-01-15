@extends('layouts.admin.admin-app')
@section('content')
	 <div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile border">
			<div class="kt-portlet__head kt-portlet__head--sm">
				 <div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('Artist Permit') }} - {{$permit->reference_number}} </h3>
				 </div>
				 <div class="kt-portlet__head-toolbar">
						<a href="{{ URL::signedRoute('admin.artist_permit.index') }}" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u">
							 <i class="la la-arrow-left"></i>
							 {{ __('Back') }}
						</a>
            @if(!Auth::user()->roles()->whereIn('roles.role_id', [4,5,6])->exists())
						<div class="dropdown dropdown-inline">
							 <button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="flaticon-more"></i>
							 </button>
							 <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
									<a class="dropdown-item kt-font-trasnform-u" href="{{ URL::signedRoute('admin.company.show', $permit->owner->company->company_id) }}">
                  {{ __('Establishment Details') }}
                </a>
							 </div>
						</div>
            @endif
				 </div>
			</div>
			<div class="kt-portlet__body kt-padding-t-5">
        <section class="row">
          <div class="col-md-8">
            <div class="kt-widget kt-widget--project-1">
              <div class="kt-widget__body kt-padding-0">
                <h6 class="kt-font-dark kt-font-bold kt-margin-b-15 kt-font-transform-u">{{ __('ARTIST PERMIT DETAILS') }}</h6>
                <div class="kt-widget__stats kt-padding-l-0 kt-margin-t-5 kt-padding-b-5 border-top border-bottom">
                  <div class="kt-widget__item">
                    <span class="kt-widget__subtitel">{{__('Permit Start Date')}}</span>
                    <div class="kt-widget__progress d-flex  align-items-center kt-margin-t-5">
                      <span class="kt-widget__stat kt-padding-l-0">
                     {{ $permit->issued_date->format('d-F-Y') }}
                      </span>
                    </div>
                  </div>
                  <div class="kt-widget__item">
                    <span class="kt-widget__subtitel">{{__('Permit End Date')}}</span>
                    <div class="kt-widget__progress d-flex  align-items-center kt-margin-t-5">
                      <span class="kt-widget__stat kt-padding-l-0">
                     {{ $permit->expired_date->format('d-F-Y') }}
                      </span>
                    </div>
                  </div>
                  <div class="kt-widget__item">
                    <span class="kt-widget__subtitel">{{__('Permit Duration')}}</span>
                    <div class="kt-widget__progress d-flex  align-items-center kt-margin-t-5">
                      <span class="kt-widget__stat kt-padding-l-0">
                      @php
                        $date =Carbon\Carbon::parse($permit->expired_date)->diffInDays($permit->issued_date);
                        $date = $date !=  0 ? $date : 1;
                        $day = $date > 1 ? ' Days': ' Day';
                      @endphp
                      {{$date.$day}}
                      </span>
                    </div>
                  </div>
                  <div class="kt-widget__item">
                    <span class="kt-widget__subtitel">{{__('Permit Term')}}</span>
                    <div class="kt-widget__progress d-flex  align-items-center kt-margin-t-5">
                      <span class="kt-widget__stat kt-padding-l-0">
                     {{ __(ucfirst($permit->term).' Term') }}
                      </span>
                    </div>
                  </div>
                </div>
                      <section class="kt-section kt-margin-t-5">
                         <div class="kt-section__desc">
                            
                            <table class="table table-borderless table-sm">
                               <tr>
                                  <td width="25%">{{ __('Reference Number') }} :</td>
                                  <td class="text-danger kt-font-bolder">{{ $permit->reference_number }}</td>
                               </tr>
                               <tr>
                                  <td>{{ __('Request Type') }} :</td>
                                  <td>{{ __(ucfirst($permit->request_type) . ' Application') }}</td>
                               </tr>
                               <tr>
                                  <td>{{ __('Permit Status') }} :</td>
                                  <td>{!! permitStatus($permit->permit_status) !!}</td>
                               </tr>
                               @if ($permit->number)
                                  <tr>
                                     <td>Permit Number :</td>
                                     <td>{{ $permit->permit_number ? $permit->permit_number : null   }}</td>
                                  </tr>
                               @endif
                               <tr>
                                  <td>{{ __('Work Location') }} :</td>
                                  <td>{{ ucwords($permit->work_location) }}</td>
                               </tr>
                            </table>
                         </div>
                      </section>
                {{-- <span class="kt-widget__text">
                  I distinguish three main text objecttives.First, your objective could
                  be merely to inform people.A second be to persuade people.
                </span> --}}
                <div class="kt-widget__content border-top kt-margin-t-15">
                  <div class="kt-widget__details">
                    <span class="kt-widget__subtitle kt-padding-b-5 kt-font-transform-u">{{__('Revision Number')}}</span>
                    <span class="kt-widget__value">{{str_pad($permit->rivision_number, 3, 0, STR_PAD_LEFT)}}</span>
                  </div>
                  <div class="kt-widget__details">
                    <span class="kt-widget__subtitle kt-padding-b-5 kt-font-transform-u">{{__('CONNECTED TO AN EVENT')}}</span>
                    <span class="kt-widget__value">
                      @if ($permit->event()->exists())
                        <a href="{{URL::signedRoute('admin.event.show', $permit->event->event_id)}}" class="btn btn-sm btn-secondary">{{__('YES')}}</a>
                        @else
                        {{__('NO')}}
                      @endif
                    </span>
                  </div>
                  <div class="kt-widget__details">
                    <span class="kt-widget__subtitle kt-padding-b-5 kt-font-transform-u">{{__('Artists')}}</span>
                    <div class="kt-badge kt-badge__pics">
                      @if ($permit->artistPermit()->exists())
                        @foreach ($permit->artistPermit as $number => $artist_permit)
                          @if ($number < 6)
                            <a href="{{ URL::signedRoute('admin.artist.show', $artist_permit->artist->artist_id) }}" class="kt-badge__pic" data-original-title="{{ ucwords($artist_permit->fullname) }}" data-toggle="kt-tooltip" data-skin="brand" data-placement="top">
                              <img src="{{ asset('storage/'.$artist_permit->thumbnail) }}" alt="image" class="img-thumbnail">
                            </a>
                            @else
                            <a href="#" class="kt-badge__pic kt-badge__pic--last kt-font-brand">
                              +{{$permit->artistPermit()->count() - ($number - 6) }}
                            </a>
                          @endif
                        @endforeach
                      @endif
                    </div>
                  </div>
                </div>
                <hr>
              </div>
              
            </div>
          </div>
          <div class="col-md-4">
            <section class="kt-section border kt-padding-10 kt-margin-b-20">
               <div class="kt-section__desc">
                  <h6 class="kt-font-dark kt-font-bold kt-font-transform-u kt-margin-b-10">{{ __('Establishment Details') }}</h6>
                  <table class="table table-borderless table-sm table-display">
                    <tbody>
                      <tr>
                         <td><span style="font-size: large;" class="flaticon-home"></span></td>
                         <td class="kt-font-dark">{{ Auth::user()->LanguageId == 1 ? ucwords($permit->owner->company->name_en) : ucwords($permit->owner->company->name_ar) }}</td>
                      </tr>
                      <tr>
                        <td><span style="font-size: large;" class="flaticon-email"></span></td>
                        <td>{{$permit->owner->company->company_email}}</td>
                      </tr>
                      <tr>
                        <td><span style="font-size: large;" class="la la-phone"></span></td>
                       <td>{{$permit->owner->company->phone_number}}</td>
                      </tr>
                      <tr>
                        <td><span style="font-size: large;" class="flaticon-placeholder-3"></span></td>
                        @php
                          $country = Auth::user()->LanguageId == 1 ? ucfirst($permit->owner->company->country->name_en) : ucfirst($permit->owner->company->country->name_ar);
                          $area = Auth::user()->LanguageId == 1 ? ucfirst($permit->owner->company->area->area_en) : ucfirst($permit->owner->company->area->area_en);
                          $emirate = Auth::user()->LanguageId == 1 ? ucfirst($permit->owner->company->emirate->name_en) : ucfirst($permit->owner->company->emirate->name_en);
                          $address = ucfirst($permit->owner->company->address).' '.ucfirst($area).' '.ucfirst($emirate).' '.ucfirst($country);
                        @endphp
                        <td>{{$address}}</td>
                      </tr>
                    </tbody>
                  </table>


                  <h6 class="kt-font-dark kt-font-bold kt-font-transform-u kt-margin-b-10 kt-margin-t-20">{{ __('Contact Information') }}</h6>
                  <table class="table table-borderless table-sm table-display">
                    <tbody>
                      <tr>
                        <td class="no-wrap"><i style="font-size: large;" class="flaticon-profile-1"></i></td>
                        <td>
                          {{ Auth::user()->LanguageId == 1 ? ucwords($permit->company->contact->contact_name_en) : ucwords($permit->company->contact->contact_name_ar)  }}
                        </td>
                     </tr>
                     <tr>
                        <td><i style="font-size: large;" class="la la-suitcase"></i></td>
                        <td>{{ Auth::user()->LanguageId == 1 ? ucwords($permit->company->contact->designation_en) : ucwords($permit->company->contact->designation_ar) }}</td>
                     </tr>
                     <tr>
                        <td><i style="font-size: large;" class="la la-mobile-phone"></i></td>
                        <td>{{ $permit->company->contact->mobile_number }}</td>
                     </tr>
                    </tbody>
                  </table>
               </div>
            </section>
          </div>
        </section>


        <section class="row">
          <div class="col-md-12">
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-3x" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#artist-list" role="tab">
                  {{__('ARTIST LIST')}}
                  <span class="kt-badge kt-badge--outline kt-badge--info">{{$permit->artistPermit()->count()}}</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#approver-tab" role="tab">
                  {{__('CHECKED HISTORY')}}
                  {{-- <span class="kt-badge kt-badge--outline kt-badge--info">{{$permit->comment()->o}}</span> --}}
                </a>
              </li>
              @if(!Auth::user()->roles()->whereIn('roles.role_id', [4, 5, 6])->exists())
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#permit-history" role="tab">
                  {{__('PERMIT HISTORY')}}
                  <span class="kt-badge kt-badge--outline kt-badge--info">{{$rivision}}</span>
                </a>
              </li>
              @endif
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="artist-list" role="tabpanel">
                 

                <?php  $is_artist_check = $permit->artistpermit()->where('artist_permit_status', 'unchecked')->exists(); ?>
                <div id="action-alert" class="alert d-none alert-outline-danger fade show" role="alert">
                  <div class="alert-icon"><i class="flaticon-warning"></i></div>
                  <div class="alert-text">
                      {{ __('Please check each artist with the action status of unchecked before taking action!') }}
                  </div>
                </div>
                <div id="action-alert-unselected" class="alert d-none alert-outline-danger fade show" role="alert">
                  <div class="alert-icon"><i class="flaticon-warning"></i></div>
                  <div class="alert-text">{{ __('Please check atleast one checkbox to take action.') }}</div>
                  <div class="alert-close"></div>
                </div>
                  <table class="table table-hover table-borderless table-striped border table-sm" id="artist-table">
                    <thead>
                      <tr>
                         <th>{{ __('PERSON CODE') }}</th>
                         <th>{{ __('ARTIST NAME') }}</th>
                         <th>{{ __('AGE') }}</th>
                         <th>{{ __('PROFESSION') }}</th>
                         <th>{{ __('NATIONALITY') }}</th>
                         <th>{{ __('STATUS') }}</th>
                         <th>{{ __('ACTION') }}</th>
                      </tr>
                      </thead>
                   </table>
              </div>

              <div class="tab-pane" id="approver-tab" role="tabpanel">
                <table class=" border table-striped table table-borderless table-hover table-sm" id="permit-comment-table">
                  <thead>
                    <tr>
                      <th>{{ __('CHECKED BY') }}</th>
                      <th>{{ __('REMARKS') }}</th>
                      <th>{{ __('CHECKED DATE') }}</th>
                      <th>{{ __('ACTION TAKEN') }}</th>
                    </tr>
                  </thead>
                </table>
              </div>

               @if(!Auth::user()->roles()->whereIn('roles.role_id', [4, 5, 6])->exists())
               <div class="tab-pane" id="permit-history" role="tabpanel">
                 <table class="table table-striped table-borderless table-hover" id="table-permit-history">
                   <thead>
                     <tr>
                       <th>{{ __('REVISION NUMBER') }}</th>
                       <th>{{ __('REFERENCE NO.') }}</th>
                       <th>{{ __('PERMIT NO.') }}</th>
                       <th>{{ __('NO. OF ARTIST') }}</th>
                       <th>{{ __('PERMIT DURATION') }}</th>
                       <th>{{ __('PERMIT START DATE') }}</th>
                       <th>{{ __('PERMIT END DATE') }}</th>
                       <th>{{ __('REQUEST TYPE') }}</th>
                       <th>{{ __('STATUS') }}</th>
                     </tr>
                   </thead>
                 </table>
               </div>
               @endif
              
            </div>
          </div>
        </section>
        

        </div>
        <?php
        $artist_number = $permit->artistpermit()->count();
        $check = $permit->artistpermit; ?>
		@include('admin.artist_permit.includes.submit-action', ['permit' => $permit])
		@include('admin.artist_permit.includes.comment-modal', ['permit' => $permit])
    @include('admin.artist_permit.includes.document')
		@include('admin.artist_permit.includes.check-existing-permit')
	<div id="action-container">
			<button id="btn-action" class="btn btn-warning btn-sm btn-elevate kt-margin-l-5 kt-font-transform-u kt-bold">{{ __('Take Action For Application') }}</button>
	</div>
@endsection
@section('script')
<script type="text/javascript">
  var artist = {};
  $(document).ready(function () {

    $('select[name=action]').change(function(){
      if($(this).val() == 'approved-unpaid'){
        $('form#permit-action').find('textarea[name=comment]').removeAttr('required',true).removeClass('is-invalid');
        $('form#permit-action').find('#comment-error').hide();
      }
      else{
         $('form#permit-action').find('textarea[name=comment]').attr('required', true).addClass('is-invalid');
          $('form#permit-action').find('#comment-error').show();
      }
    });
    hasUrl();
    submitAction();
    artistTable();
    permitHistory();
    permitComment();


    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var current_tab = $(e.target).attr('href');

      if('#approver-tab' == current_tab ){ permitComment(); }
      if('#permit-history' == current_tab ){ permitHistory(); }
    });


    //UPDATE LOCK EVERY 5 SECONDS
    var lockinterval = setInterval(updateLock, 60000);

    $('button#btn-action').click(function () {
      if ('{{ $is_artist_check  }}') {
        $('#action-alert').removeClass('d-none');
      } else {
        $('#action-alert-unselected').addClass('d-none');
        $('#action-alert').addClass('d-none');
        $('#action-modal').modal('show');
      }
    });

    $('#permit-action').validate({
    // onsubmit: false,
    // debug:true,
    rules: {
      comment: {
      // required: true,
      minlength: 1,
    },
    action: {
      required: true
    }
  },
  invalidHandler: function (event, validator) {
    var errors = validator.numberOfInvalids();
    KTUtil.scrollTop();
  },

  submitHandler: function (form) {
      var rows_selected = artist.column(0).checkboxes.selected();
      rows_selected.each(function (v) {
        $(form).append($('<input >').attr('type', 'hidden').attr('name', 'artist_permit_id[]').val(v)); });
      form[0].submit();
    }
  });

      $('div.toolbar').html($('#action-container'));

      $('input[name=bypass_payment][type=checkbox]').prop('checked', false);

      $('#chk-government').on('change', function(){
          if(this.checked) {
              $('#selectDepartment').removeClass('kt-hide');
              $('#selectDepartment #select-department').removeAttr('disabled', true);
          }else{
              $('#selectDepartment').addClass('kt-hide');
              $('#selectDepartment #select-department').attr('disabled', true);
              $('#selectDepartment #select-department').val('').trigger('change');
          }
      });

      var depselect = $('select#select-department');
      depselect.select2({
           minimumResultsForSearch: 'Infinity',
           maximumSelectionLength: 2,
           placeholder: 'Select Government Department',
           autoWidth: true,
           width: '100%',
           allowClear: true,
           tags: true
      });

  });

  function permitComment(){
    $('table#permit-comment-table').DataTable({
      ajax: '{{ route('admin.permit.comment.datatable', $permit->permit_id) }}',
      responsive: true,
      columns:[
      {data: 'name'},
      {data: 'comment'},
      {data: 'action'},
      {data: 'created_at'},
      ],
      columnDefs:[
      {targets:'_all', className: 'no-wrap'}
      ],
    });
  }

  function permitHistory() {
    $('table#table-permit-history').DataTable({
      ajax: {
        url: '{{ route('admin.artist_permit.history', $permit->permit_id) }}'
      },
      columnDefs: [
      {targets: '_all', className: 'no-wrap'}
      ],
      responsive: true,
      columns: [
         {data: 'rivision_number'},
         {data: 'reference_number'},
         {data: 'permit_number'},
         {data: 'artist_number'},
         {data: 'duration'},
         {data: 'issued_date'},
         {data: 'expired_date'},
         {data: 'request_type'},
         {data: 'permit_status'}
      ],
      createdRow: function(row, data, index){
        $('td:not(:first-child)', row).click(function(){location.href = data.link;});
      }
   });
  }

  function artistTable() {
     artist = $('table#artist-table').DataTable({
        dom: '<"toolbar pull-left">frt<"pull-left"i>p',
        ajax: {
           url: '{{ route('admin.artist_permit.applicationdetails.datatable', $permit->permit_id) }}'
        },
        responsive: true,
        columnDefs: [
           {targets: '_all', className: 'no-wrap'}
        ],
        columns: [  
           {data: 'person_code'},
           {
              render: function (type, data, full, meta) {
                 var url = '{{ url('/permit/artist') }}/' + full.artist_id;
                 return '<a class="underlined kt-font-dark kt-font-bold" href="' + full.artist_link + '">' + full.fullname + '</a>';
              }
           },
           {data: 'age'},
           {data: 'profession'},
           {data: 'nationality'},
           {data: 'artist_status'},
           {data: 'action'},
        ],
        createdRow: function (row, data, index) {

          $(row).click(function(){ location.href = data.show_link; });

        
           $('.btn-document', row).click(function(e){
            e.stopPropagation();
              documents(data);
              $('#document-modal').modal('show');
           });

           $('.btn-comment-modal', row).click(function (e) {
              e.stopPropagation();
              viewComment(data);
              $('#comment-modal').modal('show');
           });

         //   $(row).click(function () {
         //     
         //      if (!data.existing_permit) {
         //         location.href = data.show_link;
         //      } else {
								 // $('#existing-permit-alert').removeClass('d-none').find('.alert-text').html(data.existing_permit);
								 // $('#check-existing-permit-modal').find('a').attr('href', url);
								 // existingPermit(data);
         //        
         //      }
         //   });
        },
        initComplete: function (settings, json) {
           $('#artist-total').html(json.recordsTotal);
        }
     });
  }

  function existingPermit(data) {

     $('form#frm-existing-permit').find('a[href]').attr('href', '{{ url('/artist_permit/') }}/'+data.permit_id+'/application/'+data.artist_permit_id);

     $('form#frm-existing-permit').validate({
        rules: {
           comment: {
              required: true,
              minlength: 1,
              maxlength: 255
           }
        }
     });
     
     $.ajax({
				url: '{{ url('/artist_permit/') }}/'+data.permit_id+'/application/'+data.artist_permit_id+'/checklist',
				data: $('form#frm-existing-permit').serialize(),
				type: 'post',
				dataType: 'json'
		 }).done(function (response) {
				if(response){
				   artist.ajax().reload();
				}
     });
  }

  function submitAction() {
      $('select[name=action]').change(function () {
        if ($(this).val() == 'need approval') {
           $('#approver').removeClass('d-none');
           $('#chk-inspector').removeAttr('disabled', true).attr('checked', true);
           $('#-chk-manager').removeAttr('disabled', true).removeAttr('checked', true);
           $('#chk-government').removeAttr('disabled', true).removeAttr('checked', true);
        } else {
           $('#approver').addClass('d-none');
           $('#chk-inspector').attr('disabled', true).attr('checked', true);
           $('#-chk-manager').attr('disabled', true).removeAttr('checked', true);
           $('#chk-government').attr('disabled', true).removeAttr('checked', true);
        }
      });
  }

  function documents(data){
      $('#document-modal').on('shown.bs.modal', function(){
          $('table#table-document').DataTable({
              ajax:{ 
                  url: '{{ url('/artist_permit') }}/'+'{{ $permit->permit_id }}'+'/application/'+data.artist_permit_id+'/documentDatatable',
              },
              columnDefs:[
              {targets: [1, 2], className: 'no-wrap'}
              ],
              columns:[
              {data: 'document_name'},
              {data: 'issued_date'},
              {data: 'expired_date'},
              ]
          });
      });
  }

  function viewComment(data) {
     $('#comment-modal').on('shown.bs.modal', function () {

        $('button[type=reset]').trigger('click');
        $('table#table-comment').DataTable({
           ajax: {
              url: '{{ url('/artist_permit') }}/'+{{$permit->permit_id}}+'/application/'+data.artist_permit_id + '/comment/datatable'
           },
           columnDefs: [
              {targets: [1, 2], className: 'no-wrap'}
           ],
           columns: [
              {data: 'comment'},
              {data: 'commented_by'},
              {data: 'commented_on'}
           ]
        });
     });
  }

  function updateLock(){
      $.ajax({
         url: '{{ route('artist_permit.lock', $permit->permit_id) }}',
         type: 'post',
         success: function(){
            console.log('test lock');
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
