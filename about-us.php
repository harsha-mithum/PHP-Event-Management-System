<?php require_once 'assets/php/header.php';
?>



<!-- start wpo-page-title -->
<section class="wpo-page-title">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <h2>About</h2>
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="index.html">Home</a></li>
                        <li>About</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- start wpo-banner-section -->
<section class="wpo-banner-section">
    <h4>" We are making your memories to understand<br>what our lives mean to us "</h4>
</section>
<!-- end wpo-banner-section -->


<!-- start of wpo-about-section -->
<section class="wpo-about-section-s2 section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="wpo-about-wrap">
                    <div class="wpo-about-item">
                        <div class="wpo-about-img">
                            <img src="assets/images/about/3.jpg" alt="">
                        </div>
                        <p class="m-2 text-center">Malintha Pathmasiri - Founder of Ideagraphy Studio</p>
                    </div>
                    <div class="ab-shape">
                        <img src="assets/images/about/shape.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="wpo-about-text">
                    <div class="wpo-about-icon">
                        <div class="icon">
                            <img src="assets/images/about/thumb.png" alt="">
                        </div>
                    </div>
                    <div class="wpo-about-icon-content">
                        <h2>Capturer of Your Perfect Event</h2>
                        <p class="text-right">Here are a few things about Us. We love photography.
                            For us it is our soul passion. It is the language we most blissfully choose to communicate with.
                            Our alphabets are our frames.
                        </p>
                        <p>It is your sparkling day that you celebrate your love, joy, friendship and family. Everybody admires and enjoys those memories forever!!!
                            That’s why our foremost team of experts are always there to capture each and every special moment from the dawn to the dark, and they work hard to make sure every click captures every single emotion, expression, and every movement that you experience right through your unforgettable day.
                        </p>
                        <p> Rather than posing every shot, we allow the day to unfold naturally so that we can capture free spirited, unpretending movements. Letting you and your family relax and be completely comfortable during your celebration. We like to keep the posed shots to a minimum. Blending the nature with the photograph is our first choice which enhances the liveliness of the photograph.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="wpo-about-text">
                    <div class="wpo-about-icon-content mt-5">
                        <p>
                            Today, Ideagraphy Studio services throughout several areas like Videography,
                            Event photography, Commercial photography, multimedia camera, Documentary Video and is the pioneer of Arial videography in Sri Lanka.
                            Fashion and Commercial Photography
                            This is another arena where we have entered in and accomplished successfully. 
                            What we believe is creativity, innovatory and exciting is the main theory behind fashion and commercial photography.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end of wpo-about-section -->

<!-- start wpo-fun-fact-section -->
<section class="wpo-fun-fact-section-s2 section-padding">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-fun-fact-grids clearfix">
                    <div class="grid">
                        <div class="info">
                            <h3><span class="odometer" data-count="<?= $admin->totalCount('users'); ?>">00</span>+</h3>
                            <p>Happy Families</p>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="info">
                            <h3><span class="odometer" data-count="<?= $admin->totalCount('events'); ?>">00</span></h3>
                            <p>Events</p>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="info">
                            <h3><span class="odometer" data-count="<?= $admin->totalCount('images'); ?>">00</span>+</h3>
                            <p>Captured Moments</p>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="info">
                            <h3><span class="odometer" data-count="<?php $data = $admin->site_hits();
                                                                    echo $data['hits']; ?>">00</span>+</h3>
                            <p>Site Hits</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end wpo-fun-fact-section -->

<!-- start wpo-team-section -->
<section class="wpo-team-section section-padding pt-0">
    <div class="container">
        <div class="row">
            <div class="wpo-section-title">
                <span>Our Team</span>
                <h2>Meet Our Members</h2>
                <div class="section-title-img">
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <div class="wpo-team-wrap">
            <div class="row justify-content-center">
                <?php foreach ($admin->fetchAllStaff(1) as $row) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $photo = $row['photo'];
                    $designation = $row['designation'];
                    echo '<div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="wpo-team-item">
                                <div class="wpo-team-img">
                                    <img src="assets/php/' . $photo . '" alt="">
                                </div>
                                <div class="wpo-team-text">
                                    <h3><a href="#">' . ucwords($name) . '</a></h3>
                                    <span>' . $designation . '</span>
                                </div>
                            </div>
                        </div>';
                } ?>

            </div>
        </div>

    </div> <!-- end container -->
</section>
<!-- end wpo-team-section -->




<!-- start of wpo-site-footer-section -->
<?php require_once 'assets/php/footer.php' ?>