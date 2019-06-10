const UserCreate = () => import('../../../pages/administration/users/Create.vue');

export default {
    name: 'administration.students.create',
    path: 'create',
    component: UserCreate,
    meta: {
        breadcrumb: 'create',
        title: 'Create Student',
    },
};
