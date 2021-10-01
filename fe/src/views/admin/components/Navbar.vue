<template>
  <div>
    <div class="navigation" v-if="user.admininfo">
      <avatar
        v-if="user.admininfo"
        class="ms-4"
        :username="user.admininfo.first_name + ' ' + user.admininfo.last_name"
        :rounded="true"
        :size="40"
        :color="'#fff'"
        :lighten="100"
      ></avatar>
      <div class="d-flex flex-column">
        <p class="text-dark username lh-sm" v-if="user">
          Welcome, {{ user.admininfo.first_name }}
          {{ user.admininfo.last_name }}!
        </p>
        <p class="text-muted username lh-sm" v-if="user">
          <small>{{ user.email }}</small>
        </p>
      </div>
    </div>
  </div>
</template>
<script>
import Avatar from "vue-avatar";
import { mapState, mapActions } from "vuex";
export default {
  components: {
    Avatar,
  },
  async mounted() {
    await this.checkAdminUser();
  },
  computed: {
    ...mapState("auth", ["user"]),
  },
  methods: {
    ...mapActions("auth", ["checkAdminUser"]),
  },
};
</script>
