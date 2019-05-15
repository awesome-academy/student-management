function previewFile(){
    var preview = document.querySelector('#avatar'); //selects the query named img
    var file    = document.querySelector('input[type=file]').files[0]; //sames as here
    var reader  = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
            var url = reader.readAsDataURL(file); //reads the data as a URL
        } else {
            alert('error file');
            location.reload();
        }
                    
    } else {
        location.reload();
    }
}
