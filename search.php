<?php require_once 'assets/php/header.php'; ?>




<div class="container p-5 ">
    <div class="row">
        <h1 class="text-center">:) Under Construction!</h1>



        <?php

        if (isset($_POST['search'])) {
            $search =  $cuser->test_input($_POST['search']);

            $sql = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

           

            $count = count($result);
            if ($count == 0) {
                echo "<h1>Sorry, No result found! </h1>";
            } else {
               
                $posts = $admin->fetchAllPosts(0);

                while ($row = $posts) {

                    $post_title = $row['post_title'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
        ?>

                    <!-- First  Post -->
                    <h2>
                        <a href="#"><?php echo $post_title ?></a>
                    </h2>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="./images/<?php echo $post_image ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>


        <?php }
            }
        }
        ?>
    </div>
</div>



<?php require_once 'assets/php/footer.php'; ?>