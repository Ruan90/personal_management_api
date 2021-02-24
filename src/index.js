const express = require('express');
const app = express();
const bodyParser = require('body-parser');

app.use(bodyParser);

app.listen(3000, () => {
    console.log("funcionando!");
});