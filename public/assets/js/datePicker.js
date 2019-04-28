fetchUrl = url.replace('show', 'getUnavailableDate');

const getBooking = () => {
  fetch(fetchUrl).then(function(response) {
    return response.json();
  }).then(function(json) {
    bookings = json;
    getData();
  }).catch(function(err) {
    console.log('Fetch problem: ' + err.message);
  });
}
let getData = () => {
  console.log(bookings);
  let unavailableDate = [];
  for(let i = 0;  i < Object.keys(bookings).length -1; i++){
    // emptyArr.push(bookings);
    unavailableDate.push(bookings[i]);
  }
  let dDate = bookings['dDate'];
  console.log(dDate);
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