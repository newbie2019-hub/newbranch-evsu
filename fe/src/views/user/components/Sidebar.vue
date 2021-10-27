<template>
  <div class="sidenav">
   <p class="text-center mt-5 mb-4 text-white fw-bolder">MANAGEMENT</p>
   <router-link to="/user/home"><i class="bi bi-house"></i> Dashboard</router-link>
   <router-link to="/user/members"><i class="bi bi-people"></i>Members</router-link>
   <router-link to="/user/announcements"><i class="bi bi-megaphone"></i> Announcements</router-link>
   <router-link to="/user/payments"><i class="bi bi-cash-coin"></i>Payment Records</router-link>
   <router-link to="/user/chat"><i class="bi bi-chat-fill"></i>Chatbox</router-link>
   <a href="" v-on:click.prevent="setValues(); $bvModal.show('settingsModal')" ><i class="bi bi-tools"></i> Settings</a>
   <a href="" v-on:click.prevent="$bvModal.show('logoutModal')"><i class="bi bi-x-circle"></i> Log-out</a>

   <b-modal id="logoutModal" centered title="Logout">
    <p class="my-4">Are you sure you want to log-out?</p>
    <template #modal-footer = {cancel} >
      <b-button variant="primary" size="sm" @click="cancel()"> Cancel </b-button>
      <b-button size="sm" variant="danger" v-on:click.prevent="logout">
        Logout
      </b-button>
    </template>
   </b-modal>

  <b-modal id="settingsModal" centered title="Account Settings">
   <div class="row pe-4 ps-4 pt-2 pb-2">
    <div class="col">
     <label for="item">First Name</label>
     <input v-model="data.first_name" id="item" type="text" class="form-control" placeholder="" aria-label="First Name">
     
     <label for="remarks">Middle Name</label>
     <input v-model="data.middle_name" id="remarks" type="text" class="form-control" placeholder="" aria-label="Middle Name">

     <label for="remarks">Last Name</label>
     <input v-model="data.last_name" id="remarks" type="text" class="form-control" placeholder="" aria-label="Last Name">

     <label for="gender">Select Gender</label>
     <select id="gender" v-model="data.gender" class="form-select">
      <option value="" disabled selected>Select Gender</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
     </select>
     
     <label for="email">Email</label>
     <input v-model="data.email" id="email" type="text" class="form-control" placeholder="" aria-label="Email">
    </div>
   </div>
    <template #modal-footer = {cancel} >
      <b-button variant="primary" size="sm" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
      <b-button variant="success" size="sm" v-on:click.prevent="$bvModal.show('saveChangesModal')"  :disabled="isLoading">
        Update
      </b-button>
    </template>
   </b-modal>

   <b-modal id="saveChangesModal" centered title="Save Changes">
    <div class="p-3">
     <p class="">Please enter your password</p>
     <input v-model="data.confirm_password" type="password" class="form-control">
    </div>
    <template #modal-footer = {cancel} >
      <b-button variant="primary" @click="cancel()" :disabled="isLoading"> Cancel </b-button>
      <b-button variant="success" v-on:click.prevent="updateAccount" :disabled="isLoading">
        {{isLoading ? 'Saving Changes ...' : 'Save Changes'}}
      </b-button>
    </template>
   </b-modal>
  </div>
</template>
<script>
import moment from 'moment'
import { mapActions, mapState } from 'vuex';
export default {
  data(){
    return {
      data:{
        id: '',
        first_name: '',
        middle_name: '',
        last_name: '',
        gender: '',
        email: '',
        password: '',
        confirm_password: '',
      },
      isLoading: false,
    }
  },
  filters: {
     moment: function (date) {
      return moment(date).format('MMMM DD, YYYY');
    }
  },
  mounted(){
    this.setValues()
    console.clear()
  },
  methods: {
   ...mapActions('auth', ['logoutAuthUser']),
   async logout(){
     const res = await this.logoutAuthUser()
     if(res.status == 200){
       this.$router.push('/')
     }
   },
    setValues(){
     this.data.id = this.user.id
     this.data.first_name = this.user.userinfo.first_name
     this.data.middle_name = this.user.userinfo.middle_name
     this.data.last_name = this.user.userinfo.last_name
     this.data.gender = this.user.userinfo.gender
     this.data.contact_number = this.user.userinfo.contact_number
     this.data.email = this.user.email
   },
   async updateAccount(){
     this.isLoading = true
     const res = await this.$store.dispatch('auth/updateAccount', this.data)
     if(res.status == 200){
       this.$toast.success(res.data.msg)
       await this.$store.dispatch('auth/checkUser')
       this.$bvModal.hide('saveChangesModal')
       this.data.confirm_password = ''
     }
     else {
       this.data.confirm_password = ''
       this.$toast.error(res.data.msg)
     }
     this.isLoading = false
   }
  },
  computed: {
    ...mapState("auth", ["user"]),
   getRoute: function(){
      return this.$route.path
    }
  }
}
</script>