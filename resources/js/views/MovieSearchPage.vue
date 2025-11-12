<template>
  <div>
    <navbar-actions />

    <div class="movie-search-container max-w-3xl mx-auto mt-10 flex flex-col gap-8">
      
      <!-- Title Search Card -->
      <div class="movie-card">
        <h1 class="title">Search by Title</h1>
        <div class="form">
          <div class="form-group">
            <label>Movie Title</label>
            <input v-model="title" type="text" placeholder="Enter movie title (e.g., Spartacus)" />
          </div>
          <div class="form-actions">
            <button @click="searchByTitle">Search</button>
          </div>
        </div>
      </div>

      <!-- IMDB ID Search Card -->
      <div class="movie-card">
        <h1 class="title">Search by IMDB ID</h1>
        <div class="form">
          <div class="form-group">
            <label>IMDB ID</label>
            <input v-model="imdbId" type="text" placeholder="Enter IMDB ID (e.g., tt1234567)" />
          </div>
          <div class="form-actions">
            <button @click="searchById">Search</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import NavbarActions from '../components/NavbarActions.vue'

const title = ref('');
const imdbId = ref('');
const router = useRouter();

// transform data to be a movie and navigate to movie-detail page with data
function goToDetailPage(data) {

  const movieData = {
    title: data.Title || '',
    release_date: data.Released ? new Date(data.Released).toISOString().substr(0,10) : '',
    poster_url: data.Poster && data.Poster !== 'N/A' ? data.Poster : '',
    director: data.Director || '',
    runtime_minutes: data.Runtime ? parseInt(data.Runtime) : 0,
    actors: data.Actors || ''
  }

  sessionStorage.setItem('movieBody', JSON.stringify(movieData))
  router.push({ name: 'movie-detail' })
}

// search by title 
async function searchByTitle() {
  if (!title.value) return alert('Please enter a movie title');
  try {
    const res = await fetch(`/omdb/title?title=${encodeURIComponent(title.value)}`);
    const data = await res.json();
    if (data.Response === 'False') return alert(data.Error || 'Movie not found');

    goToDetailPage(data);
  } catch {
    alert('Failed to fetch movie');
  }
}

// search by id
async function searchById() {
  if (!imdbId.value) return alert('Please enter an IMDB ID');
  try {
    const res = await fetch(`/omdb/id?id=${encodeURIComponent(imdbId.value)}`);
    const data = await res.json();
    if (data.Response === 'False') return alert(data.Error || 'Movie not found');

    goToDetailPage(data);
  } catch {
    alert('Failed to fetch movie');
  }
}
</script>

<style scoped>

.movie-card {
  max-width: 600px;
  margin: 40px auto;  
  padding: 20px 30px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.title {
  text-align: center;
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 25px;
  color: #333;}

.form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-weight: bold;
  margin-bottom: 5px;
  color: #555;
}

.form-group input {
  padding: 8px 10px;
  border: 1px solid #aaa;
  border-radius: 5px;
  font-size: 16px;
}

.form-actions {
  text-align: center;
  margin-top: 10px;
}

.form-actions button {
  background-color: #6b46c1;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-weight: bold;
  cursor: pointer;
}

.form-actions button:hover {
  background-color: #553c9a;
}
</style>
