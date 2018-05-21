$(function () {
    vlidateInputs($("#add-product-form"));
    $("#add-product-form").submit(function (event) {
        var name  =  $("#product_name");
        var image = $("#product_img");
        validateNameField(name,event);
        validateImageField(image,event);
    });




});

function vlidateInputs(form) {
    var name  = form.find("#product_name");
    var image = form.find("#product_img");
    name.blur(function (event) {
        validateNameField(name,event);
    });
    image.change(function (event) {

        validateImageField(image,event);

    });

}
function validateNameField(name,event) {


    if (name.val().trim() === ""){
        $("#name_feedback").text("Name is required");
        name.css( "box-shadow","0 0 4px #811");
        event.preventDefault();
    }else{
        name.css( "box-shadow","0 0 4px #181");
        $("#name_feedback").empty();
    }
}

function validateImageField(image,event) {
    var imageVal = image.val();

    var fileType = imageVal.substring((imageVal.lastIndexOf('.'))+1);

    if (fileType !== "jpeg" && fileType!== "jpg" && fileType !== "png"){
        console.log(fileType);
        $("#image_feedback").text("File must be an image ");
        image.css( "box-shadow","0 0 4px #811");
    }else{
        image.css( "box-shadow","0 0 4px #181");
        $("#image_feedback").empty();
    }



}