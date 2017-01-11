         
      jQuery(document).ready(function()
 
    {
        //Initialize Select2 Elements
        //$(".select2").select2();

        //Datemask dd/mm/yyyy
//        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
//        //Datemask2 mm/dd/yyyy
//        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
//        //Money Euro
//        $("[data-mask]").inputmask();

        //Date range picker
//        $('#reservation').daterangepicker();
//        //Date range picker with time picker
//        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
//        //Date range as a button
//        $('#daterange-btn').daterangepicker(
//                {
//                    ranges: {
//                        'Today': [moment(), moment()],
//                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
//                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//                        'This Month': [moment().startOf('month'), moment().endOf('month')],
//                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//                    },
//                    startDate: moment().subtract(29, 'days'),
//                    endDate: moment()
////                },
//                function (start, end) {
//                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
//                }
//        );

        //Date picker
//        $('#datepicker').datepicker({
//            autoclose: true
//        });
//
//        //iCheck for checkbox and radio inputs
//        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
//            checkboxClass: 'icheckbox_minimal-blue',
//            radioClass: 'iradio_minimal-blue'
//        });
//        //Red color scheme for iCheck
//        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
//            checkboxClass: 'icheckbox_minimal-red',
//            radioClass: 'iradio_minimal-red'
//        });
//        //Flat red color scheme for iCheck
//        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
//            checkboxClass: 'icheckbox_flat-green',
//            radioClass: 'iradio_flat-green'
//        });
//
//        //Colorpicker
//        $(".my-colorpicker1").colorpicker();
//        //color picker with addon
//        $(".my-colorpicker2").colorpicker();
//
//        //Timepicker
//        $(".timepicker").timepicker({
//            showInputs: false
//        });

        // UPLOAD CLASS DEFINITION
        // ======================

        //var myUploadForm = $('my-upload');
        //var dropZone = $('#drop-zone').dropzone({  url: "null" });

        //var removeButton = Dropzone.createElement("<button>Remove file</button>");

        /*var startUpload = function (files) {
            console.log(files);
        }

        myUploadForm.addEventListener('submit', function (e) {
            var uploadFiles = document.getElementById('js-upload-files').files;
            e.preventDefault();

            startUpload(uploadFiles);
        });

        dropZone.ondrop = function (e) {
            e.preventDefault();
            this.className = 'upload-drop-zone';
            startUpload(e.dataTransfer.files)
        }

        dropZone.ondragover = function () {
            this.className = 'upload-drop-zone drop';
            return false;
        }

        dropZone.ondragleave = function () {
            this.className = 'upload-drop-zone';
            return false;
        }*/

    }
    );

    var image_input_index = 0;
    var image_select_window_open = image_selected = false;

    $(document).ready(function() {

        $(document).on('click', '.add-image-input', function(e) {
console.log('popo');
            var form = $(this).closest('form');
                   $(this).siblings('.images-container').append('<li class="uploaded-img-preview" id="clinic_images" style="float: left;" ><div><img src=""><div><a class="remove-uploaded-img" href="" image-index-"' + (image_input_index + 1) + '">Remove</a></div></div><input type="file" name="'+ $(this).attr('image-type') +'_images['+ image_input_index +']" id="image-input-' + (image_input_index + 1) + '" class="upload-image hide"></li>');
console.log(image_input_index);
                   $('#image-input-' + (image_input_index + 1)).click();
                   image_select_window_open = true;
                   image_selected = false;
        });

        $(document).on('change', '.upload-image', function(e) {
               image_selected = true;
                var form = $(this).closest('form');
                productImageSelectHandler($(this), $('#image-input-' + (image_input_index + 1)).closest('li').find('img'));

                //image_input_index = image_input_index + 1;
                //form.append('<input type="file" name="images[' + image_input_index + ']" id="image-input-' + image_input_index + '" class="upload-image pos-absolute" style="opacity: 0;">');
                //$('#add-image-input').attr('image-index', image_input_index);
                       //reorderImages();
        });

        $(document).on('click', '.remove-uploaded-img', function(e) {
            e.preventDefault();
            $('#image-input-' + $(this).attr('image-index')).remove();
            $(this).closest('li').remove();
        });

    });

    $(window).focus(function() {

        //remove product image upload file input if no file is selected and user closes the file browser window
        window.setTimeout(function() {
            if(image_select_window_open) {
                image_select_window_open = false;
                if(!image_selected) {
                    $('.uploaded-img-preview:last').remove();
                }
            }
        }, 100);
    });

    function productImageSelectHandler(file_input, image_ele)
    {
        // get selected file
        var oFile = file_input[0].files[0];

        if(typeof oFile == 'undefined')
            return false;

        // check for image type (jpg and png are allowed)
        var rFilter = /^(image\/jpeg|image\/png|image\/bmp|image\/jpg)$/i;
        if (! rFilter.test(oFile.type)) {
            showToastr('Please select a valid image file (jpg, jpg, png, bmp are allowed).', 'error', true, 3000);
            image_ele.closest('li').remove();
            return;
        }

        image_ele.attr('alt', 'loading...');

        // prepare HTML5 FileReader
        var oReader = new FileReader();

        oReader.onload = function(e) {

            //$('#images-container').prepend('<li class="uploaded-img-preview"><div><img src="' + e.target.result + '"><div><a class="remove-uploaded-img" href="" image-index-"' + file_input_index + '">Remove</a></div></div></li>');

            var img;
            img = document.createElement("img");
            img.src = e.target.result;

            img.onload = function() {
                var canvas, ctx, resizeInfo, thumbnail, _ref, _ref1, _ref2, _ref3;

                canvas = document.createElement("canvas");
                ctx = canvas.getContext('2d');

                resizeInfo = thumnailResizeInfo(img);

                if (resizeInfo.trgWidth == null) {
                    resizeInfo.trgWidth = resizeInfo.optWidth;
                }
                if (resizeInfo.trgHeight == null) {
                    resizeInfo.trgHeight = resizeInfo.optHeight;
                }

                canvas.width = resizeInfo.trgWidth;
                canvas.height = resizeInfo.trgHeight;

                drawImageIOSFix(ctx, img, (_ref = resizeInfo.srcX) != null ? _ref : 0, (_ref1 = resizeInfo.srcY) != null ? _ref1 : 0, resizeInfo.srcWidth, resizeInfo.srcHeight, (_ref2 = resizeInfo.trgX) != null ? _ref2 : 0, (_ref3 = resizeInfo.trgY) != null ? _ref3 : 0, resizeInfo.trgWidth, resizeInfo.trgHeight);
                thumbnail = canvas.toDataURL("image/png");
                image_ele.attr('src', thumbnail);
                image_input_index = image_input_index + 1;
            };
        };

        // read selected file as DataURL
        oReader.readAsDataURL(oFile);
    }

    function thumnailResizeInfo(file)
    {
        console.log(file.height);
        var info, srcRatio, trgRatio;
        info = {
          srcX: 0,
          srcY: 0,
          srcWidth: file.width,
          srcHeight: file.height
        };
        srcRatio = file.width / file.height;
        info.optWidth = 100;
        info.optHeight = 100;
        if ((info.optWidth == null) && (info.optHeight == null)) {
          info.optWidth = info.srcWidth;
          info.optHeight = info.srcHeight;
        } else if (info.optWidth == null) {
          info.optWidth = srcRatio * info.optHeight;
        } else if (info.optHeight == null) {
          info.optHeight = (1 / srcRatio) * info.optWidth;
        }
        trgRatio = info.optWidth / info.optHeight;
        if (file.height < info.optHeight || file.width < info.optWidth) {
          info.trgHeight = info.srcHeight;
          info.trgWidth = info.srcWidth;
        } else {
          if (srcRatio > trgRatio) {
            info.srcHeight = file.height;
            info.srcWidth = info.srcHeight * trgRatio;
          } else {
            info.srcWidth = file.width;
            info.srcHeight = info.srcWidth / trgRatio;
          }
        }
        info.srcX = (file.width - info.srcWidth) / 2;
        info.srcY = (file.height - info.srcHeight) / 2;
        return info;    
    }

    detectVerticalSquash = function(img) {
        
        var alpha, canvas, ctx, data, ey, ih, iw, py, ratio, sy;
        iw = img.naturalWidth;
        ih = img.naturalHeight;
        canvas = document.createElement("canvas");
        canvas.width = 1;
        canvas.height = ih;
        ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);
        data = ctx.getImageData(0, 0, 1, ih).data;
        sy = 0;
        ey = ih;
        py = ih;
        while (py > sy) {
          alpha = data[(py - 1) * 4 + 3];
          if (alpha === 0) {
            ey = py;
          } else {
            sy = py;
          }
          py = (ey + sy) >> 1;
        }
        ratio = py / ih;
        if (ratio === 0) {
          return 1;
        } else {
          return ratio;
        }
    };

    drawImageIOSFix = function(ctx, img, sx, sy, sw, sh, dx, dy, dw, dh) {
        
        var vertSquashRatio;
        vertSquashRatio = detectVerticalSquash(img);
        return ctx.drawImage(img, sx, sy, sw, sh, dx, dy, dw, dh / vertSquashRatio);
    };
