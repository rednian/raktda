@extends('layouts.admin.admin-app')
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile border">
    <div class="kt-portlet__head kt-portlet__head--sm">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('Artist Permit') }} - {{$permit->reference_number}}</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a href="{{ URL::signedRoute('admin.artist_permit.index') }}" class="btn btn-sm btn-outline-secondary btn-elevate kt-font-transform-u">
                <i class="la la-arrow-left"></i>{{ __('BACK') }}
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
                    @if ($permit->permit_status == 'active' || $permit->permit_status == 'expired')
                        {{-- <div class="dropdown-divider"></div> --}}
                        <a target="_blank" class="dropdown-item kt-font-trasnform-u" href="{{ URL::signedRoute('admin.artist_permit.download', $permit->permit_id) }}"><i class="la la-download"></i> {{ __('Download') }}</a>
                    @endif
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
                <h6 class="kt-font-dark kt-font-bold kt-margin-b-15 kt-font-transform-u">{{ __('Permit Details') }}</h6>
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
                     {{ __(ucfirst($permit->term).' Term Permit') }}
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
                       @if ($permit->number)
                          <tr>
                             <td>Permit Number :</td>
                             <td>{{ $permit->permit_number ? $permit->permit_number : null   }}</td>
                          </tr>
                       @endif
                       <tr>
                          <td>{{ __('Request Type') }} :</td>
                          <td>{{ ucfirst($permit->request_type) }} Application</td>
                       </tr>
                       <tr>
                          <td>{{ __('Permit Status') }} :</td>
                          <td>
                             {!! permitStatus($permit->permit_status) !!}
                          </td>
                       </tr>

                       @if ($permit->approved_by || $permit->permit_status == 'approved-unpaid' )
                        <tr>
                            <td>{{ __('Approved On') }} :</td>
                            <td><span title="{{$permit->approved_date->format('l h:i A | d-F-Y')}}" class="text-underline">{{humanDate($permit->approved_date)}}</span></td>
                        </tr>
                        <tr>
                            <td>{{ __('Approved By') }} :</td>
                            @php
                                $name = Auth::user()->LanguageId == 1 ? ucwords($permit->approvedBy->NameEn) : ucwords($permit->approvedBy->NameAr); 
                                $role = Auth::user()->LanguageId == 1 ? ucwords($permit->approvedBy->roles()->first()->NameEn) : ucwords($permit->approvedBy->roles()->first()->NameAr); 
                            @endphp
                            <td>{!! profileName($name, $role) !!}</td>
                        </tr>
                       @endif

                       @if ($permit->cancel_by)
                        <tr>
                            <td>{{ __('Cancelled On') }} :</td>
                            <td><span title="{{$permit->cancel_date->format('l h:i A | d-F-Y')}}" class="text-underline">{{humanDate($permit->cancel_date)}}</span></td>
                        </tr>
                        <tr>
                            <td>{{ __('Cancelled By') }} :</td>
                            @php
                                $name = Auth::user()->LanguageId == 1 ? ucwords($permit->cancelBy->NameEn) : ucwords($permit->cancelBy->NameAr); 
                                $role = Auth::user()->LanguageId == 1 ? ucwords($permit->cancelBy->roles()->first()->NameEn) : ucwords($permit->cancelBy->roles()->first()->NameAr); 
                            @endphp
                            <td>{!! profileName($name, $role) !!}</td>
                        </tr>
                        <tr>
                           <td>{{ __('Cancel Reason') }} :</td>
                           <td>{{ ucfirst($permit->cancel_reason) }}</td>
                        </tr>
                       @endif
                     
                       <tr>
                          <td>{{ __('Work Location') }} :</td>
                          <td>{{ ucwords($permit->work_location) }}</td>
                       </tr>
                    </table>
                 </div>
              </section>
            
                <div class="kt-widget__content border-top kt-margin-t-5">
                  <div class="kt-widget__details">
                    <span class="kt-widget__subtitle kt-padding-b-5 kt-font-transform-u">{{__('Revision Number')}}</span>
                    <span class="kt-widget__value">{{str_pad($permit->rivision_number, 3, 0, STR_PAD_LEFT)}}</span>
                  </div>
                  <div class="kt-widget__details">
                    <span class="kt-widget__subtitle kt-padding-b-5 kt-font-transform-u">{{__('Connected to an Event ?')}}</span>
                    <span class="kt-widget__value">
                      @if ($permit->event()->exists())
                        <a href="{{URL::signedRoute('admin.event.show', $permit->event->event_id)}}" class="btn btn-sm btn-secondary">{{__('YES')}}</a>
                        @else
                        {{__('NO')}}
                      @endif
                    </span>
                  </div>
                  <div class="kt-widget__details">
                    <span class="kt-widget__subtitle kt-padding-b-5 kt-font-transform-u">{{__('Artist')}}</span>
                    <div class="kt-badge kt-badge__pics">
                      @if ($permit->artistPermit()->exists())
                        @foreach ($permit->artistPermit as $number => $artist_permit)
                          @if ($number < 6)
                            <a href="{{ URL::signedRoute('admin.artist.show', $artist_permit->artist->artist_id) }}" class="kt-badge__pic" data-original-title="{{ ucwords($artist_permit->fullname) }}" data-toggle="kt-tooltip" data-skin="brand" data-placement="top">
                              <img src="{{ asset('storage/'.$artist_permit->thumbnail) }}" alt="image">
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


                  <h6 class="kt-font-dark kt-font-bold kt-font-transform-u kt-margin-b-10 kt-margin-t-20">{{ __('Contact Person Details') }}</h6>
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

        @if ($permit->permit_status == 'active' || $permit->permit_status == 'approved-unpaid')
        <section class="row kt-margin-t-5">
            <div class="col-md-12">
                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                    <div class="card border">
                        <div class="card-header " id="headingOne6">
                            <div class="card-title kt-padding-b-10 kt-padding-t-10" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                                 <h6 class="kt-font-dark kt-font-transform-u">{{__('Cancel Permit')}}</h6>
                            </div>
                        </div>
                        <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6">
                            <div class="card-body">
                              <form name="frm_cancel" action="{{ route('admin.artist_permit.cancelPermit', $permit->permit_id) }}" method="post">
                                @csrf
                                  <div class="form-group row form-group-sm">
                                      <div class="col-sm-6">
                                          <label for="">{{__('Remarks')}} <span class="text-danger">*</span></label>
                                          <textarea maxlength="255" required dir="ltr" autocomplete="off" autofocus name="comment" rows="3" class="form-control form-control-sm"></textarea>
                                      </div>
                                      <div class="col-sm-6">
                                          <label for="">{{__('Remarks (AR)')}} <span class="text-danger">*</span></label>
                                          <textarea maxlength="255" required dir="rtl" autocomplete="off" name="comment_ar" rows="3" class="form-control form-control-sm"></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <button type="submit" name="action" value="cancelled" class="btn btn-sm btn-maroon">{{__('SUBMIT')}}</button>
                                  </div>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        
        @if(Auth::user()->roles()->whereIn('roles.role_id', [4,5,6])->exists())
        @if($permit->comment()->where('action', '!=', 'pending')->where('role_id', Auth::user()->roles()->first()->role_id)->latest()->first())
        @php
            $action = $permit->comment()->where('action', '!=', 'pending')->where('role_id', Auth::user()->roles()->first()->role_id)->latest()->first();
        @endphp
        <div class="alert alert-outline-danger fade show" role="alert" style="margin-bottom:0px">
            <div class="alert-text">
              <h6 class="alert-heading text-danger kt-font-transform-u">{{ __('Last Action Taken') }}</h6>
              <table class="table table-hover table-bordered table-striped">
                <thead>
                  <tr>
                    <th>{{ __('Checked By') }}</th>
                    <th>{{ __('Checked Date') }}</th>
                    <th>{{ __('Remarks') }}</th>
                    <th class="text-right">{{ __('Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $action->user->NameEn }}</td>
                    <td>{{ $action->updated_at }}</td>
                    <td>
                        {{ $action->comment }}
                        @if($action->exempt_payment)
                          <br><span class="kt-badge kt-badge--warning kt-badge--inline">{{ __('Exempted for Payment') }}</span>
                        @endif
                    </td>
                    <td class="text-right">{!! permitStatus($action->action) !!}</td>
                  </tr>
                </tbody>
              </table>
               <a href="#tabDetails" onclick="$('ul.nav a[href=\'#kt_portlet_base_demo_1_2_tab_content\']').tab('show');" class="btn btn-sm btn-warning btn-elevate kt-font-transform-u">{{ __('See History') }}
               </a>
            </div>
        </div>
        @endif
        @endif

        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample5">
            <div class="card kt-hide">
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
            <ul id="tabDetails" class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_1_tab_content" role="tab" aria-selected="true">{{ __('ARTIST LIST') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_2_tab_content" role="tab" aria-selected="false">
                       {{ __('ACTION HISTORY') }}
                    </a>
                </li>
                @if(!Auth::user()->roles()->whereIn('roles.role_id', [4,5,6])->exists())
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_3_tab_content" role="tab" aria-selected="false">
                                    {{ __('PERMIT HISTORY') }}
                                    <span class="kt-badge kt-badge--outline kt-badge--info">{{$rivision}}</span>
                                </a>
                </li>
                @endif
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
                            @if(!Auth::user()->roles()->whereIn('roles.role_id', [4,5,6])->exists())
                            <div class="tab-pane" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">
                               <table class="table table-striped table-borderless table-hover" id="table-permit-history">
                                 <thead>
                                   <tr>
                                     <th>{{ __('RIVISION NO.') }}</th>
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

       $('form[name=frm_cancel]').validate();

       $('form[name=frm_cancel]').submit(function(e){
            e.preventDefault();
            // bootbox.confirm({
            //     'Are you sure you want to cancel this permit? '
            // }, function(result){
            //     if(result){
            //         alert();
            //     }
            // });
       });

       });

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
