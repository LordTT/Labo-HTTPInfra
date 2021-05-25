var Chance = require('chance');
var chance = new Chance();

var express = require('express')
var app = express()
var port = 3000

app.get('/', (req, res) => {
  res.send(alienMessage())
})

app.listen(port, () => {
  console.log(`Listens on ${port}`)
})

function alienMessage(){
	var message = [];
	var alienName =  chance.word();
	var alienSpeech = chance.paragraph();
	
	message.push({
	name: alienName,
	message : alienSpeech	
	})
	
	console.log(message);
	return message;
}