function set_status(el, status, url) {
    const hostname = new URL(url).hostname;
    el.textContent = status ? `🟢 ${hostname} is up` : `🔴 ${hostname} is down`;
    el.style.color = status ? "#16a34a" : "#dc2626";
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
