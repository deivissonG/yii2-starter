<?php

namespace app\helpers;

class Formatter extends \yii\i18n\Formatter
{
    /**
     * @param $phone
     * @return string|string[]|null
     */
    public function asPhone($phone)
    {
        if (strlen($phone) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '(${1}) ${2}-${3}', $phone);
        } elseif (strlen($phone) === 11) {
            return preg_replace('/(\d{2})(\d{1})(\d{4})(\d{4})/', '(${1}) ${2} ${3}-${4}', $phone);
        } else {
            return $phone;
        }
    }

    /**
     * @param $cpf
     * @return string|string[]|null
     */
    public function asCpf($cpf)
    {
        if (!$cpf) {
            return '';
        }
        $cpf = str_pad($cpf, 11, 0, STR_PAD_LEFT);
        $cpf = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '${1}.${2}.${3}-${4}', $cpf);
        return $cpf;
    }

    public function asCnpj($cnpj) {
        $cnpj = str_pad($cnpj, 14, 0, STR_PAD_LEFT);
        $cnpj = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '${1}.${2}.${3}/${4}-${5}', $cnpj);
        return $cnpj;
    }

    public function asCpfCnpj($cpfCnpj) {
        if ($this->validaCPF($cpfCnpj)) {
            return $this->asCpf($cpfCnpj);
        }
        return $this->asCnpj($cpfCnpj);
    }

    private function validaCPF($cpf) {

        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        if (strlen($cpf) > 11) {
            return false;
        }

        if (strlen($cpf) < 11) {
            $cpf = str_pad($cpf, 11, 0, STR_PAD_LEFT);
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    function validarCnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        if (strlen($cnpj) != 14)
            return false;

        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;

        // Validate the first digit verifier
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        // Validate the second digit verifier
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }
}