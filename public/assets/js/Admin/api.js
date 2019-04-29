var date = new Date();
var currentURL = document.URL;
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


function appendValues(div, value){
  div[0].innerText = value;
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
  let emptyArr = [];
  for (i = 0; i < Object.keys(bookings).length; i++){
    emptyArr.push(bookings[i].name);
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
  };
  for (n=0; n < rooms.length; n++){
    let element = document.getElementById(rooms[n]);
    // Si doit partir
    if((element.classList.contains("is-displayed") == true) && (emptyArr.includes(rooms[n])==false)){
      leave(element);
    }
  }
  for (n=0; n < rooms.length; n++){
    let element = document.getElementById(rooms[n]);
    // Si pas encore display on annime l'entree
    if((element.classList.contains("is-displayed") == false) && (emptyArr.includes(rooms[n])==true)){
      appear(element);
    }
  }   
}


/// TRANSITIONS

let leave = (element) => {
  element.classList.remove("display-enter-to");
  element.classList.add("display-leave");
  
  setTimeout(function() {
    element.classList.add("display-leave-active");

    setTimeout(function() {
      element.classList.remove("display-leave");
      element.classList.add("display-leave-to");
      
      setTimeout(function() {
        element.classList.remove("display-leave-active");
        element.classList.remove("is-displayed");
      }, 800);
    }, 0);
  }, 0);
};

let appear = (element) => {
  element.classList.add("is-displayed");
  element.classList.remove("display-leave-to");
  element.classList.add("display-enter");

  setTimeout(function() {
      element.classList.add("display-enter-active");
      
      setTimeout(function() {
          element.classList.remove("display-enter");
          element.classList.add("display-enter-to");
          
          setTimeout(function() {
              element.classList.remove("display-enter-active");
          }, 1000);
      }, 0);
  }, 0);
};



