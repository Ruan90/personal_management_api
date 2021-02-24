const jsontoxml = require('jsontoxml');
const { Sequelize } = require('sequelize/types');

class Serializer{
    
    json(data){
        return JSON.stringify(data);
    }

    xml(data){

        let tag = this.tagSingular;

        /**
         * Caso a estrutura de dados tiver mais de um item, é adicionado uma
         * tag pai no plural
         */
        if(Array.isArray(data)){
            tag = this.tagPlural;
            data = data.map((item) => {
                return {
                    [this.tagSingular]: item
                }
            });
        }

        return jsontoxml({ [tag]: data });
    }

    serializer(data){

        data = this.filtrar(data);

        if(this.contentType === 'application/json'){
            return this.json(data);
        }
        if(this.contentType === 'application/xml'){
            return this.xml(data);
        }
    }

    objectFilter(data){
        
        const newObject = {};

        this.publicAttributes.forEach((attr) => {
            if(data.hasOwnProperty(attr)){
                newObject[attr] = data[attr];
            }
        });

        return newObject;
    }

    filter(data){

        if(Array.isArray(data)){
            data = data.map(item => {
                return this.objectFilter(item);
            });
        }else{
            data = this.objectFilter(data);
        }

        return data;
    }
}

/**
 * Classe para gerar a resposta em xml adequado para os erros de requisições
 * trazendo um id, mensagem e atributos extras, todos customizados
 */
class SerializerError extends Serializer{

    constructor(contentType, attributesExtra){
        super();
        this.contentType = contentType;
        this.publicAttributes = ['id', 'message'].concat(attributesExtra || []);
        this.tagSingular = 'erro';
        this.tagPlural = 'erros';
    }
}

module.exports = {
    Serializer: Sequelizer,
    SerializerError: SerializerError,
    acceptedFormats: ['application/json', 'application/xml']
}