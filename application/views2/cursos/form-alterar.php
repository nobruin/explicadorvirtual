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
    
        <form method="post" action="{url}cursos/alterar" role="form">
            <input type="hidden" name="sent" value="1"/>
            <input type="hidden" name="curso_id" value="{curso_id}"/>
            <div class="form-group">
                <label for="curso_nome">Categoria:</label>
                <input type="text" class="form-control" name="curso_nome" id="curso_nome" value="{curso_nome}"/>
            </div>
            
            <button class="btn btn-success" type="submit">SALVAR</button>
            <button class="btn btn-primary" type="button" onclick="location.href='{url}cursos';" >VOLTAR</button>					
        </form>
	</div>
</div>
