$(function () {
    $("#question").on("keydown",function (event) {
        var question  = $(this).val();
        if (question.trim() !== ""){
                    if (event.keyCode === 13){




                            $(this).val("").hide();

                            $.ajax({
                                url:"../Controllers/user_route.php",
                                type:"POST",
                                dataType:"JSON",
                                data:{"add-question":question},
                                success:function (response) {
                                    var rowId = `question${response.id}`;
                                    var row   = $("<tr>",{id:rowId});
                                    var col1  = $("<td>",{text:question,class:"col-xs-1"});
                                    var col2  = $("<td>",{text:"Waiting for  response",class:"col-xs-2"});
                                    row.append(col1);
                                    row.append(col2);
                                    $(".table tbody:last").append(row);

                                    window.location.hash = `#${rowId}`;
                                    $(`#${rowId}`).css({
                                        backgroundColor:"#ffffff29"
                                    });

                                    setTimeout(function () {
                                        $(`#${rowId}`).css({
                                            backgroundColor:"#0000001a"
                                        });
                                    },1000);
                                }
                            });



                    }

        }
    });
});