<?php
require "config/database.php";
require "includes/header.php";
global $connection;
if (isset($_SESSION['logged'])) {
    header("Location: " . BASE_URL, true, 301);
}

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $message = "<div class='alert alert-danger bg-danger text-white'>Input fields are empty</div>";
    }else{
        $email = $_POST['email'];
        $password = $_POST['password'];
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $statement = $connection->prepare($sql);
            $statement->execute([
                ':email' => $email
            ]);
            $user = $statement->fetch(PDO::FETCH_OBJ);
            if ($user) {
                if (password_verify($password, $user->password)) {
                    $_SESSION["logged"] = true;
                    $_SESSION['auth_id'] = $user->id;
                    $_SESSION['auth_name'] = $user->username;
                    $_SESSION['auth_email'] = $user->email;
                    $_SESSION['auth_type'] = $user->usertype;
                    $_SESSION['auth_image'] = $user->image;
                    $_SESSION['auth_created_at'] = $user->created_at;
                    header("Location: " . BASE_URL, true, 301);
                }else{
                    $message = "<div class='alert alert-danger bg-danger text-white'>Wrong Password</div>";
                }
            }else{
                $message = "<div class='alert alert-danger bg-danger text-white'>User not found</div>";
            }
        }catch (PDOException $e) {
            $message = $e->getMessage();
        }
    }

}
?>

<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('<?php BASE_URL ?>/public/images/hero_1.jpg');" id="home-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 class="text-white font-weight-bold">Log In</h1>
        <div class="custom-breadcrumbs">
          <a href="<?php echo BASE_URL ?>">Home</a> <span class="mx-2 slash">/</span>
          <span class="text-white"><strong>Log In</strong></span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <?php
          if (isset($message)) { echo $message; }

          if(isset($_SESSION['reg_message'] ))
            echo $_SESSION['reg_message'];
            unset($_SESSION['reg_message']) ;
          ?>
        <form action="login.php" method="POST" class="p-4 border rounded">
          <div class="row form-group">
            <div class="col-md-12 mb-3 mb-md-0">
              <label class="text-black" for="email">Email</label>
              <input type="text" name="email" id="email" class="form-control" placeholder="Email address">
            </div>
          </div>
          <div class="row form-group mb-4">
            <div class="col-md-12 mb-3 mb-md-0">
              <label class="text-black" for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Log In" class="btn px-4 btn-primary text-white">
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>

<?php require "includes/footer.php"; ?>