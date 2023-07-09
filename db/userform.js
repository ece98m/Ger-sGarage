const express = require('express');
const mysql = require('mysql');


// MySQL bağlantı bilgilerini ayarlayın
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '12345',
  database: 'gersgarage'
});



