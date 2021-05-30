<template>
  <div>
    <div v-if="canLogin">
      <inertia-link
        v-if="$page.props.user"
        href="/dashboard"
      >
        Dashboard
      </inertia-link>

      <template v-else>
        <inertia-link
          :href="route('login')"
          class=""
        >
          Log in
        </inertia-link>

        <inertia-link
          v-if="canRegister"
          :href="route('register')"
          class="ml-4"
        >
          Register
        </inertia-link>
      </template>
      <h2>Welcome Diamond vue</h2>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },
};
</script>

<style scoped>
.ml-4 {
  margin-left: 16px;
}
</style>
