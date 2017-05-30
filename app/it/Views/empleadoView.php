<?php
Route::getJs(array("scriptempleado"), "it", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>    
<style>
    .modal { width: 75% !important ; max-height: 100% !important ;}
    .picker{
        /*position: relative !important;*/
    }
    .picker__holder{
        position: absolute off !important;
    }
</style>
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="small material-icons teal-text">group</i>Empleado</h4>        

    </div>
    <div class="col s8 m8 l8">
        <div class="right-align">
             You Are In:
            <a href="menu" >Dashboard</a> >
            <a href="<?php echo $module ?>" ><?php echo ucfirst($module); ?></a> >
            <a href="<?php echo $module ?>" ><?php echo ucfirst($type); ?></a> >
            <a href="#" class="teal-text text-darken-1"><?php echo ucfirst($app); ?></a>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<hr>
<!--table-->
<div class="row">
    <div class="col s12 m12 l12">
        <table class="bordered striped highlight centered responsive-table">
            <thead>
                <tr class="accent-color white-text">
                    <th >#</th>
                    <th >Nombre</th>
                    <th >Email</th>
                    <th >Cedula</th>
                    <th >Telefono</th>
                    <th >Sexo</th>
                    <th >Direccion</th>
                    <th >Fecha Nacimiento</th>
                    <th >Fecha Ingreso</th>
                    <th >Estado Civil</th>
                    <th >Tipo Empleado</th>
                    <th >Active</th>
                    <th >Option</th>
                </tr>
            </thead>
            <tbody id="details">

            </tbody>
        </table>
    </div>
</div>
<!--/ table-->

<!--floting btn-->
<div class="fixed-action-btn horizontal">
    <!-- Modal Trigger -->
    <a data-target="modal1" class="waves-effect waves-light btn btn-floating btn-large  teal" id="addRecord">
        <i class="large material-icons">add</i>
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
                        <input id="admission_date" type="date" class="datepicker">
                        <label for="admission_date">Fecha Ingreso</label>
                    </div>                    
                </div>

                <div class="row">
                    <div class="input-field col s4">
                        <select id="tipo">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="1">Ventas</option>
                            <option value="2">Gerencia</option>
                        </select>
                        <label>Tipo Empleado</label>
                    </div> 
                    <div class="input-field col s4">
                        <select id="estado_civil">
                            <option value="" disabled selected>Choose your option</option>                            
                            <option value="soltero">Soltero</option>
                            <option value="casado">Casado</option>
                        </select>
                        <label>Estado Civil</label>
                    </div>     
                    <div class="input-field col s4">
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
        <a class="waves-effect waves-light waves-green btn-flat" id="save">Save</a>
        <a class="waves-effect waves-light waves-red btn-flat" id="cancel">Cancel</a>
    </div>
</div>
<!--/ Modal Structure-->