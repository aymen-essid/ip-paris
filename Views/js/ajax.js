$( document ).ready(function() {

    function getUsers(){

        $.ajax({
            method: "GET",
            url: "index.php?action=getUsers"
        }).done(function( msg ) {

            $("#users-list").html(msg);
        });
    }

    function getCountries() {
        $.ajax({
            method: "GET",
            url: "index.php?action=getCountries"
        }).done(function( msg ) {

            $("#country").html(msg);
        });
    }

    getCountries();
    getUsers();

    $( "#submit" ).click(function(e) {

        $("#form-subscribe").submit(function (event) {

            event.preventDefault();
            event.stopImmediatePropagation();

            serializedData = $(this).serialize();

            $.ajax({
                method: "POST",
                url: "index.php?action=addUser",
                data: serializedData,
                dataType: 'text'
            }).done(function( msg ) {
                $(".alert-success").addClass('hide');
                $(".alert-danger").addClass('hide');
                getUsers();
                obj = JSON.parse(msg);
                console.log(obj);
                if(obj.alerte == 'SUCCESS' ){
                    $(".alert-success").removeClass('hide');
                    $(".alert-success").html(obj.messagee);
                }
                else
                {
                    $(".alert-danger").removeClass('hide');
                    $(".alert-danger").html(obj.messagee);
                }
            })
        });

    });

});