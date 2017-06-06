<?php
Route::getJs(array("scriptusuario"), "it", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="small material-icons teal-text">account_box</i>&nbsp;Usuarios</h4>       

    </div>
    <div class="col s8 m8 l8">
        <div class="right-align">
            You Are In:
            <a href="menu" >Dashboard</a> /
            <a href="<?php echo $module ?>" ><?php echo ucfirst($module); ?></a> /
            <a href="<?php echo $module ?>" ><?php echo ucfirst($type); ?></a> /
            <a href="#!" class="teal-text text-darken-1" style="font-weight: bold;"><?php echo $app; ?></a> 
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<hr>
<!--table-->
<div class="row container">

    <table class="display cell-border compact order-column mdl-data-table bordered" cellspacing="0" width="100%" id="details">
        <thead>
            <tr class="accent-color white-text">
                <th data-field="id">#</th>
                <th data-field="name">Empleado</th>
                <th data-field="name">Username</th>
                <th data-field="name">Email</th>
                <th data-field="name">Tipo Usuario</th>
                <th data-field="name">Terminal</th>
                <th data-field="price">Active</th>
                <th data-field="price">Option</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>
<!--/ table-->

<!--floting btn--> 
<div class="fixed-action-btn horizontal">
    <!-- Modal Trigger -->
    <a data-target="modal1" class="waves-effect waves-light btn btn-floating btn-large accent-color">
        <i class="large material-icons">add</i>
    </a>
</div>
<!--/ floting btn-->

<!-- Modal Structure Save-->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Create Record</h4>
        <div class="row"> 
            <div class="input-field col s6">
                <select id="empleado">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Paul Ottenwalder</option>
                </select>
                <label>Empleado</label>
            </div> 
            <div class="input-field col s3">
                <select id="tipo">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Admin</option>
                    <option value="2">Cajero</option>
                    <option value="3">Vendedor</option>
                </select>
                <label>Tipo Usuario</label>
            </div>             
            <div class="input-field col s3">
                <select id="terminal" disabled>
                    <option value="" disabled selected>Choose your option</option>
                </select>
                <label>Terminal</label>
            </div>             
        </div>
        <div class="row">             
            <div class="input-field col s4">
                <input id="username" type="text" class="validate">
                <label for="username">Username</label>
            </div>   
            <div class="input-field col s4">
                <input id="password" type="password" class="validate">
                <label for="password">Clave</label>
            </div>
            <div class="input-field col s4">
                <input id="rpassword" type="password" class="validate">
                <label for="rpassword">Repetir Clave</label>
            </div>
        </div>
    </div>
    <div class="modal-footer right-align">
        <a class="waves-effect waves-light btn dark-primary-color" id="save">Save</a>
        <a class="waves-effect waves-light btn red darking-1" id="cancel" style="margin-right: 1%;" >Cancel</a>
    </div>
</div>
<!--/ Modal Structure-->

<!-- Modal Structure Edit-->
<div id="modal2" class="modal">
    <div class="modal-content">
        <h4>Update Record</h4>
        <div class="row">
            <form class="col s12" id="records">
                <div class="row">
                    <div class="input-field col s4">
                        <input id="description2" type="text" class="validate">
                        <label for="description2">Descripcion</label>
                    </div>
                    <div class="input-field col s4">
                        <select  id="active">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="TRUE">TRUE</option>
                            <option value="FALSE">FALSE</option>
                        </select>
                        <label>Active</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer right-align">
        <a class="waves-effect waves-light btn dark-primary-color" id="update">Save</a>
        <a class="waves-effect waves-light btn red darken-1" id="cancel2" style="margin-right: 1%;" >Cancel</a>
    </div>
</div>
<!--/ Modal Structure-->