<template>
  <div class="row">
    <grid-vue class="input-field" tamanho="12">
      <label for="conteudoID">O que está acontecendo?</label>
      <input type="text" v-model="conteudo.titulo">
      <textarea v-if="conteudo.titulo" placeholder="Conteúdo:" v-model="conteudo.texto" id="conteudoID" class="materialize-textarea"></textarea>
      <input v-if="conteudo.titulo && conteudo.texto" type="text" placeholder="Link" v-model="conteudo.link">
      <input v-if="conteudo.titulo && conteudo.texto" type="text" placeholder="Url da imagem" v-model="conteudo.imagem">
    </grid-vue>
    <span>
      <grid-vue v-if="conteudo.titulo && conteudo.texto" class="btn waves-effect waves-light" tamanho="2 offset-s10">Publicar</grid-vue>
    </span>
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
        titulo: '',
        texto: '',
        link: '',
        imagem: ''
      }
    }
  }
}
</script>

<style scoped>

</style>