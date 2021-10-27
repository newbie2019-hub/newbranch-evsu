<template>
 <div>
  <div class="container pt-5">
   <div class="row">
    <h5 class="text-primary">Chat</h5>
    <p class="text-muted">Send a message to your organization admin</p>
    <div class="col-12 col-sm-12 col-md-3 col-lg-4 col-xl-4 d-block mt-4">
    <small>Select admin</small>
    <select class="form-select" v-model="data.receiver_id">
        <option v-for="(stud, i) in admins" :key="i" :value="stud.id">{{stud.userinfo.first_name}} {{stud.userinfo.last_name}}</option>
    </select>
    </div>
    <div class="col-12 col-sm-11 col-md-12 col-lg-11 col-xl-11">
     <div class="card p-0 mt-4">
         <div class="user-chatbox-container">
            <div class="message-container p-3">
                <div class="bubble-one d-flex justify-content-start my-2">
                    <p class="text-light">aalsidjalksdjlasjdlkajasldkjaslkdjlaksjdlasjdlkasjdlkasjdlkasjdlasjdlaskjdsdasdasdasdasasdasdiugasiuygfasudyfgaudygfayusdcgasyutdfgcasuycgasuycgasuyd</p>
                </div>
                <div class="bubble-two d-flex justify-content-start my-2">
                    <p class="text-light">aalsidjalksdjlasjdlkajasldkjaslkdjlaksjdlasjdlkasjdlkasjdlkasjdlasjdlaskjdsdasdasdasdasasdasdiugasiuygfasudyfgaudygfayusdcgasyutdfgcasuycgasuycgasuydaalsidjalksdjlasjdlkajasldkjaslkdjlaksjdlasjdlkasjdlkasjdlkasjdlasjdlaskjdsdasdasdasdasasdasdiugasiuygfasudyfgaudygfayusdcgasyutdfgcasuycgasuycgasuydaalsidjalksdjlasjdlkajasldkjaslkdjlaksjdlasjdlkasjdlkasjdlkasjdlasjdlaskjdsdasdasdasdasasdasdiugasiuygfasudyfgaudygfayusdcgasyutdfgcasuycgasuycgasuydaalsidjalksdjlasjdlkajasldkjaslkdjlaksjdlasjdlkasjdlkasjdlkasjdlasjdlaskjdsdasdasdasdasasdasdiugasiuygfasudyfgaudygfayusdcgasyutdfgcasuycgasuycgasuydaalsidjalksdjlasjdlkajasldkjaslkdjlaksjdlasjdlkasjdlkasjdlkasjdlasjdlaskjdsdasdasdasdasasdasdiugasiuygfasudyfgaudygfayusdcgasyutdfgcasuycgasuycgasuydaalsidjalksdjlasjdlkajasldkjaslkdjlaksjdlasjdlkasjdlkasjdlkasjdlasjdlaskjdsdasdasdasdasasdasdiugasiuygfasudyfgaudygfayusdcgasyutdfgcasuycgasuycgasuyd</p>
                </div>
            </div>
             <div class="user-chatbox-message d-flex justify-content-center pb-3">
                 <input v-model="data.message" class="form-control ms-3 shadow-none" placeholder="Type your message here ..."/>
                 <button class="btn btn-primary ms-2 me-3 shadow-none rounded-circle" @click="sendMessage"><i class="bi bi-telegram fs-5"></i></button>
             </div>
         </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</template>
<script>
import { mapState } from 'vuex'
export default {
 data(){
  return {
      isLoading: false,
      data: {
          receiver_id: '',
          message: ''
      }
  }
 },
 async mounted() {
  await this.$store.dispatch('auth/checkUser')
  await this.$store.dispatch('members/allAdmins')
  document.title = 'Chat Section'
 },
 computed: {
    ...mapState('auth', ['user']),
    ...mapState('members', ['admins']),
 },
 methods: {
     async sendMessage(){
      if(this.data.receiver_id == '') return this.$toast.error('Recepient required')
      if(this.data.message == '') return this.$toast.error('Message is blank')

      this.isLoading = true
      const { data, status } = await this.$store.dispatch('members/sendMessage', this.data)
      this.checkStatus(data, status, '', 'members/allAdmins')
    },
 },
 watch: {}
}
</script>
<style>
.user-chatbox-container {
    min-height: 400px !important;
    max-height: 400px !important;
    background-color: #f1f3f4;
    position: relative;
}
.user-chatbox-message{
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
}
.message-container {
    position: relative;
    overflow-y: scroll;
    height: 320px;
}
.bubble-one{
    height: max-content;
    width: 100% !important;
    max-width: 500px;
    padding: 10px 15px;
    background-color: rgb(112, 197, 197);
    min-height: 2rem;
    border-radius: 10px;
    word-break: break-word !important;
}
.bubble-two{
    position: absolute;
    right: 0;
    margin-right: 15px;
    height: max-content;
    width: 100% !important;
    max-width: 500px;
    padding: 10px 15px;
    background-color: rgb(80, 231, 156);
    min-height: 2rem;
    border-radius: 10px;
    word-break: break-word !important;
}
</style>