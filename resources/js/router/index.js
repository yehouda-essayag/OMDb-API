import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../views/HomePage.vue'
import MoviesDetails from '../views/MoviesDetails.vue'
import MovieSearch from '../views/MovieSearchPage.vue'

const routes = [
  { path: '/', name: 'home-page', component: HomePage },
  { path: '/movie/:id?', name: 'movie-detail', component: MoviesDetails },
  { path: '/movie/search', name: 'movie-search', component: MovieSearch }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
