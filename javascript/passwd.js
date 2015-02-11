$('document').ready(function() {
    registerForm();
    registerHelp();
});

function registerHelp() {
    $(".help").click(function(e) {
        e.preventDefault();
        $('.overlay > section').load("ajax/help.php", function() {
            $('.overlay').fadeIn(function() {
                $(this).click(function() {
                    $(this).fadeOut();
                });
            });
        });
    });
}

function registerForm() {
    $("#userdata").submit(function(e) {
        //$('button').load("ajax/spinner.php");
        $.ajax({
            type: "POST",
            url: $("#userdata").attr('action'),
            data: $("#userdata").serialize(),
            success: function(data) {
                processForm(data);
            }
        });
        e.preventDefault();
    });
}

function processForm(data) {
    switch (parseInt(data)) {
        case 1:
            $("#userdata").html("<span class='success'>Ihr Passwort wurde geändert</span>");
            return true;
            break;
        case 600:
            $("#userdata").html("<span class='toomany'>Sie haben Ihr Passwort zu oft falsch eingegeben.<br />Sie können Ihr Passwort innerhalb der nächsten <b>24h</b> nicht mehr ändern.</span>");
            break;
        default:
            wrongCredentials();
            break;
    }
}

function wrongCredentials() {
    if ($.ui) {
        (function () {
            var oldEffect = $.fn.effect;
            $.fn.effect = function (effectName) {
                if (effectName === "shake") {
                    var old = $.effects.createWrapper;
                    $.effects.createWrapper = function (element) {
                        var result;
                        var oldCSS = $.fn.css;

                        $.fn.css = function (size) {
                            var _element = this;
                            var hasOwn = Object.prototype.hasOwnProperty;
                            return _element === element && hasOwn.call(size, "width") && hasOwn.call(size, "height") && _element || oldCSS.apply(this, arguments);
                        };

                        result = old.apply(this, arguments);

                        $.fn.css = oldCSS;
                        return result;
                    };
                }
                return oldEffect.apply(this, arguments);
            };
        })();
    }
    $('.form').effect("shake", function() {
        $('#userdata').find("input[type=password]").val("");
    });
}