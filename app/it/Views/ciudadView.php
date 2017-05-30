<?php
Route::getJs(array("scriptciudad"), "it", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>    
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="small material-icons teal-text">location_city</i>Ciudades</h4>        

    </div>
    <div class="col s8 m8 l8">
        <div class="right-align">
             You Are In:
            <a href="menu" >Dashboard</a> >
            <a href="<?php echo $module ?>" ><?php echo ucfirst($module); ?></a> >
            <a href="<?php echo $module ?>" ><?php echo ucfirst($type); ?></a> >
            <a href="#!" class="teal-text text-darken-1"><?php echo $app; ?></a>
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
                <th >#</th>
                <th >Pais</th>
                <th >Ciudad</th>
                <th >Active</th>
                <th >Option</th>
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
    <a data-target="modal1" class="waves-effect waves-light btn btn-floating btn-large teal" id="addRecord">
        <i class="large material-icons">add</i>
    </a>
</div>
<!--/ floting btn-->

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Create Record</h4>
        <div class="row">
            <form class="col s12" id="records">
                <div class="row">
                    <div class="input-field col s6">
                        <select id="pais">

                        </select>
                        <label>Pais</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate">
                        <label for="description">Ciudad</label>
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