@extends('layouts.admin.admin-app')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
<style>
  .fc-unthemed .fc-event .fc-title, .fc-unthemed .fc-event-dot .fc-title { color: #fff; }
  .fc-unthemed .fc-event .fc-time, .fc-unthemed .fc-event-dot .fc-time { color: #fff; }
   .widget-toolbar{ cursor: pointer; }

</style>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/custom/fullcalendar-scheduler/packages/timeline/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/custom/fullcalendar-scheduler/packages/resource-timeline/main.css') }}">
@stop
@section('content')
    <section class="kt-portlet  kt-portlet--head-sm kt-portlet--responsive-mobile">
         <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
             <div class="kt-portlet__head-label">
                  <h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __($inspection->permit->reference_number . ' - EVENT INSPECTION') }}</h3>
             </div>

             <div class="kt-portlet__head-toolbar">
                <a href="{{ URL::signedRoute('inspection.show', $inspection->approval_id) }}" class="btn btn-sm btn-outline-secondary btn-elevate kt-font-transform-u kt-margin-r-10">
                   <i class="la la-arrow-left"></i>
                   {{ __('BACK TO DETAILS') }}
                </a>

                <button type="button" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u btnSumit">
                  <i class="la la-check"></i>
                   {{ __('SUBMIT') }}
                </button>

             </div>
         </div>
         <div class="kt-portlet__body kt-padding-t-20">
            
            {{-- <div class="row kt-margin-t-50">
                <div class="col-md-12">

                    

                    <div class="form-group">
                      <button type="button" id="btnCaptureImage" class="btn btn-lg btn-maroon btn-pill btn-elevate kt-font-transform-u">
                          <i class="la la-camera"></i>
                          {{ __('TAKE PHOTOGRAPH') }}
                      </button>
                  </div>
                </div>
            </div> --}}
            <form method="POST" id="formInspection" action="{{ route('inspection.inspect.submit', ['inspection' => $inspection->approval_id]) }}">
            @csrf
            @foreach(App\Questionnaire::find(1)->getCategories as $category)
            <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus kt-margin-t-0" id="category-{{ $category->category_id }}">
                <div class="card">
                  <div class="card-header" id="category-{{ $category->category_id }}-heading">
                      <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#category-{{ $category->category_id }}-details" aria-expanded="true" aria-controls="category-{{ $category->category_id }}-details">
                          <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ Auth::user()->LanguageId == 1 ? $category->question_category_name_en : $category->question_category_name_ar }}</h6>
                      </div>
                   </div>
                   <div id="category-{{ $category->category_id }}-details" class="collapse show" aria-labelledby="category-{{ $category->category_id }}-heading" data-parent="#category-{{ $category->category_id }}">
                      <div class="card-body">

                        @foreach($category->getQuestions as $question)
                        <div class="border kt-padding-10 kt-margin-b-5">
                            <div class="row">
                              <div class="col-sm-7">
                                  <b>{{ Auth::user()->LanguageId == 1 ? $question->question_name_en : $question->question_name_ar }}</b>
                              </div>

                              <div class="col-sm-4 offset-sm-1">
                                  <div class="btn-group btn-group-sm btn-group-toggle btn-block" data-toggle="buttons">
                                    @foreach($question->getChoices as $choice)
                                    <label class="btn btn-outline-info">
                                        <input value="{{ $choice->question_choice_id }}" type="radio" name="q_{{ $question->question_id }}[answer]"> {{ Auth::user()->LanguageId == 1 ? $choice->question_choice_name_en : $choice->question_choice_name_ar }}
                                    </label>
                                    @endforeach
                                  </div>
                              </div>
                            </div>
                            <div class="row kt-margin-t-5">
                              <div class="col-sm-12">
                                  <textarea placeholder="{{ __('Remarks / Comment') }}" class="form-control form-control-sm" name="q_{{ $question->question_id }}[comment]" rows="3" style="resize:none"></textarea>
                              </div>
                            </div>

                            @if($question->is_required_image)
                            <div class="row kt-margin-t-5">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-maroon btn-sm btnCaptureImage"><i class="fa fa-camera"></i> {{ __('Take Photo') }}</button>
                                    <input data-q="{{ $question->question_id }}" type="file" multiple accept="image/*;capture=camera" class="kt-hide captureCamera">
                                </div>
                                <div class="col-sm-12 captureContainer kt-padding-t-5"></div>
                                <div class="filescontainer"></div>
                            </div>
                            @endif
                        </div>
                        @endforeach

                      </div>
                   </div>
                </div>
              </section>
            @endforeach
          </form>

         </div>
    </section>
@stop
@section('script')
<script>

  $(document).ready(function(){

      $('.btnSumit').on('click', function(){
          bootbox.confirm('Are you sure you want to submit inspection?', function(result){
            if(result){
                $('#formInspection').trigger('submit');
            } 
          });
      });

      $('.btnCaptureImage').click(function(){
          $(this).parent().find('.captureCamera').trigger('click');
      });

      $('input.captureCamera').on('change', function(e){

          var q_id = $(this).data('q');
          var container = $(this).parent().parent().find('.captureContainer');
          var files = $(this).parent().parent().find('.filescontainer');

          if(e.target.files){
              $.each(e.target.files, function(key, file){

                  var reader = new FileReader();
                  reader.readAsDataURL(file);

                  reader.onload = function (e) {
                      var url = e.target.result
                      var img = "<span class=\"kt-userpic kt-userpic--xl  kt-margin-r-5 kt-margin-t-5\">\
                                  <img src='" + url + "' alt=\"image\" class=\"border\">\
                                </span>";

                      container.append(img);
                  };

                  files.append(
                    $('<input>')
                    .attr('type', 'file')
                    .attr('name', 'q_' + q_id + '[' + q_id + '][photos][]')
                    .css('display', 'none')
                    .val(file)
                  );

                  //ACCEPTS ONLY EXCEL FILE
                  // if (option && option.accept && $.inArray(file.type, option.accept) < 0) {
                  //     new PNotify({
                  //         title: 'Information',
                  //         text: 'The selected file is not valid.',
                  //         type: 'error',
                  //     });
                  //     return false;
                  // }

                  // //CHECK FILE SIZE NOT MORE THAN 5MB
                  // if(option && option.size && file.size > option.size){
                  //     new PNotify({
                  //         title: 'Information',
                  //         type: 'error',
                  //         text: 'The selected file likely exceeded the maximum file size.'
                  //     });
                  //     return false;
                  //}

                  console.log(file)


                  // var class_name = icons.getClassWithColor(file.name);
                  // var filename = file.name;
                  // var filesize = humanFileSize(file.size, true);
                  // var path = file.path
                  
                  // var fileHtml = '<div class="alert alert-info fileInputFile"><button title="Remove" type="button" class="btn-remove-file close" aria-label="Close"><span aria-hidden="true">×</span></button><span class="' + class_name + '"></span> ' + filename + ' (' + filesize + ')</div>';

                  // var img = "<div class='pickup_image clearfix'>\
                  //                           <img src='" + url + "' class='img-responsive img-thumbnail'/>\
                  //                           <a href='javascript:;' class='text-danger deleteLogo'><i class='fa fa-minus-circle'></i></a>\
                  //                         </div>";

                  // container.html(fileHtml);
              });
          }
      });
  });

</script>
@stop