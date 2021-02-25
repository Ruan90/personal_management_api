class NaoEncontrado extends Error{
    constructor(name){
        super(`${name} não foi encontrado!`);
        this.name = 'NaoEncontrado';
        this.idError = 0;
    }
}

module.exports = NaoEncontrado;