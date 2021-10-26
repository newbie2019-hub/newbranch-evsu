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
                <div class="bubble-one d-flex justify-content-start">
                    <p class="text-wrap">asdasdasdasdasasdasdiugasiuygfasudyfgaudygfayusdcgasyutdfgcasuycgasuycgasuyd</p>
                </div>
                <div class="bubble-two d-flex justify-content-end">

                </div>
            </div>
             <div class="user-chatbox-message d-flex justify-content-center pb-3">
                 <input class="form-control ms-3 shadow-none" />
                 <button class="btn btn-primary ms-2 me-3">Send</button>
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
.bubble-one{
    position: relative;
    height: max-content;
    width: 100% !important;
    max-width: 500px;
    padding: 10px 15px;
    background-color: aqua;
    min-height: 2rem;
    border-radius: 10px;
    word-wrap: break-word !important;
}
</style>