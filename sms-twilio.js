const accountSid = '';
const authToken = '';
const client = require('twilio')(accountSid, authToken);

client.messages
    .create({
        body: 'Hola',
        from: '+14406168287',
        to: '+51961610362'
    })
    .then(message => console.log(message.sid))
    