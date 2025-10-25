<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Preview</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .resume-preview {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .section {
            margin-bottom: 1.5rem;
        }
        .section-title {
            border-bottom: 2px solid #007bff;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
        .preview-actions {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="resume-preview">
        <h1 class="text-center mb-4">Resume Preview</h1>
        
        <!-- Personal Information -->
        <div class="section">
            <h2 class="section-title">Personal Information</h2>
            <p><strong>Name:</strong> <span id="preview-name"></span></p>
            <p><strong>Email:</strong> <span id="preview-email"></span></p>
            <p><strong>Phone:</strong> <span id="preview-phone"></span></p>
        </div>

        <!-- Education -->
        <div class="section">
            <h2 class="section-title">Education</h2>
            <div id="preview-education"></div>
        </div>

        <!-- Skills & Certifications -->
        <div class="section">
            <h2 class="section-title">Skills & Certifications</h2>
            <div id="preview-skills"></div>
        </div>

        <!-- Projects -->
        <div class="section">
            <h2 class="section-title">Projects</h2>
            <div id="preview-projects"></div>
        </div>
    </div>

    <div class="preview-actions">
        <button onclick="window.print()" class="btn btn-primary">Print Resume</button>
        <button onclick="window.close()" class="btn btn-secondary">Close Preview</button>
    </div>

    <script>
        // Populate preview with sessionStorage data
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('preview-name').textContent = sessionStorage.getItem('fullname');
            document.getElementById('preview-email').textContent = sessionStorage.getItem('mailid');
            document.getElementById('preview-phone').textContent = sessionStorage.getItem('mobno');

            // Populate education section
            let educationHTML = '';
            if (sessionStorage.getItem('degree_type')) {
                educationHTML += `<p><strong>${sessionStorage.getItem('degree_type')}</strong><br>
                    ${sessionStorage.getItem('university')}<br>
                    ${sessionStorage.getItem('college')}</p>`;
            }
            document.getElementById('preview-education').innerHTML = educationHTML;

            // Populate skills section
            let skillsHTML = sessionStorage.getItem('know') ? `<p>${sessionStorage.getItem('know')}</p>` : '';
            document.getElementById('preview-skills').innerHTML = skillsHTML;

            // Populate projects section
            let projectsHTML = '';
            if (sessionStorage.getItem('beproj')) {
                projectsHTML += `<p><strong>Final Year Project:</strong> ${sessionStorage.getItem('beproj')}</p>`;
            }
            document.getElementById('preview-projects').innerHTML = projectsHTML;
        });
    </script>
</body>
</html>