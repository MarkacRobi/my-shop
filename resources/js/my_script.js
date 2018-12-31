window.readURL = readURL;
window.hide_adress = hide_adress;

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

function hide_adress() {
    if(document.getElementById('stranka').checked){
        document.getElementById('adress').removeAttribute('hidden');
        document.getElementById('city').setAttribute("required", "true");
        document.getElementById('post_number').setAttribute("required", "true");
        document.getElementById('street').setAttribute("required", "true");
        document.getElementById('street_number').setAttribute("required", "true");
    }
    else {
        document.getElementById('adress').setAttribute("hidden", "true");
        document.getElementById("city").removeAttribute("required");
        document.getElementById("post_number").removeAttribute("required");
        document.getElementById("street").removeAttribute("required");
        document.getElementById("street_number").removeAttribute("required");

    }
}