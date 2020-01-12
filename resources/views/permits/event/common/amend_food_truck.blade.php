<div class="modal fade" id="edit_one_food_truck" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style=" overflow-y:auto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_truck_title">{{__('Edit Food Truck')}}
                </h5>
                <h5 class="modal-title" id="add_truck_title">{{__('Add Food Truck')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-outline-danger fade show" role="alert">
                    <div class="alert-icon">
                        <i class="flaticon-questions-circular-button"></i>
                    </div>
                    <div class="alert-text">{{__('If you Add or Update Food Truck Details Permit will get Amended')}}
                    </div>
                </div>
                <form class="col-md-12" id="truck_details_form">
                    <div class="row">
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Establishment Name')}}</label>
                            <input type="text" class="form-control form-control-sm" name="company_name_en"
                                id="company_name_en" autocomplete="off">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Establishment Name (AR)')}}</label>
                            <input type="text" class="form-control form-control-sm" name="company_name_ar"
                                id="company_name_ar" autocomplete="off">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Food Services')}}</label>
                            <textarea class="form-control form-control-sm" name="food_type" id="food_type"
                                autocomplete="off" placeholder="{{__('Food Services')}}" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Traffic Plate No')}}</label>
                            <input type="text" class="form-control form-control-sm" name="plate_no" id="plate_no"
                                autocomplete="off" placeholder="{{__('Traffic Plate No')}}">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Vehicle Registration Issue Date')}}
                            </label>
                            <input type="text" class="form-control form-control-sm date-picker" name="regis_issue_date"
                                data-date-end-date="+0d" id="regis_issue_date" autocomplete="off"
                                placeholder="DD-MM-YYYY">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Vehicle Registration Issue Date')}}
                            </label>
                            <input type="text" class="form-control form-control-sm date-picker" name="regis_expiry_date"
                                data-date-start-date="+0d" id="regis_expiry_date" autocomplete="off"
                                placeholder="DD-MM-YYYY">
                        </div>
                        <input type="hidden" id="this_event_truck_id">
                    </div>
                </form>
                <div class="row col-md-12 justify-content-between kt-margin-b-15 kt-margin-t-15">
                    <h5 class="text-dark  text-underline kt-font-bold">{{__('Food Truck Required Documents')}}
                    </h5>
                </div>
                <form id="truck_upload_form" class="col-md-12">
                    <input type="hidden" id="truck_document_count" value="{{count($truck_req)}}">
                    @php
                    $i = 1;
                    @endphp
                    @foreach($truck_req as $req)
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
                        <input type="hidden" value="{{$req->requirement_id}}" id="truck_req_id_{{$i}}">
                        <input type="hidden" value="{{$req->requirement_name}}" id="truck_req_name_{{$i}}">
                        <div class="col-lg-4 col-sm-12">
                            <label style="visibility:hidden">hidden</label>
                            <div id="truckuploader_{{$i}}">{{__('Upload')}}
                            </div>
                        </div>
                        <input type="hidden" id="datesRequiredCheck_{{$i}}" value="{{$req->dates_required}}">
                        @if($req->dates_required == 1)
                        <div class="col-lg-2 col-sm-12">
                            <label for="" class="text--maroon kt-font-bold"
                                title="Issue Date">{{__('Issued Date')}}</label>
                            <input type="text" class="form-control form-control-sm date-picker"
                                name="truck_doc_issue_date_{{$i}}" data-date-end-date="0d"
                                id="truck_doc_issue_date_{{$i}}" placeholder="DD-MM-YYYY" />
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <label for="" class="text--maroon kt-font-bold"
                                title="Expiry Date">{{__('Expiry Date')}}</label>
                            <input type="text" class="form-control form-control-sm date-picker"
                                name="truck_doc_exp_date_{{$i}}" id="truck_doc_exp_date_{{$i}}"
                                placeholder="DD-MM-YYYY" />
                        </div>
                        @endif
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </form>
                <div class="d-flex justify-content-between kt-margin-t-10 pull-right">
                    <button class="btn btn-sm btn--maroon" id="update_this_td">{{__('Update')}}</button>
                    <button class="btn btn-sm btn--maroon" id="add_new_td">{{__('Add')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>