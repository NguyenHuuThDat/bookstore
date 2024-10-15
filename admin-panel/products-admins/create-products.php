<?php require "../layouts/header.php"; ?>  
<?php require "../../config/config.php"; ?> 
<?php 
  $select = $conn->query("SELECT * FROM categories");
  $select->execute();

  $categories = $select->fetchAll(PDO::FETCH_OBJ);

  if(isset($_POST['submit'])) {
    if(empty($_POST['name']) OR empty($_POST['description']) OR empty($_POST['price'])) {
      echo "<script>alert('One or more inputs are empty');</script>";
    } else {
      $id = $_POST['id'];
      $name = $_POST['name'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $discount = $_POST['discount'];
      
      $image = $_FILES['image']['name'];
      $file = $_FILES['file']['name'];
      $category_id = $_POST['category_id'];

      $dir_image = "images/" . basename($image);
      $dir_file = "books/" . basename($file);

      $insert = $conn->prepare("INSERT INTO products (id, name, price, discount, description, image, file, category_id) VALUES 
      (:id, :name, :price, :discount, :description, :image, :file, :category_id)");
      $insert->execute([
        ":id" => $id,
        ":name" => $name,
        ":price" => $price,
        ":discount" => $discount,
        ":description" => $description,
        ":image" => $image,
        ":file" => $file,
        ":category_id" => $category_id,
      ]);

      // if(move_uploaded_file($_FILES['image']['tmp_name'],  $dir_image) AND move_uploaded_file($_FILES['file']['tmp_name'],  $dir_file)) {
      //   header("location: ".ADMINURL."/products-admins/show-products.php");
      // }

      // Kiểm tra trạng thái sau insert
      if($insert->rowCount() > 0) {
        if(move_uploaded_file($_FILES['image']['tmp_name'],  $dir_image) AND move_uploaded_file($_FILES['file']['tmp_name'],  $dir_file)) {
          echo "<script>alert('Product created successfully');</script>";
          header("refresh: 1; url=".ADMINURL."/products-admins/show-products.php"); // Chuyển hướng sau 1 giây
        } else {
          echo "<script>alert('Error uploading file');</script>";
        }
      } else {
        echo "<script>alert('Error creating product');</script>";
      }
    }
  }
?>

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Products</h5>
              <form method="POST" action="create-products.php" enctype="multipart/form-data">
                <div class="form-outline mb-4 mt-4">
                  <label>ID</label>
                  <input type="text" name="id" id="form2Example1" class="form-control" placeholder="ID" />
                </div> 
                
                <div class="form-outline mb-4 mt-4">
                  <label>Name</label>
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="Name" />
                </div>

                <div class="form-outline mb-4 mt-4">
                    <label>Price</label>
                    <input type="text" name="price" id="form2Example1" class="form-control" placeholder="Price" />
                </div>

                <div class="form-outline mb-4 mt-4">
                    <label>Discount</label>
                    <input type="text" name="discount" id="form2Example1" class="form-control" placeholder="Discount" />
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea name="description" placeholder="Description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Category</label>
                    <select name="category_id" class="form-control" id="exampleFormControlSelect1">
                      <option>Select Category</option>
                      <?php foreach($categories as $category) : ?>
                        <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-outline mb-4 mt-4">
                    <label>Image</label>
                    <input type="file" name="image" id="form2Example1" class="form-control" placeholder="Image" />
                </div>

                <div class="form-outline mb-4 mt-4">
                    <label>File</label>
                    <input type="file" name="file" id="form2Example1" class="form-control" placeholder="File" />
                </div>

                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php"; ?>  
