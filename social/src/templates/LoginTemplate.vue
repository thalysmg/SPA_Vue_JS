<template>
  <div id="app">
    <header>
      <nav-bar logo="Social" url="/" cor="red darken-1">
        <li v-if="!usuario"><router-link to="/login">Entrar</router-link></li>
        <li v-if="!usuario"><router-link to="/cadastro">Cadastre-se</router-link></li>
        <li v-if="usuario"><router-link to="/perfil">{{usuario.name}}</router-link></li>
        <li v-if="usuario"><a v-on:click="sair()">Sair</a></li>
      </nav-bar>
    </header>

    <main>
      <div class="container">
        <div class="row">
          <grid-vue tamanho="8">
            <card-menu-vue>    
              <slot name="menu-esquerdo" />
            </card-menu-vue>
          </grid-vue>
          
          <grid-vue tamanho="4">
            <slot name="principal" />
          </grid-vue>
        </div>
      </div>
    </main>

    <div>
      <footer-vue cor="red darken-1" logo="Social" descricao="Teste de descrição" ano="2018">
        <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 5</a></li>
      </footer-vue>
    </div>
    
  </div>
</template>

<script>
import NavBar from "@/components/layouts/NavBar"
import FooterVue from "@/components/layouts/FooterVue"
import GridVue from "@/components/layouts/GridVue"
import CardMenuVue from '@/components/layouts/CardMenuVue'
import CardConteudoVue from '@/components/social/CardConteudoVue'

export default {
  name: 'LoginTemplate',
  components: {
    NavBar,
    FooterVue,
    GridVue,
    CardMenuVue,
    CardConteudoVue
  },
  data() {
    return {
      usuario: false
    }
  },
  created() {
    console.log("created()")
    let usuarioAux = this.$store.getters.getUsuario
    if (usuarioAux) {
      this.usuario = this.$store.getters.getUsuario
      this.$router.push('/')
    }
  }
}
</script>

<style>

</style>
