@extends('layouts.admin-app')
@section('content')
<section class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" >
            <div class="kt-portlet__head kt-portlet__head--lg" style="">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">New Artist Type</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ URL::previous() }}" class="btn btn-clean kt-margin-r-10">
                        <i class="la la-arrow-left"></i>
                        <span class="kt-hidden-mobile">Back</span>
                    </a>
                    <a href="{{ route('artist_type.index') }}" class="btn btn-outline-primary btn-sm kt-margin-t-5 kt-margin-b-5">
                        Artist Type List
                    </a>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form class="kt-form" id="frm-artist-type" method="post" action="{{ route('artist_type.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Name <span class="text-danger">*</span></label>
                                        <div class="col-4">
                                            <input class="form-control input-sm" type="text" name="artist_type_en" autocomplete="off" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label">Artist Type Fee <span class="text-danger">*</span></label>
                                        <div class="col-4">
                                            <input class="form-control input-sm" type="text" name="amount" autocomplete="off">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-2 col-form-label">Artist Permit Code</label>
                                        <div class="col-4">
                                            <input class="form-control input-sm" type="text" name="artist_permit_code" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <dib class="div col-2"></dib>
                                        <div class="col-9">
                                            <button type="submit" class="btn btn-outline-success btn-sm">Save & New</button>
                                            <button type="submit" class="btn btn-outline-success btn-sm">Save & Continue</button>
                                            <button type="reset" class="btn btn-default btn-sm">Cancel</button>
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
        $('#frm-artist-type').validate({
          rules: {
            artist_type_en: {
              required: true,
              remote: {
                 url: '{!! route('artist_type.isexist') !!}',
                 // global: false
                data: {
                  artist_type_en: function() {
                    return $('input[name=artist_type_en]').val();
                  }
                }
              }
            },
            amount: {
              required: true,
            }
          }
        });

    });
</script>
@endsection
