<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Happy Totes</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="images/logo2.png" />
    <link rel="stylesheet" href="style1.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
    <!-- Front Page -->
    <div class="banner">
      <div class="navbar">
        <img src="images/logo2.png" class="logo" />
        <ul>
          <li><a href="Front-Page-Tote.html">Home</a></li>
          <li><a href="Company-Overview.html">Company Overview</a></li>
          <li><a href="Contact-us.html">Contact Us</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col">
          <h1>Happy Totes</h1>
          <p>
            Custom Tote Bag, Carry your essentials with flair. With their
            spacious design and sturdy handles, tote bags effortlessly blend
            fashion and functionality. Whether you're heading to the market,
            library, or a day out with friends, a tote bag is the perfect
            companion, ready to hold your essentials with ease.
          </p>
          <button type="button" onclick="location.href='Shop2.php'">
            Shop Now
          </button>
        </div>
        <div class="col">
          <div class="card card1" onclick="location.href='Customize.php'">
            <h3>Bag Sizes</h3>
            <p>Bags come in an endless array of styles</p>
            <p>click for more details</p>
          </div>
          <div class="card card2" onclick="location.href='Customize.php'">
            <h3>Fashion</h3>
            <p>Customize your design</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Chatbot Container -->
    <div id="Chatbot"></div>
    <!-- Scripts -->
    <script src="js/script.js" defer></script>
    <script src="website/js/chatbot.js" defer></script>
  </body>
</html>
