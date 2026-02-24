<?php
// We keep the PHP purely for the "Static" part of the Discord embed
$status_title = "Jellyfin Status Check"; 
$embed_gif = "https://coyotecody.net/images/flourish.gif";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jellyfin Status</title>
    
    <meta property="og:title" content="<?php echo $status_title; ?>">
    <meta property="og:description" content="Live status check for coyotecody.net">
    <meta property="og:image" content="<?php echo $embed_gif; ?>">
    <meta name="theme-color" content="#aa5ccc">

    <link rel="stylesheet" type="text/css" href="./style.css?nocache123">
</head>
<body>
    <div style="padding: 20px;">
        <div id="status_container">
            <img id="status_gif" src="" style="display: none; max-width: 300px; margin-bottom: 10px;">
            <p id="status_text" style="color: white; font-weight: bold; font-family: sans-serif;">Checking...</p>
        </div>
        <button class="button" onclick="location.href='./index.html'">mmmmrowww (back)</button>
    </div>

    <script>
        // YOUR METHOD: The only one we trust
        const imgUrl = "https://media.coyotecody.net/web/banner-light.b113d4d1c6c07fcb73f0.png";
        const testImg = new Image();
        const gifEl = document.getElementById('status_gif');
        const textEl = document.getElementById('status_text');

        testImg.onload = () => {
            gifEl.src = "./images/flourish.gif";
            gifEl.style.display = "block";
            textEl.textContent = "jelly flourish";
            textEl.style.color = "#16a34a"; // Green
        };

        testImg.onerror = () => {
            gifEl.src = "./images/jellykill.gif";
            gifEl.style.display = "block";
            textEl.textContent = "jellykill";
            textEl.style.color = "#dc2626"; // Red
        };

        testImg.src = imgUrl + "?rand=" + Date.now();
    </script>
</body>
</html>
