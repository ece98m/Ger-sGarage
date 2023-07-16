// DOM elementlerini seçme
var homeLink = document.querySelector('a[href="#"]');
var servicesLink = document.querySelector('a[href="#services"]');
var bookingsLink = document.querySelector('a[href="#booking"]');
var contactLink = document.querySelector('a[href="#contact"]');
var bookingForm = document.querySelector('#booking form');
var contactForm = document.querySelector('#contact form');

// Ana sayfaya dönme işlemi
homeLink.addEventListener('click', function(event) {
  event.preventDefault();
  // Ana sayfaya yönlendirme kodu buraya eklenebilir
});

// Hizmetlere gitme işlemi
servicesLink.addEventListener('click', function(event) {
  event.preventDefault();
  // Hizmetler sayfasına yönlendirme kodu buraya eklenebilir
});

// Rezervasyon bilgilerini isteme işlemi
bookingsLink.addEventListener('click', function(event) {
  event.preventDefault();
  // Rezervasyon bilgilerini isteme kodu buraya eklenebilir
});

// İletişim bilgilerini verme işlemi
contactLink.addEventListener('click', function(event) {
  event.preventDefault();
  // İletişim bilgilerini verme kodu buraya eklenebilir
});

// Rezervasyon formu gönderme işlemi
bookingForm.addEventListener('submit', function(event) {
  event.preventDefault();
  // Rezervasyon formu gönderme kodu buraya eklenebilir
});

// İletişim formu gönderme işlemi
contactForm.addEventListener('submit', function(event) {
  event.preventDefault();
  // İletişim formu gönderme kodu buraya eklenebilir
});