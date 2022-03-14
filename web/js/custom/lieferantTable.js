var tableLieferant = $('#lieferantTable');  
var otableLieferant = "";

var LieferantTable = (function () {
    "use strict";

    var init = function () {

            
        otableLieferant = tableLieferant.DataTable({
                columns: [
                    {
                        data: "fullname",
                   },
                   {
                        data: "street",
                   },
                   {
                        data: "zip",
                   },

                   {
                       data: "city",
                   },

                   {
                       data: "state",

                   },
                   {
                    data: "country",

                },
                   /**{
                    data: "phone1",

                    },**/

               ],
               "ajax": {
                           "url": 'get-material-lieferant',
                           "type": "POST",
                          /* "data": function ( d ) {
                               return $.extend( {}, d, {
                                 
                                // "patient":  patient_nbr

                               });
                             }*/

                         },
                "bSortCellsTop": true,
                "processing": false,
                "serverSide": false,
                "lengthMenu": [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
                "pageLength": 25,
                "autoWidth": false,
                "bPaginate": true,
               
               "language": {
                   url: '/material/web/plugins/de.json'
               },
               
               "pagingType": "bootstrap_full_number",
               "order": [],
               
           });
        
       
        
        $('#lieferantTable tbody').on('click', 'tr', function () {
            var data = otableLieferant.row( this ).data();

            $('#lieferantTable tbody tr').removeClass("highlight");
            $("#selectedRow,#material_matemat_owner").val("")

            if(!$(this).hasClass("highlight"))
            {
                
                $(this).addClass("highlight")

                $("#selectedRow").val(otableLieferant.row( this ).index())
                $("#material_mat_owner").val(data.id)
                
            }
            
            
        } );
    
        

    };

    return {
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            init();
        }
    };

}());