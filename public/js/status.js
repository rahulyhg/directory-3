// Initialize status
var val = $(".status").val();

// New = 0
// The default field value on create is null, so we need to set it to 1 "Active" and apply the classes for the user
if (val === "") {
    $(".status-toggle p i").addClass("fa-toggle-on");
    $(".status-toggle p").addClass("bg-success");
    $(".status-toggle span").text("Active");
    $(".status").val(1);
}

// Active = 1
if (val === "1") {
    $(".status-toggle p i").addClass("fa-toggle-on");
    $(".status-toggle p").addClass("bg-success");
    $(".status-toggle span").text("Active");
}

// Closed = 2
if (val === "2") {
    $(".status-toggle p i").addClass("fa-toggle-off");
    $(".status-toggle p").addClass("bg-danger");
    $(".status-toggle span").text("Closed");
}


// Update status value from toggle icon click
$.fn.extend({
    toggleText: function(a, b){
        return this.text(this.text() == b ? a : b);
    }
});

$(".status-toggle p i").on("click", function(){
    $(".status-toggle p i").toggleClass("fa-toggle-on fa-toggle-off");
    $(".status-toggle p").toggleClass("bg-success bg-danger");
    $(".status-toggle span").toggleText("Active", "Closed");

    var status = $(".status"),
        val = status.val();

    status.val(val === "1" ? "2" : "1");
});
