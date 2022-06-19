<template>
  <header>
    <img alt="Logo ID Formation" src="@/assets/img/logo-id-formation.png">
    <nav>
      <router-link to="/">Accueil</router-link>
      <router-link to="/users">Utilisateurs</router-link>
      <router-link to="/addUser">Ajouter</router-link>
    </nav>
  </header>
  <router-view/>
  <footer>
    <span>&copy; 2022 - Alain ORLUK</span><span>ID Formation Strasbourg</span>
  </footer>
</template>
<script>
import UserDataService from "./service/userDataService";
export default {
  name: 'app',
  data() {
    return {
      columns: []
    };
  },
  methods: {
    getUsers: function () {
      UserDataService.retrieveAllUsers().then((res) => {
        this.usersList = res.data;
        this.$store.commit("setUsers", this.usersList);
        Object.keys(this.usersList[0]).forEach(column => {
            this.columns.push(column);
        })
        this.$store.commit("setColumns", this.columns);
      });
    }
  },
  created() {
    this.getUsers();
  },
}
</script>
<style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-size: 16px;
  font-style: normal;
}

  body {
      margin-top: 26vh;
      background-color: #f4f4f4;
  }

  body::-webkit-scrollbar {
    display: none;
  }

  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    text-align: center;
    color: #2c3e50;
    user-select: none;
  }
  ul {
    display: none;
  }

  h1 {
    width: 40vw;
    margin: 1rem auto;
    margin-bottom: 2rem;
    padding: 1rem;
    color: #c5d0c6;
    background-color: #154a44;
    border-radius: 10px;
    box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
  }

  header {
    display: flex;
    position: fixed;
    top: 0;
    width: 100vw;
    justify-content: space-between;
    background-color: #5c8c9c;
  }

  header img {
    width: 6%;
    margin: .5%;
    border-radius: 10px;
    box-shadow : 4px 3px 0.1em 0.1em #154a44;
  }

  nav {
    display: flex;
    justify-content: center;
  }

  nav a {
    font-weight: bold;
    color: #c5d0c6;
    text-decoration: none;
    padding: 1vw;
    margin: auto 1vw;
    border-radius: 10px;
    box-shadow: #c5d0c6 1.95px 1.95px 2.6px;
    background-color: #154a44;
  }

  nav a:hover {
    color: white;
    background-color: #4e7b7f;
    box-shadow: black 1.95px 1.95px 2.6px;
  }

  nav a.router-link-exact-active {
    color: #fbc522;
  }

  footer {
    /* border: 1px solid red; */
    display: flex;
    flex-direction: column;
    justify-content: center;
    /* position: sticky; */
    /* top: 90vh; */
    /* height: 8rem; */
    font-weight: bolder;
    /* font-size: .8rem; */
    background-color: #5c8c9c;
  }
  footer span:nth-of-type(2) {
    font-size: 1rem;
    padding-bottom: 8px;
  }
  footer span:first-of-type {
    padding-bottom: 7px;
    padding-top: .6rem;
  }
  @media (max-width: 1000px) {
    footer span {
      font-size: 1rem;
      margin: auto;
    }
    header img {
    width: 8%;
    margin: 1%;
    border-radius: 50%;
    box-shadow:none;
  }
  }
</style>
