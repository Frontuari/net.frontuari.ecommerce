<?php
$data="<![CDATA[
<UT>         DUPLICADO</UT>
     B A N E S C O J-07013380-5
               COMPRA
PAYMENT GATEWAY
CHAGUARAMOS
RIF:J00408552965 AFIL:860084789 
TER:9898016 LOTE:4 REF:24
NRO.CTA:522037******2279 'M'
FECHA:08/05/2020 16:49:20 APROB:6016
SECUENCIA:11 CAJA:BIOPG01
MONTO BS.  :80.000,00

FIRMA  :__________________
C.I.   :__________________

";

echo formatear($data);


function formatear($data){
    $data=str_replace("_", "", $data);
return "
<table border='0' cellspacing='0' width='100%''>
    <tr>
        <td></td>
        <td width='300' style=' font-family: \"Courier New\", Courier, monospace; padding:20px; border:1px solid #000; border-radius: 15px; border-style: dashed; width:300px; margin:0 auto; background:#F2F2F2'>
        <div >
<div style='text-align:center;background:#203876; color:white; margin-bottom:10px' >VOUCHER<BR>ELECTRÓNICO<BR></div>
Alimentos FM, C.A.<br>
RIF: J-31721968-6<br>
<br>
".nl2br($data)."<BR></div><hr><div style='text-align:center'><br>Para más información, visita la sección contáctanos de https://eosdelivery.com.ar/<br><span style=''><b>¡INSPIRADOS EN SERVIR!</b><span></div>

        </td>
        <td></td>
     </tr>
</table> ";




}

?>