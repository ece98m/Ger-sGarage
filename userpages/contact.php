<?php include "header.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ger's Garage - Contact</title>
  <link rel="stylesheet" href="stylecontact.css">
</head>
<body>

  <section id="contact">
    <h2>Contact Us</h2>
    <p>For any inquiries or feedback, please feel free to reach out to us:</p>
  
    <ul>
      <li>Email: info@gersgarage.com</li>
      <li>Phone: +1 123-456-7890</li>
      <li>Address: 123 Main Street, City, Country</li>
    </ul>
  
    <p>We look forward to hearing from you!</p>

    <h3>Send us a Message</h3>
    <form>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
  
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
  
      <label for="message">Message:</label>
      <textarea id="message" name="message" rows="4" required></textarea>
  
      <button type="submit">Send</button>
    </form>
  </section>

  <!-- Diğer içerikler buraya eklenebilir -->

  <footer>
    <p>&copy; 2023 Ger's Garage. All rights reserved.</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>