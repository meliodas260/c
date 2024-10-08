<?php
// Check if the download button is clicked
if (isset($_POST['download'])) {
    // Path to the file you want to download
    $file = 'pdfs/20240925150013.pdf'; // Update this with the path of your file

    // Check if the file exists
    if (file_exists($file)) {
        // Set headers for the file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        // Clear output buffer and read the file
        ob_clean();
        flush();
        readfile($file);

        exit;
    } else {
        echo "File not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download File</title>
</head>
<body>
    <h2>Download PDF File</h2>
    <form method="POST">
        <button type="submit" name="download">Download</button>
    </form>
</body>
</html>
