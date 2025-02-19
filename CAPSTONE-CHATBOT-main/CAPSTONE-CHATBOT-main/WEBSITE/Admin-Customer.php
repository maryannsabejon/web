<!DOCTYPE html>
<link rel="icon" href="image/logo3.jpg">
<link rel="icon" type="image/png" href="images/logo2.png">
<title>www.HappyTotes.com</title>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
    body 
    {
    font-family: "Poppins", sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    text-decoration: none;
    scroll-padding-top: 2rem;
    scroll-behavior: smooth;
    }
    .banner
    {
        width: 100%;
        height: 100vh;
        background-image: url(images/bg1.jpg);
        background-size: cover;
        background-position: center;
        padding-left: 8%;
        padding-right: 5%;
        padding-top: 17%;
        box-sizing: border-box;
    }
    .container 
    {
        text-align: center;
    }
    .btn 
    {
        display: inline-block;
        padding: 10px 20px;
        background-color: transparent;
        color: #ffffff;
        border: none;
        width: 300px;
        height: 100px;
        border-radius: 15px;
        cursor: pointer;
        font-size: 20px;
        margin: 10px;
        text-decoration: none;
        border: 1px solid rgb(0, 119, 255);
        transition: 0.5s;
        backdrop-filter: blur(3px);
        box-shadow: 0 0 20px 2px rgba(0,0,0,0.1);
    }
    .btn:hover
     {
        background-color: #007bff;
        color: black;
        transform: scale(1.1);
        z-index: 2;
    }

</style>
</head>
<body>
    <div class="banner">
<div class="container">
    <button class="btn" onclick="adminLogin();">Admin</button>
    <button class="btn" onclick="customerLogin()">Customer</button>
    </div>
</div>
 
<script>
    function adminLogin() 
    {
        location.href = 'Admin.php'
        // Add your admin login logic here
        alert("Admin login clicked");
    }

    function customerLogin() 
    {
        // Add your customer login logic here
        location.href = 'Home.php'
        alert("Customer login clicked");
    }
</script>

</body>
</html>
