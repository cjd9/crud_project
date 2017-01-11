

<style>
    

    td.details-control {
    background: url('../resources/img/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('../resources/img/details_close.png') no-repeat center center;
}
</style>
 
 
 <div class="content-wrapper" style="min-height: 1126px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#patients_personal" data-toggle="tab" aria-expanded="false">View Personal Patients</a>
                        </li>
                        <li class="">
                            <a href="#patients_ocare" data-toggle="tab" aria-expanded="true">View Ocare Patients</a>
                        </li>
                        <li class="">
                            <a href="#add_personal_patient" data-toggle="tab" aria-expanded="true">Add a Personal Patient</a>
                        </li>
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="add_personal_patient">
                            <h2>Add Patient</h2>
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" id="addnewclinic" data-target="#addPatient">Add Patient</button>
                        </div>
                        <div class="tab-pane active" id="patients_personal">
                            <div class="table-responsive">
                                <table id="personal_patients" class="display table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            
                                          
                                            <th>Patient Name</th>
                                            <th>Patient Email</th>
                                            <th>Mobile No</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            
                                            
                                            <th>Patient Name</th>
                                            <th>Patient Email</th>
                                            <th>Mobile No</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                        </div>  
                        <div class="tab-pane" id="patients_ocare">
                            
                               <div class="table-responsive">
                                <table id="ocare_patients" class="display table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            
                                          
                                            <th>Patient Name</th>
                                            <th>Patient Email</th>
                                            <th>Mobile No</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            
                                            
                                            <th>Patient Name</th>
                                            <th>Patient Email</th>
                                            <th>Mobile No</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                        </div>
                            <div class="modal fade" id="addPatient" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Patient Details</h4>
                <div id="patientvalidationerrors" class="alert alert-danger" style="display:none;" > </div>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id' => 'addnewpatient');
                echo form_open('addNewPatient', $attributes);
                ?>
                <div class="col-sm-6 form-group"> 
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" class="form-dob form-control" id="first_name">
                </div>
                <div class="col-sm-6 form-group"> 
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" class="form-last_name form-control" id="last_name">
                </div>
                <div class="col-sm-6 form-group"> 
                    <input type="number" name="mobile_no"  class="form-control" placeholder="Mobile No" class="form-mobile_no form-control" id="mobile_no">
                </div>
                <div class="col-sm-6 form-group">
                    <input type="text" name="email_id"  class="form-control" placeholder="Email" class="form-email_id form-control" id="email_id">
                </div>
                <div class="col-sm-4 form-group">  
                    Gender: 
                    <label class="radio-inline">
                        <input type="radio" class="gender" name="gender"  value="Male">Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio"  class="gender"  name="gender" value="Female" >Female
                    </label>
                </div>
                <div class="col-sm-4 form-group">  
                    <select class="form-control" id="city" name="city">
                        <option value="">Select a City</option>
                        <?php foreach ($city as $value) {
                        ?>
                        <option value="<?php echo $value['id'] ?>"  ><?php echo $value['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4 form-group"> 
                    <select class="form-control" id="state" name="state">
                        <option value="">Select a State</option>
                        <?php foreach ($state as $value) {
                        ?>
                            <option value="<?php echo $value['id'] ?>" ><?php echo $value['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12 form-group">
                    <textarea name="address"  placeholder="Address" class="form-address form-control" id="address"></textarea>
                </div>
                <div class="col-sm-6 form-group"> Pincode  
                    <input type="text" name="pincode"  placeholder="Pincode" class="form-pincode form-control" id="pincode">
                </div> 
                <div class="col-sm-6 form-group">
                    Date Of Birth: 
                    <input type="date" name="dob"   placeholder="Date Of Birth" class="form-dob form-control" id="dob">
                </div>
                <div class="col-sm-12 form-group">
                    <textarea name="about"  placeholder="Patient Comments" class="form-about form-control" id="about"></textarea>
                </div>
                <div class="col-sm-12 form-group">  
                    Is the Patient Insured: 
                    <label class="radio-inline">
                        <input type="radio" name="is_insured" class="is_insured" value="1" >Yes
                    </label>
                    <label class="radio-inline"> 
                        <input type="radio" name="is_insured" class="is_insured"  value="0" >No
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12 form-group"> 
                    <button type="submit" id="addPatientToDb" class="btn btn-success">Add Patient</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
                    </div>
                </div>             
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    function format ( d ) 
    {
        // `d` is the original data object for the row
        return  '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                '<td>Full name:</td>'+
                '<td>'+d.user_id+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Extension number:</td>'+
                '<td>'+d.mobile_no+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>Extra info:</td>'+
                '<td>And any further details here (images etc)...</td>'+
                '</tr>'+
                '</table>';
    }

    $(document).ready(function() {
        var table = $('#personal_patients').DataTable( {
            "ajax": "dashboard/getPatientFullDetails",
            "columns": [
              
                { "data": "name" },
                
                { "data": "email_id" },
                { "data": "mobile_no" }
            ],
            "order": [[1, 'asc']]
        });
        
               var table = $('#ocare_patients').DataTable( {
            "ajax": "dashboard/getOcarePatientFullDetails",
            "columns": [
              
                { "data": "name" },
                
                { "data": "email_id" },
                { "data": "mobile_no" }
            ],
            "order": [[1, 'asc']]
        });


        // Add event listener for opening and closing details
        $('#personal_patients tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr ); 
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        });
    });
</script>
