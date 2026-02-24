<?php
// 1. The "Check": See if the Jellyfin banner is reachable
$check_url = 'https://media.coyotecody.net/web/banner-light.b113d4d1c6c07fcb73f0.png';
$context = stream_context_create(['http' => ['timeout' => 3]]);
$headers = @get_headers($check_url, 0, $context);
$is_up = ($headers && strpos($headers[0], '200') !== false);

// 2. Set variables based on status
$status_title = $is_up ? "Jellyfin is UP" : "Jellyfin is DOWN";
$status_desc  = $is_up ? "jelly flourish" : "jellykill";

// Local paths to your images in the \images folder
$status_gif   = $is_up ? "./images/flourish.gif" : "./images/jellykill.gif";

// Absolute URL for the Discord Embed
$embed_gif    = $is_up 
    ? "https://coyotecody.net/images/flourish.gif" 
    : "https://coyotecody.net/images/jellykill.gif";

$theme_color  = $is_up ? "#aa5ccc" : "#ff4c4c";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $status_title; ?></title>

    <meta property="og:title" content="<?php echo $status_title; ?>">
    <meta property="og:description" content="<?php echo $status_desc; ?>">
    <meta property="og:image" content="<?php echo $embed_gif; ?>">
    <meta name="theme-color" content="<?php echo $theme_color; ?>">
    <meta property="og:type" content="website">

    <link rel="stylesheet" type="text/css" href="./style.css?nocache123">
</head>
<body>
    <div style="padding: 20px;">
        <div id="status">
            <img src="<?php echo $status_gif; ?>" alt="" style="display: block; max-width: 300px; margin-bottom: 10px;">
            <p style="color: white; font-weight: bold; font-family: sans-serif;">
                <?php echo $status_desc; ?>
            </p>
        </div>

        <button class="button" onclick="location.href='./index.html'">mmmmrowww (back)</button>
    </div>
</body>
</html>
