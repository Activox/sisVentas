<?php
/**
 * Created by PhpStorm.
 * User: pottenwalder
 * Date: 4/19/2017
 * Time: 4:16 PM
 */

namespace lib\vendor;

class TableGenerator
{
    public function collapseTable($result, $getcolse, $getdata, $sumvalue, $status)
    {
        $validation = '';
        $html = '';
        $cont1 = 1;
        $contint = 1;
        $sum = 0;
        echo "<pre>";
        print_r($result);
        print_r($getdata);die;
        foreach ($result as $key => $value) {
            $sum += $value->$sumvalue;
            if ($validation != $value->$getcolse) {
                $html .= '<tr class="head" style="background: #e0f2f1; cursor:pointer; font-weight:bold;" data-status="0">';
                $html .= '<td>' . ($cont1++) . '</td>';
                $html .= '<td colspan="' . (count($getdata)) . '" >' . $value->$getcolse . '</td>';
                $html .= '</tr>';
                $validation = $value->$getcolse;
                $contint = 1;
            }
            $html .= '<tr>';
            $html .= '<td class="brown lighten-5"></td>';
            for ($n = 0; $n < count($getdata); $n++) {
                $html .= '<td>' . $value->$getdata[$n] . '</td>';
            }
            $html .= '</tr>';
        }
        if ($status) {
            $html .= '<tr class="head" style="background: #dadada; font-weight: bold;">';
            $html .= '<td>TOTAL</td>';
            for ($n = 0; $n < count($getdata) - 1; $n++) {
                $html .= '<td></td>';
            }
            $html .= '<td>' . $sum . '</td>';
            $html .= '</tr>';
        }
        echo $html;
    }
}
