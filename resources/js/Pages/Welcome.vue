<template>
  <div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
  >
    <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
      <inertia-link
        v-if="$page.props.user"
        href="/dashboard"
        class="text-sm text-gray-700 underline"
      >
        Dashboard
      </inertia-link>

      <template v-else>
        <inertia-link
          :href="route('login')"
          class="text-sm text-gray-700 underline"
        >
          Log in
        </inertia-link>

        <inertia-link
          v-if="canRegister"
          :href="route('register')"
          class="ml-4 text-sm text-gray-700 underline"
        >
          Register
        </inertia-link>
      </template>
    </div>
    <div class="login-body">
      <div class="login-wrapper">
        <div class="login-panel">
          <img
            src="images/layout/logo-dark.svg"
            class="logo"
            alt="diamond-layout"
          />

          <div class="login-form">
            <h2>Access to your Diamond Account</h2>
            <p>Don't have an account? <a href="/resigter">Register</a></p>
            <InputText id="email" placeholder="Email" />
            <Password placeholder="Password" />
            <Button label="LOGIN" type="button"></Button>
          </div>

          <p>A problem? <a href="/">Click here</a> and let us help you.</p>
        </div>
        <div class="login-image">
          <div class="login-image-content">
            <h1>Access to your</h1>
            <h1>Diamond</h1>
            <h1>Account</h1>
            <h3>
              Lorem ipsum dolor sit amet, consectetur <br />
              adipiscing elit. Donec posuere velit nec enim <br />
              sodales, nec placerat erat tincidunt.
            </h3>
          </div>
          <div class="image-footer">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <div class="icons">
              <i class="pi pi-github"></i>
              <i class="pi pi-twitter"></i>
            </div>
          </div>
        </div>
      </div>
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
