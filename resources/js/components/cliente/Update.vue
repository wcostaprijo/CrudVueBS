<template>
    <div class="container mt-5">
        <div class="row mt-5 justify-content-md-center">
            <div class="col-12 col-sm-8 mb-5 border-bottom">
                <h4>Atualização de cadastro</h4>
            </div>
            <div v-show="Object.keys(erros).length > 0" class="col-12 alert alert-danger">
                <ul>
                    <li v-for="(erro, index) in erros.nome_cliente" v-bind:key="index">{{erro}}</li>
                    <li v-for="(erro, index) in erros.dt_nasc_cliente" v-bind:key="index + 1">{{erro}}</li>
                    <li v-for="(erro, index) in erros.rg_cliente" v-bind:key="index + 2">{{erro}}</li>
                    <li v-for="(erro, index) in erros.cpf_cliente" v-bind:key="index + 3">{{erro}}</li>
                    <li v-for="(erro, index) in erros.telefone_cliente" v-bind:key="index + 4">{{erro}}</li>
                </ul>
            </div>
            <div class="col-12 col-sm-8 mt-3">
                <div class="form-group row">
                    <label for="nome-cliente" class="col-sm-4 col-form-label">Nome</label>
                    <div class="col-sm-8">
                        <input v-model="cliente.nome_cliente" type="text" class="form-control" id="nome-cliente" placeholder="Informe nome do cliente">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dt-nasc-cliente" class="col-sm-4 col-form-label">Data de nascimento</label>
                    <div class="col-sm-8">
                        <input v-model="cliente.dt_nasc_cliente" type="date" class="form-control" id="dt-nasc-cliente" placeholder="DD/MM/YYYY">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rg-cliente" class="col-sm-4 col-form-label">RG</label>
                    <div class="col-sm-8">
                        <input v-mask="'#############'" v-model="cliente.rg_cliente" type="text" class="form-control" id="rg-cliente" placeholder="Informe RG do cliente">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cpf-cliente" class="col-sm-4 col-form-label">CPF</label>
                    <div class="col-sm-8">
                        <input v-mask="'###.###.###-##'" v-model="cliente.cpf_cliente" type="text" class="form-control" id="cpf-cliente" placeholder="Informe CPF do cliente">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telefone-cliente" class="col-sm-4 col-form-label">Celular</label>
                    <div class="col-sm-8">
                        <input v-mask="'## # ####-####'" v-model="cliente.telefone_cliente" type="text" class="form-control" id="telefone-cliente" placeholder="99 9 9999-9999">
                    </div>
                </div>

                <button v-on:click.prevent="navegarPara('/vue/clientes')" class="btn btn-secondary mt-5">Voltar</button>
                <button v-if="!loading" v-on:click.prevent="atualizarCliente()" class="btn btn-primary mt-5">Salvar Alterações</button>
                <button v-else class="btn btn-primary mt-5" disabled><i class="fas fa-spinner fa-spin"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                loading: false,
                erros: [],
                cliente: {},
            }
        },
        created(){
            this.axios
                .get('/api/clientes/' + this.$route.params.id)
                .then(response => {
                    this.cliente = response.data
                    var dt = this.cliente.dt_nasc_cliente.split('/')
                    this.cliente.dt_nasc_cliente = dt[2] + '-' + dt[1] + '-' + dt[0]
                })
                .catch((error) => {
                    this.cliente = {
                        nome_cliente: 'Cliente não encontrado',
                        dt_nasc_cliente: '-',
                        rg_cliente: '-',
                        cpf_cliente: '-',
                        telefone_cliente: '-',
                        created_at: '-'
                    }
                    this.loading = true
                })
        },
        methods: {
            navegarPara(url) {
                this.$router.push(url)
            },
            atualizarCliente() {
                this.loading = true
                this.axios
                    .put('/api/clientes/' + this.$route.params.id, this.cliente)
                    .then(response => (
                        this.navegarPara('/vue/clientes/'+response.data.cliente.id_cliente)
                    ))
                    .catch((error) => {
                        this.erros = error.response.data.errors
                        this.loading = false
                    })
                    .finally(() => this.loading = false)
            }
        }
    }
</script>