<template>
  <div class="pagination">
    <button 
      :disabled="currentPage === 1" 
      @click="$emit('update:page', currentPage - 1)"
    >
      Prev
    </button>

    <button 
      v-for="page in pages" 
      :key="page" 
      :class="{ active: page === currentPage }" 
      @click="$emit('update:page', page)"
    >
      {{ page }}
    </button>

    <button 
      :disabled="currentPage === totalPages" 
      @click="$emit('update:page', currentPage + 1)"
    >
      Next
    </button>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  currentPage: Number,
  totalPages: Number
});

const pages = computed(() => {
  const arr = [];
  for (let i = 1; i <= props.totalPages; i++) {
    arr.push(i);
  }
  return arr;
})
</script>

<style scoped>
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  margin-top: 20px;
}

button {
  padding: 6px 12px;
  border: 1px solid #ccc;
  background-color: white;
  cursor: pointer;
  border-radius: 4px;
}

button.active {
  background-color: #7f5af0;
  color: white;
  border-color: #7f5af0;
}

button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>
