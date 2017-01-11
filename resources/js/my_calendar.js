var scheduleMinDate = moment().startOf('day');
var scheduleMaxDate = moment().endOf('week').add('weeks', totalSchedulesWeeksToShow).add('days', scheduleMinDate.format('e'));

$(document).ready(function(e) {
    /* schedule */

    var defaultRange = new Object;
    defaultRange.start = moment();
    defaultRange.end = moment().add('days', 1);
    var subViewElement, subViewContent;

    $(".close-subview-button").off().on("click", function (e) {
        e.preventDefault();
        $.hideSubview();
    });

    $(".add-schedule").on("click", function () {
        subViewElement = $(this);
        subViewContent = subViewElement.attr('href');
        defaultRange.start = moment().startOf('day').format('h:mm a');
        defaultRange.end = moment().startOf('day').add(0.5, 'hours').format('h:mm a');

        $.subview({
            content: subViewContent,
            onShow: function () {
                addSchedule();
            },
            onHide: function () {
                hide_add_edit_Schedule();
            }
        });
    });

    var initializeScheduleFullCalendar = function (displayTimeRange) {

        $('#full-schedule').fullCalendar({
            buttonText: {
                prev: '<i class="fa fa-chevron-left"></i>',
                next: '<i class="fa fa-chevron-right"></i>'
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            minTime: displayTimeRange.minTime,
            maxTime: displayTimeRange.maxTime,
            slotMinutes: $('#full-schedule').attr('data-schedule-type') == 'online' ? 30 : 15,
            defaultView: 'agendaWeek',
            firstDay: scheduleMinDate.day(),
            allDaySlot: false,
            slotEventOverlap: false,
            events: typeof schedules !== 'undefined' ? schedules : {},
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            selectable: true,
            selectHelper: true,
            timeFormat: {
                month: 'h:mm { - h:mm}',
                basicWeek: 'h:mm { - h:mm}'
            },
            columnFormat: 'ddd dd/M',
            select: function (start, end, allDay) {
                defaultRange.start = moment(start).format('hh:mm a');
                defaultRange.end = moment(end).format('hh:mm a');
                if (defaultRange.start == defaultRange.end) {
                    defaultRange.end = moment(start).add('hours', 0.5).format('hh:mm a');
                }
    //if user selects by dragging then check if the selection overlaps any other event
                else {
                    if (!isValidEventSelection(moment(start), moment(end))) {
                        $('#full-schedule').fullCalendar('unselect');
                        return;
                    }
                }

                thisScheduleDate = moment(start);
                if (start >= scheduleMinDate && end <= scheduleMaxDate) {
                    $.subview({
                        content: "#editSchedule",
                        onShow: function () {
                            editSchedule(start, end);
                        },
                        onHide: function () {
                            resetRepeatOptions($('.edit-schedule-form'));
                            hide_add_edit_Schedule();
                        }
                    });
                }
            },
            eventClick: function (calEvent, jsEvent, view) {
    //return if appointment exists
                if (calEvent.disabled) {
                    return;
                }

                thisSchedule = calEvent;
                $.subview({
                    content: "#readSchedule",
                    onShow: function () {
                        readSchedule();
                    },
                    onHide: function () {
                        resetRepeatOptions($('.read-schedule-form'));
                        hide_add_edit_Schedule();
                    }
                });

            },
            eventRender: function (event, element) {
                element.attr('schedule-id', event._id);
                if (!event.disabled) {
                    element.append("<div class='delete-schedule'><i class='fa fa-times'></i></div>");
                    element.find(".delete-schedule").data('event-id', event._id);
                    element.find(".delete-schedule").click(function (e) {
                        e.stopPropagation();
                        thisSchedule = $('#full-schedule').fullCalendar('clientEvents', event._id)[0];

                        $.subview({
                            content: "#deleteSchedule",
                            onShow: function () {
                                deleteSchedule();
                            },
                            onHide: function () {
                                resetRepeatOptions($('.delete-schedule-form'));
                                hide_add_edit_Schedule();
                            }
                        });

                    });
                } else if (typeof event.offlinePatientAppointment !== 'undefined') {
                    element.find('.fc-event-time').html(event.time);
                    element.find('.fc-event-inner').append(event.patientName);
                } else {
                    element.find('.fc-event-time').remove();
                    element.find('.fc-event-inner').append(event.appointments);
                }
            },
            viewRender: function (currentView) {
    //past
                if (scheduleMinDate >= moment(currentView.start)) {
                    $(".fc-button-prev").prop('disabled', true).removeClass('fc-state-default').addClass('fc-state-disabled');
                } else {
                    $(".fc-button-prev").prop('disabled', false).removeClass('fc-state-disabled').addClass('fc-state-default');
                }
    //future
                if (scheduleMaxDate <= moment(currentView.end)) {
                    $(".fc-button-next").prop('disabled', true).removeClass('fc-state-default').addClass('fc-state-disabled');
                } else {
                    $(".fc-button-next").prop('disabled', false).removeClass('fc-state-disabled').addClass('fc-state-default');
                }
            }
        });

    }

    initializeScheduleFullCalendar({'minTime': '10:00:00', 'maxTime': '22:00:00'});

    var isValidEventSelection = function (start, end) {
        var overlapping_events = $("#full-schedule").fullCalendar('clientEvents', function (event) {
            var s = moment(event.start);
            var e = moment(event.end);
            return ((start > s && start < e) || (end > s && end <= e) || (start < s && end > e));
        });

        return overlapping_events.length == 0;
    };

    var addSchedule = function (el) {
        $(".close-new-event").off().on("click", function () {
            $(".back-subviews").trigger("click");
        });
        var form = $(".add-schedule-form");
        var schedule_from = form.find('input[name="schedule_from"]');
        var schedule_to = form.find('input[name="schedule_to"]');
        form.find('input[type="checkbox"]').removeAttr('checked');
        form.find('div.checkbox div').removeClass('checked');
        form.find('.first-input').focus();

        schedule_from.timepicker({
            'minuteStep': 30
        }).timepicker('setTime', defaultRange.start)

        schedule_to.timepicker({
            'minuteStep': 30
        }).timepicker('setTime', defaultRange.end);

    //change schedule time(schedule_from + 0.5 hour) as schedule from changes
        schedule_from.on('changeTime.timepicker', function (e) {
            var tp = getTimePickerTime(e);

    //if schedule_to is less or equal to schedule_from then we set schedule_to to schedule_from + 30 minutes
            if (tp.datetime >= new Date(tp.now.format('YYYY-MM-DD') + ' ' + schedule_to.val())) {
                if (tp.minutes == 30) {
                    tp.minutes = 00;
                    tp.hours = tp.hours + 1;

                    if (tp.hours >= 12) {
                        tp.hours = tp.hours - 12;
                        tp.meridian = tp.meridian == 'AM' ? 'PM' : 'AM';
                    }
                } else {
                    tp.minutes = 30;
                }

                schedule_to.timepicker('setTime', tp.hours + ':' + tp.minutes + ' ' + tp.meridian);
            }
        });
    }

    var editSchedule = function (start, end) {
        var nextSchedule;
        end = moment(end);
        var data = {'schedule_end': end.format('YYYY-MM-DD hh:mm:ss a')};

        $.blockUI({
            message: '<i class="fa fa-spinner fa-spin"></i> Preparing please wait...'
        });

        $.ajax({
            'url': get_schedule_by_date_range_href,
            'data': data,
            'success': function (response) {
                var result = checkIfJson(response);

                if (result['isJson']) {
                    if (result['output'].schedule_id !== '') {
                        Object.keys(schedules).forEach(function (prop) {
                            if (schedules[prop]['schedule_id'] == result['output'].schedule_id && moment(schedules[prop]['start']).format('YYYY-MM-DD') == end.format('YYYY-MM-DD')) {
                                nextSchedule = $('#full-schedule').fullCalendar('clientEvents', schedules[prop]['_id'])[0];
                                return;
                            }
                        });
                    }

                    if (typeof nextSchedule !== 'undefined') {
                        var nextScheduleStart = moment(nextSchedule.start);
                        var nextScheduleOverlapMessage = 'There exists a schedule which starts at ' + (nextScheduleStart.format('hh:mm a')).toUpperCase();
                    }

                    $(".close-new-event").off().on("click", function () {
                        $(".back-subviews").trigger("click");
                    });
                    var form = $(".edit-schedule-form");
                    var schedule_from = form.find('input[name="schedule_from"]');
                    var schedule_to = form.find('input[name="schedule_to"]');
                    var day = start.getDay();
                    form.find('.first-input').focus();

                    form.find('.radio-label .single-day').text(thisScheduleDate.format('dddd Do MMM'));
                    form.find('.radio-label .day-name').text(weekDays[day]).attr('data-day-id', day);
                    form.find('.week-days-form-group input[value="' + day + '"]').attr('checked', 'checked').prop('checked', true).parent().addClass('checked');

                    schedule_from.val(defaultRange.start);
                    form.find('input[name="schedule_date"]').val(thisScheduleDate.format('YYYY-MM-DD'));
                    form.find('input[name="days"]').val(start.getDay());
                    form.find('.schedule_from_text').text((defaultRange.start).toUpperCase());

                    schedule_to.timepicker({
                        'minuteStep': 30
                    }).timepicker('setTime', defaultRange.end);

                    schedule_to.on('changeTime.timepicker', function (e) {
                        var tp = getTimePickerTime(e, {'start': start});

                        if (typeof nextScheduleStart !== 'undefined' && tp.datetime > nextSchedule.start) {
                            showToastr(nextScheduleOverlapMessage, 'error', true, 2000);
                            schedule_to.timepicker('setTime', nextScheduleStart.format('hh:mm a'));
                            return;
                        } else if (tp.meridian.toLowerCase() == 'am' && tp.hours == '12' && tp.minutes == '00') {
                            schedule_to.timepicker('setTime', '11:30 PM');
                            return;
                        } else if (tp.datetime <= new Date(tp.datetime.toDateString() + ' ' + defaultRange.start)) {
                            schedule_to.timepicker('setTime', defaultRange.end);
                            return;
                        }
                    });

                    $.unblockUI();
                }
            }
        });
    }

    var readSchedule = function (el) {
        $(".close-new-event").off().on("click", function () {
            $(".back-subviews").trigger("click");
        });

        var form = $(".read-schedule-form");
        var schedule_from = form.find('input[name="schedule_from"]');
        var schedule_to = form.find('input[name="schedule_to"]');
        var date = moment(thisSchedule.start);

        form.find('input[type="checkbox"]').removeAttr('checked');
        form.find('div.checkbox div').removeClass('checked');
        form.find('.first-input').focus();

        form.find('.radio-label .single-day').text(date.format('dddd Do MMM'));
        form.find('.radio-label .day-name').text(weekDays[thisSchedule.start.getDay()]).attr('data-day-id', thisSchedule.start.getDay());

        form.find('.event-day h2').text(date.format('DD'));
        form.find('.event-date h3').text(date.format('dddd'));
        form.find('.event-date h4').text(date.format('MMMM YYYY'));
        form.find('.event-time .from-to').text((date.format('hh:mm a')).toUpperCase() + ' - ' + (moment(thisSchedule.end).format('hh:mm a')).toUpperCase());
        form.find('input[name="schedule_date"]').val(moment(thisSchedule.start).format('YYYY-MM-DD'));

    //hide the repeat action radio buttons if schedule is for single day
        if (thisSchedule.singleDay)
            form.find('.repeat-action-form-group').addClass('hide');

        schedule_from.timepicker({
            'minuteStep': 30
        }).timepicker('setTime', moment(thisSchedule.start).format('hh:mm a'))

        schedule_to.timepicker({
            'minuteStep': 30
        }).timepicker('setTime', moment(thisSchedule.end).format('hh:mm a'));

    //find previous and next schedules
        var prevSchedule = $('#full-schedule').fullCalendar('clientEvents', '_fc' + (parseInt(getNumberFromString(thisSchedule._id)) - 1))[0];
        var nextSchedule = $('#full-schedule').fullCalendar('clientEvents', '_fc' + (parseInt(getNumberFromString(thisSchedule._id)) + 1))[0];

    //if previous and next schedules are found then initialize their end and start dates appropriately
        if (typeof prevSchedule !== 'undefined' && (prevSchedule.start).getDate() == (thisSchedule.start).getDate()) {
            var prevScheduleEnd = moment(prevSchedule.end);
            var prevScheduleOverlapMessage = 'There exists a schedule which ends at ' + (prevScheduleEnd.format('hh:mm a')).toUpperCase();
        }
        if (typeof nextSchedule !== 'undefined' && (nextSchedule.start).getDate() == (thisSchedule.start).getDate()) {
            var nextScheduleStart = moment(nextSchedule.start);
            var nextScheduleOverlapMessage = 'There exists a schedule which starts at ' + (nextScheduleStart.format('hh:mm a')).toUpperCase();
        }

        schedule_from.on('changeTime.timepicker', function (e) {
            var tp = getTimePickerTime(e, thisSchedule);

            if (typeof prevScheduleEnd !== 'undefined' && tp.datetime < prevSchedule.end) {
                showToastr(prevScheduleOverlapMessage, 'error', true, 2000);
                schedule_from.timepicker('setTime', prevScheduleEnd.format('hh:mm a'));
                return;
            } else if (tp.meridian.toLowerCase() == 'pm' && tp.hours == '11') {
                schedule_from.timepicker('setTime', '12:00 AM');
                return;
            } else if (tp.datetime >= new Date(tp.datetime.toDateString() + ' ' + schedule_to.val())) {
                var t = moment(new Date(tp.now.format('YYYY-MM-DD') + ' ' + schedule_to.val()));
                schedule_from.timepicker('setTime', t.add('minutes', '-30').format('hh:mm a'));
                return;
            }
        });

        schedule_to.on('changeTime.timepicker', function (e) {
            var tp = getTimePickerTime(e, thisSchedule);

            if (typeof nextScheduleStart !== 'undefined' && tp.datetime > nextSchedule.start) {
                showToastr(nextScheduleOverlapMessage, 'error', true, 2000);
                schedule_to.timepicker('setTime', nextScheduleStart.format('hh:mm a'));
                return;
            } else if (tp.meridian.toLowerCase() == 'am' && tp.hours == '12') {
                schedule_to.timepicker('setTime', '11:30 PM');
                return;
            } else if (tp.datetime <= new Date(tp.datetime.toDateString() + ' ' + schedule_from.val())) {
                var t = moment(new Date(tp.now.format('YYYY-MM-DD') + ' ' + schedule_from.val()));
                schedule_to.timepicker('setTime', t.add('minutes', '30').format('hh:mm a'));
                return;
            }
        });

    };

    var deleteSchedule = function (el) {
        $(".close-new-event").off().on("click", function () {
            $(".back-subviews").trigger("click");
        });

        var form = $(".delete-schedule-form");
        var schedule_from = form.find('input[name="schedule_from"]');
        var schedule_to = form.find('input[name="schedule_to"]');
        form.find('input[type="checkbox"]').removeAttr('checked');
        form.find('div.checkbox div').removeClass('checked');

        var date = moment(thisSchedule.start);
        var day = thisSchedule.start.getDay();
        form.find('.event-day h2').text(date.format('DD'));
        form.find('.event-date h3').text(date.format('dddd'));
        form.find('.event-date h4').text(date.format('MMMM YYYY'));
        form.find('.event-time .from-to').text((date.format('hh:mm a')).toUpperCase() + ' - ' + (moment(thisSchedule.end).format('hh:mm a')).toUpperCase());

    //form.find('.radio-label .day-name').text(weekDays[day]).attr('data-day-id', day);

    //hide the repeat action radio buttons if schedule is for single day
        if (thisSchedule.singleDay)
            form.find('.repeat-action-form-group').addClass('hide');
        else {
            form.find('.radio-label .single-day').text(date.format('dddd Do MMM'));
            form.find('.radio-label .day-name').text(weekDays[day]).attr('data-day-id', day);
            form.find('.week-days-form-group input[value="' + day + '"]').attr('checked', 'checked').prop('checked', true).parent().addClass('checked');
        }

        /*$('#full-schedule').fullCalendar('removeEvents', el.data('event-id'));*/
    }

    var hide_add_edit_Schedule = function () {
        $('.time-picker').unbind('changeTime.timepicker');
        $('.repeat-action-form-group').removeClass('hide');
        $.hideSubview();
    };

    $('.days-checkbox').on('ifToggled', function (e) {
        var el = $(this);
        var form = el.closest('form');
        var total_days = form.find('.days-checkbox:checked').length;

        if (total_days > 1 || total_days == 0) {
            form.find('.day-name').text('following day');
        } else {
            form.find('.day-name').text(weekDays[form.find('.days-checkbox:checked').first().val()]);
        }
    });

    $('input[name="repeat_action"]').on('ifClicked', function (e) {
        var el = $(this);
        var form = el.closest('form');

        if (el.val() == 'repeat') {
            form.find('.week-days-form-group input').removeAttr('disabled');
        } else {
            form.find('.week-days-form-group input').attr('disabled', 'disabled');
        }
    });

    $(document).on('submit', '.add-schedule-form', function (e) {
        e.preventDefault();
        var form = $(this);
        var now = moment();
        var schedule_from = $(this).find('input[name="schedule_from"]').val();
        var schedule_to = $(this).find('input[name="schedule_to"]').val();

        if (new Date(now.format('YYYY-MM-DD') + ' ' + schedule_from) >= new Date(now.format('YYYY-MM-DD') + ' ' + schedule_to)) {
            showToastr('Invalid time range', 'error', true, toastrShowDuration);
            return;
        }
        if (!$(this).find('.days-checkbox:checked').length) {
            showToastr('Please select a day for this schedule', 'error', true, toastrShowDuration);
            return;
        }

        $.blockUI({
            message: '<i class="fa fa-spinner fa-spin"></i> Saving new schedule...'
        });

        $.ajax({
            'url': form.attr('action'),
            'data': form.serialize(),
            'type': 'POST',
            'dataType ': 'json',
            'success': function (response) {
                var result = checkIfJson(response);

                if (result['isJson']) {
                    if (typeof (result['output'].error) == 'undefined') {

                        schedules = JSON.parse(result['output'].schedules);

                        $('#full-schedule').fullCalendar('removeEvents')
                        $('#full-schedule').fullCalendar('addEventSource', schedules);
                        $('#full-schedule').fullCalendar('refetchEvents');

                        showToastr(result['output'].message, 'success', true, toastrShowDuration);
                        $.hideSubview();
                    } else {
                        showToastr(result['output'].error, 'error', true, toastrShowDuration);
                    }

                    $.unblockUI();
                }

            },
            'error': function () {

            }
        });
    });

    $(document).on('submit', '.edit-schedule-form', function (e) {
        e.preventDefault();
        var form = $(this);
        var now = moment();
        var schedule_from = $(this).find('input[name="schedule_from"]').val();
        var schedule_to = $(this).find('input[name="schedule_to"]').val();

        if (new Date(now.format('YYYY-MM-DD') + ' ' + schedule_from) >= new Date(now.format('YYYY-MM-DD') + ' ' + schedule_to)) {
            showToastr('Invalid time range', 'error', true, toastrShowDuration);
            return;
        }

        $.blockUI({
            message: '<i class="fa fa-spinner fa-spin"></i> Saving new schedule...'
        });

        $.ajax({
            'url': form.attr('action'),
            'data': form.serialize(),
            'type': 'POST',
            'dataType ': 'json',
            'success': function (response) {
                var result = checkIfJson(response);

                if (result['isJson']) {
                    if (typeof (result['output'].error) == 'undefined') {

                        schedules = JSON.parse(result['output'].schedules);

                        $('#full-schedule').fullCalendar('removeEvents')
                        $('#full-schedule').fullCalendar('addEventSource', schedules);
                        $('#full-schedule').fullCalendar('refetchEvents');

                        showToastr(result['output'].message, 'success', true, toastrShowDuration);
                        $.hideSubview();
                    } else {
                        showToastr(result['output'].error, 'error', true, toastrShowDuration);
                    }

                    $.unblockUI();
                }

            },
            'error': function () {

            }
        });
    });

    $(document).on('submit', '.read-schedule-form', function (e) {
        e.preventDefault();
        var form = $(this);
        var formdata = form.serializeArray();
        formdata.push({name: 'schedule_id', value: thisSchedule.schedule_id});
        formdata.push({name: 'singleDay', value: thisSchedule.singleDay});
        formdata.push({name: 'schedule_date', value: moment(thisSchedule.start).format('YYYY-MM-DD')});

        var now = moment();
        var schedule_from = $(this).find('input[name="schedule_from"]').val();
        var schedule_to = $(this).find('input[name="schedule_to"]').val();

        if (new Date(now.format('YYYY-MM-DD') + ' ' + schedule_from) >= new Date(now.format('YYYY-MM-DD') + ' ' + schedule_to)) {
            showToastr('Invalid time range', 'error', true, toastrShowDuration);
            return;
        }

        $.blockUI({
            message: '<i class="fa fa-spinner fa-spin"></i> Saving new schedule...'
        });

        $.ajax({
            'url': form.attr('action'),
            'data': formdata,
            'type': 'POST',
            'dataType ': 'json',
            'success': function (response) {
                var result = checkIfJson(response);

                if (result['isJson']) {
                    if (typeof (result['output'].error) == 'undefined') {
                        schedules = JSON.parse(result['output'].schedules);

                        $('#full-schedule').fullCalendar('removeEvents')
                        $('#full-schedule').fullCalendar('addEventSource', schedules);
                        $('#full-schedule').fullCalendar('refetchEvents');

                        showToastr(result['output'].message, 'success', true, toastrShowDuration);
                        $.hideSubview();
                    } else {
                        showToastr(result['output'].error, 'error', true, toastrShowDuration);
                    }

                    $.unblockUI();
                }

            },
            'error': function () {

            }
        });
    });

    $(document).on('submit', '.delete-schedule-form', function (e) {
        e.preventDefault();
        var form = $(this);
        var formdata = form.serializeArray();
        formdata.push({name: 'schedule_id', value: thisSchedule.schedule_id});
        formdata.push({name: 'singleDay', value: thisSchedule.singleDay});
        formdata.push({name: 'schedule_date', value: moment(thisSchedule.start).format('YYYY-MM-DD')});

        $.blockUI({
            message: '<i class="fa fa-spinner fa-spin"></i> Deleting schedule...'
        });

        $.ajax({
            'url': form.attr('action'),
            'data': formdata,
            'type': 'POST',
            'dataType ': 'json',
            'success': function (response) {
                var result = checkIfJson(response);

                if (result['isJson']) {
                    if (typeof (result['output'].error) == 'undefined') {
                        schedules = JSON.parse(result['output'].schedules);

                        $('#full-schedule').fullCalendar('removeEvents')
                        $('#full-schedule').fullCalendar('addEventSource', schedules);
                        $('#full-schedule').fullCalendar('refetchEvents');

                        showToastr(result['output'].message, 'success', true, toastrShowDuration);
                        $.hideSubview();
                    } else {
                        showToastr(result['output'].error, 'error', true, toastrShowDuration);
                    }

                    $.unblockUI();
                }

            },
            'error': function () {

            }
        });
    });

    $('input[name="display_working_hours"]').on('ifClicked', function (e) {
        if ($(this).prop('checked')) {
            var minTime = '00:00:00';
            var maxTime = '24:00:00';
        } else {
            var minTime = '10:00:00';
            var maxTime = '22:00:00';
        }

        $('#full-schedule').fullCalendar('destroy');
        initializeScheduleFullCalendar({'minTime': minTime, 'maxTime': maxTime});
    });

    /* schedule end */

});