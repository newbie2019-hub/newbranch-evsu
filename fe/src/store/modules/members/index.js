import API from '../../base/'
import Vue from 'vue'
export default {
  namespaced: true,
  state: {
    allmembers: [],
    members: [],
  },
  getters: {
    
  },
  mutations: {
    SET_ALL_MEMBERS(state, data) {
      state.allmembers = data
    },
    SET_MEMBERS(state, data) {
      state.members = data
    },
    UPDATE_MEMBER(state, data) {
      for(let i = 0; i < state.members.data.length; i++){
        if(state.members.data[i].id == data.id){
         Vue.set(state.members.data, i, data)
        }
       }
    }
  },
  actions: {
    async allMembers({commit}){
      const res = await API.get(`/user/members/all`).then(res => {
        commit('SET_ALL_MEMBERS', res.data)
        return res;
      }).catch(err => {
        return err.response
      })
  
      return res;
     },
    async getMembers({commit}, {page, sort}){
      const res = await API.get(`/user/members?page=${page}&sort=${sort}`).then(res => {
        commit('SET_MEMBERS', res.data)
        return res;
      }).catch(err => {
        return err.response
      })
  
      return res;
     },
     async saveMember({commit}, payload){
       const res = await API.post('/user/members', payload).then(res => {
         return res;
       }).catch(err => {
         return err.response
       })
  
       return res;
     },
     async updateMember({commit}, payload){
       const res = await API.put(`/user/members/${payload.id}`, payload).then(res => {
         commit('UPDATE_MEMBER', res.data[0]);
         return res;
       }).catch(err => {
         return err.response
       })
  
       return res;
     },
     async deleteMember({commit}, payload){
       const res = await API.delete(`/user/members/${payload.id}`).then(res => {
         return res;
       }).catch(err => {
         return err.response
       })
  
       return res;
     },
  
      /** END OF ACTION */
  },
}