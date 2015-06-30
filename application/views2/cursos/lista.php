<div class="col-sm-9 col-md-9 col-lg-9"> <!-- CONTEUDO DA DIREITA -->
    <h3>CADASTRO DE CURSOS</h3>
    <a href="{url}cursos/cadastrar" type="button" class="btn btn-success margin-bottom-lg">NOVO CURSO</a>
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <th>CURSOS</th>
                <th class="acoes" style="width:80px;">AÇÕES</th>
            </tr>
            {cursos}
            <tr>
                <td>{curso_nome}</td>
                <td>
                    <!--<button type="button" title="Remover" class="btn btn-primary icone" onclick="remover({curso_id}, '{curso_nome}')"><span class="glyphicon glyphicon-remove"></span></button>-->
                    <button type="button" title="Renomear" class="btn btn-primary icone" onclick="location.href='{url}cursos/alterar/{curso_id}'"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
            </tr>
            {/cursos}
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