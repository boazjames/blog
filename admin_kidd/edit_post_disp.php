<?php session_start(); ?>
<?php if (isset($_SESSION['ua_id'])) : ?>
    <?php include 'config/config.php'; ?>
    <?php include 'libraries/Database.php'; ?>
    <?php include 'helpers/format_helper.php'; ?>
    <?php
    $post_disp_id = $_POST['id'];
    $db = new Database();
    $query = "SELECT * FROM posts WHERE id=" . $post_disp_id;
    $post = $db->select($query)->fetch_assoc();
    $query="SELECT * FROM categories";
        $categories=$db->select($query);
    ?>

    <div id="edit_value">
        <div class="form-group">
        <label>Post Title</label>
        <input name="title" type="text" class="form-control" placeholder="Enter Title" value="<?php echo $post['title']; ?>" required>
    </div>
    <div class="form-group">
        <label>Post Body</label>
        <textarea name="body" class="form-control" placeholder="Enter Post Body" required><?php echo $post['body']; ?></textarea>
    </div>
    <div class="form-group">
        <label>Category</label>
        <select name="category" class="form-control">
             <?php while($row=$categories->fetch_assoc()) : ?>
            <?php if($row['id']==$post['category']){
                $selected='selected';
            } else {
                $selected='';
            }
            ?>
            <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    </div>
<?php else : ?>

<?php endif; ?>

<script src="ckeditor/ckeditor.js"></script>
<script src="js/custom.js"></script>
