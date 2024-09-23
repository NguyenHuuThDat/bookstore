<?php require "includes/header.php"; ?>
<?php 
    if(!isset($_SERVER['HTTP_REFERER'])){
        // Chuyển hướng về trang chủ
        header('location: index.php');
        exit;
    }
?>

<?php header("refresh:5; url=index.php"); ?>
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="text-center">
                <h1 class="display-1 fw-bold">Payment Success</h1>
                <p class="lead">
                    Your payment has been a success. Go ahead and check your gmail account for the books. You will be redirected to home page shortly.
                </p>
                <a href="index.php" class="btn btn-primary">Go Home</a>
            </div>
        </div>
<?php require "includes/footer.php"; ?>