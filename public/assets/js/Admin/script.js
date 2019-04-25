// JQuery script pour le menu
$(document).ready(function() {
  $(".sidenav").sidenav();
});

var ctx = document.getElementById("myChart").getContext("2d");
var myChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: [
      "January",
      "Febuary",
      "March",
      "April",
      "May",
      "June",
      "Jully",
      "August",
      "September",
      "October",
      "November",
      "December"
    ],
    datasets: [
      {
        data: [12, 11, 4, 5, 6, 4, 8, 4, 12, 17, 11, 8],
        label: "Réservations",
        backgroundColor: "rgba(0, 59, 85, 1)",
        borderColor: "#80bfb7",
        fill: false
      }
    ]
  },
  options: {
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: true
          }
        }
      ]
    }
  }
});

var ctx2 = document.getElementById("myChart2").getContext("2d");
var myChart2 = new Chart(ctx2, {
  type: "pie",
  data: {
    datasets: [
      {
        data: [3221, 2345, 3647, 1289],
        backgroundColor: ["#7cb342", "#36a2eb", "#ff6384", "#ffcd56"]
      }
    ],
    labels: ["Chambre 1", "Chambre 2", "Chambre 3", "Chambre 4"]
  }
});


// HERVE //


var date = new Date();


function formatDate() {
  let semaine = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
  let mois= ["janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre"];
  let fr_string_formatted_date = semaine[date.getDay()] + " " + date.getDate() + " " + mois[date.getMonth()] + " " + date.getFullYear();
  let el = document.getElementById('dateJs');
  el.innerHTML = fr_string_formatted_date;
};

function previousDay(){
  date.setDate(date.getDate() - 1);
  formatDate();
}

function nextDay(){
  date.setDate(date.getDate() + 1);
  formatDate();
}

formatDate();

formatted_date = date.toISOString().split('T')[0]

let currentURL = document.URL
let url = currentURL.replace('index', 'fetch')  + '/' + formatted_date; ;

let bookings;
// const getBooking = () => {
//   return fetch(url)
//   .then(response => response.json())
//   .then(data => {
//     console.log(data)
//   })
//   .catch(error => console.error(error))
// }

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

function initialize() {
  for (i = 0; i < Object.keys(bookings).length; i++){
    console.log(bookings[i].name);
  }
  
}