<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>API Cidades e Estados</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="funcoes.js"></script>

    <link rel="stylesheet" type="text/css" href="style.css"	>
</head>
<body onload="load()">
    <div class="container">

        <header>
            <h1>Cidades e Estados API</h1>
        </header>

        <article>
            <!-- SOBRE A API -->
            <div id="sobre-a-api" class="sobre-a-api">
                <h2>Sobre a API</h2>
                <p>A Cidades e Estados é uma API simples que fornece as cidades por estados.</p>
            </div>

            <hr>

            <!-- MÉTODOS -->
            <div id="metodos" class="metodos">

                <h2>Métodos disponíveis</h2>
                <p>Por enquanto, apenas dois métodos estão disponíveis para consulta. Um deles retorna todos os estados brasileiros e o outro retorna as cidades para um determiando estado.</p>

                <h3>obterEstados()</h3>
                <p>Este método retorna todos os estados brasileiros.</p>
                <p><span>Atributos</span></p>
                <ul>
                    <li>int id: Armazena a ID do estado para consulta das cidades. Exemplo: 26</li>
                    <li>string nome: Armazena o nome do estado. Exemplo: São Paulo</li>
                    <li>string uf: Armazena a sigla de Unidade Federativa. Exemplo: SP</li>
                </ul>

                <p>URL de request: http://api.aderleifilho.com/obterEstados</p>

                <h3>obterCidadesPorEstado(id)</h3>
                <p>Este método retorna todos as cidades do estado selecionado.</p>
                <p><span>Atributos</span></p>
                <ul>
                    <li>int id: Armazena a ID da cidaded para consulta das cidades. Exemplo: 5001</li>
                    <li>string nome: Armazena o nome da cidade. Exemplo: Jundiaí</li>
                </ul>

                <p>URL de request: http://api.aderleifilho.com/obterCidadesPorEstado/{id}</p>


            </div>

            <hr>


            <!-- EXEMPLOS -->
            <div id="exemplos" class="exemplos">
                <h2>Exemplo</h2>
                <p>Implantação para seleção de cidade via caixa de seleção</p>
                <div id="exemplo" class="exemplo">
                    <!-- Caixa de Seleção de estados-->
                    <div id="divEstados" class="styled-select slate"></div>
                    <!-- Caixa de Seleção de cidades-->
                    <div id="divCidades" class="styled-select slate"></div>
                </div>


            </div>


        </article>

        <footer>
            <div><h6>Licença GNU GPL2 - aderleifilho.com</h6></div>
        </footer>
    </div>
    <script type="text/javascript">
    function load()
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
    </script>
</body>
</html>
