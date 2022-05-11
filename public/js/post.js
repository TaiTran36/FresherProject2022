$(document).ready(function () {
    $('#submit').click(function() {
        checked = $("input[type=checkbox]:checked").length;
        if(!checked) {
          $('#err').text("You must check this !!!!!!").css("color", "red");
          return false;
        }
      });
    });
    function getFileData(myFile) {
        var file = myFile.files[0];
        if (file) {
            var filename = file.name;
            document.getElementById ("image_show").src = URL.createObjectURL(file);
        }
    }