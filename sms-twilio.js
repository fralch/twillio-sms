const accountSid = 'ACb1db216d0745b985252cad96efa929bb';
const authToken = 'f66393c94bed1dc0c7340efea8ff7ce4';
const client = require('twilio')(accountSid, authToken);

client.messages
    .create({
        body: 'Hola',
        from: '+14406168287',
        to: '+51961610362'
    })
    .then(message => console.log(message.sid))
    