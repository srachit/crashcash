$("#gambleButton").click(function (event) {

    event.preventDefault();
    $(".alert").hide();

    if ($("#city").val() != "") {
        $.get("scrapper.php?city="+$("#city").val(), function (data) {
            if(data=="")
            {
                $("#fail").fadeIn();   
            }
            else
            {
                $("#succes").html(data).fadeIn();
            }
        });
    }
    else{
        $("#noCity").fadeIn();   
    }
});