// Handle ticket booking form submission
document.getElementById('ticketForm').addEventListener('submit', function(event) {
  event.preventDefault();

  const eventName = document.getElementById('eventName').value;
  const ticketQuantity = document.getElementById('ticketQuantity').value;
  const userName = document.getElementById('userName').value;
  const userEmail = document.getElementById('userEmail').value;

  if (userName && userEmail) {
    alert('Thank you for booking ${ticketQuantity} ticket(s) for "${eventName}"!\nA confirmation email will be sent to: ${userEmail}');
    // Here, you can proceed with processing the payment and finalizing the booking.
  } else {
    alert('Please fill out all fields.');
  }
});

// Simulate a ticket booking when a user clicks on "Book Tickets" button
function bookTicket(eventName) {
  alert('You are booking a ticket for "${eventName}". Please fill in the booking details below.');
}