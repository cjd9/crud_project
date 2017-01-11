<script src="<?php echo PLUGINS_URL; ?>/dropzone.js"></script>
<script src="<?php echo PLUGINS_URL; ?>/dc_images.js"></script>

<style>
    /* layout.css Style */
    .upload-drop-zone {
        height: 200px;
        border-width: 2px;
        margin-bottom: 20px;
    }

    /* skin.css Style*/
    .upload-drop-zone {
        color: #ccc;
        border-style: dashed;
        border-color: #ccc;
        line-height: 200px;
        text-align: center
    }
    .upload-drop-zone.drop {
        color: #222;
        border-color: #222;
    }

    .pos-relative {
        position: relative !important;
    }
    .pos-absolute {
        position: absolute !important;
    }
    #images-container {
        list-style: none;
    }
    #images-container li {
        border-radius: 5px;
        float: left;
        margin-bottom: 10px;
        margin-right: 10px;
    }
    #images-container li:last-child {
        margin-right: 0;
    }
    #images-container li > div img {
        width: 100px;
        height: 100px;
        border-radius: inherit;
        background-image: url('../../images/bg.png');
    }
    #images-container li > div div {
        padding: 5px 10px ;
        text-align: center;
        border: 1px solid #ccc;
    }

    /*.drag-image-upload-wrapper {
      width: 100%;
      DISPLAY: block;
      height: 200px;
      border: 1px dashed;
    }
    .drag-image-input-box{
      width: 100%;
      height: 100%;
      opacity: 0;
    }*/

   
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#addtreatment" data-toggle="tab" aria-expanded="true">Add a TreatMent</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="addtreatment">

                            <!-- /.box-header -->
                            <div class="box-body">


                                <?php echo form_open('dashboard/updateTreatments'); ?>
                                <!-- form start -->

                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
<!--                                            <div class="form-group">
                                                <input type="hidden" value="<?php //echo $details['appointment_id'] ?>" name="appointment_id" id="patient_id">

                                                <input type="hidden" value="<?php //echo $details['patient_user_id'] ?>" name="patient_id" id="patient_id">
                                                <label>     <?php //echo $details['first_name'];
                                //echo" ";
                                //echo $details['last_name']; ?></label>

                                            </div>-->
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">

<!--                                                <input type="hidden" value="<?php //echo $details['clinic_id'] ?>" name="clinic_id" id="clinic_id">
                                                <label>     <?php// echo $details['clinic_name']; ?></label>-->

                                            </div>
                                        </div>  
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tooth under consideration</label>
                                                <select class="form-control select2" name="tooth_no[]" id="tooth_no" multiple="multiple" data-placeholder="Select a tooth" style="width: 100%;">
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
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Chief Complaint</label>
                                                <textarea class="form-control" name="chief_complaint" id="chief_complaint" rows="3" placeholder="Enter ..."></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Diagnosis</label>
                                                <textarea class="form-control" name="diagnosis" id="diagnosis" rows="3" placeholder="Enter ..."></textarea>
                                            </div>
                                        </div>



                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Treatment Done</label>
                                                <select class="form-control select2" name="treatment_done[]" id="treatment_done" multiple="multiple" data-placeholder="Select treatment done" style="width: 100%;">
                                                    <?php foreach ($treatments as $value) { ?>
                                                        <option value="<?php echo $value['treatment_id']; ?>"><?php echo $value['treatment_name'] ?></option>
<?php } ?>


                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Doctors Comments</label>
                                                <textarea class="form-control" name="dentist_comments" id="dentist_comments"  rows="3" placeholder="Enter ..."></textarea>
                                            </div>                  
                                        </div> 
                                    </div>

                                    <div class="row">
                                        <div class="panel panel-default">


                                            <ul class="nav nav-tabs">

                                                <li class="active"><a href="#pre" data-toggle="tab"><div class="panel-heading"><strong>IntraOral Images</strong></div></a></li>
                                                <li><a href="#post" data-toggle="tab"><div class="panel-heading"><strong>Post Oral Images</strong></div></a></li>
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
                                                            <div class="col-md-9 col-sm-12">
                                                                <!-- <input type="file" name="images[0][file]" id="image-input" class="upload-image pos-absolute invisible" style="opacity: 0;"> -->
                                                                <a class="add-image-input btn btn-danger" href="" image-type="pre" onclick="return false;" image-index="0">Add Image</a>
                                                                <ul class="no-padding images-container" style="list-style: outside none none;">

                                                                    <div class="col-md-12">
                                                                        <li class="uploaded-img-preview" id="image-li-1" style="float: left;">
                                                                            <div>
                                                                                <img src=""  style="float: left;" height="112" width="102" alt="No image" id="image-1" >
                                                                            </div>




                                                                        <li class="uploaded-img-preview" id="image-li-2" style="float: left;">
                                                                            <div>
                                                                                <img src=""  style="float: left;" height="112" width="102" alt="No image" id="image-2" >

                                                                            </div>


                                                                        </li> 

                                                                        <li class="uploaded-img-preview" id="image-li-3" style="float: left;">
                                                                            <div>
                                                                                <img src=""  style="float: left;" height="112" width="102" alt="No image" id="image-3" >

                                                                            </div>


                                                                        </li> 

                                                                        <li class="uploaded-img-preview" id="image-li-4" style="float: left;">
                                                                            <div>
                                                                                <img src=""  style="float: left;" height="112" width="102" alt="No image" id="image-4" >

                                                                            </div>


                                                                        </li> 

                                                                        <li class="uploaded-img-preview" id="image-li-5" style="float: left;">
                                                                            <div>
                                                                                <img src=""  style="float: left;" height="112" width="102" alt="No image" id="image-5" >

                                                                            </div>


                                                                        </li> 
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <li class="uploaded-img-preview" id="image-li-6" style="float: left;">
                                                                            <div>
                                                                                <img src=""  style="float: left;" height="112" width="102" alt="No image" id="image-6">

                                                                            </div>


                                                                        </li> 

                                                                        <li class="uploaded-img-preview" id="image-li-7" style="float: left;">
                                                                            <div>
                                                                                <img src=""  style="float: left;" height="112" width="102" alt="No image" id="image-7" >

                                                                            </div>


                                                                        </li> 

                                                                        <li class="uploaded-img-preview" id="image-li-8" style="float: left;">
                                                                            <div>
                                                                                <img src=""  style="float: left;" height="112" width="102" alt="No image" id="image-8" >

                                                                            </div>


                                                                        </li> 

                                                                        <li class="uploaded-img-preview" id="image-li-9" style="float: left;">
                                                                            <div>
                                                                                <img src=""  style="float: left;" height="112" width="102" alt="No image" id="image-9">

                                                                            </div>


                                                                        </li> 

                                                                        <li class="uploaded-img-preview" id="image-li-10" style="float: left;">
                                                                            <div>
                                                                                <img src=""  style="float: left;" height="112" width="102" alt="No image" id="image-10" >

                                                                            </div>


                                                                        </li> 
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

                                                    <div id="post" class="tab-pane fade">

                                                        <!-- Standar Form -->
                                                        <!-- <h4>Select files from your computer</h4> -->

                                                        <div class="form-inline">
                                                            <div class="form-group">
                                                              <!-- <input type="file" name="files[]" id="js-upload-files" multiple> -->
                                                            </div>
                                                            <!-- <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload files</button> -->
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">POST Treatment Images <span class="required">*</span></label>
                                                            <div class="col-md-9 col-sm-12">
                                                                <!-- <input type="file" name="images[0][file]" id="image-input" class="upload-image pos-absolute invisible" style="opacity: 0;"> -->
                                                                <a class="add-image-input btn btn-danger" href="" image-type="post" onclick="return false;" image-index="0">Add Image</a>
                                                                <ul id="" class="no-padding images-container">
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
                                                <input type="text" name="amount" id="amount"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Status</label>
                                                <select class="form-control select2" name="status" id="status" data-placeholder="Select a State" style="width: 100%;">
                                                    <option value="0">Treatment Ongoing</option>
                                                    <option value="1">Treatment Complete</option>
                                                </select>
                                            </div>    
                                        </div>  
                                    </div>

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
<?php echo form_close(); ?>
                            </div>
                        </div>     




                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
    $(function ()
    {
        $(".select2").select2();
    });
</script>