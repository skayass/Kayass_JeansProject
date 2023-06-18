
<!DOCTYPE html>
<!-- !PAGE CONTENT! -->
<?php include "./includes/header.php" ?> 



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
      <p><a href="#jeans" class="w3-button w3-black w3-padding-large w3-large">SHOP NOW</a></p>
    </div>
  </div>


  <div class="w3-container w3-text-grey" id="jeans">
    <p>8 items</p>
  </div>
    

  <!-- Product grid -->
 <div class="w3-row w3-grayscale">
 
   <! --- 
     *******************************************
     IMPLEMENT YOUR PHP HERE  
     ---->
     
   <?php
        
    
        $sql = "SELECT * FROM products ";
        $result = $dbc->query($sql);
        $newColumn = 0;
        if ($result->num_rows > 0) {
            // output data of each row.
            
            while($row = $result->fetch_assoc()){
                
                
                if ($newColumn = 0 || $newColumn = 3 || $newColumn = 5) {
                    
                    echo '<div class="w3-col l3 s6">' ;
                    
                }
                
                
                echo '<div class="w3-container">' ;
                echo '<div class="w3-display-container">' ;
                echo '<form action="JeansAdded.php" method="post">' ;
                echo "<img src='{$row['item_img']}' style='width:100%'>" ;
                echo '<span class="w3-tag w3-display-topleft"></span>' ;
                echo '<div class="w3-display-middle w3-display-hover">' ;
                echo '<button class="w3-button w3-black" name="buy"> Add To Cart <i class="fa fa-shopping-cart"></i></button>';
                echo "<input type='hidden' name='id' value='{$row['item_id']}' >" ;
                echo "<input type='hidden' name='item_name' value='{$row['item_name']}' >" ;
                
                echo '</div>';
                echo '</form>';
                echo '</div>';
                echo "<p style = 'color:white'> {$row['item_name']}<br><b>$ {$row['item_price']}</b></p>";
                echo '</div>';
                
                if ($newColumn = 0 || $newColumn = 3 || $newColumn = 5) {
                    echo '</div>';
                }
                
                $newColumn +=1; 
                
            }
            
        }else {
            echo "0 results";
            
        }
        
        echo "<br><br><br><hr>";

    
    ?>
       
   
  <!-- Subscribe section -->
  <div class="w3-container w3-black w3-padding-32">
    <h1>Subscribe</h1>
    <p>To get special offers and VIP treatment:</p>
    <p><input class="w3-input w3-border" type="text" placeholder="Enter e-mail" style="width:100%"></p>
    <button type="button" class="w3-button w3-red w3-margin-bottom">Subscribe</button>
  </div>
  <?php include "./includes/footer.php" ?> 