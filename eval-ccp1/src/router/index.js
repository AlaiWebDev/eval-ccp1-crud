import { createRouter, createWebHistory } from 'vue-router'
import UsersList from '@/views/UsersList.vue'
import AccueilView from '@/views/AccueilView.vue'
import AddUser from '@/views/AddUser.vue'
import ModifyUser from '@/views/ModifyUser.vue'

const routes = [
  {
    path: '/',
    name: 'accueil',
    component: AccueilView
  },
  {
    path: '/users',
    name: 'usersList',
    component: UsersList
  },
  {
    path: '/addUser',
    name: 'addUser',
    component: AddUser
  },
  {
    path: '/user/:id',
    props: true,
    name: 'modifyUser',
    component: ModifyUser
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
