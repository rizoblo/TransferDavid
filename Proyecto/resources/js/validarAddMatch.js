$(document).ready(function() {
    $( "button[name='guardarPartidoAddMatch']" ).click(function(e) {
        e.preventDefault();
        var equipoLocal=$("select[name='localTeamAddMatch']").val();
        var equipoVisitante=$("select[name='visitorTeamAddMatch']").val();
        var journey=$("input[name='journey']").val();
        var scoreLocal=$("input[name='scoreLocal']").val();
        var scoreVisitor=$("input[name='scoreVisitor']").val();
        var error;
        var error2;
        var error3;
        var error4;
        var error5;



        if(journey==""){
            if($("p[name='mensajeErrorJourney']").length==0){
                $( "<p style='margin-top: 2%;color:red' name='mensajeErrorJourney'>*Debe seleccionar una jornada*</p>" ).insertAfter($("input[name='journey']"));
                error2=true;
            }
        }else{
            $("p[name='mensajeErrorJourney']").remove();
            error2=false;
        }
        if(scoreLocal==""){
            if($("p[name='mensajeErrorScoreLocal']").length==0){
                $( "<p style='margin-top: 2%;color:red' name='mensajeErrorScoreLocal'>*Debe asignar un marcador al local*</p>" ).insertAfter($("input[name='scoreLocal']"));
                error3=true;
            }
        }else{
            $("p[name='mensajeErrorScoreLocal']").remove();
            error3=false;
        }
        if(scoreVisitor==""){
            if($("p[name='mensajeErrorScoreVisitor']").length==0){
                $( "<p style='margin-top: 2%;color:red' name='mensajeErrorScoreVisitor'>*Debe asignar un marcador al visitante*</p>" ).insertAfter($("input[name='scoreVisitor']"));
                error4=true;
            }
        }else{
            $("p[name='mensajeErrorScoreVisitor']").remove();
            error4=false;
        }
        if(equipoLocal == equipoVisitante){
            if($("p[name='mensajeError']").length==0){
                $( "<p style='margin-top: 2%;color:red' name='mensajeError'>*Los equipos no deben ser iguales*</p>" ).insertAfter($("select[name='localTeamAddMatch']"));
                error=true;
            }
            if($("p[name='mensajeError2']").length==0){
                $( "<p style='margin-top: 2%;color:red' name='mensajeError2'>*Los equipos no deben ser iguales*</p>" ).insertAfter($("select[name='visitorTeamAddMatch']"));
                error=true;
            }
        }else{
            $("p[name='mensajeError']").remove();
            $("p[name='mensajeError2']").remove();
            error=false;
        }
        if($("h1[name='bienvenidaAddMatchMadrid']").length>0){

            if(equipoLocal!=7 && equipoVisitante!=7){
                error5=true;
                if($("p[name='mensajeError51']").length==0){
                    $( "<p style='margin-top: 2%;color:red' name='mensajeError'>*Alguno de los dos equipos debe ser el Real Madrid*</p>" ).insertAfter($("select[name='localTeamAddMatch']"));
                }
                if($("p[name='mensajeError52']").length==0){
                    $( "<p style='margin-top: 2%;color:red' name='mensajeError2'>*Alguno de los dos equipos debe ser el Real Madrid*</p>" ).insertAfter($("select[name='visitorTeamAddMatch']"));
                }
            }else{
                $("p[name='mensajeError51']").remove();
                $("p[name='mensajeError52']").remove();
                error5=false;
            }
        }
        if($("h1[name='bienvenidaAddMatchBarcelona']").length>0){
            if(equipoLocal!=8 && equipoVisitante!=8){
                error5=true;
                if($("p[name='mensajeError51']").length==0){
                    $( "<p style='margin-top: 2%;color:red' name='mensajeError'>*Alguno de los dos equipos debe ser el F.C Barcelona*</p>" ).insertAfter($("select[name='localTeamAddMatch']"));
                }
                if($("p[name='mensajeError52']").length==0){
                    $( "<p style='margin-top: 2%;color:red' name='mensajeError2'>*Alguno de los dos equipos debe ser el F.C Barcelona*</p>" ).insertAfter($("select[name='visitorTeamAddMatch']"));
                }
            }else{
                $("p[name='mensajeError51']").remove();
                $("p[name='mensajeError52']").remove();
                error5=false;
            }
        }
        if(error==false && error2==false && error3==false && error4==false && error5==false){
            $(".formAddMatch").submit();
        }


    });

});

