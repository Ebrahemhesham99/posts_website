<?php
require_once("./includes/db.php");
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $sql = "SELECT * from `posts` WHERE `post_id` =:post_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'post_id' => $post_id
    ]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    $post_title = $post['post_title'];
    $post_detail = $post['post_detail'];
    $post_img = $post['post_image'];
    $post_author = $post['post_author'];
    $post_publish_date = $post['post_date'];
    $post_views = $post['post_views'];
    $post_catagory = $post['post_catagory'];
    $current_page = $post_title;
} else {
    header("Location:index.php");
}
$stmt = $conn->prepare("UPDATE `posts` SET `post_views` = `post_views`+1 WHERE `post_id` = :post_id");
$stmt->execute([
    'post_id' => $post_id
]);
?>
<?php require './includes/header.php'; ?>
<div id="layoutDefault">
    <div id="layoutDefault_content">
        <main>

            <?php include_once './includes/navbar.php'; ?>

            <header class="page-header page-header-dark" style='background-image: url("./img/<?= $post_img ?>");background-size: cover;background-repeat: no-repeat;'>
                <div class="page-header-content pt-10">
                    <div class="container text-center">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <h1 class="page-header-title mb-3"><?= $post_title ?></h1>
                                <p class="page-header-text">
                                    Category: <?= $post_catagory ?>,
                                    Posted by: <?= $post_author ?>
                                </p>
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
                    <!--start post content-->
                    <div>
                        <h1><?= $post_title ?></h1>
                        <p class="lead"><?= $post_detail ?>
                    </div>
                    <!--end post content-->

                    <!--start comment section-->
                    <div class="pt-5 col-lg-8 col-xl-9">
                        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                            <h2 class="mb-0">Comments</h2>
                        </div>
                        <hr class="mb-4" />
                        <div class="card mb-5">
                            <div class="card-header d-flex justify-content-between">
                                <div class="mr-2 text-dark">
                                    John Doe
                                    <div class="text-xs text-muted">November 19, 2020 at 11:31 PM</div>
                                </div>
                                <div class="h5"><span class="badge badge-warning-soft text-warning font-weight-normal">Awaiting Response</span></div>
                            </div>
                            <div class="card-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque blanditiis, exercitationem architecto accusamus quis repellendus magni nam ipsam id qui non itaque eos, consectetur maiores aperiam sapiente. Libero, possimus minus.
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">Add Comment</div>
                            <div class="card-body">
                                <textarea placeholder="Type here..." class="form-control mb-2" rows="4"></textarea>
                                <button class="btn btn-primary btn-sm mr-2">Post Comment</button>
                            </div>
                        </div>
                    </div>
                    <!--end comment section end-->
                </div>

                <!--Rounded style-->
                <div class="svg-border-rounded text-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor">
                        <path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" />
                    </svg>
                </div>
                <!--Rounded style-->
            </section>
        </main>
    </div>

    <!--Footer start-->
    <?php include_once './includes/footer-bar.php'; ?>
    <!--Footer end-->
    <?php require_once './includes/footer.php'; ?>