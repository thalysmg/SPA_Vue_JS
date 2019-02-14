<template>
  <login-template>
    
    <span slot="menu-esquerdo">
      <img src="http://www.twccomunicacao.com.br/restrito/img/blog/29f464ef386c0c4c08f5e7fc5103d29e.png" class="responsive-img">
    </span>

    <span slot="principal">

        <h2>Login</h2>
        <input type="text" placeholder="E-mail" v-model="email">
        <input type="password" placeholder="Senha" v-model="password">
        <button class="btn" v-on:click="login()">Entrar</button>
        <router-link class="btn orange" to="/cadastro">Cadastre-se</router-link>

    </span>
  </login-template>

</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios' 

export default {
  name: 'Login',
  components: {
    LoginTemplate
  },
  data () {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    login() {
      axios.post('http://127.0.0.1:8000/api/login', {
        email: this.email,
        password: this.password
      })
      .then(response => {
        if (response.data.token) {
          console.log('Login realizado com sucesso')
          sessionStorage.setItem('usuario', JSON.stringify(response.data))
          this.$router.push('/')
        } else if (response.data.status == false) {
          console.log('Senha ou email incorreto!')
          alert('Login inválido')
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
