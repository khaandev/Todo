<template>
    <AppLayout>
        <div class="m-10">
            <!-- Header + Add Button -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-zinc-800 dark:text-zinc-100">
                    Todo List
                </h1>
                <Link href="/todos/create">
                <Button>Add New</Button>
                </Link>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto rounded-2xl shadow-sm border border-zinc-200 dark:border-zinc-700">
                <table class="min-w-full text-sm text-left border-collapse">
                    <thead class="bg-zinc-900 text-white">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Due Date</th>
                            <th class="px-4 py-3">Completed At</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(todo, index) in todos" :key="todo.id"
                            class="border-b border-zinc-200 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition">
                            <td class="px-4 py-3">{{ index + 1 }}</td>
                            <td class="px-4 py-3 font-medium">{{ todo . title }}</td>
                            <td class="px-4 py-3 text-zinc-600 dark:text-zinc-300">
                                {{ todo . description }}
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    :class="{
                                        'text-yellow-600 bg-yellow-100 px-2 py-1 rounded text-xs font-medium': todo
                                            .status === 'pending',
                                        'text-blue-600 bg-blue-100 px-2 py-1 rounded text-xs font-medium': todo
                                            .status === 'in_progress',
                                        'text-green-600 bg-green-100 px-2 py-1 rounded text-xs font-medium': todo
                                            .status === 'completed',
                                    }">
                                    {{ todo . status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ todo . due_date }}</td>
                            <td class="px-4 py-3">{{ todo . completed_at || "—" }}</td>
                            <td class="px-4 py-3 flex gap-2 justify-center">
                                <Link :href="`/todos/${todo.id}/edit`">
                                <Button variant="outline" size="sm">Edit</Button>
                                </Link>
                                <Button variant="destructive" size="sm" @click="deleteTodo(todo.id)">
                                    Delete
                                </Button>
                            </td>
                        </tr>

                        <!-- Empty state -->
                        <tr v-if="!todos.length">
                            <td colspan="7" class="text-center py-6 text-zinc-500">
                                No todos found.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/layouts/AppLayout.vue'
    import {
        Button
    } from '@/components/ui/button'
    import {
        Link,
        router
    } from '@inertiajs/vue3'

    defineProps({
        todos: Array,
    })

    const deleteTodo = (id) => {
        if (confirm('Are you sure you want to delete this todo?')) {
            router.delete(`/todos/${id}`)
        }
    }
</script>
