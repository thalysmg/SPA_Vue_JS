<template>
  <site-template>
    <span slot="menu-esquerdo">
      <div class="row valign-wrapper">
        <grid-vue tamanho="4">
          <img v-bind:src="usuario.imagem" v-bind:alt="usuario.name" class="circle responsive-img"> <!-- notice the "circle" class -->
        </grid-vue>
        <grid-vue tamanho="8">
          <span class="black-text">
            <h4>{{usuario.name}}</h4>
          </span>
        </grid-vue>
      </div>
    </span>

    <span slot="principal">
      <publicar-conteudo-vue/>
      
      <card-conteudo-vue 
      :perfil="usuario.imagem" 
      :nome="usuario.name" 
      data="29/12/18 22:00"
      >
      <card-detalhe-vue 
        img="http://materializecss.com/images/sample-1.jpg" 
        titulo="" 
        txt="I am a very simple card. I am good at containing small bits of information.
            I am convenient because I require little markup to use effectively."
      />
      </card-conteudo-vue>
    </span>
  </site-template>

</template>

<script>
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardDetalheVue from '@/components/social/CardDetalheVue'
import GridVue from "@/components/layouts/GridVue"
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'
import SiteTemplate from '@/templates/SiteTemplate'

export default {
    name: 'Home',
    components: {
      CardConteudoVue,
      CardDetalheVue,
      GridVue,
      PublicarConteudoVue,
      SiteTemplate
    },
  	data () {
    	return {
        usuario: false
      }
    },
    created() {
      let usuarioAux = sessionStorage.getItem('usuario')
      if (usuarioAux) {
        this.usuario = JSON.parse(usuarioAux);
      }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  	font-weight: normal;
}
ul {
  	list-style-type: none;
  	padding: 0;
}
li {
  	display: inline-block;
  	margin: 0 10px;
}
a {
  	color: #42b983;
}
</style>
