const SchoolClassEdit = () => import('../../../pages/schools/classes/Edit.vue');

export default {
    name: 'schools.classes.edit',
    path: ':schoolClass/edit',
    component: SchoolClassEdit,
    meta: {
        breadcrumb: 'edit',
        title: 'Edit School Class',
    },
};
