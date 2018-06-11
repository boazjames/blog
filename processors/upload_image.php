<?php session_start(); ?>
    <?php include '../config/config.php'; ?>
    <?php include '../libraries/Database.php'; ?>
    <?php
    $db = new Database();
    $user_id = $_SESSION['u_id'];
    $v1 = rand(1111, 9999);
    $v2 = rand(1111, 9999);
    $v3 = $v1 . $v2;
    $fnm = $_FILES['img_upload']['name'];
    $dst = "../user_images/KiddNation254_" . $v3 . $fnm;
    $dst1="KiddNation254_" . $v3 . $fnm;
    
    
    move_uploaded_file($_FILES['img_upload']['tmp_name'], $dst);
    
    $query = "UPDATE users SET user_image='$dst1' WHERE user_id=".$user_id;
    $update_row = $db->update($query);
    $query = "SELECT user_image FROM users WHERE user_id=" . $user_id;
    $user_img = $db->select($query)->fetch_assoc();
    ?>
<li id="li_img"><img id="user_nav_img" class="img-responsive img-circle" src="./user_images/<?php echo $user_img['user_image']; ?>"></li>
<script>
                $(document).ready(function(){
                    $('a#upload').click(function(e){
                        e.preventDefault();
                        var action_type=$(this).attr('data-action-type');
                        if(action_type='upload'){
                        $('#upload_img_modal').modal('show');
                        $('button#upload_img').one('click',function(e){
                            e.preventDefault();
                            action_type=$(this).attr('data-action-type');
                            if(action_type='upload_img'){
                            var img_upload=$('#img_upload').val();
                            if(img_upload==''){
                                alert('Please, select an image');
                            }else{
                                /*var formData=new FormData();
                                formData.append('file', $('input[type=file]')[0].files[0]);*/
                                //var form=$('form').get(0);
                                var form=$('#insert_img');
                                var form_data=new FormData(form[0]);
                               $.ajax({
                                    url: "upload_image.php",
                                    method: "POST",
                                    data: form_data,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function(data){
                                     $('#insert_img')[0].reset(); 
                                     $('#upload_img_modal').modal('hide');
                                     $('#li_img').html(data);
                                    }
                                }); 
                            }
                        }
                        });
                    }
                    });
                });
                </script>