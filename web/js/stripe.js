$(function () {
    var $form = $("#payment-form");
    $(".cc-number").payment("formatCardNumber");
    $(".cc-exp").payment("formatCardExpiry");
    $(".cc-cvc").payment("formatCardCVC");

    $form.submit(function (event) {
        event.preventDefault();
        if ($("#email").val() !== $("#confirm").val()) {
            $(".payment-errors").empty().append("<p>Les emails ne correspondent pas</p>");
            //alert("Attention, les mails ne correspondent pas !");
            return false;
        }
        else {
            // Disable the submit button to prevent repeated clicks:
            $form.find(".submit").prop("disabled", true);
            // Request a token from Stripe:
            Stripe.card.createToken($form, stripeResponseHandler);
            // Prevent the form from being submitted:
            return false;
        }
    });
});
function stripeResponseHandler(status, response) {
    // Grab the form:
    var $form = $("#payment-form");
    if (response.error) { // Problem!
        // Show the errors on the form:
        $form.find(".payment-errors").text(response.error.message);
        $form.find(".submit").prop("disabled", false); // Re-enable submission
    } else { // Token was created!
        // Get the token ID:
        var token = response.id;
        // Insert the token ID into the form so it gets submitted to the server:
        $form.append($('<input type="hidden" name="stripeToken">').val(token));
        // Submit the form:
        $form.get(0).submit();
    }
}
