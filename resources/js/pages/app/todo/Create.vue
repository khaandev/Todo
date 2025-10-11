<template>

    <AppLayout>
           <Form v-bind="TodoController.store.form()"
                 v-slot="{ errors, processing }">

               <div class="p-10 rounded-lg m-10 border grid grid-cols-3 gap-5">

        <div class="grid  gap-2">
                    <Label for="title">title</Label>
                    <Input
                        id="title"
                        type="text"
                        name="title"
                        required
                        autofocus
                        autocomplete="title"
                        placeholder="title"
                    />
                     <InputError :message="errors.title" />
                </div>
                <div class="grid  gap-2">
                    <Label for="description">description</Label>
                    <Input
                        id="description"
                        type="text"
                       name="description"
                        required
                        autocomplete="description"
                        placeholder="description"
                    />
                     <InputError :message="errors.description" />
                </div>
                   <div class="grid  gap-2">
                       <Label for="due_date">Due Date</Label>
                       <Input
                           id="due_date"
                           type="date"
                           name="due_date"
                           required
                           :default-value="today"
                           autocomplete="due_date"
                           placeholder="due_date"
                       />
                       <InputError :message="errors.due_date" />
                   </div>
               <Button
                   type="submit"
                   class="mt-4 w-full"
                   :tabindex="4"
                   :disabled="processing"
                   data-test="submit-button"
               >
                   <LoaderCircle
                       v-if="processing"
                       class="h-4 w-4 animate-spin"
                   />
                   Submit
               </Button>
               </div>
           </Form>



    </AppLayout>
</template>
<script setup lang="ts">


    import { Button } from '@/components/ui/button';
    import { Input } from '@/components/ui/input';
    import AppLayout from '@/layouts/AppLayout.vue';
    import { Form } from '@inertiajs/vue3';
    import TodoController from '@/actions/App/Http/Controllers/TodoController';
    import InputError from '@/components/InputError.vue';
    import { LoaderCircle } from 'lucide-vue-next';

    const today = new Date().toISOString().split('T')[0];

</script>
