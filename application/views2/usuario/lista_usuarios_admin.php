<div class="col-sm-9 col-md-9 col-lg-9"> <!-- CONTEUDO DA DIREITA -->
    <h3>CADASTRO DE USU&Aacute;RIOS</h3>
    <a href="{url}usuarios/cadastrar" type="button" class="btn btn-success margin-bottom-lg">NOVO USU&Aacute;RIO</a>

    <form method="post" role="form">
        <div class="row margin-bottom-lg">
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar usuários...">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary lupa" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </div>
        </div>
    
        <div id="paginacao">
            {paginacao}
        </div>        
    </form>
    <h4>USUÁRIOS ADMINISTRADORES</h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <th>NOME</th>
                <th>LOGIN</th>
                <th>EMAIL</th>
                <th>TELEFONE</th>
                <th>CATEGORIA</th>
                <th class="acoes" style="width:80px;">AÇÕES</th>
            </tr>
            {usuarios}
            <tr>
                <td>{usuario_admin_nome}</td>
                <td>{usuario_login}</td>
                <td>{usuario_email}</td>
                <td>{usuario_admin_telefone1}</td>
                <td>{categoria_nome}</td>
                <td>
                    <button type="button" title="Remover" class="btn btn-primary icone" onclick="remover({usuario_id}, '{usuario_admin_nome}')"><span class="glyphicon glyphicon-remove"></span></button>
                    <button type="button" title="Alterar" class="btn btn-primary icone" onclick="location.href = '{url}usuarios/alterar/{usuario_id}'"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
            </tr>   
            {/usuarios}
        </table>
    </div>
</div> <!-- FECHA CONTEUDO DA DIREITA -->
<script type="text/javascript">
    function remover(id, nome)
    {
        if (confirm("Tem certeza que deseja remover o usuário " + nome))
        {
            location.href = "{url}usuarios/remover/" + id;
        }
    }
</script>