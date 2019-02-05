const SchoolEdit = () => import('../../../pages/administration/schools/Edit.vue');

export default {
    name: 'administration.schools.edit',
    path: ':school/edit',
    component: SchoolEdit,
    meta: {
        breadcrumb: 'edit',
        title: 'Edit School',
    },
};
