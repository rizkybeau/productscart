<header class="header">

   <div class="flex">

      <a href="#" class="logo">FAMILY SAKAU</a>

      <nav class="navbar">
         <a href="index.php">Menu Utama</a>
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `carts`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);
      
      ?>

      <a href="cart.php" class="cart">Keranjang<span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>
      <h1 style="color:#fff;"><?php echo($row_count);?></h1>
   </div>

</header>