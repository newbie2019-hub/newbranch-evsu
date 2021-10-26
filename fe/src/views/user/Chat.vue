<template>
 <div>
  <div class="container pt-5">
   <div class="row">
    <h5 class="text-primary">Chat</h5>
    <p class="text-muted">Send a message to your organization admin</p>
    <div class="col-12 col-sm-11 col-md-12 col-lg-11 col-xl-11 mt-4">
     <div class="card p-0 mt-4">
         <div class="user-chatbox-container">
            <div class="message-container p-3">
                <div class="bubble-one d-flex justify-content-start my-2">
                    <p class="text-light">aalsidjalksdjlasjdlkajasldkjaslkdjlaksjdlasjdlkasjdlkasjdlkasjdlasjdlaskjdsdasdasdasdasasdasdiugasiuygfasudyfgaudygfayusdcgasyutdfgcasuycgasuycgasuyd</p>
                </div>
                <div class="bubble-two d-flex justify-content-start my-2">
                    <p class="text-light">aalsidjalksdjlasjdlkajasldkjaslkdjlaksjdlasjdlkasjdlkasjdlkasjdlasjdlaskjdsdasdasdasdasasdasdiugasiuygfasudyfgaudygfayusdcgasyutdfgcasuycgasuycgasuyd</p>
                </div>
            </div>
             <div class="user-chatbox-message d-flex justify-content-center pb-3">
                 <input class="form-control ms-3 shadow-none" placeholder="Type your message here ..."/>
                 <button class="btn btn-primary ms-2 me-3 rounded-circle"><i class="bi bi-telegram fs-5"></i></button>
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
  return {}
 },
 async mounted() {
  await this.$store.dispatch('auth/checkUser')
  document.title = 'Chat Section'
 },
 computed: {
    ...mapState('auth', ['user']),
 },
 methods: {},
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