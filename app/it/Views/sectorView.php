<?php
Route::getJs(array("scriptsector"), "it", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>    
<!--Header-->
<div class="row">
    <div class="col s3 m3 l3">
        <h4><i class="small material-icons teal-text">domain</i>Sectores</h4>        

    </div>
    <div class="col s9 m9 l9">
        <div class="right-align">
             You Are In:
            <a href="menu" >Dashboard</a> /
            <a href="<?php echo $module ?>" ><?php echo ucfirst($module); ?></a> /
            <a href="<?php echo $module ?>" ><?php echo ucfirst($type); ?></a> /
            <a href="#!" class="teal-text text-darken-1"><?php echo ucfirst($app); ?></a>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<hr>
<!--table-->
<div class="row ">

    <table class="display cell-border compact order-column mdl-data-table bordered" cellspacing="0" width="100%"
           id="details">
        <thead>
            <tr class="accent-color white-text">
                <th >#</th>
                <th >Ciudad</th>
                <th >Sector</th>
                <th >Active</th>
                <th >Option</th>
            </tr>
        </thead>
        <tbody >

        </tbody>
    </table>

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
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Create Record</h4>
        <div class="row">
            <form class="col s12" id="records">
                <div class="row">
                    <div class="input-field col s6">
                        <select id="ciudad">

                        </select>
                        <label>Ciudad</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="description" type="text" class="validate">
                        <label for="description">Sector</label>
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
<!--/ Modal Structure-->