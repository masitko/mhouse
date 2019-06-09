const OutcomeHistory = () => import('../../../pages/schools/outcomes/Index.vue');

export default {
    name: 'schools.outcomes.history',
    path: 'history',
    component: OutcomeHistory,
    meta: {
        breadcrumb: 'history',
        title: 'Outcomes History',
        history: true
    },
};
