 
    </div><!-- ./wrapper -->

  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<!-- jQuery UI 1.11.4 -->


<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

<script src="<?php echo base_url(); ?>resources/js/main.js"></script>
<script src="<?php echo base_url(); ?>resources/js/jquery-custom-file-input.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script  src="<?php echo PLUGINS_URL; ?>subview.js" ></script>
<script  src="<?php echo PLUGINS_URL; ?>moment/min/moment.min.js" ></script>
<script  src="<?php echo PLUGINS_URL; ?>moment-with-locales.min.js" ></script>
<script  src="<?php echo PLUGINS_URL; ?>fullcalendar/fullcalendar/fullcalendar.min.js" ></script>
<script  src="<?php echo PLUGINS_URL; ?>bootstrap-timepicker/js/bootstrap-timepicker.min.js" ></script>
<script  src="<?php echo PLUGINS_URL; ?>bootstrap-datetimepicker-latest.js" ></script>
<script  src="<?php echo PLUGINS_URL; ?>toastr/toastr.min.js" ></script>

<?php
 if(isset($js)):
            foreach($js as $v):
                ?><script src="<?php echo JS_URL  . $v; ?>" />
                    <?php
            endforeach;
		endif;
        ?>

<script>
    $.widget.bridge('uibutton', $.ui.button);
    function oalert(mess, callback) {
        alert(mess);
        if(callback)
            callback();
    }
</script>

<!-- Bootstrap 3.3.5 -->
<script src="<?php echo BS_URL; ?>/js/bootstrap.min.js"></script>
<scri
<!-- Select2 -->
<script src="<?php echo PLUGINS_URL; ?>/select2/select2.full.min.js"></script>
<script src="<?php echo PLUGINS_URL; ?>/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
<script src="<?php echo PLUGINS_URL; ?>/formValidation/formValidation.min.js"></script>
<script src="<?php echo PLUGINS_URL; ?>/jquery.blockUI.js"></script>
<script src="<?php echo PLUGINS_URL; ?>/formValidation/bootstrap.min.js"></script>


   
  
 
</body>
</html>
