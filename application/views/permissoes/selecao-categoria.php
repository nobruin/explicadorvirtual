<div class="col-sm-9 col-md-9 col-lg-9"> <!-- CONTEUDO DA DIREITA -->
    <h3>DEFINI&Ccedil;&Atilde;O DE PERMISS&Otilde;ES</h3>

    <div class="painel_conteudo">
        <form id="formAcoesCategoria">
        <div class="form-group">
        	<div class="row">
				<div class="col-xs-6">
                <label for="categoria">Categoria de Usu&aacute;rios:</label>
                <select id="categoria" class="form-control" name="categoria" onchange="listarAcoes(this.value)">
                    <option value="">Selecione</option>
                    {categorias}
                    <option value="{categoria_id}">{categoria_nome}</option>
                    {/categorias}
                </select>
                </div>
			</div>
        </div>
        <div id="listaAcoes"></div>
        </form>
    </div>

</div>
<script>
function listarAcoes(idCategoria)
{
    if(idCategoria != '')
    {
        sendPost('{url}permissoes/acoes', {idCategoria:idCategoria}, function(data)
        {
            $('#listaAcoes').html(data);
        });
    }
}
</script>