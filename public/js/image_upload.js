function getFileData(myFile) {
    var file = myFile.files[0];
    if (file) {
        var filename = file.name;
        document.getElementById("image_show").src = URL.createObjectURL(file);
    }
}