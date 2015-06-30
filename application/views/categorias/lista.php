<div class="col-sm-9 col-md-9 col-lg-9"> <!-- CONTEUDO DA DIREITA -->
    <h3>CADASTRO DE CATEGORIAS</h3>
    <a href="{url}categorias/cadastrar" type="button" class="btn btn-success margin-bottom-lg">NOVA CATEGORIA</a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <th>CATEGORIA</th>
                <th class="acoes" style="width:80px;">AÇÕES</th>
            </tr>
            {categorias}
            <tr>
                <td>{categoria_nome}</td>
                <td>
                <!-- <button type="button" title="Remover" class="btn btn-primary icone" onclick="remover({categoria_id}, '{categoria_nome}')"><span class="glyphicon glyphicon-remove"></span></button> -->                    
                <button type="button" title="Renomear" class="btn btn-primary icone" onclick="location.href='{url}categorias/alterar/{categoria_id}'"><span class="glyphicon glyphicon-pencil"></span></bu
            </tr>
            {/categorias}
        </table>
    </div>
</div>
<script>
function remover(id, nome)
{
    if(confirm("Tem certeza que deseja remover a categoria "+nome+"?"))
    {
        location.href = "{url}categorias/remover/"+id;
    }
}
</script>