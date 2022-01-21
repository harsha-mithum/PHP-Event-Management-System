<?php require_once 'assets/php/header.php';
$id = $_GET['id'];
$data = $admin->fetchPostDetailsById($id);

if ($data) {

    $title = $data['post_title'];
    $event = $data['event'];
    $event_date = $data['event_date'];
    $post_date = $data['event_date'];
    $post_image = $data['post_image'];
    $content = $data['post_content'];
    $youtube = $data['yt_link'];

    if ($youtube == null) {
        $youtube = '<h4 class="m-5 p-5 border shadow-sm">Video Not Available</h4>';
    } else {
        $youtube = '<iframe width="560" height="315" src="' . $youtube . '" title="YouTube video player" frameborder="0" allowfullscreen></iframe> ';
    }
}
?>




<div class="container p-5 ">
    <div class="row">
        <h1 class="text-center">:) Under Construction!</h1>
    </div>
</div>


 <!-- start wpo-blog-single-section -->
 <section class="wpo-blog-single-section wpo-blog-single-left-sidebar-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-10 col-12 offset-lg-1">
                        <div class="wpo-blog-content">
                            <div class="post format-standard-image">
                                <div class="entry-media">
                                    <img src="admin/assets/php/<?= $post_image  ?>" alt width="auto" height="auto" style="max-height: 50% !important;">
                                </div>
                                <div class="entry-meta">
                                    <ul>
                                        <li><? $event ?></li>
                                        <li><i class="fi flaticon-calendar"></i>posted on <?php { echo $admin->timeInAgo($data['event_date']);} ?>, <?php { echo $post_date;} ?></li>
                                    </ul>
                                </div>
                                <h2>Best wedding gift you may like & choose.</h2>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful.</p>
                                <blockquote>
                                    Combined with a handful of model sentence structures, generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                </blockquote>
                                <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,</p>

                                <div class="gallery">
                                    <div>
                                        <img src="assets/images/blog-details/1.jpg" alt="">
                                    </div>
                                    <div>
                                        <img src="assets/images/blog-details/2.jpg" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="tag-share clearfix">
                                <div class="tag">
                                    <span>Share: </span>
                                    <ul>
                                        <li><a href="blog-single-fullwidth.html#">Planning</a></li>
                                        <li><a href="blog-single-fullwidth.html#">photography</a></li>
                                        <li><a href="blog-single-fullwidth.html#"> creative</a></li>
                                    </ul>
                                </div>
                            </div> <!-- end tag-share -->
                            <div class="tag-share-s2 clearfix">
                                <div class="tag">
                                    <span>Share: </span>
                                    <ul>
                                        <li><a href="blog-single-fullwidth.html#">facebook</a></li>
                                        <li><a href="blog-single-fullwidth.html#">twitter</a></li>
                                        <li><a href="blog-single-fullwidth.html#">linkedin</a></li>
                                        <li><a href="blog-single-fullwidth.html#">pinterest</a></li>
                                    </ul>
                                </div>
                            </div> <!-- end tag-share -->

                            <div class="author-box">
                                <div class="author-avatar">
                                    <a href="blog-single-fullwidth.html#" target="_blank"><img src="assets/images/blog-details/author.jpg" alt></a>
                                </div>
                                <div class="author-content">
                                    <a href="blog-single-fullwidth.html#" class="author-name">Author: Jenny Watson</a>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>
                                    <div class="socials">
                                        <ul class="social-link">
                                            <li><a href="blog-single-fullwidth.html#"><i class="ti-facebook"></i></a></li>
                                            <li><a href="blog-single-fullwidth.html#"><i class="ti-twitter-alt"></i></a></li>
                                            <li><a href="blog-single-fullwidth.html#"><i class="ti-linkedin"></i></a></li>
                                            <li><a href="blog-single-fullwidth.html#"><i class="ti-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> <!-- end author-box -->

                            <div class="more-posts">
                                <div class="previous-post">
                                    <a href="blog.html">
                                        <span class="post-control-link">Previous Post</span>
                                        <span class="post-name">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium.</span>
                                    </a>
                                </div>
                                <div class="next-post">
                                    <a href="blog-left-sidebar.html">
                                        <span class="post-control-link">Next Post</span>
                                        <span class="post-name">Dignissimos ducimus qui blanditiis praesentiu deleniti atque corrupti quos dolores</span>
                                    </a>
                                </div>
                            </div>

                            <div class="comments-area">
                                <div class="comments-section">
                                    <h3 class="comments-title">5 Comments</h3>
                                    <ol class="comments">
                                        <li class="comment even thread-even depth-1" id="comment-1">
                                            <div id="div-comment-1">
                                                <div class="comment-theme">
                                                    <div class="comment-image"><img src="assets/images/blog-details/comments-author/img-1.jpg" alt></div>
                                                </div>
                                                <div class="comment-main-area">
                                                    <div class="comment-wrapper">
                                                        <div class="comments-meta">
                                                            <h4>Robert Sonny <span class="comments-date">says Jul 21, 2021 at 10:00am</span></h4>
                                                        </div>
                                                        <div class="comment-area">
                                                            <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system</p>
                                                            <div class="comments-reply">
                                                                <a class="comment-reply-link" href="blog-single-fullwidth.html#"><span>Reply</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="children">
                                                <li class="comment">
                                                    <div>
                                                        <div class="comment-theme">
                                                            <div class="comment-image"><img src="assets/images/blog-details/comments-author/img-2.jpg" alt></div>
                                                        </div>
                                                        <div class="comment-main-area">
                                                            <div class="comment-wrapper">
                                                                <div class="comments-meta">
                                                                    <h4>John Abraham  <span class="comments-date">says Jul 21, 2021 at 10:00am</span></h4>
                                                                </div>
                                                                <div class="comment-area">
                                                                    <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system</p>
                                                                    <div class="comments-reply">
                                                                        <a  class="comment-reply-link" href="blog-single-fullwidth.html#"><span>Reply</span></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul>
                                                        <li class="comment">
                                                            <div>
                                                                <div class="comment-theme">
                                                                    <div class="comment-image"><img src="assets/images/blog-details/comments-author/img-3.jpg" alt></div>
                                                                </div>
                                                                <div class="comment-main-area">
                                                                    <div class="comment-wrapper">
                                                                        <div class="comments-meta">
                                                                            <h4>Robert Sonny <span class="comments-date">says Jul 21, 2021 at 10:00am</span></h4>
                                                                        </div>
                                                                        <div class="comment-area">
                                                                            <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system</p>
                                                                            <div class="comments-reply">
                                                                                <a  class="comment-reply-link" href="blog-single-fullwidth.html#"><span>Reply</span></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="comment">
                                            <div>
                                                <div class="comment-theme">
                                                    <div class="comment-image"><img src="assets/images/blog-details/comments-author/img-1.jpg" alt></div>
                                                </div>
                                                <div class="comment-main-area">
                                                    <div class="comment-wrapper">
                                                        <div class="comments-meta">
                                                            <h4>John Abraham  <span class="comments-date">says Jul 21, 2021 at 10:00am</span></h4>
                                                        </div>
                                                        <div class="comment-area">
                                                            <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system</p>
                                                            <div class="comments-reply">
                                                                <a  class="comment-reply-link" href="blog-single-fullwidth.html#"><span>Reply</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div> <!-- end comments-section -->

                                <div class="comment-respond">
                                    <h3 class="comment-reply-title">Leave a reply</h3>
                                    <form class="comment-form">
                                        <div class="form-inputs">
                                            <input placeholder="Name" type="text">
                                            <input placeholder="Email" type="email">
                                            <input placeholder="Website" type="url">
                                        </div>
                                        <div class="form-textarea">
                                            <textarea id="comment" placeholder="Write Your Comments..."></textarea>
                                        </div>
                                        <div class="form-submit">
                                            <input id="submit" value="Post Comment" type="submit">
                                        </div>
                                    </form>
                                </div>
                            </div> <!-- end comments-area -->
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end wpo-blog-single-section -->




<?php require_once 'assets/php/footer.php'; ?>