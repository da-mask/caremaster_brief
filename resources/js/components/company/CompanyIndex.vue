<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { type Company } from '@/types/caremaster';

defineProps<{
    companies?: Company[];
}>();

const emit = defineEmits(['create', 'edit']);

function handleEdit(company) {
    emit('edit', company);
}

function handleCreate() {
    emit('create');
}
</script>

<template>
    <div class="w-full">
        <Card>
            <CardHeader>
                <CardTitle>Companies</CardTitle>
                <CardDescription>Manage your companies</CardDescription>
            </CardHeader>
            <CardContent>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">Name</TableHead>
                            <TableHead>ABN</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead>Address</TableHead>
                            <TableHead>Employee Count</TableHead>
                            <TableHead>Actions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="company in companies" :key="company.id">
                            <TableCell class="font-medium">{{ company.name }}</TableCell>
                            <TableCell>{{ company.abn }}</TableCell>
                            <TableCell>{{ company.email }}</TableCell>
                            <TableCell>{{ company.address }}</TableCell>
                            <TableCell>{{ company.employees_count }}</TableCell>
                            <TableCell>
                                <Button @click="handleEdit(company)" variant="secondary" class="mr-2"> Edit Company </Button>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </CardContent>
            <CardFooter>
                <Button @click="handleCreate" variant="default">Create a Company</Button>
            </CardFooter>
        </Card>
    </div>
</template>
