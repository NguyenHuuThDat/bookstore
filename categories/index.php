<?php require  "../includes/header.php"; ?>
<?php require  "../config/config.php"; ?> 
<?php 
    $select = $conn->query("SELECT * FROM categories");
    $select->execute();

    $categories = $select->fetchAll(PDO::FETCH_OBJ);
?>

        <div class="row mt-5">
            <?php foreach($categories as $category) : ?>
                <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1" style="min-height: 439px">
                    <div class="card">
                        <img height="213px" class="card-img-top" src="http://localhost/bookstore/admin-panel/categories-admins/images/<?php echo $category->image; ?>">
                        <div class="card-body" style="min-height:200px">
                            <h5 class="d-inline">
                                <b>
                                    <?php echo $category->name; ?>
                                </b> 
                            </h5>
                            
                            <p style="min-height: 72px">
                                <?php 
                                    $description = $category->description;
                                    $length = 120;
                                    
                                    if (strlen($description) > $length) {
                                      $description = preg_replace('/\s+(?=[^"]*"$)/', '...', $description, 1);
                                      $description = substr($description, 0, $length) . '...';
                                    }
                                    
                                    echo $description;
                                ?>
                            </p>
                            <a href="<?php echo APPURL; ?>/categories/single-category.php?id=<?php echo $category->id; ?>" class="btn btn-primary w-100 rounded my-2">Discover Products</a>
                        </div>
                    </div>
                </div>
                <br>
            <?php endforeach; ?>
        </div>

<?php require  "../includes/footer.php"; ?>