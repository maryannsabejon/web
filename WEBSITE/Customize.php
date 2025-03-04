<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Your Tote Bag</title>
    <link rel="icon" type="image/png" href="images/logo2.png" />
    <link rel="stylesheet" href="style1.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(images/bg2.jpg);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            color: white;
            text-shadow: 0 28px 28px rgba(0, 0, 0, 0.632),
            10px 15px 10px rgba(0, 0, 0, 0.495);
            transition: .4s;
        }
        .logo
        {
            width: 90px;
            cursor: pointer;
            float: left;
            margin: 0 10px;
        }
        .btn-home
  {
    width: 70px;
    height: 30px;
    cursor: pointer;
    float: right;
    border-radius: 3px;

    margin: -55px 30px;
    background-color: #acacac;
  }
        header {
            background-color: #515151;
            color: white;
            text-align: center;
            padding: 5px 0;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.477),
            10px 15px 10px rgba(0, 0, 0, 0.463);
            
        }
        footer {
            text-align: center;
            color: white;
        }
        
        main {
            padding: 20px;
        }
        
        .icon-option {
            display: inline-block;
            margin-top: 10px;
            margin-right: 20px;
            cursor: pointer;
            box-shadow: 0 38px 38px rgba(0, 0, 0, 0.628),
            10px 15px 10px rgba(0, 0, 0, 0.582);
            transition: .4s;
            color: black;
            transition: transform 0.5s;
        }
        .icon-option:hover
        {
            transform: translateY(-10px);
        }
        #icon-preview img {
            max-width: 100px;
            margin-top: 10px;
            margin: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.591),
            10px 15px 10px rgba(0, 0, 0, 0.537);
            transition: .4s;
        }
        
        #size-select {
            padding: 10px 20px;
            border-radius: 3px;
            font-size: 15px;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            10px 15px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        #size-section
        {
            margin: 10px 20px;
        }
        #side-select {
            padding: 10px 57px;
            border-radius: 3px;
            font-size: 15px;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            10px 15px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        #side-section
        {
            margin: 10px 20px;
        }
        
        #order-button {
            padding: 10px 50px;
            background-color: #00d11c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
            margin: 10px 20px;
            transition: transform 0.5s;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            10px 15px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        #order-button:hover
        {
            background-color: #42810f;
        color: rgb(255, 255, 255);
        transform: scale(1.1);
        z-index: 2;
        }
        #side-section p
        {
            text-decoration: underline;
            font-size: 15px;
            cursor: pointer;
        }
        .icon-option
        {
            width: 200px;
            height: 230px;
            display: inline-block;
            border-radius: 8px;
            padding: 15px 25px; 
            box-sizing: border-box;
            cursor: pointer;
            margin: 10px 20px;
            background-position: center;
            background-size: cover;
            box-shadow: 0 28px 28px rgba(0, 0, 0, 0.5),
            10px 15px 10px rgba(0, 0, 0, 0.30);
            transition: .4s;
        }
        .card1 { background-image: url(icons/icon1.jpg); }
        .card2 { background-image: url(icons/icon2.jpg); }
        .card3 { background-image: url(icons/icon3.jpg); }
        .card4 { background-image: url(icons/icon4.jpg); }
        .card5 { background-image: url(icons/icon5.jpg); }
        .card6 { background-image: url(icons/icon6.jpg); }
        .card7 { background-image: url(icons/icon7.jpg); }
        .card8 { background-image: url(icons/icon8.jpg); }
        .card9 { background-image: url(icons/icon9.jpg); }
        .card10 { background-image: url(icons/icon10.jpg); }
        .card11 { background-image: url(icons/icon11.jpg); }
        .card12 { background-image: url(icons/icon12.jpg); }
        .card13 { background-image: url(icons/icon13.jpg); }
        .card14 { background-image: url(icons/icon14.jpg); }
        .card15 { background-image: url(icons/icon15.jpg); }
    </style>
</head>
<body>
    <header>
        <div class="tote-logo">
            <img src="images/logo2.png" class="logo">
        <h1>Customize Your Tote Bag</h1>
        <button class="btn-home" onclick="location.href='Home.php'">Home</button>
    </header>
    <main>
        <section id="design-section">
            <h2>Choose Your Icon Design</h2>
            <div class="icon-option card1" onclick="selectIcon('icon1')">Icon 1  </div>
            <div class="icon-option card2" onclick="selectIcon('icon2')">Icon 2  </div>
            <div class="icon-option card3" onclick="selectIcon('icon3')">Icon 3  </div>
            <div class="icon-option card4" onclick="selectIcon('icon4')">Icon 4  </div>
            <div class="icon-option card5" onclick="selectIcon('icon5')">Icon 5  </div>
            <div class="icon-option card6" onclick="selectIcon('icon6')">Icon 6  </div>
            <div class="icon-option card7" onclick="selectIcon('icon7')">Icon 7  </div>
            <div class="icon-option card8" onclick="selectIcon('icon8')">Icon 8  </div>
            <div class="icon-option card9" onclick="selectIcon('icon9')">Icon 9  </div>
            <div class="icon-option card10" onclick="selectIcon('icon10')">Icon 10  </div>
            <div class="icon-option card11" onclick="selectIcon('icon11')">Icon 11  </div>
            <div class="icon-option card12" onclick="selectIcon('icon12')">Icon 12  </div>
            <div class="icon-option card13" onclick="selectIcon('icon13')">Icon 13  </div>
            <div class="icon-option card14" onclick="selectIcon('icon14')">Icon 14  </div>
            <div class="icon-option card15" onclick="selectIcon('icon15')">Icon 15  </div>
            <!-- Add more icon options -->
            <div id="icon-preview">
            </div>
        </section>
        <section id="size-section">
            <h2>SIZES (TOTE BAG) KATCHA / CANVAS MATERIAL ONLY</h2>
            <select id="size-select">
                <option value="Extra Small">8.5x10.5 (Extra Small)</option>
                <option value="Small">10x12 (Small)</option>
                <option value="Medium">13x15 (Medium)</option>
                <option value="Large">14x16 (Large)</option>
                <option value="Extra Large">15x17 (Extra Large)</option>
            </select>
        </section>
        <section id="side-section">
            <h2>Print</h2> 
            <select id="side-select">
                <option value="1 side print">1 side print</option>
                <option value="2 side print">2 side print</option>
            </select>
        </section>
        <button id="order-button" onclick="placeOrder()">Place Order</button>
    </main>
    <!-- Chatbot Container -->
    <div id="Chatbot"></div>
    <!-- Scripts -->
    <script src="js/script.js" defer></script>
    <script src="website/js/chatbot.js" defer></script>

    <footer>
        <p>&copy; 2024 Custom Happpy Tote Bag</p>
    </footer>

    <script>
        function selectIcon(icon) {
            const iconPreview = document.getElementById("icon-preview");
            iconPreview.innerHTML = "";
        
            const img = document.createElement("img");
            img.src = "icons/" + icon + ".jpg"; // Assuming icons are in a folder named "icons"
            iconPreview.appendChild(img);
        }
        
        function placeOrder() {
            const selectedSize = document.getElementById("size-select").value;
            const selectedSide = document.getElementById("side-select").value;
        
            if (!document.getElementById("icon-preview").firstChild) {
                alert("Please choose an icon design.");
                return;
            }
        
            alert(`Order placed! Size: ${selectedSize} ${selectedSide}`)
        }
        
    </script>
    <div id="Chatbot"></div>
    <!-- Scripts -->
    <script src="website/js/script.js" defer></script>
    <script src="website/js/chatbot.js" defer></script>
</body>
</html>
