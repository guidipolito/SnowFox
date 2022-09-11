<script setup>
import ConfirmPopup from 'primevue/confirmpopup';
</script>
<template>
    <div class="layout-topbar">
        <Link href="/" class="layout-topbar-logo">
            <svg class="mr-2" width="44" height="44" viewBox="0 0 87.842 100.542" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><g transform="translate(-59.554 -100.283)"><circle style="fill:#fff;fill-opacity:0;stroke:#d1e3e8;stroke-width:6.819;stroke-linecap:butt;stroke-linejoin:miter;stroke-dasharray:none;stroke-opacity:.12036;paint-order:normal" cx="100.354" cy="152.259" r="36.478" fill="none"/><path style="fill:#a0aabc;fill-opacity:1;stroke:#000;stroke-width:0;stroke-linecap:butt;stroke-linejoin:miter;stroke-dasharray:none;stroke-opacity:1" d="M108.931 67.477c-7.266 9.904-4.86 27.683-4.86 27.683-.772-.546-3.205-7.349-3.205-7.349-5.79.325-14.209 8.036-14.209 8.036l1.252-3.334c-2.615 1.108-6.797 7.835-6.797 7.835-7.517 15.168-22.305 18.126-22.305 18.126-.83 4.366 7.129 4.27 7.129 4.27l-1.92 1.483c5.754 6.706 11.49 4.823 26.265 2.956 14.774-1.866 21.697 5.3 21.697 5.3 4.623-5.14-.469-14.166-.469-14.166 3.13.43 5.5 6.884 5.5 6.884 3.543-2.503 2.132-10.976 2.132-10.976 5.606 10.858-2.419 14.512-2.419 14.512-1.745 8.998-4.654 9.48-4.654 9.48-9.309-12.805-27.752-6.518-27.752-6.518 9.536.874 11.228 12.173 11.228 12.173 1.517-1.94 1.663-7.325 1.663-7.325 7.696 13.652.96 26.096.96 26.096 19.824-3.674 22.397-27.22 22.397-27.22 3.05 4.594.82 12.098.82 12.098 10.485-12.288 5.427-26.988 5.427-26.988 3.915 2.78 4.916 12.663 4.916 12.663 5.807-28.55-8.3-40.052-8.3-40.052.372 4.994-3.837 7.478-3.837 7.478s3.872-15.812-3.03-21.175c-6.903-5.363-7.629-11.97-7.629-11.97zm-.148 6.25s6.409 6.434 7.872 10.932 1.439 11.025.792 11.025-6.642-4.731-6.602-7.176c0 0-1.553 2.41-.695 4.055 0 0-3.111-3.48-2.399-9.437 0 0-2.654 6.232-2.633 8.905 0 0-1.661-11.39 3.665-18.303zm-22.717 32.724c.464-.008.973.046 1.53.178 5.097 1.205 7.882-.108 7.882-.108s-2.984 2.589-5.853 2.658c-2.87.07-2.883 1.656-4.074 2.424-1.19.768-4.092-.89-4.092-.89s.825-4.195 4.607-4.262z" transform="matrix(-1 0 0 1 204.432 34.405)"/><path style="fill:#e5e6e7;fill-opacity:1;stroke:#e6e6e6;stroke-width:0;stroke-linecap:butt;stroke-linejoin:miter;stroke-dasharray:none;stroke-opacity:1" d="M100.637 85.581c-2.48-.297-9.957 3.723-9.957 3.723s1.265-15.473 4.968-19.47c0 0 1.245-1.294 1.566 1.547.321 2.84 4.609 5.81 4.609 5.81s-1.982 6.916-1.186 8.39z" transform="matrix(-1 0 0 1 204.432 34.405)"/></g></svg>
            <span class="text-sm">Snow Fox</span>
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
