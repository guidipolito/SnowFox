<template>
    <div class="card">

        <template v-if="message">
            <Message severity="success" class="opacity-80">{{ message }}</Message>
        </template>

        <template v-if="categories.length">
            <TreeTable :value="tree" class="p-datatable-lg" :scrollable="true" >
                <template #header>
                    <div class="flex align-items-center">
                        <span>Categorias</span>
                        <Button icon="pi pi-plus-circle" class="ml-auto" @click="createCategory" v-tooltip=" 'New' " />
                    </div>
                </template>
                <Column field="id" header="ID" :expander="true" />
                <Column field="name" header="Name" />
                <Column field="slug" class="break-words" header="Slug" />
                <Column header="Actions">
                    <template #body="data">
                        <Button icon="pi pi-pencil" @click="editCategory(data)" v-tooltip="'Edit'"></Button>
                    </template>
                </Column>
            </TreeTable>
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

                <label for="parent_id" class="block text-900 text-sm font-medium mb-2 mt-3">Parent Category</label>
            
                <small class="p-error" v-if="errors.description">{{ errors.description }}</small>
                <Dropdown class="w-full" :options="categories" optionLabel="name" optionValue="id" v-model="form.parent_id" />

                <Button class="block mt-3" type="submit" label="Salvar" />
            </form>
        </Dialog>

    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import TreeTable from 'primevue/treetable';
import Column from 'primevue/column';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Message from 'primevue/message';
import Toolbar from 'primevue/toolbar';
import TextArea from 'primevue/textarea';
import Dropdown from 'primevue/dropdown';
import { Inertia } from '@inertiajs/inertia';

export default {
    data(){
        const formBase = () => useForm({
            name: '',
            slug: '',
            description: '',
            parent_id: null,
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
                        Inertia.reload({only: ['categories']})
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
            this.form = useForm(data.node.data)
        }
        const getTree = () => { 
            const mapNodes = obj => {
                let children = []
                if(obj.children.length > 0){
                    children = obj.children.filter(item=>typeof item != 'undefined').map(data=>mapNodes(data))
                }
                return { key: obj.path.replace('.', '-'), data: obj, children }
            }
            return this.categories.filter(item=>{console.log(item); return true}).map(obj=>mapNodes(obj));
        }

        let tree = getTree()
        this.$watch('categories', ()=>this.tree = getTree() )

        return { 
            submit, form, 
            formVisible: false,
            createCategory, 
            editCategory,
            message: '',
            tree,
        }
    },
    props: {
        categories: Array,
        errors: Object,
    },
    layout: AppLayout,
    components: {
        Dialog, InputText, Button, Message, Toolbar, TreeTable, Column, TextArea, Dropdown
    },
}

</script>
