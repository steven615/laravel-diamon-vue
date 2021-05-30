<template>
  <jet-authentication-card>
    <!-- <form @submit.prevent="submit">
      <div>
        <jet-label for="name" value="Name" />
        <jet-input
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />
      </div>

      <div class="mt-4">
        <jet-label for="email" value="Email" />
        <jet-input
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
        />
      </div>

      <div class="mt-4">
        <jet-label for="password" value="Password" />
        <jet-input
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-4">
        <jet-label for="password_confirmation" value="Confirm Password" />
        <jet-input
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />
      </div>

      <div
        class="mt-4"
        v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
      >
        <jet-label for="terms">
          <div class="flex items-center">
            <jet-checkbox
              name="terms"
              id="terms"
              v-model:checked="form.terms"
            />

            <div class="ml-2">
              I agree to the
              <a
                target="_blank"
                :href="route('terms.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900"
                >Terms of Service</a
              >
              and
              <a
                target="_blank"
                :href="route('policy.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900"
                >Privacy Policy</a
              >
            </div>
          </div>
        </jet-label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <inertia-link
          :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-900"
        >
          Already registered?
        </inertia-link>

        <jet-button
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Register
        </jet-button>
      </div>
    </form> -->
  </jet-authentication-card>
  <div class="login-body">
    <div class="login-wrapper">
      <div class="login-panel">
        <img
          src="images/layout/logo-dark.svg"
          class="logo"
          alt="diamond-layout"
        />

        <form @submit.prevent="submit" class="login-form">
          <h2>Create Your Free Account</h2>
          <p>Already have an account? <a href="/login">Login</a></p>
          <InputText
            id="name"
            placeholder="Full Name"
            v-model="form.name"
            required
            autofocus
            autocomplete="name"
          />
          <InputText
            id="email"
            type="email"
            placeholder="Email"
            v-model="form.email"
            required
          />
          <Password
            id="password"
            placeholder="Password"
            v-model="form.password"
            required
            autocomplete="new-password"
          />
          <Password
            id="password_confirmation"
            placeholder="Confirm Password"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
          />

          <jet-validation-errors class="mb-4" />

          <div class="btn-register">
            <Button
              label="REGISTER"
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
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
  },

  data() {
    return {
      form: this.$inertia.form({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        terms: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("register"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
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

.mb-4 {
  margin-bottom: 16px;
}

.btn-register {
  width: 274px;
  display: flex;
  justify-content: flex-end;
}
</style>
