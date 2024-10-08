<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF.js Viewer with Page Jump</title>
    <style>
        body { font-family: Arial, sans-serif; }
        #pdf-container { text-align: center; margin: 20px; }
        canvas { border: 1px solid #ddd; }
        #page-controls { margin: 10px 0; }
        #page-jump { margin-top: 10px; }
    </style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
</head>
<body>
    <div id="pdf-container">
        <canvas id="pdf-render"></canvas>
        <div id="page-controls">
            <button id="prev-page">Previous</button>
            <span id="page-number">Page 1</span>
            <button id="next-page">Next</button>
        </div>
        <div id="page-jump">
            <input type="number" id="page-input" min="1" />
            <button id="jump-to-page">Go to Page</button>
        </div>
    </div>
    <?php
// Get the filename from the URL query parameter, ensuring it's properly encoded
$FILEN = isset($_GET['FILE']) ? $_GET['FILE'] : '';
?>

<!-- Hidden input to hold the filename -->
<input type="hidden" id="phpVar" value="<?php echo htmlspecialchars($FILEN, ENT_QUOTES, 'UTF-8'); ?>">

    <script>
        const FileNjs = $('#phpVar').val();

    const url = "pdfs/"+FileNjs; // Replace with the path to your PDF
        const pdfjsLib = window['pdfjs-dist/build/pdf'];

        let pdfDoc = null;
        let pageNum = 1;
        let pageIsRendering = false;
        let pageNumIsPending = null;

        const scale = 1.5;
        const canvas = document.getElementById('pdf-render');
        const ctx = canvas.getContext('2d');

        // Load the PDF document
        pdfjsLib.getDocument(url).promise.then(pdf => {
            pdfDoc = pdf;
            renderPage(pageNum);
        }).catch(error => {
            console.error('Error loading PDF:', error);
        });

        // Render the page
        function renderPage(num) {
            pageIsRendering = true;

            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({ scale });

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                page.render(renderContext).promise.then(() => {
                    pageIsRendering = false;

                    if (pageNumIsPending !== null) {
                        renderPage(pageNumIsPending);
                        pageNumIsPending = null;
                    }

                    document.getElementById('page-number').textContent = `Page ${num}`;
                }).catch(error => {
                    console.error('Error rendering page:', error);
                });
            });
        }

        // Show prev page
        document.getElementById('prev-page').addEventListener('click', () => {
            if (pageNum <= 1) return;
            pageNum--;
            renderPage(pageNum);
        });

        // Show next page
        document.getElementById('next-page').addEventListener('click', () => {
            if (pageNum >= pdfDoc.numPages) return;
            pageNum++;
            renderPage(pageNum);
        });

        // Jump to a specific page
        document.getElementById('jump-to-page').addEventListener('click', () => {
            const input = document.getElementById('page-input').value;
            const page = parseInt(input, 10);

            if (!isNaN(page) && page >= 1 && page <= pdfDoc.numPages) {
                pageNum = page;
                renderPage(pageNum);
            } else {
                alert(`Please enter a valid page number between 1 and ${pdfDoc.numPages}.`);
            }
        });
    </script>
</body>
</html>
