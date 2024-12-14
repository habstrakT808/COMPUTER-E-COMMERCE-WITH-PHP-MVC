<?php
require_once "includes/class_autoloader.php";
if (isset($_GET["member_id"])) {
    /** @var int $memberID */
    $memberID = $_GET["member_id"];
    $member = Member::CreateMemberFromID($memberID);
    $orders = $member->getOrders();
    $orderCount = count($orders);
}
?>

<div class="row" style="margin-top: 100px; margin-bottom: 50px; border-bottom: 3px solid #bbb">
  <h4 class="page-title">Payment History / Previous Orders</h4>
</div>

<?php
if ($orderCount <= 0) {
    echo("<h5 class='grey-text page-title'>There are no orders yet. How about 
    <a href='product_catalogue.php?query='>making some orders</a>? :)</h5>");
} else {
    echo("
    <div class='row'>
      <div class='title-card col s8' style='height: 55px; margin-bottom: 10px'>
        <p class='col s4 center' style='padding-top: 15px; margin: 0px;'>Date & Product</p>
        <p class='col s2 center ' style='padding-top: 15px; margin: 0px;'>Unit Price</p>
        <p class='col s2 center' style='padding-top: 15px; margin: 0px;'>Quantity</p>
        <p class='col s4 center' style='padding-top: 15px; margin: 0px;'>Actions</p>
      </div>
    </div>
    ");

    for ($i = 0; $i < $orderCount; $i++) {
        $idx = $i + 1;

        $sql = "SELECT P.OrderID, P.PaymentDate, OI.OrderID FROM Payment P, OrderItems OI
        WHERE P.OrderID = OI.OrderID";
        $dbh = new Dbhandler();
        $result = $dbh->conn()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $paymentDate = $row["PaymentDate"];
        }

        echo("<h5 class='white-text page-title'>#$idx Paid: $paymentDate</h5>");
        // row starting point
        echo("<div class='row'>");
        // prev order list starting point
        echo("<div class='col s8'> <ul class='collapsible popout' id='cart'>");

        $order = $orders[$i];
        $orderID = $order->getOrderID();
        $orderItems = $order->getOrderItems();
        $orderItemCount = count($orderItems);

        $sumTotal = 0;
        for ($o = 0; $o < $orderItemCount; $o++) {
            $orderItem = $orderItems[$o];
            $item = new Item($orderItem->getItemID());
            generateBoughtItem($item, $orderItem, $memberID);

            $quantity = $orderItem->getQuantity();
            $price = $orderItem->getPrice();
            $sumTotal += $price * $quantity;
        }

        // Calculate shipping and promo discounts
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

        // order items list closing point
        echo("</ul></div>");

        generateOrderSum($orderItemCount, $sumTotalFormatted, $displayShippingFormatted, $displaySVoucher, $displayPVoucher);

        // row closing point
        echo("</div>");
    }
}
?>
