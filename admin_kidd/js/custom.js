$(document).ready(function () {

    $('.alert').hide();

    CKEDITOR.replace('body');

    $('table#categories-tbl tr td a').on('click', function (e) {
        e.preventDefault();

        var action_type = $(this).attr('data-action-type');
        var category_id = $(this).attr('data-category-id');


        if (action_type == 'edit') {
            location.replace('edit_category.php?id=' + category_id);

        }
        else if (action_type == 'delete') {
            $('#myModal').modal('show');


            $('button').on('click', function (e) {
                e.preventDefault();
                var action_type = $(this).attr('data-action-type');
                if (action_type == 'delete_ok') {

                    $.ajax({
                        url: "del_category.php",
                        method: "POST",
                        data: {'id': category_id},
                        dataType: "",
                        success: function (data) {
                            //hide modal
                            $('#myModal').modal('hide');
                            //reload categories table
                            $('#categories-tbl').html(data);

                        }
                    });

                }
            });


        }

    });

    function verifyExtension(file_name, allowed_extension_array) {
        var extension = file_name.substr((file_name.lastIndexOf('.') + 1));
        for (var i = 0; i < allowed_extension_array.length; i++) {
            if (allowed_extension_array[i] == extension) {
                return true;
            }
        }
        return false;
    }


    function readURL(input, preview) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.show();
                preview.attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewImage(input, label, preview) {
        input.on('change', function (e) {
            if (this.files[0].size / 1024 > 2048) {
                $('.alert').show();
                $('.alert').html('File size must not exceed 2MB');
                $(this).val('');
            } else {
                preview.hide();
                label.find('span').html('Choose an image file...');

                var path = $(this).val().split('\\'),
                    fileName = path[path.length - 1];
                if (verifyExtension(fileName, ['png', 'PNG', 'jpeg', 'JPEG', 'jpg', 'JPG']) == true) {
                    readURL(this, preview);
                    label.find('span').html(fileName);
                    // if( e.target.value ){
                    //
                    // }
                    //     fileName = e.target.value.split( '\\' ).pop();

                    if (fileName)
                        label.find('span').html(fileName);
                    else
                        label.html('Choose an image file...');
                } else {
                    $('.alert').show();
                    $('.alert').html('File must be jgp, jpeg or png image type');
                    $(this).val('');
                    setTimeout(function () {
                        $('.alert').fadeOut(2000);
                    }, 3000)
                }


            }

        });

    }

    var input = $('#image'),
        label = $('#label-for-image'),
        preview = $('#preview');

    preview.hide();
    // $('#add-sermon-form')[0].reset();

    previewImage(input, label, preview);

    setTimeout(function () {
        $('.alert').fadeOut(2000);
    }, 3000);


});