@extends('layouts.admin.admin-app')
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile border">
    <div class="kt-portlet__head kt-portlet__head--sm">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('Artist Permit') }}</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a href="{{ URL::signedRoute('admin.artist_permit.index') }}" class="btn btn-sm btn-outline-secondary btn-elevate kt-font-transform-u">
                <i class="la la-arrow-left"></i>{{ __('BACK') }}
            </a>
            <div class="dropdown dropdown-inline">
                <button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="flaticon-more"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                    <a class="dropdown-item kt-font-trasnform-u" href="{{ URL::signedRoute('admin.company.show', $permit->owner->company->company_id) }}">
                        {{ __('Establishment Details') }}
                    </a>
                    @if ($permit->permit_status == 'active' || $permit->permit_status == 'expired')
                        {{-- <div class="dropdown-divider"></div> --}}
                        <a target="_blank" class="dropdown-item kt-font-trasnform-u" href="{{ route('admin.artist_permit.download', $permit->permit_id) }}"><i class="la la-download"></i> {{ __('Download') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-5">
        @if ($permit->event()->count() > 0)
        <a href="{{ route('admin.event.show', $permit->event->event_id) }}">
          <div class="alert alert-outline-danger alert-bold kt-margin-t-10 kt-margin-b-10" role="alert">
            <div class="alert-text">This permit is connected to <span class="text-success kt-font-bold kt-font-transform-u">{{ $permit->event->name_en }}</span> event with reference number <span class="kt-font-danger">{{ $permit->event->reference_number }}</span>
              {{-- <span class="btn btn-maroon kt-font-transform-u btn-sm">Event Details <span class="la la-arrow-right"></span></span> --}}
            </div>
          </div>
          </a>
        @endif
        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample5">
            <div class="card">
                <div class="card-header" id="headingOne5">
                    <div class="card-title kt-padding-t-10 kt-padding-b-10 kt-margin-b-5" data-toggle="collapse" data-target="#collapseOne5" aria-expanded="true" aria-controls="collapseOne5">
                        <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder">{{ __('BASIC INFORMATION') }}</h6>
                    </div>
                </div>
                <div id="collapseOne5" class="collapse show" aria-labelledby="headingOne5" data-parent="#accordionExample5">
                    <div class="card-body border kt-padding-r-15 kt-padding-l-15 kt-padding-t-10 kt-padding-b-10">
                        @include('admin.artist_permit.includes.company-information')
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_1_tab_content" role="tab" aria-selected="true">{{ __('ARTIST LIST') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_2_tab_content" role="tab" aria-selected="false">
                       {{ __('CHECKED HISTORY') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_3_tab_content" role="tab" aria-selected="false">
                                    {{ __('PERMIT HISTORY') }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_portlet_base_demo_1_1_tab_content" role="tabpanel">
                                <table class="table table-hover border table-borderless table-striped table-sm" id="artist-table">
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
                            <div class="tab-pane" id="kt_portlet_base_demo_1_2_tab_content" role="tabpanel">

                                @if ($permit->comment()->count() > 0)
                                 <div class="card">
                                    <div class="card-header" id="headingThree5">
                                         <div class="card-title kt-padding-t-10 kt-padding-b-10 kt-margin-b-5" data-toggle="collapse"
                                                    data-target="#collapseThree5" aria-expanded="true" aria-controls="collapseThree5">
                                                <h6 class="kt-font-dark kt-font-transform-u">{{ __('CHECKED HISTORY') }}</h6>
                                         </div>
                                    </div>
                                    <div id="collapseThree5" class="collapse show" aria-labelledby="headingThree5" data-parent="#accordionExample5">
                                     <div class="card-body">
                                        <table class=" border table-striped table table-borderless table-hover table-sm">
                                             <thead>
                                                 <tr>
                                                    <th>{{ __('CHECKED BY') }}</th>
                                                    <th>{{ __('REMARKS') }}</th>
                                                    <th>{{ __('CHECKED DATE') }}</th>
                                                    <th>{{ __('ACTION TAKEN') }}</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                @foreach($permit->comment()->doesntHave('artistPermitComment')->orderBy('created_at', 'desc')->get() as $comment)
                                                    <tr>
                                                        <td>
                                                            <div class="kt-user-card-v2">
                                                                <div class="kt-user-card-v2__pic">
                                                                    @php
                                                                    $name = explode(' ', $comment->user->NameEn);
                                                                    @endphp
                                                                    <div class="kt-badge kt-badge--xl kt-badge--success"><span>{{ strtoupper(substr($name[0], 0, 1)) }}</span></div>
                                                                </div>
                                                                <div class="kt-user-card-v2__details">
                                                                    <span class="kt-user-card-v2__name">{{ ucwords($comment->user->NameEn) }}</span>
                                                                    <a href="#" class="kt-user-card-v2__email kt-link">{{ $comment->role_id != 6 ? ucfirst($comment->role->NameEn) : (Auth::user()->LanguageId == 1 ? ucwords($comment->government->government_name_en) : $comment->government->government_name_ar) }}</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ ucfirst($comment->comment) }}
                                                            @if($comment->exempt_payment)
                                                              <br><span class="kt-badge kt-badge--warning kt-badge--inline">Exempted for Payment</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $comment->created_at->format('d-M-Y') }}</td>
                                                        <td>{{ ucfirst($comment->action) }}</td>
                                                    </tr>
                                                @endforeach
                                             </tbody>
                                        </table>
                                     </div>
                                    </div>
                                 </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">
                               <table class="table table-striped table-borderless table-sm table-hover border" id="table-permit-history">
                                 <thead>
                                 <tr>
                                        <th>{{ __('APPLIED DATE') }}</th>
                                        <th>{{ __('ISSUED DATE') }}</th>
                                        <th>{{ __('EXPIRY DATE') }}</th>
                                        <th>{{ __('NO. OF ARTIST') }}</th>
                                        <th>{{ __('REQUEST TYPE') }}</th>
                                        <th>{{ __('PERMIT STATUS') }}</th>
                                        <th>{{ __('ACTION') }}</th>
                                 </tr>
                                 </thead>
                               </table>
                            </div>
                        </div>
                        
                      
				 </div>
				  
	 
</div>
		<?php
		$artist_number = $permit->artistpermit()->count();
		$check = $permit->artistpermit;
		?>
    @include('admin.artist_permit.includes.comment-modal', ['permit' => $permit])
    @include('admin.artist_permit.includes.document')
    @include('admin.artist_permit.includes.check-existing permit')
@endsection
@section('script')
<script type="text/javascript">
    var artist = {};
    $(document).ready(function () {
        artistTable();
       permitHistory();

       });

    function permitHistory() {
       $('table#table-permit-history').DataTable({
          ajax: {
             url: '{{ route('admin.artist_permit.history', $permit->permit_id) }}'
          },
          columnDefs: [
             {targets: [5, 6], className: 'no-wrap'}
          ],
          columns: [
             {data: 'applied_date'},
             {data: 'issued_date'},
             {data: 'expired_date'},
             {data: 'artist_number'},
             {
                render: function (row, type, full, meta) {
                   return full.request_type + ' Application';
                }
             },
             {data: 'permit_status'},
             {data: 'action'}
          ]
       });
    }

    function artistTable() {
       artist = $('table#artist-table').DataTable({
          dom: '<"toolbar pull-left">frt<"pull-left"i>p',
          ajax: {
             url: '{{ route('admin.artist_permit.applicationdetails.datatable', $permit->permit_id) }}'
          },
          columnDefs: [
             {targets: [0, 2, 5, 6], className: 'no-wrap'}
          ],
          columns: [
             {data: 'person_code'},
             {
                render: function (type, data, full, meta) {
                   var url = '{{ url('/permit/artist') }}/' + full.artist_id;
                   return '<a class="underlined kt-font-dark kt-font-bold" href="' + full.artist_link + '">' + full.fullname + '</a>';
                }
             },
             {
                render: function (type, data, full, meta) {
                   return '<span title="" data-original-title="Tooltip title" data-placement="top" data-container="body" data-toggle="kt-tooltip" >' + full.age + '</span>';
                }
             },
             {data: 'profession'},
             {data: 'nationality'},
             {data: 'artist_status'},
             {
                render: function (type, data, full, meta) {
                   return '<button class="btn btn-secondary btn-sm btn-elevate btn-document kt-margin-r-5">Document</button><button class="btn btn-secondary btn-sm btn-elevate btn-comment-modal">Comment</button>';
                }
             }
          ],
          createdRow: function (row, data, index) {
             $('td input[type=checkbox]', row).click(function (e) {
                e.stopPropagation();
             });

             $('.btn-document', row).click(function(){
                documents(data);
                $('#document-modal').modal('show');
             });

             $('.btn-comment-modal', row).click(function (e) {
                e.stopPropagation();
                viewComment(data);
                $('#comment-modal').modal('show');
             });

           
          },
          initComplete: function (settings, json) {
             $('#artist-total').html(json.recordsTotal);
          }
       });
    }

    function documents(data){
        $('#document-modal').on('shown.bs.modal', function(){
            $('table#table-document').DataTable({
                ajax:{ 
                    url: '{{ url('/artist_permit') }}/'+'{{ $permit->permit_id }}'+'/application/'+data.artist_permit_id+'/documentDatatable',
                },
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
</script>
@endsection
