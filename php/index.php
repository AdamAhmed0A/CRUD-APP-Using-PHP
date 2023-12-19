<!DOCTYPE html>
<html language = "en">
<head>
  <title>CRUD APP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</head>
<body>
  <?php
  try{
      require("./Connection.php");
      $query = "SELECT `id`,`name`, `description`, `amount`, `price` FROM `products`";
      $result = $conn -> query($query);
      $products = $result -> fetch_all(MYSQLI_ASSOC);
    }
  catch (Exception $e){
    die("Failed" ." ". $e->getMessage());
  }
  ?>
  <p class="text-center display-4 m-4">CRUD APP => PHP</p>
  <div class="container">
    <table class="table table-striped table-hover">
      <thead>
        <th>Name</th>
        <th>Description</th>
        <th>Amount</th>
        <th>Price</th>
        <th>Actions</th>
      </thead>

      <tbody>
        <?php
        foreach ($products as $product) {
          $id = $product["id"];
          echo"<tr>";
          foreach ($product as $key => $value) {
            if($key != "id"){
              echo"<td> $value </td>";
            }
          }
          echo "<td>
          <a href='update.php?id=$id'>
          <button class='btn btn-success'>Update</button>
          </a>
          <a href='delete.php?id=$id'>
          <button class='btn btn-danger'>Delete</button>
          </a>
          </td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
    <a href="./insert.php"> <button type="button" class='btn btn-primary' name="addproduct">Add Product</button></a>
  </div>

</body>
</html>
