const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const config = require('config');

const port = config.get('api.port');

app.use(bodyParser);

app.listen(port, () => console.log(`API executando na porta ${port}`));