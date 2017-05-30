<?php
Route::getJs(array("scripttipo"), "it", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";
//language=sql
$sql="

";

?>

<!--<p class="caption">A Simple Blank Page to use it for your custome design and elements.</p>-->
<!--<div class="divider"></div>-->
<!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>-->

<table class="display" cellspacing="0" width="100%" id="tabledetails">
    <thead>
    <tr>
        <th data-field="id">#</th>
        <th data-field="id">Tipo</th>
        <th data-field="name">Description</th>
        <th data-field="price">Active</th>
        <th data-field="price">Option</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>


<div class="accordion" id="accordion1">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne">
                Collapsible Group #1
            </a>
        </div>
        <div id="collapseOne" class="accordion-body collapse in">
            <div class="accordion-inner">
                This is a simple accordion inner content...
            </div>
        </div>
    </div>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo">
                Collapsible Group #2 (With nested accordion inside)
            </a>
        </div>
        <div id="collapseTwo" class="accordion-body collapse">
            <div class="accordion-inner">
                <!-- Here we insert another nested accordion -->
                <div class="accordion" id="accordion2">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseInnerOne"> Collapsible Inner Group Item #1 </a> </div>
                        <div id="collapseInnerOne" class="accordion-body collapse in">
                            <div class="accordion-inner"> Anim pariatur cliche... </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseInnerTwo"> Collapsible Inner Group Item #2 </a>
                        <div id="collapseInnerTwo" class="accordion-body collapse">
                            <div class="accordion-inner"> Anim pariatur cliche... </div>
                        </div>
                    </div>
                </div>
                <!-- Inner accordion ends here -->
            </div>
        </div>
    </div>
</div>

