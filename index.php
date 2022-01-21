<?php require_once 'assets/php/header.php' ?>


<!-- start of hero -->
<section class="wpo-hero-slider">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="slide-inner slide-bg-image" data-background="assets/images/slider/slide-1.jpg">
                    <!-- <div class="gradient-overlay"></div> -->
                    <div class="container-fluid">
                        <div class="slide-content">
                            <div data-swiper-parallax="300" class="slide-title">
                                <h2>Our DREAMY Love</h2>
                            </div>
                            <div data-swiper-parallax="400" class="slide-text">
                                <p><em>There is only one happiness in this life,<br> to love and be loved</em></p>
                            </div>
                            <div class="clearfix"></div>
                            <div data-swiper-parallax="500" class="slide-btns">
                                <a href="about-us.php" class="theme-btn">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- end slide-inner -->
            </div> <!-- end swiper-slide -->

            <div class="swiper-slide">
                <div class="slide-inner slide-bg-image" data-background="assets/images/slider/slide-2.jpg">
                    <!-- <div class="gradient-overlay"></div> -->
                    <div class="container-fluid">
                        <div class="slide-content">
                            <div data-swiper-parallax="300" class="slide-title">
                                <h2>NO MATTER VISION</h2>
                            </div>
                            <div data-swiper-parallax="400" class="slide-text">
                                <p>Let your imagination inspire a remarkable event, perfectly tailored to suit your unique style and flair.</p>
                            </div>
                            <div class="clearfix"></div>
                            <div data-swiper-parallax="500" class="slide-btns">
                                <a href="events.php" class="theme-btn">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- end slide-inner -->
            </div> <!-- end swiper-slide -->

            <div class="swiper-slide">
                <div class="slide-inner slide-bg-image" data-background="assets/images/slider/slide-3.jpg">
                    <!-- <div class="gradient-overlay"></div> -->
                    <div class="container-fluid">
                        <div class="slide-content">
                            <div data-swiper-parallax="300" class="slide-title">
                                <h2>HAPPILY EVER AFTER</h2>
                            </div>
                            <div data-swiper-parallax="400" class="slide-text">
                                <p>Welcome and open yourself to your trust love this year with us!</p>
                            </div>
                            <div class="clearfix"></div>
                            <div data-swiper-parallax="500" class="slide-btns">
                                <a href="about-us.php" class="theme-btn">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- end slide-inner -->
            </div> <!-- end swiper-slide -->
        </div>
        <!-- end swiper-wrapper -->

        <!-- swipper controls -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
<!-- end of wpo-hero-slide-section-->

<!-- start wpo-partners-section -->
<section class="wpo-partners-section">
    <h2 class="hidden">Partners</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="partner-grids partners-slider owl-carousel">
                    <div class="grid">
                        <img src="assets/images/partners/11.png" alt>
                    </div>
                    <div class="grid">
                        <img src="assets/images/partners/14.png" alt>
                    </div>
                    <div class="grid">
                        <img src="assets/images/partners/12.png" alt>
                    </div>
                    <div class="grid">
                        <img src="assets/images/partners/15.png" alt>
                    </div>
                    <div class="grid">
                        <img src="assets/images/partners/13.png" alt>
                    </div>

                </div>
            </div>
        </div>
    </div> <!-- end container -->
</section>
<!-- end wpo-partners-section-->

<!-- start wpo-service-section -->
<section class="wpo-service-section">
    <h2 class="hidden">some</h2>
    <div class="container">
        <div class="wpo-service-active owl-carousel">


               <?php foreach ($admin->fetchAllTypes() as $row) {
                                $id = $row['id'];
                                $event = $row['name'];  ?>

                        <div class="wpo-service-item p-1" >
                            <div class="wpo-service-img " >
                                        
                    <?=  '<img src="assets/images/service/img-7.jpg" alt="" style="width: 360px; height:360px; ">' ?>

                        <div class="wpo-service-text">
                            <div class="s-icon">
                                <i class="fi flaticon-wedding"></i>
                            </div>
                    
                            <?= '<a href="events.php?='.$event.'">'.$event.'</a>' ?>

                            </div>
                        </div>
                    </div>
                <?php   } ?>

            
        </div>
    </div> <!-- end container -->
</section>
<!-- end wpo-service-section-->

<!-- start wpo-video-section -->
<section class="wpo-video-section section-padding">
    <div class="container">
        <div class="row">
            <div class="wpo-section-title">
                <span>Wedding Ceremony</span>
                <h2>Celebrating Your Love</h2>
                <div class="section-title-img">
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <div class="wpo-video-item">
            <div class="wpo-video-img">
                <img src="assets/images/cta.jpg" alt="">
                <a href="https://www.youtube-nocookie.com/embed/klAJM3xg60Y" class="video-btn" data-type="iframe"><i class="fi flaticon-play"></i></a>
            </div>
        </div>
        
    </div> <!-- end container -->
</section>
<!-- end wpo-video-section-->

<!-- start wpo-fun-fact-section -->
<section class="wpo-fun-fact-section">
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
                            <h3><span class="odometer" data-count="<?php $data = $admin->site_hits(); echo $data['hits']; ?>">00</span>+</h3>
                            <p>Site Hits</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="f-shape-1">
            <img src="assets/images/f-shape-1.png" alt="">
        </div>
        <div class="f-shape-2">
            <img src="assets/images/f-shape-2.png" alt="">
        </div>
    </div>
</section>
<!-- end wpo-fun-fact-section -->



<!-- start wpo-testimonials-section -->
<section class="wpo-testimonials-section section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-12">
                <div class="wpo-testimonials-img">
                    <img src="assets/images/testimonial/l-img.jpg" alt="">
                    <div class="wpo-testimonials-img-shape">
                        <img src="assets/images/testimonial/shape.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-7 offset-lg-1 col-12">
                <div class="wpo-testimonials-wrap">
                    <h2>What Our Client Say</h2>
                    <div class="wpo-testimonials-active owl-carousel">
                        <div class="wpo-testimonials-item">
                            <p>This is not only a wedding planning agency but also a dreamy friend.
                                I am very glad to work with them.They make my dream come true. In my wedding
                                I found them as my best friends. </p>
                            <div class="wpo-testimonial-info">
                                <div class="wpo-testimonial-info-img">
                                    <img src="assets/images/testimonial/img-1.jpg" alt="">
                                </div>
                                <div class="wpo-testimonial-info-text">
                                    <h5>Ashel Miskin</h5>
                                    <span>Wedding 08/06/21</span>
                                </div>
                            </div>
                        </div>
                        <div class="wpo-testimonials-item">
                            <p>This is not only a wedding planning agency but also a dreamy friend.
                                I am very glad to work with them.They make my dream come true. In my wedding
                                I found them as my best friends. </p>
                            <div class="wpo-testimonial-info">
                                <div class="wpo-testimonial-info-img">
                                    <img src="assets/images/testimonial/img-3.jpg" alt="">
                                </div>
                                <div class="wpo-testimonial-info-text">
                                    <h5>Malith Gurusinghe</h5>
                                    <span>Wedding 10/20/21</span>
                                </div>
                            </div>
                        </div>
                        <div class="wpo-testimonials-item">
                            <p>This is not only a wedding planning agency but also a dreamy friend.
                                I am very glad to work with them.They make my dream come true. In my wedding
                                I found them as my best friends. </p>
                            <div class="wpo-testimonial-info">
                                <div class="wpo-testimonial-info-img">
                                    <img src="assets/images/testimonial/img-2.jpg" alt="">
                                </div>
                                <div class="wpo-testimonial-info-text">
                                    <h5>Nimesha</h5>
                                    <span>Wedding 08/09/21</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end container -->

    <div class="wpo-testimonials-shape">
        <img src="assets/images/testimonial/shape2.png" alt="">
    </div>
</section>
<!-- end wpo-testimonials-section -->


<!-- start wpo-cta-section -->

<div class="wpo-cta-section">
    <div class="conatiner-fluid">
        <div class="wpo-cta-item">
            <span><img src="assets/images/section-title.png" alt=""></span>
            <h2>Lets Celebrate Your Love</h2>
            <a class="theme-btn-s2" href="contact.php">Contact Us</a>
        </div>
    </div>
</div>

<!-- end wpo-cta-section -->


<!-- start wpo-banner-section -->
<section class="wpo-banner-section">
    <h4>" We are making your memories to understand<br>what our lives mean to us "</h4>
</section>
<!-- end wpo-banner-section -->

<!-- start of wpo-contact-section -->
<section class="wpo-contact-section section-padding">
    <div class="container">
        <div class="wpo-contact-section-wrapper">
            <div class="wpo-contact-form-area">
                <div class="wpo-section-title">
                    <span>Let’s Meet</span>
                    <h2>Make an inquiry</h2>
                    <div class="section-title-img">
                        <img src="assets/images/section-title.png" alt="">
                    </div>
                </div>
                <form method="post" class="contact-validation-active" id="contact-form-main">
                    <div>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                    </div>
                    <div>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                    <div>
                        <input type="text" class="form-control" name="adress" id="adress" placeholder="Address">
                    </div>
                    <div>
                        <select name="service" class="form-control" id="eventType">
                            <option disabled="disabled" selected>Services</option>
                            <?php foreach ($admin->fetchAllTypes() as $row) {
                                $id = $row['id'];
                                $event = $row['name'];
                                echo "<option value=$id>$event</option>";
                            } ?>
                        </select>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="guest" id="guest" placeholder="Number Of Guests">

                    </div>
                    <div>
                        <select name="package" class="form-control last" id="package">
                        </select>
                    </div>
                    <div class="submit-area">
                        <button type="submit" class="theme-btn-s3">Send An Inquiry</button>
                        <div id="c-loader">
                            <i class="ti-reload"></i>
                        </div>
                    </div>
                    <div class="clearfix error-handling-messages">
                        <div id="success">Thank you</div>
                        <div id="error"> Error occurred while sending email. Please try again later.
                        </div>
                    </div>
                </form>
                <div class="border-style"></div>
            </div>
            <div class="vector-1">
                <img src="assets/images/contact/1.png" alt="">
            </div>
            <div class="vector-2">
                <img src="assets/images/contact/2.png" alt="">
            </div>
        </div>
    </div>
</section>
<!-- end of wpo-contact-section -->

<script>
    

        //select option package
        $('body').on('change', '#eventType', function() {

            var id = $(this).val();

            if (id != '0') {
                $.ajax({
                    type: 'POST',
                    url: 'admin/assets/php/admin-action.php',
                    data: {
                        package_type_id: id
                    },
                    success: function(data) {
                        $("#package").html(data);
                    }
                });
            } else {
                $("#package").html('<option value="0" selected>Select Event Type First</option>');
            }
        });
</script>


<!-- start of wpo-site-footer-section -->
<?php require_once 'assets/php/footer.php' ?>