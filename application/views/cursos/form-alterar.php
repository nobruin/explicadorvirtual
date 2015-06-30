<div class="col-sm-9 col-md-9 col-lg-9"> <!-- CONTEUDO DA DIREITA -->
    <h3>RENOMEAR CURSOS</h3>

    <div class="painel_conteudo">                  
        <div style="display:{vis_erros}">
            <div class="form-group">
                <h3>{tituloErros}</h3>
                {erros}
                <div class="alert alert-danger" role="alert" >{mensagem}</div>
                {/erros}
            </div>
        </div>    

        <form method="post" action="{url}cursos/alterar" enctype="multipart/form-data" role="form">
            <input type="hidden" name="sent" value="1"/>
            <input type="hidden" name="curso_id" value="{curso_id}"/>
            <input type="hidden" name="curso_icone2" value="{curso_icone}"/>

            <div class="form-group">
                <span class="btn btn-success fileinput-button enable" >
                    <label for="curso_icone"><span>CLIQUE PARA TROCAR O ICONE:</span></label>
                    <input type="file" class="btn btn-success" name="curso_icone" id="curso_icone" />
                </span>
            </div>
            <div class="form-group">
                <img src="{curso_icone}" width="110" height="66"/>
            </div>

            <div class="form-group">
                <label for="curso_nome">Categoria:</label>
                <input type="text" class="form-control" name="curso_nome" id="curso_nome" value="{curso_nome}"/>
            </div>

            <button class="btn btn-success" type="submit">SALVAR</button>
            <button class="btn btn-primary" type="button" onclick="location.href = '{url}cursos';" >VOLTAR</button>					
        </form>
    </div>
</div>
