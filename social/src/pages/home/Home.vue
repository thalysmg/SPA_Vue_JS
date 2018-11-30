<template>
  <card-conteudo-vue perfil="https://materializecss.com/images/yuna.jpg" 
		nome="Maria Joana" 
		data="29/12/18 22:00"
	>
		<div class="card-image">
			<img src="https://materializecss.com/images/sample-1.jpg">
				<span class="card-title">Card Title</span>
		</div>
		<div class="card-content">
			<p>I am a very simple card. I am good at containing small bits of information.
			I am convenient because I require little markup to use effectively.</p>
		</div>
	</card-conteudo-vue>
</template>

<script>
import CardConteudoVue from '@/components/social/CardConteudoVue';

export default {
    name: 'Home',
    components: {
      CardConteudoVue
    },
  	data () {
    	return {
      		msg: 'Welcome to Your Vue.js App'
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
