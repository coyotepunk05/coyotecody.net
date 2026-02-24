<?php
// 1. THE CHECK (PHP Source of Truth)
$host = 'media.coyotecody.net';
$port = 443;
$timeout = 2;

$fp = @fsockopen($host, $port, $errno, $errstr, $timeout);
$is_up = ($fp !== false);
if ($fp) fclose($fp);

// 2. EMBED SETTINGS
// We use absolute URLs to ensure Discord can find the files
$status_title = $is_up ? "Jellyfin is UP" : "Jellyfin is DOWN";
$status_desc  = $is_up ? "jelly flourish" : "jellykill";
$theme_color  = $is_up ? "#aa5ccc" : "#ff4c4c"; // Purple vs Red

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
    <meta property="og:description" content="<?php echo $status_desc; ?>">
    <meta property="og:image" content="<?php echo $embed_gif; ?>">
    <meta name="theme-color" content="<?php echo $theme_color; ?>">
    <meta property="og:type" content="website">

    <link rel="stylesheet" type="text/css" href="./style.css?nocache123">
</head>
<body>
    <div style="padding: 20px;">
        <div id="status_container">
            <img id="status_gif" src="./images/<?php echo $is_up ? 'flourish.gif' : 'jellykill.gif'; ?>" style="display: block; max-width: 300px; margin-bottom: 10px;">
            <p id="status_text" style="color: white; font-weight: bold; font-family: sans-serif;">
                <?php echo $status_desc; ?>
            </p>
        </div>
        <button class="button" onclick="location.href='./index.html'">mmmmrowww (back)</button>
    </div>

    <script>
        // JS remains as a live backup if the user stays on the page
        const imgUrl = "https://media.coyotecody.net/web/banner-light.b113d4d1c6c07fcb73f0.png";
        const testImg = new Image();
        
        testImg.onerror = () => {
            document.getElementById('status_gif').src = "./images/jellykill.gif";
            document.getElementById('status_text').textContent = "jellykill";
            document.getElementById('status_text').style.color = "#dc2626";
        };
        testImg.src = imgUrl + "?rand=" + Date.now();
    </script>
</body>
</html>
