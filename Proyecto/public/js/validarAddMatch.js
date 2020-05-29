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
        var error6;
        var error7;



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

        if(journey < 1 && error2==false){
            if($("p[name='mensajeError7']").length==0){
                $( "<p style='margin-top: 2%;color:red' name='mensajeError7'>*La jornada mínima debe de ser la 1*</p>" ).insertAfter($("input[name='journey']"));
                    error5=true;
            }
        }else{
            $("p[name='mensajeError7']").remove();
            error5=false;
        }
        
        if(scoreLocal < 0){
            if($("p[name='mensajeError8']").length==0){
                $( "<p style='margin-top: 2%;color:red' name='mensajeError8'>*El marcador del local debe ser 0 o mayor*</p>" ).insertAfter($("input[name='scoreLocal']"));
                    error6=true;
            }
        }else{
            $("p[name='mensajeError8']").remove();
            error6=false;
        }
        
        if(scoreVisitor < 0){
            if($("p[name='mensajeError9']").length==0){
                $( "<p style='margin-top: 2%;color:red' name='mensajeError9'>*El marcador del visitante debe ser 0 o mayor*</p>" ).insertAfter($("input[name='scoreVisitor']"));
                    error7=true;
            }
        }else{
            $("p[name='mensajeError9']").remove();
            error7=false;
        }

        if(error==false && error2==false && error3==false && error4==false && error5==false && error6==false && error7==false){
            $(".formAddMatch").submit();
        }


    });

});

