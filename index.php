<?php include 'includes/header.php'; ?>

<?php
$db = new Database();
$query = "SELECT * FROM posts ORDER BY id DESC LIMIT 3";
$posts = $db->select($query);
?>


<!-- Blog -->
<div id="blog" class="section md-padding bg-grey">

    <!-- Container -->
    <div class="container">

        <!-- Row -->
        <div class="row">

            <!-- Section header -->
            <div class="section-header text-center">
                <h2 class="title">Latest Posts</h2>
            </div>
            <!-- /Section header -->

            <?php if ($posts) : ?>
                <?php while ($row = $posts->fetch_assoc()) : ?>
                    <!-- blog -->
                    <div class="col-md-4" id="blog-main">
                        <div class="blog" id="latest_blog">
                            <div class="blog-img">
                                <img id="latest_post_img" class="img-responsive" src="<?php echo $row['post_image']; ?>" alt="">
                            </div>
                            <div class="blog-content">
                                <ul class="blog-meta">
                                    <li><i class="fa fa-user"></i><?php echo $row['author']; ?></li>
                                    <li><i class="fa fa-clock-o"></i><?php echo formatTime($row['time']); ?></li>

                                </ul>
                                <h3><?php echo $row['title']; ?></h3>
                                <?php echo shortenText($row['body'], 150); ?>
                                <a href="blog-single.php?id=<?php echo urlencode($row['id']); ?>">Read more</a>
                            </div>
                        </div>
                    </div>
                    <!-- /blog -->

                <?php endwhile; ?>

            <?php else : ?>
                <P>There are no posts</P>
            <?php endif; ?>


        </div>
        <!-- /Row -->

    </div>
    <!-- /Container -->

</div>
<!-- /Blog -->


<?php include 'includes/footer.php'; ?>
<script>

</script>
<script>
    $("a#get_started").on('click', function (e) {
        e.preventDefault();
        var hash = this.hash;
        $('html, body').animate({
            scrollTop: $(this.hash).offset().top
        }, 600);
    });
</script>
<script>
    $('#alert').hide();
    function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
    var original_disp = document.getElementById('subcriptions_div');
    var inner_content = original_disp.innerHTML;
    $('form#subscribe').submit(function (e) {
        e.preventDefault();
        var sub=$('#subscription_input');
        var sub_val=sub.val();
        if(isEmail(sub_val)==true){
            $.ajax({
            url: "./processors/subscriptions.php",
            method: "POST",
            data: $(this).serialize(),
            dataType: 'html',
            success: function (data) {
                $('#subcriptions_div').html(data);
                setTimeout(function () {
                    $('#subcriptions_div').html(inner_content);
                    $('#subscription_input').attr("disabled","disabled");
                    $('#eemail').attr("disabled","disabled");
                }, 5000);
            }
        });
        }else{
            $('#alert').show();
            setTimeout(function () {
                    $('#alert').hide();
                }, 5000);
        }
        
        /*
        $.ajax({
            url: "./processors/subscriptions.php",
            method: "POST",
            data: $(this).serialize(),
            dataType: 'html',
            success: function (data) {
                $('#subcriptions_div').html(data);
                setTimeout(function () {
                    $('#subcriptions_div').html(inner_content);
                    $('#subscription_input').attr("disabled","disabled");
                    $('#eemail').attr("disabled","disabled");
                }, 5000);
            }
        });*/
    });
</script>
