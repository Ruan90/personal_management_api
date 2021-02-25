class DadosNaoFornecidos extends Error{
    constructor(name){
        super('Não foram fornecidos dados para a atualização!');
        this.name = 'DadosNaoFornecidos';
        this.idError = 2;
    }
}

module.exports = DadosNaoFornecidos;