<script setup lang="ts">
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import Button from '@/components/ui/button/Button.vue';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Rocket } from 'lucide-vue-next';





interface Product {
    id: number,
    name: string,
    price: number,
    sku: string,
    description: string,
}
interface Props {
    products: Product[];
}
//Get props from inertia
const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Products',
        href: '/products',
    },
];

const page = usePage();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div v-if="page.props.flash?.message" class="mb-4">
                <Alert class="bg-blue-00">
                    <Rocket class="h-4 w-4" />
                    <AlertTitle> Notification </AlertTitle>
                    <AlertDescription>
                        {{ page.props.flash.message }}
                    </AlertDescription>
                </Alert>
            </div>
            <Link :href="route('products.create')"> <Button> Create a Product</Button></Link>
            <div>
                <Table>
                    <TableCaption>A list of your recent Products</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px]">
                                ID
                            </TableHead>
                            <TableHead>Name</TableHead>
                            <TableHead>Price</TableHead>
                            <TableHead>SKU</TableHead>
                            <TableHead>Description</TableHead>
                            <TableHead class="text-center"> 
                                Action
                            </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for ="product in props.products" :key ="product.id">
                            <TableCell>{{product.id}}</TableCell>
                            <TableCell>{{product.name}}</TableCell>
                            <TableCell>{{product.price}}</TableCell>
                            <TableCell>{{product.sku}}</TableCell>
                            <TableCell> {{product.description}} </TableCell>
                            <TableCell class ="text-center">
                               <Link :href="route('products.edit', {id: product.id})"><Button class ="bg-slate-600"> Edit</Button></Link>
                            </TableCell>
                            
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
            
        </div>
    </AppLayout>
</template>
