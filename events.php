<?php require_once 'assets/php/header.php';



?>





<div class="container p-5 ">
    <div class="row">
        <h1 class="text-center">:) Under Construction!</h1>
    </div>
</div>


<!-- start wpo-portfolio-section -->
<section class="wpo-portfolio-section section-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="wpo-section-title">
                <span>View</span>
                <h2>Our Amazing Work</h2>
                <div class="section-title-img">
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <div class="sortable-gallery">
            <div class="gallery-filters"></div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="portfolio-grids gallery-container clearfix">
                        <?php
                        $result = $admin->fetchAllPosts(1);
                        foreach ($result as $data) {

                            $id = $data['post_id'];
                            $title = $data['post_title'];
                            $event = $data['event'];
                            $event_date = $data['event_date'];
                            $post_date = $data['post_date'];
                            $image = $data['post_image'];
                            $content = $data['post_content'];
                            $youtube = $data['yt_link'];

                            if ($youtube == null) {
                                $youtube = '<h4 class="m-5 p-5 border shadow-sm">Video Not Available</h4>';
                            } else {
                                $youtube = '<iframe width="560" height="315" src="' . $youtube . '" title="YouTube video player" frameborder="0" allowfullscreen></iframe> ';
                            }

                            $output = '
                            <div class="grid">
                                <div class="img-holder">
                                    <img src="admin/assets/php/' . $image . '" alt="">
                                    <div class="hover-content">
                                        <h4><a href="post.php?id=' . $id . '">' . $title . '</a></h4>
                                        <span>' . $event_date . '</span>
                                    </div>
                                </div>
                            </div>
                            ';
                            echo $output;
                        }

                        ?>
                        
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end container -->
</section>
<!-- end wpo-portfolio-section -->

<?php require_once 'assets/php/footer.php'; ?>