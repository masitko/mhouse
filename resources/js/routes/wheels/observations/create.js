const ObservationCreate = () => import('../../../pages/wheels/observations/Create.vue');

export default {
    name: 'wheels.observations.create',
    path: 'create',
    component: ObservationCreate,
    meta: {
        breadcrumb: 'create',
        title: 'Create Observation',
    },
};
