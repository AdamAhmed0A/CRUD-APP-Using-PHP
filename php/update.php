<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    $id = $_GET["id"];
      require("Connection.php");
        // showing the old value
    $fetchdata = "SELECT * FROM `products` WHERE id=$id";
    $result = $conn->query($fetchdata);
    if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $desc = $row["description"];
    $amount = $row["amount"];
    $price = $row["price"];
    }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST["name"];
      $desc = $_POST["description"];
      $amount = $_POST["amount"];
      $price = $_POST["price"];

      // Checking if the fillds are empty or not
      if (empty($name) || empty($desc) || empty($amount) || empty($price)) {
          ?>
          <script>
              Swal.fire({
                  icon: 'error',
                  title: 'Invalid',
                  text: 'Input Fields Can\'t Be Empty'
              })
          </script>
          <?php
      } else {
          try {
              // updating the VALUES
              $query = "UPDATE `products` SET `name`='$name',`description`='$desc',`amount`='$amount',`price`='$price' WHERE id=$id";
              $conn->query($query);
              ?>
              <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Product updated successfully'
                    }).then(() => {
                        window.location.href = 'index.php'; // directing to the index.php
                    });
                </script>
           <?php
         }

          catch (Exception $e) {
              die("Failed to update the data" . " " . $e->getMessage());
          }
      }
  }
  ?>

    <p class="text-center display-5 m-3">Insert Product</p>
    <div class="container w-50">
      <form class=" form" method="post">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $name ;?>">

        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" value="<?php echo $desc ;?>">

        <label for="amount" class="form-label">Amount</label>
        <input type="text" class="form-control" name="amount" value="<?php echo $amount ;?>">

        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" name="price" value="<?php echo $price ;?>">

        <input type="submit" class="btn btn-primary mt-3" name="submit" value="Submit">
      </form>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>
