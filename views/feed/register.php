<?php
require_once('../../core/helpers/feed.php');
Feed::headerTemplate('Registro');
?>

<body class='AkiZwg'>
    <div class="row margin">
        <div class="col s12">
            <div id="RegisterStyle" class="row">
                <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 Card">
                    <form method="post" id="form-register">
                        <div class="input-field col s12">
                            <h5 class="ml-4 black-text">Registrarse</h5>
                            <p>Crea una cuenta para el proceso de inscripción nuevo ingreso.</p>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12 m6">
                                <i class="material-icons black-text prefix">person_outline</i>
                                <input id="nombres" type="text" name="nombres" class="validate" autocomplete="off" required />
                                <label for="nombres" class="center-align">Nombre</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons black-text prefix">person</i>
                                <input id="apellidos" type="text" name="apellidos" class="validate" autocomplete="off" required />
                                <label for="apellidos" class="center-align">Apellido</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons black-text prefix">email</i>
                                <input id="correo" type="email" name="correo" class="validate" autocomplete="off" required />
                                <label for="correo" class="center-align">Correo Electrónico</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons black-text prefix">insert_emoticon</i>
                                <input id="alias" type="text" name="alias" class="validate" autocomplete="off" required />
                                <label for="alias" class="center-align">Nombre de usuario</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons black-text prefix">lock_outline</i>
                                <input id="clave1" type="password" name="clave1" class="validate" autocomplete="off" required />
                                <label for="clave1" class="">Contraseña</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons black-text prefix">replay</i>
                                <input id="clave2" type="password" name="clave2" class="validate" autocomplete="off" required />
                                <label for="clave2" class="">Repite la contraseña</label>
                            </div>
                        </div>
                        <div class="row margin">
                            <div class="input-field col s12 center">
                                <button type="submit" class="btn waves-effect waves-light black border-round">Registrarme</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
Feed::footerTemplate('register.js');
?>