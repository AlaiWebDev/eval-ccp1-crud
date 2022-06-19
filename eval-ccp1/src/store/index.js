import { createStore } from 'vuex'

export default createStore({
  state: {
    users: [],
    columns: [],
    currentUser: {}
  },
  getters: {
  },
  mutations: {
    setUsers(state, nouvelle_valeur) {
      state.users = nouvelle_valeur;
    },
    setCurrentUser(state, nouvelle_valeur) {
      state.currentUser = nouvelle_valeur;
    },
    changeUser(state, idUser) {
      state.users[state.users.findIndex(user => user.id == idUser)] = state.currentUser;
    },
    addUser(state, newUser) {
      state.users.push(newUser);
    },
    deleteUser(state, idUser) {
      state.users.splice(state.users.findIndex(user => user.id === idUser), 1);
    },
    setColumns(state, nouvelle_valeur) {
      state.columns = nouvelle_valeur;
    }
  },
  actions: {
  },
  modules: {
  }
})
