<?php include "header.php"; ?>
  
  <section id="">
   
<head>
  <title>Autoservice</title>
  <link rel="stylesheet" type="text/css" href="styleprofile.css">
</head>
<body>
  <header>
    <h1>Profile</h1>
  
  </header>

  <main>
    <section id="arac-ekle">
      <h2>Araç Ekle</h2>
      <form>
        <label for="vehicle-type">Araç Türü:</label>
        <input type="text" id="vehicle-type" name="vehicle-type" required>
        
        <label for="vehicle-make">Araç Markası:</label>
        <input type="text" id="vehicle-make" name="vehicle-make" required>
        
        <label for="license-details">Araç Lisans Detayları:</label>
        <input type="text" id="license-details" name="license-details" required>
        
        <label for="engine-type">Araç Motor Tipi:</label>
        <input type="text" id="engine-type" name="engine-type" required>
        
        <button type="submit">Araç Ekle</button>
      </form>
    </section>

    <section id="rezervasyonlarim">
      <h2>Rezervasyonlarım</h2>
      <table>
        <tr>
          <th>Araç Türü</th>
          <th>Araç Markası</th>
          <th>Araç Lisans Detayları</th>
          <th>Araç Motor Tipi</th>
          <th>Durum</th>
        </tr>
        <tr>
          <td>Motorbike</td>
          <td>Audi</td>
          <td>ABC 123</td>
          <td>Diesel</td>
          <td>Onaylandı</td>
        </tr>
        <!-- Diğer rezervasyonlar buraya eklenebilir -->
      </table>
    </section>
  </main>

  <footer>
    <p>Telif Hakkı &copy; 2023 Autoservice</p>
  </footer>


  </section>

  <!-- Diğer içerikler buraya eklenebilir -->
  <?php include "footer.php"; ?>
