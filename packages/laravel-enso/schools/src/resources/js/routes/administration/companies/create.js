const CompanyCreate = () => import('../../../pages/administration/schools/Create.vue');

export default {
    name: 'administration.schools.create',
    path: 'create',
    component: CompanyCreate,
    meta: {
        breadcrumb: 'create',
        title: 'Create School',
    },
};
