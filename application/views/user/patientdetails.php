<?php #pr($pd,1); ?>
 

<div  class="content-wrapper"> 
<div class="container">
    <section class="content-header"><h1>View Patient profile <span class="glyphicon glyphicon-user"></span></h1></section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Basic Details</h3>
                    </div>
                    <div class="box-body">
                       
                        
                        <div class="form-group">
                            <label>First Name: </label>
                           <?php echo $pd['first_name']; ?>
                        </div>
                        <div class="form-group">
                           <label>Last Name: </label>
                           <?php echo $pd['last_name']; ?>
                        </div>
                        <div class="form-group">
                            <label>Middle Name: </label>
                            <?php echo $pd['middle_name']; ?>
                        </div>
                        <div class="form-group">
                            <label>Salutation: </label>
                            <?php echo $pd['salutation']; ?>
                           
                        </div>
                        <div class="form-group">
                            <label>Gender: </label>
                            <?php echo $pd['gender']; ?>
                            
                        </div>
                        <div class="form-group">
                            <label>Date Of Birth: </label>
                            <?php echo $pd['date_of_birth']; ?>
                            
                        </div>
                        <div class="form-group">
                            <label>Mobile No: </label>
                            <?php echo $pd['mobile_no'] ;?>
                            
                        </div>
                        <div class="form-group">
                            <label>Email Id: </label>
                            <?php echo $pd['email_id']; ?>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Address Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Address: </label>
                            <?php echo $pd['address']; ?>
                            
                        </div>
                        <div class="form-group">
                            <label>City: </label>
                           <?php echo $pd['city_name']; ?>
                        </div>
                        <div class="form-group">
                            <label>State: </label>
                           <?php echo $pd['state_name']; ?>
                        </div>
                        <div class="form-group">
                            <label>Locality: </label>
                            <?php echo $pd['locality']; ?>
                            
                        </div>
                        <div class="form-group">
                            <label>Country: </label>
                            <?php echo $pd['country']; ?>
                            
                        </div>
                        <div class="form-group">
                            <label>Pin code: </label>
                            <?php echo $pd['pincode']; ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Bank Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Bank Name :</label>
                            <?php echo $pd['bank_name']; ?>                           
                        </div>
                        <div class="form-group">
                            <label>Branch Name :</label>
                            <?php echo $pd['bank_branch_name']; ?>                           
                        </div>
                        <div class="form-group">
                            <label>Account No. :</label>
                            <?php echo $pd['bank_account_number']; ?>                           
                        </div>
                        <div class="form-group">
                            <label>IFSC :</label>
                            <?php echo $pd['bank_ifsc']; ?>                           
                        </div>
                        <div class="form-group">
                            <label>Account Type :</label>
                            <?php echo $pd['bank_account_type']; ?>                           
                        </div>
                        <div class="form-group">
                            <label>Address :</label>
                            <?php echo $pd['bank_address']; ?>                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Identity Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>Pan Card : </label>
                            <?php echo $pd['pan_card']; ?>                           
                        </div>
                        <div class="form-group">
                            <label>Aadhaar Card :</label>
                            <?php echo $pd['aadhaar_card']; ?>                           
                        </div>
                        <div class="form-group">
                            <label>Insurance Policy ID :</label>
                            <?php echo $pd['insurance_policy_id']; ?>                           
                        </div>
                        <div class="form-group">
                            <label>Ocare ID :</label>
                            <?php echo $pd['ocare_id']; ?>                           
                        </div>
                        
                        
                    </div>
                </div>
                
            </div>
            <div class="col-md-12">
                  <div class="box-header">
                       <div class="box box-primary">
                           <div class="box-body">
                               <center>
                              <h3 class="box-title">Treatment History</h3>
                              </center>
                           </div>
                      </div>
                  </div>
                        <?php if(count($pd['treatments']) > 0): ?>
                            <?php foreach( $pd['treatments'] as $td): ?>
                <div class="col-md-4" >
                        <div class="box box-primary">
                    
                    <div class="box-body">
                        
      
                            <div class="form-group">
                                <label>Dentist Name : </label>
                                <?php echo $td['dentist_salutation']; ?>
                                <?php echo $td['dentist_first_name']; ?> 
                                <?php echo $td['dentist_middle_name']; ?>
                                <?php  echo $td['dentist_last_name'];  ?>

                            </div>
                            <div class="form-group">
                                <label>Diagnosis : </label>
                                <?php echo $td['diagnosis'] ?>
                            </div>
                            <div class="form-group">
                                <label>Clinic Name : </label>
                                <?php echo $td['clinic_name']; ?>
                            </div>
                            <div class="form-group">
                                <label>Treatment Type : </label>
                                <?php echo $td['treatment_type']; ?>
                            </div>
                          

                               
                            <div class="form-group">
                                <label>Tooth No : </label>
                                <?php echo $td['tooth_no']; ?>
                            </div>
                            <div class="form-group">
                                <label>Chief Complaint : </label>
                                <?php echo $td['chief_complaint']; ?>
                            </div>
                            <div class="form-group">
                                <label>Treatment Name : </label>
                                <?php echo implode(",",$td['treatment_done']); ?>
                            </div>
                       
                        
                           </div>
                                 </div> 
                        
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                       
                
                       
                    
            </div>
    </section>
</div>
</div>
