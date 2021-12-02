<?php
if (ENVIRONMENT == 'development') {
    function elapseTime($time)
    {
        return number_format(microtime(TRUE) - $time, 3) * 10000;
    }

    function getProfilerResumen()
    {
        $ci = &get_instance();
        $ci->load->library('myprofiler/profiler/MyProfilerLib');
        $ci->myprofilerlib->run();

        return $ci->myprofilerlib->getResumen();
    }

    function getCIVersion()
    {
        return CI_VERSION;
    }

    function displayArray($array)
    {
        if (is_array($array)) {
            foreach ($array as $subitem) {
                if (!is_array($subitem)) {
                    echo $subitem. ', ';
                } else {
                    displayArray($subitem);
                }
            }
        } else {
            echo $array;
        }
    }
}