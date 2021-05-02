<template>
    <div class="container mt-5">
        <div class="row mt-5 justify-content-md-center">
            <div class="col-12 col-sm-8 mb-5 border-bottom">
                <h4 class="text-capitalize">{{cliente.nome_cliente}}</h4>
            </div>
            <div class="col-12 col-sm-8 mt-3">
                <ul class="list-group">
                    <li class="list-group-item">Data de nascimento: <strong>{{cliente.dt_nasc_cliente}}</strong></li>
                    <li class="list-group-item">RG: <strong>{{cliente.rg_cliente}}</strong></li>
                    <li class="list-group-item">CPF: <strong>{{cliente.cpf_cliente}}</strong></li>
                    <li class="list-group-item">Celular: <strong>{{cliente.telefone_cliente}}</strong></li>
                </ul>
            </div>

            <div class="col-12 col-sm-6 mt-5 border-top text-muted pt-2">
                Cliente cadastrado em {{cliente.created_at}}
            </div>

            <div class="col-12 col-sm-6 mt-5 border-top pt-2 text-right">
                <a v-on:click.prevent="navegarPara('/vue/clientes')" href="#">Voltar a lista de clientes</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cliente: {}
        }
    },
    created(){
        this.axios
            .get('/api/clientes/' + this.$route.params.id)
            .then(response => {
                this.cliente = response.data
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
            })
    },
    methods: {
        navegarPara(pagina) {
            this.$router.push(pagina)
        }
    }
}
</script>