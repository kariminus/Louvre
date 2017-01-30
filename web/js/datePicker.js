$(document).ready(function() {
    $(".js-datepicker").datepicker({
        format: "dd/mm/yyyy",
        startDate: "0",
        daysOfWeekDisabled: "4",
        beforeShowDay: function (date) {
            if ( ((date.getDate()== 25) && (date.getMonth()== 11)) || ((date.getDate()== 1) && (date.getMonth()== 4)) || ((date.getDate()== 1) && (date.getMonth()== 10))) {
                return false;
            }
        }
    });
});