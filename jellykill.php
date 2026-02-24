<?php
// 1. DISCORD EMBED LOGIC (PHP)
$check_url = 'https://media.coyotecody.net/web/banner-light.b113d4d1c6c07fcb73f0.png';
$context = stream_context_create(['http' => ['timeout' => 2]]);
$headers = @get_headers($check_url, 0, $context);
$is_up_guess = ($headers && strpos($headers[0], '200') !== false);

$status_title = $is_up_guess ? "Jellyfin is UP" : "Jellyfin is DOWN";
$embed_gif = $is_up_guess ? "https://coyotecody.net/images/flourish.gif" : "https://coyotecody.net/images/jellykill.gif";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $status_title; ?></title>
    
    <meta property="og:title" content="<?php echo $status_title; ?>">
    <meta property="og:image" content="<?php echo $embed_gif; ?>">
    <meta property="og:description" content="Live status check">
    <meta name="theme-color" content="<?php echo $is_up_guess ? '#aa5ccc' : '#ff4c4c'; ?>">

    <link rel="stylesheet" type="text/css" href="./style.css?nocache123">
</head>
<body>
    <div style="padding: 20px;">
        <div id="status_container">
            <img id="status_gif" src="./images/flourish.gif" style="display: none; max-width: 300px;">
            <p id="status_text" style="color: white; font-weight: bold;">Checking...</p>
        </div>

        <button class="button" onclick="location.href='./index.html'">mmmmrowww (back)</button>
    </div>

    <script>
        // Use your JS logic to perform the REAL check on page load
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
