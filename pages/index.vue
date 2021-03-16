<template>
  <div class="container">
    <div>
      <Logo />
      <h1 class="title">
        remed.io
      </h1>
      <div v-if="block">

        <div class="main">
        <h1>Escolha a sua profissão</h1>
          <v-select  v-model="selected" :options="options" @input="setSelected"></v-select>

        <div v-if="crm" class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text"  v-model="Ncrm"   class="form-control" placeholder="Digite o numero do deu CRM aqui">
          <br>
            <button type="button"   v-on:click="setCrm" class="btn btn-primary">adicionar</button>
          </div>
          <!-- <select  v-model="prof"  class="form-control">
              <option value=""><span class="flag-icon flag-icon-gr"></span>Selecione a sua profissão</option>
              <option> Médico </option>
              <option>Farmaeutico</option>
              <option>Enfermeiro</option>
            </select> -->
        </div>


      </div>

  <!-- Actual search box -->
  <div v-if="search" class="form-group has-search">
    <span class="fa fa-search form-control-feedback"></span>
    <input type="text"  v-model="remedio"   class="form-control" placeholder="Pesquise aqui">
   <br>
    <button type="button"   v-on:click="pesquisar" class="btn btn-primary">Procurar</button>
  </div>
  

  <h6> {{msg}}</h6>


  
</div>


    </div>
  </div>
</template>

<script>

import 'vue-select/dist/vue-select.css';

export default { 
   data() {
    return {

    remedio: '',
    msg:'',
    search:false,
    crm:false,
    prof:'',
    options: [
      'Médico',
      'Farmaeutico',
      'Enfermeiro'
    ],
    Ncrm: '',
    selected:'',
    block:true
    };
  },
  methods: {
    setSelected: function(value){
      console.log(value);
      this.crm=true;

    },
    setCrm(){
      
      this.search=true
      this.block=false
    },
    pesquisar: function () {
      console.log("pesquisando");
      console.log(this.remedio)
      var listaConsenso = {
        "lorazepam":   "acordo ao consenso brasileiro é inapropriado para idosos pois causa dependência e risco de queda.",
        "biperideno":   "Risco de toxicidade anticolinérgica.",
        "triexifenidil": "Risco de toxicidade anticolinérgica.",
        "Bronfeniramina": "Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico." ,
        "Carbinoxamina":  "Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
        "Ciproeptadina":  "Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
        "Clemastina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
        "Clorfeniramina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
        "Dexclorfeniramina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
        "Difenidramina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
        "Dimenidrinato":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
        "Doxilamina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
        "Hidroxizina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
        "Meclizina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
        "Prometazina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
        "Triprolidina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico.",
      }
      
      this.msg=listaConsenso[this.remedio];
      console.log(this.msg);
      // alert(listaConsenso[this.remedio])
    }
  }
  }
</script>

<style>
/* Styles for wrapping the search box */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
select{
    font-family: 'FontAwesome' , 'TATSanaChon';
}

.main {
    width: 100%;
    margin: 50px auto;
}

/* Bootstrap 4 text input with search icon */

.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}

.container {
  /* margin: 0 auto; */
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family:
    'Quicksand',
    'Source Sans Pro',
    -apple-system,
    BlinkMacSystemFont,
    'Segoe UI',
    Roboto,
    'Helvetica Neue',
    Arial,
    sans-serif;
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
