<div>
<a href="{url}aulas/cadastrar">Cadastrar Aulas</a>
</div>

<h3>Lista de aulas cadastradas</h3>
<table border='1px' >
    <tr>
    <th>titulo</th>
    <th>Curso</th>
    <th>matéria</th>
    <th>Tefelone</th>
    <th>categoria</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    </tr>
    {aulas}
    <tr>
        <td>{aula_titulo}</td>
        <td>{curso_nome}</td>
        <td>{materia_nome}</td>
        <td>{usuario_admin_telefone1}</td>
        <td>{categoria_nome}</td>
        
        <td><input type="button" onclick="location.href='{url}aulas/alterar/{aula_id}'" value="alterar"></td>
        <td><input type="button" value="Remover" onclick="remover({usuario_id}, '{aula_titulo}')"></td>
    </tr>   
    {/aulas}
</table>

<script type="text/javascript">
function remover(id, nome)
{
    if(confirm("Tem certeza que deseja remover o usuário "+nome))
    {
        location.href = "{url}usuarios/remover/"+id;
    }
}
</script>