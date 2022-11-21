import IndexProduct from './components/AllProduct.vue';
import CreateProduct from './components/CreateProduct.vue';
import EditProduct from './components/EditProduct.vue';

export const routes = [
    {
        name: 'product.index',
        path: '/products',
        component: IndexProduct
    },
    {
        name: 'products.create',
        path: '/products/create',
        component: CreateProduct
    },
    {
        name: 'products.edit',
        path: '/products/edit/:id',
        component: EditProduct
    }
];