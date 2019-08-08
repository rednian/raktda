@extends('layouts.admin-app')
@section('action')
<a href="{{ route('permit_type.index') }}" class="btn btn-brand btn-raised active btn-sm ">Permit Type List</a>
@endsection
@section('content')
<section class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" >
            <div class="kt-portlet__head kt-portlet__head--lg" style="">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">New Permit Type</h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form class="kt-form" id="frm-permit-type" method="post" action="{{ route('permit_type.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Type <span class="text-danger">*</span></label>
                                        <div class="col-4">
                                            <select name="permit_type" class="form-control input-sm" autofocus required>
                                                <option disabled selected>Select Permit Type</option>
                                                <option value="artist">Artist Permit </option>
                                                <option value="event">Event Permit </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Duration<span class="text-danger">*</span></label>
                                        <div class="col-4">
                                            <select name="duration" class="form-control input-sm" autofocus required>
                                                <option disabled selected>Select Duration</option>
                                                <option value="one day">One Month</option>
                                                <option value="one month">One Day</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Name <span class="text-danger">*</span></label>
                                        <div class="col-4">
                                            <input class="form-control input-sm" type="text" name="name_en" autocomplete="off" required >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Permit Type Fee<span class="text-danger">*</span></label>
                                        <div class="col-4">
                                            <input class="form-control input-sm" type="text" name="amount" autocomplete="off" required>
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-2 col-form-label">Permit Type Code</label>
                                        <div class="col-4">
                                            <input class="form-control input-sm" type="text" name="permit_type_code" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <dib class="div col-2"></dib>
                                        <div class="col-9">
                                            <button type="submit" value="0" name="exit" class="btn btn-brand active btn-raised btn-sm">Save & New</button>
                                            <button type="submit" value="1" name="exit" class="btn btn-brand active btn-raised btn-sm">Save & Exit</button>
                                            <button type="reset" class="btn btn-light btn-raised btn-sm">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

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
