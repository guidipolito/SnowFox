<script setup>
import ConfirmPopup from 'primevue/confirmpopup';
</script>
<template>
    <div class="layout-topbar">
        <Link href="/" class="layout-topbar-logo">
            <img alt="Logo"  />
            <span>Snow Fox</span>
        </Link>
        <button class="p-link layout-menu-button layout-topbar-button" @click="onMenuToggle">
            <i class="pi pi-bars"></i>
        </button>

        <button class="p-link layout-topbar-menu-button layout-topbar-button"
            :class="{ selector: '@next', enterClass: 'hidden', enterActiveClass: 'scalein',
            leaveToClass: 'hidden', leaveActiveClass: 'fadeout', hideOnOutsideClick: true}">
            <i class="pi pi-ellipsis-v"></i>
        </button>
        <ul class="layout-topbar-menu hidden lg:flex origin-top">
            <li>
            <button class="p-link layout-topbar-button">
                <i class="pi pi-calendar"></i>
                <span>Events</span>
            </button>
            </li>
            <li>
            <button class="p-link layout-topbar-button">
                <i class="pi pi-cog"></i>
                <span>Settings</span>
            </button>
            </li>
            <li>
            <button class="p-link layout-topbar-button">
                <i class="pi pi-user"></i>
                <span>Profile</span>
            </button>
            </li>
            <li>
                <button @click="onLogout()" class="p-link layout-topbar-button">
                    <i class="pi pi-sign-out"></i>
                    <span>Profile</span>
                </button>
                <ConfirmPopup></ConfirmPopup>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    methods: {
        onLogout(){
            this.$confirm.require({
                target: event.currentTarget,
                message: 'Tem certeza que deseja sair?',
                icon: 'pi pi-exclamation-triangle',
                accept: () => {
                    this.$inertia.visit(route('logout'), {method: 'POST'})
                },
                reject: () => {
                }
            });
        },
        onMenuToggle(event) {
              this.$emit('menu-toggle', event);
          },
        onTopbarMenuToggle(event) {
              this.$emit('topbar-menu-toggle', event);
        },
    },
}
</script>
