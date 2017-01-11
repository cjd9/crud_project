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
                
          
                   
                            <table id="appointments" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        
                                        <th>TreatMent ID</th>
                                        <th>Ocare ID</th> 
                                        <th>Patient Name</th> 
                                        <th>Treatments</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>TreatMent ID</th>
                                        <th>Ocare ID</th> 
                                        <th>Patient Name</th> 
                                        <th>Treatments</th>
                                        
                                    </tr>
                                </tfoot>
                       
                            </table>
                     
           
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {
      
//        var table = $('#appointments').DataTable({
//        "ajax": "dashboard/doctorAppointmentsDatatableForTreatment",
//            "columns": [
//            { "data": "appointment_id" },
//            { "data": "first_name" },
//            { "data": "appointment_date" },
//            { "data": "appointment_time" },
//            { "data": "clinic_name" },
//            { "data": "" ,
//            "defaultContent": "<button type='submit'  class='treatment btn btn-primary btn-block' />Add Treatment </button> "}
//        ]
//    });


//      var table = $('#appointments').DataTable({
//        "ajax": "dashboard/treatmentDone",
//            "columns": [
//            { "data": "appointment_id" },
//            { "data": "name"},
//            { "data": "appointment_date" },
//            { "data": "clinic_name" },
//            { "data": "treatment" },
//            { "data": "" ,
//            "defaultContent": "<button type='submit'  class='treatment btn btn-primary btn-block' />Update Treatment </button> "}
//        
//        ],
//        "responsive": true
//    });
    
    
          var table = $('#appointments').DataTable({
                    
         "ajax": "dashboard/treatmentPast",
            "columns": [
            { "data": "id" },
            { "data": "ocare_id" },
            { "data": "name"},
            { "data": "treatment" }
          
        ],
  
        
        "responsive": true
    });
    
        
        $(document).on('click', '.treatment', function () {
          var apid=$(this).closest('tr').find('td:first').text();
          window.location.href = "dashboard/fetchTreatmentDetails/"+apid;
       });
    });
</script>


<script type="text/javascript">
    $(function ()
    {
        $(".select2").select2();
    });
</script>