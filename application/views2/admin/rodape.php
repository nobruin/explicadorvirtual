</div><!-- FECHA ROW -->
</div><!-- FECHA PRINCIPAL -->
</div><!-- FECHA CONTAINER -->
</div><!-- FECHA CONTANT -->
<!-- ======== @Region: #footer ======== -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col">
                <div class="block contact-block">
                    <!--@todo: replace with company contact details-->
                    <h3>
                        Contato
                    </h3>
                    <address>
                        <ul class="fa-ul">
                            <li>
                                <abbr title="Phone"><i class="fa fa-li fa-phone"></i></abbr>
                                (21) 98766-9866
                            </li>
                            <li>
                                <abbr title="Email"><i class="fa fa-li fa-envelope"></i></abbr>
                                jane@explicadorvirtual.com.br
                            </li>
                            <li>
                                <abbr title="Address"><i class="fa fa-li fa-home"></i></abbr>
                                Av. das Américas, 500 - Bl 11 - Lj 108 - Shopping Downtown - Barra da Tijuca - Rio de Janeiro - RJ
                            </li>
                        </ul>
                    </address>
                </div>
            </div>

            <div class="col-md-5 col">
                <div class="block">
                    <h3>
                        Sobre Nós
                    </h3>
                    <p>Saiba mais sobre nossas propostas para melhorar o desempenho dos seus filhos na escola!</p>
                </div>
            </div>

            <div class="col-md-4 col">
                <div class="block newsletter">
                    <h3>
                        Newsletter
                    </h3>
                    <p>Fique atualizado, receba nossos informativos semanais.</p>
                    <!--@todo: replace with mailchimp code-->
                    <form role="form">
                        <div class="input-group input-group-sm">
                            <label class="sr-only" for="email-field">Email</label>
                            <input type="text" class="form-control" id="email-field" placeholder="Email">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">Go!</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div id="toplink">
                <a href="#top" class="top-link" title="Back to top">Voltar ao topo <i class="fa fa-chevron-up"></i></a>
            </div>
            <!--@todo: replace with company copyright details-->
            <div class="subfooter">
                <div class="col-md-6">
                    <p>Todos os direitos reservados 2015 &copy; Explicador Virtual</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline footer-menu">
                        <li><a href="#">Termos de uso</a></li>
                        <li><a href="#">Política de privacidade</a></li>
                        <li><a href="#">Fale conosco</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--Hidden elements - excluded from jPanel Menu on mobile-->
<div class="hidden-elements jpanel-menu-exclude">
    <!--@modal - signup modal-->
    <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        Sign Up
                    </h4>
                </div>
                <div class="modal-body">
                    <form action="signup.htm" role="form">
                        <h5>
                            Price Plan
                        </h5>
                        <select class="form-control">
                            <option>Basic</option>
                            <option>Pro</option>
                            <option>Pro +</option>
                        </select>

                        <h5>
                            Account Information
                        </h5>
                        <div class="form-group">
                            <label class="sr-only" for="signup-first-name">First Name</label>
                            <input type="text" class="form-control" id="signup-first-name" placeholder="First name">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="signup-last-name">Last Name</label>
                            <input type="text" class="form-control" id="signup-last-name" placeholder="Last name">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="signup-username">Userame</label>
                            <input type="text" class="form-control" id="signup-username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="signup-email">Email address</label>
                            <input type="email" class="form-control" id="signup-email" placeholder="Email address">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="signup-password">Password</label>
                            <input type="password" class="form-control" id="signup-password" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="term">
                                I agree with the Terms and Conditions. 
                            </label>
                        </div>
                        <button class="btn btn-primary" type="submit">Sign up</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <small>Already signed up? <a href="login.htm">Login here</a>.</small>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!--@modal - login modal-->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">
                        Login
                    </h4>
                </div>
                <div class="modal-body">
                    <form action="login.htm" role="form">
                        <div class="form-group">
                            <label class="sr-only" for="login-email">Email</label>
                            <input type="email" id="login-email" class="form-control email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="login-password">Password</label>
                            <input type="password" id="login-password" class="form-control password" placeholder="Password">
                        </div>
                        <button type="button" class="btn btn-primary">Login</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <small>Not a member? <a href="#" class="signup">Sign up now!</a></small>
                    <br />
                    <small><a href="#">Forgotten password?</a></small>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>



<!--Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{url}js/jquery.maskedinput.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{url}js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{url}js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="{url}js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="{url}js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{url}js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="{url}js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="{url}js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="{url}js/jquery.fileupload-validate.js"></script>
<!-- The File Upload Angular JS module -->
<script src="{url}js/jquery.fileupload-angular.js"></script>
<!-- The main application script -->
<script src="{url}js/app.js"></script>


<!-- Bootstrap JS -->
<script src="{url}js/bootstrap.min.js"></script>


<!-- JS plugins required on all pages NOTE: Additional non-required plugins are loaded ondemand as of AppStrap 2.5 -->

<!--Custom scripts mainly used to trigger libraries/plugins -->
<script src="{url}js/script.min.js"></script>
</body>
</html>