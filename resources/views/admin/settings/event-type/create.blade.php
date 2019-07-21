@extends('layouts.app')
@section('content')
<section class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" >
            <div class="kt-portlet__head kt-portlet__head--lg" style="">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">New Event Type Permit</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ URL::previous() }}" class="btn btn-clean kt-margin-r-10">
                        <i class="la la-arrow-left"></i>
                        <span class="kt-hidden-mobile">Back</span>
                    </a>
                    <a href="{{ route('event_type.index') }}" class="btn btn-outline-primary btn-sm">
                        Event Type List
                    </a>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form class="kt-form" id="frm-event-type" method="post" action="{{ route('event_type.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Event Type Name <span class="text-danger">*</span></label>
                                        <div class="col-4">
                                            <input class="form-control input-sm" type="text" name="event_type_en" autocomplete="off" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Event Type Fee <span class="text-danger">*</span></label>
                                        <div class="col-4">
                                            <input class="form-control input-sm" type="text" name="event_type_amount" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Event Type Duration <span class="text-danger">*</span></label>
                                        <div class="col-4">
                                            <select name="event_duration" class="form-control input-sm">
                                                <option selected disabled> Select Duration</option>
                                                <option value="one day">One Day</option>
                                                <option value="one month"> One Month</option>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-3 col-form-label">Event Type Code</label>
                                        <div class="col-4">
                                            <input class="form-control input-sm" type="text" name="event_type_code" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <dib class="div col-3"></dib>
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
        $('#frm-event-type').validate({
          rules: {
            event_type_en: {
              required: true,
              remote: {
                 url: '{!! route('event_type.isexist') !!}',
                 // global: false
                data: {
                  event_type_en: function() {
                    return $('input[name=event_type_en]').val();
                  }
                }
              }
            },
            event_type_amount: {
              required: true,
            },
            event_duration:{
                required : true

            }
          }
        });

    });
</script>
@endsection
