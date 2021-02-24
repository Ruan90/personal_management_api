/**
 * Modelos com a estrutura do sequelize para a geração das tabelas
 */
const models = [];

/**
 * Função para gerar as tabelas de banco de dados conforme forem criadas em todo
 * o processo de desenvolvimento
 */
async function createTables(){
    for(let count = 0; count < models.length; count++){
        const models = models[count];
        await models.sync();
    }
}

createTables();