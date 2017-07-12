<?php
Route::getJs(array("scriptsuplidor"), "it", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>
<style>
    .modal {
        width: 75% !important;
        max-height: 100% !important;
    }

</style>
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="small material-icons teal-text">trunks</i>Suplidor</h4>

    </div>
    <div class="col s8 m8 l8">
        <div class="right-align">
            You Are In:
            <a href="menu">Dashboard</a> /
            <a href="<?php echo $module ?>"><?php echo ucfirst($module); ?></a> /
            <a href="<?php echo $module ?>"><?php echo ucfirst($type); ?></a> /
            <a href="#" class="teal-text text-darken-1"><?php echo ucfirst($app); ?></a>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<hr>
<!--table-->
<div class="row">
    <div class="col s12 m12 l12">
        <table class="display cell-border compact order-column mdl-data-table bordered" cellspacing="0" width="100%"
               id="details">
            <thead>
            <tr class="accent-color white-text">
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Cedula</th>
                <th>Telefono</th>
                <th>Active</th>
                <th>Option</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<!--/ table-->

<!--floting btn-->
<div class="fixed-action-btn horizontal">
    <!-- Modal Trigger -->
    <a data-target="modal1" class="waves-effect waves-light btn btn-floating btn-large dark-primary-color"
       id="addRecord">
        <i class="material-icons">add</i>
    </a>
</div>
<!--/ floting btn-->

<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Create Record</h4>

        <div class="row">
            <form class="col s12" id="records">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="name" type="text" class="validate">
                        <label for="name">Nombre</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="last_name" type="text" class="validate">
                        <label for="last_name">Apellidos</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <input id="cedula" type="text" class="validate">
                        <label for="cedula">Cedula</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="phone" type="text" class="validate">
                        <label for="phone">Telefono</label>
                    </div>
                    <div class="input-field col s4">
                        <select id="sexo">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otros">Otros</option>
                        </select>
                        <label>Sexo</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <input id="email" type="text" class="validate">
                        <label for="email">Correo</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="date" type="date" class="datepicker">
                        <label for="date">Fecha Nacimiento</label>
                    </div>
                    <div class="input-field col s4">
                        <select id="empresa">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">UNO</option>
                            <option value="2">CLARO</option>
                            <option value="2">TRICOM</option>
                            <option value="2">DISTRIBUIDORA</option>
                        </select>
                        <label>Empresa</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s6">
                        <select id="tipo">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Al por mayor</option>
                            <option value="2">Normal</option>
                        </select>
                        <label>Tipo Suplidor</label>
                    </div>
                    <div class="input-field col s6">
                        <select id="nacionalidad">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Dominicano</option>
                        </select>
                        <label>Nacionalidad</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <select id="pais">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="2">Republica dominicana</option>
                        </select>
                        <label>Pais</label>
                    </div>
                    <div class="input-field col s4">
                        <select id="ciudad">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Santiago</option>
                        </select>
                        <label>Ciudad</label>
                    </div>
                    <div class="input-field col s4">
                        <select id="sector">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Las Colinas</option>
                            <option value="2">Gurabo</option>
                        </select>
                        <label>Sector</label>
                    </div>

                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="direccion" class="materialize-textarea" data-length="250"></textarea>
                        <label for="direccion">Direccion</label>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="modal-footer right-align">
        <a class="waves-effect waves-light btn red darken-1" id="cancel">Cancel</a>
        <a class="waves-effect waves-light btn dark-primary-color" style="margin-right: 1%" id="save">Save</a>
    </div>
</div>

<div id="modal2" class="modal">
    <div class="modal-content">
        <h4>Supplier Information</h4>
        <div class="row" id="info">

        </div>
    </div>
    <div class="modal-footer">
        <a class="modal-action modal-close waves-effect btn red darken-1" id="close">CLOSE</a>
    </div>
</div>
<!--/ Modal Structure-->