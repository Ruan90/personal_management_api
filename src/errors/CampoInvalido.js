class CampoInvalido extends Error{
    constructor(name){
        super(`O campo ${campo} está inválido!`);
        this.name = 'CampoInvalido';
        this.idError = 1;
    }
}

module.exports = CampoInvalido;