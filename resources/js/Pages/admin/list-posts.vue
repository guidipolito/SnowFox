<template>
    <div class="card">
        <DataTable :value="posts.data" class="p-datatable-lg" :scrollable="true" >
            <template #header>
                <div class="flex align-items-center">
                    <span>Posts</span>
                    <Link :href="route('posts.create')" class="ml-auto">
                        <Button icon="pi pi-plus-circle" v-tooltip=" 'New' " />
                    </Link>
                </div>
            </template>
            <Column field="id" header="ID"></Column>
            <Column field="title" header="Title"></Column>
            <Column field="slug" header="Slug"></Column>
            <Column field="status" header="Status"></Column>
            <Column header="Ações">
                <template #body="{data}">
                    <Link :href="route('posts.edit', data.id)">
                        <Button icon="pi pi-pencil" v-tooltip="'Editar'"></Button>
                    </Link>
                </template>
            </Column>
        </DataTable>
    </div>
</template>


<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Row from 'primevue/row';
import { Link } from '@inertiajs/inertia-vue3';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';

export default{
    components: {
        AppLayout, DataTable, Row, Column, Button, Dialog, InputText, Link
    },
    layout: AppLayout,
    props: {
        posts: Array,
    },
    data(){
        return {
            editVisible: false,
        }
    },
}
</script>
