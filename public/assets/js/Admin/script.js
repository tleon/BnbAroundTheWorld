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