const WheelEdit = () => import('../../../pages/wheels/wheels/Edit.vue');

export default {
    name: 'wheels.wheels.edit',
    path: ':wheel/edit',
    component: WheelEdit,
    meta: {
        breadcrumb: 'edit',
        title: 'Edit Wheel',
    },
};
