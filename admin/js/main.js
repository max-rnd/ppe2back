$(function () {
    $.ajax({
        type: 'GET',
        url: 'http://localhost:8080/allExpo',
        dataType: 'json',
        success: function (val) {
            selectExpo = document.getElementById('selectExpo');
            for (i = 0; i < val.length; i++) {
                selectExpo.options[selectExpo.options.length] = new Option(val[i]['titre'], val[i]['id']);
            }
            expoUpdate();
        },
        error: function () {
            alert("Erreur de chargement");
        }
    });
    $("#selectExpo").change(function () {
        expoUpdate();
    });

    function expoUpdate() {
        idExpo = $("#selectExpo").children("option:selected").val();
        $.ajax({
            type: 'GET',
            url: 'http://localhost:8080/expo/' + idExpo,
            dataType: 'json',
            success: function (val) {
                dd = new Date(val['dateDebut']);
                if (dd >= Date.now()) {
                    $("#expoStatus").html("Status : A venir");
                } else {
                    $("#expoStatus").html("Status : En cours");
                }
                $("#dateDebut").attr("value", val['dateDebut']);
                $("#dateFin").attr("value", val['dateFin']);
                $("#titreExpo").attr("value", val['titre']);
            }
        });
    }
});