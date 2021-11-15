<template>
 <div>
  <div class="navigation" v-if="user.userinfo">
   <avatar v-if="user.userinfo" class="ms-4" :username="user.userinfo.first_name + ' ' + user.userinfo.last_name" :rounded="true" :size="40" :color="'#fff'" :lighten="100"></avatar>
   <div class="d-flex flex-column">
    <p class="text-dark username lh-sm" v-if="user">{{ user.userinfo.first_name }} {{ user.userinfo.last_name }}!</p>
    <p class="text-muted username lh-sm" v-if="user">
     <small>{{ user.email }}</small>
    </p>
    <p class="text-muted username lh-sm" v-if="user">
     <small>S.Y. {{ user.userinfo.academic_year }}</small>
    </p>
   </div>
  </div>
 </div>
</template>
<script>
 import Avatar from 'vue-avatar';
 import { mapState, mapActions } from 'vuex';
 export default {
  components: {
   Avatar,
  },
  async mounted() {
   await this.checkUser();
  },
  computed: {
   ...mapState('auth', ['user']),
  },
  methods: {
   ...mapActions('auth', ['checkUser']),
  },
 };
</script>
