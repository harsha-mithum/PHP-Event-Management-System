
<?php 

if(isset($_GET['p_id'])){
$the_post_id =  $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$select_posts_by_id = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_posts_by_id)){
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_type_id = $row['post_type_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];

if(isset($_POST['update_post'])){
    $post_title = $_POST['title'];
    $post_type_id = $_POST['post_type'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)){
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_type_id = '{$post_type_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} ";

    $update_query = mysqli_query($connection, $query);

    errorQuery($update_query);
}
}
?>
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title ?>" type="text" name="title" class="form-control">
</div>
<div class="form-group">
    <select name="post_type" id="">
        <option value="<?php echo $post_type_id; ?>"></option>
        <?php

                $query = "SELECT * FROM event_type";
                $select_type = mysqli_query($connection, $query);
        
                errorQuery($select_type);

                while($row = mysqli_fetch_assoc($select_type)){
                    $type_id = $row['type_id'];
                    $type_name = $row['type_name'];

                    echo "<option value='{$type_id}'>{$type_name}</option>";
                }

        ?>
    </select>
</div>
<div class="form-group">
    <label for="post_status">Post Status</label>
    <input value="<?php echo $post_status ?>" type="text" name="post_status" class="form-control">
</div>
<div class="form-group">
    <img width="100px" src="../images/<?php echo $post_image; ?>" alt="">
    <input type="file" name="image">
</div>
<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags ?>" type="text" name="post_tags" class="form-control">
</div>
<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" class="form-control" cols="30" rows="10">
    <?php echo $post_content ?>
    </textarea>
</div>
<div  class="form-group">
    <input class="btn btn-primary" name="update_post" type="submit" value="Update Post">
</div>

</form>