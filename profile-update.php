
<?php
require "config/database.php";
require "includes/header.php";
global $connection;

//Unauthorized Access Redirect Home Page
if (!isset($_SESSION['logged'])) {
    header("Location: " . BASE_URL, true, 301);
}

//Get Auth User Info
if (isset($_SESSION['logged'])) {
    $id = $_SESSION['auth_id'];
    $result = $connection->query("SELECT * FROM users WHERE id = '$id'");
    $user = $result->fetch(PDO::FETCH_OBJ);
}

//Update Auth User Info
if (isset($_POST['submit'])){

    $id = $_POST['auth_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $facebook_url = $_POST['facebook_url'];
    $twitter_url = $_POST['twitter_url'];
    $linkedin_url = $_POST['linkedin_url'];
    $bio = $_POST['bio'];
//  Image Upload
    $image_name = $_FILES['image']['name'];
    $extension = pathinfo($image_name, PATHINFO_EXTENSION);
    $location = "public/upload/user/".rand(11111111, 99999999).".".$extension;


//  Validation Checks
    if (empty($username)) {
        $_SESSION['error'] = "User Name is required";
    }elseif (empty($email)){
        $_SESSION['error'] = "User Email is required";
    }elseif (empty($id)) {
        $_SESSION['error'] = "User Id is required";
    }

    $update = $connection->prepare("UPDATE users SET username = :username, email = :email, title = :title, facebook_url = :facebook_url, twitter_url = :twitter_url, linkedin_url = :linkedin_url, bio = :bio, image = :image WHERE id = '$id'");
    $update->execute([
        ':username' => $username,
        ':email' => $email,
        ':title' => $title,
        ':facebook_url' => $facebook_url,
        ':twitter_url' => $twitter_url,
        ':linkedin_url' => $linkedin_url,
        ':bio' => $bio,
        ':image' => $location,
    ]);

    if ($update) {
        move_uploaded_file($_FILES['image']['tmp_name'], $location);
        $_SESSION['success'] = "Profile Updated Successfully";
    }else{
        $_SESSION['error'] = "Profile Update Failed";
    }

}


?>
<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('public/images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Profile Update</h1>
                <div class="custom-breadcrumbs">
                    <a href="<?php echo BASE_URL ?>">Home</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Profile Update</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section" id="next-section">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10 mb-5 mb-lg-0">
                <form action="profile-update.php" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="auth_id" value="<?php echo $user->id ?>">
                    <input type="hidden" name="old_image" value="<?php echo $user->image ?>">
                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-black" for="username">User Name</label>
                            <input value="<?php echo $user->username ?>" type="text" id="username" name="username" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="text-black" for="title">User Title</label>
                            <input value="<?php echo $user->title ?>" type="text" id="title" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-black" for="email">User Email</label>
                            <input value="<?php echo $user->email ?>" type="email" id="email" name="email" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-black" for="facebook_url">Facebook url</label>
                            <input value="<?php echo $user->facebook_url ?>" type="text" id="facebook_url" name="facebook_url" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-black" for="twitter_url">Twitter url</label>
                            <input value="<?php echo $user->twitter_url ?>" type="text" id="twitter_url" name="twitter_url" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="text-black" for="linkedin_url">Linkedin url</label>
                            <input value="<?php echo $user->linkedin_url ?>" type="text" id="linkedin_url" name="linkedin_url" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="text-black" for="image">Image</label>
                            <input id="input_image"  type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6 text-center">
                           <img id="input_image_preview" width="120px" src="<?php echo $user->image ?>" alt="" class="img-fluid">
                        </div>
                    </div>
                    <?php if($_SESSION['auth_type'] === 'worker'):?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="cv">CV</label>
                            <input type="file" id="cv" class="form-control">
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="bio">Bio</label>
                            <textarea name="bio" id="bio" cols="30" rows="7" class="form-control" placeholder="Write your bio...."><?php echo $user->bio ?></textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <input name="submit" type="submit" value="Update Profile" class="btn btn-primary btn-md text-white">
                        </div>
                    </div>


                </form>
            </div>
<!--            <div class="col-lg-5 ml-auto">-->
<!--                <div class="p-4 mb-3 bg-white">-->
<!--                    <p class="mb-0 font-weight-bold">Address</p>-->
<!--                    <p class="mb-4">203 Fake St. Mountain View, San Francisco, California, USA</p>-->
<!---->
<!--                    <p class="mb-0 font-weight-bold">Phone</p>-->
<!--                    <p class="mb-4"><a href="#">+1 232 3235 324</a></p>-->
<!---->
<!--                    <p class="mb-0 font-weight-bold">Email Address</p>-->
<!--                    <p class="mb-0"><a href="#">youremail@domain.com</a></p>-->
<!---->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</section>


<?php require "includes/footer.php"; ?>