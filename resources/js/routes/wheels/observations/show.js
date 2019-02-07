const ObservationShow = () => import('../../../pages/wheels/observations/Show.vue');

export default {
    name: 'wheels.observations.show',
    path: ':observation',
    component: ObservationShow,
    meta: {
        breadcrumb: 'show',
        title: 'Observation Profile',
    },
};
