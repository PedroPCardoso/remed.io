<template>
  <div class="container">
    <div>
      <Logo />
      <h1 class="title">
        remedio
      </h1>
      
<div class="main">
  
  <!-- Actual search box -->
  <div class="form-group has-search">
    <span class="fa fa-search form-control-feedback"></span>
    <input type="text"  v-model="remedio"   class="form-control" placeholder="Pesquise aqui">
   <br>
    <button type="button"   v-on:click="pesquisar" class="btn btn-primary">Procurar</button>
  </div>
  

  <h4> {{diagnostico}}</h4>
  
</div>


    </div>
  </div>
</template>

<script>
export default { 
   data: {
    remedio: 'Pesquise aqui',
    dignostico:'',
  },
  methods: {
    pesquisar: function () {
      console.log("pesquisando");
      var listaConsenso = {
        "lorazepam para o idosos":   "acordo ao consenso brasileiro é inapropriado para idosos pois causa dependência e risco de queda.",
        "two":   2,
        "three": 3,
        "four":  4,
        "five":  5
      }
      this.dignostico=listaConsenso[this.remedio];
      console.log(this.dignostico);
      // alert(listaConsenso[this.remedio])
    }
  }
  }
</script>

<style>
/* Styles for wrapping the search box */

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
