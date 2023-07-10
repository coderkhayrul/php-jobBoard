
<?php
require "config/database.php";
require "includes/header.php";
global $connection;
if (!isset($_SESSION['logged'])) {
    header("Location: " . BASE_URL, true, 301);
}

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $result = $connection->query("SELECT * FROM users WHERE id = '$id'");
    $result->execute();
    $user = $result->fetch(PDO::FETCH_OBJ);
    if (!$user){
        header("Location: " .  NOT_FOUND_URL, true, 301);
    }
}else{
    header("Location: " .  NOT_FOUND_URL, true, 301);
}

//All Jobs Show by User
$jobs = $connection->query("SELECT * FROM jobs WHERE company_id = '$id' AND status = 1");
$jobs->execute();
$jobs = $jobs->fetchAll(PDO::FETCH_OBJ);
?>
<section class="section-hero overlay inner-page bg-image" style="background-image: url('<?php BASE_URL ?>/public/images/hero_1.jpg');" id="home-section">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-10">
        <div class="card p-3 py-4">
                <div class="text-center">
                    <img src="<?php echo $user->image ?>" width="100" class="rounded-circle">
                </div>
                <div class="text-center mt-3">
                    <?php if ($user->usertype === 'worker'): ?>
                    <a href="#" class="btn btn-sm btn-secondary text-white"> Download CV</a>
                    <?php endif; ?>
                    <h5 class="mt-2 mb-0"><?php echo $user->username ?></h5>
                    <span><?php echo $user->title ?></span>
                    <div class="px-4 mt-1">
                        <p class="fonts"><?php echo $user->bio ?></p>
                    </div>
                    <div class="px-3">
                <a target="_blank" href="<?php echo $user->facebook_url ?>" class="pt-3 pb-3 pr-3 pl-0 underline-none"><span class="icon-facebook"></span></a>
                <a target="_blank" href="<?php echo $user->twitter_url ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                <a target="_blank" href="<?php echo $user->linkedin_url ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
            </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>

<section class="site-section">
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="section-title mb-2">43,167 Job Listed</h2>
            </div>
        </div>
        <ul class="job-listings mb-5">
            <?php foreach ($jobs as $job): ?>
            <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                <a href="<?php echo BASE_URL . '/job.php?id=' . $job->id ?>"></a>
                <div class="job-listing-logo">
                    <img src="<?php echo BASE_URL .'/'. $job->company_image ?>" alt="Free Website Template by Free-Template.co" class="img-fluid">
                </div>

                <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                    <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                        <h2><?php echo $job->job_title ?></h2>
                        <strong><?php echo $job->company_name ?></strong>
                    </div>
                    <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                        <span class="icon-room"></span> <?php echo $job->job_region ?>
                    </div>
                    <div class="job-listing-meta">
                        <span class="badge badge-danger"><?php echo $job->job_type ?></span>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>



    </div>
</section>

<?php require "includes/footer.php"; ?>
