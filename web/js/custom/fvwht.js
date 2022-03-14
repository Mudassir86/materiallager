

LieferantTable.init();


var handleTitle = function(tab, navigation, index) {
    var total = navigation.find('li').length;
    var current = index + 1;



    // set done steps
    jQuery('li', $('#form_wizard_1')).removeClass("done");
    var li_list = navigation.find('li');
    for (var i = 0; i < index; i++) {
        jQuery(li_list[i]).addClass("done");
    }

    if (current == 1) {
        $('#form_wizard_1').find('.fvwhtMaterialZuruck').hide();
    } else {
        $('#form_wizard_1').find('.fvwhtMaterialZuruck').show();
    }

    if (current >= total) {
        $('#form_wizard_1').find('.fvwhtMaterialNext').hide();
        $('#form_wizard_1').find('.fvwhtMaterialSubmit').show();
    } else {
        $('#form_wizard_1').find('.fvwhtMaterialNext').show();
        $('#form_wizard_1').find('.fvwhtMaterialSubmit').hide();
    }

}

$('#form_wizard_1').bootstrapWizard({
    'nextSelector': '.fvwhtMaterialNext',
    'previousSelector': '.fvwhtMaterialZuruck',
    onTabClick: function (tab, navigation, index, clickedIndex) {
        return false;

        //handleTitle(tab, navigation, clickedIndex);
    },
    onNext: function (tab, navigation, index) {

        var isValidation = tab.data("validation");

        if(isValidation === "t")
        {
            var noerrors = eval("materialTab"+index+"Validation()");

            if(!noerrors)
            {
                return false;
            }
        }

        if(index == 3)
        {
            displayOverView();
        }

        handleTitle(tab, navigation, index);

    },
    onPrevious: function (tab, navigation, index) {

        handleTitle(tab, navigation, index);
    },
    onTabShow: function (tab, navigation, index) {
        var total = navigation.find('li').length;
        var current = index + 1;
        var $percent = (current / total) * 100;
        $('#form_wizard_1').find('.progress-bar').css({
            width: $percent + '%'
        });
    }
});

$('#form_wizard_1').find('.fvwhtMaterialZuruck,.fvwhtMaterialSubmit').hide();

function displayOverView()
{
    var selectedRow = $("#selectedRow").val();

    var data = otableLieferant.row(selectedRow).data();

    $("#materialOverView_firmenname").html(data.fullname);
    $("#materialOverView_strasse").html(data.street);
    $("#materialOverView_postleitzahl").html(data.zip);
    $("#materialOverView_email").html(data.email1);
    $("#materialOverView_staat").html(data.state);
    $("#materialOverView_ort").html(data.city);
    $("#materialOverView_land").html(data.country);
    $("#materialOverView_bemerkung").html(data.comment);

    $("#materialOverView_prufzeichen").html($('#freePrufzeichen').val());
    $("#materialOverView_lfdnummer").html($('#lfdNummer').val());
    $("#materialOverView_projektgruppe").html($('#projektgruppe').val());

    $('#materialOverView_pz_alt1').html($('#fvwht_normbezeichnung').val());
    $('#materialOverView_werkstoffnummer').html($('#fvwht_werkstoffnummer').val());
    $('#materialOverView_trivialname1').html($('#fvwht_trivialname1').val());
    $('#materialOverView_trivialname2').html($('#fvwht_trivialname2').val());
    $('#materialOverView_trivialname3').html($('#fvwht_trivialname3').val());
    $('#materialOverView_werkstoffzustand').html($('#fvwht_werkstoffzustand').val());
    $('#materialOverView_schmelze').html($('#fvwht_schmelze').val());
    $('#materialOverView_weld_mat').html(($('#fvwht_weld_mat').is(":checked"))? "X" : "");
    $('#materialOverView_pz_weld2').html($('#fvwht_pz_weld2').val());
    $('#materialOverView_pz_weld3').html($('#fvwht_pz_weld3').val());


}

$("#fvwht_weld_mat").change(function(){

    if($(this).is(":checked"))
    {
        $("#fvwht_pz_weld2,#fvwht_pz_weld3").prop("disabled",false);
    }

    else
    {
        $("#fvwht_pz_weld2,#fvwht_pz_weld3").val("").prop("disabled",true);
    }
})


function materialTab1Validation()
{
    if($('#selectedRow').val() === "")
    {
        swal({
            title:"Hinweis!",
            text: "Bitte wählen Sie einen Organisation aus.",
            type: 'error',
            html: true
        });

        return false;
    }

    return true;
}

function materialTab2Validation()
{

    if($.trim($('#freePrufzeichen').html()) === "" || $.trim($('#freePrufzeichen').val()) === "")
    {
        swal({
            title:"Hinweis!",
            text: "Bitte wählen Sie ein freies Prüfzeichen.",
            type: 'error',
            html: true
        });

        return false;
    }

    return true;
}

function materialTab3Validation()
{
    var noerrors = true;
    $.each( $('#tab3 .mandatory:visible'), function( key, value )
    {
        if($(this).prop('type') === "radio")
        {
            var name = $(this).prop('name');
            if($('input[name="'+ name +'"]:checked').length)
            {
                $('input[name="'+ name +'"]').closest('div').removeClass('has-error');
            }
            else {

                $(this).closest('div').addClass('has-error');

                swal({
                    title:"Hinweis!",
                    text: "Bitte wählen Sie einen Wert aus.",
                    type: 'error',
                    html: true
                });

                noerrors = false;
                return false;
            }
        }
        else {

            if($(this).val() === '' || $(this).val() === null || typeof $(this).val() ==="undefined")
            {

                $(this).closest('div').addClass('has-error');

                $('html, body').animate({
                    scrollTop: $(this).offset().top
                });
                swal({
                    title:"Hinweis!",
                    text: "Bitte füllen Sie die rot markierten Felder aus.",
                    type: 'error',
                    html: true
                });

                noerrors = false;
                return false;
            }

            else
            {
                $(this).closest('div').removeClass('has-error');

            }
        }
    });
    return noerrors;
}

$('#neue_lieferant').click(function(){

    $.ajax({
        url: 'neue-lieferant-form',
        type: 'post',

        beforeSend: function ()
        {

        },
        error: function (data) {

            swal({
                title: 'Hinweis',
                text: data.responseText,
                type: 'error',
                html: true
            });
            return false;

        },
        success: function (data) {

            $('.neueLieferantModalBody').html('');

            $('.neueLieferantModalBody').html(data);



            $('#neueLieferantModal').modal('show');



        }
    });



})


$('.neueLieferantModalSave').click(function(){

    var noerrors = true;

    $.each( $('.neueLieferantModalBody .mandatory:visible'), function( key, value )
    {

        if($(this).prop('type') === "checkbox" || $(this).prop('type') === "radio")
        {
            var name = $(this).prop('name');
            if($('input[name="'+ name +'"]:checked').length)
            {
                $('input[name="'+ name +'"]').closest('div').removeClass('has-error');
            }

            else
            {

                $('input[name="'+ name +'"]').closest('div').addClass('has-error');

                $('html, body').animate({
                    scrollTop: $(this).offset().top
                });

                noerrors = false;
                return false;
            }
        }

        else
        {
            if($(this).val() === '' || $(this).val() === null || typeof $(this).val() ==="undefined")
            {

                $(this).closest('div').addClass('has-error');

                $('html, body').animate({
                    scrollTop: $(this).offset().top
                });

                swal({
                    title:"Hinweis!",
                    text: "Bitte füllen Sie die rot markierten Felder aus.",
                    type: 'error',
                    timer: '2500',
                    html: true
                });


                noerrors = false;
                return false;
            }

            else
            {
                $(this).closest('div').removeClass('has-error');

            }
        }

    });

    if(!noerrors)
    {
        return false;
    }

    var previewTxt = '<div class="row">\n\
            <label class="control-label col-md-5" style="font-weight: bold;">Firmenname:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static">'+$("#neue_name").val()+'</p>\n\
            </div>\n\
        </div>\n\
        <div class="row">\n\
            <label class="control-label col-md-5" style="font-weight: bold;">Straße, Hausnummer:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static" >'+$("#neue_strasse").val()+'</p>\n\
            </div>\n\
        </div>\n\
        <div class="row">\n\
            <label class="control-label col-md-5" style="font-weight: bold;">Postleitzahl:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static" >'+$("#neue_zip").val()+'</p>\n\
            </div>\n\
        </div>\n\
        <div class="row">\n\
            <label class="control-label col-md-5" style="font-weight: bold;">Ort:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static">'+$("#neue_ort").val()+'</p>\n\
            </div>\n\
        </div>\n\
        <div class="row">\n\
            <label class="control-label col-md-5" style="font-weight: bold;">Land:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static">'+$("#neue_land").val()+'</p>\n\
            </div>\n\
        </div>\n\
        <div class="row">\n\
            <label class="control-label col-md-5" style="font-weight: bold;">Email:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static">'+$("#neue_email").val()+'</p>\n\
            </div>\n\
        </div>';



    swal({
            title:"Hinweis",
            text: "Sind Sie sicher, dass Sie speichern möchten?<br><br>"+previewTxt,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Ja",
            cancelButtonText: "Nein",
            closeOnConfirm: true,
            closeOnCancel: true,
            html: true
        },
        function(isConfirm)
        {
            if (isConfirm)
            {
                saveNeueLieferant();
            }

        });

})

function saveNeueLieferant()
{
    var dataString = $(".neue_lieferant_input").serialize();

    $.ajax({
        type: "POST",
        url: "save-neue-lieferant",
        data: dataString,
        async: true,
        dataType: 'json',
        beforeSend:function(){

        },

        error: function (data) {

            swal({
                title: 'Hinweis',
                text: "error",
                type: 'error',
                html: true
            });
            return false;

        },

        success: function (data) {


            if (data.success === 'true')
            {

                $('#neueLieferantModal').modal('hide');

                otableLieferant.ajax.reload();

                return false;
            }

            else
            {
                swal({
                    title: 'Hinweis',
                    text: data.error,
                    type: 'error',
                    html: true
                });
                return false;
            }

        }
    });

}

$('#fvwhtPrufzeichen').keyup(function(){

    var val = $.trim($(this).val());
    this.value = this.value.replace(/[iIoOqxX.,;/\{()}0-9=*+'#-:!"§$%&?]/g, '');
    val = val.toUpperCase();


    if(val.length >= 2)
    {
        $.ajax({
            url : 'prufzeichen',
            type : 'POST',
            data: 'val='+val,
            dataType: 'json',
            beforeSend:function()
            {

            },
            error : function (data) {


            },
            success : function (data) {

                var used = data.used;
                var free = data.free;

                $('#usedPrufzeichen,#freePrufzeichen').html('');


                $.each( used, function(key,value)
                {
                    value = $.trim(value);

                    $('#usedPrufzeichen').append('<option value="'+value+'">'+value+'</option>');
                });

                $.each( free, function(key,value)
                {
                    value = $.trim(value);
                    if(value.match(/[iIqoOxX]/g, '')){
                        return value.splice ;
                    };

                    $('#freePrufzeichen').append('<option value="'+value+'">'+value+'</option>');

                });

            },

        });
    }

    else
    {
        $('#usedPrufzeichen,#freePrufzeichen').html('');
    }
})

    $('body').on('change','#freePrufzeichen', function() {
        $('#fvwhtPrufzeichen').val(this.value);
    });

$('.mandatory:visible').live('input change paste',function(){

    if($(this).prop('type') === "checkbox" || $(this).prop('type') === "radio")
    {
        var name = $(this).prop('name');
        if($('input[name="'+ name +'"]:checked').length)
        {
            $('input[name="'+ name +'"]').closest('div').removeClass('has-error');
        }

        else
        {
            $('input[name="'+ name +'"]').closest('div').addClass('has-error');

        }
    }

    else
    {
        if($(this).val() === '' || $(this).val() === null || typeof $(this).val() ==="undefined")
        {
            $(this).closest('div').addClass('has-error');
        }

        else
        {
            $(this).closest('div').removeClass('has-error');

        }

    }

})


$(".materialTabs li").click(function(){
    var current = $(this).data("index");
    var total = $(".materialTabs").find('li').length;
    var $percent = (current / total) * 100;
    $('#form_wizard_1').find('.progress-bar').css({
        width: $percent + '%'
    });

})


$("input[name=fvwhtbtn]").click(function() {
    if($(".radio_fvwhtbtn").is(':checked')) {

        var id = $(this).val();

        var val = $('#' + id).val()

        $('#fvwht_pz_alt').val(val);

        console.log(val);
    }

});

$(".fvwhtMaterialSubmit").click(function(){


    var form = $("#fvwhtMaterialForm");
    var formdata = new FormData(form[0]);


    $.ajax({
       
        url: "save-neue-fvwht",
        type: "POST",
        data: formdata,
		async : false,
        cache: false,
        contentType: false,
        processData: false,
        dataType:'json',
        beforeSend:function(){


        },

        error: function (data) {

            swal({
                title: 'Hinweis',
                text: "error",
                type: 'error',
                html: true
            });
            return false;

        },

        success: function (data) {


            if (data.success === 'true')
            {
                swal({
                        title:"Erfolg",
                        text: "Daten erfolgreich gespeichert",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-info",
                        confirmButtonText: "Ja",
                        cancelButtonText: "Nein",
                        closeOnConfirm: true,
                        closeOnCancel: true,
                        html: true
                    },
                    function(isConfirm)
                    {
                        if (isConfirm)
                        {
                            window.location.href = "/material/web/site/main";
                        }

                        else
                        {
                            window.location.href = "/material/web/site/main";
                        }

                    });



                return false;
            }

            else
            {
                swal({
                    title: 'Hinweis',
                    text: data.error,
                    type: 'error',
                    html: true
                });
                return false;
            }

        }
    });

})