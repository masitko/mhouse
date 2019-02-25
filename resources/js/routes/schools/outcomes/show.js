const OutcomeShow = () => import('../../../pages/schools/outcomes/Show.vue');

export default {
    name: 'schools.outcomes.show',
    path: ':outcome',
    component: OutcomeShow,
    meta: {
        breadcrumb: 'show',
        title: 'Outcome Profile',
    },
};
