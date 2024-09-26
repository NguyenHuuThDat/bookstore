<?php require  "includes/header.php"; ?>
<?php require  "config/config.php"; ?> 

<?php
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: index.php');
        exit;
    }

    $select = $conn->query("SELECT * FROM cart WHERE user_id='$_SESSION[user_id]'");
    $select->execute();
    $allProdcuts = $select->fetchAll(PDO::FETCH_OBJ);

    // Download trực tiếp về máy
    $zipname = 'bookstore.zip';
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
    foreach ($allProdcuts as $product) {
        $zip->addFile("admin-panel/products-admins/books/" . $product->pro_file, basename($product->pro_file));
    }
    $zip->close();

    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename='.$zipname);
    readfile($zipname);

    // Download thông qua email
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'src/Exception.php';
    require 'src/PHPMailer.php';
    require 'src/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;               //Enable verbose debug output
        $mail->isSMTP();                                        //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                               //Enable SMTP authentication
        $mail->Username   = '';                                 //SMTP username
        $mail->Password   = '';                                 //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;     //Enable implicit TLS encryption
        $mail->Port       = 587;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Sender
        $mail->setFrom('', 'Bookstore');
        
        //Add a recipient
        $mail->addAddress($_SESSIONN['email'], 'user');    

        foreach($allProdcuts as $products) {
            $path  = 'admin-panel/products-admins/books';
            //$file = $products->pro_file;

            for($i=0; $i < count($allProdcuts); $i++) {
                $mail->addAttachment($path . "/" . $products->pro_file);        //Add attachment
            }
        }

        //Content
        $mail->isHTML(true);                                                    //Set email format to HTML
        $mail->Subject = 'The books you bought';
        $mail->Body    = 'Here are you books you paid '.$_SESSION['price'].' <b>thanks for buying from Bookstore</b>';
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        $mail->send();

        //Delete cart items after sending products
        $select = $conn->query("DELETE FROM cart WHERE user_id='$_SESSION[user_id]'");
        $select->execute();

        header("location: success.php");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }