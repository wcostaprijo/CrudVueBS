<?php

namespace App\Http\Requests\Bootstrap\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'nome_cliente.required' => 'Você precisa informar o nome do cliente.',
            'nome_cliente.string' => 'O nome do cliente deve conter apenas letras.',
            'nome_cliente.min' => 'O nome do cliente deve conter no mínimo 10 letras.',
            'dt_nasc_cliente.required' => 'Você precisa informar a data de nascimento do cliente.',
            'dt_nasc_cliente.date_format' => 'A data de nascimento precisa conter o formato DD/MM/YYYY.',
            'rg_cliente.required' => 'Você precisa informar o RG do cliente.',
            'rg_cliente.numeric' => 'O RG do cliente deve conter apenas números.',
            'cpf_cliente.required' => 'Você precisa informar o CPF do cliente.',
            'cpf_cliente.min' => 'O CPF do cliente deve estar no formato 000.000.000-00',
            'cpf_cliente.max' => 'O CPF do cliente deve estar no formato 000.000.000-00',
            'cpf_cliente.unique' => 'O CPF do cliente já está cadastrado em nosso banco de dados.',
            'telefone_cliente.required' => 'Você precisa informar o celular do cliente.',
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
            'nome_cliente' => 'required|string|min:10',
            'dt_nasc_cliente' => 'required|date_format:Y-m-d',
            'rg_cliente' => 'required|numeric',
            'cpf_cliente' => 'required|min:14|max:14|unique:clientes',
            'telefone_cliente' => 'required|min:14|max:14'
        ];
    }
}
