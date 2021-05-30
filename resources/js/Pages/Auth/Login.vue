<template>
  <div class="login-body">
    <div class="login-wrapper">
      <div class="login-panel">
        <img
          src="images/layout/logo-dark.svg"
          class="logo"
          alt="diamond-layout"
        />

        <form @submit.prevent="submit" class="login-form">
          <h2>Access to your Diamond Account</h2>
          <p>Don't have an account? <a href="/register">Register</a></p>
          <InputText
            id="email"
            type="email"
            placeholder="Email"
            v-model="form.email"
            required
            autofocus
          />
          <Password
            id="password"
            v-model="form.password"
            placeholder="Password"
            required
            autocomplete="current-password"
          />

          <jet-validation-errors class="mb-4" />

          <div class="p-d-flex p-ai-center p-jc-xl-end">
            <inertia-link
              v-if="canResetPassword"
              :href="route('password.request')"
              class="reset-password"
            >
              Forgot your password?
            </inertia-link>
            <Button
              label="LOGIN"
              type="submit"
              :disabled="form.processing"
            ></Button>
          </div>
        </form>

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
</template>

<script>
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
  components: {
    JetValidationErrors,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
};
</script>

<style scoped lang="scss">
.login-body .login-wrapper .login-panel .login-form > input,
.login-body .login-wrapper .login-panel .login-form > button {
  max-width: 274px;
}

.reset-password {
  font-size: 0.875rem;
  line-height: 1.25rem;
  text-decoration: underline;
  color: #4b5563;
  margin-right: 15px;

  &:hover {
    color: #111827;
  }
}

.mb-4 {
  margin-bottom: 16px;
}
</style>

