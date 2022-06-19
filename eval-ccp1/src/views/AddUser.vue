<template>
  <div class="add-user-form">
    <h1>Ajout d'un utilisateur</h1>
    <form>
      <label v-for="(value, index) in userFields" :key="index">
        {{ value.toUpperCase() }}
        <input v-if="value !== 'id'" type="text" v-bind:id="value">
        <input v-else type="text" v-bind:id="value">
      </label>
      <button v-on:click.prevent="addUser">Valider</button>
    </form>
  </div>
</template>
<script>
import UserDataService from "../service/userDataService";
import sortObjectProperties from '@/mixins/sortObjectPropertiesMixin';
export default {
  name: 'addUser',
  mixins: [
    sortObjectProperties
    ],
  data() {
    return {
      userFields: this.$store.state.columns,
      datasFromInput: [],
      datasFromTextarea: [],
      userDatas: [],
      newUser: {},
      idAjoute: 0
    }
  },
  methods: {
    async addUser() {
      this.datasFromInput = document.querySelectorAll("input[type=text]");
      this.userDatas = this.sortObject(this.userDatas);
      let myArray = [];
      for (const elem of this.datasFromInput) {
        myArray.push(elem.id);
      }
      myArray = myArray.reduce((acc,curr)=> (acc[curr]='',acc),{});
      for (const elem of this.datasFromInput) {
        myArray[elem.id] = elem.value;
      }
      this.sortObject(this.userDatas);
      this.newUser = {...myArray};
      this.$store.commit('addUser',this.newUser);
      this.idAjoute = await UserDataService.createUser({
            usrname: this.newUser.usrname,
            username: this.newUser.username,
            email: this.newUser.email,
            phone: this.newUser.phone,
            website: this.newUser.website
      });
      console.log("id ajouté : ",this.idAjoute);
      this.$router.push("/users");
    },
  }
}
</script>
<style scoped>
  .add-user-form {
    width: 90%;
    margin: 5rem auto;
  }

  form {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  form label {
    font-weight: bolder;
    width: fit-content;
    margin: 1rem;
  }

  form label input[type=text]{
    display: block;
    width: fit-content;
    margin: auto;
    margin-top: .5rem;
    text-align: center;
    padding: .5rem;
    border-radius: 10px;
  }

  form label:first-of-type {
    display: none;
  }

  form textarea {
    display: block;
    height: 55px;
    width: 20rem;
    border: 2px solid black;
    border-radius: 10px;
    line-height: 1rem;
    margin: auto;
    margin-top: .5rem;
    padding-left: .5rem;
    resize: none;
  }

  #company {
    height: 55px;
  }

  button {
  display: block;
  cursor: pointer;
  width: 8rem;
  font-weight: bold;
  color: #c5d0c6;
  text-decoration: none;
  padding: 1rem;
  margin: auto 1rem;
  border-radius: 10px;
  box-shadow: #c5d0c6 1.95px 1.95px 2.6px;
  background-color: #154a44;
  }

  button:hover {
  color: white;
  background-color: #4e7b7f;
  box-shadow: black 1.95px 1.95px 2.6px;
}
</style>
