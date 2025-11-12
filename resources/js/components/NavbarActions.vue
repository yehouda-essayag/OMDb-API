<template>
  <nav class="navbar">
    <div class="navbar-content">
      <!-- Left navigation buttons -->
      <div class="nav-buttons">
        <button @click="home" class="nav-btn">Home</button>
        <button @click="importOmbd" class="nav-btn">Import Movie</button>
        <button @click="createMovie" class="nav-btn">Create a Movie</button>
      </div>

      <!-- Right side: filter button (only if showFilter = true) -->
      <div v-if="showFilter" class="filter-section">
        <!-- Genre Filter Modal -->
        <genre-filter-modal
          v-if="showFilter"
          :show="showGenreModal"
          @close="showGenreModal = false"
          @filter="filterByGenre"
        />
      </div>
    </div>


  </nav>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import GenreFilterModal from './GenreFilterModal.vue'


const props = defineProps({
  showFilter: { type: Boolean, default: false }, // define if show genre modal filter or not
});

const emit = defineEmits(['filter']);
const router = useRouter();

// define if show genre dropdown is open or not
const showGenreModal = ref(false);

// emit filter by genre to parent
const filterByGenre = (genre) => {
  showGenreModal.value = false;
  emit('filter', genre);
};

// go to home page
const home = () => {
  if(props.showFilter) {
    filterByGenre(null);
  }
  else {
    router.push({ name: 'home-page' });
  }
  
}

// go to import page
const importOmbd = () => router.push({ name: 'movie-search' });

// go to add new movie page
const createMovie = () => router.push({ name: 'movie-detail' });
</script>

<style scoped>
/* Navbar container */
.navbar {
  position: sticky;
  top: 0;
  z-index: 50;
  background-color: #ffffff;
  border-bottom: 1px solid #ddd;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

/* Inner flex container */
.navbar-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 24px;
}

/* Button groups */
.nav-buttons {
  display: flex;
  gap: 12px;
}

/* Navigation buttons */
.nav-btn {
  padding: 8px 14px;
  border: none;
  background: none;
  color: #444;
  font-size: 15px;
  font-weight: 500;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.nav-btn:hover {
  background-color: #f2f2f2;
  color: #111;
}

/* Filter section (right side) */
.filter-section {
  display: flex;
  align-items: center;
}

/* Purple filter button */
.filter-btn {
  background-color: #7e3ff2;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  font-weight: 500;
  transition: background-color 0.25s ease;
}

.filter-btn:hover {
  background-color: #692ed9;
}

/* Optional: make navbar slightly blur when scrolling */
.navbar {
  backdrop-filter: blur(8px);
}
</style>
