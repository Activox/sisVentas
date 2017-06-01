<?php
Route::getJs(array("scripttipo"), "it", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="small material-icons teal-text">group</i>&nbsp;Tipos</h4>        

    </div>
    <div class="col s8 m8 l8">
        <div class="right-align">
             You Are In:
            <a href="menu" >Dashboard</a> /
            <a href="<?php echo $module ?>" ><?php echo ucfirst($module); ?></a> /
            <a href="<?php echo $module ?>" ><?php echo ucfirst($type); ?></a> /
            <a href="#!" class="teal-text text-darken-1"><b><?php echo $app; ?></b></a>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<hr>
<!--table-->
<div class="row container">

    <table class="bordered striped highlight centered responsive-table">
        <thead>
            <tr class="accent-color white-text">
                <th data-field="id">#</th>
                <th data-field="id">Tipo</th>
                <th data-field="name">Description</th>
                <th data-field="price">Active</th>
                <th data-field="price">Option</th>
            </tr>
        </thead>
        <tbody id="details">

        </tbody>
    </table>

</div>
<!--/ table-->

<!--floting btn--> 
<div class="fixed-action-btn horizontal">
    <!-- Modal Trigger -->
    <a data-target="modal1" class="waves-effect waves-light btn btn-floating btn-large accent-color">
        <i class="mdi-editor-border-color"></i>
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
        <a class="waves-effect waves-light waves-green btn-flat" id="save">Save</a>
        <a class="waves-effect waves-light waves-red btn-flat" id="cancel">Cancel</a>
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
        <a class="waves-effect waves-light waves-green btn-flat" id="update">Save</a>
        <a class="waves-effect waves-light waves-red btn-flat" id="cancel">Cancel</a>
    </div>
</div>
<!--/ Modal Structure-->