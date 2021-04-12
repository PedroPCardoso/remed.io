<template>
  <div class="container">
    <div>
      <title>ConsulteMIP'S</title>
      <!-- <Logo />
      <h1 class="title">
        CONSULTEMIPs
      </h1> -->
      <div>

        <img src='~/assets/logo.png'>
      </div>
      <div v-if="block">

        <div class="main">
        <h1>Escolha a sua profissão</h1>
          <v-select  v-model="selected" :options="options" @input="setSelected"></v-select>

<div v-if="selected=='Médico'">
        <div v-if="crm" class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text"  v-model="Ncrm"   class="form-control" placeholder="Digite o numero do seu CRM aqui">
          <br>
            <button type="button"   v-on:click="setCrm" class="btn btn-primary">adicionar</button>
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
  <div v-if="search || selected!='Médico'&&  selected!=''" class="form-group has-search">
    <span class="fa fa-search form-control-feedback"></span>
    <input type="text"  v-model="remedio"   class="form-control" placeholder="Pesquise aqui">
   <br>
    <button type="button"   v-on:click="pesquisar" class="btn btn-primary">Procurar</button>
  </div>
  

  <h6> {{msg}}</h6>
<br>

  <h6> {{msg2}}</h6>
<br>

<br>
    <button type="button" v-if="newSearch && search && remedio && crm"  v-on:click="FormComentario" class="btn btn-primary">Adicionar Comentário</button>
<br>
<br>


 <div v-if="block2" class="form-group has-search">
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
    search:false,
    crm:false,
    prof:'',
    options: [
      'Médico',
      'Farmaceutico',
      'Dentista'
    ],
    Ncrm: '',
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
      this.crm=true;

    },
    setCrm(){
      
      this.search=true
      this.block=false
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
      console.log("pesquisando");
      console.log(this.remedio)
      this.msg2='';
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
        'Clorpromazina': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Flufenazina': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Haloperidol': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Levomepromazina': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Penfluridol': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Periciazina': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Pimozida': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Pipotiazina': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Sulpirida': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Tioridazina': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Trifluoperazina': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Zuclopentixol Amissulprida': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Aripiprazol': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Clozapina': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Olanzapina': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Paliperidona': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Quetiapina': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Risperidona': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.', 'Ziprasidona': 'Aumento do risco de acidente vascular cerebral (AVC) e mortalidade.',
        'Fenobarbital': 'Alta proporção de dependência física, tolerância na indução do sono e risco de overdose em doses baixas.', 'Tiopenta': 'Alta proporção de dependência física, tolerância na indução do sono e risco de overdose em doses baixas.',
        'Alprazolam': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Bromazepam': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Clobazam': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Clonazepam': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Clordiazepóxido': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Cloxazolam': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Diazepam': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Estazolam': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Flunitrazepam': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Flurazepam': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Lorazepam': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Midazolam': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.', 'Nitrazepam.': 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.',
        'Mesilato de codergocrina': 'Ausência de eficácia',
        'Zolpidem': 'Efeitos adversos similares aos benzodiazepínicos (por exemplo: delirium, quedas, fraturas). Pequena melhora na latência e duração do sono.',
        'Amitriptilina': 'Altamente anticolinérgicos, sedativos e causam hipotensão ortostática.', 'Imipramina': 'Altamente anticolinérgicos, sedativos e causam hipotensão ortostática.', 'Nortriptilina': 'Altamente anticolinérgicos, sedativos e causam hipotensão ortostática.', 'Clomipramina': 'Altamente anticolinérgicos, sedativos e causam hipotensão ortostática.', 'Maprotilina': 'Altamente anticolinérgicos, sedativos e causam hipotensão ortostática.',
        'Tioridazina':'Altamente anticolinérgico e risco de prolongamento do intervalo QT.',
        'Doxazosina': 'Uso associado ao alto risco de hipotensão ortostática. Não recomendados para tratamento de rotina da hipertensão. Há alternativas com melhor relação risco-benefício.', 'Prazosina': 'Uso associado ao alto risco de hipotensão ortostática. Não recomendados para tratamento de rotina da hipertensão. Há alternativas com melhor relação risco-benefício.', 'Terazosina': 'Uso associado ao alto risco de hipotensão ortostática. Não recomendados para tratamento de rotina da hipertensão. Há alternativas com melhor relação risco-benefício.',
        'Clonidina': 'Alto risco de efeitos adversos ao Sistema Nervoso Central (SNC). Podem causar bradicardia e hipotensão ortostática.', 'Metildopa': 'Alto risco de efeitos adversos ao Sistema Nervoso Central (SNC). Podem causar bradicardia e hipotensão ortostática.', 'Reserpina': 'Alto risco de efeitos adversos ao Sistema Nervoso Central (SNC). Podem causar bradicardia e hipotensão ortostática.',
        'Amiodarona': 'Dados sugerem que o controle da frequência cardíaca proporciona melhor perfil risco-benefício do que o controle do ritmo em idosos. A Amiodarona está associada a doenças da tireóide, distúrbios pulmonares e prolongamento do intervalo QT.', 'Propafenona': 'Dados sugerem que o controle da frequência cardíaca proporciona melhor perfil risco-benefício do que o controle do ritmo em idosos. A Amiodarona está associada a doenças da tireóide, distúrbios pulmonares e prolongamento do intervalo QT.', 'Quinidina': 'Dados sugerem que o controle da frequência cardíaca proporciona melhor perfil risco-benefício do que o controle do ritmo em idosos. A Amiodarona está associada a doenças da tireóide, distúrbios pulmonares e prolongamento do intervalo QT.', 'Sotalol': 'Dados sugerem que o controle da frequência cardíaca proporciona melhor perfil risco-benefício do que o controle do ritmo em idosos. A Amiodarona está associada a doenças da tireóide, distúrbios pulmonares e prolongamento do intervalo QT.',
        'Aspirina': 'Aumento do risco de hemorragia digestiva, sem evidência de aumento da eficácia.',
        'Digoxina': 'A diminuição do clearance renal com o envelhecimento aumenta o risco de intoxicação digitálica. Além disso, na insuficiência cardíaca, as doses mais altas elevam o risco de toxicidade e não oferecem maiores benefícios.',
        'Dipiridamol': 'Sem evidência de eficácia como monoterapia para prevenção secundária de eventos cardiovasculares. Pode causar hipotensão ortostática. Há alternativas mais eficazes disponíveis.',
        'Bumetanida': 'Não há evidência da eficácia. Meias de compressão geralmente são mais apropriadas.', 'Furosemida': 'Não há evidência da eficácia. Meias de compressão geralmente são mais apropriadas.', 'Piretanida': 'Não há evidência da eficácia. Meias de compressão geralmente são mais apropriadas.',  
        'Nifedipino': 'Potencial para hipotensão. Risco de isquemia miocárdica.',
        'Espironolactona': 'Risco de hipercalemia em pacientes com insuficiência cardíaca, especialmente com uso concomitante de anti-inflamatórios não esteroides, Inibidores da Enzima Conversora de Angiotensina (IECA) ou bloqueadores do receptor da angiotensina.',
        'Ticlopidina': 'Há alternativas mais seguras e eficazes disponíveis.',
        'Estrógenos': 'Evidência de potencial carcinogênico (mama e endométrio). Além disso, ausência de efeito cardioprotetor e de proteção cognitiva em idosas.',
        'Clorpropamida':'Meia-vida prolongada em idosos. Pode causar hipoglicemia e síndrome de secreção inapropriada do hormônio antidiurético.',
        'Glibenclamida': 'Maior risco de hipoglicemia prolongada grave em idosos.',
        'Somatropina': 'Efeito sobre a composição corporal é pequeno e está associado ao surgimento de edema, artralgia, síndrome do túnel do carpo, ginecomastia e glicose de jejum alterada.',
        'Hiosciamina': 'Altamente anticolinérgicos. Efetividade incerta.', 'Escopolamina': 'Altamente anticolinérgicos. Efetividade incerta.',
        'Loperamida': 'Risco de diagnóstico tardio. Pode agravar a constipação com diarreia espúria e precipitar megacólon tóxico na doença inflamatória do intestino e retardar a recuperação da gastroenterite. Nos casos de gastroenterite infecciosa grave, existe o risco de exacerbação ou prolongamento da infecção.',
        'Metoclopramida': 'Pode causar efeitos extrapiramidais incluindo discinesia tardia. Risco pode ser ainda maior em idosos mais frágeis.',
        'Óleo mineral': 'Potencial para aspiração e efeitos adversos. Alternativas mais seguras disponíveis.',
        'Omeprazol': 'Potencial para desenvolvimento de osteoporose/fratura, demência e insuficiência renal com o uso prolongado.', 'Pantoprazol': 'Potencial para desenvolvimento de osteoporose/fratura, demência e insuficiência renal com o uso prolongado.', 'Lanzoprazol': 'Potencial para desenvolvimento de osteoporose/fratura, demência e insuficiência renal com o uso prolongado.', 'Rabeprazol': 'Potencial para desenvolvimento de osteoporose/fratura, demência e insuficiência renal com o uso prolongado.', 'Esomeprazol': 'Potencial para desenvolvimento de osteoporose/fratura, demência e insuficiência renal com o uso prolongado.',
        'Carisoprodol': 'A maioria dos relaxantes musculares é mal tolerada por idosos devido aos efeitos anticolinérgicos, como sedação e consequente risco de fratura. A efetividade em doses toleradas por idosos é questionável.', 'Ciclobenzaprina': 'A maioria dos relaxantes musculares é mal tolerada por idosos devido aos efeitos anticolinérgicos, como sedação e consequente risco de fratura. A efetividade em doses toleradas por idosos é questionável.', 'Orfenadrina': 'A maioria dos relaxantes musculares é mal tolerada por idosos devido aos efeitos anticolinérgicos, como sedação e consequente risco de fratura. A efetividade em doses toleradas por idosos é questionável.',
        'Aspirina > 325 mg/dia': 'Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco.', 'Diclofenaco': 'Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco.', 'Etodolaco': 'Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco.', 'Fenoprofeno': 'Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco.', 'Ibuprofeno': 'Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco.', 'Cetoprofeno': 'Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco.', 'Meloxicam': 'Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco.', 'Naproxeno': 'Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco.', 'Piroxicam': 'Aumentam o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, incluindo aqueles com idade > 75 anos ou que utilizam corticosteroides orais ou parenterais, anticoagulantes ou antiplaquetários. O uso de inibidores da bomba de prótons reduz, mas não elimina o risco.',
        'Indometacina':'Aumenta o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco. Entre os anti- inflamatórios não esteroides (AINE), a Indometacina é o agente que causa mais efeitos adversos.',
        'Cetorolaco': 'Aumenta o risco de hemorragia gastrointestinal e úlcera péptica em grupos de alto risco, por pertencer à classe dos anti-inflamatórios não esteroides (AINE).',
        'Betametasona': 'Risco de efeitos adversos graves.', 'Budesonida': 'Risco de efeitos adversos graves.', 'Deflazacorte': 'Risco de efeitos adversos graves.', 'Dexametasona': 'Risco de efeitos adversos graves.', 'Fludrocortisona': 'Risco de efeitos adversos graves.', 'Hidrocortisona': 'Risco de efeitos adversos graves.', 'Metilprednisolona': 'Risco de efeitos adversos graves.', 'Prednisolona': 'Risco de efeitos adversos graves.', 'Prednisona': 'Risco de efeitos adversos graves.',
        'Colchicina ': 'O alopurinol é o medicamento profilático de primeira escolha na gota.',
        'Alfentanila': 'Não segue a escala analgésica da OMS.', 'Fentanila': 'Não segue a escala analgésica da OMS.', 'Hidromorfona': 'Não segue a escala analgésica da OMS.', 'Metadona': 'Não segue a escala analgésica da OMS.', 'Morfina': 'Não segue a escala analgésica da OMS.', 'Nalbufina': 'Não segue a escala analgésica da OMS.', 'Oxicodona': 'Não segue a escala analgésica da OMS.', 'Petidina': 'Não segue a escala analgésica da OMS.', 'Remifentanila': 'Não segue a escala analgésica da OMS.', 'Sufentanila': 'Não segue a escala analgésica da OMS.',
        'Petidina': 'Não é um analgésico efetivo por via oral, em doses normalmente utilizadas. Pode causar neurotoxicidade. Há alternativas mais seguras disponíveis.', 'Dolantina': 'Não é um analgésico efetivo por via oral, em doses normalmente utilizadas. Pode causar neurotoxicidade. Há alternativas mais seguras disponíveis.', 'Meperidin': 'Não é um analgésico efetivo por via oral, em doses normalmente utilizadas. Pode causar neurotoxicidade. Há alternativas mais seguras disponíveis.',
        'Nitrofurantoína': 'Potencial para toxicidade pulmonar. Apresenta perda de eficácia em pacientes com ClCr < 60 mL/min devido à concentração inadequada do fármaco na urina. Há alternativas mais seguras disponíveis.',
        'Betametasona': 'Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.', 'Deflazacorte': 'Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.', 'Dexametasona': 'Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.', 'Hidrocortisona': 'Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.', 'Metilprednisolona': 'Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.', 'Prednisolona': 'Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.', 'Prednisona': 'Exposição desnecessária aos efeitos adversos de longo prazo dos corticosteroides sistêmicos.',
        'Teofilina': 'Existência de alternativa mais segura e efetiva. Além disso, risco de efeitos adversos devido ao índice terapêutico estreito.',
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
