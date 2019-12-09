@extends('layouts.app')

@section('title', 'Upload Event Pictures - Event Permit Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Upload Event Pictures
            </h3>
            <span class="text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                <strong>{{$event->permit_number}}
                </strong>
            </span>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{route('event.index')}}#valid"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
                </a>

            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{route('event.index')}}#valid"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                </a>

            </div>
        </div>
    </div>

    <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">


    <div class="kt-portlet__body">
        <div class="kt-container">
            <input type="hidden" id="event_id" value="{{$event->event_id}}">
            <div id="upload_file">{{__('Upload')}}
            </div>
        </div>
    </div>


    @endsection



    @section('script')
    <script src="{{asset('js/company/uploadfile.js')}}"></script>
    <script>
        $.ajaxSetup({
                        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
                    });

        $(document).ready(function(){
            uploadDocs();
        })


        const uploadDocs = () => {
            var truckDocUploader = $('#upload_file').uploadFile({
                url: "{{route('event.uploadEventPics')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png,pdf",
                fileName: "upload_file",
                abortStr: '',
                returnType: "json",
                maxFileCount: 2,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                formData: {
                    id: $('#event_id').val()
                }
            });
            $('#upload_file div').attr('id', 'ajax-upload');
            $('#upload_file + div').attr('id', 'ajax-file-upload');
        };

        

        function viewLiquor(){
            var url = "{{route('event.fetch_liquor_details_by_event_id', ':id')}}";
            url = url.replace(':id', $('#event_id').val());
            $.ajax({
                url: url,
                success: function (data) {
                    if(data) 
                    {
                        $('#liquor_details').modal('show');
                        $('#l_company_name_en').val(data.company_name_en);
                        $('#l_company_name_ar').val(data.company_name_ar);
                        $('#license_no').val(data.license_number);
                        $('#license_no').val(data.license_number);
                        $('#l_issue_date').val(data.license_issued_date ? moment(data.license_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY') : '');
                        $('#l_expiry_date').val(data.license_expired_date ? moment(data.license_expired_date,'YYYY-MM-DD').format('DD-MM-YYYY') : '');
                        $('#l_emirates').val(data.emirate_id ? JSON.parse(data.emirate_id) : '');
                        $('#trade_license_no').val(data.trade_license);
                        $('#tl_issue_date').val(data.trade_license_issued_date ? moment(data.trade_license_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY') : '');
                        $('#tl_expiry_date').val(data.trade_license_expired_date ? moment(data.trade_license_expired_date , 'YYYY-MM-DD').format('DD-MM-YYYY') : '');
                        $('#event_liquor_id').val(data.event_liquor_id);
                    }
                    $('.ajax-file-upload-red').trigger('click');
                    liquorDocUpload();
                }
            });
        }


 
    </script>
    @endsection