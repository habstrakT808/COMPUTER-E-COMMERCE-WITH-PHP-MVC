<?php 

function buyOrCart($conn, $quantityInStock, $cartQty, $itemID, $price, $cart){
  // add into cart if qty in stock is larger than requested quantity
  if ($quantityInStock >= $cartQty){
    if (isset($_SESSION["Member"])) {
      $orderID = $cart->getOrderID();
      
      // check if order has been added before
      $sql = "SELECT O.OrderID, O.CartFlag, OI.OrderItemID, OI.OrderID, OI.Quantity 
              FROM Orders O, OrderItems OI 
              WHERE O.OrderID = OI.OrderID AND OI.OrderID = ? AND OI.ItemID = ?";
      $stmt = $conn->conn()->prepare($sql);
      $stmt->bind_param('ii', $orderID, $itemID);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $orderItemID = $row["OrderItemID"];

      if ($orderItemID === NULL) {
        // add as new order
        $sql = "INSERT INTO OrderItems(OrderID, ItemID, Price, Quantity, AddedDatetime)
                VALUES (?, ?, ?, ?, CURRENT_TIME)";
        $stmt = $conn->conn()->prepare($sql);
        $stmt->bind_param('iiii', $orderID, $itemID, $price, $cartQty);
        $stmt->execute();
      } else {
        $cartQty += $row["Quantity"];
        
        // update the existing order item quantity
        $sql = "UPDATE OrderItems 
                SET Quantity = ? 
                WHERE OrderItemID = ? AND OrderID = ? AND ItemID = ?";
        $stmt = $conn->conn()->prepare($sql);
        $stmt->bind_param('iiii', $cartQty, $orderItemID, $orderID, $itemID);
        $stmt->execute();
      }
    } else {
      echo ("<script>alert('Login to add to cart.');</script>");
      echo ("<script>window.location.href='login.php';</script>");
    }
  }
}
