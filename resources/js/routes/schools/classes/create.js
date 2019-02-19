const SchoolClassCreate = () => import('../../../pages/schools/classes/Create.vue');

export default {
    name: 'schools.classes.create',
    path: 'create',
    component: SchoolClassCreate,
    meta: {
        breadcrumb: 'create',
        title: 'Create School Class',
    },
};
