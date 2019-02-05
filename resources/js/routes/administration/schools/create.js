const SchoolCreate = () => import('../../../pages/administration/schools/Create.vue');

export default {
    name: 'administration.schools.create',
    path: 'create',
    component: SchoolCreate,
    meta: {
        breadcrumb: 'create',
        title: 'Create School',
    },
};
