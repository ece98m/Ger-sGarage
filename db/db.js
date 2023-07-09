// mysql paketini yükleyin
const mysql = require('mysql');

// MySQL bağlantı bilgilerini ayarlayın
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '12345',
  database: 'gersgarage'
});

// MySQL bağlantısını yapın
connection.connect((err) => {
  if (err) {
    console.error('MySQL bağlantısı başarısız: ' + err.stack);
    return;
  }
  console.log('MySQL bağlantısı başarıyla gerçekleştirildi');
});

// Veritabanı sorgusu yapın
connection.query('SELECT * FROM bookings', (err, results) => {
  if (err) {
    console.error('Sorgu hatası: ' + err.stack);
    return;
  }
  console.log('Sonuçlar:');
  console.log(results);
});

// MySQL bağlantısını kapatın
connection.end((err) => {
  if (err) {
    console.error('MySQL bağlantısı kapatılamadı: ' + err.stack);
    return;
  }
  console.log('MySQL bağlantısı başarıyla kapatıldı');
});
