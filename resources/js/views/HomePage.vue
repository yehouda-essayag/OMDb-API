<template>
  <div>
    <!-- Navbar with genre filter modal -->
    <navbar-actions 
      :showFilter="true"
      @filter="handleGenre"
    />

    <!-- Movie list -->
    <movie-list ref="movieList"/>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import MovieList from '../components/MovieList.vue'
import NavbarActions from '../components/NavbarActions.vue'

// for movie-list to get filter from navbar
const movieList = ref(null);

// called when a genre is selected in the navbar
const handleGenre = (genreId) => {
  movieList.value.filterByGenre(genreId);
};
</script>