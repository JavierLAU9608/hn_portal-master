<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request
{
    public function _get($key, $default = null, $filtro = VALIDATE_ID, $required = true)
    {
        //return $_GET[$key];

        $value = filter_input(INPUT_POST, $key);
        if (!$value) {
            $value = filter_input(INPUT_GET, $key);
        }

        if ($required) {
            // el valor no ha sido enviado en $_GET
            if (null === $value) {
                throw new Exception("El valor de: $key es requerido");
            }
        }

        if ($filtro == NO_VALIDATE) {
            return $value;
        } elseif ($filtro == VALIDATE_ID) {
            if ($this->validate_id($value)) {
                return (int) $value;
            }
        } elseif ($filtro == VALIDATE_TRANSACTION) {
            if ($this->validate_trans($value)) {
                return $value;
            }
        } elseif ($filtro == VALIDATE_TOKEN) {
            if ($this->validate_token($this->_get('id'), $value)) {
                return $value;
            }
        }

        return $default;
    }

    private function validate_token($id, $token)
    {
        if ($token != md5($id . 'elPa3380rdD3l4h0s14')) {
            throw new Exception('El token no es correcto');
        }

        return true;
    }

    // valida si un id es válido
    private function validate_id($id) {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            throw new Exception('El id no es un entero válido');
        }

        return true;
    }

    private function remove0inicial($id)
    {
        $resp = '';
        for ($pos = 0; $pos < strlen($id); $pos++) {
           $char = $id[$pos];
           if ($char === '0' && strlen($resp) === 0) {
               continue;
           } else {
               $resp .= $char;
           }
        }

        return $resp;
    }

    /**
     * Validar si un número de transacción es válido
     *
     * @param string $transaction # de transacción
     * @param int $max_old Límite de antiguedad de la transacción
     * @return boolean
     */
    private function validate_trans($transaction, $max_old = 15)
    {
        $hoy = date('ymd');
        $fec = substr($transaction, 0, 6);
        $id = $this->remove0inicial(substr($transaction, 6, 20));

        $_old = date('ymd', mktime(0, 0, 0, date("m"), date("d") - $max_old, date("Y")));

        //validar fecha correcta
        $y = '20' . substr($transaction, 0, 2);
        $m = substr($transaction, 2, 2);
        $d = substr($transaction, 4, 2);

        if (!checkdate($m, $d, $y)) {
            throw new Exception('La transacción no es válida (Err: 0001)');
        }

        /* se pueden comparar como cadenas por estar en formato ymd */

        // validar la fecha máxima
        if ($fec > $hoy) {
            throw new Exception('La transacción no es válida (Err: 0002)');
        }

        // validar la fecha mínima
        if ($fec < $_old) {
            throw new Exception('La transacción no es válida (Err: 0003)'); // reserva con más de $max_old dias
        }

        // validar el id como entero
        $this->validate_id($id);

        // #de transacción válida
        return true;
    }
}
