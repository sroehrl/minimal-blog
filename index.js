const express = require('express')
const cors = require("cors");
const fs = require("fs");
const port = process.env.PORT || 3000;
const app = express();
app.set('views', './views');
app.set('view engine', 'pug');
app.use(express.json())

const allowBluaBlue = {
    origin: 'https://blua.blue'
}
app.use(cors(allowBluaBlue));
const folder = __dirname + '/articles/';
if (!fs.existsSync(folder)) {
    fs.mkdirSync(folder)
}
const articles = [];
fs.readdirSync(folder, 'utf8').forEach(slug => {
    const article = fs.readFileSync(folder + slug, 'utf-8')
    articles.push(JSON.parse(article))
})
app.post('/receive',(req, res)=> {
    const fileName = req.body.payload.slug + '.json';
    const knownIndex = articles.findIndex(x => x.id === req.body.payload.id);
    if(req.body.event === 'deleted'){
        fs.unlinkSync(folder + fileName);
        if(knownIndex !== -1){
            articles.slice(knownIndex,1)
        }
    } else {
        fs.writeFileSync(folder + fileName, JSON.stringify(req.body.payload),'utf8');
        if(knownIndex === -1){
            articles.push(req.body.payload)
        } else {
            articles[knownIndex] = req.body.payload;
        }
    }
    res.json({request:'received'})
})

app.get('/:slug?', (req, res) => {
    const article = req.params.slug ? articles.find(x => x.slug === req.params.slug) : articles[0];
    res.render('blog',{article,articles})
})
app.listen(port, ()=> console.log('running ...'))