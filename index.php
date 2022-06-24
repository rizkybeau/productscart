<?php
//connect database
@include 'config.php';
//insert php
if(isset($_POST['keranjang'])){
    // tentukan data yang akan di insert
   $product_name = $_POST['masakan'];
   $product_price = $_POST['harga'];
   $product_image = $_POST['foto'];
   $product_quantity = 1;
    //select databasenya
   $select_cart = mysqli_query($conn, "SELECT * FROM `carts` WHERE name = '$product_name'");
    //kondisi supaya tidak double saat di masukan datanya
   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'makanan sudah dipilih';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `carts`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'pesanan anda telah ditambahkan';
   }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="./style/style.css">
</head>
<body>
    
    <?php

//pemanis untuk memberitahu bahwa sukses atau kesalahan
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">


        <section class="products">

            <h1 class="heading">Paling Laris</h1>

            <div class="box-container">

            <?php
      
            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            //jumlah baris = mysqli_num_rows
            if(mysqli_num_rows($select_products) > 0){
               //tampilakn product di menu dari database
               
                while($fetch_product = mysqli_fetch_assoc($select_products)){
                    
                    ?>
                    
                    <form action="" method="post">
                    <div class="box">
                        <img src="menuutama/<?php echo $fetch_product['image']; ?>" alt="">
                        <h3><?php echo $fetch_product['name']; ?></h3>
                        <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                        <input type="hidden" name="masakan" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="harga" value="<?php echo $fetch_product['price']; ?>">
                        <input type="hidden" name="foto" value="<?php echo $fetch_product['image']; ?>">
                        <input type="submit" class="btn" value="Pesan" name="keranjang">
                    </div>
                    </form>
        
                <?php
                    };//end while
                    
        };//end if
        
        ?>
        </section>
        <!-- container -->
        <h1>Best Deals</h1>
        <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            $fetch_product = mysqli_fetch_assoc($select_products)
                    
                ?>
                
                <form action="" method="post">
                <div class="box">
                    <img src="menuutama/<?php echo $fetch_product['image']; ?>" alt="">
                    <h3><?php echo $fetch_product['name']; ?></h3>
                    <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                    <input type="hidden" name="masakan" value="<?php echo $fetch_product['name']; ?>">
                    <input type="hidden" name="harga" value="<?php echo $fetch_product['price']; ?>">
                    <input type="hidden" name="foto" value="<?php echo $fetch_product['image']; ?>">
                    <input type="submit" class="btn" value="Pesan" name="keranjang">
                </div>
                </form>
    
            <?php
            

        ?>
        <h1>Favorite</h1>















</div>

    
    
    <section class="gallery">
        <div class="icon-contact"></div>
            <div class="ket">
            <p>Lokasi</p>
            <p>Jakarta Utara</p>
            </div>
        <div class="icon-contact"></div>
            <div class="ket">
            <p>Open Hours</p>
            <p>10.00-22.00</p>
            </div>
            <div class="icon-contact"></div>
            <div class="ket">
            <p>Email Kami</p>
            <p>admin@masakan.info</p>
            </div>
        <div class="icon-contact"></div>
            <div class="ket">
            <p>Call</p>
            <p>+6280003000</p>
            </div>
        
        
        
    </section>    
    

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>