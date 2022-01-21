<?php 

if(isset($_POST['create_post'])){
    
    $post_title = $_POST['title'];
    $post_type_id = $_POST['post_type'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('Y-m-d');


    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_type_id, post_title, post_date, post_image, post_content, post_tags, post_status) "; 
    $query .= "VALUES({$post_type_id}, '{$post_title}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' ) ";

    $create_post_query = mysqli_query($connection, $query);

    errorQuery($create_post_query);
    echo "Post created successfully!" . " " . "<a href='posts.php'> View Posts </a>";
}

?>









<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" name="title" class="form-control">
</div>
<div class="form-group">
    <select name="post_type" id="">
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
    <input type="text" name="post_status" class="form-control">
</div>
<div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
</div>
<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" name="post_tags" class="form-control">
</div>
<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" class="form-control" cols="30" rows="10">

    </textarea>
</div>
<div  class="form-group">
    <input class="btn btn-primary" name="create_post" type="submit" value="Publish Post">
</div>

</form>