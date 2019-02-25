const OutcomeEdit = () => import('../../../pages/schools/outcomes/Edit.vue');

export default {
    name: 'schools.outcomes.edit',
    path: ':outcome/edit',
    component: OutcomeEdit,
    meta: {
        breadcrumb: 'edit',
        title: 'Edit Outcome',
    },
};
