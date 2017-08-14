<?php
$a = mt_rand(100000, 999999);
$hoy = getdate();
$params = Factory::getParametersView();
$records = Factory::get()->getDetalleOrder($params[1]);

?>
<br>
<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
</style>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <!--                                <img src="http://nextstepwebs.com/images/logo.png" style="width:100%; max-width:300px;">-->
                            <span class="primary-text-color">Joyeria Genesis <i class="fa fa-gitlab teal-text"
                                                                                aria-hidden="true"></i></span>
                            <br>
                            <span class="primary-text-color" style="font-size: 24px !important;">Orden de Compra</span>
                        </td>
                        <td>
                            #: <?php echo $a; ?><br>
                            Created: <?php echo $hoy['mday'] . "/" . $hoy['mon'] . "/" . $hoy['year'] . "" ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            Joyeria Genecis, SA.<br>
                            Av.San Luis<br>
                            (809) 355 5889
                        </td>
                        <td>
                            <?php echo $records[0]->empresa; ?><br>
                            <?php echo $records[0]->persona; ?><br>
                            <?php echo $records[0]->email; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>
                Payment Method
            </td>

            <td>

            </td>
        </tr>

        <tr class="details">
            <td>
                <?php echo ucfirst($records[0]->tipo_pago) ; ?>
            </td>

            <td>

            </td>
        </tr>

        <tr class="heading">
            <td> Item</td>
            <td> Price</td>
        </tr>
        <?php
        $html = "";
        $total = 0;
        foreach ($records as $key) {
            $total += $key->precio;
            $html .= "
            <tr class=\"item\">
            <td>
                $key->articulo <b>QTY:</b> $key->qty $key->unidad
            </td>         
            <td>
            
               DOP$ $key->precio
            </td>
        </tr>
            ";
        }
        echo $html;
        ?>

        <tr class="total">
            <td></td>
            <td>
                Total: DOP$ <?php echo $total; ?>
            </td>
        </tr>
    </table>
</div>