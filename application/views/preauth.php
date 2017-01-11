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
  
                    <div class="box-body">


                        <form action="<?php echo base_url('dashboard/updateTreatments'); ?>" method="POST" role="form" class="smart-wizard form-horizontal" id="pre-auth-form" enctype="multipart/form-data" novalidate="true">
<?php //echo form_open('dashboard/updateTreatments'); ?>
                         

                            <div id="pre-auth-wizard" class="swMain">
                                <ul>
                                    <li>
                                        <a href="#step-1">
                                            <div class="stepNumber">
                                                1
                                            </div>
                                            <span class="stepDesc">Ocare ID</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-2">
                                            <div class="stepNumber">
                                                2
                                            </div>
                                            <span class="stepDesc">Patient profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-3">
                                            <div class="stepNumber">
                                                3
                                            </div>
                                            <span class="stepDesc">Chief Complaint</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-4">
                                            <div class="stepNumber">
                                                4
                                            </div>
                                            <span class="stepDesc">Intra oral images</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-5">
                                            <div class="stepNumber">
                                                5
                                            </div>
                                            <span class="stepDesc">Treatment Type</span>
                                        </a>
                                    </li>
                                </ul>
                                 
                                <div id="step-1">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">
                                            Patient Ocare ID <span class="symbol required"></span>
                                        </label>

                                        <div class="col-sm-7">
                                            <input type="text" class="form-control first-text-input validate-me"  name="ocare_id" id="ocare_id" placeholder="Enter ocare ID" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-sm-2 float-right">
                                            <button class="btn btn-primary next-step btn-block" id="ocareidbtn">
                                                Next <i class="fa fa-arrow-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div id="step-2">
                                    <div class="row">
                                        <div class="col-md-3">

                                            <!-- Profile Image -->
                                            <div class="box box-primary">
                                                <div class="box-body box-profile " id="ppicname">
                                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo PRPICTH_URL . '/dummy.png'; ?>" alt="User profile picture">

                                                    <h3 class="profile-username text-center"></h3>

                                                    <p class="text-muted text-center">Insured</p>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-9">
                                                <input type="hidden"  name="appointment_id" value="" id="appointment_id">
                                              <input type="hidden"  name="patient_id" value="" id="patient_id">
                                           
                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    User ID <span class="symbol required"></span>
                                                </label>

                                                <div id="user_id" class="col-sm-7">
                                                    123
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    Name <span class="symbol required"></span>
                                                </label>

                                                <div id="name" class="col-sm-7">
                                                    Arif Ansari
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    Email <span class="symbol required"></span>
                                                </label>

                                                <div id="email" class="col-sm-7">
                                                    arif09ansari@gmail.com
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    Mobile <span class="symbol required"></span>
                                                </label>

                                                <div id="mobile" class="col-sm-7">
                                                    333333333
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    Gender <span class="symbol required"></span>
                                                </label>

                                                <div id="gender" class="col-sm-7">
                                                    Male
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    Date of birth <span class="symbol required"></span>
                                                </label>

                                                <div id="dob" class="col-sm-7">
                                                    03 May 1993
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    Is insured <span class="symbol required"></span>
                                                </label>

                                                <div id="is_insured" class="col-sm-7">
                                                    Yes
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    Address <span class="symbol required"></span>
                                                </label>

                                                <div id="address" class="col-sm-7">
                                                    Dadar west
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    City <span class="symbol required"></span>
                                                </label>

                                                <div id="citytreatment" class="col-sm-7">
                                                    Mumbai
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    State <span class="symbol required"></span>
                                                </label>

                                                <div id="state" class="col-sm-7">
                                                    Maharashtra
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    Pincode <span class="symbol required"></span>
                                                </label>

                                                <div id="pincode" class="col-sm-7">
                                                    400022
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 text-right">
                                                    Is OPG Valid <span class="symbol required"></span>
                                                </label>

                                                <div id="opg" class="col-sm-7">
                                                    <i class="fa fa-check-square"></i> Verified
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-sm-2">
                                            <button class="btn btn-primary back-step btn-block">
                                                <i class="fa fa-arrow-circle-left"></i> Back
                                            </button>
                                        </div>
                                        <div class="col-sm-2 float-right">
                                            <button class="btn btn-primary next-step btn-block">
                                                Next <i class="fa fa-arrow-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-3">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group padding-hori-15">
                                                <label class="control-label">
                                                    Select Tooth Number <span class="symbol required"></span>
                                                </label>
                                                <select required class="form-control select2 width-100 validate-me" name="tooth_no[]" id="tooth_no" multiple="multiple">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                    <option value="32">32</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group padding-hori-15">
                                                <label class="control-label">
                                                    Chief Complaint <span class="symbol required"></span>
                                                </label>
                                                <textarea name="chief_complaint" id="chief_complaint" required class="form-control validate-me"></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group padding-hori-15">
                                                <label class="control-label">
                                                    Diagnosis <span class="symbol required"></span>
                                                </label>
                                                <textarea name="diagnosis" id="diagnosis" required class="form-control validate-me"></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group padding-hori-15">
                                                <label class="control-label">
                                                    Treatments Recommended <span class="symbol required"></span>
                                                </label>
                                                <select required class="form-control select2 validate-me" name="treatment_done[]" id="treatment_done" multiple="multiple">
                                                                                             <?php foreach ($treatments as $value) { ?>
                                                            <option value="<?php echo $value['treatment_id']; ?>"><?php echo $value['treatment_name'] ?></option>
    <?php } ?>


                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group padding-hori-15">
                                                <label class="control-label">
                                                    Doctor's Comments
                                                </label>
                                                <textarea name="dentist_comments"  id="dentist_comments" class="form-control validate-me" required></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-sm-2">
                                            <button class="btn btn-primary back-step btn-block">
                                                <i class="fa fa-arrow-circle-left"></i> Back
                                            </button>
                                        </div>
                                        <div class="col-sm-2 float-right">
                                            <button class="btn btn-primary next-step btn-block">
                                                Next <i class="fa fa-arrow-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <div id="step-4">

                                    <div class="intra-oral-images-wrapper clearfix">
                                        <div> 
                                            
                                             <div class="col-md-12">
                                        
                                           <div class="col-md-3">
                                                            <div class="pull-left">
                                                            <video id="video" width="200" height="300" autoplay></video>
                                                            <input id="snap" type="button" value="Capture Snapshot" />                                                            
                                                            <canvas id="canvas" width="640" height="480" style="display:none;" ></canvas>
                                                            </div>
                                                        </div>
                                    </div>
                                           
                                        <div class="intra-oral-image-holder" id="image-holder-1">
                                            <i class="fa fa-file-image-o"></i>
                                            <img   id="image-1" name="image-1"/>
                                            
                                        </div>
                                        
                                        </div>
                                         <div> 
                                             
                                        <div class="intra-oral-image-holder" id="image-holder-2">
                                           
                                            <i class="fa fa-file-image-o"></i>
                                             <img  id="image-2" />
                                             
                                        </div>
                                         
                                         </div>
                                         <div> 
                                             
                                        <div class="intra-oral-image-holder" id="image-holder-3">
                                         
                                            <i class="fa fa-file-image-o"></i>
                                            <img  id="image-3" />
                                            
                                        </div>
                                         
                                         </div>
                                             
                                        <div class="intra-oral-image-holder" id="image-holder-4">
                                            <i class="fa fa-file-image-o"></i>
                                            <img id="image-4" />
                                        </div>
                                        <div class="intra-oral-image-holder" id="image-holder-5">
                                            <i class="fa fa-file-image-o"></i>
                                            <img id="image-5" />
                                        </div>
                                        <div class="intra-oral-image-holder" id="image-holder-6">
                                            <i class="fa fa-file-image-o"></i>
                                            <img id="image-6" />
                                        </div>
                                        <div class="intra-oral-image-holder" id="image-holder-7">
                                            <i class="fa fa-file-image-o"></i>
                                            <img id="image-7" />
                                        </div>
                                        <div class="intra-oral-image-holder" id="image-holder-8">
                                            <i class="fa fa-file-image-o"></i>
                                            <img id="image-8" />
                                        </div>
                                        <div class="intra-oral-image-holder" id="image-holder-9">
                                            <i class="fa fa-file-image-o"></i>
                                            <img id="image-9" />
                                        </div>
                                        <div class="intra-oral-image-holder" id="image-holder-10">
                                            <i class="fa fa-file-image-o"></i>
                                            <img id="image-10" />
                                        </div>
                                    </div>

                                    <div class="row margin-top-20">
                                        <div class="col-sm-2">
                                            <button class="btn btn-primary back-step btn-block">
                                                <i class="fa fa-arrow-circle-left"></i> Back
                                            </button>
                                        </div>
                                        <div class="col-sm-2 float-right">
                                            <button class="btn btn-primary next-step btn-block">
                                                Next <i class="fa fa-arrow-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <div id="step-5">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">
                                            Treatment Type <span class="symbol required"></span>
                                        </label>

                                        <div class="col-sm-7">
                                            <select class="form-control validate-me" name="treatment_type" required>
                                                <option value="normal">Normal</option>
                                                <option value="emergency">Emergency</option>
                                                <option value="critical">Critical</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    
                                   
                <input type="hidden" class="intra-oral-image" id="image-1-data" rel="image-holder-1" name="image-data[]" />
                <input type="hidden" class="intra-oral-image" id="image-2-data" rel="image-holder-2" name="image-data[]" />
                <input type="hidden" class="intra-oral-image" id="image-3-data" rel="image-holder-3" name="image-data[]" />
                <input type="hidden" class="intra-oral-image" id="image-4-data" rel="image-holder-4" name="image-data[]" />
                <input type="hidden" class="intra-oral-image" id="image-5-data" rel="image-holder-5" name="image-data[]" />
                <input type="hidden" class="intra-oral-image" id="image-6-data" rel="image-holder-6" name="image-data[]" />
                <input type="hidden" class="intra-oral-image" id="image-7-data" rel="image-holder-7" name="image-data[]" />
                <input type="hidden" class="intra-oral-image" id="image-8-data" rel="image-holder-8" name="image-data[]" />
                <input type="hidden" class="intra-oral-image" id="image-9-data" rel="image-holder-9" name="image-data[]" />
                <input type="hidden" class="intra-oral-image" id="image-10-data" rel="image-holder-10" name="image-data[]" />
                                    <div class="row margin-top-20">
                                        <div class="col-sm-2 float-right">
                                            <button class="btn btn-primary finish-step btn-block">
                                                Submit for Pre Auth
                                            </button>
                                        </div>
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
    $(function ()
    {
        $(".select2").select2({
        }).on('select2:open', function (evt) {
            $('.select2-search__field').addClass('validate-me');
        });
    });
</script>