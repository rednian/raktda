    // defaulth theme
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
$(document).ready(function(){
      
      autosize.update($('textarea'));

       window.getIcon = function( fileName){
            var icons = window.FileIcons;
            var class_name = icons.getClassWithColor(fileName);
            return '<span class="'+class_name+'"></span>';
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.select2').select2({dropdownAutoWidth:true});
        
        $('.fancy-box').fancybox({});

        $.extend( true, $.fn.dataTable.defaults, {
            lengthMenu: [5, 10, 25, 50, 100],
            pageLength: 10,
            order: [[1, 'desc']],
            deferRender: true,
            processing: true,
            serverSide: true,
            destroy: true,
            deferRender: true,
            pagingType: 'full_numbers',
            ajax: { global: false }, 
            language: {
                  infoFiltered: '',
                  lengthMenu: "Show _MENU_",
                  // processing: '<span class="fa fa-spinner fa-spin fa-3x text-info"></span>',
            },
        });

        $(document).bind("ajaxSend", function(){
            // $.LoadingOverlay("show", {
            //     image: "{{ asset('images/loading.gif') }}",
            //     size: 10
            // });
        }).bind("ajaxSuccess", function(event, request, settings, data){
            // $.LoadingOverlay("hide");
            if(data.hasOwnProperty('message')){
                $.notify({
                    title: data.message[2],
                    message: data.message[1],
                },{
                    type: data.message[0],
                    animate: {
                        enter: 'animated zoomIn',
                        exit: 'animated zoomOut'
                    },
                });
            }
        }).bind("ajaxError", function(event, request, settings, data){
            $.notify({
                title: 'Somethings wrong!',
                message: data,
            },{
                type: 'error',
                animate: {
                    enter: 'animated zoomIn',
                    exit: 'animated zoomOut'
                },
            });
            // $.LoadingOverlay("hide");
            // new PNotify({
            //     title: 'Error',
            //     text: data,
            //     type: 'error'
            // });
        });
});