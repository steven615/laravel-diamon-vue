<template>
    <div class="layout-sidebar" @click="onMenuClick">
        <a href="/dashboard" class="logo">
            <img id="app-logo" class="logo-image" src="images/layout/logo-m2-white.svg" alt="M2" />

            <span class="app-name">M2</span>
        </a>


        <div class="layout-menu-container">
            <AppSubmenu :items="model" :layoutMode="layoutMode" :parentMenuItemActive="true" :menuActive="active" :mobileMenuActive="mobileMenuActive" :root="true" @menuitem-click="onMenuItemClick" @root-menuitem-click="onRootMenuItemClick" />
        </div>
    </div>
</template>

<script>
import AppSubmenu from "./AppSubmenu";
export default {
    name: "AppMenu",
    emits: ["menu-click", "menuitem-click", "root-menuitem-click"],
    props: {
        model: Array,
        layoutMode: String,
        active: Boolean,
        mobileMenuActive: Boolean
    },
    methods: {
        onMenuClick(event) {
            this.$emit("menu-click", event);
        },
        onMenuItemClick(event) {
            this.$emit("menuitem-click", event);
        },
		onRootMenuItemClick(event) {
			this.$emit("root-menuitem-click", event);
		}
    },
    components: { AppSubmenu },
};
</script>
