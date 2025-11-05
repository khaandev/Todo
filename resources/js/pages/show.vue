<template>
    <AppLayout>
        <Form
            :data="form"
            @submit="submit"
            v-slot="{ errors, processing }"
        >
            <div class="p-10 rounded-lg m-10 border grid grid-cols-3 gap-5">
                <!-- Multiple Images -->
                <div class="grid gap-2">
                    <Label for="images">Images</Label>
                    <Input
                        id="images"
                        type="file"
                        name="images"
                        multiple
                        ref="imagesInput"
                        @change="handleImages"
                    />
                    <InputError :message="errors.images" />
                </div>

                <!-- Title -->
                <div class="grid gap-2">
                    <Label for="title">Title</Label>
                    <Input
                        id="title"
                        v-model="form.title"
                        type="text"
                        required
                        placeholder="Title"
                    />
                    <InputError :message="errors.title" />
                </div>

                <!-- Description -->
                <div class="grid gap-2">
                    <Label for="description">Description</Label>
                    <Input
                        id="description"
                        v-model="form.description"
                        type="text"
                        placeholder="Description"
                    />
                    <InputError :message="errors.description" />
                </div>

                <!-- Due Date -->
                <div class="grid gap-2">
                    <Label for="due_date">Due Date</Label>
                    <Input
                        id="due_date"
                        v-model="form.due_date"
                        type="date"
                        required
                        :value="today"
                    />
                    <InputError :message="errors.due_date" />
                </div>

                <!-- Submit -->
                <Button
                    type="submit"
                    class="mt-4 w-full"
                    :disabled="processing"
                >
                    <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                    <span v-else>Submit</span>
                </Button>
            </div>
        </Form>
    </AppLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Form } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import InputError from '@/components/InputError.vue';
import { LoaderCircle } from 'lucide-vue-next';
import { Label } from '@/components/ui/label';

const today = new Date().toISOString().split('T')[0];

const imagesInput = ref(null);

const form = useForm({
    title: '',
    description: '',
    due_date: today,
    images: [],
});

function handleImages(event) {
    form.images = Array.from(event.target.files);
}

function submit() {
    form.post('/todos', {
        forceFormData: true,
    });

}
</script>
