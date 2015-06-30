<div class="col-sm-9 col-md-9 col-lg-9">

    <h3>CADASTRAR VÍDEOS</h3>          
        <!-- The file upload form used as target for the file upload widget -->
        <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data" data-ng-app="demo" data-ng-controller="DemoFileUploadController" data-file-upload="options" data-ng-class="{'fileupload-processing': processing() || loadingFiles}">
            <!-- Redirect browsers with JavaScript disabled to the origin page -->
            <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
            <div class="row fileupload-buttonbar">
                <div class="col-lg-7">
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button" ng-class="{disabled: disabled}">
                        <span>ADICIONAR ARQUIVOS</span>
                        <input type="file" name="files[]" multiple ng-disabled="disabled">
                    </span>
                    <button type="button" class="btn btn-primary start" data-ng-click="submit()">
                        <span>INICIAR ENVIO</span>
                    </button>
                    <button type="button" class="btn btn-warning cancel" data-ng-click="cancel()">
                        <span>CANCELAR ENVIO</span>
                    </button>
                    <!-- The global file processing state -->
                    <span class="fileupload-process"></span>
                </div>
                <!-- The global progress state -->
                <div class="col-lg-5 fade" data-ng-class="{in: active()}">
                    <!-- The global progress bar -->
                    <div class="progress progress-striped active" data-file-upload-progress="progress()"><div class="progress-bar progress-bar-success" data-ng-style="{width: num + '%'}"></div></div>
                    <!-- The extended global progress state -->
                    <div class="progress-extended">&nbsp;</div>
                </div>
            </div>
            <!-- The table listing the files available for upload/download -->
            <table class="table table-striped files ng-cloak">
                <tr>
                    <th>IMAGEM</th>
                    <th>NOME DO ARQUIVO</th>
                    <th>TAMANHO</th>
                    <th class="acoes" style="width:120px;">AÇÕES</th>
                </tr>

                <tr data-ng-repeat="file in queue" data-ng-class="{'processing': file.$processing()}">
                    <td data-ng-switch data-on="!!file.thumbnailUrl">
                        <div class="preview" data-ng-switch-when="true">
                            <a data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery><img data-ng-src="{{file.thumbnailUrl}}" alt=""></a>
                        </div>
                        <div class="preview" data-ng-switch-default data-file-upload-preview="file"></div>
                    </td>
                    <td>
                        <p class="name" data-ng-switch data-on="!!file.url">
                            <span data-ng-switch-when="true" data-ng-switch data-on="!!file.thumbnailUrl">
                                <a data-ng-switch-when="true" data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery>{{file.name}}</a>
                                <a data-ng-switch-default data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}">{{file.name}}</a>
                            </span>
                            <span data-ng-switch-default>{{file.name}}</span>
                        </p>
                        <strong data-ng-show="file.error" class="error text-danger">{{file.error}}</strong>
                    </td>
                    <td>
                        <p class="size">{{file.size| formatFileSize}}</p>
                        <div class="progress progress-striped active fade" data-ng-class="{pending: 'in'}[file.$state()]" data-file-upload-progress="file.$progress()"><div class="progress-bar progress-bar-success" data-ng-style="{width: num + '%'}"></div></div>
                    </td>
                    <td>
						<button type="button" title="Excluir" class="btn btn-danger destroy icone" data-ng-controller="FileDestroyController"  data-ng-click="file.$destroy()" data-ng-hide="!file.$destroy">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                        <button type="button" title="Cancelar" class="btn btn-warning cancel icone" data-ng-click="file.$cancel()" data-ng-hide="!file.$cancel">
                            <span class="glyphicon glyphicon-ban-circle"></span>
                        </button>
                        <button type="button" title="Enviar" class="btn btn-primary start icone" data-ng-click="file.$submit()" data-ng-hide="!file.$submit || options.autoUpload" data-ng-disabled="file.$state() == 'pending' || file.$state() == 'rejected'">
                            <span class="glyphicon glyphicon-upload"></span>
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<script type="text/javascript">
</script>