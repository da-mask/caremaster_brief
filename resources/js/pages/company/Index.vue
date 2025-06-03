<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { Head, Link } from '@inertiajs/vue3';
    import { type Company } from '@/types/caremaster';
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
            title: 'Companies',
            href: route('companies.index'),
        }
    ];
    defineProps<{ 
        companies?: Company[] 
    }>();
</script>

<template>
    <Head title="Companies" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-2xl">
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-[100px]">
                                    Name
                                </TableHead>
                                <TableHead>ABN</TableHead>
                                <TableHead>Email</TableHead>
                                <TableHead>Address</TableHead>
                                <TableHead>Employee Count</TableHead>
                                <TableHead>Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="company in companies" :key="company.id" class="">
                                <TableCell class="font-medium">
                                    {{ company.name }}
                                </TableCell>
                                <TableCell>{{ company.abn }}</TableCell>
                                <TableCell>{{ company.email }}</TableCell>
                                <TableCell>{{ company.address }}</TableCell>
                                <TableCell>{{ company.employees_count }}</TableCell>
                                <TableCell>
                                    <Button as-child variant="secondary">
                                        <Link :href="route('companies.edit', company.id)">Edit</Link>
                                    </Button>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                    <Button as-child variant="secondary" class="my-4">
                        <Link :href="route('companies.create')">Add Company</Link>
                    </Button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>