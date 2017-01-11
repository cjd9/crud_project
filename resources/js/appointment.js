function show_prompt() {
    var name = prompt('Please include a reason for rejecting');
    if (name != null && name != "")
    {
        return name;
    } else
    {
        location.reload();
        throw new Error("Something went badly wrong!");
    }
}
function reschedule() {

}

function actions_event_bind() {
 
    $('.action_btn').on('click', function(){
    var r = confirm("Are You Sure?");
    if (r == true)
    {
        //var btn = $(this).find("button[type=submit]:focus").val();
        var btn = $('.action_btn').val();
        
        var aid = $(this).parent().find(".aid").val();
       
        if (btn == '2')
        {
            var data = show_prompt();
        } else
        {
            var data = '';
        }
        $.ajax({
            type: 'post',
            url: "dashboard/dentistAnswer/" + btn + "/" + aid,
            data: {'reason': data},
            success: function (res) {
                 console.log(res);

                if (res == true)
                {
                    alert("Data Updated");
                    location.reload();
                } else
                {
                    console.log("something went wrong");
                }
            }
        });
    } else
    {
        return false;
    }
    });
}
$(function(){
    actions_event_bind();
});

//$(document).on("click", ".action", function () {
//    // Get the submit button element
//    
//    var r = confirm("Are You Sure?");
//    if (r == true)
//    {
//        //var btn = $(this).find("button[type=submit]:focus").val();
//        var btn = $('.action_btn').val();
//        alert(btn);
//        var aid = $(this).parent().find(".aid").val();
//        alert(aid);
//        if (btn == '2')
//        {
//            var data = show_prompt();
//        } else
//        {
//            var data = '';
//        }
//        $.ajax({
//            type: 'post',
//            url: "dashboard/dentistAnswer/" + btn + "/" + aid,
//            data: {'reason': data},
//            success: function (res) {
//                 console.log(res);
//
//                if (res == true)
//                {
//                    alert("Data Updated");
//                    location.reload();
//                } else
//                {
//                    console.log("something went wrong");
//                }
//            }
//        });
//    } else
//    {
//        return false;
//    }
//});
//







  