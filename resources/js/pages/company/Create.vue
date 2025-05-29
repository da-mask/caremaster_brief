<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import HeadingSmall from '@/components/HeadingSmall.vue';
    import InputError from '@/components/InputError.vue';

    import { type BreadcrumbItem } from '@/types';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import { Input } from '@/components/ui/input'
    import { Label } from '@/components/ui/label'
    import { Button } from '@/components/ui/button'
    import { type Company } from '@/types/caremaster';
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Companies',
            href: route('companies.index'),
        },
        {
            title: 'Create',
            href: route('companies.create'),
        }
    ];
    const form = useForm<Company>({
        name: '',
        abn: '',
        email: '',
        address: '',
    });
    
    const submit = () => {
        form.post(route('companies.store'));
    };
</script>
<template>
    <Head title="Create Company" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-2xl">
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="">
                    <HeadingSmall title="Create Company" description="Fill in the form below to create a new company" />

                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input
                                id="name"
                                ref="nameInput"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="name"
                                placeholder="Company Name"
                            />
                            <InputError :message="form.errors.name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="abn">ABN</Label>
                            <Input
                                id="abn"
                                ref="abnInput"
                                v-model="form.abn"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="abn"
                                placeholder="ABN"
                            />
                            <InputError :message="form.errors.abn" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input
                                id="email"
                                ref="emailInput"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                autocomplete="email"
                                placeholder="Email"
                            />
                            <InputError :message="form.errors.email" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="address">Address</Label>
                            <Input
                                id="address"
                                ref="addressInput"
                                v-model="form.address"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="address"
                                placeholder="Address"
                            />
                            <InputError :message="form.errors.address" />
                        </div>

                        <div class="flex items-center gap-4">
                            <Button :disabled="form.processing">Save company</Button>

                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p v-show="form.recentlySuccessful" class="text-sm text-neutral-600">Saved.</p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>