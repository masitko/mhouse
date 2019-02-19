const TermEdit = () => import('../../../pages/schools/terms/Edit.vue');

export default {
    name: 'schools.terms.edit',
    path: ':term/edit',
    component: TermEdit,
    meta: {
        breadcrumb: 'edit',
        title: 'Edit Term',
    },
};
