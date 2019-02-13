const WheelCreate = () => import('../../../pages/wheels/wheels/Edit.vue');

export default {
    name: 'wheels.wheels.create',
    path: 'create',
    component: WheelCreate,
    meta: {
        breadcrumb: 'create',
        title: 'Create Wheel',
    },
};
