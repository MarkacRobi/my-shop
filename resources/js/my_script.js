window.readURL = readURL;

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#item_image_show')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}