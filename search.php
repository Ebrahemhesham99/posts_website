<?php 
            require_once("./includes/db.php");

            if (isset($_POST["search-keyword"])){
                $key_word = strtolower($_POST["search-keyword"]);
                $search_sql = "SELECT * FROM `posts` WHERE `post_status` =:status AND `post_title` OR `post_detail` LIKE :keyword";
                $stmt = $conn->prepare($search_sql);
                $stmt->execute([
                    ':status'=>'published',
                    ':keyword'=>'%' . trim($key_word) .'%'
                ]);
                $founded_postes = 0;
                $count = $stmt->rowCount();
                if ($count ==0)
                {
                    $current_page = "Not Found";
                    $founded_postes = 0;
                }
                else{
                    $current_page = $key_word;
                    $founded_postes = $count;
                }
            }
            ?>
<?php require_once './includes/header.php'; ?>

<div id="layoutDefault">
    <div id="layoutDefault_content">
        <main>

            <?php include_once './includes/navbar.php'; ?>
        
            <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                <div class="page-header-content pt-10">
                    <div class="container text-center">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <h1 class="page-header-title mb-3">Search result for <?=$key_word?></h1>
                                <p class="page-header-text">Total_posts found: <?=$founded_postes?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="svg-border-rounded text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
                        <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" />
                    </svg>
                </div>
            </header>
            <section class="bg-white py-10">
                <div class="container">

                    <h1>Search Result:</h1>
                    <hr />
                    <div class="row">
                     <?php 
                $sql2 = "SELECT * FROM `posts` WHERE `post_status` =:status AND `post_title` OR `post_detail` LIKE :keyword ORDER BY `post_id` LIMIT 0,6";
                $stmt = $conn->prepare($sql2);
                $stmt->execute([
                    ':status'=>'published',
                    ':keyword'=>'%' . trim($key_word) .'%'
                ]);
                $count = $stmt->rowCount();
                if($count==0){
                    echo "No posts Found! Try Again ";
                }
                else{
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
                        } 
                        }?>

                    </div>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-blog justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#!" aria-label="Previous"><span aria-hidden="true">&#xAB;</span></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                            <li class="page-item"><a class="page-link" href="#!">12</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#!" aria-label="Next"><span aria-hidden="true">&#xBB;</span></a>
                            </li>
                        </ul>
                    </nav>

                </div>

                <div class="svg-border-rounded text-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
                        <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" />
                    </svg>
                </div>
            </section>
        </main>
    </div>
    <!--Footer start-->
    <?php include_once './includes/footer-bar.php'; ?>
    <!--Footer end-->
</div>
<?php require_once './includes/footer.php'; ?>