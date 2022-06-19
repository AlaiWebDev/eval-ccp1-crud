<template>
  <div class="change-user-form">
    <h1>Modification de l'utilisateur <span>{{ currentUser }}</span></h1>
    <form>
      <label v-for="(value, property, index) in userDatas" :key="index">
        {{ property.toUpperCase() }}
        <input type="text" v-bind:value="value" :disabled="property === 'id'" v-bind:id="property">
      </label>
      <button v-on:click.prevent="majUser">Valider</button>
    </form>
  </div>
</template>
<script>
import sortObjectProperties from '@/mixins/sortObjectPropertiesMixin';
import UserDataService from "../service/userDataService";
export default {
  name: 'modifyUser',
  mixins: [
    sortObjectProperties
    ],
  data() {
    return {
      userDatas: [],
      disabled: false,
      datasFromInput: [],
    }
  },
  methods: {
    async majUser() {
      this.datasFromInput = document.querySelectorAll("input[type=text], textarea");
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
      this.userDatas = {...myArray};
      this.$store.commit("setCurrentUser", this.userDatas);
      this.$store.commit("changeUser", this.id);
      await UserDataService.updateUser({
            id: this.id,
            usrname: this.userDatas.usrname,
            username: this.userDatas.username,
            email: this.userDatas.email,
            phone: this.userDatas.phone,
            website: this.userDatas.website,
      });
      this.$router.push("/users");
    },
  },
    props: [
      "id",
      "currentUser"
    ],
  beforeMount() {
    this.userDatas = this.$store.state.users[(this.$store.state.users).findIndex(v => parseInt(v.id) === parseInt(this.id))];
    this.$store.commit("setCurrentUser", this.userDatas);
  }
}
</script>
<style scoped>
  .change-user-form {
    width: 50%;
    margin: 5rem auto;
  }

  h1 span {
    display: block;
    width: fit-content;
    margin: .2rem auto;
    border-radius: 10px;
    color: #154a44;
    background-color: #fbc522;
    padding: .5rem;
    text-transform: uppercase;
  }

  form {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  form label {
    margin: 1rem;
    width: fit-content;
    font-weight: bolder;
  }

  form input[type=text] {
    display: block;
    width: fit-content;
    margin: auto;
    margin-top: .5rem;
    text-align: center;
    padding: .5rem;
    border-radius: 10px;
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
    height: 70px;
  }

  button {
  font-weight: bold;
  color: #c5d0c6;
  text-decoration: none;
  padding: 1rem;
  margin: auto 1rem;
  border-radius: 10px;
  cursor: pointer;
  box-shadow: #c5d0c6 1.95px 1.95px 2.6px;
  background-color: #154a44;
  }

  button:hover {
  color: white;
  background-color: #4e7b7f;
  box-shadow: black 1.95px 1.95px 2.6px;
}
</style>
