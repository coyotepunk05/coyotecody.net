<?php
/**
 * Using your exact logic: If the image can't be fetched, the site is down.
 */
$imgUrl = 'https://media.coyotecody.net/web/banner-light.b113d4d1c6c07fcb73f0.png';

// PHP's version of your "img.onload" - checking for a successful 200 OK
$context = stream_context_create(['http' => ['timeout' => 2, 'ignore_errors' => true]]);
$headers = @get_headers($imgUrl, 0, $context);
$is_up = ($headers && strpos($headers[0], '200') !== false);

// Discord Embed Data
$status_title = $is_up ? "Jellyfin is UP" : "Jellyfin is DOWN";
$status_desc  = $is_up ? "jelly flourish" : "jellykill";
$theme_color  = $is_up ? "#aa5ccc" : "#ff4c4c";
$embed_gif    = $is_up ? "https://coyotecody.net/images/flourish.gif" : "https://coyotecody.net/images/jellykill.gif";
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
            <img id="status_gif" src="./images/<?php echo $is_up ? 'flourish.gif' : 'jellykill.gif'; ?>" alt="" style="display: block; max-width: 300px; margin-bottom: 10px;">
            <p id="status_text" style="color: white; font-weight: bold; font-family: sans-serif;">
                <?php echo $status_desc; ?>
            </p>
        </div>
        <button class="button" onclick="location.href='./index.html'">mmmmrowww (back)</button>
    </div>

    <script>
        /** * Your Original Logic: 
         * Re-verifies in the browser to ensure the user sees the real-time truth.
         */
        const testImg = new Image();
        testImg.onload = () => {
            console.log("Jellyfin reached successfully.");
        };
        testImg.onerror = () => {
            // If browser fails, override the PHP guess immediately
            document.getElementById('status_gif').src = "./images/jellykill.gif";
            const text = document.getElementById('status_text');
            text.textContent = "jellykill";
            text.style.color = "#dc2626";
        };
        testImg.src = "<?php echo $imgUrl; ?>?rand=" + Date.now();
    </script>
</body>
</html>
