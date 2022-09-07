<template>
    <div :class="containerClass" @click="onWrapperClick">
        <div class="layout-main-container">
            <div class="layout-main">
              <slot />
            </div>
            <AppFooter />
        </div>
    </div>
</template>

<script>
import AppFooter from '../Components/AppFooter.vue';

export default {
    emits: ['change-theme'],
    components: {
        'AppFooter': AppFooter,
    }
}
</script>

