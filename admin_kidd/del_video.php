<?php session_start(); ?>
<?php

if (isset($_SESSION['ua_id'])) {
    include 'config/config.php';
    include 'libraries/Database.php';

    $db = new Database();
    $query = "SELECT * FROM videos";
    $videos = $db->select($query);

    $id = $_POST['id'];
    $query = "DELETE FROM videos WHERE id=" . $id;
    $delete_row = $db->delete($query);
    $output = '';
    $query = "SELECT * FROM videos ORDER BY id DESC";
    $videos = $db->select($query);
    $output .= '<table class="table table-condensed table-striped table-hover" id="videos-tbl">
                      <tr>
                          <th>Video ID</th>
                        <th>Video Iframe</th>
                        <th></th>
                      </tr>';

    while ($row = $videos->fetch_assoc()) {
        $output .= '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['title'] . '</td>
                        <td>
                                <a data-action-type="delete" data-video-id="' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                                
                        
                        </td>
                      </tr>';
    }

    $output .= '</table>';

    echo $output;
}
?>

<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script>



    $(document).ready(function () {

        $('table#videos-tbl tr td a').on('click', function (e) {
            e.preventDefault();
            var action_type = null;
            action_type = $(this).attr('data-action-type');
            var video_id = null;
            video_id = $(this).attr('data-video-id');

            if (action_type == 'delete') {
                $('#myModal').modal('show');


                $('button').on('click', function (e) {
                    e.preventDefault();
                    var action_type = $(this).attr('data-action-type');
                    if (action_type == 'delete_ok') {

                        $.ajax({
                            url: "del_video.php",
                            method: "POST",
                            data: {'id': video_id},
                            dataType: "",
                            success: function (data) {
                                //hide modal
                                $('#myModal').modal('hide');
                                //show modal success
                                $('#del_success').modal('show');
                                //reload categories table
                                $('#videos-tbl').html(data);

                            }
                        });

                    }
                });


            }

        });


    });

</script>