<!DOCTYPE html>
<html>
    <head>
        <title>Alterar Foto</title>

        <link href='{url}css/explicador_virtual.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{url}css/jquery.Jcrop.css" type="text/css" />
        <link rel="stylesheet" href="{url}css/bootstrap.css" type="text/css" />
        <script type="text/javascript" src="{url}js/jquery.js"></script>
        <script type="text/javascript" src="{url}js/jquery-ui.js"></script>
        <script type="text/javascript" src="{url}js/jquery.Jcrop.js"></script> 


        <script type="text/javascript">
            //jQuery(function($)
            var jcrop_api, boundx, boundy, testeJCrop;
            function cortarFotoCorretor()
            {
                if (jcrop_api)
                    jcrop_api.destroy();

                testeJCrop = $('#fotoTempMaior').Jcrop(
                        {
                            bgFade: true,
                            bgOpacity: .3,
                            onChange: updatePreview,
                            onSelect: updatePreview,
                            setSelect: [50, 50, 200, 200],
                            aspectRatio: 1,
                            minSize: [90, 90]
                        },
                function ()
                {
                    var bounds = this.getBounds();
                    boundx = bounds[0];
                    boundy = bounds[1];

                    jcrop_api = this;
                }
                );
                function updatePreview(c)
                {
                    if (parseInt(c.w) > 0)
                    {
                        if (boundx == null || boundx == undefined)
                            boundx = document.getElementById('fotoTempMaior').width;
                        if (boundy == null || boundy == undefined)
                            boundx = document.getElementById('fotoTempMaior').height;

                        var rx = 90 / c.w;
                        var ry = 90 / c.h;
                        $('#fotoTempMenor').css({
                            width: Math.round(rx * boundx) + 'px',
                            height: Math.round(ry * boundy) + 'px',
                            marginLeft: '-' + Math.round(rx * c.x) + 'px',
                            marginTop: '-' + Math.round(ry * c.y) + 'px'
                        });

                        $('#x').val(c.x);
                        $('#y').val(c.y);
                        $('#x2').val(c.x2);
                        $('#y2').val(c.y2);
                        $('#w').val(c.w);
                        $('#h').val(c.h);
                    }
                }
                ;
            }

            $(document).ready(function ()
            {
                $('#botaoFinalizarAdicaoFoto').click(function ()
                {
                    $(this).val('Salvando...');
                    $(this).attr('disabled', true);
                    $('#formFinalizarFotoCorretor').submit();
                });
                $('#campoFotoCorretor').change(function ()
                {
                    $('#formFotoCorretor').submit();
                    $('#divBtEscolherFoto').html('Escolhendo...');
                });
                $('#botaoRemoverFotoCorretor').click(function ()
                {
                    jConfirm("Tem certeza que deseja remover a foto do seu perfil?", "Atenção:", function (resp)
                    {
                        if (resp)
                        {
                            $('#formFotoCorretor').attr('action', '{url}usuario/removerFoto');
                            $('#formFotoCorretor').submit();
                        }
                    });
                });

                $('#botaoCancelarAdicaoFoto').click(function ()
                {
                    $('fotoTempMaior').attr('src', '');

                    $('#divBtFinalizarFoto').hide();
                    $('#preVisualizacao').hide();

                    $('#divAvisoCortarFoto').show();

                    $('#botaoRemoverFotoCorretor').show();
                    $('#divCampoUpload').show();

                    $('#divExplicacaoFormato').show();
                });
            });
            //});
        </script>
    </head>
    <body>
        <div style="margin:10px;">
            <div id="divFormAdicionarFoto" style="float:left;width:180px;">
                <br />
                <br />
                <br />
                <form id="formFotoCorretor" action="{url}usuarios/alterar_foto_passo2" method="post" enctype="multipart/form-data" target="controleUploadFoto">

                    <input type="hidden" name="idUsuario" value="{idUsuario}" />
                    <div style="display:{visBtRemover};">
                        <input type="button" class="bt_azul_geral" value="Remover Foto" id="botaoRemoverFotoCorretor" />
                        <br /><br />
                    </div>
                    <div id="divCampoUpload" style="cursor:pointer;width:133px;height:35px;overflow:hidden;background:url('') no-repeat left top;">
        <!--		<input type="button" class="bt_azul_geral" value="{rotBtAddFoto}" id="botaoDefinirFoto" /> -->
                        <div class="btn btn-success" style="cursor:pointer;position:absolute;color:#ffffff;font-family:'Trebuchet MS';font-size:10pt;width:133px;height:35px;text-align:center;padding-top:8px;" id="divBtEscolherFoto">
                            Escolher Foto
                        </div>
                        <input type="file" name="foto" id="campoFotoCorretor" style="cursor:pointer;position:absolute;width:133px;height:35px;opacity:0;filter:alpha(opacity=00);" />
                    </div>
                    <div style="width:133px;text-align:center;" class="textoGeral1" id="divExplicacaoFormato">Somente Imagens no Formato JPG</div>


                </form>
                <div id="preVisualizacao" style="display:none">
                    <div>Pr&eacute;-visualiza&ccedil;&atilde;o:</div>
                    <div style="width:90px;height:90px;overflow:hidden;">
                        <img id="fotoTempMenor" alt="Pr&eacute;-visualiza&ccedil;&atilde;o" title="Pr&eacute;-visualiza&ccedil;&atilde;o" />
                    </div>
                </div>
            </div>
            <div id="divFormRedimencionarFoto">
                <form id="formFinalizarFotoCorretor" action="{url}usuarios/alterar_foto_fim" method="post" enctype="multipart/form-data" target="controleUploadFoto">
                    <input type="hidden" name="idUsuario" value="{idUsuario}" />
                    <input type="hidden" name="x" id="x" />
                    <input type="hidden" name="y" id="y" />
                    <input type="hidden" name="x2" id="x2" />
                    <input type="hidden" name="y2" id="y2" />
                    <input type="hidden" name="w" id="w" />
                    <input type="hidden" name="h" id="h" />

                    <div class="textoGeral1" style="margin-bottom:5px;">Selecione a &aacute;rea desejada para recortar a foto.</div>
                    <div id="divAvisoCortarFoto" style="border: 1px solid #999999; float: left; width: 500px; background-color: #FFFFFF; border-radius:3px; text-align: justify; padding: 60px;"><h2 style="text-align:center">IMPORTANTE</h2><p>
                        </p><p>
                            Essa foto precisa representar voc&ecirc; como <strong>profissional</strong>. 
                        </p>     
                        <p> Veja abaixo nossas sugest&otilde;es e solicita&ccedil;&otilde;es para inclus&atilde;o da foto:</p>
                        <ul>
                            <li>Pedimos para que n&atilde;o sejam inseridas imagens de terceiros, amigos, familiares ou conjunto de pessoas.</li><br>
                            <li>Imagens com apelo de vendas de qualquer produto, logomarcas de outras empresas e/ou pessoas jur&iacute;dicas.</li><br>
                            <li>A sua foto n&atilde;o deve ter telefones, endere&ccedil;os de sites, blogs, hotsites, redes sociais pessoais, etc.. Seus dados de contato j&aacute; est&atilde;o em seu site pessoal.</li>
                        </ul>    
                        <p> Nos resguardamos o direito de remover ou substituir a foto/imagem cadastrada se estiver em desacordo com estas solicita&ccedil;&otilde;es e/ou sugest&otilde;es.</p> 

                    </div>

                    <div style="display:none;float:left;width:500px;" id="divBtFinalizarFoto">
                        <div style="margin-bottom:2px;"><img id="fotoTempMaior" /></div>
                        <input type="button" id="botaoFinalizarAdicaoFoto" value="Salvar Foto" class="bt_azul_geral" />
                        <input type="button" id="botaoCancelarAdicaoFoto" value="Cancelar" class="bt_azul_geral" />
                    </div>

                </form>
            </div>
            <iframe name="controleUploadFoto" style="display:none;"></iframe>
        </div>
    </body>
</html>