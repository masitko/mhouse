const TermCreate = () => import('../../../pages/schools/terms/Create.vue');

export default {
    name: 'schools.terms.create',
    path: 'create',
    component: TermCreate,
    meta: {
        breadcrumb: 'create',
        title: 'Create Term',
    },
};
