jQuery(document).ready(function($) {
    $('#generate_meta_button').on('click', function() {
        var postTitle = $('#title').val();
        var postExcerpt = $('#excerpt').val();

        if (postTitle && postExcerpt) {
            $.ajax({
                url: ajaxurl,
                method: 'POST',
                data: {
                    action: 'generate_meta',
                    post_title: postTitle,
                    post_excerpt: postExcerpt
                },
                success: function(response) {
                    if (response.success) {
                        $('#aimg_meta_title').val(response.data.meta_title);
                        $('#aimg_meta_description').val(response.data.meta_description);
                    } else {
                        alert('Error: ' + response.data.message);
                    }
                },
                error: function() {
                    alert('An error occurred.');
                }
            });
        } else {
            alert('Please fill out the post title and excerpt.');
        }
    });
});
