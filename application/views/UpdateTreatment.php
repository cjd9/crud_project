<?php ?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">


                <div class="box-body">
                    <div class="row">
                        <?php echo form_open('dashboard/UpdatePostTreatment', array('id' => 'preauthform') ); ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $treatment_details['id'] ?>" name="treatment_id" id="treatment_id">
                                <input type="hidden" value="<?php echo $treatment_details['appointment_id'] ?>" name="appointment_id" id="appointment_id">

                                <input type="hidden" value="<?php echo $treatment_details['patient_id'] ?>" name="patient_id" id="patient_id">
                                <label> Patient Name:</label>
                                
                                <label>     <?php
                                    echo $treatment_details['first_name'];
                                    echo" ";
                                    echo $treatment_details['last_name'];
                                    ?></label>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">





                                    <label> Clinic Name:</label>
                                <select class="form-control" name="clinic_id" id="clinic_id"  >
                                    <option value="">Select Clinic</option>
                                    <?php
                                    foreach ($clinic_details as $values) {
                                        ?>
                                        <option value="<?php echo $values['clinic_id']; ?>" <?php if ($values['clinic_id'] == $treatment_details['clinic_id']) echo "selected" ?>><?php echo $values['clinic_name'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>  
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tooth under consideration</label>
                                <select class="form-control select2" name="tooth_no[]" id="tooth_no" multiple="multiple" data-placeholder="Select a tooth"  style="width: 100%;" disabled>

                                    <?php for ($i = 1; $i < 33; $i++) { ?>

                                        <option value="<?php echo $i ?>" <?php if (in_array($i, $tooth_selected)) echo "selected"; ?> ><?php echo $i ?></option>

                                    <?php }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Chief Complaint</label>
                                <textarea class="form-control" name="chief_complaint"   id="chief_complaint" rows="3" placeholder="Enter ..." readonly><?php echo $treatment_details['chief_complaint']  ?> </textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Diagnosis</label>
                                <textarea class="form-control" name="diagnosis"  id="diagnosis" rows="3" placeholder="Enter ..." readonly><?php echo $treatment_details['diagnosis'] ?> </textarea>
                            </div>
                        </div>



                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Treatment Done</label>
                                <select class="form-control select2" name="treatment_done[]" id="treatment_done" multiple="multiple" data-placeholder="Select treatment done" style="width: 100%;" disabled>
                                    <?php foreach ($treatments as $value) { ?>
                                        <option value="<?php echo $value['treatment_id']; ?>" <?php if (in_array($value['treatment_id'], $treatment_selected)) echo "selected"; ?>  <?php ?> ><?php echo $value['treatment_name'] ?></option>
                                    <?php } ?>


                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Doctors Comments</label>
                                <textarea class="form-control" name="dentist_comments"  id="dentist_comments"  rows="3" placeholder="Enter ..."><?php echo $treatment_details['dentist_comment'] ?></textarea>
                            </div>                  
                        </div> 
                    </div>

                    <div class="row">
                        <div class="panel panel-default">


                            <ul class="nav nav-tabs">

                                <li class="active"><a href="#pre" data-toggle="tab"><div class="panel-heading"><strong>IntraOral Images</strong></div></a></li>
<!--                                <li><a href="#post" data-toggle="tab"><div class="panel-heading"><strong>Post Oral Images</strong></div></a></li>-->
                            </ul>


                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="pre" class="tab-pane fade in active">

                                        <!-- Standar Form -->
                                        <!-- <h4>Select files from your computer</h4> -->

                                        <div class="form-inline">
                                            <div class="form-group">
                                              <!-- <input type="file" name="files[]" id="js-upload-files" multiple> -->
                                            </div>
                                            <!-- <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button> -->
                                        </div>

                                        <!-- <div class="form-group">
                                             <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> <span class="required"></span></label>
                                             <div class="col-md-9 col-sm-12">
                                                 
                                                 <a class="drag-image-upload-wrapper" image-index="0">Add Image
                                                    <input type="file" id="add-image-input" class="drag-image-input-box">
                                                    
                                                  </a>
                                                 <ul id="images-container" class="no-padding">
                                                 </ul>
                                             </div>
                                         </div> -->

                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Treatment Images <span class="required">*</span></label>
                                            <div class="col-md-12">
                                                <!-- <input type="file" name="images[0][file]" id="image-input" class="upload-image pos-absolute invisible" style="opacity: 0;"> -->
<!--                                                <a class="add-image-input btn btn-danger" href="" image-type="pre" onclick="return false;" image-index="0">Add Image</a>-->
                                                <ul class="no-padding images-container" style="list-style: outside none none;">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="pull-left">
                                                            <video id="video" width="200" height="300" autoplay></video>
                                                            <input id="snap" type="button" value="Capture Snapshot" />                                                            
                                                            <canvas id="canvas" width="640" height="480" style="display:none;" ></canvas>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">

                                                            <div class="col-md-12">
                                                                <li class="uploaded-img-preview" id="image-li-1" style="float: left;">
                                                                    <div>
                                                                        <img style="float: left;" height="112" width="102" alt="No image" id="image-1" >
                                                                    </div>




                                                                <li class="uploaded-img-preview" id="image-li-2" style="float: left;">
                                                                    <div>
                                                                        <img  style="float: left;" height="112" width="102" alt="No image" id="image-2" >

                                                                    </div>


                                                                </li> 

                                                                <li class="uploaded-img-preview" id="image-li-3" style="float: left;">
                                                                    <div>
                                                                        <img style="float: left;" height="112" width="102" alt="No image" id="image-3" >

                                                                    </div>


                                                                </li> 

                                                                <li class="uploaded-img-preview" id="image-li-4" style="float: left;">
                                                                    <div>
                                                                        <img style="float: left;" height="112" width="102" alt="No image" id="image-4" >

                                                                    </div>


                                                                </li> 

                                                                <li class="uploaded-img-preview" id="image-li-5" style="float: left;">
                                                                    <div>
                                                                        <img  style="float: left;" height="112" width="102" alt="No image" id="image-5" >

                                                                    </div>


                                                                </li> 
                                                            </div>

                                                            <div class="col-md-12">
                                                                <li class="uploaded-img-preview" id="image-li-6" style="float: left;">
                                                                    <div>
                                                                        <img style="float: left;" height="112" width="102" alt="No image" id="image-6">

                                                                    </div>


                                                                </li> 

                                                                <li class="uploaded-img-preview" id="image-li-7" style="float: left;">
                                                                    <div>
                                                                        <img style="float: left;" height="112" width="102" alt="No image" id="image-7" >

                                                                    </div>


                                                                </li> 

                                                                <li class="uploaded-img-preview" id="image-li-8" style="float: left;">
                                                                    <div>
                                                                        <img style="float: left;" height="112" width="102" alt="No image" id="image-8" >

                                                                    </div>


                                                                </li> 

                                                                <li class="uploaded-img-preview" id="image-li-9" style="float: left;">
                                                                    <div>
                                                                        <img style="float: left;" height="112" width="102" alt="No image" id="image-9">

                                                                    </div>


                                                                </li> 

                                                                <li class="uploaded-img-preview" id="image-li-10" style="float: left;">
                                                                    <div>
                                                                        <img style="float: left;" height="112" width="102" alt="No image" id="image-10" >

                                                                    </div>


                                                                </li> 
                                                            </div>
                                                        </div>
                                                    </div>







                                                </ul>
                                            </div>
                                        </div>


                                        <!-- Progress Bar -->
                                        <!--                          <div class="progress">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                                                      <span class="sr-only">60% Complete</span>
                                                                    </div>
                                                                  </div>-->

                                        <!-- Upload Finished -->
                                        <div class="js-upload-finished">
                                            <!--    <h3>Uploaded files</h3>
                                               <div class="list-group">
                                                 <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-01.jpg</a>
                                                 <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-02.jpg</a>
                                               </div> -->

                                        </div>

                                    </div>

                    




                                </div>

                            </div>





                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cost</label>
                                <input type="text" name="amount" value="<?php echo $treatment_details['amount'] ?>" id="amount"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Status</label>
                                <select class="form-control select2" name="status" id="status" data-placeholder="Select Treatment Status" style="width: 100%;">
                                    <option value="1">Treatment Ongoing</option>
                                    <option value="0" selected>Treatment Complete</option>
                                </select>
                            </div>    
                        </div>  
                    </div>
        <img src="<?php echo IMG_URL; ?>/loader.gif" id="gif" style="display: block; margin: 0 auto; width: 100px; display:none; position: absolute; left:50%;top:50%;">

                </div>
                <!-- /.box-body -->
                   <input type="hidden" id="image-1-data" name="image-data[]" />
                <input type="hidden" id="image-2-data" name="image-data[]" />
                <input type="hidden" id="image-3-data" name="image-data[]" />
                <input type="hidden" id="image-4-data" name="image-data[]" />
                <input type="hidden" id="image-5-data" name="image-data[]" />
                <input type="hidden" id="image-6-data" name="image-data[]" />
                <input type="hidden" id="image-7-data" name="image-data[]" />
                <input type="hidden" id="image-8-data" name="image-data[]" />
                <input type="hidden" id="image-9-data" name="image-data[]" />
                <input type="hidden" id="image-10-data" name="image-data[]" />

                <div class="box-footer">
                    <button type="submit" id="imageTreatment" class="btn btn-primary">Submit</button>
                </div>
             
                
                <?php echo form_close(); ?>
            </div>


        </div>



</section>

</div>


<script type="text/javascript">
    $(function ()
    {
        $(".select2").select2();
    });
</script>