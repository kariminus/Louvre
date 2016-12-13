$(document).ready(function() {

    $("#reservation_date").change(function () {
        var newDate = new Date(),
            hours = newDate.getHours(),
            today = newDate.toLocaleDateString(),
            date = $("#reservation_date").val();
        if (date == today && hours >= 14) {

        $("#reservation_dayTime").prop("checked", true);
        $("#reservation_dayTime").prop("required", true);

        }
        else {
            $("#reservation_dayTime").prop("checked", false);
            $("#reservation_dayTime").prop("required", false);
        }
    });
});