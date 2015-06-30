<table class="table table-bordered table-striped">
    {acoes}
    <tr>
        <td style="width:50px;"><input type="checkbox" name="acoes[]" value="{acao_id}" {checked} id="acao_{acao_id}"/></td>
        <td><label for="acao_{acao_id}">{acao_nome}</label></td>
    </tr>
    {/acoes}
</table>
<input type="button" class="btn btn-success" value="SALVAR" onclick="salvarPermissoes()" />
<script>
function salvarPermissoes()
{
    var info = $('#formAcoesCategoria').serialize();
    sendPost('{url}permissoes/salvar', info, function(data)
    {
        if(data == 1) alert("Permissões salvas com sucesso!");
    });
}
</script>