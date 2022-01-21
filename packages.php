<?php require_once 'assets/php/header.php';
$admin = new Admin(); ?>


<!-- start wpo-page-title -->
<section class="wpo-page-title mb-0">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <h2>Packages & information</h2>
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="index.html">Home</a></li>
                        <li>Packages</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->


<!-- start wpo-pricing-section -->
<section class="wpo-pricing-section section-padding mt-0">

    <?php
    $event = $admin->fetchAllTypes();
    if (!$event) {
        echo '<h1 class= "text-center"> Something wrong, Sorry for your inconvenience</h1>';
    } else {
        foreach ($event as $row) {
            $output = '<div class="container my-5">
                <div class="row">
                    <div class="wpo-section-title">
                        <span>Pricing</span>
                        <h2>' . $row['name'] . ' Packages</h2>
                        <div class="section-title-img">
                            <img src="assets/images/section-title.png" alt="">
                        </div>
                    </div>
                </div>';
            $package = $admin->fetchPackageDetailsByType($row['id']);
            if (!$package) {
                $output .= '<h3 class= "text-center text-muted"> Sorry, no packages available here.</h3><h5 class= "text-center text-muted"><span class="mt-5">Contact us for more information.</span></h5>';
            } else {
                $output .= '<div class="wpo-pricing-wrap"> 
                            <div class="row">';
                $package = $admin->fetchPackageDetailsByType($row['id']);
                foreach ($package as $row2) {
                    $output .= '
                                <div class="col col-lg-4 col-md-6 col-12 my-5">
                                    <div class="wpo-pricing-item">
                                        <div class="wpo-pricing-top">
                                            <div class="wpo-pricing-img">
                                                <img src="admin/assets/php/'.$row2['photo'].'" alt="" width="170px" height="150px">
                                            </div>
                                            <div class="wpo-pricing-text">
                                                <h4>' . $row2['name'] . '</h4>
                                                <h2>Rs.' . number_format($row2['price']) . '<span></span></h2>
                                            </div>
                                        </div>
                                        <div class="wpo-pricing-bottom">
                                            <div class="wpo-pricing-bottom-text ">
                                                <ul class="">'; //end
                    $data = $admin->fetchPackageDetailsById($row2['id']);
                    $str = $data['description'];
                    $array =  explode(';', $str,-1);
                    foreach ($array as $key => $value) {
                        $output .= ' <li class=""><i class="fad fa-chevron-double-right"></i>&nbsp;&nbsp;' . $value . '</li>';
                    }
                    $output .= ' </ul>
                                                <a data-fancybox href="admin/assets/php/'.$data['photo'].'">View Package</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>'; //end

                }
            }

            $output .= '</div>'; //end

            echo $output;
        }
    } // data loop end
    ?>
    <!-- <div class="container">
        <div class="row">
            <div class="wpo-section-title">
                <span>Pricing</span>
                <h2>Wedding Packages</h2>
                <div class="section-title-img">
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <div class="wpo-pricing-wrap">
            <div class="row">
                <div class="col col-lg-4 col-md-6 col-12">
                    <div class="wpo-pricing-item">
                        <div class="wpo-pricing-top">
                            <div class="wpo-pricing-img">
                                <img src="assets/images/pricing/1.png" alt="">
                            </div>
                            <div class="wpo-pricing-text">
                                <h4>Basic Package</h4>
                                <h2>Rs.60,000<span></span></h2>
                            </div>
                        </div>
                        <div class="wpo-pricing-bottom">
                            <div class="wpo-pricing-bottom-text">
                                <ul>
                                    <li>Wedding & Pre Shoot Album 10×24 (Page60) - 01</li>
                                    <li>Wedding Enlargement 16×24 - 01</li>
                                    <li>Home Coming Enlargement 16×24 - 01</li>
                                    <li>Photo Print (With Frame) - 02</li>
                                    <li>Thanks Card - 100</li>
                                </ul>
                                <a href="packages.php">Choose Package</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4 col-md-6 col-12">
                    <div class="wpo-pricing-item">
                        <div class="wpo-pricing-top">
                            <div class="wpo-pricing-img">
                                <img src="assets/images/pricing/2.png" alt="">
                            </div>
                            <div class="wpo-pricing-text">
                                <h4>Standard Package</h4>
                                <h2>Rs.90,000<span></span></h2>
                            </div>
                        </div>
                        <div class="wpo-pricing-bottom">
                            <div class="wpo-pricing-bottom-text">
                                <ul>
                                    <li>Wedding , Home Coming & Pre Shoot Album 10×24 (Page60) - 01</li>
                                    <li>Family or pre shoot album - 8×16 (Page32)</li>
                                    <li>Wedding Enlargement 16×24 - 01</li>
                                    <li>Home Coming Enlargement 16×24 - 01</li>
                                    <li>Full Day Pre Shoot</li>
                                    <li>Photo Print (With Frame) - 02</li>
                                    <li>Thanks Card - 150</li>
                                </ul>
                                <a href="packages.php">Choose Package</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4 col-md-6 col-12">
                    <div class="wpo-pricing-item">
                        <div class="wpo-pricing-top">
                            <div class="wpo-pricing-img">
                                <img src="assets/images/pricing/3.png" alt="">
                            </div>
                            <div class="wpo-pricing-text">
                                <h4>Luxary Package</h4>
                                <h2>Rs.120,000<span></span></h2>
                            </div>
                        </div>
                        <div class="wpo-pricing-bottom">
                            <div class="wpo-pricing-bottom-text">
                                <ul>
                                    <li>Wedding , Home Coming & Pre Shoot Album 12×28 or 15×20 (Page60) - 01</li>
                                    <li>0×24 Pre Shoot Album or 10×24 Family Album (Page32) 01</li>
                                    <li>Wedding Enlargement 20×30 - 01</li>
                                    <li>Home Coming Enlargement 16×24 - 01</li>
                                    <li>2 Day Full Full Coverage </li>
                                    <li>Full Day Pre Shoot</li>
                                    <li>Photo Print (With Frame) - 02</li>
                                    <li>Thanks Card - 150</li>
                                </ul>
                                <a href="packages.php">Choose Package</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</section>
<!-- start wpo-pricing-section -->





<?php require_once 'assets/php/footer.php'; ?>