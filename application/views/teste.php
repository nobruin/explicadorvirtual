<DOCTYPE html>
    <html>
        <head>
            <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
            <script type="text/javascript">
                $(function () {
                    $("#minhaDiv").hide();
                    $("#btnTeste").click(function () {
                        //Sem parâmetros: o efeito é executado em 400ms
                        $("#minhaDiv").fadeIn();
                        //Parâmetro com a duração em ms do efeito
                        $("#minhaDiv").fadeIn(1000);
                        //Parâmetro slow: o efeito é executado em 600ms
                        $("#minhaDiv").fadeIn("slow");
                        //Parâmetro fast: o efeito é executado em 200ms
                        $("#minhaDiv").fadeIn("fast");
                        //Informada duração e função de callback
                        $("#minhaDiv").fadeIn("fast",
                                function () {
                                    alert("fade concluido");
                                }
                        );
                    });
                });
            </script>
        </head>
        <body>
            <button id="btnTeste">Clique aqui</button>
            <div id="minhaDiv" style="height:100px; width:100px; background:green"/>
        <body>
    </html>
