// fetchUrl = url.replace('show', 'getUnavailableDate');

// const getBooking = () => {
//   fetch(fetchUrl).then(function(response) {
//     return response.json();
//   }).then(function(json) {
//     bookings = json;
//     getData();
//   }).catch(function(err) {
//     console.log('Fetch problem: ' + err.message);
//   });
// }
// let getData = () => {
//   console.log(bookings);
//   flatpickr(".flatpickr-calendar", {
//     inline: true,
//     altFormat: "j F Y",
//     dateFormat: "d.m.Y",
//     minDate: "today",
//     mode: "range",
//     "locale": "fr",
//     disable: bookings
//     // defaultDate: ["28.04.2019", "30.04.2019"]
//   }).open();
// }

// getBooking();