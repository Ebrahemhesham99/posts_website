<?php $current_page = "Home"?>
<?php require_once './includes/header.php';?>

<div id="layoutDefault">
    <div id="layoutDefault_content">
        <main>
            <?php include_once './includes/navbar.php'; ?>
            <header class="page-header page-header-dark bg-secondary">
                <div class="page-header-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-8 col-lg-10 text-center">

                                <h1 class="page-header-title">Welcome to Technobra</h1>
                                <p class="page-header-text mb-5">Are you searching for some content that you haven't found yet? Try searching in the search box below!</p>
                                <form class="page-header-signup mb-2 mb-md-0" method="post" action="search.php">
                                    <div class="form-row justify-content-center">
                                        <div class="col-lg-6 col-md-8">
                                            <div class="form-group mr-0 mr-lg-2">
                                                <input class="form-control form-control-solid rounded-pill" name="search-keyword" type="text" placeholder="Search keyword..." /></div>
                                        </div>
                                        <div class="col-lg-3 col-md-4"><button class="btn btn-teal btn-block btn-marketing rounded-pill" type="submit">Search</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="svg-border-waves text-white">
                    <svg class="wave" style="pointer-events: none" fill="currentColor" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 75">
                        <defs>
                            <style>
                                .a {
                                    fill: none;
                                }

                                .b {
                                    clip-path: url(#a);
                                }

                                .d {
                                    opacity: 0.5;
                                    isolation: isolate;
                                }
                            </style>
                            <clipPath id="a">
                                <rect class="a" width="1920" height="75" />
                            </clipPath>
                        </defs>
                        <title>wave</title>
                        <g class="b">
                            <path class="c" d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48" />
                        </g>
                        <g class="b">
                            <path class="d" d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10" />
                        </g>
                        <g class="b">
                            <path class="d" d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24" />
                        </g>
                        <g class="b">
                            <path class="d" d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150" />
                        </g>
                    </svg>
                </div>
            </header>
            <section class="bg-white py-10">
                <!--Start-->
                <div class="container">
                    <h1>Most popular post:</h1>
                    <hr />
                    <?php
                    $sql1 = "SELECT * FROM `posts` ORDER BY `post_views` DESC LIMIT 0,1";
                    $stmt = $conn->prepare("$sql1");
                    $stmt->execute();
                    $posts = $stmt->fetch(PDO::FETCH_ASSOC);

                    $post_id = $posts['post_id'];
                    $posts_title = $posts['post_title'];
                    $posts_detail = substr($posts['post_detail'], 0, 300);
                    $posts_img = $posts['post_image'];
                    $posts_author = $posts['post_author'];
                    $posts_publish_date = $posts['post_date'];
                    $posts_views = $posts['post_views'];
                    ?>
                    <a class="card post-preview post-preview-featured lift mb-5" href="single.php?post_id=<?= $post_id ?>">
                        <div class="row no-gutters">
                            <div class="col-lg-5">
                                <div class="post-preview-featured-img" style='background-image: url("./img/<?= $posts_img ?>")'></div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-body">
                                    <div class="py-5">
                                        <h5 class="card-title"><?= $posts_title ?></h5>
                                        <p class="card-text">
                                            <?= $posts_detail ?>
                                        </p>
                                    </div>
                                    <hr />
                                    <div class="post-preview-meta">
                                        <img class="post-preview-meta-img" src="./img/<?= $posts_img ?>" />
                                        <div class="post-preview-meta-details">
                                            <div class="post-preview-meta-details-name"><?= $posts_author ?></div>
                                            <div class="post-preview-meta-details-date"><?= $posts_publish_date ?> , viewed by <?= $posts_views ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <h1>Recent posting:</h1>
                    <hr />
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM `posts` WHERE `post_status` = :status ORDER BY `post_id` Desc LIMIT 0,6";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([
                            ':status' => 'published'
                        ]);
                        while ($posts = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $post_id = $posts['post_id'];
                            $posts_title = $posts['post_title'];
                            $posts_detail = substr($posts['post_detail'], 0, 140);
                            $posts_img = $posts['post_image'];
                            $posts_author = $posts['post_author'];
                            $posts_publish_date = $posts['post_date'];
                            $posts_views = $posts['post_views'];
                        ?>
                            <div class="col-md-6 col-xl-4 mb-5">
                                <a class="card post-preview lift h-100" href="single.php?post_id=<?= $post_id ?>">
                                    <img class="card-img-top" src="./img/<?= $posts_img ?>" alt=<?= $posts_img ?> />
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $posts_title ?></h5>
                                        <p class="card-text">
                                            <?= $posts_detail ?>
                                        </p>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="post-preview-meta">
                                            <img class="post-preview-meta-img" src="./img/<?= $posts_img ?>" alt=<?= $posts_img ?> />
                                            <div class="post-preview-meta-details">
                                                <div class="post-preview-meta-details-name"><?= $posts_author ?></div>
                                                <div class="post-preview-meta-details-date"><?= $posts_publish_date ?></div>
                                            </div>
                                        </div>
                                        <div class="post-preview-meta"><?= $posts_views ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php 
                        } ?>

                    </div>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-blog justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#!" aria-label="Previous"><span aria-hidden="true">&#xAB;</span></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item"><a class="page-link" href="#!">12</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#!" aria-label="Next"><span aria-hidden="true">&#xBB;</span></a>
                            </li>
                        </ul>
                    </nav>

                    <h1 class="pt-5">Most viewed posts:</h1>
                    <hr />
                    <div class="row">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM `posts` ORDER BY `post_views` DESC LIMIT 0,3");
                        $stmt->execute();
                        while ($posts = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $post_id = $posts['post_id'];
                            $posts_title = $posts['post_title'];
                            $posts_detail = substr($posts['post_detail'], 0, 140);
                            $posts_img = $posts['post_image'];
                            $posts_author = $posts['post_author'];
                            $posts_publish_date = $posts['post_date'];
                            $posts_views = $posts['post_views'];
                        ?>
                            <div class="col-md-6 col-xl-4 mb-5">
                                <a class="card post-preview lift h-100" href="single.php?post_id=<?= $post_id ?>">
                                    <img class="card-img-top" src="./img/<?= $posts_img ?>" alt=<?= $posts_img ?> />
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $posts_title ?></h5>
                                        <p class="card-text">
                                            <?= $posts_detail ?>
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="post-preview-meta">
                                            <img class="post-preview-meta-img" src="./img/<?= $posts_img ?>" alt=<?= $posts_img ?> />
                                            <div class="post-preview-meta-details">
                                                <div class="post-preview-meta-details-name"><?= $posts_author ?></div>
                                                <div class="post-preview-meta-details-date">Feb 4 &#xB7; 5 min read</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>

                    <h1 class="pt-5">Browse by categories:</h1>
                    <hr />
                    <div class="row features text-center mb-5">
                        <?php
                        $sql1 = "SELECT * FROM `catagories` WHERE `catagory_status` = :status";
                        $stmt = $conn->prepare($sql1);
                        $stmt->execute([
                            ':status' => 'published'
                        ]);
                        while ($catagories = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $catagory_title = $catagories['catagory_title'];
                            $total_posts = $catagories['catagory_total_posts']; ?>
                            <div class="col-lg-4 col-md-6 mb-5">
                                <a class="card card-link border-top border-top-lg border-primary h-100 lift" href="#!">
                                    <div class="card-body p-5">
                                        <div class="icon-stack icon-stack-lg bg-primary-soft text-primary mb-4"><i data-feather="user"></i></div>
                                        <h6><?= $catagory_title ?></h6>
                                    </div>
                                    <div class="card-footer bg-transparent pt-0 pb-5">
                                        <div class="badge badge-pill badge-light font-weight-normal px-3 py-2"><?= $total_posts ?> Posts</div>
                                    </div>
                                </a>
                            </div>
                        <?php 
                        } ?>
                    </div>
                </div>
                <!--End-->
                <!--Waves-->
                <div class="svg-border-waves text-dark">
                    <svg class="wave" style="pointer-events: none" fill="currentColor" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 75">
                        <defs>
                            <style>
                                .a {
                                    fill: none;
                                }

                                .b {
                                    clip-path: url(#a);
                                }

                                .d {
                                    opacity: 0.5;
                                    isolation: isolate;
                                }
                            </style>
                            <clipPath id="a">
                                <rect class="a" width="1920" height="75" />
                            </clipPath>
                        </defs>
                        <title>wave</title>
                        <g class="b">
                            <path class="c" d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48" />
                        </g>
                        <g class="b">
                            <path class="d" d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10" />
                        </g>
                        <g class="b">
                            <path class="d" d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24" />
                        </g>
                        <g class="b">
                            <path class="d" d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150" />
                        </g>
                    </svg>
                </div>
                <!--End Waves-->

        </main>
    </div>
    <!--Footer start-->
    <?php include_once './includes/footer-bar.php'; ?>
    <!--Footer end-->
</div>
<?php require_once './includes/footer.php'; ?>