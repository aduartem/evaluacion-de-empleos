/*
 * @author: Andrés Duarte M.
 *
 */

$(document).ready(function(){

    $("[data-tooltip]").tooltip();

    $(".solo-numeros").keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
    });

    $(".solo-decimales-y-enteros").keyup(function (){
        this.value = (this.value + '').replace(/[^0-9.]/g, '');
    });

    $('.nota-empresa1').on("change", function(e){
        var nota = parseFloat($(this).val());
        if(nota >= 0 && nota <= 10){
            var correlativo = $(e.currentTarget).data('correlativo');
            calcularPonderacion(nota, "1", correlativo);
        }else{
            showMessage('error', 'Debe ingresar una nota válida');
            $(this).val('');
            $(this).focus();
        }
    });

    $('.nota-empresa2').on("change", function(e){
        var nota = parseFloat($(this).val());
        if(nota >= 0 && nota <= 10){
            var correlativo = $(e.currentTarget).data('correlativo');
            calcularPonderacion($(this).val(), "2", correlativo);            
        }else{
            showMessage('error', 'Debe ingresar una nota válida');
            $(this).val('');
            $(this).focus();
        }
    });

    $(".factor").on("change", function(e){
        var correlativo  = $(e.currentTarget).data('correlativo');
        var tipoEmpresa  = "1";
        var selector     = "#nota"+correlativo+"-empresa" + tipoEmpresa;
        if($("#nota"+correlativo+"-empresa1").val() !== ""){
            var nota = parseFloat($("#nota" + correlativo + "-empresa1").val());
            calcularPonderacion(nota, "1", correlativo);
        }

        tipoEmpresa = "2";
        selector    = "#nota"+correlativo+"-empresa" + tipoEmpresa;
        if($(selector).val() !== ""){
            var nota = parseFloat($(selector).val());
            calcularPonderacion(nota, tipoEmpresa, correlativo);
        }

        var sumFactor = 0;
        $('input[name^="factor"]').each(function() {
            if($(this).val() !== ""){
                sumFactor = sumFactor + parseInt($(this).val());
            }
        });

        $("#sumaFactores").text(sumFactor);
    });

    $("#btnGetResult").on("click", function(e){
        getResult();
    });
});

function calcularPonderacion(nota, tipoEmpresa, correlativo){
    var factor = $("#factor" + correlativo).val();
    if(factor !== "" && nota !== ""){
        var factor      = parseFloat(factor);
        var ponderacion = nota * (factor / 100);
        ponderacion     = Math.round(ponderacion * 100) / 100;
        $(".ponderacion"+correlativo+"-empresa"+tipoEmpresa).text(ponderacion);
        $("#ponderacion"+correlativo+"-empresa"+tipoEmpresa).val(ponderacion);
    }
}

function getResult(){
    var continuar = true;

    var sumFactor = 0;
    $('input[name^="factor"]').each(function() {
        if($(this).val() !== ""){
            sumFactor = sumFactor + parseInt($(this).val());
        }
    });

    if(sumFactor !== 100){
        showMessage('error', 'La suma de los factores debe ser 100.');
    }else{
        var sumE1 = 0;
        $('input[name^="ponderacion-empresa1"]').each(function() {
            if($(this).val() === ""){
                showMessage("error", "Debe completar todos los campos");
                continuar = false;
                return false;
            }
            sumE1 = sumE1 + parseFloat($(this).val());
        });

        if(continuar){
            var sumE2 = 0;
            $('input[name^="ponderacion-empresa2"]').each(function() {
                if($(this).val() === ""){
                    showMessage("error", "Debe completar todos los campos");
                    continuar = false;
                    return false;
                }
                sumE2 = sumE2 + parseFloat($(this).val());
            });

            if(continuar)
            {
                sumE1 = Math.round(sumE1 * 100) / 100;
                sumE2 = Math.round(sumE2 * 100) / 100;

                $("#resultE1").text(sumE1);
                $("#resultE2").text(sumE2);
            }
        }
    }
}

function showMessage(type, message){
    swal({
          title: "Error de validación",   
          text: message,   
          type: type
    });
}