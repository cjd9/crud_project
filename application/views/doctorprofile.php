<?php 
$specialityArray = $dentist_details['specialities'];
$treatmentsArray = $dentist_details['treatments'];

?>
<?php $education_selected=(explode(",",$dentist_details['education'])); ?>
<div class="content-wrapper"><!-- Main content -->
    <section class="content">
        
        <?php //print_r($education_master); die; ?>
        
        
        <div class="container container-small panel">
            <div id="profile_pic" class="col-md-3 doc-profile-header text-center">
                <img id="profileimg" alt="User Image" class="img-circle doc-profile-pic" src="<?php if ($dentist_details['profile_picture']=='1'): echo PRPICTH_URL . '/' . $this->session->user_id . '.jpg'; else: echo PRPICTH_URL . '/dummy.png'; endif; ?>">
                <iframe name='hidden-iframe' id='hidden-iframe' style='display:none'></iframe>
                <div id="newprpic" class="changprpic" action="<?php echo base_url('dental/prpicupl'); ?>">
                    <img  src="<?php echo IMG_URL; ?>editicon.png" width="32" height="32" alt="" title="Click to change profile picture" />
                </div>
                <div id="removeprpic" class="removeprpic" user_id="<?php echo $this->session->user_id; ?>">
                    <img src="<?php echo IMG_URL; ?>remove-icon.png" title="Click to remove profile picture" />
                </div>
            </div>
            <div class="col-md-9 doc-profile-header" style="margin-left:10px;">
                <h3><?php echo $dentist_details['salutation'].". ".$dentist_details['first_name']." ".$dentist_details['last_name'];?></h3>
                <div>
                <?php
                    foreach ($dentist_details['specialities'] as $key=>$value) 
                    {
                ?>
                        <span class="label label-primary"><?php echo $value; ?></span>
                <?php 
                    }
                ?>
                </div>
                <div>
                <?php
                 if(isset($treatmentsArray)) 
                                                 
                     {
                 
                    foreach ($dentist_details['treatments'] as $key=>$value) 
                    {
                ?>
                        <span class="label label-warning"><?php echo $value; ?></span>
                <?php 
                    }
                   }  
                ?>
                </div>
                <hr>
                <p><?php echo $dentist_details['about'];?></p>
                <button class="btn-danger btn pull-right">Edit Profile <i class="fa fa-pencil"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="" id="settings">
                            <?php $attributes = array('class' => 'registration-form, form-horizontal', 'role' => 'form', 'id' => 'updateDentist', 'enctype' => 'multipart/form-data');
                                echo form_open(base_url('updateDentistDetails'), $attributes);
                            ?> 
                                <div class="form-group">
                                    <label for="inputsalutation" class="col-sm-2 control-label">Salutation</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="salutation" value="Dr"  class="form-salutation form-control" id="salutation" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control disabled-edit" name="first_name" id="first_name" placeholder="First Name" value="<?php echo $dentist_details['first_name'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control disabled-edit" name="last_name" id="last_name" placeholder="Last name" value="<?php echo $dentist_details['last_name'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDOB" class="col-sm-2 control-label">Date of Birth</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="dob" id="dob" placeholder="Date of birth" value="<?php echo $dentist_details['date_of_birth'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputdci" class="col-sm-2 control-label">DCI Registration Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="dci_number" id="dci_number" placeholder="DCI registration number" value="<?php echo $dentist_details['dci_reg_no'];?>">
                                    </div>
                                </div>
                            
                            
                            <div class="form-group">
                                    <label for="education" class="col-sm-2 control-label">Education</label>
                                    <div class="col-sm-8">
                                                   <select class="form-control select2" name="education[]" id="education" multiple="multiple" data-placeholder="Select your Education" style="width: 100%;">
                                                   <?php foreach ($education_master as $value) { ?>
                                        <option value="<?php echo $value; ?>" <?php if (in_array($value, $education_selected)) echo "selected"; ?>  <?php ?> ><?php echo $value ?></option>
                                    <?php } ?>
                                                   
                                                </select>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly value="<?php echo $dentist_details['email_id'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMobile" class="col-sm-2 control-label">Mobile</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="mobile" id="mobile" readonly     placeholder="Mobile number" maxlength="10" value="<?php echo $dentist_details['mobile_no'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputGender" class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" id="gender" value="Male" <?php if ($dentist_details['gender'] == 'Male') echo "checked" ?>>Male
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="gender" id="gender" value="Female" <?php if ($dentist_details['gender'] == 'Female') echo "checked" ?>>Female
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAbout" class="col-sm-2 control-label">About Me</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="about" name="about" placeholder="Address"> <?php echo trim($dentist_details['about']);?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputLocality" class="col-sm-2 control-label">Locality</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="locality" id="locality" placeholder="Locality" value="<?php echo $dentist_details['locality'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="address" name="address" placeholder="Address"> <?php echo trim($dentist_details['address']);?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCity" class="col-sm-2 control-label">City</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="city" name="city">
                                            <option value="">Select a City</option>
                                        <?php 
                                            foreach ($city as $value) {
                                        ?>
                                                <option value="<?php echo $value['id'] ?>" <?php if ($value['id'] == $dentist_details['city']) echo "selected" ?> ><?php echo $value['name'] ?></option>
                                        <?php 
                                            } 
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputState" class="col-sm-2 control-label">State</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="state" name="state">
                                            <option value="">Select a State</option>
                                        <?php 
                                            foreach ($state as $value) {
                                        ?>
                                                <option value="<?php echo $value['id'] ?>" <?php if ($value['id'] == $dentist_details['state']) echo "selected" ?>><?php echo $value['name'] ?></option>
                                        <?php 
                                            } 
                                        ?>
                                        </select>
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <label for="inputPin" class="col-sm-2 control-label">Pin Code</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Pincode" maxlength="6"  value="<?php echo $dentist_details['pincode'];?>">
                                    </div>
                                </div>
                                <div class ="form-group">
                                    <label for="inputSpecialities" class="col-sm-2 control-label">Specialities </label>
                                    <div class="checkbox col-sm-8">
                                    <?php
                                        $i = 0;
                                        $flag = 0;
                                        foreach ($speciality as $value) {
                                            if ($i == '4' || $i == '8' || $i == '12') 
                                            {
                                                echo'</div>';
                                                $flag = 0;
                                            }
                                            if ($flag == 0) 
                                            {
                                                echo' <div class="col-sm-3 form-group">';
                                            }
                                            echo' <label><input type="checkbox" name="speciality[]" class="speciality" value="' . $value['name'] . '" ';
                                           if(!empty($specialityArray)) 
                                            {
                                               foreach ($specialityArray as $sid) {
                                                if ($value['name'] == $sid)
                                                    echo "checked";
                                             }
                                                
                                           } 
                                            echo' >' . $value['name'] . '</label>';
                                            $flag = 1;
                                            $i++;
                                        }
                                    ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSpecialities" class="col-sm-2 control-label">Treatments </label>
                                    <div class="col-sm-8">
                                        <div class="checkbox">
                                        <?php
                                            $i = 0;
                                            $flag = 0;
                                            foreach ($treatments as $value) {
                                                if ($i == '4' || $i == '8' || $i == '12') 
                                                {
                                                    echo'</div>';
                                                    $flag = 0;
                                                }
                                                if ($flag == 0) 
                                                {
                                                    echo' <div class="col-sm-3 form-group">';
                                                }
                                                echo' <label><input type="checkbox" name="treatment[]" class="treatment" value="' . $value['treatment_name'] . '" ';
                                                
                                                if(isset($treatmentsArray)) 
                                                { 
                                                    foreach ($treatmentsArray as $sid) {
                                                    if ($value['treatment_name'] == $sid)
                                                    echo "checked";
                                                } 
                                                
                                            }
                                                echo'>' . $value['treatment_name'] . '</label>';
                                                $flag = 1;
                                                $i++;
                                            }
                                        ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Experience (in years)</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="experience" id="experience" placeholder="Experience (In years)" value="<?php echo $dentist_details['experience']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputFees" class="col-sm-2 control-label">Consultation Fees (Rs.)</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="fees" name="fees">
                                            <option <?php if ($dentist_details['fees'] == '0 - 300') echo "selected" ?>>0 - 300</option>
                                            <option <?php if ($dentist_details['fees'] == '300 - 500') echo "selected" ?>>300 - 500</option>
                                            <option <?php if ($dentist_details['fees'] == '500 above') echo "selected" ?>>500 above</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                                <div id="errordisp" ></div>
                            <?php echo form_close(); ?>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div>


<script type="text/javascript">
    $(function ()
    {
        $(".select2").select2();
    });
</script>