<div class="col-sm-9 col-md-9 col-lg-9"> <!-- CONTEUDO DA DIREITA -->
    <h3>CADASTRO DE USU&Aacute;RIOS</h3>
    
    <div class="painel_conteudo">
        <div style="display:{vis_erros}">
            <div class="form-group">
                <h4>{tituloErros}</h4>			
                {erros}
                <div class="alert alert-danger" role="alert" >{mensagem}</div>
                {/erros}
            </div>		
        </div>
        <form action="{url}usuarios/alterar" role="form" method="post">
            <input type="hidden" name="id" value="{id}"/>
            <input type="hidden" name="usuarioId" id="usuarioId" value="{usuarioId}" />
            
            
            <div class="form-group" >
                    <img border="0" title="Clique para alterar a foto" src="{url}image/usuarios/foto_homem.png" width="90" height="90" class="ui-corner-slider" style="border-radius:20px;cursor:pointer;" onclick="openWinFoto()"/>
            </div>
            
            <div class="form-group">
                <label for="nome">Sexo</label>
                <br />
                <label for="nome">Feminino</label>
                <input type="radio"  id="sexoM" name="sexo"  {checked}>
                <label for="nome">Masculino</label>
                <input type="radio"  id="sexoF" name="sexo"  {checked}>
            </div>
            
            
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{nome}" placeholder="Nome Completo">
            </div>
            <div class="form-group"> 
                <div class="row">
                    <div class="col-xs-4">
                        <label for="usuario">Nome de usuário</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="{usuario}" placeholder="Login">
                    </div>
                    <div class="col-xs-8">     
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{email}" placeholder="Email">
					</div>
	            </div>
            </div>
            <div class="form-group"> 
                <div class="row">
                    <div class="col-xs-4">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="{telefone}" placeholder="Telefone">
					</div>
                    <div class="col-xs-8">
                        <label for="categoria">Categoria:</label>
                        <select name="categoria" id="categoria" class="form-control">
                            {categorias}
                            <option value="{categoria_id}" {categoria_selected}>{categoria_nome}</option>
                            {/categorias}
                        </select>
					</div>
				</div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-4">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password"  placeholder="Senha">
					</div>
				</div>
            </div>
            <div class="form-group">    
                <div class="row">
                    <div class="col-xs-4">
                        <label for="passwordCopia">Confirmar Senha</label>
                        <input type="password" class="form-control" id="passwordCopia" name="passwordCopia"  placeholder="Digite novamente sua Senha">
					</div>
				</div>
            </div>
            <button class="btn btn-success" type="submit">SALVAR</button>
            <button class="btn btn-primary" type="button" onclick="location.href='{url}/usuarios'" >VOLTAR</button>
            
        </form>
    </div>
</div>


<script type="text/javascript">
    var winFoto;
    function openWinFoto()
    {
        winFoto = window.open('{url}usuarios/alterarFoto?idUsuario={id}', '', 'width=520,height520,left=30,top=30');
    }
    function closeWinFoto()
    {
        winFoto.close();
    }
    aumentarDiv();

</script>

