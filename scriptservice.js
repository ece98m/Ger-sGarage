function showBookingForm(serviceType) {
    // Set the service_type field value
    document.getElementById('service_type').value = serviceType;
  
    // Show the booking form container
    var bookingFormContainer = document.getElementById('booking-form-container');
    bookingFormContainer.style.display = 'block';
  
    // Scroll to the booking form container
    bookingFormContainer.scrollIntoView({ behavior: 'smooth' });
  }
  