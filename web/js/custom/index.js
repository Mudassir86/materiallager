$(document).ready(function(e){

    if(window.history.replaceState){

        window.history.replaceState(null,null,window.location.href);

    }

    $("#main_search_btn").click(function(){

        mainSearch()
    })

    $("#main_search_category").change(function(){

        if ($('#main_search_text_sel').hasClass("select2-hidden-accessible")) {
            // Select2 has been initialized
            $("#main_search_text_sel").select2("destroy");
        }

        $("#main_search_text_sel").select2({
            placeholder: 'Suchen',
            tags: true,
            createTag: function (params) {
                var term = $.trim(params.term);


                if (term === '') {
                    return null;
                }

                return {
                    id: "-1~~"+term,
                    text: term,
                    newTag: true
                }


            },
            ajax: {
                url: "get-"+$("#main_search_category").val(),
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
                                text: item.text,
                                id: item.text
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


        })



    })

    $("#main_search_text_sel").change(function(){

       // console.log($(this).select2('data'));


        if($(this).val() !== null && $(this).val() !== "")
        {
            mainSearch();
        }
    });


    $("#main_search_text").keyup(function(evt){

        if($.trim($(this).val()) === "")
        {
            $('.main_search_data').html('');
        }
    });

    $("#main_search_category").change();


});


function uniqid() {
    var ts=String(new Date().getTime()), i = 0, out = '';
    for(i=0;i<ts.length;i+=2) {
        out+=Number(ts.substr(i, 2)).toString(36);
    }
    return ('d'+out);
}

function mainSearch()
{
   if($.trim($("#main_search_category").val()) === "" || $.trim($("#main_search_text_sel").val()) === "" || $.trim($("#main_search_text_sel").val()) === null)
   {
       swal({
           title: 'Hinweis',
           text: "Bitte wählen Sie eine Kategorie und geben Sie etwas in das Suchfeld ein.",
           type: 'error',
           html: true
       });
       return false;
   }
   else
   {
       $("#main_search_form").submit();
   }

}

$("#neuMaterial").click(function (){
    $('#materialOptionModal').modal('show');

})

$(".prufzeichen_link").live("click",function(){

    $("#main_search_category").html('<option selected value = "prufzeichen"></option>').change();

   $("#main_search_text_sel").html('<option selected value="'+$(this).attr("data-pz")+'">'+$(this).attr("data-pz")+'</option>').change();
})

$(".urteile_link").live("click",function(){

    $("#main_search_category").html('<option selected value = "urteile">').change();

    $("#main_search_text_sel").html('<option selected value="'+$(this).attr("data-pz")+'">'+$(this).attr("data-pz")+'</option>').change();
})

