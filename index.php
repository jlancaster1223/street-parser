<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street Parser</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <section class="uploadform">
        <div class="container">
            <div class="row">
                <div
                    class="col col-lg-4 uploadform__steps border-end border-dark-subtle d-flex flex-column justify-content-center border-right">
                    <div class="uploadform__steps__step isactive" data-step="1">
                        <div class="stepper__icon">
                            1
                        </div>
                        <div class="stepper__content">
                            <div class="stepper__content__title">Upload</div>
                            <div class="stepper__content__content">
                                <em>
                                    Upload your CSV
                                </em>
                            </div>
                        </div>
                    </div>
                    <div class="uploadform__steps__step" data-step="2">
                        <div class="stepper__icon">
                            2
                        </div>
                        <div class="stepper__content">
                            <div class="stepper__content__title">Complete</div>
                            <div class="stepper__content__content">
                                <em>
                                    View your parsed data
                                </em>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-8 uploadform__panels">
                    <div class="uploadform__panels__panel isactive" data-step="1">
                        <div class="file-upload-wrapper">
                            <label class="file-upload-box mb-0">
                                <input type="file" class="file-upload-input" multiple>
                                <div class="upload-content">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <h5 class="mb-2">Drag & Drop files here</h5>
                                    <p class="text-muted mb-0">or click to browse</p>
                                </div>
                            </label>
                            <div class="file-list">
                                <!-- Files will be listed here -->
                            </div>
                        </div>

                        <!-- Upload button -->
                        <button class="btn btn-primary mt-3" id="upload-button">Upload</button>
                    </div>
                    <div class="uploadform__panels__panel" data-step="2">
                        <div class="alert alert-success" role="alert">
                            Your file has been successfully uploaded!
                        </div>
                        <div class="parsed-data">
                            <!-- Parsed data will be displayed here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<style>
    .uploadform__steps__step,
    .uploadform__panels__panel.isactive {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .uploadform__panels__panel {
        display: none;
    }

    .uploadform__steps__step.isactive {
        opacity: 1;
    }

    .stepper__icon {
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        background: orange;
        border-radius: 10px;
        color: white;
        font-weight: bold;
        aspect-ratio: 1;
        margin-right: 10px;
    }

    .stepper__content__title {
        font-weight: bold;
    }

    .uploadform__panels {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .uploadform__panels__panel.isactive {
        width: 100%;
    }

    .file-upload-wrapper {
        width: 100%;
    }


    /* Upload form */
    .file-upload-box {
        position: relative;
        padding: 2rem;
        text-align: center;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
        cursor: pointer;
        width: 100%;
    }

    .file-upload-box:hover {
        background-color: #e9ecef;
        border-color: #adb5bd;
    }

    .file-upload-input {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 1;
    }

    .upload-content {
        position: relative;
        z-index: 0;
    }

    .upload-icon {
        font-size: 2.5rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .file-list {
        margin-top: 1.5rem;
    }

    .file-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        background-color: white;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        margin-bottom: 0.5rem;
        transition: all 0.2s ease;
    }

    .file-item:hover {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .file-icon {
        color: #6c757d;
        margin-right: 0.75rem;
        font-size: 1.25rem;
    }

    .file-name {
        flex-grow: 1;
        color: #495057;
        text-decoration: none;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-right: 1rem;
    }

    .file-name:hover {
        color: #007bff;
        text-decoration: none;
    }

    .remove-file {
        color: #dc3545;
        cursor: pointer;
        padding: 0.25rem 0.5rem;
        font-size: 1.25rem;
        transition: color 0.2s ease;
        flex-shrink: 0;
    }

    .remove-file:hover {
        color: #c82333;
    }

    .drag-over {
        background-color: #e9ecef;
        border-color: #007bff;
    }

    /* Add loading animation */
    @keyframes upload-progress {
        0% {
            width: 0%;
        }

        100% {
            width: 100%;
        }
    }

    .upload-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        background-color: #007bff;
        animation: upload-progress 1s ease-in-out;
    }

    section.uploadform {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 0 10px 10px rgba(0, 0, 0, 0.1);
    }

    .uploadform__panels__panel.isactive {
        flex-direction: column;
    }
    .parsed-data {
    height: 400px;
    overflow-y: scroll;
    background: white;
    border-radius: 20px;
    padding: 20px;
    width: 100%;
}
</style>

<!-- jQuery cdn -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    jQuery(document).ready(function ($) {
        const fileUploadBox = $('.file-upload-box');
        const fileList = $('.file-list');
        const fileInput = $('.file-upload-input');

        // Handle drag and drop events
        fileUploadBox
            .on('dragover dragenter', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).addClass('drag-over');
            })
            .on('dragleave dragend drop', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass('drag-over');
            });

        // Handle file selection
        fileInput.on('change', function (e) {
            const files = e.target.files;
            handleFiles(files);
        });

        // Handle dropped files
        fileUploadBox.on('drop', function (e) {
            const files = e.originalEvent.dataTransfer.files;
            handleFiles(files);
        });

        function handleFiles(files) {
            Array.from(files).forEach(file => {
                // Create progress bar element
                const progressBar = $('<div class="upload-progress"></div>');

                const fileItem = $(`
                        <div class="file-item">
                            <i class="fas fa-file file-icon"></i>
                            <span class="file-name" title="${file.name}">${file.name}</span>
                            <i class="fas fa-times remove-file"></i>
                            ${progressBar.prop('outerHTML')}
                        </div>
                    `);

                fileList.append(fileItem);

                // Remove progress bar after animation
                setTimeout(() => {
                    fileItem.find('.upload-progress').remove();
                }, 1000);

                // Handle file removal
                fileItem.find('.remove-file').on('click', function (e) {
                    e.stopPropagation();
                    fileItem.fadeOut(300, function () {
                        $(this).remove();
                    });
                });

                // Get appropriate FontAwesome icon based on file type
                const fileIcon = fileItem.find('.file-icon');
                const fileExtension = file.name.split('.').pop().toLowerCase();

                const iconMap = {
                    'pdf': 'fa-file-pdf',
                    'doc': 'fa-file-word',
                    'docx': 'fa-file-word',
                    'xls': 'fa-file-excel',
                    'xlsx': 'fa-file-excel',
                    'ppt': 'fa-file-powerpoint',
                    'pptx': 'fa-file-powerpoint',
                    'jpg': 'fa-file-image',
                    'jpeg': 'fa-file-image',
                    'png': 'fa-file-image',
                    'gif': 'fa-file-image',
                    'zip': 'fa-file-archive',
                    'rar': 'fa-file-archive',
                    'txt': 'fa-file-alt'
                };

                if (iconMap[fileExtension]) {
                    fileIcon.removeClass('fa-file').addClass(iconMap[fileExtension]);
                }
            });
        }

        // Handle upload button click
        // Post it to the HomeownerParser class
        $('#upload-button').on('click', function () {
            const files = fileInput[0].files;
            if (files.length === 0) {
                alert('Please select a file to upload.');
                return;
            }

            const formData = new FormData();
            Array.from(files).forEach(file => {
                formData.append('files[]', file);
            });

            var data = {
                action: 'parseData',
                files: formData
            };
            // Encode it
            formData.append('data', JSON.stringify(data));

            $.ajax({
                url: '/street/endpoint.php', // Change this to your server endpoint
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Handle success response
                    console.log(response);
                    $('.uploadform__steps__step.isactive').removeClass('isactive');
                    $('.uploadform__panels__panel.isactive').removeClass('isactive');
                    $('.uploadform__steps__step[data-step="2"]').addClass('isactive');
                    $('.uploadform__panels__panel[data-step="2"]').addClass('isactive');
                    $('.parsed-data').html('<code>' + response + '</code>');
                },
                error: function (error) {
                    // Handle error response
                    console.error(error);
                }
            });
        });
    });
</script>
