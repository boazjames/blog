<?php session_start(); ?>
<?php if (isset($_SESSION['ua_id'])) : ?>
    <?php include 'config/config.php'; ?>
    <?php include 'libraries/Database.php'; ?>
    <?php include 'helpers/format_helper.php'; ?>
    <?php
    $category_id = $_POST['id'];

    $db = new Database();
    $query = "SELECT * FROM categories WHERE id=" . $category_id;
    $category = $db->select($query)->fetch_assoc();

    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    $query = "UPDATE categories SET name='$name' WHERE id=" . $category_id;
    $update_row = $db->update($query);
    $query = "SELECT * FROM categories";
    $categories = $db->select($query);
    ?>
    <table class="table table-condensed table-striped table-hover" id="categories-tbl">
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th></th>
        </tr>
        <?php while ($row = $categories->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td>

                    <a data-action-type="edit" data-category-id="<?php echo $row['id']; ?>" class="btn btn-warning btn-sm" id="tedit">Edit</a>
                    <a data-action-type="delete" data-category-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>


                </td>
            </tr>
        <?php endwhile; ?>

    </table>
    <script src="./js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

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
<?php else : ?>

<?php endif; ?>
