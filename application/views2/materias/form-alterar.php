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

        <form method="post" action="{url}materias/alterar" role="form">
            <input type="hidden" name="sent" value="1"/>
            <input type="hidden" name="materia_id" value="{materia_id}"/>
            <div class="form-group">
                <label for="materia_nome">Categoria:</label>
                <input type="text" class="form-control" name="materia_nome" id="materia_nome" value="{materia_nome}"/>
            </div>
            
            <button class="btn btn-success" type="submit">SALVAR</button>
            <button class="btn btn-primary" type="button" onclick="location.href='{url}materias';" >VOLTAR</button>					
        </form>

</div>