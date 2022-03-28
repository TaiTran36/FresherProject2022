function getFileData(myFile) {
    var file = myFile.files[0];
    if (file) {
        var filename = file.name;
        document.getElementById ("img_avatar").src = URL.createObjectURL(file);
    }
}