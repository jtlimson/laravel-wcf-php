$(document).ready( function () {    
    $("#table").on('click',".empinfo", function(){    
        $("#xr").html("");
        console.log("triggered");
        var data =( $(this).data('pin').toString().length  > 6 ) ?  $(this).data('pin').toString().substr(2,6) : $(this).data('pin').toString();     
        $.get("http://smd-ws/RMS/api/WebServiceAPI/SearchRemitter" , { query : data } , function( response ){
            console.log(response);
            response.forEach(function(item){               
                $("#xr").append(item.name.toString() + " - " + item.value1.toString()  +  "<br />");
            });            
        });
    });
     
});

function formatDate(date) {     
    date = new Date(date);
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();
    return  year  + '/' + (monthIndex + 1) + '/' + (day + 1) ;
}
