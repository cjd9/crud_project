<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#confirmedappointments" data-toggle="tab" aria-expanded="true">Confirmed Appointments</a>
                        </li>
                        <li class="">
                            <a href="#rejectedappointments" data-toggle="tab" aria-expanded="false">Rejected Appointments</a>
                        </li>
                        <li class="">
                            <a href="#addnewappointment" data-toggle="tab" aria-expanded="false">Add a Personal Appointment</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="confirmedappointments">     
                            
                                  <div class="col-md-4">
                    <div class="form-group">
                        <label>Select Date</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="datepickerbooking" class="form-control pull-right"  placeholder="Select Date">
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->
                </div>
                            <table id="appointments" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Appointment ID</th>
                                        <th>Patient Name</th> 
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Clinic</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Appointment ID</th>
                                        <th>Patient Name</th> 
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Clinic</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                       
                            </table>
                        </div>
                        <div class="tab-pane" id="rejectedappointments">
                            <table border="1" class="table table-bordered table-striped dataTable no-footer">
                                <tr>
                                    <th>Appointment ID</th>
                                    <th>Patient Name</th> 
                                    <th>Appointment Date</th>
                                    <th>Appointment Time</th>
                                    <th>Clinic</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                    if (!empty($appointment_details)) 
                                    {
                                        foreach ($appointment_details_rejected as $row) 
                                        {
                                ?> 
                                            <tr>
                                                <td class="aid"><?php echo $row['appointment_id'] ?></td>
                                                <td><?php echo $row['patient_name'] ?></td> 
                                                <td><?php echo $row['appointment_date'] ?></td>
                                                <td><?php echo $row['appointment_time'] ?></td>
                                                <td><?php echo $row['clinic_name'] ?></td>
                                                <td>Rejected</td>
                                            </tr>  
                                    <?php
                                        }
                                    } 
                                    ?>
                            </table>
                        </div>
                        <div class="tab-pane" id="addnewappointment">
                            <div class="add-appointment">
                                <h3>Add Personal Appointments</h3>
                                <?php
                                    $attributes = array('id' => 'timeslots', 'name' => 'timeslots', 'class' => 'form-inline', 'role' => 'form');
                                    echo form_open(base_url('addTimeSlotForPatient'), $attributes);
                                ?>
                                <div id="error_login" > </div>
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->user_id ?>">
                                <div class="form-group">
                                    <label for="patient_name">Patient Name :</label>
                                    <select class="form-control" name="patient_id" id="patient_id">
                                        <option value="">Select Patient</option>
                                        <?php 
                                        foreach ($patient_details as $values) 
                                        { 
                                        ?>
                                            <option value="<?php echo $values['user_id']; ?>">
                                        <?php
                                            echo $values['first_name'];
                                            echo" ";
                                            echo $values['last_name'];
                                            ?>
                                            </option>
                                        <?php 
                                        } 
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label name="clinic_name">Clinic Name :</label>
                                    <select class="form-control" name="clinic_id" id="clinic_id" >
                                        <option value="">Select Clinic</option>
                                        <?php 
                                            foreach ($clinic_details as $values) 
                                            { 
                                        ?>
                                                <option value="<?php echo $values['clinic_id']; ?>"><?php echo $values['clinic_name'] ?></option>
                                        <?php 
                                            } 
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label name="dateslot">Appointment Date : </label>
                                    <input type="text" class="form-control" placeholder="Date"  name="date" id="appointmentdate"/>
                                </div>
                                <hr>
                                <div id="timeslot" class="form-group">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button type="submit" id="date_submit_btn" class="btn btn-primary">Update Slots</button>
                                </div>
                                <hr>
                                <?php echo form_close(); ?>
                            </div>
                            <div class="patient">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
         $(function () {
    $("#datepickerbooking").datepicker({dateFormat: 'yy-mm-dd', minDate: -0}); 
});
        
       
        var table = $('#appointments').DataTable({
            
            
        "ajax": "dashboard/doctorAppointmentsDatatable",
            "columns": [
            { "data": "appointment_id" },
            { "data": "patient_name" },
            { "data": "appointment_date" },
            { "data": "appointment_time" },
            { "data": "clinic_name" },
            { "data": "" ,
            "defaultContent": "CONFIRMED"}
        ],
         "destroy": true

    });
       
        
         $('#datepickerbooking').on('change', function () {
         var date = $('#datepickerbooking').datepicker({dateFormat: 'yy-mm-dd', minDate: -0}).val();
//            var user_id = $('#user_id').val();
//            var clinic_id = $('#clinic_id').val();
            var data = {'date': date};
     var table = $('#appointments').DataTable({
            
             
        "ajax": {
            "url":"dashboard/doctorAppointmentsDatatableByDate",
            "type": "POST",
            "data":data
                    },
             "columns": [
            { "data": "appointment_id" },
            { "data": "patient_name" },
            { "data": "appointment_date" },
            { "data": "appointment_time" },
            { "data": "clinic_name" },
            { "data": "" ,
            "defaultContent": "CONFIRMED"}
        ],
         "destroy": true

    });
    });
        
    });
</script>
