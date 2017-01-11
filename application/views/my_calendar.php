<?php
    $clinic_options = '';
    foreach ($dentist_clinics as $values) {
        $clinic_options .= "<option value='{$values['clinic_id']}'>{$values['clinic_name']}</option>";
    }
?>

<div class="content-wrapper pos-relative"><!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <!-- start: FULL CALENDAR PANEL -->
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 space20">
                                <a href="#newSchedule" class="btn btn-success add-schedule"><i class="fa fa-plus"></i> Add New Schedule</a>
                            </div>
                        </div>
                        <div class="row schedule-index">
                            <div class="col-sm-12">
                                <ul class="no-padding">
                                    <li>
                                        <div>
                                            <span class="pending-schedule"></span>
                                            Pending appointments
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <span class="confirmed-schedule"></span>
                                            Confirmed appointments
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="checkbox-inline padding-vert-0 text-bold float-right">
                                    <input type="checkbox" class="grey" name="display_working_hours" checked>
                                    Display only working hours
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="full-schedule" class="pos-relative" data-schedule-type="{{ $type }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: FULL CALENDAR PANEL -->
            </div>
        </div>

        <!-- Schedule -->

        <div id="newSchedule" style="display: none;">
            <div class="col-md-8 col-md-offset-2">
                <form class="add-schedule-form" action="<?php echo base_url('addSchedule'); ?>" method="POST">
                    <h3>Add schedule</h3>
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <label class="control-label">
                                    Start Time
                                </label>
                                <div class="input-group input-append bootstrap-timepicker">
                                    <input type="text" name="schedule_from" class="form-control time-picker first-input cursor-pointer" readonly>
                                    <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    End Time
                                </label>
                                <div class="input-group input-append bootstrap-timepicker">
                                    <input type="text" name="schedule_to" class="form-control time-picker cursor-pointer" readonly>
                                    <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label name="clinic_name">Clinic Name :</label>
                                <select class="form-control" name="clinic_id" id="clinic_id" >
                                    <option value="">Select Clinic</option>
                                    <?php echo $clinic_options ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    Select Day(s)
                                </label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="0" name="days[]" class="grey days-checkbox">
                                        Sunday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="days[]" class="grey days-checkbox">
                                        Monday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="2" name="days[]" class="grey days-checkbox">
                                        Tuesday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="3" name="days[]" class="grey days-checkbox">
                                        Wednesday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="4" name="days[]" class="grey days-checkbox">
                                        Thursday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="5" name="days[]" class="grey days-checkbox">
                                        Friday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="6" name="days[]" class="grey days-checkbox">
                                        Saturday
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="#" class="btn btn-info close-subview-button">
                                Close
                            </a>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-info save-new-event" type="submit">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="editSchedule" style="display: none;">
            <div class="col-md-8 col-md-offset-2">
                <form class="edit-schedule-form" action="<?php echo base_url('addSchedule'); ?>" method="POST">
                    <h3>Add schedule</h3>
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <label class="control-label">
                                    Start Time
                                </label>
                                <div><strong class="schedule_from_text"></strong></div>
                                <input type="hidden" name="days">
                                <input type="hidden" name="schedule_from">
                                <input type="hidden" name="schedule_date">
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    End Time
                                </label>
                                <div class="input-group input-append bootstrap-timepicker">
                                    <input type="text" name="schedule_to" class="form-control time-picker first-input cursor-pointer" readonly>
                                    <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label name="clinic_name">Clinic Name :</label>
                                <select class="form-control" name="clinic_id" id="clinic_id" >
                                    <option value="">Select Clinic</option>
                                    <?php echo $clinic_options ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="repeat" name="repeat_action" class="grey" checked>
                                        <span class="radio-label" replaced-day=""> Repeat for all <span class="day-name"></span>s</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="oneday" name="repeat_action" class="grey">
                                        <span class="radio-label" replaced-day=""> Apply only for (<span class="single-day text-bold"></span>)</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group week-days-form-group">
                                <label class="control-label">
                                    Select Day(s)
                                </label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="0" name="days[]" class="grey days-checkbox">
                                        Sunday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="days[]" class="grey days-checkbox">
                                        Monday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="2" name="days[]" class="grey days-checkbox">
                                        Tuesday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="3" name="days[]" class="grey days-checkbox">
                                        Wednesday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="4" name="days[]" class="grey days-checkbox">
                                        Thursday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="5" name="days[]" class="grey days-checkbox">
                                        Friday
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="6" name="days[]" class="grey days-checkbox">
                                        Saturday
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="#" class="btn btn-info close-subview-button">
                                Close
                            </a>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-info save-new-event" type="submit">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="readSchedule" class="readFullEvent" style="display: none;">
            <div class="col-md-8 col-md-offset-2">
                <form class="read-schedule-form" action="<?php echo base_url('editSchedule'); ?>" method="POST">
                    <h3>Edit schedule</h3>
                    <div class="event-start margin-top-0 space15">
                        <div class="event-day">
                            <h2></h2>
                        </div>
                        <div class="event-date">
                            <h3></h3>
                            <h4></h4>
                        </div>
                        <div class="event-time">
                            <h3>
                                <i class="fa fa-clock-o"></i>
                                <span class="from-to"></span>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label class="control-label">
                                    Start Time
                                </label>
                                <div class="input-group input-append bootstrap-timepicker">
                                    <input type="text" name="schedule_from" class="form-control time-picker first-input cursor-pointer" readonly>
                                    <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">
                                    End Time
                                </label>
                                <div class="input-group input-append bootstrap-timepicker">
                                    <input type="text" name="schedule_to" class="form-control time-picker cursor-pointer" readonly>
                                    <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                                </div>
                            </div>

                            <div class="form-group repeat-action-form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="repeat" name="repeat_action" class="grey" checked>
                                        <span class="radio-label" replaced-day=""> Repeat for all <span class="day-name"></span>s</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="oneday" name="repeat_action" class="grey">
                                        <span class="radio-label" replaced-day=""> Apply only for (<span class="single-day text-bold"></span>)</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="#" class="btn btn-info close-subview-button">
                                Close
                            </a>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-info save-new-event" type="submit">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="deleteSchedule" class="readFullEvent" style="display: none;">
            <div class="col-md-8 col-md-offset-2">
                <form class="delete-schedule-form" action="<?php echo base_url('deleteSchedule'); ?>" method="POST">
                    <h3>Delete schedule</h3>
                    <div class="event-start margin-top-0 space15">
                        <div class="event-day">
                            <h2></h2>
                        </div>
                        <div class="event-date">
                            <h3></h3>
                            <h4></h4>
                        </div>
                        <div class="event-time">
                            <h3>
                                <i class="fa fa-clock-o"></i>
                                <span class="from-to"></span>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group repeat-action-form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="repeat" name="repeat_action" class="grey" checked>
                                        <span class="radio-label"> Delete for all <span class="day-name"></span>s</span>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="oneday" name="repeat_action" class="grey">
                                        <span class="radio-label"> Delete only for (<span class="single-day text-bold"></span>)</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="#" class="btn btn-info close-subview-button">
                                No
                            </a>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-info save-new-event" type="submit">
                                Yes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Schedule end -->
    </section>
    
    <div class="subviews">
        <div class="subviews-container"></div>
    </div> 
</div>

<script>
    var get_schedule_by_date_range_href = "<?php echo base_url('fetchSameDayNextSchedule'); ?>";
    var schedules = <?php echo $schedules; ?>;
    console.log(schedules);
    var totalSchedulesWeeksToShow = <?php echo TOTAL_SCHEDULE_WEEKS_TO_SHOW ?>;
    /*var addTotalWeeks = 2;
     var temp = new Date();
     var scheduleMinDate = new Date();
     scheduleMinDate.setHours(0,0,0,0);
     //get week end of scheduleMinDate AND add next 2 weeks to scheduleMaxDate
     var scheduleMaxDate = new Date(temp.setDate(temp.getDate() + (6 - temp.getDay()) + (addTotalWeeks * 7)));*/
</script>
