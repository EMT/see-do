$("form :input").focus(function() {
    $("label[for='" + this.id + "']").addClass("label-focus");
})

$("form :input").blur(function() {
  $("label").removeClass("label-focus");
});
