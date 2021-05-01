<?php

namespace App\Http\Requests\Bootstrap\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determina se osusuários podem fazer o uso dessa requisição
     * Por ser uma request publica, todos terão acesso
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Determina as mensagens personalizadas para erros na validação da requisição
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome_cliente.string' => 'O nome do cliente deve conter apenas letras.',
            'nome_cliente.min' => 'O nome do cliente deve conter no mínimo 10 letras.',
            'dt_nasc_cliente.date_format' => 'A data de nascimento precisa conter o formato DD/MM/YYYY.',
            'rg_cliente.numeric' => 'O RG do cliente deve conter apenas números.',
            'cpf_cliente.min' => 'O CPF do cliente deve estar no formato 000.000.000-00',
            'cpf_cliente.max' => 'O CPF do cliente deve estar no formato 000.000.000-00',
            'telefone_cliente.min' => 'O celular do cliente deve estar no formato 00 0 0000-0000.',
            'telefone_cliente.max' => 'O celular do cliente deve estar no formato 00 0 0000-0000.',
        ];
    }

    /**
     * Determina as validações para requisição
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome_cliente' => 'nullable|string|min:10',
            'dt_nasc_cliente' => 'nullable|date_format:Y-m-d',
            'rg_cliente' => 'nullable|numeric',
            'cpf_cliente' => ['nullable','min:14','max:14', new \App\Rules\Cliente\CPF($this->route('cliente'))],
            'telefone_cliente' => 'nullable|min:14|max:14'
        ];
    }
}
