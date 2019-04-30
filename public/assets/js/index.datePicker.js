  let event = document.getElementById('roomId');
  event.addEventListener('change', function () {
    let getUrl = window.location;
    let baseUrl = getUrl.protocol + "//" + getUrl.host + "/room/getUnavailableDate/" + this.value;
    getBooking(baseUrl);
  }, false);

  const getBooking = (url) => {
    fetch(url).then(function (response) {
      return response.json();
    }).then(function (bookings) {
      getData(bookings);
    }).catch(function (err) {
      console.log('Fetch problem: ' + err.message);
    });
  }

  let getData = (bookings) => {
    let unavailableDate = [];
    for (let i = 0; i < Object.keys(bookings).length - 1; i++) {
      unavailableDate.push(bookings[i]);
    }
    flatpickr("#dp1", {
      position: "above",
      altFormat: "j F Y",
      dateFormat: "d.m.Y",
      minDate: "today",
      mode: "range",
      "locale": "fr",
      disable: unavailableDate
    });
  }

  let inputId = document.getElementById("dp1");
  let inputIdParent = document.getElementById("tooltiptest");
  inputIdParent.addEventListener("click", function () {
    if (window.getComputedStyle(inputId).display === "none") {
      M.toast({ html: 'Sélectionnez une chambre pour voir ses disponibilités', classes: 'rounded blue' });
    }
  }, false);