jQuery(document).ready(function($) {
    $('#upload_profile_image_button').click(function(e) {
        e.preventDefault();

        var customUploader = wp.media({
            title: 'Choose Profile Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false
        });

        customUploader.on('select', function() {
            var attachment = customUploader.state().get('selection').first().toJSON();
            $('#profile_image').val(attachment.url);
            $('#profile_image_preview img').attr('src', attachment.url).show();
            $('#remove_profile_image_button').show();
        });

        customUploader.open();
    });

    $('#remove_profile_image_button').click(function(e) {
        e.preventDefault();

        $('#profile_image').val('');
        $('#profile_image_preview img').attr('src', 'http://sdod.ir/wp-content/plugins/magiz-dash-post/admin/assets/images/default-profile-image.jpg');
        $('#remove_profile_image_button').hide();
    });

    jalaliDatepicker.startWatch({ 
        time: true
    });
    
});