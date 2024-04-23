<?php
include_once ("products.php");
//var_dump($products);
if (isset($_GET["product"])) {
   $id = htmlspecialchars($_GET["product"]);
   $product_name = $products[$id]["title"];
   $price = $products[$id]["price"];
   $product_desc = $products[$id]["description"];
   $pix = $products[$id]["pix"];
} else {
   header("location: index.php?empty-Please, select a product to continue");
}

//integrate paystack
if (isset($_POST["submit"])) {
   $name = htmlspecialchars($_POST['name']);
   $phone = htmlspecialchars($_POST['phone']);
   $address = htmlspecialchars($_POST['address']);
   $email = htmlspecialchars($_POST["email"]);

   //initiate paystack
   $url = "https://api.paystack.co/transaction/initialize";

   //gather parameters
   $transaction_data = [
      "email" => $email,
      "amount" => $price * 100,
      "callback_url" => "http://localhost/verify.php",
      "metadata" => [
            "custom_fields" => [
               [
                  "display_name" => "Product Name",
                  "variable_name" => "product",
                  "value" => $product_name
               ],

               [
                  "display_name" => "Product Description",
                  "variable_name" => "description",
                  "value" => $product_desc
               ],

               [
                  "display_name" => "Product Price",
                  "variable_name" => "price",
                  "value" => $price
               ],

               [
                  "display_name" => "Customer Name",
                  "variable_name" => "name",
                  "value" => $name
               ],

               [
                  "display_name" => "Customer Phone Number",
                  "variable_name" => "phone",
                  "value" => $phone
               ],

               [
                  "display_name" => "Customer Address",
                  "variable_name" => "address",
                  "value" => $address
               ]

            ]
         ]
   ];

   //generate url encoded string
   $encode_transaction_data = http_build_query($transaction_data);
   //open connection to cURL
   $ch = curl_init();

   //turn off mandatory ssl checking
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

   //set the url
   curl_setopt($ch, CURLOPT_URL, $url);

   //enable data to be sent in POST arrays
   curl_setopt($ch, CURLOPT_POST, true);

   //collect post data from above
   curl_setopt($ch, CURLOPT_POSTFIELDS, $encode_transaction_data);

   //set headers from the endpoint
   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Authorization: Bearer sk_test_f8c6e5c61cbaedf0cefac1c7501508f6a4d11dd8",
      "cache-control: no-cache",
   )
   );

   //make curl returrn the data instead of echocing it
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   //execute the cURL
   $result = curl_exec($ch);

   //check for errors
   if (curl_error($ch)) {
      die("curl reutrned error: " . curl_error($ch));
   }

   //var_dump($result);

   $transaction = json_decode($result);
   // redirect auto to payment page
   header("location: " . $transaction->data->authorization_url);
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BUY NOW!</title>
   <link rel="stylesheet" href="style.css">
</head>

<body>
   <h1 class="buyHeader">Confirmation</h1>
   <hr>
   <div class="productContainer">
      <div class="productItem">
         <?php echo $pix ?>
         <h3>
            <?php echo $product_name ?>
         </h3>
         <small> &#8358;
            <?php echo $price ?>
         </small>
         <p>
            <?php echo $product_desc ?>
         </p>

         <form action="" method="POST">
            <label>Your Details</label>
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="text" name="address" placeholder="Delivery Address" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="submit" name="submit" value="Proceed to Pay">
         </form>
      </div>

   </div>
   <hr>
   <footer class="buyFooter">
      <p>Copyright &copy; uwem
         <?php echo date("Y"); ?>
      </p>
   </footer>
   <hr>
</body>

</html>