<?php
session_start();
require_once "includes/db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION["user_id"];

$products = [
  ["id" => 1, "name" => "Classic Org Shirt", "price" => 350, "image" => "images/shirt1.jpg"],
  ["id" => 2, "name" => "Premium Polo Shirt", "price" => 400, "image" => "images/shirt2.jpg"],
  ["id" => 3, "name" => "Limited Edition Hoodie", "price" => 380, "image" => "images/shirt3.jpg"]
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_to_cart'])) {
  $product_id = $_POST['product_id'];
  $quantity = max(1, intval($_POST['quantity']));
  $size = $_POST['size'];

  $_SESSION['cart'][] = ["product_id" => $product_id, "quantity" => $quantity, "size" => $size];
  header("Location: merchandise.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['checkout'])) {
  $gcash_name = $_POST['gcash_name'];
  $gcash_ref = $_POST['gcash_ref'];
  $cart_items = $_SESSION['cart'] ?? [];

  foreach ($cart_items as $item) {
    $product = $products[$item['product_id'] - 1];
    $stmt = $conn->prepare("INSERT INTO merchandise_orders (user_id, product_name, size, quantity, price, gcash_name, gcash_ref) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $total_price = $product['price'] * $item['quantity'];
    $stmt->bind_param("isssiss", $user_id, $product['name'], $item['size'], $item['quantity'], $total_price, $gcash_name, $gcash_ref);
    $stmt->execute();
  }

  unset($_SESSION['cart']);
  header("Location: merchandise.php?success=1");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Merchandise Store</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    .product-card {
      display: inline-block;
      width: 300px;
      background: #fff;
      margin: 1rem;
      padding: 1rem;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      vertical-align: top;
    }
    .product-card img {
      width: 100%;
      border-radius: 10px;
    }
    .cart {
      background: #f9f9f9;
      padding: 1rem;
      margin: 2rem;
      border-radius: 10px;
    }
    input, select, button {
      padding: 0.5rem;
      margin: 0.5rem 0;
      width: 100%;
    }
  </style>
</head>
<!-- 🔵 Header -->
<header class="site-header" style="background: linear-gradient(90deg, #1e3c72, #2a5298); padding: 1rem 2rem;">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <img src="images/logo.png" alt="Logo" style="height: 50px;">
    <nav>
      <a href="home.php">HOME</a>
      <a href="account.php">ACCOUNT</a>
      <a href="logout.php">LOGOUT</a>
    </nav>
  </div>
</header>

<div id="notification-panel" class="notification-panel" style="...">
  <div style="..."><strong>🔔 Notifications</strong></div>
  <div id="notif-body" style="max-height: 300px; overflow-y: auto; padding: 1rem;">
    <p>Loading notifications...</p>
  </div>
</div>
</header>
</head>
<body>
  <h1 style="text-align:center;">🛍️ Kasandigan Merchandise</h1>
  <div style="text-align:center;">
    <?php foreach ($products as $product): ?>
      <div class="product-card">
        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <h3><?= $product['name'] ?></h3>
        <p>Price: ₱<?= $product['price'] ?></p>
        <form method="POST">
          <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
          <label>Size:</label>
          <select name="size" required>
            <option value="">Select size</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
          </select>
          <label>Quantity:</label>
          <input type="number" name="quantity" value="1" min="1" required>
          <button name="add_to_cart">Add to Cart</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="cart">
    <h2>Your Cart</h2>
    <?php if (!empty($_SESSION['cart'])): ?>
      <form method="POST">
        <table width="100%" border="1" cellpadding="10">
          <tr><th>Item</th><th>Size</th><th>Qty</th><th>Price</th></tr>
          <?php $total = 0; foreach ($_SESSION['cart'] as $item): 
            $product = $products[$item['product_id'] - 1];
            $item_total = $product['price'] * $item['quantity'];
            $total += $item_total;
          ?>
            <tr>
              <td><?= $product['name'] ?></td>
              <td><?= $item['size'] ?></td>
              <td><?= $item['quantity'] ?></td>
              <td>₱<?= $item_total ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
        <h3>Total: ₱<?= $total ?></h3>
        <input type="text" name="gcash_name" placeholder="GCash Account Name" required>
        <input type="text" name="gcash_ref" placeholder="GCash Reference Number" required>
        <button name="checkout">Submit Order</button>
      </form>
    <?php else: ?>
      <p>Your cart is empty.</p>
    <?php endif; ?>
    <?php if (isset($_GET['success'])) echo "<p style='color: green;'>Order submitted successfully!</p>"; ?>
  </div>
</body>
<?php include "includes/footer.php"; ?>
</html>
