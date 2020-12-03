$(function() {
    var reviewId;
    var reviewAction = function(e) {
        $(e.currentTarget).parent().parent().siblings(".showReview").toggle();
    }
    $(".showReviewButton").each(function () {
        var currentButton = $(this);
        currentButton.click(reviewAction);
    })
    var commentAction = function(e) {
        reviewId = $(e.currentTarget).parent().parent().parent().attr("id");
        var commentsDiv = $(e.currentTarget).parent().parent().siblings(".showComments");
        if (commentsDiv.css("display") == "none") {
            $.ajax({
                method: "GET",
                url: "reviewJS_handler.php",
                data: {"getReviewComments" : 1, "reviewId" : reviewId},
                dataType: "json",
                success: function(data) {
                    $("p").remove(".commentP");
                    //alert("ajax: " + data);
                    for(var i=0, l=data.length; i<l; i++) {
                        //alert("comment: " + data[i]);
                        commentsDiv.append("<p class='commentP'>" + data[i] + "</p>");
                    }
                    commentsDiv.toggle();
                },
                error: function(xhr , status, error) {
                    alert(xhr.responseText);
                }
            });
        } else {
            commentsDiv.toggle();
        }
        $("#commentContainer").toggle();
    }
    $(".showCommentsButton").each(function () {
        var currentButton = $(this);
        currentButton.click(commentAction);
    }) 
    $("#commentForm").submit(function(e) {
        e.preventDefault();
        var comment = $("#reviewComments").val();
        if (comment.length > 0 && comment.length <= 255) {
            $.ajax({
                method: "POST",
                url: "reviewComments_handler.php",
                data: {"reviewComment": comment, "reviewId": reviewId},
                dataType: "json",
                success: function(data) {
                    alert("ajax success: " + data);
                    $(".showComments").prepend("<p class='commentP'>" + comment + "</p>");
                    $("#reviewComments").val('');
                },
                error: function(xhr , status, error) {
                    alert("failed ajax: " + xhr.responseText);
                }
            })
        } else {
            var errorMsg = $("<p class='signUpMessages'></p>").text("Please enter valid comment.").fadeOut(3000);
            $("#commentForm").parent().prepend(errorMsg);    
        }
    });
})