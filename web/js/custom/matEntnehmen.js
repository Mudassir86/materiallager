var handleTitle = function(tab, navigation, index) {
    var total = navigation.find('li').length;
    var current = index + 1;



    // set done steps
    jQuery('li', $('#form_wizard_entnehmen')).removeClass("done");
    var li_list = navigation.find('li');
    for (var i = 0; i < index; i++) {
        jQuery(li_list[i]).addClass("done");
    }

    if (current == 1) {
        $('#form_wizard_entnehmen').find('.matEntnehmenZuruck').hide();
    } else {
        $('#form_wizard_entnehmen').find('.matEntnehmenZuruck').show();
    }

    if (current >= total) {
        $('#form_wizard_entnehmen').find('.matEntnehmenNext').hide();
        $('#form_wizard_entnehmen').find('.matEntnehmenSubmit').show();
    } else {
        $('#form_wizard_entnehmen').find('.matEntnehmenNext').show();
        $('#form_wizard_entnehmen').find('.matEntnehmenSubmit').hide();
    }

}

$('#form_wizard_entnehmen').bootstrapWizard({
    'nextSelector': '.matEntnehmenNext',
    'previousSelector': '.matEntnehmenZuruck',
    onTabClick: function (tab, navigation, index, clickedIndex) {
        return false;

        //handleTitle(tab, navigation, clickedIndex);
    },
    onNext: function (tab, navigation, index) {

        var isValidation = tab.data("validation");

        if(isValidation === "t")
        {
            var noerrors = eval("matEntnehmenTab"+index+"Validation()");

            if(!noerrors)
            {
                return false;
            }
        }

        if(index == 1)
        {
            getAuftragnummer();
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
        $('#form_wizard_entnehmen').find('.progress-bar').css({
            width: $percent + '%'
        });

        if(index == 2)
        {
            $(".matEntnehmenNext").hide();
        }

        if(index == 5)
        {
            $(".matEntnehmenNext").hide();
        }
    }
});

function getAuftragnummer() {
    $.ajax({
        url: 'get-auftragnummer',
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {

        },
        error: function (data) {


        },
        success: function (data) {

            $('#auftragnummer').html('');

            $.each(data, function (key, value) {


                $('#auftragnummer').append('<option value="' + value.id + '">' + $.trim(value.assignment_number) + '</option>');
            });

        },

    });
}

$('#form_wizard_entnehmen').find('.matEntnehmenZuruck,.matEntnehmenSubmit').hide();

function matEntnehmenTab1Validation()
{
    if($("#entnehmen_available_pz").val() === null)
    {
        swal({
            title:"Hinweis!",
            text: "Bitte wählen Sie einen Prüfzeichen aus.",
            type: 'error',
            html: true
        });

        return false;
    }

    return true;
}

function matEntnehmenTab2Validation()
{
    var noerrors = true;
    $.each( $('#tab2 .mandatory:visible'), function( key, value )
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
                    text: "Bitte wählen Sie ein Typ aus.",
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
                    text: "Bitte wählen Sie die Teil(e) aus.",
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

function matEntnehmenTab4Validation()
{
    var noerrors = true;
    $.each( $('#tab4 .mandatory:visible'), function( key, value )
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
                    text: "Bitte wählen Sie ein Typ aus.",
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



$("#entnehmen_available_pz").select2({
    placeholder: 'Prüfzeichen',
    ajax: {
        url: "get-pz",
        dataType: 'json',
        type: "POST",
        delay: 250,
        data: function (params) {
            return {
                q: params.term, // search term
            };
        },
        processResults: function (data,container) {

            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.pz,
                        id: item.pz,
                        pz_txt:item.pz,
                        pz_alt1:item.pz_alt1,
                        material_number:item.material_number,
                        pz_weld2:item.pz_weld2,
                        weld_mat:item.weld_mat,
                        pz_weld3:item.pz_weld3,
                        pz_id: item.id,
                        standard_designation:item.standard_designation,
                        mat_cond: item.mat_cond,
                        trivialname1: item.trivialname1,
                        trivialname2: item.trivialname2,
                        trivialname3: item.trivialname3,
                        forename: item.forename,
                        surname: item.surname,
                        org_name: item.fullname,
                        start_label_id: item.start_label_id

                    }
                })
            };

        },
        cache: true
    },
    sorter: function(data) {
        return data.sort(function(a, b) {
            return a.text < b.text ? -1 : a.text > b.text ? 1 : 0;
        });
    },
    allowClear: true,
    language: "de"


});

$("#entnehmen_available_pz").change(function(){

    if($(this).val() === null)
    {
        $('.entnehmen_txt').html('');
    }

    else
    {
        var pz_data = $("#entnehmen_available_pz").select2('data')[0];

        $('#entnehmen_pz_id_hdn').val(pz_data.pz_id);

        $('#entnehmen_pz_txt').html(pz_data.text);
        $('#entnehmen_angelegt_txt').html(pz_data.forename +" "+ pz_data.surname);
        $('#entnehmen_pz_alt1_txt').html(pz_data.pz_alt1);
        $('#entnehmen_designation_txt').html(pz_data.standard_designation);
        $('#entnehmen_werkstoffnummer').html(pz_data.material_number);
        $('#entnehmen_trivialname1_txt').html(pz_data.trivialname1);
        $('#entnehmen_trivialname2_txt').html(pz_data.trivialname2);
        $('#entnehmen_trivialname3_txt').html(pz_data.trivialname3);
        $('#entnehmen_Werkstoffzustand_txt').html(pz_data.mat_cond);

        if(pz_data.weld_mat == true)
        {
            $('#entnehmen_weld_mat_txt').html("Ja");
        }
        else
        {
            $('#entnehmen_weld_mat_txt').html("Nein");
        }
        $('#entnehmen_grundwerkstoff_pz_weld2').html(pz_data.pz_weld2);
        $('#entnehmen_scheisse_pz_weld3').html(pz_data.pz_weld3);
        $('#entnehmen_lieferant_txt').html(pz_data.org_name);

    }

});

$('.radio').change(function(){

    var val = $('#entnehmen_pz_id_hdn').val();
    var form = $("input[name='form']:checked").val();

    $.ajax({
        url : 'mat-select',
        type : 'POST',
        data: {val: val, form:form},
        dataType: 'json',
        beforeSend:function()
            {
            },
        error : function (data) {

        },
        success : function (data)
        {
            $('#part_select').html('');

            $.each( data, function(key,value)
            {
                value = $.trim(value);
                $('#part_select').append('<option value="'+key+'">'+value+'</option>');
            });
        },
    });
})


/****************Industrieauftrag/Forschungsvorhaben****************/

$("#neueIndustrieauftrag").click(function(){

    $.ajax({
        url: 'neue-industrieauftrag-form',
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

            $('.neueIndustrieauftragModalBody').html('');

            $('.neueIndustrieauftragModalBody').html(data);

            $("#neueAuftraggeber").click(function(){

                $.ajax({
                    url: 'neue-auftraggeber-form',
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

                        $('.neueAuftraggeberModalBody').html('');

                        $('.neueAuftraggeberModalBody').html(data);



                        $('#neueAuftraggeberModal').modal('show');

                    }
                });

            })

            $('#neueIndustireuftragModal').modal('show');

        }
    });

    getAuftraggeber()

})

function getAuftraggeber(){

    $.ajax({
        url : 'get-auftraggeber',
        type : 'POST',
        dataType: 'json',
        beforeSend:function()
        {

        },
        error : function (data) {


        },
        success : function (data) {

            $('#selAuftraggeber').html('');

            $.each( data, function(key,value)
            {
                $('#selAuftraggeber').append('<option value="' + value.id + '">' + $.trim(value.fullname) +'</option>');
            })

        },

    });

}

$('.neueIndustrieauftragModalSave').click(function(){

    var noerrors = true;

    $.each( $('.neueIndustrieauftragModalBody .mandatory:visible'), function( key, value )
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
            <label class="control-label col-md-5" style="font-weight: bold;">Auftrag Nummer:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static">'+$("#neueAuftragnummer").val()+'</p>\n\
            </div>\n\
        </div>\n\
        <div class="row">\n\
            <label class="control-label col-md-5" style="font-weight: bold;">Externer Ansprechpartner:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static" >'+$("#neueExtAnsprechpartner").val()+'</p>\n\
            </div>\n\
        </div>\n\
        <div class="row">\n\
            <label class="control-label col-md-5" style="font-weight: bold;">Interner Ansprechpartner:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static" >'+$("#neueIntAnsprechpartner").val()+'</p>\n\
            </div>\n\
        </div>\n\
        <div class="row">\n\
            <label class="control-label col-md-5" style="font-weight: bold;">Bemerkung / Kurztitel:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static">'+$("#neueKurztitel").val()+'</p>\n\
            </div>\n\
        </div>\n\
        <div class="row">\n\
            <label class="control-label col-md-5" style="font-weight: bold;">Auftraggeber:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static">'+$("#selAuftraggeber").val()+'</p>\n\
        </div>\n\
        <div class="row">\n\
            <label class="control-label col-md-5" style="font-weight: bold;">Datum:</label>\n\
            <div class="col-md-7" style="text-align: left;">\n\
                <p class="form-control-static">'+$("#newDatum").val()+'</p>\n\
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
                saveNeueIndustrieauftrag();
            }

        });

})

function saveNeueIndustrieauftrag()
{
    var dataString = $(".neue_industrieauftrag_input").serialize();

    $.ajax({
        type: "POST",
        url: "save-neue-industrieauftrag",
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

                $('#neueIndustireuftragModal').modal('hide');

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


/****************Auftraggeber****************/

$('.neueAuftraggeberModalSave').click(function(){

    var noerrors = true;

    $.each( $('.neueAuftraggeberModalBody .mandatory:visible'), function( key, value )
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
                saveNeueAuftraggeber();
            }

        });
})

function saveNeueAuftraggeber()
{
    var dataString = $(".neue_auftraggeber_input").serialize();

    $.ajax({
        type: "POST",
        url: "save-neue-auftraggeber",
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

                $('#neueAuftraggeberModal').modal('hide');
                getAuftraggeber();

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

/****************EntnehmenMenu****************/

$(".entnehmenTab3Menu").click(function(){
    var menu_index = $(this).attr("data-menu_index");
    $.ajax({
        type: "POST",
        url: "get-entnehmen-tab3-html",
        data: "menu_index="+menu_index,
        async: true,
        beforeSend:function(){

        },

        error: function (data) {

            return false;

        },

        success: function (data) {
            $(".entnehmenTab4").html(data);

            // JAVASCRIPT FOR THE ABOVE HTML COMES HERE
            if(menu_index == '1')
            {
                tab3menu1();
            }

            $(".matEntnehmenNext").trigger("click");

        }
    });

})

function tab3menu1()
{
    /****************LabelCreation****************/
    $('.radio').change(function (){

        newLabels();

    })

 function newLabels(){

     $("#anzahl").on('keyup', function () {

         var type = $('input[name="material_family[form]"]:checked').val();
         var count = parseInt($("#anzahl").val());
         var selected_part ={}
         var htmlMasse  = "";

         $("#part_select option:selected").each(function(key,value) {
             selected_part[$(value).val()] =  $(value).text();
         })

         $("#teilen").html("");

         $.each(selected_part, function(index, value){

             for(var i=1; i<=count; i++) {

                 if (type === 'wrought') {

                     var label = value.replace('origin', 'w_' + i);

                 }
                 else {

                     var label = value.replace('origin', 'b_' + i);
                 }

             htmlMasse +=
                 '<div class="form-group massePr">\n' +
                 '<label class="control-label col-xs-1" >'+label+'</label>\n' +
                 '<input type="hidden" name="partlabelNames[]" value="'+label+'">\n'+
                 '<input type="hidden" name="material_family['+label+'][parent_id]" value="'+index+'">\n'+
                 '<label class="control-label col-xs-3">Maß L x B x H (in mm)<span class="required">*</span></label>\n' +
                 '<div class=" col-xs-1">\n' +
                 '    <input class="form-control mandatory number" type="text"  size="5" name="material_family['+label+'][length_mm]">\n' +
                 '</div>\n' +
                 '<div class=" col-xs-1">\n' +
                 '    <input class="form-control mandatory number" type="text"  size="5" name="material_family['+label+'][width_mm]">\n' +
                 '</div>\n' +
                 '<div class=" col-xs-1">\n' +
                 '    <input class="form-control mandatory number" type="text"  size="5" name="material_family['+label+'][height_mm]">\n' +
                 '</div>\n' +
                 '\n' +
                 '<label for="mass" class="col-xs-2 control-label number">Gesamtmasse (in kg)<span class="required">*</span></label>\n' +
                 '<div class="col-xs-1">\n' +
                 '    <input class="form-control mandatory" type="text" size="5" name="material_family['+label+'][total_mass_kg]">\n' +
                 '</div>\n' +
                 '</div>';

             }
         })

         $(".massePr").remove();
         $(".werstattMasse").append(htmlMasse);

     })

 }

}


/****************Send Data to Backend****************/
$(".matEntnehmenSubmit").click(function(){


    var form = $("#matEntnehmenForm");
    var formdata = new FormData(form[0]);

    $.ajax({
        type: "POST",
        url: "save-entnehmen",
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
    })

});





