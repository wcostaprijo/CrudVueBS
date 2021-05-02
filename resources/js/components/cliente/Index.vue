<template>
    <div class="container">
        <div class="row mt-4 mb-2 justify-content-md-end">
            <div class="col-6">
                <h4>Clientes cadastrados</h4>
            </div>
            <div class="col-6 text-right">
                <div class="input-group">
                    <input v-on:keyup="procurarCliente()" v-model="cliente" type="text" class="form-control" placeholder="Insira o nome do cliente" value="" autocomplete="off" required>
                    <div class="input-group-append">
                        <a v-on:click.prevent="navegarPara('/vue/clientes/create')" href="#" class="btn btn-success">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-6 mt-4" v-show="cliente !== ''">
                Mostrando resultados para <strong>{{cliente}}</strong>. <a href="#" v-on:click.prevent="limparFiltro()">Limpar filtro</a>
            </div>

            <div class="col-6 mt-4 text-right" v-show="excluidos">
                Mostrando clientes excluídos. <a href="#" v-on:click.prevent="esconderClientesExcluidos()">Mostrar clientes não excluídos</a>
            </div>

            <div class="col-6 mt-4 text-right" v-show="!excluidos">
                <a href="#" v-on:click.prevent="mostrarClientesExcluidos()">Mostrar clientes excluídos</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Nascimento</th>
                            <th scope="col">RG</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="c in this.clientes" :key="c.id_cliente">
                            <th scope="row" class="text-capitalize">{{c.nome_cliente}}</th>
                            <td>{{c.dt_nasc_cliente}}</td>
                            <td>{{c.rg_cliente}}</td>
                            <td>{{c.cpf_cliente}}</td>
                            <td>{{c.telefone_cliente}}</td>
                            <td class="text-center">
                                <a v-show="!excluidos" v-on:click.prevent="navegarPara('/vue/clientes/'+c.id_cliente)" href="#" class="text-dark mr-2"><i class="fas fa-eye"></i></a>
                                <a v-show="!excluidos" v-on:click.prevent="navegarPara('/vue/clientes/'+c.id_cliente+'/edit')" href="#" class="text-warning mr-2"><i class="fas fa-user-edit"></i></a>
                                <a v-show="!excluidos" v-on:click.prevent="excluirCliente(c.id_cliente)" href="#" class="text-danger"><i class="far fa-trash-alt"></i></a>

                                <a v-show="excluidos" v-on:click.prevent="restaurarCliente(c.id_cliente)" href="#" class="text-info"><i class="fas fa-redo"></i></a>
                            </td>
                        </tr>

                        <tr v-show="this.clientes.length == 0">
                            <td colspan="6" class="text-center">Nenhum cliente foi encontrado.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <nav>
                    <ul class="pagination justify-content-end">
                        <li v-if="this.paginacao.current_page == 1" class="page-item disabled">
                            <span class="page-link">&lsaquo;</span>
                        </li>
                        
                        <li v-else class="page-item">
                            <a v-on:click.prevent="toPage(paginacao.current_page - 1)" class="page-link" href="#" rel="prev">&lsaquo;</a>
                        </li>

                        <li v-for="item in paginacao_itens" class="page-item" v-bind:class="{active: paginacao.current_page == item}" v-bind:key="item">
                            <span v-if="paginacao.current_page == item" class="page-link">{{ item }}</span>
                            <a v-on:click.prevent="toPage(item)" v-else class="page-link" href="#">{{ item }}</a>
                        </li>

                        <li v-if="this.paginacao.current_page != this.paginacao.last_page" class="page-item">
                            <a v-on:click.prevent="toPage(paginacao.current_page + 1)" class="page-link" href="#" rel="next">&rsaquo;</a>
                        </li>

                        <li v-else class="page-item disabled" aria-disabled="true">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            clientes: [],
            cliente: '',
            excluidos: false,
            paginacao: [],
            paginacao_itens: []
        }
    },
    mounted() {
        var instance = this
        this.axios
            .get('/api/clientes')
            .then(response => {
                console.log(response.data)
                this.paginacao = response.data
                this.clientes = response.data.data

                for(var i = 1; i <= this.paginacao.last_page; i++){
                    this.paginacao_itens.push(i)
                }
            })
    },
    methods: {
        mostrarClientesExcluidos() {
            this.excluidos = true
            this.toPage(this.paginacao.current_page)
        },
        esconderClientesExcluidos() {
            this.excluidos = false
            this.toPage(this.paginacao.current_page)
        },
        limparFiltro() {
            this.cliente = ''
            this.procurarCliente()
        },
        toPage(page) {
            this.clientes = []
            this.axios
                .get('/api/clientes?page=' + page + (this.excluidos ? '&excluidos' : ''))
                .then(response => {
                    this.paginacao = response.data
                    this.clientes = response.data.data

                    this.paginacao_itens = []
                    for(var i = 1; i <= this.paginacao.last_page; i++){
                        this.paginacao_itens.push(i)
                    }
                })
        },
        procurarCliente() {
            this.axios
                .get('/api/clientes?cliente='+this.cliente+(this.excluidos ? '&excluidos' : ''))
                .then(response => {
                    this.paginacao = response.data
                    this.clientes = response.data.data

                    this.paginacao_itens = []
                    for(var i = 1; i <= this.paginacao.last_page; i++){
                        this.paginacao_itens.push(i)
                    }
                })
        },
        navegarPara(url) {
            this.$router.push(url)
        },
        excluirCliente(cliente) {
            this.axios
                .delete('/api/clientes/'+cliente)
                .then(response => {
                    alert('Cliente excluido com sucesso!')
                    this.procurarCliente()
                })
        },
        restaurarCliente(cliente) {
            this.axios
                .post('/api/clientes/'+cliente+'/restore')
                .then(response => {
                    alert('Cliente restaurado com sucesso!')
                    this.procurarCliente()
                })
        }
    }
}
</script>
