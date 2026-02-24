<?php
// 1. The "Check": See if the Jellyfin banner is reachable
$check_url = 'https://jellyfin.olgi.net/web/banner-light.b113d4d1c6c07fcb73f0.png';
$headers = @get_headers($check_url);
$is_up = ($headers && strpos($headers[0], '200') !== false);

// 2. Set variables based on status
$status_title = $is_up ? "Jellyfin is UP" : "Jellyfin is DOWN";
$status_desc  = $is_up ? "jelly flourish" : "jellykill";
$status_gif   = $is_up 
    ? "https://media.discordapp.net/attachments/883081538596642826/1375096957374038186/attachment.gif" 
    : "https://media.discordapp.net/attachments/883081538596642826/1374210725496488017/attachment.gif";
$theme_color  = $is_up ? "#52AD5B" : "#FF4C4C";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $status_title; ?></title>

    <meta property="og:title" content="<?php echo $status_title; ?>">
    <meta property="og:description" content="<?php echo $status_desc; ?>">
    <meta property="og:image" content="<?php echo $status_gif; ?>">
    <meta name="theme-color" content="<?php echo $theme_color; ?>">
    <meta property="og:type" content="website">

    <link rel="stylesheet" type="text/css" href="./style.css?nocache123">
</head>
<body>
    <p id="status">
        <img src="<?php echo $status_gif; ?>" alt="<?php echo $status_desc; ?>">
        <br>
        <?php echo $status_desc; ?>
    </p>

    <button class="button" onclick="location.href='./index.html'">mmmmrowww (back)</button>
</body>
</html>
