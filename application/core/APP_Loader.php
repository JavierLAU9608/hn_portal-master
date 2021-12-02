<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class APP_Loader extends MX_Loader {
    /** sobrescribí esto porque había un error en $this->_ci_object_to_array($vars) **/
    public function view($view, $vars = array(), $return = FALSE)
    {
        list($path, $_view) = Modules::find($view, $this->_module, 'views/');

        if ($path != FALSE) {
            $this->_ci_view_paths = array($path => TRUE) + $this->_ci_view_paths;
            $view = $_view;
        }

        return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
    }

    /**
     * Autoload module items
     *
     * Sobrescrito para cargar el autoload de todos los módulos
     **/
    public function _autoloader($autoload)
    {
        // cargar las configuraciones de todos los módulos
        $modules = Modules::list_modules();
        foreach ($modules as $module) {
            list($path, $file) = Modules::find('autoload', $module, 'config/');

            /* module autoload file */
            if ($path != FALSE) {
                $temp = Modules::load_file($file, $path, 'autoload');
                foreach ($temp as &$type) {
                    foreach ($type as &$item) {
                        $item = $module . '/' . $item;
                    }

                }

                $autoload = array_merge_recursive($temp, $autoload);
            }

            list($path, $file) = Modules::find('constants', $module, 'config/');

            /* module constants file */
            if ($path != FALSE) {
                include_once $path . $file . EXT;
            }
        }


        /* nothing to do */
        if (count($autoload) == 0) return;

        /* autoload package paths */
        if (isset($autoload['packages'])) {
            foreach ($autoload['packages'] as $package_path) {
                $this->add_package_path($package_path);
            }
        }

        /* autoload config */
        if (isset($autoload['config'])) {
            foreach ($autoload['config'] as $config) {
                $this->config($config);
            }
        }

        /* autoload helpers, plugins, languages */
        foreach (array('helper', 'plugin', 'language') as $type) {
            if (isset($autoload[$type])) {
                foreach ($autoload[$type] as $item) {
                    $this->$type($item);
                }
            }
        }

        // Autoload drivers
        if (isset($autoload['drivers'])) {
            foreach ($autoload['drivers'] as $item => $alias) {
                (is_int($item)) ? $this->driver($alias) : $this->driver($item, $alias);
            }
        }

        /* autoload database & libraries */
        if (isset($autoload['libraries'])) {
            if (in_array('database', $autoload['libraries'])) {
                /* autoload database */
                if (!$db = CI::$APP->config->item('database')) {
                    $this->database();
                    $autoload['libraries'] = array_diff($autoload['libraries'], array('database'));
                }
            }

            /* autoload libraries */
            foreach ($autoload['libraries'] as $library => $alias) {
                (is_int($library)) ? $this->library($alias) : $this->library($library, NULL, $alias);
            }
        }

        /* autoload models */
        if (isset($autoload['model'])) {
            foreach ($autoload['model'] as $model => $alias) {
                (is_int($model)) ? $this->model($alias) : $this->model($model, $alias);
            }
        }

        /* autoload module controllers */
        if (isset($autoload['modules'])) {
            foreach ($autoload['modules'] as $controller) {
                ($controller != $this->_module) && $this->module($controller);
            }
        }
    }

    /**
     * Load a module model
     *
     * Sobrescrito para quitarle strtolower
     **/
    public function model($model, $object_name = NULL, $connect = FALSE)
    {
        if (is_array($model)) return $this->models($model);

        ($_alias = $object_name) OR $_alias = basename($model);

        if (in_array($_alias, $this->_ci_models, TRUE))
            return $this;

        /* check module */
        list($path, $_model) = Modules::find($model, $this->_module, 'models/');

        if ($path == FALSE) {
            /* check application & packages */
            parent::model($model, $object_name, $connect);
        } else {
            class_exists('CI_Model', FALSE) OR load_class('Model', 'core');

            if ($connect !== FALSE && !class_exists('CI_DB', FALSE)) {
                if ($connect === TRUE) $connect = '';
                $this->database($connect, FALSE, TRUE);
            }

            Modules::load_file($_model, $path);

            $model = ucfirst($_model);
            CI::$APP->$_alias = new $model();

            $this->_ci_models[] = $_alias;
        }
        return $this;
    }
}