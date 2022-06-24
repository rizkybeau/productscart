<?php
//query nya untuk bermain dengan database
@include 'config.php';

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `carts` SET quantity = '$update_value' WHERE id = '$update_id'");
   
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `carts` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `carts`");
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./style/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="shopping-cart">

   <h1 class="heading">Pesanan Anda</h1>

   <table>
    <!-- header tabel -->
      <thead>
         <th>foto</th>
         <th>masakan</th>
         <th>harga</th>
         <th>quantity</th>
         <th>total harga</th>
         <th>action</th>
      </thead>

      <tbody>
        <!-- isinya tabel -->
         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `carts`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){

         ?>
            <!-- daftar dalam keranjang -->
         <tr>
            <!-- //1 -->
            <td><img src="menuutama/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <!-- //2 -->
            <td><?php echo $fetch_cart['name']; ?></td>
            <!-- //3 -->
            <td>Rp.<?php echo $fetch_cart['price']; ?>,-</td>
            <!-- //4 quantity-->
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1" max="10" value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <!-- //5 -->
            <td> 
                total price Rp.<?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?>,-
            </td>
            <!-- 6 -->
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('batal memesan masakan ini?')" class="delete-btn"> <i class="fas fa-trash"></i> batal</a></td>
         </tr>
         <?php           
                $grand_total += $sub_total;//perhitungan
           
            }; //endwhile
         }; //endif
            function diskon($total){
                $diskon = $total * 0.02;//250000*0.02 = 5000
                echo $total - $diskon; //250000-5000
            }
            function tampilandiskon($tot){
                echo $diskon = $tot *0.02;
            }
         ?>

         <tr class="table-bottom">
            <td><a href="index.php" class="option-btn" style="margin-top: 0;">kembali memesan</a></td>
            <td colspan="3">grand totale</td>
            <td>Rp.<?php 
              if($grand_total > 100000){
                  echo diskon($grand_total);
              }else{
                    echo $grand_total;
              }
              
              
              
              ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('kamu yakin membatalkan semua daftar?');" class="delete-btn"> <i class="fas fa-trash"></i> Hapus Semua Daftar </a></td>
         </tr>
         <tr>
             <td></td>
             <td></td>
             <td></td>
             <td>Diskon 2% setiap pembelian lebih dari 3</td>
             <td><?php if($grand_total > 100000){ 
                 echo tampilandiskon($grand_total);}else{
                     echo "-";
                 }
                   
                    
             ?></td>
             <td></td>
         </tr>

      </tbody>
         
   </table>

   <!-- <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div> -->

</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>