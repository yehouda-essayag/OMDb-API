<template>
  <div>
    <navbar-actions />

    <div class="movie-card">
      <h1 v-if="movie.id" class="title">Edit Movie</h1>
      <h1 v-else class="title">Create Movie</h1>

      <form @submit.prevent="saveMovie" class="form">
        <div v-for="(field, key) in fields" :key="key" class="form-group">
          <label>{{ field.label }}</label>
          <input v-model="movie[key]" :type="field.type" />
        </div>

        <div class="form-group">
          <label>Poster Preview</label>
          <img :src="movie.poster_url" alt="Poster Preview" class="poster-preview" />
        </div>

        <div class="form-actions">
          <button type="submit">Save</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import NavbarActions from '../components/NavbarActions.vue'

const router = useRouter();

// a movie default object
const movie = ref({
  id: null,
  title: '',
  release_date: '',
  poster_url: '',
  director: '',
  runtime_minutes: 0,
  actors: ''
})

// fields to show on form 
const fields = {
  title: { label: 'Title', type: 'text' },
  release_date: { label: 'Release Date', type: 'date' },
  poster_url: { label: 'Poster URL', type: 'text' },
  director: { label: 'Director', type: 'text' },
  runtime_minutes: { label: 'Runtime (minutes)', type: 'number' },
  actors: { label: 'Actors (comma separated)', type: 'text' }
}

// check if there is a sessionStorage then get the movie and clean sessionStorage
onMounted(async () => {
  const saved = sessionStorage.getItem('movieBody');
  if (saved) {
    movie.value = JSON.parse(saved);
    sessionStorage.removeItem('movieBody');
  }
})

// save a movie 
const saveMovie = async () => {
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const method = movie.value.id ? 'PUT' : 'POST';
  const url = movie.value.id ? `/movies/${movie.value.id}` : '/movies';

  const res = await fetch(url, {
    method,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': token
    },
    body: JSON.stringify(movie.value)
  });

  if (!res.ok) return alert('Error saving movie');
  else router.push({ name: 'home-page' });
}

</script>



<style scoped>
.movie-card {
  max-width: 600px;
  margin: 20px auto;
  padding: 20px 30px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
  color: #333;
}

.form {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-weight: bold;
  margin-bottom: 8px;
  color: #555;
}

.form-group input {
  padding: 8px 10px;
  border: 1px solid #aaa;
  border-radius: 5px;
  font-size: 16px;
}

.poster-preview {
  margin-top: 8px;
  width: 200px;
  height: 180px;
  object-fit: cover;
  border: 1px solid #aaa;
  border-radius: 5px;
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
