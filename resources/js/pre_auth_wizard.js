var preAuthWizard = function () {
    "use strict";
    var wizardContent = $('#pre-auth-wizard');
    var wizardForm = $('#pre-auth-form');
    var numberOfSteps = $('.swMain > ul > li').length;
    var currentStep = 1;
    var stepValidationDone = false;
    var initWizard = function () {
        // function to initiate Wizard Form
        wizardContent.smartWizard({
            selected: 0,
            keyNavigation: false,
            onLeaveStep: leaveStepCallback,
            onShowStep: onShowStep,
            transitionEffect: 'none',
        });
        var numberOfSteps = 0;
        initValidator();
    };
    var initValidator = function () {
        wizardForm.formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                ocare_id: {
                    validators: {
                        notEmpty: {
                            message: 'The Ocare ID is required'
                        }
                    }
                },
                diagnosis:{
                    validators: {
                        notEmpty: {
                            message: 'Please Enter a Diagnosis'
                        }
                    }
                },
                  tooth_no:{
                    validators: {
                        notEmpty: {
                            message: 'Please Select the tooth/teeth no'
                        }
                    }
                },
                 chief_complaint:{
                    validators: {
                        notEmpty: {
                            message: 'Please Enter a Chief Complaint'
                        }
                    }
                },
                  treatment_done:{
                    validators: {
                        notEmpty: {
                            message: 'Please Select the treatments'
                        }
                    }
                },
                  dentist_comments:{
                    validators: {
                        notEmpty: {
                            message: 'Please Enter some Comments'
                        }
                    }
                },
            }
        });

        $(document).on('invalid.bs.validator', '.validate-me.select2', function (e) {
            console.log(e.detail);
        });
    };

    var onShowStep = function (obj, context) {
        wizardContent.find(".next-step").unbind("click").click(function (e) {
            e.preventDefault();
            wizardContent.smartWizard("goForward");
        });
        wizardContent.find(".back-step").unbind("click").click(function (e) {
            e.preventDefault();
            wizardContent.smartWizard("goBackward");
        });
        wizardContent.find(".finish-step").unbind("click").click(function (e) {
            e.preventDefault();
            onFinish(obj, context);
        });
    };
    var leaveStepCallback = function (obj, context) {
        currentStep = context.toStep;

        if (!stepValidationDone) {
            return validateSteps(context.fromStep, context.toStep);
        } else {
            stepValidationDone = false;
            return true;
        }
        // return false to stay on step and true to continue navigation
    };
    var onFinish = function (obj, context) {
        $.blockUI({css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }});

        //wizardForm.submit();
        wizardForm.data('formValidation').defaultSubmit();
    };
    var validateSteps = function (stepnumber, nextstep) {
        var isStepValid = true;

        if (numberOfSteps >= nextstep && nextstep > stepnumber) {

            $('#step-' + stepnumber).find('.validate-me').each(function (index) {
                wizardForm.data('formValidation').validateField($(this));
                if (!wizardForm.data('formValidation').isValidField($(this).attr('name'))) {

                    isStepValid = false;
                }
            });

            if (stepnumber == 1 && isStepValid) {
                var ocareid = $("#ocare_id").val();
//                if ($.trim($('#ocare_id').val()) == '') {
//                    isStepValid = false;
//                    //alert("Please Enter a Ocare Id");
//                    return isStepValid;
//                }

                var is_insuredpt = '';
                var r = $.ajax({
                    type: 'post',
                    url: HOME_URL + 'dashboard/getPatientProfile',
                    dataType: "json",
                    data: {'ocare_id': ocareid},
                    success: function (res) {
                        if (!res.length) {
                            alert("Invalid Ocare Id. Please Try Again!");
                            isStepValid = false;
                            return false;
                        }

                        if (res[0].is_insured == '0')
                        {
                            is_insuredpt = "No";
                        } else {
                            is_insuredpt = "Yes";
                        }


                        var d = new Date();

                        var month = d.getMonth() + 1;
                        var day = d.getDate();

                        var output = d.getFullYear() + '-' +
                                (month < 10 ? '0' : '') + month + '-' +
                                (day < 10 ? '0' : '') + day;

                        //                      if(res[0].date)
                        var today = new Date(output);


                        var opgdate = new Date(res[0].date);
                        var diff = new Date(today - opgdate);

                        // get days
                        var days = diff / 1000 / 60 / 60 / 24

                        if (days >= 183)
                        {
                            alert("OPG for this patient is invalid");
                            isStepValid = false;
                            return false;
                        }
                            
                            var name=(res[0].first_name) ? res[0].first_name : '';
                            if(res[0].last_name)
                            {
                                
                                name+=' '+res[0].last_name;
                            }
                            
                        $("#user_id").text((res[0].user_id) ? res[0].user_id : '');
                        $("#name").text(name);
                        
                     
                        $("#email").text((res[0].email_id) ? res[0].email_id : '');
                        $("#mobile").text((res[0].mobile_no) ? res[0].mobile_no : '');
                        $("#state").text((res[0].state) ? res[0].state : '');
                        $("#address").text((res[0].address) ? res[0].address : '');
                        $("#is_insured").text(is_insuredpt);
                        $("#pincode").text((res[0].pincode) ? res[0].pincode : '');
                        $("#dob").text((res[0].date_of_birth) ? res[0].date_of_birth : '');
                        
                        $("#citytreatment").text((res[0].city) ? res[0].city : '');
                        $("#appointment_id").val(res[0].appointment_id);
                        $("#patient_id").val(res[0].user_id);
                        $("div#ppicname h3").html(name);
                       
                        // $("div#ppicname h2").append(" "+res[0].last_name);
                        stepValidationDone = true;
                        wizardContent.smartWizard("goForward");
                    }


                });

            }
            else if( stepnumber == 4 ) {
                $('input.intra-oral-image').each(function(index) {
                    if ( $(this).val() == '' ) {
                        console.log($(this).attr('rel'));
                        $('#'+$(this).attr('rel')).addClass('error');
                        isStepValid = false;
                    }
                });
                
                if ( !isStepValid ) {
                    alert('Please click all 10 intra oral images.');
                }
            }
            else {
                return isStepValid;
            }

        }

        if (stepnumber !== 1)
            return isStepValid;

    };

    return {
        init: function () {
            initWizard();
        }
    };
}();