<div class="col-sm-9 col-md-9 col-lg-9">
    <h3>VÍDEOS</h3>
    <a href="{url}videos/cadastrar" type="button" class="btn btn-success margin-bottom-md">CADASTRAR AULAS</a>
    
   <form method="post" role="form">   
        <div class="row margin-bottom-lg">
            <div class="col-lg-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar vídeos..." value="{busca}" name="busca" id="busca">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary lupa" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                    <br />
                    <span class="input-group-btn">
                        <a href="#" onclick="javascript:location.href='{url}videos/gerarRelatorioVideos'" >
                        <button class="btn btn-primary" type="button">Gerar Relatorio de videos</button>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </form>
    
    {paginacao}
    <h4>LISTA DE VÍDEOS</h4>
    <table class="table table-striped table-bordered">
        <tr>
            <th style="width:220px;">VÍDEO</th>
            <th>TÍTULO</th>
            <th class="acoes" style="width:80px;">AÇÕES</th>
        </tr>
        {videos}
        <tr>
            <td>
                <iframe src="https://player.vimeo.com{video_vimeo_id}?title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0" 
                     width="200" 
                     height="130"
                     frameborder="0"
                     title="M7igor 065" 
                     webkitallowfullscreen mozallowfullscreen allowfullscreen>             
                </iframe>
            </td>
            <td>{video_titulo}</td>
            <td>
                <button type="button" title="Remover" class="btn btn-primary icone" onclick="remover({video_id}, '{video_titulo}')"><span class="glyphicon glyphicon-remove"></span></button>
                <!-- <button type="button" title="Alterar" class="btn btn-primary icone" onclick="location.href = '{url}videos/alterar/{video_id}'"><span class="glyphicon glyphicon-pencil"></span></button> -->
            </td>
        </tr>   
        {/videos}
    </table>
    {paginacao}
</div>
<script type="text/javascript">
    function remover(id, titulo)
    {
        if (confirm("Tem certeza que deseja remover o video " + titulo))
        {
            location.href = "{url}videos/remover/" + id;
        }
    }
</script>