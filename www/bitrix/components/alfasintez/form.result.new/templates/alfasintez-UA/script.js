$( document ).ready(function() {


	$('.alfasintez-call-back-form .alfasintez-question-6 input').attr({placeholder: "Ім\'я *",data_only_text:""});
	$('.alfasintez-call-back-form .alfasintez-question-7 input').attr({placeholder: "Номер телефону *",phone:""});

$("input[data_only_text]").keypress(function(e) {
if (e.which != 8 && e.which != 32 && e.which != 0 && e.which != 46 &&  (e.which < 65 || e.which > 122 && e.which < 1040 || e.which >  1105)) {
return false;
}
});

/* ------------------ ОТМЕНА ВВОДА БУКВ В INPUT PHONE ----------------------------*/
$('.inputtext[phone]').keypress(function(e) {
	if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
	return false;
	}
});

// проверка формы на заполненность////////
    $('body').on('click', '.alfasintez-call-back-form .alfasintez-form-submit', function(event)
    {
        $('.alfasintez-call-back-form input.inputtext').removeClass("inputError");
        var $input_1 = $('.alfasintez-call-back-form .alfasintez-question-6 input'),
            $input_2 = $('.alfasintez-call-back-form .alfasintez-question-7 input');

        if($input_1.val() == "" ||  $input_1.val().length < 3 ) {
            $input_1.attr("placeholder", "Ім'я *").addClass("inputError");
            event.preventDefault();
        } else {$(this).attr("disable", true);}

        if($input_2.val() == "" || $input_2.val().length < 10 || $input_2.val().length > 15) {
            $input_2.attr("placeholder", "Номер телефону *").addClass("inputError");
            event.preventDefault();
        } else {$(this).attr("disable", true);}


    });


//---------------------------ДОБАВЛЕНИЕ + В ПОЛЕ ТЕЛЕФОНА-------------------------//
    $( ".inputtext[phone]" ).focusin(function() {
        var $inputVal = $(this);
    if($inputVal.val() == "") {
        $inputVal.val("+");
    }
    });

});