<?php
include_once("products.php");
//var_dump($products);
if(isset($_GET["empty"])){
   $error = htmlspecialchars($_GET["empty"]);
}else{
   $error = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">   
    <title>Denim Jeans</title>
</head>
<body>
    <nav id="nav">
        <div class="navTop">
            <div class="navItem">
                <img src="img/sneakers.png" alt="sneakers image">
            </div>
            <div class="navItem">
                <span class="limitedOffer">Limited Offer</span>
            </div>
        </div>
        <div class="navBottom">
            <h3 class="menuItem">AIR FORCE</h3>
            <h3 class="menuItem">JORDAN</h3>
            <h3 class="menuItem">BLAZER</h3>
            <h3 class="menuItem">CRATER</h3>
            <h3 class="menuItem">HIPPIE</h3>
        </div>
    </nav>
    <div class="slider">
        <div class="sliderWrapper">
            <div class="sliderItem">
                <img src="img/air.png" alt="" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">AIR FORCE<br> NEW <br> SEASON</h1>
                <!-- <h2 class="sliderPrice">$119</h2> -->
                <a href = "#product">
                    <btton class="buyButton">Buy Now!</btton>
                </a>
            </div>
            <div class="sliderItem">
                <img src="img/jordan.png" alt="" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">JORDAN<br> NEW <br> SEASON</h1>
                <!-- <h2 class="sliderPrice">$149</h2> -->
                <a href = "#product"> 
                    <btton class="buyButton">Buy Now!</btton>
                </a>
            </div>
            <div class="sliderItem">
                <img src="img/blazer.png" alt="" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">BLAZERS<br> NEW <br> SEASON</h1>
                <!-- <h2 class="sliderPrice">$109</h2> -->
                <a href = "#product"> 
                    <btton class="buyButton">Buy Now!</btton>
                </a>
            </div>
            <div class="sliderItem">
                <img src="img/crater.png" alt="" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">CRATER<br> NEW <br> SEASON</h1>
                <!-- <h2 class="sliderPrice">$129</h2> -->
                <a href = "#product"> 
                    <btton class="buyButton">Buy Now!</btton>
                </a>
            </div>
            <div class="sliderItem">
                <img src="img/hippie.png" alt="" class="sliderImg">
                <div class="sliderBg"></div>
                <h1 class="sliderTitle">HIPPIE<br> NEW <br> SEASON</h1>
                <!-- <h2 class="sliderPrice">$99</h2> -->
                <a>
                    <btton class="buyButton">Buy Now!</btton>
                </a>
            </div> 
        </div>
    </div>
        <div class="features">
            <div class="feature">
                <img src="./img/shipping.png" alt="" class="featureIcon">
                <span class="featureTitle">FREE SHIPPING</span>
                <span class="featureDesc">Free worldwide shipping on all orders.</span>
            </div>
            <div class="feature">
                <img class="featureIcon" src="./img/return.png" alt="">
                <span class="featureTitle">30 DAYS RETURN</span>
                <span class="featureDesc">No question return and easy refund in 14 days.</span>
            </div>
            <div class="feature">
                <img class="featureIcon" src="./img/gift.png" alt="">
                <span class="featureTitle">GIFT CARDS</span>
                <span class="featureDesc">Buy gift cards and use coupon codes easily.</span>
            </div>
            <div class="feature">
                <img class="featureIcon" src="./img/contact.png" alt="">
                <span class="featureTitle">CONTACT US!</span>
                <span class="featureDesc">Keep in touch via email and support system.</span>
            </div>
        </div>

        <span id="error"><?php echo $error; ?></span>
        
        <div class="productContainer" id="product">
            <?php foreach($products as $product): ?>
                <div class="productItem">
                    <?php echo $product["pix"]; ?>
                    <h3> <?php echo $product["title"]; ?></h3>
                    <!-- <small> &#8358;<?php echo $product["price"]; ?></small> -->
                    <p>  <?php echo $product["description"]; ?></p>
                    <a href="buy.php?product=<?php echo $product["id"]; ?>">&#8358;<?php echo $product["price"]; ?></a>
                </div>
            <?php endforeach; ?>
            
        </div>


        <div class="payment" id="paymentForm">
            <h1 class="payTitle">Personal Information</h1>
            <label>Name and Surname</label>
            <input type="text" placeholder="Your name" class="payInput" id="name">
            <label>Phone Number</label>
            <input type="text" placeholder="Your phone number" class="payInput">
            <label>Amount</label>
            <input type="text" placeholder="price" class="payInput" id="amount">
        
            <label>Email</label>
            <input type="text" placeholder="Your email" class="payInput" id="email-address">
        
            <h1 class="payTitle">Card Informmation</h1>
            <div class="cardIcons">
                <img src="./img/visa.png" width="40" alt="" class="cardIcon">
                <img src="./img/master.png" width="40" alt="" class="cardIcon">
            </div>
            <button type="submit" class="payButton" onclick= "payWithPaystack(event)" >Checkout</button>
            <span class="close">X</span>
        </div>
    </div>


    <div class="gallery">
        <div class="galleryItem">
            <h1 class="galleryTitle">Jeans That Fit</h1>
                <img src="https://images.pexels.com/photos/9295809/pexels-photo-9295809.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"
                    alt="" class="galleryImg">
        </div>
        <div class="galleryItem">
            <img src="https://images.pexels.com/photos/1040427/pexels-photo-1040427.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"
                alt="" class="galleryImg">
            <h1 class="galleryTitle">This is the First Day of Your New Life</h1>
        </div>
        <div class="galleryItem">
            <h1 class="galleryTitle">Just Do it!</h1>
            <img src="https://images.pexels.com/photos/7856965/pexels-photo-7856965.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"
                alt="" class="galleryImg">
        </div>
    </div>
    <div class="newSeason">
        <div class="nsItem">
            <img src="https://images.pexels.com/photos/4753986/pexels-photo-4753986.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"
                alt="" class="nsImg">
        </div>

        <div class="nsItem">
            <h3 class="nsTitle">WINTER NEW ARRIVALS</h3>
            <h1 class="nsTitle">New Season</h1>
            <h1 class="nsTitle">New Collection</h1>
            <a href="#nav">
                <button class="nsButton">CHOOSE YOUR STYLE</button>
            </a>
        </div>

        <div class="nsItem">
            <img src="https://images.pexels.com/photos/7856965/pexels-photo-7856965.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500"
                alt="" class="nsImg">
        </div>
    </div>
    <footer>
        <div class="footerLeft">
            <div class="footerMenu">
                <h1 class="fMenuTitle">About Us</h1>
                <ul class="fList">
                    <li class="fListItem">Company</li>
                    <li class="fListItem">Contact</li>
                    <li class="fListItem">Careers</li>
                    <li class="fListItem">Affiliates</li>
                    <li class="fListItem">Stores</li>
                </ul>
            </div>
            <div class="footerMenu">
                <h1 class="fMenuTitle">Useful Links</h1>
                <ul class="fList">
                    <li class="fListItem">Support</li>
                    <li class="fListItem">Refund</li>
                    <li class="fListItem">FAQ</li>
                    <li class="fListItem">Feedback</li>
                    <li class="fListItem">Stories</li>
                </ul>
            </div>
            <div class="footerMenu">
                <h1 class="fMenuTitle">Products</h1>
                <ul class="fList">
                    <li class="fListItem">Air Force</li>
                    <li class="fListItem">Air Jordan</li>
                    <li class="fListItem">Blazer</li>
                    <li class="fListItem">Crater</li>
                    <li class="fListItem">Hippie</li>
                </ul>
            </div>
        </div>
        <div class="footerRight">
            <div class="footerRightMenu">
                <h1 class="footerMenuTitle">Subscribe to Our newsletter</h1>
                <div class="fMail">
                    <input type="text" placeholder="Your email" class="fInput">
                    <button class="fButton">Join</button>
                </div>
            </div>
            <div class="footerRightMenu">
                <h1 class="fMenuTitle">Follow Us</h1>
                <div class="fIcons">
                    <img src="./img/facebook.png" alt="" class="fIcon">
                    <img src="./img/twitter.png" alt="" class="fIcon">
                    <img src="./img/instagram.png" alt="" class="fIcon">
                    <img src="./img/whatsapp.png" alt="" class="fIcon">
                </div>
            </div>
            <div class="footerRightMenu">
                <span class="copyright">@Uwem Utuk. All rights reserved. 2024.</span>
            </div>
        </div>
    </footer>

    <script src="https://js.paystack.co/v1/inline.js"></script> 
    <script src="./payment.js"></script>
    <script src="./main.js"></script>
</body>
</html>