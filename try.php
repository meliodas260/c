<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer with Single and All Page View</title>
    <style>
        body { font-family: Arial, sans-serif; }
        #pdf-container { text-align: center; margin: 20px; }
        canvas { border: 1px solid #ddd; margin-bottom: 10px; }
        #page-controls { margin: 10px 0; }
        #page-jump { margin-top: 10px; }
        #all-pages-view { display: none; } /* Initially hidden */
    </style>
</head>
<body>
    <div id="pdf-container">
        <div>
            <button id="view-one-page">View One Page</button>
            <button id="view-all-pages">View All Pages</button>
        </div>

        <!-- Single Page View -->
        <div id="single-page-view">
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

        <!-- All Pages View -->
        <div id="all-pages-view"></div>
    </div>

    <!-- Hidden PHP variable for filename -->
    <input type="hidden" id="phpVar" value="<?php echo htmlspecialchars(isset($_GET['FILE']) ? $_GET['FILE'] : '', ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Load PDF.js and set GlobalWorkerOptions -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script>
        // Initialize pdf.js worker
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        const FileNjs = encodeURIComponent($('#phpVar').val());
        const url = "pdfs/" + FileNjs;

        let pdfDoc = null;
        let pageNum = 1;
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

        // Render a single page
        function renderPage(num) {
            pdfDoc.getPage(num).then(page => {
                const viewport = page.getViewport({ scale });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                page.render(renderContext).promise.then(() => {
                    document.getElementById('page-number').textContent = `Page ${num}`;
                });
            });
        }

        // Render all pages
        function renderAllPages() {
            const allPagesContainer = document.getElementById('all-pages-view');
            allPagesContainer.innerHTML = ''; // Clear previous content

            for (let i = 1; i <= pdfDoc.numPages; i++) {
                pdfDoc.getPage(i).then(page => {
                    const viewport = page.getViewport({ scale });
                    const pageCanvas = document.createElement('canvas');
                    pageCanvas.width = viewport.width;
                    pageCanvas.height = viewport.height;
                    const context = pageCanvas.getContext('2d');

                    page.render({ canvasContext: context, viewport: viewport }).promise.then(() => {
                        allPagesContainer.appendChild(pageCanvas);
                    });
                });
            }
        }

        // Show single-page view
        document.getElementById('view-one-page').addEventListener('click', () => {
            document.getElementById('single-page-view').style.display = 'block';
            document.getElementById('all-pages-view').style.display = 'none';
        });

        // Show all-pages view
        document.getElementById('view-all-pages').addEventListener('click', () => {
            document.getElementById('single-page-view').style.display = 'none';
            document.getElementById('all-pages-view').style.display = 'block';
            renderAllPages();
        });

        // Navigate pages in single-page view
        document.getElementById('prev-page').addEventListener('click', () => {
            if (pageNum > 1) {
                pageNum--;
                renderPage(pageNum);
            }
        });

        document.getElementById('next-page').addEventListener('click', () => {
            if (pageNum < pdfDoc.numPages) {
                pageNum++;
                renderPage(pageNum);
            }
        });

        // Jump to specific page
        document.getElementById('jump-to-page').addEventListener('click', () => {
            const page = parseInt(document.getElementById('page-input').value, 10);
            if (page >= 1 && page <= pdfDoc.numPages) {
                pageNum = page;
                renderPage(pageNum);
            } else {
                alert(`Please enter a valid page number between 1 and ${pdfDoc.numPages}.`);
            }
        });
    </script>
</body>
</html>
