<?php
// 1. THE DEEP CHECK
// We check the specific banner image. If the service is down, this will fail.
$check_url = 'https://media.coyotecody.net/web/banner-light.b113d4d1c6c07fcb73f0.png';
$context = stream_context_create(['http' => ['timeout' => 2, 'ignore_errors' => true]]);
$headers = @get_headers($check_url, 0, $context);

// Only '200 OK' counts as UP
$is_up = ($headers && strpos($headers[0], '200') !== false);

// 2. EMBED SETTINGS
$status_title = $is_up ? "Jellyfin is UP" : "Jellyfin is DOWN";
$status_desc  = $is_up ? "jelly flourish" : "jellykill";
$theme_color  = $is_up ? "#aa5ccc" : "#ff4c4c";

// Discord absolute URLs
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
    <link rel="stylesheet" type="text/css" href="./style.css?nocache123">
</head>
<body>
    <div style="padding: 20px;">
        <div id="status_container">
            <img id="status_gif" src="./images/<?php echo $is_up ? 'flourish.gif' : 'jellykill.gif'; ?>" style="display: block; max-width: 300px; margin-bottom: 10px;">
            <p id="status_text" style="color: white; font-weight: bold;">
                <?php echo $status_desc; ?>
            </p>
        </div>
        <button class="button" onclick="location.href='./index.html'">mmmmrowww (back)</button>
    </div>

    <script>
        // Use your working JS logic to confirm on-page
        const imgUrl = "<?php echo $check_url; ?>";
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
