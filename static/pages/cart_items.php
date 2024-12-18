<?php

require_once "includes/order.inc.php";
require_once "includes/class_autoloader.php";

$sumTotal = 0; // Inisialisasi awal variabel $sumTotal

if (isset($_GET["member_id"])) {
    $memberID = $_GET["member_id"];
    $member = Member::CreateMemberFromID($memberID);
    $cart = $member->getCart();
    $cartID = $cart->getOrderID();
    $cartItems = $cart->getOrderItems();
    $cartItemCount = count($cartItems);
}

if (isset($_GET["remove_item"])) {
    $orderItemID = $_GET["remove_item"];
    $sql = "DELETE FROM OrderItems WHERE OrderItemID = ?";
    $conn = new Dbhandler();
    $stmt = $conn->conn()->prepare($sql);
    $stmt->bind_param('i', $orderItemID);
    $stmt->execute();
    header("location: cart.php?member_id=$memberID");
    exit;
}
?>

<h4 class="page-title">Cart</h4>
<div class="row">
  <div class="col s8">
    <ul class="collapsible popout" id="cart">
      <!-- generate all rows of items -->
      <?php
        if (isset($cartItems)) {
          if ($cartItemCount <= 0) {
            echo("<h5 class='grey-text page-title'>Your shopping cart is empty.</h5><h6 class='grey-text page-title'>
              <a href='product_catalogue.php?query='>Shop Now!</a></h6>");
          } else {
            echo("
            <div class='title-card' style='height: 55px; margin-bottom: 10px'>
              <p class='col s4 center' style='padding: 0px; margin: 0px;'>Product</p>
              <p class='col s2 center' style='padding: 0px; margin: 0px;'>Unit Price</p>
              <p class='col s2 center' style='padding: 0px; margin: 0px;'>Quantity</p>
              <p class='col s4 center' style='padding: 0px; margin: 0px;'>Actions</p>
            </div>");
            
            for ($c=0; $c < $cartItemCount; $c++) {
              $orderItem = $cartItems[$c];
              $item = new Item($orderItem->getItemID());
              generateItem($item, $orderItem, $memberID);

              $quantity = $orderItem->getQuantity();
              $price = $orderItem->getPrice();
              $sumTotal += $price * $quantity;
            }
          }
        }
      ?>
    </ul>
  </div>

  <div class="col s4">
    <div class="rounded-card-parent">
      <div class="card rounded-card">
        <h5 class="bold center">Cart Details</h5>
        <form action="payment.php" method="GET">
          <table class="responsive-table">
            <tbody>
              <?php
                
                if ($sumTotal >= 200000) {
                    $displayShipping = 0;
                    $displaySVoucher = " <span class='yellow-text'>(Shipping voucher applied)</span>";
                } else {
                    $displayShipping = 25000;
                    $displaySVoucher = "";
                }
                
                if ($displayShipping === 0) {
                    $displayShippingFormatted = "<span class='underline'>Rp.0</span>";
                } else {
                    $displayShippingFormatted = "Rp." . number_format($displayShipping, 0, ',', '.');
                }

                if ($sumTotal >= 2000000) {
                    $promoDiscount = 100000;
                    $displayPVoucher = "<span class='underline'>-Rp.100.000</span> <span class='yellow-text'>(Promo voucher applied)</span>";
                } else {
                    $promoDiscount = 0;
                    $displayPVoucher = "None (min spend not reached)";
                }

                $shippingTotal = $sumTotal - $promoDiscount + $displayShipping;
                $sumTotalFormatted = "Rp." . number_format($shippingTotal, 0, ',', '.');

                echo("<tr><th>Total Items:</th><td>$cartItemCount</td></tr>");
                echo("<tr><th>Delivery Charges:</th><td>$displayShippingFormatted $displaySVoucher</td></tr>");
                echo("<tr><th>Promo Voucher:</th><td>$displayPVoucher</td></tr>");
                echo("<tr><th>Sum Total:</th><td>$sumTotalFormatted</td></tr>");
              ?>
            </tbody>
          </table>
          <?php if (!isset($_GET["view_order"]) && $cartItemCount > 0) { ?>
          <button class="btn amber darken-3" style="margin-top: 20px; margin-left: 200px">
            Checkout
          </button>
          <input type="hidden" name="order_id" value=<?php echo($cartID); ?>>
          <input type="hidden" name="view_order" value=1>
          <input type="hidden" name="member_id" value=<?php echo($memberID); ?>>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){ $('.collapsible').collapsible(); });
</script>
