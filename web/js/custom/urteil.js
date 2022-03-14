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
        $('#form_wizard_1').find('.urteilZuruck').hide();
    } else {
        $('#form_wizard_1').find('.urteilZuruck').show();
    }

    if (current >= total) {
        $('#form_wizard_1').find('.urteilNext').hide();
        $('#form_wizard_1').find('.urteilSubmit').show();
    } else {
        $('#form_wizard_1').find('.urteilNext').show();
        $('#form_wizard_1').find('.urteilSubmit').hide();
    }

}

$('#form_wizard_1').bootstrapWizard({
    'nextSelector': '.urteilNext',
    'previousSelector': '.urteilZuruck',

    onNext: function (tab, navigation, index) {

        var isValidation = tab.data("validation");



        if(isValidation === "t")
        {
            var noerrors = eval("urteilTab"+index+"Validation()");



            if(!noerrors)
            {
                return false;
            }

            if(index == 2)
            {
                fileFieldgeneration();
            }
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

$('#form_wizard_1').find('.urteilZuruck,.urteilSubmit').hide();

function urteilTab1Validation()
{
    if($("#availablepz").val() === null)
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

function urteilTab2Validation()
{
    var noerrors = true;
    $.each( $('#tab2 .mandatory:visible'), function( key, value )
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

                swal({
                    title:"Hinweis!",
                    text: "Bitte füllen Sie die rot markierten Felder aus.",
                    type: 'error',
                    html: true
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

    if(parseInt($("#stuckzahl").val()) > 702) // 702 zz
    {
        $("#stuckzahl").closest('div').addClass('has-error');

        $('html, body').animate({
            scrollTop: $("#stuckzahl").offset().top
        });
        swal({
            title:"Hinweis!",
            text: "Stückzahl kann nicht großer als 702 sein.",
            type: 'error',
            html: true
        });

        noerrors = false;
        return false;
    }

    return noerrors;

}

function urteilTab3Validation()
{
    var noerrors = true;
    $.each( $('#tab3 .mandatory:visible'), function( key, value )
    {

        if($.trim($("#regal").val()) === "" || $.trim($("#ebene").val()) === "" || $.trim($("#palette").val()) === "")
        {
            $(this).closest('div').addClass('has-error');
            swal({
                title:"Hinweis!",
                text: "Bitte füllen Sie die Lager informationen.",
                type: 'error',
                html: true
            });

            noerrors = false;
            return false;
        }

    });

    return noerrors;
}

function urteilTab4Validation()
{
    var noerrors = true;
    $.each( $('#tab4 .mandatory:visible'), function( key, value )
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

                swal({
                    title:"Hinweis!",
                    text: "Bitte füllen Sie die rot markierten Felder aus.",
                    type: 'error',
                    html: true
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


$('#urteilForm .mandatory:visible').live('input change paste',function(){

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

});

$('.radio').change(function() {
    if ($('#radio_rohling').is(':checked')) {
        $('#art').closest('div').hide();
    }
    else{
        $('#art').closest('div').show();
    }
});


$('#mass').keydown(function (event) {


    if (event.shiftKey == true) {
        event.preventDefault();
    }

    if ((event.keyCode >= 48 && event.keyCode <= 57) ||
        (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 ||
         event.keyCode == 9 || event.keyCode == 37 ||
         event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

    } else {
        event.preventDefault();
    }

    if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
        event.preventDefault();

});



$('#regal,#ebene,#palette').keyup(function () {
    this.value = this.value.replace(/^0/, "1")

});

/*$('#regal,#ebene,#palette').keypress(function () {
    if(this.value.length == 1)
       return false
});*/

$('#regal,#ebene,#palette').bind('input change', function () {
    var lagerOrt = $('#regal').val() + '.' + $('#ebene').val() + '.' + $('#palette').val();
    $('#lagerort').val(lagerOrt);
});

function fileFieldgeneration()
{
    $(".photo_remaining").remove();
    var len = parseInt($("#stuckzahl").val());
    var pz_data = $("#availablepz").select2('data')[0];

    var start_label_id = pz_data['start_label_id'] + 1;
    var end_label_id = len + pz_data['start_label_id'];

    for (var i = start_label_id; i <= end_label_id; i++)
    {
        var prufzeichen = $("#availablepz").val();

        var label = ($("#radio_urteil").is(":checked")) ? (prufzeichen+'_'+colName(i-1)+'_origin') : (prufzeichen+'_b_'+i);

        if(i == start_label_id)
        {
            $(".next_child_id_hdn").val(start_label_id)
            $(".part_first_label_hdn").val(label);
            $(".part_first_label").html(label);
            $(".part_first_foto").attr("name","files["+label+"][]");

        }

        else
        {
            var html = '<tr class="photo_remaining">' +
                '<td style="padding-right: 10px; padding-bottom: 10px;">'+label+'</td>' +
                '<td style="padding-bottom: 10px;">' +
                '<input class="mandatory" accept="image/*" name="files['+label+'][]" type="file" multiple />' +
                '<input type="hidden" name="labelName[]" value="'+label+'">' +
                '<input type="hidden" name="nextChildId" value="'+start_label_id+'">' +
                '</td>' +
                '</tr>';

            $('#image_upload').append(html)
        }


    }

}

function colName(n) {
    var ordA = 'a'.charCodeAt(0);
    var ordZ = 'z'.charCodeAt(0);
    var len = ordZ - ordA + 1;

    var s = "";
    while(n >= 0) {
        s = String.fromCharCode(n % len + ordA) + s;
        n = Math.floor(n / len) - 1;
    }
    return s;
}


$("#isSingleFoto").change(function(){

   if($(this).is(":checked"))
   {
       $(".photo_remaining").css("display","none");
   }

   else
   {
       $(".photo_remaining").css("display","");
   }
});


$(".urteilSubmit").click(function(){

    if(!urteilTab3Validation())
    {
        return false;
    }

    var form = $("#urteilForm");
    var formdata = new FormData(form[0]);

    $.ajax({
        type: "POST",
        url: "save-material-family",
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


$("#availablepz").select2({
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
                            mat_cond: item.mat_cond,
                            trivialname1: item.trivialname1,
                            trivialname2: item.trivialname2,
                            trivialname3: item.trivialname3,
                            forename: item.forename,
                            surname: item.surname,
                            org_name: item.fullname,
                            start_label_id: item.start_label_id,
                            vpz_available:item.vpz_available,
                            standard_designation:item.standard_designation

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

$("#availablepz").change(function(){
    if($(this).val() === null)
    {
        $('.urteil_txt').html('');
    }

    else
        {
            var pz_data = $("#availablepz").select2('data')[0];

            $('#pz_hdn').val(pz_data.pz_id);

            $('#pz_txt').html(pz_data.text);
            $('#angelegt_txt').html(pz_data.forename +" "+ pz_data.surname);
            $('#standard_designation_txt').html(pz_data.standard_designation);
            $('#werkstoffnummer').html(pz_data.material_number);
            $('#trivialname1_txt').html(pz_data.trivialname1);
            $('#trivialname2_txt').html(pz_data.trivialname2);
            $('#trivialname3_txt').html(pz_data.trivialname3);
            $('#Werkstoffzustand_txt').html(pz_data.mat_cond);

            if(pz_data.weld_mat == true)
            {
                $('#weld_mat_txt').html("Ja");
            }
            else
            {
                $('#weld_mat_txt').html("Nein");
            }
            $('#grundwerkstoff_pz_weld2').html(pz_data.pz_weld2);
            $('#scheisse_pz_weld3').html(pz_data.pz_weld3);
            $('#lieferant_txt').html(pz_data.org_name);

            if (pz_data.vpz_available == true){
                $('#vpzUpload').prop('disabled', true);
            }
            else
            {
                $('#vpzUpload').prop('disabled', false);
            }

        }

    });
