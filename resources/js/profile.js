/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  

$(function(){
    $('#profile_pic').on('mouseover', function(){
        $('#profile_pic .prpic_changpic_btn').show();
    });
    $('#profile_pic').on('mouseout', function(){
        $('#profile_pic .prpic_changpic_btn').hide();
    });
    //$('#profile_pic .prpic_changpic_btn').on('click', function(){
    //    $('#profile_pic .loader').css('height', $('#profile_pic .image').css('height')).show();
        //$('#newprpic').click();
   // });
    /*
    $('#newprpic').change(function(){
        alert($('#newprpic').val());
    });
    */
    $('#newprpic').file().choose(function(e, inp) {
//        $('#profile_pic .loader').css('height', $('#profile_pic .image').css('height')).show();
        // we make a hidden form and append it to body. Replace example.com with your server.
        var action = $(this).attr('action');
        var form = $('<form method="POST" enctype="multipart/form-data" action="'+action+'" target="hidden-iframe"></form>').hide().appendTo('body')
        inp.attr('name', 'prpicfile'); // its REQUIRED to give the input a name for the browser to submit it
        form.append(inp).submit();
    });
    $('#removeprpic').on('click',function(){
        user_id = $(this).attr('user_id');
        $.post(HOME_URL + 'dental/removePrPic',{user_id: user_id},function(res){
            if(res.status=='ok')
                $('#profileimg').attr('src', PRPICTH_URL + 'dummy.png');
            else
                oalert(res.message);
        });
    });
    
});
    function postprpicupload(data) {
        console.log(data);
        if(data.status == 'ok') {
            $('#profile_pic .loader').hide();
            $('#profileimg').attr('src', data.thumbimageurl);
        }
        else {
            oalert(data.message);
        }
    }