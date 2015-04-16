$(document).ready(function() {
    var basicBtn = $("#basicBtn");
    var personalBtn = $("#personalBtn");
    var acadBtn = $("#academicBtn");

    /*
     * Form Toggle
     */
    $(basicBtn).click(toggleForm(basicBtn, personalBtn, acadBtn));
    $(personalBtn).click(toggleForm(personalBtn, basicBtn, acadBtn));
    $(acadBtn).click(toggleForm(acadBtn, basicBtn, personalBtn));

    $("#message").fadeOut(5000);

    /*
     * Total Back Logs
     */
    $("body").on("keyup", "#total_backs", (function() {

        var value = $(this).val();
        var div = $("#total_backs_div");
        console.log(value);
        if (value == "" || value == null) {
            $(div).empty();
        } else {
            for (var i = 0; i < parseInt(value); i++) {
                $(div).append('<input type="text" class="form-control" name="totalbacklogs[]" placeholder="Name of the paper" /> <br>');
            }
        }

    }));
    
    /*
     * Total Current Back Logs
     */
    $("body").on("keyup", "#current_back", (function() {

        var value = $(this).val();
        var div = $("#current_backs_div");
        console.log(value);
        if (value == "" || value == null) {
            $(div).empty();
        } else {
            for (var i = 0; i < parseInt(value); i++) {
                $(div).append('<input type="text" class="form-control" name="currentbacklogs[]" placeholder="Name of the paper" /> <br>');
            }
        }

    }));
});

var toggleForm = function(buttonClick, btn2, btn3) {
    $(buttonClick).click(function(event) {
        event.preventDefault();
        var form2 = $(btn2).attr("href");
        var form3 = $(btn3).attr("href");
        $(btn2).parent().toggleClass("");
        $(btn3).parent().toggleClass("");
        $(this).parent().toggleClass("active");
        var divID = $(this).attr("href");
        $(form2).hide();
        $(form3).hide();
        $(divID).show();
    })
}

var addInputs = function(div, value) {

}
