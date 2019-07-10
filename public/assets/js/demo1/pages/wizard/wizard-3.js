"use strict";

// Class definition
var KTWizard3 = (function() {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;

    // Private functions
    var initWizard = function() {
        // Initialize form wizard
        wizard = new KTWizard("kt_wizard_v3", {
            startStep: 1
        });

        // Validation before going to next page
        wizard.on("beforeNext", function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop(); // don't go to the next step
            }
        });

        // Change event
        wizard.on("change", function(wizard) {
            KTUtil.scrollTop();
        });
    };

    var initValidation = function() {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                //= Step 1
                artist_type: {
                    required: true
                },
                artist_permit_from: {
                    required: true
                },
                artist_permit_to: {
                    required: true
                },
                artist_name_en: {
                    required: true
                },
                artist_nationality: {
                    required: true
                },
                artist_passport: {
                    required: true
                },
                artist_uid_number: {
                    required: true
                },
                artist_dob: {
                    required: true
                },
                artist_telephone: {
                    required: true
                },
                artist_mobile: {
                    required: true
                },
                artist_email: {
                    required: true
                },

                //= Step 2
                artist_upload_doc_type: {
                    required: true
                },
                artist_upload_doc_file: {
                    required: true
                },
                artist_upload_doc_exp_date: {
                    required: true
                }
            },

            // Display error
            invalidHandler: function(event, validator) {
                KTUtil.scrollTop();

                swal.fire({
                    title: "",
                    text:
                        "There are some errors in your submission. Please correct them.",
                    type: "error",
                    confirmButtonClass: "btn btn-secondary"
                });
            },

            // Submit valid form
            submitHandler: function(form) {}
        });
    };

    var initSubmit = function() {
        var btn = formEl.find('[data-ktwizard-type="action-submit"]');

        btn.on("click", function(e) {
            e.preventDefault();

            if (validator.form()) {
                // See: src\js\framework\base\app.js
                KTApp.progress(btn);
                //KTApp.block(formEl);

                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                    success: function() {
                        KTApp.unprogress(btn);
                        //KTApp.unblock(formEl);

                        swal.fire({
                            title: "",
                            text:
                                "The application has been successfully submitted!",
                            type: "success",
                            confirmButtonClass: "btn btn-secondary"
                        });
                    }
                });
            }
        });
    };

    return {
        // public functions
        init: function() {
            wizardEl = KTUtil.get("kt_wizard_v3");
            formEl = $("#kt_form");

            initWizard();
            initValidation();
            initSubmit();
        }
    };
})();

jQuery(document).ready(function() {
    KTWizard3.init();
});
