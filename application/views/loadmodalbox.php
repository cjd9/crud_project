  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script>
$(document).ready(function() {
                 
   $( "#addnewclinic" ).trigger( "click" );

});

</script>

                 <div class="table-responsive">
                                    <table border="1" class="table table-bordered table-striped dataTable no-footer">
                                        <tr>
                                        <tr>
                                            <th>Appointment ID</th>
                                            <th>Patient Name</th> 
                                            <th>Appointment Date</th>
                                            <th>Appointment Time</th>
                                            <th>Clinic</th>
                                            <th>Status</th>
                                        </tr>

                                        <?php
                                        if (!empty($appointment_details)) {
                                            foreach ($appointment_details as $row) {
                                                ?> 

                                                <tr>
                                                    <td class="aid"><?php echo $row['appointment_id'] ?></td>
                                                    <td><?php echo $row['patient_name'] ?></td> 
                                                    <td><?php echo $row['appointment_date'] ?></td>
                                                    <td><?php echo $row['appointment_time'] ?></td>
                                                    <td><?php echo $row['clinic_name'] ?></td>
                                                    <td>Confirmed</td>
                                                </tr>  

                                                <?php
                                            }
                                        } else {
                                            echo "No Upcoming appointments";
                                        }
                                        ?>


                                    </table>
                                     </div> 