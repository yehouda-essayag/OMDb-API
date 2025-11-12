<template>
  <div v-if="genres.length > 0" class="dropdown-container">
    <!-- Dropdown button -->
    <button @click="toggleDropdown" class="dropdown-btn">
      Filter by Genres
      <span class="arrow" :class="{ open: showDropdown }">▼</span>
    </button>

    <!-- Dropdown menu -->
    <div 
      v-if="showDropdown" 
      class="dropdown-menu"
    >
      <button 
        @click="selectGenre(null)" 
        class="dropdown-item"
      >
        All Genres
      </button>

      <button 
        v-for="genre in genres" 
        :key="genre.id"
        @click="selectGenre(genre.id)"
        class="dropdown-item"
      >
        {{ genre.name }}
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, defineEmits } from 'vue'

const emit = defineEmits(['filter']);

// define dropdown open / close  
const showDropdown = ref(false);
// array of genre 
const genres = ref([]);

// toggle dropdown open / close
const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value;
};

// emit to parent (navbar) when select a genre
const selectGenre = (genreId) => {
  showDropdown.value = false;
  emit('filter', genreId); // null = All Genres
};

// fetch genres on mount
onMounted(async () => {
  try {
    const response = await fetch('/genre/index-names');
    const data = await response.json();
    genres.value = data.map(g => ({ id: g.id, name: g.name }));
  } catch (err) {
    console.error('Failed to fetch genres:', err)
  }
});
</script>

<style scoped>
.dropdown-container {
  position: relative;
  display: inline-block;
}

.dropdown-btn {
  background-color: #7e3ff2;
  color: white;
  border: none;
  padding: 10px 16px;
  border-radius: 6px;
  font-size: 15px;
  cursor: pointer;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: background-color 0.25s ease, transform 0.1s ease;
}

.dropdown-btn:hover {
  background-color: #692ed9;
  transform: translateY(-1px);
}

.arrow {
  font-size: 12px;
  transition: transform 0.25s ease;
}

.arrow.open {
  transform: rotate(180deg);
}

.dropdown-menu {
  position: absolute;
  top: 110%;
  left: 0;
  width: 180px;
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 6px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  z-index: 20;
  overflow: hidden;
  animation: fadeIn 0.15s ease;
}

.dropdown-item {
  width: 100%;
  text-align: left;
  padding: 10px 14px;
  background: none;
  border: none;
  font-size: 14px;
  color: #444;
  cursor: pointer;
  transition: background-color 0.2s ease, color 0.2s ease;
}

.dropdown-item:hover {
  background-color: #f5f0ff;
  color: #7e3ff2;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-4px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
