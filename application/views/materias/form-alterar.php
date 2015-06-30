<div class="col-sm-9 col-md-9 col-lg-9"> <!-- CONTEUDO DA DIREITA -->
    <h3>RENOMEAR MATÉRIA</h3>
    <div style="display:{vis_erros}">
        <div class="form-group">
            <h3>{tituloErros}</h3>
            {erros}
            <div class="alert alert-danger" role="alert" >{mensagem}</div>
            {/erros}
        </div>
    </div>

    <form method="post" action="{url}materias/alterar" enctype="multipart/form-data" role="form">
        <input type="hidden" name="sent" value="1"/>
        <input type="hidden" name="materia_id" value="{materia_id}"/>
        <input type="hidden" name="materia_icone2" value="{materia_icone}"/>

        <div class="form-group">
            <span class="btn btn-success fileinput-button enable" >
                <label for="materia_icone"><span>CLIQUE PARA TROCAR O ICONE:</span></label>
                    <input type="file" class="btn btn-success" name="materia_icone" id="materia_icone" />
            </span>
        </div>
        <div class="form-group">
            <img src="{materia_icone}" width="110" height="66"/>
        </div>
        <div class="form-group">
            <label for="materia_nome">Categoria:</label>
            <input type="text" class="form-control" name="materia_nome" id="materia_nome" value="{materia_nome}"/>
        </div>

        <button class="btn btn-success" type="submit">SALVAR</button>
        <button class="btn btn-primary" type="button" onclick="location.href = '{url}materias';" >VOLTAR</button>					
    </form>

</div>