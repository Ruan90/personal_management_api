const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const config = require('config');

const acceptedFormats = require('./Serializer').acceptedFormats;
const SerializerError = require('./Serializer').SerializerError;

const serverPort = config.get('api.port');
const clientUrl = config.get('client.host') + config.get('client.port'); //url e porta de cliente da api

const ValorNaoSuportado = require('./errors/ValorNaoSuportado');
const NaoEncontrado = require('./errors/NaoEncontrado');
const CampoInvalido = require('./errors/CampoInvalido');
const DadosNaoFornecidos = require('./errors/DadosNaoFornecidos');

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

    if(error instanceof ValorNaoSuportado){
        status = 406;
    }
    if(error instanceof NaoEncontrado){
        status = 404;
    }
    if(error instanceof CampoInvalido || error instanceof DadosNaoFornecidos){
        status = 400;
    }

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