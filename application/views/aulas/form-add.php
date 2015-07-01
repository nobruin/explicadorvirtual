
<div class="col-sm-9 col-md-9 col-lg-9">
    <h3>CADASTRAR DE AULAS</h3>
    <br />
    <div id="divErro" style="display:none;">
        <div class="form-group">
            <h4>{tituloErros}</h4>			
            {erros}
            <div class="alert alert-danger" role="alert" >{mensagem}</div>
            {/erros}
        </div>		
    </div>
    <div id="passo1">
        <form action="cadastrarArquivosAula" id="formAula1" enctype="multipart/form-data" role="form" method="post">

            <div id="files" class="files"></div>
            <div class="form-group">
                <span class="btn btn-success fileinput-button enable" style="width: 300px;">
                    <label for="curso_icone"><span>CLIQUE PARA ADICIONAR O PDF DA AULA:</span></label>
                    <input type="file" class="btn btn-success" name="curso_icone" id="curso_icone" />
                </span>
            </div>

            <div class="form-group">
                <span class="btn btn-success fileinput-button enable" style="width: 300px;" >
                    <label for="curso_icone"><span>CLIQUE PARA ADICIONAR O MAPA DA AULA:</span></label>
                    <input type="file" class="btn btn-success" name="curso_icone" id="curso_icone" />
                </span>
            </div>


            <button class="btn btn-success" type="button" onclick="cadastraArquivosAula()">SALVAR</button>
            <button class="btn btn-primary" type="button" onclick="location.href = '{url}aulas';" >VOLTAR</button>
        </form>
    </div>

    <div  id="passo2" style="display: none;">

    </div>
</div>

<script type="text/javascript">

    

    function cadastraArquivosAula() {

        var qs = $('#formAula1').serialize();

        sendPost("{url}aulas/cadastrarArquivosAula", qs, function (result) {
            alert(result);
        });
    }    
</script>


