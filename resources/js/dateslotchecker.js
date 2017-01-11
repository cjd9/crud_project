$(function () {
    $("#datepicker").datepicker({dateFormat: 'yy-mm-dd', minDate: -0});
});

$(function () {
    $("#datepickerappointment").datepicker({dateFormat: 'yy-mm-dd', minDate: -0});
});

$(document).ready(function () {
    $('#datepicker').on('change', function () {
        if ($('#clinic_id').val() == '')
        {
            alert("Please Select a Clinic before picking a date");
            $('#datepicker').val("");
            return false;
        } 
        else
        {
            var date = $('#datepicker').datepicker({dateFormat: 'dd-mm-yy', minDate: -0}).val();
            var user_id = $('#user_id').val();
            var clinic_id = $('#clinic_id').val();
            var data = {'date': date, user_id: user_id, clinic_id: clinic_id};
        }
        $.post("dashboard/checkTimeSlot", data, function (result, textStatus)
        {
            $('#timeslot').html(result);
            $("#slots").trigger("click");
        });
    });

    $('#clinic_id').on('change', function () {
        if ($('#datepicker').val() == '')
        {
            return false;
        }
        if ($('#clinic_id').val() == '')
        {
            return false;
        } 
        else
        {
            var date = $('#datepicker').datepicker({dateFormat: 'dd-mm-yy', minDate: -0}).val();
            var user_id = $('#user_id').val();
            var clinic_id = $('#clinic_id').val();
            var data = {'date': date, user_id: user_id, clinic_id: clinic_id};
        }
        $.post("dashboard/checkTimeSlot", data, function (result, textStatus)
        {
            $('#timeslot').html(result);
            $("#slots").trigger("click");
        });
    });
});