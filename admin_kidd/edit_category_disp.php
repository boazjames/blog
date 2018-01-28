<?php session_start(); ?>
<?php if (isset($_SESSION['ua_id'])) : ?>
    <?php include 'config/config.php'; ?>
    <?php include 'libraries/Database.php'; ?>
    <?php include 'helpers/format_helper.php'; ?>
    <?php
    $category_disp_id = $_POST['id'];
    $db = new Database();
    $query = "SELECT * FROM categories WHERE id=" . $category_disp_id;
    $category = $db->select($query)->fetch_assoc();
    
    ?>

    <div class="form-group" id="edit_value">
        <label>Category Name</label>
        <input name="name" type="text" class="form-control" placeholder="Enter Name" value="<?php echo $category['name']; ?>" required>
        
    </div>
<?php else : ?>

<?php endif; ?>
