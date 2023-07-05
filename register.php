<?php
require "config/database.php";
require "includes/header.php";

global $connection;
if (isset($_SESSION['auth_id'])) {
    header("Location: " . BASE_URL, true, 301);
}

if (isset($_POST['submit'])) {
    if (empty($_POST['userName']) || empty($_POST['userEmail']) || empty($_POST['password']) || empty($_POST['repeatPassword'])) {
        $message = "<div class='alert alert-danger bg-danger text-white'>Input fields are empty</div>";
    }else if ($_POST['password'] !== $_POST['repeatPassword']) {
        $message = "<div class='alert alert-danger bg-danger text-white'>Passwords do not match</div>";
    }else if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
        $message = "<div class='alert alert-danger bg-danger text-white'>Invalid email address</div>";
    }else if (strlen($_POST['password']) < 6) {
        $message = "<div class='alert alert-danger bg-danger text-white'>Password must be at least 6 characters</div>";
    }else{
        $userName = $_POST['userName'];
        $userEmail = $_POST['userEmail'];
        $userType = $_POST['userType'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];
        $image = 'default.png';
        $created_at = date('Y-m-d H:i:s');
        try {
            $sql = "INSERT INTO users (username, email, usertype, password, image, created_at) VALUES (:userName, :userEmail, :userType, :password, :image, :created_at)";
            $statement = $connection->prepare($sql);
            $statement->execute([
                ':userName' => $userName,
                ':userEmail' => $userEmail,
                ':userType' => $userType,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':image' => $image,
                ':created_at' =>$created_at
            ]);
            $_SESSION['reg_message'] = "<div class='alert alert-success bg-success text-white'>User Registration Successfully</div>";
            header("Location: " . LOGIN_URL, true, 301);
        }catch (PDOException $e) {
            $message = $e->getMessage();
        }
    }
}
?>
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image" style="background-image: url('public/images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold">Register</h1>
            <div class="custom-breadcrumbs">
              <a href="<?php echo BASE_URL ?>">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong>Register</strong></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-5">
            <?php if (isset($message)) { echo $message; } ?>
            <form action="register.php" method="POST" class="p-4 border rounded">
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="userName">Username</label>
                  <input name="userName" type="text" id="userName" class="form-control" placeholder="Username">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="userEmail">Email</label>
                  <input name="userEmail" type="text" id="userEmail" class="form-control" placeholder="Email address">
                </div>
              </div>
                <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                    <label class="text-black" for="userType">User Type</label>
                    <select name="userType" class="form-control">
                        <option selected disabled>User Type</option>
                        <option value="worker">Worker</option>
                        <option value="company">Company</option>
                    </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="password">Password</label>
                  <input name="password" type="password" id="password" class="form-control" placeholder="Password">
                </div>
              </div>
              <div class="row form-group mb-4">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="text-black" for="repeatPassword">Re-Type Password</label>
                  <input name="repeatPassword" type="password" id="repeatPassword" class="form-control" placeholder="Re-type Password">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                    <input type="submit" name="submit" class="btn px-4 btn-primary text-white" value="Sign Up">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

<?php require "includes/footer.php"; ?>