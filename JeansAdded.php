
<!DOCTYPE html>
<!-- !PAGE CONTENT! -->
<?php session_start(); ?>
<?php include "./includes/header.php" ?> 
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <p class="w3-left">Jeans</p>
    <p class="w3-right">
      <button id="viewCartButton" class="fa fa-shopping-cart w3-margin-right"></button>
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

  <div class="w3-container w3-text-grey" id="jeans">
    <p>8 items</p>
  </div>

  
  <! --- 
     *******************************************
     IMPLEMENT YOUR PHP HERE
     ---->
    
<?php
 # get passed product id and assign it to a variable.   
if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
# retrieve selective item data from 'shop"products"' database table.
$q= "SELECT * FROM products WHERE item_id= $id";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r)==1){
    
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    
    # check if cart already contains one of this product id.
    
    if (isset ($_SESSION['cart'][$id])) {
        #add one more of this product.
        $_SESSION['cart'][$id]['quantity']++;
        echo '<p>Another ' . $row["item_name"] . '  has been added to your cart</p>';
    }else{
        # or add one of this product to the cart.
        $_SESSION['cart'][$id]= array('quantity' => 1, 'price' => $row['item_price']);
        echo'<p>A ' . $row["item_name"] .' has been added to your cart</p>'; 
    }
    
    //echo var_dump($_SESSION);
 }
       
?>
            
    
  <!-- Subscribe section -->
  <div class="w3-container w3-black w3-padding-32">
    <h1>Subscribe</h1>
    <p>To get special offers and VIP treatment:</p>
    <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail" style="width:100%"></p>
    <button type="button" class="w3-button w3-red w3-margin-bottom">Subscribe</button>
  </div>
    
  <?php include "./includes/footer.php" ?> 