const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const config = require('config');

const acceptedFormats = require('./serializer').acceptedFormats;
const SerializerError = require('./serializer').SerializerError;

const serverPort = config.get('api.port');
const clientUrl = config.get('client.host') + config.get('client.port');

app.use(bodyParser);

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

app.use((req, res, next) => {
    res.set('Access-Control-Allow-Origin', clientUrl);
    next();
});

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