<template>
    <div class="card">
        <form @submit.prevent="submit">
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
                <Editor v-model="form.content" editorStyle="height: 320px"/>
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
    components:{
        InputText, Editor, Dropdown, Button
    },
    setup(){
        let form, submit

        if(typeof post != 'undefined'){
            form = useForm(post)
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
<style scoped>
.p-editor-content p{
    font-size: 1.3rem;
}
</style>
