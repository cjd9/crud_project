$(document).ready(function () {
    $(".deleteclinicaction").click(function () {
        var r = confirm("Are You Sure?");
        if (r == true)
        {
            var btn = $(this).find("button[type=submit]:focus").val();
            var cid = $(this).parent().find(".cid").val();
            if (btn == 'delete')
            {
                $.ajax({
                    type: 'post',
                    url: "dashboard/deleteclinic",
                    data: {'clinic_id': cid},
                    success: function (res) {
                        alert(res);
                        console.log(res);
                        if (res == 1)
                        {
                            alert("Data Deleted");
                            location.reload();
                        } 
                        else
                        {
                            alert("we could not delete this data");
                        }
                    }
                });
            }  
        } 
        else
        {
            return false;
        }
    });
});