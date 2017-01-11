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
    
     .remove_btn {
                background: url("../img/remove-icon.png");
                cursor: pointer;
                height: 20px;
                position: absolute;
                left: 140px;
                top: 105px;
                width: 16px;
            }
            
            img {
    
    width: 100px;
    height: 100px;
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
            <div class="col-sm-8">
                <div id="validationerrors"></div>
                <?php
                    echo form_open_multipart(base_url('UpdateClinicDetails'));
                ?>
                <div class="form-group">
                    <input class="form-control" type="hidden" name="id" id="clinic_id" value=" <?php echo $user['id'] ?>"/>
                </div>
                <div class="form-group">
                    <label for="clinic_name">Full Name :</label>
                    <input class="form-control" type="text" readonly="readonly" name="full_name" id="full_name" value=" <?php echo $user['full_name'] ?>" placeholder="Enter Name" /> 
                </div>
                <div class="form-group">
                    <label for="clinic_email"> Email :</label>
                    <input class="form-control" readonly="readonly" type="text" name="email" id="email" value=" <?php echo $user['email'] ?>" placeholder="Enter Email id" /> 
                </div>
                <div class="form-group">
                    <label for="clinic_office_no">Mobile Number :</label>
                    <input class="form-control" readonly="readonly" type="text" name="mobile_no" id="mobile_no" value=" <?php echo $user['mobile_no'] ?>" placeholder="Enter Mobile No.">
                </div>
              
                <div class="form-group">
                    <label for="pin">Pincode :</label>
                    <input class="form-control" readonly="readonly" type="text" name="pin" value=" <?php echo $user['pin'] ?>"id="pin" placeholder="Enter Pincode" /> 
                </div>
                
                
                    <div class="form-group">
                              
                               <ul class="padding-top-20 padding-left-0 images-container" style="list-style: outside none none;">
                                                
                               <?php

                                $imgpath = base_url('uploads/clinics/' . $user['id'] );
                                
                                 if($files && count($files) > 0) {
                                     foreach($files as $image) { ?>
                                         
                                        <li class="uploaded-img-preview" style="float: left;">
                                            <div>
                                                <img src="<?php echo $imgpath . '/' . $image ?>" alt="loading...">
                                                <div>
                                                    
                                            <a class="remove-img" href="" img-name="<?php echo $image ?>" >Remove</a>                                       
                                            <input type="hidden" class="imgname"   value="<?php echo $image ?>"/>
                                                </div>
                                            </div>
                                        </li>
                            <?php         }
                                 }
                            ?>
                               <div class="js-upload-finished">
                                 </div>
                            </div>
                
                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
</div>  

<script>
   $( document ).ready(function() {
    
    //var mockFile = { name: "Filename", size: 12345 };

// Call the default addedfile event handler
//myDropzone.emit("addedfile", mockFile);
    
//    var thisDropzone = this;
//
//        $.getJSON('get_item_images.php', function(data) { // get the json response
//
//            $.each(data, function(key,value){ //loop through it
//
//                var mockFile = { name: value.name, size: value.size }; // here we get the file name and size as response 
//
//                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
//
//                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "uploadsfolder/"+value.name);//uploadsfolder is the folder where you have all those uploaded files
//
//            });
//
//        });
        
    });
    </script>
