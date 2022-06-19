<template>
  <div class="users-list">
    <h1>Liste des utilisateurs</h1>
    <table>
      <caption></caption>
      <thead>
        <tr>
          <th v-for="(column, index) in columns" :key="index">
            {{ column.toUpperCase() }}
          </th>
          <th>ACTION</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, index) in usersList" :key="index" v-bind:id="user.id">
            <td v-for="(oneUser, key, index) in user" :key="index">{{ oneUser}}</td>
            <td>
              <input type="button" @click="afficherModal(user.id, user.username)" value="Supprimer">
              <router-link :to="{ name: 'modifyUser', params: { id: user.id, currentUser: user.username } }"> 
                <span>Modifier</span>
                <Teleport to="body">
                  <modal :show="showModal" :userId="activeUserId" :userName="activeUserName" @cancel="showModal = false" @confirm="supprimerLigne">
                  </modal>
                </Teleport>
              </router-link>
            </td>
        </tr>
      </tbody>
    </table>
    <ul v-for="(user, index) in usersList" :key="index" v-bind:id="user.id">
      <li v-for="(oneUser, key, index) in user" :key="index">
        <span class="user-prop">{{ key }}</span>
        <span class="user-value">{{ oneUser }}</span> 
      </li>
      <li>
        <input type="button" @click="afficherModal(user.id, user.username)" value="Supprimer">
          <router-link :to="{ name: 'modifyUser', params: { id: user.id, currentUser: user.username } }"> 
            <span>Modifier</span>
            <Teleport to="body">
              <modal :show="showModal" :userId="activeUserId" :userName="activeUserName" @cancel="showModal = false" @confirm="supprimerLigne">
              </modal>
            </Teleport>
          </router-link>
      </li>
    </ul>
  </div>
  
</template>
<script>
import UserDataService from "../service/userDataService";
import Modal from "../components/Modal";
export default {
  name: 'usersList',
  components: {
    Modal
  },
  data() {
    return {
      usersList: [],
      columns: [],
      showModal: false,
      activeUserId: 0,
      activeUserName: "",
    };
  },
  methods: {
    supprimerLigne: function (idUser) {
      UserDataService.deleteUser(parseInt(idUser));
      this.$store.commit("deleteUser", idUser);
      this.showModal = false;
      
    },
    afficherModal: function (idUser, usernameUser) {
      this.activeUserId = idUser;
      this.activeUserName = usernameUser;
      this.showModal = true;
    },
  },
  beforeCreate() {
      UserDataService.retrieveAllUsers().then((res) => {
        this.usersList = res.data;
        this.$store.commit("setUsers", this.usersList);
        this.usersList = this.$store.state.users;
        this.columns = Object.keys(this.usersList[0]);
      });
  }
}
</script>
<style>
@media (min-width: 1061px){
  ul {
    display: none;
  }

  table {
    display: table;
    width: 80vw;
    margin: 2rem auto;
    border-collapse: collapse;
    box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
  }

  table {
    border: 3px solid #000;
  }

  th, td {
    border: 1px solid #000;
    padding: .5vw .5vw;
  }

  th {
    border-bottom: 3px solid #000;
    background-color: #4e7b7f;
    color: white;
  }

  td a {
    display: block;
    width: 8vw;
    margin:auto;
    border-radius: 10px;
    color: #c5d0c6;
    text-decoration: none;
    padding: .3rem;
    font-weight: bold;
    background-color: #154a44;
    box-shadow: #c5d0c6 1.95px 1.95px 2.6px;
    cursor: pointer;
  }

  td input {
    width: 8vw;
    display: block;
    margin: .5rem auto;
    padding: .3rem;
    border: none;
    border-radius: 10px;
    color: #c5d0c6;
    font-weight: bold;
    box-shadow: #c5d0c6 1.95px 1.95px 2.6px;
    background-color: inherit;
    cursor: pointer;
  }

  td input:hover {
    background-color: red;
    color: white;
  }
  
  td a:hover {
    background-color: green;
    color: white;
  }

  tbody tr:nth-child(odd){
  background-color: #5c8c8c;
  color: #c5d0c6;
  }
}
@media (max-width: 1060px) {
  table {
  display: none;
  }
  ul {
    display: block;
    list-style-type: none;
  border:1px solid black;
  margin: 1rem;
  }

  ul li:first-of-type {
    display: none;
  }
  
  .user-prop {
    display: block;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: .3rem;
  }
  li a {
    display: block;
    margin: .5rem auto;
    width: 8rem;
    border-radius: 10px;
    color: #c5d0c6;
    text-decoration: none;
    padding: .3rem;
    font-weight: bold;
    background-color: #154a44;
    box-shadow: #c5d0c6 1.95px 1.95px 2.6px;
    cursor: pointer;
  }

  li input {
    width: 8rem;
    display: block;
    margin: .5rem auto;
    padding: .3rem;
    border: none;
    border-radius: 10px;
    color: #c5d0c6;
    font-size: inherit;
    font-weight: bold;
    box-shadow: #c5d0c6 1.95px 1.95px 2.6px;
    background-color: inherit;
    cursor: pointer;
  }

  li input:hover {
    background-color: red;
    color: white;
  }
  
  li a:hover {
    background-color: green;
    color: white;
  }
}
</style>
