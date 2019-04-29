fetchUrl = url.replace('show', 'getUnavailableDate');

let test;

const getBooking = () => {
  fetch(fetchUrl).then(function(response) {
    return response.json();
  }).then(function(bookings) {
    test = bookings;
    getData(bookings);
  }).catch(function(err) {
    console.log('Fetch problem: ' + err.message);
  });
}
let getData = (bookings) => {
  let unavailableDate = [];
  for(let i = 0;  i < Object.keys(bookings).length -1; i++){
    unavailableDate.push(bookings[i]);
  }
  let dDate = bookings['dDate'];
  flatpickr(".flatpickr-calendar", {
    inline: true,
    altFormat: "j F Y",
    dateFormat: "d.m.Y",
    minDate: "today",
    mode: "range",
    "locale": "fr",
    disable: unavailableDate,
    defaultDate: dDate
  }).open();
}

getBooking();

