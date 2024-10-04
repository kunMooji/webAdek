$(document).ready(function() {
    // Load content on page load
    loadContent();

    // Handle form submission
    $('#contentForm').on('submit', function(e) {
        e.preventDefault();
        updateContent();
    });

    // Preview image on file selection
    $('#hero_image, #about_image').on('change', function(e) {
        previewImage(this);
    });
});

function loadContent() {
    $.ajax({
        url: 'get_content.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#hero_title').val(data.hero_title);
            $('#hero_cta').val(data.hero_cta);
            $('#about_title').val(data.about_title);
            $('#about_description').val(data.about_description);
            $('#android_download').val(data.android_download);
            $('#ios_download').val(data.ios_download);

            if (data.hero_image) {
                $('#hero_image_preview').html(`<img src="data:image/jpeg;base64,${data.hero_image}" alt="Hero Image" style="max-width: 200px;">`);
            }
            if (data.about_image) {
                $('#about_image_preview').html(`<img src="data:image/jpeg;base64,${data.about_image}" alt="About Image" style="max-width: 200px;">`);
            }
        },
        error: function(xhr, status, error) {
            $('#message').html(`<p style="color: red;">Error loading content: ${error}</p>`);
        }
    });
}

function updateContent() {
    var formData = new FormData($('#contentForm')[0]);

    $.ajax({
        url: 'update_content.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.message) {
                $('#message').html(`<p style="color: green;">${response.message}</p>`);
                loadContent(); // Reload content after successful update
            } else if (response.error) {
                $('#message').html(`<p style="color: red;">${response.error}</p>`);
            }
        },
        error: function(xhr, status, error) {
            $('#message').html(`<p style="color: red;">Error updating content: ${error}</p>`);
        }
    });
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(`#${input.id}_preview`).html(`<img src="${e.target.result}" alt="Image Preview" style="max-width: 200px;">`);
        };
        reader.readAsDataURL(input.files[0]);
    }
}