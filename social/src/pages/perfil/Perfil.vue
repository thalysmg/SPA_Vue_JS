<template>
  <site-template>
    
    <span slot="menu-esquerdo">
      <img src="http://www.twccomunicacao.com.br/restrito/img/blog/29f464ef386c0c4c08f5e7fc5103d29e.png" class="responsive-img">
    </span>

    <span slot="principal">

        <h2>Perfil</h2>
        <input type="text" placeholder="Nome" v-model="name">
        <input type="text" placeholder="E-mail" v-model="email">

        <div class="file-field input-field">
          <div class="btn">
            <span>Imagem</span>
            <input type="file">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>

        <input type="password" placeholder="Senha" v-model="password">
        <input type="password" placeholder="Confirme sua senha" v-model="password_confirmation">
        <button class="btn" v-on:click="perfil()">Atualizar</button>
        <router-link class="btn orange" to="/login">Já tenho conta</router-link>

    </span>
  </site-template>

</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import axios from 'axios'

export default {
  name: 'Perfil',
  data () {
    return {
      usuario: false,
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }
  },
  created() {
    console.log("created()")
    let usuarioAux = sessionStorage.getItem('usuario')
    if (usuarioAux) {
      this.usuario = JSON.parse(usuarioAux);
      this.name = this.usuario.name;
      this.email = this.usuario.email;
      this.password = this.usuario.password;
    }
  },
  components: {
    SiteTemplate
  },
  methods: {
    perfil() {
      axios.post('http://127.0.0.1:8000/api/perfil', {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
      })
      .then(response => {
        if (response.data.token) {
          console.log('Cadastro realizado com sucesso')
          sessionStorage.setItem('usuario', JSON.stringify(response.data))
          this.$router.push('/')
        
        } else if (response.data.status == false) {
          alert('Erro ao cadastrar! Tente novamente.')
        
        } else {
          console.log('erros de validação')
          let erros = '';
          for (let erro of Object.values(response.data)) {
            erros += erro + " ";
          }
          alert(erros);
        }
        console.log(response)
      })
      .catch(error => {
        console.log(error);
        alert("Servidor temporariamente indisponível. Tente novamente mais tarde!")
      });
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
