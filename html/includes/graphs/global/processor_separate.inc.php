<?php

$i = 0;

foreach (dbFetchRows('SELECT * FROM `processors` AS P, devices AS D WHERE D.device_id = P.device_id') as $proc) {
    $rrd_filename = $config['rrd_dir'].'/'.$proc['hostname'].'/'.safename('processor-'.$proc['processor_type'].'-'.$proc['processor_index'].'.rrd');

    if (is_file($rrd_filename)) {
        $descr = short_hrDeviceDescr($proc['processor_descr']);

        $rrd_list[$i]['filename'] = $rrd_filename;
        $rrd_list[$i]['descr']    = $descr;
        $rrd_list[$i]['ds']       = 'usage';
        $rrd_list[$i]['area']     = 1;
        $i++;
    }
}

$unit_text = 'Load %';

$units       = '%';
$total_units = '%';
$colours     = 'mixed';

$scale_min = '0';
$scale_max = '100';

$nototal = 1;

require 'includes/graphs/generic_multi_line.inc.php';
