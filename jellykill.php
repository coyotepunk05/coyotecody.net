<?php
$status_title = "Jellyfin Status Check";

// Check the image server-side
$imgUrl = "https://media.coyotecody.net/web/banner-light.b113d4d1c6c07fcb73f0.png";

$headers = @get_headers($imgUrl);
$isUp = $headers && strpos($headers[0], '200') !== false;

// Now set embed values based on actual result
$embed_description = $isUp ? "✅ Jellyfin is up!" : "❌ Jellyfin is down!";
$embed_gif = $isUp
    ? "https://coyotecody.net/images/flourish.gif"
    : "https://coyotecody.net/images/jellykill.gif";
$embed_color = $isUp ? "#16a34a" : "#dc2626";
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
                <?php echo $embed_description; ?>
            </p>
        </div>
        <button class="button" onclick="location.href='./index.html'">mmmmrowww (back)</button>
    </div>
</body>
</html>
