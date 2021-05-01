<?php

namespace App\Rules\Cliente;

use Illuminate\Contracts\Validation\Rule;

class CPF implements Rule
{
    private $cliente;

    /**
     * Definindo o cliente na constraução da instancia.
     *
     * @return void
     */
    public function __construct($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Determina se o CPF informado está ou não cadastrado.
     * Levando em consideração que se for o CPF do mesmo devemos aceitar.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->cliente->cpf_cliente === $value) 
            return true;
        return \App\Models\Cliente::whereCpfCliente($value)->first() ? false : true;
    }

    /**
     * Mensagem de erro caso a validação não seja TRUE.
     *
     * @return string
     */
    public function message()
    {
        return 'O CPF do cliente já está cadastrado em nosso banco de dados.';
    }
}
