const AreaEdit = () => import('../../../pages/wheels/areas/Edit.vue');

export default {
    name: 'wheels.areas.edit',
    path: ':area/edit',
    component: AreaEdit,
    meta: {
        breadcrumb: 'edit',
        title: 'Edit Area',
    },
};
