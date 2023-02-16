<?php
$__conf = CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        // console application components
        'components'=>array(
            'request' => array(
                'hostInfo' => $params['app.host'],
                'baseUrl' => rtrim($params['app.base_url'], "/"),
                'scriptUrl'=>rtrim($params['app.base_url'], "/").'/index.php',
            ),
        ),
    )
);
unset($__conf['defaultController']);
return $__conf;