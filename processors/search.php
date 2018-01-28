<?php if (!empty($_POST)) : ?>
    <?php
    $text = $_POST['text'];
    ?>
    <?php if (strlen($text) >= 3) : ?>
        <?php if ($text != "") : ?>
            <?php
            include '../config/config.php';
            include '../libraries/Database.php';
            $db = new Database();
            $text = mysqli_real_escape_string($db->link, $_POST['text']);
            $query = "SELECT * FROM posts WHERE title LIKE '%" . $text . "%'";
            $search_result = $db->select($query);
            ?>
            <?php if ($search_result) : ?>
                <div id="search_result_main">
                    <?php while ($row = $search_result->fetch_assoc()): ?>
                        <div id="search_result">
                            <a href="blog-single.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <div id="search_result_main">
                    <div id="search_result">
                        No such post
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
