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
  name: 'app',
  components: {
    'Navigation': Navigation,
    'Footer': Footer
  }
}
</script>
