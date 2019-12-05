<div class="modal fade" id="edit_liquor_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style=" overflow-y:auto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Edit Liquor Details')}} <i
                        class="fa fa-glass-cheers"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="changeIsLiquor()">
                </button>
            </div>
            <div class="modal-body">
                <form class="col-md-12" id="liquor_details_form" novalidate autocomplete="off">
                    <div class="row">
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Company Name')}}</label>
                            <input type="text" class="form-control form-control-sm" name="e_company_name_en"
                                id="e_company_name_en" autocomplete="off" placeholder="company name">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Company Name - Ar')}}</label>
                            <input type="text" class="form-control form-control-sm" name="e_company_name_ar"
                                id="e_company_name_ar" autocomplete="off" placeholder="company name - Ar">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('License No')}}</label>
                            <input type="text" class="form-control form-control-sm" name="e_license_no"
                                id="e_license_no" autocomplete="off" placeholder="license no">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('License Issue')}} </label>
                            <input type="text" class="form-control form-control-sm date-picker" name="e_l_issue_date"
                                id="e_l_issue_date" autocomplete="off" placeholder="DD-MM-YYYY">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('License Expiry')}} </label>
                            <input type="text" class="form-control form-control-sm date-picker" name="e_l_expiry_date"
                                id="e_l_expiry_date" autocomplete="off" placeholder="DD-MM-YYYY">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Emirates')}} </label>
                            <select name="e_l_emirates[]" id="e_l_emirates" multiple
                                class="form-control form-control-sm">
                                <option value="">{{__('Select')}}</option>
                                @foreach($emirates as $em)
                                <option value="{{$em->id}}">{{$em->name_en}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Trade License No')}}</label>
                            <input type="text" class="form-control form-control-sm" name="trade_license_no"
                                id="trade_license_no" autocomplete="off" placeholder="Trade license no">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('TL Issue')}} </label>
                            <input type="text" class="form-control form-control-sm date-picker" name="tl_issue_date"
                                id="tl_issue_date" autocomplete="off" placeholder="DD-MM-YYYY">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('TL Expiry')}} </label>
                            <input type="text" class="form-control form-control-sm date-picker" name="tl_expiry_date"
                                id="tl_expiry_date" autocomplete="off" placeholder="DD-MM-YYYY">
                        </div>
                    </div>
                </form>
                <div class="row col-md-12 justify-content-between kt-margin-b-15 kt-margin-t-15">
                    <h5 class="text-dark  text-underline kt-font-bold">{{__('Liquor Required Documents')}}
                    </h5>
                    {{-- <div class="kt-pull-right">
                        <button class="btn btn-sm btn-dark" onclick="liquor_add_new_doc()"> <i class="la la-plus"></i>
                            {{__('Add Document')}}</button>
                </div> --}}
            </div>
            <form id="liquor_upload_form" class="col-md-12">
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
                        <label for="" class="text--maroon kt-font-bold" title="Issue Date">{{__('Issue Date')}}</label>
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
            <form id="liquor_additional_doc" class="col-md-12" novalidate autocomplete="off">
            </form>
            <div class="kt-pull-right kt-margin-t-10">
                <button class="btn btn-sm btn--maroon" id="update_lq">{{__('Update')}}</button>
            </div>
        </div>
    </div>
</div>
</div>