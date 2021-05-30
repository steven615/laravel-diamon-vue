<template>
  <div v-if="hasErrors">
    <div class="error-title">Whoops! Something went wrong.</div>

    <ul class="error-content">
      <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  computed: {
    errors() {
      return this.$page.props.errors;
    },

    hasErrors() {
      return Object.keys(this.errors).length > 0;
    },
  },
};
</script>

<style scoped>
.error-title {
  color: #dc2626;
  font-weight: 500;
}

.error-content {
  font-size: 0.875rem;
  line-height: 1.25rem;
  color: #dc2626;
  text-align: left;
  margin-top: 12px;
  list-style-type: disc;
  list-style-position: inside;
}
</style>
