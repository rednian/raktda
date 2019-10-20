@extends('layouts.admin.admin-app')
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile border">
    <div class="kt-portlet__head kt-portlet__head--sm">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-dark">{{ ucfirst($event->name_en) }} - DETAILS</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a href="{{ route('admin.event.index') }}#{{ $tab }}" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u">
                 <i class="la la-arrow-left"></i>
                 Back to permit list
            </a>
            <div class="dropdown dropdown-inline">
                 <button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-more"></i>
                 </button>
                 <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                        <a class="dropdown-item kt-font-trasnform-u" href="#">Cancel Permit</a>
                        @if ($tab != 'processing-permit')
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item kt-font-trasnform-u" href="#"><i class="la la-download"></i> download</a>
                        @endif
                 </div>
            </div>
         </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-5">
        <section class="row kt-margin-b-5">
            <div class="col-md-6">
                <section class="border kt-padding-5">
                    <h6 class="kt-font-dark">Event Information</h6>
                    <table class="table table-sm table-hover table-borderless">
                        <tr>
                            <td width="27%">Permit Status : </td>
                            <td class="kt-font-dark">{!! permitStatus($event->status) !!}</td>
                        </tr>
                        <tr>
                            <td>Reference No. </td>
                            <td class="kt-font-dark">{{ $event->reference_number }}</td>
                        </tr>
                        @if ($event->status == 'active' || $event->status == 'expired')
                        <tr>
                            <td>Permit Number. </td>
                             <td class="kt-font-dark">{{ $event->permit_number }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Event Name: </td>
                            <td class="kt-font-dark">{{  ucfirst($event->name_en) }}</td>
                        </tr>
                        
                        <tr>
                            <td>Applied Date: </td>
                            <td class="kt-font-dark">{{ $event->created_at->format('d-M-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Permit Duration : </td>
                             <td class="kt-font-dark">{{ $event->created_at->format('d-M-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Venue : </td>
                             <td class="kt-font-dark">{{ $event->venue_en }}</td>
                        </tr>
                        <tr>
                            <td>Address : </td>
                             <td class="kt-font-dark">{{ $event->address.' '.$event->area->area_en.' '.$event->emirate->name_en.' '.$event->country->name_en }}</td>
                        </tr>
                    </table>
                </section>
            </div>
            <div class="col-md-6">
                <section class="border kt-padding-5">
                    <h6 class="kt-font-dark">Permit Owner Information</h6>
                    <table class="table table-sm table-hover table-borderless">
                        <tr>
                            <td width="35%">Name :</td>
                            <td>{{ ucwords($event->owner->NameEn) }}</td>
                        </tr>
                        <tr>
                            <td>Owner Type: </td>
                            <td>{{ ucwords(userType($event->owner->type)) }}</td>
                        </tr>
                        <tr>
                            <td>Designation :</td>
                            <td>{{  ucwords($event->owner->designation) }}</td>
                        </tr>
                        <tr>
                            <td>Mobile :</td>
                             <td>{{ $event->owner->mobile_number }}</td>
                        </tr>
                        <tr>
                            <td>Email :</td>
                             <td>{{ $event->owner->email }}</td>
                        </tr>
                    </table>
                     <h6 class="kt-font-dark">Establishment Information</h6>
                     <table class="table table-borderless table-sm">
                         <tr>
                             <td width="35%">Establishment Name: </td>
                         </tr>
                         @if ($event->owner->type == 1)
                            <tr>
                                <td>Trade License No. :</td>
                                <td>{{ $event->owner->company->company_trade_license }}</td>
                            </tr> 
                         @endif
                         <tr>
                            <td>Address:</td>
                             <td>{{ $event->owner->company->company_address.' '.$event->owner->company->city.' '.$event->owner->company->country }}</td>
                         </tr>
                     </table>
                </section>
            </div>
        </section>
        <div class="accordion accordion-solid accordion-toggle-plus" id="accordion-approver">
            <div class="card">
                <div class="card-header" id="headingOne-approver">
                    <div class="card-title kt-padding-t-10 kt-padding-b-10 kt-margin-b-5" data-toggle="collapse" data-target="#collapse-approver"
                        aria-expanded="true" aria-controls="collapse-approver">
                        <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder">Checked & Approval History</h6>
                    </div>
                </div>
                <div id="collapse-approver" class="collapse show" aria-labelledby="headingOne-approver" data-parent="#accordion-approver">
                    <div class="card-body border kt-padding-r-15 kt-padding-l-15 kt-padding-t-10 kt-padding-b-10">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Checked By</th>
                                    <th>Remarks</th>
                                    <th>User Group</th>
                                    <th>Checked Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($event->approve()->exists())
                                @foreach ($event->approve()->orderBy('updated_at')->get() as $approve)
                                    <tr>
                                        <td>{{ ucwords($approve->user->NameEn) }}</td>
                                        <td>{{ ($approve->comment->comment) }}</td>
                                        <td>{{ ucwords($approve->role->NameEn) }}</td>
                                        <td>{{ $approve->checked_at ? $approve->checked_at->format('d-M-Y') : null }}</td>
                                        <td>{{ $approve->status }}</td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>
@endsection