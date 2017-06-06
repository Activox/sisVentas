<?php
Route::getJs(array("scriptapp"), "it", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

?>
<!--table-->
<table class="display cell-border compact order-column mdl-data-table" cellspacing="0" width="100%" id="tabledetails">
    <thead style=" color: #fff; background-color: /*#00bcd4*/#D9534F; ">
    <tr>
        <th>#</th>
        <th>App</th>
        <th>Icon</th>
        <th>URL</th>
        <th>Father App</th>
        <th>Type</th>
        <th>Active</th>
        <th>Option</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<!-- / table-->

<!--floting btn-->
<div class="fixed-action-btn horizontal">
    <!-- Modal Trigger -->
    <a href="#modal1" class="waves-effect waves-light btn btn-floating btn-large light-blue lighten-1 modal-trigger">
        <i class="mdi-content-add"></i>
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
                        <input id="description" type="text" class="validate">
                        <label for="description">description</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="icon" type="text" class="validate">
                        <label for="icon">icon</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="url" type="text" class="validate">
                        <label for="url">URL</label>
                    </div>
                    <div class="input-field col s3">
                        <select id="father" >
                            <option value="" disabled selected>Choose your option</option>
                        </select>
                        <label>Father App</label>
                    </div>
                    <div class="input-field col s3">
                        <select id="tipo" >
                            <option value="" disabled selected>Choose your option</option>
                        </select>
                        <label>Father App</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer right-align">
        <button class="waves-effect waves-light btn cyan" style="margin-left: 1%;" id="save">Save <i
                    class="mdi-content-send" style="margin-top: 1%;"></i></button>
        <button class="waves-effect waves-light btn red darken-1" id="cancel">Cancel <i class="mdi-navigation-close"
                                                                                        style="margin-top: 1%;"></i>
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
        <button class="waves-effect waves-light btn cyan" style="margin-left: 1%;" id="update">Update <i
                    class="mdi-content-send" style="margin-top: 1%;"></i></button>
        <button class="waves-effect waves-light btn red darken-1" id="cancel2">Cancel <i class="mdi-navigation-close"
                                                                                         style="margin-top: 1%;"></i>
        </button>
    </div>
</div>
<!--/ Modal Structure-->
