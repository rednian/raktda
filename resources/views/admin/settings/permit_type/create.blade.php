@extends('layouts.admin-app')
@section('content')
<section class="row">
    <div class="col">
          <section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">
                <form class="kt-form kt-form--label-right" id="frm-permit-type" method="post" action="{{ route('permit_type.store') }}">
                   @csrf
                    <div class="kt-portlet__head kt-portlet__head--sm">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Create Permit Type</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                           <a href="{{ URL::previous() }}" class="btn btn-sm btn-light btn-elevate active btn-raised">
                             <i class="la la-arrow-left"></i>
                             <span class="kt-hidden-mobile">Back</span>
                           </a>
                           <button type="submit" class="btn btn-brand active btn-raised btn-elevate btn-sm "></i> Save</button>
                           <button type="reset" class="btn btn-light active btn-raised btn-elevate btn-sm ">Reset</button>
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                    <button type="submit" class="dropdown-item" href="#"> Save & Continue</button>
                                    <button type="submit"  class="dropdown-item" href="#">Save & New</button>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('permit_type.index') }}">Permit Type List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                       <div class="row">
                           <div class="col-xl-8">
                               <div class="kt-section kt-section--first">
                                   <div class="kt-section__body">

                                       <div class="form-group row">
                                           <label class="col-2 col-form-label">Type <span class="text-danger">*</span></label>
                                           <div class="col-4">
                                               <select name="permit_type" class="form-control form-control-sm" autofocus required>
                                                   <option selected data-selected="add-type">Select Permit Type</option>
                                                   <option value="artist">Artist Permit </option>
                                                   <option value="event">Event Permit </option>
                                               </select>
                                           </div>
                                       </div>
                                       <div class="form-group row">
                                           <label class="col-2 col-form-label">Duration<span class="text-danger">*</span></label>
                                           <div class="col-4">
                                               <select name="duration" class="form-control form-control-sm" autofocus required>
                                                   <option disabled selected>Select Duration</option>
                                                   <option value="one day">One Month</option>
                                                   <option value="one month">One Day</option>
                                               </select>
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label class="col-2 col-form-label">Name <span class="text-danger">*</span></label>
                                           <div class="col-4">
                                               <input class="form-control form-control-sm" type="text" name="name_en" autocomplete="off" required >
                                           </div>
                                       </div>

                                       <div class="form-group row">
                                           <label class="col-2 col-form-label">Permit Type Fee<span class="text-danger">*</span></label>
                                           <div class="col-4">
                                               <input class="form-control form-control-sm" type="text" name="amount" autocomplete="off" required>
                                           </div>
                                       </div>

                                        <div class="form-group row">
                                           <label class="col-2 col-form-label">Permit Type Code</label>
                                           <div class="col-4">
                                               <input class="form-control form-control-sm" type="text" name="permit_type_code" autocomplete="off">
                                           </div>
                                       </div>
                                       
                                   </div>
                               </div>

                           </div>
                       </div>
                    </div>
              </form>
          </section>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function(){

        $('#frm-permit-type').validate({
          rules: {
            name_en: {
              required: true,
              remote: {
                 url: '{!! route('permit_type.isexist') !!}',
                data: {
                  name_en: function() {
                    return $('input[name=name_en]').val();
                  }
                }
              }
            },
          }
        });

    });
</script>
@endsection
