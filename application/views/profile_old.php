<script>
        $(function () {
            var availableTags = <?php echo $clinic_details; ?>;
            $("#tags").autocomplete({
                minLength: 0,
                source: availableTags,
                focus: function (event, ui) {
                    $("#tags").val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $("#tags").val(ui.item.label);
                    $("#tags-id").val(ui.item.value);
                    $("#tags-address").val(ui.item.add);

                    return false;
                }
            })
                    .autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                        .append("<a>" + item.label + "</a>")
                        .appendTo(ul);
            };

        });
</script>
<a href="dental/showProfile">Edit Profile</a>

<?php
//echo base_url();
//
//print_r($doc_details);
?>
</br>
</br>
</br>


<?php
foreach ($images as $image) {
    echo '<img class="img-thumbnail" alt="Cinque Terre"   src ="' . base_url() . 'uploads/thumbnails/' . $image['image_name'] . '">';
}
?>
<div class="container">

    <?php
    $attributes = array('id' => 'timeslots', 'name' => 'timeslots', 'class' => 'form-inline', 'role' => 'form');
    echo form_open(base_url('addTimeSlot'), $attributes);
    ?>
    <div id="error_login" > </div>
    <input type="hidden" name="user_id" id="user_id" value="15">
    <div class="form-group">
        <select class="form-control" name="clinic_id" id="clinic_id" >

            <option value="">Select Clinic</option>
            <?php foreach ($dentist_details as $values) { ?>
                <option value="<?php echo $values['clinic_id']; ?>"><?php echo $values['clinic_name'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label name="dateslot">Date : </label>
        <input type="text" class="form-control" placeholder="Date"  name="date" id="datepicker"/>

    </div>

    

    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg " data-toggle="modal" id="slots" data-target="#myModal">Time Slots</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body" id="timeslot">

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <button type="submit" id="date_submit_btn" class="btn btn-primary">Update Slots</button>








    <?php echo form_close(); ?>


    <br>
    <br>
    <br>
    <hr>


    --------------------------------------------------------------------------------------------------------------------------------------
    <?php
    $attributes = array('id' => 'addclinic', 'name' => 'addclinic', 'class' => 'cd-form');
    echo form_open('', $attributes);
    ?>




    <h4>Add New Clinic  </h4>
    <label for="tags">Clinic Name: </label>
    <input type="hidden" value="15" name="dentist_id" id="dentist_id">
    <input type="select" name="clinic_name" value="" id="tags">
    <input type="hidden" name="clinic_id" id="tags-id">
    <input type="text" style="width:50%;" name="clinic_add" id="tags-address" disabled>

    <input type="submit" id="checknewclinic" value="submit">
    <?php
    echo form_close();
    ?>


    <h2>Clinic Add</h2>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" id="addnewclinic" data-target="#myModal1">Add New CLinic</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  id="closeClinicModal" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Your Clinic isnt registered with us. Please Fill the Form Below</h4>
                </div>
                <div class="modal-body">
                    <div id="validationerrors"></div>
                    <?php
                    $attributes = array('name' => 'addnewclinic');
                    echo form_open(base_url('dental/addNewClinicToMaster'), $attributes);
                    ?>
                    <input type="text" name="clinic_name" id="clinic_name" placeholder="Enter Clinic Name" /> </br>  </br> 
                    <input type="text" name="clinic_address" id="clinic_address" placeholder="Enter Clinic Address" /> </br></br> 
                    <input type="text" name="clinic_email" id="clinic_email" placeholder="Enter Clinic Email id" /> </br></br> 
                    <input type="text" name="city" id="city" placeholder="Enter Clinic City" /> </br></br> 
                    <input type="text" name="clinic_mobile_no" id="clinic_mobile_no" placeholder="Enter Clinic Contact No." /></br> </br> 
                    <input type="text" name="clinic_office_no" id="clinic_office_no" placeholder="Enter Clinic Office No."></br> </br> 
                    <select name="state" id="state">
                        <option value="">Select State</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Puducherry">Puducherry</option>
                    </select>
                    </br></br> 
                    <input type="text" name="pin" id="pin" placeholder="Enter Clinic Pincode" /> </br></br> 
                    <input type="submit" id="clinic_add">
                    <?php
                    echo form_close();
                    ?>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>





            </div>
        </div>
    </div>



    <hr>

    -----------------------------------------------------------------------------------------------------------------------------------
    <table border="2" class="table-bordered" >
        <tr>
        <tr>
            <th>Appointment ID</th>
            <th>Patient Name</th> 
            <th>Appointment Date</th>
            <th>Appointment Time</th>

            <th>Action</th>
        </tr>

        <?php foreach ($appointment_details as $row) {
            ?> 

            <tr>
                <td class="aid"><?php echo $row['appointment_id'] ?></td>
                <td><?php echo $row['patient_name'] ?></td> 
                <td><?php echo $row['appointment_date'] ?></td>
                <td><?php echo $row['appointment_time'] ?></td>
                <td class="action"> <button type='submit'  class="btn btn-primary btn-block" name='accept' value='1' />Accept </button> <button type='submit'  class="btn btn-primary btn-block" name='reject' value='2' />Reject</button> <button type='submit'  class="btn btn-primary btn-block" name='reschedule' value='3' />Reschedule</button></td>
            </tr>  

        <?php } ?>


    </table>


    <div class="patient">


        <h2>Add Patient</h2>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" id="addnewclinic" data-target="#addPatient">Add Patient</button>
        <div class="modal fade" id="addPatient" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Patient Details</h4>
                        <span id="patientvalidationerrors"> </span>
                    </div>
                    <div class="modal-body" >
                        <?php
                        $attributes = array('name' => 'addnewclinic');
                        echo form_open(base_url('dental/addNewPatient'), $attributes);
                        ?>
                        <div class="form-group">  
                            <div class="col-sm-6 form-group"> <input type="text" name="first_name"   placeholder="First Name" class="form-dob form-control" id="first_name">
                            </div>
                            <div class="col-sm-6 form-group"> <input type="text" name="last_name"  placeholder="Last Name" class="form-last_name form-control" id="last_name">
                            </div>
                            <div class="col-sm-6 form-group">  <input type="number" name="mobile_no"  placeholder="Mobile No" class="form-mobile_no form-control" id="mobile_no">
                            </div>
                            <div class="col-sm-6 form-group">  <input type="text" name="email_id"  placeholder="Email" class="form-email_id form-control" id="email_id">
                            </div>
                            <div class="col-sm-4 form-group">  
                                Gender: 
                                <label class="radio-inline">

                                    <input type="radio" name="gender" value="Male" >Male</label>
                                <label class="radio-inline"> 
                                    <input type="radio" name="gender" value="Female" >Female</label>
                            </div>


                            <div class="col-sm-4 form-group">  <select class="form-control" id="city" name="city">
                                    <option value="">Select a City</option>
                                    <?php foreach ($city as $value) {
                                        ?>
                                        <option value="<?php echo $value['id'] ?>"  ><?php echo $value['name'] ?></option>
                                    <?php } ?>

                                </select>


                            </div>  

                            <div class="col-sm-4 form-group"> <select class="form-control" id="state" name="state">
                                    <option value="">Select a State</option>
                                    <?php foreach ($state as $value) {
                                        ?>
                                        <option value="<?php echo $value['id'] ?>" ><?php echo $value['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>



                            <div class="col-sm-12 form-group">
                                <textarea name="address"  placeholder="Address" 
                                          class="form-address form-control" id="address"></textarea>

                            </div>
                            <div class="col-sm-6 form-group"> Pincode  <input type="text" name="pincode"  placeholder="Pincode" class="form-pincode form-control" id="pincode">
                            </div> 

                            <div class="col-sm-6 form-group">Date Of Birth: <input type="date" name="dob"   placeholder="Date Of Birth" class="form-dob form-control" id="dob">
                            </div>

                            <div class="col-sm-12 form-group">

                                <textarea name="about"  placeholder="Patient Comments" 
                                          class="form-about form-control" id="about"></textarea>
                            </div>



                        </div>  

                        <div class="col-sm-12 form-group">  
                            Is the Patient Insured: 
                            <label class="radio-inline">

                                <input type="radio" name="is_insured" id="is_insured" value="1" >Yes</label>
                            <label class="radio-inline"> 
                                <input type="radio" name="is_insured" id="is_insured"  value="0" >No</label>
                        </div>
                        <br> <br> 
<div class="col-sm-12 form-group"> 
                <button type="submit" id="addPatientToDb" class="btn btn-success">Add Details</button>
</div>

                    </div>
                    <div class="modal-footer">
                     

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

    </div>
    
    ---------------------------------------------------------------------------------------------------------------------------------------------------
    <hr>
   

</div>           


<script>

    $("#closeClinicModal").on("click", function () {
        window.location = '<?php echo base_url(); ?>';
    });



</script>
