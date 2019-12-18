<?php
 
use Carbon\Carbon;
 
function tglIndo($tgl)
{
    $tgl = new Carbon($tgl);
    setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US');
    return $tgl->formatLocalized('%d %B %Y');
}

?>