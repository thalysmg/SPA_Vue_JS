<template>
  <div id="app">
    <nav v-bind:class="cor || 'green darken-1'">
      <div class="nav-wrapper container">
        <router-link class="brand-logo" :to="url || '/'">{{logo || 'Site'}}</router-link>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <slot />
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'NavBar',
  props: ['logo', 'url', 'cor'],
  data () {
    return {

    }
  }
}
</script>

<style scoped>

</style>
