<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import HeadingSmall from '@/components/HeadingSmall.vue';
    import InputError from '@/components/InputError.vue';

    import { type BreadcrumbItem } from '@/types';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import { Input } from '@/components/ui/input'
    import { Label } from '@/components/ui/label'
    import { Button } from '@/components/ui/button'
    import { type Employee } from '@/types/caremaster';
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Employees',
            href: route('employees.index'),
        },
        {
            title: 'Create',
            href: route('companies.create'),
        }
    ];
    const form = useForm<Employee>({
        name: '',
        abn: '',
        email: '',
        address: '',
    });

    const submit = () => {
        form.post(route('employees.store'));
    };
</script>

<template>
    <Head title="Create Employee" />
    <AppLayout :breadcrumbs="breadcrumbs">
    </AppLayout> 
</template>