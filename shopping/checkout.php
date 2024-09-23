<?php require  "../includes/header.php"; ?>
<?php require  "../config/config.php"; ?> 
<?php 
  if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: cart.php');
    exit;
  }

  if(!isset($_SESSION['username'])) {
    header("location: ".APPURL."");
  }
?>

      <h2 class="my-5 h2 text-center">Checkout</h2>
      <div class="row d-flex justify-content-center align-items-center h-100 mt-5 mt-5">
        <div class="col-md-12 mb-4">
          <div class="card">
            <form class="card-body" method="POST" action="charge.php">
              <div class="row">
                <div class="col-md-6 mb-2">
                  <div class="md-form">
                    <label for="firstName" class="">First Name</label>
                    <input type="text" name="fname" id="firstName" class="form-control" placeholder="First Name">
                  </div>
                </div>

                <div class="col-md-6 mb-2">
                  <div class="md-form">
                    <label for="lastName" class="">Last Name</label>
                    <input type="text"  name="lname" id="lastName" class="form-control" placeholder="Last Name">
                  </div>
                </div>
              </div>

              <div class="md-form mb-5">
                <label for="email" class="">Username</label>
                <input type="text"  name="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
              </div>

              <div class="md-form mb-5">
                <label for="email" class="">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="youremail@example.com">
              </div>

              <hr class="mb-4">
              <script 
                src="https://checkout.stripe.com/checkout.js" 
                class="stripe-button" 
                data-key="pk_test_51Q1r3U04BuTMBXtcPkbnzDZ6vSGd1jEhDSOLXE9T4i9r811Q8Hg6gLTTFbcZhpTVBrIbarJO2dR2VqE44DbUnTVl00zLSbLYLS" 
                data-currency="usd" 
                data-label="PAY">
              </script>
            </form>
          </div>
        </div>
</div>
<?php require "../includes/footer.php"; ?>    