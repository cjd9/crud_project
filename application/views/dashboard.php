<div class="content-wrapper">
    <div class="box">
        <div class="box-body">
            <div class="col-md-12">
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
               
            </div>
            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="appointment_wrapper">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="appointment_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                   
                                    
                                    
                                    
                                    <table  id="appointment" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Patient Name:</th>
                <th>Patient Phone</th>
                <th>Date</th>
                <th>Appointment Time</th>
                <th>Status</th>
                <th>Actions</th>
               
            </tr>
        </thead>
        <tfoot>
            <tr>
             <th>Patient Name:</th>
                <th>Patient Phone</th>
                <th>Date</th>
                <th>Appointment Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </tfoot>
           <tbody>
                                            <?php 
                                                foreach ($appointment_details as $row) {
                                            ?>
                                            <tr class="odd"  role="row">
                                                <td class="sorting_1"><?php echo $row['first_name']." ".$row['last_name']."<a href=' ". HOME_URL ."viewpatientdetails/" .$row['user_id'] ."  ' target='dentistview'> <i class='fa fa-external-link-square' aria-hidden='true' title='Click to view Patient Details'></i></a>"; ?></td>
                                                <td><?php echo $row['mobile_no'];?></td>
                                                <td><?php echo date("d-m-Y", strtotime($row['appointment_date'])); ?></td>
                                                <td><?php echo $row['appointment_time']; ?></td>
                                                <td> OPEN </td>
                                                <td class="action">
                                                    <input type="hidden" name="aid" class="aid" value="<?php echo $row['appointment_id']; ?>">
                                                    <button type='submit'  class="btn btn-primary btn-block action_btn" name='accept' value='1' />Accept </button> 
                                                    <button type='submit'  class="btn btn-primary btn-block action_btn" name='reject' value='2' />Reject</button> 
                                                    <!--  <button type='submit'  class="btn btn-primary btn-block action_btn" name='reschedule' value='3' />Reschedule</button>-->
                                                </td>
                                            </tr>
                                            <?php 
                                                } 
                                            ?>
                </tbody>
                                        
                                    </table>
                                    
                                    
                                    
                                </div>
                            </div>
                            <div class="row">
                              
               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
       
    $('#appointment').DataTable();
    
    $(function () {
    $("#datepickerbooking").datepicker({dateFormat: 'yy-mm-dd', minDate: -0}); 
});

  $('#datepickerbooking').on('change', function () {
      
            var date = $('#datepickerbooking').datepicker({dateFormat: 'yy-mm-dd', minDate: -0}).val();
//            var user_id = $('#user_id').val();
//            var clinic_id = $('#clinic_id').val();
            var data = {'date': date};
        
        $.post("dashboard/CheckByDate", data, function (result, textStatus)
        {
            console.log(JSON.parse(result));
            
            $("tbody tr").remove();
            
//            $("tbody").html("<tr class='odd'  role='row'> <td class='sorting_1'>Patient Name</td><td>PAtient Phone</td><td>Date</td><td>Appointment Time</td><td> OPEN </td>\n\
//    <td class='action'>  <input type='hidden' name='aid' class='aid' value=''>\n\
//    <button type='submit' class='btn btn-primary btn-block' name='accept' value='1'>Accept</button>\n\
//  <button type='submit' class='btn btn-primary btn-block' name='reject' value='2'>Reject</button> \n\
//</td></tr>");





                                            

        });
        
        setTimeout('actions_event_bind()',1000);
    });

});
    </script>
