public class funcoes() {
    funcoes.load = function()
    {
        obterEstados ();
        obterCidadePorID ();
    }

    function obterEstados () {
        $.ajax({
            url: "http://api.aderleifilho.com/obterEstados",
            dataType: "text",
            success: function(data) {
                console.log('my message' + data);
                var json = $.parseJSON(data);
                $('#divEstados').html('<select id="estados" onchange="obterCidadePorID(this);">');
                for (var i = 0; i <= json.length - 1; i++) {
                    $('#estados').append('<option value=' + json[i].id + '>'+ json[i].nome +'</option>');
                };
                $('body').append('</select>');
            },    
            error: function(req, err){ console.log('my message' + err); }

        });
    }

    function obterCidadePorID (id) 
    {
        if (typeof id === "undefined") 
        {
            id = 1;
        } 
        else 
        {
            id = id.value;
        }

        $.ajax(
        {
            url: "http://api.aderleifilho.com/obterCidadesPorEstado/" + id,
            dataType: "text",
            success: function(data) {
                console.log('my message' + data);
                var json = $.parseJSON(data);
                $('#divCidades').html('<select id="cidades">');
                for (var i = 0; i <= json.length - 1; i++) {
                    $('#cidades').append('<option value=' + json[i].id + '>'+ json[i].nome +'</option>');
                };
                $('body').append('</select>');

            },    
            error: function(req, err){ console.log('my message' + err); }

        });
    }
}
