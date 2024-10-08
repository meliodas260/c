
    <!DOCTYPE html>
<html>
    
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>PDF File Upload</title>
</head>
<body>

<?php   include 'modal/header.php'; 
        include 'modal/ResearcherSidebar.php';
        ?>
<div class="container mt-5">
    <h1>Research Details</h1>

    <!-- Div to display research details -->
    <div id="researchDetails" class="mt-4"></div>
</div>

<?php
    // Capture secID and researchID from URL parameters (GET request)
    $secID = isset($_GET['secID']) ? $_GET['secID'] : null;
    $researchID = isset($_GET['researchID']) ? $_GET['researchID'] : null;
?>

<script>
$(document).ready(function() {
    const secID = <?php echo json_encode($secID); ?>;
    const researchID = <?php echo json_encode($researchID); ?>;  // Set the specific Research ID to display
    const url = `backend/Researchdata.php`; // Backend API endpoint

    // Fetch research data from the backend
    $.ajax({
        url: url,
        type: 'POST',
        data: { SecID: secID },
        dataType: 'json',  // Expect JSON response
        success: function(data) {
            if (data.error) {
                $('#researchDetails').html(`<div class="alert alert-danger">${data.error}</div>`);
            } else {
                // Search for the specific research entry with matching researchID
                const research = data.find(item => item.ID == researchID);

                if (research) {
                    let researchers = research.Researchers.map(res => `${res.name} (${res.role})`).join(', ');
                    let Panels = research.Panels.map(res => `${res.name} (${res.role})`).join(', ');
                    let tags = research.Tags.join(', ');
                    let keywords = research.Keywords.join(', ');

                    $('#researchDetails').html(`
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${research.Title}</h5>
                                <p><strong>Year:</strong> ${research.Year || 'N/A'}</p>
                                <p><strong>Description:</strong> ${research.Description || 'No description'}</p>
                                <p><strong>File Name:</strong> ${research.FILE || 'No File Uploaded Yet'}</p>
                                <p><strong>Researchers:</strong> ${researchers}</p>
                                <p><strong>Panels:</strong> ${Panels}</p>
                                <p><strong>Tags:</strong> ${tags}</p>
                                <p><strong>Keywords:</strong> ${keywords}</p>
                                <img src="UploadIMG/${research.ImageUrl || 'img/neust_logo.png'}" alt="Image" class="img-fluid">
                            </div>
                        </div>
                    `);
                } else {
                    $('#researchDetails').html('<div class="alert alert-warning">No research data available for this ID.</div>');
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#researchDetails').html(`<div class="alert alert-danger">Error: ${textStatus}</div>`);
        }
    });
});
</script>
<form action="backend/fileuploadAPI.php" method="post" enctype="multipart/form-data">
    <h3>Research file upload</h3><br>

    <div class="custom-file">
        <input type="hidden" id="ResearchID" name="ResearchID" value="<?php echo $researchID; ?>">
        <label for="file">Select PDF to upload:</label>
        <input type="file" class="custom-file-input" name="pdfFile" accept=".pdf" id="pdfFile"><br><br>
    </div>

    <button type="submit" class="btn btn-primary buttonclean" name="submit">Upload</button>
</form>
<form action="upload.php" method="post" enctype="multipart/form-data"> <h2>Upload Photo Form</h2>
    <input type="hidden" id="ResearchID" name="ResearchID" value="<?php echo $researchID; ?>">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
        <input type="submit" value="Upload Image" name="submit">
    </form>

</body>
</html>
