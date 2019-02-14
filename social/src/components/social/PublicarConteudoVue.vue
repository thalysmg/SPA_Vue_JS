<template>
  <div class="row">
    <grid-vue class="input-field" tamanho="12">
      <textarea v-model="conteudo" id="conteudoID" class="materialize-textarea"></textarea>
        <label for="conteudoID">Digite aqui seu texto:</label>
    </grid-vue>
    <span>
      <grid-vue v-if="conteudo" class="btn waves-effect waves-light" tamanho="2 offset-s10">Publicar</grid-vue>
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
      conteudo: ''
    }
  }
}
</script>

<style scoped>

</style>