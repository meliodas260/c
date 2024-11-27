
    <!DOCTYPE html>
<html>
    
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/custom2.css" rel="stylesheet"> 
    <link href="css/sidebar.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>PDF File Upload</title>
    <style>
        .research-fullview {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 30px;
            margin: 20px auto;
            max-width: 800px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .research-title {
            font-size: 2.2em;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .research-year,
        .research-description,
        .research-researchers,
        .research-panels,
        .research-tags,
        .research-keywords {
            font-size: 1.1em;
            margin: 12px 0;
            color: #555;
        }

        .research-title,
        .research-year,
        .research-description,
        .research-researchers {
            font-weight: bold;
        }

        .research-fullview p {
            line-height: 1.6;
        }
    </style>
</head>
<body>
<?php include 'modal/header.php'; ?>
<div class="content">
    <div class="sidebar">
        <?php  include 'modal/adminSidebar.php'; ?>
    </div>
    <div class="main-content">

    <div class="container mt-5">

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
                            <div class="research-fullview">
                                <h4>Research Details</h4>
                                <br>

                                <h2 class="research-title">${research.Title}</h2>
                                <p class="research-year"><strong>Year:</strong> ${research.Year || 'N/A'}</p>
                                <p class="research-description"><strong>Description:</strong> ${research.Description || 'No description'}</p>
                                <p class="research-file"><strong>File Name:</strong> ${research.FILE || 'No File Uploaded Yet'}</p>
                                <p class="research-researchers"><strong>Researchers:</strong> ${researchers}</p>
                                <p class="research-panels"><strong>Panels:</strong> ${Panels}</p>
                                <p class="research-tags"><strong>Tags:</strong> ${tags}</p>
                                <p class="research-keywords"><strong>Keywords:</strong> ${keywords}</p>
                                <img src="${research.ImageUrl === '' ? 'img/neust_logo.png' : 'UploadIMG/'+ research.ImageUrl}" alt="Image" class="img-fluid">
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

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pdfUploadModal">Upload Research File</button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imageUploadModal">Upload Image</button>
            </div>
        </div>
    </div>
    <br><br>
    <!-- PDF Upload Modal -->
    <div class="modal fade" id="pdfUploadModal" tabindex="-1" aria-labelledby="pdfUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfUploadModalLabel">Research File Upload</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="backend/fileuploadAPI.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="ResearchID" name="ResearchID" value="<?php echo $researchID; ?>">
                        <div class="mb-3">
                            <label for="pdfFile" class="form-label">Select PDF to upload:</label>
                            <input type="file" class="form-control" name="pdfFile" accept=".pdf" id="pdfFile" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Upload Modal -->
    <div class="modal fade" id="imageUploadModal" tabindex="-1" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageUploadModalLabel">Upload Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="ResearchID" name="ResearchID" value="<?php echo $researchID; ?>">
                        <div class="mb-3">
                            <label for="fileToUpload" class="form-label">Select image to upload:</label>
                            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png" required>
                        </div>
                        <button type="submit" class="btn btn-secondary w-100" name="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
