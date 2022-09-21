<template>
    <div class="card">
        <DataTable :value="users" class="p-datatable-lg" :scrollable="true" >
            <template #header>
                Usuarios
            </template>
            <Column field="id" header="ID"></Column>
            <Column field="name" header="Nome"></Column>
            <Column field="email" class="break-words" header="Email"></Column>
            <Column field="email_verified_at" header="Verificado"></Column>
            <Column header="Ações">
                <template #body="{data}">
                    <Button icon="pi pi-pencil" @click="edit(data)" v-tooltip="'Editar'"></Button>
                </template>
            </Column>
        </DataTable>
    </div>

    <Dialog v-model:visible="editVisible" modal style="width: 400px; max-width: 90%;">
        <template #header>
            <h3 class="m-0">Editando</h3>
        </template>
        <form @submit.prevent="submitForm">
            <label for="username" class="block text-900 text-sm font-medium mb-2">Username</label>
            <InputText class="mb-3 w-full" id="username" v-model="editing.name" />
            <small class="p-error" v-if="errors.name">{{ errors.name }}</small>

            <label for="email" class="block text-900 text-sm font-medium mb-2">Email</label>
            <InputText id="email" class="w-full" v-model="editing.email" />
            <small class="p-error" v-if="errors.name">{{ errors.email }}</small>

            <Button class="block mt-3" type="submit" label="Salvar" />
        </form>
    </Dialog>
</template>


<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Row from 'primevue/row';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';

import Tooltip from 'primevue/tooltip';

export default{
    components: {
        AppLayout, DataTable, Row, Column, Button, Dialog, InputText
    },
    layout: AppLayout,
    props: {
        users: Array,
        errors: Object,
    },
    data(){
        return {
            editVisible: false,
        }
    },
    setup(){
        const editing = useForm({
            name: '',
            email: '',
            id: false,
        })
        const submitForm = () => {
            editing.submit('PUT', route('users.update'))
        }
        return { editing }
    },
    methods:{
        edit(data){
            this.editing = data
            this.editVisible = true && this.editing.id !== false
        }
    }
}
</script>
