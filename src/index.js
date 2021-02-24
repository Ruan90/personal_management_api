const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const config = require('config');

const acceptedFormats = require('./serializer').acceptedFormats;
const SerializerError = require('./serializer').SerializerError;

const serverPort = config.get('api.port');
const clientUrl = config.get('client.host') + config.get('client.port'); //url e porta de cliente da api

app.use(bodyParser);

/**
 * Pega o formado requisitado na header accept e retorna os dados na resposta neste formato,
 * se não tiver nada explícito retorna no padrão json,
 * se o formato ainda não for suportado ou for inválido retorna erro
 */
app.use((req, res, next) => {
    
    let reqFormat = req.header('Accept');

    if(reqFormat === '*/*'){
        reqFormat = 'application/json';
    }
    if(acceptedFormats.indexOf(reqFormat) === -1){
        res.status(406);
        res.end();
        return;
    }
    res.setHeader('Content-Type', reqFormat);
    next();
});

/**
 * Configura o ip válido para o acesso da api
 */
app.use((req, res, next) => {
    res.set('Access-Control-Allow-Origin', clientUrl);
    next();
});

/**
 * Configuração das mensagens de erro customizadas e seus respectivos status http
 */
app.use((error, req, res, next) => {

    let status = 500;

    const serializer = new SerializerError(res.getHeader('Content-Type'));
    res.status(status);
    res.send(
        serializer.serializer({
            message: error.message,
            id: error.id
        })
    );
});

app.listen(port, () => console.log(`API executando na porta ${serverPort}`));