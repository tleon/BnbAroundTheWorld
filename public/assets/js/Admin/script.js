// JQuery script pour le menu
$(document).ready(function() {
  $(".sidenav").sidenav();
  chart1();
  chart2();
});


function chart1() {
  $.get("/Admin/bookingChart").done(function(r) {
    data = JSON.parse(r);
    data.forEach(element => {
      month = parseInt(element.month.substr(4, 2)) - 1;
      d1[month] = parseInt(element.reservations);
    });
    myChart.update();
  });
}

function chart2() {
  $.get("/Admin/priceChart").done(function(r) {
    data = JSON.parse(r);
    data.forEach(element => {
      total = parseInt(element.price);
      room = parseInt(element.room_id) -1 ;
      d2[room] = total;
    });
    myChart2.update();
  });
}

let d1 = [0,0,0,0,0,0,0,0,0,0,0,0]
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
        data: d1,
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

let d2 = [0, 0, 0, 0, 0];
var ctx2 = document.getElementById("myChart2").getContext("2d");
var myChart2 = new Chart(ctx2, {
  type: "pie",
  data: {
    datasets: [
      {
        data: d2,
        backgroundColor: ["#bf55ec", "#ff6384", "#ffcd56", "#36a2eb", "#7cb342"]
      }
    ],
    labels: ["USA", "Japon", "Tailande", "France", "Afrique"]
  }
});