<template>
    <div class="card">
        <form @submit.prevent="submit">
            <h2>{{ typeof this.post == 'undefined' ? 'Criar Post' : 'Editar Post' }}</h2>
            <div class="mb-3">
                <label class="">Title</label>
                <InputText v-model="form.title" class="w-full" />
                <small class="p-error" v-if="errors.title">{{ errors.title }}</small>
            </div>
            <div class="mb-3 flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <label class="">Slug</label>
                    <InputText v-model="form.slug" class="w-full" />
                    <small class="p-error" v-if="errors.slug">{{ errors.slug }}</small>
                </div>
                <div class="flex-1">
                    <label class="">status</label>
                    <Dropdown v-model="form.status" class="w-full" :options="statusOptions" />
                    <small class="p-error" v-if="errors.status">{{ errors.status }}</small>
                </div>
            </div>
            <div>
                <label class="">Content</label>
                <Editor v-model="form.content" editorStyle="height: 320px" modules=""/>
                <small class="p-error" v-if="errors.title">{{ errors.content }}</small>
            </div>
            <Button type="submit" class="mt-3" label="Salvar" />
        </form>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import InputText from 'primevue/inputtext';
import Dropdown from 'primevue/dropdown';
import Editor from 'primevue/editor';
import Button from 'primevue/button';

export default {
    layout: AppLayout,
    props: {
        post: Object,
        errors: Object,
    },
    methods: {
        slugFilter(str){
            return str.toLowerCase().replace(/ /g, '-').replace(/[^(a-z0-9\-)]/g, '')
        }
    },
    watch:{
        'form.title'(value, oldValue){
            if( this.form.slug == '' || this.slugFilter(oldValue) == this.form.slug ) this.form.slug = this.slugFilter(value)
        }
    },
    components:{
        InputText, Editor, Dropdown, Button
    },
    data(){
        let form, submit
        
        if(typeof this.post != 'undefined'){
            form = useForm(this.post)
            submit = () => form.post( route('posts.update', post.id) )
        }else{
            form = useForm({
                title: '',
                slug: '',
                content: '',
                status: 'private',
            })
            submit = () => form.post(route('posts.store'))
        }

        let statusOptions = [
            'private', 'public'
        ]

        return {form, submit, statusOptions}
    },
}
</script>
<style>
.ql-tooltip ql-editing{
    z-index: 999;
}
.p-editor-content p{
    font-size: 1.3rem;
}
</style>
