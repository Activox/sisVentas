<?php
Route::getJs(array("scriptitbs"), "it", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="fa fa-university teal-text" aria-hidden="true"></i>&nbsp;Impuestos</h4>

    </div>
    <div class="col s8 m8 l8">
        <div class="right-align">
            You Are In:
            <a href="menu" >Dashboard</a> /
            <a href="<?php echo $module ?>" ><?php echo ucfirst($module); ?></a> /
            <a href="<?php echo $module ?>" ><?php echo ucfirst($type); ?></a> /
            <a href="#!" class="teal-text text-darken-1"><?php echo $app; ?></a>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<hr>
<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3 info" ><a class="active" data-info="sub"href="#test1">Sub Categoria</a></li>
            <li class="tab col s3 info2" ><a data-info="pro" href="#test2">Producto</a></li>
        </ul>
    </div>
    <div id="test1" class="col s12">
        <br>
        <!--    subcategory menu-->
        <form id="record">
            <div class="row">
                <div class="">
                    <div class="input-field col s4">
                        <select name="categoria" id="categoria">
                            <option value="" disabled selected> Choose your option</option>
                        </select>
                        <label>Categoria</label>
                    </div>
                    <div class="input-field col s4">
                        <select name="subcategoria" id="subcategoria">
                            <option value="" disabled selected> Choose your option</option>
                        </select>
                        <label>SubCategoria</label>
                    </div>
                    <div class="input-field col s2">
                        <input name="porcentaje" id="porcentaje" type="text" class="validate">
                        <label for="porcentaje">Porcentaje</label>
                    </div>
                    <div class="col s2">
                        <br>
                        <a class="waves-effect waves-light waves-green btn" id="save">Save</a>
                    </div>
                </div>
            </div>
        </form>
        <!--table-->
        <div class="row ">

            <table class="display cell-border compact order-column mdl-data-table bordered"  cellspacing="0" width="100%" id="detail" >
                <thead>
                <tr class="accent-color white-text">
                    <th>#</th>
                    <th>SubCategoria</th>
                    <th>Porcentaje</th>
                    <th>Active</th>
                    <th>Option</th>
                </tr>
                </thead>
                <tbody >

                </tbody>
            </table>

        </div>
        <!--/ table-->
        <!--/ subcategory menu-->
    </div>
    <div id="test2" class="col s12">
        <br>
        <!--    product menu-->
        <form id="records">
            <div class="row center-align">
                <div class="input-field col s4">
                    <select name="suplidor" id="suplidor">
                        <option value="" disabled selected> Choose your option</option>
                    </select>
                    <label>Suplidor</label>
                </div>
                <div class="input-field col s4">
                    <select name="articulo" id="articulo">
                        <option value="" disabled selected> Choose your option</option>
                    </select>
                    <label>Articulo</label>
                </div>
                <div class="input-field col s2">
                    <input name="porcentaje" id="porcentaje" type="text" class="validate">
                    <label for="porcentaje">Porcentaje</label>
                </div>
                <div class="col s2">
                    <br>
                    <a class="waves-effect waves-light waves-green btn" id="save2">Save</a>
                </div>
            </div>
        </form>
        <!--table-->
        <div class="row ">
            <table class="display cell-border compact order-column mdl-data-table bordered"  cellspacing="0" width="100%" id="details" >
                <thead>
                <tr class="accent-color white-text">
                    <th>#</th>
                    <th>Articulo</th>
                    <th>Porcentaje</th>
                    <th>Active</th>
                    <th>Option</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
        <!--/ table-->
        <!--    / product menu-->
    </div>
</div>