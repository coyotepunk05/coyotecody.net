function set_status(el, status, url) {
    const urlObj = new URL(url);
    const hostname = urlObj.hostname;
    const baseUrl = `${urlObj.protocol}//${hostname}`; // Extracts the homepage URL

    // Clear the "Checking..." text
    el.textContent = status ? "🟢 " : "🔴 ";

    // Create the hyperlink
    const link = document.createElement("a");
    link.href = baseUrl;
    link.textContent = hostname;
    link.target = "_blank"; // Opens in a new tab
    link.style.color = status ? "#16a34a" : "#dc2626";
    link.style.textDecoration = "none"; // Optional: removes underline

    // Add " is up/down" after the link
    const statusText = document.createTextNode(status ? " is up" : " is down");

    el.appendChild(link);
    el.appendChild(statusText);
    el.style.fontWeight = "bold";
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('p.site_status').forEach(el => {
        const imgUrl = el.getAttribute('data-url');
        const img = document.createElement("img");
        img.src = imgUrl + "?rand=" + Math.random();
        img.onload = () => set_status(el, true, imgUrl);
        img.onerror = () => set_status(el, false, imgUrl);
        img.style.display = "none";
        document.body.appendChild(img);
    });
});
