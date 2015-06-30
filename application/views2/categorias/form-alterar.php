<div class="col-sm-9 col-md-9 col-lg-9"> <!-- CONTEUDO DA DIREITA -->
    <h3>RENOMEAR CATEGORIA</h3>
    
    <div class="painel_conteudo">
        <div style="display:{vis_erros}">
            <div class="form-group">
                <h3>{tituloErros}</h3>
                {erros}
                    <div class="alert alert-danger" role="alert" >{mensagem}</div>
                {/erros}
            </div>
        </div>
    
        <form method="post" action="{url}categorias/alterar" role="form">
            <input type="hidden" name="sent" value="1"/>
            <input type="hidden" name="categoria_id" value="{categoria_id}"/>
            
            <div class="form-group">
                <label for="categoria_nome">Categoria:</label>
                <input type="text" class="form-control" name="categoria_nome" id="categoria_nome" value="{categoria_nome}"/>
            </div>
            
            <button class="btn btn-success" type="submit">SALVAR</button>
            <button class="btn btn-primary" type="button" onclick="location.href='{url}categorias';" >VOLTAR</button>					
        </form>
    </div>
</div>
