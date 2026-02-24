<?php
$imgUrl = "https://media.coyotecody.net/web/banner-light.b113d4d1c6c07fcb73f0.png";

$ch = curl_init($imgUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 5,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RANGE          => "0-7", // only grab the first 8 bytes
]);
$data = curl_exec($ch);
curl_close($ch);

// Real PNG files always start with these exact bytes
$isUp = (substr($data, 0, 4) === "\x89PNG");

$status_title      = "Jellyfin Status Check";
$embed_description = $isUp ? "✅ Jellyfin is up!" : "❌ Jellyfin is down!";
$embed_gif         = $isUp ? "https://coyotecody.net/images/flourish.gif" : "https://coyotecody.net/images/jellykill.gif";
$embed_color       = $isUp ? "#16a34a" : "#dc2626";
$status_text       = $isUp ? "jelly flourish" : "jellykill";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jellyfin Status</title>
    <meta property="og:title" content="<?php echo $status_title; ?>">
    <meta property="og:description" content="<?php echo $embed_description; ?>">
    <meta property="og:image" content="<?php echo $embed_gif; ?>">
    <meta name="theme-color" content="#aa5ccc">
    <link rel="stylesheet" type="text/css" href="./style.css?nocache123">
</head>
<body>
    <div style="padding: 20px;">
        <div id="status_container">
            <img src="<?php echo $embed_gif; ?>" style="max-width: 300px; margin-bottom: 10px;">
            <p style="color: <?php echo $embed_color; ?>; font-weight: bold; font-family: sans-serif;">
                <?php echo $status_text; ?>
            </p>
        </div>
        <button class="button" onclick="location.href='./index.html'">mmmmrowww (back)</button>
    </div>
</body>
</html>
