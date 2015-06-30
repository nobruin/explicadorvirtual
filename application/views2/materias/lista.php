<div class="col-sm-9 col-md-9 col-lg-9"> <!-- CONTEUDO DA DIREITA -->
    <h3>CADASTRO DE MAT&Eacute;RIAS</h3>
    <a href="{url}materias/cadastrar" type="button" class="btn btn-success margin-bottom-lg">NOVA MATÉRIA</a>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <th>MATÉRIA</th>
                <th class="acoes" style="width:80px;">AÇÕES</th>
                <!--<th>&nbsp;</th>-->
            </tr>
            {materias}
            <tr>
                <td>{materia_nome}</td>
                <td>
                    <!--<button type="button" title="Remover" class="btn btn-primary icone" onclick="remover({materia_id}, '{materia_nome}')"><span class="glyphicon glyphicon-remove"></span></button>-->
                    <button type="button" title="Renomear" class="btn btn-primary icone" onclick="location.href='{url}materias/alterar/{materia_id}'"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
            </tr>
            {/materias}
        </table>
    </div>
</div>
<script>
function remover(id, nome)
{
    if(confirm("Tem certeza que deseja remover a materia "+nome+"?"))
    {
        location.href = "{url}materias/remover/"+id;
    }
}
</script>