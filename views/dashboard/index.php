<?php
require_once('../../core/helpers/dashboard.php');
Dashboard::headerTemplate('Iniciar sesión');
?>
<!-- BEGIN: Form-->
<body class="Aki">
    <div class="row">
        <div class="col s12">
            <div id="SinB">
                <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 Card">
                    <form method="post" id="form-sesion">
                        <div class="row margin">
                            <div class="input-field col s12">
                                <h5 class="black-text">Iniciar Sesión</h5>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="material-icons black-text prefix pt-2">person_outline</i>
                                <input id="alias" type="text" name="alias" class="validate" autocomplete="off" required/>
                                <label for="alias">Nombre de usuario</label>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <i class="material-icons black-text prefix pt-2">lock_outline</i>
                                <input id="clave" type="password" name="clave" class="validate" autocomplete="off" required/>
                                <label for="clave">Contraseña</label>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12">
                                <button type="submit" class="btn waves-effect waves-light black col s12 border-round">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- END: Form-->
<?php
Dashboard::footerTemplate('index.js');
?>