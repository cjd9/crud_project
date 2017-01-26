function validateEmail(inputtxt) {
    var emailid = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (inputtxt.match(emailid))
    {
        return true;
    } 
    else
    {
        return false;
    }
}

var topBar = $('.main-header'), $windowWidth, $windowHeight, subViews = $('.subviews'), toastrShowDuration = 2000;
var weekDays = {0: 'Sunday', 1: 'Monday', 2: 'Tuesday', 3: 'Wednesday', 4: 'Thursday', 5: 'Friday', 6: 'Saturday'};


//template viewport height and width
var viewport = function() {
    var e = window, a = 'inner';
    if(!('innerWidth' in window )) {
            a = 'client';
            e = document.documentElement || document.body;
    }
    return {
        width: e[a + 'Width'],
        height: e[a + 'Height']
    };
};

$windowWidth = viewport().width;
$windowHeight = viewport().height;

$(document).ready(function () {
	
   $('#datepickerbooking').datepicker({
	dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+20",
        defaultDate: "-1Y",
        maxDate: new Date()
    });
    
    
    $(document).on('click', '.remove-img', function(e) {
        e.preventDefault();

          var r = confirm("Are You Sure?");
    if (r == true)
    {
        var imgname=$(this).attr("img-name");
        var clinic_id=$('#clinic_id').val();
        $.ajax({
             type: 'POST',
             url:  HOME_URL + 'dashboard/deleteClinicImage',
             dataType: 'json',
             data: {

                 'imgname': imgname,
                 'clinic_id':clinic_id
             },
             success: function (res) {
                     

             }
        });
        $(this).closest("li").fadeOut("normal", function() {
        $(this).remove();
    });
    }
    else
    {
        return false;
    }
});
    
     
    $('#user_add').on('click', function () {
        var valid = true;
        if ($.trim($('#full_name').val()) == '') 
        {
            valid = false;
            $('#validationerrors').show();
            $('#validationerrors').html("Please Enter your Full Name");
        } 
        else if ($.trim($('#address').val()) == '') 
        {
            valid = false;
             $('#validationerrors').show();
            $('#validationerrors').html("Please Enter a appropiate Address").show();
        } 
        else if ($.trim($('#email').val()) == '') 
        {
            valid = false;
             $('#validationerrors').show();
            $('#validationerrors').html("Please Enter a Email Id").show();
        } 
         else if ( !validateEmail($('#email').val())  ) 
        {
        valid = false;
        $('#validationerrors').html("Enter a valid email id").show();

        }
        
        else if ($.trim($('#mobile_no').val()) == '') 
        {
            valid = false;
            $('#validationerrors').html("Please Enter Patients Mobile No").show();
        } 
        else if ($.trim($('#mobile_no').val().length) != '10') 
        {
            valid = false;
            $('#validationerrors').html("Please Enter Only 10 digits").show();
            return false;
        }
	else if ($.trim($('#datepickerbooking').val()) == '') 
        {
            valid = false;
            $('#validationerrors').html("Please Enter Your Date Of Birth").show();
            return false;
        }
        else if ($.trim($('#address').val()) == '') 
        {
            valid = false;
             $('#validationerrors').show();
            $('#validationerrors').html("Please Enter a appropiate Address").show();
        } 
        else if ($.trim($('#pin').val()) == '') 
        {
            valid = false;
             $('#validationerrors').show();
            $('#validationerrors').html("Please Enter a Pin Code").show();
        }

	 else if($('#g-recaptcha-response').val() == '') {
        valid = false;
        $('#validationerrors').html("Please check the captcha button").show();
      }
          
        if (valid) 
        {
            console.log("Submitting Form"); 
        } 
        else 
        {
            return false;
        }
    });


      $('#register_btn').on('click', function (e) {
        var valid = true;
        e.preventDefault();
        
        if ($.trim($('#first_name').val()) == '') 
        {
            valid = false;
            $('#validationerrors').show();
            $('#validationerrors').html("Please Enter your First Name");
        } 
        else if ($.trim($('#last_name').val()) == '') 
        {
            valid = false;
             $('#validationerrors').show();
            $('#validationerrors').html("Please Enter your last name").show();
        } 
        else if ($.trim($('#email_id').val()) == '') 
        {
            valid = false;
             $('#validationerrors').show();
            $('#validationerrors').html("Please Enter a Email Id").show();
        } 
         else if ( !validateEmail($('#email_id').val())  ) 
        {
        valid = false;
        $('#validationerrors').html("Enter a valid email id").show();

        }

         else if ($.trim($('#password').val()) == '') 
        {
            valid = false;
             $('#validationerrors').show();
            $('#validationerrors').html("Please Enter a password").show();
        } 

        else if ($.trim($('#confirm_password').val())!=$.trim($('#password').val())) 
        {
            valid = false;
             $('#validationerrors').show();
            $('#validationerrors').html("Passwords do noot match").show();
        } 
        
        else if ($.trim($('#mobile_no').val()) == '') 
        {
            valid = false;
            $('#validationerrors').html("Please Enter a Mobile No").show();
        } 
        else if ($.trim($('#mobile_no').val().length) != '10') 
        {
            valid = false;
            $('#validationerrors').html("Please Enter Only 10 digits").show();
            return false;
        }
  
       
          
        if (valid) 
        {
            console.log("Submitting Form");   
            $.ajax({
                type:'POST',
                url:HOME_URL + 'register',
                dataType:'json',
                data:$('#signup_form').serialize(),
                success: function(res){
                    if(res.status == 'ok') 
                    {
                       alert('Registration Successfull. login to continue');
                       window.location = HOME_URL+"/login";

                       location.reload();

                    }
                    else if(res.status == 'error'){
                     alert(res.message);

                        
                    }
                    else 
                    {
                        alert('fail');
                    }
                }
            }); 

        } 
        else 
        {
            return false;
        }
    });


     
  });

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
                    url: "dashboard/deleteUser",
                    data: {'user_id': cid},
                    success: function (res) {
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
    
