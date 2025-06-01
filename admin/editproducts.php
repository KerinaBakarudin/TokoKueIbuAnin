<?php
include '../connect/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM products WHERE id=$id");
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Product not found!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/97216fb713.js" crossorigin="anonymous"></script>
    <title>Edit Product</title>
    <style>
        * {
            font-family: 'Lucida Sans';
        }

    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        background-color: #f7d9e3;
    }

    .container {
        max-width: 600px; 
        margin: auto; 
        margin-top: auto; 
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: white;
    }

    h2 {
        text-align: center;
        color: #e83e8c;
    }

    label {
        margin-bottom: 5px;
        display: block;
        color: #e83e8c;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #e83e8c;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        background-color: #e83e8c;
        color: white;
        padding: 5px 20px;
        margin-top: 7px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: #d8357e;
    }

    input[type="file"]::file-selector-button {
        background-color: #e83e8c;
    }
    </style>
</head>
<body>
    <div class="container">
    <h2>Edit Produk</h2>
        <form action="updateproducts.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                <label for="flowerName">Flower Name</label>
                <input type="text" class="form-control" id="flowerName" name="flowerName" value="<?php echo $product['flowerName']; ?>" required>
  
                <label for="flowerPrice">Flower Price</label>
                <input type="number" class="form-control" id="flowerPrice" name="flowerPrice" value="<?php echo $product['flowerPrice']; ?>" required>

                <label for="flowerImage">Flower Image</label>
                <input type="file" class="form-control" id="flowerImage" name="flowerImage">
                <img src="flower/<?php echo $product['flowerImage']; ?>" alt="<?php echo $product['flowerName']; ?>" style="width: 150px; margin-top: 10px;">

                <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>
