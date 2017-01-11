

<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content">
        
        <?php 
echo form_open_multipart(base_url('dashboard/addClinicTimings'));
?>              
        
        
                        <div class="checkbox">
              <label><input type="checkbox" name="7days" id="7days" value="[0,1,2,3,4]">All days</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" name="6days" id="6days" value="">All days(Except Sunday)</label>
            </div>

            <div class="form-group">
            <label for="locality">Days:</label>
            <select class="form-control dayofweek" id="dayofweek" name="dayofweek">
                <option value="">Select day</option>
                <option value="0">Sunday</option>
                <option value="1">Monday</option>
                <option value="2">Tuesday</option>
                <option value="3">Wednesday</option>
                <option value="4">Thursday</option>
                <option value="5">Friday</option>
                <option value="6">Saturday</option>
                
                

            </select>
            </div>
        
        
                          <div class="form-group">
                                    <label name="clinic_name">Clinic Name :</label>
                                    <select class="form-control" name="clinic_id" id="clinic_id" >
                                        <option value="">Select Clinic</option>
                                        <?php 
                                            foreach ($clinic_details as $values) 
                                            { 
                                        ?>
                                                <option value="<?php echo $values['clinic_id']; ?>"><?php echo $values['clinic_name'] ?></option>
                                        <?php 
                                            } 
                                        ?>
                                    </select>
                                </div>
        
        <br><br><br>
        
                                <div class="form-group">
                                        <label for="start_time">Clinic Start Time :</label>
                                        <select class="form-control" id="start_time" name="start_time[]">
                                            <option value="">Select Start Time</option>
                                            <option value="00:00:00" >12am</option>
                                            <option value="00:30:00" >12.30am</option>
                                            <option value="01:00:00" >1am</option>
                                            <option value="01:30:00" >1.30am</option>
                                            <option value="02:00:00" >2am</option>
                                            <option value="02:30:00" >2.30am</option>
                                            <option value="03:00:00" >3am</option>
                                            <option value="03:30:00" >3.30am</option>
                                            <option value="04:00:00" >4am</option>
                                            <option value="04:30:00" >4.30am</option>
                                            <option value="05:00:00" >5am</option>
                                            <option value="05:30:00" >5.30am</option>
                                            <option value="06:00:00" >6am</option>
                                            <option value="06:30:00" >6.30am</option>
                                            <option value="07:00:00" >7am</option>
                                            <option value="07:30:00" >7.30am</option>
                                            <option value="08:00:00" >8am</option>
                                            <option value="08:30:00" >8.30am</option>
                                            <option value="09:00:00" >9am</option>
                                            <option value="09:30:00" >9.30am</option>
                                            <option value="10:00:00" >10am</option>
                                            <option value="10:30:00" >10.30am</option>
                                            <option value="11:00:00" >11am</option>
                                            <option value="11:30:00" >11.30am></option>
                                            <option value="12:00:00" >12pm</option>
                                            <option value="12:30:00" >12.30pm</option>
                                            <option value="13:00:00" >1pm</option>
                                            <option value="13:30:00" >1.30pm</option>
                                            <option value="14:00:00" >2pm</option>
                                            <option value="14:30:00" >2.30pm</option>
                                            <option value="15:00:00" >3pm</option>
                                            <option value="15:30:00" >3.30pm</option>
                                            <option value="16:00:00" >4pm</option>
                                            <option value="16:30:00" >4.30pm</option>
                                            <option value="17:00:00" >5pm</option>
                                            <option value="17:30:00" >5.30pm</option>
                                            <option value="18:00:00" >6pm</option>
                                            <option value="18:30:00" >6.30pm</option>
                                            <option value="19:00:00" >7pm</option>
                                            <option value="19:30:00" >7.30pm</option>
                                            <option value="20:00:00" >8pm</option>
                                            <option value="20:30:00" >8.30pm</option>
                                            <option value="21:00:00" >9pm</option>
                                            <option value="21:30:00" >9.30pm</option>
                                            <option value="22:00:00" >10pm</option>
                                            <option value="22:30:00" >10.30pm</option>
                                            <option value="23:00:00" >11pm</option>
                                            <option value="23:30:00" >11.30pm</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_time">Clinic End Time :</label>
                                        <select class="form-control" id="end_time[]" name="end_time[]">
                                            <option value="">Select END TIME</option>
                                            <option value="00:00:00" >12am</option>
                                            <option value="00:30:00" >12.30am</option>
                                            <option value="01:00:00" >1am</option>
                                            <option value="01:30:00" >1.30am</option>
                                            <option value="02:00:00" >2am</option>
                                            <option value="02:30:00" >2.30am</option>
                                            <option value="03:00:00" >3am</option>
                                            <option value="03:30:00" >3.30am</option>
                                            <option value="04:00:00" >4am</option>
                                            <option value="04:30:00" >4.30am</option>
                                            <option value="05:00:00" >5am</option>
                                            <option value="05:30:00" >5.30am</option>
                                            <option value="06:00:00" >6am</option>
                                            <option value="06:30:00" >6.30am</option>
                                            <option value="07:00:00" >7am</option>
                                            <option value="07:30:00" >7.30am</option>
                                            <option value="08:00:00" >8am</option>
                                            <option value="08:30:00" >8.30am</option>
                                            <option value="09:00:00" >9am</option>
                                            <option value="09:30:00" >9.30am</option>
                                            <option value="10:00:00" >10am</option>
                                            <option value="10:30:00" >10.30am</option>
                                            <option value="11:00:00" >11am</option>
                                            <option value="11:30:00" >11.30am</option>
                                            <option value="12:00:00" >12pm</option>
                                            <option value="12:30:00" >12.30pm</option>
                                            <option value="13:00:00" >1pm</option>
                                            <option value="13:30:00" >1.30pm</option>
                                            <option value="14:00:00" >2pm</option>
                                            <option value="14:30:00" >2.30pm</option>
                                            <option value="15:00:00" >3pm</option>
                                            <option value="15:30:00" >3.30pm</option>
                                            <option value="16:00:00" >4pm</option>
                                            <option value="16:30:00" >4.30pm</option>
                                            <option value="17:00:00" >5pm</option>
                                            <option value="17:30:00" >5.30pm</option>
                                            <option value="18:00:00" >6pm</option>
                                            <option value="18:30:00" >6.30pm</option>
                                            <option value="19:00:00" >7pm</option>
                                            <option value="19:30:00" >7.30pm</option>
                                            <option value="20:00:00" >8pm</option>
                                            <option value="20:30:00" >8.30pm</option>
                                            <option value="21:00:00" >9pm</option>
                                            <option value="21:30:00" >9.30pm</option>
                                            <option value="22:00:00" >10pm</option>
                                            <option value="22:30:00" >10.30pm</option>
                                            <option value="23:00:00" >11pm</option>
                                            <option value="23:30:00" >11.30pm</option>
                                        </select>
                                        
                                    </div>
        
        <br><br><br>
        
                
     <div class="form-group">
                                        <label for="start_time">Clinic Start Time :</label>
                                        <select class="form-control" id="start_time[]" name="start_time[]">
                                            <option value="">Select Start Time</option>
                                            <option value="00:00:00" >12am</option>
                                            <option value="00:30:00" >12.30am</option>
                                            <option value="01:00:00" >1am</option>
                                            <option value="01:30:00" >1.30am</option>
                                            <option value="02:00:00" >2am</option>
                                            <option value="02:30:00" >2.30am</option>
                                            <option value="03:00:00" >3am</option>
                                            <option value="03:30:00" >3.30am</option>
                                            <option value="04:00:00" >4am</option>
                                            <option value="04:30:00" >4.30am</option>
                                            <option value="05:00:00" >5am</option>
                                            <option value="05:30:00" >5.30am</option>
                                            <option value="06:00:00" >6am</option>
                                            <option value="06:30:00" >6.30am</option>
                                            <option value="07:00:00" >7am</option>
                                            <option value="07:30:00" >7.30am</option>
                                            <option value="08:00:00" >8am</option>
                                            <option value="08:30:00" >8.30am</option>
                                            <option value="09:00:00" >9am</option>
                                            <option value="09:30:00" >9.30am</option>
                                            <option value="10:00:00" >10am</option>
                                            <option value="10:30:00" >10.30am</option>
                                            <option value="11:00:00" >11am</option>
                                            <option value="11:30:00" >11.30am></option>
                                            <option value="12:00:00" >12pm</option>
                                            <option value="12:30:00" >12.30pm</option>
                                            <option value="13:00:00" >1pm</option>
                                            <option value="13:30:00" >1.30pm</option>
                                            <option value="14:00:00" >2pm</option>
                                            <option value="14:30:00" >2.30pm</option>
                                            <option value="15:00:00" >3pm</option>
                                            <option value="15:30:00" >3.30pm</option>
                                            <option value="16:00:00" >4pm</option>
                                            <option value="16:30:00" >4.30pm</option>
                                            <option value="17:00:00" >5pm</option>
                                            <option value="17:30:00" >5.30pm</option>
                                            <option value="18:00:00" >6pm</option>
                                            <option value="18:30:00" >6.30pm</option>
                                            <option value="19:00:00" >7pm</option>
                                            <option value="19:30:00" >7.30pm</option>
                                            <option value="20:00:00" >8pm</option>
                                            <option value="20:30:00" >8.30pm</option>
                                            <option value="21:00:00" >9pm</option>
                                            <option value="21:30:00" >9.30pm</option>
                                            <option value="22:00:00" >10pm</option>
                                            <option value="22:30:00" >10.30pm</option>
                                            <option value="23:00:00" >11pm</option>
                                            <option value="23:30:00" >11.30pm</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_time">Clinic End Time :</label>
                                        <select class="form-control" id="end_time[]" name="end_time[]">
                                            <option value="">Select END TIME</option>
                                            <option value="00:00:00" >12am</option>
                                            <option value="00:30:00" >12.30am</option>
                                            <option value="01:00:00" >1am</option>
                                            <option value="01:30:00" >1.30am</option>
                                            <option value="02:00:00" >2am</option>
                                            <option value="02:30:00" >2.30am</option>
                                            <option value="03:00:00" >3am</option>
                                            <option value="03:30:00" >3.30am</option>
                                            <option value="04:00:00" >4am</option>
                                            <option value="04:30:00" >4.30am</option>
                                            <option value="05:00:00" >5am</option>
                                            <option value="05:30:00" >5.30am</option>
                                            <option value="06:00:00" >6am</option>
                                            <option value="06:30:00" >6.30am</option>
                                            <option value="07:00:00" >7am</option>
                                            <option value="07:30:00" >7.30am</option>
                                            <option value="08:00:00" >8am</option>
                                            <option value="08:30:00" >8.30am</option>
                                            <option value="09:00:00" >9am</option>
                                            <option value="09:30:00" >9.30am</option>
                                            <option value="10:00:00" >10am</option>
                                            <option value="10:30:00" >10.30am</option>
                                            <option value="11:00:00" >11am</option>
                                            <option value="11:30:00" >11.30am</option>
                                            <option value="12:00:00" >12pm</option>
                                            <option value="12:30:00" >12.30pm</option>
                                            <option value="13:00:00" >1pm</option>
                                            <option value="13:30:00" >1.30pm</option>
                                            <option value="14:00:00" >2pm</option>
                                            <option value="14:30:00" >2.30pm</option>
                                            <option value="15:00:00" >3pm</option>
                                            <option value="15:30:00" >3.30pm</option>
                                            <option value="16:00:00" >4pm</option>
                                            <option value="16:30:00" >4.30pm</option>
                                            <option value="17:00:00" >5pm</option>
                                            <option value="17:30:00" >5.30pm</option>
                                            <option value="18:00:00" >6pm</option>
                                            <option value="18:30:00" >6.30pm</option>
                                            <option value="19:00:00" >7pm</option>
                                            <option value="19:30:00" >7.30pm</option>
                                            <option value="20:00:00" >8pm</option>
                                            <option value="20:30:00" >8.30pm</option>
                                            <option value="21:00:00" >9pm</option>
                                            <option value="21:30:00" >9.30pm</option>
                                            <option value="22:00:00" >10pm</option>
                                            <option value="22:30:00" >10.30pm</option>
                                            <option value="23:00:00" >11pm</option>
                                            <option value="23:30:00" >11.30pm</option>
                                        </select>
                                        
                                    </div>
        
     <input type="submit">    
    </form>
    
   
    </section>

</div>