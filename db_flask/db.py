from flask import Flask
from flask_mysqldb import MySQL

app = Flask("__main__")

# MySQL bağlantı bilgilerini ayarlayın
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = '12345'
app.config['MYSQL_DB'] = 'gersgarage'

# MySQL bağlantısını oluşturun
mysql = MySQL(app)

@app.route('/')
def test_connection():
    cur = mysql.connection.cursor()
    cur.execute("SELECT * FROM bookings")
    data = cur.fetchall()
    cur.close()

    for row in data:
        print(row)

    return "Veritabanı bağlantısı başarılı!"

if __name__ == '__main__':
    app.run()
