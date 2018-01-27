<?php include '../config/config.php'; ?>
<?php include '../libraries/Database.php'; ?>
<?php if(!empty($_POST)) : ?>
<?php
$db=new Database();
$text= mysqli_real_escape_string($db->link,$_POST['search_sm']);
$query = "SELECT * FROM posts WHERE title LIKE '%" . $text . "%'";
            $search_result = $db->select($query);
            
?>
<p class="well text-primary text-center">
    Search Results:
</p>
<?php if ($search_result) : ?>
                <div id="search_result_main_click_sm">
                    <?php while ($row = $search_result->fetch_assoc()): ?>
                        <div id="search_result">
                            <a href="blog-single.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <div id="search_result_main_click_sm">
                    <div id="search_result">
                        No such post
                    </div>
                </div>
            <?php endif; ?>
<?php endif; ?>

