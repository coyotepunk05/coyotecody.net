<?php
// 1. THE REAL CHECK: Try to open a connection to the domain/port
// We check media.coyotecody.net on port 443 (HTTPS)
$host = 'media.coyotecody.net';
$port = 443;
$timeout = 2; // Seconds

$fp = @fsockopen($host, $port, $errno, $errstr, $timeout);

if ($fp) {
    $is_up = true;
    fclose($fp);
} else {
    $is_up = false;
}

// 2. SET VARIABLES (Keep your existing absolute URLs for Discord)
$status_title = $is_up ? "Jellyfin is UP" : "Jellyfin is DOWN";
$status_desc  = $is_up ? "jelly flourish" : "jellykill";
$theme_color  = $is_up ? "#aa5ccc" : "#ff4c4c";

$embed_gif = $is_up 
    ? "https://coyotecody.net/images/flourish.gif" 
    : "https://coyotecody.net/images/jellykill.gif";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $status_title; ?></title>
    
    <meta property="og:title" content="<?php echo $status_title; ?>">
    <meta property="og:description" content="Live status check">
    <meta property="og:image" content="<?php echo $embed_gif; ?>">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="<?php echo $theme_color; ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?php echo $embed_gif; ?>">

    <link rel="stylesheet" type="text/css" href="./style.css?nocache123">
</head>
<body>
    <div style="padding: 20px;">
        <div id="status_container">
            <img id="status_gif" src="./images/flourish.gif" style="display: none; max-width: 300px;">
            <p id="status_text" style="color: white; font-weight: bold; font-family: sans-serif;">Checking...</p>
        </div>

        <button class="button" onclick="location.href='./index.html'">mmmmrowww (back)</button>
    </div>

    <script>
        const imgUrl = "<?php echo $check_url; ?>";
        const testImg = new Image();
        const statusGif = document.getElementById('status_gif');
        const statusText = document.getElementById('status_text');

        testImg.onload = () => {
            statusGif.src = "./images/flourish.gif?t=" + Date.now();
            statusGif.style.display = "block";
            statusText.textContent = "jelly flourish";
            statusText.style.color = "#16a34a";
        };

        testImg.onerror = () => {
            statusGif.src = "./images/jellykill.gif?t=" + Date.now();
            statusGif.style.display = "block";
            statusText.textContent = "jellykill";
            statusText.style.color = "#dc2626";
        };

        testImg.src = imgUrl + "?rand=" + Math.random();
    </script>
</body>
</html>
