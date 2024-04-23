<?php
include_once("products.php");
$curl= curl_init();

//turn off ssl
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// //GET THE REFERENCE CODE FROM THE URL
if(!empty($_GET["reference"])){
    //
    $sanitize = filter_var_array($_GET, FILTER_SANITIZE_STRING);
    $reference = rawurldecode($sanitize["reference"]);

}else{
    die("No reference was supplied");
}

//set the config
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/". $reference,
    CURLOPT_RETURNTRANSFER => true,

    //set the headers
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "authorization: Bearer sk_test_f8c6e5c61cbaedf0cefac1c7501508f6a4d11dd8",
        "cache-control: no-cache"
        
    ]

)

);
//execute the curl
$response = curl_exec($curl);

$err = curl_error($curl);
if($err){
    die("curl returned some errors: ". $err);
}
//var_dump($response);

$trans = json_decode($response);
if(isset($trans->error)){
    die("API returned some errors: ". $trans->message);
}
if("success" == $trans->data->status){
    $amount = $trans->data->amount;
    $email = $trans->data->customer->email;
    $ref = $trans->data->reference;
    $product_name = $trans->data->metadata->custom_fields[0]->value;
    $product_desc = $trans->data->metadata->custom_fields[1]->value;
    $name = $trans->data->metadata->custom_fields[3]->value;
$phone = $trans->data->metadata->custom_fields[4]->value;
$address = $trans->data->metadata->custom_fields[5]->value;
}else{
    die("Transaction not found");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Reciept</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="verifyHeader">THANK YOU!</h1>
<hr>
<div class="verifyContainer">
    <div class="verifyProduct">
        <h3 class="verifySubHeading" >Details of your Purchase</h3>
        <div class="productLine">
            <div class="verifyLabel">
                <p> Name:  </p>
            </div>
            <div class="verifyDetails">
                <p><?php echo $name ?> </p>
            </div>
        </div>

        <div class="productLine">
            <div class="verifyLabel">
                <p> Phone:  </p>
            </div>
            <div class="verifyDetails">
                <p> <?php echo $phone ?> </p>
            </div>
        </div>

        <div class="productLine">
            <div class="verifyLabel">
                <p> Delivery Address:  </p>
            </div>
            <div class="verifyDetails">
                <p><?php echo $address ?> </p>
            </div>
        </div>

        <div class="productLine">
            <div class="verifyLabel">
                <p> Email:  </p>
            </div>
            <div class="verifyDetails">
                <p> <?php echo $email ?> </p>
            </div>
        </div>

        <div class="productLine">
            <div class="verifyLabel">
                <p> Reference:  </p>
            </div>
            <div class="verifyDetails">
                <p><?php echo $ref ?> </p>
            </div>
        </div>

        <div class="productLine">
            <div class="verifyLabel">
                <p> Product Name:  </p>
            </div>
            <div class="verifyDetails">
            <p> <?php echo $product_name ?> </p>
            </div>
        </div>

        <div class="productLine">
            <div class="verifyLabel">
                <p> Product Description:  </p>
            </div>
            <div class="verifyDetails">
            <p> <?php echo $product_desc ?> </p>
            </div>
        </div>

        <div class="productLine">
            <div class="verifyLabel">
                <p> Amount:  </p>
            </div>
            <div class="verifyDetails">
            <p> <?php echo $amount /100 ?> </p>
            </div>
        </div>


    </div>
</div>
   
</div>
<hr>
<hr>
</body>
</html>