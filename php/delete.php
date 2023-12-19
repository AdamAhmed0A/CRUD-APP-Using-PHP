<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</head>
<body>
    <?php
    try {
        require("Connection.php");

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
                $query = "DELETE FROM `products` WHERE id=$id";
                $conn->query($query);
                ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted',
                        text: 'Item has been successfully deleted'
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                </script>
                <?php
            } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel_delete'])) {
                ?>
                <script>
                    Swal.fire({
                        icon: 'info',
                        title: 'Cancelled',
                        text: 'Deletion operation cancelled'
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                </script>
                <?php
            } else {
                ?>
                <form method="post">
                    <input type="submit" name="confirm_delete" value="Confirm Delete" style="display:none;">
                    <input type="submit" name="cancel_delete" value="Cancel" style="display:none;">
                </form>
                <script>
                    const confirmDelete = confirm('Are you sure you want to delete this item?');
                    if (confirmDelete) {
                        document.forms[0].elements['confirm_delete'].click();
                    } else {
                        document.forms[0].elements['cancel_delete'].click();
                    }
                </script>
                <?php
            }
        } else {
            echo 'Invalid request';
        }
    } catch (Exception $e) {
        die("Failed: " . $e->getMessage());
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
