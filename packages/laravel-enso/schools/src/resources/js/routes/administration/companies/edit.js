const CompanyEdit = () => import('../../../pages/administration/schools/Edit.vue');

export default {
    name: 'administration.schools.edit',
    path: ':school/edit',
    component: CompanyEdit,
    meta: {
        breadcrumb: 'edit',
        title: 'Edit School',
    },
};
