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
      
      <card-conteudo-vue v-for="item in listarConteudos"
        :key="item.id"
        :perfil="item.user.imagem" 
        :nome="item.user.name" 
        :data="item.data"
      >
        <card-detalhe-vue 
          :img="item.imagem" 
          :titulo="item.titulo" 
          :txt="item.texto"
          :link="item.link"
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
    let usuarioAux = this.$store.getters.getUsuario
    if (usuarioAux) {
      this.usuario = usuarioAux;
    }

    this.$http.get(this.$urlAPI + 'conteudo/listar', {
      "headers": {
        "authorization": "Bearer " + this.$store.getters.getToken
      }
    })
    .then(response => {
      console.log(response)
      if (response.data.status) {
        this.$store.commit('setConteudosLinhaTempo', response.data.conteudos.data)
      }
    })
    .catch(error => {
      console.log(error)
      alert("Erro! Tente novamente mais tarde!")
    })
  },
  computed: {
    listarConteudos() {
      return this.$store.getters.getConteudosLinhaTempo
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
