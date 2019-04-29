// JQuery script pour le menu
$(document).ready(function() {
  $(".sidenav").sidenav();
  chart1();
  chart2();
});

function chart1() {
  $.get("/Admin/bookingChart").done(function(r) {
    data = JSON.parse(r);
    console.log(data);
    for (var keys in data) {
      data[keys].forEach(element => {
        month = parseInt(element.month.substr(4, 2)) - 1;
        d1[keys][month] = parseInt(element.reservations);
      });
    }

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

let d1 = { total: [0,0,0,0,0,0,0,0,0,0,0,0],
          usa: [0,0,0,0,0,0,0,0,0,0,0,0],
          japon: [0,0,0,0,0,0,0,0,0,0,0,0],
          thailand: [0,0,0,0,0,0,0,0,0,0,0,0],
          france: [0,0,0,0,0,0,0,0,0,0,0,0],
          africa: [0,0,0,0,0,0,0,0,0,0,0,0] }
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
        data: d1['total'],
        label: "Réservations",
        backgroundColor: "rgba(0, 59, 85, 1)",
        borderColor: "#80bfb7",
        fill: false
      },
      {
        data : d1['usa'],
        label: 'USA',
        backgroundColor: "#bf55ec",
        borderColor: "#bf55ec",
        fill: false
      },
      {
        data : d1['japon'],
        label: 'Japon',
        backgroundColor: "#ff6384",
        borderColor: "#ff6384",
        fill: false
      },
      {
        data : d1['thailand'],
        label: 'Thailande',
        backgroundColor: "#ffcd56",
        borderColor: "#ffcd56",
        fill: false
      },
      {
        data : d1['france'],
        label: 'France',
        backgroundColor: "#36a2eb",
        borderColor: "#36a2eb",
        fill: false
      },
      {
        data : d1['africa'],          
        label: 'Afrique',
        backgroundColor: "#7cb342",
        borderColor: "#7cb342",
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