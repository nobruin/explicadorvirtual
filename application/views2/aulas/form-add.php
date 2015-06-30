<div class="col-sm-9 col-md-9 col-lg-9">
    <div id="divErro" style="display:{vis_erros}">
        <div class="form-group">
            <h4>{tituloErros}</h4>			
            {erros}
            <div class="alert alert-danger" role="alert" >{mensagem}</div>
            {/erros}
        </div>		
    </div>
    <form action="cadastrar" role="form" method="post">
        <input type="hidden" name="usuarioId" id="usuarioId" value="{usuarioId}" />
        <h5>
            Cadastro de usuários:
        </h5>
        <div class="form-group">
            <label class="sr-only" for="nome">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{nome}" placeholder="Nome Completo">
        </div>
        <div class="form-group">
            <label class="sr-only" for="aula">Nome de usuário</label>
            <input type="text" class="form-control" id="aula" name="aula" value="{aula}" placeholder="Login">
        </div>
        <div class="form-group">            
            <label class="sr-only" for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="{telefone}" placeholder="Telefone">
        </div>
        <div class="form-group">
            <label class="sr-only" for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{email}" placeholder="Email">
        </div>
        <div class="form-group">
            <div  class="col-sm-6">
                <label for="categoria">Categoria:</label>
                <select  name="categoria" id="categoria">
                    {categorias}
                    <option value="{categoria_id}" {categoria_selected}>{categoria_nome}</option>
                    {/categorias}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="sr-only" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password"  placeholder="Senha">
        </div>

        <div class="form-group">    
            <label class="sr-only" for="passwordCopia">Password</label>
            <input type="password" class="form-control" id="passwordCopia" name="passwordCopia"  placeholder="digite novamente sua Senha">
        </div>
        <button class="btn btn-success" type="submit">Salvar</button>
        <button class="btn btn-success" type="button" onclick="location.href = '{url}/aulas'" >Voltar</button>
    </form>
</div>

<script type="text/javascript">
    aumentarDiv();
</script>


