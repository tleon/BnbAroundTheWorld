Vue.component('app-date-comp', {
    props: ['dateoutput'],
    template: `                
    <div class="row">
    <div class="col s12">

      <div class="card-calendrier-button center-align">
        <button v-on:click="$emit('datemoinsun')" class="waves-effect waves-light btn-small light-green darken-2">jour -1</button>
        <button v-on:click="$emit('today')" class="waves-effect waves-light btn-small light-green darken-2">Aujourd'hui</button>
        <button v-on:click="$emit('dateplusun')" class="waves-effect waves-light btn-small light-green darken-2">jour + 1</button>
      </div>
    </div>
    <div class="col s12">

      <span class="card-title center-align">{{ dateoutput }}</span>

    </div>
    <div class="col s12">
      <div class="divider"></div>
    </div>
  </div>`
})