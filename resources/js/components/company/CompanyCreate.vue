<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/vue3';

const emit = defineEmits(['cancel', 'created']);

const form = useForm({
    name: '',
    abn: '',
    email: '',
    address: '',
});

function handleSubmit() {
    form.post(route('companies.store'), {
        onSuccess: () => {
            emit('created');
        },
    });
}

function handleCancel() {
    emit('cancel');
}
</script>

<template>
    <div class="w-full">
        <Card>
            <CardHeader>
                <CardTitle>Create Company</CardTitle>
                <CardDescription>Add a new company to the system</CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="handleSubmit" class="space-y-4">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="name">Company Name</Label>
                            <Input id="name" v-model="form.name" type="text" required />
                            <div v-if="form.errors.name" class="text-sm text-red-500">{{ form.errors.name }}</div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="abn">ABN</Label>
                            <Input id="abn" v-model="form.abn" type="text" required />
                            <div v-if="form.errors.abn" class="text-sm text-red-500">{{ form.errors.abn }}</div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input id="email" v-model="form.email" type="email" required />
                            <div v-if="form.errors.email" class="text-sm text-red-500">{{ form.errors.email }}</div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="address">Address</Label>
                            <Input id="address" v-model="form.address" type="text" required />
                            <div v-if="form.errors.address" class="text-sm text-red-500">{{ form.errors.address }}</div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <Button @click="handleCancel" type="button" variant="outline">Cancel</Button>
                        <Button type="submit" :disabled="form.processing" variant="default">Create Company</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
