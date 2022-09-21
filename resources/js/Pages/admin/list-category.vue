<template>
    <div class="card">

        <Toolbar>
            <template #end>
                <Button icon="pi pi-plus-circle" @click="createCategory" v-tooltip=" 'New' " />
            </template>
        </Toolbar>

        <template v-if="message">
            <Message severity="success" class="opacity-80">{{ message }}</Message>
        </template>

        <template v-if="categories.length">
            <DataTable :value="categories" class="p-datatable-lg" :scrollable="true" >
                <template #header>
                    Categorias
                </template>
                <Column field="id" header="ID"></Column>
                <Column field="name" header="Nome"></Column>
                <Column field="slug" class="break-words" header="Slug"></Column>
                <Column header="Ações">
                    <template #body="{data}">
                        <Button icon="pi pi-pencil" @click="editCategory(data)" v-tooltip="'Editar'"></Button>
                    </template>
                </Column>
            </DataTable>
        </template>
        <h2 v-else> <center> Sem categorias cadastradas </center> </h2>


        <Dialog v-model:visible="formVisible" modal style="width: 400px; max-width: 90%;">
            <template #header>
                <h4 class="m-0">{{ typeof this.form.id == 'undefined' ? 'Criar Categoria' : 'Editando #'+this.form.id }}</h4>
            </template>
            <form @submit.prevent="submit">
                <label for="name" class="block text-900 text-sm font-medium mb-2">name</label>
                <InputText class="w-full" id="name" v-model="form.name" placeholder="Category name" />
                <small class="p-error" v-if="errors.name">{{ errors.name }}</small>

                <label for="slug" class="block text-900 text-sm font-medium mb-2 mt-3">Slug</label>
                <InputText id="email" class="w-full" v-model="form.slug" placeholder="my-category-url" />
                <small class="p-error" v-if="errors.slug">{{ errors.slug }}</small>

                <label for="description" class="block text-900 text-sm font-medium mb-2 mt-3">Description</label>
                <TextArea id="description" class="w-full" v-model="form.description" placeholder="Say a few words about this category" />
                <small class="p-error" v-if="errors.description">{{ errors.description }}</small>

                <Button class="block mt-3" type="submit" label="Salvar" />
            </form>
        </Dialog>

    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Message from 'primevue/message';
import Toolbar from 'primevue/toolbar';
import TextArea from 'primevue/textarea';
import { Inertia } from '@inertiajs/inertia';

export default {
    data(){
        const formBase = () => useForm({
            name: '',
            slug: '',
            description: '',
        })
        let form = formBase()

        const submit = () => {
            if(typeof this.form.id == 'undefined'){
                this.form.post(route('category.store'), {
                    wantsjson: true,
                    onSuccess: (res)=>{ 
                        this.formVisible = false
                        this.message = 'Category created successfully'
                        Inertia.reload({only: ['categories']})
                    }
                })
            }else{
                this.form.put(route('category.update', this.form.id), {
                    wantsjson: true,
                    onSuccess: ()=>{
                        this.formVisible = false
                        this.message = 'Post #'+this.form.id+' Updated'
                    }
                });
            }
            this.form.clearErrors()
        }
        const createCategory = () => {
            this.formVisible = true
            this.form = formBase();
            }
        const editCategory = data => {
            this.formVisible = true
            this.form = useForm(data)
        }
        return { 
            submit, form, 
            formVisible: false,
            createCategory, 
            editCategory,
            message: '',
        }
    },
    props: {
        categories: Array,
        errors: Object,
    },
    layout: AppLayout,
    components: {
        Dialog, InputText, Button, Message, Toolbar, DataTable, Column, TextArea
    },
}

</script>
