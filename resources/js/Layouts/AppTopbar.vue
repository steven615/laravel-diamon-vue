<template>
  <div class="layout-topbar">
    <div class="topbar-left">
      <a tabindex="0" class="menu-button" @click="onMenuButtonClick">
        <i class="pi pi-chevron-left"></i>
      </a>
      <span class="topbar-separator"></span>

      <div
        class="layout-breadcrumb viewname"
        style="text-transform: uppercase"
      ></div>

      <img
        id="logo-mobile"
        class="mobile-logo"
        src="images/layout/logo-dark.svg"
        alt="diamond-layout"
      />
    </div>

    <div class="topbar-right">
      <ul class="topbar-menu">
        <li class="search-item">
          <a tabindex="0" @click="onSearchClick">
            <i class="pi pi-search"></i>
          </a>
        </li>
        <li
          class="notifications-item"
          :class="{ 'active-menuitem ': topbarNotificationMenuActive }"
        >
          <a href="#" tabindex="0" @click="onTopbarNotificationMenuButtonClick">
            <i class="pi pi-bell"></i>
            <span class="topbar-badge">5</span>
          </a>
          <ul class="notifications-menu fade-in-up">
            <li role="menuitem">
              <a href="#" tabindex="0">
                <i class="pi pi-shopping-cart"></i>
                <div class="notification-item">
                  <div class="notification-summary">Novos Pedidos</div>
                  <div class="notification-detail">
                    Você tem <strong>3</strong> novos pedidos.
                  </div>
                </div>
              </a>
            </li>
            <li role="menuitem">
              <a href="#" tabindex="0">
                <i class="pi pi-check-square"></i>
                <div class="notification-item">
                  <div class="notification-summary">Atendimento Concluído</div>
                  <div class="notification-detail">
                    Melhoria material promocional.
                  </div>
                </div>
              </a>
            </li>
            <li role="menuitem">
              <a href="#" tabindex="0">
                <i class="pi pi-chart-line"></i>
                <div class="notification-item">
                  <div class="notification-summary">Relatórios Mensais</div>
                  <div class="notification-detail">
                    Novos relatórios estão prontos.
                  </div>
                </div>
              </a>
            </li>
            <li role="menuitem">
              <a href="#" tabindex="0">
                <i class="pi pi-comments"></i>
                <div class="notification-item">
                  <div class="notification-summary">Comentários</div>
                  <div class="notification-detail">
                    <strong>2</strong> novos comentários.
                  </div>
                </div>
              </a>
            </li>
            <li role="menuitem">
              <a href="#" tabindex="0">
                <i class="pi pi-exclamation-circle"></i>
                <div class="notification-item">
                  <div class="notification-summary">
                    Requisição de Devolução
                  </div>
                  <div class="notification-detail">
                    <strong>1</strong> para revisar.
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </li>

        <li
          class="profile-item"
          :class="{ 'active-menuitem fadeInDown': topbarUserMenuActive }"
        >
          <a href="#" @click="onTopbarUserMenuButtonClick">
            <img
              src="images/avatar/profile.jpg"
              alt="diamond-layout"
              class="profile-image"
            />
            <span class="profile-name">Maria da Penha</span>
          </a>
          <ul class="profile-menu fade-in-up">
            <li>
              <a href="#">
                <i class="pi pi-user"></i>
                <span>Meus Dados</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="pi pi-cog"></i>
                <span>Configurações</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="pi pi-calendar"></i>
                <span>Calendário</span>
              </a>
            </li>
            
            <li>
              <a href="#" @click="logout">
                <i class="pi pi-power-off"></i>
                <span>Logout</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="right-sidebar-item">
          <a href="#" tabindex="0" @click="onRightMenuClick">
            <i class="pi pi-align-right"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "AppTopbar",
  emits: [
    "menu-button-click",
    "search-click",
    "topbar-notification",
    "topbar-user-menu",
    "right-menubutton-click",
  ],
  props: {
    topbarNotificationMenuActive: Boolean,
    topbarUserMenuActive: Boolean,
  },
  data() {
    return {
      items: [],
    };
  },
  unmounted() {
    if (this.subscription) {
      this.subscription.unsubscribe();
    }
  },
  methods: {
    onMenuButtonClick(event) {
      this.$emit("menu-button-click", event);
    },
    onSearchClick(event) {
      this.$emit("search-click", event);
    },
    onTopbarNotificationMenuButtonClick(event) {
      this.$emit("topbar-notification", event);
    },
    onTopbarUserMenuButtonClick(event) {
      this.$emit("topbar-user-menu", event);
    },
    onRightMenuClick(event) {
      this.$emit("right-menubutton-click", event);
    },
    logout() {
      this.$inertia.post(route("logout"));
    },
  },
};
</script>