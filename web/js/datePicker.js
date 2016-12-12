$(document).ready(function() {

    $(".js-datepicker").datepicker({
        format: "dd/mm/yyyy",
        startDate: "0",
        daysOfWeekDisabled: "2",
        datesDisabled: ['01/05/2017', '25/12/2016', '01/05/2018', '25/12/2017']
    });
});