<template>
  <div class="row">
    <div class="card">
      <div class="card-content">
        <div class="row valign-wrapper">
          <grid-vue tamanho="1">
            <router-link :to="'/pagina/' + usuarioid + '/' + $slug(nome, {lower: true})">
              <img v-bind:src="perfil" :alt="nome" class="circle responsive-img"> <!-- notice the "circle" class -->
            </router-link>
          </grid-vue>
          <grid-vue tamanho="11">
            <span class="black-text">
              <router-link :to="'/pagina/' + usuarioid + '/' + $slug(nome, {lower: true})">
                <strong>{{nome}}</strong>  
              </router-link>
               - <small>{{data}}</small>
            </span>
          </grid-vue>
        </div>
        <slot></slot>
      </div>
      <div class="card-action">
          <p>
            <a style="cursor: pointer" @click="curtir(id)"><i class="material-icons">{{curtiu}}</i>{{totalCurtidas}}</a>
            <a style="cursor: pointer" @click="abrirComentarios()"><i class="material-icons">insert_comment</i>{{listaComentarios.length}}</a>
          </p>
          <p v-if="exibirComentarios" class="right-align">
            <input type="text" v-model="textoComentario" placeholder="Comentar">
            <button v-if="textoComentario" @click="comentar(id)" style="width: 20%" class="btn waves-effect waves-light orange"><i class="material-icons">send</i></button>
          </p>
          <p v-if="exibirComentarios">
            <ul class="collection">
              <li class="collection-item avatar" v-for="comentario in comentarios" :key="comentario.id">
                <img :src="comentario.user.imagem" alt="" class="circle">
                <span class="title">{{comentario.user.name}}<small> - {{comentario.data}}</small></span>
                <p>
                  {{comentario.texto}}
                </p>
              </li>
            </ul>
          </p>
      </div>
    </div>
  </div>
</template>

<script>
import GridVue from '@/components/layouts/GridVue';

export default {
  name: 'CardConteudoVue',
  components: {
    GridVue
  },
  props: ['perfil', 'nome', 'data', 'id', 'totalcurtidas', 'curtiuConteudo', 'comentarios', 'usuarioid'],
  data () {
    return {
      curtiu: this.curtiuConteudo ? 'favorite' : 'favorite_border',
      totalCurtidas: this.totalcurtidas,
      exibirComentarios: false,
      textoComentario: '',
      listaComentarios: this.comentarios || []
    }
  },
  methods: {
    curtir(id) {
      this.$http.put(this.$urlAPI + 'conteudo/curtir/' + id, {}, {
        "headers": {
          "authorization": "Bearer " + this.$store.getters.getToken
        }
      })
      .then(response => {
        if(response.data.status) {
          this.totalCurtidas = response.data.curtidas
          this.$store.commit('setConteudosLinhaTempo', response.data.lista.conteudos.data)
          if (this.curtiu == 'favorite_border') {
            this.curtiu = 'favorite'
          } else {
            this.curtiu = 'favorite_border'
          }
        } else {
          alert(response.data.erro)
        }
      })
      .catch(error => {
        console.log(error)
      })
    },
    abrirComentarios() {
      this.exibirComentarios = !this.exibirComentarios
    },
    comentar(id) {
      if (!this.textoComentario) {
        return
      }
      this.$http.put(this.$urlAPI + 'conteudo/comentar/' + id, {texto:this.textoComentario}, {
        "headers": {
          "authorization": "Bearer " + this.$store.getters.getToken
        }
      })
      .then(response => {
        if(response.status) {
          this.$store.commit('setConteudosLinhaTempo', response.data.lista.conteudos.data)
          this.textoComentario = ''
        } else {
          alert(response.data.erro)
        }
      })
      .catch(error => {
        console.log(error)
      })
    }
  }
}
</script>

<style scoped>

</style>
