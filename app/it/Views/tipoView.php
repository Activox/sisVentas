<?php
Route::getJs(array("scripttipo"), "it", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";
$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>

<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="small material-icons teal-text">people</i>&nbsp;Tipos</h4>

    </div>
    <div class="col s8 m8 l8">
        <div class="right-align">
            You Are In:
            <a href="menu">Dashboard</a> /
            <a href="<?php echo $module ?>"><?php echo ucfirst($module); ?></a> /
            <a href="<?php echo $module ?>"><?php echo ucfirst($type); ?></a> /
            <a href="#!" class="teal-text text-darken-1" style="font-weight: bold;"><?php echo $app; ?></a>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row  center-align">
    <!--table-->
    <table class="display cell-border compact order-column mdl-data-table bordered" cellspacing="0" width="100%"
           id="tabledetails">
        <thead class="accent-color white-text">
        <tr>
            <th>#</th>
            <th>Tipo</th>
            <th>Description</th>
            <th>Active</th>
            <th>Option</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <!-- / table-->
</div>

<!-- / table-->

<!--floting btn-->
<div class="fixed-action-btn horizontal">
    <!-- Modal Trigger -->
    <a data-target="modal1" class="waves-effect waves-light btn btn-floating btn-large dark-primary-color">
        <i class="material-icons">add</i>
    </a>
</div>
<!--/ floting btn-->

<!-- Modal Structure Save-->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Create Record</h4>
        <div class="row">
            <form class="col s12" id="records">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="tipo" type="text" class="validate">
                        <label for="tipo">Tipo</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate">
                        <label for="description">Descripcion</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer right-align">
        <button class="waves-effect waves-light btn red darken-1" id="cancel">Cancel</button>
        <button class="waves-effect waves-light btn dark-primary-color" id="save" style="margin-right: 1%;">Save
        </button>
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
                        <input id="tipo2" type="text" class="validate">
                        <label for="tipo2">Tipo</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="description2" type="text" class="validate">
                        <label for="description2">Descripcion</label>
                    </div>
                    <div class="input-field col s4">
                        <select id="active">
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
        <button class="waves-effect waves-light btn red darken-1" id="cancel2">Cancel</button>
        <button class="waves-effect waves-light btn dark-primary-color" id="update" style="margin-right: 1%;">Update
        </button>
    </div>
</div>
<!--/ Modal Structure-->
