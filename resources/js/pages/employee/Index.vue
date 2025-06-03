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
    import DashboardCounter from '@/components/DashboardCounter.vue'

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
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <DashboardCounter 
                        title="Total Companies" 
                        description="Total number of companies in the system" 
                        count=1
                        />
                </div>
                <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <DashboardCounter 
                        title="Total Employees" 
                        description="Total number of employees in the system" 
                        count=1
                        />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                    <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        <Button as-child>
                            <Link :href="route('employees.create')">Create Employee</Link>
                        </Button>
                        <Table>
                            <TableCaption>Employee List</TableCaption>
                            <TableHeader>
                                <TableRow>
                                    <TableHead class="w-[100px]">
                                        Name
                                    </TableHead>
                                    <TableHead>Email</TableHead>
                                    <TableHead>Phone</TableHead>
                                    <TableHead>Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="employee in employees" :key="employee.id" class="">
                                    <TableCell class="font-medium">
                                        {{ employee.first_name }} {{ employee.last_name }}
                                    </TableCell>
                                    <TableCell>{{ employee.email }}</TableCell>
                                    <TableCell>{{ employee.phone }}</TableCell>
                                    <TableCell>
                                        <Button as-child variant="destructive" >
                                            <Link :href="route('employees.destroy', employee.id)">Delete</Link>
                                        </Button>
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>