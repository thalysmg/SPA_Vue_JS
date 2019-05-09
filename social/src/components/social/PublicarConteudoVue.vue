<template>
  <div class="row">
    <grid-vue class="input-field" tamanho="12">
      <label for="conteudoID">O que está acontecendo?</label>
      <input type="text" v-model="conteudo.titulo">
      <textarea v-if="conteudo.titulo" placeholder="Conteúdo:" v-model="conteudo.texto" id="conteudoID" class="materialize-textarea"></textarea>
      <input v-if="conteudo.titulo && conteudo.texto" type="text" placeholder="Link" v-model="conteudo.link">
      <input v-if="conteudo.titulo && conteudo.texto" type="text" placeholder="Url da imagem" v-model="conteudo.imagem">
    </grid-vue>
    <p class="right-align">
      <button v-on:click="addConteudo()" v-if="conteudo.titulo && conteudo.texto" class="btn waves-effect waves-light" tamanho="2 offset-s10">Publicar</button>
    </p>
  </div>
  
</template>

<script>
import GridVue from '@/components/layouts/GridVue'

export default {
  name: 'PublicarConteudoVue',
  components: {
    GridVue
  },
  props: [],
  data () {
    return {
      conteudo: {
        titulo: '', texto: '', link: '', imagem: ''
      }
    }
  },
  methods: {
    addConteudo() {
      this.$http.post(this.$urlAPI + 'conteudo/adicionar', this.conteudo, {
        "headers": {
          "authorization": "Bearer " + this.$store.getters.getToken
        }
      })
      .then(response => {
        if (response.data.status) {
          console.log(response.data.conteudos)
          this.conteudo = {titulo: '', texto: '', link: '', imagem: ''}
          this.$store.commit('setConteudosLinhaTempo', response.data.conteudos.data)
        
        } else if (response.data.status == false && response.data.validacao == true) {
          let erros = ''
          for (let erro of Object.values(response.data)) {
            erros += erro + " "
          }
          alert(erros)
        }
      })
      .catch(error => {
        console.log(error)
        alert("Erro! Tente mais tarde!")
      })
    }
  }
}
</script>

<style scoped>

</style>