<template>
  <site-template>
    <span slot="menu-esquerdo">
      <div class="row valign-wrapper">
        <grid-vue tamanho="4">
          <router-link :to="'/pagina/' + usuario.id + '/' + $slug(usuario.name, {lower: true})">
            <img v-bind:src="usuario.imagem" v-bind:alt="usuario.name" class="circle responsive-img"> <!-- notice the "circle" class -->
          </router-link>
        </grid-vue>
        <grid-vue tamanho="8">
          <span class="black-text">
            <router-link :to="'/pagina/' + usuario.id + '/' + $slug(usuario.name, {lower: true})">
              <h4>{{usuario.name}}</h4>
            </router-link>
          </span>
        </grid-vue>
      </div>
    </span>

    <span class="amigos" slot="menu-esquerdo-amigos">
      <h3>Seguindo</h3>
      <router-link v-for="amigo in amigos" :key="amigo.id" :to="'/pagina/' + amigo.id + '/' + $slug(amigo.name, {lower: true})">
        <li>{{amigo.name}}</li>
      </router-link>
      <li v-if="!amigos.length">Nenhum Usuário</li>
      
      <h3>Seguidores</h3>
      <router-link v-for="seguidor in seguidores" :key="seguidor.id" :to="'/pagina/' + seguidor.id + '/' + $slug(seguidor.name, {lower: true})">
        <li>{{seguidor.name}}</li>
      </router-link>
      <li v-if="!seguidores.length">Nenhum Usuário</li>
    </span>

    <span slot="principal">
      <publicar-conteudo-vue/>
      
      <card-conteudo-vue v-for="item in listarConteudos"
        :id="item.id"
        :totalcurtidas="item.total_curtidas"
        :comentarios="item.comentarios"
        :curtiuConteudo="item.curtiu_conteudo"
        :usuarioid="item.user.id"
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

      <!-- <button v-if="urlProximaPagina" @click="carregaPaginacao()" class="btn blue">Mais...</button> -->

      <div class="" v-scroll="handleScroll">

      </div>

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
      usuario: {imagem: '', name: ''},
      urlProximaPagina: null,
      pararScroll: false,
      amigos: [],
      seguidores: []
    }
  },
  created() {
    let usuarioAux = this.$store.getters.getUsuario
    if (usuarioAux) {
      this.usuario = usuarioAux;
      this.$http.get(this.$urlAPI + 'conteudo/listar', {
        "headers": {
          "authorization": "Bearer " + this.$store.getters.getToken
        }
      })
      .then(response => {
        if (response.data.status) {
          this.$store.commit('setConteudosLinhaTempo', response.data.conteudos.data)
          this.urlProximaPagina = response.data.conteudos.next_page_url

          this.$http.get(this.$urlAPI + 'usuario/listaamigos', {
            "headers": {
              "authorization": "Bearer " + this.$store.getters.getToken
            }
          })
          .then(response => {
            if (response.data.status) {
              console.log(response.data)
              this.amigos = response.data.amigos
              this.seguidores = response.data.seguidores
            } else {
              alert(response.data.erro)
            }
          })
          .catch(error => {
            console.log(error)
          })
        }
      })
      .catch(error => {
        console.log(error)
        alert("Erro! Tente novamente mais tarde!")
      })
    }
  },
  methods: {
    handleScroll: function (evt, el) {
      // console.log(window.scrollY)
      // console.log(document.body.clientHeight);
      if (this.pararScroll) {
        return
      }
      if (window.scrollY >= document.body.clientHeight - 1080) {
        this.pararScroll = true
        this.carregaPaginacao()
      }
    },

    carregaPaginacao() {
      if (!this.urlProximaPagina) {
        return
      }
      this.$http.get(this.urlProximaPagina, {
        "headers": {
          "authorization": "Bearer " + this.$store.getters.getToken
        }
      })
      .then(response => {
        if (response.data.status && this.$route.name == 'Home') {
          this.$store.commit('setPaginacaoConteudosLinhaTempo', response.data.conteudos.data)
          this.urlProximaPagina = response.data.conteudos.next_page_url
          this.pararScroll = false
        }
      })
      .catch(error => {
        console.log(error)
        alert("Erro! Tente novamente mais tarde!")
      })
    }
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
.amigos {
  display: grid;
}
</style>
