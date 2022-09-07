<script setup>
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import Checkbox from 'primevue/checkbox';
import Button from 'primevue/button';
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';

let form = useForm({
  username: '',
  password: '',
})

const submit = ()=>{
  form.post(route('login'))
}


</script>
<template>
  <AuthenticatedLayout>
    <div class="surface-0 flex  justify-content-center pt-5 w-full overflow-hidden">
        <div class="grid justify-content-center p-2 lg:p-0" style="min-width:80%">
            <div class="col-12 xl:mt-0 text-center">
                <img :src="'layout/images/logo-' + logoColor + '.svg'" alt="Sakai logo" class="mb-5">
            </div>
            <div class="col-12 xl:col-6" style="border-radius:56px; padding:0.3rem; background: linear-gradient(180deg, var(--primary-color), rgba(33, 150, 243, 0) 30%);">
                <form @submit.prevent="submit" class="h-full w-full m-0 py-7 px-4" style="border-radius:53px; background: linear-gradient(180deg, var(--surface-50) 38.9%, var(--surface-0));">
                    <div class="text-center mb-5">
                        <img src="layout/images/avatar.png" alt="Image" height="50" class="mb-3">
                        <div class="text-900 text-3xl font-medium mb-3">Login</div>
                        <span class="text-600 font-medium">Autentifique-se para continuar</span>
                    </div>

                    <div class="w-full md:w-10 mx-auto">
                        <label for="username" class="block text-900 text-xl font-medium mb-2">Username</label>
                        <InputText id="username" v-model="form.username" type="text" class="w-full mb-3" placeholder="Email" style="padding:1rem;" />

                        <label for="password1" class="block text-900 font-medium text-xl mb-2">Senha</label>
                        <Password id="password1" v-model="form.password" placeholder="Password" :toggleMask="true" class="w-full mb-3" inputClass="w-full" inputStyle="padding:1rem"></Password>

                        <div class="flex align-items-center justify-content-between mb-5">
                            <div class="flex align-items-center">
                                <Checkbox id="rememberme1" v-model="checked" :binary="true" class="mr-2"></Checkbox>
                                <label for="rememberme1">Remember me</label>
                            </div>
                            <a class="font-medium no-underline ml-2 text-right cursor-pointer" style="color: var(--primary-color)">Forgot password?</a>
                        </div>
                        <Button label="Entrar" type="submit" class="w-full p-3 text-xl"></button>
                        <Link :href="route('register')" style="float: right">
                          <Button type="link" label="Criar Conta" class="p-button-outlined p-3 text-xl mt-3" ></button>
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
            checked: false
        }
    },
}
</script>

<style scoped>
.pi-eye {
    transform:scale(1.6);
    margin-right: 1rem;
}
.pi-eye-slash {
    transform:scale(1.6);
    margin-right: 1rem;
}
</style>
