<div>    
    <div>                    
        <div class="panel panel-default">
            <div class="panel-heading">
					<div class="panel-title">Renomear curso</div>
			</div>   

			<div style="padding:30px" class="panel-body" >
				<div style="display:{vis_erros}">
					<div class="form-group">
						<h3>{tituloErros}</h3>
						{erros}
							<div class="alert alert-danger" role="alert" >{mensagem}</div>
						{/erros}
					</div>
				</div>


				<form method="post" action="{url}cursos/alterar" class="form-horizontal" role="form">
					<input type="hidden" name="sent" value="1"/>
					<input type="hidden" name="curso_id" value="{curso_id}"/>
					<div class="form-group">
						<div  class="col-sm-12">
							<label for="curso_nome">Categoria:</label>
							<br/>
							<input type="text" class="form-control" name="curso_nome" id="curso_nome" value="{curso_nome}"/>
					
						</div>
					</div>
					
					<button class="btn btn-success" type="submit">Salvar</button>
					<button class="btn btn-success" type="button" onclick="location.href='{url}cursos';" >Voltar</button>					
				</form>

			</div>
		</div>
	</div>
</div>