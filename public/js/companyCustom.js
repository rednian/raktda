// var scale = 'scale(1)';
// document.body.style.webkitTransform =  scale;    // Chrome, Opera, Safari
//  document.body.style.msTransform =   scale;       // IE 9
//  document.body.style.transform = scale;     // General

// defaulth theme
var KTAppOptions = {
    colors: {
        state: {
            brand: "#5d78ff",
            dark: "#282a3c",
            light: "#ffffff",
            primary: "#5867dd",
            success: "#34bfa3",
            info: "#36a3f7",
            warning: "#ffb822",
            danger: "#fd3995"
        },
        base: {
            label: ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
            shape: ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
        }
    }
};
$(document).ready(function() {
    // language selection
    // $('span[data-lang=en]').click(function(){
    //    $(this).addClass('d-none');
    //    $('span[data-lang=ar]').removeClass('d-none');
    // });

    // $('span[data-lang=ar]').click(function(){
    //    $(this).addClass('d-none');
    //    $('span[data-lang=en]').removeClass('d-none');
    // });

    $("input[type=checkbox]").each(function() {
        $(this).change(function() {
            if ($(this).is(":checked")) {
                // $(this).parent('label').removeClass('kt-checkbox--solid').addClass('kt-checkbox--success');
                $(this)
                    .closest(".input-group")
                    .find("input[type=text]")
                    .addClass("is-valid")
                    .css("background-image", "none");
            } else {
                // $(this).parent('label').removeClass('kt-checkbox--solid').addClass('kt-checkbox--solid');
                $(this)
                    .closest(".input-group")
                    .find("input[type=text]")
                    .removeClass("is-valid");
            }
        });
    });

    // datatable default setting
    $.extend(true, $.fn.dataTable.defaults, {
        // dom: '<"row"<"col text-left"f>>rt<"pull-left"p><"pull-left kt-margin-l-5"l><"pull-right m-r-sm"i><"clearfix">',
        lengthMenu: [5, 10, 25, 50, 100],
        pageLength: 10,
        deferRender: true,
        processing: true,
        serverSide: true,
        destroy: true,
        pagingType: "simple_numbers",
        ajax: { global: false },
        language: {
            search: "",
            searchPlaceholder: "Search...",
            lengthMenu: "_MENU_ ",
            processing:
                '<div class="kt-spinner spinner-border kt-spinner-solid"></div>'
        }
    });

    $("table").wrap('<div class="table-responsive-sm"></div>');

    // select2 settings
    $(".select2").select2({ dropdownAutoWidth: true });

    autosize.update($("textarea"));

    window.getIcon = function(fileName) {
        var icons = window.FileIcons;
        var class_name = icons.getClassWithColor(fileName);
        return '<span class="' + class_name + '"></span>';
    };

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    // $('.fancy-box').fancybox({});

    $(document)
        .bind("ajaxSend", function() {
            // $.LoadingOverlay("show", {
            //     image: "{{ asset('images/loading.gif') }}",
            //     size: 10
            // });
        })
        .bind("ajaxSuccess", function(event, request, settings, data) {
            // $.LoadingOverlay("hide");
            if (data.hasOwnProperty("message")) {
                $.notify(
                    {
                        title: data.message[2],
                        message: data.message[1]
                    },
                    {
                        type: data.message[0],
                        animate: {
                            enter: "animated zoomIn",
                            exit: "animated zoomOut"
                        }
                    }
                );
            }
        });
    // $.LoadingOverlay("hide");
    // new PNotify({
    //     title: 'Error',
    //     text: data,
    //     type: 'error'
    // });
    // });

    /*.bind("ajaxError", function(event, request, settings, data){
            $.notify({
                title: 'Somethings wrong!',
                message: data,
            },{
                type: 'error',
                animate: {
                    enter: 'animated zoomIn',
                    exit: 'animated zoomOut'
                },
            });*/

    window.global = {
        profile: function(name) {
            var text = [
                "danger",
                "brand",
                "warning",
                "success",
                "info",
                "primary",
                "dark"
            ];
            text = text[Math.floor(Math.random() * text.length)];
            return (
                '<div class="kt-badge kt-badge--xl kt-badge--' +
                text +
                '"><span>' +
                name.charAt(0).toUpperCase() +
                "</span></div>"
            );
        }
    };
});
