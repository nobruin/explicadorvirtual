<script type="text/javascript">
top.document.getElementById('fotoTempMaior').src = "{urlFoto}";
top.document.getElementById('fotoTempMenor').src = "{urlFoto}";
top.document.getElementById('botaoRemoverFotoCorretor').style.display = "none";
top.document.getElementById('divCampoUpload').style.display = "none";
top.document.getElementById('divAvisoCortarFoto').style.display = "none";
top.document.getElementById('divExplicacaoFormato').style.display = 'none';
top.document.getElementById('preVisualizacao').style.display = "block";
top.document.getElementById('divBtFinalizarFoto').style.display = 'block';


top.cortarFotoCorretor();
</script>