var date = new Date();
var currentURL = currentURL = document.URL;
let formatted_date, url, bookings;
let rooms =['USA', 'Japon', 'Tailande', 'France', 'Africa'];

document.addEventListener('DOMContentLoaded', documentReady = () => {
  formatDate();
  getBooking();
});


let formatDate = () => {
  let semaine = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
  let mois= ["janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre"];
  let fr_string_formatted_date = semaine[date.getDay()] + " " + date.getDate() + " " + mois[date.getMonth()] + " " + date.getFullYear();
  let el = document.getElementById('dateJs');
  el.innerHTML = fr_string_formatted_date;
  formatted_date = date.toISOString().split('T')[0]
  url = currentURL.replace('index', 'fetch')  + '/' + formatted_date;
};

let previousDay = () => {
  date.setDate(date.getDate() - 1);
  formatDate();
  getBooking();
}

let nextDay = () => {
  date.setDate(date.getDate() + 1);
  formatDate();
  getBooking();
}

const getBooking = () => {
  fetch(url).then(function(response) {
    return response.json();
  }).then(function(json) {
    bookings = json;
    initialize();
  }).catch(function(err) {
    console.log('Fetch problem: ' + err.message);
  });
}

let initialize = () => {
  for (n=0; n < rooms.length; n++){
    document.getElementById(rooms[n]).classList.remove('is-displayed')
  };
  for (i = 0; i < Object.keys(bookings).length; i++){
    // console.log(bookings[i].name);
    let parent = document.getElementById(bookings[i].name);
    let div = parent.getElementsByClassName('user');
    let val = bookings[i].username;
    appendValues(div, val);
    div = parent.getElementsByClassName('guests');
    val = bookings[i].nb_person;
    appendValues(div, val);
    div = parent.getElementsByClassName('date-departure');
    val = bookings[i].end_date.split(' ')[0];
    let splt = val.split('-');
    val = splt[2] + '-' + splt[1] + '-' + splt[0];
    appendValues(div, val);
    document.getElementById(bookings[i].name).classList.add('is-displayed');
  }
}


function appendValues(div, value){
div[0].innerHTML = value;
}