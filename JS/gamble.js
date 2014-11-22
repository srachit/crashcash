$("#gambleButton").click(function (event) {

    event.preventDefault();
    $(".alert").hide();

    if ($("#numGuess").val() < 10) {
        $.get("gambleScript.php?numGuess="+$("#numGuess").val()+"&gambleBet="+$("#gambleBet") , function (data) {
            if(data=="lose")
            {
                $("#fail").fadeIn();   
            }
            else 
            {
                $("#succes").fadeIn();
            }
        });
    }
    else{
        $("#Less").fadeIn();   
    }
});