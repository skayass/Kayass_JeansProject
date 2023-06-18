<!DOCTYPE html>
<!-- !PAGE CONTENT! -->

<?php include "./includes/header.php" ?>
 <?php
session_start();
echo "session";
echo var_dump($_SESSION); 
?>
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <p class="w3-left">Jeans</p>
    <p class="w3-right">
      <button id="viewCartButton" class="fa fa-shopping-cart w3-margin-right"></button>
      <!--<i class="fa fa-shopping-cart w3-margin-right"></i>-->
      <i class="fa fa-search"></i>
    </p>
  </header>
    <script type="text/javascript">
    document.getElementById("viewCartButton").onclick = function () {
        location.href = "./JeansCart.php";
    };
</script>
    
    

  <!-- Image header -->
  <div class="w3-display-container w3-container">
    <img src="https://www.w3schools.com//w3images/jeans.jpg" alt="Jeans" style="width:100%">
    <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
      <h1 class="w3-jumbo w3-hide-small">New arrivals</h1>
      <h1 class="w3-hide-large w3-hide-medium">New arrivals</h1>
      <h1 class="w3-hide-small">COLLECTION 2021</h1>
      <p><a href="./Jeans.php" class="w3-button w3-black w3-padding-large w3-large">SHOP NOW</a></p>
    </div>
  </div>



<div class="w3-display-container w3-container">
  <div class="w3-container w3-text-grey" id="jeans">
    <p>8 items</p>
     <! --- 
     *******************************************
     IMPLEMENT YOUR PHP HERE     
     ---->
<?php 
      
 # access session     

# page title and display header section.      
$page_title = 'Cart';

# check if form has been submitted for update.
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
 # update changed quantity field values.
  foreach($_POST['qty'] as $item_id => $item_qty) {
    
    # ensure values are integers.  
    $id = (int) $item_id;
    $qty = (int) $item_qty;
      
    # change quantity or delete if zero.
    if($qty == 0) {
        unset($_SESSION['cart'][$id]);
      }
    elseif($qty>0) {
        $_SESSION['cart'][$id]['quantity'] = $qty; }
  }
}

# initialize grand total variable.
$total =0;

# Display the cart if not empty.
if(!empty($_SESSION['cart'])) {
    
   # Retrieve all items in the cart from the 'shop(products)' database table.
   $q="SELECT * FROM products WHERE item_id IN (";
   foreach ($_SESSION['cart'] as $id => $value)
   { $q.=$id.',';}
    $q= substr($q, 0, -1).') ORDER BY item_id ASC';
    $r= mysqli_query($dbc, $q);
    
    # display body section with a form and a table.
    echo '<form action="JeansCart.php" method="POST"><table>
    <tr><th colspan="5">Items in your cart</th></tr><tr>';
    
    while($row = mysqli_fetch_array ( $r, MYSQLI_ASSOC ))
{
        # calculate sub-totals and grand total.
        $subtotal = $_SESSION['cart'][$row['item_id']]['quantity']
                * $_SESSION['cart'][$row['item_id']]['price'] ;
        $total += $subtotal ;
        
        # Display the row/s.
        echo "<tr> <td>{$row['item_name']}</td> <td>{$row['item_desc']}</td>
        <td><input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"> </td> <td>@
        {$row['item_price']} = </td> <td>".number_format ( $subtotal , 2 )."</td></tr>" ;
        }
    # close the database connection.
     mysqli_close($dbc );
    
    # display the total.
    echo '<tr><td colspan="5" style="text-align:right"> Total = '.number_format( $total , 2 ).'</td></tr></table>
    <input type="submit" name="submit" value="Update My Cart"></form>';  
    
}else {
    # or display a message
    echo'<p> Your cart is currently empty.</p>';
} 
    echo '<p><a href="./Jeans.php">Shop</a> | <a href="JeansCheckout.php?total='.$total.'"> Checkout</a></p>' ;
          
      
 ?>     
  </div>
</div>
    
<!-- Subscribe section -->
  <div class="w3-container w3-black w3-padding-32">
      
    <h1>Subscribe</h1>
    <p>To get special offers and VIP treatment:</p>
    <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail" style="width:100%"></p>
    <button type="button" class="w3-button w3-red w3-margin-bottom">Subscribe</button>
  </div>
    <?php include "./includes/footer.php" ?>
   

 