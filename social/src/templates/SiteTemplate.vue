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
          <grid-vue tamanho="5">
            <card-menu-vue>
              <slot name="menu-esquerdo" />
            </card-menu-vue>
            <card-menu-vue>
              <h3>Amigos</h3>
              <li>João</li>
              <li>Neto</li>
              <li>Júnior</li>
            </card-menu-vue>
          </grid-vue>
          <grid-vue tamanho="7">
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
  name: 'SiteTemplate',
  data() {
    return {
      usuario: false
    }
  },
  components: {
    NavBar,
    FooterVue,
    GridVue,
    CardMenuVue,
    CardConteudoVue
  },
  created() {
    console.log("created()")
    let usuarioAux = sessionStorage.getItem('usuario')
    if (usuarioAux) {
      this.usuario = JSON.parse(usuarioAux);
    } else {
      this.$router.push('/login')
    }
  },
  methods: {
    sair() {
      sessionStorage.clear();
      this.usuario = false;
      this.$router.push('/login')
    }
  }
}
</script>

<style>

</style>
