<?php require  "../includes/header.php"; ?>
<?php require  "../config/config.php"; ?>  
<?php 
  // kiểm tra phiên đăng nhập
  if(!isset($_SESSION['username'])) {
    header("location: ".APPURL."");
  }

  // lấy danh sách sản phẩm trong giỏ hàng
  $products = $conn->query("SELECT * FROM cart WHERE user_id = '$_SESSION[user_id]'");
  $products->execute();

  $allProducts = $products->fetchAll(PDO::FETCH_OBJ);

  //  xử lý khi người dùng nhấn nút thanh toán
  if(isset($_POST['submit'])) {
    $price = $_POST['price'];

    $_SESSION['price'] = $price;

    header("location: checkout.php");
  }
?>

    <div class="row d-flex justify-content-center align-items-center h-100 mt-5 mt-5">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                  </div>

                  <table class="table" height="190" >
                    <thead>
                      <tr>
                        <th scope="col" style="vertical-align: middle">Image</th>
                        <th scope="col" style="vertical-align: middle">Name</th>
                        <th scope="col" style="vertical-align: middle">Price</th>
                        <th scope="col" style="vertical-align: middle">Quantity</th>
                        <th scope="col" style="vertical-align: middle">Discount</th>
                        <th scope="col" style="vertical-align: middle">Total Price</th>
                        <th scope="col" style="vertical-align: middle">Update</th>
                        <th scope="col"><button class="delete-all btn btn-danger text-white">Clear</button></th>
                      </tr>
                    </thead>

                    <!-- Hiển thị danh sách sản phẩm -->
                    <tbody>
                      <?php if(count($allProducts) > 0) : ?>
                        <?php foreach($allProducts as $product) : ?>
                          <tr class="mb-4">
                            <td>
                              <img width="100" height="100" src="<?php echo IMGURL; ?>/<?php echo $product->pro_image; ?>" class="img-fluid rounded-3" alt="Cotton T-shirt">
                            </td>

                            <td><?php echo $product->pro_name; ?></td>
                            
                            <td class="pro_price"><?php echo $product->pro_price; ?></td>
                            
                            <td>
                              <input id="form1" min="1" max="100" name="quantity" value="<?php echo $product->pro_amount; ?>" type="number" class="form-control form-control-sm pro_amount" />
                            </td>
                            
                            <td class="pro_discount"><?php echo $product->pro_discount; ?></td>

                            <td class="total_price"><?php echo $product->pro_price * $product->pro_amount * ((100 - $product->pro_discount) / 100); ?></td>

                            <td>
                              <button value="<?php echo $product->id; ?>" class="btn-update btn btn-warning text-white"><i class="fas fa-pen"></i></button>
                            </td>

                            <td>
                              <button value="<?php echo $product->id; ?>" class="btn btn-danger text-white btn-delete"><i class="fas fa-trash-alt"></i></button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <div class="alert alert-danger bg-danger text-white">
                          There is no products in cart
                        </div>
                      <?php endif; ?>  
                    </tbody>
                  </table>
                  <a href="<?php echo APPURL; ?>" class="btn btn-success text-white"><i class="fas fa-arrow-left"></i>  Continue Shopping</a>
                </div>
              </div>

              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h1 class="fw-bold mb-5 mt-2 pt-1">Summary</h1>
                  <hr class="my-4">

                  <form method="POST" action="cart.php">      
                    <div class="d-flex justify-content-between mb-5">
                      <h5 class="text-uppercase">Total price</h5>
                      <h5 class="full_price"></h5>
                      <input class="inp_price" name="price" type="hidden">
                    </div>

                    <button type="submit" name="submit" class="checkout btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Checkout</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
       
      </div>

    </div>
 <?php require  "../includes/footer.php"; ?>

 
  <script>
    $(document).ready(function(){
      $(".pro_amount").mouseup(function () {
        var $el = $(this).closest('tr');

        var pro_amount = $el.find(".pro_amount").val();
        var pro_price = $el.find(".pro_price").html();
        var pro_discount = $el.find(".pro_discount").html();

        var total = pro_amount * pro_price * ((100 - pro_discount) / 100);      

        $el.find(".total_price").html(total.toFixed(2) + '$');

        $(".btn-update").on('click', function(e) {
          var id = $(this).val();
          $.ajax({
            type: "POST",
            url: "update-item.php",
            data: {
              update: "update",
              id: id,
              pro_amount: pro_amount
            },

            success: function() {
              // alert("done");
              // reload();
            }
          })
        });      

        fetch();     
      });

      $(".btn-delete").on('click', function(e) {
        var id = $(this).val();

        $.ajax({
          type: "POST",
          url: "delete-item.php",
          data: {
            delete: "delete",
            id: id
          },

          success: function() {
            alert("Product deleted successfully");
            reload();
          }
          })
      });

      $(".delete-all").on('click', function(e) {
        $.ajax({
          type: "POST",
          url: "delete-all-item.php",
          data: {
            delete: "delete",
          },

          success: function() {
            alert("All products deleted successfully");
            reload();
          }
        })
      });

      fetch();

      function fetch() {
        setInterval(function () {
          var sum = 0.0;
          $('.total_price').each(function() {
            sum += parseFloat($(this).text());
          });

          $(".full_price").html(sum+"$");
          $(".inp_price").val(sum);

          if($(".inp_price").val() > 0) {
            $(".checkout").show();
          } else {
            $(".checkout").hide();
          }
        }, 0);  // cập nhật price ngay lập tức
      }

      function reload() {
            $("body").load("cart.php")
      }
    });
 </script>
