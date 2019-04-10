let vm = new Vue({
    el: '#calendrier',
    data: {
      semaine: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
      mois: ["janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre"],
      dateDuJourNonFormate: new Date(),
      dateOutput: ""
    },
    methods: {
      datemoinsun: function () {
        let date = new Date(this.dateDuJourNonFormate.setDate(this.dateDuJourNonFormate.getDate() - 1))
        this.dateOutput = this.semaine[date.getDay()] + " " + date.getDate() + " " + this.mois[date.getMonth()] + " " + date.getFullYear()
      },
      dateplusun: function () {
        let date = new Date(this.dateDuJourNonFormate.setDate(this.dateDuJourNonFormate.getDate() + 1))
        this.dateOutput = this.semaine[date.getDay()] + " " + date.getDate() + " " + this.mois[date.getMonth()] + " " + date.getFullYear()
      },
      today: function () {
        let date = new Date();
        this.dateOutput = this.semaine[date.getDay()] + " " + date.getDate() + " " + this.mois[date.getMonth()] + " " + date.getFullYear()
      }
    },
    mounted() {
      let date = new Date();
      this.dateOutput = this.semaine[date.getDay()] + " " + date.getDate() + " " + this.mois[date.getMonth()] + " " + date.getFullYear()
    }
  })