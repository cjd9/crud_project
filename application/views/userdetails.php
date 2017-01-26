<script src="<?php echo PLUGINS_URL; ?>/dropzone.js"></script>
<script src="<?php echo PLUGINS_URL; ?>/dc_images.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
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
<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#doctorclinics" data-toggle="tab" aria-expanded="true">Users</a>
                        </li>
                        <li class="">
                            <a href="#addnewclinic" data-toggle="tab" aria-expanded="false">Add New User</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="doctorclinics">
                            <div class="table-responsive">
                                <table border="1" id="users" class="table table-bordered table-striped dataTable no-footer">	
				<thead>
                                    <tr>
                                        <th>Full Name</th> 
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Created date</th>
                                        <th>Action</th>
                                    </tr>
				</thead>
				 <tfoot>
					<tr>
                                        <th>Full Name</th> 
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Created date</th>
                                        <th>Action</th>
                                    </tr>
				</tfoot>	
				  <tbody>
				
                                    <?php
                                    if (!empty($user_details)) {
                                        foreach ($user_details as $row) {
                                    ?> 
                                            <tr>
                                                <td><?php echo $row['full_name'] ?></td> 
                                                <td><?php echo $row['address'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['mobile_no'] ?></td>
                                                <td><?php echo date("d/m/Y", strtotime($row['created_on']))?></td>
                                                <td class="deleteclinicaction">
                                                       <input type="hidden" name="cid" class="cid" value="<?php echo $row['id'] ?>">
                                                    <button type="submit" class="btn btn-primary btn-block" name="deleteclinic" value="delete">Delete</button>
                                                   
                                                    <?php echo form_open('dashboard/fetchUserMasterDetails');?>
                                                     <button type="submit" class="btn btn-primary btn-block" name="updateclinic" value="update">View</button>
                                                      <input type="hidden" name="id" class="id" value="<?php echo $row['id'] ?>">

                                                    <?php echo form_close();?>
                                                </td>
                                            </tr>  
                                    <?php
                                        }
                                    } 
                                    else 
                                    {
                                        echo "No Clinics Added";
                                    }
                                    ?>
			</tbody>
                                </table>
                            </div>
                        </div>
                       <div class="tab-pane" id="addnewclinic">
                            <div class="alert alert-danger" style="display:none" id="validationerrors"></div>
                                <?php $attributes = array('name' => 'addnewclinic');
                                    echo form_open_multipart(base_url('dashboard/addNewEntry'), $attributes);
                                ?>
                                    <div class="form-group">
                                        <label for="clinic_name">Full Name :</label>
                                        <input class="form-control" type="text" name="full_name" id="full_name" placeholder="Enter Name" />
                                    </div>
					<div class="form-group">
					<label for="clinic_name">Date Of Birth :</label>
					<input type="text" name="date_of_birth" value="" id="datepickerbooking" class="form-control" placeholder="Date of birth (MM-DD-YY)">
					</div>
                                    <div class="form-group">
                                        <label for="clinic_email"> Email :</label>
                                        <input class="form-control" type="text" name="email" id="email" placeholder="Enter Email id" />
                                    </div>
                                    <div class="form-group">
                                        <label for="clinic_office_no"> Mobile Number :</label>
                                        <input class="form-control" type="text" name="mobile_no" id="mobile_no" placeholder="Enter Contact No." />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="clinic_address">Address</label>
                                        <input class="form-control" type="text" name="address" id="address" placeholder="Enter Address" />
                                    </div>
                                    
                                
                                    <div class="form-group">
                                        <label for="clinic_pin"> Pincode :</label>
                                        <input class="form-control" type="text" name="pin" id="pin" placeholder="Enter Pincode" /> 
                                    </div>
                            
                              
                            	    <div class="form-group">
						  <div class="g-recaptcha" data-sitekey="6LcDMB0TAAAAAHkfsz6ogL0m0X_7xmcrkTQ9WWdv">
						    </div>
                	            </div>
                            
                                <div class="form-group">
                              <a class="add-image-input btn btn-danger" href="" image-type="pre" onclick="return false;" image-index="0">Add Image</a>
                               <ul class="padding-top-20 padding-left-0 images-container clearfix" style="list-style: outside none none;">
                            
                                
                               <div class="js-upload-finished">
                                                        

                                  </div>
                            </div>
                                    <div class="form-group">
                                        <button type="submit" id="user_add" class="btn btn-default" >Add User</button>
                                        <button type="submit" id="clinic_update" style="display:none;" class="btn btn-default" >Update Details</button>
                                    </div>
                                <?php
                                echo form_close();
                                ?>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
       
    $('#users').DataTable();
    });

    </script>
