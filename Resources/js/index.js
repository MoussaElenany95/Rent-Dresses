$(function () {
    $(".movie-image").click(function (event) {

            var source = $(this).find("img").attr("src");
            var name   = $(this).find(".name").text();
            var price  = $(this).find(".price").text();
            var link   = $(this).find("button").attr("onclick");
            $(".light-box img").attr("src",source);
            $(".light-box #name").html("<b>Name :</b> "+ name);
            $(".light-box #price").html("<b>Price :</b> "+ price);
            $(".light-box #order-btn").attr("onclick",link);
            $(".light-box").stop().slideDown();


    });
    $(".movie-image").hover(function () {
         $(this).find(".show-details").stop().slideDown();
     },function () {
            $(this).find(".show-details").stop().slideUp();

    });
    $(".light-box").click(function (event) {

        if (event.target === this){
            $(this).stop().fadeOut();
        }
    });

    $(".delete-product").click(function () {
        var productId  = $(this).val();
        var productDiv = $("#product"+productId);
        $.ajax({

            url:"../Controllers/user_route.php",
            type:"GET",
            data:{delete:productId},
            dataType:"JSON",success:function (response) {
                if (response.success){
                    productDiv.stop().fadeOut();
                    setTimeout(function () {
                            productDiv.remove();
                    },1000);
                }else{
                    alert("You have an order for this , you can't remove");
                }
            }
        });
    });
    //live search
    $("#search-input").on("keyup",function () {
        var search = $(this).val().toLowerCase();
        searchValues(search);

    });
    $("#search-input").on("focus",function () {
        var search = $(this).val().toLowerCase();
        searchValues(search);

    });

    $("#search-div").on("click","tr",function () {
        var search = $(this).text();
        if (search !== "No results found"){

            $("#search-input").val(search);

            $("#live-search").submit();
        }

    });
    $("#search-input").on("blur",function () {

        setTimeout(function () {
            $("#search-div").empty();
        },200);


    });
    $("#live-search").submit(function (event) {
        var search = $(this).find("#search-input").val();

        if (search.trim() === "" ){
            event.preventDefault();
        }
    });
});

function searchValues(search) {
    $.ajax({
        url:"../Controllers/user_route.php",
        type:"GET",
        data:{"search-product":search},
        dataType:"JSON",success:function (response) {
            if (response.length > 0){

                   $("#search-div").html(function () {
                       var row = "";
                        $.each(response,function (index) {
                            row += `<tr class="clickable"><td>${response[index].name}</td></tr>`;
                        });
                       return row;
                   });


            } else {
                $("#search-div").html(`<tr><td>No results found</td></tr>`);
            }


        },error:function (status) {
            console.log(status);
        }
    });

}