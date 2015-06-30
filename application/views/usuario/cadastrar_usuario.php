<div class="col-sm-9 col-md-9 col-lg-9"> <!-- CONTEUDO DA DIREITA -->
    <h3>CADASTRO DE USU&Aacute;RIOS</h3>
    <div class="painel_conteudo">
        <div id="divErro" style="display:{vis_erros}">
            <div class="form-group">
                <h4>{tituloErros}</h4>			
                {erros}
                <div class="alert alert-danger" role="alert" >{mensagem}</div>
                {/erros}
            </div>		
        </div>
        <div id="passo1">
            <form action="cadastrar" role="form" method="post" id="formUsuario">    
                <input type="hidden" name="usuarioId" id="usuarioId" value="{usuarioId}" />
                <input type="hidden" name="nomeFoto" id="nomeFoto" value="{nomeFoto}" />

                <div class="form-group" >
                    <img id="fotoUsuario" name="fotoUsuario" border="0" title="Clique para alterar a foto" {foto} width="90" height="90" class="ui-corner-slider" style="border-radius:20px;cursor:pointer;" onclick="openWinFoto()"/>
                </div>

                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{nome}" placeholder="Nome Completo">
                </div>

                <div class="form-group">
                    <label for="nome">Sexo</label>
                    <br />
                    <label for="sexoM">Masculino</label>
                    <input type="radio"  id="sexoM" name="sexo" value="M" {checkedMasculino}>
                    <label for="sexoF">Feminino</label>
                    <input type="radio"  id="sexoF" name="sexo"  value="F" {checkedFeminino}>
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
                        <div class="col-xs-12">
                            <label for="descricao">Descrição (se for professor escreva o curriculo)</label>
                            <textarea id="descricao" name="descricao" style="width: 100%;height: 140px;">{descricao}</textarea>
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
                            <input type="password" class="form-control" id="passwordCopia" name="passwordCopia"  placeholder="digite novamente sua Senha">
                        </div>
                    </div>
                </div>

                <button class="btn btn-success" type="submit">SALVAR</button>
                <button class="btn btn-primary" type="button" onclick="location.href = '{url}/usuarios'" >VOLTAR</button>
            </form>
        </div>
        <div id="passo2">
            <div id="conteudoPasso2"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //var modalFoto = $('#modalFoto');
    /*function openWinFoto(){
     genericModal('{url}usuarios/cadastrarFotoOutroUsuario');
     }
     */

    var winFoto;
    function openWinFoto()
    {
        winFoto = window.open('{url}usuarios/cadastrarFotoOutroUsuario', '', 'width=520,height520,left=30,top=30');
    }
    function closeWinFoto()
    {
        winFoto.close();
    }

    // tratar o passo 1 e o 2 dentro do form e so submiter no fim do processo agora como eu faço isso
    function cadastrarUsuarios() {
        var qs = $('#formUsuario').serialize();
        sendPost('usuarios/cadastrar', qs, function (idUsuario) {
            if (idUsuario !== 0) {
                $('#passo1').fadeIn(200, function () {
                    sendPost('usuarios/cadastrarFoto', {id: idUsuario}, function (result) {
                        $('conteudoPasso2').html(result);
                        $('#passo2').fadeOut(200);
                    });
                });
            }
        });
    }

</script>


