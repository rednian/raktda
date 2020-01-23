/*function set_document_expiry(validity, id) {
    // alert(validity);
    var noOfMonths = validity != 0 ? validity : 0;
    var issue_date = $("#doc_issue_date_" + id).val();
    var issue_date_year_format = moment(issue_date, "DD-MM-YYYY").format(
        "YYYY-MM-DD"
    );
    var expiryMonth = moment(issue_date_year_format).add(noOfMonths, "M");
    // var expiryMonthEnd = moment(expiryMonth).endOf('month');
    // if(issue_date_year_format.date() != expiryMonth.date() && expiryMonth.isSame(expiryMonthEnd.format('YYYY-MM-DD'))){
    //     expiryMonth = expiryMonth.add(1, 'd');
    // }
    $("#doc_exp_date_" + id).val(expiryMonth.format("DD-MM-YYYY"));
}*/

// function setExpiryMindate(i) {
//     var i = parseInt(i);
//     if ($("#doc_issue_date_" + i).length) {
//         var validity = $("#doc_validity_" + i).val()
//             ? $("#doc_validity_" + i).val()
//             : 1;
//         // var issue = moment($('#doc_issue_date_'+i).val(), 'DD-MM-YYYY').toDate();
//         var today = moment().toDate();
//         var minDate = moment(today)
//             .add(validity, "M")
//             .toDate();
//         $("#doc_exp_date_" + i).datepicker("setStartDate", minDate);
//     }
// }

function setWizard() {
    // Initialize form wizard
    wizard = new KTWizard("kt_wizard_v3", {
        startStep: 1
    });

    // Change event
    wizard.on("change", function(wizard) {
        KTUtil.scrollTop();
    });
}

function dayCount(from, to) {
    var x = moment(from, "DD-MM-YYYY");
    var y = moment(to, "DD-MM-YYYY");
    var from = moment([x.format("YYYY"), x.month(), x.format("DD")]);
    var to = moment([y.format("YYYY"), y.month(), y.format("DD")]);
    return to.diff(from, "days");
}
