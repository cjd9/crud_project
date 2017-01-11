<script type="text/javascript">
    var errors = <?php echo json_encode($this->config->item('errors')); ?>;
    var user_name = '<?php echo $this->session->user_name; ?>';
    var user_id = '<?php echo $this->session->user_id; ?>';
</script>
<script src="<?php echo base_url(); ?>resources/js/dentist_main.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/profile.css" /> 
<script src="<?php echo base_url(); ?>resources/js/profile.js"></script><script src="<?php echo base_url(); ?>resources/js/jquery-custom-file-input.js"></script> 
<style>
    span {
        display: none;
    }
    .borderClass{
        border-color: #FF0000;
        border-width:1px;
        border-style: solid;
    }
</style>
<!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-2 form-box"></div>
                <div id="form" class="col-sm-8 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Sign up now</h3>
                            <p>Fill in the form below to get instant access:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                    <?php
                        $attributes = array('class' => 'registration-form', 'role' => 'form', 'id' => 'updateDentist', 'enctype' => 'multipart/form-data');
                        echo form_open(base_url('dental/updateDentistDetails'), $attributes);
                    ?>                      
                        <div id="errordisp" ></div>
                        <div class="form-group">
                            <div id="profile_pic">
                                <div class="image">
                                <?php
                                    if ($profiledData['profile_picture'] == 1):
                                ?>
                                        <img src="<?php echo PRPICTH_URL . $this->session->user_id . '.jpg'; ?>" id="profileimg"/>
                                <?php
                                    else:
                                ?>
                                        <img src="<?php echo PRPICTH_URL . 'dummy.png'; ?>" id="profileimg"/>
                                <?php
                                    endif;
                                ?>
                                    <iframe name='hidden-iframe' id='hidden-iframe' style='display:none'></iframe>
                                    <div id="newprpic" class="changprpic" action="<?php echo base_url('dental/prpicupl'); ?>">
                                        <img src="<?php echo IMG_URL; ?>editicon.png" width="32" height="32" alt="" title="Click to change profile picture" />
                                    </div>
                                    <div id="removeprpic" class="removeprpic" user_id="<?php echo $this->session->user_id; ?>">
                                        <img src="<?php echo IMG_URL; ?>remove-icon.png" title="Click to remove profile picture" />
                                    </div>
                                </div>
                                <div class="loader">
                                    <!-- Loading image is in background -->
                                </div>
                            </div> 
                            <div class="form-group">  
                                <div class="col-sm-2 form-group"> 
                                    <input type="text" name="salutation" value="Dr"  class="form-salutation form-control" id="salutation" disabled>
                                </div>
                                <div class="col-sm-5 form-group"> 
                                    <input type="text" name="first_name" value="<?php echo $dentist_details['first_name']; ?>" placeholder="First Name" class="form-fname form-control" id="first_name"> <span>focus fire</span> 
                                </div>
                                <div class="col-sm-5 form-group">  
                                    <input type="text" name="last_name" value="<?php echo $dentist_details['last_name']; ?>" placeholder="Last Name" class="form-lname form-control" id="last_name">
                                </div>  
                                <br> <br>
                            </div>   
                            <div class="form-group">  
                                <div class="col-sm-4 form-group"> 
                                    <input type="date" name="dob"  value="<?php echo$dentist_details['dob']; ?>" placeholder="Date Of Birth" class="form-dob form-control" id="dob">
                                </div>
                                <div class="col-sm-4 form-group"> 
                                    <input type="text" name="dci_number" value="<?php echo $dentist_details['dci_reg_no']; ?>" placeholder="DCI Number" class="form-dci_number form-control" id="dci_number">
                                </div>
                                <div class="col-sm-4 form-group">  
                                    <input type="text" name="email" value="<?php echo $dentist_details['email_id']; ?>" placeholder="Email id" class="form-email form-control" id="email">
                                </div>  
                                <br> <br>
                            </div> 
                            <div class="form-group">  
                                <div class="col-sm-4 form-group"> 
                                    <input type="text" name="mobile" value="<?php echo $dentist_details['mobile_no']; ?>" placeholder="Mobile" class="form-mobile form-control" id="mobile">
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="Male" <?php if ($doc_details['gender'] == 'Male') echo "checked" ?>>Male
                                    </label>
                                    <label class="radio-inline"> 
                                        <input type="radio" name="gender" value="Female" <?php if ($dentist_details['gender'] == 'Female') echo "checked" ?>>Female
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 form-group">
                                        <input type="text" name="pincode" value="<?php echo $dentist_details['pincode']; ?>" placeholder="Pincode" class="form-pincode form-control" id="pincode">
                                    </div>  
                                </div>
                                <br> <br>
                            </div> 
                            <div class="form-group">  
                                <div class="col-sm-4 form-group"> 
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
                                <div class="col-sm-4 form-group"> 
                                    <select class="form-control" id="specialities" name="specialities">
                                        <option value="">Select a Speciality</option>
                                    <?php 
                                        foreach ($speciality as $value) {
                                    ?>
                                            <option value="<?php echo $value['id'] ?>" <?php if ($value['name'] == $doc_details['speciality']) echo "selected" ?> ><?php echo $value['name'] ?></option>
                                    <?php 
                                        } 
                                    ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">  
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
                                <label >Please Select your Specialities:</label>
                            </div>
                            <div class ="specialityborder">
                                <div class="checkbox">
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
                                        echo' <label><input type="checkbox" name="speciality[]" class="speciality" value="' . $value['id'] . '" ';
                                        foreach ($specialityArray as $sid) {
                                            if ($value['id'] == $sid)
                                                echo "checked";
                                        } 
                                        echo' >' . $value['name'] . '</label>';
                                        $flag = 1;
                                        $i++;
                                    }
                                ?>
                                </div>
                            </div>
                            <br> <br>
                            <div class="form-group">
                                <label class="sr-only" for="form-about-yourself">Address</label>
                                <textarea name="address"  placeholder="Address" class="form-address form-control" id="address"><?php echo $dentist_details['address']; ?></textarea> 
                            </div> 
                            <div class="form-group">
                                <input type="number" name="experience" placeholder="Years of experience..." value="<?php echo isset($dentist_details['experience']) ? $dentist_details['experience'] : '' ?>" class="form-email form-control" id="experience">
                            </div>
                            <div class="form-group">
                                <label for="fees">Consultation Fees:</label>
                                <select class="form-control" id="fees" name="fees">
                                    <option>Rs. 0-300 /-</option>
                                    <option>Rs. 300-500 /-</option>
                                    <option>Rs. 500+ /-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-about-yourself">About yourself</label>
                                <textarea name="about"  placeholder="About yourself..." class="form-about-yourself form-control" id="about"> <?php echo isset($dentist_details['about']) ? $dentist_details['about'] : '' ?></textarea> 
                            </div>
                            <div class="form-group">
                                <input type="text" name="locality" placeholder="Locality" value="<?php echo isset($dentist_details['locality']) ? $dentist_details['locality'] : '' ?>" class="form-locality form-control" id="locality">
                            </div>
                            <div class="form-group">
                                <label >Please Select the treatments you offer:</label>
                            </div>
                            <div class ="treatmentborder">
                                <div class="checkbox">
                                <?php
                                    $i = 0;
                                    $flag = 0;
                                    foreach ($treatments as $value) {
                                        if ($i == '3' || $i == '6' || $i == '9') 
                                        {
                                            echo'</div>';
                                            $flag = 0;
                                        }
                                        if ($flag == 0) 
                                        {
                                            echo' <div class="col-sm-3 form-group">';
                                        }
                                        echo' <label><input type="checkbox" name="treatment[]" class="treatment" value="' . $value['treatment_id'] . '" ';
                                        foreach ($treatmentsArray as $sid) {
                                            if ($value['treatment_id'] == $sid)
                                            echo "checked";
                                        } 
                                        echo'>' . $value['treatment_name'] . '</label>';
                                        $flag = 1;
                                        $i++;
                                    }
                                ?>
                                </div>
                            </div>
                            <button type="submit" class="btn">Sign me up!</button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="col-sm-2 form-box"></div>
                </div>
            </div>
        </div>
    </div>
<!-- Javascript -->
    <script src="<?php echo base_url(); ?>resources/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/assets/js/jquery.backstretch.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/assets/js/retina-1.1.0.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/assets/js/scripts.js"></script>
    <script>
        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });
        $(document).ready(function () {
            $('.btn-file :file').on('fileselect', function (event, numFiles, label) {
                var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;
                if (input.length) 
                {
                    input.val(log);
                } 
                else 
                {
                    if (log)
                        alert(log);
                }
            });
        });
    </script>