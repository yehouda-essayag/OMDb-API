<template>
  <div>
    <!-- Pagination -->
    <Pagination 
      :currentPage="currentPage" 
      :totalPages="totalPages" 
      @update:page="currentPage = $event"
    />
    
    <div class="movie-list">
      <div   
        v-for="movie in paginatedMovies" 
        :key="movie.id" 
        class="movie-card"
        @click="openMovie(movie)"
      >
        <img :src="movie.poster_url" class="movie-image"/>
        <div class="movie-info">
          <h3 class="movie-title">{{ movie.title }}</h3>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import Pagination from './Pagination.vue'

const movies = ref([])
const router = useRouter()

// pagination data 
const currentPage = ref(1);
const pageSize = 12;

// calculate N. of pages and what movies are on screan
const totalPages = computed(() => Math.ceil(movies.value.length / pageSize))
const paginatedMovies = computed(() => {
  const start = (currentPage.value - 1) * pageSize
  return movies.value.slice(start, start + pageSize)
})

// Fetch movies
const filterByGenre = async (genreId = null) => {
  try {
    const response = await fetch(`/movies/by-genres/${genreId || ''}`)
    movies.value = await response.json()
    currentPage.value = 1 // reset page when filtering
  } catch (err) {
    console.error('Failed to filter movies:', err)
  }
}

// Open movie detail
const openMovie = (movie) => {
  sessionStorage.setItem('movieBody', JSON.stringify(movie))
  router.push({ name: 'movie-detail' })
}

// Fetch on mount
onMounted(async () => {
  await filterByGenre()
})

// Expose filter function for parent
defineExpose({ filterByGenre })
</script>


<style scoped>
.movie-list {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 15px;
  margin-top: 5px;
}

.movie-card {
  cursor: pointer;
  width: 200px;
  text-align: center;
}

.movie-image {
  width: 100%;
  border-radius: 8px;
  height: 190px; 
  object-fit: cover;
}

.movie-title {
  margin-top: 5px;
}
</style>
