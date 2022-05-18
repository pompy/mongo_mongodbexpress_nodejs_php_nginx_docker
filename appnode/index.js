const express = require('express');
const MongoClient = require('mongodb').MongoClient;

const app = express();
const url = 'mongodb://root:rootpassword@mongo-server:27017';

// Connect to MongoDB
MongoClient.connect(url, (err, client) => {
  if(err){
    throw new Error('Could not connect to the database');
  }
  console.log('Successfully connected to the database');
})

// Some other stuffs 
app.get('/', (req, res) => {
  res.send('Welcome --- this is node.js!');
});

app.listen(5000, () => { 
  console.log('Express is listening on port 5000!')
})