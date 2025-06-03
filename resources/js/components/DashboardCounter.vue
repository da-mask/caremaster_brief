<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
  } from '@/components/ui/card'
  defineProps<{
    title: string
    description: string
    count: number
  }>()
 
</script>
<template>
  <Card>
    <CardHeader>
      <CardTitle class="text-center text-2xl">{{ title }}</CardTitle>
      <CardDescription class="text-center">{{ description }}</CardDescription>
    </CardHeader>
    <CardContent class="text-center text-5xl">
      {{ count }}
    </CardContent>
  </Card>
</template>