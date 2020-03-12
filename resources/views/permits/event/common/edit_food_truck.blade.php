<div class="modal fade" id="edit_food_truck" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style=" overflow-y:auto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Food Truck List')}}&emsp;<i
                        class="fa fa-truck"></i>
                </h5>
                <div class="d-flex" style="position: absolute;{{ getlangId() == 1 ? 'right:5rem'  : 'left:5rem' }}">
                    <button class="btn btn-sm btn--yellow" id="add_new_truck"><i class="fa fa-plus"></i>
                        {{__('Add New')}}</button>
                    <button class="btn btn-sm btn--maroon ml-2" data-dismiss="modal" onclick="changeIsTruck()"><i
                            class="fa fa-check"></i> {{__('Update')}}</button>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="changeIsTruck()">
                </button>
            </div>
            <div class="modal-body">
                @if(isset($from) && $from == 'amend')
                <div class="alert alert-outline-danger fade show kt-padding-t-0 kt-padding-b-0" role="alert">
                    <div class="alert-icon">
                        <i class="flaticon-questions-circular-button"></i>
                    </div>
                    <div class="alert-text">{{__('If you Add or Update Food Truck Details, Permit will get Amended')}}
                    </div>
                </div>
                @endif
                @include('permits.event.common.food-truck-fee')
                <div class="table-responsive">
                    <table class="table table-borderless border table-striped">
                        <thead class="no-wrap">
                            <th>#</th>
                            <th>{{__('Establishment Name (EN)')}}</th>
                            <th>{{__('Establishment Name (AR)')}}</th>
                            <th>{{__('Traffic Plate No')}}</th>
                            <th>{{__('Types of provided F&B')}}</th>
                            <th></th>
                        </thead>
                        <tbody id="food_truck_list">
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="disp_mess" class="text-center"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_one_food_truck" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="overflow-y:auto;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_truck_title">{{__('Edit Food Truck')}}
                </h5>
                <h5 class="modal-title" id="add_truck_title">{{__('Add Food Truck')}}
                </h5>
                <button class="btn btn-sm btn--yellow" onclick="go_back_truck_list()"><i class="la la-arrow-left"></i>
                    {{__('BACK')}}</button>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="changeIsTruck()">
                </button> --}}
            </div>
            <div class="modal-body">
                <form class="col-md-12" id="truck_details_form">
                    <div class="row">
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Establishment Name (EN)')}}
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="company_name_en"
                                id="company_name_en" dir="ltr" autocomplete="off" />
                        </div>
                        <div class=" col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Establishment Name (AR)')}}
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="company_name_ar"
                                id="company_name_ar" dir="rtl" autocomplete="off" />
                        </div>
                        <div class=" col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Types of provided F&B')}} <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control form-control-sm" name="food_type" id="food_type"
                                autocomplete="off" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Traffic Plate No')}} <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="plate_no" id="plate_no"
                                autocomplete="off" dir="ltr" />
                        </div>
                        <div class=" col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Vehicle Registration Issue Date')}}
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm " name="regis_issue_date"
                                data-date-end-date="+0d" id="regis_issue_date" autocomplete="off"
                                placeholder="DD-MM-YYYY">
                        </div>
                        <div class="col-md-4 form-group form-group-xs">
                            <label for="" class="col-form-label kt-font-bold">{{__('Vehicle Registration Expiry Date')}}
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm " name="regis_expiry_date"
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
                    @include('permits.components.requirements')
                    <input type="hidden" id="truck_document_count" value="{{count($truck_req)}}">
                    @php
                    $i = 1;
                    @endphp
                    @foreach($truck_req as $req)
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <label
                                class="kt-font-bold text--maroon">{{getLangId() == 1 ? ucfirst($req->requirement_name) : $req->requirement_name_ar  }}
                                <span id="cnd_{{$i}}"></span>
                                <span class="text-danger">*</span>
                            </label>
                            <p for="" class="reqName">
                                {{getLangId() == 1 ? ucfirst($req->requirement_description) : $req->requirement_description_ar}}
                            </p>
                        </div>
                        <input type="hidden" value="{{$req->requirement_id}}" id="truck_req_id_{{$i}}">
                        <input type="hidden" value="{{$req->requirement_name}}" id="truck_req_name_{{$i}}">
                        <div class="col-lg-4 col-sm-12">
                            <label style="visibility:hidden">hidden</label>
                            <div id="truckuploader_{{$i}}">{{__('Upload')}}
                            </div>
                        </div>
                        {{-- <input type="hidden" id="truckdatesRequiredCheck_{{$i}}" value="{{$req->dates_required}}">
                        --}}
                        {{-- @if($req->dates_required == 1)
                        <div class="col-lg-2 col-sm-12">
                            <label for="" class="text--maroon kt-font-bold"
                                title="Issue Date">{{__('Issued Date')}}</label>
                        <input type="text" class="form-control form-control-sm date-picker"
                            name="truck_doc_issue_date_{{$i}}" data-date-end-date="0d" id="truck_doc_issue_date_{{$i}}"
                            placeholder="DD-MM-YYYY" />
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <label for="" class="text--maroon kt-font-bold"
                            title="Expiry Date">{{__('Expiry Date')}}</label>
                        <input type="text" class="form-control form-control-sm date-picker"
                            name="truck_doc_exp_date_{{$i}}" id="truck_doc_exp_date_{{$i}}" placeholder="DD-MM-YYYY" />
                    </div>
                    @endif --}}
            </div>
            @php
            $i++;
            @endphp
            @endforeach
            </form>
            <div class="d-flex justify-content-end kt-margin-t-10">
                <button class="btn btn-sm btn--maroon btn-wide" id="update_this_td">{{__('Update')}}</button>
                <button class="btn btn-sm btn--maroon btn-wide" id="add_new_td">{{__('Add')}}</button>
            </div>
        </div>
    </div>
</div>
</div>