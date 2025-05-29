<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { Head, Link } from '@inertiajs/vue3';
    import { type Employee } from '@/types/caremaster';
    import {
        Table,
        TableBody,
        TableCaption,
        TableCell,
        TableHead,
        TableHeader,
        TableRow,
    } from '@/components/ui/table'
    import { Button } from '@/components/ui/button'

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Employees',
            href: route('employees.index'),
        },
    ];
    defineProps<{ 
        employees?: Employee[] 
    }>();
</script>

<template>
    <Head title="Employees" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-2xl">
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <Link :href="route('employees.create')">
                        <Button>Create Employee</Button>
                    </Link>
                    <Table>
                        <TableCaption>Employee List</TableCaption>
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-[100px]">
                                    Name
                                </TableHead>
                                <TableHead>Email</TableHead>
                                <TableHead>Address</TableHead>
                                <TableHead>Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="employee in employees" :key="employee.id" class="">
                                <TableCell class="font-medium">
                                    {{ employee.first_name }} {{ employee.last_name }}
                                </TableCell>
                                <TableCell>{{ employee.email }}</TableCell>
                                <TableCell>{{ employee.address }}</TableCell>
                                <TableCell>
                                    <Link :href="route('employees.edit', employee.id)" class="text-primary hover:underline">
                                        Edit
                                    </Link>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>