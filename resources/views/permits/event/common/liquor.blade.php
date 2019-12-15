{{-- <div class="modal fade" id="liquor_type_check" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Liquor Permit Type')}} <i class="fa fa-truck"></i>
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="changeIsLiquor()">
</button>
</div>
<div class="modal-body">

</div>
</div>
</div>
</div>
--}}

<div class="modal fade" id="liquor_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style=" overflow-y:auto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Liquor Details')}} <i
                        class="fa fa-glass-cheers"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="changeIsLiquor()">
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 form-group form-group-xs d-flex">
                    <label class="col-form-label"> {{__('Provided by venue')}}
                        ?</label>
                    {{-- <label class="kt-checkbox kt-checkbox--bold ml-2 pt-1">
                                <input type="checkbox" name="isTruck" id="isTruck">
                                <span></span>
                            </label> --}}
                    <div class="kt-radio-inline" style="margin: auto 5%;">
                        <label class="kt-radio ">
                            <input type="radio" name="isLiquorVenue" onclick="checkLiquorVenue(1)" value="1">
                            {{__('Yes')}}
                            <span></span>
                        </label>
                        <label class="kt-radio">
                            <input type="radio" name="isLiquorVenue" onclick="checkLiquorVenue(0)" value="0" checked>
                            {{__('No')}}
                            <span></span>
                        </label>
                    </div>
                </div>
                <form class="col-md-12" id="liquor_details_form" novalidate autocomplete="off">
                    <div class="row">
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Company Name')}} <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="l_company_name_en"
                                id="l_company_name_en" autocomplete="off" placeholder="company name">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Company Name - Ar')}} <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="l_company_name_ar"
                                id="l_company_name_ar" dir="rtl" autocomplete="off" placeholder="company name - Ar">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Purchase Receipt No')}} <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="purchase_receipt"
                                id="purchase_receipt" autocomplete="off" placeholder="{{__('Purchase Receipt No')}}">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Liquor Service')}} <span
                                    class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" name="liquor_service" id="liquor_service"
                                onchange="changeLiquorService()">
                                <option value="">{{__('Select')}}</option>
                                <option value="limited">{{__('Limited')}}</option>
                                <option value="unlimited">{{__('Unlimited')}}</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group form-group-xs" id="limited_types">
                            <label for="" class="col-form-label kt-font-bold">{{__('Types of Liquor')}} <span
                                    class="text-danger">*</span></label>
                            <textarea type="text" class="form-control form-control-sm" name="liquor_types"
                                id="liquor_types" autocomplete="off" placeholder="{{__('Types of Liquor')}}"></textarea>
                        </div>
                        <input type="hidden" id="event_liquor_id">
                    </div>
                </form>
                <form id="liquor_upload_form" class="col-md-12">
                    <div class="row col-md-12 justify-content-between kt-margin-b-15 kt-margin-t-15">
                        <h5 class="text-dark  text-underline kt-font-bold">{{__('Liquor Required Documents')}}
                        </h5>
                    </div>
                    <input type="hidden" id="liquor_document_count" value="{{count($liquor_req)}}">
                    @php
                    $i = 1;
                    @endphp
                    @foreach($liquor_req as $req)
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <label
                                class="kt-font-bold text--maroon">{{getLangId() == 1 ? ucwords($req->requirement_name) : $req->requirement_name_ar  }}
                                <span id="cnd_{{$i}}"></span>
                            </label>
                            <p for="" class="reqName">
                                {{getLangId() == 1 ? ucwords($req->requirement_description) : $req->requirement_description_ar}}
                            </p>
                        </div>
                        <input type="hidden" value="{{$req->requirement_id}}" id="liqour_req_id_{{$i}}">
                        <input type="hidden" value="{{$req->requirement_name}}" id="liqour_req_name_{{$i}}">
                        <div class="col-lg-4 col-sm-12">
                            <label style="visibility:hidden">hidden</label>
                            <div id="liquoruploader_{{$i}}">{{__('Upload')}}
                            </div>
                        </div>
                        <input type="hidden" id="datesRequiredCheck_{{$i}}" value="{{$req->dates_required}}">
                        @if($req->dates_required == 1)
                        <div class="col-lg-2 col-sm-12">
                            <label for="" class="text--maroon kt-font-bold"
                                title="Issue Date">{{__('Issue Date')}}</label>
                            <input type="text" class="form-control form-control-sm date-picker"
                                name="liquor_doc_issue_date_{{$i}}" data-date-end-date="0d"
                                id="liquor_doc_issue_date_{{$i}}" placeholder="DD-MM-YYYY" />
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <label for="" class="text--maroon kt-font-bold"
                                title="Expiry Date">{{__('Expiry Date')}}</label>
                            <input type="text" class="form-control form-control-sm date-picker"
                                name="liquor_doc_exp_date_{{$i}}" id="liquor_doc_exp_date_{{$i}}"
                                placeholder="DD-MM-YYYY" />
                        </div>
                        @endif
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </form>
                <form id="liquor_provided_form" autocomplete="off">
                    <div class="col-md-4 form-group form-group-xs">
                        <label for="" class="col-form-label kt-font-bold">{{__('Liquor Permit No')}} <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="liquor_permit_no"
                            id="liquor_permit_no" autocomplete="off" placeholder="{{__('Liquor Permit No')}}">
                    </div>
                </form>
                <div class="kt-pull-right kt-margin-t-10">
                    <button class="btn btn-sm btn--maroon" id="update_lq">{{__('Update')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>