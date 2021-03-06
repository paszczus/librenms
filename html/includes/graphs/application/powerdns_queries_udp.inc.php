<?php

require 'includes/graphs/common.inc.php';

$scale_min    = 0;
$colours      = 'mixed';
$nototal      = (($width < 224) ? 1 : 0);
$unit_text    = 'Packets/sec';
$rrd_filename = $config['rrd_dir'].'/'.$device['hostname'].'/app-powerdns-'.$app['app_id'].'.rrd';
$array        = array(
                 'q_udp4Answers' => array(
                                     'descr'  => 'UDP4 Answers',
                                     'colour' => '00008888',
                                    ),
                 'q_udp4Queries' => array(
                                     'descr'  => 'UDP4 Queries',
                                     'colour' => '000088FF',
                                    ),
                 'q_udp6Answers' => array(
                                     'descr'  => 'UDP6 Answers',
                                     'colour' => '88000088',
                                    ),
                 'q_udp6Queries' => array(
                                     'descr'  => 'UDP6 Queries',
                                     'colour' => '880000FF',
                                    ),
                );

$i = 0;

if (is_file($rrd_filename)) {
    foreach ($array as $ds => $vars) {
        $rrd_list[$i]['filename'] = $rrd_filename;
        $rrd_list[$i]['descr']    = $vars['descr'];
        $rrd_list[$i]['ds']       = $ds;
        $rrd_list[$i]['colour']   = $vars['colour'];
        $i++;
    }
}
else {
    echo "file missing: $file";
}

require 'includes/graphs/generic_multi_simplex_seperated.inc.php';
