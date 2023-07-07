
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
<?php require "includes/footer.php"; ?>
