function sendphp() {
    debugger;
    var name = $(".name").val();
    var email = $(".email").val();
    var subject = $(".subject").val();
    var message = $('.message').val();

    $.post("phpMailer/mail_handler.php", {name:name, email:email, subject:subject, message:message})
}