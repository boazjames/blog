<?php

session_start(); 
if(isset($_SESSION['ua_id'])){
include 'config/config.php';
include 'libraries/Database.php'; 

$db=new Database();
 $query="SELECT * FROM categories";
        $categories=$db->select($query);

    $id=$_POST['id'];
    $query="DELETE FROM categories WHERE id=".$id;
    $delete_row=$db->delete($query);
    $output='';
    $query="SELECT * FROM categories";
    $categories=$db->select($query);
   $output.='<table class="table table-condensed table-striped table-hover" id="categories-tbl">
                      <tr>
                          <th>Category ID</th>
                        <th>Category Name</th>
                        <th></th>
                      </tr>';
   
   while($row=$categories->fetch_assoc()){
       $output.='<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['name'].'</td>
                        <td>
                           
                                <a data-action-type="edit" data-category-id="'.$row['id'].'" class="btn btn-warning btn-sm" id="tedit">Edit</a>
                                <a data-action-type="delete" data-category-id="'.$row['id'].'" class="btn btn-danger btn-sm">Delete</a>
                                
                        
                        </td>
                      </tr>';
   }
   
   $output.='</table>';
  
    echo $output;
    
} ?>

<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
    <script>



        $(document).ready(function () {

            $('table#categories-tbl tr td a').on('click', function (e) {
                e.preventDefault();
                var action_type = null;
                action_type = $(this).attr('data-action-type');
                var category_id = null;
                category_id = $(this).attr('data-category-id');



                if (action_type == 'edit') {
                    $('#edit_category').modal('show');
                    $.ajax({
                        url: "edit_category_disp.php",
                        method: "POST",
                        data: "id=" + category_id,
                        dataType: "",
                        success: function (data) {
                            //category value
                            $('#edit_value').html(data);
                            $('button#edit_cat').on('click', function (e) {
                                e.preventDefault();
                                $.ajax({
                                    url: "edit_category.php",
                                    method: "POST",
                                    data: "id=" + category_id + "&" + $('#edit_cat_form').serialize(),
                                    dataType: "",
                                    success: function (data) {
                                        //hide modal
                                        $('#edit_category').modal('hide');
                                        //show modal success
                                        $('#edit_success').modal('show');
                                        //reload categories table
                                        $('#categories-tbl').html(data);
                                        action_type = null;
                                        category_id = null;
                                    }
                                });
                            });

                        }
                    });

                } else if (action_type == 'delete') {
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
                                    //show modal success
                                    $('#del_success').modal('show');
                                    //reload categories table
                                    $('#categories-tbl').html(data);

                                }
                            });

                        }
                    });


                }

            });


        });

    </script>