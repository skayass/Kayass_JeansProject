<?php # DISPLAY CHECKOUT PAGE.

# Access session.
session_start() ;

 

# Set page title and display header section.
$page_title = 'Checkout' ;
include ( 'includes/header.php' ) ; ?>
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
      <! --- 
     *******************************************
     IMPLEMENT YOUR PHP HERE     
     ---->
<?php
    
      #check for passed total and cart.
    if (isset($_GET['total'] ) && ($_GET['total'] > 0 ) && (!empty( $_SESSION['cart']))) {
    
         # User id is hard coded because we did not include login.
        # store buyer and order total in 'orders' database table.
        $q ="INSERT INTO orders ( user_id , total, order_date) VALUES (1,".$_GET['total'].", NOW())";
        $r = mysqli_query($dbc , $q) ;
        
        # Retrieve current order number.
        $order_id = mysqli_insert_id($dbc);
        
        # Retrieve cart items from 'shop(products)' database table.
        $q = "SELECT * FROM products WHERE item_id IN (" ;
        foreach ($_SESSION['cart'] as $id => $value){
             $q.= $id.',' ; }
        $q = substr( $q, 0 , -1 ).') ORDER BY item_id ASC' ;
        $r = mysqli_query ($dbc , $q );
        
        # Store order contents in 'order_contents' database table.
        while ( $row = mysqli_fetch_array ( $r , MYSQLI_ASSOC ) )
        {
            $query = "INSERT INTO order_contents ( order_id, item_id, quantity, price )
            VALUES ( $order_id, ".$row['item_id'].",".$_SESSION['cart'][$row['item_id']]['quantity'].",".
            $_SESSION['cart'][$row['item_id']]['price'].")" ;
            $result = mysqli_query( $dbc , $query ) ;
        }

        mysqli_close($dbc);   
        
       echo "<p>Thanks for your order. Your Order Number Is #".$order_id."</p>";
       
        # Remove cart items.
       $_SESSION['cart']= NULL ; 
             

    }else {
        echo '<p>There are no items in your cart.</p>'; 
    }

    echo '<p><a href="Jeans.php">Shop</a></p>';

?>    
      
    </div>
</div>
<?php
# Display footer section.
include ( 'includes/footer.php' ) ; 

?>