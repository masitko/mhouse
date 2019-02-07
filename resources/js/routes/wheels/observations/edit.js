const ObservationEdit = () => import('../../../pages/wheels/observations/Edit.vue');

export default {
    name: 'wheels.observations.edit',
    path: ':observation/edit',
    component: ObservationEdit,
    meta: {
        breadcrumb: 'edit',
        title: 'Edit Observation',
    },
};
