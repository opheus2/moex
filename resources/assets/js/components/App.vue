<template>
  <div>
    <Navigation></Navigation>
        <router-view/>
        <Footer></Footer>
  </div>
</template>

<script>
import Navigation from './Navbar'
import Footer from './footer'
export default {
  name: 'App',
  components: {
    'Navigation': Navigation,
    'Footer': Footer
  }
}
</script>
