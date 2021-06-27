<template>
  <div class="container">
    <div>
      <title>ConsulteMIPI'S</title>
      <!-- <Logo />
      <h1 class="title">
        CONSULTEMIPs
      </h1> -->
      <div>

        <img src='~/assets/logo.png'>
      </div>
      <div v-if="block">

        <div class="main">
        <h4>Escolha a sua profissão</h4>
          <v-select  v-model="selected" :options="options" @input="setSelected"></v-select>

<div v-if="selected=='Médico'">
        <div v-if="crm" class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text"  v-model="Ncrm"   class="form-control" placeholder="Digite o numero do seu CRM aqui">
          <br>
            <button type="button"   v-on:click="setCrm" class="btn btn-primary">adicionar</button>
          </div>
        </div>

<div v-if="selected=='Farmacêutico'">
        <div v-if="crf" class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text"  v-model="Ncrf"   class="form-control" placeholder="Digite o numero do seu CRF aqui">
          <br>
            <button type="button"   v-on:click="setCrf" class="btn btn-primary">adicionar</button>
          </div>
        </div>

<div v-if="selected=='Dentista'">
        <div v-if="crf" class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text"  v-model="Ncrf"   class="form-control" placeholder="Digite o numero do seu CRD aqui">
          <br>
            <button type="button"   v-on:click="setCrf" class="btn btn-primary">adicionar</button>
          </div>
        </div>




        </div>



          <!-- <select  v-model="prof"  class="form-control">
              <option value=""><span class="flag-icon flag-icon-gr"></span>Selecione a sua profissão</option>
              <option> Médico </option>
              <option>Farmaeutico</option>
              <option>Enfermeiro</option>
            </select> -->


      </div>

  <!-- Actual search box -->
  <div v-if="search &&  selected!=''" class="form-group has-search">
    <span class="fa fa-search form-control-feedback"></span>
    <input type="text"  v-model="remedio"   class="form-control" placeholder="Pesquise aqui">
   <br>
    <button type="button"   v-on:click="pesquisar" class="btn btn-primary">Procurar</button>
  </div>
  
  <div v-if="procurando" class="form-group has-search ">

    <b> Racional: </b> <br> <br> 

    <span  v-html="msg">
      
        </span>
    <br>

      <h6> {{msg2}}</h6>
    <br>
    <br>

  </div>
 
    <button type="button" v-if="newSearch && search && remedio && crm"  v-on:click="FormComentario" class="btn btn-primary">Adicionar Comentário</button>
<br>
<br>


 <div v-if="block2" class="form-group has-search container">
    <span class="fa fa-search form-control-feedback"></span>
    <input type="text"  v-model="newComent"   class="form-control" placeholder="Adicionar novo comentário">
   <br>
    <button type="button"   v-on:click="AdicionarComentario" class="btn btn-primary">Adicionar</button>
  </div>
  
</div>


    </div>
  </div>
</template>

<script>

import 'vue-select/dist/vue-select.css';
import VueCookies from 'vue-cookies';

export default { 
   data() {
    return {

    remedio: '',
    msg:'',
    procurando:false,
    search:false,
    crm:false,
    cro:false,
    crf:false,
    prof:'',
    options: [
      'Médico',
      'Farmacêutico',
      'Dentista'
    ],
    Ncrm: '',
    Ncro:'',
    Ncrf:'',
    selected:'',
    block:true,
    block2:false,
    newSearch:false,
    newComent:'',
    newComents: {},
    msg2:''
    };
  },
  methods: {
    setSelected: function(value){
      console.log(value);
      if(value == "Médico"){
        this.crm=true;
      }
      else{
        this.crf=true;
      }
    },
    setCrm(){
      
      this.search=true
      this.block=false
    },
    setCrf(){
      
      this.search=true
    
    },
    FormComentario(){
      this.block2=true
    },
    AdicionarComentario(){
      
      var json_str = $cookies.get('mycookie');
      
      if(json_str){
        var arr = JSON.parse(JSON.stringify(json_str));
        this.newComents=arr
      }
      this.newComents[this.remedio]=this.newComent
      var json_str = JSON.stringify(this.newComents);
      $cookies.set('mycookie', json_str);
      this.block2=false;

    },
    pesquisar: function () {
      console.log(this.remedio)
      this.procurando=true;

      this.msg2='';
      var listaConsenso = {
        "Lorazepam":   "<b> Racional : </b> <br> <br>  acordo ao consenso brasileiro é inapropriado para idosos pois causa dependência e risco de queda.",
        "Biperideno":   "Risco de toxicidade anticolinérgica.",
        "Triexifenidil": "Risco de toxicidade anticolinérgica.",
        "Bronfeniramina": "Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância, quando utilizados como hipnótico. `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Carbinoxamina":  "Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Ciproeptadina":  "Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Clemastina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Clorfeniramina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Dexclorfeniramina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Difenidramina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Dimenidrinato":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Doxilamina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Hidroxizina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Meclizina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Prometazina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,
        "Triprolidina":"Risco de sedação e efeitos anticolinérgicos (confusão, boca seca, constipação, entre outros). Há o desenvolvimento de tolerância,  `<div> <b > Exceção</b> : <br> O uso de Difenidramina, em situações como reação alérgica grave, pode ser apropriado. </div> `" ,


        "Clorpromazina": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Flufenazina": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Haloperidol": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Levomepromazina": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Penfluridol": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Periciazina": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Pimozida": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Pipotiazina": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Sulpirida": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Tioridazina": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Trifluoperazina": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Zuclopentixol Amissulprida": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Aripiprazol": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Clozapina": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Olanzapina": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Paliperidona": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Quetiapina": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Risperidona": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `", "Ziprasidona": "Aumento do risco de acidente vascular cerebral (AVC) e mortalidade. `<div> <b > Exceção</b> : <br> O uso deve ser restrito aos casos nos quais estratégias não farmacológicas tenham falhado ou quando o paciente representa ameaça a si ou a outros. </div> `",
        "Fenobarbital": "Alta proporção de dependência física, tolerância na indução do sono e risco de overdose em doses baixas.", "Tiopenta": "Alta proporção de dependência física, tolerância na indução do sono e risco de overdose em doses baixas.",
        "Alprazolam": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.",
        "Bromazepam": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.", "Clobazam": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.", "Clonazepam": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.", "Clordiazepóxido": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.", "Cloxazolam": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.", "Diazepam": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.", "Estazolam": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.", "Flunitrazepam": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.", "Flurazepam": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.", 
        "Lorazepam": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.", "Midazolam": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.", "Nitrazepam.": "Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratar crises convulsivas, distúrbios do sono REM, síndrome de abstinência a benzodiazepínicos e etanol, transtorno de ansiedade generalizada grave, em anestesia perioperatória e cuidados paliativos. </div> `.",
        "Mesilato de codergocrina": "Ausência de eficácia",
        "Zolpidem": "Efeitos adversos similares aos benzodiazepínicos (por exemplo: delirium, quedas, fraturas). Pequena melhora na latência e duração do sono.",
        "Amitriptilina": "Altamente anticolinérgicos, sedativos e causam hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> `", "Imipramina": "Altamente anticolinérgicos, sedativos e causam hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> `", "Nortriptilina": "Altamente anticolinérgicos, sedativos e causam hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> `", "Clomipramina": "Altamente anticolinérgicos, sedativos e causam hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> `", "Maprotilina": "Altamente anticolinérgicos, sedativos e causam hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> `",
        "Tioridazina":"Altamente anticolinérgico e risco de prolongamento do intervalo QT.",
        "Doxazosina": "Uso associado ao alto risco de hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> <br> Não recomendados para tratamento de rotina da hipertensão. Há alternativas com melhor relação risco-benefício.", "Prazosina": "Uso associado ao alto risco de hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> ` Não recomendados para tratamento de rotina da hipertensão. Há alternativas com melhor relação risco-benefício.", "Terazosina": "Uso associado ao alto risco de hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> ` Não recomendados para tratamento de rotina da hipertensão. Há alternativas com melhor relação risco-benefício.",
        "Clonidina": "Alto risco de efeitos adversos ao Sistema Nervoso Central (SNC). Podem causar bradicardia e hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> `", "Metildopa": "Alto risco de efeitos adversos ao Sistema Nervoso Central (SNC). Podem causar bradicardia e hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> `", "Reserpina": "Alto risco de efeitos adversos ao Sistema Nervoso Central (SNC). Podem causar bradicardia e hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> `",
        "Amiodarona": "Dados sugerem que o controle da frequência cardíaca proporciona melhor perfil risco-benefício do que o controle do ritmo em idosos. A Amiodarona está associada a doenças da tireóide, distúrbios pulmonares e prolongamento do intervalo QT.", "Propafenona": "Dados sugerem que o controle da frequência cardíaca proporciona melhor perfil risco-benefício do que o controle do ritmo em idosos. A Amiodarona está associada a doenças da tireóide, distúrbios pulmonares e prolongamento do intervalo QT.", "Quinidina": "Dados sugerem que o controle da frequência cardíaca proporciona melhor perfil risco-benefício do que o controle do ritmo em idosos. A Amiodarona está associada a doenças da tireóide, distúrbios pulmonares e prolongamento do intervalo QT.", "Sotalol": "Dados sugerem que o controle da frequência cardíaca proporciona melhor perfil risco-benefício do que o controle do ritmo em idosos. A Amiodarona está associada a doenças da tireóide, distúrbios pulmonares e prolongamento do intervalo QT.",
        "Aspirina": "Aumento do risco de hemorragia digestiva, sem evidência de aumento da eficácia.",
        "Digoxina": "A diminuição do clearance renal com o envelhecimento aumenta o risco de intoxicação digitálica. Além disso, na insuficiência cardíaca, as doses mais altas elevam o risco de toxicidade e não oferecem maiores benefícios.",
        "Dipiridamol": "Sem evidência de eficácia como monoterapia para prevenção secundária de eventos cardiovasculares. Pode causar hipotensão ortostática. `<div> <b > Exceção</b> : <br> Podem ser apropriados para tratamento da dor e/ou depressão grave. Pode ser apropriado o uso da Nortriptilina para tratamento da depressão associada à doença de Parkinson em idosos jovens. </div> ` Há alternativas mais eficazes disponíveis.",
        "Bumetanida": "Não há evidência da eficácia. Meias de compressão geralmente são mais apropriadas.", "Furosemida": "Não há evidência da eficácia. Meias de compressão geralmente são mais apropriadas.", "Piretanida": "Não há evidência da eficácia. Meias de compressão geralmente são mais apropriadas.",  
        "Nifedipino": "Potencial para hipotensão. Risco de isquemia miocárdica.",
        "Espironolactona": "Risco de hipercalemia em pacientes com insuficiência cardíaca, especialmente com uso concomitante de anti-inflamatórios não esteroides, Inibidores da Enzima Conversora de Angiotensina (IECA) ou bloqueadores do receptor da angiotensina.",
        "Ticlopidina": "Há alternativas mais seguras e eficazes disponíveis.",
        "Estrógenos": "Evidência de potencial carcinogênico (mama e endométrio). Além disso, ausência de efeito cardioprotetor e de proteção cognitiva em idosas.",
        "Andrógenos":"Potenciais para problemas cardíacos e contraindicados para homens com câncer de próstata.<br> <div> <b > Exceção</b> : <br> Evitar, a menos que estejam indicados para hipogonadismo moderado a grave. </div>",
        "Clorpropamida":"Meia-vida prolongada em idosos. Pode causar hipoglicemia e síndrome de secreção inapropriada do hormônio antidiurético.",
  
        "Somatropina": " Efeito sobre a composição corporal é pequeno e está associado ao surgimento de edema, artralgia, síndrome do túnel do carpo, ginecomastia e glicose de jejum alterada. <div> <b> Exceção</b> : <br> Evitar, exceto em casos de reposição hormonal, após remoção da glândula pituitária. </div> ",
        "Hiosciamina": "Altamente anticolinérgicos. Efetividade incerta. <div> <b > Exceção</b> : <br> Evitar, exceto em cuidado paliativo de curto prazo para reduzir secreções orais. </div>", "Escopolamina": "Altamente anticolinérgicos. Efetividade incerta. <div> <b > Exceção</b> : <br> Evitar, exceto em cuidado paliativo de curto prazo para reduzir secreções orais. </div>",
        "Loperamida": "Risco de diagnóstico tardio. Pode agravar a constipação com diarreia espúria e precipitar megacólon tóxico na doença inflamatória do intestino e retardar a recuperação da gastroenterite. Nos casos de gastroenterite infecciosa grave, existe o risco de exacerbação ou prolongamento da infecção.",
        "Metoclopramida": "Pode causar efeitos extrapiramidais incluindo discinesia tardia. Risco pode ser ainda maior em idosos mais frágeis. <br> <div> <b > Exceção</b> : <br> Evitar, exceto em casos de gastroparesia. </div>",
        "Óleo mineral": "Potencial para aspiração e efeitos adversos. Alternativas mais seguras disponíveis.",
        "Omeprazol": "Potencial para desenvolvimento de osteoporose/fratura, demência e insuficiência renal com o uso prolongado <br> <div> <b > Exceção</b> : <br> Descontinuação antes de oito semanas de uso ou redução da dose para tratamento, manutenção/profilático de úlcera péptica, esofagite ou Doença do Refluxo Gastroesofágico. </div>.", "Pantoprazol": "Potencial para desenvolvimento de osteoporose/fratura, demência e insuficiência renal com o uso prolongado <br> <div> <b > Exceção</b> : <br> Descontinuação antes de oito semanas de uso ou redução da dose para tratamento, manutenção/profilático de úlcera péptica, esofagite ou Doença do Refluxo Gastroesofágico. </div>.", "Lanzoprazol": "Potencial para desenvolvimento de osteoporose/fratura, demência e insuficiência renal com o uso prolongado <br> <div> <b > Exceção</b> : <br> Descontinuação antes de oito semanas de uso ou redução da dose para tratamento, manutenção/profilático de úlcera péptica, esofagite ou Doença do Refluxo Gastroesofágico. </div>.", "Rabeprazol": "Potencial para desenvolvimento de osteoporose/fratura, demência e insuficiência renal com o uso prolongado <br> <div> <b > Exceção</b> : <br> Descontinuação antes de oito semanas de uso ou redução da dose para tratamento, manutenção/profilático de úlcera péptica, esofagite ou Doença do Refluxo Gastroesofágico. </div>.", "Esomeprazol": "Potencial para desenvolvimento de osteoporose/fratura, demência e insuficiência renal com o uso prolongado <br> <div> <b > Exceção</b> : <br> Descontinuação antes de oito semanas de uso ou redução da dose para tratamento, manutenção/profilático de úlcera péptica, esofagite ou Doença do Refluxo Gastroesofágico. </div>.",
        "Carisoprodol": "A maioria dos relaxantes musculares é mal tolerada por idosos devido aos efeitos anticolinérgicos, como sedação e consequente risco de fratura. A efetividade em doses toleradas por idosos é questionável.", "Ciclobenzaprina": "A maioria dos relaxantes musculares é mal tolerada por idosos devido aos efeitos anticolinérgicos, como sedação e consequente risco de fratura. A efetividade em doses toleradas por idosos é questionável.", "Orfenadrina": "A maioria dos relaxantes musculares é mal tolerada por idosos devido aos efeitos anticolinérgicos, como sedação e consequente risco de fratura. A efetividade em doses toleradas por idosos é questionável.",
        "Aspirina > 325 mg/dia": "Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco. <br> <div> <b > Exceção</b> : <br> Evitar uso crônico, exceto quando não houver outras alternativas e for possível associação com agente gastroprotetor. </div>", "Diclofenaco": "Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco. <br> <div> <b > Exceção</b> : <br> Evitar uso crônico, exceto quando não houver outras alternativas e for possível associação com agente gastroprotetor. </div>", "Etodolaco": "Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco. <br> <div> <b > Exceção</b> : <br> Evitar uso crônico, exceto quando não houver outras alternativas e for possível associação com agente gastroprotetor. </div>", "Fenoprofeno": "Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco. <br> <div> <b > Exceção</b> : <br> Evitar uso crônico, exceto quando não houver outras alternativas e for possível associação com agente gastroprotetor. </div>", "Ibuprofeno": "Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco. <br> <div> <b > Exceção</b> : <br> Evitar uso crônico, exceto quando não houver outras alternativas e for possível associação com agente gastroprotetor. </div>", "Cetoprofeno": "Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco. <br> <div> <b > Exceção</b> : <br> Evitar uso crônico, exceto quando não houver outras alternativas e for possível associação com agente gastroprotetor. </div>", "Meloxicam": "Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco. <br> <div> <b > Exceção</b> : <br> Evitar uso crônico, exceto quando não houver outras alternativas e for possível associação com agente gastroprotetor. </div>", "Naproxeno": "Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco. <br> <div> <b > Exceção</b> : <br> Evitar uso crônico, exceto quando não houver outras alternativas e for possível associação com agente gastroprotetor. </div>", "Piroxicam": "Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco. <br> <div> <b > Exceção</b> : <br> Evitar uso crônico, exceto quando não houver outras alternativas e for possível associação com agente gastroprotetor. </div>",
        "Indometacina":"Aumenta o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco. Entre os anti- inflamatórios não esteroides (AINE), a Indometacina é o agente que causa mais efeitos adversos.",
        "Cetorolaco": "Aumenta o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, por pertencer à classe dos anti-inflamatórios não esteroides (AINE).",
        "Betametasona": "Risco de efeitos adversos graves.", "Budesonida": "Risco de efeitos adversos graves.", "Deflazacorte": "Risco de efeitos adversos graves.", "Dexametasona": "Risco de efeitos adversos graves.", "Fludrocortisona": "Risco de efeitos adversos graves.", "Hidrocortisona": "Risco de efeitos adversos graves.", "Metilprednisolona": "Risco de efeitos adversos graves.", "Prednisolona": "Risco de efeitos adversos graves.", "Prednisona": "Risco de efeitos adversos graves.",
        "Colchicina ": "O alopurinol é o medicamento profilático de primeira escolha na gota.",
        "Alfentanila": "Não segue a escala analgésica da OMS.", "Fentanila": "Não segue a escala analgésica da OMS.", "Hidromorfona": "Não segue a escala analgésica da OMS.", "Metadona": "Não segue a escala analgésica da OMS.", "Morfina": "Não segue a escala analgésica da OMS.", "Nalbufina": "Não segue a escala analgésica da OMS.", "Oxicodona": "Não segue a escala analgésica da OMS.", "Petidina": "Não segue a escala analgésica da OMS.", "Remifentanila": "Não segue a escala analgésica da OMS.", "Sufentanila": "Não segue a escala analgésica da OMS.",
        "Petidina": "Não é um analgésico efetivo por via oral, em doses normalmente utilizadas. Pode causar neurotoxicidade. Há alternativas mais seguras disponíveis.", "Dolantina": "Não é um analgésico efetivo por via oral, em doses normalmente utilizadas. Pode causar neurotoxicidade. Há alternativas mais seguras disponíveis.", "Meperidin": "Não é um analgésico efetivo por via oral, em doses normalmente utilizadas. Pode causar neurotoxicidade. Há alternativas mais seguras disponíveis.",
        "Nitrofurantoína": "Potencial para toxicidade pulmonar. Apresenta perda de eficácia em pacientes com ClCr < 60 mL/min devido à concentração inadequada do fármaco na urina. Há alternativas mais seguras disponíveis.",
        "Betametasona": "Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.", "Deflazacorte": "Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.", "Dexametasona": "Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.", "Hidrocortisona": "Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.", "Metilprednisolona": "Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.", "Prednisolona": "Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.", "Prednisona": "Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.",
        "Teofilina": "Existência de alternativa mais segura e efetiva. Além disso, risco de efeitos adversos devido ao índice terapêutico estreito.",

      // Lista 2

      'Aspirina': 'Alto risco de sangramento em pacientes com distúrbio hemorrágico concomitante.', 'Clopidogrel': 'Alto risco de sangramento em pacientes com distúrbio hemorrágico concomitante.', 'Dipiridamol': 'Alto risco de sangramento em pacientes com distúrbio hemorrágico concomitante..', 
      'Varfarina': 'Alto risco de sangramento em pacientes com distúrbio hemorrágico concomitante.',
      'Amitriptilina': 'Efeitos pró-arrítmicos ', 'Imipramina': 'Efeitos pró-arrítmicos ', 'Nortriptilina': 'Efeitos pró-arrítmicos ', 'Clomipramina': 'Efeitos pró-arrítmicos ',
      'Diltiazem': 'Podem agravar a constipação ', 'Verapamil': 'Podem agravar a constipação ',
      'Clorpromazina': 'Podem agravar a constipação devido à forte ação anticolinérgica ', 'Clozapina': 'Podem agravar a constipação devido à forte ação anticolinérgica ', 'Flufenazina': 'Podem agravar a constipação devido à forte ação anticolinérgica ', 'Olanzapina': 'Podem agravar a constipação devido à forte ação anticolinérgica ', 'Pimozida': 'Podem agravar a constipação devido à forte ação anticolinérgica ', 'Prometazina': 'Podem agravar a constipação devido à forte ação anticolinérgica ', 'Tioridazina': 'Podem agravar a constipação devido à forte ação anticolinérgica ', 'Trifluoperazina': 'Podem agravar a constipação devido à forte ação anticolinérgica ',
      'Amitriptilina': 'Podem agravar a constipação devido à forte ação anticolinérgica ', 'Imipramina': 'Podem agravar a constipação devido à forte ação anticolinérgica ', 'Nortriptilina': 'Podem agravar a constipação devido à forte ação anticolinérgica ', 'Clomipramina': 'Podem agravar a constipação devido à forte ação anticolinérgica ',
      'Morfina': 'Risco de constipação grave ', 'Oxicodona': 'Risco de constipação grave ', 'Codeína': 'Risco de constipação grave ', 'Petidina': 'Risco de constipação grave ', 'Fentanil': 'Risco de constipação grave ', 'Sufentanil': 'Risco de constipação grave ', 'Nalbufina': 'Risco de constipação grave ', 'Tramadol': 'Risco de constipação grave ',
      'Biperideno': 'Podem agravar a constipação devido à forte ação anticolinérgica. ', 'Triexifenidil': 'Podem agravar a constipação devido à forte ação anticolinérgica. ',
      'Carisoprodol': 'Podem agravar a constipação devido à forte ação anticolinérgica. ', 'Ciclobenzaprina': 'Podem agravar a constipação devido à forte ação anticolinérgica. ', 'Orfenadrina': 'Podem agravar a constipação devido à forte ação anticolinérgica. ', 'Tizanidina': 'Podem agravar a constipação devido à forte ação anticolinérgica. ',
      'Bronfeniramina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
      'Dexbronfeniramina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.", 
      'Carbinoxamina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
      'Ciproeptadina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
      'Clemastina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
      'Dexclorfeniramina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
      'Difenidramina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
      'Dimenidrinato': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.", 
      'Doxilamina Hidroxizina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
      'Prometazina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.", 
      'Triprolidina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
      'Atropina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.", 
      'Diciclomina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
      'Homatropina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
       'Escopolamina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
        'Hioscina': "Podem agravar a constipação devido à forte ação anticolinérgica Exceção1: Evitar, a menos que não haja outra alternativa.",
        'Atropina': "Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Diciclomina': "Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Homatropina': "Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Escopolamina': "Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Hioscina': "Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Clorpromazina':"Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Clozapina':"Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Flufenazina':"Podem agravar a constipação devido à forte ação anticolinérgica.",'Olanzapina':"Podem agravar a constipação devido à forte ação anticolinérgica.",'Pimozida':"Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Prometazina':"Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Tioridazina':"Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Trifluoperazina':"Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Amitriptilina':"Podem agravar a constipação devido à forte ação anticolinérgica.",

        'Imipramina':"Podem agravar a constipação devido à forte ação anticolinérgica.",'Nortriptilina':"Podem agravar a constipação devido à forte ação anticolinérgica.",
        'Clomipramina':"Podem agravar a constipação devido à forte ação anticolinérgica.",'Morfina':"Risco de constipação grave",'Oxicodona':"Risco de constipação grave",'Codeína':"Risco de constipação grave",'Petidina':"Risco de constipação grave",'Fentanil':"Risco de constipação grave",'Sufentanil':"Risco de constipação grave",'Nalbufina':"Risco de constipação grave",'Tramadol':"Risco de constipação grave",
        'Carisoprodol':"Podem agravar a constipação devido à forte ação anticolinérgica",'Ciclobenzaprina':"Podem agravar a constipação devido à forte ação anticolinérgica",'Orfenadrina':"Podem agravar a constipação devido à forte ação anticolinérgica",'Tizanidina':"Podem agravar a constipação devido à forte ação anticolinérgica",'Indometacina':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Diclofenaco':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Etodolaco':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Cetorolaco':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Aceclofenaco':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Piroxicam':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Tenoxicam':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Lornoxicam':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Meloxicam':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Ibuprofeno':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Naproxeno':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Cetoprofeno':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Ácido Mefenâmico':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Celecoxibe':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Parecoxibe':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Etoricoxibe':"Podem aumentar o risco de lesão renal e deterioração da função renal.",'Benzidamina':"Podem aumentar o risco de lesão renal e deterioração da função renal.",
        
        'Glicosamina':"Podem aumentar o risco de lesão renal e deterioração da função renal.",
        'Condroitina':"Podem aumentar o risco de lesão renal e deterioração da função renal.",
        'Triantereno':"Pode aumentar o risco de lesão renal.",
        'Carvedilol':"Risco aumentado de broncoespasmo",
        'Labetalol':"Risco aumentado de broncoespasmo",
        'Nadolol':"Risco aumentado de broncoespasmo",'Pindolol':"Risco aumentado de broncoespasmo",
        'Propranolol':"Risco aumentado de broncoespasmo",
        'Alprazolam':"Pode induzir ou agravar o delirium.",
        'Estazolam':"Pode induzir ou agravar o delirium.",
        'Lorazepam':"Pode induzir ou agravar o delirium.",
        'Clordiazepóxido':"Pode induzir ou agravar o delirium.",
        'Clonazepam':"Pode induzir ou agravar o delirium.",
        'Diazepam':"Pode induzir ou agravar o delirium.",
        'Flurazepam':"Pode induzir ou agravar o delirium.",
        'Clorpromazina':"Pode induzir ou agravar o delirium.",
        'Dexametasona':"Pode induzir ou agravar o delirium.",
        'Prednisolona':"Pode induzir ou agravar o delirium.",
        'Metilprednisolona':"Pode induzir ou agravar o delirium.",
        'Betametasona':"Pode induzir ou agravar o delirium.",
        'Hidrocortison':"Pode induzir ou agravar o delirium.",
        'Cimetidina':"Pode induzir ou agravar o delirium.",
        'Ranitidina':"Pode induzir ou agravar o delirium.",
        'Famotidina':"Pode induzir ou agravar o delirium.",
        'Nizatidina':"Pode induzir ou agravar o delirium.",
        'Petidina':"Pode induzir ou agravar o delirium.",
        'Zolpidem':"Pode induzir ou agravar o delirium.",
        'Tioridazina':"Pode induzir ou agravar o delirium.",
        'Amitriptilina':"Pode induzir ou agravar o delirium.",
        'Imipramina':"Pode induzir ou agravar o delirium.",
        'Nortriptilina':"Pode induzir ou agravar o delirium.",
        'Clomipramina':"Pode induzir ou agravar o delirium.",
        'Clorpromazina': "Os antipsicóticos devem ser evitados para tratar os problemas comportamentais da demência, pois estão associados a um risco aumentado de AVC e de mortalidade em pacientes com demência.'<div> <b > Exceção</b>  A menos que os recursos não farmacológicos tenham falhado e o paciente represente uma ameaça a si ou a outros. </div>'",
        'Clozapina': "Os antipsicóticos devem ser evitados para tratar os problemas comportamentais da demência, pois estão associados a um risco aumentado de AVC e de mortalidade em pacientes com demência. '<div> <b > Exceção</b> A menos que os recursos não farmacológicos tenham falhado e o paciente represente uma ameaça a si ou a outros. </div>'",'Flufenazina': "Os antipsicóticos devem ser evitados para tratar os problemas comportamentais da demência, pois estão associados a um risco aumentado de AVC e de mortalidade em pacientes com demência. '<div> <b > Exceção</b> A menos que os recursos não farmacológicos tenham falhado e o paciente represente uma ameaça a si ou a outros. </div>'",'Olanzapina': "Os antipsicóticos devem ser evitados para tratar os problemas comportamentais da demência, pois estão associados a um risco aumentado de AVC e de mortalidade em pacientes com demência. '<div> <b > Exceção</b> A menos que os recursos não farmacológicos tenham falhado e o paciente represente uma ameaça a si ou a outros. </div>'",'Pimozida': "Os antipsicóticos devem ser evitados para tratar os problemas comportamentais da demência, pois estão associados a um risco aumentado de AVC e de mortalidade em pacientes com demência. '<div> <b > Exceção</b> A menos que os recursos não farmacológicos tenham falhado e o paciente represente uma ameaça a si ou a outros. </div>'",'Tioridazina': "Os antipsicóticos devem ser evitados para tratar os problemas comportamentais da demência, pois estão associados a um risco aumentado de AVC e de mortalidade em pacientes com demência. '<div> <b > Exceção</b> A menos que os recursos não farmacológicos tenham falhado e o paciente represente uma ameaça a si ou a outros. </div>'",'Trifluoperazina': "Os antipsicóticos devem ser evitados para tratar os problemas comportamentais da demência, pois estão associados a um risco aumentado de AVC e de mortalidade em pacientes com demência. '<div> <b > Exceção</b> A menos que os recursos não farmacológicos tenham falhado e o paciente represente uma ameaça a si ou a outros. </div>'",'Alprazolam':"Devem ser evitados, devido aos efeitos adversos ao SNC",'Estazolam':"Devem ser evitados, devido aos efeitos adversos ao SNC",'Lorazepam':"Devem ser evitados, devido aos efeitos adversos ao SNC",'Clordiazepóxido':"Devem ser evitados, devido aos efeitos adversos ao SNC",'Clonazepam':"Devem ser evitados, devido aos efeitos adversos ao SNC",'Diazepam':"Devem ser evitados, devido aos efeitos adversos ao SNC",'Flurazepam':"Devem ser evitados, devido aos efeitos adversos ao SNC",'Oxibutinina':"'Risco de aumento da confusão e agitação.",'Atropina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Diciclomina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Homatropina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Escopolamina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Hioscina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Cimetidina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Ranitidina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Famotidina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Nizatidina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Carisoprodol':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Ciclobenzaprina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Orfenadrina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Tizanidina':"Devem ser evitados, devido aos efeitos adversos ao SNC.",'Morfina': "Risco de exacerbação do déficit cognitivo.  '<div> <b > Exceção</b> A não ser que esteja indicado para cuidados paliativos ou manejo da dor crônica moderada a grave. </div>'",'Oxicodona': "Risco de exacerbação do déficit cognitivo.  '<div> <b > Exceção</b> A não ser que esteja indicado para cuidados paliativos ou manejo da dor crônica moderada a grave. </div>'",'Codeína': "Risco de exacerbação do déficit cognitivo.  '<div> <b > Exceção</b> A não ser que esteja indicado para cuidados paliativos ou manejo da dor crônica moderada a grave. </div>'",'Petidina': "Risco de exacerbação do déficit cognitivo.  '<div> <b > Exceção</b> A não ser que esteja indicado para cuidados paliativos ou manejo da dor crônica moderada a grave. </div>'",'Fentanil': "Risco de exacerbação do déficit cognitivo.  '<div> <b > Exceção</b> A não ser que esteja indicado para cuidados paliativos ou manejo da dor crônica moderada a grave. </div>'",'Sufentanil': "Risco de exacerbação do déficit cognitivo.  '<div> <b > Exceção</b> A não ser que esteja indicado para cuidados paliativos ou manejo da dor crônica moderada a grave. </div>'",'Nalbufina': "Risco de exacerbação do déficit cognitivo.  '<div> <b > Exceção</b> A não ser que esteja indicado para cuidados paliativos ou manejo da dor crônica moderada a grave. </div>'",'Tramadol': "Risco de exacerbação do déficit cognitivo.  '<div> <b > Exceção</b> A não ser que esteja indicado para cuidados paliativos ou manejo da dor crônica moderada a grave. </div>'",
        
        
        'Nimesulida': "'<div> <br> <br> <b > Motivo pelo qual é um MPI</b> </br> Risco pronunciado de sangramento gastrointestinal ou úlcera péptica em grupos de alto risco (ex.: idade superior a 75 anos, tomando corticoesteroides, anticoagulantes e/ou agentes antiplaquetários). Uso concomitante de inibidor de bomba de prótons reduz, mas não elimina o risco. </div>' '<div> <br><br>  <b > Ajuste de dose/ considerações especiais de uso </b> <br> <br> A nimesulida está associada a um risco ligeiramente aumentado de hepatotoxicidade, que aumenta com o tempo de exposição e a taxa. Recomenda-se a restrição do seu uso ao tratamento da dor aguda, tratamento sintomático da osteoartrite dolorosa e dismenorreia primária.   </div>' '<div> <br><br>  <b >Medicamentos e/ou terapias alternativas </b> <br><br>  Paracetamol para dor leve a moderada. </div>'",
'Glibenclamida': "'<div> <br> <br> <b > Motivo pelo qual é um MPI</b> </br> Risco pronunciado de hipoglicemia prolongada. </div>' '<div> <br><br> <b > Ajuste de dose/ considerações especiais de uso </b> <br> <br> Sem opção. </div>' '<div> <br><br> <b >Medicamentos e/ou terapias alternativas </b> <br><br> Dieta, metformina, sulfunilureias de curta duração (ex.: gliclazida). </div>'",
        'Etodolac': " '<div> <br> <br> <b > Motivo pelo qual é um MPI  </b> </br><br>  Elevado risco de sangramento, ulceração ou perfuração gastrointestinal, que pode ser fatal </div>' '<div> <br><br>  <b > Ajuste de dose/ considerações especiais de uso </b> <br><br>  Os idosos têm uma frequência mais elevada de reações adversas com AINEs, principalmente hemorragias e perfurações gastrointestinais, que podem ser fatais. </div>' '<div> <br><br>  <b >Medicamentos e/ou terapias alternativas </b> <br> <br> Paracetamol; ibuprofeno (≤ 3 x 400 mg/d ou durante menos de uma semana); naproxeno (≤ 2 x 250 mg/d ou durante menos de uma semana). Opióides com menor risco de delírio (por exemplo, naloxona, morfina, oxicodona, buprenorfina, hidromorfona). </div>'",
       'Dexclorfeniramina': " '<div> <br> <br> <b > Motivo pelo qual é um MPI</b> </br> Dentre os anti-histamínicos prescritos e não prescritos, muitos podem ter propriedades anticolinérgicas </div>' '<div> <br><br>  <b > Ajuste de dose/ considerações especiais de uso </b> <br> </div>' '<div> <br><br>  <b >Medicamentos e/ou terapias alternativas </b> <br> </div>'",

      'Nitrofurantoína': " '<div> <br> <br> <b > Motivo pelo qual é um MPI </b></br> <br> Potencial para insuficiência rena </div>' '<div> <br><br>  <b > Ajuste de dose/ considerações especiais de uso </b> <br> </div>' '<div> <br><br>  <b >Medicamentos e/ou terapias alternativas </b> <br><br>  Cefalexina. Ciprofloxacino. SMT + TMP </div>'",

      'Digoxina': " '<div> <br> <br> <b > Motivo pelo qual é um MPI </b></br><br>  Diminuição da depuração renal pode levar a aumento do risco de efeitos tóxicos. </div>' '<div> <br><br>  <b > Ajuste de dose/ considerações especiais de uso </b> <br> </div>' '<div> <br><br>  <b >Medicamentos e/ou terapias alternativas </b> <br> Digoxina em doses inferiores às recomendadas. Carvedilol. </div>'",


      }
      // this.newComents.push({
      //   key:this.remedio,
      //   value:"vazio"
      // })
      var json_str = $cookies.get('mycookie');
      
      if(json_str){
        var arr = JSON.parse(JSON.stringify(json_str));
        this.newComents=arr
      }
      this.msg=listaConsenso[this.remedio];
      if(this.newComents[this.remedio]){
        this.msg2=this.newComents[this.remedio];
        console.log(this.msg2);

      }
      this.newSearch=true
      console.log(this.msg);
      console.log(this.newComents);
      this.block=false
      // alert(listaConsenso[this.remedio])
    }
  }
  }
</script>

<style>
/* Styles for wrapping the search box */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
select{
    font-family: 'FontAwesome', 'TATSanaChon';
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
    width: 1.375rem;
    height: 1.375rem;
    line-height: 1.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}

.container {
  /* margin: 0 auto; */
  /* min-height: 100vh; */
  /* display: flex;
  justify-content: center;
  align-items: center; */
  
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
